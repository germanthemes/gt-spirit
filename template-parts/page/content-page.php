<?php
/**
 * The template used for displaying page content in page.php
 *
 * @version 1.0
 * @package GT Spirit
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php gt_spirit_page_header(); ?>

	<div class="entry-content">

		<?php the_content(); ?>
		<?php wp_link_pages(); ?>

	</div><!-- .entry-content -->

</article>
