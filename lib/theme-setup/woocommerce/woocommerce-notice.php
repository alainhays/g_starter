<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Remove the default WooCommerce Notice
add_action( 'admin_print_styles', function () {
	// If below version WooCommerce 2.3.0, exit early.
	if ( ! class_exists( 'WC_Admin_Notices' ) ) {
		return;
	}
	WC_Admin_Notices::remove_notice( 'theme_support' );
});

// ** Add a prompt to activate Genesis Connect for WooCommerce if WooCommerce is active but Genesis Connect is not
add_action( 'admin_notices', function () {
	// If WooCommerce isn't installed or Genesis Connect is installed, exit early.
	if ( ! class_exists( 'WooCommerce' ) || function_exists( 'gencwooc_setup' ) ) {
		return;
	}
	// If user doesn't have access, exit early
	if ( ! current_user_can( 'manage_woocommerce' ) ) {
		return;
	}
	// If message dismissed, exit early
	if ( get_user_option( 'g_starter_woocommerce_message_dismissed', get_current_user_id() ) ) {
		return;
	}
	$notice_html = sprintf( __( 'Please install and activate <a href="https://wordpress.org/plugins/genesis-connect-woocommerce/" target="_blank">Genesis Connect for WooCommerce</a> to <strong>enable WooCommerce support for %s</strong>.', CHILD_THEME_TEXT_DOMAIN ), esc_html( CHILD_THEME_NAME ) );
	if ( current_user_can( 'install_plugins' ) ) {
		$plugin_slug  = 'genesis-connect-woocommerce';
		$admin_url    = network_admin_url( 'update.php' );
		$install_link = sprintf( '<a href="%s">%s</a>', wp_nonce_url(
			add_query_arg(
				[
					'action' => 'install-plugin',
					'plugin' => $plugin_slug,
				],
				$admin_url
			),
			'install-plugin_' . $plugin_slug
		), __( 'install and activate Genesis Connect for WooCommerce', CHILD_THEME_TEXT_DOMAIN ) );
		$notice_html = sprintf( __( 'Please %s to <strong>enable WooCommerce support for %s</strong>.', CHILD_THEME_TEXT_DOMAIN ), $install_link, esc_html( CHILD_THEME_NAME ) );
	}
	echo '<div class="notice notice-info is-dismissible g_starter-woocommerce-notice"><p>' . $notice_html . '</p></div>';
});

// ** Add option to dismiss Genesis Connect for Woocommerce plugin install prompt
add_action( 'wp_ajax_g_starter_dismiss_woocommerce_notice', 'g_starter_dismiss_woocommerce_notice' );
function g_starter_dismiss_woocommerce_notice() {

	update_user_option( get_current_user_id(), 'g_starter_woocommerce_message_dismissed', 1 );
}

// ** Enqueue script to clear the Genesis Connect for WooCommerce plugin install prompt on dismissal
add_action( 'admin_enqueue_scripts', function () {
	wp_enqueue_script( 'woocommerce-notice-scripts', g_starter_asset_path('scripts/woocommerce-notice-update.js'), ['jquery'], CHILD_THEME_VERSION, true  );
});

// ** Clear the Genesis Connect for WooCommerce plugin install prompt on theme change
add_action( 'switch_theme', 'g_starter_reset_woocommerce_notice', 10, 2 );
function g_starter_reset_woocommerce_notice() {
	global $wpdb;
	$args = [
		'meta_key'     => $wpdb->prefix . 'g_starter_woocommerce_message_dismissed',
		'meta_value'   => 1,
	] ;
	$users = get_users( $args );    
	foreach ( $users as $user ) {
		delete_user_option( $user->ID, 'g_starter_woocommerce_message_dismissed' );
	}
}

// ** Clear the Genesis Connect for WooCommerce plugin prompt on deactivation
add_action( 'deactivated_plugin', function ( $plugin, $network_activation ) {
	// Conditional check to see if we're deactivating WooCommerce or Genesis Connect for WooCommerce
	if ( $plugin !== 'woocommerce/woocommerce.php' && $plugin !== 'genesis-connect-woocommerce/genesis-connect-woocommerce.php'  ) {
		return;
	}
	g_starter_reset_woocommerce_notice();
}, 10, 2 );
