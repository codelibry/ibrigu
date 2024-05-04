<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>


<div class="cartTotals__wrapper">
	<h2 class="cartTotals__title"><?php _e('Il tuo ordine', 'woocommerce_custom_text'); ?></h2>
	<div class="cartTotals__list cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

		<div class="cartTotals__subtotalRow cartTotals__row">
			<div class="cartTotals__subtotalLabel"><?php _e('Subtotale', 'woocommerce_custom_text'); ?></div>
			<div class="cartTotals__subtotalNumber"><?php wc_cart_totals_subtotal_html(); ?></div>
		</div>
		<div class="cartTotals__taxRow cartTotals__row">
			<div class="cartTotals__taxLabel"><?php _e('Tasse e imposte', 'woocommerce_custom_text'); ?></div>
			<div class="cartTotals__taxNumber"><?php echo WC()->cart->get_total_tax( ) . ' ' . get_woocommerce_currency_symbol();; ?></div>
		</div>
		<div class="cartTotals__shippingRow cartTotals__row">
			<div class="cartTotals__shippingLabel"><?php _e('Spedizione', 'woocommerce_custom_text'); ?></div>
			<div class="cartTotals__shippingNumber"><?php echo WC()->cart->get_shipping_total() . ' ' . get_woocommerce_currency_symbol(); ?></div>
		</div>

		<h4 class="cartTotals__amountRow cartTotals__row lg">
			<div class="cartTotals__amountLabel"><?php _e('Totale', 'woocommerce_custom_text'); ?></div>
			<div class="cartTotals__amountNumber"><?php wc_cart_totals_order_total_html(); ?></div>
		</h4>

	</div>


</div>
