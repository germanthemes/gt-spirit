<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package GT Spirit
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function gt_spirit_body_classes( $classes ) {

	// Get theme options from database.
	$theme_options = gt_spirit_theme_options();

	// Header Image added?
	if ( has_header_image() ) {
		$classes[] = 'header-image-added';
	}

	// Hide Date?
	if ( false === $theme_options['meta_date'] ) {
		$classes[] = 'date-hidden';
	}

	// Hide Author?
	if ( false === $theme_options['meta_author'] ) {
		$classes[] = 'author-hidden';
	}

	// Hide Category?
	if ( false === $theme_options['meta_category'] ) {
		$classes[] = 'categories-hidden';
	}

	// Featured Images?
	if ( true === $theme_options['post_image_archives'] ) {
		$classes[] = 'post-images-displayed';
	}

	// Single Featured Image?
	if ( true === $theme_options['post_image_single'] && is_single() ) {
		$classes[] = 'post-image-displayed';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'gt_spirit_body_classes' );


/**
 * Hide Elements with CSS.
 *
 * @return void
 */
function gt_spirit_hide_elements() {

	// Get theme options from database.
	$theme_options = gt_spirit_theme_options();

	$elements = array();

	// Hide Site Title?
	if ( false === $theme_options['site_title'] ) {
		$elements[] = '.site-title';
	}

	// Hide Site Description?
	if ( false === $theme_options['site_description'] ) {
		$elements[] = '.site-description';
	}

	// Hide Featured Header Image on single posts?
	if ( false === $theme_options['post_image_single'] ) {
		$elements[] = '.single-post .featured-header-image';
	}

	// Allow plugins to add own elements.
	$elements = apply_filters( 'gt_spirit_hide_elements', $elements );

	// Return early if no elements are hidden.
	if ( empty( $elements ) ) {
		return;
	}

	// Create CSS.
	$classes    = implode( ', ', $elements );
	$custom_css = $classes . ' { position: absolute; clip: rect(1px, 1px, 1px, 1px); width: 1px; height: 1px; overflow: hidden; }';

	// Add Custom CSS.
	wp_add_inline_style( 'gt-spirit-stylesheet', $custom_css );
}
add_filter( 'wp_enqueue_scripts', 'gt_spirit_hide_elements', 11 );
