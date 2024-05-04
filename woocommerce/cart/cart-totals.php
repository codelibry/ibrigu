<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cartTotals__wrapper">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>
	<div class="cartTotals__list cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">
		<?php 
		$tax = WC()->cart->get_total_tax( ) == 0 ? 'Included' : WC()->cart->get_total_tax( ) . ' ' . get_woocommerce_currency_symbol();
		?>
		<h5 class="cartTotals__subtotalRow cartTotals__row desktop-md">
			<div class="cartTotals__subtotalLabel"><?php _e('Subtotale', 'woocommerce_custom_text'); ?></div>
			<div class="cartTotals__subtotalNumber"><?php wc_cart_totals_subtotal_html(); ?></div>
		</>
		<h5 class="cartTotals__taxRow cartTotals__row desktop-md">
			<div class="cartTotals__taxLabel"><?php _e('Tasse e imposte', 'woocommerce_custom_text'); ?></div>
			<div class="cartTotals__taxNumber"><?php echo $tax; ?></div>
		</>
		<h5 class="cartTotals__shippingRow cartTotals__row desktop-md">
			<div class="cartTotals__shippingLabel"><?php _e('Spedizione', 'woocommerce_custom_text'); ?></div>
			<div class="cartTotals__shippingNumber"><?php echo WC()->cart->get_shipping_total() . ' ' . get_woocommerce_currency_symbol(); ?></div>
		</>
		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<h4 class="cartTotals__amountRow cartTotals__row lg desktop-lg">
			<div class="cartTotals__amountLabel"><?php _e('Totale', 'woocommerce_custom_text'); ?></div>
			<div class="cartTotals__amountNumber"><?php wc_cart_totals_order_total_html(); ?></div>
		</h4>
		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</div>
	
	<div class="cartTotals__buttonsList">
		<?php $current_lang = apply_filters( 'wpml_current_language', NULL ); ?>
		<?php 
		if($current_lang == 'it'){
			$checkout = get_home_url() . '/checkout';
			$clothing = get_home_url() . '/product-category/vestiario/';
			$home = get_home_url() . '/product-category/casa/';
		} elseif( $current_lang == 'en' ){
			$checkout = get_home_url() . '/checkout';
			$clothing = get_home_url() . '/product-category/clothing/';
			$home = get_home_url() . '/product-category/home/';
		}
		?>
		<a class="cartTotals__checkoutBtn btn button--black button--fz--md button--size--md" href="<?php echo $checkout; ?>">
			<?php _e('GUARDARE', 'woocommerce_custom_text'); ?>
		</a>
		<a class="cartTotals__shopBtn btn button--white button--white--border button--fz--xs button--size--md" href="<?php echo $clothing; ?>">
			<?php _e('VESTIARIO', 'woocommerce_custom_text'); ?>
		</a>
		<a class="cartTotals__shopBtn btn button--white button--white--border button--fz--xs button--size--md" href="<?php echo $home; ?>">
			<?php _e('CASA', 'woocommerce_custom_text'); ?>
		</a>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
