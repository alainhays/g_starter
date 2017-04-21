<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Initialize Genesis
require_once get_template_directory() . '/lib/init.php';

// ** The $g_starter_includes array determines the code library included in your child theme
// Add or remove files to the array as needed
// Please note that missing files will produce a fatal error
$g_starter_includes = [

  // Main features
  'lib/main/features/assets.php',
  'lib/main/features/accessibility.php',
  'lib/main/features/branding.php',
  'lib/main/features/classes.php',
  'lib/main/features/discussion.php',
  'lib/main/features/head.php',
  'lib/main/features/HTML5.php',
  'lib/main/features/media.php',
  'lib/main/features/security.php',
  'lib/main/features/developer-tools.php',

  // Back-end
  'lib/main/admin/dashboard.php',  // WP dashboard
  'lib/main/admin/genesis.php',    // Genesis options

  // Theme setup
  'lib/theme-setup/features.php',   // Define constants and features
  'lib/theme-setup/scripts.php',    // Enqueue Scripts and stylesheets
  'lib/theme-setup/defaults.php',   // Default theme settings
  'lib/theme-setup/extras.php',     // Custom functions goes here

  // Theme structure
  'lib/theme-setup/structure/header.php',
  'lib/theme-setup/structure/navigation.php',
  'lib/theme-setup/structure/layout.php',
  'lib/theme-setup/structure/post.php',
  'lib/theme-setup/structure/author-box.php',
  'lib/theme-setup/structure/comments.php',
  'lib/theme-setup/structure/media.php',
  'lib/theme-setup/structure/search.php',
  'lib/theme-setup/structure/sidebar.php',
  'lib/theme-setup/structure/widgets.php',
  'lib/theme-setup/structure/footer.php',

  // Customizer
  'lib/theme-setup/customizer/customize.php',
  'lib/theme-setup/customizer/functions.php',
  'lib/theme-setup/customizer/output.php',

  // Woocommerce
  'lib/theme-setup/woocommerce/woocommerce-setup.php',
  'lib/theme-setup/woocommerce/woocommerce-output.php',
  'lib/theme-setup/woocommerce/woocommerce-notice.php'

];

foreach ($g_starter_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', CHILD_THEME_TEXT_DOMAIN), $file), E_USER_ERROR);
  }
  require_once $filepath;  
}
unset($file, $filepath);