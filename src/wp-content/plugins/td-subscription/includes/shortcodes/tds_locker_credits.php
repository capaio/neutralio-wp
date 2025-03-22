<?php

/**
 * Class tds_locker_credits
 */

class tds_locker_credits extends td_block {

    private static $separator_enabled = false;


	public function get_custom_css() {

        // $unique_block_class
        $unique_block_class = $this->block_uid;

		$compiled_css = '';

		/** @noinspection CssInvalidAtRule */
		$raw_css =
            "<style>

                /* @tds_locker_credits */
                body .tds_locker_credits {
                    margin-bottom: 0;
                    font-family: Verdana, BlinkMacSystemFont, -apple-system, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                }
                body .tds_locker_credits .tds-block-inner {
                    margin: 0 auto;
                    padding: 55px 45px 60px;
                    max-width: 650px;
                    background-color: #fff;
                    text-align: center;
                }
                body .tds_locker_credits .tds-locker-title {
                    margin-top: 0;
                    margin-bottom: 26px;
                    font-family: var(--td_default_google_font_2, 'Roboto', sans-serif);
                    font-size: 24px;
                    line-height: 1.2; 
                    font-weight: 700; 
                }
                body .tds_locker_credits.tds-user-not-logged .tds-locker-title .tds-not-logged-hide,
                body .tds_locker_credits.tds-user-not-logged .tds-under-title-msg .tds-not-logged-hide {
                    display: none;
                }
                body .tds_locker_credits .tds-info:not(:empty) {
                    margin-bottom: 12px; 
                }
                body .tds_locker_credits .tds-messages {
                    padding: 8px 12px;
                    font-size: 12px;
                    line-height: 1.2;
                    color: #fff;
                    border-radius: 3px;
                    transition: opacity .2s ease-in-out;
                }
                body .tds_locker_credits .tds-messages:not(:last-child) {
                    margin-bottom: .4em;
                }
                body .tds_locker_credits .tds-messages-hiding {
                    opacity: 0;
                }
                body .tds_locker_credits .tds-messages-error {
                    background-color: #ec4d4d;
                }
                body .tds_locker_credits .tds-messages-success {
                    background-color: #6bc16f;
                }
                body .tds_locker_credits .tds-message:not(:last-child) {
                    margin-bottom: .4em;
                }
                body .tds_locker_credits .tds-under-title-msg {
                    font-size: 12px;
                    line-height: 1.6;
                    color: #444;
                }
                body .tds_locker_credits .tds-under-title-msg:not(.tds-under-title-msg-no-space) {
                    margin-bottom: 20px;
                }
                body .tds_locker_credits .tds-input-wrap {
                    margin-bottom: 12px;
                    display: flex;
                    flex-direction: column;
                }
                body .tds_locker_credits .tds-input-wrap .tds-input:not(:first-child) {
                    margin-top: 12px;
                }
                body .tds_locker_credits .tds-input {
                    height: 100%;
                    padding: 12px 15px;
                    line-height: 1;
                }
                body .tds_locker_credits .tds-submit-btn {
                    -webkit-appearance: none;
                    display: flex;
                    flex-direction: column;
                    width: 60%;
                    margin: 0 auto;
                    align-items: center;
                    justify-content: center; 
                    padding: 15px;
                    background-color: var(--td_theme_color, #4db2ec);
                    font-size: 13px;
                    line-height: 1;
                    color: #fff;
                    border-width: 0;
                    border-style: solid;
                    border-color: #000;
                    -webkit-transition: all 0.3s ease;
                    transition: all 0.3s ease;
                    outline: none;
                }
                body .tds_locker_credits .tds-submit-btn:disabled {
                   opacity: .5;
                }
                body .tds_locker_credits .tds-submit-btn:not(.disabled):hover {
                    background-color: #222;
                }
                body .tds_locker_credits .tds-after-btn-text {
                    margin-top: 12px;
                    font-size: 11px;
                    line-height: 1.2;
                    color: #888;
                }
                body .tds_locker_credits .tds-checkbox {
                    margin-top: 24px;
                }
                body .tds_locker_credits .tds-checkbox input {
                    display: none;
                }
                body .tds_locker_credits .tds-checkbox label {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 0;
                    cursor: pointer;
                }
                body .tds_locker_credits .tds-check {
                    position: relative;
                    width: 1em;
                    height: 1em;
                    margin-right: 8px;
                    background-color: #fff;
                    cursor: pointer;
                    border: 1px solid #ccc;
                    transition: all .3s ease-in-out;
                    flex-shrink: 0;
                }
                body .tds_locker_credits .tds-check:after {
                    content: '';
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 0.5em;
                    height: 0.5em;
                    background-color: var(--td_theme_color, #4db2ec);
                    opacity: 0;
                    transition: all .3s ease;
                    pointer-events: none;
                }
                body .tds_locker_credits .tds-checkbox input:checked + label .tds-check:after {
                    opacity: 1;
                }
                body .tds_locker_credits .tds-check-title {
                    margin-top: 1px;
                    user-select: none;
                    -webkit-user-select: none;
                    font-size: 11px;
                    text-align: left;
                    color: #444;
                    line-height: 1.2;
                }
                body .tds_locker_credits .tds-check-title a {
                    text-decoration: none;
                    color: var(--td_theme_color, #4db2ec);
                }
                body .tds_locker_credits .tds-check-title a:hover {
                    color: #222;
                }
                .td-post-content .tds-locked-content,
                .tdb_single_content .tds-locked-content,
                .page .tds-locked-content {
                  display: none;
                }

                /* @style_general_tds_locker_credits_with_separator */
                body .tds_locker_credits .tds-lc-separator {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding-top: 1.385em;
                    padding-bottom: 1.385em;
                    font-size: 13px;
                    line-height: 1;
                    font-weight: 700;
                    color: #555;
                }
                body .tds_locker_credits .tds-lc-separator:before,
                body .tds_locker_credits .tds-lc-separator:after {
                    content: '';
                    width: 3.462em;
                    height: 1px;
                    background-color: #555;
                    opacity: .15;
                }
                body .tds_locker_credits .tds-lc-separator:before {
                    margin-right: .769em;
                }
                body .tds_locker_credits .tds-lc-separator:after {
                    margin-left: .769em;
                }

                /* @style_general_tds_locker_credits_without_separator */
                body .tds_locker_credits {
                    margin-top: 20px;   
                }

                
                /* @all_border_size */
                html body .$unique_block_class .tds-block-inner {
                    border: @all_border_size solid @all_border_color;
                }
                /* @all_shadow_size */
                html body .$unique_block_class .tds-block-inner {
                    box-shadow: 0 0 @all_shadow_size @all_shadow_color;
                }
                
                /* @bg_color */
                html body .$unique_block_class .tds-block-inner {
                    background-color: @bg_color;
                }
                
                /* @title_color */
                html body .$unique_block_class .tds-locker-title {
                    color: @title_color !important;
                } 
                /* @message_color */
                html body .$unique_block_class .tds-under-title-msg {
                    color: @message_color !important;
                }
                
                /* @input_color */
                html body .$unique_block_class .tds-input,
                html body .$unique_block_class .tds-input::placeholder {
                    color: @input_color;
                } 
                /* @input_color_f */
                html body .$unique_block_class .tds-input:focus {
                    color: @input_color_f;
                }
                /* @input_bg_color */
                html body .$unique_block_class .tds-input {
                    background-color: @input_bg_color;
                }
                /* @input_bg_color_f */
                html body .$unique_block_class .tds-input:focus {
                    background-color: @input_bg_color_f;
                }
                /* @input_border_color */
                html body .$unique_block_class .tds-input {
                    border-color: @input_border_color;
                }
                /* @input_border_color_f */
                html body .$unique_block_class .tds-input:focus {
                    border-color: @input_border_color_f;
                }

                /* @btn_color */
                html body .$unique_block_class .tds-submit-btn {
                    color: @btn_color;
                }
                /* @btn_color_h */
                html body .$unique_block_class .tds-submit-btn:not(.disabled):hover {
                    color: @btn_color_h;
                }
                /* @btn_bg_color */
                html body .$unique_block_class .tds-submit-btn {
                    background-color: @btn_bg_color;
                }
                /* @btn_bg_color_h */
                html body .$unique_block_class .tds-submit-btn:not(.disabled):hover {
                    background-color: @btn_bg_color_h;
                }
                
                /* @after_btn_text_color */
                html body .$unique_block_class .tds-after-btn-text {
                    color: @after_btn_text_color;
                }
                
                /* @tds_pp_checked_color */
                html body .$unique_block_class .tds-check:after {
                    background-color: @tds_pp_checked_color;
                }
                /* @tds_pp_check_bg */
                html body .$unique_block_class .tds-check {
                    background-color: @tds_pp_check_bg;
                }
                /* @tds_pp_check_bg_f */
                html body .$unique_block_class .tds-checkbox input:checked + label .tds-check {
                    background-color: @tds_pp_check_bg_f;
                }
                /* @tds_pp_check_border_color */
                html body .$unique_block_class .tds-check {
                    border-color: @tds_pp_check_border_color;
                }
                /* @tds_pp_check_border_color_f */
                html body .$unique_block_class .tds-checkbox input:checked + label .tds-check {
                    border-color: @tds_pp_check_border_color_f;
                }
                
                /* @tds_pp_msg_color */
                html body .$unique_block_class .tds-check-title {
                    color: @tds_pp_msg_color;
                }
                /* @tds_pp_msg_links_color */
                html body .$unique_block_class .tds-check-title a {
                    color: @tds_pp_msg_links_color;
                }
                /* @tds_pp_msg_links_color_h */
                html body .$unique_block_class .tds-check-title a:hover {
                    color: @tds_pp_msg_links_color_h;
                }
                /* @tds_cl_sep_color */
                html body .$unique_block_class .tds-lc-separator {
                    color: @tds_cl_sep_color;
                }
                html body .$unique_block_class .tds-lc-separator:before,
                html body .$unique_block_class .tds-lc-separator:after {
                    background-color: @tds_cl_sep_color;
                }
                
                
                
                /* @tds_general */
                html body .$unique_block_class,
                html body .$unique_block_class * {
                    @tds_general
                }
                /* @tds_title */
                html body .$unique_block_class .tds-locker-title {
                    @tds_title
                }  
                /* @tds_message */
                html body .$unique_block_class .tds-under-title-msg {
                    @tds_message
                }
                /* @tds_input */
                html body .$unique_block_class .tds-input {
                    @tds_input
                }
                /* @tds_submit_btn_text */
                html body .$unique_block_class .tds-submit-btn {
                    @tds_submit_btn_text
                }
                /* @tds_after_btn_text */
                html body .$unique_block_class .tds-after-btn-text {
                    @tds_after_btn_text
                }
                /* @tds_pp_msg */
                html body .$unique_block_class .tds-check-title {
                    @tds_pp_msg
                }
                /* @tds_lc_sep_text */
                html body .$unique_block_class .tds-lc-separator {
                    @tds_lc_sep_text
                }

            </style>";

		$td_css_res_compiler = new td_css_res_compiler( $raw_css );
		$td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

		$compiled_css .= $td_css_res_compiler->compile_css();

		return $compiled_css;

	}

	static function cssMedia( $res_ctx ) {

        $res_ctx->load_settings_raw( 'tds_locker_credits', 1 );

        if ( self::$separator_enabled ) {
            $res_ctx->load_settings_raw( 'style_general_tds_locker_credits_with_separator', 1 );
        } else {
            $res_ctx->load_settings_raw( 'style_general_tds_locker_credits_without_separator', 1 );
        }



        /*-- LAYOUT -- */
        // border size
        $all_border_size = $res_ctx->get_shortcode_att('all_tds_border');
        $res_ctx->load_settings_raw( 'all_border_size', $all_border_size );
        if( $all_border_size != '' && is_numeric( $all_border_size ) ) {
            $res_ctx->load_settings_raw( 'all_border_size', $all_border_size . 'px' );
        }


        // shadow size
        $all_shadow_size = $res_ctx->get_shortcode_att('all_tds_shadow');
        $res_ctx->load_settings_raw( 'all_shadow_size', $all_shadow_size );
        if( $all_shadow_size != '' && is_numeric( $all_shadow_size ) ) {
            $res_ctx->load_settings_raw( 'all_shadow_size', $all_shadow_size . 'px' );
        }



		/*-- COLORS -- */
        $res_ctx->load_settings_raw( 'bg_color', $res_ctx->get_shortcode_att('tds_bg_color') );
        $all_border_color = $res_ctx->get_shortcode_att('all_tds_border_color');
        $res_ctx->load_settings_raw( 'all_border_color', '#000' );
        if( $all_border_color != '' ) {
            $res_ctx->load_settings_raw( 'all_border_color', $all_border_color );
        }
        $all_shadow_color = $res_ctx->get_shortcode_att('all_tds_shadow_color');
        $res_ctx->load_settings_raw( 'all_shadow_color', '#000' );
        if( $all_shadow_color != '' ) {
            $res_ctx->load_settings_raw( 'all_shadow_color', $all_shadow_color );
        }

		$res_ctx->load_settings_raw( 'title_color', $res_ctx->get_shortcode_att('tds_title_color') );
		$res_ctx->load_settings_raw( 'message_color', $res_ctx->get_shortcode_att('tds_message_color') );

        $res_ctx->load_settings_raw( 'input_color', $res_ctx->get_shortcode_att('tds_input_color') );
        $res_ctx->load_settings_raw( 'input_color_f', $res_ctx->get_shortcode_att('tds_input_color_f') );
        $res_ctx->load_settings_raw( 'input_bg_color', $res_ctx->get_shortcode_att('tds_input_bg_color') );
        $res_ctx->load_settings_raw( 'input_bg_color_f', $res_ctx->get_shortcode_att('tds_input_bg_color_f') );
        $res_ctx->load_settings_raw( 'input_border_color', $res_ctx->get_shortcode_att('tds_input_border_color') );
        $res_ctx->load_settings_raw( 'input_border_color_f', $res_ctx->get_shortcode_att('tds_input_border_color_f') );

        $res_ctx->load_settings_raw( 'btn_color', $res_ctx->get_shortcode_att('tds_submit_btn_text_color') );
        $res_ctx->load_settings_raw( 'btn_color_h', $res_ctx->get_shortcode_att('tds_submit_btn_text_color_h') );
		$res_ctx->load_settings_raw( 'btn_bg_color', $res_ctx->get_shortcode_att('tds_submit_btn_bg_color') );
        $res_ctx->load_settings_raw( 'btn_bg_color_h', $res_ctx->get_shortcode_att('tds_submit_btn_bg_color_h') );

        $res_ctx->load_settings_raw( 'after_btn_text_color', $res_ctx->get_shortcode_att('tds_after_btn_text_color') );

        $res_ctx->load_settings_raw( 'tds_pp_checked_color', $res_ctx->get_shortcode_att('tds_pp_checked_color') );
        $res_ctx->load_settings_raw( 'tds_pp_check_bg', $res_ctx->get_shortcode_att('tds_pp_check_bg') );
        $res_ctx->load_settings_raw( 'tds_pp_check_bg_f', $res_ctx->get_shortcode_att('tds_pp_check_bg_f') );
        $res_ctx->load_settings_raw( 'tds_pp_check_border_color', $res_ctx->get_shortcode_att('tds_pp_check_border_color') );
        $res_ctx->load_settings_raw( 'tds_pp_check_border_color_f', $res_ctx->get_shortcode_att('tds_pp_check_border_color_f') );

        $res_ctx->load_settings_raw( 'tds_pp_msg_color', $res_ctx->get_shortcode_att('tds_pp_msg_color') );
        $res_ctx->load_settings_raw( 'tds_pp_msg_links_color', $res_ctx->get_shortcode_att('tds_pp_msg_links_color') );
        $res_ctx->load_settings_raw( 'tds_pp_msg_links_color_h', $res_ctx->get_shortcode_att('tds_pp_msg_links_color_h') );

        $res_ctx->load_settings_raw( 'tds_cl_sep_color', $res_ctx->get_shortcode_att('tds_cl_sep_color') );



		/*-- FONTS -- */
        $res_ctx->load_font_settings( 'tds_general' );
		$res_ctx->load_font_settings( 'tds_title' );
        $res_ctx->load_font_settings( 'tds_message' );
        $res_ctx->load_font_settings( 'tds_input' );
        $res_ctx->load_font_settings( 'tds_submit_btn_text' );
        $res_ctx->load_font_settings( 'tds_after_btn_text' );
        $res_ctx->load_font_settings( 'tds_pp_msg' );
        $res_ctx->load_font_settings( 'tds_lc_sep_text' );

	}

	function __construct() {
		parent::disable_loop_block_features();
	}

	function render( $atts, $content = null ) {

        // don't render on AMP
        if ( td_util::is_amp() ) {
            return '';
        }

		parent::render( $atts );

        // is payable locker
        $tds_payable = $this->get_att('tds_payable' );

		/* -- title -- */
		$title_text = $this->get_att('tds_locker_credits_title' );

		/* -- message -- */
		$locker_message = $this->get_att('tds_locker_credits_message' );

		/* -- button -- */
		$btn_text = $this->get_att('tds_locker_credits_btn_text' );

        /* -- form submission msg -- */
        $tds_form_submission_message = '';

        // check if form was submitted to update $tds_form_submission_message
        if ( td_subscription::instance()->is_tds_credits_locker_form_submit() ) {

            if( tds_form_submission::has_errors() ) {

                $tds_form_submission_errors = tds_form_submission::get_errors();

                $tds_form_submission_message .= '<div class="tds-messages tds-messages-error">';
                foreach( $tds_form_submission_errors as $err_id => $err_msg ) {
                    $tds_form_submission_message .= '<div class="tds-message">' . __td( $err_msg ) . '</div>';
                }
                $tds_form_submission_message .= '</div>';

            } else {

                // get the form submit result
                $tds_form_submission_results = tds_form_submission::get_result();

                // check if form submit result was a successful post unlock and display a message
                if( isset($tds_form_submission_results['success']) ) {
                    $tds_form_submission_message .= '<div class="tds-messages tds-messages-success">';
                    $tds_form_submission_message .= '<div class="tds-message">' . __td( 'Post successfully unlocked!' ) . '</div>';
                    $tds_form_submission_message .= '</div>';
                }

            }

        }

		/* -- locker id -- */
		$tds_locker_id = !empty( $atts['tds_locker_id'] ) ? $this->get_att('tds_locker_id') : '';

		/* -- redirect url -- */
		$tds_successful_submit_rdr_url = !empty( $atts['tds_successful_submit_rdr_url'] ) ? $this->get_att('tds_successful_submit_rdr_url') : '';

		/* -- redirect url for not logged in users -- */
		$tds_locker_credits_btn_rdr_url = !empty( $atts['tds_locker_credits_btn_rdr_url'] ) ? $this->get_att('tds_locker_credits_btn_rdr_url') : '';

        /* -- enable separator -- */
        self::$separator_enabled = !empty( $atts['tds_locker_credits_sep_enabled'] ) ? $this->get_att('tds_locker_credits_sep_enabled') != '' : false;

        /* -- separator text -- */
        $tds_locker_credits_sep_text = !empty( $atts['tds_lc_sep_text'] ) ? $this->get_att('tds_lc_sep_text') : '';

		/* -- is locker preview -- */
		$tds_locker_preview = !empty( $atts['tds_locker_preview'] ) ? $this->get_att('tds_locker_preview') : '';

        global $post;

        // process post unlock credits cost to replace %unlock_credits_cost% placeholder in locker message
        $tds_post_unlock_credits = 'N/A';

        if ( $post instanceof WP_Post ) {

            // read post settings && get post locker credits meta
            $td_post_theme_settings = td_util::get_post_meta_array( $post->ID, 'td_post_theme_settings' );
            $tds_post_locker_credits = $td_post_theme_settings['tds_locker_credits'] ?? '';

            // get default post type credits cost
            $tds_options_credits_settings = tds_util::get_tds_option('credits_settings');
            $post_types_default_credits_settings = $tds_options_credits_settings ? unserialize($tds_options_credits_settings) : [];
            $post_type = get_post_type($post->ID);

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

        } elseif ( $tds_locker_preview ) {

            // on admin locker preview set a dummy value for %unlock_credits_cost% placeholder in locker message
            $tds_post_unlock_credits = '123';

        }

        // user available credits used for %available_credits% placeholder in locker message
        $available_credits = is_user_logged_in() ? tds_util::get_user_available_credits( get_current_user_id() ) : 'N/A';

        // replace placeholders in locker message
        $locker_message = str_replace( [ '%unlock_credits_cost%', '%available_credits%' ], [ $tds_post_unlock_credits, $available_credits ], $locker_message );

        // block classes
        $block_classes = $this->get_block_classes();

        // add user logged in class
        if ( !is_user_logged_in() ) {
            $block_classes .= ' tds-user-not-logged';
        }

		$buffy = '<div class="' . $block_classes . '" ' . $this->get_block_html_atts() . '>';

			$buffy .= $this->get_block_css();
			$buffy .= $this->get_block_js();

            $locked = true;
            if ( !empty( $tds_payable ) ) {
                $tds_locker_id = tds_email_locker::instance()->get_locker_id();
                $tds_locker_types = get_post_meta( $tds_locker_id, 'tds_locker_types', true );

                if ( !empty($tds_locker_types['tds_paid_subs_page_id']) ) {

                    if ( is_user_logged_in() ) {
                        $result = tds_util::get_subscriptions( get_current_user_id(), -1 );
                        if ( !empty($result) && !empty($result['subscriptions']) ) {

                            $subscriptions = $result['subscriptions'];

                            foreach ( $subscriptions as $subscription ) {

                                $valid_plan = false;

                                // check plan
                                if ( !empty( $tds_locker_types['tds_paid_subs_plan_ids'] ) && is_array( $tds_locker_types['tds_paid_subs_plan_ids'] ) && in_array( $subscription['plan_id'], $tds_locker_types['tds_paid_subs_plan_ids'] ) ) {
                                    $valid_plan = true;
                                }

                                // check subscription status
                                if ( $valid_plan ) {

                                    if ( in_array( $subscription['status'], [ 'free', 'active', 'trial' ] ) ) {
                                        $locked = false;
                                    }

                                }

                            }

                        }

                    }

                }

            }

            if ( !$locked ) {
                return '';
            }

            if ( self::$separator_enabled ) {
                $buffy .= '<div class="tds-lc-separator">' . $tds_locker_credits_sep_text . '</div>';
            }

			$buffy .= '<div class="tds-block-inner td-fix-index">';

                /* locker title */
			    if( !empty($title_text) ) {
                    $buffy .= '<h3 class="tds-locker-title">' . wp_kses_post($title_text) . '</h3>';
                }

                /* locker message */
                if( !empty($locker_message) ) {
                    $buffy .= '<div class="tds-under-title-msg">' . wp_kses_post($locker_message) . '</div>';
                }

                /* info display */
                $buffy .= '<div class="tds-info">';
                if( $tds_form_submission_message != '' ) {
                    $buffy .= $tds_form_submission_message;
                }
                $buffy .= '</div>';

                /* form */
                $buffy .= '<form class="tds-form" action="" method="post" name="">';

                    if ( $post instanceof WP_Post ) {
                        $buffy .= '<input type="hidden" name="tds_unlock_post_id" value="' . $post->ID . '">';

                        if ( !empty($tds_successful_submit_rdr_url) ) {
                            $buffy .= '<input type="url" name="rdr_url" value="' . esc_attr( esc_url($tds_successful_submit_rdr_url) ) . '" style="display: none;">';
                        }

                        if ( is_user_logged_in() ) {
                            $buffy .= '<button class="tds-submit-btn" type="submit" name="tds-unlock">' . wp_kses_post($btn_text) . '</button>';
                        } else {

                            $tds_login_url = '';
                            $login_register_page_id = tds_util::get_tds_option('create_account_page_id');

                            if ( class_exists('SitePress') ) {
                                $translated_login_register_page_id = apply_filters( 'wpml_object_id', $login_register_page_id, 'page' );
                                if ( !is_null($translated_login_register_page_id) ) {
                                    $login_register_page_id = $translated_login_register_page_id;
                                }

                            }

                            if ( !is_null($login_register_page_id) ) {
                                $login_register_permalink = get_permalink($login_register_page_id);
                                if ( false !== $login_register_permalink ) {
                                    $tds_login_url = esc_url($login_register_permalink);
                                }
                            }

                            ob_start();
                            ?>
                            <script>
                                /* global jQuery */
                                jQuery().ready( function () {

                                    // on btn submit redirect
                                    jQuery('body').on( 'click', '.<?php echo $this->block_uid; ?> .tds-submit-btn', function(event) {
                                        event.preventDefault();

                                        var $this = jQuery(this),
                                            dataRdrUrl = $this.data('rdr-url'),
                                            tdsRdrUrl = '<?php echo $tds_login_url ?>';

                                        if ( 'undefined' !== typeof dataRdrUrl ) {
                                            window.location.href = dataRdrUrl;
                                        } else if ( tdsRdrUrl ) {
                                            window.location.href = tdsRdrUrl;
                                        }

                                    });

                                });
                            </script>
                            <?php
                            td_js_buffer::add_to_footer("\n" . td_util::remove_script_tag( ob_get_clean() ) );

                            $data_rdr_url = $tds_locker_credits_btn_rdr_url ? ' data-rdr-url="' . esc_attr( esc_url($tds_locker_credits_btn_rdr_url) ) . '"' : '';
                            $buffy .= '<button class="tds-submit-btn" type="submit" name="tds-unlock"' . $data_rdr_url . '>' . wp_kses_post($btn_text) . '</button>';

                        }

                    } else {
                        $btn_disabled = !$tds_locker_preview ? ' disabled' : '';
                        $buffy .= '<button class="tds-submit-btn' . $btn_disabled . '" type="submit" name="tds-unlock"' . $btn_disabled . '>' . wp_kses_post($btn_text) . '</button>';
                    }

                $buffy .= '</form>';

            $buffy .= '</div>';

		$buffy .= '</div>';

		return $buffy;
	}

}
