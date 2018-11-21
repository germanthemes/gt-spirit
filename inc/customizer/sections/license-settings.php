<?php
/**
 * License Settings
 *
 * Register License Settings
 *
 * @package GT Spirit
 */

/**
 * Adds all License settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function gt_spirit_customize_register_license_settings( $wp_customize ) {

	// Add Section for License.
	$wp_customize->add_section( 'gt_spirit_section_license', array(
		'title'       => esc_html__( 'License', 'gt-spirit' ),
		'description' => esc_html__( 'Please enter your license key. An active license key is necessary for automatic theme updates and support.', 'gt-spirit' ),
		'priority'    => 30,
		'panel'       => 'gt_spirit_options_panel',
	) );

	// Add License Key setting.
	$wp_customize->add_setting( 'gt_spirit_theme_options[license_key]', array(
		'default'           => '',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new GT_Spirit_Customize_License_Control(
		$wp_customize, 'license_key', array(
			'label'    => esc_html__( 'License Key', 'gt-spirit' ),
			'section'  => 'gt_spirit_section_license',
			'settings' => 'gt_spirit_theme_options[license_key]',
			'priority' => 10,
		)
	) );
}
add_action( 'customize_register', 'gt_spirit_customize_register_license_settings' );
