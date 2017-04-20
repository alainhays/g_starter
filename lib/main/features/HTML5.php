<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Enable HTML5 markup support
add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

// ** Remove unnecessary role attributes
// See: https://www.sitepoint.com/avoiding-redundancy-wai-aria-html-pages/
add_filter( 'genesis_attr_search-form', 'g_starter_unset_role_attribute' );
add_filter( 'genesis_attr_sidebar-primary', 'g_starter_unset_role_attribute' );

function g_starter_unset_role_attribute( $attributes ) {
	if( isset($attributes['role']) )
		unset($attributes['role']);
	return $attributes;
}
