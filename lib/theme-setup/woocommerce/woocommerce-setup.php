<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Print an inline script to the footer to keep products the same height
add_action( 'wp_enqueue_scripts', function () {
	// If WooCommerce isn't installed, exit early.
	if ( ! class_exists( 'WooCommerce' ) || ! is_shop() && ! is_product_category() && ! is_product_tag() ) {
		return;
	}
	wp_add_inline_script( 'g_starter-match-height', "jQuery(document).ready( function() { jQuery( '.product .woocommerce-LoopProduct-link').matchHeight(); });" );
}, 99 );

// ** Modify the WooCommerce breakpoints
add_filter( 'woocommerce_style_smallscreen_breakpoint', function () {
	$current = genesis_site_layout();
	$layouts = [
		'one-sidebar' => [
			'content-sidebar',
			'sidebar-content',
		],
		'two-sidebar' => [
			'content-sidebar-sidebar',
			'sidebar-content-sidebar',
			'sidebar-sidebar-content',
		],
	];

	if ( in_array( $current, $layouts['two-sidebar'] ) ) {
		return '2000px'; // Show mobile styles immediately.
	}
	elseif ( in_array( $current, $layouts['one-sidebar'] ) ) {
		return '1200px';
	}
	else {
		return '860px';
	}
});

// ** Set the shop default products per page count
add_filter( 'genesiswooc_default_products_per_page', function ( $count ) {
	return 8;
});

// ** Update the next and previous arrows to the default Genesis style
add_filter( 'woocommerce_pagination_args', function ( $args ) {
	$args['prev_text'] = sprintf( '&laquo; %s', __( 'Previous Page', CHILD_THEME_TEXT_DOMAIN ) );
	$args['next_text'] = sprintf( '%s &raquo;', __( 'Next Page', CHILD_THEME_TEXT_DOMAIN ) );
	return $args;
});


// ** Define WooCommerce image sizes on theme activation
add_action( 'after_switch_theme', function () {
	global $pagenow;
	// Conditional check to see if we're activating the current theme and that WooCommerce is installed
	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' || ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	g_starter_update_woocommerce_image_dimensions();
}, 1 );


// ** Define WooCommerce image sizes on activation of the WooCommerce plugin
add_action( 'activated_plugin', function ( $plugin ) {
	// Conditional check to see if we're activating WooCommerce
	if ( $plugin !== 'woocommerce/woocommerce.php' ) {
		return;
	}
	g_starter_update_woocommerce_image_dimensions();
}, 10, 2 );

// ** Update the WooCommerce image dimensions
function g_starter_update_woocommerce_image_dimensions() {
	$catalog = [
		'width'  => '550', // px
		'height' => '550', // px
		'crop'   => 1,     // true
	] ;
	$single = [
		'width'  => '750', // px
		'height' => '750', // px
		'crop'   => 1,     // true
	] ;
	$thumbnail = [
		'width'  => '180', // px
		'height' => '180', // px
		'crop'   => 1,     // true
	] ;

	// Image sizes

	// Product category thumbs
	update_option( 'shop_catalog_image_size', $catalog ); 

	// Single product image   
	update_option( 'shop_single_image_size', $single ); 

	// Image gallery thumbs     
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 
}