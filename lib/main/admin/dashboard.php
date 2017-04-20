<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Remove admin bar inline CSS
add_theme_support( 'admin-bar', ['callback' => '__return_false'] );
add_action(  'admin_bar_init', function () {
	remove_action( 'wp_head', 'wp_admin_bar_header' );
});

// ** Remove admin bar avatar
add_action( 'admin_bar_menu', function () {
	add_filter( 'pre_option_show_avatars', '__return_zero' );
}, 0 );
add_action( 'admin_bar_menu', function () {
	remove_filter( 'pre_option_show_avatars', '__return_zero' );
}, 10 );

// ** Only show the admin bar to users who can at least use posts
add_filter( 'show_admin_bar', function ( $default ) {
	return current_user_can( 'edit_posts' ) ? $default : false;
}, 99 );

// ** Remove Welcome Panel from dashboard
// Disabled by default (uncoment the line below to activate) 
//remove_action('welcome_panel', 'wp_welcome_panel');

// ** Remove admin dashboard metaboxes
// The first value passed is the metabox ID, so you could remove other metaboxes added by plugins
// Partially enabled by default (uncoment lines below to remove other metaboxes) 
add_action( 'admin_menu', function () {
	//remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'core' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );
	//remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );
	//remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );
	remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );
});

// ** Remove default admin dashboard menus
// Disabled by default (uncoment lines below to activate) 
add_action( 'admin_menu', function () {
	//remove_menu_page('index.php'); 				// Dashboard tab
	//remove_menu_page('edit.php'); 				// Posts
	//remove_menu_page('upload.php'); 				// Media
	//remove_menu_page('edit.php?post_type=page'); 	// Pages
	//remove_menu_page('edit-comments.php'); 		// Comments
	//remove_menu_page('genesis'); 					// Genesis
	//remove_menu_page('themes.php'); 				// Appearance
	//remove_menu_page('plugins.php'); 				// Plugins
	//remove_menu_page('users.php'); 				// Users
	//remove_menu_page('tools.php'); 				// Tools
	//remove_menu_page('options-general.php'); 		// Settings
});

// ** Limit the number of items that can be shown at once on admin pages, too many items will cause timeouts on most servers
add_action( 'admin_init', function () {
	$options = [
		'edit_comments_per_page',
		'edit_page_per_page',
		'edit_post_per_page',
		'site_themes_network_per_page',
		'site_users_network_per_page',
		'sites_network_per_page',
		'themes_network_per_page',
		'users_network_per_page',
		'users_per_page',
	];
	// 'edit_{$post_type}_per_page'
	$post_types = get_post_types( ['_builtin' => false] );
	foreach( $post_types as $post_type )
		$options[] = 'edit_' . $post_type . '_per_page';

	foreach( $options as $option )
		add_filter( $option, function ( $per_page ) {
			return min( $per_page, 10 );
		});
});

// ** Remove default post and page meta boxes. You should always unhook 'Custom Fields', since it can be a large query
// Disabled by default (uncoment the lines below to activate)
add_action( 'do_meta_boxes', function () {
		// Post
	//remove_meta_box( 'authordiv', 'post', 'normal' );
	//remove_meta_box( 'categorydiv', 'post', 'side' );
	//remove_meta_box( 'commentsdiv', 'post', 'normal' );
	//remove_meta_box( 'commentstatusdiv', 'post', 'normal' );
	//remove_meta_box( 'postcustom', 'post', 'normal' );
	//remove_meta_box( 'postexcerpt', 'post', 'normal' );
	//remove_meta_box( 'postimagediv', 'post', 'side' );
	//remove_meta_box( 'revisionsdiv', 'post', 'normal' );
	//remove_meta_box( 'slugdiv', 'post', 'normal' );
	//remove_meta_box( 'submitdiv', 'post', 'side' );
	//remove_meta_box( 'tagsdiv-post_tag', 'post', 'side' );
	//remove_meta_box( 'trackbacksdiv', 'post', 'normal' );
		// Page
	//remove_meta_box( 'authordiv', 'page', 'normal' );
	//remove_meta_box( 'commentstatusdiv', 'page', 'normal' );
	//remove_meta_box( 'pageparentdiv', 'page', 'side' );
	//remove_meta_box( 'postcustom', 'page', 'normal' );
	//remove_meta_box( 'postimagediv', 'page', 'side' );
	//remove_meta_box( 'slugdiv', 'page', 'normal' );
	//remove_meta_box( 'submitdiv', 'page', 'side' );
});

