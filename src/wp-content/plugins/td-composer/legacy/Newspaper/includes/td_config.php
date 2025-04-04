<?php
/*
 * This is the config file for the theme.
 */

define("TD_THEME_DEMO_URL", "https://demo.tagdiv.com/" . strtolower(TD_THEME_NAME));
define("TD_THEME_DEMO_DOC_URL", 'https://tagdiv.com/newspaper-theme-installing-demos/');  //the url to the demo documentation
define("TD_PLUGINS_URL", 'https://cloud.tagdiv.com/td_plugins/');  //plugins url
define("TD_FEATURED_CAT", "Featured"); //featured cat name
define("TD_FEATURED_CAT_SLUG", "featured"); //featured cat slug

define("TD_AURORA_VERSION", "__td_aurora_deploy_version__");

define("TD_THEME_WP_BOOSTER", "3.0"); // prevents multiple instances of the framework


/**
 * speed booster v 3.0 hooks - prepare the framework for the theme
 * is also used by td_deploy - that's why it's a static class
 * Class td_wp_booster_hooks
 */
class td_config {


    /**
     * @throws ErrorException
     */
    static function on_td_global_after_config() {

        self::register_styles();



        /**
         * js files list
         */
        td_global::$js_files = array(
	        'tdExternal'                => '/legacy/common/wp_booster/js_dev/tdExternal.js',
            'tdDetect'                  => '/legacy/common/wp_booster/js_dev/tdDetect.js',
	        'tdViewport'                => '/legacy/common/wp_booster/js_dev/tdViewport.js',
            'tdUtil'                    => '/legacy/common/wp_booster/js_dev/tdUtil.js',
            'tdAffix'                   => '/legacy/common/wp_booster/js_dev/tdAffix.js',
            'td_site'                   => '/legacy/common/wp_booster/js_dev/td_site.js',
            'tdBlocks'                  => '/legacy/common/wp_booster/js_dev/tdBlocks.js',
            'td_history'                => '/legacy/common/wp_booster/js_dev/td_history.js',
			'tdHeader'                  => '/legacy/common/wp_booster/js_dev/tdHeader.js',
	        'tdCustomEvents'            => '/legacy/' . TD_THEME_NAME . '/includes/js_files/tdCustomEvents.js',
	        'tdEvents'                  => '/legacy/common/wp_booster/js_dev/tdEvents.js',
            'tdPullDown'                => '/legacy/common/wp_booster/js_dev/tdPullDown.js',
	        'tdShowVideo'               => '/legacy/common/wp_booster/js_dev/tdShowVideo.js',
	        'tdAnimationStack'          => '/legacy/common/wp_booster/js_dev/tdAnimationStack.js',
	        'td_main'                   => '/legacy/' . TD_THEME_NAME . '/includes/js_files/td_main.js',
            'tdLastInit'                => '/legacy/common/wp_booster/js_dev/tdLastInit.js',
	        'td_confirm'                => '/legacy/common/wp_booster/wp-admin/js/tdConfirm.js'
        );

        td_global::$js_files_for_front_minify_only = array(
            'tdAnalytics'               => '/legacy/common/wp_booster/js_dev/tdAnalytics.js',
            'tdMenu'                    => '/legacy/common/wp_booster/js_dev/tdMenu.js',
            'tdLoadingBox'              => '/legacy/common/wp_booster/js_dev/tdLoadingBox.js',
            'tdAjaxSearch'              => '/legacy/common/wp_booster/js_dev/tdAjaxSearch.js',
            'tdPostImages'              => '/legacy/common/wp_booster/js_dev/tdPostImages.js',
            'hammer'                    => '/legacy/common/wp_booster/js_dev/hammer.min.js',
            'jquery_hammer'             => '/legacy/common/wp_booster/js_dev/jquery.hammer.min.js',
            'tdLogin'                   => '/legacy/common/wp_booster/js_dev/tdLogin.js',
            'tdLoginMobile'             => '/legacy/common/wp_booster/js_dev/tdLoginMobile.js',
            'tdTrendingNow'             => '/legacy/common/wp_booster/js_dev/tdTrendingNow.js',
            'tdSmartSidebar'            => '/legacy/common/wp_booster/js_dev/tdSmartSidebar.js',
            'tdStickyRow'               => '/legacy/common/wp_booster/js_dev/tdStickyRow.js',
            'tdScrollToClass'           => '/legacy/common/wp_booster/js_dev/tdScrollToClass.js',
            'tdInfiniteLoader'          => '/legacy/common/wp_booster/js_dev/tdInfiniteLoader.js',
            'vimeo_froogaloop'          => '/legacy/common/wp_booster/js_dev/vimeo_froogaloop.js',
            'tdAjaxCount'               => '/legacy/common/wp_booster/js_dev/tdAjaxCount.js',
            'tdVideoPlaylistYoutube'    => '/legacy/common/wp_booster/js_dev/tdVideoPlaylistYoutube.js',
            'tdVideoPlaylistVimeo'      => '/legacy/common/wp_booster/js_dev/tdVideoPlaylistVimeo.js',
            'td_slide'                  => '/legacy/common/wp_booster/js_dev/td_slide.js',
            'tdAnimationScroll'         => '/legacy/common/wp_booster/js_dev/tdAnimationScroll.js',
            'tdHomepageFull'            => '/legacy/common/wp_booster/js_dev/tdHomepageFull.js',
            'tdBackstr'                 => '/legacy/common/wp_booster/js_dev/tdBackstr.js',
            'td_loop_ajax'              => '/legacy/common/wp_booster/js_dev/tdLoopAjax.js',
            'tdWeather'                 => '/legacy/common/wp_booster/js_dev/tdWeather.js',
            'tdAnimationSprite'         => '/legacy/common/wp_booster/js_dev/tdAnimationSprite.js',
            'tdDatei18n'                => '/legacy/common/wp_booster/js_dev/tdDatei18n.js',
            'tdSocialSharing'           => '/legacy/common/wp_booster/js_dev/tdSocialSharing.js',
            'tdModalPostImages'         => '/legacy/common/wp_booster/js_dev/tdModalPostImages.js',
            'tdAjaxVideoModal'          => '/legacy/common/wp_booster/js_dev/tdAjaxVideoModal.js',
            'tdfAjaxFlickr'             => '/legacy/common/wp_booster/js_dev/tdfAjaxFlickr.js',
            'tdPopupModal'              => '/legacy/common/wp_booster/js_dev/tdPopupModal.js',
            'tdTabbedContent'           => '/legacy/common/wp_booster/js_dev/tdTabbedContent.js',
            'tdListMenu'                => '/legacy/common/wp_booster/js_dev/tdListMenu.js',
	        'tdToTop'                   => '/legacy/common/wp_booster/js_dev/tdToTop.js'
        );


	    /**
	     * tdViewport intervals in crescendo order
	     */
	    td_global::$td_viewport_intervals = array(
		    array(
			    "limitBottom" => 767,
			    "sidebarWidth" => 228,
		    ),
		    array(
			    "limitBottom" => 1018,
			    "sidebarWidth" => 300,
		    ),
		    array(
			    "limitBottom" => 1140,
			    "sidebarWidth" => 324,
		    ),
	    );


	    /**
	     * - td animation stack effects used in the 'loading animation image' theme panel section
	     * - the first element is a special case, it representing the default type 'type0' @see animation-stack.less
	     * - the 'val' parameter is the type effect
	     * - the 'specific_selectors' parameter is the css selector used to look for new elements inside of some specific sections [ex. at ajax req]
	     * - the 'general_selectors' parameter is the css selector used to look for elements on extended sections [ex. entire page]
	     * - Important! the 'general_selectors' is not used by the default 'type0'
	     */
	    td_global::$td_animation_stack_effects = array(
		    array(
			    'text' => 'Fade [full]',
			    'val' => '', // empty, as a default value
			    'specific_selectors' => '.entry-thumb, img, .td-lazy-img',
			    'general_selectors' => '.td-animation-stack img, .td-animation-stack .entry-thumb, .post img, .td-animation-stack .td-lazy-img',
		    ),

            array(
                'text' => 'Fade & Scale',
                'val' => 'type1',
                'specific_selectors' => '.entry-thumb, img[class*="wp-image-"], a.td-sml-link-to-image > img, .td-lazy-img',
                'general_selectors' => '.td-animation-stack .entry-thumb, .post .entry-thumb, .post img[class*="wp-image-"], .post a.td-sml-link-to-image > img, .td-animation-stack .td-lazy-img',
            ),


            array(
                'text' => 'Up fade',
                'val' => 'type2',
                'specific_selectors' => '.entry-thumb, img[class*="wp-image-"], a.td-sml-link-to-image > img, .td-lazy-img',
                'general_selectors' => '.td-animation-stack .entry-thumb, .post .entry-thumb, .post img[class*="wp-image-"], a.td-sml-link-to-image > img, .td-animation-stack .td-lazy-img',
            ),


            array(
                'text' => 'No Animation',
                'val' => 'type3',
                'specific_selectors' => '.entry-thumb, img[class*="wp-image-"], a.td-sml-link-to-image > img, .td-lazy-img',
                'general_selectors' => '.td-animation-stack .entry-thumb, .post .entry-thumb, .post img[class*="wp-image-"], a.td-sml-link-to-image > img, .td-animation-stack .td-lazy-img',
            ),


        );



        /**
         * single template list
         */
        td_api_single_template::add('single_template',
            array(
                'file' => TDC_PATH_LEGACY . '/single.php',
                'text' => 'Single template',
                'img' => TDC_URL_LEGACY . '/assets/images/panel/single_templates/single_template_0.png',
                'show_featured_image_on_all_pages' => false,
                'bg_disable_background' => false,          // disable the featured image
                'bg_box_layout_config' => 'auto',                // auto | td-boxed-layout | td-full-layout
                'bg_use_featured_image_as_background' => false,   // uses the featured image as a background
                'exclude_ad_content_top' => false,
            )
        );



        /**
		 * block templates
		 */
        td_api_block_template::add('td_block_template_1',
            array (
                'text' => 'Block Header 1 - Default',
                'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-1.png',
                'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_1.php',
                'params' => array(
                    // title settings
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => 'Title background color:',
                        "param_name" => "header_color",
                        "value" => '',
                        "description" => 'Optional - Choose a custom background color for this header/loader gif',
                        'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_background_color.png",
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => 'Title text color:',
                        "param_name" => "header_text_color",
                        "value" => '',
                        "description" => 'Optional - Choose a custom title text color for this header',
                        'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => 'Accent hover color:',
                        "param_name" => "accent_text_color",
                        "value" => '',
                        "description" => 'Optional - Choose a custom accent hover color for this block',
                        'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
                    )
                )//end generic array
            )
        );

