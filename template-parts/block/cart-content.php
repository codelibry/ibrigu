<?php do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form cartContent__wrapper" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
	<?php if(is_cart()): ?>
		<h1 class="cartContent__title sm woocommerce-title lg"><?php the_title(); ?></h1>	
	<?php else: ?>
		<h4 class="cartContent__title desktop-lg"><?php _e('Cart', 'woocommerce_custom_text'); ?></h4>
	<?php endif; ?>
	<div class="cartContent__itemsWrapper woocommerce-cart-form__contents" cellspacing="0">
		<div class="cartContent__itemsList">
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
					<div class="cartContent__item">
						<div class="cartContent__itemImage__wrapper">
							<div class="cartContent__itemImage">
								<?php echo $thumbnail; ?>
							</div>
						</div>
						<div class="cartContent__itemContent">
							<div class="cartContent__itemTop">
								<h5 class="cartContent__itemTitle desktop-sm"><?php echo $product_name; ?></h5>
								<h5 class="cartContent__itemPrice desktop-sm"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></h5>
							</div>

							<h5 class="cartContent__itemBody desktop-sm">
								<div class="cartContent__itemAttrs_list woocommerce-text sm desktop-md">
									<div class="cartContent__itemAttr">
										<div class="cartContent__itemAttr__options"><?php _e('Model ID:', 'woocommerce_custom_text'); ?> <?php echo $_product->get_sku(); ?></div>
									</div>
								</div>
								<?php 
								if($_product->get_type() == 'variation'){
									$attributes = $_product->get_attribute_summary();
									$attributes = explode(', ', $attributes);
								} else{
									$attributes = $_product->get_attributes();
								}
								foreach($attributes as $attribute):
								?>
									<div class="cartContent__itemAttrs_list woocommerce-text sm desktop-md">
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
										<div class="cartContent__itemAttr">
											<?php if($_product->get_type() != 'variation'): ?>
												<div class="cartContent__itemAttr__label"><?php echo $attributelabel . ': '; ?></div>
											<?php endif; ?>
											<?php if($_product->get_type() == 'variation'): ?>
												<div class="cartContent__itemAttr__options">
													<?php if($str[0] == 'Size'): ?>
														<?php _e('Only size', 'woocommerce_custom_text'); ?>
													<?php else: ?>
														<?php echo $results; ?>
													<?php endif; ?>
												</div>
											<?php else: ?>
												<div class="cartContent__itemAttr__options">
													<?php $count = count($results); ?>
													<?php $i = 1; foreach($results as $result): ?>
														<?php 
															echo $result; 
															if($i != $count){
																echo ', ';
															}
														?>
													<?php $i++; endforeach;?>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endforeach; ?>
								<?php if(is_cart()): ?>
								<div class="cartContent__itemQuantity">
									<div class="decrease">-</div>
									<?php
										if ( $_product->is_sold_individually() ) {
											$min_quantity = 1;
											$max_quantity = 1;
										} else {
											$min_quantity = 0;
											$max_quantity = $_product->get_max_purchase_quantity();
										}

										$product_quantity = woocommerce_quantity_input(
											array(
												'input_name'   => "cart[{$cart_item_key}][qty]",
												'input_value'  => $cart_item['quantity'],
												'max_value'    => $max_quantity,
												'min_value'    => $min_quantity,
												'product_name' => $product_name,
											),
											$_product,
											false
										);

										echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
									?>
									<div class="increase">+</div>
								</div>
								<?php else: ?>
									<div class="lii-qty lii-buttons-added me-3 <?php echo esc_attr($hidden); ?>">
										<input type="button" value="-" class="lii-minus" /><input data-key="<?php echo esc_attr($cart_item_key); ?>" type="number" step="1" min="1" max="" name="quantity" value="<?php echo $cart_item['quantity']; ?>" title="Qty" class="lii-input-text lii-qty lii-text" size="4" pattern="" inputmode="" /><input type="button" value="+" class="lii-plus" />
									</div>
								<?php endif; ?>
							</h5>
							<div class="cartContent__itemBottom">
								<?php 
									$in_wishlist = false;
									$test = YITH_WCWL();
									if ( function_exists( 'YITH_WCWL' ) ) {
										$in_wishlist = YITH_WCWL()->is_product_in_wishlist( $product_id );
									}
									$exists = YITH_WCWL()->is_product_in_wishlist( $product_id );
									$found_in_list = $exists ? yith_wcwl_get_wishlist( false ) : false;
									$found_item = $found_in_list ? $found_in_list->get_product( $product_id ) : false;
									if($in_wishlist == 1):
										$class = ' remove_from_wishlistWrapper';
										$wishlist_item_id = $found_item->get_id();
									else: 
										$class = ' add_to_wishlistWrapper';
										$wishlist_item_id = '';
									endif; 
								?>
								<div class="woocommerce-text cartContent__wishlist__buttonsWrapper<?php echo $class; ?>">
									<a href="?add_to_wishlist=<?php echo $product_id; ?>" class="add_to_wishlist woocommerce-text single_add_to_wishlist wishlist_toggle" data-product-id="<?php echo $product_id; ?>" data-product-type="variable" data-original-product-id="<?php echo $product_id; ?>" data-title="Add to wishlist" rel="nofollow">
										<?php _e('Add to my selection', 'woocommerce_custom_text'); ?>
									</a>
								
									<a href="?remove_from_wishlist=<?php echo $product_id; ?>" class="delete_item woocommerce-text wishlist_toggle" data-item-id="<?php echo $wishlist_item_id; ?>" data-product-id="<?php echo $product_id; ?>" data-original-product-id="<?php echo $product_id; ?>" data-title="Remove from list" rel="nofollow">
										<?php _e('Remove from my selection', 'woocommerce_custom_text'); ?>
									</a>
								</div>
								<div class="cartContent__itemRemove woocommerce-text desktop-sm">
									<?php _e('Cancel', 'woocommerce_custom_text') ?>
								</div>
							</div>
						</div>
						<div class="cartContent__itemBottom__buttons">
							<div class="woocommerce-text cartContent__wishlist__buttonsWrapper<?php echo $class; ?>">
								<a href="?add_to_wishlist=<?php echo $product_id; ?>" class="add_to_wishlist woocommerce-text desktop-md single_add_to_wishlist wishlist_toggle" data-product-id="<?php echo $product_id; ?>" data-product-type="variable" data-original-product-id="<?php echo $product_id; ?>" data-title="Add to wishlist" rel="nofollow">
									<?php _e('Add to my selection', 'woocommerce_custom_text'); ?>
								</a>
							
								<a href="?remove_from_wishlist=<?php echo $product_id; ?>" class="delete_item woocommerce-text desktop-md wishlist_toggle" data-item-id="<?php echo $wishlist_item_id; ?>" data-product-id="<?php echo $product_id; ?>" data-original-product-id="<?php echo $product_id; ?>" data-title="Remove from list" rel="nofollow">
									<?php _e('Remove from my selection', 'woocommerce_custom_text'); ?>
								</a>
							</div>
							<h5 class="cartContent__itemRemove woocommerce-text desktop-md">
								<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="removeBtn" aria-label="%s" data-product_id="%s" data-product_sku="%s">' . _e('Cancel', 'woocommerce_custom_text') . '</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											/* translators: %s is the product name */
											esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
										),
										$cart_item_key
									);
								?>
							</h5>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
			<?php do_action( 'woocommerce_cart_contents' ); ?>
			<div class="cartContent__coupon">
				<?php if ( wc_coupons_enabled() ) { ?>
					<div class="coupon">
						<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
						<?php do_action( 'woocommerce_cart_coupon' ); ?>
					</div>
				<?php } ?>
				<button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
				<?php do_action( 'woocommerce_cart_actions' ); ?>
				<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
			</div>
			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</div>
	</div>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
<div class="cart__bottomWrapper">
	<div class="cart__bottomContainer">
		<div class="cart__bottom">
			<div class="cart-collaterals">
				<?php
					/**
					 * Cart collaterals hook.
					 *
					 * @hooked woocommerce_cross_sell_display
					 * @hooked woocommerce_cart_totals - 10
					 */
					do_action( 'woocommerce_cart_collaterals' );
				?>
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
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
