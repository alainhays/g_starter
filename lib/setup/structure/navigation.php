<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Limit menu depth
add_filter( 'wp_nav_menu_args', function ( $args ) {
	if( !in_array($args['theme_location'], ['primary', 'secondary'], true) )
		return $args;
	$args['depth'] = 4;
	return $args;
});

// ** Remove output of primary navigation right extras
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

// ** Reposition primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// ** Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// ** Add arrows to menu items
add_filter( 'walker_nav_menu_start_el', function ( $item_output, $item, $depth, $args ) {
	if( in_array( 'menu-item-has-children', $item->classes ) ) {
		$arrow = 0 == $depth ? '' : '<i class="ion-chevron-right"></i>';
		$item_output = str_replace( '</a>', $arrow . '</a>', $item_output );
	}
	return $item_output;
}, 10, 4 );

// ** Define our responsive menu settings
function g_starter_responsive_menu_settings() {
	$settings = [		
		'menuIconClass'    => 'ionicons-before ion-android-more-horizontal',	
		'subMenuIconClass' => 'ionicons-before ion-chevron-down',
		'menuClasses'      => [
			'others' => [
				'.nav-primary',
			],
		],
	];
	return $settings;
}