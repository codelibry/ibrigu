<?php
/*
	=====================
		Custom Post Types
	=====================	
*/



function cptui_register_my_cpts_testimonial() {

	/**
	 * Post Type: Testimonials.
	 */

	$labels = [
		"name" => __( "Testimonials", "'ikon'" ),
		"singular_name" => __( "Testimonial", "'ikon'" ),
	];

	$args = [
		"label" => __( "Testimonials", "'ikon'" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "testimonial", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-format-chat",
		"supports" => [ "title" ],
		"show_in_graphql" => false,
	];

	register_post_type( "testimonial", $args );
}

add_action( 'init', 'cptui_register_my_cpts_testimonial' );


add_action( 'init', 'register_post_types' );
function register_post_types(){
	register_post_type( 'collections', [
		'label'  => null,
		'labels' => [
			'name'               => 'Collections', 
			'singular_name'      => 'Collection', 
			'add_new'            => 'Add Collection', 
			'add_new_item'       => 'Collection adding', 
			'edit_item'          => 'Collection editing', 
			'new_item'           => 'New  Collection', 
			'view_item'          => 'Collection',
			'search_items'       => 'Search Collection', 
			'not_found'          => 'Not found', 
			'not_found_in_trash' => 'Not found in trash',
			'parent_item_colon'  => '', 
			'menu_name'          => 'Collections', 
		],
		'description'         => '',
		'public'              => true,
		'show_in_menu'        => true, 
		'show_in_rest'        => true,
		'rest_base'           => null, 
		'menu_position'       => null,
		'menu_icon'           => null,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );
	register_post_type( 'stories', [
		'label'  => null,
		'labels' => [
			'name'               => 'Stories', 
			'singular_name'      => 'Story', 
			'add_new'            => 'Add Story', 
			'add_new_item'       => 'Story adding', 
			'edit_item'          => 'Story editing', 
			'new_item'           => 'New  Story', 
			'view_item'          => 'Story',
			'search_items'       => 'Search Story', 
			'not_found'          => 'Not found', 
			'not_found_in_trash' => 'Not found in trash',
			'parent_item_colon'  => '', 
			'menu_name'          => 'Stories', 
		],
		'description'         => '',
		'public'              => true,
		'show_in_menu'        => true, 
		'show_in_rest'        => true,
		'rest_base'           => null, 
		'menu_position'       => null,
		'menu_icon'           => null,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}