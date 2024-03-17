<?php 
add_action('wp_ajax_nopriv_products_filter', 'products_filter');
add_action('wp_ajax_products_filter', 'products_filter');
function products_filter() {
    $colors = '';
    $sizes = '';
    $sort = '';
    $category = '';
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'meta_query' => array(),
        'tax_query' => array(),
    );
    if(!empty($_POST['colors'])){
        $colors = $_POST['colors'];
    }
    if(!empty($_POST['sizes'])){
        $sizes = $_POST['sizes'];
    }
    if(!empty($_POST['sort'])){
        $sort = $_POST['sort'];
    }
    if(!empty($_POST['category'])){
        $category = $_POST['category'];
    }

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

    if(!empty($category)){
        $categories_sort = array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $category,
        );
        array_push($args['tax_query'], $categories_sort);
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


add_action('wp_ajax_nopriv_product_categories', 'product_categories');
add_action('wp_ajax_product_categories', 'product_categories');
function product_categories() {
    $sort = '';
    $slug = '';
    $colors = '';
    $sizes = '';

    if(!empty($_POST['order'])){
        $sort = $_POST['order'];
    }
    if(!empty($_POST['size'])){
        $sizes = explode(',', $_POST['size']);
    }
    if(!empty($_POST['color'])){
        $colors = explode(',', $_POST['color']);
    }
    if(!empty($_POST['slug'])){
        $slug = $_POST['slug'];
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => array(),
        'meta_query' => array(),
    );

    if(!empty($slug)){
        $categories_sort = array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $slug,
        );
        array_push($args['tax_query'], $categories_sort);
    }

    if(!empty($colors)){
        $colors_array = array(
            'taxonomy' => 'pa_color',
            'field' => 'slug',
            'terms' => $colors,
        );
        array_push($args["tax_query"], $colors_array);
    }
    if(!empty($sizes)){
        $sizes_array = array(
            'taxonomy' => 'pa_size',
            'field' => 'slug',
            'terms' => $sizes,
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