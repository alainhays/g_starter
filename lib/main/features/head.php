<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Add <meta> tags for mobile responsiveness
add_theme_support( 'genesis-responsive-viewport' );

// ** Enable plugins to manage the document title
add_theme_support('title-tag');

// ** Cleanup <head>
remove_action( 'wp_head', 'rsd_link' );	
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link');
// remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// ** Remove WP-API <head> material
// See: https://wordpress.stackexchange.com/questions/211467/remove-json-api-links-in-header-html
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

// ** Overrides the default Genesis doctype with IE and JS identifier classes
// See: http://html5boilerplate.com/
remove_action( 'genesis_doctype', 'genesis_do_doctype' );
add_action( 'genesis_doctype', function () {
	?>
	<!DOCTYPE html>
	<html class="no-js <?php echo is_admin_bar_showing() ? 'admin-bar-showing' : ''; ?>" <?php language_attributes( 'html' ); ?>>
	<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php
});

// ** Prefetch the DNS for external resource domains. Better browser support than preconnect
// See: https://www.igvita.com/2015/08/17/eliminating-roundtrips-with-preconnect/
add_filter( 'wp_resource_hints', function ( $hints, $relation_type ) {
	if( 'dns-prefetch' === $relation_type ) {
		$hints[] = '//ajax.googleapis.com';
		// $hints[] = '//fonts.googleapis.com';
	}
	return $hints;
}, 10, 2 );

// ** Add the AJAX URL as a `data-*` attribute on `<body>`, instead of an inline script, for better CSP compatibility
add_filter( 'genesis_attr_body', function ( $atts ) {
	$atts['data-ajax_url'] = admin_url( 'admin-ajax.php' );
	return $atts;
});

// ** Simple favicon override to specify your favicon's location
// Make sure you have a favicon.ico in assets/images folder before using this function!
// Disabled by default (uncomment the line below to activate)
//add_filter( 'genesis_pre_load_favicon', 'g_starter_simple_favicon' );
function g_starter_simple_favicon () {
	return get_stylesheet_directory_uri() . '/dist/images/favicon.ico';
}

// ** Show the best favicon, within reason
// See: http://www.jonathantneal.com/blog/understand-the-favicon/
// Disabled by default (uncomment the lines below to activate)
//remove_action( 'wp_head', 'genesis_load_favicon' );
//add_action( 'wp_head', 'g_starter_best_favicon' );
	function g_starter_best_favicon() {
		$stylesheet_dir     = get_stylesheet_directory_uri();
		$favicon_path       = $stylesheet_dir . '/dist/images';
		$favicon_build_path = $stylesheet_dir . '/dist/images';

		// Set to false to disable, otherwise set to a hex color
		$color = false;

		// Use a 192px X 192px PNG for the homescreen for Chrome on Android
		echo '<link rel="icon" type="image/png" href="' . $favicon_build_path . '/favicon-192.png" sizes="192x192">';

		// Use a 180px X 180px PNG for the latest iOS devices, also setup app styles
		echo '<link rel="apple-touch-icon" sizes="180x180" href="' . $favicon_build_path . '/favicon-180.png">';

		// Give IE <= 9 the old favicon.ico (16px X 16px)
		echo '<!--[if IE]><link rel="shortcut icon" href="' . $favicon_path . '/favicon.ico"><![endif]-->';

		// Use a 144px X 144px PNG for Windows tablets
		echo '<meta name="msapplication-TileImage" content="' . $favicon_build_path . '/favicon-144.png">';

		if( false !== $color ) {
			// Windows icon background color
			echo '<meta name="msapplication-TileColor" content="' . $color . '">';

			// Chrome for Android taskbar color
			echo '<meta name="theme-color" content="' . $color . '">';

			// Safari 9 pinned tab color
			echo '<link rel="mask-icon" href="' . $favicon_build_path . '/favicon.svg" color="' . $color . '">';
		}
}

// ** Add a defer attribute to the designated <script> tags
// See: http://calendar.perfplanet.com/2016/prefer-defer-over-async/
add_filter('script_loader_tag', function ( $tag, $handle ) {
	switch( $handle ) {
		case 'g_starter-scripts':
			return str_replace( ' src', ' defer src', $tag );
	}
	return $tag;
}, 10, 2);