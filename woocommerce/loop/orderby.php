<?php 
    $product_colors = get_terms(array(
        'taxonomy' => 'pa_color',
        'hide_empty' => false,
    ));
    $product_sizes = get_terms(array(
        'taxonomy' => 'pa_size',
        'hide_empty' => false,
    ));
?>
<?php 
if(is_product_category()){
    $queried_object = get_queried_object(); 
    $slug = $queried_object->slug;   
}
?>
<h4 class="catalog__filter"><?php _e('Filters', 'woocommerce_custom_text'); ?></h4>
<div class="catalog__filtersMenu">
    <div class="catalog__filtersClose"></div>
    <h4 class="catalog__filtersMenu__title"><?php _e('Filters', 'woocommerce_custom_text'); ?></h4>
    <div class="catalog__filtersList">
        <div class="catalog__filtersList__attribute sort">
            <h4 class="catalog__filtersList__attributeLabel"><?php _e('Sort by', 'woocommerce_custom_text'); ?></h4>
            <div class="catalog__filtersList__attributeSublist__overlay"></div>
            <div class="catalog__filtersList__attributeSublist">
                <div class="catalog__filtersList__attributeSublist__close"></div>
                <h4 class="catalog__filtersList__attributeLabel"><?php _e('Sort by', 'woocommerce_custom_text'); ?></h4>
                <div class="catalog__filtersList__attributeList">
                    <div class="catalog__filtersList__attributeColumn">
                        <div class="catalog__filtersList__attributeItem">
                            <div class="catalog__filtersList__attributeItem__checkbox"></div>
                            <h4 class="catalog__filtersList__attributeItem__name desktop-md lg" data-slug="price-desc"><?php _e('Descending Price', 'woocommerce_custom_text'); ?></h4>
                        </div>
                        <div class="catalog__filtersList__attributeItem">
                            <div class="catalog__filtersList__attributeItem__checkbox"></div>
                            <h4 class="catalog__filtersList__attributeItem__name desktop-md lg" data-slug="price"><?php _e('Ascending Price', 'woocommerce_custom_text'); ?></h4>
                        </div>
                        <div class="catalog__filtersList__attributeItem">
                            <div class="catalog__filtersList__attributeItem__checkbox"></div>
                            <h4 class="catalog__filtersList__attributeItem__name desktop-md lg" data-slug="availability"><?php _e('Availability', 'woocommerce_custom_text'); ?></h4>
                        </div>
                        <div class="catalog__filtersList__attributeItem">
                            <div class="catalog__filtersList__attributeItem__checkbox"></div>
                            <h4 class="catalog__filtersList__attributeItem__name desktop-md lg" data-slug="date"><?php _e('Most recent', 'woocommerce_custom_text'); ?></h4>
                        </div>
                    </div>
                </div>
                <h4 class="catalog__filtersList__attributeItem__apply button button--black sm"><?php _e('APPLY', 'woocommerce_custom_text'); ?></h4>
            </div>
        </div>
        <div class="catalog__filtersList__attribute colors">
            <h4 class="catalog__filtersList__attributeLabel"><?php _e('Colors', 'woocommerce_custom_text'); ?></h4>
            <div class="catalog__filtersList__attributeSublist__overlay"></div>
            <div class="catalog__filtersList__attributeSublist">
                <div class="catalog__filtersList__attributeSublist__close"></div>
                <h4 class="catalog__filtersList__attributeLabel"><?php _e('Colors', 'woocommerce_custom_text'); ?></h4>
                <div class="catalog__filtersList__attributeList">
                    <div class="catalog__filtersList__attributeColumn">
                        <?php $i = 1; foreach($product_colors as $color): ?>
                            <?php $colorHex = get_field('color', 'pa_color_' . $color->term_id); ?>
                            <div class="catalog__filtersList__attributeItem">
                                <?php if($colorHex): ?>
                                    <div class="catalog__filtersList__attributeItem__box <?php echo $color->slug; ?>" style="background-color: <?php echo $colorHex; ?>"></div>
                                <?php endif; ?>
                                <h4 class="catalog__filtersList__attributeItem__name desktop-md lg" data-slug="<?php echo $color->slug; ?>"><?php echo $color->name; ?></h4>
                            </div>
                            <?php if($i % 8 == 0): ?>
                                </div>
                                <div class="catalog__filtersList__attributeColumn">
                            <?php endif; ?>
                        <?php $i++; endforeach; ?>
                    </div>
                </div>
                <h4 class="catalog__filtersList__attributeItem__apply button button--black sm"><?php _e('APPLY', 'woocommerce_custom_text'); ?></h4>
            </div>
        </div>
        <?php if($slug != 'home'): ?>
            <div class="catalog__filtersList__attribute size">
                <h4 class="catalog__filtersList__attributeLabel"><?php _e('Size', 'woocommerce_custom_text'); ?></h4>
                <div class="catalog__filtersList__attributeSublist__overlay"></div>
                <div class="catalog__filtersList__attributeSublist">
                    <div class="catalog__filtersList__attributeSublist__close"></div>
                    <h4 class="catalog__filtersList__attributeLabel"><?php _e('Size', 'woocommerce_custom_text'); ?></h4>
                    <div class="catalog__filtersList__attributeList">
                        <div class="catalog__filtersList__attributeColumn">
                            <?php $i = 1; foreach($product_sizes as $size): ?>
                                <div class="catalog__filtersList__attributeItem">
                                    <div class="catalog__filtersList__attributeItem__checkbox"></div>
                                    <h4 class="catalog__filtersList__attributeItem__name desktop-md lg" data-slug="<?php echo $size->slug; ?>"><?php echo $size->name ?></h4>
                                </div>
                            <?php $i++; endforeach; ?>
                            </div>
                        </div>
                    <h4 class="catalog__filtersList__attributeItem__apply button button--black sm"><?php _e('APPLY', 'woocommerce_custom_text'); ?></h4>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>