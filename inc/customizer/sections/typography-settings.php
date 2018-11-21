<?php
/**
 * Typography Settings
 *
 * Register Typography Settings
 *
 * @package GT Spirit
 */

/**
 * Adds all Typography settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function gt_spirit_customize_register_typography_settings( $wp_customize ) {

	// Add Section for Theme Fonts.
	$wp_customize->add_section( 'gt_spirit_section_typography', array(
		'title'    => esc_html__( 'Typography', 'gt-spirit' ),
		'priority' => 20,
		'panel'    => 'gt_spirit_options_panel',
	) );

	// Get Default Fonts from settings.
	$default = gt_spirit_default_options();

	// Add Text Font setting.
	$wp_customize->add_setting( 'gt_spirit_theme_options[text_font]', array(
		'default'           => $default['text_font'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_attr',
	) );

	$wp_customize->add_control( new GT_Spirit_Customize_Font_Control(
		$wp_customize, 'text_font', array(
			'label'    => esc_html__( 'Body Font', 'gt-spirit' ),
			'section'  => 'gt_spirit_section_typography',
			'settings' => 'gt_spirit_theme_options[text_font]',
			'priority' => 10,
		)
	) );

	// Add Title Font setting.
	$wp_customize->add_setting( 'gt_spirit_theme_options[title_font]', array(
		'default'           => $default['title_font'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_attr',
	) );

	$wp_customize->add_control( new GT_Spirit_Customize_Font_Control(
		$wp_customize, 'title_font', array(
			'label'    => esc_html_x( 'Headings', 'Font Setting', 'gt-spirit' ),
			'section'  => 'gt_spirit_section_typography',
			'settings' => 'gt_spirit_theme_options[title_font]',
			'priority' => 20,
		)
	) );

	// Add Navigation Font setting.
	$wp_customize->add_setting( 'gt_spirit_theme_options[navi_font]', array(
		'default'           => $default['navi_font'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_attr',
	) );

	$wp_customize->add_control( new GT_Spirit_Customize_Font_Control(
		$wp_customize, 'navi_font', array(
			'label'    => esc_html_x( 'Navigation', 'Font Setting', 'gt-spirit' ),
			'section'  => 'gt_spirit_section_typography',
			'settings' => 'gt_spirit_theme_options[navi_font]',
			'priority' => 30,
		)
	) );
}
add_action( 'customize_register', 'gt_spirit_customize_register_typography_settings' );
