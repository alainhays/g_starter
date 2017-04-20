<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Customize the post navigation prev text
// (Only applies to the 'Previous/Next' Post Navigation Technique, set in Genesis > Theme Options)
add_filter( 'genesis_prev_link_text', function ( $text ) {
	return html_entity_decode('&#10216;') . ' ';
});

// ** Customize the post navigation next text
// (Only applies to the 'Previous/Next' Post Navigation Technique, set in Genesis > Theme Options)
add_filter( 'genesis_next_link_text', function ( $text ) {
	return ' ' . html_entity_decode('&#10217;');
});

// ** Adjust the default WP password protected form to support keeping the input and submit on the same line
add_filter( 'the_password_form', function ( $post = 0 ) {
	$post       = get_post( $post );
	$label      = 'pwbox-' . ( empty($post->ID) ? mt_rand() : $post->ID );
	$output     = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">';
		$autofocus = is_singular() ? 'autofocus' : '';
		$output .= '<input name="post_password" id="' . $label . '" type="password" size="20" placeholder="' . __( 'Password', CHILD_THEME_TEXT_DOMAIN ) . '" ' . $autofocus . '>';
		$output .= '<input type="submit" name="' . __( 'Submit', CHILD_THEME_TEXT_DOMAIN ) . '" value="' . esc_attr__( 'Submit' ) . '">';
	$output .= '</form>';
	return $output;
});

// ** Allow pages to have excerpt
// Disabled by default (uncoment the line below to activate)
//add_post_type_support( 'page', 'excerpt' );

// ** Customize the post info text
// See:http://www.briangardner.com/code/customize-post-info/
// Friendly note: use [post_author] to return the author's name, without an archive link.
// Disabled by default (uncoment the lines below to activate)
//remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
//add_filter( 'genesis_post_info', 'g_starter_post_info' );
function g_starter_post_info () {
	return '[post_date] ' . __( 'by', CHILD_THEME_TEXT_DOMAIN ) . ' [post_author_posts_link] [post_comments] [post_edit]';
}

// ** Customize the post meta text
// See:http://www.briangardner.com/code/customize-post-meta/
// Disabled by default (uncoment the lines below to activate)
//remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
//add_filter( 'genesis_post_meta', 'g_starter_post_meta' );
function g_starter_post_meta () {
	return '[post_categories before="' . __( 'Filed Under: ', CHILD_THEME_TEXT_DOMAIN ) . '"] [post_tags before="' . __( 'Tagged: ', CHILD_THEME_TEXT_DOMAIN ) . '"]';
}

// Display Post Author Avatar
// Disabled by default (uncoment the line below to activate)
//add_action('genesis_entry_header', 'g_starter_post_author_avatar' );
function g_starter_post_author_avatar () {
	echo get_avatar(get_the_author_meta('email'), 30);
} 