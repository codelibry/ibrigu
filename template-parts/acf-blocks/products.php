<?php
    $products_list = get_sub_field('products_list');
    $paddingTop = get_sub_field('paddingTop');
    $paddingBottom = get_sub_field('paddingBottom');
    $paddingTop_mobile = get_sub_field('paddingTop_mobile');
    $paddingBottom_mobile = get_sub_field('paddingBottom_mobile');
?>

<?php if ($products_list) : ?>
    <div class="section products pt-<?php echo $paddingTop_mobile ?> pb-<?php echo $paddingBottom_mobile ?> pt-md-<?php echo $paddingTop ?> pb-md-<?php echo $paddingBottom ?>">
        <div class="container">
            <ul class="products__list row">
                <?php foreach ($products_list as $post) : ?>
                    <?php setup_postdata($post); ?>
                    <?php $product = wc_get_product($post->ID); ?>
                    
                    <?php if ($product) : ?>
                        <?php
                        $product_title = $product->get_title();
                        $product_thumbnail = $product->get_image();
                        $product_price = $product->get_price();
                        $product_link = get_permalink($product->get_id());
                        ?>

                        <li class="products__item col-6 col-md-4 col-xl-2">
                            <div class="products__item-wrap">
                                <a href="<?php echo $product_link; ?>" class="products__item-img">
                                    <?php echo $product_thumbnail; ?>
                                </a>
                                <span class="products__item-name">
                                    <?php echo $product_title; ?>
                                </span>
                                <span class="products__item-price">
                                    <?php echo wc_price($product_price); ?>
                                </span>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                
                <?php wp_reset_postdata(); ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
