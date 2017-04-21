<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Custom footer 'creds' text
add_filter( 'genesis_footer_output', function () {
	 return '<p>[footer_childtheme_link before="" after=""]';
});