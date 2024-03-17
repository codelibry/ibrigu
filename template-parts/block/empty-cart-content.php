<?php $image = get_field('empty_cart_image', 'options'); ?>
<div class="emptyCart__title woocommerce-text desktop-lg"><?php _e('Cart', 'woocommerce_custom_text'); ?> (0)</div>
<h1 class="emptyCart__title woocommerce-title"><?php _e('Cart', 'woocommerce_custom_text'); ?> (0)</h1>
<div class="emptyCart__subtitle woocommerce-text desktop-md"><?php _e('Your cart is empty.', 'woocommerce_custom_text'); ?></div>
<?php if($image): ?>
    <div class="emptyCart__image"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>"></div>
<?php endif; ?>
<a href="<?php echo get_home_url(  ) ?>" class="emptyCart__button btn button--fz--md button--black button--size--md"><?php _e('HOME', 'woocommerce_custom_text'); ?></a>
<a href="<?php echo get_home_url(  ) ?>" class="emptyCart__closeIcon"></a>