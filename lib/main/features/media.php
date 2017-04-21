<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Downsize uploaded image if too large
// See: https://wordpress.stackexchange.com/questions/63707/automatically-replace-original-uploaded-image-with-large-image-size
// Disabled by default (uncomment the line below to activate)
//add_filter( 'wp_generate_attachment_metadata', 'g_starter_downsize_uploaded_image', 99 );
function g_starter_downsize_uploaded_image( $image_data ) {
	$max_image_size_name = 'large';
	// Abort if no max image
	if( !isset($image_data['sizes'][$max_image_size_name]) )
		return $image_data;
	// paths to the uploaded image and the max image
	$upload_dir              = wp_upload_dir();
	$uploaded_image_location = $upload_dir['basedir'] . '/' . $image_data['file'];
	$max_image_location      = $upload_dir['path'] . '/' . $image_data['sizes'][$max_image_size_name]['file'];
	// Delete original image
	unlink($uploaded_image_location);
	// Rename max image to original image
	rename( $max_image_location, $uploaded_image_location );
	// Update and return image metadata
	$image_data['width']  = $image_data['sizes'][$max_image_size_name]['width'];
	$image_data['height'] = $image_data['sizes'][$max_image_size_name]['height'];
	unset($image_data['sizes'][$max_image_size_name]);
	return $image_data;
}

// ** Change WP JPEG compression (WP default is 90%)
// See: http://wpmu.org/how-to-change-jpeg-compression-in-wordpress/
// Disabled by default (uncomment the line below to activate)
//add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );