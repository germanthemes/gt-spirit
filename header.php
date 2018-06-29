<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @version 1.0
 * @package GT Workout
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gt-workout' ); ?></a>

		<?php do_action( 'gt_workout_before_header' ); ?>

		<header id="masthead" class="site-header" role="banner">

			<div class="header-main container">

				<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

				<?php get_template_part( 'template-parts/header/site', 'navigation' ); ?>

			</div><!-- .header-main -->

		</header><!-- #masthead -->

		<?php do_action( 'gt_workout_after_header' ); ?>

		<?php gt_workout_header_image(); ?>

		<div id="content" class="site-content">

			<main id="main" class="site-main" role="main">
