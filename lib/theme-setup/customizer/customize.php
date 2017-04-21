<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ** Register settings and controls with the Customizer
add_action( 'customize_register',  function () {
	$wp_customize->add_setting(
		'g_starter_link_color',
		[
			'default'           => g_starter_customizer_get_default_link_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'g_starter_link_color',
			[
				'description' => __( 'Change the color of post info links, hover color of linked titles, hover color of menu items, and more.', CHILD_THEME_TEXT_DOMAIN ),
				'label'       => __( 'Link Color', CHILD_THEME_TEXT_DOMAIN ),
				'section'     => 'colors',
				'settings'    => 'g_starter_link_color',
			]
		)
	);

	$wp_customize->add_setting(
		'g_starter_accent_color',
		[
			'default'           => g_starter_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'g_starter_accent_color',
			[
				'description' => __( 'Change the default hovers color for button.', CHILD_THEME_TEXT_DOMAIN ),
				'label'       => __( 'Accent Color', CHILD_THEME_TEXT_DOMAIN ),
				'section'     => 'colors',
				'settings'    => 'g_starter_accent_color',
			]
		)
	);
});