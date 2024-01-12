<?php 
global $product;

$attachment_ids = $product->get_gallery_image_ids();
$post_image = get_the_post_thumbnail_url(  );
$products_list_title = get_field('single_product_products_list_title', 'options');
$products_slider_title = get_field('single_product_products_slider_title', 'options');
$products = get_field('products_list');
do_action( 'woocommerce_before_single_product' ); 
?>
<section id="product-<?php the_ID(); ?>" <?php wc_product_class( 'singleProduct', $product ); ?>>
    <div class="singleProduct-container container">
        <div class="singleProduct__content mobile">
            <div class="singleProduct__breadcrumbs"></div>
            <div class="singleProduct__imagesList">
                <?php if(!empty($attachment_ids) || !empty($post_image)): ?>
                    <?php if(!empty($post_image)): ?>
                        <div class="singleProduct__imagesList__item">
                            <img src="<?php echo $post_image; ?>" alt="">
                        </div>
                    <?php endif; 
                    if(!empty($attachment_ids)):
                        foreach( $attachment_ids as $attachment_id ) {
                            $image_link = wp_get_attachment_url( $attachment_id ); ?>
                            <div class="singleProduct__imagesList__item">
                                <img src="<?php echo $image_link; ?>" alt="">
                            </div>
                        <?php } 
                    endif; ?>
                <?php else: ?>
                    <div class="singleProduct__imagesList__item">
                        <img src="<?php echo wc_placeholder_img_src(); ?>" alt="">
                    </div>
                <?php endif; ?>
            </div>
            <div class="singleProduct__button">
                <div class="singleProduct__buttonLeftCol"><h2 class="sm"><?php the_title(); ?></h2><div class="wishlistIcon"><?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?></div></div>
                <div class="singleProduct__buttonCart productAddTocart<?php if(is_a( $product, 'WC_Product_Variable' )){echo ' variable';} ?>">
                    <?php do_action('woocommerce_product_add_to_cart'); ?>
                </div>
            </div>
            <div class="singleProduct__description__wrapper">
                <?php 
                $attributes = $product->get_attributes();
                if(is_a( $product, 'WC_Product_Variable' )):
                ?>
                <div class="singleProduct__attributesPicker">
                    <?php foreach($attributes as $attribute): 
                        $attributelabel = wc_attribute_label( $attribute['name'] );
                        $results = woocommerce_get_product_terms($product->id, $attribute['name']);
                        if(count($results) > 1):
                        ?>
                            <div class="singleProduct__attributesPicker__item" data-attribute="<?php echo $attribute['name']; ?>">
                                <h2 class="singleProduct__attributesPicker__itemTitle sm"><?php echo $attributelabel; ?></h2>
                                <div class="singleProduct__attributesPicker__itemPopup">
                                    <div class="singleProduct__attributesPicker__itemPopup__close"></div>
                                    <h4 class="singleProduct__attributesPicker__itemPopup__title"><?php _e('Select ', 'woocommerce_custom_text'); ?><?php echo $attributelabel; ?></h4>
                                    <div class="singleProduct__attributesPicker__itemPopup__list">
                                        <?php foreach($results as $result): ?>
                                            <div class="singleProduct__attributesPicker__itemPopup__listItem">
                                                <h4 class="singleProduct__attributesPicker__itemPopup__listItem__title lg" data-item="<?php echo $result->slug; ?>"><?php echo $result->name; ?></h4>
                                            </div>
                                        <?php endforeach;?>
                                    </div>
                                    <div class="singleProduct__attributesPicker__itemPopup__content">
                                        <?php if($attribute['name'] == 'pa_size'): ?>
                                            <?php 
                                                $popup_title = get_field('size_guide_title', 'options');
                                                $size_choosing_text = get_field('size_choosing_text', 'options');
                                            ?>
                                            <div class="singleProduct__attributesPicker__itemPopup__guide">
                                                <?php if($popup_title): ?>
                                                    <div class="singleProduct__attributesPicker__itemPopup__guideLabel popup-toggle"><?php echo $popup_title; ?></div>
                                                <?php endif; ?>
                                                <?php if($popup_title || have_rows('size_table_row')): ?>
                                                    <div class="singleProduct__attributesPicker__itemPopup__guidePopup">
                                                        <?php if($popup_title): ?>
                                                            <h4 class="singleProduct__attributesPicker__itemPopup__guidePopup__title"><?php echo $popup_title; ?></h4>
                                                        <?php endif; ?>
                                                        <?php if(have_rows('size_table_row', 'options')): ?>
                                                            <div class="singleProduct__attributesPicker__itemPopup__guidePopup__content">
                                                                <table>
                                                                    <?php while(have_rows('size_table_row', 'options')): the_row(); ?>
                                                                        <?php if(have_rows('items')): ?>
                                                                            <tr>
                                                                                <?php while(have_rows('items')): the_row(); ?>
                                                                                    <?php 
                                                                                        $item_label = get_sub_field('item_label'); 
                                                                                    ?>
                                                                                        <td><?php echo $item_label; ?></td>
                                                                                <?php endwhile; ?>
                                                                            </tr>
                                                                        <?php endif; ?>
                                                                    <?php endwhile; ?>
                                                                </table>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="singleProduct__attributesPicker__itemPopup__guideBg popup-toggle"></div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($size_choosing_text): ?>
                                            <div class="singleProduct__attributesPicker__itemPopup__text woocommerce-text lh-sm">
                                                <?php echo $size_choosing_text; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <div class="singleProduct__description">
                    <div class="attributesItem__list">
                        <?php 
                        foreach($attributes as $attribute):
                            $attributelabel = wc_attribute_label( $attribute['name'] );
                            $results = woocommerce_get_product_terms($product->id, $attribute['name'], 'names'); ?>
                            <div class="attributesItem">
                                <div class="attributesItem__label"><?php echo $attributelabel . ': '; ?></div>
                                <div class="attributesItem__options">
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
                        <?php endforeach;?>
                    </div>
                    <div class="singleProduct__descriptionText woocommerce-text"><?php the_content(); ?></div>
                </div>
                <div class="showContent">
                    <div class="more showContentBtn"><?php _e('See more +', 'woocommerce_custom_text'); ?></div>
                    <div class="less showContentBtn"><?php _e('See less -', 'woocommerce_custom_text'); ?></div>
                </div>
            </div>
            
            <?php if(have_rows('features')): ?>
                <div class="singleProduct__features">
                    <?php while(have_rows('features')): the_row(); ?>
                        <?php 
                        $icon = get_sub_field('icon');
                        $text = get_sub_field('text');
                        ?>
                        <div class="singleProduct__featuresItem">
                            <?php if($icon): ?>
                                <div class="singleProduct__featuresItem__icon"><img src="<?php echo $icon; ?>"></div>
                            <?php endif; ?>
                            <?php if($text): ?>
                                <div class="singleProduct__featuresItem__title"><?php echo $text; ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <?php if(have_rows('info_tabs')): ?>
                <div class="singleProduct__infoTabs__list">
                    <?php while(have_rows('info_tabs')): the_row(); ?>
                        <?php 
                        $title = get_sub_field('tab_title');
                        $image = get_sub_field('tab_image');
                        $text = get_sub_field('tab_text');
                        if($title): ?>
                            <div class="singleProduct__infoTab__wrapper">
                                <div class="singleProduct__infoTab">
                                    <div class="singleProduct__infoTab__title"><?php echo $title; ?></div>
                                </div>
                                <div class="singleProduct__infoTab__popup">
                                    <div class="singleProduct__infoTab__popupClose"></div>
                                    <h5 class="singleProduct__infoTab__popupTitle"><?php echo $title; ?></h5>
                                    <?php if($text): ?>
                                        <div class="singleProduct__infoTab__popupText woocommerce-text"><?php echo $text; ?></div>
                                    <?php endif; ?>
                                    <?php if($image): ?>
                                        <div class="singleProduct__infoTab__popupImage"><img src="<?php echo $image; ?>"></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="singleProduct__content desktop">
            <div class="singleProduct__leftCol">
                <div class="singleProduct__top">
                    <h2 class="singleProduct__title desktop-md"><?php the_title(); ?></h2>
                    <h2 class="singleProduct__price desktop-md"><?php do_action('woocommerce_product_price'); ?></h2>
                    <h2 class="singleProduct__wishlist desktop-md"><?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?></h2>
                </div>
                <div class="singleProduct__description__wrapper">
                    <div class="singleProduct__description">
                        <div class="attributesItem__list woocommerce-text">
                            <?php 
                            foreach($attributes as $attribute):
                                $attributelabel = wc_attribute_label( $attribute['name'] );
                                $results = woocommerce_get_product_terms($product->id, $attribute['name'], 'names'); ?>
                                <div class="attributesItem">
                                    <div class="attributesItem__label"><?php echo $attributelabel . ': '; ?></div>
                                    <div class="attributesItem__options">
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
                            <?php endforeach;?>
                        </div>
                        <div class="singleProduct__descriptionText woocommerce-text"><?php the_content(); ?></div>
                    </div>
                    <div class="showContent">
                        <div class="more showContentBtn woocommerce-text"><?php _e('See more +', 'woocommerce_custom_text'); ?></div>
                        <div class="less showContentBtn woocommerce-text"><?php _e('See less -', 'woocommerce_custom_text'); ?></div>
                    </div>
                </div>
                <?php if(have_rows('features')): ?>
                    <div class="singleProduct__features">
                        <?php while(have_rows('features')): the_row(); ?>
                            <?php 
                            $icon = get_sub_field('icon');
                            $text = get_sub_field('text');
                            ?>
                            <div class="singleProduct__featuresItem">
                                <?php if($icon): ?>
                                    <div class="singleProduct__featuresItem__icon"><img src="<?php echo $icon; ?>"></div>
                                <?php endif; ?>
                                <?php if($text): ?>
                                    <div class="singleProduct__featuresItem__title woocommerce-text"><?php echo $text; ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="singleProduct__imagesWrapper">
                <div class="singleProduct__mainSlider">
                    <?php if(!empty($attachment_ids) || !empty($post_image)): ?>
                        <?php if(!empty($post_image)): ?>
                            <div class="singleProduct__mainSlider__itemWrapper">
                                <div class="singleProduct__mainSlider__item">
                                    <img src="<?php echo $post_image; ?>" alt="">
                                </div>
                            </div>
                        <?php endif; 
                        if(!empty($attachment_ids)):
                            foreach( $attachment_ids as $attachment_id ) {
                                $image_link = wp_get_attachment_url( $attachment_id ); ?>
                                <div class="singleProduct__mainSlider__itemWrapper">
                                    <div class="singleProduct__mainSlider__item">
                                        <img src="<?php echo $image_link; ?>" alt="">
                                    </div>
                                </div>
                            <?php } 
                        endif; ?>
                    <?php else: ?>
                        <div class="singleProduct__mainSlider__itemWrapper">
                            <div class="singleProduct__mainSlider__item">
                                <img src="<?php echo wc_placeholder_img_src(); ?>" alt="">
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="singleProduct__sideSlider">
                <?php if(!empty($attachment_ids) || !empty($post_image)): ?>
                        <?php if(!empty($post_image)): ?>
                            <div class="singleProduct__sideSlider__itemWrapper">
                                <div class="singleProduct__sideSlider__item">
                                    <img src="<?php echo $post_image; ?>" alt="">
                                </div>
                            </div>
                        <?php endif; 
                        if(!empty($attachment_ids)):
                            foreach( $attachment_ids as $attachment_id ) {
                                $image_link = wp_get_attachment_url( $attachment_id ); ?>
                                <div class="singleProduct__sideSlider__itemWrapper">
                                    <div class="singleProduct__sideSlider__item">
                                        <img src="<?php echo $image_link; ?>" alt="">
                                    </div>
                                </div>
                            <?php } 
                        endif; ?>
                    <?php else: ?>
                        <div class="singleProduct__sideSlider__itemWrapper">
                            <div class="singleProduct__sideSlider__item">
                                <img src="<?php echo wc_placeholder_img_src(); ?>" alt="">
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="singleProduct__rightCol">
                <?php if(have_rows('info_tabs')): ?>
                    <div class="singleProduct__infoTabs__list">
                        <?php while(have_rows('info_tabs')): the_row(); ?>
                            <?php 
                            $title = get_sub_field('tab_title');
                            $image = get_sub_field('tab_image');
                            $text = get_sub_field('tab_text');
                            if($title): ?>
                                <div class="singleProduct__infoTab__wrapper">
                                    <div class="singleProduct__infoTab">
                                        <div class="singleProduct__infoTab__title woocommerce-text"><?php echo $title; ?></div>
                                    </div>
                                    <div class="singleProduct__infoTab__popup">
                                        <div class="singleProduct__infoTab__popupClose"></div>
                                        <h5 class="singleProduct__infoTab__popupTitle desktop-lg"><?php echo $title; ?></h5>
                                        <?php if($text): ?>
                                            <div class="singleProduct__infoTab__popupText woocommerce-text"><?php echo $text; ?></div>
                                        <?php endif; ?>
                                        <?php if($image): ?>
                                            <div class="singleProduct__infoTab__popupImage"><img src="<?php echo $image; ?>"></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="singleProduct__infoTab__popupOverlay"></div>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <div class="singleProduct__buttons">
                    <?php 
                        $attributes = $product->get_attributes();
                        if(is_a( $product, 'WC_Product_Variable' )):
                        ?>
                        <div class="singleProduct__attributesPicker">
                            <?php foreach($attributes as $attribute): 
                                $attributelabel = wc_attribute_label( $attribute['name'] );
                                $results = woocommerce_get_product_terms($product->id, $attribute['name']);
                                if(count($results) > 1):
                                ?>
                                    <div class="singleProduct__attributesPicker__item" data-attribute="<?php echo $attribute['name']; ?>">
                                        <h5 class="singleProduct__attributesPicker__itemTitle desktop-md"><?php echo $attributelabel; ?></h5>
                                        <div class="singleProduct__attributesPicker__itemPopup">
                                            <div class="singleProduct__attributesPicker__itemPopup__close"></div>
                                            <h4 class="singleProduct__attributesPicker__itemPopup__title"><?php _e('Select ', 'woocommerce_custom_text'); ?><?php echo $attributelabel; ?></h4>
                                            <div class="singleProduct__attributesPicker__itemPopup__list">
                                                <?php foreach($results as $result): ?>
                                                    <div class="singleProduct__attributesPicker__itemPopup__listItem">
                                                        <h4 class="singleProduct__attributesPicker__itemPopup__listItem__title lg" data-item="<?php echo $result->slug; ?>"><?php echo $result->name; ?></h4>
                                                    </div>
                                                <?php endforeach;?>
                                            </div>
                                            <div class="singleProduct__attributesPicker__itemPopup__content">
                                                <?php if($attribute['name'] == 'pa_size'): ?>
                                                    <?php 
                                                        $popup_title = get_field('size_guide_title', 'options');
                                                        $size_choosing_text = get_field('size_choosing_text', 'options');
                                                    ?>
                                                    <div class="singleProduct__attributesPicker__itemPopup__guide">
                                                        <?php if($popup_title): ?>
                                                            <div class="singleProduct__attributesPicker__itemPopup__guideLabel popup-toggle woocommerce-text desktop-xs"><?php echo $popup_title; ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if($size_choosing_text): ?>
                                                    <div class="singleProduct__attributesPicker__itemPopup__text woocommerce-text lh-sm desktop-xs">
                                                        <?php echo $size_choosing_text; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="singleProduct__buttonCart productAddTocart<?php if(is_a( $product, 'WC_Product_Variable' )){echo ' variable';} ?>">
                        <?php do_action('woocommerce_product_add_to_cart'); ?>
                    </div>
                </div>
                <div class="singleProduct__attributesPicker__itemPopup__guide">
                    <?php if($popup_title || have_rows('size_table_row')): ?>
                        <div class="singleProduct__attributesPicker__itemPopup__guidePopup">
                            <?php if($popup_title): ?>
                                <h4 class="singleProduct__attributesPicker__itemPopup__guidePopup__title desktop-lg"><?php echo $popup_title; ?></h4>
                            <?php endif; ?>
                            <?php if(have_rows('size_table_row', 'options')): ?>
                                <div class="singleProduct__attributesPicker__itemPopup__guidePopup__content">
                                    <table>
                                        <?php while(have_rows('size_table_row', 'options')): the_row(); ?>
                                            <?php if(have_rows('items')): ?>
                                                <tr>
                                                    <?php while(have_rows('items')): the_row(); ?>
                                                        <?php 
                                                            $item_label = get_sub_field('item_label'); 
                                                        ?>
                                                            <td><?php echo $item_label; ?></td>
                                                    <?php endwhile; ?>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="singleProduct__attributesPicker__itemPopup__guideBg popup-toggle"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if($products): ?>