		td_api_block_template::add('td_block_template_2',
		    array (
		        'text' => 'Block Header 2',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-2.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_2.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_3',
		    array (
		        'text' => 'Block Header 3',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-3.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_3.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title background color:',
		                "param_name" => "header_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom background color for this header/loader gif',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_background_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_4',
		    array (
		        'text' => 'Block Header 4',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-4.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_4.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title background color:',
		                "param_name" => "header_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom background color for this header/loader gif',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_background_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_5',
		    array (
		        'text' => 'Block Header 5',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-5.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_5.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title background color:',
		                "param_name" => "header_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom background color for this header/loader gif',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_background_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_6',
		    array (
		        'text' => 'Block Header 6',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-6.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_6.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "attach_image",
		                "holder" => "div",
		                "class" => "",
		                "heading" => "Header background",
		                "param_name" => "header_image",
		                "value" => '',
		                "description" => "Optional - Choose a custom background image for this header",
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_7',
		    array (
		        'text' => 'Block Header 7',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-7.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_7.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title background color:',
		                "param_name" => "header_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom background color for this header/loader gif',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_background_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            ),
		            array(
		                "type" => "attach_image",
		                "holder" => "div",
		                "class" => "",
		                "heading" => "Header pattern",
		                "param_name" => "header_image",
		                "value" => '',
		                "description" => "Optional - Choose a custom background image for this header",
		                'td_type' => 'block_template',
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_8',
		    array (
		        'text' => 'Block Header 8',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-8.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_8.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Border color:',
		                "param_name" => "border_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom border color for this header',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_9',
		    array (
		        'text' => 'Block Header 9',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-9.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_9.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Border color:',
		                "param_name" => "border_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom border color for this header',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_10',
		    array (
		        'text' => 'Block Header 10',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-10.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_10.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Border color:',
		                "param_name" => "border_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom border color for this header',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_11',
		    array (
		        'text' => 'Block Header 11',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-11.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_11.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Border color:',
		                "param_name" => "border_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom border color for this header',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_12',
		    array (
		        'text' => 'Block Header 12',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-12.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_12.php',
		        'params' => array_merge(
                    array(
		            // title settings
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Title text color:',
                            "param_name" => "header_text_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom title text color for this header',
                            'td_type' => 'block_template',
                            "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Accent hover color:',
                            "param_name" => "accent_text_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom accent hover color for this block',
                            'td_type' => 'block_template',
                            "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "tdc-textfield-big",
                            "heading" => 'Continue button text:',
                            "param_name" => "button_text",
                            "value" => '',
                            "description" => 'To enable the continue button, choose a category from Filter or write a custom Title URL',
                            'td_type' => 'block_template',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Continue button text color:',
                            "param_name" => "button_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom text color for the continue button',
                            'td_type' => 'block_template',
                        )
                    ),
                    td_config_helper::get_map_block_font_array( 'f_cont', false, 'Continue button text' )
		        )
		    )
		);

		td_api_block_template::add('td_block_template_13',
		    array (
		        'text' => 'Block Header 13',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-13.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_13.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            ),
		            array(
		                "type" => "textfield",
		                "holder" => "div",
		                "class" => "tdc-textfield-big",
		                "heading" => 'Big title:',
		                "param_name" => "big_title_text",
		                "value" => '',
		                "description" => 'Optional - Choose a custom big title text for this header',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Big title text color:',
		                "param_name" => "big_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom color for the big title',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "textfield",
		                "holder" => "div",
		                "class" => "tdc-textfield-big",
		                "heading" => 'Continue button text:',
		                "param_name" => "button_text",
		                "value" => '',
		                "description" => 'To enable the continue button, choose a category from Filter or write a custom Title URL',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Continue button color:',
		                "param_name" => "button_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom text color for the continue button',
		                'td_type' => 'block_template',
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_14',
		    array (
		        'text' => 'Block Header 14',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-14.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_14.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title background color:',
		                "param_name" => "header_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom background color for this header/loader gif',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_background_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Border color:',
		                "param_name" => "border_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom border color for this header',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_15',
		    array (
		        'text' => 'Block Header 15',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-15.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_15.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title background color:',
		                "param_name" => "header_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom background color for this header/loader gif',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_background_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Border color:',
		                "param_name" => "border_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom border color for this header',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Top border color:',
		                "param_name" => "top_border_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom top border color for this header',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_16',
		    array (
		        'text' => 'Block Header 16',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-16.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_16.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Border color:',
		                "param_name" => "border_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom border color for this header',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_17',
		    array (
		        'text' => 'Block Header 17',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-17.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_17.php',
		        'params' => array(
		            // title settings
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title text color:',
		                "param_name" => "header_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom title text color for this header',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_text_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title background color:',
		                "param_name" => "header_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom background color for this header/loader gif',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_background_color.png",
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Border top color:',
		                "param_name" => "top_border_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom top border color for this header',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Border bottom color:',
		                "param_name" => "bottom_border_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom bottom border color for this header',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            )
		        )//end generic array
		    )
		);

		td_api_block_template::add('td_block_template_18',
		    array (
		        'text' => 'Block Header 18',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/block_templates/icon-block-header-18.png',
		        'file' => TDC_PATH_LEGACY . '/includes/block_templates/td_block_template_18.php',
		        'params' => array(
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title gradient color A:',
		                "param_name" => "header_text_color_a",
		                "value" => '#06d3d5',
		                "description" => 'Optional - Choose a custom title gradient color for this header',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Title gradient color B:',
		                "param_name" => "header_text_color_b",
		                "value" => '#2a81cb',
		                "description" => 'Optional - Choose a custom title gradient color for this header',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "textfield",
		                "holder" => "div",
		                "class" => "tdc-textfield-big",
		                "heading" => 'Speech bubble text:',
		                "param_name" => "speech_bubble_text",
		                "value" => '',
		                "description" => 'Optional - Custom text for the speech bubble',
		                'td_type' => 'block_template',
		            ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "tdc-textfield-small",
                        "heading" => 'Speech bubble text size:',
                        "param_name" => "speech_bubble_text_size",
                        "value" => '',
                        'placeholder' => '12',
                        "description" => 'Optional - Custom text size for the speech bubble',
                        'td_type' => 'block_template',
                    ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Speech bubble color:',
		                "param_name" => "speech_bubble_color",
		                "value" => '#2a81cb',
		                "description" => 'Optional - Speech bubble background color',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "textfield",
		                "holder" => "div",
		                "class" => "tdc-textfield-extrabig",
		                "heading" => 'Subtitle text:',
		                "param_name" => "subtitle_text",
		                "value" => '',
		                "description" => 'Optional - Choose a custom subtitle text for this header',
		                'td_type' => 'block_template',
		            ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "tdc-textfield-small",
                        "heading" => 'Subtitle text size:',
                        "param_name" => "subtitle_text_size",
                        "value" => '',
                        "placeholder" => '15',
                        "description" => 'Optional - Choose a custom subtitle text size for this header',
                        'td_type' => 'block_template',
                    ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Subtitle text color:',
		                "param_name" => "subtitle_text_color",
		                "value" => '#808080',
		                "description" => 'Optional - Choose a custom color for the subtitle text',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Subtitle border color:',
		                "param_name" => "subtitle_border_color",
		                "value" => '#e3e3e3',
		                "description" => 'Optional - Choose a custom color for the subtitle border',
		                'td_type' => 'block_template',
		            ),
		            array(
		                "type" => "colorpicker",
		                "holder" => "div",
		                "class" => "",
		                "heading" => 'Accent hover color:',
		                "param_name" => "accent_text_color",
		                "value" => '',
		                "description" => 'Optional - Choose a custom accent hover color for this block',
		                'td_type' => 'block_template',
                        "info_img" => "https://cloud.tagdiv.com/help/title_active.png",
		            )
		        ),//end generic array
		        'premium' => true
		    )
		);



        /**
		 * modules list
		 */
        td_api_module::add('td_module_single',
            array(  // this module is for internal use only
                'file' => TDC_PATH_LEGACY . '/includes/modules/td_module_single.php',
                'text' => 'Single Module',
                'img' => '',
                'used_on_blocks' => '',
                'excerpt_title' => '',
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => false,
                'class' => '',
                'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
            )
        );

        td_api_module::add('td_module_slide',
            array(
                'file' => TDC_PATH_LEGACY . '/includes/modules/td_module_slide.php',
                'text' => 'Slider module',
                'img' => '',
                'used_on_blocks' => array('td_block_slide'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td-animation-stack',
                'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
            )
        );


        td_api_module::add('td_module_mega_menu',
            array(
                'file' => TDC_PATH_LEGACY . '/includes/modules/td_module_mega_menu.php',
                'text' => 'Mega menu module',
                'img' => '',
                'used_on_blocks' => array('td_block_mega_menu'),
                'excerpt_title' => '12',
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td-animation-stack',
                'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
            )
        );
		td_api_module::add('td_module_trending_now',
		    array(  // this module is for internal use only
		        'file' => TDC_PATH_LEGACY . '/includes/modules/td_module_trending_now.php',
		        'text' => 'Trending now module',
		        'img' => '',
		        'used_on_blocks' => '',
		        'excerpt_title' => 25,
		        'excerpt_content' => '',
		        'enabled_on_more_articles_box' => false,
		        'enabled_on_loops' => false,
		        'uses_columns' => false,                      // if the module uses columns on the page template + loop
		        'category_label' => false,
		        'class' => '',
		        'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);
        td_api_module::add( 'td_module_flex_1',
            array(
                'file'                         => TDC_PATH_LEGACY . '/includes/modules/td_module_flex_1.php',
                'text'                         => 'Module Flex 1',
                'img'                          => '',
                'used_on_blocks'               => array( 'td_flex_block_1' ),
                'excerpt_title'                => 25,
                'excerpt_content'              => 25,
                'enabled_excerpt_in_panel'     => false,
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops'             => false,
                'uses_columns'                 => false,
                // if the module uses columns on the page template + loop
                'category_label'               => false,
                'class'                        => 'td_module_wrap td-animation-stack',
                'group'                        => ''
                // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
            )
        );
        
		td_api_module::add( 'td_module_flex_2',
		    array(
		        'file'                         => TDC_PATH_LEGACY . '/includes/modules/td_module_flex_2.php',
		        'text'                         => 'Module Flex 2',
		        'img'                          => '',
		        'used_on_blocks'               => array( 'td_flex_block_2' ),
		        'excerpt_title'                => 25,
		        'excerpt_content'              => 25,
                'enabled_excerpt_in_panel'     => false,
		        'enabled_on_more_articles_box' => false,
		        'enabled_on_loops'             => false,
		        'uses_columns'                 => false,
		        // if the module uses columns on the page template + loop
		        'category_label'               => false,
		        'class'                        => 'td_module_wrap td-animation-stack',
		        'group'                        => ''
		        // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);

		td_api_module::add( 'td_module_flex_3',
		    array(
		        'file'                         => TDC_PATH_LEGACY . '/includes/modules/td_module_flex_3.php',
		        'text'                         => 'Module Flex 3',
		        'img'                          => '',
		        'used_on_blocks'               => array( 'td_flex_block_3' ),
		        'excerpt_title'                => 25,
		        'excerpt_content'              => 25,
                'enabled_excerpt_in_panel'     => false,
		        'enabled_on_more_articles_box' => false,
		        'enabled_on_loops'             => false,
		        'uses_columns'                 => false,
		        // if the module uses columns on the page template + loop
		        'category_label'               => false,
		        'class'                        => 'td_module_wrap td-animation-stack',
		        'group'                        => ''
		        // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);

		td_api_module::add( 'td_module_flex_4',
		    array(
		        'file'                         => TDC_PATH_LEGACY . '/includes/modules/td_module_flex_4.php',
		        'text'                         => 'Module Flex 4',
		        'img'                          => '',
		        'used_on_blocks'               => array( 'td_flex_block_4' ),
		        'excerpt_title'                => 25,
		        'excerpt_content'              => 25,
                'enabled_excerpt_in_panel'     => false,
		        'enabled_on_more_articles_box' => false,
		        'enabled_on_loops'             => false,
		        'uses_columns'                 => false,
		        // if the module uses columns on the page template + loop
		        'category_label'               => false,
		        'class'                        => 'td_module_wrap td-animation-stack',
		        'group'                        => ''
		        // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);

		td_api_module::add( 'td_module_flex_5',
		    array(
		        'file'                         => TDC_PATH_LEGACY . '/includes/modules/td_module_flex_5.php',
		        'text'                         => 'Module Flex 5',
		        'img'                          => '',
		        'used_on_blocks'               => array( 'td_module_flex_5' ),
		        'excerpt_title'                => 25,
		        'excerpt_content'              => 25,
                'enabled_excerpt_in_panel'     => false,
		        'enabled_on_more_articles_box' => false,
		        'enabled_on_loops'             => false,
		        'uses_columns'                 => false,
		        // if the module uses columns on the page template + loop
		        'category_label'               => false,
		        'class'                        => 'td_module_wrap td-animation-stack',
		        'group'                        => ''
		        // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);

		td_api_module::add( 'td_module_flex_6',
		    array(
		        'file'                         => TDC_PATH_LEGACY . '/includes/modules/td_module_flex_6.php',
		        'text'                         => 'Module Flex 6',
		        'img'                          => '',
		        'used_on_blocks'               => array( 'td_module_flex_6' ),
		        'excerpt_title'                => 25,
		        'excerpt_content'              => 0,
                'enabled_excerpt_in_panel'     => false,
		        'enabled_on_more_articles_box' => false,
		        'enabled_on_loops'             => false,
		        'uses_columns'                 => false,
		        // if the module uses columns on the page template + loop
		        'category_label'               => false,
		        'class'                        => 'td-animation-stack',
		        'group'                        => ''
		        // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);

		td_api_module::add( 'td_module_flex_7',
		    array(
		        'file'                         => TDC_PATH_LEGACY . '/includes/modules/td_module_flex_7.php',
		        'text'                         => 'Module Flex 7',
		        'img'                          => '',
		        'used_on_blocks'               => array( 'td_module_flex_7' ),
		        'excerpt_title'                => 25,
		        'excerpt_content'              => 0,
                'enabled_excerpt_in_panel'     => false,
		        'enabled_on_more_articles_box' => false,
		        'enabled_on_loops'             => false,
		        'uses_columns'                 => false,
		        // if the module uses columns on the page template + loop
		        'category_label'               => false,
		        'class'                        => 'td-animation-stack',
		        'group'                        => ''
		        // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);

		td_api_module::add( 'td_module_flex_8',
		    array(
		        'file'                         => TDC_PATH_LEGACY . '/includes/modules/td_module_flex_8.php',
		        'text'                         => 'Module Flex 8',
		        'img'                          => '',
		        'used_on_blocks'               => array( 'td_module_flex_8' ),
		        'excerpt_title'                => 25,
		        'excerpt_content'              => 0,
                'enabled_excerpt_in_panel'     => false,
		        'enabled_on_more_articles_box' => false,
		        'enabled_on_loops'             => false,
		        'uses_columns'                 => false,
		        // if the module uses columns on the page template + loop
		        'category_label'               => false,
		        'class'                        => 'td-animation-stack',
		        'group'                        => ''
		        // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);

		td_api_module::add( 'td_module_flex_empty',
		    array(
		        'file'                         => TDC_PATH_LEGACY . '/includes/modules/td_module_flex_empty.php',
		        'text'                         => 'Module Flex Empty',
		        'img'                          => '',
		        'used_on_blocks'               => array( 'td_module_flex_empty' ),
		        'excerpt_title'                => 25,
		        'excerpt_content'              => 0,
                'enabled_excerpt_in_panel'     => false,
		        'enabled_on_more_articles_box' => false,
		        'enabled_on_loops'             => false,
		        'uses_columns'                 => false,
		        // if the module uses columns on the page template + loop
		        'category_label'               => false,
		        'class'                        => 'td-animation-stack',
		        'group'                        => ''
		        // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);
        
        td_api_module::add( 'tds_module_loop_1',
            array(
                'file'                         => TDC_PATH_LEGACY . '/includes/modules/tds_module_loop_1.php',
                'text'                         => 'Flex Module',
                'img'                          => '',
                'used_on_blocks'               => array(),
                'excerpt_title'                => 25,
                'excerpt_content'              => 25,
                'enabled_excerpt_in_panel'     => false,
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops'             => false,
                'uses_columns'                 => false,
                // if the module uses columns on the page template + loop
                'category_label'               => false,
                'class'                        => 'td_module_wrap td-animation-stack',
                'group'                        => ''
                // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
            )
        );

        td_api_module::add( 'tds_module_loop_2',
            array(
                'file'                         => TDC_PATH_LEGACY . '/includes/modules/tds_module_loop_2.php',
                'text'                         => 'Flex Module 2',
                'img'                          => '',
                'used_on_blocks'               => array(),
                'excerpt_title'                => 25,
                'excerpt_content'              => 25,
                'enabled_excerpt_in_panel'     => false,
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops'             => false,
                'uses_columns'                 => false,
                // if the module uses columns on the page template + loop
                'category_label'               => false,
                'class'                        => 'td_module_wrap td-animation-stack',
                'group'                        => ''
                // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
            )
        );

        include_once ('td_config_blocks.php');

        /**
		 * the thumbs used by the  theme
		 * Thumb id => array parameters. Wp booster only cuts if the option is set from theme panel
		 */

        td_api_thumb::add('td_0x420',
            array(
                'name' => 'td_0x420',
                'width' => 0,
                'height' => 420,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal', //what play icon to load (small or normal)
                'used_on' => array(
                    'tagDiv Image Gallery'
                ),
                'no_image_path' => TDC_URL_LEGACY . '/assets',
                'b64_encoded' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAfQAAAGkAQMAAAD9lkU+AAAAA1BMVEWurq51dlI4AAAAAXRSTlMmkutdmwAAADFJREFUeNrtwTEBAAAAwiD7pzbDfmAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAANEBaQAAAZUbkzMAAAAASUVORK5CYII=',
            )
        );

        td_api_thumb::add('td_80x60',
            array(
                'name' => 'td_80x60',
                'width' => 80,
                'height' => 60,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'small',
                'used_on' => array(
                    'Module MX2',
                    'Block 18, 19',
                    'Live search',
                    'tagDiv Image Gallery thumbs'
                ),
                'no_image_path' => TDC_URL_LEGACY . '/assets',
                'b64_encoded' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAAA8AQMAAADL6a/PAAAAA1BMVEWurq51dlI4AAAAAXRSTlMmkutdmwAAAA5JREFUKM9jGAWjYJABAAKUAAHoEAeuAAAAAElFTkSuQmCC',
            )
        );
        td_api_thumb::add('td_150x0',
            array(
                'name' => 'td_150x0',
                'width' => 150,
                'height' => 0,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    'Flex blocks 1, 2, 3, 4, 5'
                ),
                'no_image_path' => TDC_URL_LEGACY . '/assets',
                'b64_encoded' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAAB4AQMAAAAqgZlTAAAAA1BMVEWurq51dlI4AAAAAXRSTlMmkutdmwAAABlJREFUSMftwTEBAAAAwiD7p7bETmAAAKQOCWAAAaG6mx4AAAAASUVORK5CYII=',
            )
        );

		td_api_thumb::add('td_218x150',
		    array(
		        'name' => 'td_218x150',
		        'width' => 218,
		        'height' => 150,
		        'crop' => array('center', 'top'),
		        'post_format_icon_size' => 'normal',
		        'used_on' => array(
		            'Module 10, MX4, MX7, MX13, Mega menu, Related posts',
		            'Block 11, 15, 16, 18',
		            'Big grid 6'
		        ),
		        'no_image_path' => TDC_URL_LEGACY . '/assets',
		        'b64_encoded' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAANoAAACWAQMAAACCSQSPAAAAA1BMVEWurq51dlI4AAAAAXRSTlMmkutdmwAAABpJREFUWMPtwQENAAAAwiD7p7bHBwwAAAAg7RD+AAGXD7BoAAAAAElFTkSuQmCC',
		    )
		);

        td_api_thumb::add('td_300x0',
            array(
                'name' => 'td_300x0',
                'width' => 300,
                'height' => 0,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    'Flex blocks 1, 2, 3, 4, 5'
                ),
                'no_image_path' => TDC_URL_LEGACY . '/assets',
                'b64_encoded' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASwAAADIAQMAAABoEU4WAAAAA1BMVEWurq51dlI4AAAAAXRSTlMmkutdmwAAAB5JREFUWMPtwTEBAAAAwiD7pzbEXmAAAAAAAAAAEBweeAABBpYptwAAAABJRU5ErkJggg==',
            )
        );

		td_api_thumb::add('td_324x400',
		    array(
		        'name' => 'td_324x400',
		        'width' => 324,
		        'height' => 400,
		        'crop' => array('center', 'top'),
		        'post_format_icon_size' => 'normal',
		        'used_on' => array(
		            'Slide - 1 column',
		            'Flex Block 1'
		        ),
		        'no_image_path' => TDC_URL_LEGACY . '/assets',
		        'b64_encoded' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUQAAAGQAQMAAADsi4u8AAAAA1BMVEWurq51dlI4AAAAAXRSTlMmkutdmwAAACdJREFUeNrtwYEAAAAAw6D7U99gBNUAAAAAAAAAAAAAAAAAAAAASAdBoAABzZKptAAAAABJRU5ErkJggg==',
		    )
		);

        td_api_thumb::add('td_485x360',
            array(
                'name' => 'td_485x360',
                'width' => 485,
                'height' => 360,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'small',
                'used_on' => array(
                    'Module MX24, MX25',
                    'Big grid full 7, 8, 9, 10'
                ),
                'no_image_path' => TDC_URL_LEGACY . '/assets',
                'b64_encoded' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAeUAAAFoAQMAAABT0HEnAAAAA1BMVEWurq51dlI4AAAAAXRSTlMmkutdmwAAACxJREFUeNrtwTEBAAAAwiD7p7bGDmAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQcFcwAAFIn2pxAAAAAElFTkSuQmCC',
            )
        );

        td_api_thumb::add('td_696x0',
            array(
                'name' => 'td_696x0',
                'width' => 696,
                'height' => 0,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    'Default post template,
                     Post template 2, 11',
                    'Module 12, 13, 15, MX20, MX22, MX23',
                    'Big grid full 3, 6, 7',
                    'Smart list style 1, 2, 5, 6, 7, 8',
                    'Flex Block 1'
                ),
                'no_image_path' => TDC_URL_LEGACY . '/assets',
                'b64_encoded' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAArgAAAG0AQMAAADjJMaKAAAAA1BMVEWurq51dlI4AAAAAXRSTlMmkutdmwAAADxJREFUeNrtwQENAAAAwiD7pzbHN2AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAUQeV4AAB10TPnAAAAABJRU5ErkJggg==',
            )
        );

		td_api_thumb::add('td_1068x0',
		    array(
		        'name' => 'td_1068x0',
		        'width' => 1068,
		        'height' => 0,
		        'crop' => array('center', 'top'),
		        'post_format_icon_size' => 'normal',
		        'used_on' => array(
		            'Post template 3, 4, 9, 10',
		            'Smart list style 1, 2, 5, 6, 7, 8',
		            'Module MX19',
		            'Big grid full 2, 8, 9, 10',
		            'Flex Block 1'
		        ),
		        'no_image_path' => TDC_URL_LEGACY . '/assets',
		        'b64_encoded' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABCwAAAJEAQMAAADnqyfeAAAAA1BMVEWurq51dlI4AAAAAXRSTlMmkutdmwAAAG9JREFUeNrswYEAAAAAgKD9qRepAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADg9uCQAAAAAEDQ/9fOsAAAAAAAAAAAAAAAAAAAAAAAsAox6wABwRHV3QAAAABJRU5ErkJggg==',
		    )
		);

		td_api_thumb::add('td_1920x0',
		    array(
		        'name' => 'td_1920x0',
		        'width' => 1920,
		        'height' => 0,
		        'crop' => array('center', 'top'),
		        'post_format_icon_size' => 'normal',
		        'used_on' => array(
		            'Module MX18',
		            'Big grid full 1, 6',
		            'Flex Block 1'
		        ),
		        'no_image_path' => TDC_URL_LEGACY . '/assets',
		        'b64_encoded' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAB4AAAAIwAQMAAABdnuRXAAAAA1BMVEWurq51dlI4AAAAAXRSTlMmkutdmwAAALJJREFUeNrswYEAAAAAgKD9qRepAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABg9uBAAAAAAADI/7URVFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVWlPTgQAAAAABDkbz3BBhUAAAAAAAAAAAAAAAArD04AAVCiTaUAAAAASUVORK5CYII=',
		    )
		);


        /**
         * social sharing styles
         */
        td_api_social_sharing_styles::add('style1', array (
            'wrap_classes' => 'td-ps-bg td-ps-notext',
            'text' => 'Style 1',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-1.png'
        ));
        td_api_social_sharing_styles::add('style2', array (
            'wrap_classes' => 'td-ps-bg td-ps-padding',
            'text' => 'Style 2',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-2.png'
        ));
        td_api_social_sharing_styles::add('style3', array (
            'wrap_classes' => 'td-ps-bg td-ps-notext td-ps-rounded',
            'text' => 'Style 3',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-3.png'
        ));
        td_api_social_sharing_styles::add('style4', array (
            'wrap_classes' => 'td-ps-bg td-ps-padding td-ps-rounded',
            'text' => 'Style 4',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-4.png'
        ));
        td_api_social_sharing_styles::add('style5', array (
            'wrap_classes' => 'td-ps-bg td-ps-notext td-ps-bar',
            'text' => 'Style 5',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-5.png'
        ));
        td_api_social_sharing_styles::add('style6', array (
            'wrap_classes' => 'td-ps-bg td-ps-padding td-ps-bar',
            'text' => 'Style 6',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-6.png'
        ));
        td_api_social_sharing_styles::add('style7', array (
            'wrap_classes' => 'td-ps-bg td-ps-padding',
            'text' => 'Style 7',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-7.png'
        ));
        td_api_social_sharing_styles::add('style8', array (
            'wrap_classes' => 'td-ps-bg td-ps-notext td-ps-big',
            'text' => 'Style 8',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-8.png'
        ));
        td_api_social_sharing_styles::add('style9', array (
            'wrap_classes' => 'td-ps-bg td-ps-padding td-ps-big',
            'text' => 'Style 9',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-9.png'
        ));
        td_api_social_sharing_styles::add('style10', array (
            'wrap_classes' => 'td-ps-bg td-ps-notext td-ps-big td-ps-bar',
            'text' => 'Style 10',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-10.png'
        ));
        td_api_social_sharing_styles::add('style11', array (
            'wrap_classes' => 'td-ps-bg td-ps-padding td-ps-big td-ps-bar',
            'text' => 'Style 11',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-11.png'
        ));
        td_api_social_sharing_styles::add('style12', array (
            'wrap_classes' => 'td-ps-bg td-ps-notext td-ps-big td-ps-nogap',
            'text' => 'Style 12',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-12.png'
        ));
        td_api_social_sharing_styles::add('style13', array (
            'wrap_classes' => 'td-ps-bg td-ps-padding td-ps-big td-ps-nogap',
            'text' => 'Style 13',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-13.png'
        ));
        td_api_social_sharing_styles::add('style14', array (
            'wrap_classes' => 'td-ps-dark-bg td-ps-notext',
            'text' => 'Style 14',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-14.png'
        ));
        td_api_social_sharing_styles::add('style15', array (
            'wrap_classes' => 'td-ps-dark-bg td-ps-padding',
            'text' => 'Style 15',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-15.png'
        ));
        td_api_social_sharing_styles::add('style16', array (
            'wrap_classes' => 'td-ps-border td-ps-border-grey td-ps-notext td-ps-icon-color td-ps-text-color',
            'text' => 'Style 16',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-16.png'
        ));
        td_api_social_sharing_styles::add('style17', array (
            'wrap_classes' => 'td-ps-border td-ps-border-grey td-ps-padding td-ps-icon-color td-ps-text-color',
            'text' => 'Style 17',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-17.png'
        ));
        td_api_social_sharing_styles::add('style18', array (
            'wrap_classes' => 'td-ps-border td-ps-border-grey td-ps-rounded td-ps-padding td-ps-icon-color',
            'text' => 'Style 18',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-18.png'
        ));
        td_api_social_sharing_styles::add('style19', array (
            'wrap_classes' => 'td-ps-border td-ps-border-grey td-ps-icon-arrow td-ps-icon-bg td-ps-text-color',
            'text' => 'Style 19',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-19.png'
        ));
        td_api_social_sharing_styles::add('style20', array (
            'wrap_classes' => 'td-ps-border td-ps-border-colored td-ps-icon-bg td-ps-text-color',
            'text' => 'Style 20',
            'img' => TDC_URL_LEGACY . '/assets/images/panel/post_sharing_styles/icon-post-sharing-20.png'
        ));


	    /**
         * the tiny mce styles
         */

	    // paddings
        td_api_tinymce_formats::add('td_tinymce_item_1',
            array(
                'title' => 'Text padding'
            ));
            td_api_tinymce_formats::add('td_tinymce_item_1_1',
                array(
                    'parent_id' => 'td_tinymce_item_1',
                    'title' => 'text ⇠',
                    'block' => 'div',
                    'classes' => 'td-paragraph-padding-0',
                    'wrapper' => true,
                ));
            td_api_tinymce_formats::add('td_tinymce_item_1_2',
                array(
                    'parent_id' => 'td_tinymce_item_1',
                    'title' => '⇢ text',
                    'block' => 'div',
                    'classes' => 'td-paragraph-padding-4',
                    'wrapper' => true,
                ));
            td_api_tinymce_formats::add('td_tinymce_item_1_3',
                array(
                    'parent_id' => 'td_tinymce_item_1',
                    'title' => '⇢ text ⇠',
                    'block' => 'div',
                    'classes' => 'td-paragraph-padding-1',
                    'wrapper' => true,
                ));
            td_api_tinymce_formats::add('td_tinymce_item_1_4',
                array(
                    'parent_id' => 'td_tinymce_item_1',
                    'title' => '⇢ text ⇠⇠',
                    'block' => 'div',
                    'classes' => 'td-paragraph-padding-3',
                    'wrapper' => true,
                ));
            td_api_tinymce_formats::add('td_tinymce_item_1_5',
                array(
                    'parent_id' => 'td_tinymce_item_1',
                    'title' => '⇢⇢ text ⇠',
                    'block' => 'div',
                    'classes' => 'td-paragraph-padding-6',
                    'wrapper' => true,
                ));
            td_api_tinymce_formats::add('td_tinymce_item_1_6',
                array(
                    'parent_id' => 'td_tinymce_item_1',
                    'title' => '⇢⇢ text ⇠⇠',
                    'block' => 'div',
                    'classes' => 'td-paragraph-padding-2',
                    'wrapper' => true,
                ));
            td_api_tinymce_formats::add('td_tinymce_item_1_7',
                array(
                    'parent_id' => 'td_tinymce_item_1',
                    'title' => '⇢⇢⇢ text ⇠⇠⇠',
                    'block' => 'div',
                    'classes' => 'td-paragraph-padding-5',
                    'wrapper' => true,
                ));

        // arrow list
        td_api_tinymce_formats::add('td_tinymce_item_3',
            array(
                'title' => 'Arrow list',
                'selector' => 'ul',
                'classes' => 'td-arrow-list'
            ));

        // blockquote
        td_api_tinymce_formats::add('td_blockquote',
            array(
                'title' => 'Quotes'
        ));
	        td_api_tinymce_formats::add('td_blockquote_1',
	            array(
	                'parent_id' => 'td_blockquote',
	                'title' => 'Quote left',
	                'block' => 'blockquote',
	                'classes' => 'td_quote td_quote_left',
	                'wrapper' => true,
	            ));
	        td_api_tinymce_formats::add('td_blockquote_2',
	            array(
	                'parent_id' => 'td_blockquote',
	                'title' => 'Quote right',
	                'block' => 'blockquote',
	                'classes' => 'td_quote td_quote_right',
	                'wrapper' => true,
	            ));
	        td_api_tinymce_formats::add('td_blockquote_3',
	            array(
	                'parent_id' => 'td_blockquote',
	                'title' => 'Quote box center',
	                'block' => 'blockquote',
	                'classes' => 'td_quote_box td_box_center',
	                'wrapper' => true,
	            ));
	        td_api_tinymce_formats::add('td_blockquote_4',
	            array(
	                'parent_id' => 'td_blockquote',
	                'title' => 'Quote box left',
	                'block' => 'blockquote',
	                'classes' => 'td_quote_box td_box_left',
	                'wrapper' => true,
	            ));
	        td_api_tinymce_formats::add('td_blockquote_5',
	            array(
	                'parent_id' => 'td_blockquote',
	                'title' => 'Quote box right',
	                'block' => 'blockquote',
	                'classes' => 'td_quote_box td_box_right',
	                'wrapper' => true,
	            ));
	        td_api_tinymce_formats::add('td_blockquote_6',
	            array(
	                'parent_id' => 'td_blockquote',
	                'title' => 'Pull quote center',
	                'block' => 'blockquote',
	                'classes' => 'td_pull_quote td_pull_center',
	                'wrapper' => true,
	            ));
	        td_api_tinymce_formats::add('td_blockquote_7',
	            array(
	                'parent_id' => 'td_blockquote',
	                'title' => 'Pull quote left',
	                'block' => 'blockquote',
	                'classes' => 'td_pull_quote td_pull_left',
	                'wrapper' => true,
	            ));
	        td_api_tinymce_formats::add('td_blockquote_8',
            array(
                'parent_id' => 'td_blockquote',
                'title' => 'Pull quote right',
                'block' => 'blockquote',
                'classes' => 'td_pull_quote td_pull_right',
                'wrapper' => true,
            ));

        // two columns text
        td_api_tinymce_formats::add('td_text_columns',
            array(
                'title' => 'Text columns'
            ));
            td_api_tinymce_formats::add('td_text_columns_0',
                array(
                    'parent_id' => 'td_text_columns',
                    'title' => 'two columns',
                    'block' => 'div',
                    'classes' => 'td_text_columns_two_cols',
                    'wrapper' => true,
                ));

        // dropcap
        td_api_tinymce_formats::add('td_dropcap',
            array(
                'title' => 'Dropcaps'
            ));
            td_api_tinymce_formats::add('td_dropcap_0',
                array(
                    'parent_id' => 'td_dropcap',
                    'title' => 'Box',
                    'classes' => 'dropcap',
                    'inline' => 'span'
                ));
            td_api_tinymce_formats::add('td_dropcap_1',
                array(
                    'parent_id' => 'td_dropcap',
                    'title' => 'Circle',
                    'classes' => 'dropcap dropcap1',
                    'inline' => 'span'
                ));
            td_api_tinymce_formats::add('td_dropcap_2',
                array(
                    'parent_id' => 'td_dropcap',
                    'title' => 'Regular',
                    'classes' => 'dropcap dropcap2',
                    'inline' => 'span'
                ));
            td_api_tinymce_formats::add('td_dropcap_3',
                array(
                    'parent_id' => 'td_dropcap',
                    'title' => 'Bold',
                    'classes' => 'dropcap dropcap3',
                    'inline' => 'span'
                ));

        // Custom buttons in post Formats
        td_api_tinymce_formats::add('td_btn',
            array(
                'title' => 'Button'
            ));
	        //Default button
	        td_api_tinymce_formats::add('td_default_btn',
	            array(
	                'parent_id' => 'td_btn',
	                'title' => 'Default',
	                'classes' => ' td_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_default_btn_sm',
	            array(
	                'parent_id' => 'td_default_btn',
	                'title' => 'Default - Small',
	                'classes' => 'td_btn  td_btn_sm td_default_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_default_btn_md',
	            array(
	                'parent_id' => 'td_default_btn',
	                'title' => 'Default - Normal',
	                'classes' => 'td_btn td_btn_md td_default_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_default_btn_lg',
	            array(
	                'parent_id' => 'td_default_btn',
	                'title' => 'Default - Large',
	                'classes' => 'td_btn td_btn_lg td_default_btn',
	                'inline' => 'span'
	            ));
	        //Round button
	        td_api_tinymce_formats::add('td_round_btn',
	            array(
	                'parent_id' => 'td_btn',
	                'title' => 'Round',
	                'classes' => 'td_round_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_round_btn_sm',
	            array(
	                'parent_id' => 'td_round_btn',
	                'title' => 'Round - Small',
	                'classes' => 'td_btn td_btn_sm td_round_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_round_btn_md',
	            array(
	                'parent_id' => 'td_round_btn',
	                'title' => 'Round - Normal',
	                'classes' => 'td_btn td_btn_md td_round_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_round_btn_lg',
	            array(
	                'parent_id' => 'td_round_btn',
	                'title' => 'Round - Large',
	                'classes' => 'td_btn td_btn_lg td_round_btn',
	                'inline' => 'span'
	            ));
	        //Outlined button
	        td_api_tinymce_formats::add('td_outlined_btn',
	            array(
	                'parent_id' => 'td_btn',
	                'title' => 'Outlined',
	                'classes' => 'td_outlined_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_outlined_btn_sm',
	            array(
	                'parent_id' => 'td_outlined_btn',
	                'title' => 'Outlined - Small',
	                'classes' => 'td_btn td_btn_sm td_outlined_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_outlined_btn_md',
	            array(
	                'parent_id' => 'td_outlined_btn',
	                'title' => 'Outlined - Normal',
	                'classes' => 'td_btn td_btn_md td_outlined_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_outlined_btn_lg',
	            array(
	                'parent_id' => 'td_outlined_btn',
	                'title' => 'Outlined - Large',
	                'classes' => 'td_btn td_btn_lg td_outlined_btn',
	                'inline' => 'span'
	            ));
	        //Shadow button
	        td_api_tinymce_formats::add('td_shadow_btn',
	            array(
	                'parent_id' => 'td_btn',
	                'title' => 'Shadow',
	                'classes' => 'td_shadow_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_shadow_btn_sm',
	            array(
	                'parent_id' => 'td_shadow_btn',
	                'title' => 'Shadow - Small',
	                'classes' => 'td_btn td_btn_sm td_shadow_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_shadow_btn_md',
	            array(
	                'parent_id' => 'td_shadow_btn',
	                'title' => 'Shadow - Normal',
	                'classes' => 'td_btn td_btn_md td_shadow_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_shadow_btn_lg',
	            array(
	                'parent_id' => 'td_shadow_btn',
	                'title' => 'Shadow - Large',
	                'classes' => 'td_btn td_btn_lg td_shadow_btn',
	                'inline' => 'span'
	            ));
	        //3D button
	        td_api_tinymce_formats::add('td_3D_btn',
	            array(
	                'parent_id' => 'td_btn',
	                'title' => '3D',
	                'classes' => 'td_3D_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_3D_btn_sm',
	            array(
	                'parent_id' => 'td_3D_btn',
	                'title' => '3D - Small',
	                'classes' => 'td_btn td_btn_sm td_3D_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_3D_btn_md',
	            array(
	                'parent_id' => 'td_3D_btn',
	                'title' => '3D - Normal',
	                'classes' => 'td_btn td_btn_md td_3D_btn',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_3D_btn_lg',
            array(
                'parent_id' => 'td_3D_btn',
                'title' => '3D - Large',
                'classes' => 'td_btn td_btn_lg td_3D_btn',
                'inline' => 'span'
            ));

        // highlighter
        td_api_tinymce_formats::add('td_text_highlight',
            array(
                'title' => 'Text highlighting'
            ));
            td_api_tinymce_formats::add('td_text_highlight_0',
                array(
                    'parent_id' => 'td_text_highlight',
                    'title' => 'Black censured',
                    'classes' => 'td_text_highlight_0',
                    'inline' => 'span'
                ));
            td_api_tinymce_formats::add('td_text_highlight_red',
                array(
                    'parent_id' => 'td_text_highlight',
                    'title' => 'Red marker',
                    'classes' => 'td_text_highlight_marker_red td_text_highlight_marker',
                    'inline' => 'span'
                ));
            td_api_tinymce_formats::add('td_text_highlight_blue',
                array(
                    'parent_id' => 'td_text_highlight',
                    'title' => 'Blue marker',
                    'classes' => 'td_text_highlight_marker_blue td_text_highlight_marker',
                    'inline' => 'span'
                ));
	        td_api_tinymce_formats::add('td_text_highlight_green',
	            array(
	                'parent_id' => 'td_text_highlight',
	                'title' => 'Green marker',
	                'classes' => 'td_text_highlight_marker_green td_text_highlight_marker',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_text_highlight_yellow',
	            array(
	                'parent_id' => 'td_text_highlight',
	                'title' => 'Yellow marker',
	                'classes' => 'td_text_highlight_marker_yellow td_text_highlight_marker',
	                'inline' => 'span'
	            ));
	        td_api_tinymce_formats::add('td_text_highlight_pink',
            array(
                'parent_id' => 'td_text_highlight',
                'title' => 'Pink marker',
                'classes' => 'td_text_highlight_marker_pink td_text_highlight_marker',
                'inline' => 'span'
            ));

        // clear elements
        td_api_tinymce_formats::add('td_clear_elements',
            array(
                'title' => 'Clear element',
                'selector' => 'a,p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img,code,blockquote',
                'styles' => array(
                    'clear' => 'both'
                )
            ));

$ad_desc = 'Paste your ad code here. Google AdSense will be made responsive automatically. <br><br> To add non AdSense responsive ads, <br> <a target="_blank" href="http://forum.tagdiv.com/using-other-ads/">click here</a> (last paragraph)';
    if ('enabled' === td_util::get_option('tds_white_label')) {
        $ad_desc = 'Paste your ad code here. Google AdSense will be made responsive automatically.';
    }
        /**
         * ad areas
         */
        td_api_ad::add('header',
            array(
                'text' => 'Header ad',
                'ad_type' => 'ajax',
                'fields' => array(
                    'ad_field_code' => array(
                        'title' => 'YOUR HEADER AD',
                        'desc' => $ad_desc
                    ),
                    'ad_field_phone' => array(
                        'desc' => '',
                    ),
                    'ad_field_position_content' => false,
                    'ad_field_after_paragraph' => false,0
                )
            )
        );
        td_api_ad::add('sidebar',
            array(
                'text' => 'Sidebar ad',
                'ad_type' => 'ajax',
                'fields' => array(
                    'ad_field_notice' => 'To show the ads on the sidebar, please drag the "Ad box" widget to the desired sidebar.',
                    'ad_field_code' => array(
                        'title' => 'YOUR SIDEBAR AD',
                        'desc' => $ad_desc
                    ),
                    'ad_field_title' => false,
                    'ad_field_position_content' => false,
                    'ad_field_after_paragraph' => false,
                )
            )
        );
        td_api_ad::add('content_top',
            array(
                'text' => 'Article top ad',
                'ad_type' => 'ajax',
                'fields' => array(
                    'ad_field_code' => array(
                        'title' => 'YOUR ARTICLE TOP AD',
                        'desc' => $ad_desc
                    ),
                    'ad_field_position_content' => false,
                    'ad_field_after_paragraph' => false,
                )
            )
        );
        td_api_ad::add('content_inline',
            array(
                'text' => 'Article inline ad',
                'ad_type' => 'ajax',
                'fields' => array(
                    'ad_field_code' => array(
                        'title' => 'YOUR ARTICLE INLINE AD',
                        'desc' => $ad_desc
                    ),
                )
            )
        );
        td_api_ad::add('content_bottom',
            array(
                'text' => 'Article bottom ad',
                'ad_type' => 'ajax',
                'fields' => array(
                    'ad_field_code' => array(
                        'title' => 'YOUR ARTICLE BOTTOM AD',
                        'desc' => $ad_desc
                    ),
                    'ad_field_position_content' => false,
                    'ad_field_after_paragraph' => false,
                )
            )
        );
        td_api_ad::add('custom_ad_1',
            array(
                'text' => 'Custom ad 1',
                'ad_type' => 'ajax',
                'fields' => array(
                    'ad_field_title' => false,
                    'ad_field_position_content' => false,
                    'ad_field_after_paragraph' => false,
                ),
            )
        );
        td_api_ad::add('custom_ad_2',
            array(
                'text' => 'Custom ad 2',
                'ad_type' => 'ajax',
                'fields' => array(
                    'ad_field_title' => false,
                    'ad_field_position_content' => false,
                    'ad_field_after_paragraph' => false,
                ),
            )
        );
        td_api_ad::add('custom_ad_3',
            array(
                'text' => 'Custom ad 3',
                'ad_type' => 'ajax',
                'fields' => array(
                    'ad_field_title' => false,
                    'ad_field_position_content' => false,
                    'ad_field_after_paragraph' => false,
                ),
            )
        );
        td_api_ad::add('custom_ad_4',
            array(
                'text' => 'Custom ad 4',
                'ad_type' => 'ajax',
                'fields' => array(
                    'ad_field_title' => false,
                    'ad_field_position_content' => false,
                    'ad_field_after_paragraph' => false,
                ),
            )
        );
        td_api_ad::add('custom_ad_5',
            array(
                'text' => 'Custom ad 5',
                'ad_type' => 'ajax',
                'fields' => array(
                    'ad_field_title' => false,
                    'ad_field_position_content' => false,
                    'ad_field_after_paragraph' => false,
                ),
            )
        );


		/**
		 * smart lists
		 */
		td_api_smart_list::add('td_smart_list_1',
		    array(
		        'file' => TDC_PATH_LEGACY . '/includes/smart_lists/td_smart_list_1.php',
		        'text' => 'Smart list 1',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/smart_lists/td_smart_list_1.png',
		        'extract_first_image' => true,
		        'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);
		td_api_smart_list::add('td_smart_list_2',
		    array(
		        'file' => TDC_PATH_LEGACY . '/includes/smart_lists/td_smart_list_2.php',
		        'text' => 'Smart list 2',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/smart_lists/td_smart_list_2.png',
		        'extract_first_image' => true,
		        'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);
		td_api_smart_list::add('td_smart_list_3',
		    array(
		        'file' => TDC_PATH_LEGACY . '/includes/smart_lists/td_smart_list_3.php',
		        'text' => 'Smart list 3',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/smart_lists/td_smart_list_3.png',
		        'extract_first_image' => true,
		        'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);
		td_api_smart_list::add('td_smart_list_4',
		    array(
		        'file' => TDC_PATH_LEGACY . '/includes/smart_lists/td_smart_list_4.php',
		        'text' => 'Smart list 4',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/smart_lists/td_smart_list_4.png',
		        'extract_first_image' => true,
		        'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);
		td_api_smart_list::add('td_smart_list_5',
		    array(
		        'file' => TDC_PATH_LEGACY . '/includes/smart_lists/td_smart_list_5.php',
		        'text' => 'Smart list 5',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/smart_lists/td_smart_list_5.png',
		        'extract_first_image' => true,
		        'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);
		td_api_smart_list::add('td_smart_list_6',
		    array(
		        'file' => TDC_PATH_LEGACY . '/includes/smart_lists/td_smart_list_6.php',
		        'text' => 'Smart list 6',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/smart_lists/td_smart_list_6.png',
		        'extract_first_image' => true,
		        'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);
		td_api_smart_list::add('td_smart_list_7',
		    array(
		        'file' => TDC_PATH_LEGACY . '/includes/smart_lists/td_smart_list_7.php',
		        'text' => 'Smart list 7',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/smart_lists/td_smart_list_7.png',
		        'extract_first_image' => true,
		        'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);
		td_api_smart_list::add('td_smart_list_8',
		    array(
		        'file' => TDC_PATH_LEGACY . '/includes/smart_lists/td_smart_list_8.php',
		        'text' => 'Smart list 8',
		        'img' => TDC_URL_LEGACY . '/assets/images/panel/smart_lists/td_smart_list_8.png',
		        'extract_first_image' => false,
		        'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
		    )
		);


        /**
         * The typography settings for the panel and css compiler
         */
        td_global::$typography_settings_list = array (
            'dgf_Default Google Fonts' => array(
                'custom_def_googl_f_1' =>  array(
                    'text' => 'Open Sans replacement',
                    'type' => 'general_setting',
                ),
                'custom_def_googl_f_2' => array(
                    'text' => 'Roboto replacement',
                    'type' => 'general_setting',
                ),
            ),
            'General' => array (
                'body_text' =>  array(
                    'text' => 'Body - General font',
                    'type' => 'default',
                ),
                'login_general' => array(
                    'text' => 'Sign in/Join modal',
                    'type' => 'general_setting',
                ),
            ),
            'Header' => array (
                'show_only_on_tdsp' => true,
                'top_menu' => array(
                    'text' => 'Top Menu',
                    'type' => 'default',
                ),
                'top_sub_menu' => array(
                    'text' => 'Top Sub-Menu',
                    'type' => 'default',
                ),
                'main_menu' => array(
                    'text' => 'Main Menu',
                    'type' => 'default',
                ),
                'main_sub_menu' => array(
                    'text' => 'Main Sub-Menu',
                    'type' => 'default',
                ),
                'mega_menu' => array(
                    'text' => 'Mega Menu',
                    'type' => 'default',
                    'show_only_on_tdsp' => true,
                ),
                'mega_menu_categ' => array(
                    'text' => 'Mega Menu Sub-Categories',
                    'type' => 'default',
                ),
                'text_logo' => array(
                    'text' => 'Text Logo',
                    'type' => 'default',
                ),
                'text_logo_tagline' => array(
                    'text' => 'Tagline Text',
                    'type' => 'default',
                ),
            ),
            'Modules and Blocks General' => array (
                'show_only_on_tdsp' => true,
                'blocks_title' => array(
                    'text' => 'Blocks/Widgets Title',
                    'type' => 'default',
                ),
                'blocks_author' => array(
                    'text' => 'Author',
                    'type' => 'default',
                ),
                'blocks_date' => array(
                    'text' => 'Date',
                    'type' => 'default',
                ),
                'blocks_comment' =>  array(
                    'text' => 'Comment',
                    'type' => 'default',
                ),
                'blocks_category' =>  array(
                    'text' => 'Category tag',
                    'type' => 'default',
                ),
                'blocks_filter' =>  array(
                    'text' => 'Filter dropdown',
                    'type' => 'default',
                    'show_only_on_tdsp' => true,
                ),
                'blocks_excerpt' =>  array(
                    'text' => 'Excerpt',
                    'type' => 'default',
                    'show_only_on_tdsp' => true,
                ),
            ),
            'Modules and Blocks - Article Title' => array (
                'show_only_on_tdsp' => true,
                'modules_general' => array(
                    'text' => 'General font',
                    'type' => 'general_setting',
                ),
                'module_1' =>  array(
                    'text' => 'Module 1',
                    'type' => 'default',
                ),
                'module_2' =>  array(
                    'text' => 'Module 2',
                    'type' => 'default',
                ),
                'module_3' =>  array(
                    'text' => 'Module 3',
                    'type' => 'default',
                ),
                'module_4' =>  array(
                    'text' => 'Module 4',
                    'type' => 'default',
                ),
                'module_5' =>  array(
                    'text' => 'Module 5',
                    'type' => 'default',
                ),
                'module_6' =>  array(
                    'text' => 'Module 6',
                    'type' => 'default',
                ),
                'module_7' =>  array(
                    'text' => 'Module 7',
                    'type' => 'default',
                ),
                'module_8' =>  array(
                    'text' => 'Module 8',
                    'type' => 'default',
                ),
                'module_9' =>  array(
                    'text' => 'Module 9',
                    'type' => 'default',
                ),
                'module_10' =>  array(
                    'text' => 'Module 10',
                    'type' => 'default',
                ),
                'module_11' =>  array(
                    'text' => 'Module 11',
                    'type' => 'default',
                ),
                'module_12' =>  array(
                    'text' => 'Module 12',
                    'type' => 'default',
                ),
                'module_13' =>  array(
                    'text' => 'Module 13',
                    'type' => 'default',
                ),
                'module_14' =>  array(
                    'text' => 'Module 14',
                    'type' => 'default',
                ),
                'module_15' =>  array(
                    'text' => 'Module 15',
                    'type' => 'default',
                ),
                'module_16' =>  array(
                    'text' => 'Module 16',
                    'type' => 'default',
                ),
                'module_17' =>  array(
                    'text' => 'Module 17',
                    'type' => 'default',
                ),
                'module_18' =>  array(
                    'text' => 'Module 18',
                    'type' => 'default',
                ),
                'module_19' =>  array(
                    'text' => 'Module 19',
                    'type' => 'default',
                ),
            ),
            'Modules MX and Other Blocks - Article Title' => array (
                'show_only_on_tdsp' => true,
                'other_modules_general' => array(
                    'text' => 'General font',
                    'type' => 'general_setting',
                ),
                'module_mx1' =>  array(
                    'text' => 'Module MX1',
                    'type' => 'default',
                ),
                'module_mx2' =>  array(
                    'text' => 'Module MX2',
                    'type' => 'default',
                ),
                'module_mx3' =>  array(
                    'text' => 'Module MX3',
                    'type' => 'default',
                ),
                'module_mx4' =>  array(
                    'text' => 'Module MX4',
                    'type' => 'default',
                ),
                'module_mx5' =>  array(
                    'text' => 'Module MX5',
                    'type' => 'default',
                ),
                'module_mx6' =>  array(
                    'text' => 'Module MX6',
                    'type' => 'default',
                ),
                'module_mx7' =>  array(
                    'text' => 'Module MX7',
                    'type' => 'default',
                ),
                'module_mx8' =>  array(
                    'text' => 'Module MX8',
                    'type' => 'default',
                ),
                'module_mx9' =>  array(
                    'text' => 'Module MX9',
                    'type' => 'default',
                ),
                'module_mx10' =>  array(
                    'text' => 'Module MX10',
                    'type' => 'default',
                ),
                'module_mx11' =>  array(
                    'text' => 'Module MX11',
                    'type' => 'default',
                ),
                'module_mx12' =>  array(
                    'text' => 'Module MX12',
                    'type' => 'default',
                ),
                'module_mx13' =>  array(
                    'text' => 'Module MX13',
                    'type' => 'default',
                ),
                'module_mx14' =>  array(
                    'text' => 'Module MX14',
                    'type' => 'default',
                ),
                'module_mx15' =>  array(
                    'text' => 'Module MX15',
                    'type' => 'default',
                ),
                'module_mx16' =>  array(
                    'text' => 'Module MX16',
                    'type' => 'default',
                ),
                'module_mx17' =>  array(
                    'text' => 'Module MX17',
                    'type' => 'default',
                ),
                'module_mx18' =>  array(
                    'text' => 'Module MX18',
                    'type' => 'default',
                ),
                'module_mx19' =>  array(
                    'text' => 'Module MX19',
                    'type' => 'default',
                ),
                'module_mx20' =>  array(
                    'text' => 'Module MX20',
                    'type' => 'default',
                ),
                'module_mx21' =>  array(
                    'text' => 'Module MX21',
                    'type' => 'default',
                ),
                'module_mx22' =>  array(
                    'text' => 'Module MX22',
                    'type' => 'default',
                ),
                'module_mx23' =>  array(
                    'text' => 'Module MX23',
                    'type' => 'default',
                ),
                'module_mx24' =>  array(
                    'text' => 'Module MX24',
                    'type' => 'default',
                ),
                'module_mx25' =>  array(
                    'text' => 'Module MX25',
                    'type' => 'default',
                ),
                'module_mx26' =>  array(
                    'text' => 'Module MX26',
                    'type' => 'default',
                ),
                'news_ticker' =>  array(
                    'text' => 'News Ticker',
                    'type' => 'default',
                ),
                'slider_1columns' =>  array(
                    'text' => 'Slider on 1 column',
                    'type' => 'default',
                ),
                'slider_2columns' =>  array(
                    'text' => 'Slider on 2 columns',
                    'type' => 'default',
                ),
                'slider_3columns' =>  array(
                    'text' => 'Slider on 3 columns',
                    'type' => 'default',
                ),
                'big_grid_tiny' =>  array(
                    'text' => 'Big grid - Tiny img',
                    'type' => 'default',
                ),
                'big_grid_small' =>  array(
                    'text' => 'Big grid - Small img',
                    'type' => 'default',
                ),
                'big_grid_medium' =>  array(
                    'text' => 'Big grid - Medium img',
                    'type' => 'default',
                ),
                'big_grid_big' =>  array(
                    'text' => 'Big grid - Big img',
                    'type' => 'default',
                ),
                'homepage_post' =>  array(
                    'text' => 'Homepage post',
                    'type' => 'default',
                )
            ),
            'Mobile menu' => array (
                'mobile_general' => array(
                    'text' => 'General font',
                    'type' => 'general_setting',
                ),
                'mobile_menu' => array(
                    'text' => 'Mobile Menu',
                    'type' => 'default',
                ),
                'mobile_sub_menu' => array(
                    'text' => 'Mobile Sub-Menu',
                    'type' => 'default',
                )
            ),
            'Post title' => array (
                'show_only_on_tdsp' => true,
                'post_general' => array(
                    'text' => 'General font',
                    'type' => 'general_setting',
                ),
                'post_title' =>  array(
                    'text' => 'Default template',
                    'type' => 'default',
                ),
                'post_title_style1' =>  array(
                    'text' => 'Style 1 template',
                    'type' => 'default',
                ),
                'post_title_style2' =>  array(
                    'text' => 'Style 2 template',
                    'type' => 'default',
                ),
                'post_title_style3' =>  array(
                    'text' => 'Style 3 template',
                    'type' => 'default',
                ),
                'post_title_style4' =>  array(
                    'text' => 'Style 4 template',
                    'type' => 'default',
                ),
                'post_title_style5' =>  array(
                    'text' => 'Style 5 template',
                    'type' => 'default',
                ),
                'post_title_style6' =>  array(
                    'text' => 'Style 6 template',
                    'type' => 'default',
                ),
                'post_title_style7' =>  array(
                    'text' => 'Style 7 template',
                    'type' => 'default',
                ),
                'post_title_style8' => array(
                    'text' => 'Style 8 template',
                    'type' => 'default',
                ),
                'post_title_style9' =>  array(
                    'text' => 'Style 9 template',
                    'type' => 'default',
                ),
                'post_title_style10' =>  array(
                    'text' => 'Style 10 template',
                    'type' => 'default',
                ),
                'post_title_style11' =>  array(
                    'text' => 'Style 11 template',
                    'type' => 'default',
                ),
                'post_title_style12' =>  array(
                    'text' => 'Style 12 template',
                    'type' => 'default',
                ),
                'post_title_style13' =>  array(
                    'text' => 'Style 13 template',
                    'type' => 'default',
                ),
            ),
            'Post content' => array (
                'show_only_on_tdsp' => true,
                'post_content' =>  array(
                    'text' => 'Post Content',
                    'type' => 'default',
                ),
                'post_blockquote' =>  array(
                    'text' => 'Default Blockquote',
                    'type' => 'default',
                ),
                'post_box_quote' =>  array(
                    'text' => 'Box Quote',
                    'type' => 'default',
                ),
                'post_pull_quote' =>  array(
                    'text' => 'Pull Quote',
                    'type' => 'default',
                ),
                'post_lists' =>  array(
                    'text' => 'Lists',
                    'type' => 'default',
                ),
                'post_h1' =>  array(
                    'text' => 'H1',
                    'type' => 'default',
                ),
                'post_h2' =>  array(
                    'text' => 'H2',
                    'type' => 'default',
                ),
                'post_h3' =>  array(
                    'text' => 'H3',
                    'type' => 'default',
                ),
                'post_h4' =>  array(
                    'text' => 'H4',
                    'type' => 'default',
                ),
                'post_h5' =>  array(
                    'text' => 'H5',
                    'type' => 'default',
                ),
                'post_h6' =>  array(
                    'text' => 'H6',
                    'type' => 'default',
                ),
            ),
            'Post elements' => array (
                'show_only_on_tdsp' => true,
                'post_category' =>  array(
                    'text' => 'Category tag',
                    'type' => 'default',
                ),
                'post_author' =>  array(
                    'text' => 'Author',
                    'type' => 'default',
                ),
                'post_date' =>  array(
                    'text' => 'Date',
                    'type' => 'default',
                ),
                'post_comment' =>  array(
                    'text' => 'Views and Comments',
                    'type' => 'default',
                ),
                'via_source_tag' =>  array(
                    'text' => 'Via/Source/Tags',
                    'type' => 'default',
                ),
                'post_next_prev_text' =>  array(
                    'text' => 'Next/Prev Text',
                    'type' => 'default',
                ),
                'post_next_prev' =>  array(
                    'text' => 'Next/Prev Post Title',
                    'type' => 'default',
                ),
                'box_author_name' =>  array(
                    'text' => 'Box Author Name',
                    'type' => 'default',
                ),
                'box_author_url' =>  array(
                    'text' => 'Box Author URL',
                    'type' => 'default',
                ),
                'box_author_description' =>  array(
                    'text' => 'Box Author Description',
                    'type' => 'default',
                ),
                'post_related' =>  array(
                    'text' => 'Related Article Title',
                    'type' => 'default',
                ),
                'post_share' =>  array(
                    'text' => 'Share Text',
                    'type' => 'default',
                ),
                'post_image_caption' =>  array(
                    'text' => 'Image caption',
                    'type' => 'default',
                ),
                'post_subtitle_small' =>  array(
                    'text' => 'Subtitle post style Default, 1, 4, 5, 9, 10, 11',
                    'type' => 'default',
                ),
                'post_subtitle_large' =>  array(
                    'text' => 'Subtitle post style 2, 3, 6, 7, 8',
                    'type' => 'default',
                ),
            ),
            'Pages' => array (
                'page_title' =>  array(
                    'text' => 'Page title',
                    'type' => 'default',
                ),
                'page_content' =>  array(
                    'text' => 'Page content',
                    'type' => 'default',
                ),
                'page_h1' =>  array(
                    'text' => 'H1',
                    'type' => 'default',
                ),
                'page_h2' =>  array(
                    'text' => 'H2',
                    'type' => 'default',
                ),
                'page_h3' =>  array(
                    'text' => 'H3',
                    'type' => 'default',
                ),
                'page_h4' =>  array(
                    'text' => 'H4',
                    'type' => 'default',
                ),
                'page_h5' =>  array(
                    'text' => 'H5',
                    'type' => 'default',
                ),
                'page_h6' =>  array(
                    'text' => 'H6',
                    'type' => 'default',
                ),
            ),
            'Footer' => array (
                'show_only_on_tdsp' => true,
                'footer_text_about' =>  array(
                    'text' => 'Text under logo',
                    'type' => 'default',
                ),
                'footer_copyright_text' =>  array(
                    'text' => 'Copyright text',
                    'type' => 'default',
                ),
                'footer_menu_text' =>  array(
                    'text' => 'Footer menu',
                    'type' => 'default',
                ),
            ),
            'Other' => array (
                'show_only_on_tdsp' => true,
                'breadcrumb' =>  array(
                    'text' => 'Breadcrumb',
                    'type' => 'default',
                ),
                'category_tag' =>  array(
                    'text' => 'Sub-Category tags from Category pages',
                    'type' => 'default',
                ),
                'news_ticker_title' =>  array(
                    'text' => 'News Ticker title',
                    'type' => 'default',
                ),
                'pagination' =>  array(
                    'text' => 'Pagination',
                    'type' => 'default',
                ),
                'dropcap' =>  array(
                    'text' => 'Dropcap',
                    'type' => 'default',
                ),
                'default_widgets' =>  array(
                    'text' => 'Default Widgets',
                    'type' => 'default',
                ),
                'default_buttons' =>  array(
                    'text' => 'Default Buttons',
                    'type' => 'default',
                ),
                'woocommerce_products' =>  array(
                    'text' => 'Woocommerce products titles',
                    'type' => 'default',
                ),
                'woocommerce_product_title' =>  array(
                    'text' => 'Woocommerce product title on product page',
                    'type' => 'default',
                ),
            ),
            'bbPress - Forum' => array (
                'bbpress_header' =>  array(
                    'text' => 'Header',
                    'type' => 'default',
                ),
                'bbpress_titles' =>  array(
                    'text' => 'Forums and Topics Titles',
                    'type' => 'default',
                ),
                'bbpress_subcategories' =>  array(
                    'text' => 'Subcategories Titles',
                    'type' => 'default',
                ),
                'bbpress_description' =>  array(
                    'text' => 'Categories Description',
                    'type' => 'default',
                ),
                'bbpress_author' =>  array(
                    'text' => 'Author name',
                    'type' => 'default',
                ),
                'bbpress_replies' =>  array(
                    'text' => 'Replies content',
                    'type' => 'default',
                ),
                'bbpress_notices' =>  array(
                    'text' => 'Notices/Messages',
                    'type' => 'default',
                ),
                'bbpress_pagination' =>  array(
                    'text' => 'Pagination text',
                    'type' => 'default',
                ),
                'bbpress_topic' =>  array(
                    'text' => 'Topic details',
                    'type' => 'default',
                ),
            ),
            'WooCommerce default templates' => array(
                'woo_general' => array(
                    'text' => 'General font',
                    'type' => 'default',
                ),
            ),
        ); // end td_global::$typography_settings_list


        /**
         * set the custom css fields for the panel @see td_panel_custom_css.php
         * and also for the wp_footer hook @see td_bottom_code()
         */
        td_global::$theme_panel_custom_css_fields_list = array(
            'tds_responsive_css_desktop' => array(
                'text' => 'DESKTOP',
                'description' => '1141px +',
                'media_query' => '@media (min-width: 1141px)',
                'img' => TDC_URL_LEGACY_COMMON . '/wp_booster/wp-admin/images/panel/resp-desktop.png'
            ),
            'tds_responsive_css_ipad_landscape' => array(
                'text' => 'IPAD LANDSCAPE',
                'description' => '1019px - 1140px',
                'media_query' => '@media (min-width: 1019px) and (max-width: 1140px)',
                'img' => TDC_URL_LEGACY_COMMON . '/wp_booster/wp-admin/images/panel/resp-ipado.png'
            ),
            'tds_responsive_css_ipad_portrait' => array(
                'text' => 'IPAD PORTRAIT',
                'description' => '768px - 1018px',
                'media_query' => '@media (min-width: 768px) and (max-width: 1018px)',
                'img' => TDC_URL_LEGACY_COMMON . '/wp_booster/wp-admin/images/panel/resp-ipadv.png'
            ),
            'tds_responsive_css_phone' => array(
                'text' => 'PHONES',
                'description' => '0 - 767px',
                'media_query' => '@media (max-width: 767px)',
                'img' => TDC_URL_LEGACY_COMMON . '/wp_booster/wp-admin/images/panel/resp-phone.png'
            )
        );


		// !!!! Change it to use just one option for viewport settings!
	    td_global::$viewport_settings = array(
            'all' => td_global::$theme_panel_custom_css_fields_list['tds_responsive_css_desktop'],
            'landscape' => td_global::$theme_panel_custom_css_fields_list['tds_responsive_css_ipad_landscape'],
	        'portrait' => td_global::$theme_panel_custom_css_fields_list['tds_responsive_css_ipad_portrait'],
            'phone' => td_global::$theme_panel_custom_css_fields_list['tds_responsive_css_phone'],
        );


	    td_global::$default_google_fonts_list = array();
        $td_fonts_default = td_options::get( 'td_fonts_default' );
        if ( empty( $td_fonts_default['default_fonts'] ) || ( ! empty( $td_fonts_default['default_fonts'] ) && '' === $td_fonts_default['default_fonts'] ) ) {
            $td_fonts = td_options::get('td_fonts');

            $default_google_font_1 = '438';
            if ( !empty($td_fonts['custom_def_googl_f_1']) ) {
                if ( strpos($td_fonts['custom_def_googl_f_1']['font_family'], 'g_') !== false ) {
                    $default_google_font_1 = $td_fonts['custom_def_googl_f_1']['font_family'];
                } else {
                    $default_google_font_1 = '';
                }
            }

            $default_google_font_2 = '521';
            if ( !empty($td_fonts['custom_def_googl_f_2']) ) {
                if ( strpos($td_fonts['custom_def_googl_f_2']['font_family'], 'g_') !== false ) {
                    $default_google_font_2 = $td_fonts['custom_def_googl_f_2']['font_family'];
                } else {
                    $default_google_font_2 = '';
                }
            }

	        /**
	         * the default fonts used by the theme. For a list of fonts ids @see td_fonts::$font_names_google_list
	         */
            if ( !empty( $default_google_font_1 ) ) {
                td_global::$default_google_fonts_list[$default_google_font_1] = array(
	                '400',
	                '600',
	                '700'
	            );
            }
            if ( !empty( $default_google_font_2 ) ) {
                td_global::$default_google_fonts_list[$default_google_font_2] = array(
	                '400',
	                '600',
	                '700'
	            );
            }
	    }


	    /**
	     * the demos are stored in /includes/demos
	     * demos_filename (without .txt) => demos_name
	     * @var array
	     */
	    td_global::$demo_list = array(
            'default_pro' => array(
                'text' => 'Default PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/default_pro/',
                'img' => TDC_URL_DEMO . '/default_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'black_pro' => array(
                'text' => 'Black Version PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/black_pro/',
                'img' => TDC_URL_DEMO  . '/black_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_black_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'cassio_lovo' => array(
                'text' => 'Cassio Lovo',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/cassio_lovo/',
                'img' => TDC_URL_DEMO . '/cassio_lovo/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_cassio_lovo_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'Advanced Custom Fields'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'multipurpose'
                )
            ),
            'office_nexus' => array(
                'text' => 'Office Nexus',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/office_nexus/',
                'img' => TDC_URL_DEMO . '/office_nexus/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_office_nexus_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                    'Advanced Custom Fields'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'multipurpose'
                )
            ),
            'forest_beat' => array(
                'text' => 'Forest Beat',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/forest_beat/',
                'img' => TDC_URL_DEMO . '/forest_beat/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_forest_beat_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine'
                )
            ),
            'trucking_services' => array(
                'text' => 'Trucking Services',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/trucking_services/',
                'img' => TDC_URL_DEMO . '/trucking_services/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_trucking_services_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'multipurpose'
                )
            ),
            'interior_designer' => array(
                'text' => 'Interior Designer',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/interior_designer/',
                'img' => TDC_URL_DEMO . '/interior_designer/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_interior_designer_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'multipurpose'
                )
            ),
            'free_news' => array(
                'text' => 'Free News',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/free_news/',
                'img' => TDC_URL_DEMO . '/free_news/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_free_news_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'membership',
                    'magazine'
                )
            ),
            'urban_observer' => array(
                'text' => 'Urban Observer',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/urban_observer/',
                'img' => TDC_URL_DEMO . '/urban_observer/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_urban_observer_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'membership',
                    'magazine'
                )
            ),
            'echoverse' => array(
                'text' => 'EchoVerse',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/echoverse/',
                'img' => TDC_URL_DEMO . '/echoverse/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_echoverse_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine'
                )
            ),
            'towntalk_pro' => array(
                'text' => 'Town Talk',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/towntalk_pro/',
                'img' => TDC_URL_DEMO . '/towntalk_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_towntalk_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                    'tagDiv Social Counter'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'membership',
                    'magazine'
                )
            ),
            'world_matters' => array(
                'text' => 'World Matters',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/world_matters/',
                'img' => TDC_URL_DEMO . '/world_matters/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_world_matters_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine'
                )
            ),
            'pc_forge_pro' => array(
                'text' => 'PC Forge PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/pc_forge_pro/',
                'img' => TDC_URL_DEMO . '/pc_forge_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_pc_forge_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                    'Advanced Custom Fields',
                    //'PC Forge PRO Plugin',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'listing',
                    'multipurpose'
                )
            ),
            'app_find_pro' => array(
                'text' => 'APP Find PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/app_find_pro/',
                'img' => TDC_URL_DEMO . '/app_find_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_app_find_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                    'tagDiv Newsletter',
                    'Advanced Custom Fields',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'listing',
                    'multipurpose'
                )
            ),
            'korean_news_insight' => array(
                'text' => 'Korean News Insight',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/korean_news_insight/',
                'img' => TDC_URL_DEMO . '/korean_news_insight/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_korean_news_insight/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine'
                )
            ),
            'insightai' => array(
                'text' => 'InsightAI',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/insightai/',
                'img' => TDC_URL_DEMO . '/insightai/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_insightai_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine'
                )
            ),
            'urbanedge' => array(
                'text' => 'UrbanEdge',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/urbanedge/',
                'img' => TDC_URL_DEMO . '/insightai/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_urbanedge_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine'
                )
            ),
            'coaching_pro' => array(
                'text' => 'Coaching PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/coaching_pro/',
                'img' => TDC_URL_DEMO . '/coaching_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_coaching_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'Advanced Custom Fields',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'membership',
                    'multipurpose'
                )
            ),
            'job_hunt_pro' => array(
                'text' => 'Job Hunt PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/job_hunt_pro/',
                'img' => TDC_URL_DEMO . '/job_hunt_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_job_hunt_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                    'Advanced Custom Fields',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'listing',
                    'multipurpose'
                )
            ),
            'momentum_pro' => array(
                'text' => 'Momentum PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/momentum_pro/',
                'img' => TDC_URL_DEMO . '/momentum_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_momentum_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'Advanced Custom Fields',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'multipurpose'
                )
            ),
            'cali_sight' => array(
                'text' => 'Cali Sight',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/cali_sight/',
                'img' => TDC_URL_DEMO . '/cali_sight/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_cali_sight_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                    'Advanced Custom Fields',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'multipurpose',
                    'listing'
                )
            ),
            'liberty_case' => array(
                'text' => 'Liberty Case',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/liberty_case/',
                'img' => TDC_URL_DEMO . '/liberty_case/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_liberty_case_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine'
                )
            ),
            'real_estate_pro' => array(
                'text' => 'Real Estate PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/real_estate_pro/',
                'img' => TDC_URL_DEMO . '/real_estate_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_real_estate_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                    'tagDiv Newsletter',
	                'Advanced Custom Fields',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'listing'
                )
            ),
            'compass_pro' => array(
                'text' => 'Compass PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/compass_pro/',
                'img' => TDC_URL_DEMO . '/compass_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_compass_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
	                'Advanced Custom Fields',
                    'Compass PRO Plugin',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'listing'
                )
            ),
            'eastcoast_check_pro' => array(
                'text' => 'EastCoast Check PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/eastcoast_check_pro/',
                'img' => TDC_URL_DEMO . '/eastcoast_check_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_eastcoast_check_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
	                'Advanced Custom Fields',
                    'Eastcoast Check PRO Plugin',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'listing'
                )
            ),
            'doctors_pro' => array(
                'text' => 'Doctors PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/doctors_pro/',
                'img' => TDC_URL_DEMO . '/doctors_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_doctors_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
	                'Advanced Custom Fields',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'listing'
                )
            ),
            'blockchain_pro' => array(
                'text' => 'BlockChain PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/blockchain_pro/',
                'img' => TDC_URL_DEMO . '/blockchain_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_blockchain_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'multipurpose'
                )
            ),
            'default_rtl_pro' => array(
                'text' => 'Default RTL PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/default_rtl_pro/',
                'img' => TDC_URL_DEMO . '/default_rtl_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_default_rtl_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                    'rtl'
                ),
            ),
            'river_news' => array(
                'text' => 'River News',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/river_news/',
                'img' => TDC_URL_DEMO . '/river_news/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_river_news_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
	                'tagDiv Opt-In Builder'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                    'membership',
                    'rtl'
                ),
            ),
            'rtl_news_magazine' => array(
                'text' => 'RTL News Magazine',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/rtl_news_magazine/',
                'img' => TDC_URL_DEMO . '/rtl_news_magazine/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_rtl_newsmagazine_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                    'membership',
                    'rtl'
                ),
            ),
			//'food_delivery_pro' => array(
			//    'text' => 'Food Delivery PRO',
			//    'folder' => TDC_PATH_LEGACY . '/includes/demos/food_delivery_pro/',
			//    'img' => TDC_URL_DEMO . '/food_delivery_pro/screenshot.png',
			//    'demo_url' => 'https://demo.tagdiv.com/newspaper_food_delivery_pro/',
			//    'td_css_generator_demo' => false,
			//    'uses_custom_style_css' => false,
			//    'required_plugins' => array(
			//        'tagDiv Cloud Library',
			//        'tagDiv Shop',
			//        'WooCommerce'
			//    ),
			//    'type' => array(
			//        'shop'
			//    ),
			//),
            'chained_news_pro' => array(
                'text' => 'Chained News PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/chained_news_pro/',
                'img' => TDC_URL_DEMO . '/chained_news_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_chained_news_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                    'membership'
                ),
            ),
            'dreamland_nest_pro' => array(
                'text' => 'Dreamland Nest PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/dreamland_nest_pro/',
                'img' => TDC_URL_DEMO . '/dreamland_nest_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_dreamland_nest_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                ),
                'type' => array(
                    'pro',
                    'multipurpose',
                ),
            ),
            'crypto_gaming_pro' => array(
                'text' => 'Crypto Gaming PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/crypto_gaming_pro/',
                'img' => TDC_URL_DEMO . '/crypto_gaming_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_crypto_gaming_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'magazine',
                    'membership'
                ),
            ),
            'news_hub_pro' => array(
                'text' => 'News Hub PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/news_hub_pro/',
                'img' => TDC_URL_DEMO . '/news_hub_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_news_hub_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'magazine',
                    'membership'
                ),
            ),
            'today_news_pro' => array(
                'text' => 'Today News PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/today_news_pro/',
                'img' => TDC_URL_DEMO . '/today_news_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_today_news_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'magazine',
                    'membership'
                ),
            ),
            'reel_news_pro' => array(
                'text' => 'Reel News PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/reel_news_pro/',
                'img' => TDC_URL_DEMO . '/reel_news_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_reel_news_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'magazine',
                    'membership'
                ),
            ),
            'music_life' => array(
                'text' => 'Music & Life',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/music_life/',
                'img' => TDC_URL_DEMO . '/music_life/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_music_life_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                ),
            ),
			//'tech_talk_pro' => array(
			//    'text' => 'Tech Talk PRO',
			//    'folder' => TDC_PATH_LEGACY . '/includes/demos/tech_talk_pro/',
			//    'img' => TDC_URL_DEMO . '/tech_talk_pro/screenshot.png',
			//    'demo_url' => 'https://demo.tagdiv.com/newspaper_tech_talk_pro/',
			//    'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
			//    'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
			//    'required_plugins' => array(                    // required plugins for the demo to work properly
			//        'tagDiv Cloud Library',
			//        'tagDiv Opt-In Builder',
			//    ),
			//    'type' => array(
			//        'pro',
			//        'magazine',
			//        'membership'
			//    ),
			//),
            'lightning_path' => array(
                'text' => 'Lightning-Path',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/lightning_path/',
                'img' => TDC_URL_DEMO . '/lightning_path/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_lightning_path_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                    'tagDiv Opt-In Builder'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'blog',
                    'membership'
                ),
            ),
            'amsonia' => array(
                'text' => 'Amsonia',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/amsonia/',
                'img' => TDC_URL_DEMO . '/amsonia/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_amsonia_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                    'tagDiv Opt-In Builder'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                    'membership'
                ),
            ),
            'downtown_pro' => array(
                'text' => 'Downtown Magazine PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/downtown_pro/',
                'img' => TDC_URL_DEMO . '/downtown_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_downtown_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'magazine',
                    'membership'
                ),
            ),
            'nft_pro' => array(
                'text' => 'NFT News PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/nft_pro/',
                'img' => TDC_URL_DEMO . '/nft_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_nft_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                    'tagDiv Opt-In Builder'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                    'membership'
                ),
            ),
            'center_pro' => array(
                'text' => 'Center Magazine PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/center_pro/',
                'img' => TDC_URL_DEMO . '/center_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_center_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                    'tagDiv Opt-In Builder'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                    'membership'
                ),
            ),
            'military_news_pro' => array(
                'text' => 'Military News PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/military_news_pro/',
                'img' => TDC_URL_DEMO . '/military_news_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_military_news_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                    'membership'
                ),
            ),
            'kattmar' => array(
                'text' => 'Kattmar',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/kattmar/',
                'img' => TDC_URL_DEMO . '/kattmar/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_kattmar_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                    'tagDiv Opt-In Builder'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                    'membership'
                ),
            ),
            'aniglobe' => array(
                'text' => 'AniGlobe',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/aniglobe/',
                'img' => TDC_URL_DEMO . '/aniglobe/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_aniglobe_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                    'tagDiv Opt-In Builder'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                    'membership'
                ),
            ),
            'the_rimont' => array(
                'text' => 'The Rimont',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/the_rimont/',
                'img' => TDC_URL_DEMO . '/the_rimont/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_the_rimont_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine'
                ),
            ),
            'living_pro' => array(
                'text' => 'Living Magazine PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/living_pro/',
                'img' => TDC_URL_DEMO . '/living_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_living_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                    'tagDiv Opt-In Builder'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                    'membership'
                ),
            ),
            'week_pro' => array(
                'text' => 'Newsweek PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/week_pro/',
                'img' => TDC_URL_DEMO . '/week_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_week_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                    'membership'
                ),
            ),
            'publication_pro' => array(
                'text' => 'Publication PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/publication_pro/',
                'img' => TDC_URL_DEMO . '/publication_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_publication_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                    'membership'

                ),
            ),
            'metropolitan_pro' => array(
                'text' => 'Metropolitan PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/metropolitan_pro/',
                'img' => TDC_URL_DEMO . '/metropolitan_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_metropolitan_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder'
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'magazine',
                    'membership'
                ),
            ),
            'rue_bailand' => array(
                'text' => 'Rue Bailand',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/rue_bailand/',
                'img' => TDC_URL_DEMO . '/rue_bailand/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_rue_bailand_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'blog',
                    'membership'
                ),
            ),
            'aramis' => array(
                'text' => 'Aramis',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/aramis/',
                'img' => TDC_URL_DEMO . '/aramis/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_aramis_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'latest',
                    'blog',
                    'membership'
                ),
            ),
            'personal_trainer' => array(
                'text' => 'Personal Trainer',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/personal_trainer/',
                'img' => TDC_URL_DEMO . '/personal_trainer/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_personal_trainer_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'blog',
                    'membership'
                ),
            ),
            'crypto_news_pro' => array(
                'text' => 'Crypto News PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/crypto_news_pro/',
                'img' => TDC_URL_DEMO . '/crypto_news_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_crypto_news_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'magazine',
                    'membership'
                ),
            ),
            'parenting' => array(
                'text' => 'Parenting',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/parenting/',
                'img' => TDC_URL_DEMO . '/parenting/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_parenting_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                    'tagDiv Opt-In Builder',
                ),
                'type' => array(
                    'pro',
                    'magazine',
                    'membership'
                ),
            ),
            'revenant' => array(
                'text' => 'Revenant',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/revenant/',
                'img' => TDC_URL_DEMO . '/revenant/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_revenant_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Opt-In Builder'
                ),
                'type' => array(
                    'pro',
                    'magazine',
                    'membership'
                ),
            ),
		    'shop_kids_store' => array(
			    'text' => 'Shop Kids Store',
			    'folder' => TDC_PATH_LEGACY . '/includes/demos/shop_kids_store/',
			    'img' => TDC_URL_DEMO . '/shop_kids_store/screenshot.png',
			    'demo_url' => 'https://demo.tagdiv.com/newspaper_shop_kids_store/',
			    'td_css_generator_demo' => false,
			    'uses_custom_style_css' => false,
			    'required_plugins' => array(
				    'tagDiv Cloud Library',
				    'tagDiv Shop',
				    'tagDiv Newsletter',
				    'tagDiv Social Counter',
				    'WooCommerce'
			    ),
			    'type' => array(
                    'shop'
                ),
		    ),
            'shop_audio' => array(
                'text' => 'Shop Audio',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/shop_audio/',
                'img' => TDC_URL_DEMO . '/shop_audio/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_shop_audio/',
                'td_css_generator_demo' => false,
                'uses_custom_style_css' => false,
                'required_plugins' => array(
                    'tagDiv Cloud Library',
                    'tagDiv Shop',
                    'WooCommerce'
                ),
                'type' => array(
                    'shop'
                ),
            ),
            'shop_watches_store' => array(
                'text' => 'Shop Watches Store',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/shop_watches_store/',
                'img' => TDC_URL_DEMO . '/shop_watches_store/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_shop_watches_store/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Shop',
                    'tagDiv Newsletter',
                    'WooCommerce'
                ),
                'type' => array(
                    'shop'
                ),
            ),
            'shop_vintage_choppers_store' => array(
                'text' => 'Shop Vintage Choppers Store',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/shop_vintage_choppers_store/',
                'img' => TDC_URL_DEMO . '/shop_vintage_choppers_store/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_shop_vintage_choppers_store/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Shop',
                    'WooCommerce'
                ),
                'type' => array(
                    'shop'
                ),
            ),
            'shop_makeup' => array(
                'text' => 'Shop Makeup',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/shop_makeup/',
                'img' => TDC_URL_DEMO . '/shop_makeup/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_shop_makeup/',
                'td_css_generator_demo' => false,
                'uses_custom_style_css' => false,
                'required_plugins' => array(
                    'tagDiv Cloud Library',
                    'tagDiv Shop',
                    'tagDiv Newsletter',
                    'tagDiv Social Counter',
                    'WooCommerce'
                ),
                'type' => array(
                    'shop'
                ),
            ),
            'shop_apocryph_pro' => array(
                'text' => 'Shop Apocryph',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/shop_apocryph_pro/',
                'img' => TDC_URL_DEMO . '/shop_vaness_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_shop_apocryph/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Shop',
                    'tagDiv Newsletter',
                    'WooCommerce'
                ),
                'type' => array(
                    'shop'
                ),
            ),
            'shop_vaness_pro' => array(
                'text' => 'Shop Vaness',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/shop_vaness_pro/',
                'img' => TDC_URL_DEMO . '/shop_vaness_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_shop_vaness/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Shop',
                    'tagDiv Newsletter',
                    'WooCommerce'
                ),
                'type' => array(
                    'shop'
                ),
            ),
            'shop_blog_gadgets' => array(
                'text' => 'Shop Blog Gadgets',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/shop_blog_gadgets/',
                'img' => TDC_URL_DEMO . '/shop_blog_gadgets/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_shop_blog_gadgets/',
                'td_css_generator_demo' => false,
                'uses_custom_style_css' => false,
                'required_plugins' => array(
                    'tagDiv Cloud Library',
                    'tagDiv Shop',
                    'tagDiv Newsletter',
                    'tagDiv Social Counter',
                    'WooCommerce'
                ),
                'type' => array(
                    'shop'
                ),
            ),
            'art_blog_pro' => array(
                'text' => 'Art Blog PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/art_blog_pro/',
                'img' => TDC_URL_DEMO . '/art_blog_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_art_blog_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'blog'
                ),
            ),
            'magazine_pro' => array(
                'text' => 'Magazine PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/magazine_pro/',
                'img' => TDC_URL_DEMO . '/magazine_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_magazine_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'pulses_pro' => array(
                'text' => 'Pulses PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/pulses_pro/',
                'img' => TDC_URL_DEMO  . '/pulses_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_pulses_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'london_news_pro' => array(
                'text' => 'London News PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/london_news_pro/',
                'img' => TDC_URL_DEMO . '/london_news_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_london_news_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'city_pro' => array(
                'text' => 'City PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/city_pro/',
                'img' => TDC_URL_DEMO  . '/city_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_city_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(
                    // required plugins for the demo to work properly
                    'tagDiv Newsletter',
                    'tagDiv Cloud Library',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'school_pro' => array(
                'text' => 'School PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/school_pro/',
                'img' => TDC_URL_DEMO  . '/school_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_school_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(
                    // required plugins for the demo to work properly
                    'tagDiv Newsletter',
                    'tagDiv Cloud Library',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'cov19_italy_report_pro' => array(
                'text' => 'COV-19 Italy Report PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/cov19_italy_report_pro/',
                'img' => TDC_URL_DEMO . '/cov19_italy_report_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_covid19_news_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'gossip_pro' => array(
                'text' => 'Gossip PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/gossip_pro/',
                'img' => TDC_URL_DEMO . '/gossip_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_gossip_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'tech_pro' => array(
                'text' => 'Tech News PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/tech_pro/',
                'img' => TDC_URL_DEMO . '/tech_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_tech_news_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'life_news' => array(
                'text' => 'Life News PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/life_news/',
                'img' => TDC_URL_DEMO . '/life_news/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_life_news/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'gadgets_pro' => array(
                'text' => 'Gadgets PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/gadgets_pro/',
                'img' => TDC_URL_DEMO . '/gadgets_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_gadgets_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'romania_news' => array(
                'text' => 'Romania News PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/romania_news/',
                'img' => TDC_URL_DEMO . '/romania_news/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_romania_news/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'classic_pro' => array(
                'text' => 'Classic PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/classic_pro/',
                'img' => TDC_URL_DEMO  . '/classic_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_classic_pro/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                ),
                'type' => array(
                    'pro',
                    'blog'
                ),
            ),
            'lifestyle_pro' => array(
                'text' => 'Lifestyle PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/lifestyle_pro/',
                'img' => TDC_URL_DEMO . '/lifestyle_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_lifestyle_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'medicine_pro' => array(
                'text' => 'Coronavirus Medicine PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/medicine_pro/',
                'img' => TDC_URL_DEMO . '/medicine_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_medicine_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'covid_dark_pro' => array(
                'text' => 'Covid Dark PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/covid_dark_pro/',
                'img' => TDC_URL_DEMO  . '/covid_dark_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_covid_dark_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'covid_stats_pro' => array(
                'text' => 'Covid Stats PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/covid_stats_pro/',
                'img' => TDC_URL_DEMO  . '/covid_stats_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_covid_stats_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'pandemic_pro' => array(
                'text' => 'Covid Pandemic PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/pandemic_pro/',
                'img' => TDC_URL_DEMO . '/pandemic_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_pandemic_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'artist_pro' => array(
                'text' => 'Artist PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/artist_pro/',
                'img' => TDC_URL_DEMO . '/artist_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_artist_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'arette_pro' => array(
                'text' => 'Arette PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/arette_pro/',
                'img' => TDC_URL_DEMO . '/arette_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_arette_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'scuba_pro' => array(
                'text' => 'Scuba Diving PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/scuba_pro/',
                'img' => TDC_URL_DEMO . '/scuba_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_scuba_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'garden_pro' => array(
                'text' => 'Garden PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/garden_pro/',
                'img' => TDC_URL_DEMO . '/garden_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_garden_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'estates_pro' => array(
                'text' => 'Estates PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/estates_pro/',
                'img' => TDC_URL_DEMO . '/estates_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_estates_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'mintyside_pro' => array(
                'text' => 'Mintyside PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/mintyside_pro/',
                'img' => TDC_URL_DEMO . '/mintyside_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_mintyside_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'retro_blog_pro' => array(
                'text' => 'Retro Blog PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/retro_blog_pro/',
                'img' => TDC_URL_DEMO . '/retro_blog_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_retro_blog_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'blog'
                ),
            ),
            'gourmet_pro' => array(
                'text' => 'Gourmet PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/gourmet_pro/',
                'img' => TDC_URL_DEMO . '/gourmet_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_gourmet_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'style_pro' => array(
                'text' => 'Style PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/style_pro/',
                'img' => TDC_URL_DEMO . '/style_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_style_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'influencer' => array(
                'text' => 'Influencer PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/influencer/',
                'img' => TDC_URL_DEMO . '/influencer/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_influencer/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'travel_pro' => array(
                'text' => 'Travel Memories PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/travel_pro/',
                'img' => TDC_URL_DEMO . '/travel_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_travel_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'blog'
                ),
            ),
            'video_pro' => array(
                'text' => 'Video News PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/video_pro/',
                'img' => TDC_URL_DEMO . '/video_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_video_news_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'animals_pro' => array(
                'text' => 'Animals Magazine PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/animals_pro/',
                'img' => TDC_URL_DEMO . '/animals_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_animals_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'royal_pub_pro' => array(
                'text' => 'Royal Pub PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/royal_pub_pro/',
                'img' => TDC_URL_DEMO  . '/royal_pub_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_royal_pub_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'amberlight_pro' => array(
                'text' => 'Amberlight PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/amberlight_pro/',
                'img' => TDC_URL_DEMO . '/amberlight_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_amberlight_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'baby_pro' => array(
                'text' => 'Baby PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/baby_pro/',
                'img' => TDC_URL_DEMO . '/baby_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_baby_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'zodiac_pro' => array(
                'text' => 'Zodiac PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/zodiac_pro/',
                'img' => TDC_URL_DEMO . '/zodiac_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_zodiac_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'the_critic' => array(
                'text' => 'The Critic PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/the_critic/',
                'img' => TDC_URL_DEMO . '/the_critic/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_the_critic/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'blog'
                ),
            ),
            'podcasts' => array(
                'text' => 'Podcasts PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/podcasts/',
                'img' => TDC_URL_DEMO . '/podcasts/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_podcasts/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'fashion_pro' => array(
                'text' => 'La Mode PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/fashion_pro/',
                'img' => TDC_URL_DEMO . '/fashion_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_la_mode/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'sports_pro' => array(
                'text' => 'Sports PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/sports_pro/',
                'img' => TDC_URL_DEMO  . '/sports_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_sports_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'fitness_pro' => array(
                'text' => 'Fitness Blog PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/fitness_pro/',
                'img' => TDC_URL_DEMO . '/fitness_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_fitness_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'blog'
                ),
            ),
            'history_pro' => array(
                'text' => 'L\'Histoire PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/history_pro/',
                'img' => TDC_URL_DEMO . '/history_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_history/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'art_pro' => array(
                'text' => 'Art Magazine PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/art_pro/',
                'img' => TDC_URL_DEMO . '/art_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_art_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'beauty_pro' => array(
                'text' => 'Beauty PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/beauty_pro/',
                'img' => TDC_URL_DEMO  . '/beauty_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_beauty_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(
                    'tagDiv Newsletter',
                    'tagDiv Cloud Library',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'gadgets_magazine_pro' => array(
                'text' => 'Gadgets Magazine PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/gadgets_magazine_pro/',
                'img' => TDC_URL_DEMO . '/gadgets_magazine_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_gadgets_magazine_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'crypto_pro' => array(
                'text' => 'Crypto PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/crypto_pro/',
                'img' => TDC_URL_DEMO . '/crypto_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_crypto_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'fast_pro' => array(
                'text' => 'Fast News PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/fast_pro/',
                'img' => TDC_URL_DEMO . '/fast_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_fast_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'business_pro' => array(
                'text' => 'Business PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/business_pro/',
                'img' => TDC_URL_DEMO . '/business_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_business_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'classic_blog_pro' => array(
                'text' => 'Classic Blog PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/classic_blog_pro/',
                'img' => TDC_URL_DEMO . '/classic_blog_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_classic_blog_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'city_news_pro' => array(
                'text' => 'City News PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/city_news_pro/',
                'img' => TDC_URL_DEMO . '/crypto_news_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_city_news_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'pro',
                    'magazine'
                ),
            ),
            'dentist_pro' => array(
                'text' => 'Dental Studio PRO',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/dentist_pro/',
                'img' => TDC_URL_DEMO . '/dentist_pro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_dentist_pro/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => false,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                ),
                'type' => array(
                    'pro',
                    'multipurpose'
                )
            ),
            'default' => array(
                'text' => 'Default',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/default/',
                'img' => TDC_URL_DEMO . '/default/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper/',
                'td_css_generator_demo' => false,
                'uses_custom_style_css' => false,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'hide_demo' => true,                            // hide the old demo which has a PRO version
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                ),
            ),
            'black' => array(
                'text' => 'Black Version',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/black/',
                'img' => TDC_URL_DEMO . '/black/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_black/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'hide_demo' => true,                            // hide the old demo which has a PRO version
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                ),
            ),
            'gossip' => array(
                'text' => 'iGossip',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/gossip/',
                'img' => TDC_URL_DEMO . '/gossip/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_gossip/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Standard Pack',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'magazine'
                ),
            ),
            'blog_food' => array(
                'text' => 'Food Blog',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/blog_food/',
                'img' => TDC_URL_DEMO . '/blog_food/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_blog_food/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
	                'tagDiv Cloud Library',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'racing' => array(
                'text' => 'Racing Mag',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/racing/',
                'img' => TDC_URL_DEMO . '/racing/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_racing/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
	                'tagDiv Cloud Library',
                    'tagDiv Standard Pack',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'nomad' => array(
                'text' => 'Nomad',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/nomad/',
                'img' => TDC_URL_DEMO . '/nomad/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_nomad/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'decor' => array(
                'text' => 'Home Decor',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/decor/',
                'img' => TDC_URL_DEMO . '/decor/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_decor/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'blog_lifestyle' => array(
                'text' => 'Lifestyle Blog',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/blog_lifestyle/',
                'img' => TDC_URL_DEMO . '/blog_lifestyle/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_blog_lifestyle/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                     // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'living_mag' => array(
                'text' => 'LivingMag',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/living_mag/',
                'img' => TDC_URL_DEMO . '/living_mag/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_living_mag/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'fast' => array(
                'text' => 'Fast News',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/fast/',
                'img' => TDC_URL_DEMO . '/fast/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_fast/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'hide_demo' => true,                            // hide the old demo which has a PRO version
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'crypto' => array(
                'text' => 'Crypto News',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/crypto/',
                'img' => TDC_URL_DEMO . '/crypto/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_crypto/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'hide_demo' => true,                            // hide the old demo which has a PRO version
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'craft_ideas' => array(
                'text' => 'Craft Ideas',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/craft_ideas/',
                'img' => TDC_URL_DEMO . '/craft_ideas/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_craft_ideas/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                    'tagDiv Social Counter',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'classy' => array(
                'text' => 'Classy Magazine',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/classy/',
                'img' => TDC_URL_DEMO . '/classy/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_classy/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'journal' => array(
                'text' => 'Journal',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/journal/',
                'img' => TDC_URL_DEMO . '/journal/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_journal/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'dentist' => array(
                'text' => 'Dental Studio',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/dentist/',
                'img' => TDC_URL_DEMO . '/dentist/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_dentist/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'hide_demo' => true,                            // hide the old demo which has a PRO version
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'multipurpose'
                )
            ),
            'gaming' => array(
                'text' => 'Gaming',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/gaming/',
                'img' => TDC_URL_DEMO . '/gaming/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_gaming/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Newsletter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'entertainment' => array(
                'text' => 'Entertainment',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/entertainment/',
                'img' => TDC_URL_DEMO . '/entertainment/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_entertainment/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Cloud Library',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'blog_coffee' => array(
                'text' => 'Coffee Blog',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/blog_coffee/',
                'img' => TDC_URL_DEMO . '/blog_coffee/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_blog_coffee/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'nature' => array(
                'text' => 'Nature Love',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/nature/',
                'img' => TDC_URL_DEMO . '/nature/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_nature/',
                'td_css_generator_demo' => false,               // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'multipurpose'
                )
            ),
            'wine' => array(
                'text' => 'Wine Aroma',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/wine/',
                'img' => TDC_URL_DEMO . '/wine/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_wine/',
                'td_css_generator_demo' => false,               // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'multipurpose'
                )
            ),
            'city_news' => array(
                'text' => 'City News',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/city_news/',
                'img' => TDC_URL_DEMO . '/city_news/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_city_news/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'hide_demo' => true,                            // hide the old demo which has a PRO version
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'smart_app' => array(
                'text' => 'Smart APP',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/smart_app/',
                'img' => TDC_URL_DEMO . '/smart_app/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_smart_app/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'multipurpose'
                )
            ),
            'lifestyle' => array(
                'text' => 'Lifestyle Magazine',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/lifestyle/',
                'img' => TDC_URL_DEMO . '/lifestyle/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_lifestyle/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'gadgets' => array(
                'text' => 'Gadgets',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/gadgets/',
                'img' => TDC_URL_DEMO . '/gadgets/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_gadgets/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'hide_demo' => true,                            // hide the old demo which has a PRO version
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'wildlife' => array(
                'text' => 'Raw & Wild',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/wildlife/',
                'img' => TDC_URL_DEMO . '/wildlife/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_wildlife/',
                'td_css_generator_demo' => false,               // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'multipurpose'
                )
            ),
            'business' => array(
                'text' => 'Business',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/business/',
                'img' => TDC_URL_DEMO . '/business/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_business/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'hide_demo' => true,                            // hide the old demo which has a PRO version
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'multipurpose'
                )
            ),
            'construction' => array(
                'text' => 'Construction',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/construction/',
                'img' => TDC_URL_DEMO . '/construction/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_construction/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'multipurpose'
                )
            ),
            'recipes' => array(
                'text' => 'Recipes',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/recipes/',
                'img' => TDC_URL_DEMO . '/recipes/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_recipes/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'week' => array(
                'text' => 'News Week',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/week/',
                'img' => TDC_URL_DEMO . '/week/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_week/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'ink' => array(
                'text' => 'Ink Parlor',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/ink/',
                'img' => TDC_URL_DEMO . '/ink/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_ink/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'multipurpose'
                )
            ),
            'what' => array(
                'text' => 'Say What?',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/what/',
                'img' => TDC_URL_DEMO . '/what/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_what/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'book_club' => array(
                'text' => 'Book Club',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/book_club/',
                'img' => TDC_URL_DEMO . '/book_club/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_book_club/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'demo_installed_text' => '<a href="http://forum.tagdiv.com/import-revolution-sliders-on-demos/" target="_blank">Import revolution slider</a>',
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'law_firm' => array(
                'text' => 'Law Firm',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/law_firm/',
                'img' => TDC_URL_DEMO . '/law_firm/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_law_firm/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'multipurpose'
                )
            ),
            'tech' => array(
                'text' => 'Tech News',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/tech/',
                'img' => TDC_URL_DEMO . '/tech/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_tech/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'spa' => array(
                'text' => 'Spa Heaven',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/spa/',
                'img' => TDC_URL_DEMO . '/spa/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_spa/',
                'td_css_generator_demo' => false,               // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'multipurpose'
                )
            ),
            'travel' => array(
                'text' => 'Travel Guides',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/travel/',
                'img' => TDC_URL_DEMO . '/travel/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_travel/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                    'tagDiv Newsletter',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'retro' => array(
                'text' => 'Retro',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/retro/',
                'img' => TDC_URL_DEMO . '/retro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_retro/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'blog_architecture' => array(
                'text' => 'Architecture',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/blog_architecture/',
                'img' => TDC_URL_DEMO . '/blog_architecture/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_architecture/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'blog_fitness' => array(
                'text' => 'Blog Fitness',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/blog_fitness/',
                'img' => TDC_URL_DEMO . '/blog_fitness/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_blog_fitness/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'magazine' => array(
                'text' => 'News Magazine',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/magazine/',
                'img' => TDC_URL_DEMO . '/magazine/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_magazine/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'voice' => array(
                'text' => 'Voice Report',
                'folder' => TDC_PATH_LEGACY .  '/includes/demos/voice/',
                'img' => TDC_URL_DEMO . '/voice/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_voice/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'technology' => array(
                'text' => 'Technology',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/technology/',
                'img' => TDC_URL_DEMO . '/technology/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_technology/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'multipurpose'
                )
            ),
            'art_creek' => array(
                'text' => 'Art Creek',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/art_creek/',
                'img' => TDC_URL_DEMO . '/art_creek/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_art_creek/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'sound_radar' => array(
                'text' => 'Sound Radar',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/sound_radar/',
                'img' => TDC_URL_DEMO . '/sound_radar/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_sound_radar/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'blog_travel' => array(
                'text' => 'Travel Blog',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/blog_travel/',
                'img' => TDC_URL_DEMO . '/blog_travel/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_blog_travel/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'demo_installed_text' => '<a href="http://forum.tagdiv.com/import-revolution-sliders-on-demos/" target="_blank">Import revolution slider</a>',
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'church' => array(
                'text' => 'Church',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/church/',
                'img' => TDC_URL_DEMO . '/church/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_church/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'blog_beauty' => array(
                'text' => 'Beauty Blog',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/blog_beauty/',
                'img' => TDC_URL_DEMO . '/blog_beauty/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_blog_beauty/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'restro' => array(
                'text' => 'Restro',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/restro/',
                'img' => TDC_URL_DEMO . '/restro/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_restro/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'multipurpose'
                )
            ),
            'showcase' => array(
                'text' => 'Showcase',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/showcase/',
                'img' => TDC_URL_DEMO . '/showcase/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_showcase/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'multipurpose'
                )
            ),
            'old_fashioned' => array(
                'text' => 'Old Fashioned',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/old_fashioned/',
                'img' => TDC_URL_DEMO . '/old_fashioned/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_old_fashioned/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'photography' => array(
                'text' => 'Photography',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/photography/',
                'img' => TDC_URL_DEMO . '/photography/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_photography/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'blog_baby' => array(
                'text' => 'Baby Blog',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/blog_baby/',
                'img' => TDC_URL_DEMO . '/blog_baby/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_blog_baby/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'cafe' => array(
                'text' => 'News Cafe',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/cafe/',
                'img' => TDC_URL_DEMO . '/cafe/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_cafe/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'sport' => array(
                'text' => 'Sport News',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/sport/',
                'img' => TDC_URL_DEMO . '/sport/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_sport/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'local_news' => array(
                'text' => 'Local News',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/local_news/',
                'img' => TDC_URL_DEMO . '/local_news/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_local_news/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'blog_cars' => array(
                'text' => 'Cars Blog',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/blog_cars/',
                'img' => TDC_URL_DEMO . '/blog_cars/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_blog_cars/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'demo_installed_text' => '<a href="http://forum.tagdiv.com/import-revolution-sliders-on-demos/" target="_blank">Import revolution slider</a>',
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'medicine' => array(
                'text' => 'Global Medicine',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/medicine/',
                'img' => TDC_URL_DEMO . '/medicine/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_medicine/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'blog_health' => array(
                'text' => 'Health Blog',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/blog_health/',
                'img' => TDC_URL_DEMO . '/blog_health/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_blog_health/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'wedding' => array(
                'text' => 'Wedding News',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/wedding/',
                'img' => TDC_URL_DEMO . '/wedding/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_wedding/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'demo_installed_text' => '<a href="http://forum.tagdiv.com/import-revolution-sliders-on-demos/" target="_blank">Import revolution slider</a>',
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'animals' => array(
                'text' => 'Animal News',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/animals/',
                'img' => TDC_URL_DEMO . '/animals/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_animals/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'politics' => array(
                'text' => 'Politics',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/politics/',
                'img' => TDC_URL_DEMO . '/politics/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_politics/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'demo_installed_text' => '<a href="http://forum.tagdiv.com/import-revolution-sliders-on-demos/" target="_blank">Import revolution slider</a>',
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'blog' => array(
                'text' => 'Classic Blog',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/blog/',
                'img' => TDC_URL_DEMO . '/blog/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_classic_blog/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'hide_demo' => true,                            // hide the old demo which has a PRO version
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'blog'
                )
            ),
            'college' => array(
                'text' => 'College News',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/college/',
                'img' => TDC_URL_DEMO . '/college/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_college/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                 // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
            'cars' => array(
                'text' => 'Car Enthusiast',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/cars/',
                'img' => TDC_URL_DEMO . '/cars/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_cars/',
                'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
	            'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
		    'health' => array(
			    'text' => 'Health & Fitness',
			    'folder' => TDC_PATH_LEGACY . '/includes/demos/health/',
			    'img' => TDC_URL_DEMO . '/health/screenshot.png',
			    'demo_url' => 'https://demo.tagdiv.com/newspaper_health/',
			    'td_css_generator_demo' => true,                // must have a td_css_generator_demo.php in demo's folder
			    'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
		    ),
		    'video' => array(
			    'text' => 'Video News',
			    'folder' => TDC_PATH_LEGACY . '/includes/demos/video/',
			    'img' => TDC_URL_DEMO . '/video/screenshot.png',
			    'demo_url' => 'https://demo.tagdiv.com/newspaper_video/',
			    'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
			    'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
    	    ),
            'fashion' => array(
                'text' => 'Fashion',
                'folder' => TDC_PATH_LEGACY . '/includes/demos/fashion/',
                'img' => TDC_URL_DEMO . '/fashion/screenshot.png',
                'demo_url' => 'https://demo.tagdiv.com/newspaper_fashion/',
                'td_css_generator_demo' => false,                // must have a td_css_generator_demo.php in demo's folder
                'uses_custom_style_css' => true,                // load a custom demo_style.less - must also be added to td_less_style.css.php
                'required_plugins' => array(                    // required plugins for the demo to work properly
                    'tagDiv Social Counter',
                    'tagDiv Standard Pack',
                ),
                'type' => array(
                    'magazine'
                )
            ),
	    );


        /*
         * it doesn't require the tagDiv Composer plugin
         */
        td_api_features::set('require_vc', false);
        //td_api_features::set('require_td_composer', true);

        // disable activation/demos/panel/updates check if just theme without composer..
        if ( ! defined('TD_COMPOSER' ) ) {

	        add_action( 'admin_enqueue_scripts', function() {
				$custom_css = "
					#adminmenu a[href*=\"td_cake_panel\"],
	                #adminmenu a[href*=\"td_theme_demos\"],
	                #adminmenu a[href*=\"td_theme_panel\"],
	                .nav-tab-wrapper a[href*=\"td_cake_panel\"],
	                .nav-tab-wrapper a[href*=\"td_theme_demos\"],
	                .nav-tab-wrapper a[href*=\"td_theme_panel\"] {
	                    display: none
	                }";
                wp_add_inline_style( 'td-wp-admin-td-panel-2', $custom_css );
	        }, 11);
        }

        add_action( 'admin_enqueue_scripts', function () {
            if ( TDC_DEPLOY_MODE == 'dev' ) {
                wp_enqueue_style( 'td-legacy-framework-front-style-less', TDC_URL_LEGACY . '/td_less_style.css.php?part=admin-style.css_td_legacy_newspaper_v1&theme_name=' . TD_THEME_NAME, false, TD_COMPOSER );
            } else {
                wp_enqueue_style('td-legacy-framework-admin-style', TDC_URL_LEGACY . '/assets/css/td_legacy_admin.css', false, TD_COMPOSER);
            }
        }, 11);

		add_action('wp_enqueue_scripts', function () {
	        if ( td_util::is_mobile_theme() ) {
	            return;
	        }

	        // load the css
	        if ( TDC_DEPLOY_MODE == 'dev' ) {
	            wp_enqueue_style( 'td-legacy-framework-front-style-less', TDC_URL_LEGACY . '/td_less_style.css.php?part=style.css_td_legacy_newspaper_v1&theme_name=' . TD_THEME_NAME, false, TD_COMPOSER );

                if ( class_exists('WooCommerce', false) && !defined( 'TD_WOO' ) ) {
                    wp_enqueue_style( 'td-legacy-framework-woo-style-less', TDC_URL_LEGACY . '/td_less_style.css.php?part=woocommerce', false, TD_COMPOSER );
                }
	        } else {
	            wp_enqueue_style( 'td-legacy-framework-front-style', TDC_URL_LEGACY . '/assets/css/td_legacy_main.css', false, TD_COMPOSER );

                if ( class_exists('WooCommerce', false) && !defined( 'TD_WOO' ) ) {
                    wp_enqueue_style('td-legacy-framework-woo-style', TDC_URL_LEGACY . '/assets/css/td_legacy_woocommerce.css' );
                }
	        }
	    }, 1002);

        if ( is_admin() ) {

            /**
             * generate the theme panel
             */
            td_global::$all_theme_panels_list =  array (
                'theme_panel' => array (
                    'title' => TD_THEME_NAME . ' - Theme panel',
                    'subtitle' => 'version: ' . TD_THEME_VERSION,
                    'panels' => array (
                        'td-panel-header' => array(
                            'text' => 'HEADER',
                            'ico_class' => 'td-ico-header',
                            'file' => TDC_PATH_LEGACY_COMMON . '/wp_booster/wp-admin/panel/views/td_panel_header.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-footer' => array(
                            'text' => 'FOOTER',
                            'ico_class' => 'td-ico-footer',
                            'file' => TDC_PATH_LEGACY_COMMON . '/wp_booster/wp-admin/panel/views/td_panel_footer.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-ads' => array(
                            'text' => 'ADS',
                            'ico_class' => 'td-ico-ads',
                            'file' => TDC_PATH_LEGACY . '/includes/panel/views/td_panel_ads.php',
                            'type' => 'in_theme'
                        ),

                        /*  ----------------------------------------------------------------------------
                            layout settings
                         */
                        'td-panel-separator-1' => array(   // LAYOUT SETTINGS Separator
                            'text' => 'LAYOUT SETTINGS',
                            'type' => 'separator'
                        ),
                        'td-panel-template-settings' => array(
                            'text' => 'TEMPLATE SETTINGS',
                            'ico_class' => 'td-ico-template',
                            'file' => TDC_PATH_LEGACY_COMMON . '/wp_booster/wp-admin/panel/views/td_panel_template_settings.php',
                            'type' => 'in_theme'
                        ),

                        'td-panel-categories' => array(
                            'text' => 'CATEGORIES',
                            'ico_class' => 'td-ico-categories',
                            'file' => TDC_PATH_LEGACY_COMMON . '/wp_booster/wp-admin/panel/views/td_panel_categories.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-post-settings' => array(
                            'text' => 'POST SETTINGS',
                            'ico_class' => 'td-ico-post',
                            'file' => TDC_PATH_LEGACY_COMMON . '/wp_booster/wp-admin/panel/views/td_panel_post_settings.php',
                            'type' => 'in_theme'
                        ),


                        /*  ----------------------------------------------------------------------------
                            misc
                         */
                        'td-panel-separator-2' => array( // MISC Separator
                            'text' => 'MISC',
                            'type' => 'separator'
                        ),
                        'td-panel-block-style' => array(
                            'text' => 'BLOCK SETTINGS',
                            'ico_class' => 'td-ico-block',
                            'file' => TDC_PATH_LEGACY . '/includes/panel/views/td_panel_block_settings.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-background' => array(
                            'text' => 'BACKGROUND',
                            'ico_class' => 'td-ico-background',
                            'file' => TDC_PATH_LEGACY_COMMON . '/wp_booster/wp-admin/panel/views/td_panel_background.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-excerpts' => array(
                            'text' => 'EXCERPTS',
                            'ico_class' => 'td-ico-excerpts',
                            'file' => TDC_PATH_LEGACY_COMMON . '/wp_booster/wp-admin/panel/views/td_panel_excerpts.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-translates' => array(
                            'text' => 'TRANSLATIONS',
                            'ico_class' => 'td-ico-translation',
                            'file' => TDC_PATH_LEGACY_COMMON . '/wp_booster/wp-admin/panel/views/td_panel_translations.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-theme-colors' => array(
                            'text' => 'THEME COLORS',
                            'ico_class' => 'td-ico-color',
                            'file' => TDC_PATH_LEGACY . '/includes/panel/views/td_panel_theme_colors.php',
                            'type' => 'in_theme'
                        ),

                        'td-panel-theme-fonts' => array(
                            'text' => 'THEME FONTS',
                            'ico_class' => 'td-ico-typography',
                            'file' => TDC_PATH_LEGACY . '/includes/panel/views/td_panel_theme_fonts.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-custom-code' => array(
                            'text' => 'CUSTOM CODE',
                            'ico_class' => 'td-ico-code',
                            'file' => TDC_PATH_LEGACY_COMMON . '/wp_booster/wp-admin/panel/views/td_panel_custom_code.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-analytics' => array(
                            'text' => 'ANALYTICS/JS CODES',
                            'ico_class' => 'td-ico-analytics',
                            'file' => TDC_PATH_LEGACY_COMMON . '/wp_booster/wp-admin/panel/views/td_panel_analytics.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-social-networks' => array(
                            'text' => 'SOCIAL/APIs',
                            'ico_class' => 'td-ico-social',
                            'file' => TDC_PATH_LEGACY_COMMON . '/wp_booster/wp-admin/panel/views/td_panel_social_networks.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-cpt-taxonomy' => array(
                            'text' => 'CPT &amp; TAXONOMY',
                            'ico_class' => 'td-ico-cpt',
                            'file' => TDC_PATH_LEGACY_COMMON . '/wp_booster/wp-admin/panel/views/td_panel_cpt_taxonomy.php',
                            'type' => 'in_theme'
                        ),
                        'td-link-1' => array( // MISC Separator
                            'text' => 'Import / export',
                            'url' => '?page=td_theme_panel&td_page=td_view_import_export_settings',
                            'type' => 'link'
                        )
                    )
                )
            );

	        /*
	         * the list with custom texts of the theme. admin texts
	         */
	        td_api_text::set('text_featured_video', '
                <div class="td-wpa-info">Paste a video link from Youtube, Vimeo, Dailymotion or Twitter it will be embedded in the post and the thumb used as the featured image of this post. <br/>You need to choose <strong>Video Format</strong> from above to use Featured Video.</div>
                <div class="td-wpa-info remove-wpa-info"><strong>Notice:</strong> Use only with those post templates:
                    <ul>
                        <li>Post style default</li>
                        <li>Post style 1</li>
                        <li>Post style 2</li>
                        <li>Post style 9</li>
                        <li>Post style 10</li>
                        <li>Post style 11</li>
                    </ul>
                    <ul>
                        <li>Find more about this <a href="http://forum.tagdiv.com/featured-image-or-video/" target="_blank">feature</a></li>
                    </ul>
                </div>'
	        );

            td_api_text::set('text_featured_audio', '
                <div class="td-wpa-info">Paste an audio link from SoundCloud, Spotify or self-hosted it will be embedded in the post and the thumb used as the featured image of this post. <br/>You need to choose <strong>Audio Format</strong> from above to use Featured Audio.</div>'
            );

	        td_api_text::set('text_header_logo',
		        'Text logo for header Style 9, Style 10 and Style 11:'
	        );

	        td_api_text::set('text_header_logo_description',
		        'The text logo is used only by Style 9, Style 10 and Style 11 - full menu + text logo. The other header styles use only images for logos'
	        );

	        td_api_text::set('text_header_logo_mobile',
		        'Style 4, Style 5, Style 6, Style 7, Style 8 or Style 12'
	        );

	        td_api_text::set('text_header_logo_mobile_image',
		        '140 x 48px'
	        );

	        td_api_text::set('text_header_logo_mobile_image_retina',
		        '280 x 96px'
	        );

	        td_api_text::set('text_smart_sidebar_widget_support', '
                <p>From here you can enable and disable the smart sidebar on all the templates. The smart sidebar is an affix (sticky) sidebar that has auto resize and it scrolls with the content. The smart sidebar reverts back to a normal sidebar on iOS (iPad) and on mobile devices. The following shortcodes are not supported in the smart sidebar:</p>
                <ul>
                    <li>News ticker</li>
                </ul>
            ');

            td_api_text::set('welcome_fast_start', 'The theme will try to install <strong>tagDiv Composer</strong> and <strong>tagDiv Social Counter</strong> plugins automatically. But you can also manually manage the plugins from our <a href="admin.php?page=td_theme_plugins">plugins panel</a>');

            td_api_text::set('welcome_support_forum', '
            <h2>Support forum</h2>
            <p>We offer outstanding support through our forum. To get support first you need to register (create an account) and open a thread in the ' . TD_THEME_NAME . ' Section.</p>
            <a class="button button-primary" href="http://forum.tagdiv.com/" target="_blank">Open forum</a>'
            );

            td_api_text::set('welcome_docs', '
            <h2>Docs and learning</h2>
            <p>Our online documentation will give you important information about the theme. This is a exceptional resource to start discovering the theme’s true potential.</p>
            <a class="button button-primary" href="https://tagdiv.com/category/documentation/" target="_blank">Open documentation</a>'
            );

            td_api_text::set('welcome_video_tutorials', '
            <h2>Video tutorials</h2>
            <p>We believe that the easiest way to learn is watching a video tutorial. We have a growing library of narrated video tutorials to help you do just that.</p>
            <a class="button button-primary" href="https://www.youtube.com/user/tagdiv" target="_blank">View tutorials</a>'
            );


            /**
             * the tiny mce image style list
             */
            td_global::$tiny_mce_image_style_list = array(
                'td_zoom_in_image_effect' => array(
                    'text' => 'Center Full Width',
                    'class' => 'td-center'
                )
            );

        }

        add_filter( 'theme_page_templates', function( $posts_templates ) {
			$posts_templates = array_merge( $posts_templates, array(
				'page-pagebuilder-latest.php' => 'Pagebuilder + latest articles + pagination',
				'page-pagebuilder-overlay.php' => 'Pagebuilder + Overlay menu',
				'page-pagebuilder-title.php' => 'Pagebuilder + page title',
			) );
			return $posts_templates;
		});

        add_filter( 'template_include', function( $template ) {
			global $post;

			if ( is_page() && ! td_util::is_mobile_theme()  ) {

				$templates = array(
					'page-pagebuilder-latest.php'  => 'Pagebuilder + latest articles + pagination',
					'page-pagebuilder-overlay.php' => 'Pagebuilder + Overlay menu',
					'page-pagebuilder-title.php'   => 'Pagebuilder + page title',
				);

				if ( ! is_null( $post ) ) {
					$current_template = get_post_meta( $post->ID, '_wp_page_template', true );
				}

				if ( empty( $current_template ) || ! array_key_exists( $current_template, $templates ) ) {
					return $template;
				}

				$file_path = TDC_PATH_LEGACY . '/' . $current_template;

				if ( file_exists( $file_path ) ) {
					return $file_path;
				}
			}

			return $template;
		});

        add_action('after_setup_theme', function() {
		   global $td_translation_map;

			$td_translation_map = array(
			    'EXCLUSIVE' => __('EXCLUSIVE', 'newspaper'),

			    //top bar
			    'Tel:' => __('Tel:', 'newspaper'),
			    'Email:' => __('Email:', 'newspaper'),

			    //header search
			    'View all results' => __('View all results', 'newspaper'),
			    'No results' => __('No results', 'newspaper'),

			    'Home' => __('Home', 'newspaper'),

			    //mobile menu
			    'CLOSE' => __('CLOSE', 'newspaper'),

                //mobile search
                'Loading' => __('Loading', 'newspaper'),
                'Here are the results for the search:' => __('Here are the results for the search:', 'newspaper'),

			    //title tag
			    'Page' => __('Page', 'newspaper'),


			    //blocks
			    'All' => __('All', 'newspaper'),
			    'By' => __('By', 'newspaper'),
			    'Load more' => __('Load more', 'newspaper'),
			    'Modified date:' => __('Modified date:', 'newspaper'),
                'Modified date' => __('Modified date', 'newspaper'),
                'Alphabetical A -> Z' => __('Alphabetical A -> Z', 'newspaper'),
                'Oldest posts' => __('Oldest posts', 'newspaper'),
                'Select' => __('Select', 'newspaper'),

			    //breadcrumbs
			    'View all posts in' => __('View all posts in', 'newspaper'),
			    'Tags' => __('Tags', 'newspaper'),

			    //article / page
			    'Previous article' => __('Previous article', 'newspaper'),
			    'Next article' => __('Next article', 'newspaper'),
			    'Authors' => __('Authors', 'newspaper'),
			    'Author' => __('Author', 'newspaper'),
			    'RELATED ARTICLES' => __('RELATED ARTICLES', 'newspaper'),   //on newspaper 4 it was: SIMILAR ARTICLES
			    'MORE FROM AUTHOR' => __('MORE FROM AUTHOR', 'newspaper'),
			    'VIA' => __('VIA', 'newspaper'),   //on newspaper4 it was lowercase
			    'SOURCE' => __('SOURCE', 'newspaper'), //on newspaper4 it was lowercase
			    'TAGS' => __('TAGS', 'newspaper'),
			    'Share' => __('Share', 'newspaper'),
			    'SHARE' => __('SHARE', 'newspaper'),
			    'Continue' => __('Continue', 'newspaper'),
			    'Read more' => __('Read more', 'newspaper'),
			    'views' => __('views', 'newspaper'),
			    'Print' => __('Print', 'newspaper'),


			    //comments
			    'Name:' => __('Name:', 'newspaper'),
			    'Website:' => __('Website:', 'newspaper'),
			    'Comment:' => __('Comment:', 'newspaper'),
			    'LEAVE A REPLY' => __('LEAVE A REPLY', 'newspaper'),  //on newspaper4 it was lowercase
			    'Post Comment' => __('Post Comment', 'newspaper'),
			    'Cancel reply' => __('Cancel reply', 'newspaper'),
			    'Reply' => __('Reply', 'newspaper'),
			    'Log in to leave a comment' => __('Log in to leave a comment', 'newspaper'),
			    'NO COMMENTS' => __('NO COMMENTS', 'newspaper'),
			    '1 COMMENT' => __('1 COMMENT', 'newspaper'),
			    'COMMENTS' => __('COMMENTS', 'newspaper'),
			    'Your comment is awaiting moderation' => __('Your comment is awaiting moderation', 'newspaper'),
			    'Please enter your name here' => __('Please enter your name here', 'newspaper'),
			    'Please enter your email address here' => __('Please enter your email address here', 'newspaper'),
			    'You have entered an incorrect email address!' => __('You have entered an incorrect email address!', 'newspaper'),
			    'Please enter your comment!' => __('Please enter your comment!', 'newspaper'),
			    'Logged in as'                        => __('Logged in as', 'newspaper'),
			    'Log out?'                            => __('Log out?', 'newspaper'),
			    'Logged in as %s. Edit your profile.' => __('Logged in as %s. Edit your profile.', 'newspaper'),
			    'Edit' => __('Edit', 'newspaper'),
                'At' => __('At', 'newspaper'),
                'on' => __('on', 'newspaper'),
                'Comments are closed.' => __('Comments are closed.', 'newspaper'),


			    //review
			    'REVIEW OVERVIEW' => __('REVIEW OVERVIEW', 'newspaper'),  //on newspaper4 it was lowercase
			    'SUMMARY' => __('SUMMARY', 'newspaper'),  //on newspaper4 it was lowercase
			    'OVERALL SCORE' => __('OVERALL SCORE', 'newspaper'),

			    //404
			    'Ooops... Error 404' => __('Ooops... Error 404', 'newspaper'),
			    "Sorry, but the page you are looking for doesn_t exist." => __("Sorry, but the page you are looking for doesn't exist.", 'newspaper'),
			    'You can go to the' => __('You can go to the', 'newspaper'),
			    'HOMEPAGE' => __('HOMEPAGE', 'newspaper'),


			    'OUR LATEST POSTS' => __('OUR LATEST POSTS', 'newspaper'),

			    //author page title atribute
			    'Posts by' => __('Posts by', 'newspaper'),
			    'POSTS' => __('POSTS', 'newspaper'),


			    'Posts tagged with' => __('Posts tagged with', 'newspaper'),
			    'Tag' => __('Tag', 'newspaper'),

			    //archives
			    'Daily Archives:' => __('Daily Archives:', 'newspaper'),
			    'Monthly Archives:' => __('Monthly Archives:', 'newspaper'),
			    'Yearly Archives:' => __('Yearly Archives:', 'newspaper'),
			    'Archives' => __('Archives', 'newspaper'),


			    //homepage
			    'LATEST ARTICLES' => __('LATEST ARTICLES', 'newspaper'),

			    //search page
			    'search results' => __('search results', 'newspaper'),
			    'Search' => __('Search', 'newspaper'),
			    "If you_re not happy with the results, please do another search" => __("If you're not happy with the results, please do another search", 'newspaper'),

			    //footer widget
			    'Contact us' => __('Contact us', 'newspaper'),

			    //footer instagram
			    'Follow us on Instagram' => __('Follow us on Instagram', 'newspaper'),

			    //pagination
			    'Page %CURRENT_PAGE% of %TOTAL_PAGES%' => __('Page %CURRENT_PAGE% of %TOTAL_PAGES%', 'newspaper'),
			    'Next' => __('Next', 'newspaper'),
			    'Prev' => __('Prev', 'newspaper'),
			    'Back' => __('Back', 'newspaper'),


			    'No results for your search' => __('No results for your search', 'newspaper'),
			    'No posts to display' => __('No posts to display', 'newspaper'),
			    'No bookmarked posts' => __('No bookmarked posts', 'newspaper'),

			    //modal window
			    'LOG IN'  => __('LOG IN', 'newspaper'),
			    'Sign in / Join'  => __('Sign in / Join', 'newspaper'),
			    'Sign in' => __('Sign in', 'newspaper'),
			    'Sign up' => __('Sign up', 'newspaper'),
                'Log in With Facebook' => __('Log in With Facebook', 'newspaper'),
                'Join' => __('Join', 'newspaper'),
			    'Log In'  => __('Log In', 'newspaper'),
			    'Login'  => __('Login', 'newspaper'),
			    'REGISTER'  => __('REGISTER', 'newspaper'),
			    'Welcome!' => __('Welcome!', 'newspaper'),
			    'Log into your account' => __('Log into your account', 'newspaper'),
			    'Password recovery' => __('Password recovery', 'newspaper'),
			    'Send My Pass'  => __('Send My Pass', 'newspaper'),
			    'Send My Password'  => __('Send My Password', 'newspaper'),
			    'Forgot your password?'  => __('Forgot your password?', 'newspaper'),
			    'Forgot your password? Get help'  => __('Forgot your password? Get help', 'newspaper'),
			    'Create an account'  => __('Create an account', 'newspaper'),
			    'Please wait...'  => __('Please wait...', 'newspaper'),
			    'User or password incorrect!'  => __('User or password incorrect!', 'newspaper'),
			    'Email or username incorrect!'  => __('Email or username incorrect!', 'newspaper'),
			    'Email incorrect!'  => __('Email incorrect!', 'newspaper'),
			    'User or email already exists!'  => __('User or email already exists!', 'newspaper'),
			    'Please check your email (inbox or spam folder), the password was sent there.'  => __('Please check your email (inbox or spam folder), the password was sent there.', 'newspaper'),
			    'Email address not found!'  => __('Email address not found!', 'newspaper'),
			    'Your password is reset, check your email.'  => __('Your password is reset, check your email.', 'newspaper'),
			    'Welcome! Log into your account' => __('Welcome! Log into your account', 'newspaper'),
			    'Welcome! Register for an account' => __('Welcome! Register for an account', 'newspaper'),
			    'Register for an account' => __('Register for an account', 'newspaper'),
			    'Recover your password' => __('Recover your password', 'newspaper'),
			    'your username' => __('your username', 'newspaper'),
			    'your password' => __('your password', 'newspaper'),
			    'your email' => __('your email', 'newspaper'),
			    'A password will be e-mailed to you.' => __('A password will be e-mailed to you.', 'newspaper'),
			    'Logout' => __('Logout', 'newspaper'),
			    'CAPTCHA verification failed!' => __('CAPTCHA verification failed!', 'newspaper'),
			    'CAPTCHA user score failed. Please contact us!' => __('CAPTCHA user score failed. Please contact us!', 'newspaper'),
			    'Someone has requested a password reset for the following account:' => __('Someone has requested a password reset for the following account:', 'newspaper'),
                'Username: %s' => __('Username: %s', 'newspaper'),
                'If this was a mistake, just ignore this email and nothing will happen.' => __('If this was a mistake, just ignore this email and nothing will happen.', 'newspaper'),
			    'To reset your password, visit the following address:' => __('To reset your password, visit the following address:', 'newspaper'),

			    //social counters
			    'Like' => __('Like', 'newspaper'),
			    'Likes' => __('Likes', 'newspaper'),
			    'Fans' => __('Fans', 'newspaper'),
			    'Follow' => __('Follow', 'newspaper'),
			    'Followers' => __('Followers', 'newspaper'),
                'Members' => __('Members', 'newspaper'),
			    'Subscribe' => __('Subscribe', 'newspaper'),
			    'Subscribers' => __('Subscribers', 'newspaper'),

			    //more article box
			    'MORE STORIES' => __('MORE STORIES', 'newspaper'),

			    //filter drop down options on category page
			    'Latest' => __('Latest', 'newspaper'),
			    'Featured posts' => __('Featured posts', 'newspaper'),
			    'Most popular' => __('Most popular', 'newspaper'),
			    '7 days popular' => __('7 days popular', 'newspaper'),
			    'By review score' => __('By review score', 'newspaper'),
			    'Random' => __('Random', 'newspaper'),

			    'Trending Now' => __('Trending Now', 'newspaper'),

			    //used in Popular Category widget (td_block_popular_categories.php file)
			    'POPULAR CATEGORY' => __('POPULAR CATEGORY', 'newspaper'),
			    'POPULAR POSTS' => __('POPULAR POSTS', 'newspaper'),
			    'EDITOR PICKS' => __('EDITOR PICKS', 'newspaper'),
			    'ABOUT US' => __('ABOUT US', 'newspaper'),
			    'About me' => __('About me', 'newspaper'),
			    'FOLLOW US' => __('FOLLOW US', 'newspaper'),
			    'EVEN MORE NEWS' => __('EVEN MORE NEWS', 'newspaper'),


			    //magnific popup
			    'Previous (Left arrow key)' => __('Previous (Left arrow key)', 'newspaper'),
			    'Next (Right arrow key)' => __('Next (Right arrow key)', 'newspaper'),
			    '%curr% of %total%' => __('%curr% of %total%', 'newspaper'),
			    'The content from %url% could not be loaded.' => __('The content from %url% could not be loaded.', 'newspaper'),
			    'The image #%curr% could not be loaded.' => __('The image #%curr% could not be loaded.', 'newspaper'),

			    //blog
			    'Blog' => __('Blog', 'newspaper'),
			    'Share on Facebook' => __('Share on Facebook', 'newspaper'),
			    'Tweet on Twitter' => __('Tweet on Twitter', 'newspaper'),

			    'Featured' => __('Featured', 'newspaper'),
			    'All time popular' => __('All time popular', 'newspaper'),

			    'More' => __('More', 'newspaper'),
			    'Register' => __('Register', 'newspaper'),

			    'of' => __('of', 'newspaper'),

			    //exchange currencies
			    'Euro Member Countries' => __('Euro Member Countries', 'newspaper'),
			    'Australian Dollar' => __('Australian Dollar', 'newspaper'),
			    'Bulgarian Lev' => __('Bulgarian Lev', 'newspaper'),
			    'Brazilian Real' => __('Brazilian Real', 'newspaper'),
			    'Canadian Dollar' => __('Canadian Dollar', 'newspaper'),
			    'Swiss Franc' => __('Swiss Franc', 'newspaper'),
			    'Chinese Yuan Renminbi' => __('Chinese Yuan Renminbi', 'newspaper'),
			    'Czech Republic Koruna' => __('Czech Republic Koruna', 'newspaper'),
			    'Danish Krone' => __('Danish Krone', 'newspaper'),
			    'British Pound' => __('British Pound', 'newspaper'),
			    'Hong Kong Dollar' => __('Hong Kong Dollar', 'newspaper'),
			    'Croatian Kuna' => __('Croatian Kuna', 'newspaper'),
			    'Hungarian Forint' => __('Hungarian Forint', 'newspaper'),
			    'Indonesian Rupiah' => __('Indonesian Rupiah', 'newspaper'),
			    'Israeli Shekel' => __('Israeli Shekel', 'newspaper'),
			    'Indian Rupee' => __('Indian Rupee', 'newspaper'),
			    'Japanese Yen' => __('Japanese Yen', 'newspaper'),
			    'Korean (South) Won' => __('Korean (South) Won', 'newspaper'),
			    'Mexican Peso' => __('Mexican Peso', 'newspaper'),
			    'Malaysian Ringgit' => __('Malaysian Ringgit', 'newspaper'),
			    'Norwegian Krone' => __('Norwegian Krone', 'newspaper'),
			    'New Zealand Dollar' => __('New Zealand Dollar', 'newspaper'),
			    'Philippine Peso' => __('Philippine Peso', 'newspaper'),
			    'Polish Zloty' => __('Polish Zloty', 'newspaper'),
			    'Romanian (New) Leu' => __('Romanian (New) Leu', 'newspaper'),
			    'Russian Ruble' => __('Russian Ruble', 'newspaper'),
			    'Swedish Krona' => __('Swedish Krona', 'newspaper'),
			    'Singapore Dollar' => __('Singapore Dollar', 'newspaper'),
			    'Thai Baht' => __('Thai Baht', 'newspaper'),
			    'Turkish Lira' => __('Turkish Lira', 'newspaper'),
			    'United States Dollar' => __('United States Dollar', 'newspaper'),
			    'South African Rand' => __('South African Rand', 'newspaper'),


			    'Save my name, email, and website in this browser for the next time I comment.' => __('Save my name, email, and website in this browser for the next time I comment.', 'newspaper'),
			    'Privacy Policy' => 'Privacy Policy',




                // woocommerce
                'My account' => __('My account', 'newspaper'),
                'Orders' => __('Orders', 'newspaper'),
                'Downloads' => __('Downloads', 'newspaper'),
                'Addresses' => __('Addresses', 'newspaper'),
                'Account settings' => __('Account settings', 'newspaper'),
                'Hello' => __('Hello', 'newspaper'),
                'No products in the cart.' => __('No products in the cart.', 'newspaper'),
                'Product categories' => __('Product categories', 'newspaper'),
                'Product tags' => __('Product tags', 'newspaper'),
                'inc. TAX' => __('inc. TAX', 'newspaper'),
                'ex. TAX' => __('ex. TAX', 'newspaper'),


                //post submit form
                'An unexpected error has occured while trying to create your post. Please try again.' => __('An unexpected error has occured while trying to create your post. Please try again.', 'newspaper'),
                'Your post has been successfully created.' => __('Your post has been successfully created.', 'newspaper'),
                'Your post has been successfully updated.' => __('Your post has been successfully updated.', 'newspaper'),
                'An unexpected error has occurred and the mail could not be sent.' => __('An unexpected error has occurred and the mail could not be sent.', 'newspaper'),
                'Location:' => __('Location:', 'newspaper'),
                'The email has been successfully sent.' => __('The email has been successfully sent.', 'newspaper'),
                'An unexpected error has occurred. Please try again.' => __('An unexpected error has occurred. Please try again.', 'newspaper'),
                'Drag and drop or browse' => __('Drag and drop or browse', 'newspaper'),
                'Search by keyword...' => __('Search by keyword...', 'newspaper'),
                'Select parent' => __('Select parent', 'newspaper'),
                'Add new' => __('Add new', 'newspaper'),
                'Select child' => __('Select child', 'newspaper'),
                'Select sub-child' => __('Select sub-child', 'newspaper'),


                // Reviews system
                'Posted by' => __('Posted by', 'newspaper'),
                'Overall' => __('Overall', 'newspaper'),
                'Post review' => __('Post review', 'newspaper'),
                'This field is required!' => __('This field is required!', 'newspaper'),
                'Your review has been published. Please refresh the page in order to see it.' => __('Your review has been published. Please refresh the page in order to see it.', 'newspaper'),
                'Your review has been registered and is awaiting approval.' => __('Your review has been registered and is awaiting approval.', 'newspaper'),
                'Submit reply' => __('Submit reply', 'newspaper'),
                'Enter your reply' => __('Enter your reply', 'newspaper'),
                'Name' => __('Name', 'newspaper'),
                'Email address' => __('Email address', 'newspaper'),
                'Cancel' => __('Cancel', 'newspaper'),
                'Some required fields have been left blank.' => __('Some required fields have been left blank.', 'newspaper'),
                'Please enter a valid email address.' => __('Please enter a valid email address.', 'newspaper'),
                'The number cannot be lower than' => __('The number cannot be lower than', 'newspaper'),
                'The number cannot be higher than' => __('The number cannot be higher than', 'newspaper'),
                'Leave a review' => __('Leave a review', 'newspaper'),
                'Submit' => __('Submit', 'newspaper'),
                'Update' => __('Update', 'newspaper'),
                'out of 5' => __('out of 5', 'newspaper'),
                'You have reached the limit of reviews that you can submit for this article' => __('You have reached the limit of reviews that you can submit for this article', 'newspaper'),
                'Log in to leave a review.' => __('Log in to leave a review.', 'newspaper'),
                'Enter a title for your review' => __('Enter a title for your review', 'newspaper'),
                'Enter your review' => __('Enter your review', 'newspaper'),
                'Review criteria' => __('Review criteria', 'newspaper'),
                'Enter Your Name or Company' => __('Enter Your Name or Company', 'newspaper'),
                'Submit review' => __('Submit review', 'newspaper'),
                'Delete' => __('Delete', 'newspaper'),
                'Your reply has been published. Please refresh the page in order to see it.' => __('Your reply has been published. Please refresh the page in order to see it.', 'newspaper'),

                // Posts List
                'You have not created any posts.' => __('You have not created any posts.', 'newspaper'),
                'You have not bought any posts.' => __('You have not bought any posts.', 'newspaper'),
                'The selected post has been successfully deleted.' => __('The selected post has been successfully deleted.', 'newspaper'),
                'ID' => __('ID', 'newspaper'),
                'Rating' => __('Rating', 'newspaper'),
                'Title' => __('Title', 'newspaper'),
                'Post image' => __('Post image', 'newspaper'),
                'Categories' => __('Categories', 'newspaper'),
                'Date' => __('Date', 'newspaper'),
                'Source title' => __('Source title', 'newspaper'),
                'Credits cost' => __('Credits cost', 'newspaper'),
                'No rating' => __('No rating', 'newspaper'),
                'View' => __('View', 'newspaper'),
                'Publish' => __('Publish', 'newspaper'),
                'Add new post' => __('Add new post', 'newspaper'),
                'Edit post' => __('Edit post', 'newspaper'),
                'Publish a post' => __('Publish a post', 'newspaper'),
                'The status for %POST_TITLE% has been changed.' => __('The status for %POST_TITLE% has been changed.', 'newspaper'),
                'Are you sure you want to publish %POST_TITLE%?' => __('Are you sure you want to publish %POST_TITLE%?', 'newspaper'),
                'Delete a post' => __('Delete a post', 'newspaper'),
                'Are you sure you want to delete %POST_TITLE%?' => __('Are you sure you want to delete %POST_TITLE%?', 'newspaper'),
                '%POST_TITLE% has been moved to trash.' => __('%POST_TITLE% has been moved to trash.', 'newspaper'),
                'You do not hold the required privileges to execute this request.' => __('You do not hold the required privileges to execute this request.', 'newspaper'),
                'No search results.' => __('No search results.', 'newspaper'),

                // Modals
                'Yes' => __('Yes', 'newspaper'),
                'No' => __('No', 'newspaper'),
                'Save' => __('Save', 'newspaper'),

                //Location form
                'Search for a location' => __('Search for a location', 'newspaper'),
                'Address line' => __('Address line', 'newspaper'),
                '(Optional)' => __('(Optional)', 'newspaper'),
                'City' => __('City', 'newspaper'),
                'State' => __('State', 'newspaper'),
                'Country' => __('Country', 'newspaper'),

                // Form taxonomies
                'Create new term' => __('Create new term', 'newspaper'),
                'Parent' => __('Parent', 'newspaper'),
                'Description' => __('Description', 'newspaper'),

                // Delete bookmarks button
                'Delete bookmarks' => __('Delete bookmarks', 'newspaper'),
            );
		}, 11 );

    }


    /**
     * This array is used to add the custom_title and custom_url of the block, it also loads the atts from the current global td_block_template
     * on visual composer we remove the block_template_id att in the UI @see td_vc_edit_form_fields_after_render
     * @return array
     */
    static function get_map_block_general_array() {
        $map_block_general_array = array();

        $map_block_general_array[] = array(
            "param_name" => "separator",
            "type"       => "text_separator",
            'heading'    => 'Header settings',
            "value"      => "",
            "class"      => "",
        );
        $map_block_general_array[] = array(
            "param_name" => "custom_title",
            "type" => "textfield",
            "value" => "",
            "heading" => 'Custom title:',
            "description" => "Optional - a title for this block, if you leave it blank the block will not have a title",
            "holder" => "div",
            "class" => "tdc-textfield-extrabig",
            "info_img" => "https://cloud.tagdiv.com/help/custom_title.png",
//	        'live' => 1,
        );
        $map_block_general_array[] = array(
            "param_name" => "custom_url",
            "type" => "textfield",
            "value" => "",
            "heading" => 'Title url:',
            "description" => "Optional - a custom url when the block title is clicked",
            "holder" => "div",
            "class" => "tdc-textfield-extrabig",
        );
        $map_block_general_array[] = array(
            "param_name" => "separator",
            "type"       => "horizontal_separator",
            "value"      => "",
            "class"      => "tdc-separator-small",
        );
        $map_block_general_array[] = array(
            "param_name" => "block_template_id",
            "type" => "dropdown",
            "value" => td_util::get_block_template_ids(),
            "heading" => 'Header template:',
            "description" => "Header template used by the current block",
            "holder" => "div",
            "class" => "tdc-dropdown-big",
            "info_img" => "https://cloud.tagdiv.com/help/header_template.png",
        );

        return $map_block_general_array;
    }


    /**
     * the filter array (used by blocks and by the loop filters)
     * @return array
     */
    static function get_map_filter_array ($group = 'Filter', $show_locked_only = false, $block_class = '') {

		// sorting options
		$sorting_options_array = array (
			'- Latest -' => '',
			'Oldest posts' => 'oldest_posts',
			'Modified date' => 'modified_date',
			'Alphabetical A -> Z' => 'alphabetical_order',
			'Popular (all time)' => 'popular',
			'Popular (jetpack + stats module required) Does not work with other settings/pagination' => 'jetpack_popular_2',
			'Featured' => 'featured',
			'Highest rated (reviews)' => 'review_high',
			'Lowest rated (reviews)' => 'review_low',
            'Highest rated (user reviews)' => 'user_reviews_high',
            'Lowest rated (user reviews)' => 'user_reviews_low',
			'Random Posts' => 'random_posts',
			'Random posts Today' => 'random_today' ,
			'Random posts from last 7 Days' => 'random_7_day' ,
			'Most Commented' => 'comment_count'
		);

		// add the popular last 24/48 hours filter(sorting) option if it's enabled from panel
	    if ( td_util::get_option('tds_p_enable_7_days_count') === 'enabled' ) {
		    $sorting_options_array = td_util::array_insert_after(
				$sorting_options_array,
				'Popular (all time)',
				array(
					'Popular (last 24hrs)'   => 'popular1',
					'Popular (last 48hrs)'   => 'popular2',
					'Popular (last 3 days)'  => 'popular3',
					'Popular (last 7 days)'  => 'popular7',
				)
		    );
	    } else {
		    $sorting_options_array = td_util::array_insert_after(
			    $sorting_options_array,
			    'Popular (all time)',
			    array(
				    '-- Popular (last 7 days) - theme counter (enable from panel BLOCK SETTINGS -> 7 days post sorting ) --' => '__',
				    '-- Popular (last 24hrs) - theme counter (enable from panel BLOCK SETTINGS -> 7 days post sorting ) --' => '__',
				    '-- Popular (last 48hrs) - theme counter (enable from panel BLOCK SETTINGS -> 7 days post sorting ) --' => '__',
			    )
		    );
	    }

        $filter_array = array(
            array(
                "param_name" => "separator",
                "type"       => "text_separator",
                'heading'    => 'Filters',
                "value"      => "",
                "class"      => "",
                'group' => $group
            ),
            array(
                "param_name" => "post_ids",
                "type" => "textfield",
                "value" => '',
                "heading" => 'Post ID filter:',
                "description" => "Filter multiple posts by ID. Enter here the post IDs separated by commas (ex: 10,27,233). To exclude posts from this block add them with '-' (ex: -7, -16)",
                "holder" => "div",
                "class" => "tdc-textfield-big",
                'group' => $group
            ),
            array(
                "param_name" => "category_id",
                "type" => "dropdown",
                "value" => td_util::get_category2id_array(),
                "heading" => 'Category filter:',
                "description" => "A single category filter. If you want to filter multiple categories, use the 'Multiple taxonomies filter' and leave this to default",
                "holder" => "div",
                "class" => "tdc-dropdown-big",
                'group' => $group,
	            'toggle_enable_params' => 'category_id',
            ),
			array(
                "param_name" => "taxonomies",
                "type" => "textfield",
                "value" => '',
                "heading" => 'Single - Related from taxonomies:',
                "description" => "This option applies when using this block on single posts or custom post types cloud templates, you can use this option to display posts or cpts related with the viewed post(cpt) but only form the taxonomies slugs you set here. Enter here the post/cpts taxonomies slugs separated by commas ( for example for `movie` cpt you can enter the slugs for the `Actors` or `Genre` taxonomies: actors,genre ).",
                "holder" => "div",
                "class" => "tdc-textfield-big",
				'toggle_enabled_by' => 'category_id--_related_tax',
                'hide_on_page_loop' => true,
                'group' => $group
            ),
            array(
                "param_name" => "category_ids",
                "type" => "textfield",
                "value" => '',
                "heading" => 'Multiple terms filter:',
                "description" => "Filter from multiple taxonomies terms by term ID. Enter here the taxonomy term IDs separated by commas (ex: 13,23,18). To exclude, add the taxonomy term id with '-' (ex: -9, -10).\n Please note that in order to get accurate results when using terms IDs to filter from multiple taxonomies, you also need to use the post type filter to set all post types related to the taxonomies terms you've used.\n This filter also supports taxonomy names. For instance, to display posts from all taxonomy terms, simply add the tdtax_ prefix to the taxonomy slug (if movies is the taxonomy slug, you would use tdtax_movies).",
                "holder" => "div",
                "class" => "tdc-textfield-big",
                'group' => $group
            ),
            array(
                "param_name"  => "in_all_terms",
                "type"        => "checkbox",
                "value"       => '',
                "heading"     => "Posts(cpts) must belong to all terms",
                "description" => "Displayed posts(cpts) must belong to all taxonomies terms.",
                "holder"      => "div",
                "class"       => "",
                "group"       => $group,
            ),
            array(
                "param_name" => "tag_slug",
                "type" => "textfield",
                "value" => '',
                "heading" => 'Filter by tag slug:',
                "description" => "To filter multiple tag slugs, enter here the tag slugs separated by commas (ex: tag1,tag2,tag3). To exclude posts from specific tags use '-' before the slug (ex: -tag1,-tag2,-tag3)",
                "holder" => "div",
                "class" => "tdc-textfield-big",
                'group' => $group
            ),
            array(
                "param_name" => "autors_id",
                "type" => "textfield",
                "value" => '',
                "heading" => "Multiple authors filter:",
                "description" => "Filter multiple authors by ID. Enter here the author IDs separated by commas (ex: 13,23,18).",
                "holder" => "div",
                "class" => "tdc-textfield-big",
                'group' => $group
            ),
            array(
                "param_name" => "installed_post_types",
                "type" => "textfield",
                "value" =>  '',//tdUtil::create_array_installed_post_types(),
                "heading" => 'Post Type:',
                "description" => "Filter by post types. Usage: post, page, event - Write 1 or more post types delimited by commas",
                "holder" => "div",
                "class" => "tdc-textfield-big",
                'group' => $group
            ),
            array(
                "param_name" => "include_cf_posts",
                "type" => "textfield",
                "value" => '',
                "heading" => 'Include custom field:',
                "description" => "Include posts by specific Custom Field ( ACF true_false type ). If the CF meta value is true the post will be displayed on block.",
                "holder" => "div",
                'hide_on_page_loop' => true,
                "class" => "tdc-textfield-big",
                'group' => $group
            ),
            array(
                "param_name" => "exclude_cf_posts",
                "type" => "textfield",
                "value" => '',
                "heading" => 'Exclude custom field:',
                "description" => "Exclude posts by specific Custom Field ( ACF true_false type ). If the CF meta value is true the post will be excluded.",
                "holder" => "div",
                'hide_on_page_loop' => true,
                "class" => "tdc-textfield-big",
                'group' => $group
            ),
            array(
                "param_name" => "sort",
                "type" => "dropdown",
                "value" => $sorting_options_array,
                "heading" => 'Sort order:',
                "description" => "How to sort the posts. Please note that the Popular (last 24-48hrs & 7 days) options are affected by caching plugins and CDNs. For popular posts we recommend the jetpack (24-48hrs) method",
                "holder" => "div",
                "class" => "tdc-dropdown-big tdc-block-sort",
                'group' => $group,
                "options_to_disable" => ( !defined( 'TD_CLOUD_LIBRARY' ) ? 'user_reviews_high user_reviews_low' : '' ),
                "options_to_hide" => ( !defined( 'TD_POPULAR_3_DAYS_ENABLED' ) ? 'popular3' : '' )
            ),
            array(
                "param_name" => "popular_by_date",
                "type" => "checkbox",
                "value" => '',
                "heading" => 'Popular by date:',
                "description" => "Displays the most popular articles published in the last X days",
                "holder" => "div",
                "class" => "tdc-textfield-big tdc-block-sort-popular-by-day" . ( !defined( 'TD_POPULAR_BY_DATE_ENABLED' ) ? ' tdc-hidden' : '' ),
                'group' => $group
            ),
            array(
                "param_name" => "linked_posts",
                "type" => "dropdown",
                "value" => array(
                    '- Select option -' => '',
                    'Parent post' => 'parent',
                    'Child posts' => 'yes'
                ),
                "heading" => 'Posts linked to current article',
                "description" => "",
                "holder" => "div",
                "class" => "tdc-dropdown-big",
                'hide_on_page_loop' => true,
                'group' => $group
            ),
            array(
                "param_name"  => "favourite_only",
                "type"        => "checkbox",
                "value"       => '',
                "heading"     => "Show bookmark posts only",
                "description" => "",
                "holder"      => "div",
                "class"       => "",
                "info_img"    => "",
                'group'       => $group
            )

        );

        if( $show_locked_only ) {
	        $filter_array = apply_filters( 'td_composer_map_filter_array', $filter_array, $group );
        }

        $filter_array = array_merge(
            $filter_array,
            array(
                // these are added to the main group
                array(
                    "param_name" => "separator",
                    "type"       => "text_separator",
                    'heading'    => 'Extra',
                    "value"      => "",
                    "class"      => "",
                ),
                array(
                    "param_name" => "limit",
                    "type" => "textfield",
                    "value" => '5',
                    "heading" => 'Limit post number:',
                    "description" => "If the field is empty the limit post number will be the number from Wordpress settings -> Reading",
                    "holder" => "div",
                    "class" => "tdc-textfield-small",
                    "info_img" => "https://cloud.tagdiv.com/help/limit_post_number.png",
                ),
                array(
                    "param_name" => "offset",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => 'Offset posts:',
                    "description" => "Start the count with an offset. If you have a block that shows 5 posts before this one, you can make this one start from the 6'th post (by using offset 5)",
                    "holder" => "div",
                    "class" => "tdc-textfield-small",
                    "info_img" => "https://cloud.tagdiv.com/help/offset_posts.png",
                )
            )
        );

        if( !in_array( $block_class, array( 'td_flex_block_6', 'td_flex_block_mct' ) ) ) {
            $filter_array = array_merge(
                $filter_array,
                array(
                    array(
                        "param_name" => "separator",
                        "type" => "horizontal_separator",
                        "value" => "",
                        "class" => "tdc-separator-small",
                        "group" => '',
                    ),
                    array(
                        "param_name" => "open_in_new_window",
                        "type" => "checkbox",
                        "value" => '',
                        "heading" => "Open posts in new tab",
                        "description" => "The posts will be opened in a new tab. This option adds target blank on image thumb and post title links.",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "separator",
                        "type" => "horizontal_separator",
                        "value" => "",
                        "class" => "tdc-separator-small",
                        "group" => '',
                    ),
                    array(
                        "param_name"  => "show_modified_date",
                        "type"        => "checkbox",
                        "value"       => '',
                        "heading"     => "Show modified date",
                        "description" => "Show last modified date of the article instead of published date",
                        "holder"      => "div",
                        "class"       => "",
                        "info_img" => "https://cloud.tagdiv.com/help/show_modified_date.png",
                    ),
                    array(
                        "param_name" => "time_ago",
                        "type" => "checkbox",
                        "value" => '',
                        "heading" => 'Enable time ago',
                        "description" => "Applicable only for posts newer than 7 days",
                        "holder" => "div",
                        "class" => "",
                        "info_img" => "https://cloud.tagdiv.com/help/module_time_ago.png",
                    ),
                    array(
                        "param_name" => "time_ago_add_txt",
                        "type" => "textfield",
                        "value" => 'ago',
                        "heading" => 'Time ago add. text',
                        "description" => "",
                        "placeholder" => "",
                        "holder" => "div",
                        'hide_on_page_loop' => true,
                        "class" => "tdc-textfield-big",
                        "info_img" => "https://cloud.tagdiv.com/help/module_ago_text.png",
                    ),
                    array(
                        "param_name" => "time_ago_txt_pos",
                        "type" => "checkbox",
                        "value" => '',
                        "heading" => 'Display additional text before the date',
                        "description" => "",
                        "holder" => "div",
                        "class" => "",
                        "info_img" => "",
                    ),
                    array(
                        "param_name" => "separator",
                        "type" => "horizontal_separator",
                        "value" => "",
                        "class" => "tdc-separator-small",
                        "group" => '',
                    ),
                    array(
                        "param_name"  => "review_source",
                        "type"        => "dropdown",
                        "value"       => array(
                            'Author review' => '',
                            'User reviews' => 'user_reviews',
                        ),
                        "heading"     => 'Reviews source',
                        "description" => "",
                        "holder"      => "div",
                        'hide_on_page_loop' => true,
                        "class"       => "tdc-dropdown-big",
                        "group"       => "",
                    )
                )
            );
        }

        $filter_array = array_merge(
            $filter_array,
            array(
                array(
                    "param_name" => "separator",
                    "type" => "horizontal_separator",
                    "value" => "",
                    "class" => "tdc-separator-small",
                    "group" => '',
                ),
                array(
                    'param_name' => 'el_class',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Extra class',
                    'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS',
                    'class' => 'tdc-textfield-extrabig',
                )
            )
        );

        return $filter_array;
    } // end get_map function


	static function get_map_block_ajax_filter_array() {

        return array(
            array(
                "param_name" => "separator",
                "type"       => "text_separator",
                'heading'    => 'Ajax categories dropdown',
                "value"      => "",
                "class"      => "",
                'group' =>  'Filter'
            ),
            // custom filter types
            array(
                "param_name" => "td_ajax_filter_type", // this is used to build the filter list (for example a list of categories from the id-s bellow)
                "type" => "dropdown",
                "value" => array('- No drop down ajax filter -' => '', 'Filter by categories' => 'td_category_ids_filter', 'Filter by taxonomies' => 'td_taxonomy_ids_filter', 'Filter by authors' => 'td_author_ids_filter', 'Filter by tag IDs' => 'td_tag_slug_filter', 'Filter by popularity (Featured | All time popular)' => 'td_popularity_filter_fa'),
                "heading" => 'Filter type:',
                "description" => "Show the ajax drop down filter. The ajax filters (except by popularity) require an additional parameter. If no ids are provided in the input below, the filter will show all the available items (ex: all authors, all categories etc..)",
                "holder" => "div",
                "class" => "tdc-dropdown-big",
                'group' =>  'Filter'
            ),

            // filter by ids
            array(
                "param_name" => "td_ajax_filter_ids", // the ids that we will show in the list
                "type" => "textfield",
                "value" => '',
                "heading" => 'Show the following IDs:',
                "description" => "The ajax drop down shows only the (author ids, categories ids OR tag IDs) that you enter here separated by comas",
                "holder" => "div",
                "class" => "tdc-textfield-big",
                'group' =>  'Filter'
            ),

            // default pull down text
            array(
                "param_name" => "td_filter_default_txt",
                "type" => "textfield",
                "value" => 'All',
                "heading" => 'Filter dropdown text:',
                "description" => "The default text for the first item from the drop down. The first item shows the default block settings (the settings from the Filter tab)",
                "holder" => "div",
                "class" => "tdc-textfield-big",
                'group' =>  'Filter'
            ),

            array(
                "param_name" => "td_ajax_preloading",  // preloader settings
                "type" => "dropdown",
                "value" => array('- No preloading -' => '', 'Optimized preloading' => 'preload', 'Preload all' => 'preload_all'),
                "heading" => 'Content preloading:',
                "description" => "The content that is displayed when a user clicks on an ajax filter from the dropdown is preloaded on each pageview. WARNING: This feature consumes more resources on the server.",
                "holder" => "div",
                "class" => "tdc-dropdown-big",
                'group' =>  'Filter'
            ),
        );

    }


    static function get_map_exclusive_label_array($index = '', $sep_small = false, $group = 'Layout') {

        $label_array = array();

        $label_array = apply_filters( 'td_composer_map_exclusive_label_array', $label_array, $index, $sep_small, $group );

        return $label_array;

    }


    static function get_map_block_pagination_array($module_class = '') {
        $block_pagination_array = array (
            array(
                "param_name" => "separator",
                "type"       => "text_separator",
                'heading'    => 'Extra',
                "value"      => "",
                "class"      => "",
                'group' => 'Filter'
            ),
            array(
                "param_name" => "ajax_pagination",
                "type" => "dropdown",
                "value" => array('- No pagination -' => '', 'Next Prev ajax' => 'next_prev', 'Load More button' => 'load_more', 'Infinite load' => 'infinite'),
                "heading" => 'Pagination:',
                "description" => "Our blocks support pagination.",
                "holder" => "div",
                "class" => "tdc-dropdown-big",
                'group' => 'Filter',
                "info_img" => "https://cloud.tagdiv.com/help/module_pagination.png",
            ),
            array(
                "param_name"  => "ajax_pagination_next_prev_swipe",
                "type"        => "checkbox",
                "value"       => '',
                "heading"     => "Next Prev swipe",
                "description" => "ONLY FOR NEXT PREV pagination: Adds the ability for the user to slide to the left or right to load more posts",
                "holder"      => "div",
                "class"       => "",
                "group"       => 'Filter',
            ),

            array(
                "param_name" => "ajax_pagination_infinite_stop",
                "type" => "textfield",
                "value" => '',
                "heading" => "Infinite load show 'Load more' after x pages:",
                "description" => "ONLY FOR INFINITE LOAD pagination: Shows 'load more' button after x number of pages. Leave this blank to load posts forever when infinite load is set for ajax pagination",
                "holder" => "div",
                "class" => "tdc-textfield-big",
                'group' => 'Filter'
            ),

        );

        if( !in_array( $module_class, array( 'td_flex_block_mct' ) ) ) {
            $block_pagination_array = array_merge($block_pagination_array,
                array(
                    array (
                        'param_name' => 'css',
                        'value' => '',
                        'type' => 'css_editor',
                        'heading' => 'Css',
                        'group' => 'Design options',
                    ),
                    array (
                        'param_name' => 'tdc_css',
                        'value' => '',
                        'type' => 'tdc_css_editor',
                        'heading' => '',
                        'group' => 'Design options',
                    ),
                )
            );
        }

        if( in_array( $module_class, array( 'td_flex_block_6', 'td_flex_block_mct' ) ) ) {
            $block_pagination_array = array_merge($block_pagination_array,
                array(
                    array(
                        "param_name" => "separator",
                        "type" => "horizontal_separator",
                        "value" => "",
                        "class" => "tdc-separator-small",
                        "group" => 'Filter',
                    ),
                    array(
                        "param_name" => "pag_space",
                        "type" => "textfield-responsive",
                        "value" => '',
                        "heading" => 'Top space',
                        "description" => "",
                        "placeholder" => "20",
                        "holder" => "div",
                        "class" => "tdc-textfield-small",
                        'group'      => 'Filter',
                        "info_img" => "https://cloud.tagdiv.com/help/module_pagination_space.png",
                    ),
                    array(
                        "param_name"  => "pag_padding",
                        "type"        => "textfield-responsive",
                        "value"       => '',
                        "heading"     => 'Padding',
                        "description" => "",
                        "holder"      => "div",
                        "class"       => "tdc-textfield-big",
                        "placeholder" => "",
                        "group"       => "Filter",
                        "info_img" => "https://cloud.tagdiv.com/help/module_pagination_padding.png",
                    ),
                    array(
                        "param_name"  => "pag_border_width",
                        "type"        => "textfield-responsive",
                        "value"       => '',
                        "heading"     => 'Border width',
                        "description" => "",
                        "holder"      => "div",
                        "class"       => "tdc-textfield-small",
                        "placeholder" => "1",
                        "group"       => "Filter",
                        "info_img" => "https://cloud.tagdiv.com/help/module_pagination_border.png",
                    ),
                    array(
                        "param_name"  => "pag_border_radius",
                        "type"        => "textfield-responsive",
                        "value"       => '',
                        "heading"     => 'Border radius',
                        "description" => "",
                        "holder"      => "div",
                        "class"       => "tdc-textfield-small",
                        "placeholder" => "0",
                        "group"       => "Filter",
                        "info_img" => "https://cloud.tagdiv.com/help/module_pagination_border_radius.png",
                    ),
                    array(
                        "param_name" => "separator",
                        "type" => "horizontal_separator",
                        "value" => "",
                        "class" => "tdc-separator-small",
                        "group" => 'Filter',
                    ),
                    array(
                        'param_name' => 'prev_tdicon',
                        'type' => 'icon',
                        'heading' => 'Prev icon',
                        'class' => 'tdc-textfield-small',
                        'value' => '',
                        "group"       => 'Filter',
                        "info_img" => "https://cloud.tagdiv.com/help/module_pagination_arrow.png",
                    ),
                    array(
                        'param_name' => 'next_tdicon',
                        'type' => 'icon',
                        'heading' => 'Next icon',
                        'class' => 'tdc-textfield-small',
                        'value' => '',
                        "group"       => 'Filter',
                        "info_img" => "https://cloud.tagdiv.com/help/module_pagination_arrow.png",
                    ),
                    array(
                        "param_name"  => "pag_icons_size",
                        "type"        => "textfield-responsive",
                        "value"       => '',
                        "heading"     => 'Icons size',
                        "description" => "",
                        "holder"      => "div",
                        "class"       => "tdc-textfield-small",
                        "placeholder" => "",
                        "group"       => "Filter",
                        "info_img" => "https://cloud.tagdiv.com/help/module_pagination_arrow_size.png",
                    ),
                    array(
                        "param_name" => "separator",
                        "type"       => "text_separator",
                        'heading'    => 'Style',
                        "value"      => "",
                        "class"      => "tdc-separator-small",
                        'group' => 'Filter'
                    ),
                    array(
                        "type"        => "colorpicker",
                        "holder"      => "div",
                        "class"       => "td-colorpicker-double-a",
                        "heading"     => 'Text color',
                        "param_name"  => "pag_text",
                        "value"       => '',
                        "description" => '',
                        "group"       => 'Filter',
                        "info_img" => "https://cloud.tagdiv.com/help/module_pagination_color_text.png",
                    ),
                    array(
                        "type"        => "colorpicker",
                        "holder"      => "div",
                        "class"       => "td-colorpicker-double-b",
                        "heading"     => 'Text hover color',
                        "param_name"  => "pag_h_text",
                        "value"       => '',
                        "description" => '',
                        "group"       => 'Filter',
                    ),
                    array(
                        "type"        => "colorpicker",
                        "holder"      => "div",
                        "class"       => "td-colorpicker-double-a",
                        "heading"     => 'Background color',
                        "param_name"  => "pag_bg",
                        "value"       => '',
                        "description" => '',
                        "group"       => 'Filter',
                        "info_img" => "https://cloud.tagdiv.com/help/module_pagination_color_bg.png",
                    ),
                    array(
                        "type"        => "colorpicker",
                        "holder"      => "div",
                        "class"       => "td-colorpicker-double-b",
                        "heading"     => 'Background hover color',
                        "param_name"  => "pag_h_bg",
                        "value"       => '',
                        "description" => '',
                        "group"       => 'Filter',
                    ),
                    array(
                        "type"        => "colorpicker",
                        "holder"      => "div",
                        "class"       => "td-colorpicker-double-a",
                        "heading"     => 'Border color',
                        "param_name"  => "pag_border",
                        "value"       => '',
                        "description" => '',
                        "group"       => 'Filter',
                        "info_img" => "https://cloud.tagdiv.com/help/module_pagination_color_border.png",
                    ),
                    array(
                        "type"        => "colorpicker",
                        "holder"      => "div",
                        "class"       => "td-colorpicker-double-b",
                        "heading"     => 'Border hover color',
                        "param_name"  => "pag_h_border",
                        "value"       => '',
                        "description" => '',
                        "group"       => 'Filter',
                    ),
                    array(
                        "param_name" => "separator",
                        "type" => "horizontal_separator",
                        "value" => "",
                        "class" => "tdc-separator-small",
                        "group" => 'Filter',
                    ),
                ),
                td_config_helper::get_map_block_font_array( 'f_pag', false, 'Pagination text', 'Filter', '', '', 'https://cloud.tagdiv.com/help/module_font_load_more.png', '' )
            );
        }

        return $block_pagination_array;
    }


    // example copy/paste custom for components
    static function get_list_style_params() {
    	return array(
    	    'Title' => array(
                'td_flex_block_1' => array(
                    'art_title',
                    'f_title_font_family',
                    array(
                        'f_title_font_size',
                        '',
                    ),
                    array(
                        'f_title_font_line_height',
                        ''
                    ),
                    'f_title_font_style',
                    'f_title_font_weight',
                    'f_title_font_transform',
                    array(
                        'f_title_font_spacing',
                        ''
                    ),
                    'title_txt',
                    'title_txt_hover',
                    'all_underline_color',
                    'all_underline_height'
                ),
                'td_flex_block_2' => array(
                    'art_title',
                    'f_title_font_family',
                    array(
                        'f_title_font_size',
                        '',
                    ),
                    array(
                        'f_title_font_line_height',
                        ''
                    ),
                    'f_title_font_style',
                    'f_title_font_weight',
                    'f_title_font_transform',
                    array(
                        'f_title_font_spacing',
                        ''
                    ),
                    'title_txt',
                    'title_txt_hover',
                    'all_underline_color',
                    'all_underline_height'
                ),
                'td_flex_block_3' => array(
                    array(
                        'art_title1',
                        'art_title2'
                    ),
                    array(
                        'f_title1_font_family',
                        'f_title2_font_family'
                    ),
                    array(
                        'f_title1_font_size',
                        'f_title2_font_size',
                    ),
                    array(
                        'f_title1_font_line_height',
                        'f_title2_font_line_height',
                    ),
                    array(
                        'f_title1_font_style',
                        'f_title2_font_style'
                    ),
                    array(
                        'f_title1_font_weight',
                        'f_title2_font_weight'
                    ),
                    array(
                        'f_title1_font_transform',
                        'f_title2_font_transform'
                    ),
                    array(
                        'f_title1_font_spacing',
                        'f_title2_font_spacing'
                    ),
                    'title_txt',
                    'title_txt_hover',
                    'all_underline_color',
                    array(
                        'all_underline_height1',
                        'all_underline_height2'
                    )
                ),
                'td_flex_block_4' => array(
                    array(
                        'art_title1',
                        'art_title2'
                    ),
                    array(
                        'f_title1_font_family',
                        'f_title2_font_family'
                    ),
                    array(
                        'f_title1_font_size',
                        'f_title2_font_size',
                    ),
                    array(
                        'f_title1_font_line_height',
                        'f_title2_font_line_height',
                    ),
                    array(
                        'f_title1_font_style',
                        'f_title2_font_style'
                    ),
                    array(
                        'f_title1_font_weight',
                        'f_title2_font_weight'
                    ),
                    array(
                        'f_title1_font_transform',
                        'f_title2_font_transform'
                    ),
                    array(
                        'f_title1_font_spacing',
                        'f_title2_font_spacing'
                    ),
                    array(
                        'title_txt',
                        'title_txt2'
                    ),
                    array(
                        'title_txt_hover',
                        'title_txt_hover2'
                    ),
                    array(
                        'all_underline_color1',
                        'all_underline_color2'
                    ),
                    array(
                        'all_underline_height1',
                        'all_underline_height2'
                    )
                ),
                'td_flex_block_5' => array(
                    'art_title',
                    'f_title_font_family',
                    array(
                        'f_title_font_size',
                        '',
                    ),
                    array(
                        'f_title_font_line_height',
                        ''
                    ),
                    'f_title_font_style',
                    'f_title_font_weight',
                    'f_title_font_transform',
                    array(
                        'f_title_font_spacing',
                        ''
                    ),
                    'title_txt',
                    'title_txt_hover',
                    'all_underline_color',
                    'all_underline_height'
                ),
                'tdb_header_menu' => array(
                    'art_title',
                    'f_title_font_family',
                    array(
                        'f_title_font_size',
                        '',
                    ),
                    array(
                        'f_title_font_line_height',
                        ''
                    ),
                    'f_title_font_style',
                    'f_title_font_weight',
                    'f_title_font_transform',
                    array(
                        'f_title_font_spacing',
                        ''
                    ),
                    'title_txt',
                    'title_txt_hover',
                    'all_underline_color',
                    'all_underline_height'
                ),
                'tdb_header_search' => array(
                    'art_title',
                    'f_title_font_family',
                    array(
                        'f_title_font_size',
                        '',
                    ),
                    array(
                        'f_title_font_line_height',
                        ''
                    ),
                    'f_title_font_style',
                    'f_title_font_weight',
                    'f_title_font_transform',
                    array(
                        'f_title_font_spacing',
                        ''
                    ),
                    'title_txt',
                    'title_txt_hover',
                    'all_underline_color',
                    'all_underline_height'
                ),
                'tdb_loop' => array(
                    'art_title',
                    'f_title_font_family',
                    array(
                        'f_title_font_size',
                        '',
                    ),
                    array(
                        'f_title_font_line_height',
                        ''
                    ),
                    'f_title_font_style',
                    'f_title_font_weight',
                    'f_title_font_transform',
                    array(
                        'f_title_font_spacing',
                        ''
                    ),
                    'title_txt',
                    'title_txt_hover',
                    'all_underline_color',
                    'all_underline_height'
                ),
                'tdb_loop_2' => array(
                    'art_title',
                    'f_title_font_family',
                    array(
                        'f_title_font_size',
                        '',
                    ),
                    array(
                        'f_title_font_line_height',
                        ''
                    ),
                    'f_title_font_style',
                    'f_title_font_weight',
                    'f_title_font_transform',
                    array(
                        'f_title_font_spacing',
                        ''
                    ),
                    'title_txt',
                    'title_txt_hover',
                    'all_underline_color',
                    'all_underline_height'
                ),
                'tdb_single_related' => array(
                    'art_title',
                    'f_title_font_family',
                    array(
                        'f_title_font_size',
                        '',
                    ),
                    array(
                        'f_title_font_line_height',
                        ''
                    ),
                    'f_title_font_style',
                    'f_title_font_weight',
                    'f_title_font_transform',
                    array(
                        'f_title_font_spacing',
                        ''
                    ),
                    'title_txt',
                    'title_txt_hover',
                    'all_underline_color',
                    'all_underline_height'
                ),
                'tdb_single_related_author' => array(
                    'art_title',
                    'f_title_font_family',
                    array(
                        'f_title_font_size',
                        '',
                    ),
                    array(
                        'f_title_font_line_height',
                        ''
                    ),
                    'f_title_font_style',
                    'f_title_font_weight',
                    'f_title_font_transform',
                    array(
                        'f_title_font_spacing',
                        ''
                    ),
                    'title_txt',
                    'title_txt_hover',
                    '',
                    ''
                )
            ),
            'Image' => array(
                'td_flex_block_1' => array(
                    array(
                        'image_alignment',
                        ''
                    ),
                    array(
                        'image_height',
                        ''
                    ),
                    array(
                        'image_radius',
                        ''
                    ),
                    array(
                        'video_icon',
                        ''
                    ),
                    '',
                    '',
                    '',
                    ''
                ),
                'td_flex_block_2' => array(
                    array(
                        'image_alignment',
                        ''
                    ),
                    '',
                    array(
                        'image_radius',
                        ''
                    ),
                    array(
                        'video_icon',
                        ''
                    ),
                    'video_icon_pos',
                    'image_margin',
                    'image_margin_right',
                    'image_margin_forced'
                ),
                'td_flex_block_3' => array(
                    array(
                        'image_alignment1',
                        'image_alignment2',
                    ),
                    array(
                        'image_height1',
                        'image_height2',
                    ),
                    array(
                        'image_radius1',
                        'image_radius2',
                    ),
                    array(
                        'video_icon1',
                        'video_icon2',
                    ),
                    '',
                    '',
                    '',
                    ''
                ),
                'td_flex_block_4' => array(
                    array(
                        'image_alignment1',
                        'image_alignment2',
                    ),
                    array(
                        'image_height1',
                        'image_height2',
                    ),
                    array(
                        'image_radius1',
                        'image_radius2',
                    ),
                    array(
                        'video_icon1',
                        'video_icon2',
                    ),
                    array(
                        'video_icon_pos1',
                        ''
                    ),
                    '',
                    '',
                    ''
                ),
                'td_flex_block_5' => array(
                    array(
                        'image_alignment',
                        ''
                    ),
                    array(
                        'image_height',
                        ''
                    ),
                    array(
                        'image_radius',
                        ''
                    ),
                    array(
                        'video_icon',
                        ''
                    ),
                    '',
                    '',
                    '',
                    ''
                ),
                'tdb_header_menu' => array(
                    array(
                        'image_alignment',
                        ''
                    ),
                    array(
                        'image_height',
                        ''
                    ),
                    array(
                        'image_radius',
                        ''
                    ),
                    array(
                        'video_icon',
                        ''
                    ),
                    '',
                    '',
                    '',
                    ''
                ),
                'tdb_header_search' => array(
                    array(
                        'image_alignment',
                        ''
                    ),
                    array(
                        'image_height',
                        ''
                    ),
                    array(
                        'image_radius',
                        ''
                    ),
                    array(
                        'video_icon',
                        ''
                    ),
                    '',
                    '',
                    '',
                    ''
                ),
                'tdb_loop' => array(
                    '',
                    array(
                        'image_height',
                        ''
                    ),
                    array(
                        'image_radius',
                        ''
                    ),
                    array(
                        'video_icon',
                        ''
                    ),
                    '',
                    '',
                    '',
                    ''
                ),
                'tdb_loop_2' => array(
                    array(
                        'image_alignment',
                        ''
                    ),
                    array(
                        'image_height',
                        ''
                    ),
                    array(
                        'image_radius',
                        ''
                    ),
                    array(
                        'video_icon',
                        ''
                    ),
                    '',
                    '',
                    '',
                    ''
                ),
                'tdb_single_related' => array(
                    array(
                        'image_alignment',
                        ''
                    ),
                    array(
                        'image_height',
                        ''
                    ),
                    array(
                        'image_radius',
                        ''
                    ),
                    array(
                        'video_icon',
                        ''
                    ),
                    '',
                    '',
                    '',
                    ''
                ),
                'tdb_single_related_author' => array(
                    array(
                        'image_alignment',
                        ''
                    ),
                    array(
                        'image_height',
                        ''
                    ),
                    array(
                        'image_radius',
                        ''
                    ),
                    array(
                        'video_icon',
                        ''
                    ),
                    '',
                    '',
                    '',
                    ''
                )
            ),
            'Category tag' => array(
                'td_flex_block_1' => array(
                    'modules_category',
                    'modules_category_margin',
                    'modules_category_padding',
                    'modules_cat_border',
                    'modules_category_radius',
                    'f_cat_font_family',
                    'f_cat_font_size',
                    'f_cat_font_line_height',
                    'f_cat_font_style',
                    'f_cat_font_weight',
                    'f_cat_font_transform',
                    'f_cat_font_spacing',
                    'cat_bg',
                    'cat_bg_hover',
                    'cat_txt',
                    'cat_txt_hover',
                    'cat_border',
                    'cat_border_hover'
                ),
                'td_flex_block_2' => array(
                    'modules_category',
                    'modules_category_margin',
                    'modules_category_padding',
                    'modules_cat_border',
                    'modules_category_radius',
                    'f_cat_font_family',
                    'f_cat_font_size',
                    'f_cat_font_line_height',
                    'f_cat_font_style',
                    'f_cat_font_weight',
                    'f_cat_font_transform',
                    'f_cat_font_spacing',
                    'cat_bg',
                    'cat_bg_hover',
                    'cat_txt',
                    'cat_txt_hover',
                    'cat_border',
                    'cat_border_hover'
                ),
                'td_flex_block_3' => array(
                    array(
                        'modules_category',
                        'modules_category2'
                    ),
                    array(
                        'modules_category_margin1',
                        'modules_category_margin2'
                    ),
                    array(
                        'modules_category_padding1',
                        'modules_category_padding2'
                    ),
                    array(
                        'modules_cat_border1',
                        'modules_cat_border2'
                    ),
                    array(
                        'modules_category_radius1',
                        'modules_category_radius2'
                    ),
                    array(
                        'f_cat1_font_family',
                        'f_cat2_font_family',
                    ),
                    array(
                        'f_cat1_font_size',
                        'f_cat2_font_size',
                    ),
                    array(
                        'f_cat1_font_line_height',
                        'f_cat2_font_line_height',
                    ),
                    array(
                        'f_cat1_font_style',
                        'f_cat2_font_style',
                    ),
                    array(
                        'f_cat1_font_weight',
                        'f_cat2_font_weight',
                    ),
                    array(
                        'f_cat1_font_transform',
                        'f_cat2_font_transform',
                    ),
                    array(
                        'f_cat1_font_spacing',
                        'f_cat2_font_spacing',
                    ),
                    'cat_bg',
                    'cat_bg_hover',
                    'cat_txt',
                    'cat_txt_hover',
                    'cat_border',
                    'cat_border_hover'
                ),
                'td_flex_block_4' => array(
                    array(
                        'modules_category',
                        'modules_category3'
                    ),
                    array(
                        'modules_category_margin1',
                        'modules_category_margin2'
                    ),
                    array(
                        'modules_category_padding1',
                        'modules_category_padding2'
                    ),
                    array(
                        'modules_cat_border1',
                        'modules_cat_border2'
                    ),
                    array(
                        'modules_category_radius1',
                        'modules_category_radius2'
                    ),
                    array(
                        'f_cat1_font_family',
                        'f_cat2_font_family',
                    ),
                    array(
                        'f_cat1_font_size',
                        'f_cat2_font_size',
                    ),
                    array(
                        'f_cat1_font_line_height',
                        'f_cat2_font_line_height',
                    ),
                    array(
                        'f_cat1_font_style',
                        'f_cat2_font_style',
                    ),
                    array(
                        'f_cat1_font_weight',
                        'f_cat2_font_weight',
                    ),
                    array(
                        'f_cat1_font_transform',
                        'f_cat2_font_transform',
                    ),
                    array(
                        'f_cat1_font_spacing',
                        'f_cat2_font_spacing',
                    ),
                    array(
                        'cat_bg',
                        'cat_bg2',
                    ),
                    array(
                        'cat_bg_hover',
                        'cat_bg_hover2',
                    ),
                    array(
                        'cat_txt',
                        'cat_txt2',
                    ),
                    array(
                        'cat_txt_hover',
                        'cat_txt_hover2',
                    ),
                    array(
                        'cat_border1',
                        'cat_border2',
                    ),
                    array(
                        'cat_border_hover1',
                        'cat_border_hover2'
                    )
                ),
                'td_flex_block_5' => array(
                    'modules_category',
                    'modules_category_margin',
                    'modules_category_padding',
                    'modules_cat_border',
                    'modules_category_radius',
                    'f_cat_font_family',
                    'f_cat_font_size',
                    'f_cat_font_line_height',
                    'f_cat_font_style',
                    'f_cat_font_weight',
                    'f_cat_font_transform',
                    'f_cat_font_spacing',
                    'cat_bg',
                    'cat_bg_hover',
                    'cat_txt',
                    'cat_txt_hover',
                    'cat_border',
                    'cat_border_hover'
                ),
                'tdb_header_menu' => array(
                    'modules_category',
                    'modules_category_margin',
                    'modules_category_padding',
                    'modules_cat_border',
                    'modules_category_radius',
                    'f_cat_font_family',
                    'f_cat_font_size',
                    'f_cat_font_line_height',
                    'f_cat_font_style',
                    'f_cat_font_weight',
                    'f_cat_font_transform',
                    'f_cat_font_spacing',
                    'cat_bg',
                    'cat_bg_hover',
                    'cat_txt',
                    'cat_txt_hover',
                    'cat_border',
                    'cat_border_hover'
                ),
                'tdb_header_search' => array(
                    'modules_category',
                    'modules_category_margin',
                    'modules_category_padding',
                    'modules_cat_border',
                    'modules_category_radius',
                    'f_cat_font_family',
                    'f_cat_font_size',
                    'f_cat_font_line_height',
                    'f_cat_font_style',
                    'f_cat_font_weight',
                    'f_cat_font_transform',
                    'f_cat_font_spacing',
                    'cat_bg',
                    'cat_bg_hover',
                    'cat_txt',
                    'cat_txt_hover',
                    'cat_border',
                    'cat_border_hover'
                ),
                'tdb_loop' => array(
                    'modules_category',
                    'modules_category_margin',
                    'modules_category_padding',
                    'modules_cat_border',
                    'modules_category_radius',
                    'f_cat_font_family',
                    'f_cat_font_size',
                    'f_cat_font_line_height',
                    'f_cat_font_style',
                    'f_cat_font_weight',
                    'f_cat_font_transform',
                    'f_cat_font_spacing',
                    'cat_bg',
                    'cat_bg_hover',
                    'cat_txt',
                    'cat_txt_hover',
                    'cat_border',
                    'cat_border_hover'
                ),
                'tdb_loop_2' => array(
                    'modules_category',
                    'modules_category_margin',
                    'modules_category_padding',
                    'modules_cat_border',
                    'modules_category_radius',
                    'f_cat_font_family',
                    'f_cat_font_size',
                    'f_cat_font_line_height',
                    'f_cat_font_style',
                    'f_cat_font_weight',
                    'f_cat_font_transform',
                    'f_cat_font_spacing',
                    'cat_bg',
                    'cat_bg_hover',
                    'cat_txt',
                    'cat_txt_hover',
                    'cat_border',
                    'cat_border_hover'
                ),
                'tdb_single_related' => array(
                    'modules_category',
                    'modules_category_margin',
                    'modules_category_padding',
                    'modules_cat_border',
                    'modules_category_radius',
                    'f_cat_font_family',
                    'f_cat_font_size',
                    'f_cat_font_line_height',
                    'f_cat_font_style',
                    'f_cat_font_weight',
                    'f_cat_font_transform',
                    'f_cat_font_spacing',
                    'cat_bg',
                    'cat_bg_hover',
                    'cat_txt',
                    'cat_txt_hover',
                    'cat_border',
                    'cat_border_hover'
                ),
                'tdb_single_related_author' => array(
                    'modules_category',
                    'modules_category_margin',
                    'modules_category_padding',
                    'modules_cat_border',
                    'modules_category_radius',
                    'f_cat_font_family',
                    'f_cat_font_size',
                    'f_cat_font_line_height',
                    'f_cat_font_style',
                    'f_cat_font_weight',
                    'f_cat_font_transform',
                    'f_cat_font_spacing',
                    'cat_bg',
                    'cat_bg_hover',
                    'cat_txt',
                    'cat_txt_hover',
                    'cat_border',
                    'cat_border_hover'
                )
            ),
            'Meta info' => array(
                'td_flex_block_1' => array(
                    'author_photo_size',
                    'author_photo_space',
                    'author_photo_radius',
                    'review_size',
                    'f_meta_font_family',
                    array(
                        'f_meta_font_size',
                        ''
                    ),
                    array(
                        'f_meta_font_line_height',
                        ''
                    ),
                    'f_meta_font_style',
                    'f_meta_font_weight',
                    'f_meta_font_transform',
                    array(
                        'f_meta_font_spacing',
                        ''
                    ),
                    'author_txt',
                    'author_txt_hover',
                    'date_txt',
                    'com_bg',
                    'com_txt',
                    'rev_txt'
                ),
                'td_flex_block_2' => array(
                    '',
                    '',
                    '',
                    'review_size',
                    'f_meta_font_family',
                    array(
                        'f_meta_font_size',
                        ''
                    ),
                    array(
                        'f_meta_font_line_height',
                        ''
                    ),
                    'f_meta_font_style',
                    'f_meta_font_weight',
                    'f_meta_font_transform',
                    array(
                        'f_meta_font_spacing',
                        ''
                    ),
                    'author_txt',
                    'author_txt_hover',
                    'date_txt',
                    'com_bg',
                    'com_txt',
                    ''
                ),
                'td_flex_block_3' => array(
                    array(
                        'author_photo_size1',
                        'author_photo_size2'
                    ),
                    array(
                        'author_photo_space1',
                        'author_photo_space2'
                    ),
                    array(
                        'author_photo_radius1',
                        'author_photo_radius2'
                    ),
                    array(
                        'review_size1',
                        'review_size2'
                    ),
                    array(
                        'f_meta1_font_family',
                        'f_meta2_font_family',
                    ),
                    array(
                        'f_meta1_font_size',
                        'f_meta2_font_size',
                    ),
                    array(
                        'f_meta1_font_line_height',
                        'f_meta2_font_line_height',
                    ),
                    array(
                        'f_meta1_font_style',
                        'f_meta2_font_style',
                    ),
                    array(
                        'f_meta1_font_weight',
                        'f_meta2_font_weight',
                    ),
                    array(
                        'f_meta1_font_transform',
                        'f_meta2_font_transform',
                    ),
                    array(
                        'f_meta1_font_spacing',
                        'f_meta2_font_spacing',
                    ),
                    'author_txt',
                    'author_txt_hover',
                    'date_txt',
                    'com_bg',
                    'com_txt',
                    ''
                ),
                'td_flex_block_4' => array(
                    array(
                        'author_photo_size1',
                        'author_photo_size2'
                    ),
                    array(
                        'author_photo_space1',
                        'author_photo_space2'
                    ),
                    array(
                        'author_photo_radius1',
                        'author_photo_radius2'
                    ),
                    array(
                        'review_size1',
                        'review_size2'
                    ),
                    array(
                        'f_meta1_font_family',
                        'f_meta2_font_family',
                    ),
                    array(
                        'f_meta1_font_size',
                        'f_meta2_font_size',
                    ),
                    array(
                        'f_meta1_font_line_height',
                        'f_meta2_font_line_height',
                    ),
                    array(
                        'f_meta1_font_style',
                        'f_meta2_font_style',
                    ),
                    array(
                        'f_meta1_font_weight',
                        'f_meta2_font_weight',
                    ),
                    array(
                        'f_meta1_font_transform',
                        'f_meta2_font_transform',
                    ),
                    array(
                        'f_meta1_font_spacing',
                        'f_meta2_font_spacing',
                    ),
                    array(
                        'author_txt',
                        'author_txt2',
                    ),
                    array(
                        'author_txt_hover',
                        'author_txt_hover2',
                    ),
                    array(
                        'date_txt',
                        'date_txt2',
                    ),
                    array(
                        'com_bg',
                        'com_bg2',
                    ),
                    array(
                        'com_txt',
                        'com_txt2'
                    ),
                    ''
                ),
                'td_flex_block_5' => array(
                    'author_photo_size',
                    'author_photo_space',
                    'author_photo_radius',
                    'review_size',
                    'f_meta_font_family',
                    array(
                        'f_meta_font_size',
                        ''
                    ),
                    array(
                        'f_meta_font_line_height',
                        ''
                    ),
                    'f_meta_font_style',
                    'f_meta_font_weight',
                    'f_meta_font_transform',
                    array(
                        'f_meta_font_spacing',
                        ''
                    ),
                    'author_txt',
                    'author_txt_hover',
                    'date_txt',
                    'com_bg',
                    'com_txt',
                    'rev_txt'
                ),
                'tdb_header_menu' => array(
                    'author_photo_size',
                    'author_photo_space',
                    'author_photo_radius',
                    'review_size',
                    'f_meta_font_family',
                    array(
                        'f_meta_font_size',
                        ''
                    ),
                    array(
                        'f_meta_font_line_height',
                        ''
                    ),
                    'f_meta_font_style',
                    'f_meta_font_weight',
                    'f_meta_font_transform',
                    array(
                        'f_meta_font_spacing',
                        ''
                    ),
                    'author_txt',
                    'author_txt_hover',
                    'date_txt',
                    'com_bg',
                    'com_txt',
                    'rev_txt'
                ),
                'tdb_header_search' => array(
                    'author_photo_size',
                    'author_photo_space',
                    'author_photo_radius',
                    'review_size',
                    'f_meta_font_family',
                    array(
                        'f_meta_font_size',
                        ''
                    ),
                    array(
                        'f_meta_font_line_height',
                        ''
                    ),
                    'f_meta_font_style',
                    'f_meta_font_weight',
                    'f_meta_font_transform',
                    array(
                        'f_meta_font_spacing',
                        ''
                    ),
                    'author_txt',
                    'author_txt_hover',
                    'date_txt',
                    'com_bg',
                    'com_txt',
                    'rev_txt'
                ),
                'tdb_loop' => array(
                    'author_photo_size',
                    'author_photo_space',
                    'author_photo_radius',
                    'review_size',
                    'f_meta_font_family',
                    array(
                        'f_meta_font_size',
                        ''
                    ),
                    array(
                        'f_meta_font_line_height',
                        ''
                    ),
                    'f_meta_font_style',
                    'f_meta_font_weight',
                    'f_meta_font_transform',
                    array(
                        'f_meta_font_spacing',
                        ''
                    ),
                    'author_txt',
                    'author_txt_hover',
                    'date_txt',
                    'com_bg',
                    'com_txt',
                    ''
                ),
                'tdb_loop_2' => array(
                    'author_photo_size',
                    'author_photo_space',
                    'author_photo_radius',
                    'review_size',
                    'f_meta_font_family',
                    array(
                        'f_meta_font_size',
                        ''
                    ),
                    array(
                        'f_meta_font_line_height',
                        ''
                    ),
                    'f_meta_font_style',
                    'f_meta_font_weight',
                    'f_meta_font_transform',
                    array(
                        'f_meta_font_spacing',
                        ''
                    ),
                    'author_txt',
                    'author_txt_hover',
                    'date_txt',
                    'com_bg',
                    'com_txt',
                    ''
                ),
                'tdb_single_related' => array(
                    'author_photo_size',
                    'author_photo_space',
                    'author_photo_radius',
                    '',
                    'f_meta_font_family',
                    array(
                        'f_meta_font_size',
                        ''
                    ),
                    array(
                        'f_meta_font_line_height',
                        ''
                    ),
                    'f_meta_font_style',
                    'f_meta_font_weight',
                    'f_meta_font_transform',
                    array(
                        'f_meta_font_spacing',
                        ''
                    ),
                    'author_txt',
                    'author_txt_hover',
                    'date_txt',
                    'com_bg',
                    'com_txt',
                    ''
                ),
                'tdb_single_related_author' => array(
                    'author_photo_size',
                    'author_photo_space',
                    'author_photo_radius',
                    '',
                    'f_meta_font_family',
                    array(
                        'f_meta_font_size',
                        ''
                    ),
                    array(
                        'f_meta_font_line_height',
                        ''
                    ),
                    'f_meta_font_style',
                    'f_meta_font_weight',
                    'f_meta_font_transform',
                    array(
                        'f_meta_font_spacing',
                        ''
                    ),
                    'author_txt',
                    'author_txt_hover',
                    'date_txt',
                    'com_bg',
                    'com_txt',
                    ''
                )
            ),
            'Excerpt' => array(
                'td_flex_block_1' => array(
                    'art_excerpt',
                    'f_ex_font_family',
                    array(
                        'f_ex_font_size',
                        '',
                    ),
                    array(
                        'f_ex_font_line_height',
                        '',
                    ),
                    'f_ex_font_style',
                    'f_ex_font_weight',
                    'f_ex_font_transform',
                    array(
                        'f_ex_font_spacing',
                        ''
                    ),
                    'ex_txt'
                ),
                'td_flex_block_2' => array(
                    'art_excerpt',
                    'f_ex_font_family',
                    array(
                        'f_ex_font_size',
                        '',
                    ),
                    array(
                        'f_ex_font_line_height',
                        '',
                    ),
                    'f_ex_font_style',
                    'f_ex_font_weight',
                    'f_ex_font_transform',
                    array(
                        'f_ex_font_spacing',
                        ''
                    ),
                    'ex_txt'
                ),
                'td_flex_block_3' => array(
                    'art_excerpt1',
                    'f_ex1_font_family',
                    array(
                        'f_ex1_font_size',
                        '',
                    ),
                    array(
                        'f_ex1_font_line_height',
                        '',
                    ),
                    'f_ex1_font_style',
                    'f_ex1_font_weight',
                    'f_ex1_font_transform',
                    array(
                        'f_ex1_font_spacing',
                        ''
                    ),
                    'ex_txt'
                ),
                'td_flex_block_4' => array(
                    array(
                        'art_excerpt1',
                        'art_excerpt2',
                    ),
                    array(
                        'f_ex1_font_family',
                        'f_ex2_font_family',
                    ),
                    array(
                        'f_ex1_font_size',
                        'f_ex2_font_size',
                    ),
                    array(
                        'f_ex1_font_line_height',
                        'f_ex2_font_line_height',
                    ),
                    array(
                        'f_ex1_font_style',
                        'f_ex2_font_style'
                    ),
                    array(
                        'f_ex1_font_weight',
                        'f_ex2_font_weight'
                    ),
                    array(
                        'f_ex1_font_transform',
                        'f_ex2_font_transform'
                    ),
                    array(
                        'f_ex1_font_spacing',
                        'f_ex2_font_spacing'
                    ),
                    array(
                        'ex_txt',
                        'ex_txt2'
                    )
                ),
                'td_flex_block_5' => array(
                    'art_excerpt',
                    'f_ex_font_family',
                    array(
                        'f_ex_font_size',
                        '',
                    ),
                    array(
                        'f_ex_font_line_height',
                        '',
                    ),
                    'f_ex_font_style',
                    'f_ex_font_weight',
                    'f_ex_font_transform',
                    array(
                        'f_ex_font_spacing',
                        ''
                    ),
                    'ex_txt'
                ),
                'tdb_header_menu' => array(
                    'art_excerpt',
                    'f_ex_font_family',
                    array(
                        'f_ex_font_size',
                        '',
                    ),
                    array(
                        'f_ex_font_line_height',
                        '',
                    ),
                    'f_ex_font_style',
                    'f_ex_font_weight',
                    'f_ex_font_transform',
                    array(
                        'f_ex_font_spacing',
                        ''
                    ),
                    'ex_txt'
                ),
                'tdb_header_search' => array(
                    'art_excerpt',
                    'f_ex_font_family',
                    array(
                        'f_ex_font_size',
                        '',
                    ),
                    array(
                        'f_ex_font_line_height',
                        '',
                    ),
                    'f_ex_font_style',
                    'f_ex_font_weight',
                    'f_ex_font_transform',
                    array(
                        'f_ex_font_spacing',
                        ''
                    ),
                    'ex_txt'
                ),
                'tdb_loop' => array(
                    'art_excerpt',
                    'f_ex_font_family',
                    array(
                        'f_ex_font_size',
                        '',
                    ),
                    array(
                        'f_ex_font_line_height',
                        '',
                    ),
                    'f_ex_font_style',
                    'f_ex_font_weight',
                    'f_ex_font_transform',
                    array(
                        'f_ex_font_spacing',
                        ''
                    ),
                    'ex_txt'
                ),
                'tdb_loop_2' => array(
                    'art_excerpt',
                    'f_ex_font_family',
                    array(
                        'f_ex_font_size',
                        '',
                    ),
                    array(
                        'f_ex_font_line_height',
                        '',
                    ),
                    'f_ex_font_style',
                    'f_ex_font_weight',
                    'f_ex_font_transform',
                    array(
                        'f_ex_font_spacing',
                        ''
                    ),
                    'ex_txt'
                ),
                'tdb_single_related' => array(
                    'art_excerpt',
                    'f_ex_font_family',
                    array(
                        'f_ex_font_size',
                        '',
                    ),
                    array(
                        'f_ex_font_line_height',
                        '',
                    ),
                    'f_ex_font_style',
                    'f_ex_font_weight',
                    'f_ex_font_transform',
                    array(
                        'f_ex_font_spacing',
                        ''
                    ),
                    'ex_txt'
                ),
                'tdb_single_related_author' => array(
                    'art_excerpt',
                    'f_ex_font_family',
                    array(
                        'f_ex_font_size',
                        '',
                    ),
                    array(
                        'f_ex_font_line_height',
                        '',
                    ),
                    'f_ex_font_style',
                    'f_ex_font_weight',
                    'f_ex_font_transform',
                    array(
                        'f_ex_font_spacing',
                        ''
                    ),
                    'ex_txt'
                )
            ),

            'to other types of images' => array(
                'vc_single_image' => array(
                    'overlay',
                    'video_bg',
                    'video_overlay',
                    'mix_color',
                    'mix_type',
                    'fe_brightness',
                    'fe_contrast',
                    'fe_saturate',
                    'mix_color_h',
                    'mix_type_h',
                    'fe_brightness_h',
                    'fe_contrast_h',
                    'fe_saturate_h'
                ),
                'tdm_block_inline_image' => array(
                    'overlay_color',
                    'video_bg',
                    'video_overlay',
                    'mix_color',
                    'mix_type',
                    'fe_brightness',
                    'fe_contrast',
                    'fe_saturate',
                    'mix_color_h',
                    'mix_type_h',
                    'fe_brightness_h',
                    'fe_contrast_h',
                    'fe_saturate_h'
                )
            )
	    );
    }


    /**
     * modify the blocks params for big grids
     * @return array
     */
    static function td_block_big_grid_params() {
        $map_filter_array = self::get_map_filter_array();

        // remove the limit filter from map. Big grids do not have a limit filter
        $map_filter_array = td_util::vc_array_remove_params($map_filter_array, array(
            'limit'
        ));

        return $map_filter_array;
    }

    /**
     * modify the blocks params for trending_now
     * @return array
     */
    static function td_block_trending_params() {
        $map_filter_array = self::get_map_filter_array();

        // remove the limit filter from map. Big grids do not have a limit filter
        $map_filter_array = td_util::vc_array_remove_params($map_filter_array, array(
            'show_modified_date',
            'time_ago',
            'time_ago_add_txt',
            'time_ago_txt_pos'
        ));

        return $map_filter_array;
    }


    static function get_map_css_tab() {
        return array(
            array (
                'param_name' => 'css',
                'value' => '',
                'type' => 'css_editor',
                'heading' => 'Css',
                'group' => 'Design options',
            ),
            array (
                'param_name' => 'tdc_css',
                'value' => '',
                'type' => 'tdc_css_editor',
                'heading' => '',
                'group' => 'Design options',
            ),
        );
    }


    /**
     * Map array for sliders
     * @return array VC_MAP params
     */
    static function td_slide_params() {
        $map_block_array = self::get_map_block_general_array();

        // remove some of the params that are not needed for the slide
        $map_block_array = td_util::vc_array_remove_params($map_block_array, array(
            'border_top',
            'ajax_pagination',
            'ajax_pagination_infinite_stop'
        ));

        // add some more
        $temp_array_merge = array_merge(
            $map_block_array,
            array(
                array(
                    "param_name" => "title_tag",
                    "type" => "dropdown",
                    "value" => array(
                        'Default - H4' => '',
                        'H1' => 'h1',
                        'H2' => 'h2',
                        'H3' => 'h3',
                        'Div' => 'div'
                    ),
                    "heading" => 'Title tag (SEO)',
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-dropdown-big",
                    "info_img" => "https://cloud.tagdiv.com/help/title_seo.png",
                ),
                array(
                    "param_name" => "autoplay",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => 'Autoplay slider (at x seconds)',
                    "description" => "Leave empty do disable autoplay",
                    "holder" => "div",
                    "class" => "tdc-textfield-small"
                ),
                array(
                    "param_name" => "ms_title_tag",
                    "type" => "dropdown",
                    "value" => array(
                        'Default - H3' => '',
                        'H1' => 'h1',
                        'H2' => 'h2',
                        'H4' => 'h4',
                        'Paragraph' => 'p'
                    ),
                    "heading" => 'Article title tag (SEO)',
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-dropdown-big",
                    "info_img" => "https://cloud.tagdiv.com/help/module_title_seo.png",
                )
            ),
            self::get_map_filter_array()
        );
        return $temp_array_merge;
    }

    //used to configure instagram on demos
    static function td_instagram_demo_data() {
        $instagram_demo_array = array();
        if(TD_DEPLOY_MODE == 'dev' || TD_DEPLOY_MODE == 'demo') {
             $instagram_demo_array = array(
                 array(
                     "param_name" => "instagram_demo_data",
                    "type" => "textarea_raw_html",
                    "value" => '',
                    "heading" => "Instagram demo data (avatar, followers number, images ids)",
                    "description" => 'Enter the data separated by comma in this order (user image, followers number, images ids) ',
                    "holder" => "div",
                    "class" => "",
                    'group' => 'Instagram'
                 )
             );

        }
        return $instagram_demo_array;
    }

    static function td_favourites_badge( $group = 'Layout', $suffix = '' ) {

        return array_merge(
            array(
                array(
                    "param_name" => "separator",
                    "type"       => "text_separator",
                    'heading'    => 'Bookmark button',
                    "value"      => "",
                    "class"      => "tdc-separator-small" . ( !defined( 'TD_CLOUD_LIBRARY' ) ? ' tdc-hidden' : '' ),
                    "group"       => $group,
                ),
                array(
                    "param_name" => "show_favourites" . $suffix,
                    "type" => "checkbox",
                    "value" => '',
                    "heading" => 'Show',
                    "description" => "",
                    "holder" => "div",
                    "group"       => $group,
                    "class" => !defined( 'TD_CLOUD_LIBRARY' ) ? 'tdc-hidden' : ''
                ),
                array(
                    'param_name'  => 'fav_size' . $suffix,
                    'type'        => 'range-responsive',
                    'value'       => '2',
                    'heading'     => 'Button size',
                    'description' => '',
                    'class'       => 'tdc-textfield-small' . ( !defined( 'TD_CLOUD_LIBRARY' ) ? ' tdc-hidden' : '' ),
                    'range_min'   => '1',
                    'range_max'   => '4',
                    'range_step'  => '1',
                    "group"       => $group,
                ),
                array(
                    "param_name"  => "fav_space" . $suffix,
                    "type"        => "textfield-responsive",
                    "value"       => '',
                    "heading"     => 'Button space',
                    "description" => "",
                    "holder"      => "div",
                    "class"       => "tdc-textfield-small" . ( !defined( 'TD_CLOUD_LIBRARY' ) ? ' tdc-hidden' : '' ),
                    "placeholder" => "10",
                    "group"       => $group,
                    "info_img" => "",
                ),
                array(
                    "type"        => "colorpicker",
                    "holder"      => "div",
                    "class"       => "td-colorpicker-double-a" . ( !defined( 'TD_CLOUD_LIBRARY' ) ? ' tdc-hidden' : '' ),
                    "heading"     => 'Icon color',
                    "param_name"  => "fav_ico_color" . $suffix,
                    "value"       => '',
                    "description" => '',
                    "group"       => $group,
                ),
                array(
                    "type"        => "colorpicker",
                    "holder"      => "div",
                    "class"       => "td-colorpicker-double-b" . ( !defined( 'TD_CLOUD_LIBRARY' ) ? ' tdc-hidden' : '' ),
                    "heading"     => 'Icon hover/added color',
                    "param_name"  => "fav_ico_color_h" . $suffix,
                    "value"       => '',
                    "description" => '',
                    "group"       => $group,
                ),
                array(
                    "type"        => "colorpicker",
                    "holder"      => "div",
                    "class"       => "td-colorpicker-double-a" . ( !defined( 'TD_CLOUD_LIBRARY' ) ? ' tdc-hidden' : '' ),
                    "heading"     => 'Background color',
                    "param_name"  => "fav_bg" . $suffix,
                    "value"       => '',
                    "description" => '',
                    "group"       => $group,
                ),
                array(
                    "type"        => "colorpicker",
                    "holder"      => "div",
                    "class"       => "td-colorpicker-double-b" . ( !defined( 'TD_CLOUD_LIBRARY' ) ? ' tdc-hidden' : '' ),
                    "heading"     => 'Background hover/added color',
                    "param_name"  => "fav_bg_h" . $suffix,
                    "value"       => '',
                    "description" => '',
                    "group"       => $group,
                ),
            ),
            td_config_helper::get_map_block_shadow_array( 'fav_shadow' . $suffix, 'Shadow', 4, 1, 1, $group, '', 0, true, ( !defined( 'TD_CLOUD_LIBRARY' ) ? ' tdc-hidden' : '' ) ),
        );

    }

    static function register_styles() {

        // Tabbed content styles
        td_api_style::add( 'tds_tabbed_content1', array(
                'group' => 'tds_tabbed_content',
                'title' => 'Style 1 - Tabs on top',
                'file' => TDC_PATH_LEGACY . '/styles/tds_tabbed_content/tds_tabbed_content1.php',
                'params' => array_merge(
                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Tabs',
                            "value"      => "",
                            "class"      => "tdc-separator",
                            "group"      => "General"
                        ),
                        array(
                            "param_name" => "tabs_horiz",
                            "type" => "dropdown-responsive",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                            "group"       => "General",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "tabs_border",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "1",
                            "heading" => 'Bottom border size',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-small",
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Bottom border color',
                            "param_name" => "tabs_border_color",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Tab',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "General"
                        ),
                        array(
                            "param_name" => "tab_space",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "30",
                            "heading" => 'Space',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-small",
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "tab_padd",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "0 0 18px 0",
                            "heading" => 'Padding',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-big",
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "tab_border",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "3",
                            "heading" => 'Bottom border size',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-small",
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-a",
                            "heading" => 'Bottom border color',
                            "param_name" => "tab_border_color",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-b",
                            "heading" => 'Bottom border color hover',
                            "param_name" => "tab_border_color_h",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-b",
                            "heading" => 'Bottom border color active',
                            "param_name" => "tab_border_color_a",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Icons',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "General"
                        ),
                        array(
                            "param_name" => "icon_size",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "14",
                            "heading" => 'Size',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-small",
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "icon_space",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "8",
                            "heading" => 'Space',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-small",
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "icon_pos",
                            "type" => "dropdown",
                            "value" => array(
                                'Before text' => '',
                                'After text' => 'after',
                            ),
                            "heading" => 'Position',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => 'General'
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-a",
                            "heading" => 'Icon color',
                            "param_name" => "icon_color",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-b",
                            "heading" => 'Icon color hover',
                            "param_name" => "icon_color_h",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-b",
                            "heading" => 'Icon color active',
                            "param_name" => "icon_color_a",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Text',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "General"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-a",
                            "heading" => 'Text color',
                            "param_name" => "txt_color",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-b",
                            "heading" => 'Text color hover',
                            "param_name" => "txt_color_h",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-b",
                            "heading" => 'Text color active',
                            "param_name" => "txt_color_a",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_txt', true, 'Text', 'General' ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Content',
                            "value"      => "",
                            "class"      => "tdc-separator",
                            "group"      => "General"
                        ),
                        array(
                            "param_name" => "content_padd",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "30px 0 0 0",
                            "heading" => 'Padding',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-big",
                            "group" => 'General',
                        ),
                    )
                )
            )
        );

        td_api_style::add( 'tds_tabbed_content2', array(
                'group' => 'tds_tabbed_content',
                'title' => 'Style 2 - Tabs on left',
                'file' => TDC_PATH_LEGACY . '/styles/tds_tabbed_content/tds_tabbed_content2.php',
                'params' => array_merge(
                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Tabs',
                            "value"      => "",
                            "class"      => "tdc-separator",
                            "group"      => "General"
                        ),
                        array(
                            "param_name" => "tabs_width",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "200",
                            "heading" => 'Width',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-big",
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "tabs_border",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "1",
                            "heading" => 'Right border size',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-small",
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Right border color',
                            "param_name" => "tabs_border_color",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Tab',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "General"
                        ),
                        array(
                            "param_name" => "tab_space",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "16",
                            "heading" => 'Space',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-small",
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "tab_padd",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "5px 25px 5px 0",
                            "heading" => 'Padding',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-big",
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "tab_horiz",
                            "type" => "dropdown-responsive",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                            "group"       => "General",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "tab_border",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "3",
                            "heading" => 'Right border size',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-small",
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-a",
                            "heading" => 'Right border color',
                            "param_name" => "tab_border_color",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-b",
                            "heading" => 'Right border color hover',
                            "param_name" => "tab_border_color_h",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-b",
                            "heading" => 'Right border color active',
                            "param_name" => "tab_border_color_a",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Icons',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "General"
                        ),
                        array(
                            "param_name" => "icon_size",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "14",
                            "heading" => 'Size',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-small",
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "icon_space",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "8",
                            "heading" => 'Space',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-small",
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "icon_pos",
                            "type" => "dropdown",
                            "value" => array(
                                'Before text' => '',
                                'After text' => 'after',
                            ),
                            "heading" => 'Position',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => 'General'
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-a",
                            "heading" => 'Icon color',
                            "param_name" => "icon_color",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-b",
                            "heading" => 'Icon color hover',
                            "param_name" => "icon_color_h",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-b",
                            "heading" => 'Icon color active',
                            "param_name" => "icon_color_a",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Text',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "General"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-a",
                            "heading" => 'Text color',
                            "param_name" => "txt_color",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-b",
                            "heading" => 'Text color hover',
                            "param_name" => "txt_color_h",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "tdc-colorpicker-triple-b",
                            "heading" => 'Text color active',
                            "param_name" => "txt_color_a",
                            "value" => '',
                            "description" => '',
                            "group" => 'General',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_txt', true, 'Text', 'General' ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Content',
                            "value"      => "",
                            "class"      => "tdc-separator",
                            "group"      => "General"
                        ),
                        array(
                            "param_name" => "content_padd",
                            "type" => "textfield-responsive",
                            "value" => "",
                            "placeholder" => "0 0 0 30px",
                            "heading" => 'Padding',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-big",
                            "group" => 'General',
                        ),
                    )
                )
            )
        );


        // Filters loop modules
        td_api_style::add( 'tds_module_loop_1_style', array(
                'group' => 'tds_module_loop_style',
                'title' => 'Module 1',
                'file' => TDC_PATH_LEGACY . '/styles/tds_module_loop_style/tds_module_loop_1_style.php',
                'params' => array_merge(
                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Content length',
                            "value"      => "",
                            "class"      => "",
                            "group" => "Module"
                        ),
                        array(
                            "param_name"  => "mc1_tl",
                            "type"        => "textfield",
                            "value"       => '',
                            "heading"     => 'Title length',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => '25',
                            "info_img" => "https://cloud.tagdiv.com/help/title_length.png",
                            "group" => "Module"
                        ),
                        array(
                            "param_name" => "mc1_title_tag",
                            "type" => "dropdown",
                            "value" => array(
                                'Default - H3' => '',
                                'H1' => 'h1',
                                'H2' => 'h2',
                                'H4' => 'h4',
                                'Paragraph' => 'p'
                            ),
                            "heading" => 'Title tag (SEO)',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "info_img" => "https://cloud.tagdiv.com/help/module_title_seo.png",
                            "group" => "Module"
                        ),
                        array(
                            "param_name"  => "mc1_el",
                            "type"        => "textfield",
                            "value"       => '',
                            "heading"     => 'Excerpt length',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "25",
                            "info_img" => "https://cloud.tagdiv.com/help/excerpt_length.png",
                            "group" => "Module"
                        ),

                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'General',
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Module",
                        ),
                        array(
                            "param_name"  => "container_width",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Container width (0-100 percent)',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "100",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_container.png",
                        ),
                        array(
                            "param_name"  => "modules_on_row",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                '1'  => '100%',
                                '2'  => '50%',
                                '3'  => '33.33333333%',
                                '4'  => '25%',
                                '5'  => '20%',
                                '6'  => '16.66666667%',
                                '7'  => '14.28571428%',
                                '8'  => '12.5%',
                                '9'  => '11.11111111%',
                                '10' => '10%',
                            ),
                            "heading"     => 'Modules per row',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-small",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_modules_per_row.png",
                        ),
                        array(
                            "param_name"  => "modules_gap",
                            "type"        => "textfield-responsive",
                            "value"       => '48',
                            "heading"     => 'Modules gap',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "40",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_modules_gap.png",
                        ),
                        array(
                            "param_name"  => "m_padding",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Modules padding',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_modules_padding.png",
                        ),
                        array(
                            "param_name"  => "all_modules_space",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Modules bottom space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "34",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_modules_bottom_space.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Module background',
                            "param_name"  => "m_bg",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_background.png",
                        ),
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow', 'Module Shadow', 0, 0, 0, "Module", '', 0, true, '', 'https://cloud.tagdiv.com/help/module_shadow.png', '' ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => '',
                        ),
                        array(
                            "param_name"  => "review_source",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Author review' => '',
                                'User reviews' => 'user_reviews',
                            ),
                            "heading"     => 'Reviews source',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Modules border',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "Module",
                        ),
                        array(
                            "param_name"  => "modules_border_size",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Border width',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_border_width.png",
                        ),
                        array(
                            "param_name"  => "modules_border_style",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Solid'  => '',
                                'Dotted' => 'dotted',
                                'Dashed' => 'dashed',
                            ),
                            "heading"     => 'Border style',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_border_style.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Border color',
                            "param_name"  => "modules_border_color",
                            "value"       => '#eaeaea',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_border_color.png",
                        ),
                        array(
                            "param_name"  => "m_radius",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Border radius',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Module",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Modules divider',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "Module",
                        ),
                        array(
                            "param_name"  => "modules_divider",
                            "type"        => "dropdown",
                            "value"       => array(
                                'None'   => '',
                                'Solid'  => 'solid',
                                'Dotted' => 'dotted',
                                'Dashed' => 'dashed',
                            ),
                            "heading"     => 'Modules divider',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_modules_divider.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Divider color',
                            "param_name"  => "modules_divider_color",
                            "value"       => '#eaeaea',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_divider_color.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Hover',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "Module",
                        ),
                        array(
                            "param_name"  => "h_effect",
                            "type"        => "dropdown",
                            "value"       => array(
                                'None'   => '',
                                'Shadow'  => 'shadow',
                                'Move up & shadow'  => 'up-shadow',
                            ),
                            "heading"     => 'Hover effect',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_hover_effect.png",
                        ),

                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Article image',
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Module",
                        ),
                        array(
                            "param_name"  => "image_size",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Medium - Default - 696x0px'  => '',
                                '-- [No crop] --' => '__',
                                'XSmall - 150x0px' => 'td_150x0',
                                'Small - 300x0px' => 'td_300x0',
                                'Large - 1068x0px' => 'td_1068x0',
                                'Full - 1920x0px'  => 'td_1920x0',
                                '-- [Other sizes] --' => '__',
                                '218x150px' => 'td_218x150',
                                '324x400px'  => 'td_324x400',
                                '485x360' => 'td_485x360'
                            ),
                            "heading"     => 'Image size',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_image_size.png",
                        ),
                        array(
                            "param_name"  => "image_height",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Image height (percent)',
                            "description" => "Default value in percent",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "50",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_image_height.png",
                        ),
                        array(
                            "param_name"  => "image_width",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Image width (0-100 percent)',
                            "description" => "Default value in percent",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "100",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_image_width.png",
                        ),
                        array(
                            "param_name"  => "image_floated",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Normal'      => 'no_float',
                                'Float left'  => 'float_left',
                                'Float right' => 'float_right',
                                'Hidden'      => 'hidden',
                            ),
                            "heading"     => 'Image position',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_image_position.png",
                        ),
                        array(
                            "param_name"  => "image_radius",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Image radius',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "0",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_image_radius.png",
                        ),
                        array(
                            "param_name"  => "hide_image",
                            "type"        => "checkbox",
                            "value"       => '',
                            "heading"     => "Hide image",
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => 'Module',
                            "info_img" => "https://cloud.tagdiv.com/help/layout_hide_image.png",
                        ),
                    ),
                    td_config_helper::mix_blend('Module'),
                    td_config_helper::image_filters(),
                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Article video',
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Module",
                        ),
                        array(
                            "param_name"  => "video_icon",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Video icon size',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "40",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_video_icon_size.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                        array(
                            "param_name"  => "video_popup",
                            "type"        => "checkbox",
                            "value"       => 'yes',
                            "heading"     => "Enable video pop-up",
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => 'Module',
                            "info_img" => "https://cloud.tagdiv.com/help/layout_enable_video_pop-up.png",
                        ),
                        array(
                            "param_name" => "video_rec",
                            "type" => "textarea_raw_html",
                            "holder" => "div",
                            "class" => "tdc-textarea-raw-small",
                            "heading" => 'Video pop-up ad',
                            "value" => "",
                            "description" => 'Paste your ad code here.',
                            'group'      => 'Module',
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_popup_ad.png",
                        ),
                        array(
                            "param_name" => "spot_header",
                            "type" => "spot_header",
                            "value" => "",
                            "class" => '',
                            'group' => 'Module',
                        ),
                        array(
                            "param_name" => "video_rec_title",
                            "type" => "textfield",
                            "value" => '- Advertisement -',
                            "heading" => 'Ad title',
                            "description" => "",
                            "placeholder" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-extrabig tdc-spot-controller tdc-spot-title",
                            'group'      => 'Module',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "tdc-spot-controller tdc-spot-color",
                            "heading"     => 'Ad title color',
                            "param_name"  => "video_rec_color",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                        ),
                        array(
                            "param_name"  => "video_rec_disable",
                            "type"        => "checkbox",
                            "value"       => '',
                            "heading"     => "Hide ADS for admins/editors",
                            "description" => "Used to prevent fake clicks and views on ads by admins and editors",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => 'Module'
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                        array(
                            "param_name"  => "autoplay_vid",
                            "type"        => "checkbox",
                            "value"       => 'yes',
                            "heading"     => "Autoplay video",
                            "description" => "When it is inactive, the sound will be ON",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => 'Module'
                        ),
                        array(
                            "param_name"  => "show_vid_t",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show video duration',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_show_video_duration.png",
                        ),
                        array(
                            "param_name"  => "vid_t_margin",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Video duration space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_space.png",
                        ),
                        array(
                            "param_name"  => "vid_t_padding",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Video duration padding',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "3px 6px 4px",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_padding.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Style',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "Module",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Video pop-up article title color',
                            "param_name"  => "video_title_color",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_title_color.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Video pop-up article title hover color',
                            "param_name"  => "video_title_color_h",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                        ),
                        array(
                            "param_name" => "video_bg",
                            "holder"     => "div",
                            "type"       => "gradient",
                            'heading'    => "Video pop-up background color",
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_background.png",
                        ),
                        array(
                            "param_name" => "video_overlay",
                            "holder"     => "div",
                            "type"       => "gradient",
                            'heading'    => "Video pop-up overlay color",
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_overlay_color.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                        array(
                            "param_name" => "vid_t_color",
                            "holder"     => "div",
                            "type"       => "colorpicker",
                            'heading'    => "Video duration text color",
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_text_color.png",
                        ),
                        array(
                            "param_name" => "vid_t_bg_color",
                            "holder"     => "div",
                            "type"       => "colorpicker",
                            'heading'    => "Video duration background color",
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_bg_color.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_vid_title', true, 'Video pop-up article title', 'Layout', '', '', 'https://cloud.tagdiv.com/help/module_video_article_title.png', '' ),
                    td_config_helper::get_map_block_font_array( 'f_vid_time', false, 'Video duration text', 'Layout', '', '', 'https://cloud.tagdiv.com/help/module_video_duration_title.png', '' ),
                    td_config::get_map_exclusive_label_array(),
                    array(

                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Article meta info',
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Module",
                        ),
                        array(
                            "param_name"  => "meta_info_align",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Default' => '',
                                'Top'     => 'initial',
                                'Center'  => 'center',
                                'Bottom'  => 'flex-end',
                            ),
                            "heading"     => 'Meta info alignment',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_vertical_align.png",
                        ),
                        array(
                            "param_name" => "meta_info_horiz",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Meta info horiz align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_horiz_align.png",
                        ),
                        array(
                            "param_name"  => "meta_width",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Meta info width',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "100%",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_meta_info_width.png",
                        ),
                        array(
                            "param_name"  => "meta_margin",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Meta info margin',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_meta_margin.png",
                        ),
                        array(
                            "param_name"  => "meta_padding",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Meta info padding',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "13px 0px 0px 0px",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_meta_padding.png",
                        ),
                        array(
                            "param_name"  => "meta_space",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Meta container space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_meta_container_space.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Meta info background',
                            "param_name"  => "meta_bg",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_background.png",
                        ),
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow_m', 'Meta info shadow', 0, 0, 0, "Module", '', 0, true, '', 'https://cloud.tagdiv.com/help/module_meta_shadow.png', '' ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => '',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_meta', false, 'Article meta info', "Module", '', '', 'https://cloud.tagdiv.com/help/module_font_article_meta.png', '' ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Meta info border',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "meta_info_border_size",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Border width',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_meta_border_width.png",
                        ),
                        array(
                            "param_name"  => "meta_info_border_style",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Solid'  => '',
                                'Dotted' => 'dotted',
                                'Dashed' => 'dashed',
                            ),
                            "heading"     => 'Border style',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_meta_border_style_general.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Border color',
                            "param_name"  => "meta_info_border_color",
                            "value"       => '#eaeaea',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_meta_border_color_general.png",
                        ),
                        array(
                            "param_name"  => "meta_info_border_radius",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Border radius',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Module",
                            "info_img" => "",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Article title',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "art_title",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Article title space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 6px 0px",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_article_title_space.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Article title text color',
                            "param_name"  => "title_txt",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_color_article_title.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Article title text hover',
                            "param_name"  => "title_txt_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                        ),
                        array(
                            "param_name"  => "all_underline_height",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Underline size',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "0",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/style_underline.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Hover underline color',
                            "param_name"  => "all_underline_color",
                            "value"       => '#000',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_underline_color.png",
                        ),
                        array(
                            "param_name"  => "art_btn",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Article button space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "20px 0px 0px 0px",
                            "group"       => "Module",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => '',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Article title', "Module", '', '', 'https://cloud.tagdiv.com/help/module_font_article_title.png', '' ),

                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Category tag',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "modules_category",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Inline'      => '',
                                'Above title' => 'above',
                                'Over image'  => 'image',
                            ),
                            "heading"     => 'Category tag position',
                            "description" => "Float image",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_category_tag_position.png",
                        ),
                        array(
                            "param_name"  => "modules_category_margin",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Category tag spacing',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Module",
                        ),
                        array(
                            "param_name"  => "modules_category_padding",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Category tag padding',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "3px 6px 4px",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_cat_padding.png",
                        ),
                        array(
                            "param_name"  => "modules_cat_border",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Category border width',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_cat_border.png",
                        ),
                        array(
                            'param_name'  => 'modules_category_radius',
                            'type'        => 'range-responsive',
                            'value'       => '0',
                            'heading'     => 'Border radius',
                            'description' => '',
                            'class'       => 'tdc-textfield-small',
                            'range_min'   => '0',
                            'range_max'   => '100',
                            'range_step'  => '1',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_cat_radius.png",
                        ),
                        array(
                            "param_name"  => "show_cat",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'inline-block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show category',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_cat_show.png",
                        ),
                        array(
                            "param_name"  => "modules_extra_cat",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Inline'      => '',
                                'Above title' => 'above',
                                'Hide' => 'hide',
                            ),
                            "heading"     => 'Show custom label',
                            "description" => "The custom label can be set individually for each post. Edit a single post and check Post Settings fields.",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_category_tag_position.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                        array(
                            "param_name" => "cat_style",
                            "type" => "dropdown",
                            "value" => array(
                                'Default' => '',
                                'Solid' => 'tdb-cat-style2',
                                'Rainbow' => 'tdb-cat-style3',
                            ),
                            "heading" => 'Style',
                            "description" => "The predefined style will get the category color you set in Theme Panel. It will apply also on the Module 2.",
                            "holder" => "div",
                            "group"       => 'Style',
                            "class" => "tdc-dropdown-big",
                            "toggle_enable_params" => "cat_style",
                            'toggle_enable_params_reverse' => true,
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Category background',
                            "param_name"  => "cat_bg",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_cat_color_bg.png",
                            "toggle_enabled_by" => "cat_style",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Category background hover',
                            "param_name"  => "cat_bg_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "toggle_enabled_by" => "cat_style",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Category text color',
                            "param_name"  => "cat_txt",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "toggle_enabled_by" => "cat_style",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Category text hover',
                            "param_name"  => "cat_txt_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "toggle_enabled_by" => "cat_style",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Category border color',
                            "param_name"  => "cat_border",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_cat_color_border.png",
                            "toggle_enabled_by" => "cat_style",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Category border hover',
                            "param_name"  => "cat_border_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "toggle_enabled_by" => "cat_style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_cat', false, 'Article category tag', "Module", '', '', 'https://cloud.tagdiv.com/help/module_font_article_cat.png', '' ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Author',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "show_author",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'inline-block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show author',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_auth_show.png",
                        ),
                        array(
                            "param_name"  => "author_photo",
                            "type"        => "checkbox",
                            "value"       => '',
                            "heading"     => "Show author photo",
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => 'Layout',
                            "info_img" => "https://cloud.tagdiv.com/help/module_auth_photo.png",
                        ),
                        array(
                            "param_name"  => "author_photo_size",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Author photo size',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "20",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_auth_photo_size.png",
                        ),
                        array(
                            "param_name"  => "author_photo_space",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Author photo space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "6",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_auth_photo_space.png",
                        ),
                        array(
                            "param_name"  => "author_photo_radius",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Author photo radius',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "50%",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_auth_photo_radius.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Author text color',
                            "param_name"  => "author_txt",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_auth_color.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Author text hover',
                            "param_name"  => "author_txt_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                        ),

                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Date',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "show_date",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'inline-block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show date',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_date_show.png",
                        ),
                        array(
                            "param_name"  => "show_modified_date",
                            "type"        => "checkbox",
                            "value"       => '',
                            "heading"     => "Show modified date",
                            "description" => "Show last modified date of the article",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => "Module",
                        ),
                        array(
                            "param_name" => "time_ago",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => 'Enable time ago',
                            "description" => "Applicable only for posts newer than 7 days",
                            "holder" => "div",
                            "class" => "",
                            "group" => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_time_ago.png"
                        ),
                        array(
                            "param_name" => "time_ago_add_txt",
                            "type" => "textfield",
                            "value" => 'ago',
                            "heading" => 'Time ago add. text',
                            "description" => "",
                            "placeholder" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-big",
                            "group" => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_ago_text.png",
                        ),
                        array(
                            "param_name" => "time_ago_txt_pos",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => 'Display additional text before the date',
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                            "group" => "Module",
                            "info_img" => "",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Date text color',
                            "param_name"  => "date_txt",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_date_color.png",
                        ),

                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Comment count',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "show_com",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show comment',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_comment_show.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Comment background',
                            "param_name"  => "com_bg",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_comment_bg.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Comment text color',
                            "param_name"  => "com_txt",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_comment_text.png",
                        ),

                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Review stars',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "Module",
                        ),
                        array(
                            "param_name"  => "show_review",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'inline-block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show review stars',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_review_show.png",
                        ),
                        array(
                            "param_name"  => "review_space",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Review stars space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0",
                            "group"       => "Module",
                            "info_img" => "",
                        ),
                        array(
                            'param_name'  => 'review_size',
                            'type'        => 'range-responsive',
                            'value'       => '2.5',
                            'heading'     => 'Review stars size',
                            'description' => '',
                            'class'       => 'tdc-textfield-small',
                            'range_min'   => '0',
                            'range_max'   => '10',
                            'range_step'  => '0.5',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_review_size.png",
                        ),
                        array(
                            "param_name"  => "review_distance",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Distance between rating stars',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "0",
                            "group"       => "Module",
                            "info_img" => "",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Excerpt',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "Module",
                        ),
                        array(
                            "param_name"  => "show_excerpt",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show excerpt',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_show_excerpt.png",
                        ),
                        array(
                            "param_name"  => "art_excerpt",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Article excerpt space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "20px 0px 0px 0px",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_excerpt_space.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Layout',
                        ),
                        array(
                            "param_name"  => "excerpt_col",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                '1'  => '1',
                                '2' => '2',
                                '3' => '3',
                            ),
                            "heading"     => 'Article excerpt columns',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-small",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_article_excerpt_columns.png",
                        ),
                        array(
                            "param_name"  => "excerpt_gap",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Article excerpt columns gap',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "48",
                            "group"       => "Module",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Layout',
                        ),
                        array(
                            "param_name"  => "excerpt_middle",
                            "type"        => "checkbox",
                            "value"       => '',
                            "heading"     => "Excerpt in middle",
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "excerpt_inline",
                            "type"        => "checkbox",
                            "value"       => '',
                            "heading"     => "Inline Excerpt & Title",
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => 'Layout',
                            "info_img" => "https://cloud.tagdiv.com/help/layout_inline_excerpt_title.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Excerpt text color',
                            "param_name"  => "ex_txt",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_color_excerpt.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_ex', false, 'Article excerpt', "Module", '', '', 'https://cloud.tagdiv.com/help/module_font_article_excerpt.png', '' ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Article audio player',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "Module",
                        ),
                        array(
                            "param_name"  => "show_audio",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Visible' => 'block',
                                'Hidden' => 'none',
                            ),
                            "heading"     => 'Show audio player',
                            "description" => "This will hide the audio player responsive",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_audio_show.png",
                        ),
                        array(
                            "param_name"  => "hide_audio",
                            "type"        => "checkbox",
                            "value"       => '',
                            "heading"     => "Remove audio player",
                            "description" => "This will remove the audio player from code",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => 'Layout',
                            "info_img" => "https://cloud.tagdiv.com/help/module_audio_show.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Layout',
                        ),
                        array(
                            "param_name"  => "art_audio",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Audio player space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_audio_space.png",
                        ),
                        array(
                            'param_name'  => 'art_audio_size',
                            'type'        => 'range-responsive',
                            'value'       => '1.5',
                            'heading'     => 'Audio player size',
                            'description' => '',
                            'class'       => 'tdc-textfield-small',
                            'range_min'   => '0',
                            'range_max'   => '10',
                            'range_step'  => '0.5',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_audio_size.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Buttons color',
                            "param_name"  => "audio_btn_color",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_color_audio_buttons.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Time text color',
                            "param_name"  => "audio_time_color",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_color_audio_time.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Bars background color',
                            "param_name"  => "audio_bar_color",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_color_audio_bar.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Bars progress color',
                            "param_name"  => "audio_bar_curr_color",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_color_audio_progress.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Read more button',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Module'
                        ),
                        array(
                            "param_name"  => "show_btn",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show button',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_show.png",
                        ),
                        array(
                            "param_name"  => "btn_title",
                            "type"        => "textfield",
                            "value"       => '',
                            "heading"     => 'Button text',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "Read more",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_text.png",
                        ),
                        array(
                            "param_name"  => "btn_margin",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Button space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 20px 0px",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_space.png",
                        ),
                        array(
                            "param_name"  => "btn_padding",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Button padding',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "10px 15px",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_padding.png",
                        ),
                        array(
                            "param_name"  => "btn_border_width",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Button border width',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "0",
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_border.png",
                        ),
                        array(
                            "param_name" => "btn_radius",
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'Button border radius',
                            "description" => "",
                            "placeholder" => "0",
                            "holder" => "div",
                            "class" => "tdc-textfield-small",
                            'group'      => 'Module',
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_radius.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Button background',
                            "param_name"  => "btn_bg",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_color_bg.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Button background hover',
                            "param_name"  => "btn_bg_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Button text color',
                            "param_name"  => "btn_txt",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_color_text.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Button text hover',
                            "param_name"  => "btn_txt_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Button border color',
                            "param_name"  => "btn_border",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_border_color.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Button border hover',
                            "param_name"  => "btn_border_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Module",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Module',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_btn', false, 'Article read more button', "Module", '', '', 'https://cloud.tagdiv.com/help/module_font_article_read.png', '' )
                ),
            )
        );
        td_api_style::add( 'tds_module_loop_2_style', array(
                'group' => 'tds_module_loop_style',
                'title' => 'Module 2',
                'file' => TDC_PATH_LEGACY . '/styles/tds_module_loop_style/tds_module_loop_2_style.php',
                'params' => array_merge(
                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Content length',
                            "value"      => "",
                            "class"      => "",
                        ),
                        array(
                            "param_name"  => "mc1_tl",
                            "type"        => "textfield",
                            "value"       => '',
                            "heading"     => 'Title length',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => '25',
                            "info_img" => "https://cloud.tagdiv.com/help/title_length.png",
                        ),
                        array(
                            "param_name" => "mc1_title_tag",
                            "type" => "dropdown",
                            "value" => array(
                                'Default - H3' => '',
                                'H1' => 'h1',
                                'H2' => 'h2',
                                'H4' => 'h4',
                                'Paragraph' => 'p'
                            ),
                            "heading" => 'Title tag (SEO)',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "info_img" => "https://cloud.tagdiv.com/help/module_title_seo.png",
                        ),
                        array(
                            "param_name"  => "mc1_el",
                            "type"        => "textfield",
                            "value"       => '',
                            "heading"     => 'Excerpt length',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "25",
                            "info_img" => "https://cloud.tagdiv.com/help/excerpt_length.png",
                        ),

                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'General',
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Layout",
                        ),
                        array(
                            "param_name"  => "modules_on_row",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                '1'  => '100%',
                                '2'  => '50%',
                                '3'  => '33.33333333%',
                                '4'  => '25%',
                                '5'  => '20%',
                                '6'  => '16.66666667%',
                                '7'  => '14.28571428%',
                                '8'  => '12.5%',
                                '9'  => '11.11111111%',
                                '10' => '10%',
                            ),
                            "heading"     => 'Modules per row',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-small",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_modules_per_row.png",
                        ),
                        array(
                            "param_name"  => "modules_gap",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Modules gap',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "40",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_modules_gap.png",
                        ),
                        array(
                            "param_name"  => "m_padding",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Modules padding',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_modules_padding.png",
                        ),
                        array(
                            "param_name"  => "all_modules_space",
                            "type"        => "textfield-responsive",
                            "value"       => '36',
                            "heading"     => 'Modules bottom space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "36",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_modules_bottom_space.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Layout',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Module background',
                            "param_name"  => "m_bg",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_background.png",
                        ),
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow', 'Module Shadow', 0, 0, 0, "Style", '', 0, true, '', 'https://cloud.tagdiv.com/help/module_shadow.png', '' ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Modules border',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "Layout",
                        ),
                        array(
                            "param_name"  => "modules_border_size",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Border width',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_border_width.png",
                        ),
                        array(
                            "param_name"  => "modules_border_style",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Solid'  => '',
                                'Dotted' => 'dotted',
                                'Dashed' => 'dashed',
                            ),
                            "heading"     => 'Border style',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_border_style.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Border color',
                            "param_name"  => "modules_border_color",
                            "value"       => '#eaeaea',
                            "description" => '',
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_border_color.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Modules divider',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "Layout",
                        ),
                        array(
                            "param_name"  => "modules_divider",
                            "type"        => "dropdown",
                            "value"       => array(
                                'None'   => '',
                                'Solid'  => 'solid',
                                'Dotted' => 'dotted',
                                'Dashed' => 'dashed',
                            ),
                            "heading"     => 'Modules divider',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_modules_divider.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Modules divider color',
                            "param_name"  => "modules_divider_color",
                            "value"       => '#eaeaea',
                            "description" => '',
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_divider_color.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Modules hover',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "Layout",
                        ),
                        array(
                            "param_name"  => "h_effect",
                            "type"        => "dropdown",
                            "value"       => array(
                                'None'   => '',
                                'Shadow'  => 'shadow',
                                'Move up & shadow'  => 'up-shadow',
                            ),
                            "heading"     => 'Hover effect',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_hover_effect.png",
                        ),

                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Article image',
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Layout",
                        ),
                        array(
                            "param_name"  => "image_size",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Medium - Default - 696x0px'  => '',
                                '-- [No crop] --' => '__',
                                'XSmall - 150x0px' => 'td_150x0',
                                'Small - 300x0px' => 'td_300x0',
                                'Large - 1068x0px' => 'td_1068x0',
                                'Full - 1920x0px'  => 'td_1920x0',
                                '-- [Other sizes] --' => '__',
                                '218x150px' => 'td_218x150',
                                '324x400px'  => 'td_324x400',
                                '485x360' => 'td_485x360'
                            ),
                            "heading"     => 'Image size',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_image_size.png",
                        ),
                        array(
                            'param_name'  => 'image_alignment',
                            'type'        => 'range-responsive',
                            'value'       => '50',
                            'heading'     => 'Image V alignment',
                            'description' => '0 - Top / 50 - Center / 100 - Bottom',
                            'class'       => 'tdc-textfield-small',
                            'range_min'   => '0',
                            'range_max'   => '100',
                            'range_step'  => '1',
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_image_v_alignment.png",
                        ),
                        array(
                            "param_name"  => "image_height",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Image height (percent)',
                            "description" => "Default value in percent",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "50",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_image_height.png",
                        ),
                        array(
                            "param_name"  => "image_radius",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Image radius',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "0",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_image_radius.png",
                        ),
                        array(
                            "param_name"  => "image_margin",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Image margin',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_image_margin.png",
                        ),
                        array(
                            "param_name"  => "hide_image",
                            "type"        => "checkbox",
                            "value"       => '',
                            "heading"     => "Hide image",
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => 'Layout',
                            "info_img" => "https://cloud.tagdiv.com/help/layout_hide_image.png",
                        ),
                    ),
                    td_config_helper::mix_blend(),
                    td_config_helper::image_filters(),

                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Article video',
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Layout",
                        ),
                        array(
                            "param_name"  => "video_icon",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Video icon size',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "40",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_video_icon_size.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Layout',
                        ),
                        array(
                            "param_name"  => "video_popup",
                            "type"        => "checkbox",
                            "value"       => 'yes',
                            "heading"     => "Enable video pop-up",
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => 'Layout',
                            "info_img" => "https://cloud.tagdiv.com/help/layout_enable_video_pop-up.png",
                        ),
                        array(
                            "param_name" => "video_rec",
                            "type" => "textarea_raw_html",
                            "holder" => "div",
                            "class" => "tdc-textarea-raw-small",
                            "heading" => 'Video pop-up ad',
                            "value" => "",
                            "description" => 'Paste your ad code here.',
                            'group'      => 'Layout',
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_popup_ad.png",
                        ),
                        array(
                            "param_name" => "spot_header",
                            "type" => "spot_header",
                            "value" => "",
                            "class" => '',
                            'group' => 'Layout',
                        ),
                        array(
                            "param_name" => "video_rec_title",
                            "type" => "textfield",
                            "value" => '- Advertisement -',
                            "heading" => 'Ad title',
                            "description" => "",
                            "placeholder" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-extrabig tdc-spot-controller tdc-spot-title",
                            'group'      => 'Layout',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "tdc-spot-controller tdc-spot-color",
                            "heading"     => 'Ad title color',
                            "param_name"  => "video_rec_color",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Layout",
                        ),
                        array(
                            "param_name"  => "video_rec_disable",
                            "type"        => "checkbox",
                            "value"       => '',
                            "heading"     => "Hide ADS for admins/editors",
                            "description" => "Used to prevent fake clicks and views on ads by admins and editors",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Layout',
                        ),
                        array(
                            "param_name"  => "autoplay_vid",
                            "type"        => "checkbox",
                            "value"       => 'yes',
                            "heading"     => "Autoplay video",
                            "description" => "When it is inactive, the sound will be ON",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "show_vid_t",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show video duration',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_show_video_duration.png",
                        ),
                        array(
                            "param_name"  => "vid_t_margin",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Video duration space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_space.png",
                        ),
                        array(
                            "param_name"  => "vid_t_padding",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Video duration padding',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "3px 6px 4px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_padding.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Style',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"      => "Layout",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Video pop-up article title color',
                            "param_name"  => "video_title_color",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_title_color.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Video pop-up article title hover color',
                            "param_name"  => "video_title_color_h",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Layout",
                        ),
                        array(
                            "param_name" => "video_bg",
                            "holder"     => "div",
                            "type"       => "gradient",
                            'heading'    => "Video pop-up background color",
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_background.png",
                        ),
                        array(
                            "param_name" => "video_overlay",
                            "holder"     => "div",
                            "type"       => "gradient",
                            'heading'    => "Video pop-up overlay color",
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_overlay_color.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Layout',
                        ),
                        array(
                            "param_name" => "vid_t_color",
                            "holder"     => "div",
                            "type"       => "colorpicker",
                            'heading'    => "Video duration text color",
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_text_color.png",
                        ),
                        array(
                            "param_name" => "vid_t_bg_color",
                            "holder"     => "div",
                            "type"       => "colorpicker",
                            'heading'    => "Video duration background color",
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_video_bg_color.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_vid_title', true, 'Video pop-up article title', 'Layout', '', '', 'https://cloud.tagdiv.com/help/module_video_article_title.png', '' ),
                    td_config_helper::get_map_block_font_array( 'f_vid_time', false, 'Video duration text', 'Layout', '', '', 'https://cloud.tagdiv.com/help/module_video_duration_title.png', '' ),
                    td_config::get_map_exclusive_label_array(),

                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Article meta info',
                            "value"      => "",
                            "class"      => "",
                            "group"      => "Layout",
                        ),
                        array(
                            "param_name" => "meta_info_horiz",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Meta info horiz align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_horiz_align.png",
                        ),
                        array(
                            "param_name"  => "meta_width",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Meta info width',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "100%",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_meta_info_width.png",
                        ),
                        array(
                            "param_name"  => "meta_padding",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Top info padding',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_meta_top_padding.png",
                        ),
                        array(
                            "param_name"  => "meta_padding2",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Bottom info padding',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "13px 0px 0px 0px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_meta_bottom_padding.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Style',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Top meta info background',
                            "param_name"  => "meta_bg",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_background.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Bottom meta info background',
                            "param_name"  => "meta_bg2",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_background.png",
                        ),
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow_m', 'Meta info shadow', 0, 0, 0, "Style", '', 0, true, '', 'https://cloud.tagdiv.com/help/module_meta_shadow.png', '' ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Style',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_meta', false, 'Article meta info', 'Style', '', '', 'https://cloud.tagdiv.com/help/module_font_article_meta.png', '' ),

                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Meta info border',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "meta_info_border_size",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Top info border width',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_meta_top_border.png",
                        ),
                        array(
                            "param_name"  => "meta_info_border_size2",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Bottom info border width',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_meta_bottom_border.png",
                        ),
                        array(
                            "param_name"  => "meta_info_border_style",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Solid'  => '',
                                'Dotted' => 'dotted',
                                'Dashed' => 'dashed',
                            ),
                            "heading"     => 'Border style',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_meta_border_style_general.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Border color',
                            "param_name"  => "meta_info_border_color",
                            "value"       => '#eaeaea',
                            "description" => '',
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_meta_border_color_general.png",
                        ),
                        array(
                            "param_name"  => "meta_info_border_radius",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Top info border radius',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Layout",
                            "info_img" => "",
                        ),
                        array(
                            "param_name"  => "meta_info_border_radius2",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Bottom info border radius',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Layout",
                            "info_img" => "",
                        ),

                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Article title',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "art_title_pos",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Above image' => 'top',
                                'Under image' => 'bottom',
                            ),
                            "heading"     => 'Article title position',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_meta_title_position.png",
                        ),
                        array(
                            "param_name"  => "info_pos",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Above image' => 'top',
                                'Under image' => 'bottom',
                                'Above title' => 'title',
                            ),
                            "heading"     => 'Info position',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_info_position.png",
                        ),
                        array(
                            "param_name"  => "info_space",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Info space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_info_space.png",
                        ),
                        array(
                            "param_name"  => "art_title",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Article title space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 6px 0px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_article_title_space.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Style',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Article title text color',
                            "param_name"  => "title_txt",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_color_article_title.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Article title text hover',
                            "param_name"  => "title_txt_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                        ),
                        array(
                            "param_name"  => "all_underline_height",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Underline size',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "0",
                            "group"       => "Style",
                            "info_img" => "https://cloud.tagdiv.com/help/style_underline.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Hover underline color',
                            "param_name"  => "all_underline_color",
                            "value"       => '#000',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_underline_color.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Style',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Article title', 'Style', '', '', 'https://cloud.tagdiv.com/help/module_font_article_title.png', '' ),

                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Category tag',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "show_cat",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'inline-block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show category',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_cat_show.png",
                        ),
                        array(
                            "param_name"  => "modules_category",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Inline'      => '',
                                'Above title' => 'above',
                                'Over image'  => 'image',
                            ),
                            "heading"     => 'Category tag position',
                            "description" => "Float image",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_category_tag_position.png",
                        ),
                        array(
                            "param_name"  => "modules_extra_cat",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Inline'      => '',
                                'Above title' => 'above',
                                'Hide' => 'hide',
                            ),
                            "heading"     => 'Show custom label',
                            "description" => "The custom label can be set individually for each post. Edit a single post and check Post Settings fields.",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/layout_category_tag_position.png",
                        ),
                        array(
                            "param_name"  => "modules_category_margin",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Category tag spacing',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Layout",
                        ),
                        array(
                            "param_name"  => "modules_category_padding",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Category tag padding',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "3px 6px 4px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_cat_padding.png",
                        ),
                        array(
                            "param_name"  => "modules_category_border",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Category tag border',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_cat_border.png",
                        ),
                        array(
                            'param_name'  => 'modules_category_radius',
                            'type'        => 'range-responsive',
                            'value'       => '0',
                            'heading'     => 'Border radius',
                            'description' => '',
                            'class'       => 'tdc-textfield-small',
                            'range_min'   => '0',
                            'range_max'   => '100',
                            'range_step'  => '1',
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_cat_radius.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Style',
                        ),
                        array(
                            "param_name" => "cat_style",
                            "type" => "dropdown",
                            "value" => array(
                                'Default' => '',
                                'Solid' => 'tdb-cat-style2',
                                'Rainbow' => 'tdb-cat-style3',
                            ),
                            "heading" => 'Style',
                            "description" => "The predefined style will get the category color you set in Theme Panel. It will apply also on the Module 2.",
                            "holder" => "div",
                            "group"       => 'Style',
                            "class" => "tdc-dropdown-big",
                            "toggle_enable_params" => "cat_style",
                            'toggle_enable_params_reverse' => true,
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Category background',
                            "param_name"  => "cat_bg",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_cat_color_bg.png",
                            "toggle_enabled_by" => "cat_style",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Category background hover',
                            "param_name"  => "cat_bg_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "toggle_enabled_by" => "cat_style",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Category text color',
                            "param_name"  => "cat_txt",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "toggle_enabled_by" => "cat_style",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Category text hover',
                            "param_name"  => "cat_txt_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "toggle_enabled_by" => "cat_style",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Category border color',
                            "param_name"  => "cat_border",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_cat_color_border.png",
                            "toggle_enabled_by" => "cat_style",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Category border hover',
                            "param_name"  => "cat_border_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "toggle_enabled_by" => "cat_style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Style',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_cat', false, 'Article category tag', 'Style', '', '', 'https://cloud.tagdiv.com/help/module_font_article_cat.png', '' ),

                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Author',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "show_author",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'inline-block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show author',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_auth_show.png",
                        ),
                        array(
                            "param_name"  => "author_photo",
                            "type"        => "checkbox",
                            "value"       => '',
                            "heading"     => "Show author photo",
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => 'Layout',
                            "info_img" => "https://cloud.tagdiv.com/help/module_auth_photo.png",
                        ),
                        array(
                            "param_name"  => "author_photo_size",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Author photo size',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "20",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_auth_photo_size.png",
                        ),
                        array(
                            "param_name"  => "author_photo_space",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Author photo space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "6",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_auth_photo_space.png",
                        ),
                        array(
                            "param_name"  => "author_photo_radius",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Author photo radius',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "50%",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_auth_photo_radius.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Style',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Author text color',
                            "param_name"  => "author_txt",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_auth_color.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Author text hover',
                            "param_name"  => "author_txt_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                        ),

                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Date',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "show_date",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'inline-block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show date',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_date_show.png",
                        ),
                        array(
                            "param_name"  => "show_modified_date",
                            "type"        => "checkbox",
                            "value"       => '',
                            "heading"     => "Show modified date",
                            "description" => "Show last modified date of the article instead of published date",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => "Layout",
                        ),
                        array(
                            "param_name" => "time_ago",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => 'Enable time ago',
                            "description" => "Applicable only for posts newer than 7 days",
                            "holder" => "div",
                            "class" => "",
                            "group" => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_time_ago.png"
                        ),
                        array(
                            "param_name" => "time_ago_add_txt",
                            "type" => "textfield",
                            "value" => 'ago',
                            "heading" => 'Time ago add. text',
                            "description" => "",
                            "placeholder" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-big",
                            "group" => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_ago_text.png",
                        ),
                        array(
                            "param_name" => "time_ago_txt_pos",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => 'Display additional text before the date',
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                            "group" => "Layout",
                            "info_img" => "",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Style',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Date text color',
                            "param_name"  => "date_txt",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_date_color.png",
                        ),

                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Comment count',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "show_com",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show comment',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_comment_show.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Style',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Comment background',
                            "param_name"  => "com_bg",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_comment_bg.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Comment text color',
                            "param_name"  => "com_txt",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_comment_text.png",
                        ),

                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Review stars',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "show_review",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'inline-block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show review stars',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_review_show.png",
                        ),
                        array(
                            "param_name"  => "review_space",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Review stars space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0",
                            "group"       => "Layout",
                            "info_img" => "",
                        ),
                        array(
                            'param_name'  => 'review_size',
                            'type'        => 'range-responsive',
                            'value'       => '2.5',
                            'heading'     => 'Review stars size',
                            'description' => '',
                            'class'       => 'tdc-textfield-small',
                            'range_min'   => '0',
                            'range_max'   => '10',
                            'range_step'  => '0.5',
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_review_size.png",
                        ),
                        array(
                            "param_name"  => "review_distance",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Distance between rating stars',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "0",
                            "group"       => "Layout",
                            "info_img" => "",
                        ),

                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Excerpt',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "show_excerpt",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show excerpt',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_show_excerpt.png",
                        ),
                        array(
                            "param_name"  => "art_excerpt_pos",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Above image' => 'top',
                                'Under image' => 'bottom',
                            ),
                            "heading"     => 'Article excerpt position',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_excerpt_position.png",
                        ),
                        array(
                            "param_name"  => "art_excerpt",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Article excerpt space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "20px 0px 0px 0px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_excerpt_space.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Style',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Excerpt text color',
                            "param_name"  => "ex_txt",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_color_excerpt.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Style',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_ex', false, 'Article excerpt', 'Style', '', '', 'https://cloud.tagdiv.com/help/module_font_article_excerpt.png', '' ),

                    array(
                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Article audio player',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "show_audio",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Visible' => 'block',
                                'Hidden' => 'none',
                            ),
                            "heading"     => 'Show audio player',
                            "description" => "This will hide the audio player responsive",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_audio_show.png",
                        ),
                        array(
                            "param_name"  => "hide_audio",
                            "type"        => "checkbox",
                            "value"       => '',
                            "heading"     => "Remove audio player",
                            "description" => "This will remove the audio player from code",
                            "holder"      => "div",
                            "class"       => "",
                            "group"       => 'Layout',
                            "info_img" => "https://cloud.tagdiv.com/help/module_audio_show.png",
                        ),
                        array(
                            "param_name"  => "art_audio_pos",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Above image' => 'top',
                                'Under image' => 'bottom',
                            ),
                            "heading"     => 'Audio player position',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_audio_position.png",
                        ),
                        array(
                            "param_name"  => "art_audio",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Audio player space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 0px 0px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_audio_space.png",
                        ),
                        array(
                            'param_name'  => 'art_audio_size',
                            'type'        => 'range-responsive',
                            'value'       => '1.5',
                            'heading'     => 'Audio player size',
                            'description' => '',
                            'class'       => 'tdc-textfield-small',
                            'range_min'   => '0',
                            'range_max'   => '10',
                            'range_step'  => '0.5',
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_audio_size.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Style',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Buttons color',
                            "param_name"  => "audio_btn_color",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Style",
                            "info_img" => "https://cloud.tagdiv.com/help/module_color_audio_buttons.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Time text color',
                            "param_name"  => "audio_time_color",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Style",
                            "info_img" => "https://cloud.tagdiv.com/help/module_color_audio_time.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Bars background color',
                            "param_name"  => "audio_bar_color",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Style",
                            "info_img" => "https://cloud.tagdiv.com/help/module_color_audio_bar.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "",
                            "heading"     => 'Bars progress color',
                            "param_name"  => "audio_bar_curr_color",
                            "value"       => '',
                            "description" => '',
                            "group"       => "Style",
                            "info_img" => "https://cloud.tagdiv.com/help/module_color_audio_progress.png",
                        ),

                        array(
                            "param_name" => "separator",
                            "type"       => "text_separator",
                            'heading'    => 'Read more button',
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Layout'
                        ),
                        array(
                            "param_name"  => "show_btn",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                'Show' => 'block',
                                'Hide' => 'none',
                            ),
                            "heading"     => 'Show button',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_show.png",
                        ),
                        array(
                            "param_name"  => "btn_pos",
                            "type"        => "dropdown",
                            "value"       => array(
                                'Above image' => 'top',
                                'Under image' => 'bottom',
                            ),
                            "heading"     => 'Button position',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-big",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_position.png",
                        ),
                        array(
                            "param_name"  => "btn_title",
                            "type"        => "textfield",
                            "value"       => '',
                            "heading"     => 'Button text',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "Read more",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_text.png",
                        ),
                        array(
                            "param_name"  => "btn_margin",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Button space',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "0px 0px 20px 0px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_space.png",
                        ),
                        array(
                            "param_name"  => "btn_padding",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Button padding',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-big",
                            "placeholder" => "10px 15px",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_padding.png",
                        ),
                        array(
                            "param_name"  => "btn_border_width",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Button border width',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "0",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_border.png",
                        ),
                        array(
                            "param_name"  => "btn_radius",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Button radius',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "0",
                            "group"       => "Layout",
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_radius.png",
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Style',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Button background',
                            "param_name"  => "btn_bg",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_color_bg.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Button background hover',
                            "param_name"  => "btn_bg_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Button text color',
                            "param_name"  => "btn_txt",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_color_text.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Button text hover',
                            "param_name"  => "btn_txt_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-a",
                            "heading"     => 'Button border color',
                            "param_name"  => "btn_border",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                            "info_img" => "https://cloud.tagdiv.com/help/module_button_border_color.png",
                        ),
                        array(
                            "type"        => "colorpicker",
                            "holder"      => "div",
                            "class"       => "td-colorpicker-double-b",
                            "heading"     => 'Button border hover',
                            "param_name"  => "btn_border_hover",
                            "value"       => '',
                            "description" => '',
                            "group"       => 'Style',
                        ),
                        array(
                            "param_name" => "separator",
                            "type"       => "horizontal_separator",
                            "value"      => "",
                            "class"      => "tdc-separator-small",
                            "group"       => 'Style',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_btn', false, 'Article read more button', 'Style', '', '', 'https://cloud.tagdiv.com/help/module_font_article_read.png', '' )
                )
            )
        );

    }

}
