<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Get default accent color for Customizer
// ** Abstracted here since at least two functions use it
function g_starter_customizer_get_default_accent_color() {
	return '#3E78B2';
}

// ** Get default link color for Customizer
// ** Abstracted here since at least two functions use it
function g_starter_customizer_get_default_link_color() {
	return '#3E78B2';
}

// ** Generate a hex value that has appropriate contrast against the inputted value
function g_starter_color_contrast( $color ) {
	$hexcolor = str_replace( '#', '', $color );
	$red      = hexdec( substr( $hexcolor, 0, 2 ) );
	$green    = hexdec( substr( $hexcolor, 2, 2 ) );
	$blue     = hexdec( substr( $hexcolor, 4, 2 ) );
	$luminosity = ( ( $red * 0.2126 ) + ( $green * 0.7152 ) + ( $blue * 0.0722 ) );
	return ( $luminosity > 128 ) ? '#333333' : '#ffffff';
}

// ** Generate a hex value that has appropriate brightness against the inputted value
function g_starter_color_brightnesst( $color, $change ) {
	$hexcolor = str_replace( '#', '', $color );

	$red   = hexdec( substr( $hexcolor, 0, 2 ) );
	$green = hexdec( substr( $hexcolor, 2, 2 ) );
	$blue  = hexdec( substr( $hexcolor, 4, 2 ) );
	
	$red   = max( 0, min( 255, $red + $change ) );
	$green = max( 0, min( 255, $green + $change ) );
	$blue  = max( 0, min( 255, $blue + $change ) );
	return '#'.dechex( $red ).dechex( $green ).dechex( $blue );
}