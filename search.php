<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @version 1.0
 * @package GT Spirit
 */

get_header();

if ( have_posts() ) :

	gt_spirit_search_header();

	get_search_form();

	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/page/content', 'search' );

	endwhile;

	gt_spirit_pagination();

else :

	get_template_part( 'template-parts/page/content', 'none' );

endif;

get_footer();
