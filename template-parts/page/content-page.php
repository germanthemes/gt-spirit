<?php
/**
 * The template used for displaying page content in page.php
 *
 * @version 1.0
 * @package GT Workout
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="page-header entry-header">

		<?php the_title( '<h1 class="page-title entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->

</article>