<?php
/**
 * Theme functions and definitions.
 */
		 
		 
		 
if (!function_exists('ekommart_form_login')) {
    function ekommart_form_login()
    { ?>
        <div class="login-form-head">
            <span class="login-form-title"><?php esc_attr_e('Sign in', 'ekommart') ?></span>
            <span class="pull-right">
                <a class="register-link"
                   href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                   title="<?php esc_attr_e('Register', 'ekommart'); ?>"><?php esc_attr_e('Create an Account', 'ekommart'); ?></a>
            </span>
        </div>
        <form class="ekommart-login-form-ajax" data-toggle="validator">
            <p>
                <label><?php esc_attr_e('Username or email', 'ekommart'); ?> <span class="required">*</span></label>
                <input name="username" type="text" required placeholder="<?php esc_attr_e('Username', 'ekommart') ?>">
            </p>
            <p>
                <label><?php esc_attr_e('Password', 'ekommart'); ?> <span class="required">*</span></label>
                <input name="password" type="password" required
                       placeholder="<?php esc_attr_e('Password', 'ekommart') ?>">
            </p>
            <button type="submit" data-button-action
                    class="btn btn-primary btn-block w-100 mt-1"><?php esc_html_e('Login', 'ekommart') ?></button>
            <input type="hidden" name="action" value="ekommart_login">
            <?php wp_nonce_field('ajax-ekommart-login-nonce', 'security-login'); ?>
        </form>
        <div class="login-form-bottom">
            <a href="<?php echo wp_lostpassword_url(get_permalink()); ?>" class="lostpass-link"
               title="<?php esc_attr_e('Lost your password?', 'ekommart'); ?>"><?php esc_attr_e('Lost your password?', 'ekommart'); ?></a>
        </div>
        <?php
    }
}		 

/**
 * Change a currency symbol
 */
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'AED': $currency_symbol = 'AED'; break;
     }
     return $currency_symbol;
}

add_action( 'woocommerce_webhook_process_delivery', 'wc_webhook_process_delivery', 10, 2 );

