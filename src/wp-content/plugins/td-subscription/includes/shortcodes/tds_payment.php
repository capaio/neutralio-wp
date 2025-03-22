<?php

/**
 * Class tds_plans
 */

class tds_payment extends td_block {

    // flags
    private $is_composer = false; // is composer session flag
    private $is_payment_session = false; // is subscription payment session flag
    private $is_stripe_session = false; // is stripe payment session flag
    private $is_billing_disabled = false; // is billing form disabled flag

    private $tds_auto_unlock; // ref post id, used to auto unlock post after a successful purchase

    private $tds_ref_url; // ref url

    // tds subscription data
    private $tds_subscription = [];

    // tds plan data
    private $tds_plan = [];

	public function get_custom_css() {

        // $unique_block_class
        $unique_block_class = $this->block_uid;

		$compiled_css = '';

		/** @noinspection CssInvalidAtRule */
		$raw_css =
            "<style>

                /* @style_general_tds_page_block */
                .tds-page-block {
                    transform: translateZ(0);
                    font-family: -apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Oxygen-Sans,Ubuntu,Cantarell,\"Helvetica Neue\",sans-serif;
                    font-size: 14px;
                }
                .tds-page-block .td-element-style {
                    z-index: -1;
                }
                .tds-page-block a:not(.tds-s-btn) {
                    color: #0489FC;
                }
                .tds-page-block a:not(.tds-s-btn):hover {
                    color: #152BF7;
                }
                
                /* @style_general_tds_payment */
                .tds_payment .tds-hide {
                    display: none;
                }
                .tds_payment .tds-checkout-wrap {
                    display: flex;
                }
                .tds_payment .tds-checkout-wrap:after {
                    content: '';
                    position: absolute;
                    opacity: 0;
                    transition: opacity 0.2s ease-in-out;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    margin-top: -23px;
                    margin-left: -23px;
                    width: 40px;
                    height: 40px;
                    border: 3px solid #888;
                    border-left-color: transparent;
                    border-right-color: transparent;
                    border-radius: 50%;
                    -webkit-animation: fullspin 1s infinite ease-out;
                    animation: fullspin 1s infinite ease-out;
                    z-index: 2;
                }
                .tds_payment .tds-checkout-wrap.tds-cs-loading {
                    opacity: .5;
                    pointer-events: none;
                }
                .tds_payment .tds-checkout-wrap.tds-cs-loading:after {
                    opacity: 1;
                }
                @media (max-width: 767px) {
                    .tds_payment .tds-checkout-wrap {
                        flex-direction: column;
                    }
                }
                .tds_payment .tds-checkout-log-in {
                    width: 100%;
                }
                .tds_payment .tds-payment-content {
                    flex: 1;
                    padding-right: 34px;
                }
                @media (min-width: 768px) and (max-width: 1018px) {
                    .tds_payment .tds-payment-content {
                        padding-right: 25px;
                    }
                }
                @media (max-width: 767px) {
                    .tds_payment .tds-payment-content {
                        padding-bottom: 35px;
                        padding-right: 0;
                    }
                }
                .tds_payment:not(.tds-payment-bill-form-disabled) .tds-payment-sidebar {
                    width: 40%;
                }
                @media (max-width: 767px) {
                    .tds_payment:not(.tds-payment-bill-form-disabled) .tds-payment-sidebar {
                        width: 100%;
                    }
                }
                .tds_payment.tds-payment-bill-form-disabled .tds-payment-sidebar {
                    width: 100%;
                }
                @media (min-width: 768px) {
                    .tds_payment.tds-payment-bill-form-disabled .tds-payment-sidebar {
                        display: flex;
                    }
                    .tds_payment.tds-payment-bill-form-disabled .tds-s-page-subscr-summary {
                        flex-basis: 47%;
                        margin-bottom: 0;
                        padding-bottom: 0;
                    }
                    .tds_payment.tds-payment-bill-form-disabled .tds-s-page-pay-methods {
                        flex-basis: 53%;
                    }
                }
                @media (min-width: 1019px) {
                    .tds_payment.tds-payment-bill-form-disabled .tds-payment-sidebar {
                        gap: 0 34px;
                    }
                }
                @media (min-width: 768px) and (max-width: 1018px) {
                    .tds_payment.tds-payment-bill-form-disabled .tds-payment-sidebar {
                        gap: 0 25px;
                    }
                }
                .tds_payment .tds-s-notif-no-plan {
                    width: 100%;
                }
                .tds_payment .tds-s-page-billing-details .tds-s-page-sec-content {
                    background-color: #F8F8F8;
                    padding: 35px 25px;
                }
                @media (max-width: 767px) {
                    .tds_payment .tds-s-page-billing-details .tds-s-page-sec-content {
                        margin: 0 -20px;
                        padding: 30px 20px;
                    }
                }
                @media (min-width: 768px) {
                    .tds_payment .tds-s-billing-details-form .tds-s-form-group:nth-last-child(-n+2) {
                        margin-bottom: 0;
                    }
                    .tds_payment .tds-s-billing-details-form .tds-s-form-group:nth-last-child(-n+2),
                    .tds_payment .tds-s-billing-details-form .tds-s-form-group:nth-last-child(8),
                    .tds_payment .tds-s-billing-details-form .tds-s-form-group:nth-last-child(9),
                    .tds_payment .tds-s-billing-details-form .tds-s-form-group:nth-last-child(10),
                    .tds_payment .tds-s-billing-details-form .tds-s-form-group:nth-last-child(11) {
                        width: 50%;
                    }
                    .tds_payment .tds-s-billing-details-form .tds-s-form-group:nth-last-child(3) {
                        width: 35%;
                    }
                    .tds_payment .tds-s-billing-details-form .tds-s-form-group:nth-last-child(4) {
                        width: 65%;
                    }
                }
                .tds_payment .tds-s-page-subscr-summary {
                    border-bottom: none;
                }
                @media (max-width: 767px) {
                    .tds_payment .tds-s-page-subscr-summary .tds-spsh-title {
                        display: none;
                    }
                }
                .tds_payment .tds-s-page-ss-title {
                    margin: 0 0 24px;
                    padding: 12px 10px 13px;
                    background-color: #F8F8F8;
                    font-size: 1.429em;
                    font-weight: 500;
                    line-height: 1.2;
                    color: #1d2327;
                    text-align: center;
                }
                .tds_payment .tds-s-page-ss-info {
                    font-size: .929em;
                    line-height: 1.2;
                    font-weight: 600;
                    color: #1D2327;
                }
                .tds_payment .tds-s-page-ss-info-row {
                    display: flex;
                    align-items: baseline;
                }
                .tds_payment .tds-s-page-ss-info-row:not(:last-child) {
                    margin-bottom: 15px;
                }
                .tds_payment .tds-s-page-ss-info-label {
                    width: 25%;
                    padding-left: 10px;
                    padding-right: 15px;
                }
                .tds_payment .tds-s-page-ss-info-value {
                    flex: 1;
                    padding-left: 15px;
                    padding-right: 10px;
                    text-align: right;
                }
                .tds_payment .tds-s-coupon-form {
                    margin-top: 24px;
                }
                body .tds_payment .tds-s-coupon-form .tds-s-fc-inner .tds-s-form-group-coupon-code {
                    margin-bottom: 0;
                }
                .tds_payment .tds-s-coupon-form .tds-coupon-apply-btn {
                    display: flex;
                    align-items: center;
                    position: absolute;
                    top: 2px;
                    right: 15px;
                    height: calc(100% - 4px);
                    padding: 0 15px;
                    font-size: .929em;
                    line-height: 1.3;
                    font-weight: 700;
                    text-transform: uppercase;
                    color: #1D2327;
                    transition: color 0.2s ease-in-out;
                }
                .tds_payment .tds-s-coupon-form .tds-coupon-apply-btn:hover {
                    color: #0489FC;
                }
                .tds_payment .tds-s-coupon-form .tds-coupon-apply-btn-applied {
                    pointer-events: none;
                    color: #59BA93;
                }
                .tds_payment .tds-s-coupon-form .tds-coupon-apply-btn-invalid {
                    pointer-events: none;
                    color: #FF0000;
                }
                .tds_payment .tds-s-coupon-form .tds-coupon-apply-btn.tds-s-btn-saving:after {
                    content: '';
                    width: 10px;
                    height: 10px;
                    margin-left: 10px;
                    border: 1px solid #000;
                    border-left-color: transparent;
                    border-right-color: transparent;
                    border-radius: 50%;
                    -webkit-animation: fullspin 1s infinite ease-out;
                    animation: fullspin 1s infinite ease-out;
                    z-index: 2;
                    transition: border-top-color .2s ease-in-out, border-bottom-color .2s ease-in-out;
                }
                .tds_payment .tds-s-coupon-form .tds-coupon-apply-btn.tds-s-btn-saving:hover:after {
                    border-top-color: #0489FC;
                    border-bottom-color: #0489FC;
                }
                .tds_payment .tds-s-coupon-form .tds-s-fc-inner .tds-coupon-msg {
                    display: none;
                    margin-top: 14px;
                }
                .tds_payment .tds-s-coupon-form .tds-s-fc-inner .tds-coupon-msg .tds-s-notif-descr {
                    display: flex;
                    justify-content: space-between;
                }
                .tds_payment .tds-s-coupon-form .tds-s-fc-inner .tds-s-notif-coupon-applied {
                    padding: 0;
                    font-style: italic;
                    color: #1D2327;
                    margin: 14px 23px 0;
                }
                .tds_payment .tds-s-subscr-summary-total {
                    display: flex;
                    align-items: baseline;
                    margin-top: 20px;
                    padding-right: 10px;
                    font-size: 1.143em;
                    line-height: 1;
                    font-weight: 700;
                    color: #1D2327;
                }
                @media (min-width: 767px) {
                    .tds_payment .tds-s-subscr-summary-total {
                        justify-content: flex-end;
                    }
                }
                .tds_payment .tds-s-subscr-summary-total .tds-s-sst-label {
                    margin-right: 20px;
                }
                .tds_payment .tds-s-pay-methods-form .tds-spm-content {
                    margin-top: 15px;
                }
                body .tds_payment .tds-s-pay-methods-form .tds-spm-direct .tds-s-notif,
                body .tds_payment .tds-s-pay-methods-form .tds-spm-stripe .tds-s-notif,
                body .tds_payment .tds-s-pay-methods-form .tds-spm-custom-payment .tds-s-notif {
                    margin-top: 25px;
                    margin-left: 0;
                    margin-right: 0;
                }
                .tds_payment .tds-s-pay-methods-form .tds-spm-direct .tds-s-notif:not(:last-child),
                .tds_payment .tds-s-pay-methods-form .tds-spm-stripe .tds-s-notif:not(:last-child),
                .tds_payment .tds-s-pay-methods-form .tds-spm-custom-payment .tds-s-notif:not(:last-child) {
                    margin-bottom: 15px;
                }
                body .tds_payment .tds-s-pay-methods-form .tds-spm-direct .tds-s-notif:last-child,
                body .tds_payment .tds-s-pay-methods-form .tds-spm-stripe .tds-s-notif:last-child,
                body .tds_payment .tds-s-pay-methods-form .tds-spm-custom-payment .tds-s-notif:last-child {
                    margin-top: 0;
                }
                .tds_payment .tds-s-pay-methods-form .tds-s-form-footer .tds-s-notif {
                    margin-top: 0;
                    margin-bottom: 32px;
                }
                .tds_payment .tds-s-pay-methods-form .tds-s-form-footer .tds-s-btn {
                    width: 100%;
                    margin-right: 0;
                }
                .tds_payment .tds-s-pay-methods-form .tds-s-form-footer #paypal-button-container {
                    width: 100%;
                    height: 44px;
                }
                .tds_payment .tds-payment-confirmation {
                    width: 100%;
                }
                @media (min-width: 767px) {
                    .tds_payment .tds-s-psc-subscr-info,
                    .tds_payment .tds-s-psc-bank-info {
                        margin-bottom: 0;
                    }
                }
                .tds_payment .tds-s-psc-thank-you {
                    order: 1;
                }
                .tds_payment .tds-s-psc-subscr-info {
                    order: 2;
                }
                @media (min-width: 767px) {
                    .tds_payment .tds-s-psc-subscr-info {
                        flex: 1;
                    }
                }
                .tds_payment .tds-s-psc-bank-info {
                    order: 3;
                }
                @media (min-width: 767px) {
                    .tds_payment .tds-s-psc-bank-info {
                        width: 50%;
                    }
                }
                @media (max-width: 767px) {
                    .tds_payment .tds-s-psc-bank-info {
                        margin-top: 45px;
                        margin-bottom: 0;
                    }
                }
                .tds_payment .tds-s-checkout-confirm-btns .tds-s-btn:not(:last-of-type) {
                    margin-right: 26px;
                }
                .tds_payment #tds-payment-message {
                    display: none;
                    margin-top: 20px;
                    word-wrap: break-word;
                }
                .tds_payment #tds-stripe-checkout-session:disabled {
                    opacity: 0.5;
                    cursor: default;
                    pointer-events: none;
                }
                
                .tds_payment .tds-spm-custom-payment .tds-spm-content {
                    display: none;
                }
                
                
                /* @bill_padd */
                body .$unique_block_class .tds-s-page-billing-details .tds-s-page-sec-content {
                    padding: @bill_padd;
                }
                
                /* @all_input_border */
                body .$unique_block_class .tds-s-form .tds-s-form-input {
                    border-width: @all_input_border;
                }
                /* @all_input_border_style */
                body .$unique_block_class .tds-s-form .tds-s-form-input {
                    border-style: @all_input_border_style;
                }
                /* @all_input_border_color */
                body .$unique_block_class .tds-s-form .tds-s-form-input {
                    border-color: @all_input_border_color;
                }
                body .$unique_block_class .tds-s-form .tds-s-form-check .tds-s-fc-check {
                    border: 2px solid @all_input_border_color;
                }
                /* @input_radius */
                body .$unique_block_class .tds-s-form .tds-s-form-input {
                    border-radius: @input_radius;
                }
                
                /* @btn_radius */
                body .$unique_block_class .tds-s-btn {
                    border-radius: @btn_radius;
                }
                
                /* @notif_radius */
                body .$unique_block_class .tds-s-notif {
                    border-radius: @notif_radius;
                }
                
                
                /* @accent_color */
                body .$unique_block_class .tds-s-btn,
                body .$unique_block_class .tds-s-form .tds-s-form-check .tds-s-fc-check:after {
                    background-color: @accent_color;
                }
                body .$unique_block_class .tds-s-form .tds-s-form-group:not(.tds-s-fg-error) .tds-s-form-input:focus:not([readonly]),
                body .$unique_block_class .tds-s-form .tds-s-form-check input:checked + .tds-s-fc-check {
                    border-color: @accent_color !important;
                }
                body .$unique_block_class a:not(.tds-s-btn):not(.tds-coupon-apply-btn),
                body .$unique_block_class .tds-s-coupon-form .tds-coupon-apply-btn:hover {
                    color: @accent_color;
                }
                body .$unique_block_class .tds-s-coupon-form .tds-coupon-apply-btn.tds-s-btn-saving:hover:after {
                    border-top-color: @accent_color;
                    border-bottom-color: @accent_color;
                }
                /* @input_outline_accent_color */
                body .$unique_block_class .tds-s-form .tds-s-form-group:not(.tds-s-fg-error) .tds-s-form-input:focus:not([readonly]),
                body .$unique_block_class .tds-s-form .tds-s-form-check input:checked + .tds-s-fc-check {
                    outline-color: @input_outline_accent_color;
                }
                
                /* @a_color_h */
                body .$unique_block_class a:not(.tds-s-btn):not(.tds-coupon-apply-btn):hover {
                    color: @a_color_h;
                }
                
                /* @sec_color */
                body .$unique_block_class h2.tds-spsh-title {
                    color: @sec_color;
                }
                
                /* @bill_bg */
                body .$unique_block_class .tds-s-page-billing-details .tds-s-page-sec-content {
                    background-color: @bill_bg;
                }
                
                /* @label_color */
                body .$unique_block_class .tds-s-form .tds-s-form-label,
                body .$unique_block_class .tds-s-form .tds-s-form-check .tds-s-fc-title {
                    color: @label_color;
                }
                /* @input_color */
                body .$unique_block_class .tds-s-form .tds-s-form-input,
                body .$unique_block_class .tds-s-coupon-form .tds-coupon-apply-btn {
                    color: @input_color;
                }
                body .$unique_block_class .tds-s-form .tds-s-form-input:-webkit-autofill,
                body .$unique_block_class .tds-s-form .tds-s-form-input:-webkit-autofill:hover,
                body .$unique_block_class .tds-s-form .tds-s-form-input:-webkit-autofill:focus,
                body .$unique_block_class .tds-s-form .tds-s-form-input:-webkit-autofill:active {
                    -webkit-text-fill-color: @input_color;
                }
                body .$unique_block_class .tds-s-coupon-form .tds-coupon-apply-btn.tds-s-btn-saving:after {
                    border-top-color: @input_color;
                    border-bottom-color: @input_color;
                }
                /* @input_place_color */
                body .$unique_block_class .tds-s-form .tds-s-form-input::placeholder {
                    color: @input_place_color;
                }
                body .$unique_block_class .tds-s-form .tds-s-form-input::-webkit-input-placeholder {
                    color: @input_place_color;
                }
                body .$unique_block_class .tds-s-form .tds-s-form-input::-moz-placeholder {
                    color: @input_place_color;
                }
                body .$unique_block_class .tds-s-form .tds-s-form-input::-ms-input-placeholder {
                    color: @input_place_color;
                }
                body .$unique_block_class .tds-s-form .tds-s-form-input:::-moz-placeholder  {
                    color: @input_place_color;
                }
                /* @input_bg */
                body .$unique_block_class .tds-s-form .tds-s-form-input {
                    background-color: @input_bg;
                }
                body .$unique_block_class .tds-s-form .tds-s-form-input:-webkit-autofill,
                body .$unique_block_class .tds-s-form .tds-s-form-input:-webkit-autofill:hover,
                body .$unique_block_class .tds-s-form .tds-s-form-input:-webkit-autofill:focus,
                body .$unique_block_class .tds-s-form .tds-s-form-input:-webkit-autofill:active {
                    -webkit-box-shadow: 0 0 0 1000px @input_bg inset !important;
                }
                /* @input_succ_accent */
                body .$unique_block_class .tds-s-form .tds-s-fc-inner .tds-s-fg-success:not(.tds-s-fg-error) .tds-s-form-input {
                    border-color: @input_succ_accent !important;
                }
                body .$unique_block_class .tds-s-coupon-form .tds-coupon-apply-btn-applied {
                    color: @input_succ_accent;
                }
                /* @input_succ_accent_outline */
                body .$unique_block_class .tds-s-form .tds-s-fc-inner .tds-s-fg-success:not(.tds-s-fg-error) .tds-s-form-input {
                    outline-color: @input_succ_accent_outline;
                }
                /* @input_err_accent */
                body .$unique_block_class .tds-s-form .tds-s-fg-error .tds-s-form-input {
                    border-color: @input_err_accent;
                }
                body .$unique_block_class .tds-s-coupon-form .tds-coupon-apply-btn-invalid {
                    color: @input_err_accent;
                }
                body .$unique_block_class .tds-s-form .tds-s-fg-error-msg {
                    color: @input_err_accent;
                }
                /* @input_err_accent_outline */
                body .$unique_block_class .tds-s-form .tds-s-fg-error .tds-s-form-input {
                    outline-color: @input_err_accent_outline;
                }
                
                /* @tabl_head_color */
                body .$unique_block_class .tds-s-page-ss-title {
                    color: @tabl_head_color;
                }
                /* @tabl_head_bg */
                body .$unique_block_class .tds-s-page-ss-title {
                    background-color: @tabl_head_bg;
                }
                /* @tabl_body_color */
                body .$unique_block_class .tds-s-page-ss-info,
                body .$unique_block_class .tds-s-coupon-form .tds-s-fc-inner .tds-s-notif-coupon-applied {
                    color: @tabl_body_color;
                }
                /* @tabl_foot_color */
                body .$unique_block_class .tds-s-subscr-summary-total {
                    color: @tabl_foot_color;
                }
                
                /* @list_label_color */
                body .$unique_block_class .tds-s-list-label {
                    color: @list_label_color;
                }
                /* @list_val_color */
                body .$unique_block_class .tds-s-list-text {
                    color: @list_val_color;
                }
                
                /* @btn_color */
                body .$unique_block_class .tds-s-btn {
                    color: @btn_color;
                }
                /* @btn_color_h */
                body .$unique_block_class .tds-s-btn:hover {
                    color: @btn_color_h;
                }
                /* @btn_bg_h */
                body .$unique_block_class .tds-s-btn:hover {
                    background-color: @btn_bg_h;
                }
                
                /* @notif_info_color */
                body .$unique_block_class .tds-s-notif-info {
                    color: @notif_info_color;
                }
                /* @notif_info_bg */
                body .$unique_block_class .tds-s-notif-info {
                    background-color: @notif_info_bg;
                }
                /* @notif_warn_color */
                body .$unique_block_class .tds-s-notif-warn {
                    color: @notif_warn_color;
                }
                /* @notif_warn_bg */
                body .$unique_block_class .tds-s-notif-warn {
                    background-color: @notif_warn_bg;
                }
                /* @notif_error_color */
                body .$unique_block_class .tds-s-notif-error {
                    color: @notif_error_color;
                }
                /* @notif_error_bg */
                body .$unique_block_class .tds-s-notif-error {
                    background-color: @notif_error_bg;
                }
                
                
                /* @f_text */
                body .$unique_block_class {
                    @f_text
                }
                    
            </style>";

		$td_css_res_compiler = new td_css_res_compiler( $raw_css );
		$td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

		$compiled_css .= $td_css_res_compiler->compile_css();

		return $compiled_css;

	}

	static function cssMedia( $res_ctx ) {

        /*-- GENERAL STYLES -- */
        $res_ctx->load_settings_raw( 'style_general_tds_page_block', 1 );
        $res_ctx->load_settings_raw( 'style_general_tds_payment', 1 );



        /*-- LAYOUT -- */
        // inputs border size
        $all_input_border = $res_ctx->get_shortcode_att('all_input_border');
        $all_input_border .= $all_input_border != '' && is_numeric( $all_input_border ) ? 'px' : '';
        $res_ctx->load_settings_raw( 'all_input_border', $all_input_border );

        // inputs border style
        $all_input_border_style = $res_ctx->get_shortcode_att('all_input_border_style');
        if( $all_input_border_style != '' ) {
            $res_ctx->load_settings_raw( 'all_input_border_style', $all_input_border_style );
        } else {
            $res_ctx->load_settings_raw( 'all_input_border_style', 'solid' );
        }

        // inputs border radius
        $input_radius = $res_ctx->get_shortcode_att('input_radius');
        $res_ctx->load_settings_raw( 'input_radius', $input_radius );
        if( $input_radius != '' && is_numeric( $input_radius ) ) {
            $res_ctx->load_settings_raw( 'input_radius', $input_radius . 'px' );
        }


        // billing details form padding
        $bill_padd = $res_ctx->get_shortcode_att('bill_padd');
        $res_ctx->load_settings_raw( 'bill_padd', $bill_padd );
        if( $bill_padd != '' && is_numeric( $bill_padd ) ) {
            $res_ctx->load_settings_raw( 'bill_padd', $bill_padd . 'px' );
        }


        // buttons border radius
        $btn_radius = $res_ctx->get_shortcode_att('btn_radius');
        $res_ctx->load_settings_raw( 'btn_radius', $btn_radius );
        if( $btn_radius != '' && is_numeric( $btn_radius ) ) {
            $res_ctx->load_settings_raw( 'btn_radius', $btn_radius . 'px' );
        }


        // notifications border radius
        $notif_radius = $res_ctx->get_shortcode_att('notif_radius');
        $res_ctx->load_settings_raw( 'notif_radius', $notif_radius );
        if( $notif_radius != '' && is_numeric( $notif_radius ) ) {
            $res_ctx->load_settings_raw( 'notif_radius', $notif_radius . 'px' );
        }



        /*-- COLORS -- */
        $accent_color = $res_ctx->get_shortcode_att('accent_color');
        $res_ctx->load_settings_raw( 'accent_color', $accent_color );
        if( !empty( $accent_color ) ) {
            $res_ctx->load_settings_raw('input_outline_accent_color', td_util::hex2rgba($accent_color, 0.1));
        }

        $res_ctx->load_settings_raw( 'a_color_h', $res_ctx->get_shortcode_att('a_color_h') );

        $res_ctx->load_settings_raw( 'sec_color', $res_ctx->get_shortcode_att('sec_color') );

        $res_ctx->load_settings_raw( 'bill_bg', $res_ctx->get_shortcode_att('bill_bg') );
        $res_ctx->load_settings_raw( 'label_color', $res_ctx->get_shortcode_att('label_color') );
        $res_ctx->load_settings_raw( 'input_color', $res_ctx->get_shortcode_att('input_color') );
        $res_ctx->load_settings_raw( 'input_place_color', $res_ctx->get_shortcode_att('input_place_color') );
        $res_ctx->load_settings_raw( 'input_bg', $res_ctx->get_shortcode_att('input_bg') );
        $res_ctx->load_settings_raw( 'all_input_border_color', $res_ctx->get_shortcode_att('all_input_border_color') );
        $input_succ_accent = $res_ctx->get_shortcode_att('input_succ_accent');
        $res_ctx->load_settings_raw( 'input_succ_accent', $input_succ_accent  );
        if( !empty( $input_succ_accent ) ) {
            $res_ctx->load_settings_raw('input_succ_accent_outline', td_util::hex2rgba($input_succ_accent, 0.1));
        }
        $input_err_accent = $res_ctx->get_shortcode_att('input_err_accent');
        $res_ctx->load_settings_raw( 'input_err_accent',$input_err_accent  );
        if( !empty( $input_err_accent ) ) {
            $res_ctx->load_settings_raw('input_err_accent_outline', td_util::hex2rgba($input_err_accent, 0.1));
        }

        $res_ctx->load_settings_raw( 'tabl_head_color', $res_ctx->get_shortcode_att('tabl_head_color') );
        $res_ctx->load_settings_raw( 'tabl_head_bg', $res_ctx->get_shortcode_att('tabl_head_bg') );
        $res_ctx->load_settings_raw( 'tabl_body_color', $res_ctx->get_shortcode_att('tabl_body_color') );
        $res_ctx->load_settings_raw( 'tabl_foot_color', $res_ctx->get_shortcode_att('tabl_foot_color') );

        $res_ctx->load_settings_raw( 'list_label_color', $res_ctx->get_shortcode_att('list_label_color') );
        $res_ctx->load_settings_raw( 'list_val_color', $res_ctx->get_shortcode_att('list_val_color') );

        $res_ctx->load_settings_raw( 'btn_color', $res_ctx->get_shortcode_att('btn_color') );
        $res_ctx->load_settings_raw( 'btn_color_h', $res_ctx->get_shortcode_att('btn_color_h') );
        $res_ctx->load_settings_raw( 'btn_bg_h', $res_ctx->get_shortcode_att('btn_bg_h') );

        $notif_info_color = $res_ctx->get_shortcode_att('notif_info_color');
        $res_ctx->load_settings_raw( 'notif_info_color', $notif_info_color );
        if( !empty( $notif_info_color ) ) {
            $res_ctx->load_settings_raw('notif_info_bg', td_util::hex2rgba($notif_info_color, 0.08));
        }
        $notif_warn_color = $res_ctx->get_shortcode_att('notif_warn_color');
        $res_ctx->load_settings_raw( 'notif_warn_color', $notif_warn_color );
        if( !empty( $notif_warn_color ) ) {
            $res_ctx->load_settings_raw('notif_warn_bg', td_util::hex2rgba($notif_warn_color, 0.08));
        }
        $notif_error_color = $res_ctx->get_shortcode_att('notif_error_color');
        $res_ctx->load_settings_raw( 'notif_error_color', $notif_error_color );
        if( !empty( $notif_error_color ) ) {
            $res_ctx->load_settings_raw('notif_error_bg', td_util::hex2rgba($notif_error_color, 0.08));
        }



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_text' );

	}

	function __construct() {
		parent::disable_loop_block_features();

        // is composer session flag
        $this->is_composer = td_util::tdc_is_live_editor_iframe() || td_util::tdc_is_live_editor_ajax();

        // set request ref url
        $this->tds_ref_url = !empty($_REQUEST['ref_url']) ? $_REQUEST['ref_url'] : '';

        // set request ref id
        $this->tds_auto_unlock = !empty($_REQUEST['tds_auto_unlock']) ? $_REQUEST['tds_auto_unlock'] : '';

        // maybe set tds subscription data
        if ( !empty($_GET['subscription']) ) {

            global $wpdb;

            $tds_subscription_id = $_GET['subscription'];

            // tds subscription confirm key
            $tds_subscription_confirm_key = !empty($_GET['key']) ? $_GET['key'] : false;

            $subscriptions_query = "SELECT * FROM tds_subscriptions WHERE id = %s";
            $subscriptions_query_args = [ $tds_subscription_id ];

            if ( $tds_subscription_confirm_key ) {
                $subscriptions_query .= " AND confirm_key = %s";
                $subscriptions_query_args[] = $tds_subscription_confirm_key;
            }

            $subscriptions = $wpdb->get_results( $wpdb->prepare( $subscriptions_query, $subscriptions_query_args ), ARRAY_A );

            if ( null !== $subscriptions && count($subscriptions) ) {
                $this->tds_subscription = $subscriptions[0];
            }

        }

        // is subscription payment session flag
        $this->is_payment_session = isset($_GET['pay']);

        // is stripe payment session flag
        $this->is_stripe_session = !empty($_GET['stripe_session_id']);

        // maybe set tds plan data
        $tds_plan_id = !empty($_GET['plan_id']) ? $_GET['plan_id'] : ( !empty($this->tds_subscription) ? $this->tds_subscription['plan_id'] : null );
        if ( $tds_plan_id ) {

            $tds_plan = tds_util::get_plan( esc_sql($tds_plan_id) );

            if ( $tds_plan ) {
                $this->tds_plan = $tds_plan;
            }

        }

        // is billing form disabled flag
        if ( $this->is_payment_session && !$this->is_stripe_session && !empty($this->tds_subscription) &&
            !in_array( $this->tds_subscription['status'], [ 'waiting_payment', 'paid_incomplete' ] )
        ) {
            $this->is_billing_disabled = true;
        }

	}

	function render( $atts, $content = null ) {

        parent::render( $atts );

        global $wpdb;

		// flag to check if we are in composer
        $is_composer = false;
        if( td_util::tdc_is_live_editor_iframe() || td_util::tdc_is_live_editor_ajax() ) {
            $is_composer = true;
        }

        // show a specific version of the shortcode in composer
        $show_version_in_composer = $this->get_att('show_version');

        $show_confirm_version = false;
        if( $is_composer && $show_version_in_composer === 'confirm' ) {
            $show_confirm_version = true;
        }

        // redirect if successful
        $success_url = $this->get_att('success_url');

        //echo '<pre class="td-container">';
            //echo '$this->tds_auto_unlock post id: ' . print_r($this->tds_auto_unlock, true) . '<br>post url: ' . print_r( get_permalink($this->tds_auto_unlock), true);
        //echo '</pre>';

        // default payment method
        $default_payment_method = $this->get_att('default_payment');
        if( $default_payment_method == '' ) {
            $default_payment_method = 'direct';
        }

        // enable/disable billing details form
        $disable_bill = !empty($this->get_att('disable_bill'));

        // additional classes
        $additional_classes = array();
        if( $disable_bill || $this->is_billing_disabled ) {
            $additional_classes[] = 'tds-payment-bill-form-disabled';
        }

        // remove top border on Newsmag
        $block_classes = str_replace('td-pb-border-top', '', $this->get_block_classes($additional_classes));
        
		$buffy = '<div class="tds-page-block ' . $block_classes . '" ' . $this->get_block_html_atts() . '>';

			$buffy .= $this->get_block_css(); // get block css
			$buffy .= $this->get_block_js(); // get block js

            // display a message if the user is not logged in
            if( !is_user_logged_in() ) {
                $buffy .= $this->get_login_msg(); // get block tds checkout login msg
            } else {

                // get current user
                $current_user = wp_get_current_user();

                // get user billing details
                $user_billing_details = tds_util::get_user_billing_details( $current_user );

                // set billing details
                $billing_details_exist = $user_billing_details['billing_details_exist'];
                $billing_first_name = $user_billing_details['billing_first_name'];
                $billing_last_name = $user_billing_details['billing_last_name'];
                $billing_company_name = $user_billing_details['billing_company_name'];
                $billing_vat_number = $user_billing_details['billing_vat_number'];
                $billing_country = $user_billing_details['billing_country'];
                $billing_address = $user_billing_details['billing_address'];
                $billing_city = $user_billing_details['billing_city'];
                $billing_county = $user_billing_details['billing_county'];
                $billing_post_code = $user_billing_details['billing_post_code'];
                $billing_phone = $user_billing_details['billing_phone'];
                $billing_email = $user_billing_details['billing_email'];

                // is payment confirmation flag
                $is_payment_confirmation = $show_confirm_version || ( $this->tds_subscription && !$this->is_payment_session );

                $is_stripe_session_cls = $this->is_stripe_session ? ' tds-checkout-session tds-cs-loading' : '';
                $buffy .= '<div class="tds-block-inner tds-checkout-wrap' . $is_stripe_session_cls .  '">';

                // add ref url hidden input
                if ( $this->tds_ref_url ) {
                    $buffy .= '<input type="hidden" id="tds-ref-url" value="' . $this->tds_ref_url . '">';
                }

                // get tds subscription url
                $tds_subscription_url = $this->get_tds_subscription_url();

                // add tds subscription url hidden input
                if ( !empty($tds_subscription_url) ) {
                    $buffy .= '<input type="hidden" id="tds-subscription-url" value="' . $tds_subscription_url . '">';
                }

                // is payment confirmation
                if ( $is_payment_confirmation ) {

                    // get payment confirmation
                    $buffy .= $this->get_payment_confirmation(); // get block tds checkout payment confirmation html

                } else {

                    // redirect check
                    $redirect_check = $this->redirect_check();

                    if ( $redirect_check ) {

                        // redirect check output html
                        $buffy .= $redirect_check['output'];

                    } else {

                        // valid plan check
                        $invalid_plan = $this->invalid_plan_check();

                        if ( $invalid_plan ) {

                            // show invalid plan output html
                            $buffy .= $invalid_plan['output'];

                        } else {

                            if ( $is_composer ) {

                                // set fake data for composer
                                $plan_id = '';
                                $price = 100;
                                $cycle_interval = 'year';
                                $cycle_interval_count = 1;
                                $plan_name = 'Yearly Plan';
                                $ci_format = tds_util::ci_format( $cycle_interval, $cycle_interval_count );

                                $credits = 0;

                                $free = $unlimited = $with_credit = $with_trial = false;

                                $subscription_start_date = tds_util::get_formatted_date( date('Y-m-d') );
                                $subscription_end_date = tds_util::get_subscription_end_date(
                                    date('Y-m-d'),
                                    $cycle_interval,
                                    $cycle_interval_count
                                )->format('Y-m-d');
                                $subscription_end_date = tds_util::get_formatted_date($subscription_end_date);

                            } else {

                                // set plan data
                                $plan_id = !empty($this->tds_plan['id']) ? $this->tds_plan['id'] : '';
                                $plan_name = $this->tds_plan['name'];

                                if ( $this->is_payment_session ) {

                                    $free = $this->tds_subscription['is_free'] == 1;
                                    $unlimited = $this->tds_subscription['is_unlimited'] == 1;
                                    $with_credit = $this->tds_plan['is_with_credits'] == 1;
                                    $credits = $this->tds_plan['credits'];

                                    $with_trial = false;

                                    $price = !$free ? $this->tds_subscription['price'] : '';
                                    $cycle_interval = $this->tds_subscription['cycle_interval'];
                                    $cycle_interval_count = $this->tds_subscription['cycle_interval_count'];

                                    $subscription_start_date = tds_util::get_formatted_date($this->tds_subscription['start_date']);

                                    // subscription end date
                                    if ( !$free && !$unlimited ) {
                                        $subscription_end_date = tds_util::get_subscription_end_date(
                                            $this->tds_subscription['start_date'],
                                            $cycle_interval,
                                            $cycle_interval_count
                                        )->format('Y-m-d');
                                        $subscription_end_date = tds_util::get_formatted_date($subscription_end_date);
                                    } else {
                                        $subscription_end_date = __td('unlimited', TD_THEME_NAME );
                                    }

                                    // current subscription payment type
                                    if( !$free ) {
                                        switch ( $this->tds_subscription['payment_type'] ) {
                                            case 'direct':
                                                $subscription_payment_type = __td('Bank transfer', TD_THEME_NAME );
                                                break;
                                            case 'paypal':
                                                $subscription_payment_type = 'PayPal';
                                                break;
                                            case 'stripe':
                                                $subscription_payment_type = 'Stripe';
                                                break;
                                            case '':
                                                $subscription_payment_type = '-';
                                                break;
                                            default:
                                                $subscription_payment_type = apply_filters(
                                                    'tds_subscription_' . $this->tds_subscription['payment_type'] . '_name',
                                                    $this->tds_subscription['payment_type']
                                                );
                                                break;
                                        }
                                    } else {
                                        $subscription_payment_type = '-';
                                    }

                                    // current subscription status
                                    $subscription_status = $this->tds_subscription['status'];

                                    // get subscription billing details
                                    $subscription_billing_details = tds_util::get_subscription_billing_details($this->tds_subscription);

                                    // set billing details
                                    foreach ( $subscription_billing_details as $key => $value ) {
                                        $$key = $value;
                                    }

                                } else {

                                    $free = $this->tds_plan['is_free'] == 1;
                                    $unlimited = $this->tds_plan['is_unlimited'] == 1;
                                    $with_credit = $this->tds_plan['is_with_credits'] == 1;
                                    $credits = $this->tds_plan['credits'];

                                    $price = !$free ? $this->tds_plan['price'] : '';
                                    $cycle_interval = $this->tds_plan['interval'];
                                    $cycle_interval_count = $this->tds_plan['interval_count'];

                                    // subscription trial days
                                    $plan_trial_days = intval($this->tds_plan['trial_days']);
                                    $with_trial = $plan_trial_days > 0;

                                    $subscription_start_date = tds_util::get_formatted_date(date('Y-m-d'));

                                    // subscription end date
                                    if ( !$free && ( !$unlimited || $with_trial ) ) {
                                        $subscription_end_date = tds_util::get_subscription_end_date(
                                            date('Y-m-d'),
                                            $cycle_interval,
                                            $cycle_interval_count,
                                            $plan_trial_days
                                        )->format('Y-m-d');
                                        $subscription_end_date = tds_util::get_formatted_date($subscription_end_date);
                                    } else {
                                        $subscription_end_date = __td('unlimited', TD_THEME_NAME );
                                    }

                                }

                                $ci_format = '';
                                if ( $price ) {
                                    $ci_format = tds_util::ci_format( $cycle_interval, $cycle_interval_count );
                                }

                            }

                            // set currency
                            $curr_name = tds_util::get_tds_option('curr_name');
                            if ( empty($curr_name) ) {
                                $curr_name = 'USD';
                            }

                            $payment_bank = $wpdb->get_results( "SELECT * FROM tds_payment_bank LIMIT 1", ARRAY_A );
                            $payment_paypal = td_subscription::get_payment_method_credentials();
                            $payment_stripe = $wpdb->get_results( "SELECT * FROM tds_payment_stripe LIMIT 1", ARRAY_A );

                            if ( !empty($payment_paypal) && '1' === $payment_paypal['is_active'] ) {
                                $client_id = $payment_paypal['client_id'];
                                $buffy .= '<script src="https://www.paypal.com/sdk/js?client-id=' . $client_id . '&currency=' . $curr_name . '"></script>';

                                ob_start();
                                ?>
                                <script>
                                    /* global jQuery */

                                    if ( 'undefined' !== typeof window.paypal ) {

                                        let billingFormDisabled = <?php echo json_encode($disable_bill); ?>;
                                        let withTrial = <?php echo json_encode($with_trial); ?>;
                                        let paypalButtonContainer = jQuery('#paypal-button-container');

                                        let withCredits = <?php echo json_encode($with_credit); ?>;
                                        let tdsAutoUnlockPostId = <?php echo json_encode($this->tds_auto_unlock); ?>;

                                        if ( paypalButtonContainer.length ) {

                                            // paypal create subscription callback
                                            function tdsPaypalCreateSubscription( orderData = null ) {
                                                // console.log( 'orderData', orderData );

                                                var $tdsSubscriptionUserId = jQuery('#tds-subscription-user-id'),
                                                    $tdsSubscriptionPlanId = jQuery('#tds-subscription-plan-id'),
                                                    $tdsCouponId = jQuery('#tds-coupon-id'),
                                                    $tdsBillingPaymentMethod = jQuery('.tds-billing-payment-method:checked');

                                                // var $tdsRefUrl = jQuery('#tds-ref-url');
                                                // var refUrl;
                                                // if ( $tdsRefUrl.length ) {
                                                //     refUrl = $tdsRefUrl.val();
                                                // }

                                                let paypalOrderStatus = '';
                                                if ( orderData ) {
                                                    paypalOrderStatus = orderData.status;
                                                } else if ( withTrial ) {
                                                    paypalOrderStatus = 'NO_PAYMENT_REQUIRED';
                                                }

                                                // set paypal order data
                                                let paypalOrderData = {
                                                    order_id: orderData ? orderData.id : '',
                                                    order_intent: orderData ? orderData.intent : '',
                                                    order_status: paypalOrderStatus,
                                                    order_payer_id: orderData ? orderData.payer.payer_id : '',
                                                    order_payer_given_name: orderData ? orderData.payer.name.given_name : '',
                                                    order_payer_surname: orderData ? orderData.payer.name.surname : '',
                                                    order_payer_email: orderData ? orderData.payer.email_address : '',
                                                    order_payee_id: orderData ? orderData.purchase_units[0].payee.merchant_id : '',
                                                    order_payee_email: orderData ? orderData.purchase_units[0].payee.email_address : '',
                                                    order_amount_currency_code: orderData ? orderData.purchase_units[0].amount.currency_code : '',
                                                    order_amount_value: orderData ? orderData.purchase_units[0].amount.value : '',
                                                    order_info: orderData ? JSON.stringify(orderData, null, 2) : '',
                                                    order_create_time: orderData ? orderData.create_time : '',
                                                    order_update_time: orderData ? orderData.update_time : '',
                                                    order_capture_create_time: orderData ? orderData.purchase_units[0].payments.captures[0].create_time : '',
                                                    order_capture_update_time: orderData ? orderData.purchase_units[0].payments.captures[0].update_time : '',
                                                };

                                                // billing data
                                                let formBillingData = {};
                                                if( !billingFormDisabled ) {

                                                    let $tdsBillingFirstName = jQuery('#tds-billing-first-name'),
                                                        $tdsBillingLastName = jQuery('#tds-billing-last-name'),
                                                        $tdsBillingCompanyName = jQuery('#tds-billing-company-name'),
                                                        $tdsBillingVatNumber = jQuery('#tds-billing-vat'),
                                                        $tdsBillingCountry = jQuery('#tds-billing-country'),
                                                        $tdsBillingAddress = jQuery('#tds-billing-address'),
                                                        $tdsBillingCity = jQuery('#tds-billing-city'),
                                                        $tdsBillingCounty = jQuery('#tds-billing-county'),
                                                        $tdsBillingPostcode = jQuery('#tds-billing-postcode'),
                                                        $tdsBillingPhone = jQuery('#tds-billing-phone'),
                                                        $tdsBillingEmail = jQuery('#tds-billing-email');

                                                    // set form billing data
                                                    formBillingData = {
                                                        billingFirstName: $tdsBillingFirstName.val(),
                                                        billingLastName: $tdsBillingLastName.val(),
                                                        billingCompanyName: $tdsBillingCompanyName.val(),
                                                        billingVatNumber: $tdsBillingVatNumber.val(),
                                                        billingCountry: $tdsBillingCountry.val(),
                                                        billingAddress: $tdsBillingAddress.val(),
                                                        billingCity: $tdsBillingCity.val(),
                                                        billingCounty: $tdsBillingCounty.val(),
                                                        billingPostcode: $tdsBillingPostcode.val(),
                                                        billingPhone: $tdsBillingPhone.val(),
                                                        billingEmail: $tdsBillingEmail.val(),
                                                    };

                                                } else {

                                                    // set form billing data
                                                    formBillingData = {
                                                        billingFirstName: '<?php echo $billing_first_name ?>',
                                                        billingLastName: '<?php echo $billing_last_name ?>',
                                                        billingCompanyName: '<?php echo $billing_company_name ?>',
                                                        billingVatNumber: '<?php echo $billing_vat_number ?>',
                                                        billingCountry: '<?php echo $billing_country ?>',
                                                        billingAddress: '<?php echo $billing_address ?>',
                                                        billingCity: '<?php echo $billing_city ?>',
                                                        billingCounty: '<?php echo $billing_county ?>',
                                                        billingPostcode: '<?php echo $billing_post_code ?>',
                                                        billingPhone: '<?php echo $billing_phone ?>',
                                                        billingEmail: '<?php echo $billing_email ?>',
                                                    };

                                                }

                                                let ajaxCallData = {
                                                    subscriptionUserId: $tdsSubscriptionUserId.val(),
                                                    subscriptionPlanId: $tdsSubscriptionPlanId.val(),
                                                    subscriptionCouponId: $tdsCouponId.val(),
                                                    billingPaymentMethod: $tdsBillingPaymentMethod.val(),
                                                    paypalOrderData: paypalOrderData,
                                                    autoUnlockPostId: tdsAutoUnlockPostId,
                                                    ...formBillingData,
                                                };

                                                jQuery.ajax({
                                                    timeout: 20000,
                                                    type: 'POST',
                                                    url: tdsSubs.get_rest_endpoint(
                                                        'tds_subscription/create_subscription',
                                                        'uuid=' + tdsSubs.get_unique_id()
                                                    ),
                                                    beforeSend: function (xhr) {
                                                        // add the nonce used for cookie authentication
                                                        xhr.setRequestHeader('X-WP-Nonce', window.tds_js_globals.wpRestNonce);
                                                    },
                                                    cache: false,
                                                    dataType: 'json',
                                                    data: ajaxCallData,
                                                    success: function ( data, textStatus, jqXHR ) {
                                                        // console.log(data);

                                                        let successURL = '<?php echo $success_url ?>';

                                                        if ( 'undefined' !== typeof data['error'] ) {
                                                            console.log(data['error']);
                                                        } else if ( 'undefined' !== typeof data['response'] ) {

                                                            if ( 'undefined' !== typeof data['response']['confirm_url'] ) {

                                                                if ( tdsAutoUnlockPostId !== '' ) {

                                                                    let tdsAutoUnlockPostUrl = <?php echo json_encode( get_permalink($this->tds_auto_unlock) ); ?>;

                                                                    // for plans with credits
                                                                    if ( withCredits ) {

                                                                        // unlock post
                                                                        let unlockRequest = tdsSubs.auto_unlock_post(tdsAutoUnlockPostId);
                                                                        console.log( 'unlockRequest results: ', unlockRequest );

                                                                        const errors = unlockRequest.errors;
                                                                        const result = unlockRequest.result;
                                                                        const rdr_url = unlockRequest.rdr_url;

                                                                        // process the response
                                                                        if( Object.keys(errors).length > 0 ) {

                                                                            // errors
                                                                            let errorsMessages = '';
                                                                            Object.values(errors).map( (errMsg) => { errorsMessages += errMsg + '<br>'; });

                                                                            // display received error msg
                                                                            // tdsSubs.show_payment_message( errorsMessages, 'error', true );

                                                                        } else if ( result.includes('success') ) {

                                                                            // console.log( 'redirect to: ', rdr_url );

                                                                            // success... redirect back to post url to see it unlocked
                                                                            window.location.replace(rdr_url);

                                                                            // display success msg
                                                                            // tdsSubs.show_payment_message( 'Successfully unlocked post.', 'success' );

                                                                        } else {

                                                                            // display unknown result response warning msg
                                                                            // tdsSubs.show_payment_message( 'Unknown post unlock request result: ' + JSON.stringify(result), 'warn' );

                                                                        }

                                                                    } else {

                                                                        // just redirect back to post url to see it unlocked
                                                                        window.location.replace(tdsAutoUnlockPostUrl);

                                                                    }

                                                                } else if ( successURL !== '' ) {

                                                                    window.location.replace(successURL);

                                                                } else {

                                                                    var response = data['response'],
                                                                        redirectUrl = response['confirm_url'];
                                                                    window.history.replaceState( {}, 'TDS Confirmation Page', redirectUrl );

                                                                    let tdsPaymentConfirmationWrap = jQuery('.tds-payment-confirmation');

                                                                    jQuery('.tds-payment-content').hide();
                                                                    jQuery('.tds-payment-sidebar').hide();
                                                                    tdsPaymentConfirmationWrap.show();

                                                                    // Subscription info section
                                                                    var $tdsConfSubInfoWrap = jQuery('.tds-s-psc-subscr-info'),
                                                                        $tdsConfSubInfoID = $tdsConfSubInfoWrap.find('.tds-s-subscr-id'),
                                                                        $tdsConfSubInfoPlan = $tdsConfSubInfoWrap.find('.tds-s-subscr-plan'),
                                                                        $tdsConfSubInfoMonths = $tdsConfSubInfoWrap.find('.tds-s-subscr-months'),
                                                                        $tdsConfSubInfoPeriod = $tdsConfSubInfoWrap.find('.tds-s-subscr-period'),
                                                                        $tdsConfSubInfoPayMethod = $tdsConfSubInfoWrap.find('.tds-s-subscr-pay-method'),
                                                                        $tdsConfSubInfoTotal = $tdsConfSubInfoWrap.find('.tds-s-subscr-total'),
                                                                        $tdsConfSubInfoCredits = $tdsConfSubInfoWrap.find('.tds-s-subscr-credits');

                                                                    $tdsConfSubInfoWrap.show();

                                                                    if ('undefined' !== typeof response['local_subscription_id']) {
                                                                        $tdsConfSubInfoID.find('.tds-s-list-text').html(response['local_subscription_id']);
                                                                    }
                                                                    if ('undefined' !== typeof response['local_plan_name']) {
                                                                        $tdsConfSubInfoPlan.find('.tds-s-list-text').html(response['local_plan_name']);
                                                                    }
                                                                    if ('undefined' !== typeof response['cycle_interval_format']) {
                                                                        $tdsConfSubInfoMonths.find('.tds-s-list-text').html(response['cycle_interval_format']);
                                                                        $tdsConfSubInfoMonths.show();
                                                                    } else {
                                                                        $tdsConfSubInfoMonths.hide();
                                                                    }
                                                                    if ('undefined' !== typeof response['start_date']) {
                                                                        $tdsConfSubInfoPeriod.find('.tds-s-list-text').html(response['start_date'] + ' - ' + response['end_date']);
                                                                    }

                                                                    // hide period info
                                                                    if ('undefined' !== typeof response['is_with_credits']) {
                                                                        $tdsConfSubInfoPeriod.hide();

                                                                        // update & show credits info
                                                                        $tdsConfSubInfoCredits.find('.tds-s-list-text').html(response['credits']);
                                                                        $tdsConfSubInfoCredits.show();

                                                                    }

                                                                    if ('undefined' !== typeof response['payment_type']) {
                                                                        $tdsConfSubInfoPayMethod.find('.tds-s-list-text').html(response['payment_type']);
                                                                    }
                                                                    if ('undefined' !== typeof response['price']) {

                                                                        // formatted price
                                                                        if ( 'undefined' !== typeof response['formatted_full_price'] ) {
                                                                            $tdsConfSubInfoTotal.find('.tds-s-list-text').html(
                                                                                '<span class="tds-s-price-full">' + response['formatted_full_price'] + '</span>' +
                                                                                '<span>' + response['formatted_price'] + '</span>'
                                                                            );
                                                                        } else {
                                                                            $tdsConfSubInfoTotal.find('.tds-s-list-text').html( response['formatted_price'] );
                                                                        }

                                                                    }

                                                                    // view subscription btn url
                                                                    if ('undefined' !== typeof response['view_subscription_url']) {
                                                                        tdsPaymentConfirmationWrap.find('.tds-s-btn-view-subscription').attr( 'href', response['view_subscription_url'] );
                                                                    }

                                                                }
                                                            }
                                                        }
                                                    },
                                                    error: function ( MLHttpRequest, textStatus, errorThrown ) {
                                                        console.log( 'paypal > tds_subscription/create_subscription - Error callback - textStatus: ' + textStatus + ' errorThrown: ' + errorThrown );
                                                    }
                                                });

                                            }

                                            paypal.Buttons({
                                                fundingSource: paypal.FUNDING.PAYPAL,
                                                onClick: function ( data, actions ) {

                                                    if( !billingFormDisabled ) {
                                                        tdsValidation.resetFields();
                                                        if ( !tdsValidation.checkFields().checked ) {
                                                            return actions.reject();
                                                        }
                                                    }

                                                    let price = '<?php echo $price ?>';
                                                    let couponId = jQuery('#tds-coupon-id');
                                                    let discountedPrice = jQuery('#tds-discounted-price');

                                                    // apply coupon discount
                                                    if( couponId.val() ) {
                                                        price = discountedPrice.val();
                                                    }

                                                    // check plan price
                                                    if ( parseInt(price) === 0 || withTrial ) {

                                                        // no payment needed, just create the subscription
                                                        tdsPaypalCreateSubscription();

                                                        return actions.reject();
                                                    } else {
                                                        // proceed with payment
                                                        return actions.resolve();
                                                    }

                                                },
                                                createOrder: function ( data, actions ) {

                                                    let price = '<?php echo $price ?>';
                                                    let currencyCode = '<?php echo $curr_name ?>';
                                                    let couponId = jQuery('#tds-coupon-id');
                                                    let discountedPrice = jQuery('#tds-discounted-price');

                                                    // apply coupon discount
                                                    if( couponId.val() ) {
                                                        price = discountedPrice.val();
                                                    }

                                                    // proceed with payment
                                                    return actions.order.create({
                                                        purchase_units: [{
                                                            amount: {
                                                                value: price,
                                                                currency_code: currencyCode
                                                            }
                                                        }],
                                                        application_context: {
                                                            shipping_preference: "NO_SHIPPING"
                                                        }
                                                    });

                                                },
                                                onApprove: function ( data, actions ) {

                                                    return actions.order.capture().then( function (orderData) {
                                                        // console.log(orderData);

                                                        let tdsSubscription = jQuery('#tds-subscription-id');

                                                        if ( tdsSubscription.length ) {

                                                            // set payment data
                                                            let paymentData = {
                                                                'type': 'paypal',
                                                                'paypal_order_data': orderData
                                                            };

                                                            // update subscription
                                                            tdsSubs.tds_subscription_update(paymentData);

                                                        } else {

                                                            // create subscription
                                                            tdsPaypalCreateSubscription(orderData);

                                                        }

                                                    });

                                                },
                                                onError(error) {

                                                    // process paypal error

                                                    // find the starting and ending indices of the JSON part in the error string
                                                    const jsonStartIndex = error.message.indexOf('{');
                                                    const jsonEndIndex = error.message.lastIndexOf('}') + 1;

                                                    // extract the JSON part from the error string
                                                    const jsonPart = error.message.substring( jsonStartIndex, jsonEndIndex );

                                                    // parse the extracted JSON
                                                    try {
                                                        const errorResponse = JSON.parse(jsonPart);

                                                        // extract the required information
                                                        const errorName = errorResponse.name;
                                                        const errorMessage = errorResponse.message;
                                                        const errorDetails = errorResponse.details;

                                                        let errorHtml = '';
                                                        errorHtml += '<div class="tds-paypal-err-id">' + errorName + '</div>';
                                                        errorHtml += '<div class="tds-paypal-err-msg">' + errorMessage + '</div>';
                                                        errorHtml += '<div class="tds-paypal-err-details" style="display: none; word-wrap: break-word;">';
                                                        errorHtml += JSON.stringify( errorDetails[0], null, 2 );
                                                        errorHtml += '</div>';

                                                        // display received error msg
                                                        tdsSubs.show_payment_message( errorHtml, 'error', true );

                                                    } catch (error) {
                                                        console.error( 'Error parsing the paypal request error JSON:', error );

                                                        // display received error msg
                                                        tdsSubs.show_payment_message( 'Unknown error encountered. <br>Please check browser console for the detailed error data.', 'error', true );

                                                    }

                                                }
                                            }).render('#paypal-button-container');

                                        }

                                    } else {
                                        jQuery().ready(function () {
                                            var $el = jQuery('.tds-billing-payment-method[value="paypal"]');
                                            if ( $el.length ) {
                                                $el.attr( 'disabled', true );
                                            }
                                        });
                                    }

                                </script>

                                <?php
                                td_js_buffer::add_to_footer( "\n" . td_util::remove_script_tag( ob_get_clean() ) );

                            }

                            ob_start();
                            ?>
                            <script>

                                if ( 'undefined' === typeof tdsValidation ) {
                                    var tdsValidation = {
                                        fields: [
                                            {
                                                billingFirstName: jQuery('#tds-billing-first-name'),
                                                emptyMsg: '<?php echo __td( 'Field empty', TD_THEME_NAME ) ?>'
                                            },
                                            {
                                                billingLastName: jQuery('#tds-billing-last-name'),
                                                emptyMsg: '<?php echo __td( 'Field empty', TD_THEME_NAME ) ?>'
                                            },
                                            {
                                                billingCountry: jQuery('#tds-billing-country'),
                                                emptyMsg: '<?php echo __td( 'Field empty', TD_THEME_NAME ) ?>'
                                            },
                                            {
                                                billingAddress: jQuery('#tds-billing-address'),
                                                emptyMsg: '<?php echo __td( 'Field empty', TD_THEME_NAME ) ?>'
                                            },
                                            {
                                                billingCity: jQuery('#tds-billing-city'),
                                                emptyMsg: '<?php echo __td( 'Field empty', TD_THEME_NAME ) ?>'
                                            },
                                            {
                                                billingCounty: jQuery('#tds-billing-county'),
                                                emptyMsg: '<?php echo __td( 'Field empty', TD_THEME_NAME ) ?>'
                                            },
                                            {
                                                billingPostcode: jQuery('#tds-billing-postcode'),
                                                emptyMsg: '<?php echo __td( 'Field empty', TD_THEME_NAME ) ?>'
                                            },
                                            {
                                                billingPhone: jQuery('#tds-billing-phone'),
                                                emptyMsg: '<?php echo __td( 'Field empty', TD_THEME_NAME ) ?>'
                                            },
                                            {
                                                billingEmail: jQuery('#tds-billing-email'),
                                                emptyMsg: '<?php echo __td( 'Field empty', TD_THEME_NAME ) ?>',
                                                invalidMsg: '<?php echo __td( 'Invalid email', TD_THEME_NAME ) ?>'
                                            }
                                        ],

                                        resetFields: function () {
                                            tdsValidation.fields.forEach(el => {
                                                Object.values(el)[0].closest('.tds-s-form-group').removeClass('tds-s-fg-error').find('.tds-s-fg-error-msg').html('');
                                            });
                                        },

                                        checkFields: function () {
                                            let result = {
                                                params: {},
                                                checked: true
                                            };

                                            tdsValidation.fields.forEach(el => {

                                                result.params[Object.keys(el)[0]] = Object.values(el)[0].val().trim();

                                                if ('' === Object.values(el)[0].val().trim()) {
                                                    result.checked = false;
                                                    Object.values(el)[0].closest('.tds-s-form-group').addClass('tds-s-fg-error').find('.tds-s-fg-error-msg').html(Object.values(el)[1]);
                                                } else if ( 'tds-billing-email' === Object.values(el)[0].attr('id') ) {

                                                    if ( tdUtil.isEmail( Object.values(el)[0].val().trim() ) === false ) {
                                                        result.checked = false;
                                                        Object.values(el)[0].closest('.tds-s-form-group').addClass('tds-s-fg-error').find('.tds-s-fg-error-msg').html(Object.values(el)[2]);
                                                    }

                                                }

                                            });

                                            return result;
                                        },

                                    }
                                }

                                if ( 'undefined' === typeof tdsSubs ) {

                                    tdsSubs = {

                                        init: function () {

                                            jQuery().ready( function () {

                                                let successURL = '<?php echo $success_url ?>';

                                                // save initial stripe payment btn text
                                                let $tdsStripeCheckoutSessionBtn = jQuery('#tds-stripe-checkout-session'),
                                                    $tdsStripeCheckoutSessionBtnText = '';

                                                // if btn was found save btn text
                                                if ( $tdsStripeCheckoutSessionBtn.length ) {
                                                    $tdsStripeCheckoutSessionBtnText = $tdsStripeCheckoutSessionBtn.text();
                                                }

                                                jQuery(document).on( 'click', '.tds-billing-complete', function (event) {

                                                    event.preventDefault();

                                                    var $this = jQuery(this),
                                                        $tdsSubscriptionUserId = jQuery('#tds-subscription-user-id'),
                                                        $tdsSubscriptionPlanId = jQuery('#tds-subscription-plan-id'),
                                                        $tdsCouponId = jQuery('#tds-coupon-id'),
                                                        $tdsBillingPaymentMethod = jQuery('.tds-billing-payment-method:checked'),
                                                        //$tdsSubscriptionUrl = jQuery('#tds-subscription-url'),
                                                        // subscriptionUrl = '',

                                                        billingFormDisabled = <?php echo json_encode($disable_bill); ?>;

                                                    let tdsAutoUnlockPostId = <?php echo json_encode($this->tds_auto_unlock); ?>;

                                                    // if ( $tdsSubscriptionUrl.length ) {
                                                    //     subscriptionUrl = $tdsSubscriptionUrl.val();
                                                    // }

                                                    $this.addClass('tds-s-btn-saving');
                                                    $this.attr('disabled', 'disabled');

                                                    let ajaxCallData = {
                                                        subscriptionUserId: $tdsSubscriptionUserId.val(),
                                                        subscriptionPlanId: $tdsSubscriptionPlanId.val(),
                                                        subscriptionCouponId: $tdsCouponId.val(),
                                                        billingPaymentMethod: $tdsBillingPaymentMethod.val(),
                                                        billingFormDisabled: true,
                                                        billingFirstName: '',
                                                        billingLastName: '',
                                                        billingCompanyName: '',
                                                        billingVatNumber: '',
                                                        billingCountry: '',
                                                        billingAddress: '',
                                                        billingCity: '',
                                                        billingCounty: '',
                                                        billingPostcode: '',
                                                        billingPhone: '',
                                                        billingEmail: '',
                                                        autoUnlockPostId: tdsAutoUnlockPostId,
                                                    };

                                                    if( !billingFormDisabled ) {
                                                        tdsValidation.resetFields();
                                                        let checkFields = tdsValidation.checkFields();
                                                        if ( !checkFields.checked ) {
                                                            // tdsValidation.showMessage( 'Complete the required fields', 'warn' );
                                                            $this.removeClass('tds-s-btn-saving');
                                                            $this.removeAttr('disabled');
                                                            return;
                                                        }

                                                        let $tdsBillingFirstName = jQuery('#tds-billing-first-name'),
                                                            $tdsBillingLastName = jQuery('#tds-billing-last-name'),
                                                            $tdsBillingCompanyName = jQuery('#tds-billing-company-name'),
                                                            $tdsBillingVatNumber = jQuery('#tds-billing-vat'),
                                                            $tdsBillingCountry = jQuery('#tds-billing-country'),
                                                            $tdsBillingAddress = jQuery('#tds-billing-address'),
                                                            $tdsBillingCity = jQuery('#tds-billing-city'),
                                                            $tdsBillingCounty = jQuery('#tds-billing-county'),
                                                            $tdsBillingPostcode = jQuery('#tds-billing-postcode'),
                                                            $tdsBillingPhone = jQuery('#tds-billing-phone'),
                                                            $tdsBillingEmail = jQuery('#tds-billing-email');

                                                        ajaxCallData.billingFormDisabled = false;
                                                        ajaxCallData.billingFirstName    = $tdsBillingFirstName.val();
                                                        ajaxCallData.billingLastName     = $tdsBillingLastName.val();
                                                        ajaxCallData.billingCompanyName  = $tdsBillingCompanyName.val();
                                                        ajaxCallData.billingVatNumber    = $tdsBillingVatNumber.val();
                                                        ajaxCallData.billingCountry      = $tdsBillingCountry.val();
                                                        ajaxCallData.billingAddress      = $tdsBillingAddress.val();
                                                        ajaxCallData.billingCity         = $tdsBillingCity.val();
                                                        ajaxCallData.billingCounty       = $tdsBillingCounty.val();
                                                        ajaxCallData.billingPostcode     = $tdsBillingPostcode.val();
                                                        ajaxCallData.billingPhone        = $tdsBillingPhone.val();
                                                        ajaxCallData.billingEmail        = $tdsBillingEmail.val();
                                                    } else {
                                                        ajaxCallData.billingFirstName   = '<?php echo $billing_first_name ?>';
                                                        ajaxCallData.billingLastName    = '<?php echo $billing_last_name ?>';
                                                        ajaxCallData.billingCompanyName = '<?php echo $billing_company_name ?>';
                                                        ajaxCallData.billingVatNumber   = '<?php echo $billing_vat_number ?>';
                                                        ajaxCallData.billingCountry     = '<?php echo $billing_country ?>';
                                                        ajaxCallData.billingAddress     = '<?php echo $billing_address ?>';
                                                        ajaxCallData.billingCity        = '<?php echo $billing_city ?>';
                                                        ajaxCallData.billingCounty      = '<?php echo $billing_county ?>';
                                                        ajaxCallData.billingPostcode    = '<?php echo $billing_post_code ?>';
                                                        ajaxCallData.billingPhone       = '<?php echo $billing_phone ?>';
                                                        ajaxCallData.billingEmail       = '<?php echo $billing_email ?>';
                                                    }

                                                    let tdsSubscription = jQuery('#tds-subscription-id');

                                                    if ( tdsSubscription.length ) {

                                                        // set payment data
                                                        let paymentData = {
                                                            'type': 'direct'
                                                        };

                                                        tdsSubs.tds_subscription_update(paymentData); // update subscription

                                                    } else {
                                                        jQuery.ajax({
                                                            timeout: 20000,
                                                            type: 'POST',
                                                            url: tdsSubs.get_rest_endpoint(
                                                                'tds_subscription/create_subscription',
                                                                'uuid=' + tdsSubs.get_unique_id()
                                                            ),
                                                            beforeSend: function (xhr) {
                                                                // add the nonce used for cookie authentication
                                                                xhr.setRequestHeader('X-WP-Nonce', window.tds_js_globals.wpRestNonce);
                                                            },
                                                            cache: false,
                                                            dataType: 'json',
                                                            data: ajaxCallData,
                                                            success: function ( data, textStatus, jqXHR ) {
                                                                //console.log(data);
                                                                $this.removeClass('tds-s-btn-saving');

                                                                if ( 'undefined' !== typeof data['error'] ) {
                                                                    console.log(data['error']);
                                                                } else if ( 'undefined' !== typeof data['response'] && 'undefined' !== typeof data['response']['local_subscription_id'] ) {

                                                                    if ( 'undefined' !== typeof data['response']['confirm_url'] ) {

                                                                        if ( successURL !== '' ) {
                                                                            window.location.replace(successURL);
                                                                        } else {

                                                                            var response = data['response'],
                                                                                redirectUrl = response['confirm_url'];
                                                                            window.history.replaceState( {}, 'TDS Confirmation Page', redirectUrl );

                                                                            let tdsPaymentConfirmationWrap = jQuery('.tds-payment-confirmation');

                                                                            jQuery('.tds-payment-content').hide();
                                                                            jQuery('.tds-payment-sidebar').hide();
                                                                            tdsPaymentConfirmationWrap.show();

                                                                            // Subscription info section
                                                                            var $tdsConfSubInfoWrap = jQuery('.tds-s-psc-subscr-info'),
                                                                                $tdsConfSubInfoID = $tdsConfSubInfoWrap.find('.tds-s-subscr-id'),
                                                                                $tdsConfSubInfoPlan = $tdsConfSubInfoWrap.find('.tds-s-subscr-plan'),
                                                                                $tdsConfSubInfoMonths = $tdsConfSubInfoWrap.find('.tds-s-subscr-months'),
                                                                                $tdsConfSubInfoPeriod = $tdsConfSubInfoWrap.find('.tds-s-subscr-period'),
                                                                                $tdsConfSubInfoPayMethod = $tdsConfSubInfoWrap.find('.tds-s-subscr-pay-method'),
                                                                                $tdsConfSubInfoTotal = $tdsConfSubInfoWrap.find('.tds-s-subscr-total'),
                                                                                $tdsConfSubInfoCredits = $tdsConfSubInfoWrap.find('.tds-s-subscr-credits');

                                                                            $tdsConfSubInfoWrap.show();

                                                                            if ('undefined' !== typeof response['local_subscription_id']) {
                                                                                $tdsConfSubInfoID.find('.tds-s-list-text').html(response['local_subscription_id']);
                                                                            }
                                                                            if ('undefined' !== typeof response['local_plan_name']) {
                                                                                $tdsConfSubInfoPlan.find('.tds-s-list-text').html(response['local_plan_name']);
                                                                            }
                                                                            if ('undefined' !== typeof response['cycle_interval_format']) {
                                                                                $tdsConfSubInfoMonths.find('.tds-s-list-text').html(response['cycle_interval_format']);
                                                                                $tdsConfSubInfoMonths.show();
                                                                            } else {
                                                                                $tdsConfSubInfoMonths.hide();
                                                                            }
                                                                            if ('undefined' !== typeof response['start_date']) {
                                                                                $tdsConfSubInfoPeriod.find('.tds-s-list-text').html(response['start_date'] + ' - ' + response['end_date']);
                                                                            }

                                                                            // hide period info
                                                                            if ('undefined' !== typeof response['is_with_credits']) {
                                                                                $tdsConfSubInfoPeriod.hide();

                                                                                // update & show credits info
                                                                                $tdsConfSubInfoCredits.find('.tds-s-list-text').html(response['credits']);
                                                                                $tdsConfSubInfoCredits.show();

                                                                            }

                                                                            if ('undefined' !== typeof response['payment_type']) {
                                                                                if( response['is_free'] === '0' ) {
                                                                                    $tdsConfSubInfoPayMethod.find('.tds-s-list-text').html(response['payment_type']);
                                                                                    $tdsConfSubInfoPayMethod.show();
                                                                                }
                                                                            } else {
                                                                                $tdsConfSubInfoPayMethod.hide();
                                                                            }
                                                                            if ('undefined' !== typeof response['price']) {

                                                                                // formatted price
                                                                                if ( 'undefined' !== typeof response['formatted_full_price'] ) {
                                                                                    $tdsConfSubInfoTotal.find('.tds-s-list-text').html(
                                                                                        '<span class="tds-s-price-full">' + response['formatted_full_price'] +
                                                                                        '</span>' +
                                                                                        '<span>' + response['formatted_price'] + '</span>'
                                                                                    );
                                                                                } else {
                                                                                    $tdsConfSubInfoTotal.find('.tds-s-list-text').html(
                                                                                        response['is_free'] === '0' ? response['formatted_price'] : '<?php echo __td('Free', TD_THEME_NAME )?>'
                                                                                    );
                                                                                }

                                                                            }

                                                                            // view subscription btn url
                                                                            if ('undefined' !== typeof response['view_subscription_url']) {
                                                                                tdsPaymentConfirmationWrap.find('.tds-s-btn-view-subscription').attr( 'href', response['view_subscription_url'] );
                                                                            }

                                                                            // Bank info section
                                                                            if ('undefined' !== typeof response['payment_type']) {
                                                                                var $tdsConfBankInfoWrap = jQuery('.tds-s-psc-bank-info'),
                                                                                    $tdsConfBankInfoName = $tdsConfBankInfoWrap.find('.tds-s-bank-name'),
                                                                                    $tdsConfBankInfoAccName = $tdsConfBankInfoWrap.find('.tds-s-bank-acc-name'),
                                                                                    $tdsConfBankInfoAccNumber = $tdsConfBankInfoWrap.find('.tds-s-bank-acc-number'),
                                                                                    $tdsConfBankInfoRouting = $tdsConfBankInfoWrap.find('.tds-s-bank-routing'),
                                                                                    $tdsConfBankInfoIBAN = $tdsConfBankInfoWrap.find('.tds-s-bank-iban'),
                                                                                    $tdsConfBankInfoBic = $tdsConfBankInfoWrap.find('.tds-s-bank-bic'),
                                                                                    $tdsConfBankInfoInstructions = $tdsConfBankInfoWrap.find('.tds-s-bank-instructions');

                                                                                $tdsConfBankInfoWrap.show();

                                                                                if ('undefined' !== typeof response['payment_bank']) {
                                                                                    $tdsConfBankInfoName.find('.tds-s-list-text').html(response['payment_bank']);
                                                                                    $tdsConfBankInfoName.show();
                                                                                }
                                                                                if ('undefined' !== typeof response['payment_account_name']) {
                                                                                    $tdsConfBankInfoAccName.find('.tds-s-list-text').html(response['payment_account_name']);
                                                                                    $tdsConfBankInfoAccName.show();
                                                                                }
                                                                                if ('undefined' !== typeof response['payment_account_number']) {
                                                                                    $tdsConfBankInfoAccNumber.find('.tds-s-list-text').html(response['payment_account_number']);
                                                                                    $tdsConfBankInfoAccNumber.show();
                                                                                }
                                                                                if ('undefined' !== typeof response['payment_routing_number'] && response['payment_routing_number'] !== '') {
                                                                                    $tdsConfBankInfoRouting.find('.tds-s-list-text').html(response['payment_routing_number']);
                                                                                    $tdsConfBankInfoRouting.show();
                                                                                }
                                                                                if ('undefined' !== typeof response['payment_iban'] && response['payment_iban'] !== '') {
                                                                                    $tdsConfBankInfoIBAN.find('.tds-s-list-text').html(response['payment_iban']);
                                                                                    $tdsConfBankInfoIBAN.show();
                                                                                }
                                                                                if ('undefined' !== typeof response['payment_bic_swift'] && response['payment_bic_swift'] !=='') {
                                                                                    $tdsConfBankInfoBic.find('.tds-s-list-text').html(response['payment_bic_swift']);
                                                                                    $tdsConfBankInfoBic.show();
                                                                                }
                                                                                if ('undefined' !== typeof response['payment_instruction'] && response['payment_instruction'] !== '') {
                                                                                    $tdsConfBankInfoInstructions.find('.tds-s-list-text').html(response['payment_instruction']);
                                                                                    $tdsConfBankInfoInstructions.show();
                                                                                }
                                                                            }

                                                                        }
                                                                    }
                                                                }
                                                            },
                                                            error: function ( MLHttpRequest, textStatus, errorThrown ) {
                                                                console.log( 'bank direct > tds_subscription/create_subscription - Error callback - textStatus: ' + textStatus + ' errorThrown: ' + errorThrown );
                                                            }
                                                        });
                                                    }

                                                }).on( 'change', '.tds-billing-payment-method', function(event) {
                                                    var $this = jQuery(this),

                                                        $paymentContentDirect = jQuery('.tds-spm-direct .tds-spm-content'),
                                                        $paymentContentPaypal = jQuery('.tds-spm-paypal .tds-spm-content'),
                                                        $paymentContentStripe = jQuery('.tds-spm-stripe .tds-spm-content'),
                                                        $paymentContentCustomPayment = jQuery('.tds-spm-custom-payment .tds-spm-content'),

                                                        $tdsBillingComplete = jQuery('.tds-billing-complete'),
                                                        $paypalButtonContainer = jQuery('#paypal-button-container'),
                                                        $tdsStripeCheckoutSessionBtn = jQuery('#tds-stripe-checkout-session'),
                                                        $tdsCustomPaymentBtns = jQuery('.tds-s-form-footer .tds-s-btn-cp');

                                                    switch ( $this.val() ) {

                                                        case 'direct':

                                                            if ( $paymentContentDirect.length ) {
                                                                $paymentContentDirect.slideDown(200);
                                                            }
                                                            if ( $paymentContentPaypal.length ) {
                                                                $paymentContentPaypal.slideUp(200);
                                                            }
                                                            if ( $paymentContentStripe.length ) {
                                                                $paymentContentStripe.slideUp(200);
                                                            }
                                                            if ( $paymentContentCustomPayment.length ) {
                                                                $paymentContentCustomPayment.slideUp(200);
                                                            }

                                                            $tdsBillingComplete.show();
                                                            $paypalButtonContainer.hide();
                                                            $tdsStripeCheckoutSessionBtn.hide();

                                                            // hide custom payments buttons
                                                            $tdsCustomPaymentBtns.hide();

                                                            break;

                                                        case 'paypal':

                                                            if ( $paymentContentDirect.length ) {
                                                                $paymentContentDirect.slideUp(200);
                                                            }
                                                            if ( $paymentContentPaypal.length ) {
                                                                $paymentContentPaypal.slideDown(200);
                                                            }
                                                            if ( $paymentContentStripe.length ) {
                                                                $paymentContentStripe.slideUp(200);
                                                            }
                                                            if ( $paymentContentCustomPayment.length ) {
                                                                $paymentContentCustomPayment.slideUp(200);
                                                            }

                                                            $tdsBillingComplete.hide();
                                                            $paypalButtonContainer.show();
                                                            $tdsStripeCheckoutSessionBtn.hide();

                                                            // hide custom payments buttons
                                                            $tdsCustomPaymentBtns.hide();

                                                            break;

                                                        case 'stripe':

                                                            if ( $paymentContentDirect.length ) {
                                                                $paymentContentDirect.slideUp(200);
                                                            }
                                                            if ( $paymentContentPaypal.length ) {
                                                                $paymentContentPaypal.slideUp(200);
                                                            }
                                                            if ( $paymentContentStripe.length ) {
                                                                $paymentContentStripe.slideDown(200);
                                                            }
                                                            if ( $paymentContentCustomPayment.length ) {
                                                                $paymentContentCustomPayment.slideUp(200);
                                                            }

                                                            $tdsBillingComplete.hide();
                                                            $paypalButtonContainer.hide();
                                                            $tdsStripeCheckoutSessionBtn.show();

                                                            // hide custom payments buttons
                                                            $tdsCustomPaymentBtns.hide();

                                                            break;

                                                        default:

                                                            if ( $paymentContentDirect.length ) {
                                                                $paymentContentDirect.slideUp(200);
                                                            }

                                                            if ( $paymentContentPaypal.length ) {
                                                                $paymentContentPaypal.slideUp(200);
                                                            }

                                                            if ( $paymentContentStripe.length ) {
                                                                $paymentContentStripe.slideUp(200);
                                                            }

                                                            if ( $paymentContentCustomPayment.length ) {
                                                                $paymentContentCustomPayment.slideUp(200);
                                                            }

                                                            jQuery('.tds-spm-' + $this.val() + ' .tds-spm-content').slideDown(200);

                                                            $tdsBillingComplete.hide();
                                                            $paypalButtonContainer.hide();
                                                            $tdsStripeCheckoutSessionBtn.hide();

                                                            // hide custom payments buttons
                                                            $tdsCustomPaymentBtns.hide();

                                                            jQuery('.tds-s-form-footer .tds-cp-' + $this.val() ).show();

                                                            break;

                                                    }

                                                    // reset errors
                                                    tdsSubs.reset_error_messages();

                                                }).on( 'click', '.tds-coupon-apply-btn', function (event) {
                                                    event.preventDefault();

                                                    var $this = jQuery(this),
                                                        $tdsCouponForm = $this.closest('.tds-s-coupon-form'),
                                                        $tdsCouponInputWrapp = $tdsCouponForm.find('.tds-s-form-group-coupon-code'),
                                                        $tdsCouponInput = $tdsCouponForm.find('.tds-coupon'),
                                                        $tdsCoupon = $tdsCouponInput.val(),
                                                        $tdsCouponFormMsgWrapp = $tdsCouponForm.find('.tds-coupon-msg'),
                                                        $tdsCouponFormMsg = $tdsCouponFormMsgWrapp.find('.tds-s-notif-descr'),

                                                        $tdsInitialPrice = jQuery('#tds-initial-price').val()

                                                    // Place the button in a loading state
                                                    $this.addClass('tds-s-btn-saving');

                                                    // Remove any form input errors & notifications
                                                    $tdsCouponInputWrapp.removeClass('tds-s-fg-error tds-s-fg-success');
                                                    $tdsCouponFormMsg.html('');
                                                    $tdsCouponFormMsgWrapp.removeClass('tds-s-notif-coupon-applied tds-s-notif-warn tds-s-notif-error').hide();

                                                    // the subscription coupon code id
                                                    var $tdsCouponId = jQuery('#tds-coupon-id');

                                                    // Check if the coupon input is empty or if the remove coupon code is pressed
                                                    if ( $tdsCoupon === '' || $this.text() === '<?php echo __td( 'Remove', TD_THEME_NAME ) ?>' ) {

                                                        if( $tdsCoupon === '' && $this.text() === '<?php echo __td( 'Apply', TD_THEME_NAME ) ?>' ) {
                                                            // The coupon code input is empty, so display a warning
                                                            $tdsCouponFormMsg.html( '<?php echo __td( 'Please enter a coupon code first!', TD_THEME_NAME ) ?>' );
                                                            $tdsCouponFormMsgWrapp.addClass('tds-s-notif-warn').show();
                                                        } else {
                                                            // The reset button has been pressed

                                                            // Reset the grand total price text
                                                            jQuery('.tds-s-subscr-summary-total .tds-s-sst-val').text( $tdsInitialPrice );

                                                            // Change the button text
                                                            $this.text('<?php echo __td( 'Apply', TD_THEME_NAME ) ?>');

                                                            // Clear the coupon code input
                                                            $tdsCouponInput.val('');

                                                            // Clear the coupon code id
                                                            $tdsCouponId.val('');

                                                            // Enable input
                                                            $tdsCouponInput.removeAttr('disabled');

                                                            // Change stripe payment btn text, set it to it's initial value
                                                            $tdsStripeCheckoutSessionBtn.text($tdsStripeCheckoutSessionBtnText);

                                                        }

                                                        // Remove the button from the loading state
                                                        $this.removeClass('tds-s-btn-saving');

                                                    } else {

                                                        jQuery.ajax({
                                                            timeout: 20000,
                                                            type: 'POST',
                                                            url: tdsSubs.get_rest_endpoint(
                                                                'tds_subscription/apply_coupon',
                                                                'uuid=' + tdsSubs.get_unique_id()
                                                            ),
                                                            beforeSend: function ( xhr ) {
                                                                xhr.setRequestHeader( 'X-WP-Nonce', window.tds_js_globals.wpRestNonce );
                                                            },
                                                            cache: false,
                                                            dataType: 'json',
                                                            data: {
                                                                couponName: $tdsCoupon,
                                                                price: '<?php echo $price ?>'
                                                            },
                                                            success: function ( data ) {
                                                                // console.log(data);

                                                                if ( data.error ) {
                                                                    // We encountered a know error

                                                                    // Briefly change the button text
                                                                    $this.text('<?php echo __td( 'Invalid', TD_THEME_NAME ) ?>').addClass('tds-coupon-apply-btn-invalid');
                                                                    setTimeout( function() {
                                                                        $this.text('<?php echo __td( 'Apply', TD_THEME_NAME ) ?>').removeClass('tds-coupon-apply-btn-invalid');
                                                                    }, 2000 );

                                                                    // Place the input in an error state and display the error message
                                                                    $tdsCouponInputWrapp.addClass('tds-s-fg-error');
                                                                    $tdsCouponFormMsg.html( data.error[0] );
                                                                    $tdsCouponFormMsgWrapp.addClass('tds-s-notif-error').show();

                                                                } else if ( data.coupon_id ) {
                                                                    // No error was encountered, so proceed with applying the coupon code

                                                                    // Display the new grand total price
                                                                    jQuery('.tds-s-subscr-summary-total .tds-s-sst-val').text( data.discounted_price_with_currency );

                                                                    // Place the input in a success state
                                                                    $tdsCouponInputWrapp.addClass('tds-s-fg-success');

                                                                    // Change the button text
                                                                    $this.text('<?php echo __td( 'Applied', TD_THEME_NAME ) ?>').addClass('tds-coupon-apply-btn-applied');
                                                                    setTimeout( function() {
                                                                        $this.text('<?php echo __td( 'Remove', TD_THEME_NAME ) ?>').removeClass('tds-coupon-apply-btn-applied');
                                                                    }, 2000 );

                                                                    // Show a success message with the discount value
                                                                    $tdsCouponFormMsg.html('<?php echo __td( 'Coupon applied', TD_THEME_NAME ) ?> <span>- ' + data.discount_with_currency + '</span>');
                                                                    $tdsCouponFormMsgWrapp.addClass('tds-s-notif-coupon-applied').show();

                                                                    // Disable input
                                                                    $tdsCouponInput.attr( 'disabled', 'disabled' );

                                                                    // Save the coupon code id
                                                                    $tdsCouponId.val(data.coupon_id);

                                                                    // Save the discount price
                                                                    jQuery('#tds-discounted-price').val(data.discounted_price);

                                                                    // Change stripe payment btn text
                                                                    if ( parseInt(data.discounted_price) === 0 ) {
                                                                        $tdsStripeCheckoutSessionBtn.text('Subscribe');
                                                                    }

                                                                } else {
                                                                    // If we encountered an unknown error while trying to apply the coupon,
                                                                    // display a message
                                                                    $tdsCouponFormMsg.html( '<?php echo __td( 'Uncaught Error: Something went wrong, please reload page and try again!', TD_THEME_NAME ) ?>' );
                                                                    $tdsCouponFormMsgWrapp.addClass('tds-s-notif-error').show();
                                                                }

                                                                // Remove the button from its loading state
                                                                $this.removeClass('tds-s-btn-saving');

                                                            },
                                                            error: function ( MLHttpRequest, textStatus, errorThrown ) {
                                                                console.log( 'tds_subscription/apply_coupon - Error callback - textStatus: ' + textStatus + ' errorThrown: ' + errorThrown );

                                                                // Display the error message
                                                                $tdsCouponFormMsg.html( errorThrown )
                                                                $tdsCouponFormMsgWrapp.addClass('tds-s-notif-error').show();

                                                                // Remove the button from its loading state
                                                                $this.removeClass('tds-s-btn-saving');

                                                            }
                                                        });

                                                    }

                                                });

                                            });

                                        },

                                        // tds subscription update
                                        tds_subscription_update: function ( paymentData ) {

                                            let paymentType = paymentData.type;

                                            var $tdsSubscriptionUserId = jQuery('#tds-subscription-user-id'),
                                                $tdsSubscriptionPlanId = jQuery('#tds-subscription-plan-id'),
                                                //$tdsCouponId = jQuery('#tds-coupon-id'),
                                                $tdsSubscriptionPaymentMethod = jQuery('.tds-billing-payment-method:checked'),
                                                $tdsSubscriptionId = jQuery('#tds-subscription-id');

                                            // get billing data
                                            let formBillingData = tdsSubs.get_form_billing_data();

                                            // ajax data
                                            let ajaxCallData = {
                                                subscriptionUserId: $tdsSubscriptionUserId.val(),
                                                subscriptionPlanId: $tdsSubscriptionPlanId.val(),
                                                //subscriptionCouponId: $tdsCouponId.val(),
                                                subscriptionPaymentMethod: $tdsSubscriptionPaymentMethod.val(),
                                                subscriptionId: $tdsSubscriptionId.val(),
                                                billingData: formBillingData
                                            };

                                            // add paypal order data
                                            if ( paymentType === 'paypal' ) {
                                                let paypalOrder = paymentData.paypal_order_data;

                                                ajaxCallData.paypalOrderData = {
                                                    order_id: paypalOrder.id,
                                                    order_intent: paypalOrder.intent,
                                                    order_status: paypalOrder.status,
                                                    order_payer_id: paypalOrder.payer.payer_id,
                                                    order_payer_given_name: paypalOrder.payer.name.given_name,
                                                    order_payer_surname: paypalOrder.payer.name.surname,
                                                    order_payer_email: paypalOrder.payer.email_address,
                                                    order_payee_id: paypalOrder.purchase_units[0].payee.merchant_id,
                                                    order_payee_email: paypalOrder.purchase_units[0].payee.email_address,
                                                    order_amount_currency_code: paypalOrder.purchase_units[0].amount.currency_code,
                                                    order_amount_value: paypalOrder.purchase_units[0].amount.value,
                                                    order_info: JSON.stringify(paypalOrder, null, 2),
                                                    order_create_time: paypalOrder.create_time,
                                                    order_update_time: paypalOrder.update_time,
                                                    order_capture_create_time: paypalOrder.purchase_units[0].payments.captures[0].create_time,
                                                    order_capture_update_time: paypalOrder.purchase_units[0].payments.captures[0].update_time,
                                                };

                                            }

                                            // add stripe checkout session data
                                            if ( paymentType === 'stripe' ) {
                                                ajaxCallData.stripeCheckoutSessionData = paymentData.stripe_checkout_session_data;
                                            }

                                            // console.log( 'tds_subscription_update > ajaxCallData', ajaxCallData );

                                            // reset any error messages
                                            tdsSubs.reset_error_messages();

                                            jQuery.ajax({
                                                timeout: 20000,
                                                type: 'POST',
                                                url: tdsSubs.get_rest_endpoint(
                                                    'tds_subscription/update_subscription',
                                                    'uuid=' + tdsSubs.get_unique_id()
                                                ),
                                                beforeSend: function (xhr) {
                                                    // add the nonce used for cookie authentication
                                                    xhr.setRequestHeader('X-WP-Nonce', window.tds_js_globals.wpRestNonce);
                                                },
                                                cache: false,
                                                dataType: 'json',
                                                data: ajaxCallData,
                                                success: function ( data, textStatus, jqXHR ) {
                                                    // console.log(data);

                                                    // direct bank transfer payment
                                                    if ( $tdsSubscriptionPaymentMethod.val() === 'direct' ) {

                                                        // find btn
                                                        var $tdsBillingCompleteBtn = jQuery('.tds-s-form-footer button.tds-billing-complete');

                                                        if ( $tdsBillingCompleteBtn.length ) {
                                                            // remove btn loading && disabled state
                                                            $tdsBillingCompleteBtn.removeClass('tds-s-btn-saving').removeAttr('disabled');
                                                        }

                                                    } else if ( $tdsSubscriptionPaymentMethod.val() === 'stripe' ) {

                                                        // remove checkout session loading state
                                                        jQuery('.tds-checkout-wrap.tds-checkout-session').removeClass('tds-cs-loading');

                                                    }

                                                    let successURL = '<?php echo $success_url ?>';

                                                    if ( 'undefined' !== typeof data['error'] ) {
                                                        console.error( data['error'] );

                                                        // display received error msg
                                                        tdsSubs.show_payment_message( data['error'], 'error', true );

                                                    } else if ( 'undefined' !== typeof data['response'] ) {

                                                        if ( 'undefined' !== typeof data['response']['confirm_url'] ) {

                                                            if( successURL !== '' ) {
                                                                window.location.replace(successURL);
                                                            } else {
                                                                var response = data['response'], redirectUrl = response['confirm_url'];

                                                                window.history.replaceState( {}, 'TDS Confirmation Page', redirectUrl );

                                                                jQuery('.tds-payment-content').hide();
                                                                jQuery('.tds-payment-sidebar').hide();
                                                                jQuery('.tds-payment-confirmation').show();

                                                                // subscription info section
                                                                var $tdsConfSubInfoWrap = jQuery('.tds-s-psc-subscr-info'),
                                                                    $tdsConfBankInfoWrap = jQuery('.tds-s-psc-bank-info'),
                                                                    $tdsConfSubInfoPayMethod = $tdsConfSubInfoWrap.find('.tds-s-subscr-pay-method');

                                                                $tdsConfSubInfoWrap.show();

                                                                // update payment type
                                                                if ( 'undefined' !== typeof response['payment_type'] ) {
                                                                    $tdsConfSubInfoPayMethod.find('.tds-s-list-text').html(response['payment_type']);

                                                                    if ( $tdsSubscriptionPaymentMethod.val() === 'direct' ) {
                                                                        $tdsConfBankInfoWrap.show();
                                                                    } else {
                                                                        $tdsConfBankInfoWrap.hide();
                                                                    }

                                                                }

                                                            }

                                                        }

                                                    }

                                                },
                                                error: function ( MLHttpRequest, textStatus, errorThrown ) {
                                                    console.warn( 'tdsSubs.tds_subscription_update - error callback - textStatus: ' + textStatus );
                                                    console.error( 'errorThrown: ' + errorThrown );
                                                    tdsSubs.show_payment_message( errorThrown, 'error', true );
                                                }
                                            });

                                        },

                                        // returns form billing data
                                        get_form_billing_data: function () {

                                            let billingFormDisabled = <?php echo json_encode($disable_bill); ?>;

                                            if ( !billingFormDisabled ) {

                                                let $tdsBillingFirstName = jQuery('#tds-billing-first-name'),
                                                    $tdsBillingLastName = jQuery('#tds-billing-last-name'),
                                                    $tdsBillingCompanyName = jQuery('#tds-billing-company-name'),
                                                    $tdsBillingVatNumber = jQuery('#tds-billing-vat'),
                                                    $tdsBillingCountry = jQuery('#tds-billing-country'),
                                                    $tdsBillingAddress = jQuery('#tds-billing-address'),
                                                    $tdsBillingCity = jQuery('#tds-billing-city'),
                                                    $tdsBillingCounty = jQuery('#tds-billing-county'),
                                                    $tdsBillingPostcode = jQuery('#tds-billing-postcode'),
                                                    $tdsBillingPhone = jQuery('#tds-billing-phone'),
                                                    $tdsBillingEmail = jQuery('#tds-billing-email');

                                                // set form billing data
                                                return {
                                                    billing_first_name: $tdsBillingFirstName.val(),
                                                    billing_last_name: $tdsBillingLastName.val(),
                                                    billing_company_name: $tdsBillingCompanyName.val(),
                                                    billing_vat_number: $tdsBillingVatNumber.val(),
                                                    billing_country: $tdsBillingCountry.val(),
                                                    billing_address: $tdsBillingAddress.val(),
                                                    billing_city: $tdsBillingCity.val(),
                                                    billing_county: $tdsBillingCounty.val(),
                                                    billing_post_code: $tdsBillingPostcode.val(),
                                                    billing_phone: $tdsBillingPhone.val(),
                                                    billing_email: $tdsBillingEmail.val(),
                                                };

                                            } else {

                                                // set form billing data
                                                return {
                                                    billing_first_name: '<?php echo $billing_first_name ?>',
                                                    billing_last_name: '<?php echo $billing_last_name ?>',
                                                    billing_company_name: '<?php echo $billing_company_name ?>',
                                                    billing_vat_number: '<?php echo $billing_vat_number ?>',
                                                    billing_country: '<?php echo $billing_country ?>',
                                                    billing_address: '<?php echo $billing_address ?>',
                                                    billing_city: '<?php echo $billing_city ?>',
                                                    billing_county: '<?php echo $billing_county ?>',
                                                    billing_post_code: '<?php echo $billing_post_code ?>',
                                                    billing_phone: '<?php echo $billing_phone ?>',
                                                    billing_email: '<?php echo $billing_email ?>',
                                                };

                                            }

                                        },

                                        // display error/warn/info messages
                                        show_payment_message: function ( messageText, type = '', permanent ) {

                                            const $tdsPaymentMessage = jQuery("#tds-payment-message"),
                                                $tdsPaymentMessageTxt = $tdsPaymentMessage.find('.tds-s-notif-descr');

                                            $tdsPaymentMessage.show();
                                            $tdsPaymentMessageTxt.html(messageText);

                                            if ( type !== '' ) {
                                                $tdsPaymentMessage.addClass('tds-s-notif-' + type);
                                            }

                                            if ( 'undefined' !== typeof permanent && true === permanent ) {
                                                return;
                                            }

                                            setTimeout( function () {
                                                $tdsPaymentMessage.hide();
                                                $tdsPaymentMessageTxt.html('');

                                                if ( type !== '' ) {
                                                    $tdsPaymentMessage.removeClass('tds-s-notif-' + type);
                                                }

                                            }, 10000 );

                                        },

                                        // resets permanent error messages
                                        reset_error_messages: function () {

                                            const $tdsPaymentMessage = jQuery("#tds-payment-message"),
                                                $tdsPaymentMessageTxt = $tdsPaymentMessage.find('.tds-s-notif-descr');

                                            $tdsPaymentMessage.hide();
                                            $tdsPaymentMessageTxt.html('');
                                            $tdsPaymentMessage.removeClass('tds-s-notif-error');

                                        },

                                        // returns a full rest endpoint url..
                                        get_rest_endpoint: function ( restEndPoint, queryString ) {

                                            if ( _.isEmpty(window.tds_js_globals.permalinkStructure) ) {
                                                return window.tds_js_globals.wpRestUrl + restEndPoint + '&' + queryString; // no permalinks
                                            } else {
                                                return window.tds_js_globals.wpRestUrl + restEndPoint + '?' + queryString; // we have permalinks enabled
                                            }

                                        },

                                        // generates a unique ID
                                        get_unique_id: function () {
                                            function s4() {
                                                return Math.floor((1 + Math.random()) * 0x10000)
                                                    .toString(16)
                                                    .substring(1);
                                            }

                                            return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
                                        },

                                        // auto unlock post
                                        auto_unlock_post: function ( tds_unlock_post_id ) {

                                            let request_results = {
                                                "errors": [],
                                                "result": [],
                                                "rdr_url": ''
                                            }

                                            // post unlock request
                                            jQuery.ajax({
                                                timeout: 20000,
                                                type: 'POST',
                                                url: tdsSubs.get_rest_endpoint(
                                                    'tds_leads/tds_leads_form_submit',
                                                    'uuid=' + tdsSubs.get_unique_id()
                                                ),
                                                beforeSend: function (xhr) {
                                                    // add the nonce used for cookie authentication
                                                    xhr.setRequestHeader('X-WP-Nonce', window.tds_js_globals.wpRestNonce);
                                                },
                                                cache: false,
                                                dataType: 'json',
                                                async: false,
                                                data: {
                                                    user_id: jQuery('#tds-subscription-user-id').val(),
                                                    tds_unlock_post_id: tds_unlock_post_id,
                                                    action: 'unlock',
                                                },
                                                success: function ( response ) {
                                                    console.log( 'auto_unlock_post response: ', response );
                                                    request_results.result = response.result;
                                                    request_results.rdr_url = response.rdr_url;
                                                },
                                                error: function ( MLHttpRequest, textStatus, errorThrown ) {
                                                    request_results.errors = [
                                                        'tds_leads/tds_leads_form_submit - error callback - textStatus: ' + textStatus,
                                                        'errorThrown: ' + errorThrown
                                                    ];
                                                    request_results.result = [ 'error' ];
                                                }
                                            });

                                            return request_results;

                                        }

                                    };

                                    tdsSubs.init();

                                }

                            </script>
                            <?php

                            // js for frontend
                            td_js_buffer::add_to_footer( "\n" . td_util::remove_script_tag( ob_get_clean() ) );

                            if ( null !== $payment_stripe && count($payment_stripe) && $payment_stripe[0]['is_active'] ) {

                                if ( $this->is_payment_session ) {
                                    $cs_mode = 'payment';
                                } else {
                                    $cs_mode = !$unlimited && !$with_credit ? 'subscription' : ( $with_trial ? 'setup' : 'payment' );
                                }

                                ob_start();
                                ?>
                                <script>

                                    const $tdsStripeCheckoutSessionBtn = jQuery('#tds-stripe-checkout-session');
                                    if ( $tdsStripeCheckoutSessionBtn.length ) {

                                        $tdsStripeCheckoutSessionBtn.on( 'click', function (event) {
                                            event.preventDefault();

                                            let $this = jQuery(this),
                                                billingFormDisabled = <?php echo json_encode($disable_bill); ?>,
                                                checkoutSessionMode = '<?php echo $cs_mode ?>',
                                                formBillingData = {};

                                            let tdsAutoUnlockPostId = <?php echo json_encode($this->tds_auto_unlock); ?>;

                                            tdsResetMessage();
                                            $this.addClass('tds-s-btn-saving');
                                            $this.attr( 'disabled', 'disabled' );

                                            if( !billingFormDisabled ) {

                                                tdsValidation.resetFields();
                                                let checkFields = tdsValidation.checkFields();
                                                if ( !checkFields.checked ) {
                                                    $this.removeClass('tds-s-btn-saving');
                                                    $this.removeAttr('disabled');
                                                    return;
                                                }

                                                // form billing data
                                                let $tdsBillingFirstName = jQuery('#tds-billing-first-name'),
                                                    $tdsBillingLastName = jQuery('#tds-billing-last-name'),
                                                    $tdsBillingCompanyName = jQuery('#tds-billing-company-name'),
                                                    $tdsBillingVatNumber = jQuery('#tds-billing-vat'),
                                                    $tdsBillingCountry = jQuery('#tds-billing-country'),
                                                    $tdsBillingAddress = jQuery('#tds-billing-address'),
                                                    $tdsBillingCity = jQuery('#tds-billing-city'),
                                                    $tdsBillingCounty = jQuery('#tds-billing-county'),
                                                    $tdsBillingPostcode = jQuery('#tds-billing-postcode'),
                                                    $tdsBillingPhone = jQuery('#tds-billing-phone'),
                                                    $tdsBillingEmail = jQuery('#tds-billing-email');

                                                // set form billing data
                                                formBillingData = {
                                                    billingFirstName: $tdsBillingFirstName.val(),
                                                    billingLastName: $tdsBillingLastName.val(),
                                                    billingCompanyName: $tdsBillingCompanyName.val(),
                                                    billingVatNumber: $tdsBillingVatNumber.val(),
                                                    billingCountry: $tdsBillingCountry.val(),
                                                    billingAddress: $tdsBillingAddress.val(),
                                                    billingCity: $tdsBillingCity.val(),
                                                    billingCounty: $tdsBillingCounty.val(),
                                                    billingPostcode: $tdsBillingPostcode.val(),
                                                    billingPhone: $tdsBillingPhone.val(),
                                                    billingEmail: $tdsBillingEmail.val(),
                                                };

                                            } else {

                                                // set form billing data
                                                formBillingData = {
                                                    billingFirstName: '<?php echo $billing_first_name ?>',
                                                    billingLastName: '<?php echo $billing_last_name ?>',
                                                    billingCompanyName: '<?php echo $billing_company_name ?>',
                                                    billingVatNumber: '<?php echo $billing_vat_number ?>',
                                                    billingCountry: '<?php echo $billing_country ?>',
                                                    billingAddress: '<?php echo $billing_address ?>',
                                                    billingCity: '<?php echo $billing_city ?>',
                                                    billingCounty: '<?php echo $billing_county ?>',
                                                    billingPostcode: '<?php echo $billing_post_code ?>',
                                                    billingPhone: '<?php echo $billing_phone ?>',
                                                    billingEmail: '<?php echo $billing_email ?>',
                                                };

                                            }

                                            // build ajax call data
                                            let ajaxCallData = {
                                                ...formBillingData,
                                                subscriptionUserId: jQuery('#tds-subscription-user-id').val(),
                                            };

                                            // ajax create_stripe_customer
                                            jQuery.ajax({
                                                timeout: 20000,
                                                type: 'POST',
                                                url: tdsSubs.get_rest_endpoint(
                                                    'tds_subscription/create_stripe_customer',
                                                    'uuid=' + tdsSubs.get_unique_id()
                                                ),
                                                beforeSend: function (xhr) {
                                                    // add the nonce used for cookie authentication
                                                    xhr.setRequestHeader('X-WP-Nonce', window.tds_js_globals.wpRestNonce);
                                                },
                                                cache: false,
                                                dataType: 'json',
                                                data: ajaxCallData,
                                                success: function (data) {
                                                    // console.log(data);

                                                    if ( 'undefined' !== typeof data['error'] ) {

                                                        tdsShowMessage( data['error'], 'error', true );

                                                        $this.removeClass('tds-s-btn-saving');
                                                        $this.removeAttr('disabled');

                                                    } else if ( 'undefined' !== typeof data['customer'] ) {

                                                        let customerId = data['customer_id'];

                                                        // save the customer id
                                                        jQuery('#tds-stripe-customer-id').val( data['customer_id'] );

                                                        let price = '<?php echo $price ?>';
                                                        let couponId = jQuery('#tds-coupon-id');
                                                        let discountedPrice = jQuery('#tds-discounted-price');

                                                        // apply coupon discount
                                                        if( couponId.val() ) {
                                                            price = discountedPrice.val();
                                                        }

                                                        // check plan price,
                                                        // if the price is 0 we don't need a checkout session, just create the subscription
                                                        // @note this case applies to unlimited subscriptions && for plans with credits
                                                        //console.log(checkoutSessionMode);
                                                        if ( parseInt(price) === 0 && checkoutSessionMode !== 'subscription' ) {

                                                            // create local subscription
                                                            jQuery.ajax({
                                                                timeout: 20000,
                                                                type: 'POST',
                                                                url: tdsSubs.get_rest_endpoint(
                                                                    'tds_subscription/create_subscription',
                                                                    'uuid=' + tdsSubs.get_unique_id()
                                                                ),
                                                                beforeSend: function (xhr) {
                                                                    // add the nonce used for cookie authentication
                                                                    xhr.setRequestHeader('X-WP-Nonce', window.tds_js_globals.wpRestNonce);
                                                                },
                                                                cache: false,
                                                                dataType: 'json',
                                                                data: {
                                                                    subscriptionUserId: jQuery('#tds-subscription-user-id').val(),
                                                                    subscriptionPlanId: jQuery('#tds-subscription-plan-id').val(),
                                                                    subscriptionCouponId: couponId.val(),
                                                                    stripeCustomerId: customerId,
                                                                    ...formBillingData,
                                                                    billingPaymentMethod: 'stripe',
                                                                    stripeCheckoutSessionMode: 'payment',
                                                                    stripeSubscriptionId: '',
                                                                    stripePaymentInvoice: '',
                                                                    stripePriceId: '',
                                                                    stripePaymentStatus: '',
                                                                    stripePaymentTypes: '',
                                                                    stripePaymentInfo: '',
                                                                    autoUnlockPostId: tdsAutoUnlockPostId,
                                                                },
                                                                success: function (data) {

                                                                    if ( data.error ) {
                                                                        console.log(data.error);

                                                                        tdsShowMessage( data.error, 'error', true );

                                                                    } else {

                                                                        console.log(data);
                                                                        tdsShowConfirmationPage(data);

                                                                    }

                                                                },
                                                                error: function ( MLHttpRequest, textStatus, errorThrown ) {
                                                                    console.log( 'tds_subscription/create_subscription - Error callback - textStatus: ' + textStatus + ' errorThrown: ' + errorThrown );
                                                                }
                                                            });

                                                        } else {

                                                            let tdsSubscriptionID = jQuery('#tds-subscription-id');
                                                            let checkoutSessionContext = tdsSubscriptionID.length ? 'subscription_update' : 'subscription_create';

                                                            // create the checkout session
                                                            jQuery.ajax({
                                                                timeout: 20000,
                                                                type: 'POST',
                                                                url: tdsSubs.get_rest_endpoint(
                                                                    'tds_subscription/stripe_checkout_session_create',
                                                                    'uuid=' + tdsSubs.get_unique_id()
                                                                ),
                                                                beforeSend: function (xhr) {
                                                                    // add the nonce used for cookie authentication
                                                                    xhr.setRequestHeader('X-WP-Nonce', window.tds_js_globals.wpRestNonce);
                                                                },
                                                                cache: false,
                                                                dataType: 'json',
                                                                data: {
                                                                    checkoutSessionMode: checkoutSessionMode,
                                                                    subscriptionPlanId: jQuery('#tds-subscription-plan-id').val(),
                                                                    subscriptionCouponId: couponId.val(),
                                                                    subscriptionUserId: jQuery('#tds-subscription-user-id').val(),
                                                                    stripeCustomerId: customerId,
                                                                    currentUrl: window.location.href,
                                                                    checkoutSessionContext: checkoutSessionContext,
                                                                    tdsSubscription: tdsSubscriptionID.val(), // the subscription id
                                                                    ...formBillingData // add billing details
                                                                },
                                                                success: function (data) {
                                                                    // console.log(data);

                                                                    if ( data.error ) {

                                                                        // we encountered a know error
                                                                        if ( data.plan_interval_error ) {
                                                                            tdsShowMessage( data.plan_interval_error, 'error', true );
                                                                        } else {
                                                                            tdsShowMessage( data.error, 'error', true );
                                                                        }

                                                                        $this.removeClass('tds-s-btn-saving');
                                                                        $this.removeAttr('disabled');

                                                                    } else if ( data.stripe_checkout_session_data ) {

                                                                        // no error was encountered, redirect to stripe checkout session
                                                                        const stripe_checkout_session_url = data.stripe_checkout_session_data.url;
                                                                        if ( stripe_checkout_session_url ) {
                                                                            // console.log(stripe_checkout_session_url);
                                                                            window.location.replace( stripe_checkout_session_url );
                                                                        }

                                                                    }

                                                                },
                                                                error: function ( MLHttpRequest, textStatus, errorThrown ) {
                                                                    console.log( 'tds_subscription/stripe_checkout_session_create - Error callback - textStatus: ' + textStatus + ' errorThrown: ' + errorThrown );
                                                                }
                                                            });

                                                        }

                                                    }

                                                },
                                                error: function ( MLHttpRequest, textStatus, errorThrown ) {
                                                    console.log( 'tds_subscription/create_stripe_customer - Error callback - textStatus: ' + textStatus + ' errorThrown: ' + errorThrown );
                                                }
                                            });

                                        });

                                        tdsCheckStripeCheckSessionComplete();

                                    }

                                    // gets the checkout session data after session completes
                                    function tdsCheckStripeCheckSessionComplete() {

                                        const urlSearchParams = new URLSearchParams(window.location.search),
                                            checkoutSessionId = urlSearchParams.get("stripe_session_id"),
                                            tdsCheckoutWrap = jQuery('.tds-checkout-wrap.tds-checkout-session');

                                        let tdsSubscription = jQuery('#tds-subscription-id');

                                        if ( !checkoutSessionId ) {
                                            // console.log('stripe_session_id n/a');
                                            return;
                                        }

                                        // if ( checkoutSessionId === 'test' ) {
                                        //     tdsShowMessage( 'test error', 'error', true );
                                        //     tdsCheckoutWrap.removeClass('tds-cs-loading');
                                        //     return;
                                        // }

                                        // retrieve session data
                                        jQuery.ajax({
                                            timeout: 20000,
                                            type: 'POST',
                                            url: tdsSubs.get_rest_endpoint(
                                                'tds_subscription/stripe_checkout_session_retrieve',
                                                'uuid=' + tdsSubs.get_unique_id()
                                            ),
                                            beforeSend: function (xhr) {
                                                // add the nonce used for cookie authentication
                                                xhr.setRequestHeader('X-WP-Nonce', window.tds_js_globals.wpRestNonce);
                                            },
                                            cache: false,
                                            dataType: 'json',
                                            data: {
                                                checkoutSessionId: checkoutSessionId,
                                            },
                                            success: function (data) {

                                                if ( data.error ) {
                                                    // console.log(data.error);

                                                    tdsShowMessage( data.error, 'error', true );
                                                    tdsCheckoutWrap.removeClass('tds-cs-loading');

                                                } else if ( tdsSubscription.length ) {

                                                    // console.log(data.stripe_checkout_session_data);
                                                    //return;

                                                    // set payment data
                                                    let paymentData = {
                                                        'type': 'stripe',
                                                        'stripe_checkout_session_data': data.stripe_checkout_session_data
                                                    };

                                                    tdsSubs.tds_subscription_update(paymentData); // update subscription

                                                } else {
                                                    // console.log(data);

                                                    tdsShowConfirmationPage(data);
                                                    tdsCheckoutWrap.removeClass('tds-cs-loading');

                                                }

                                            },
                                            error: function ( MLHttpRequest, textStatus, errorThrown ) {
                                                console.log( 'tds_subscription/stripe_checkout_session_retrieve - Error callback - textStatus: ' + textStatus + ' errorThrown: ' + errorThrown );
                                            }
                                        });

                                    }

                                    function tdsShowMessage( messageText, type = '', permanent ) {
                                        const $tdsPaymentMessage = jQuery("#tds-payment-message"),
                                            $tdsPaymentMessageTxt = $tdsPaymentMessage.find('.tds-s-notif-descr');

                                        $tdsPaymentMessage.show();
                                        $tdsPaymentMessageTxt.html(messageText);

                                        if ( type !== '' ) {
                                            $tdsPaymentMessage.addClass('tds-s-notif-' + type);
                                        }

                                        if ( 'undefined' !== typeof permanent && true === permanent ) {
                                            return;
                                        }

                                        setTimeout( function () {
                                            $tdsPaymentMessage.hide();
                                            $tdsPaymentMessageTxt.html('');

                                            if ( type !== '' ) {
                                                $tdsPaymentMessage.removeClass('tds-s-notif-' + type);
                                            }
                                        }, 10000 );

                                    }

                                    function tdsResetMessage() {
                                        const $tdsPaymentMessage = jQuery("#tds-payment-message"),
                                            $tdsPaymentMessageTxt = $tdsPaymentMessage.find('.tds-s-notif-descr');

                                        $tdsPaymentMessage.hide();
                                        $tdsPaymentMessageTxt.html('');
                                        $tdsPaymentMessage.removeClass('tds-s-notif-error');

                                    }

                                    function tdsShowConfirmationPage(data) {

                                        let successURL = '<?php echo $success_url ?>';
                                        let responseData = data.response;

                                        let withCredits = <?php echo json_encode($with_credit); ?>;
                                        let tdsAutoUnlockPostId = <?php echo json_encode($this->tds_auto_unlock); ?>;

                                        if ( tdsAutoUnlockPostId !== '' ) {

                                            let tdsAutoUnlockPostUrl = <?php echo json_encode( get_permalink($this->tds_auto_unlock) ); ?>;

                                            // for plans with credits
                                            if ( withCredits ) {

                                                // unlock post
                                                let unlockRequest = tdsSubs.auto_unlock_post(tdsAutoUnlockPostId);
                                                console.log( 'unlockRequest results: ', unlockRequest );

                                                const errors = unlockRequest.errors;
                                                const result = unlockRequest.result;
                                                const rdr_url = unlockRequest.rdr_url;

                                                // process the response
                                                if( Object.keys(errors).length > 0 ) {

                                                    // errors
                                                    let errorsMessages = '';
                                                    Object.values(errors).map( (errMsg) => { errorsMessages += errMsg + '<br>'; });

                                                    // display received error msg
                                                    // tdsSubs.show_payment_message( errorsMessages, 'error', true );

                                                } else if ( result.includes('success') ) {

                                                    // console.log( 'redirect to: ', rdr_url );

                                                    // success... redirect back to post url to see it unlocked
                                                    window.location.replace(rdr_url);

                                                    // display success msg
                                                    // tdsSubs.show_payment_message( 'Successfully unlocked post.', 'success' );

                                                } else {

                                                    // display unknown result response warning msg
                                                    // tdsSubs.show_payment_message( 'Unknown post unlock request result: ' + JSON.stringify(result), 'warn' );

                                                }

                                            } else {

                                                // just redirect back to post url to see it unlocked
                                                window.location.replace(tdsAutoUnlockPostUrl);

                                            }

                                        } else if ( successURL !== '' ) {

                                            window.location.replace(successURL);

                                        } else if ( 'undefined' !== typeof responseData.confirm_url ) {

                                            window.history.replaceState( {}, 'TDS Confirmation Page', responseData.confirm_url );

                                            let tdsPaymentConfirmationWrap = jQuery('.tds-payment-confirmation');

                                            jQuery('.tds-payment-content').hide();
                                            jQuery('.tds-payment-sidebar').hide();
                                            tdsPaymentConfirmationWrap.show();

                                            // subscription info section
                                            var $tdsConfSubInfoWrap = jQuery('.tds-s-psc-subscr-info'),
                                                $tdsConfSubInfoID = $tdsConfSubInfoWrap.find('.tds-s-subscr-id'),
                                                $tdsConfSubInfoPlan = $tdsConfSubInfoWrap.find('.tds-s-subscr-plan'),
                                                $tdsConfSubInfoMonths = $tdsConfSubInfoWrap.find('.tds-s-subscr-months'),
                                                $tdsConfSubInfoPeriod = $tdsConfSubInfoWrap.find('.tds-s-subscr-period'),
                                                $tdsConfSubInfoPayMethod = $tdsConfSubInfoWrap.find('.tds-s-subscr-pay-method'),
                                                $tdsConfSubInfoTotal = $tdsConfSubInfoWrap.find('.tds-s-subscr-total'),
                                                $tdsConfSubInfoCredits = $tdsConfSubInfoWrap.find('.tds-s-subscr-credits');

                                            $tdsConfSubInfoWrap.show();
                                            $tdsConfSubInfoPayMethod.find('.tds-s-list-text').text('Stripe');

                                            if ('undefined' !== typeof responseData['view_subscription_url']) {
                                                tdsPaymentConfirmationWrap.find('.tds-s-btn-view-subscription').attr( 'href', responseData['view_subscription_url'] );
                                            }
                                            if ('undefined' !== typeof responseData['local_subscription_id']) {
                                                $tdsConfSubInfoID.find('.tds-s-list-text').html(responseData['local_subscription_id']);
                                            }
                                            if ('undefined' !== typeof responseData['local_plan_name']) {
                                                $tdsConfSubInfoPlan.find('.tds-s-list-text').html(responseData['local_plan_name']);
                                            }
                                            if ('undefined' !== typeof responseData['cycle_interval_format']) {
                                                $tdsConfSubInfoMonths.find('.tds-s-list-text').html(responseData['cycle_interval_format']);
                                                $tdsConfSubInfoMonths.show();
                                            } else {
                                                $tdsConfSubInfoMonths.hide();
                                            }
                                            if ('undefined' !== typeof responseData['start_date']) {
                                                $tdsConfSubInfoPeriod.find('.tds-s-list-text').html(responseData['start_date'] + ' - ' + responseData['end_date']);
                                            }

                                            // hide period info
                                            if ('undefined' !== typeof responseData['is_with_credits']) {
                                                $tdsConfSubInfoPeriod.hide();

                                                // update & show credits info
                                                $tdsConfSubInfoCredits.find('.tds-s-list-text').html(responseData['credits']);
                                                $tdsConfSubInfoCredits.show();

                                            }

                                            if ('undefined' !== typeof responseData['price']) {

                                                // formatted price
                                                if ( 'undefined' !== typeof responseData['formatted_full_price'] ) {
                                                    $tdsConfSubInfoTotal.find('.tds-s-list-text').html(
                                                        '<span class="tds-s-price-full">' + responseData['formatted_full_price'] + '</span>' +
                                                        '<span>' + responseData['formatted_price'] + '</span>'
                                                    );
                                                } else {
                                                    $tdsConfSubInfoTotal.find('.tds-s-list-text').html( responseData['formatted_price'] );
                                                }

                                            }

                                        }

                                    }

                                </script>
                                <?php
                                td_js_buffer::add_to_footer( "\n" . td_util::remove_script_tag( ob_get_clean() ) );

                            }

                            ob_start();

                            if( !$disable_bill && !$this->is_billing_disabled ) {
                                ?>

                                <div class="tds-payment-content">
                                    <div class="tds-s-page-sec tds-s-page-billing-details">
                                        <div class="tds-s-page-sec-header">
                                            <h2 class="tds-spsh-title">
                                                <?php echo empty($price) ? __td('User information', TD_THEME_NAME ) : __td('Billing details', TD_THEME_NAME ) ?>
                                            </h2>
                                        </div>
                                        <div class="tds-s-page-sec-content">
                                            <div class="tds-s-form tds-s-billing-details-form">
                                                <div class="tds-s-form-content">
                                                    <div class="tds-s-fc-inner">

                                                        <div class="tds-s-form-group">
                                                            <label class="tds-s-form-label" for="tds-billing-first-name"><?php echo __td('First name', TD_THEME_NAME ) ?> *</label>
                                                            <input class="tds-s-form-input tds-billing-first-name" type="text" id="tds-billing-first-name" value="<?php echo $is_composer ? 'John' : ( $billing_details_exist ? $billing_first_name : '' ) ?>">
                                                            <span class="tds-s-fg-error-msg"></span>
                                                        </div>

                                                        <div class="tds-s-form-group">
                                                            <label class="tds-s-form-label" for="tds-billing-last-name"><?php echo __td('Last name', TD_THEME_NAME ) ?> *</label>
                                                            <input class="tds-s-form-input tds-billing-last-name" type="text" id="tds-billing-last-name"  value="<?php echo $is_composer ? 'Doe' : ( $billing_details_exist ? $billing_last_name : '' ) ?>">
                                                            <span class="tds-s-fg-error-msg"></span>
                                                        </div>

                                                        <div class="tds-s-form-group">
                                                            <label class="tds-s-form-label" for="tds-billing-company-name">
                                                                <?php echo __td('Company name', TD_THEME_NAME ) . ' ' . __td('(optional)', TD_THEME_NAME ) ?>
                                                            </label>
                                                            <input class="tds-s-form-input tds-billing-company-name" type="text" id="tds-billing-company-name"  value="<?php echo $is_composer ? 'Demo company name' : $billing_company_name ?>">
                                                        </div>

                                                        <div class="tds-s-form-group">
                                                            <label class="tds-s-form-label" for="tds-billing-vat">
                                                                <?php echo __td('VAT Number', TD_THEME_NAME ) . ' ' . __td('(optional)', TD_THEME_NAME ) ?>
                                                            </label>
                                                            <input class="tds-s-form-input tds-billing-vat" type="text" id="tds-billing-vat"  value="<?php echo $is_composer ? '12345' : $billing_vat_number ?>">
                                                        </div>

                                                        <div class="tds-s-form-group tds-form-group-billing-country">
                                                            <label class="tds-s-form-label" for="tds-billing-country">
                                                                <?php echo __td('Country/Region', TD_THEME_NAME ) ?> *
                                                            </label>
                                                            <div class="tds-s-form-select-wrap">
                                                                <select class="tds-s-form-input" id="tds-billing-country">
                                                                    <option value="">Choose a country...</option>
                                                                    <?php
                                                                    foreach ( tds_util::get_countries() as $country_iso_code => $country_name ) {

                                                                        $selected_value = ( $is_composer && $country_iso_code === 'US' ) || $country_name == $billing_country || $country_iso_code == tds_util::get_country_iso_code($billing_country);

                                                                        $selected = $selected_value ? ' selected="selected"' : '';

                                                                        echo '<option value="' . $country_iso_code . '"' . $selected . '>' . $country_name . '</option>';

                                                                    }
                                                                    ?>
                                                                </select>
                                                                <svg class="tds-s-form-select-icon" xmlns="http://www.w3.org/2000/svg" width="8.947" height="12.578" viewBox="0 0 8.947 12.578"><g transform="translate(7.947 1) rotate(90)"><path d="M0,7.947A1,1,0,0,1-.58,7.761,1,1,0,0,1-.815,6.366l2.06-2.893L-.815.58A1,1,0,0,1-.58-.815,1,1,0,0,1,.815-.58L3.288,2.893a1,1,0,0,1,0,1.16L.815,7.527A1,1,0,0,1,0,7.947Z" transform="translate(8.104 0)"/><path d="M2.474,7.947a1,1,0,0,1-.815-.42L-.815,4.053a1,1,0,0,1,0-1.16L1.659-.58A1,1,0,0,1,3.053-.815,1,1,0,0,1,3.288.58L1.228,3.473l2.06,2.893a1,1,0,0,1-.814,1.58Z" transform="translate(0 0)"/></g></svg>
                                                            </div>
                                                            <span class="tds-s-fg-error-msg"></span>
                                                        </div>

                                                        <div class="tds-s-form-group <?php echo $is_composer ? 'tds-s-fg-error' : '' ?>">
                                                            <label class="tds-s-form-label" for="tds-billing-address"><?php echo __td('Street address', TD_THEME_NAME ) ?> *</label>
                                                            <input class="tds-s-form-input tds-billing-address" type="text" id="tds-billing-address" value="<?php echo !$is_composer ? $billing_address : '' ?>">
                                                            <span class="tds-s-fg-error-msg"><?php echo $is_composer ? 'Empty address' : '' ?></span>
                                                        </div>

                                                        <div class="tds-s-form-group">
                                                            <label class="tds-s-form-label" for="tds-billing-city"><?php echo __td('Town/City', TD_THEME_NAME ) ?> *</label>
                                                            <input class="tds-s-form-input tds-billing-city" type="text" id="tds-billing-city"  value="<?php echo $is_composer ? 'New York' : $billing_city ?>">
                                                            <span class="tds-s-fg-error-msg"></span>
                                                        </div>

                                                        <div class="tds-s-form-group">
                                                            <label class="tds-s-form-label" for="tds-billing-county"><?php echo __td('County', TD_THEME_NAME ) ?> *</label>
                                                            <input class="tds-s-form-input tds-billing-county" type="text" id="tds-billing-county"  value="<?php echo $is_composer ? 'New York' : $billing_county ?>">
                                                            <span class="tds-s-fg-error-msg"></span>
                                                        </div>

                                                        <div class="tds-s-form-group">
                                                            <label class="tds-s-form-label" for="tds-billing-postcode"><?php echo __td('Postcode', TD_THEME_NAME ) ?> *</label>
                                                            <input class="tds-s-form-input tds-billing-postcode" type="text" id="tds-billing-postcode"  value="<?php echo $is_composer ? '12345' : $billing_post_code ?>">
                                                            <span class="tds-s-fg-error-msg"></span>
                                                        </div>

                                                        <div class="tds-s-form-group">
                                                            <label class="tds-s-form-label" for="tds-billing-phone"><?php echo __td('Phone', TD_THEME_NAME ) ?> *</label>
                                                            <input class="tds-s-form-input tds-billing-phone" type="text" id="tds-billing-phone" value="<?php echo $is_composer ? '+30 789546548' : $billing_phone ?>">
                                                            <span class="tds-s-fg-error-msg"></span>
                                                        </div>

                                                        <div class="tds-s-form-group">
                                                            <label class="tds-s-form-label" for="tds-billing-email"><?php echo __td('Email', TD_THEME_NAME ) ?> *</label>
                                                            <input class="tds-s-form-input tds-billing-email" type="email" id="tds-billing-email" value="<?php echo $is_composer ? 'mail@example.com' : ( $billing_details_exist ? $billing_email : '' ) ?>">
                                                            <span class="tds-s-fg-error-msg"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                            <div class="tds-payment-sidebar">
                                <input type="hidden" id="tds-subscription-user-id" value="<?php echo get_current_user_id() ?>">
                                <input type="hidden" id="tds-subscription-plan-id" value="<?php echo $plan_id ?>">
                                <input type="hidden" id="tds-initial-price" value="<?php echo tds_util::get_basic_currency($price) ?>">
                                <input type="hidden" id="tds-discounted-price" value="">
                                <input type="hidden" id="tds-coupon-id" value="">
                                <input type="hidden" id="tds-stripe-customer-id" value="">
                                <input type="hidden" id="tds-stripe-coupon-id" value="">
                                <input type="hidden" id="tds-stripe-price-id" value="">
                                <input type="hidden" id="tds-stripe-subscription-id" value="">

                                <?php if ( $this->is_payment_session ) { ?>

                                    <!-- payment session local subscription id -->
                                    <input type="hidden" id="tds-subscription-id" value="<?php echo $this->tds_subscription['id'] ?>">

                                <?php } ?>

                                <div class="tds-s-page-sec tds-s-page-subscr-summary">

                                    <?php if ( !$disable_bill && !$this->is_billing_disabled ) { ?>
                                        <div class="tds-s-page-sec-header">
                                            <div class="tds-spsh-title">&nbsp;</div>
                                        </div>
                                    <?php } ?>

                                    <div class="tds-s-page-sec-content">
                                        <h2 class="tds-s-page-ss-title"><?php echo __td('Subscription summary', TD_THEME_NAME ) ?></h2>

                                        <div class="tds-s-page-ss-info">

                                            <div class="tds-s-page-ss-info-row">
                                                <div class="tds-s-page-ss-info-label"><?php echo __td('Plan', TD_THEME_NAME ) ?></div>
                                                <div class="tds-s-page-ss-info-value"><?php echo $plan_name ?></div>
                                            </div>

                                            <div class="tds-s-page-ss-info-row">
                                                <div class="tds-s-page-ss-info-label"><?php echo __td('Price', TD_THEME_NAME ) ?></div>
                                                <div class="tds-s-page-ss-info-value">
                                                    <?php echo !empty($price) ? tds_util::get_basic_currency($price) : __td('Free', TD_THEME_NAME ); ?>
                                                </div>
                                            </div>

                                            <?php if ( !empty($price) && !$unlimited && !$with_credit ) { ?>

                                                <!-- cycle interval/interval_count plan -->
                                                <div class="tds-s-page-ss-info-row">
                                                    <div class="tds-s-page-ss-info-label"><?php echo __td('Cycle Interval', TD_THEME_NAME ) ?></div>
                                                    <div class="tds-s-page-ss-info-value">
                                                        <?php echo $cycle_interval_count . ' ' . $ci_format ?>
                                                    </div>
                                                </div>

                                            <?php } ?>

                                            <?php if ( $with_credit ) { ?>

                                                <!-- subscription credits -->
                                                <div class="tds-s-page-ss-info-row">
                                                    <div class="tds-s-page-ss-info-label"><?php echo __td('Credits', TD_THEME_NAME ) ?></div>
                                                    <div class="tds-s-page-ss-info-value"><?php echo !empty($credits) ? $credits : __td('N/A', TD_THEME_NAME ) ?></div>
                                                </div>

                                            <?php } else { ?>

                                                <!-- subscription period > cycle interval/interval_count end_date -->
                                                <div class="tds-s-page-ss-info-row">
                                                    <div class="tds-s-page-ss-info-label"><?php echo __td('Period', TD_THEME_NAME ) ?></div>
                                                    <div class="tds-s-page-ss-info-value">
                                                        <?php echo $subscription_start_date ?> - <?php echo $subscription_end_date ?>
                                                    </div>
                                                </div>

                                            <?php } ?>

                                            <?php if ( $this->is_payment_session ) { ?>

                                                <?php if ( !empty($subscription_payment_type) ) { ?>

                                                <!-- subscription previously used payment method -->
                                                <div class="tds-s-page-ss-info-row">
                                                    <div class="tds-s-page-ss-info-label" style="width: 50%;">
                                                        <?php echo __td('Last used payment method', TD_THEME_NAME ) ?>
                                                    </div>
                                                    <div class="tds-s-page-ss-info-value">
                                                        <?php echo $subscription_payment_type ?>
                                                    </div>
                                                </div>

                                                <?php } ?>

                                                <?php if ( !empty($subscription_status) ) { ?>

                                                <!-- subscription current status -->
                                                <div class="tds-s-page-ss-info-row">
                                                    <div class="tds-s-page-ss-info-label" style="width: 50%;">
                                                        <?php echo __td('Current status', TD_THEME_NAME ) ?>
                                                    </div>
                                                    <div class="tds-s-page-ss-info-value">
                                                        <?php echo tds_util::subscription_status( $subscription_status, !empty($this->subscription['canceled']) ); ?>
                                                    </div>
                                                </div>

                                                <?php } ?>

                                            <?php } ?>

                                        </div>

                                        <?php
                                        if ( !empty($price) && !$this->is_payment_session ) {
                                            ?>
                                            <!-- coupon form -->
                                            <div class="tds-s-form tds-s-coupon-form">
                                                <div class="tds-s-form-content">
                                                    <div class="tds-s-fc-inner">
                                                        <div class="tds-s-form-group tds-s-form-group-coupon-code">
                                                            <input id="tds-coupon" class="tds-s-form-input tds-coupon" type="text" placeholder="<?php echo __td( 'Enter promo code here', TD_THEME_NAME ) ?>">
                                                            <a class="tds-coupon-apply-btn" href="#"><?php echo __td( 'Apply', TD_THEME_NAME ) ?></a>
                                                        </div>
                                                        <div class="tds-s-notif tds-s-notif-xsm tds-coupon-msg">
                                                            <div class="tds-s-notif-descr"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                        <div class="tds-s-subscr-summary-total">
                                            <div class="tds-s-sst-label">
                                                <?php echo ( empty($price) || $this->is_payment_session ) ? __td('Total', TD_THEME_NAME ) :  __td('Grand Total', TD_THEME_NAME ) ?>:
                                            </div>
                                            <div class="tds-s-sst-val">
                                                <?php echo ( empty($price) ) ? __td('Free', TD_THEME_NAME ) : tds_util::get_basic_currency($price) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php

                                if ( empty($price) ) {

                                    ?>

                                    <div class="tds-s-page-sec tds-s-page-pay-methods">
                                        <div class="tds-s-page-sec-content">
                                            <div class="tds-s-form tds-s-pay-methods-form">
                                                <div class="tds-s-form-footer">
                                                    <button class="tds-s-btn tds-billing-complete" <?php echo empty($tds_subscription_url) ? '' : 'data-url="' . esc_url( $tds_subscription_url ) . '"' ?>>
                                                        <?php echo __td('Subscribe', TD_THEME_NAME ) ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php

                                } elseif ( $this->is_payment_session && !$this->is_stripe_session && !empty($subscription_status) &&
                                    !in_array( $subscription_status, [ 'waiting_payment', 'paid_incomplete' ] )
                                ) {

                                    $subscription_status = tds_util::subscription_status( $subscription_status, !empty($this->subscription['canceled']), false );

                                    ?>

                                    <div class="tds-s-page-sec tds-s-page-pay-methods">
                                        <div class="tds-s-page-sec-header">
                                            <h2 class="tds-spsh-title">
                                                <?php echo __td('Payment methods', TD_THEME_NAME ) ?>
                                            </h2>
                                        </div>
                                        <div class="tds-s-page-sec-content">
                                            <div class="tds-s-notif tds-s-notif-sm tds-s-notif-warn">
                                                <div class="tds-s-notif-descr">
                                                    <?php echo sprintf(
                                                        __td( 'Payment is not available for subscriptions with %1$s status.' , TD_THEME_NAME ),
                                                        strtolower($subscription_status)
                                                    ) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php

                                } else {

                                    tds_util::check_paypal_currency( $curr_name, $is_paypal, $is_digit );
                                    if ( !$is_digit && !preg_match('/^\d+$/', $price) ) {
                                        $is_paypal = false;
                                    }

                                    tds_util::check_stripe_currency($curr_name, $is_stripe, $is_digit );
                                    if ( !$is_digit && !preg_match('/^\d+$/', $price) ) {
                                        $is_stripe = false;
                                    }

                                    $is_direct_payment_active = null !== $payment_bank && count($payment_bank) && $payment_bank[0]['is_active'];
                                    $is_paypal_payment_active = $is_paypal && !empty($payment_paypal) && '1' === $payment_paypal['is_active'];
                                    $is_stripe_payment_active = $is_stripe && null !== $payment_stripe && count($payment_stripe) && $payment_stripe[0]['is_active'];

                                    $payment_bank_checked   = false;
                                    $payment_paypal_checked = false;
                                    $payment_stripe_checked = false;

                                    if ( $is_direct_payment_active ) {

                                        if ( $default_payment_method == 'direct' ) {
                                            $payment_bank_checked = true;
                                        }

                                    } elseif ( $is_paypal_payment_active ) {

                                        if ( $default_payment_method == 'paypal' || !$payment_bank_checked ) {
                                            $payment_paypal_checked = true;
                                        }

                                    } elseif ( $is_stripe_payment_active ) {

                                        if ( $default_payment_method == 'stripe' || ( !$payment_bank_checked && !$payment_paypal_checked ) ) {
                                            $payment_stripe_checked = true;
                                        }

                                    }

                                    $check_first_available_method = false;
                                    if ( !$payment_bank_checked && !$payment_paypal_checked && !$payment_stripe_checked ) {
                                        $check_first_available_method = true;
                                    }

                                    // set pm to stripe on stripe sessions
                                    if ( $this->is_stripe_session ) {
                                        $payment_bank_checked = $payment_paypal_checked = false;
                                        $payment_stripe_checked = true;
                                    }

                                    $direct_payment_label_txt = $this->get_att('direct_txt');
                                    $paypal_payment_label_txt = $this->get_att('paypal_txt');
                                    $stripe_payment_label_txt = $this->get_att('stripe_txt');

                                    // check tds_options table for custom_payments option
                                    $custom_payments_option = tds_util::get_tds_option('custom_payments');

                                    // unserialize custom payment methods
                                    $custom_payments = !empty($custom_payments_option) ? unserialize($custom_payments_option) : [];

                                    // check for active custom payment methods
                                    $active_custom_payment_options = [];

                                    if ( is_array($custom_payments) ) {

                                        foreach ( $custom_payments as $cp_id => $cp_data ) {

                                            if ( $cp_data['status'] ) {
                                                $active_custom_payment_options[$cp_id] = $cp_data;
                                            }

                                        }

                                    }

                                    ?>

                                    <div class="tds-s-page-sec tds-s-page-pay-methods">

                                        <div class="tds-s-page-sec-header">
                                            <h2 class="tds-spsh-title">
                                                <?php echo __td('Payment methods', TD_THEME_NAME ) ?>
                                            </h2>
                                        </div>

                                        <div class="tds-s-page-sec-content">
                                            <?php

                                            if ( $is_direct_payment_active || $is_paypal_payment_active || $is_stripe_payment_active || !empty($active_custom_payment_options) ) {

                                                ?>

                                                <div class="tds-s-form tds-s-pay-methods-form">
                                                    <div class="tds-s-form-content">
                                                        <div class="tds-s-fc-inner">
                                                            <?php

                                                            if ( $is_direct_payment_active || $is_composer ) {

                                                                $label_txt = __td('Direct Bank Transfer', TD_THEME_NAME );
                                                                if( $direct_payment_label_txt != '' ) {
                                                                    $label_txt = $direct_payment_label_txt;
                                                                }

                                                                $option_checked = false;
                                                                if( $payment_bank_checked || $check_first_available_method ) {
                                                                    $option_checked = true;
                                                                    $check_first_available_method = false;
                                                                }

                                                                $payment_bank_description = $is_composer ? 'Sample bank payment description.' : $payment_bank[0]['description'];
                                                                $payment_bank_instruction = $is_composer ? 'Sample bank payment instructions.' : $payment_bank[0]['instruction'];

                                                                ?>

                                                                <div class="tds-s-form-group tds-spm-direct">
                                                                    <div class="tds-s-form-check">
                                                                        <label>
                                                                            <input type="radio"
                                                                                   name="tds-payment-method"
                                                                                   class="tds-billing-payment-method" value="direct"
                                                                                <?php echo $option_checked ? 'checked' : ''; ?>
                                                                            >
                                                                            <span class="tds-s-fc-check"></span>
                                                                            <span class="tds-s-fc-title"><?php echo $label_txt ?></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="tds-spm-content" <?php echo !$option_checked ? 'style="display:none"' : ''; ?>>
                                                                        <?php
                                                                        if ( !empty($payment_bank_description) ) {
                                                                            ?>

                                                                            <div class="tds-s-notif tds-s-notif-sm tds-s-notif-info">
                                                                                <div class="tds-s-notif-descr"><?php echo $payment_bank_description; ?></div>
                                                                            </div>

                                                                            <?php
                                                                        }

                                                                        if ( !empty($payment_bank_instruction) ) {
                                                                            ?>

                                                                            <div class="tds-s-notif tds-s-notif-sm tds-s-notif-info">
                                                                                <div class="tds-s-notif-descr"><?php echo $payment_bank_instruction; ?></div>
                                                                            </div>

                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>

                                                                <?php
                                                            }

                                                            if ( $is_paypal_payment_active || $is_composer ) {
                                                                $option_checked = false;

                                                                $label_txt = 'PayPal';
                                                                if( $paypal_payment_label_txt != '' ) {
                                                                    $label_txt = $paypal_payment_label_txt;
                                                                }

                                                                if( $payment_paypal_checked || $check_first_available_method ) {
                                                                    $option_checked = true;
                                                                    $check_first_available_method = false;
                                                                }

                                                                ?>

                                                                <div class="tds-s-form-group tds-spm-paypal">
                                                                    <div class="tds-s-form-check">
                                                                        <label>
                                                                            <input type="radio"
                                                                                   name="tds-payment-method"
                                                                                   class="tds-billing-payment-method"
                                                                                   value="paypal"
                                                                                <?php echo $option_checked ? 'checked' : '' ?>>

                                                                            <span class="tds-s-fc-check"></span>
                                                                            <span class="tds-s-fc-title"><?php echo $label_txt ?></span>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <?php
                                                            }

                                                            if ( $is_stripe_payment_active || $is_composer ) {

                                                                $label_txt = 'Stripe';
                                                                if( $stripe_payment_label_txt != '' ) {
                                                                    $label_txt = $stripe_payment_label_txt;
                                                                }

                                                                $option_checked = false;
                                                                if( $payment_stripe_checked || $check_first_available_method ) {
                                                                    $option_checked = true;
                                                                }

                                                                $payment_stripe_description = $is_composer ? 'Sample stripe payment description.' : $payment_stripe[0]['description'];
                                                                $payment_stripe_instructions = $is_composer ? 'Sample stripe payment instructions.' : $payment_stripe[0]['instructions'];

                                                                ?>

                                                                <div class="tds-s-form-group tds-spm-stripe">
                                                                    <div class="tds-s-form-check">
                                                                        <label>
                                                                            <input type="radio" name="tds-payment-method" class="tds-billing-payment-method" value="stripe" <?php echo $option_checked ? 'checked' : '' ?>>
                                                                            <span class="tds-s-fc-check"></span>
                                                                            <span class="tds-s-fc-title"><?php echo $label_txt ?></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="tds-spm-content" <?php echo !$option_checked ? 'style="display:none"' : '' ?>>
                                                                        <?php
                                                                        if ( !empty($payment_stripe_description) ) {
                                                                            ?>

                                                                            <div class="tds-s-notif tds-s-notif-sm tds-s-notif-info">
                                                                                <div class="tds-s-notif-descr"><?php echo $payment_stripe_description ?></div>
                                                                            </div>

                                                                            <?php
                                                                        }

                                                                        if ( !empty($payment_stripe_instructions) ) {
                                                                            ?>

                                                                            <div class="tds-s-notif tds-s-notif-sm tds-s-notif-info">
                                                                                <div class="tds-s-notif-descr"><?php echo $payment_stripe_instructions ?></div>
                                                                            </div>

                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>

                                                                <?php
                                                            }

                                                            if ( !empty($active_custom_payment_options) ) {

                                                                foreach ( $active_custom_payment_options as $cp_id => $cp_data ) {

                                                                    $label_txt = $cp_data['label'];
                                                                    $payment_description = $cp_data['description'];
                                                                    $payment_instructions = $cp_data['instructions'];

                                                                    ?>

                                                                    <div class="tds-s-form-group tds-spm-custom-payment tds-spm-<?php echo $cp_id ?>">
                                                                        <div class="tds-s-form-check">
                                                                            <label>
                                                                                <input type="radio"
                                                                                       name="tds-payment-method"
                                                                                       class="tds-billing-custom-payment-method tds-billing-payment-method"
                                                                                       value="<?php echo $cp_id ?>"
                                                                                >
                                                                                <span class="tds-s-fc-check"></span>
                                                                                <span class="tds-s-fc-title"><?php echo $label_txt ?></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="tds-spm-content">
                                                                            <?php

                                                                            if ( !empty($payment_description) ) {
                                                                                ?>

                                                                                <div class="tds-s-notif tds-s-notif-sm tds-s-notif-info">
                                                                                    <div class="tds-s-notif-descr">
                                                                                        <?php echo $payment_description ?>
                                                                                    </div>
                                                                                </div>

                                                                                <?php
                                                                            }

                                                                            if ( !empty($payment_instructions) ) {
                                                                                ?>

                                                                                <div class="tds-s-notif tds-s-notif-sm tds-s-notif-info">
                                                                                    <div class="tds-s-notif-descr">
                                                                                        <?php echo $payment_instructions ?>
                                                                                    </div>
                                                                                </div>

                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>

                                                                    <?php

                                                                }

                                                            }

                                                            ?>

                                                            <div id="tds-payment-message" class="tds-s-notif tds-s-notif-sm">
                                                                <div class="tds-s-notif-descr"></div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="tds-s-form-footer">

                                                        <button class="tds-s-btn tds-billing-complete" <?php echo empty($tds_subscription_url) ? '' : 'data-url="' . esc_url($tds_subscription_url) . '"' ?> <?php echo $payment_paypal_checked || $payment_stripe_checked ? 'style="display:none"' : '' ?>>
                                                            <?php

                                                            if ( $this->is_payment_session ) {
                                                                echo __td('Setup Payment', TD_THEME_NAME );
                                                            } else {
                                                                echo __td('Subscribe', TD_THEME_NAME );
                                                            }

                                                            ?>
                                                        </button>

                                                        <?php

                                                        if ( !empty($payment_paypal) && '1' === $payment_paypal['is_active'] ) {
                                                            ?>
                                                            <div id="paypal-button-container" <?php echo !$payment_paypal_checked ? 'style="display:none"' : '' ?>></div>
                                                            <?php
                                                        }

                                                        if ( null !== $payment_stripe && count($payment_stripe) && $payment_stripe[0]['is_active'] ) {
                                                            ?>
                                                            <button id="tds-stripe-checkout-session" class="tds-s-btn" <?php echo !$payment_stripe_checked ? 'style="display:none"' : '' ?>>
                                                                <?php

                                                                if ( $with_trial ) {
                                                                    echo __td('Setup Payment', TD_THEME_NAME );
                                                                } else {
                                                                    echo __td('Go to Payment', TD_THEME_NAME );
                                                                }

                                                                ?>
                                                            </button>
                                                            <?php
                                                        }

                                                        if ( !empty($active_custom_payment_options) ) {

                                                            foreach ( $active_custom_payment_options as $cp_id => $cp_data ) {

                                                                $label_txt = $cp_data['label'];

                                                                ?>

                                                                <button class="tds-s-btn tds-s-btn-cp tds-cp-<?php echo $cp_id; ?>" style="display: none;">
                                                                    <?php
                                                                    echo !empty($label_txt) ? $label_txt : __td('Subscribe', TD_THEME_NAME );
                                                                    ?>
                                                                </button>

                                                                <?php

                                                            }

                                                        }

                                                        ?>
                                                    </div>
                                                </div>

                                                <?php

                                            } else {
                                                ?>

                                                <div class="tds-s-notif tds-s-notif-sm tds-s-notif-info">
                                                    <div class="tds-s-notif-descr">
                                                        <?php echo __td('It seems that no available payment methods have been configured.', TD_THEME_NAME ) ?>
                                                    </div>
                                                </div>

                                                <?php
                                            }

                                            ?>
                                        </div>

                                    </div>

                                    <?php
                                }

                                ?>
                            </div>

                            <?php
                            $buffy .= ob_get_clean();

                            $buffy .= $this->get_payment_confirmation();

                        }

                    }

                }

            $buffy .= '</div>';

            }

		$buffy .= '</div>';

		return $buffy;

	}

    function get_login_msg() {

        ob_start();
        ?>

        <div class="tds-block-inner tds-checkout-wrap">
            <div class="tds-s-notif tds-s-notif-info tds-checkout-log-in">
                <div class="tds-s-notif-descr">You must be logged in to access this page.</div>
            </div>
        </div>
        <?php

        return ob_get_clean();

    }

    function get_payment_confirmation() {

        // get show_version att, used to show a specific version of the shortcode in composer
        $show_version = $this->get_att('show_version');
        $show_confirm_version = ( $this->is_composer && $show_version == 'confirm' );

        // set payment confirmation hide class
        $payment_confirmation_hide = $show_confirm_version || ( $this->tds_subscription && !$this->is_payment_session ) ? '' : 'tds-hide';

        // subscription default data
        $subscription_id = $show_confirm_version ? '123' : '';
        $subscription_cycle_interval = $show_confirm_version ? 'month' : '';
        $subscription_cycle_interval_count = $show_confirm_version ? '1' : '';
        $subscription_value = $show_confirm_version ? '100' : '';
        $subscription_payment_type = $show_confirm_version ? 'direct' : '-';
        $subscription_is_free = $subscription_is_unlimited = $subscription_is_with_credits = false;
        $subscription_credits = $subscription_trial_days = $subscription_coupon_id = 0;
        $formatted_full_price = $formatted_price = '';
        $subscription_start_date = date('Y-m-d');
        $subscription_end_date = '';

        // currency options
        tds_util::get_currency_options($curr_name, $curr_pos, $curr_th_sep, $curr_dec_sep, $curr_dec_no );
        $subscription_curr_name = $show_confirm_version ? $curr_name : '';
        $subscription_curr_pos = $show_confirm_version ? $curr_pos : '';
        $subscription_curr_th_sep = $show_confirm_version ? $curr_th_sep : '';
        $subscription_curr_dec_sep = $show_confirm_version ? $curr_dec_sep : '';
        $subscription_curr_dec_no = $show_confirm_version ? $curr_dec_no : '';

        // plan
        $plan_name = $show_confirm_version ? 'Monthly Plan' : '';

        // direct payment details
        $direct_payment_bank = $show_confirm_version ? 'Example bank name' : '';
        $direct_payment_account_name = $show_confirm_version ? 'Example account name' : '';
        $direct_payment_account_number = $show_confirm_version ? '123456' : '';
        $direct_payment_routing_number = $show_confirm_version ? '123456' : '';
        $direct_payment_iban = $show_confirm_version ? 'NL43INGB4186520410' : '';
        $direct_payment_bic_swift = $show_confirm_version ? '123456' : '';
        $direct_payment_instruction = $show_confirm_version ? 'Sample payment instructions.' : '';

        if ( $this->tds_subscription ) {

            $subscription_id = $this->tds_subscription['id'];
            $subscription_payment_type = $this->tds_subscription['payment_type'];
            $subscription_is_free = $this->tds_subscription['is_free'] == 1;
            $subscription_is_unlimited = $this->tds_subscription['is_unlimited'] == 1;
            $subscription_is_with_credits = $this->tds_subscription['is_with_credits'] == 1;
            $subscription_credits = !empty($this->tds_subscription['credits']) ? $this->tds_subscription['credits'] : '';

            // subscription start date
            $subscription_start_date = tds_util::get_formatted_date($this->tds_subscription['start_date']);

            // subscription cycle interval & cycle interval count
            $subscription_cycle_interval = $this->tds_subscription['cycle_interval'];
            $subscription_cycle_interval_count = $this->tds_subscription['cycle_interval_count'];

            // subscription trial days
            $subscription_trial_days = intval($this->tds_subscription['trial_days']);

            // subscription end date
            if ( !$subscription_is_free && ( !$subscription_is_unlimited || $subscription_trial_days > 0 ) ) {
                $subscription_end_date = tds_util::get_subscription_end_date(
                        $subscription_start_date,
                        $subscription_cycle_interval,
                        $subscription_cycle_interval_count,
                        $subscription_trial_days
                )->format('Y-m-d');
            } else {
                $subscription_end_date = __td('unlimited', TD_THEME_NAME );
            }

            $subscription_coupon_id = !empty($this->tds_subscription['coupon_id']) ? $this->tds_subscription['coupon_id'] : '';

            $subscription_value = $this->tds_subscription['price'];

            if ( !empty($subscription_coupon_id) ) {
                $formatted_full_price = tds_util::get_formatted_currency(
                    $subscription_value,
                    $curr_name,
                    $curr_pos,
                    $curr_th_sep,
                    $curr_dec_sep,
                    $curr_dec_no
                );
                $formatted_price = tds_util::get_formatted_currency(
                    tds_util::get_coupon_discount( $subscription_coupon_id, $subscription_value ),
                    $curr_name,
                    $curr_pos,
                    $curr_th_sep,
                    $curr_dec_sep,
                    $curr_dec_no
                );
            }

            $subscription_curr_name = $this->tds_subscription['curr_name'];
            $subscription_curr_pos = $this->tds_subscription['curr_pos'];
            $subscription_curr_th_sep = $this->tds_subscription['curr_th_sep'];
            $subscription_curr_dec_sep = $this->tds_subscription['curr_dec_sep'];
            $subscription_curr_dec_no = $this->tds_subscription['curr_dec_no'];

            $subscription_plan = tds_util::get_plan($this->tds_subscription['plan_id']);
            if ( $subscription_plan ) {

                $plan_name = $subscription_plan['name'];

                $plan_cycle_interval = $subscription_plan['interval'];
                $plan_cycle_interval_count = $subscription_plan['interval_count'];

            } else {
                $plan_name = 'Invalid subscription plan';
            }

            // subscription payment type
            if( !$subscription_is_free ) {
                switch ( $this->tds_subscription['payment_type'] ) {
                    case 'direct':
                        $subscription_payment_type = __td('Direct Bank Transfer', TD_THEME_NAME );
                        break;
                    case 'paypal':
                        $subscription_payment_type = 'PayPal';
                        break;
                    case 'stripe':
                        $subscription_payment_type = 'Stripe';
                        break;
                    case '':
                        $subscription_payment_type = '-';
                        break;
                    default:
                        $subscription_payment_type = apply_filters( 'tds_subscription_' . $this->tds_subscription['payment_type'] . '_name', $this->tds_subscription['payment_type'] );
                        break;
                }
            } else {
                $subscription_payment_type = '-';
            }

            // get bank payment details
            $direct_payment_details = tds_util::get_payment_details('direct');

            // set direct bank payment details
            $direct_payment_bank = !empty($direct_payment_details['direct_payment_bank']) ? $direct_payment_details['direct_payment_bank'] : '';
            $direct_payment_account_name = !empty($direct_payment_details['direct_payment_account_name']) ? $direct_payment_details['direct_payment_account_name'] : '';
            $direct_payment_account_number = !empty($direct_payment_details['direct_payment_account_number']) ? $direct_payment_details['direct_payment_account_number'] : '';
            $direct_payment_routing_number = !empty($direct_payment_details['direct_payment_routing_number']) ? $direct_payment_details['direct_payment_routing_number'] : '';
            $direct_payment_iban = !empty($direct_payment_details['direct_payment_iban']) ? $direct_payment_details['direct_payment_iban'] : '';
            $direct_payment_bic_swift = !empty($direct_payment_details['direct_payment_bic_swift']) ? $direct_payment_details['direct_payment_bic_swift'] : '';
            $direct_payment_instruction = !empty($direct_payment_details['direct_payment_instruction']) ? $direct_payment_details['direct_payment_instruction'] : '';

            // set tds subscription url
            $tds_subscription_url = $this->get_tds_subscription_url();

        }

        // set bank info hide class
        $bank_info_hide = $show_confirm_version || ( $this->tds_subscription && !$subscription_is_free && $this->tds_subscription['payment_type'] == 'direct' ) ? '' : 'tds-hide';

        ob_start();

        ?>

        <div class="tds-payment-confirmation <?php echo $payment_confirmation_hide ?>">
            <div class="tds-s-page-sec tds-s-page-sec-cols tds-s-checkout-confirm-details">
                <div class="tds-s-page-sec-col tds-s-psc-thank-you">
                    <div class="tds-s-page-sec-content">
                        <div class="tds-s-notif tds-s-notif-info">
                            <div class="tds-s-notif-descr">
                                <?php echo __td('Thank you! We are delighted to see you here. Your subscription will be activated soon!', TD_THEME_NAME ) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tds-s-page-sec-col tds-s-psc-bank-info <?php echo $bank_info_hide ?>">
                    <div class="tds-s-page-sec-header">
                        <h2 class="tds-spsh-title"><?php echo __td('Our bank details', TD_THEME_NAME ) ?></h2>
                    </div>
                    <div class="tds-s-page-sec-content">
                        <ul class="tds-s-list">
                            <li class="tds-s-list-item tds-s-bank-name" <?php echo !empty($direct_payment_bank) ? '' : 'style="display: none;"' ?>>
                                <span class="tds-s-list-label"><?php echo __td('Bank name', TD_THEME_NAME ) ?>:</span>
                                <span class="tds-s-list-text"><?php echo $direct_payment_bank ?></span>
                            </li>
                            <li class="tds-s-list-item tds-s-bank-acc-name" <?php echo !empty($direct_payment_account_name) ? '' : 'style="display: none;"' ?>>
                                <span class="tds-s-list-label"><?php echo __td('Account name', TD_THEME_NAME ) ?>:</span>
                                <span class="tds-s-list-text"><?php echo $direct_payment_account_name ?></span>
                            </li>
                            <li class="tds-s-list-item tds-s-bank-acc-number" <?php echo !empty($direct_payment_account_number) ? '' : 'style="display: none";' ?>>
                                <span class="tds-s-list-label"><?php echo __td('Account number', TD_THEME_NAME ) ?>:</span>
                                <span class="tds-s-list-text"><?php echo $direct_payment_account_number ?></span>
                            </li>
                            <li class="tds-s-list-item tds-s-bank-routing" <?php echo !empty($direct_payment_routing_number) ? '' : 'style="display: none;"' ?>>
                                <span class="tds-s-list-label"><?php echo __td('Routing number', TD_THEME_NAME ) ?>:</span>
                                <span class="tds-s-list-text"><?php echo $direct_payment_routing_number ?></span>
                            </li>
                            <li class="tds-s-list-item tds-s-bank-iban" <?php echo !empty($direct_payment_iban) ? '' : 'style="display: none;"' ?>>
                                <span class="tds-s-list-label"><?php echo __td('IBAN', TD_THEME_NAME ) ?>:</span>
                                <span class="tds-s-list-text"><?php echo $direct_payment_iban ?></span>
                            </li>
                            <li class="tds-s-list-item tds-s-bank-bic" <?php echo !empty($direct_payment_bic_swift) ? '' : 'style="display: none;"' ?>>
                                <span class="tds-s-list-label"><?php echo __td('Bic/Swift', TD_THEME_NAME ) ?>:</span>
                                <span class="tds-s-list-text"><?php echo $direct_payment_bic_swift ?></span>
                            </li>
                            <li class="tds-s-list-item tds-s-bank-instructions" <?php echo !empty($direct_payment_instruction) ? '' : 'style="display: none;"' ?>>
                                <span class="tds-s-list-label"><?php echo __td('Instructions', TD_THEME_NAME ) ?>:</span>
                                <span class="tds-s-list-text"><?php echo $direct_payment_instruction ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tds-s-page-sec-col tds-s-psc-subscr-info"
                    <?php echo ( $this->tds_subscription || $show_confirm_version ) ? '' : 'style="display: none;"' ?>>
                    <div class="tds-s-page-sec-header">
                        <h2 class="tds-spsh-title">
                            <?php echo __td('Your subscription details', TD_THEME_NAME ) ?>
                        </h2>
                    </div>

                    <div class="tds-s-page-sec-content">
                        <ul class="tds-s-list">
                            <li class="tds-s-list-item tds-s-subscr-id">
                                <span class="tds-s-list-label"><?php echo __td('ID', TD_THEME_NAME ) ?>:</span>
                                <span class="tds-s-list-text"><?php echo $subscription_id ?></span>
                            </li>
                            <li class="tds-s-list-item tds-s-subscr-plan">
                                <span class="tds-s-list-label"><?php echo __td('Plan', TD_THEME_NAME ) ?>:</span>
                                <span class="tds-s-list-text"><?php echo $plan_name ?></span>
                            </li>
                            <li class="tds-s-list-item tds-s-subscr-months" <?php echo !$subscription_is_free && !$subscription_is_unlimited && !$subscription_is_with_credits ? '' : 'style="display: none;"' ?>>
                                <span class="tds-s-list-label">
                                    <?php echo __td('Cycle Interval', TD_THEME_NAME ) ?>:
                                </span>
                                <span class="tds-s-list-text">
                                    <?php
                                    $subscription_ci_format = tds_util::ci_format( $subscription_cycle_interval, $subscription_cycle_interval_count );
                                    echo $subscription_cycle_interval_count . ' ' . $subscription_ci_format;
                                    ?>
                                </span>
                            </li>
                            <li class="tds-s-list-item tds-s-subscr-period" <?php echo $subscription_is_with_credits ? 'style="display: none;"' : '' ?>>
                                <span class="tds-s-list-label"><?php echo __td('Period', TD_THEME_NAME ) ?>:</span>
                                <span class="tds-s-list-text">
                                    <?php echo $subscription_start_date ?> - <?php echo $subscription_end_date ?>
                                </span>
                            </li>
                            <li class="tds-s-list-item tds-s-subscr-credits" <?php echo $subscription_is_with_credits ? '' : 'style="display: none;"' ?>>
                                <span class="tds-s-list-label"><?php echo __td('Credits', TD_THEME_NAME ) ?>:</span>
                                <span class="tds-s-list-text"><?php echo $subscription_credits ?></span>
                            </li>
                            <li class="tds-s-list-item tds-s-subscr-pay-method" <?php echo !$subscription_is_free ? '' : 'style="display: none;"' ?>>
                                <span class="tds-s-list-label"><?php echo __td('Payment method', TD_THEME_NAME ) ?>:</span>
                                <span class="tds-s-list-text"><?php echo $subscription_payment_type ?></span>
                            </li>
                            <li class="tds-s-list-item tds-s-subscr-total">
                                <span class="tds-s-list-label"><?php echo __td('Total', TD_THEME_NAME ) ?>:</span>
                                <span class="tds-s-list-text">
                                    <?php

                                    if ( !empty($subscription_coupon_id) ) {
                                        echo '<span class="tds-s-price-full">' . $formatted_full_price . '</span>';
                                        echo '<span>' . $formatted_price . '</span>';
                                    } else {
                                        echo $subscription_is_free ? __td('Free', TD_THEME_NAME ) : tds_util::get_formatted_currency( $subscription_value, $subscription_curr_name, $subscription_curr_pos, $subscription_curr_th_sep, $subscription_curr_dec_sep, $subscription_curr_dec_no );
                                    }

                                    ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tds-s-page-sec tds-s-checkout-confirm-btns">
                <div class="tds-s-page-sec-content">
                    <a href="<?php echo empty($tds_subscription_url) ? '#' : $tds_subscription_url ?>" class="tds-s-btn tds-s-btn-view-subscription">
                        <?php echo __td('View subscription', TD_THEME_NAME ); ?>
                    </a>
                    <a href="<?php echo home_url() ?>" class="tds-s-btn">
                        <?php echo __td('Home', TD_THEME_NAME ) ?>
                    </a>
                </div>
            </div>
        </div>

        <?php

        return ob_get_clean();

    }

    function redirect_check() {

        // get tds account page
        $my_account_permalink = tds_util::get_account_page_url();

        if ( !empty($this->tds_plan) && !$this->is_stripe_session && !$this->is_payment_session ) {

            $is_plan_with_credits = !empty($this->tds_plan['is_with_credits']);

            if ( !$is_plan_with_credits ) {

                $user_active_subscriptions = tds_util::get_user_subscriptions( get_current_user_id(), $this->tds_plan['id'], [ 'active', 'free' ] );

                if ( $user_active_subscriptions ) {

                    if ( empty($this->tds_ref_url) && !empty($my_account_permalink) ) {
                        $redirect_to_account_url = esc_url( add_query_arg( 'subscriptions', '', $my_account_permalink ) );

                        // add active/free subscription expand to url
                        $active_subscription_id = !empty($user_active_subscriptions[0]['id']) ? $user_active_subscriptions[0]['id'] : '';
                        if ( $active_subscription_id ) {
                            $redirect_to_account_url = esc_url( add_query_arg( 'expand', $active_subscription_id, $redirect_to_account_url ) );
                        }

                    } else {
                        // redirect to the original locked post - to see it unlocked now
                        $redirect_to_original_url = base64_decode( $this->tds_ref_url );
                    }

                } else {
                    $user_waiting_payment_subscriptions = tds_util::get_user_subscriptions( get_current_user_id(), $this->tds_plan['id'], 'waiting_payment' );

                    if ( $user_waiting_payment_subscriptions ) {

                        if ( !empty($my_account_permalink) ) {

                            // redirect to subscription account - to inform user about the existing waiting in payment subscription
                            $redirect_to_unpaid_account_url = esc_url( add_query_arg( 'subscriptions', '', $my_account_permalink ) );

                            // add waiting_payment subscription expand to url
                            $waiting_payment_subscription_id = !empty($user_waiting_payment_subscriptions[0]['id']) ? $user_waiting_payment_subscriptions[0]['id'] : '';
                            if ( $waiting_payment_subscription_id ) {
                                $redirect_to_unpaid_account_url = esc_url( add_query_arg( 'expand', $waiting_payment_subscription_id, $redirect_to_unpaid_account_url ) );
                            }

                        }
                    }
                }

            } else {
                return false;
            }

            if ( !empty($redirect_to_original_url) ) {

                ob_start();
                ?>

                <div class="tds-payment-confirmation">
                    <div class="tds-s-page-sec tds-s-page-sec-cols tds-s-checkout-confirm-details">
                        <div class="tds-s-page-sec-col tds-s-psc-thank-you">
                            <div class="tds-s-page-sec-content">
                                <div class="tds-s-notif tds-s-notif-info">
                                    <div class="tds-s-notif-descr">
                                        <?php _etd('You already have an active subscription. We will redirect you back to your post!', TD_THEME_NAME ) ?>
                                    </div>
                                    <script>
                                        ( function() {
                                            setTimeout( function() {
                                                window.location = '<?php echo $redirect_to_original_url ?>';
                                            }, 5000 );
                                        })();
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

                return [
                    'type' => 'original_url_redirect',
                    'output' => ob_get_clean()
                ];

            } else if ( !empty($redirect_to_unpaid_account_url) ) {

                ob_start();
                ?>

                <div class="tds-payment-confirmation">
                    <div class="tds-s-page-sec tds-s-page-sec-cols tds-s-checkout-confirm-details">
                        <div class="tds-s-page-sec-col tds-s-psc-thank-you">
                            <div class="tds-s-page-sec-content">
                                <div class="tds-s-notif tds-s-notif-info">
                                    <div class="tds-s-notif-descr">
                                        <?php _etd( 'You already have a subscription, but it\'s still in waiting to be paid!', TD_THEME_NAME ) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tds-s-page-sec tds-s-checkout-confirm-btns">
                        <div class="tds-s-page-sec-content">
                            <a href="<?php echo $redirect_to_unpaid_account_url ?>"
                               class="tds-s-btn">
                                <?php echo __td( 'View subscription', TD_THEME_NAME ); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <?php

                return [
                    'type' => 'unpaid_account_redirect',
                    'output' => ob_get_clean()
                ];

            } else if ( !empty($redirect_to_account_url) ) {

                ob_start();
                ?>

                <div class="tds-payment-confirmation">
                    <div class="tds-s-page-sec tds-s-page-sec-cols tds-s-checkout-confirm-details">
                        <div class="tds-s-page-sec-col tds-s-psc-thank-you">
                            <div class="tds-s-page-sec-content">
                                <div class="tds-s-notif tds-s-notif-info">
                                    <div class="tds-s-notif-descr">
                                        <?php _etd('You already have an active subscription!', TD_THEME_NAME ) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tds-s-page-sec tds-s-checkout-confirm-btns">
                        <div class="tds-s-page-sec-content">
                            <a href="<?php echo $redirect_to_account_url ?>" class="tds-s-btn">
                                <?php echo __td('View subscription', TD_THEME_NAME ); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <?php

                return [
                    'type' => 'account_redirect',
                    'output' => ob_get_clean()
                ];

            }

        } elseif ( $this->is_payment_session && empty($this->tds_subscription) ) {

            $account_url = '';
            if ( !empty($my_account_permalink) ) {
                $account_url = esc_url( add_query_arg( 'subscriptions', '', $my_account_permalink ) );
            }

            ob_start();
            ?>

            <div class="tds-payment-confirmation">
                <div class="tds-s-page-sec tds-s-page-sec-cols tds-s-checkout-confirm-details">
                    <div class="tds-s-page-sec-col tds-s-psc-thank-you">
                        <div class="tds-s-page-sec-content">
                            <div class="tds-s-notif tds-s-notif-warn">
                                <div class="tds-s-notif-descr">
                                    <?php _etd('You have not selected a valid subscription.', TD_THEME_NAME ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tds-s-page-sec tds-s-checkout-confirm-btns">
                    <div class="tds-s-page-sec-content">
                        <a href="<?php echo $account_url ?>" class="tds-s-btn">
                            <?php echo __td('View subscriptions', TD_THEME_NAME ); ?>
                        </a>
                    </div>
                </div>
            </div>

            <?php

            return [
                'type' => 'account_redirect',
                'output' => ob_get_clean()
            ];

        }

        return false;

    }

    function invalid_plan_check() {

        // get show_version att, used to show a specific version of the shortcode in composer
        $show_version = $this->get_att('show_version');
        $show_no_plan_version = ( $this->is_composer && $show_version == 'no_plan' );
        $is_composer = false;

        if ( td_util::tdc_is_live_editor_iframe() || td_util::tdc_is_live_editor_ajax() ) {
            $is_composer = true;
        }

        if ( ( empty($this->tds_plan) && !$is_composer ) || $show_no_plan_version ) {

            ob_start();
            ?>

            <div class="tds-s-notif tds-s-notif-info tds-s-notif-no-plan">
                <div class="tds-s-notif-descr">
                    <?php echo __td('You have not selected a valid subscription plan.', TD_THEME_NAME ); ?>
                </div>
            </div>

            <?php

            return [
                'type' => 'invalid_plan',
                'output' => ob_get_clean()
            ];

        }

        return false;

    }

    function get_tds_subscription_url() {

        $tds_subscription_url = '';

        // get tds account page
        $my_account_permalink = tds_util::get_account_page_url();

        if ( $my_account_permalink ) {
            $tds_subscription_url = esc_url( add_query_arg( 'subscriptions', '', $my_account_permalink ) );

            if ( !empty($this->tds_subscription) ) {
                $tds_subscription_url = esc_url( add_query_arg( 'expand', $this->tds_subscription['id'], $tds_subscription_url ) );
            }

        }

        if ( !empty($tds_subscription_url) && $this->tds_ref_url ) {
            $tds_subscription_url = add_query_arg( 'ref_url', $this->tds_ref_url, $tds_subscription_url );
        }

        return $tds_subscription_url;

    }

}
