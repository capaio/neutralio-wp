
<!-- locker state checkbox -->
<div class="td-meta-box-row">
	<?php $mb->the_field('tds_lock_content'); ?>
    <span class="td-page-o-custom-label">Lock Content: <?php td_util::tooltip_html('<h3>Full content lock:</h3><p>The post content will be locked for non-subscribed users. The content unlocks only if users subscribe to your emailing list.</p>', 'right'); ?></span>
    <input id="tds-lock-content"
           class=""
           style="position: relative; top: 7px; margin: 0; left: 3px;"
           type="checkbox"
           name="<?php $mb->the_name(); ?>"
           value="1"
           <?php if ( $mb->get_the_value() ) echo ' checked="checked"'; ?>
    />
</div>

<!-- locker select -->
<div class="td-meta-box-row">
	<span class="td-page-o-custom-label">Locker: <?php td_util::tooltip_html('<h3>#ID - Name - Custom Slug (optional):</h3><p>The Custom Slug has higher priority then ID, if it\'s set.</p>', 'right'); ?></span>
	<?php

	// locker id
	$mb->the_field('tds_locker');

	// the default locker id
	$default_locker_id = (int) get_option( 'tds_default_locker_id' );

	// default list select state
	$def_locker_select_state = ( $mb->have_value() ) ? '' : ' selected="selected"';

	?>
	<div class="td-select-style-overwrite td-inline-block-wrap">
        <?php

        // get tds lockers
        $tds_lockers = get_posts(
            array(
                'post_type' => 'tds_locker',
                'post_status' => 'publish',
                'numberposts' => -1, // get all, no limit
                'post__not_in' => array( $default_locker_id ), // exclude default locker
            )
        );

        ?>
		<select name="<?php $mb->the_name(); ?>" class="td-panel-dropdown">
            <option value="<?php echo $default_locker_id; ?>"<?php echo $def_locker_select_state; ?>>#<?php echo $default_locker_id ?> - Default Locker</option>
			<?php

            $locker_edit_url = null;

			if ( !empty( $tds_lockers ) && is_array( $tds_lockers ) ) {
				foreach ( $tds_lockers as $locker ) {

				    $custom_slug = '';
				    $tds_locker_types = get_post_meta( $locker->ID, 'tds_locker_types', true );
                    if (!empty($tds_locker_types['tds_locker_slug'])) {
                        $custom_slug = $tds_locker_types['tds_locker_slug'];
                    }

                    $current_state = '';
                    $tds_locker_types = get_post_meta( $locker->ID, 'tds_locker_types', true );
                    if (
                        ( !empty( $tds_locker_types['tds_locker_slug'] ) && $mb->get_the_value() === $tds_locker_types['tds_locker_slug'] ) ||
                        ( is_numeric( $mb->get_the_value() ) && $locker->ID === intval( $mb->get_the_value() ) )
                    ) {
                        $current_state =' selected="selected"';
                    }

                    if (!empty($current_state) && empty($locker_edit_url)) {
                        $locker_edit_url = get_edit_post_link($locker);
                    }

					?>
                    <option value="<?php echo ( empty($custom_slug) ? $locker->ID : $custom_slug ) ?>"<?php echo $current_state ?>>
						<?php echo '#' . $locker->ID . ' - ' . $locker->post_title . ( empty( $custom_slug ) ? '' : ' - Custom slug: ' . $custom_slug )  ?>
                    </option>
					<?php
				}
			}
			?>
		</select>
	</div>

    <?php

    if ( !empty( $locker_edit_url ) ) {
        ?>

        <a href="<?php echo $locker_edit_url ?>" target="_blank" style="position: absolute;
                left: 400px;
                top: 7px;
                display: block;
                width: 120px;
                font-size: 13px;
                font-weight: bold;
                line-height: 19px;">Edit Current Locker</a>

        <?php
    }

    ?>
</div>

<!-- credits locker unlock cost -->
<div class="td-meta-box-row">
    <?php
    $mb->the_field('tds_locker_credits');
    $tds_locker_credits = $mb->have_value() ? $mb->get_the_value() : '';
    $tds_settings_link = admin_url( 'edit.php?post_type=tds_email&page=td_settings#settings' );
    ?>
    <span class="td-page-o-custom-label td_text_area_label">
        Unlock Cost:
        <?php td_util::tooltip_html('<p>The <b>Unlock Cost</b> represents the number of credits needed to unlock this post.<br>Please note that the default credits value set in <a href="' . $tds_settings_link . '" target="_blank"><em>Opt-In Builder Subscriptions > Settings > Credits Settings</em></a> for this post type will be considered if this filed is empty or a nonnumerical value is set.', 'right' ); ?>
    </span>
    <input id="tds-locker-credits" class="td-input-text-post-settings" type="number" min="0" name="<?php $mb->the_name(); ?>" value="<?php echo $tds_locker_credits ?>" />
    <span class="td-page-o-info">Credits cost to unlock this post.</span>
</div>