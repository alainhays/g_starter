<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Define child theme constants (do not remove)
define( 'CHILD_THEME_NAME', 'g_starter' );
define( 'CHILD_THEME_URL', 'https://NicBeltramelli@bitbucket.org/NicBeltramelli/g_starter.git' );
define( 'CHILD_THEME_VERSION', '0.1.1' );
define( 'CHILD_THEME_TEXT_DOMAIN', 'g_starter' );

// Set Localization
load_child_theme_textdomain( CHILD_THEME_TEXT_DOMAIN, get_stylesheet_directory() . '/lang' );

// Add support for custom header.
add_theme_support( 'custom-header', [
	'width'           => 400,
	'height'          => 130,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
] );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', [ 'primary' => __( 'Header Menu', CHILD_THEME_TEXT_DOMAIN ), 'secondary' => __( 'Footer Menu', CHILD_THEME_TEXT_DOMAIN ) ] );

// ** Enable post formats
// add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Declare Genesis Connect - WooCommerce support
add_theme_support( 'genesis-connect-woocommerce' );