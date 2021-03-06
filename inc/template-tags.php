<?php
/**
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package GT Spirit
 */

if ( ! function_exists( 'gt_spirit_site_title' ) ) :
	/**
	 * Displays the site title in the header area
	 */
	function gt_spirit_site_title() {

		if ( is_home() ) : ?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<?php else : ?>

			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'gt_spirit_site_description' ) ) :
	/**
	 * Displays the site description in the header area
	 */
	function gt_spirit_site_description() {

		$description = get_bloginfo( 'description', 'display' ); /* WPCS: xss ok. */

		if ( $description || is_customize_preview() ) :
			?>

			<p class="site-description"><?php echo $description; ?></p>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'gt_spirit_header_image' ) ) :
	/**
	 * Displays the header image.
	 */
	function gt_spirit_header_image() {
		?>

		<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">

		<?php
	}
endif;


if ( ! function_exists( 'gt_spirit_blog_header' ) ) :
	/**
	 * Displays blog header with header image as background.
	 */
	function gt_spirit_blog_header() {
		// Return early if posts are displayed on front page.
		if ( 'page' !== get_option( 'show_on_front' ) || get_option( 'page_for_posts' ) < 1 ) {
			return;
		}

		if ( has_header_image() ) :
			?>

			<div class="featured-image-container">

				<div class="page-image">

					<?php gt_spirit_header_image(); ?>

				</div>

				<div class="blog-header-container entry-header-container">

					<?php gt_spirit_blog_title(); ?>

				</div>

			</div>

			<?php
		else :

			gt_spirit_blog_title();

		endif;
	}
endif;


if ( ! function_exists( 'gt_spirit_blog_title' ) ) :
	/**
	 * Displays the blog title.
	 */
	function gt_spirit_blog_title() {
		?>

		<header class="blog-header entry-header">

			<h1 class="blog-title entry-title">
				<?php echo esc_html( get_the_title( get_option( 'page_for_posts' ) ) ); ?>
			</h1>

		</header><!-- .blog-header -->

		<?php
	}
endif;


if ( ! function_exists( 'gt_spirit_archive_header' ) ) :
	/**
	 * Displays archive header with header image as background.
	 */
	function gt_spirit_archive_header() {
		if ( has_header_image() ) :
			?>

			<div class="featured-image-container">

				<div class="page-image">

					<?php gt_spirit_header_image(); ?>

				</div>

				<div class="archive-header-container entry-header-container">

					<?php gt_spirit_archive_title(); ?>

				</div>

			</div>

			<?php
		else :

			gt_spirit_archive_title();

		endif;
	}
endif;


if ( ! function_exists( 'gt_spirit_archive_title' ) ) :
	/**
	 * Displays the archive title.
	 */
	function gt_spirit_archive_title() {
		?>

		<header class="archive-header entry-header">

			<?php the_archive_title( '<h1 class="archive-title entry-title">', '</h1>' ); ?>
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>

		</header><!-- .archive-header -->

		<?php
	}
endif;


if ( ! function_exists( 'gt_spirit_search_header' ) ) :
	/**
	 * Displays search header with header image.
	 */
	function gt_spirit_search_header() {
		if ( has_header_image() ) :
			?>

			<div class="featured-image-container">

				<div class="page-image">

					<?php gt_spirit_header_image(); ?>

				</div>

				<div class="search-header-container entry-header-container">

					<?php gt_spirit_search_title(); ?>

				</div>

			</div>

			<?php
		else :

			gt_spirit_search_title();

		endif;
	}
endif;