<section class="productCompleteLook singleProductCardsList__wrapper">
    <div class="singleProduct-container container">
        <?php if($products_list_title): ?>
            <div class="productCompleteLook__title singleProductCardsList__title"><?php echo $products_list_title; ?></div>
        <?php endif; ?>
        <div class="productCompleteLook__list singleProductCardsList">
            <?php foreach($products as $post): setup_postdata( $post ); ?>
                <a href="<?php the_permalink(); ?>" class="productCompleteLook__cardWrapper singleProductCard__wrapper">
                    <div class="productCompleteLook__card singleProductCard">
                    <?php if(!empty(get_the_post_thumbnail_url(  ))):
                            $image = get_the_post_thumbnail_url(  );
                        else:
                            $image = wc_placeholder_img_src();
                        endif; ?>
                        <div class="productCompleteLook__cardImage singleProductCard__image"><img src="<?php echo $image; ?>" alt=""></div>
                        <h5 class="productCompleteLook__cardTitle singleProductCard__title"><?php the_title(); ?></h5>
                        <h5 class="productCompleteLook__cardPrice singleProductCard__price"><?php do_action('woocommerce_product_price'); ?></h5>
                    </div>
                </a>
            <?php endforeach; wp_reset_postdata(  ); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php 
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 3,
    'post__not_in' => array (get_the_ID()),
);
$mobile_query = new WP_Query($args);
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 6,
    'post__not_in' => array (get_the_ID()),
);
$desktop_query = new WP_Query($args);
if($mobile_query->have_posts() || $desktop_query->have_posts()):
?>
<section class="relatedProducts singleProductCardsList__wrapper">
    <div class="singleProduct-container container">
        <?php if($products_slider_title): ?>
            <div class="relatedProducts__title singleProductCardsList__title"><?php echo $products_slider_title; ?></div>
        <?php endif; ?>
        <div class="relatedProducts__list singleProductCardsList mobile">
            <?php while($mobile_query->have_posts()): $mobile_query->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="relatedProducts__cardWrapper singleProductCard__wrapper">
                    <div class="relatedProducts__card singleProductCard">
                        <?php if(!empty(get_the_post_thumbnail_url(  ))):
                            $image = get_the_post_thumbnail_url(  );
                        else:
                            $image = wc_placeholder_img_src();
                        endif; ?>
                        <div class="relatedProducts__image singleProductCard__image"><img src="<?php echo $image; ?>" alt=""></div>
                        <h5 class="relatedProducts__title singleProductCard__title"><?php the_title(); ?></h5>
                    </div>
                    </a>
            <?php endwhile; ?>
        </div>
        <div class="relatedProducts__list singleProductCardsList desktop">
            <?php while($desktop_query->have_posts()): $desktop_query->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="relatedProducts__cardWrapper singleProductCard__wrapper">
                    <div class="relatedProducts__card singleProductCard">
                        <?php if(!empty(get_the_post_thumbnail_url(  ))):
                            $image = get_the_post_thumbnail_url(  );
                        else:
                            $image = wc_placeholder_img_src();
                        endif; ?>
                        <div class="relatedProducts__image singleProductCard__image"><img src="<?php echo $image; ?>" alt=""></div>
                        <h5 class="relatedProducts__title singleProductCard__title"><?php the_title(); ?></h5>
                        <h5 class="relatedProducts__price singleProductCard__price"><?php do_action('woocommerce_product_price'); ?></h5>
                    </div>
                    </a>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>