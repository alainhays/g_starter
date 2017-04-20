<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Prevent the failed login notice from specifying whether the username or the password is incorrect
add_filter( 'login_errors', function () {
	return __( 'Sorry, there is a problem, try again.', CHILD_THEME_TEXT_DOMAIN );
});

// ** Disable pingbacks
// See: http://wptavern.com/how-to-prevent-wordpress-from-participating-in-pingback-denial-of-service-attacks
add_filter( 'xmlrpc_methods', function ( $methods ) {
	unset($methods['pingback.ping']);
	return $methods;
});
