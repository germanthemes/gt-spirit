<?php
/**
 * The template for displaying the blog index (latest posts)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @version 1.0
 * @package GT Spirit
 */

get_header();

if ( have_posts() ) :

	gt_spirit_blog_header();

	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/post/content' );

	endwhile;

	gt_spirit_pagination();

else :

	get_template_part( 'template-parts/page/content', 'none' );

endif;

get_footer();
