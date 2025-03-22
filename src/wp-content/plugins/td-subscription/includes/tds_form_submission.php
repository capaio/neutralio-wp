<?php
/**
 * tds form submission class
 *
 */

defined( 'ABSPATH' ) || exit;

class tds_form_submission {

	private static $errors = array();

	private static $result = array();

	private static $subscribed_email = '';

	public static function init() {
		add_action( 'init', array( __CLASS__, 'process_submission' ) );
	}




    /**
     * PROCESSES LEAD SUBMISSION.
     *
     * @param $submit_from_ajax bool
     * @param $data_from_ajax array
     * @return void
     */
	public static function process_submission( $submit_from_ajax = false, $data_from_ajax = array() ) {

        $data = array();

        if( $submit_from_ajax ) {
            $data = $data_from_ajax;
        } else {

            if ( isset($_POST['tds-unlock']) ) {

                $data = array_merge( $data, [
                    'rdr_url' => $_POST['rdr_url'] ?? '',
                    'post_id' => $_POST['tds_unlock_post_id'] ?? '',
                    'user_id' => get_current_user_id(),
                    'action' => 'unlock'
                ]);

            } else {

                $data = array(
                    'list' => isset( $_POST['list'] ) ? (int) $_POST['list'] : '',
                    'rdr_url' => $_POST['rdr_url'] ?? '',
                    'action' => 'unsubscribe'
                );

                if( !isset( $_POST['subscribed'] ) ) {
                    $data = array_merge($data, array(
                        'email' => isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '',
                        'double_opt_in' => isset( $_POST['double_opt_in'] ) ? $_POST['double_opt_in'] : '',
                        'locker' => isset( $_POST['locker'] ) ? (int) $_POST['locker'] : '',
                        'token' => !empty( $_POST['g-recaptcha-response'] ) ? $_POST['g-recaptcha-response'] : '',
                    ));

                    // Custom fields data.
                    $custom_fields_data = array();
                    for ( $i = 1; $i <= 3; $i++ ) {
                        if ( !empty( $_POST["tds_locker_cf_{$i}"] ) ) {
                            $custom_fields_data["tds_locker_cf_{$i}"] = $_POST["tds_locker_cf_{$i}"];
                        }
                    }
                    $data['tdc_custom_fields'] = $custom_fields_data;

                    // Change the action type.
                    $data['action'] = 'subscribe';
                }

            }

        }

        if( empty( $data ) ) {
            return;
        }

        $list = $data['list'] ?? '';
        $rdr_url = $data['rdr_url'] ?? '';

        /* --
        -- Subscribe action.
        -- */
        if( $data['action'] == 'subscribe' ) {

            $email = $data['email'];


            /* -- Bail if email field is empty. -- */
            if( empty( $email ) ) {
                self::$errors['email_not_set'] = 'Please fill in an email address.';
                return;
            }


            /* -- Bail if email is invalid. -- */
            if( !is_email( $email) ) {
                self::$errors['email_not_valid'] = 'Please fill in a valid email.';
                return;
            }


            /* -- Validate Google reCaptcha if necessary. -- */
            if ( td_util::get_option('tds_captcha' ) == 'show' ) {
                $recaptcha_token = $data['token'];

                if ( $recaptcha_token != '' ) {
                    $captcha_data = td_util::verify_captcha( $recaptcha_token );
                    if (  $captcha_data['success'] === false ) {
                        self::$errors['captcha_is_not_valid'] = __td( 'CAPTCHA verification failed!' );
                        return;
                    }
                } else {
                    self::$errors['captcha_is_not_valid'] = __td( 'CAPTCHA verification failed!' );
                    return;
                }
            }


            /* -- Try creating the lead. -- */
            $locker = $data['locker'];
            $opt_in = $data['double_opt_in'];

            $new_lead_data = array(
                'tds_email' => $email,
                'tds_list_id' => $list,
                'tds_locker_id' => $locker,
                'tds_custom_fields' => $custom_fields_data
            );

            // If double-opt in is active, send a confirmation request email.
            if ( $opt_in === 'yes' ) {
                $new_lead_data['tds_validate_email'] = 'no';
                td_util::td_new_subscriber_double_opt_in($email, 'user');
            }

            // Create the lead.
            $tds_leads_api_response = tds_leads_api::add( $new_lead_data );


            /* -- Process the response. -- */
            // Errors.
            if ( self::is_api_error( $tds_leads_api_response ) ) {

                $api_error_id = $tds_leads_api_response['id'];
                switch ( $api_error_id ) {
                    // If email is found in list just update the cookie.
                    // @note the email validation is done in tds_leads_api::add
                    case 'email_found_in_list':
                        // Set results response.
                        // @note the new_lead_data is needed to set the tds_leads cookie
                        self::$result['new_lead_data'] = $new_lead_data;

                        // Set cookies.
                        self::set_cookies();

                        // Maybe redirect.
                        if ( !empty( $rdr_url ) && !$submit_from_ajax ) {
                            wp_redirect( $rdr_url );
                            exit();
                        }

                        break;
                    default:
                        // Set api error response
                        self::$errors['tds_leads_api_error'] = '<pre style="background-color: transparent; text-align: left; margin: 0 auto; max-width: 60%;"><strong>tds_leads_api_error:</strong><br>' . print_r( $tds_leads_api_response, true ) . '</pre>';
                        break;
                }

            // Success.
            } else {

                // Set results response.
                self::$result = $tds_leads_api_response;
                self::$result['new_lead_data'] = $new_lead_data;

                self::$subscribed_email = $email;

                // Set cookies.
                self::set_cookies();

                // Maybe redirect.
                if ( !empty($rdr_url) && !$submit_from_ajax ) {
                    wp_redirect($rdr_url);
                    exit();
                }

            }

        /* --
        -- Unlock action.
        -- */
        } elseif ( $data['action'] == 'unlock' ) {

            // read post settings
            $td_post_theme_settings = td_util::get_post_meta_array( $data['post_id'], 'td_post_theme_settings' );

            // get post locker credits cost meta
            $tds_post_locker_credits = $td_post_theme_settings['tds_locker_credits'] ?? '';

            // get default post type credits cost
            $tds_options_credits_settings = tds_util::get_tds_option('credits_settings');
            $post_types_default_credits_settings = $tds_options_credits_settings ? unserialize($tds_options_credits_settings) : [];
            $post_type = get_post_type($data['post_id']);

            $post_type_default_credits = '1';
            if ( $post_type && is_array($post_types_default_credits_settings) ) {
                foreach ( $post_types_default_credits_settings as $post_type_default_credits_settings ) {
                    if ( $post_type === $post_type_default_credits_settings['post_type'] ) {
                        $post_type_default_credits = $post_type_default_credits_settings['default_credits'];
                    }
                }
            }

            // set post unlock credits cost, if valid the individual post value the default post type value otherwise
            $tds_post_unlock_credits = ( $tds_post_locker_credits !== '' && is_numeric($tds_post_locker_credits) ) ? $tds_post_locker_credits : $post_type_default_credits;

            // get user available credits
            $available_credits = tds_util::get_user_available_credits( $data['user_id'] );

            // sufficient credits check
            if ( $available_credits < intval($tds_post_unlock_credits) ) {
                self::$errors['insufficient_credits'] = 'Insufficient credits available!';
                return;
            }

            // get user locker credits meta
            $tds_user_locker_credits = get_user_meta( $data['user_id'], 'tds_locker_credits', true );

            // add post_id => tds_locker_credits meta on user
            if ( $tds_user_locker_credits && is_array($tds_user_locker_credits) ) {
                $tds_user_locker_credits[$data['post_id']] = $tds_post_unlock_credits;
            } else {
                $tds_user_locker_credits = [
                    $data['post_id'] => $tds_post_unlock_credits
                ];
            }

            $meta_update_res = update_user_meta( $data['user_id'], 'tds_locker_credits', $tds_user_locker_credits );

            // set submit response
            //if ( $submit_from_ajax ) {
            //    self::$result = [
            //        '$data' => print_r( $data, true ),
            //        '$available_credits' => print_r( $available_credits, true ),
            //        '$tds_post_unlock_credits' => print_r( $tds_post_unlock_credits, true ),
            //        'tds_locker_credits_meta' => print_r( $tds_user_locker_credits, true ),
            //        '$meta_update_res' => var_export( $meta_update_res, true )
            //    ];
            //} else {
                self::$result = ['success'];
            //}

            // maybe redirect
            if ( !empty($rdr_url) && !$submit_from_ajax ) {
                wp_redirect($rdr_url);
                exit();
            }

        /* --
        -- Unsubscribe action.
        -- */
        } else {

            $lists_ids_array = explode(',', $list);

            /* -- Remove the lists from the cookies -- */
            $removed_all_lists = self::remove_lists_from_cookies( $lists_ids_array );

            /* -- Set the response. -- */
            self::$result = array( 'unsubscribed' => $lists_ids_array, 'removed_all' => $removed_all_lists );

            /* -- Maybe redirect. -- */
            if ( !empty($rdr_url) && !$submit_from_ajax ) {
                wp_redirect($rdr_url);
                exit();
            }

        }

		// check if already subscribed to list
//        if( isset( $_POST['subscribed'] ) ) {
//
//            // lists ids
//            $lists_ids = $_POST['list'] ?? '';
//            $lists_ids_array = explode(',', $lists_ids);
//
//            // rdr url data
//            $rdr_url = $_POST['rdr_url'] ?? '';
//
//            // remove the lists from the cookies
//            $removed_all_lists = self::remove_lists_from_cookies( $lists_ids_array );
//
//            // set the result
//            self::$result = array('unsubscribed' => $lists_ids_array, 'removed_all' => $removed_all_lists);
//
//            // maybe redirect
//            if ( !empty( $rdr_url ) ) {
//                wp_redirect( $rdr_url );
//                exit();
//            }
//
//        } else if( isset( $_POST['tds_leads_subscribe'] ) ) {
//
//            // check email is set
//            if ( isset( $_POST['email'] ) && !empty( $_POST['email'] ) ) {
//
//                // email/list & rdr url data
//                $email = sanitize_email( wp_unslash( $_POST['email'] ) );
//                $list = isset( $_POST['list'] ) ? (int) $_POST['list'] : '';
//                $opt_in = isset( $_POST['double_opt_in'] ) ? $_POST['double_opt_in'] : '';
//                $locker = isset( $_POST['locker'] ) ? (int) $_POST['locker'] : '';
//                $rdr_url = $_POST['rdr_url'] ?? '';
//                $show_captcha = td_util::get_option('tds_captcha' );
//                $token = !empty( $_POST['g-recaptcha-response'] ) ? $_POST['g-recaptcha-response'] : '';
//
//                // custom fields data
//                $custom_fields_data = array();
//                for ( $i = 1; $i <= 3; $i++ ) {
//                    if ( !empty( $_POST["tds_locker_cf_{$i}"] ) ) {
//                        $custom_fields_data["tds_locker_cf_{$i}"] = $_POST["tds_locker_cf_{$i}"];
//                    }
//                }
//
//                // check email is valid
//                if ( is_email( $email ) ) {
//
//                    if ( $show_captcha == 'show' ) {
//                        if ( $token != '' ) {
//                            $captcha_data = td_util::verify_captcha( $token );
//                            if (  $captcha_data['success'] === false ) {
//                                self::$errors['captcha_is_not_valid'] = __td( 'CAPTCHA verification failed!' );
//                                return;
//                            }
//                        } else {
//                            self::$errors['captcha_is_not_valid'] = __td( 'CAPTCHA verification failed!' );
//                            return;
//                        }
//                    }
//
//
//                    $new_lead_data = array(
//                        'tds_email' => $email,
//                        'tds_list_id' => $list,
//                        'tds_locker_id' => $locker,
//                        'tds_custom_fields' => $custom_fields_data
//                    );
//
//                    // is double opt-in
//                    if ( $opt_in === 'yes' ) {
//                        //set no, waiting confirmation
//                        $new_lead_data['tds_validate_email'] = 'no';
//                        //send the email
//                        td_util::td_new_subscriber_double_opt_in($email, 'user');
//                    }
//
//                    // store(add) lead email
//                    $tds_leads_api_response = tds_leads_api::add( $new_lead_data );
//
//                    // api error
//                    if ( self::is_api_error( $tds_leads_api_response ) ) {
//
//                        // api error id
//                        $api_error_id = $tds_leads_api_response['id'];
//
//                        switch ( $api_error_id ) {
//                            // if email is found in list just update the cookie
//                            // @note the email validation is done in tds_leads_api::add
//                            case 'email_found_in_list':
//
//                                // set results response
//                                // @note the new_lead_data is needed to set the tds_leads cookie
//                                self::$result['new_lead_data'] = $new_lead_data;
//
//                                // set cookies
//                                self::set_cookies();
//
//                                // maybe redirect
//                                if ( !empty( $rdr_url ) ) {
//                                    wp_redirect( $rdr_url );
//                                    exit();
//                                }
//
//                                break;
//                            default:
//                                // set api error response
//                                //if ( is_user_logged_in() && current_user_can('switch_themes') ) {
//                                self::$errors['tds_leads_api_error'] = '<pre style="background-color: transparent; text-align: left; margin: 0 auto; max-width: 60%;"><strong>tds_leads_api_error:</strong><br>' . print_r( $tds_leads_api_response, true ) . '</pre>';
//                                //}
//                                break;
//                        }
//
//                        // success
//                    } else {
//
//                        // set results resp
//                        self::$result = $tds_leads_api_response;
//                        self::$result['new_lead_data'] = $new_lead_data;
//
//                        self::$subscribed_email = $email;
//
//
//                        // set cookies
//                        self::set_cookies();
//
//                        // maybe redirect
//                        if ( !empty( $rdr_url ) ) {
//                            wp_redirect( $rdr_url );
//                            exit();
//                        }
//
//                    }
//                    // invalid email error response
//                } else {
//                    self::$errors['email_not_valid'] = 'Please fill in a valid email.';
//                }
//
//            } else {
//
//                // no email set error response
//                self::$errors['email_not_set'] = 'Please fill in an email address.';
//
//            }
//
//        }

	}

