<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Modify size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', function ( $args ) {
	$args['avatar_size'] = 60;
	return $args;
});

// ** Remove comments frontend. Useful if replacing WP commenting with Disqus
// Disabled by default (uncomment the line below to activate)
//remove_action( 'genesis_comments', 'genesis_do_comments' );
//remove_action( 'genesis_comment_form', 'genesis_do_comment_form' );

// ** Remove the entire comments area frontend, including comments, reply form, and pings
// Disabled by default (uncomment the line below to activate)
//remove_action( 'genesis_after_entry', 'genesis_get_comments_template' );

// ** Move the comments list below the comment form
// Disabled by default (uncomment the line below to activate)
//add_action( 'genesis_before_comments', 'g_starter_comment_list_below_form' );
function g_starter_comment_list_below_form () {
	if ( is_single() ) {
		if ( have_comments() ) {
			remove_action( 'genesis_comment_form', 'genesis_do_comment_form' );
			add_action( 'genesis_list_comments', 'genesis_do_comment_form' , 5 );
		}
	}
}