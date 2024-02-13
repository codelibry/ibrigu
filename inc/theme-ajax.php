<?php 
add_action('wp_ajax_nopriv_products_filter', 'products_filter');
add_action('wp_ajax_products_filter', 'products_filter');
function products_filter() {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'meta_query' => array(),
        'tax_query' => array(),
    );
    $colors = $_POST['colors'];
    $sizes = $_POST['sizes'];
    $sort = $_POST['sort'];
    if(!empty($colors)){
        $colors_array = array(
            'taxonomy' => 'pa_color',
            'field' => 'slug',
            'terms' => $colors[0],
        );
        array_push($args["tax_query"], $colors_array);
    }
    if(!empty($sizes)){
        $sizes_array = array(
            'taxonomy' => 'pa_size',
            'field' => 'slug',
            'terms' => $sizes[0],
        );
        array_push($args["tax_query"], $sizes_array);
    }
    if($sort == "availability"){
        $availability = array(
            'key'       => '_stock_status',
            'value'     => 'outofstock',
            'compare'   => 'NOT IN',
        );
        array_push($args["meta_query"], $availability);
    };
    if($sort == "price"){
        $args['orderby'] = 'meta_value_num';
        $args['meta_key'] = '_price';
        $args['order'] = 'ASC';
    };
    if($sort == "price-desc"){
        $args['orderby'] = 'meta_value_num';
        $args['meta_key'] = '_price';
        $args['order'] = 'DESC';
    };
    if($sort == "date"){
        $args['orderby'] = 'publish_date';
        $args['order'] = 'DESC';
    };
    if($_POST['isCategoryPage'] == 'true'){
        $isCategoryPage = array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $_POST['category'],
        );
        array_push($args["tax_query"], $isCategoryPage);
    }
    $the_query = new WP_Query($args);
    if($the_query->have_posts()):
        while($the_query->have_posts()): $the_query->the_post();
            get_template_part( 'woocommerce/content', 'product' );
        endwhile;
    else:
        echo '<h4 class="catalog__listEmpty">Nothing was found...</h4>';
    endif;
    die();
}

add_action('wp_ajax_nopriv_sideCartUpdate', 'sideCartUpdate');
add_action('wp_ajax_sideCartUpdate', 'sideCartUpdate');
function sideCartUpdate() {
    get_template_part('template-parts/block/cart-content');
    die();
}