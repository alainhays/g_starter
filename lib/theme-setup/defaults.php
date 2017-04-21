<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Updates theme settings on reset
add_filter( 'genesis_theme_settings_defaults', function ( $defaults ) {
	$defaults['blog_cat_num']              = 6;
	$defaults['content_archive']           = 'full';
	$defaults['content_archive_limit']     = 0;
	$defaults['content_archive_thumbnail'] = 0;
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'content-sidebar';
	return $defaults;
});

// ** Updates theme settings on activation
add_action( 'after_switch_theme', function () {
	if ( function_exists( 'genesis_update_settings' ) ) {
		genesis_update_settings( [
			'blog_cat_num'              => 6,
			'content_archive'           => 'full',
			'content_archive_limit'     => 0,
			'content_archive_thumbnail' => 0,
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'content-sidebar',
		] );
	} 
	update_option( 'posts_per_page', 6 );
});

// ** Updates Simple Social Icon settings on activation
add_filter( 'simple_social_default_styles', function ( $defaults ) {
	$args = [
		'alignment'              => 'alignleft',
		'background_color'       => '#f5f5f5',
		'background_color_hover' => '#000000',
		'border_color'           => '#ffffff',
		'border_color_hover'     => '#ffffff',
		'border_radius'          => 3,
		'border_width'           => 0,
		'icon_color'             => '#000000',
		'icon_color_hover'       => '#ffffff',
		'size'                   => 36,
		];
	$args = wp_parse_args( $args, $defaults );
	return $args;
});