<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
<section class="woocommerceLogin__wrapper">
	<div class="container woocommerce-container-mb">
		<div class="u-columns col2-set" id="customer_login">

			<div class="woocommerceLogin woocommerceAccountForm">

		<?php endif; ?>

				<h4 class="woocommerceLogin__title sm woocommerceAccountForm__title desktop-lg"><?php esc_html_e( 'Registered customer', 'woocommerce' ); ?></h4>
				<div class="woocommerceLogin__text woocommerce-text woocommerceAccountForm__text desktop-lg"><?php _e('If you already have an account, please enter your email and password.', 'woocommerce_custom_text'); ?></div>

				<form class="woocommerce-form woocommerce-form-login login" method="post">

					<?php do_action( 'woocommerce_login_form_start' ); ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="E-mail *" /><?php // @codingStandardsIgnoreLine ?>
					</p>
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="<?php _e('Password *', 'woocommerce_custom_text'); ?>" />
					</p>

					<?php do_action( 'woocommerce_login_form' ); ?>
					<p class="woocommerce-LostPassword lost_password woocommerce-text sm desktop-sm">
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot the password?', 'woocommerce' ); ?></a>
					</p>
					<div class="form-row loginFormButtons">
						<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
							<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
						</label>
						<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
						<button type="submit" class="woocommerce-button woocommerceAccountForm__buttonSubmit button button--black button--fz--md button--size--md woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
						<div class="registerAccountBtn button button--grey form-switchBtn button--fz--sm button--size--md--desktop"><?php _e('Create an account', 'woocommerce_custom_text'); ?></div>
					</div>
					

					<?php do_action( 'woocommerce_login_form_end' ); ?>

				</form>

		<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

			</div>

			<div class="woocommerceRegister">

				<h4 class="woocommerceRegister__title sm woocommerceAccountForm__title desktop-lg"><?php esc_html_e( 'Create an account', 'woocommerce' ); ?></h4>
				<div class="woocommerceRegister__text woocommerceAccountForm__text woocommerce-text desktop-lg"><?php _e('Follow orders, save shipping details, track favourite pieces for access on any device, and more.', 'woocommerce_custom_text'); ?></div>
				<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

					<?php do_action( 'woocommerce_register_form_start' ); ?>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
							<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
						</p>

					<?php endif; ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide email">
						<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" placeholder="<?php _e('Email *', 'woocommerce_custom_text'); ?>" /><?php // @codingStandardsIgnoreLine ?>
					</p>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
							<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
						</p>

					<?php else : ?>


					<?php endif; ?>

					<div class="registerFormButtons__wrapper">
						<div class="woocommerce-form-row registerFormButtons">
							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
							<button type="submit" class="woocommerce-Button woocommerceAccountForm__buttonSubmit woocommerce-button button--black button--fz--md button--size--md button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'CONTINUE', 'woocommerce' ); ?>"><?php esc_html_e( 'CONTINUE', 'woocommerce' ); ?></button>
							<div class="loginFormButton registerFormButton form-switchBtn button button--grey button--fz--xs button--size--md--desktop"><?php _e('I already have an account', 'woocommerce_custom_text'); ?></div>
						</div>
					</div>
					<?php do_action( 'woocommerce_register_form_end' ); ?>

				</form>

			</div>

		</div>
		<?php endif; ?>
	</div>
</section>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
