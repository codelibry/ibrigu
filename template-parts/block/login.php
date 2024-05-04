<form class="woocommerce-form woocommerce-form-login login" method="post">
	<?php do_action( 'woocommerce_login_form_start' ); ?>
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="E-mail *" /><?php // @codingStandardsIgnoreLine ?>
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="Password *" />
	</p>

	<?php do_action( 'woocommerce_login_form' ); ?>
	<p class="woocommerce-LostPassword lost_password woocommerce-text sm">
        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Hai dimenticato la password?', 'woocommerce_custom_text' ); ?></a>
	</p>
	<div class="form-row loginFormButtons">
        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
        </label>
        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
        <button type="submit" class="woocommerce-button woocommerceAccountForm__buttonSubmit button button--black button--fz--md button--size--md woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
        <div class="registerAccountBtn button button--grey form-switchBtn button--fz--sm"><?php _e('CREA UN ACCOUNT', 'woocommerce_custom_text'); ?></div>
	</div>
	<?php do_action( 'woocommerce_login_form_end' ); ?>
</form>