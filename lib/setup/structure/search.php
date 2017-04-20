<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Customize the search form input box text
add_filter( 'genesis_search_text', function () {
	return esc_attr( __( 'Search Text Goes Here...', CHILD_THEME_TEXT_DOMAIN ) );
});

// ** Customize the search form input button text
add_filter( 'genesis_search_button_text', function ( $text ) {
	return esc_attr( __( 'Click Here...', CHILD_THEME_TEXT_DOMAIN ) );
});

// ** Redirect to the result itself, if only one search result is returned
// See: http://www.developerdrive.com/2013/07/5-quick-and-easy-tricks-to-improve-your-wordpress-theme/
add_action( 'template_redirect', function () {
	if( is_search() ) {
		global $wp_query;
		if( $wp_query->post_count === 1) {
			wp_safe_redirect( get_permalink( $wp_query->posts['0']->ID ) );
		}
	}
});

// ** Limit searching to just posts, excluding pages and CPTs
// See: http://www.mhsiung.com/2009/11/limit-wordpress-search-scope-to-blog-posts/
// Disabled by default (uncoment the line below to activate)
//add_action( 'pre_get_posts', 'g_starter_search_only_post' );
function g_starter_search_only_post ( $query ) {
	if( is_admin() )
		return;
	if( $query->is_search ) {
		$query->set( 'post_type', 'post' );
	}
}