<?php $customer = new WC_Customer( get_current_user_id() ); 
if($customer->first_name != "" or $customer->last_name != ""): 
    $customer_name = $customer->last_name . " " . $customer->first_name; 
else: 
    $customer_name = $customer->display_name; 
endif;
$empty_wishlist_text = get_field('empty_wishlist_text', 'options');
$slider_title = get_field('empty_wishlist_related_products_title', 'options');
?>
<section class="wishlist">
    <div class="wishlist__container container woocommerce-container-mb">
        <div class="wishlist__top">
            <h1 class="wishlist__pageTitle woocommerce-title"><?php _e('Account', 'woocommerce_custom_text'); ?></h1>
            <h4 class="wishlist__userName myAccount__userName sm desktop-lg"><?php _e('Welcome', 'woocommerce_custom_text'); echo $customer_name . '!'; ?></h4>
            <div class="wishlist__menu account__menu">
                <h5 class="account__menuItem desktop-lg">
                    <a href="<?php echo get_home_url() . '/my-account'; ?>"><?php _e('Le mie informazioni', 'woocommerce_custom_text'); ?></a>
                </h5>
                <h5 class="account__menuItem desktop-lg current">
                    <?php _e('La mia wishlist', 'woocommerce_custom_text'); ?>
                </h5>
            </div>
            <h1 class="wishlist__title myAccount__title sm"><?php the_title(); ?></h1>
        </div>
        <div class="wishlist__itemsList row">
            
            <?php foreach ( $wishlist_items as $item ) :
                global $product;
                $product      = $item->get_product();
                $availability = $product->get_availability();
                $stock_status = isset( $availability['class'] ) ? $availability['class'] : false; 
                $product_id = $product->get_id();
                ?>
                <div class="wishlist__itemWrapper col-12 col-md-6 col-lg-3">
                    <div class="wishlist__item">
                        <?php 
                        if(!empty(wp_get_attachment_url( $product->get_image_id() ))):
                            $image = wp_get_attachment_url( $product->get_image_id() );
                        else: 
                            $image = wc_placeholder_img_src();
                        endif;
                        ?>
                        <div class="wishlist__itemImage"><img src="<?php echo $image; ?>" alt=""></div>
                        <div class="wishlist__itemTitle"><?php echo $product->get_title(); ?></div>
                        <div class="wishlist__itemBottom">
                            <div class="wishlist__itemAttributes">
                                <h5 class="wishlist__itemTitle desktop"><?php echo $product->get_title(); ?></h5>
                                <h5 class="wishlist__itemPrice"><?php do_action('woocommerce_product_price'); ?></h5>
                                <div class="wishlist__itemAttributes__list">
                                    <?php 
                                    $attributes = $product->get_attributes();
                                    foreach($attributes as $attribute):
                                        if(gettype($attribute) == 'object'):
                                            $attributelabel = wc_attribute_label( $attribute['name'] );
                                            $results = wc_get_product_terms( $product_id, $attribute['name'], array( 'fields' => 'names') ); ?>
                                            <div class="wishlist__itemAttributes__item">
                                                <div class="wishlist__itemAttributes__itemLabel"><?php echo $attributelabel . ': '; ?></div>
                                                <div class="wishlist__itemAttributes__itemOptions">
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
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach;?>
                                    <div class="wishlist__itemRemove"><?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ) ?></div>
                                </div>
                            </div>
                            <?php if($product->is_type( 'variable' )): ?>
                                <div class="wishlist__itemButton productAddTocart"><a href="<?php echo $product->get_permalink(); ?>" class="single_add_to_cart_button button"><h2 class="price"><?php do_action('woocommerce_product_price'); ?></h2><h2 class="label sm"><?php _e('Aggiungi Al Carrello', 'woocommerce_custom_text'); ?></h2></a></div>
                            <?php else: ?>
                                <div class="wishlist__itemButton productAddTocart"><?php do_action('woocommerce_product_add_to_cart'); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="wishlist__empty">
            <?php 
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 3,
            );
            $the_query = new WP_Query($args);
            ?>
            <?php if($empty_wishlist_text): ?>
                <div class="wishlist__emptyText woocommerce-text desktop-lg"><?php echo $empty_wishlist_text ?></div>
            <?php endif; ?>
            <div class="wishlist__relatedProducts relatedProducts">
                <?php if($slider_title): ?>
                    <div class="wishlist__relatedProductsTitle woocommerce-text desktop-lg"><?php echo $slider_title; ?></div>
                <?php endif; ?>
                <?php if($the_query->have_posts()): ?>
                    <div class="relatedProducts__list singleProductCardsList">
                        <?php while($the_query->have_posts()): $the_query->the_post(); ?>
                            <div class="relatedProducts__cardWrapper singleProductCard__wrapper">
                                <div class="relatedProducts__card singleProductCard">
                                    <?php if(!empty(get_the_post_thumbnail_url(  ))):
                                        $image = get_the_post_thumbnail_url(  );
                                    else:
                                        $image = wc_placeholder_img_src();
                                    endif; ?>
                                    <div class="relatedProducts__image singleProductCard__image"><img src="<?php echo $image; ?>" alt=""></div>
                                    <h5 class="relatedProducts__title singleProductCard__title"><?php the_title(); ?></h5>
                                    <a href="<?php the_permalink() ?>" class="relatedProducts__link singleProductCard__link"><h5 class="desktop-sm"><?php _e('Vedi di più', 'woocommerce_custom_text'); ?></h5></a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="wishlist__subscribtion"></div>
        </div>
    </div>
</section>
