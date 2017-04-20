<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Link login screen's logo to homepage instead of to WordPress.org.
add_filter( 'login_headerurl', function () {
	return home_url();
});

// ** Make the login screen's logo title attribute your site title, instead of 'WordPress'
add_filter( 'login_headertitle', function () {
	return get_bloginfo( 'name' );
});

// ** Custom login logo
// Make sure you have a login-logo.png in assets/images folder before using this function!
// Assumes png logo by default
// Disabled by default (uncomment the line below to activate)
//add_action( 'login_enqueue_scripts', 'g_starter_login_logo' );
function g_starter_login_logo() {
	?><style type="text/css">
		body.login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri() ?>/dist/images/login-logo.png);
			/* Adjust to the dimensions of your logo. WP Default: 84px 84px */
			background-size: 100px 100px;
			width: 100px;
			height: 100px;
		}
	</style>
	<?php
}

// ** WordPress-generated emails 'from' your WordPress site name, instead of from 'WordPress'
add_filter( 'wp_mail_from_name',function () {
	return get_option( 'blogname' );
});

// ** WordPress-generated emails appear 'from' your WordPress admin email address
// Disabled by default (uncomment the line below to activate)
//add_filter( 'wp_mail_from', 'g_starter_wp_mail_from' );
function g_starter_wp_mail_from () {
	return get_option( 'admin_email' );
}

// ** Remove the brackets from the retreive PW link, since they get hidden on HTML
add_filter( 'retrieve_password_message', function ( $message ) {
	return preg_replace( '/<(.+?)>/', '$1', $message );
});

// ** Remove the WP icon from the admin bar
add_action( 'wp_before_admin_bar_render', function () {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
});

// ** Customize admin footer text
add_filter( 'admin_footer_text', function () {
	$text = __( 'Built by <a href="%s" target="_blank">Nic Beltramelli</a>', CHILD_THEME_TEXT_DOMAIN );
	$text = sprintf(
		$text,
		'https://twitter.com/NicBeltramelli'
	);
	return $text;
});