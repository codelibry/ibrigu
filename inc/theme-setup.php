<?php
/*
=====================
	Theme Setup Function
=====================
*/

function theme_setup(){
	load_theme_textdomain( 'ibrigu', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support('menus');
	add_theme_support( 'woocommerce' );

	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 640;

	//main menu
	register_nav_menus(
		array( 
			'main-menu-mobile' => __( 'Main Menu mobile', 'ibrigu' ),
			'main-menu-desktop-left' => __( 'Main Menu desktop left', 'ibrigu' ),
			'main-menu-desktop-right' => __( 'Main Menu desktop right', 'ibrigu' ),
			'footer-menu-1' => __( 'Footer Menu 1', 'ibrigu'),
			'footer-menu-2' => __( 'Footer Menu 2', 'ibrigu'),
			'footer-menu-3' => __( 'Footer Menu 3', 'ibrigu'),
            'footer-bottom-menu' => __( 'Footer Bottom Menu', 'ibrigu'),  
		)
    );
    
}

add_action( 'after_setup_theme', 'theme_setup' );


add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
    wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/inc/admin/admin-style.css', false, '1.0.0' );
}

function login_enqueue_scripts() {
	wp_enqueue_style( 'login_css', get_template_directory_uri() . '/inc/admin/login-style.css', false, '1.0.0' );
}
add_action('login_head', 'login_enqueue_scripts');