// ** Change which meta boxes are hidden by default on the post and page edit screens
add_filter( 'default_hidden_meta_boxes', function ( $hidden ) {
	global $current_screen;
	if( 'post' === $current_screen->id ) {
		$hidden = ['postexcerpt', 'trackbacksdiv', 'postcustom', 'commentstatusdiv', 'slugdiv', 'authordiv'];
		// Other hideable post boxes: genesis_inpost_scripts_box, commentsdiv, categorydiv, tagsdiv, postimagediv
	} elseif( 'page' === $current_screen->id ) {
		$hidden = ['postcustom', 'commentstatusdiv', 'slugdiv', 'authordiv', 'postimagediv'];
		// Other hideable post boxes: genesis_inpost_scripts_box, pageparentdiv
	}
	return $hidden;
}, 2 );

// ** Remove the post edit links (maybe you just want to use the admin bar)
add_filter( 'edit_post_link', '__return_false' );

// ** Use main stylesheet for visual editor
// To add custom styles edit /assets/styles/common/_tinymce.scss
add_editor_style(g_starter_asset_path('styles/main.css'));

// ** Modify the TinyMCE settings array
// See: https://core.trac.wordpress.org/ticket/29360
add_filter( 'tiny_mce_before_init', function ( $options ) {
	$options['element_format']   = 'html'; // See: http://www.tinymce.com/wiki.php/Configuration:element_format
	$options['schema']           = 'html5-strict'; // Only allow the elements that are in the current HTML5 specification. See: http://www.tinymce.com/wiki.php/Configuration:schema
	$options['block_formats']    = 'Paragraph=p;Header 2=h2;Header 3=h3;Header 4=h4;Blockquote=blockquote'; // Restrict the block formats available in TinyMCE. See: http://www.tinymce.com/wiki.php/Configuration:block_formats
	$options['wp_autoresize_on'] = false;
	return $options;
});

// ** Add user social profiles
add_filter( 'user_contactmethods', function ( $fields ) {
	 $fields['facebook'] = 'Facebook';											// Add Facebook
	 $fields['twitter'] = 'Twitter';												// Add Twitter
	 $fields['linkedin'] = 'LinkedIn';											// Add LinkedIn
	unset( $fields['aim'], $fields['yim'], $fields['jabber'] );						// Remove AIM, Yahoo IM, and Jabber / Google Talk
	return $fields;
});

// ** Remove admin color scheme metabox
// See: https://snippets.khromov.se/remove-admin-color-scheme-from-user-admin-dashboard-in-wordpress-3-8/
remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');

// ** Disable WP widgets
// Disabled by default (uncoment the lines below to activate)
add_action('widgets_init', function () {
	// unregister_widget( 'WP_Widget_Pages' );
	// unregister_widget( 'WP_Widget_Calendar' );
	// unregister_widget( 'WP_Widget_Archives' );
	// unregister_widget( 'WP_Widget_Meta' );
	// unregister_widget( 'WP_Widget_Search' );
	// unregister_widget( 'WP_Widget_Text' );
	// unregister_widget( 'WP_Widget_Categories' );
	// unregister_widget( 'WP_Widget_Recent_Posts' );
	// unregister_widget( 'WP_Widget_Recent_Comments' );
	// unregister_widget( 'WP_Widget_RSS' );
	// unregister_widget( 'WP_Widget_Tag_Cloud' );
	// unregister_widget( 'WP_Nav_Menu_Widget' );
});

// ** Allow shortcodes in text widgets
add_filter( 'widget_text', 'do_shortcode' );