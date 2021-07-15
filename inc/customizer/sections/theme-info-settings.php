<?php
/**
 * Theme Info Settings
 *
 * Register Theme Info Settings
 *
 * @package GT Spirit
 */

/**
 * Adds all Theme Info settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function gt_spirit_customize_register_theme_info_settings( $wp_customize ) {

	// Add Section for Theme Fonts.
	$wp_customize->add_section( 'gt_spirit_section_theme_info', array(
		'title'    => esc_html__( 'Theme Info', 'gt-spirit' ),
		'priority' => 200,
		'panel'    => 'gt_spirit_options_panel',
	) );

	// Add Theme Links control.
	$wp_customize->add_control( new GT_Spirit_Customize_Links_Control(
		$wp_customize, 'gt_spirit_theme_links', array(
			'section'  => 'gt_spirit_section_theme_info',
			'settings' => array(),
			'priority' => 10,
		)
	) );
}
add_action( 'customize_register', 'gt_spirit_customize_register_theme_info_settings' );
