<?php
/**
 * Custom Colors
 *
 * Generates Custom CSS code for Color Settings
 *
 * @package GT Spirit
 */

/**
 * Custom Colors Class
 */
class GT_Spirit_Custom_Colors {

	/**
	 * Actions Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Add Custom Fonts CSS code to frontend.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'add_custom_colors_in_frontend' ), 11 );

		// Add Custom Fonts CSS code to editor.
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'add_custom_colors_in_editor' ), 11 );
	}

	/**
	 * Add Font Family CSS styles in the head area of the theme.
	 */
	static function add_custom_colors_in_frontend() {
		wp_add_inline_style( 'gt-spirit-stylesheet', self::get_custom_colors_css() );
	}

	/**
	 * Add Font Family CSS styles in the head area of the Gutenberg editor.
	 */
	static function add_custom_colors_in_editor() {
		wp_add_inline_style( 'gt-spirit-block-editor', self::get_custom_colors_css() );
	}

	/**
	 * Generate Color CSS styles to override default colors.
	 *
	 * @return string CSS code
	 */
	static function get_custom_colors_css() {

		// Get theme options from database.
		$theme_options = gt_spirit_theme_options();

		// Get default colors.
		$default = gt_spirit_default_options();

		// Color Variables.
		$color_variables = '';

		// Set Primary Link Color.
		if ( $theme_options['link_color'] !== $default['link_color'] ) {
			$color_variables .= '--link-color: ' . $theme_options['link_color'] . ';';
			$color_variables .= '--button-color: ' . $theme_options['link_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['link_color'] ) ) {
				$color_variables .= '--button-text-color: #252525;';
			}
		}

		// Set Secondary Link Color.
		if ( $theme_options['link_hover_color'] !== $default['link_hover_color'] ) {
			$color_variables .= '--link-hover-color: ' . $theme_options['link_hover_color'] . ';';
			$color_variables .= '--button-hover-color: ' . $theme_options['link_hover_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['link_hover_color'] ) ) {
				$color_variables .= '--button-hover-text-color: #252525;';
			}
		}

		// Set Header Color.
		if ( $theme_options['header_color'] !== $default['header_color'] ) {
			$color_variables .= '--header-background-color: ' . $theme_options['header_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_dark( $theme_options['header_color'] ) ) {
				$color_variables .= '--header-text-color: #ffffff;';
				$color_variables .= '--header-border-color: rgba(255, 255, 255, 0.1);';
				$color_variables .= '--header-border-width: 0;';
			}
		}

		// Set Navigation Submenu Color.
		if ( $theme_options['navi_color'] !== $default['navi_color'] ) {
			$color_variables .= '--header-hover-text-color: ' . $theme_options['navi_color'] . ';';
			$color_variables .= '--submenu-color: ' . $theme_options['navi_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['navi_color'] ) ) {
				$color_variables .= '--submenu-text-color: #252525;';
				$color_variables .= '--submenu-hover-text-color: rgba(0, 0, 0, 0.5);';
			}
		}

		// Set Title Color.
		if ( $theme_options['title_color'] !== $default['title_color'] ) {
			$color_variables .= '--title-color: ' . $theme_options['title_color'] . ';';
		}

		// Set Title Hover Color.
		if ( $theme_options['title_hover_color'] !== $default['title_hover_color'] ) {
			$color_variables .= '--title-hover-color: ' . $theme_options['title_hover_color'] . ';';
		}

		// Set Footer Color.
		if ( $theme_options['footer_color'] !== $default['footer_color'] ) {
			$color_variables .= '--footer-color: ' . $theme_options['footer_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_dark( $theme_options['footer_color'] ) ) {
				$color_variables .= '--footer-text-color: #ffffff;';
				$color_variables .= '--footer-hover-text-color: rgba(255, 255, 255, 0.5);';
				$color_variables .= '--footer-border-color: rgba(255, 255, 255, 0.035);';
			}
		}

		// Set Block Primary Color.
		if ( $theme_options['block_primary_color'] !== $default['block_primary_color'] ) {
			$color_variables .= '--block-primary-color: ' . $theme_options['block_primary_color'] . ';';
		}

		// Set Block Secondary Color.
		if ( $theme_options['block_secondary_color'] !== $default['block_secondary_color'] ) {
			$color_variables .= '--block-secondary-color: ' . $theme_options['block_secondary_color'] . ';';
		}

		// Set Block Accent Color.
		if ( $theme_options['block_accent_color'] !== $default['block_accent_color'] ) {
			$color_variables .= '--block-accent-color: ' . $theme_options['block_accent_color'] . ';';
		}

		// Set Block Complementary Color.
		if ( $theme_options['block_complementary_color'] !== $default['block_complementary_color'] ) {
			$color_variables .= '--block-complementary-color: ' . $theme_options['block_complementary_color'] . ';';
		}

		// Return if no color variables were defined.
		if ( '' === $color_variables ) {
			return;
		}

		// Sanitize CSS Code.
		$custom_css .= ':root {' . $color_variables . '}';
		$custom_css  = wp_kses( $custom_css, array( '\'', '\"' ) );
		$custom_css  = str_replace( '&gt;', '>', $custom_css );
		$custom_css  = preg_replace( '/\n/', '', $custom_css );
		$custom_css  = preg_replace( '/\t/', '', $custom_css );

		return $custom_css;
	}

	/**
	 * Returns color brightness.
	 *
	 * @param int Number of brightness.
	 */
	static function get_color_brightness( $hex_color ) {

		// Remove # string.
		$hex_color = str_replace( '#', '', $hex_color );

		// Convert into RGB.
		$r = hexdec( substr( $hex_color, 0, 2 ) );
		$g = hexdec( substr( $hex_color, 2, 2 ) );
		$b = hexdec( substr( $hex_color, 4, 2 ) );

		return ( ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000 );
	}

	/**
	 * Check if the color is light.
	 *
	 * @param bool True if color is light.
	 */
	static function is_color_light( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) > 130 );
	}

	/**
	 * Check if the color is dark.
	 *
	 * @param bool True if color is dark.
	 */
	static function is_color_dark( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) <= 130 );
	}
}

// Run Class.
GT_Spirit_Custom_Colors::setup();
