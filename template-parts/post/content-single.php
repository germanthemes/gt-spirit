<?php
/**
 * The template for displaying single posts
 *
 * @version 1.0
 * @package GT Spirit
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-header-container entry-header-container">

		<?php gt_spirit_post_image_single(); ?>

		<header class="post-header entry-header">

			<?php the_title( '<h1 class="post-title entry-title">', '</h1>' ); ?>

			<?php gt_spirit_entry_meta(); ?>

		</header><!-- .entry-header -->

	</div>

	<div class="entry-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->

</article>
