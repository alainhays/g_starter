<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Unregister default Genesis layouts.
// Disabled by default (uncomment the lines below to activate)
//genesis_unregister_layout( 'content-sidebar' );
//genesis_unregister_layout( 'sidebar-content' );
//genesis_unregister_layout( 'content-sidebar-sidebar' );
//genesis_unregister_layout( 'sidebar-sidebar-content' );
//genesis_unregister_layout( 'sidebar-content-sidebar' );
//genesis_unregister_layout( 'full-width-content' );

// ** Force a layout setting for the site
// See: http://www.briangardner.com/code/force-layout-setting/
// Disabled by default (uncomment the line below to activate)
//add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
// Other possible layouts: __genesis_return_content_sidebar, __genesis_return_sidebar_content, __genesis_return_content_sidebar_sidebar, __genesis_return_sidebar_sidebar_content, __genesis_return_sidebar_content_sidebar, __genesis_return_full_width_content