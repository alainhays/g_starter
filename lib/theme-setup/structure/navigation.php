<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Define our responsive menu settings
function g_starter_responsive_menu_settings() {
	$settings = [
		'mainMenu'          => __( 'Menu', CHILD_THEME_TEXT_DOMAIN  ),
		'menuIconClass'     => 'ionicons-before ion-android-more-horizontal',
		'subMenu'           => __( 'Submenu', CHILD_THEME_TEXT_DOMAIN  ),
		'subMenuIconsClass' => 'ionicons-before ion-chevron-down',
		'menuClasses',
		'menuClasses'       => [
			'combine' => [
				'.nav-primary',
				'.nav-header',
			],
			'others'  => [],
		],
	];
	return $settings;
}

// ** Limit menu depth
add_filter( 'wp_nav_menu_args', function ( $args ) {
	if( !in_array($args['theme_location'], ['primary', 'secondary'], true) )
		return $args;
	$args['depth'] = 2;
	return $args;
});

// ** Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// ** Add arrows to menu items
// Disabled by default (uncomment the line below to activate)
//add_filter( 'walker_nav_menu_start_el', 'g_starter_menu_arrows' , 10, 4 );
function g_starter_menu_arrows ( $item_output, $item, $depth, $args ) {
	if( in_array( 'menu-item-has-children', $item->classes ) ) {
		$arrow = 0 == $depth ? '' : '<i class="ion-chevron-right"></i>';
		$item_output = str_replace( '</a>', $arrow . '</a>', $item_output );
	}
	return $item_output;
}