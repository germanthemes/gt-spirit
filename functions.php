<?php
/**
 * GT Workout functions and definitions
 *
 * @package GT Workout
 */

/**
 * GT Workout only works in WordPress 5.0 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '5.0-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}


if ( ! function_exists( 'gt_workout_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function gt_workout_setup() {

		// Make theme available for translation. Translations can be filed at https://translate.wordpress.org/projects/wp-themes/gt-workout
		load_theme_textdomain( 'gt-workout', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Set default Post Thumbnail size.
		set_post_thumbnail_size( 720, 360, true );

		// Add image size for header image on single posts and pages.
		add_image_size( 'gt-workout-header-image', 2560, 640, true );

		// Register Navigation Menus.
		register_nav_menus( array(
			'primary' => esc_html__( 'Main Navigation', 'gt-workout' ),
		) );

		// Switch default core markup for galleries and captions to output valid HTML5.
		add_theme_support( 'html5', array(
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom logo feature.
		add_theme_support( 'custom-logo', apply_filters( 'gt_workout_custom_logo_args', array(
			'height'      => 60,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
		) ) );

		// Set up the WordPress core custom header feature.
		add_theme_support( 'custom-header', apply_filters( 'gt_workout_custom_header_args', array(
			'header-text' => false,
			'width'       => 2560,
			'height'      => 640,
		) ) );

		// Add Theme Support for Selective Refresh in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add theme support for wide and full images.
		add_theme_support( 'align-wide' );

		// Add theme support for block color palette.
		add_theme_support( 'editor-color-palette',
			array(
				'name'  => esc_html_x( 'Primary', 'block color', 'gt-workout' ),
				'color' => '#0c557a',
			),
			array(
				'name'  => esc_html_x( 'Secondary', 'block color', 'gt-workout' ),
				'color' => '#ff6600',
			),
			array(
				'name'  => esc_html_x( 'Accent', 'block color', 'gt-workout' ),
				'color' => '#a156b4',
			),
			array(
				'name'  => esc_html_x( 'White', 'block color', 'gt-workout' ),
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html_x( 'Light Gray', 'block color', 'gt-workout' ),
				'color' => '#e5e5e5',
			),
			array(
				'name'  => esc_html_x( 'Dark Gray', 'block color', 'gt-workout' ),
				'color' => '#444444',
			),
			array(
				'name'  => esc_html_x( 'Black', 'block color', 'gt-workout' ),
				'color' => '#151515',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'gt_workout_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gt_workout_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gt_workout_content_width', 1040 );
}
add_action( 'after_setup_theme', 'gt_workout_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function gt_workout_scripts() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Register and Enqueue Stylesheet.
	wp_enqueue_style( 'gt-workout-stylesheet', get_stylesheet_uri(), array(), $theme_version );

	// Register and enqueue navigation.js.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script( 'gt-workout-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$gt_workout_l10n = array(
			'expand'   => esc_html__( 'Expand child menu', 'gt-workout' ),
			'collapse' => esc_html__( 'Collapse child menu', 'gt-workout' ),
			'icon'     => gt_workout_get_svg( 'expand' ),
		);
		wp_localize_script( 'gt-workout-navigation', 'gtWorkoutScreenReaderText', $gt_workout_l10n );
	}

	// Enqueue svgxuse to support external SVG Sprites in Internet Explorer.
	wp_enqueue_script( 'svgxuse', get_theme_file_uri( '/assets/js/svgxuse.min.js' ), array(), '1.2.4' );
}
add_action( 'wp_enqueue_scripts', 'gt_workout_scripts' );


/**
 * Enqueue block styles for Gutenberg Editor.
 */
function gt_workout_block_editor_styles() {
	wp_enqueue_style( 'gt-workout-block-editor-styles', get_theme_file_uri( '/assets/css/editor.css' ), array(), '20180529', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'gt_workout_block_editor_styles' );


/**
 * Include Files
 */

// Include Customizer Options.
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// Include SVG Icon Functions.
require get_template_directory() . '/inc/icons.php';

// Include Template Functions.
require get_template_directory() . '/inc/template-functions.php';

// Include Template Tags.
require get_template_directory() . '/inc/template-tags.php';

// Include Customization Features.
require get_template_directory() . '/inc/custom-colors.php';
require get_template_directory() . '/inc/custom-fonts.php';