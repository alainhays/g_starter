<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Disable self trackbacks
// See: http://wp-snippets.com/disable-self-trackbacks/
add_action( 'pre_ping', function ( &$links ) {
	foreach ( $links as $l => $link )
		if ( 0 === strpos( $link, home_url() ) )
			unset($links[$l]);
});

// ** Remove pings frontend
// Disabled by default (uncoment the line below to activate)
//remove_action( 'genesis_pings', 'genesis_do_pings' );

// ** Remove url field in the entry comments
add_filter('comment_form_default_fields', function ($fields) { 
    unset($fields['url']);
    return $fields;
});