<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Enqueue stylesheets and scripts
add_action('wp_enqueue_scripts', function () {
	
	wp_enqueue_style( 'g_starter-fonts', '//fonts.googleapis.com/css?family=Amiri:400,400i,700,700i|Roboto:700|Josefin+Sans:700', [], CHILD_THEME_VERSION );
	
	wp_enqueue_style('g_starter-styles', g_starter_asset_path('styles/main.css'), false, null);

		if (is_single() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}

	wp_enqueue_script('g_starter-scripts', g_starter_asset_path('scripts/main.js'), ['jquery'], null, true);

	wp_localize_script(
		'g_starter-scripts',
		'genesis_responsive_menu',
		g_starter_responsive_menu_settings()
	);
	
}, 100);