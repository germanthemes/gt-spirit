<?php
/**
 * GT Spirit functions and definitions
 *
 * @package GT Spirit
 */

/**
 * GT Spirit only works in WordPress 5.3 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/admin/back-compat.php';
	return;
}


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gt_spirit_setup() {

	// Make theme available for translation.
	load_theme_textdomain( 'gt-spirit', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Set default Post Thumbnail size.
	set_post_thumbnail_size( 960, 380, true );

	// Add image size for header image on single pages.
	add_image_size( 'gt-spirit-single-page', 1920, 560, true );

	// Register Navigation Menus.
	register_nav_menus( array(
		'primary' => esc_html__( 'Main Navigation', 'gt-spirit' ),
	) );

	// Switch default core markup for galleries and captions to output valid HTML5.
	add_theme_support( 'html5', array(
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom logo feature.
	add_theme_support( 'custom-logo', apply_filters( 'gt_spirit_custom_logo_args', array(
		'height'      => 50,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
	) ) );

	// Set up the WordPress core custom header feature.
	add_theme_support( 'custom-header', apply_filters( 'gt_spirit_custom_header_args', array(
		'header-text' => false,
		'width'       => 1920,
		'height'      => 560,
	) ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'gt_spirit_custom_background_args', array(
		'default-color' => 'ffffff',
	) ) );

	// Add Theme Support for Selective Refresh in Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'gt_spirit_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gt_spirit_content_width() {

	// Default content width.
	$content_width = 800;

	// Fullwidth content width.
	if ( is_page() && 'fullwidth' === get_post_meta( get_the_ID(), 'gt_page_layout', true ) ) {
		$content_width = 1120;
	}

	// Set global variable for content width.
	$GLOBALS['content_width'] = apply_filters( 'gt_spirit_content_width', $content_width );
}
add_action( 'after_setup_theme', 'gt_spirit_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function gt_spirit_scripts() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Register and Enqueue Stylesheet.
	wp_enqueue_style( 'gt-spirit-stylesheet', get_stylesheet_uri(), array(), $theme_version );

	// Register and enqueue navigation.js.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script( 'gt-spirit-navigation', get_theme_file_uri( '/assets/js/navigation.min.js' ), array( 'jquery' ), '1.0', true );
		$gt_spirit_l10n = array(
			'expand'   => esc_html__( 'Expand child menu', 'gt-spirit' ),
			'collapse' => esc_html__( 'Collapse child menu', 'gt-spirit' ),
			'icon'     => gt_spirit_get_svg( 'expand' ),
		);
		wp_localize_script( 'gt-spirit-navigation', 'gtSpiritScreenReaderText', $gt_spirit_l10n );
	}

	// Enqueue svgxuse to support external SVG Sprites in Internet Explorer.
	wp_enqueue_script( 'svgxuse', get_theme_file_uri( '/assets/js/svgxuse.min.js' ), array(), '1.2.4' );

	// Register Comment Reply Script for Threaded Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gt_spirit_scripts' );


/**
* Enqueue theme fonts.
*/
function gt_spirit_theme_fonts() {
	$fonts_url = gt_spirit_get_fonts_url();

	// Load Fonts if necessary.
	if ( $fonts_url ) {
		require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
		wp_enqueue_style( 'gt-spirit-theme-fonts', wptt_get_webfont_url( $fonts_url ), array(), '20210105' );
	}
}
add_action( 'wp_enqueue_scripts', 'gt_spirit_theme_fonts', 1 );
add_action( 'enqueue_block_editor_assets', 'gt_spirit_theme_fonts', 1 );


/**
 * Retrieve webfont URL to load fonts locally.
 */
function gt_spirit_get_fonts_url() {
	$font_families = array(
		'Quicksand:400,400italic,700,700italic',
	);

	$query_args = array(
		'family'  => urlencode( implode( '|', $font_families ) ),
		'subset'  => urlencode( 'latin,latin-ext' ),
		'display' => urlencode( 'swap' ),
	);

	return apply_filters( 'gt_spirit_get_fonts_url', add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );
}


/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function gt_spirit_widgets_init() {

	// Register Footer Column 1 widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'gt-spirit' ),
		'id'            => 'footer-column-1',
		'description'   => esc_html_x( 'Appears in the first column in footer.', 'widget area description', 'gt-spirit' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class = "widget-title">',
		'after_title'   => '</h4>',
	) );

	// Register Footer Column 2 widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'gt-spirit' ),
		'id'            => 'footer-column-2',
		'description'   => esc_html_x( 'Appears in the second column in footer.', 'widget area description', 'gt-spirit' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class = "widget-title">',
		'after_title'   => '</h4>',
	) );

	// Register Footer Column 3 widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'gt-spirit' ),
		'id'            => 'footer-column-3',
		'description'   => esc_html_x( 'Appears in the third column in footer.', 'widget area description', 'gt-spirit' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class = "widget-title">',
		'after_title'   => '</h4>',
	) );

	// Register Footer Column 4 widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'gt-spirit' ),
		'id'            => 'footer-column-4',
		'description'   => esc_html_x( 'Appears in the fourth column in footer.', 'widget area description', 'gt-spirit' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class = "widget-title">',
		'after_title'   => '</h4>',
	) );

	// Register Footer Copyright widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Copyright', 'gt-spirit' ),
		'id'            => 'footer-copyright',
		'description'   => esc_html_x( 'Appears in the bottom footer line.', 'widget area description', 'gt-spirit' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class = "widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'gt_spirit_widgets_init' );


/**
 * Set up automatic theme updates.
 *
 * @return void
 */
function gt_spirit_theme_updater() {
	if ( '' !== gt_spirit_get_option( 'license_key' ) ) :

		// Setup the updater.
		$theme_updater = new GT_Spirit_Theme_Updater(
			array(
				'remote_api_url' => GT_SPIRIT_STORE_API_URL,
				'version'        => '1.5.2',
				'license'        => trim( gt_spirit_get_option( 'license_key' ) ),
				'item_id'        => GT_SPIRIT_PRODUCT_ID,
				'item_name'      => 'GT Spirit',
				'theme_slug'     => 'gt-spirit',
				'author'         => 'GermanThemes',
			),
			array(
				'update-notice'    => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'gt-spirit' ),
				'update-available' => __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4$s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'gt-spirit' ),
			)
		);

	endif;
}
add_action( 'admin_init', 'gt_spirit_theme_updater', 0 );


/**
 * Include Files
 */

// Include Admin Classes.
require get_template_directory() . '/inc/admin/license-key.php';
require get_template_directory() . '/inc/admin/theme-updater.php';

// Include Customizer Options.
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// Include SVG Icon Functions.
require get_template_directory() . '/inc/icons.php';

// Include Template Functions.
require get_template_directory() . '/inc/template-functions.php';

// Include Template Tags.
require get_template_directory() . '/inc/template-tags.php';

// Include Gutenberg Features.
require get_template_directory() . '/inc/gutenberg.php';

// Include Customization Features.
require get_template_directory() . '/inc/custom-colors.php';
require get_template_directory() . '/inc/custom-fonts.php';
