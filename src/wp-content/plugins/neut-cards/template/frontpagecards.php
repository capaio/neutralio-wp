<?php function getFrontpageNnews($nnews_array, $post_link) {
    $emoji_flags = [
        'US' => '🇺🇸',
        'IT' => '🇮🇹',
        'FR' => '🇫🇷',
        'DE' => '🇩🇪',
        'JP' => '🇯🇵',
        'UK' => '🇬🇧',
        'ES' => '🇪🇸',
    ];


    $nnews_array=array_slice($nnews_array, 0, 3);?>
<div class="td_flex_block_1 tdi_92 td-pb-border-top td_block_template_1 td_flex_block" data-td-block-uid="tdi_92">
<style>.tdi_92{margin-bottom:20px!important}@media (min-width:1019px) and (max-width:1140px){.tdi_92{margin-bottom:15px!important}}@media (min-width:768px) and (max-width:1018px){.tdi_92{margin-bottom:10px!important}}@media (max-width:767px){.tdi_92{margin-bottom:0px!important}}</style>
<style>.tdi_92 .entry-thumb{background-position:center 50%}.tdi_92 .td-module-container{flex-direction:column;border-color:#eaeaea!important}.tdi_92 .td-image-container{display:block;order:0}.ie10 .tdi_92 .td-module-meta-info,.ie11 .tdi_92 .td-module-meta-info{flex:auto}body .tdi_92 .td-favorite{font-size:36px;box-shadow:1px 1px 4px 0px rgba(0,0,0,0.2)}.tdi_92 .td-module-meta-info{padding:0px;border-color:#eaeaea}.tdi_92 .td_module_wrap{padding-left:20px;padding-right:20px;padding-bottom:20px;margin-bottom:20px}.tdi_92 .td_block_inner{margin-left:-20px;margin-right:-20px}.tdi_92 .td-module-container:before{bottom:-20px;border-width:0 0 1px 0;border-style:solid;border-color:#eaeaea;border-color:var(--news-hub-dark-grey)}.tdi_92 .td-post-vid-time{display:block}.tdi_92 .td-post-category{margin:0 13px 0 0;padding:2px 13px 2px 0;background-color:rgba(234,234,234,0);color:var(--news-hub-white);border-width:0 1px 0 0;border-style:solid;border-color:#aaa;border-color:var(--news-hub-dark-grey);font-family:Lato!important;font-size:12px!important;line-height:1.2!important;font-weight:700!important;text-transform:uppercase!important}.tdi_92 .td-post-category:not(.td-post-extra-category){display:inline-block}.tdi_92 .td-author-photo .avatar{width:20px;height:20px;margin-right:6px;border-radius:50%}.tdi_92 .td-excerpt{display:none;column-count:1;column-gap:48px}.tdi_92 .td-audio-player{opacity:1;visibility:visible;height:auto;font-size:13px}.tdi_92 .td-read-more{display:none}.tdi_92 .td-author-date{display:inline}.tdi_92 .td-post-author-name{display:none}.tdi_92 .td-post-date,.tdi_92 .td-post-author-name span{display:inline-block;color:var(--news-hub-light-grey)}.tdi_92 .entry-review-stars{display:none}.tdi_92 .td-icon-star,.tdi_92 .td-icon-star-empty,.tdi_92 .td-icon-star-half{font-size:15px}.tdi_92 .td-module-comments{display:none}.tdi_92 .td_module_wrap:nth-last-child(1){margin-bottom:0;padding-bottom:0}.tdi_92 .td_module_wrap:nth-last-child(1) .td-module-container:before{display:none}.tdi_92 .td-post-category:hover{background-color:rgba(234,234,234,0)!important;color:var(--news-hub-white)}.tdi_92 .td-module-title a{color:var(--news-hub-white);box-shadow:inset 0 0 0 0 #000}.tdi_92 .td_module_wrap:hover .td-module-title a{color:var(--news-hub-accent-hover)!important}.tdi_92 .entry-title{margin:0 0 14px;font-family:Lato!important;font-size:20px!important;line-height:1.25!important;font-weight:700!important}.tdi_92 .td-editor-date,.tdi_92 .td-editor-date .td-post-author-name a,.tdi_92 .td-editor-date .entry-date,.tdi_92 .td-module-comments a{font-family:Lato!important;font-size:12px!important;line-height:1.2!important}html:not([class*='ie']) .tdi_92 .td-module-container:hover .entry-thumb:before{opacity:0}@media (min-width:768px){.tdi_92 .td-module-title a{transition:all 0.2s ease;-webkit-transition:all 0.2s ease}}@media (min-width:1019px) and (max-width:1140px){.tdi_92 .td_module_wrap{padding-bottom:15px;margin-bottom:15px;padding-bottom:15px!important;margin-bottom:15px!important}.tdi_92 .td-module-container:before{bottom:-15px}.tdi_92 .td-post-category{margin:0 8px 0 0;padding:2px 11px 2px 0;font-size:11px!important}.tdi_92 .td_module_wrap:nth-last-child(1){margin-bottom:0!important;padding-bottom:0!important}.tdi_92 .td_module_wrap .td-module-container:before{display:block!important}.tdi_92 .td_module_wrap:nth-last-child(1) .td-module-container:before{display:none!important}.tdi_92 .td-module-title a{box-shadow:inset 0 0 0 0 #000}.tdi_92 .entry-title{margin:0 0 10px;font-size:17px!important}.tdi_92 .td-editor-date,.tdi_92 .td-editor-date .td-post-author-name a,.tdi_92 .td-editor-date .entry-date,.tdi_92 .td-module-comments a{font-size:11px!important}@media (min-width:768px){.tdi_92 .td-module-title a{transition:all 0.2s ease;-webkit-transition:all 0.2s ease}}}@media (min-width:768px) and (max-width:1018px){.tdi_92 .td_module_wrap{padding-bottom:10px;margin-bottom:10px;padding-bottom:10px!important;margin-bottom:10px!important}.tdi_92 .td-module-container:before{bottom:-10px}.tdi_92 .td-post-category{margin:0 7px 0 0;padding:2px 9px 2px 0;font-size:10px!important}.tdi_92 .td_module_wrap:nth-last-child(1){margin-bottom:0!important;padding-bottom:0!important}.tdi_92 .td_module_wrap .td-module-container:before{display:block!important}.tdi_92 .td_module_wrap:nth-last-child(1) .td-module-container:before{display:none!important}.tdi_92 .td-module-title a{box-shadow:inset 0 0 0 0 #000}.tdi_92 .entry-title{margin:0 0 6px;font-size:14px!important;line-height:1.15!important}.tdi_92 .td-editor-date,.tdi_92 .td-editor-date .td-post-author-name a,.tdi_92 .td-editor-date .entry-date,.tdi_92 .td-module-comments a{font-size:10px!important}@media (min-width:768px){.tdi_92 .td-module-title a{transition:all 0.2s ease;-webkit-transition:all 0.2s ease}}}@media (max-width:767px){.tdi_92 .td_module_wrap{padding-bottom:15px;margin-bottom:15px;padding-bottom:15px!important;margin-bottom:15px!important}.tdi_92 .td-module-container:before{bottom:-15px}.tdi_92 .td-post-category{margin:0 8px 0 0;padding:2px 11px 2px 0;font-size:11px!important}.tdi_92 .td_module_wrap:nth-last-child(1){margin-bottom:0!important;padding-bottom:0!important}.tdi_92 .td_module_wrap .td-module-container:before{display:block!important}.tdi_92 .td_module_wrap:nth-last-child(1) .td-module-container:before{display:none!important}.tdi_92 .td-module-title a{box-shadow:inset 0 0 0 0 #000}.tdi_92 .entry-title{margin:0 0 10px;font-size:16px!important}.tdi_92 .td-editor-date,.tdi_92 .td-editor-date .td-post-author-name a,.tdi_92 .td-editor-date .entry-date,.tdi_92 .td-module-comments a{font-size:11px!important}@media (min-width:768px){.tdi_92 .td-module-title a{transition:all 0.2s ease;-webkit-transition:all 0.2s ease}}}</style><script>var block_tdi_92 = new tdBlock();
block_tdi_92.id = "tdi_92";
block_tdi_92.atts = '{"modules_on_row":"","limit":"4","hide_audio":"yes","tdc_css":"eyJhbGwiOnsibWFyZ2luLWJvdHRvbSI6IjIwIiwiZGlzcGxheSI6IiJ9LCJsYW5kc2NhcGUiOnsibWFyZ2luLWJvdHRvbSI6IjE1IiwiZGlzcGxheSI6IiJ9LCJsYW5kc2NhcGVfbWF4X3dpZHRoIjoxMTQwLCJsYW5kc2NhcGVfbWluX3dpZHRoIjoxMDE5LCJwb3J0cmFpdCI6eyJtYXJnaW4tYm90dG9tIjoiMTAiLCJkaXNwbGF5IjoiIn0sInBvcnRyYWl0X21heF93aWR0aCI6MTAxOCwicG9ydHJhaXRfbWluX3dpZHRoIjo3NjgsInBob25lIjp7Im1hcmdpbi1ib3R0b20iOiIwIiwiZGlzcGxheSI6IiJ9LCJwaG9uZV9tYXhfd2lkdGgiOjc2N30=","hide_image":"yes","show_author":"none","show_review":"none","show_com":"none","show_excerpt":"none","show_btn":"none","title_txt":"var(--news-hub-white)","f_title_font_family":"325","f_title_font_weight":"700","f_title_font_size":"eyJhbGwiOiIyMCIsImxhbmRzY2FwZSI6IjE3IiwicG9ydHJhaXQiOiIxNCIsInBob25lIjoiMTYifQ==","f_title_font_line_height":"eyJhbGwiOiIxLjI1IiwibGFuZHNjYXBlIjoiMS4yIiwicG9ydHJhaXQiOiIxLjE1IiwicGhvbmUiOiIxLjIifQ==","meta_padding":"0","modules_divider":"solid","modules_divider_color":"var(--news-hub-dark-grey)","all_modules_space":"eyJhbGwiOiI0MCIsImxhbmRzY2FwZSI6IjMwIiwicG9ydHJhaXQiOiIyMCIsInBob25lIjoiMzAifQ==","title_txt_hover":"var(--news-hub-accent-hover)","f_meta_font_family":"325","f_meta_font_size":"eyJhbGwiOiIxMiIsImxhbmRzY2FwZSI6IjExIiwicG9ydHJhaXQiOiIxMCIsInBob25lIjoiMTEifQ==","f_meta_font_line_height":"1.2","f_cat_font_size":"eyJhbGwiOiIxMiIsImxhbmRzY2FwZSI6IjExIiwicG9ydHJhaXQiOiIxMCIsInBob25lIjoiMTEifQ==","f_cat_font_line_height":"1.2","f_cat_font_weight":"700","f_cat_font_family":"325","f_cat_font_transform":"uppercase","date_txt":"var(--news-hub-light-grey)","cat_bg":"rgba(234,234,234,0)","cat_bg_hover":"rgba(234,234,234,0)","cat_txt":"var(--news-hub-white)","cat_txt_hover":"var(--news-hub-white)","modules_category_padding":"eyJhbGwiOiIycHggMTNweCAycHggMCIsImxhbmRzY2FwZSI6IjJweCAxMXB4IDJweCAwIiwicG9ydHJhaXQiOiIycHggOXB4IDJweCAwIiwicGhvbmUiOiIycHggMTFweCAycHggMCJ9","modules_cat_border":"0 1px 0 0","cat_border":"var(--news-hub-dark-grey)","modules_category_margin":"eyJhbGwiOiIwIDEzcHggMCAwIiwibGFuZHNjYXBlIjoiMCA4cHggMCAwIiwicG9ydHJhaXQiOiIwIDdweCAwIDAiLCJwaG9uZSI6IjAgOHB4IDAgMCJ9","art_title":"eyJhbGwiOiIwIDAgMTRweCIsImxhbmRzY2FwZSI6IjAgMCAxMHB4IiwicG9ydHJhaXQiOiIwIDAgNnB4IiwicGhvbmUiOiIwIDAgMTBweCJ9","excl_txt":"Premium","excl_margin":"eyJhbGwiOiIwIDhweCAwIDAiLCJsYW5kc2NhcGUiOiIwIDZweCAwIDAiLCJwb3J0cmFpdCI6IjAgNHB4IDAgMCIsInBob25lIjoiMCA1cHggMCAwIn0=","excl_padd":"eyJhbGwiOiIzcHggNnB4IDJweCIsImxhbmRzY2FwZSI6IjJweCA1cHggMnB4IiwicG9ydHJhaXQiOiIxcHggNHB4IDJweCIsInBob25lIjoiMXB4IDRweCAycHgifQ==","f_excl_font_family":"325","excl_bg":"var(--news-hub-accent)","f_excl_font_weight":"700","f_excl_font_transform":"uppercase","f_excl_font_size":"eyJhbGwiOiIxMyIsImxhbmRzY2FwZSI6IjEyIiwicG9ydHJhaXQiOiIxMSIsInBob25lIjoiMTEifQ==","offset":"1","ajax_pagination":"","block_type":"td_flex_block_1","separator":"","custom_title":"","custom_url":"","block_template_id":"","title_tag":"","mc1_tl":"","mc1_title_tag":"","mc1_el":"","post_ids":"","category_id":"","taxonomies":"","category_ids":"","in_all_terms":"","tag_slug":"","autors_id":"","installed_post_types":"","include_cf_posts":"","exclude_cf_posts":"","sort":"","popular_by_date":"","linked_posts":"","favourite_only":"","open_in_new_window":"","show_modified_date":"","time_ago":"","time_ago_add_txt":"ago","time_ago_txt_pos":"","review_source":"","el_class":"","td_query_cache":"","td_query_cache_expiration":"","td_ajax_filter_type":"","td_ajax_filter_ids":"","td_filter_default_txt":"All","td_ajax_preloading":"","container_width":"","modules_gap":"","m_padding":"","modules_border_size":"","modules_border_style":"","modules_border_color":"#eaeaea","modules_border_radius":"","h_effect":"","image_size":"","image_alignment":"50","image_height":"","image_width":"","image_floated":"no_float","image_radius":"","show_favourites":"","fav_size":"2","fav_space":"","fav_ico_color":"","fav_ico_color_h":"","fav_bg":"","fav_bg_h":"","fav_shadow_shadow_header":"","fav_shadow_shadow_title":"Shadow","fav_shadow_shadow_size":"","fav_shadow_shadow_offset_horizontal":"","fav_shadow_shadow_offset_vertical":"","fav_shadow_shadow_spread":"","fav_shadow_shadow_color":"","video_icon":"","video_popup":"yes","video_rec":"","spot_header":"","video_rec_title":"","video_rec_color":"","video_rec_disable":"","autoplay_vid":"yes","show_vid_t":"block","vid_t_margin":"","vid_t_padding":"","video_title_color":"","video_title_color_h":"","video_bg":"","video_overlay":"","vid_t_color":"","vid_t_bg_color":"","f_vid_title_font_header":"","f_vid_title_font_title":"Video pop-up article title","f_vid_title_font_settings":"","f_vid_title_font_family":"","f_vid_title_font_size":"","f_vid_title_font_line_height":"","f_vid_title_font_style":"","f_vid_title_font_weight":"","f_vid_title_font_transform":"","f_vid_title_font_spacing":"","f_vid_title_":"","f_vid_time_font_title":"Video duration text","f_vid_time_font_settings":"","f_vid_time_font_family":"","f_vid_time_font_size":"","f_vid_time_font_line_height":"","f_vid_time_font_style":"","f_vid_time_font_weight":"","f_vid_time_font_transform":"","f_vid_time_font_spacing":"","f_vid_time_":"","meta_info_align":"","meta_info_horiz":"layout-default","meta_width":"","meta_margin":"","meta_space":"","art_btn":"","meta_info_border_size":"","meta_info_border_style":"","meta_info_border_color":"#eaeaea","meta_info_border_radius":"","modules_category":"","modules_category_radius":"0","show_cat":"inline-block","modules_extra_cat":"","author_photo":"","author_photo_size":"","author_photo_space":"","author_photo_radius":"","show_date":"inline-block","review_space":"","review_size":"2.5","review_distance":"","art_excerpt":"","excerpt_col":"1","excerpt_gap":"","excerpt_middle":"","excerpt_inline":"","show_audio":"block","art_audio":"","art_audio_size":"1.5","btn_title":"","btn_margin":"","btn_padding":"","btn_border_width":"","btn_radius":"","pag_space":"","pag_padding":"","pag_border_width":"","pag_border_radius":"","prev_tdicon":"","next_tdicon":"","pag_icons_size":"","f_header_font_header":"","f_header_font_title":"Block header","f_header_font_settings":"","f_header_font_family":"","f_header_font_size":"","f_header_font_line_height":"","f_header_font_style":"","f_header_font_weight":"","f_header_font_transform":"","f_header_font_spacing":"","f_header_":"","f_ajax_font_title":"Ajax categories","f_ajax_font_settings":"","f_ajax_font_family":"","f_ajax_font_size":"","f_ajax_font_line_height":"","f_ajax_font_style":"","f_ajax_font_weight":"","f_ajax_font_transform":"","f_ajax_font_spacing":"","f_ajax_":"","f_more_font_title":"Load more button","f_more_font_settings":"","f_more_font_family":"","f_more_font_size":"","f_more_font_line_height":"","f_more_font_style":"","f_more_font_weight":"","f_more_font_transform":"","f_more_font_spacing":"","f_more_":"","f_title_font_header":"","f_title_font_title":"Article title","f_title_font_settings":"","f_title_font_style":"","f_title_font_transform":"","f_title_font_spacing":"","f_title_":"","f_cat_font_title":"Article category tag","f_cat_font_settings":"","f_cat_font_style":"","f_cat_font_spacing":"","f_cat_":"","f_meta_font_title":"Article meta info","f_meta_font_settings":"","f_meta_font_style":"","f_meta_font_weight":"","f_meta_font_transform":"","f_meta_font_spacing":"","f_meta_":"","f_ex_font_title":"Article excerpt","f_ex_font_settings":"","f_ex_font_family":"","f_ex_font_size":"","f_ex_font_line_height":"","f_ex_font_style":"","f_ex_font_weight":"","f_ex_font_transform":"","f_ex_font_spacing":"","f_ex_":"","f_btn_font_title":"Article read more button","f_btn_font_settings":"","f_btn_font_family":"","f_btn_font_size":"","f_btn_font_line_height":"","f_btn_font_style":"","f_btn_font_weight":"","f_btn_font_transform":"","f_btn_font_spacing":"","f_btn_":"","mix_color":"","mix_type":"","fe_brightness":"1","fe_contrast":"1","fe_saturate":"1","mix_color_h":"","mix_type_h":"","fe_brightness_h":"1","fe_contrast_h":"1","fe_saturate_h":"1","m_bg":"","color_overlay":"","shadow_shadow_header":"","shadow_shadow_title":"Module Shadow","shadow_shadow_size":"","shadow_shadow_offset_horizontal":"","shadow_shadow_offset_vertical":"","shadow_shadow_spread":"","shadow_shadow_color":"","all_underline_height":"","all_underline_color":"","cat_style":"","cat_border_hover":"","meta_bg":"","author_txt":"","author_txt_hover":"","ex_txt":"","com_bg":"","com_txt":"","rev_txt":"","audio_btn_color":"","audio_time_color":"","audio_bar_color":"","audio_bar_curr_color":"","shadow_m_shadow_header":"","shadow_m_shadow_title":"Meta info shadow","shadow_m_shadow_size":"","shadow_m_shadow_offset_horizontal":"","shadow_m_shadow_offset_vertical":"","shadow_m_shadow_spread":"","shadow_m_shadow_color":"","btn_bg":"","btn_bg_hover":"","btn_txt":"","btn_txt_hover":"","btn_border":"","btn_border_hover":"","pag_text":"","pag_h_text":"","pag_bg":"","pag_h_bg":"","pag_border":"","pag_h_border":"","ajax_pagination_next_prev_swipe":"","ajax_pagination_infinite_stop":"","css":"","td_column_number":1,"header_color":"","color_preset":"","border_top":"","class":"tdi_92","tdc_css_class":"tdi_92","tdc_css_class_style":"tdi_92_rand_style"}';
block_tdi_92.td_column_number = "1";
block_tdi_92.block_type = "td_flex_block_1";
block_tdi_92.post_count = "4";
block_tdi_92.found_posts = "16";
block_tdi_92.header_color = "";
block_tdi_92.ajax_pagination_infinite_stop = "";
block_tdi_92.max_num_pages = "4";
tdBlocksArray.push(block_tdi_92);
</script><div class="td-block-title-wrap"></div><div id="tdi_92" class="td_block_inner td-mc1-wrap">

        <?php foreach ($nnews_array as $news) { ?>
        <div class="td_module_flex td_module_flex_1 td_module_wrap td-animation-stack td-cpt-post">
            <div class="td-module-container td-category-pos-">
                <div class="td-module-meta-info frontpagecards">
                    <div class="newspaper-stripe">
                        <div class="newspaper-info">
                            <img style="margin-bottom:0px!important" src="<?php echo esc_url($news->newspaper_logo); ?>" alt="Logo">
                            <div class="newspaper-name"><?php echo esc_html($news->newspaper_name); ?> <?php if ($emoji_flags[$news->nazione]) {echo $emoji_flags[$news->nazione];} ?></div>
                        </div>
                    </div>
                    <h3 class="entry-title td-module-title"><a href="<?php echo $post_link ?>"><?php echo $news->title ?> </a></h3>
                            <?php /*<div class="category-scores">
                                <div class="category_neut">
                                    <i class="fas fa-check-double"></i> Accuratezza<br>
                                    <div class="stars">
                                        <?php echo str_repeat('<i class="fas fa-star"></i>', round($news->factual_points / 20)); ?>
                                    </div>
                                </div>
                                <div class="category_neut">
                                    <i class="fas fa-balance-scale"></i> Opinioni o Fatti<br>
                                    <div class="bar-container fact-opinion-bar">
                                        <div class="triangle" style="left:<?php echo $news->fact_vs_opinion_score; ?>%;"></div>
                                    </div>
                                </div>
                                <div class="category_neut">
                                    <?php get_political_bias($news->political_points); ?>
                                </div>
                                <div class="category_neut">
                                    <i class="fas fa-shield-alt"></i> Credibilità<br>
                                    <div class="stars">
                                        <?php echo str_repeat('<i class="fas fa-star"></i>', round($news->credibility_score / 20)); ?>
                                    </div>
                                </div>
                            </div>*/ ?>

                            <!-- Overall Score -->
                            <div class="total-score">
                                <i class="fas fa-star"></i> NScore: <?php echo round($news->n_score); ?>/100
                                <span class="score-info-icon" tabindex="0"> <!-- Question mark icon -->
                                        <i class="fas fa-question-circle"></i>
                                    </span>

                                    <!-- Tooltip popup content -->
                                    <div class="popup-content">
                                        NScore è il punteggio che Neutralio assegna a ciascuna notizia. Esso è calcolato sulla base di un algoritmo proprietario. Tra i fattori tenuti in considerazione ci sono accuratezza, obiettività, bias politico (a prescindere se destra o sinistra) e credibilità. NScore varia da 0 a 100, dove 0 rappresenta la notizia meno affidabile e 100 la più affidabile.
                                    </div>
                            </div>
                    </div>
            </div>
        </div>
    <? } ?>


        </div></div>
    <?php }