	public static function is_api_error($response) {
		return isset( $response['type'] ) && $response['type'] === 'error';
	}

	public static function has_errors() {
		if ( !empty( self::$errors ) ) {
			return true;
		}
		return false;
	}

	public static function get_errors() {
		return self::$errors;
	}

	public static function get_result() {
		return self::$result;
	}

	public static function set_cookies() {

		// do not set the cookies if the headers have been sent for some reasons ..otherwise a user can see warnings
		if ( headers_sent() )
			return;

		$new_cookie_val = array();
		$result = self::get_result();
		$new_lead_list_id = $result['new_lead_data']['tds_list_id'];

		if ( !isset( $_COOKIE['tds_leads'] ) ) {
			$new_cookie_val[] = $new_lead_list_id;
		} else {
			//$old_cookie_val = maybe_unserialize( $_COOKIE['tds_leads'] );
			$old_cookie_val = $_COOKIE['tds_leads'];
			$new_cookie_val = array_merge( array( $new_lead_list_id ), explode( ',', $old_cookie_val ) );
		}

		if( !empty( $new_cookie_val ) ) {
			setcookie(
				'tds_leads',
				//serialize( $new_cookie_val ),
				implode( ',', $new_cookie_val ),
				time() + 3600 * 24 * 5000,
				COOKIEPATH,
				COOKIE_DOMAIN
			);
		}


		$cookie_email = 'tds_leads_email';
		$email = self::$subscribed_email;

		if ( !isset( $_COOKIE[$cookie_email] ) ) {
			$new_cookie_emails[] = $email;
		} else {
			$old_cookie_emails = $_COOKIE[$cookie_email];
			$new_cookie_emails = array_merge( array( $email ), explode( ',', $old_cookie_emails ) );
		}


		if (!empty($new_cookie_emails)) {
			setcookie(
				$cookie_email,
				implode( ',', $new_cookie_emails ),
				time() + 3600 * 24 * 5000,
				COOKIEPATH,
				COOKIE_DOMAIN
			);
		}
	}

