<?php
    global $post;

    $tds_locker_types_meta = get_post_meta( $post->ID, 'tds_locker_types', true );
    $tds_locker_types = empty( $tds_locker_types_meta ) ? array() : $tds_locker_types_meta;

    $setting_disabled_class = '';
    if( !empty( $tds_locker_types['tds_payable'] ) && $tds_locker_types['tds_payable'] == 'paid_subscription' ) {
        $setting_disabled_class = 'td-op-disabled';
    }

    $credits_locker_settings_disabled_class = '';
    if ( empty($tds_locker_types['tds_locker_credits_unlock']) ) {
        $credits_locker_settings_disabled_class = 'td-op-disabled';
    }

    $tds_new_values = get_post_meta( $post->ID, 'tds_new_values', true );

?>

<div class="td-meta-box-inside">

	<div class="td-page-option-panel td-post-option-general td-page-option-panel-active">

        <!--<pre>-->
            <?php //print_r($mb); ?>
            <?php //print_r( get_post_meta( $mb->current_post_id, 'tds_locker_settings', true ) ); ?>
        <!--</pre>-->

        <!-- regular locker options section -->
        <div class="td-op-section">

            <!-- options section title -->
            <h3 class="td-meta-box-col-title td-op-section-title">Regular Locker Options</h3>

            <div class="td-op-meta-box-row">

                <div class="td-meta-box-col td-meta-box-col-layout">

                    <!-- locker title -->
                    <div class="td-meta-box-row">
                        <?php
                            $mb->the_field('tds_title');
                            $tds_title_val = empty($tds_new_values) ? "This Content Is Only For Subscribers" : ($mb->have_value() ? $mb->get_the_value() : '');
                        ?>
                        <span class="td-page-o-custom-label">Locker Title:</span>
                        <input id="tds-title" class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $tds_title_val ?>" />
                        <span class="td-page-o-info">Type a header which attracts attention or calls to action. You can leave this field empty.</span>
                    </div>

                    <!-- locker message -->
                    <div class="td-meta-box-row">
                        <?php
                            $mb->the_field('tds_message');
                            $tds_message_val = empty($tds_new_values) ? "Please subscribe to unlock this content. Enter your email to get access." : ($mb->have_value() ? $mb->get_the_value() : '');
                        ?>
                        <span class="td-page-o-custom-label td_text_area_label">Locker Message:</span>
                        <textarea id="tds-message" name="<?php $mb->the_name(); ?>" class="td-textarea-message"><?php echo $tds_message_val ?></textarea>
                        <span class="td-page-o-info">Type a message which will appear under the header.</span>
                    </div>

                    <!-- locker input placeholder -->
                    <div class="td-meta-box-row td-op-to-disable <?php echo $setting_disabled_class ?>">
                        <?php
                            $mb->the_field('tds_input_placeholder');
                            $tds_input_placeholder_val = empty($tds_new_values) ? "Please enter your email address" : ($mb->have_value() ? $mb->get_the_value() : '');
                        ?>
                        <span class="td-page-o-custom-label">Input Placeholder:</span>
                        <input id="tds-input-placeholder" class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $tds_input_placeholder_val ?>"/>
                        <span class="td-page-o-info">Type a placeholder. You can leave this field empty.</span>
                    </div>

                </div>

                <div class="td-meta-box-col">

                    <!-- locker submit button text -->
                    <div class="td-meta-box-row">
                        <?php
                            $mb->the_field('tds_submit_btn_text');
                            $tds_submit_btn_text_val = empty($tds_new_values) ? "Subscribe to unlock" : ($mb->have_value() ? $mb->get_the_value() : '');
                        ?>
                        <span class="td-page-o-custom-label">Button Text:</span>
                        <input id="tds-submit-btn-text" class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $tds_submit_btn_text_val ?>"/>
                        <span class="td-page-o-info">The text on the button. Call to action!</span>
                    </div>

                    <!-- locker after button text -->
                    <div class="td-meta-box-row">
                        <?php
                            $mb->the_field('tds_after_btn_text');
                            $tds_after_btn_text_val = empty($tds_new_values) ? "Your email address is 100% safe from spam!" : ($mb->have_value() ? $mb->get_the_value() : '');
                        ?>
                        <span class="td-page-o-custom-label">After Button Text:</span>
                        <input id="tds-after-btn-text" class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $tds_after_btn_text_val ?>"/>
                        <span class="td-page-o-info">The text below the button. Guarantee something.</span>
                    </div>

                    <!-- locker privacy policy message -->
                    <div class="td-meta-box-row">
                        <?php
                            $mb->the_field('tds_pp_msg');
                            $tds_pp_msg_val = empty($tds_new_values) ? 'I consent to processing of my data according to <a href="#">Terms of Use</a> & <a href="#">Privacy Policy</a>' : ($mb->have_value() ? $mb->get_the_value() : '');
                        ?>
                        <span class="td-page-o-custom-label td_text_area_label">Privacy Policy Consent Message:</span>
                        <textarea id="tds-pp-msg" name="<?php $mb->the_name(); ?>" class="td-textarea-message"><?php echo $tds_pp_msg_val ?></textarea>
                        <span class="td-page-o-info">Consent Message & Checkbox for GDPR compatibility.</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- locker custom fields options section -->
        <div class="td-op-section">
            
            <div class="td-op-meta-box-row td-op-meta-box-row-cf">
                <!-- locker custom field 1 -->
                <div class="td-meta-box-col">
                    <h3 class="td-meta-box-col-title <?php echo $setting_disabled_class ?>">Custom field 1</h3>

                    <div class="td-op-meta-box-row">
                        <div class="td-meta-box-col td-meta-box-col-cf-checks">
                            <!-- locker custom field 1 state checkbox -->
                            <div class="td-meta-box-row">
                                <?php $mb->the_field('tds_locker_cf_1_state'); ?>
                                <input id="tds-locker-cf-1-state" class="tds-locker-cf-1-state" style="" type="checkbox" name="<?php $mb->the_name(); ?>" value="1" <?php if ( $mb->get_the_value() ) echo ' checked="checked"'; ?>/>
                                <span class="" style="font-size: 13px; font-weight: bold; line-height: 19px;">Enable</span>
                            </div>

                            <!-- locker custom field 1 required checkbox -->
                            <div class="td-meta-box-row">
                                <?php $mb->the_field('tds_locker_cf_1_req'); ?>
                                <input id="tds-locker-cf-1-req" class="tds-locker-cf-1-req" style="" type="checkbox" name="<?php $mb->the_name(); ?>" value="1" <?php if ( $mb->get_the_value() ) echo ' checked="checked"'; ?>/>
                                <span class="" style="font-size: 13px; font-weight: bold; line-height: 19px;">Required</span>
                            </div>
                        </div>

                        <div class="td-meta-box-col td-meta-box-col-cf-name">
                            <!-- locker custom field 1 name -->
                            <div class="td-meta-box-row">
                                <?php
                                    $mb->the_field('tds_locker_cf_1_name');
                                    $tds_cf_1_val = ( $mb->have_value() ) ? $mb->get_the_value() : "Custom field 1";
                                ?>
                                <span class="td-page-o-custom-label">Name:</span>
                                <input id="tds-locker-cf-1-name" class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $tds_cf_1_val ?>" />
                                <span class="td-page-o-info">Type a name for this custom field.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- locker custom field 2 -->
                <div class="td-meta-box-col">
                    <h3 class="td-meta-box-col-title <?php echo $setting_disabled_class ?>">Custom field 2</h3>

                    <div class="td-op-meta-box-row">
                        <div class="td-meta-box-col td-meta-box-col-cf-checks">
                            <!-- locker custom field 2 state checkbox -->
                            <div class="td-meta-box-row td-op-to-disable <?php echo $setting_disabled_class ?>">
                                <?php $mb->the_field('tds_locker_cf_2_state'); ?>
                                <input id="tds-locker-cf-2-state" class="tds-locker-cf-2-state" style="" type="checkbox" name="<?php $mb->the_name(); ?>" value="1" <?php if ( $mb->get_the_value() ) echo ' checked="checked"'; ?>/>
                                <span class="" style="font-size: 13px; font-weight: bold; line-height: 19px;">Enable</span>
                            </div>

                            <!-- locker custom field 2 required checkbox -->
                            <div class="td-meta-box-row td-op-to-disable <?php echo $setting_disabled_class ?>">
                                <?php $mb->the_field('tds_locker_cf_2_req'); ?>
                                <input id="tds-locker-cf-2-req" class="tds-locker-cf-2-req" style="" type="checkbox" name="<?php $mb->the_name(); ?>" value="1" <?php if ( $mb->get_the_value() ) echo ' checked="checked"'; ?>/>
                                <span class="" style="font-size: 13px; font-weight: bold; line-height: 19px;">Required</span>
                            </div>
                        </div>

                        <div class="td-meta-box-col td-meta-box-col-cf-name">
                            <!-- locker custom field 2 name -->
                            <div class="td-meta-box-row td-op-to-disable <?php echo $setting_disabled_class ?>">
                                <?php
                                    $mb->the_field('tds_locker_cf_2_name');
                                    $tds_cf_2_val = ( $mb->have_value() ) ? $mb->get_the_value() : "Custom field 2";
                                ?>
                                <span class="td-page-o-custom-label">Name:</span>
                                <input id="tds-locker-cf-2-name" class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $tds_cf_2_val ?>" />
                                <span class="td-page-o-info">Type a name for this custom field.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- locker custom field 3 -->
                <div class="td-meta-box-col">
                    <h3 class="td-meta-box-col-title <?php echo $setting_disabled_class ?>">Custom field 3</h3>

                    <div class="td-op-meta-box-row">
                        <div class="td-meta-box-col td-meta-box-col-cf-checks">
                            <!-- locker custom field 3 state checkbox -->
                            <div class="td-meta-box-row td-op-to-disable <?php echo $setting_disabled_class ?>">
                                <?php $mb->the_field('tds_locker_cf_3_state'); ?>
                                <input id="tds-locker-cf-3-state" class="tds-locker-cf-3-state" style="" type="checkbox" name="<?php $mb->the_name(); ?>" value="1" <?php if ( $mb->get_the_value() ) echo ' checked="checked"'; ?>/>
                                <span class="" style="font-size: 13px; font-weight: bold; line-height: 19px;">Enable</span>
                            </div>

                            <!-- locker custom field 3 required checkbox -->
                            <div class="td-meta-box-row td-op-to-disable <?php echo $setting_disabled_class ?>">
                                <?php $mb->the_field('tds_locker_cf_3_req'); ?>
                                <input id="tds-locker-cf-3-req" class="tds-locker-cf-3-req" style="" type="checkbox" name="<?php $mb->the_name(); ?>" value="1" <?php if ( $mb->get_the_value() ) echo ' checked="checked"'; ?>/>
                                <span class="" style="font-size: 13px; font-weight: bold; line-height: 19px;">Required</span>
                            </div>
                        </div>

                        <div class="td-meta-box-col td-meta-box-col-cf-name">
                            <!-- locker custom field 3 name -->
                            <div class="td-meta-box-row td-op-to-disable <?php echo $setting_disabled_class ?>">
                                <?php
                                    $mb->the_field('tds_locker_cf_3_name');
                                    $tds_cf_3_val = ( $mb->have_value() ) ? $mb->get_the_value() : "Custom field 3";
                                ?>
                                <span class="td-page-o-custom-label">Name:</span>
                                <input id="tds-locker-cf-3-name" class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $tds_cf_3_val ?>" />
                                <span class="td-page-o-info">Type a name for this custom field.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- credits locker options section -->
        <div class="td-op-section">

            <!-- options section title -->
            <h3 class="td-meta-box-col-title td-meta-box-col-title-cl td-op-section-title <?php echo $credits_locker_settings_disabled_class ?>">Credits Locker Options</h3>

            <div class="td-op-meta-box-row">

                <div class="td-meta-box-col">

                    <!-- credits locker title -->
                    <div class="td-meta-box-row td-op-to-disable <?php echo $credits_locker_settings_disabled_class ?>">
                        <?php
                        $mb->the_field('tds_locker_credits_title');
                        $tds_locker_credits_title_val = $mb->have_value() ? $mb->get_the_value() : 'Buy This Article';
                        ?>
                        <span class="td-page-o-custom-label">Title:</span>
                        <input id="tds-locker-credits-title" class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $tds_locker_credits_title_val ?>" />
                        <span class="td-page-o-info">Type a header which attracts attention or calls to action. You can leave this field empty.</span>
                    </div>

                    <!-- credits locker message -->
                    <div class="td-meta-box-row td-op-to-disable <?php echo $credits_locker_settings_disabled_class ?>">
                        <?php
                        $mb->the_field('tds_locker_credits_message');
                        $tds_locker_credits_message_val = $mb->have_value() ? $mb->get_the_value() : 'Unlock this article and gain permanent access to read it. <br> Unlock credits cost: <b>%unlock_credits_cost%</b><br> <span class=\'tds-not-logged-hide\'>Available credits: <b>%available_credits%</b><span>';
                        ?>
                        <span class="td-page-o-custom-label td_text_area_label">
                            Message:
                            <?php

                            td_util::tooltip_html(
                                '<h3>The following placeholders are available:</h3>
                                        <ul>
                                            <li><b>%unlock_credits_cost%</b> - will be replaced in the locker\'s message with the number of credits needed to unlock the locked post.</li>
                                            <li><b>%available_credits%</b> - will be replaced in the locker\'s message with the number of current user\'s available credits.</li>
                                        </ul>
                                        <p>HTML elements with class <b>\'tds-not-logged-hide\'</b> can be used to display info just for logged-in users.</p>
                                ','right'
                            );

                            $tds_example = 'Unlock this article and gain permanent access to read it. <br>
                                            Unlock credits cost: <b>%unlock_credits_cost%</b><br>
                                            <span class=\'tds-not-logged-hide\'>Available credits: <b>%available_credits%</b><span>';

                            echo '<a href="#" class="td-tooltip" data-position="top" title="' . htmlspecialchars($tds_example) . '"  style="left: 115px; top: 25px; font-size: 10px;">Ex.</a>';

                            ?>
                        </span>
                        <textarea id="tds-locker-credits-message" name="<?php $mb->the_name(); ?>" class="td-textarea-message"><?php echo $tds_locker_credits_message_val ?></textarea>
                        <span class="td-page-o-info">Type a message which will appear under the header.</span>
                    </div>

                    <!-- credits locker btn text -->
                    <div class="td-meta-box-row td-op-to-disable <?php echo $credits_locker_settings_disabled_class ?>">
                        <?php
                        $mb->the_field('tds_locker_credits_btn_text');
                        $tds_locker_credits_btn_text_val = $mb->have_value() ? $mb->get_the_value() : 'Unlock now';
                        ?>
                        <span class="td-page-o-custom-label td_text_area_label">Button Text:</span>
                        <input id="tds-locker-credits-btn-text" class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $tds_locker_credits_btn_text_val ?>" />
                        <span class="td-page-o-info">The text on the credits locker button.</span>
                    </div>

                </div>

                <div class="td-meta-box-col">

                    <!-- credits locker btn redirect url -->
                    <div class="td-meta-box-row td-op-to-disable <?php echo $credits_locker_settings_disabled_class ?>">
                        <?php
                        $mb->the_field('tds_locker_credits_btn_rdr_url');
                        $tds_locker_credits_btn_rdr_url_val = $mb->have_value() ? $mb->get_the_value() : '';
                        $tds_pages_link = admin_url( 'edit.php?post_type=tds_email&page=td_settings#page' );
                        ?>
                        <span class="td-page-o-custom-label td_text_area_label">
                            Redirect URL:
                            <?php td_util::tooltip_html('<p>Please note that if this filed is empty the user will be redirected to the <b>Login/Register</b> page set in <a href="' . $tds_pages_link . '" target="_blank"><em>Opt-In Builder Subscriptions > Pages > Login/Register page</em></a> option.', 'right' ); ?>
                        </span>
                        <input id="tds-locker-credits-redr-url" class="td-input-text-post-settings" style="width: 100%;" type="url" name="<?php $mb->the_name(); ?>" value="<?php echo $tds_locker_credits_btn_rdr_url_val ?>" />
                        <span class="td-page-o-info">The button redirect url used when not logged in users click the unlock button.</span>
                    </div>

                    <!-- credits locker separator enable -->
                    <div class="td-meta-box-row td-op-to-disable <?php echo $credits_locker_settings_disabled_class ?>" style="padding-left:0">
                        <?php
                        $mb->the_field('tds_locker_credits_sep_enabled');
                        $tds_locker_credits_sep_enabled_val = $mb->have_value() ? $mb->get_the_value() : '1';
                        ?>
                        <input id="tds-locker-credits-enable" class="tds-locker-credits-enable" style="" type="checkbox" name="<?php $mb->the_name(); ?>" value="1" <?php if ( $tds_locker_credits_sep_enabled_val ) echo ' checked="checked"'; ?>/>
                        <span class="" style="font-size: 13px; font-weight: bold; line-height: 19px;">Enable separator</span>
                    </div>

                    <!-- credits locker separator text -->
                    <div class="td-meta-box-row td-op-to-disable <?php echo $credits_locker_settings_disabled_class ?>">
                        <?php
                        $mb->the_field('tds_lc_sep_text');
                        $tds_locker_credits_sep_text_val = $mb->have_value() ? $mb->get_the_value() : 'OR';
                        ?>
                        <span class="td-page-o-custom-label td_text_area_label">Separator Text:</span>
                        <input id="tds-locker-credits-sep-text" class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php echo $tds_locker_credits_sep_text_val ?>" />
                        <span class="td-page-o-info">The text on the credits locker separator.</span>
                    </div>

                </div>

            </div>

        </div>

	</div>

</div>
