<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<div class="checkoutContent__wrapper">
	<div class="checkoutContent">
		<a href="<?php echo get_home_url() . '/cart'; ?>" class="checkoutContent__btn button--underline"><?php _e('TORNA AL CARRELLO', 'woocommerce_custom_text'); ?></a>
		<div id="order_review" class="woocommerce-checkout-review-order">
			<div class="cartTotals__wrapper">
				<h3 class="cartTotals__title lg desktop-md"><?php _e('Il tuo ordine', 'woocommerce_custom_text'); ?></h3>
				<div class="cartTotals__productsList">
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>
					<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { 
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
						/**
						 * Filter the product name.
						 *
						 * @since 2.1.0
						 * @param string $product_name Name of the product in the cart.
						 * @param array $cart_item The product in the cart.
						 * @param string $cart_item_key Key for the product in the cart.
						 */
						$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {	
						?>
							<div class="cartTotals__productsList__item">
								<div class="cartTotals__productsList__itemImage"><?php echo $thumbnail; ?></div>
								<div class="cartTotals__productsList__itemBody">
									<div class="cartTotals__productsList__itemTop">
										<h5 class="cartTotals__productsList__itemTitle desktop-sm"><?php echo $product_name; ?></h5>
										<h5 class="cartTotals__productsList__itemPrice desktop-sm"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></h5>
									</div>
									<div class="cartTotals__productsList__itemAttrs_list woocommerce-text sm desktop-md">
										<?php 
										if($_product->get_type() == 'variation'){
											$attributes = $_product->get_attribute_summary();
											$attributes = explode(', ', $attributes);
										} else{
											$attributes = $_product->get_attributes();
										}
										foreach($attributes as $attribute):
										?>
											<?php 
											if($_product->get_type() == 'variation'){
												$attributelabel = '';
												$results = $attribute;
											} else{
												$attributelabel = wc_attribute_label( $attribute['name'] );
												$results = woocommerce_get_product_terms($_product->id, $attribute['name'], 'names');
											}
											$str = explode(': ', $attribute);
											
											?>
											<div class="cartTotals__productsList__itemAttr">
												<?php if($_product->get_type() != 'variation'): ?>
													<h5 class="cartTotals__productsList__itemAttr__label desktop-sm"><?php echo $attributelabel . ': '; ?></h5>
												<?php endif; ?>
												<?php if($_product->get_type() == 'variation'): ?>
													<h5 class="cartTotals__productsList__itemAttr__options desktop-sm">
														<?php if($str[0] == 'Size'): ?>
															<?php _e('Only size', 'woocommerce_custom_text'); ?>
														<?php else: ?>
															<?php echo $results; ?>
														<?php endif; ?>
													</h5>
												<?php else: ?>
													<h5 class="cartTotals__productsList__itemAttr__options desktop-sm">
														<?php $count = count($results); ?>
														<?php $i = 1; foreach($results as $result): ?>
															<?php 
																echo $result; 
																if($i != $count){
																	echo ', ';
																}
															?>
														<?php $i++; endforeach;?>
													</h5>
												<?php endif; ?>
											</div>
										<?php endforeach; ?>
									</div>
									<h5 class="cartTotals__productsList__itemQuantity desktop-sm"><?php _e('Q.tà:', 'woocommerce_custom_text'); ?> <?php echo $cart_item['quantity']; ?></h5>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
				<div
					class="cartTotals__list cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">
					<h5 class="cartTotals__subtotalRow cartTotals__row desktop-md">
						<div class="cartTotals__subtotalLabel"><?php _e('Subtotale', 'woocommerce_custom_text'); ?></div>
						<div class="cartTotals__subtotalNumber"><?php wc_cart_totals_subtotal_html(); ?></div>
					</h5>
					<h5 class="cartTotals__taxRow cartTotals__row desktop-md">
						<div class="cartTotals__taxLabel"><?php _e('Tasse e imposte', 'woocommerce_custom_text'); ?></div>
						<div class="cartTotals__taxNumber">
							<?php echo WC()->cart->get_total_tax( ) . ' ' . get_woocommerce_currency_symbol();; ?></div>
					</h5>
					<h5 class="cartTotals__shippingRow cartTotals__row desktop-md">
						<div class="cartTotals__shippingLabel"><?php _e('Spedizione', 'woocommerce_custom_text'); ?></div>
						<div class="cartTotals__shippingNumber">
							<?php echo WC()->cart->get_shipping_total() . ' ' . get_woocommerce_currency_symbol(); ?></div>
					</h5>
					<h5 class="cartTotals__amountRow cartTotals__row desktop-lg lg">
						<div class="cartTotals__amountLabel"><?php _e('Totale', 'woocommerce_custom_text'); ?></div>
						<div class="cartTotals__amountNumber"><?php wc_cart_totals_order_total_html(); ?></div>
					</h5>
				</div>
				<?php if(have_rows('cart_additional_info', 'options')): ?>
					<div class="cartAdditionalInfo">
						<?php while(have_rows('cart_additional_info', 'options')): the_row(); ?>
							<div class="cartAdditionalInfo__row">
								<?php
								$title = get_sub_field('title');
								$text = get_sub_field('text');
								$icon = get_sub_field('icon');
								if($title || $icon):
								?>
									<div class="cartAdditionalInfo__titleWrapper woocommerce-text desktop-xs">
										<?php if($icon): ?>
											<div class="cartAdditionalInfo__icon"><img src="<?php echo $icon; ?>"></div>
										<?php endif; ?>
										<?php if($title): ?>
											<div class="cartAdditionalInfo__title"><?php echo $title; ?></div>
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<?php if($text): ?>
									<div class="cartAdditionalInfo__text woocommerce-text desktop-xs">
										<?php echo $text; ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="checkoutTabs__list">
			<div class="checkoutTabs__listItem checkoutUserInfoTab active">
				<?php if(!is_user_logged_in()): ?>
					<div class="checkoutUserInfoTab__forms">
						<h4 class="checkoutTabs__listItem__title sm desktop-xl"><?php _e('Informazioni di contatto', 'woocommerce_custom_text'); ?></h4>
						<div class="checkoutUserInfoTab__sublist checkoutTabs__listItem__sublist login-tab">
							<h4 class="sm checkoutTabs__listItem__sublistTitle desktop-md login"><?php _e('Cliente esistente', 'woocommerce_custom_text'); ?></h4>
							<div class="checkoutTabs__listItem__sublistContent">
								<form class="woocommerce-form woocommerce-form-login login" method="post" id="login">
									<?php do_action( 'woocommerce_login_form_start' ); ?>
									<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
										<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="<?php _e('E-mail *', 'woocommerce_custom_text'); ?>" /><?php // @codingStandardsIgnoreLine ?>
									</p>
									<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
										<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="<?php _e('Password *', 'woocommerce_custom_text'); ?>" />
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
										<button type="submit" class="woocommerce-button woocommerceAccountForm__buttonSubmit btn button--black button--fz--md button--size--md woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'LOG IN & CONTINUA', 'woocommerce' ); ?>"><?php esc_html_e( 'LOG IN & CONTINUA', 'woocommerce' ); ?></button>
										<div class="registerFormLink swapForm woocommerce-text sm"><?php _e('Puoi anche', 'woocommerce_custom_text'); ?> <span class="link"><?php _e('Nuovo cliente', 'woocommerce_custom_text'); ?></span></div>
									</div>
									<?php do_action( 'woocommerce_login_form_end' ); ?>
								</form>
							</div>
						</div>
						<div class="checkoutTabs__listItem__sublist new-account">
							<h4 class="sm checkoutTabs__listItem__sublistTitle desktop-md"><?php _e('Crea un account', 'woocommerce_custom_text_it'); ?></h4>
							<div class="checkoutTabs__listItem__sublistContent">
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


								<div class="woocommerce-form-row form-row registerFormButtons">
									<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
									<button type="submit" class="woocommerce-Button woocommerceAccountForm__buttonSubmit woocommerce-button button--black button--fz--md button--size--md btn<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'LOG IN & CONTINUA', 'woocommerce' ); ?>"><?php esc_html_e( 'LOG IN & CONTINUA', 'woocommerce' ); ?></button>
									<div class="loginFormLink swapForm woocommerce-text sm"><?php _e('Puoi anche', 'woocommerce_custom_text'); ?> <span class="link"><?php _e('Login', 'woocommerce_custom_text'); ?></span></div>
								</div>

								<?php do_action( 'woocommerce_register_form_end' ); ?>

								</form>
							</div>
						</div>
						<div class="checkoutTabs__listItem__sublist guestLogin__tab">
							<div class="guestLogin__wrapper">
								<h4 class="sm checkoutTabs__listItem__sublistTitle desktop-md"><?php _e('Checkout come ospite', 'woocommerce_custom_text'); ?></h4>
								<div class="checkoutTabs__listItem__sublistContent">
									<form action="" class="guestLogin spacing-sm">
										<input type="email" class="email" placeholder="<?php _e('E-mail *', 'woocommerce_custom_text'); ?>">
										<input type="text" class="name" placeholder="<?php _e('Nome *', 'woocommerce_custom_text'); ?>">
										<input type="text" class="surname" placeholder="<?php _e('Cognome *', 'woocommerce_custom_text'); ?>">
										<input type="text" class="fiscalCode" placeholder="<?php _e('Codice Fiscale *', 'woocommerce_custom_text'); ?>">
										<input type="tel" class="phoneNumber" placeholder="<?php _e('Cellulare *', 'woocommerce_custom_text'); ?>">
										<div class="form-row woocommerce-form-row form-row-wide form-privacy-checkbox-wrapper form-checkbox-wrapper">
											<div class="form-privacy-checkbox form-checkbox"><input type="checkbox" name="privacy"></div>
											<span class="woocommerce-text sm desktop-sm"><?php _e('Ho letto l’informativa sulla privacy e autorizzo Ibrigu al trattamento dei miei dati personali.', 'woocommerce_custom_text'); ?></span>
										</div>
										<div class="errors woocommerce-text">
											<div class="error-msg checkbox"><?php _e("Conferma di aver letto l'Informativa sulla privacy", 'woocommerce_custom_text'); ?></div>
											<div class="error-msg emptyFields"><?php _e('Alcuni campi sono vuoti', 'woocommerce_custom_text'); ?></div>
										</div>
										<div class="guestLogin__btnWrapper">
											<button type="submit" class="guestLogin__btn btn button--black button--fz--md button--size--md"><?php _e('CONTINUA', 'woocommerce_custom_text'); ?></button>
										</div>
										<div class="createAccount woocommerce-text sm"><?php _e('Puoi anche', 'woocommerce_custom_text'); ?> <span class="create"><?php _e('Nuovo cliente', 'woocommerce_custom_text'); ?></span></div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="formResult">
						<div class="formResult__top"><h4 class="desktop-xl sm"><?php _e('Informazioni di contatto', 'woocommerce_custom_text'); ?></h4> <h5 class="edit desktop-md"><?php _e('Modifica', 'woocommerce_custom_text'); ?></h5></div>
						<h4 class="formResult__content desktop-md sm">
						</h4>
					</div>
				<?php else: ?>
					<?php $customer = new WC_Customer( get_current_user_id() ); 
						if($customer->first_name != "" or $customer->last_name != ""): 
							$customer_name = $customer->last_name . " " . $customer->first_name; 
						else: 
							$customer_name = $customer->display_name; 
						endif;
						$current_user = wp_get_current_user();
						$redirect_full_url = get_home_url() . $redirect_slug;
						$logout_url = wp_logout_url($redirect_full_url);
					?>
					<div class="loginedCustomerData woocommerce-text lg">
						<h4 class="checkoutTabs__listItem__title loginedCustomerData__title login desktop-xl sm"><?php _e('Informazioni di contatto', 'woocommerce_custom_text'); ?><a href="<?php echo $logout_url; ?>" class="loginedCustomerData__logout h4 sm desktop-md"><?php _e('Disconnettersi', 'woocommerce_custom_text'); ?></a></h4>
						<h4 class="loginedCustomerData__subtitle sm desktop-md"><?php _e('Signed with', 'woocommerce_custom_text'); ?> <?php echo $current_user->user_email; ?></h4>
						<h4 class="loginedCustomerData__text sm desktop-md"><?php echo $customer_name; ?></h4>
						<h4 class="loginedCustomerData__text sm desktop-md"><?php echo $current_user->user_email; ?></h4>
					</div>
				<?php endif; ?>
			</div>
				<form name="checkout" method="post" class="checkout woocommerce-checkout spacing-sm"
					action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">


					<?php if ( $checkout->get_checkout_fields() ) : ?>

					<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
					<div class="checkoutTabs__listItem checkoutShipping<?php if(is_user_logged_in()){echo ' opened';} ?>">
						<h4 class="checkoutTabs__listItem__title sm desktop-xl"><?php _e('Spedizione', 'woocommerce_custom_text'); ?></h4>
						<div class="checkoutTabs__listItem__sublist">
							<div class="col2-set checkoutTabs__listItem__sublistContent" id="customer_details">
								<div class="col-12">
									<?php do_action( 'woocommerce_checkout_billing' ); ?>
									<h5 class="giftComment form-checkbox-wrapper desktop-xs"><div class="form-checkbox"><input type="checkbox"></div><span><?php _e('È un regalo?', 'woocommerce_custom_text'); ?> </span><?php _e('Aggiungi un messaggio personalizzato', 'woocommerce_custom_text'); ?></h5>
									<h5 class="charactersLimit desktop-xs">
										<span class="count"></span><span class="label"><?php _e('caratteri rimanenti', 'woocommerce_custom_text'); ?></span>
									</h5>
								</div>

								<div class="col-12 additional-fields">
									<?php do_action( 'woocommerce_checkout_shipping' ); ?>
								</div>
								<div class="checkoutShipping__error"><?php _e('Some fields are empty!', 'woocommerce_custom_text'); ?></div>
								<div class="checkoutShipping__continue"><div class="btn button--black button--fz--md button--size--md"><?php _e('CONTINUA', 'woocommerce_custom_text'); ?></div> </div>
							</div>
						</div>
					</div>
					<div class="checkoutShipping__result woocommerce-text lg">
						<div class="checkoutShipping__resultColumns">
							<div class="checkoutShipping__resultShipping">
								<div class="checkoutShipping__resultTitle"><h4 class="bg_title desktop-xl sm"><?php _e('Informazioni di contatto', 'woocommerce_custom_text'); ?></h4><h4 class="title desktop-xl sm"><?php _e('Spedizione', 'woocommerce_custom_text'); ?></h4> <h5 class="edit desktop-md"><?php _e('Modifica', 'woocommerce_custom_text'); ?></h5></div>
								<div class="checkoutShipping__resultContent"></div>
							</div>
							<div class="checkoutShipping__resultBilling">
								<div class="checkoutShipping__resultTitle"><h4 class="bg_title desktop-xl sm"><?php _e('Informazioni di contatto', 'woocommerce_custom_text'); ?></h4><h4 class="title desktop-xl sm"><?php _e('Billing', 'woocommerce_custom_text'); ?></h4> <h5 class="edit desktop-md"><?php _e('Modifica', 'woocommerce_custom_text'); ?></h5></div>
								<div class="checkoutShipping__resultContent"></div>
							</div>
						</div>
					</div>
					<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

					<?php endif; ?>
					<div class="checkoutTabs__listItem checkoutPayment hide">
						<h4 class="checkoutTabs__listItem__title sm desktop-xl"><?php _e('Pagamento', 'woocommerce_custom_text'); ?></h4>
						<div class="checkoutTabs__listItem__sublist">
							<div class="checkoutTabs__listItem__sublistContent">
								<div id="payment" class="woocommerce-checkout-payment">
									<?php if ( WC()->cart->needs_payment() ) : ?>
									<ul class="wc_payment_methods payment_methods methods">
										<?php
										if ( ! empty( $available_gateways ) ) {
											foreach ( $available_gateways as $gateway ) {
												wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
											}
										} else {
											echo '<li>';
											wc_print_notice( apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ), 'notice' ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment
											echo '</li>';
										}
										?>
									</ul>
									<?php endif; ?>
									<div class="form-row place-order">
										<noscript>
											<?php
										/* translators: $1 and $2 opening and closing emphasis tags respectively */
										printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
										?>
											<br /><button type="submit"
												class="button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"
												name="woocommerce_checkout_update_totals"
												value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
										</noscript>

										<?php wc_get_template( 'checkout/terms.php' ); ?>

										<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

										<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt' . esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ) . '" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

										<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

										<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
									</div>
								</div>
								<div class="checkoutMessage woocommerce-text xs italic">
									<?php _e('I hereby confirm that I have read and accepted the terms & conditions and I understand and give my consent to the privacy and cookies policies. See here our terms and conditions.', 'woocommerce_custom_text'); ?>
									</div>
							</div>
						</div>
						<?php
					if ( ! wp_doing_ajax() ) {
						do_action( 'woocommerce_review_order_after_payment' );
					} ?>
					</div>
				</form>
			

		</div>

		<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
	</div>
</div>