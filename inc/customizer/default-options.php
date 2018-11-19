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
		'site_title'       => true,
		'site_description' => true,
		'primary_color'    => '#009966',
		'secondary_color'  => '#2cbe95',
		'header_color'     => '#ffffff',
		'navi_color'       => '#009966',
		'footer_color'     => '#ffffff',
		'text_font'        => 'Quicksand',
		'title_font'       => 'Raleway',
		'navi_font'        => 'Quicksand',
		'footer_text'      => sprintf( '&copy; %1$s %2$s', date( 'Y' ), get_bloginfo( 'name' ) ),
	);

	return apply_filters( 'gt_spirit_default_options', $default_options );
}
