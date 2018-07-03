<?php
/**
 * The template used for displaying page content in page.php
 *
 * @version 1.0
 * @package GT Spirit
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="featured-image-container">

		<div class="post-image">
			<?php the_post_thumbnail( 'gt-spirit-header-image' ); ?>
		</div>

		<div class="page-header-container entry-header-container">

			<header class="page-header entry-header">

				<?php the_title( '<h1 class="page-title entry-title">', '</h1>' ); ?>

			</header><!-- .entry-header -->

		</div>

	</div>

	<div class="entry-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->

</article>
