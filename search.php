<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @version 1.0
 * @package GT Workout
 */

get_header();

if ( have_posts() ) :

	gt_workout_search_header();

	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/page/content', 'search' );

	endwhile;

	gt_workout_pagination();

else :

	get_template_part( 'template-parts/page/content', 'none' );

endif;

get_footer();