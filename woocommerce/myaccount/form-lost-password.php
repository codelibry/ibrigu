<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>
<section class="lostPasswordForm">
    <div class="container">
        <div class="lostPasswordForm__wrapper woocommerceAccountForm">
            <h4 class="sm lostPasswordRest__title woocommerceAccountForm__title desktop-lg"><?php _e('Hai perso la password?', 'woocommerce_custom_text'); ?></h4> 
            <div class="lostPasswordRest__text woocommerce-text woocommerceAccountForm__text desktop-lg"><p><?php _e("Per favore inserisci il tuo nome utente o l'indirizzo email. Riceverai via email un link per creare una nuova password.", 'woocommerce_custom_text'); ?></p></div><?php // @codingStandardsIgnoreLine ?>
            <form method="post" class="woocommerce-ResetPassword lost_reset_password lostPasswordRest woocommerce-form">

                <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" placeholder="<?php _e('Inserisci il tuo indirizzo email', 'woocommerce_custom_text') ?>" />
                </p>

                <div class="clear"></div>

                <?php do_action( 'woocommerce_lostpassword_form' ); ?>

                <p class="woocommerce-form-row form-row button-wrapper">
                    <input type="hidden" name="wc_reset_password" value="true" />
                    <button type="submit" class="woocommerce-Button button--black button--fz--md button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php _e( 'Resetta la password', 'woocommerce_custom_text' ); ?>"><?php _e( 'Resetta la password', 'woocommerce_custom_text' ); ?></button>
                </p>

                <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

            </form>
        </div>
    </div>
</section>
<?php
do_action( 'woocommerce_after_lost_password_form' );
