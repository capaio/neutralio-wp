<?php
wp_enqueue_editor();

$tdb_brand = defined('TD_COMPOSER') ? td_util::get_wl_val('tds_wl_brand', 'tagDiv') : 'tagDiv';
$tdb_brand_logo = defined('TD_COMPOSER') ? td_util::get_wl_val('tds_wl_logo', get_template_directory_uri() . '/includes/wp-booster/wp-admin/images/plugins/tagdiv-small.png') : get_template_directory_uri() . '/includes/wp-booster/wp-admin/images/plugins/tagdiv-small.png';
$tdb_brand_url = defined('TD_COMPOSER') ? td_util::get_wl_val('tds_wl_logo_url', 'https://tagdiv.com?utm_source=theme&utm_medium=logo&utm_campaign=tagdiv&utm_content=click_hp') : 'https://tagdiv.com?utm_source=theme&utm_medium=logo&utm_campaign=tagdiv&utm_content=click_hp';
?>


<div class="about-wrap td-wp-admin-header ">
    <div class="td-wp-admin-top">
        <a class="td-tagdiv-link" href="<?php echo $tdb_brand_url ?>"><img class="td-tagdiv-brand" src="<?php echo $tdb_brand_logo ?>" /></a>
        <div class="td-wp-admin-theme">
            <h1>Opt-In Builder Subscriptions</h1>
            <span>Your Membership Management Plugin by <?php echo $tdb_brand ?></span>
        </div>
        <div class="td-welcome-version">Version: <b><?php echo TD_SUBSCRIPTION_VERSION ?></b></div>

    </div>
    <h2 class="nav-tab-wrapper subscription" style="display: none">
        <a href="#dashboard" class="nav-tab" data-route="dashboard">Dashboard</a>
        <a href="#billing" class="nav-tab" data-route="billing">Account</a>
        <a href="#payments" class="nav-tab" data-route="payment">Payments</a>
        <a href="#plans" class="nav-tab" data-route="plan">Plans</a>
        <a href="#pages" class="nav-tab" data-route="page">Pages</a>
        <a href="#subscriptions" class="nav-tab" data-route="subscription">Subscriptions</a>
        <a href="#coupons" class="nav-tab" data-route="coupons">Coupons</a>
        <a href="#settings" class="nav-tab" data-route="settings">Settings</a>
    </h2>
</div>
