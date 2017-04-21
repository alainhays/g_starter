<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', function ( $size ) {
	return 90;
});

// ** Custom Genesis Author Box
// Disabled by default (uncomment the line below to activate)
//add_filter( 'genesis_author_box', 'g_starter_author_box' , 10, 6 );
function g_starter_author_box ( $output, $context, $pattern, $gravatar, $title, $description ) {	
	if( is_single() ) {
		// On single post display author description excerpt
		$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
		$name = get_the_author();
		$title = get_the_author_meta( 'title' );
		$word_limit = 70; // Limit the number of words
		$more_text = __( 'Read more about me', CHILD_THEME_TEXT_DOMAIN ); // The read more text
		$end_text = '...'; // Display text end 
		$author_excerpt = wp_trim_words(strip_tags(get_the_author_meta('description')), $word_limit, $end_text.'</br><a href="'.$author_url.'">'.$more_text.'</a>');
		$output = '';
		$output .= '<div class="author-box">';	
		$output .= '<a href="' . $author_url .'">' . get_avatar( get_the_author_meta( 'email' ), 150 ) . '</a>';
		if( !empty( $title ) )
			$name .= ', ' . $title;
		$output .= '<a href="' . $author_url .'"><h4 class="author-box-title">' . $name . '</h2></a>';
		$output .= '<p class="author-box-description">' . $author_excerpt . '</p>';
		$output .= '<div class="author-contacts">';
		$output .= '<div class="small">' . __( 'Get in touch with me', CHILD_THEME_TEXT_DOMAIN ) . '</div>';
		if( get_the_author_meta( 'facebook' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'facebook' ) ) . '"><i class="ion-social-facebook"></i></a> ';
		if( get_the_author_meta( 'twitter' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'twitter' ) ) . '"><i class="ion-social-twitter"></i></a> ';	
		if( get_the_author_meta( 'gplus' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'gplus' ) ) . '"><i class="ion-social-googleplus"></i></a> ';	
		if( get_the_author_meta( 'linkedin' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'linkedin' ) ) . '"><i class="ion-social-linkedin"></i></a> ';
		$output .= '<a href="mailto:' . get_the_author_meta( 'email' ) . '"><i class="ion-android-mail"></i></a>';
		$output .= '</div>';
		$output .= '</div>';
	} else {
		// On the author page display full author description
		$name = get_the_author();
		$title = get_the_author_meta( 'title' );
		$output = '';
		$output .= '<div class="author-box">';
	
		if( !empty( $title ) )
			$name .= ', ' . $title;
		$output .= '<h1 class="archive-title">' . $name . '</h1>';
		$output .= ''. get_avatar( get_the_author_meta( 'email' ), 150 ) . '';
		$output .= '<p class="author-box-description">' . get_the_author_meta( 'description' ) . '</p>';
		$output .= '<div class="author-contacts">';
		$output .= '<div class="small">' . __( 'Get in touch with me', CHILD_THEME_TEXT_DOMAIN ) . '</div>';
		if( get_the_author_meta( 'facebook' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'facebook' ) ) . '"><i class="ion-social-facebook"></i></a> ';
		if( get_the_author_meta( 'twitter' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'twitter' ) ) . '"><i class="ion-social-twitter"></i></a> ';	
		if( get_the_author_meta( 'gplus' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'gplus' ) ) . '"><i class="ion-social-googleplus"></i></a> ';		
		if( get_the_author_meta( 'linkedin' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'linkedin' ) ) . '"><i class="ion-social-linkedin"></i></a> ';
		$output .= '<a href="mailto:' . get_the_author_meta( 'email' ) . '"><i class="ion-android-mail"></i></a>';
		$output .= '</div>';
		$output .= '</div>';
	}	
	return $output;
}