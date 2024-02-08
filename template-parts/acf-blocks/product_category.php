<?php
    $categories = get_sub_field('categories');
    $paddingTop = get_sub_field('paddingTop');
    $paddingBottom = get_sub_field('paddingBottom');
    $paddingTop_mobile = get_sub_field('paddingTop_mobile');
    $paddingBottom_mobile = get_sub_field('paddingBottom_mobile');
    
    $is_not_first = false;
?>

<?php if ($categories) : ?>
    <div class="section productCategory pt-<?php echo $paddingTop_mobile ?> pb-<?php echo $paddingBottom_mobile ?> pt-md-<?php echo $paddingTop ?> pb-md-<?php echo $paddingBottom ?>">
        <div class="container container--full">
            <ul class="productCategory__list">
                <?php foreach ($categories as $category) : ?>
                    <?php
                    $taxonomy = 'product_cat';
                    
                    $link = get_term_link($category);
                    
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'full');
                    
                    $layout = get_field('layout', $taxonomy . '_' . $category->term_id);
                    
                    $image_mob = get_field('image_mobile', $taxonomy . '_' . $category->term_id);
                    $image_desk_1 = get_field('image_desktop_1', $taxonomy . '_' . $category->term_id);
                    $image_desk_2 = get_field('image_desktop_2', $taxonomy . '_' . $category->term_id);
                    ?>
                    
                    <?php if ($image_mob || ($image_desk_1 || $image_desk_2)) : ?>
                        <li class="productCategory__item <?php echo $layout === 'full_width' ? 'full--width' : 'half--width';?>">
                            <a href="<?php echo $link; ?>">
                                <div class="productCategory__item-wrap d-flex">
                                    <?php if ($image_mob) : ?>
                                        <img src="<?php echo $image_mob['url']; ?>"
                                             alt="<?php echo $image_mob['alt'] ?: $image_mob['title']; ?>"
                                             class="productCategory__item-img image--mob">
                                    <?php endif; ?>
                                    <?php if ($image_desk_1) : ?>
                                        <img src="<?php echo $image_desk_1['url']; ?>"
                                             alt="<?php echo $image_desk_1['alt'] ?: $image_desk_1['title']; ?>"
                                             class="productCategory__item-img image--desk">
                                    <?php endif; ?>
                                    <?php if($image_desk_2) :?>
                                        <img src="<?php echo $image_desk_2['url']; ?>"
                                             alt="<?php echo $image_desk_2['alt'] ?: $image_desk_2['title']; ?>"
                                             class="productCategory__item-img image--desk">
                                    <?php endif; ?>
                                    <div class="productCategory__item-btn">
                                        <span><?php _e('Shop ' . $category->name); ?></span>
                                        <?php if ($is_not_first) : ?>
                                            <?php echo file_get_contents(get_template_directory_uri() . '/assets/images/product_arrow_icon.svg'); ?>
                                        <?php else : ?>
                                            <?php $is_not_first = true; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php elseif ($thumbnail_url) : ?>
                        <li class="productCategory__item">
                            <a href="<?php echo $link; ?>">
                                <div class="productCategory__item-wrap d-flex">
                                    <img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $category->name; ?>"
                                         class="productCategory__item-img">
                                    <div class="productCategory__item-btn">
                                        <span><?php _e('Shop ' . $category->name); ?></span>
                                        <?php if ($is_not_first) : ?>
                                            <?php echo file_get_contents(get_template_directory_uri() . '/assets/images/product_arrow_icon.svg'); ?>
                                        <?php else : ?>
                                            <?php $is_not_first = true; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