    public static function remove_lists_from_cookies($lists_ids) {

        // do not set the cookies if the headers have been sent for some reasons ..otherwise a user can see warnings
        if ( headers_sent() )
            return;

        $removed_all_lists = false;

        if( isset( $_COOKIE['tds_leads'] ) ) {
            $cookie_leads = $_COOKIE['tds_leads'];

            $new_cookie_val = explode( ',', $cookie_leads );

            foreach( $lists_ids as $list_id ) {
                if( in_array( $list_id, $new_cookie_val) ) {
                    unset( $new_cookie_val[array_search( $list_id, $new_cookie_val )] );
                }
            }

            if( empty( $new_cookie_val ) ) {
                $removed_all_lists = true;
            }

            setcookie(
                'tds_leads',
                implode( ',', $new_cookie_val ),
                time() + 3600 * 24 * 5000,
                COOKIEPATH,
                COOKIE_DOMAIN
            );
        }


        if( !empty( $_COOKIE['tds_leads_email'] ) ) {
	        $cookie_leads_email = explode( ',', $_COOKIE[ 'tds_leads_email' ] );

	        foreach( $cookie_leads_email as $email ) {
	        	tds_leads_api::remove_email($email);
	        }

	        setcookie(
                'tds_leads_email',
                '',
                -1,
                COOKIEPATH,
                COOKIE_DOMAIN
            );
        }

        return $removed_all_lists;

    }

}

tds_form_submission::init();
