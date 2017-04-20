<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Remove the Genesis redirect on theme upgrade
remove_action( 'genesis_upgrade', 'genesis_upgrade_redirect' );

// ** Deregister Genesis parent theme page templates
// See: https://www.billerickson.net/dont-use-genesis-blog-template/
add_filter( 'theme_page_templates', function ( $templates ) {
//  unset( $templates['page_archive.php'] );
    unset( $templates['page_blog.php'] );
    return $templates;
});

// ** Remove metaboxes from genesis admin screens
add_action( 'genesis_admin_before_metaboxes', function ( $hook ) {
    	// Theme Settings metaboxes
    //remove_meta_box( 'genesis-theme-settings-version', $hook, 'main' );
    //remove_meta_box( 'genesis-theme-settings-feeds', $hook, 'main' );
    //remove_meta_box( 'genesis-theme-settings-layout', $hook, 'main' );
    //remove_meta_box( 'genesis-theme-settings-header', $hook, 'main' );
    //remove_meta_box( 'genesis-theme-settings-nav', $hook, 'main' );
    //remove_meta_box( 'genesis-theme-settings-breadcrumb', $hook, 'main' );
    //remove_meta_box( 'genesis-theme-settings-comments', $hook, 'main' );
    //remove_meta_box( 'genesis-theme-settings-posts', $hook, 'main' );
    remove_meta_box( 'genesis-theme-settings-blogpage', $hook, 'main' );
    remove_meta_box( 'genesis-theme-settings-scripts', $hook, 'main' );
    	// SEO Settings metaboxes
    //remove_meta_box( 'genesis-seo-settings-doctitle',   $hook, 'main' );
    //remove_meta_box( 'genesis-seo-settings-homepage',   $hook, 'main' );
    remove_meta_box( 'genesis-seo-settings-dochead',    $hook, 'main' );
    //remove_meta_box( 'genesis-seo-settings-robots',     $hook, 'main' );
    //remove_meta_box( 'genesis-seo-settings-archives',   $hook, 'main' );
});

// ** Remove the Genesis 'Scripts' meta box for posts
remove_post_type_support( 'post', 'genesis-scripts' );

// ** Remove the Genesis 'Scripts' meta box for pages
remove_post_type_support( 'page', 'genesis-scripts' );

// ** Remove the Genesis 'Layout Settings' meta box for posts
remove_post_type_support( 'post', 'genesis-layouts' );

// ** Remove the Genesis 'Layout Settings' meta box for pages
remove_post_type_support( 'page', 'genesis-layouts' );

// ** Remove the Genesis 'Layout Settings' meta box for terms
remove_theme_support( 'genesis-archive-layouts' );

// ** Remove user setting metaboxes
// Uncomment the lines below to disable metaboxes
remove_action( 'show_user_profile', 'genesis_user_options_fields' );
remove_action( 'edit_user_profile', 'genesis_user_options_fields' );
//remove_action( 'show_user_profile', 'genesis_user_archive_fields' );
//remove_action( 'edit_user_profile', 'genesis_user_archive_fields' );
//remove_action( 'show_user_profile', 'genesis_user_seo_fields' );
//remove_action( 'edit_user_profile', 'genesis_user_seo_fields' );
remove_action( 'show_user_profile', 'genesis_user_layout_fields' );
remove_action( 'edit_user_profile', 'genesis_user_layout_fields' );

// ** Disable Genesis widgets
// Disabled by default (uncoment the lines below to activate)
add_action( 'widgets_init', function () {
    // unregister_widget( 'Genesis_Featured_Page' );    
    // unregister_widget( 'Genesis_User_Profile_Widget' );
    // unregister_widget( 'Genesis_Featured_Post' );    
}, 20 );