<?php

/**
 * Class tds_dashboard
 */

class tds_dashboard extends td_block {

	public function get_custom_css() {

        // $unique_block_class
        $unique_block_class = $this->block_uid;

		$compiled_css = '';

		/** @noinspection CssInvalidAtRule */
		$raw_css =
            "<style>

                /* @tds_logout */
                body .tds_logout {
                    margin-bottom: 0;                    
                }
                body .tds_logout .tds-block-inner {
                    margin: 0 auto;
                    padding: 55px 45px 60px;
                    max-width: 650px;
                    background-color: #fff;
                    text-align: center;
                }
                

            </style>";

		$td_css_res_compiler = new td_css_res_compiler( $raw_css );
		$td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

		$compiled_css .= $td_css_res_compiler->compile_css();

		return $compiled_css;

	}

	static function cssMedia( $res_ctx ) {

        $res_ctx->load_settings_raw( 'tds_logout', 1 );
	}

	function __construct() {
		parent::disable_loop_block_features();
	}

	function render( $atts, $content = null ) {

        parent::render( $atts );

		$buffy = '';
		if ( is_user_logged_in() ) {

		    ob_start();

            $current_user = '<b>' . wp_get_current_user()->display_name . '</b>';
            $log_out = '<a href="' . wp_logout_url(site_url()) . '">' . __td('Log out', TD_THEME_NAME ) . '</a>' ;
            ?>

            <div class="tds-s-page-sec tds-s-page-dashboard">
                <div class="tds-s-page-sec-header">
                    <h2 class="tds-spsh-title"><?php echo __td('Dashboard', TD_THEME_NAME ) ?></h2>
                    <div class="tds-spsh-descr"><?php echo __td('Welcome to your account!', TD_THEME_NAME ) ?></div>
                </div>

                <div class="tds-s-page-sec-content">
                    <div class="tds-s-notif tds-s-notif-info">
                        <!--%1$s: user name; %2$s: username; %3$s: logout link;-->
                        <div class="tds-s-notif-descr">
                            <?php echo sprintf(
                                __td( 'Hello %1$s (not %2$s? %3$s)! From your account dashboard you can view your subscriptions and manage your account details.' , TD_THEME_NAME ),
                                $current_user,
                                $current_user,
                                $log_out
                            ) ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            // current user information
            $current_user = wp_get_current_user();
            $current_user_id = $current_user->ID;

            // process user's publishing posts remaining
            $publishing_posts_remaining = array();
            $all_user_subscriptions = tds_util::get_user_subscriptions( $current_user_id, null, array( 'active', 'free' ) );

            if( $all_user_subscriptions ) {
                foreach( $all_user_subscriptions as $user_subscription ) {

                    if( isset($user_subscription['plan_posts_remaining']) ) {
                        $plan_posts_remaining = $user_subscription['plan_posts_remaining'] ? unserialize($user_subscription['plan_posts_remaining']) : array();

                        if (!empty($plan_posts_remaining)) {
                            foreach ( $plan_posts_remaining as $remaining_post_type => $remaining_posts ) {
                                if ( array_key_exists($remaining_post_type, $publishing_posts_remaining) ) {
                                    $publishing_posts_remaining[$remaining_post_type] += $remaining_posts;
                                } else {
                                    $publishing_posts_remaining[$remaining_post_type] = $remaining_posts;
                                }
                            }
                        }
                    }
                }
            }

            // test data for $publishing_posts_remaining
            //$publishing_posts_remaining = [
            //    'post' => 33,
            //    'tdcpt_contacts' => 77,
            //    'tdcpt_doctors' => 22,
            //    'test-post-type' => 11
            //];

            if ( !empty($publishing_posts_remaining) ) {

                ?>
                <div class="tds-s-page-sec tds-s-page-posts-remaining">
                    <div class="tds-s-page-sec-header">
                        <h2 class="tds-spsh-title"><?php echo __td('Remaining publishing rights', TD_THEME_NAME ) ?></h2>
                        <div class="tds-spsh-descr"><?php echo __td('The number of articles you have left to publish across different post types.', TD_THEME_NAME ) ?></div>
                    </div>

                    <div class="tds-s-page-sec-content">
                        <div class="tds-s-subscr-remaining-posts">
                            <?php
                            foreach( $publishing_posts_remaining as $post_type => $remaining_posts ) {
                                $post_type_obj = get_post_type_object($post_type);

                                if( $post_type_obj === null ) {
                                    continue;
                                }

                                $post_type_labels = $post_type_obj->labels;
                                ?>
                                <button class="tds-s-btn tds-s-btn-sm tds-s-btn-grey tds-s-subscr-rp-item">
                                    <span class="tds-s-subscr-rp-type"><?php echo $post_type_labels->name ?></span>
                                    <span class="tds-s-subscr-rp-count"><?php echo $remaining_posts ?></span>
                                </button>
                                <?php
                            } ?>
                        </div>
                    </div>
                </div>
                <?php

            }

            // process user's available credits
            $available_credits = tds_util::get_user_available_credits( get_current_user_id() );

            ?>
            <div class="tds-s-page-sec tds-s-page-credits-remaining">
                <div class="tds-s-page-sec-header">
                    <h2 class="tds-spsh-title"><?php echo __td('Available credits', TD_THEME_NAME ) ?></h2>
                    <div class="tds-spsh-descr"><?php echo __td('The number of available credits you have left to unlock articles.', TD_THEME_NAME ) ?></div>
                </div>

                <div class="tds-s-page-sec-content">
                    <div class="tds-s-subscr-remaining-credits">
                        <button class="tds-s-btn tds-s-btn-sm tds-s-btn-grey tds-s-subscr-rp-item">
                            <span class="tds-s-subscr-rp-type"><?php echo __td('Credits', TD_THEME_NAME ) ?></span>
                            <span class="tds-s-subscr-rp-count"><?php echo $available_credits ?></span>
                        </button>
                    </div>
                </div>
            </div>

            <?php

            $custom_page_id = $this->get_att('custom_page_id');
            $custom_page_content = '';

            if( $custom_page_id != '' && get_post_type($custom_page_id) == 'page' ) {
                $page = get_post($custom_page_id);

                if ( null !== $page ) {
                    td_global::set_in_element(true);
                    $custom_page_content = $page->post_content;

                    if (is_plugin_active('td-subscription/td-subscription.php') && has_filter('the_content', array(tds_email_locker::instance(), 'lock_content'))) {
                        $has_content_filter = true;
                        remove_filter('the_content', array(tds_email_locker::instance(), 'lock_content'));
                    }

                    $custom_page_content = preg_replace('/\[tdm_block_popup.*?\]/i', '', $custom_page_content);
                    $custom_page_content = apply_filters('the_content', $custom_page_content);
                    $custom_page_content = str_replace(']]>', ']]&gt;', $custom_page_content);

                    // the has_filter check is made for plugins, like bbpress, who think it's okay to remove all filters on 'the_content'
                    if (!has_filter('the_content', 'do_shortcode')) {
                        $custom_page_content = do_shortcode($custom_page_content);
                    }

                    if (!empty($has_content_filter)) {
                        add_filter('the_content', array(tds_email_locker::instance(), 'lock_content'));
                    }

                    td_global::set_in_element(false);
                }
            }

            if( $custom_page_content != '' ) {
                ?>
                <div class="tds-s-page-sec tds-s-page-dashboard">
                    <div class="tds-s-page-sec-content tds-s-page-sec-content-custom">
                        <?php echo $custom_page_content ?>
                    </div>
                </div>
                <?php
            }
            ?>

            <?php

            $buffy .= ob_get_clean();

		} else {

		    ob_start();

		    wp_login_form();
			?>

			<a href="<?php echo esc_url( add_query_arg( 'lost_password', '', get_permalink() ) ); ?>"><?php echo __td('Lost Password', TD_THEME_NAME ) ?></a>

			<?php
            $buffy .= ob_get_clean();
		}

		return $buffy;
	}
}
