<?php
/**
 * Returns theme options
 *
 * Uses sane defaults in case the user has not configured any theme options yet.
 *
 * @package GT Spirit
 */

/**
* Get a single theme option
*
* @return mixed
*/
function gt_spirit_get_option( $option_name = '' ) {

	// Get all Theme Options from Database.
	$theme_options = gt_spirit_theme_options();

	// Return single option.
	if ( isset( $theme_options[ $option_name ] ) ) {
		return $theme_options[ $option_name ];
	}

	return false;
}


/**
 * Get saved user settings from database or theme defaults
 *
 * @return array
 */
function gt_spirit_theme_options() {

	// Merge theme options array from database with default options array.
	$theme_options = wp_parse_args( get_option( 'gt_spirit_theme_options', array() ), gt_spirit_default_options() );

	// Return theme options.
	return apply_filters( 'gt_spirit_theme_options', $theme_options );
}


/**
 * Returns the default settings of the theme
 *
 * @return array
 */
function gt_spirit_default_options() {

	$default_options = array(
		'site_title'         => true,
		'site_description'   => true,
		'primary_color'      => '#009966',
		'secondary_color'    => '#2cbe95',
		'accent_color'       => '#990033',
		'header_color'       => '#ffffff',
		'navi_color'         => '#009966',
		'footer_color'       => '#009966',
		'text_font'          => 'SystemFontStack',
		'title_font'         => 'SystemFontStack',
		'title_is_bold'      => false,
		'title_is_uppercase' => false,
		'navi_font'          => 'SystemFontStack',
		'navi_is_bold'       => false,
		'navi_is_uppercase'  => false,
		'license_key'        => '',
		'license_status'     => 'inactive',
	);

	return apply_filters( 'gt_spirit_default_options', $default_options );
}