if ( ! function_exists( 'gt_spirit_search_title' ) ) :
	/**
	 * Displays the title for search results.
	 */
	function gt_spirit_search_title() {
		?>

		<header class="search-header entry-header">

			<h1 class="search-title entry-title"><?php printf( esc_html__( 'Search Results for: %s', 'gt-spirit' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

		</header><!-- .search-header -->

		<?php
	}
endif;


if ( ! function_exists( 'gt_spirit_page_header' ) ) :
	/**
	 * Displays page header with featured image on single pages.
	 */
	function gt_spirit_page_header() {

		if ( has_post_thumbnail() || has_header_image() ) :
			?>

			<div class="featured-image-container">

				<div class="page-image">

					<?php
					if ( has_post_thumbnail() ) :

						the_post_thumbnail( 'gt-spirit-single-page' );

					else :

						gt_spirit_header_image();

					endif;
					?>

				</div>

				<div class="page-header-container entry-header-container">

					<?php gt_spirit_page_title(); ?>

				</div>

			</div>

			<?php
		else :

			gt_spirit_page_title();

		endif;
	}
endif;


if ( ! function_exists( 'gt_spirit_page_title' ) ) :
	/**
	 * Displays the page title for single pages.
	 */
	function gt_spirit_page_title() {
		?>

		<header class="page-header entry-header">

			<?php the_title( '<h1 class="page-title entry-title">', '</h1>' ); ?>

		</header><!-- .entry-header -->

		<?php
	}
endif;


if ( ! function_exists( 'gt_spirit_post_image' ) ) :
	/**
	 * Displays the featured image on posts.
	 */
	function gt_spirit_post_image() {
		if ( ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<figure class="post-image post-image-single">
				<?php the_post_thumbnail(); ?>
			</figure>

			<?php
		else :
			?>

			<figure class="post-image post-image-archives">
				<a class="wp-post-image-link" href="<?php the_permalink(); ?>" rel="bookmark" aria-hidden="true">
					<?php the_post_thumbnail(); ?>
				</a>
			</figure>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'gt_spirit_entry_meta' ) ) :
	/**
	 * Displays the date and author of a post
	 */
	function gt_spirit_entry_meta() {

		$postmeta  = gt_spirit_entry_date();
		$postmeta .= gt_spirit_entry_author();
		$postmeta .= gt_spirit_entry_categories();

		echo '<div class="entry-meta">' . $postmeta . '</div>';
	}
endif;


if ( ! function_exists( 'gt_spirit_entry_date' ) ) :
	/**
	 * Returns the post date
	 */
	function gt_spirit_entry_date() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'gt-spirit' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		return '<span class="posted-on">' . $posted_on . '</span>';
	}
endif;


if ( ! function_exists( 'gt_spirit_entry_author' ) ) :
	/**
	 * Returns the post author
	 */
	function gt_spirit_entry_author() {

		$author_string = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'gt-spirit' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);

		$posted_by = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'gt-spirit' ),
			$author_string
		);

		return '<span class="posted-by"> ' . $posted_by . '</span>';
	}
endif;


if ( ! function_exists( 'gt_spirit_entry_categories' ) ) :
	/**
	 * Displays the post categories
	 */
	function gt_spirit_entry_categories() {

		// Return early if post has no category.
		if ( ! has_category() ) {
			return;
		}

		$posted_in = sprintf(
			/* translators: %s: post category. */
			esc_html_x( 'in %s', 'post category', 'gt-spirit' ),
			get_the_category_list( ', ' )
		);

		return '<span class="posted-in"> ' . $posted_in . '</span>';
	}
endif;


if ( ! function_exists( 'gt_spirit_entry_tags' ) ) :
	/**
	 * Displays the post tags on single post view
	 */
	function gt_spirit_entry_tags() {
		// Get tags.
		$tag_list = get_the_tag_list( esc_html__( 'Tags: ', 'gt-spirit' ), ', ' );

		// Display tags.
		if ( $tag_list ) :
			echo '<p class="entry-tags">' . $tag_list . '</p>';
		endif;
	}
endif;



if ( ! function_exists( 'gt_spirit_pagination' ) ) :
	/**
	 * Displays pagination on archive pages
	 */
	function gt_spirit_pagination() {

		the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&laquo<span class="screen-reader-text">' . esc_html_x( 'Previous Posts', 'pagination', 'gt-spirit' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Posts', 'pagination', 'gt-spirit' ) . '</span>&raquo;',
		) );
	}
endif;
