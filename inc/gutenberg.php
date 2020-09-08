<?php
/**
 * Add theme support for the Gutenberg Editor
 *
 * @package GT Spirit
 */


/**
 * Registers support for various Gutenberg features.
 *
 * @return void
 */
function gt_spirit_gutenberg_support() {

	// Get theme options from database.
	$theme_options = gt_spirit_theme_options();

	// Add theme support for wide and full images.
	add_theme_support( 'align-wide' );

	// Add theme support for block color palette.
	add_theme_support( 'editor-color-palette', apply_filters( 'gt_spirit_editor_color_palette_args', array(
		array(
			'name'  => esc_html_x( 'Primary', 'block color', 'gt-spirit' ),
			'slug'  => 'primary',
			'color' => esc_html( $theme_options['primary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Secondary', 'block color', 'gt-spirit' ),
			'slug'  => 'secondary',
			'color' => esc_html( $theme_options['secondary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Accent', 'block color', 'gt-spirit' ),
			'slug'  => 'accent',
			'color' => esc_html( $theme_options['accent_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Highlight', 'block color', 'gt-spirit' ),
			'slug'  => 'highlight',
			'color' => esc_html( $theme_options['highlight_color'] ),
		),
		array(
			'name'  => esc_html_x( 'White', 'block color', 'gt-spirit' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => esc_html_x( 'Light Gray', 'block color', 'gt-spirit' ),
			'slug'  => 'light-gray',
			'color' => esc_html( $theme_options['light_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Gray', 'block color', 'gt-spirit' ),
			'slug'  => 'gray',
			'color' => esc_html( $theme_options['gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Dark Gray', 'block color', 'gt-spirit' ),
			'slug'  => 'dark-gray',
			'color' => esc_html( $theme_options['dark_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Black', 'block color', 'gt-spirit' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
	) ) );

	// Add theme support for font sizes.
	add_theme_support( 'editor-font-sizes', apply_filters( 'gt_spirit_editor_font_sizes_args', array(
		array(
			'name' => esc_html_x( 'Small', 'block font size', 'gt-spirit' ),
			'size' => 16,
			'slug' => 'small',
		),
		array(
			'name' => esc_html_x( 'Medium', 'block font size', 'gt-spirit' ),
			'size' => 20,
			'slug' => 'medium',
		),
		array(
			'name' => esc_html_x( 'Large', 'block font size', 'gt-spirit' ),
			'size' => 24,
			'slug' => 'large',
		),
		array(
			'name' => esc_html_x( 'Extra Large', 'block font size', 'gt-spirit' ),
			'size' => 36,
			'slug' => 'extra-large',
		),
	) ) );

	// Register Small Buttons Block style.
	register_block_style( 'core/buttons', array(
		'name'         => 'gt-small',
		'label'        => esc_html__( 'GT Small', 'gt-spirit' ),
		'style_handle' => 'gt-spirit-stylesheet',
	) );

	// Register Large Buttons Block style.
	register_block_style( 'core/buttons', array(
		'name'         => 'gt-large',
		'label'        => esc_html__( 'GT Large', 'gt-spirit' ),
		'style_handle' => 'gt-spirit-stylesheet',
	) );

	// Check if block pattern functions are available.
	if ( function_exists( 'register_block_pattern' ) && function_exists( 'register_block_pattern_category' ) ) {

		// Register block pattern category.
		register_block_pattern_category( 'gt-spirit', array( 'label' => esc_html__( 'GT Spirit', 'gt-spirit' ) ) );

		// Register Block patterns.
		register_block_pattern( 'gt-spirit/hero-section', array(
			'title'      => esc_html__( 'Hero Section', 'gt-spirit' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"primary\",\"textColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-color has-primary-background-color has-text-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:group {\"align\":\"wide\"} --><div class=\"wp-block-group alignwide\"><div class=\"wp-block-group__inner-container\"><!-- wp:spacer {\"height\":50} --><div style=\"height:50px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div><!-- /wp:spacer --><!-- wp:heading {\"align\":\"center\",\"level\":1,\"fontSize\":\"huge\"} --><h1 class=\"has-text-align-center has-huge-font-size\">Hero Heading</h1><!-- /wp:heading --><!-- wp:paragraph {\"align\":\"center\"} --><p class=\"has-text-align-center\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis diss parturient montes, nascetur ridiculus mus. </p><!-- /wp:paragraph --><!-- wp:buttons {\"align\":\"center\",\"className\":\"is-style-gt-large\"} --><div class=\"wp-block-buttons aligncenter is-style-gt-large\"><!-- wp:button {\"backgroundColor\":\"secondary\",\"textColor\":\"white\"} --><div class=\"wp-block-button\"><a class=\"wp-block-button__link has-white-color has-secondary-background-color has-text-color has-background\">Button 1</a></div><!-- /wp:button --><!-- wp:button {\"backgroundColor\":\"secondary\",\"className\":\"is-style-fill\"} --><div class=\"wp-block-button is-style-fill\"><a class=\"wp-block-button__link has-secondary-background-color has-background\">Button 2</a></div><!-- /wp:button --></div><!-- /wp:buttons --><!-- wp:spacer {\"height\":75} --><div style=\"height:75px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div><!-- /wp:spacer --></div></div><!-- /wp:group --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-spirit' ),
		) );

		register_block_pattern( 'gt-spirit/portfolio', array(
			'title'      => esc_html__( 'Portfolio', 'gt-spirit' ),
			'content'    => "<!-- wp:columns {\"align\":\"wide\"} --><div class=\"wp-block-columns alignwide\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"className\":\"is-style-default\"} --><figure class=\"wp-block-image is-style-default\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading {\"level\":3} --><h3>Project 1</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"className\":\"is-style-default\"} --><figure class=\"wp-block-image is-style-default\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading {\"level\":3} --><h3>Project 2</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"className\":\"is-style-default\"} --><figure class=\"wp-block-image is-style-default\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading {\"level\":3} --><h3>Project 3</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns -->",
			'categories' => array( 'gt-spirit' ),
		) );

		register_block_pattern( 'gt-spirit/call-to-action', array(
			'title'      => esc_html__( 'Call to Action', 'gt-spirit' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"primary\",\"textColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-color has-primary-background-color has-text-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:paragraph {\"align\":\"center\",\"fontSize\":\"extra-large\"} --><p class=\"has-text-align-center has-extra-large-font-size\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><!-- /wp:paragraph --></div></div><!-- /wp:group --><!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:paragraph {\"align\":\"center\",\"fontSize\":\"large\"} --><p class=\"has-text-align-center has-large-font-size\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --><!-- wp:buttons {\"align\":\"center\",\"className\":\"is-style-gt-large\"} --><div class=\"wp-block-buttons aligncenter is-style-gt-large\"><!-- wp:button --><div class=\"wp-block-button\"><a class=\"wp-block-button__link\">Button</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-spirit' ),
		) );

		register_block_pattern( 'gt-spirit/services', array(
			'title'      => esc_html__( 'Services', 'gt-spirit' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:media-text --><div class=\"wp-block-media-text alignwide is-stacked-on-mobile\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:heading --><h2>Service 01</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --></div></div><!-- /wp:group --><!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"primary\",\"textColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-color has-primary-background-color has-text-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:media-text {\"mediaPosition\":\"right\"} --><div class=\"wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:heading {\"textColor\":\"white\"} --><h2 class=\"has-white-color has-text-color\">Service 02</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --></div></div><!-- /wp:group --><!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:media-text --><div class=\"wp-block-media-text alignwide is-stacked-on-mobile\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:heading --><h2>Service 03</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-spirit' ),
		) );
	}
}
add_action( 'after_setup_theme', 'gt_spirit_gutenberg_support' );


/**
 * Enqueue block styles and scripts for Gutenberg Editor.
 */
function gt_spirit_block_editor_assets() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Enqueue Editor Styling.
	wp_enqueue_style( 'gt-spirit-editor-styles', get_theme_file_uri( '/assets/css/editor-styles.css' ), array(), $theme_version, 'all' );

	// Enqueue Theme Settings Sidebar plugin.
	wp_enqueue_script( 'gt-spirit-editor-theme-settings', get_theme_file_uri( '/assets/js/editor-theme-settings.js' ), array( 'wp-blocks', 'wp-element', 'wp-edit-post' ), $theme_version );

	$theme_settings_l10n = array(
		'plugin_title'         => esc_html__( 'Theme Settings', 'gt-spirit' ),
		'page_options'         => esc_html__( 'Page Options', 'gt-spirit' ),
		'page_layout'          => esc_html__( 'Page Layout', 'gt-spirit' ),
		'default_layout'       => esc_html__( 'Default', 'gt-spirit' ),
		'full_layout'          => esc_html__( 'Full-width', 'gt-spirit' ),
		'hide_title'           => esc_html__( 'Hide title?', 'gt-spirit' ),
		'remove_bottom_margin' => esc_html__( 'Remove bottom margin?', 'gt-spirit' ),
	);
	wp_localize_script( 'gt-spirit-editor-theme-settings', 'gtThemeSettingsL10n', $theme_settings_l10n );
}
add_action( 'enqueue_block_editor_assets', 'gt_spirit_block_editor_assets' );


/**
 * Register Post Meta
 */
function gt_spirit_register_post_meta() {
	register_post_meta( 'page', 'gt_page_layout', array(
		'type'              => 'string',
		'single'            => true,
		'show_in_rest'      => true,
		'sanitize_callback' => 'sanitize_text_field',
	) );

	register_post_meta( 'page', 'gt_hide_page_title', array(
		'type'         => 'boolean',
		'single'       => true,
		'show_in_rest' => true,
	) );

	register_post_meta( 'page', 'gt_remove_bottom_margin', array(
		'type'         => 'boolean',
		'single'       => true,
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'gt_spirit_register_post_meta' );


/**
 * Add body classes in Gutenberg Editor.
 */
function gt_spirit_gutenberg_add_admin_body_class( $classes ) {
	global $post;
	$current_screen = get_current_screen();

	// Return early if we are not in the Gutenberg Editor.
	if ( ! ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) ) {
		return $classes;
	}

	// Fullwidth Page Layout?
	if ( get_post_type( $post->ID ) && 'fullwidth' === get_post_meta( $post->ID, 'gt_page_layout', true ) ) {
		$classes .= ' gt-fullwidth-page-layout ';
	}

	// Page Title hidden?
	if ( get_post_type( $post->ID ) && get_post_meta( $post->ID, 'gt_hide_page_title', true ) ) {
		$classes .= ' gt-page-title-hidden ';
	}

	// Remove bottom margin of page?
	if ( get_post_type( $post->ID ) && get_post_meta( $post->ID, 'gt_remove_bottom_margin', true ) ) {
		$classes .= ' gt-page-bottom-margin-removed ';
	}

	return $classes;
}
add_filter( 'admin_body_class', 'gt_spirit_gutenberg_add_admin_body_class' );


/**
 * Remove inline styling in Gutenberg.
 *
 * @return array $editor_settings
 */
function gt_spirit_block_editor_settings( $editor_settings ) {
	// Remove editor styling.
	if ( ! current_theme_supports( 'editor-styles' ) ) {
		$editor_settings['styles'] = '';
	}

	return $editor_settings;
}
add_filter( 'block_editor_settings', 'gt_spirit_block_editor_settings', 11 );
