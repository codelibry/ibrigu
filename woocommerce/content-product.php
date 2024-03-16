<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div class="catalog__listItem__wrapper col-lg-3 col-6">
    <a class="catalog__listItem" href="<?php the_permalink(); ?>">
        <?php 
        if(!empty(wp_get_attachment_url( $product->get_image_id() ))):
            $image = wp_get_attachment_url( $product->get_image_id() );
        else: 
            $image = wc_placeholder_img_src();
        endif;
        ?>
        <div class="catalog__listItem__head">
            <div class="catalog__listItem__image"><img src="<?php echo $image; ?>" alt=""></div>
        </div>
        <div class="catalog__listItem__body">
            <h5 class="catalog__listItem__title"><?php echo $product->get_title(); ?></h5>
            <h5 class="catalog__listItem__price"><?php echo $product->get_price_html(); ?></h5>
            <div class="catalog__listItem__wishlist"><?php do_action( 'woocommerce_after_shop_loop_item' ); ?></div>
        </div>
    </a>
</div>
