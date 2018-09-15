<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @version 1.0
 * @package GT Spirit
 */

?>

		</main><!-- #main -->
	</div><!-- #content -->

	<?php do_action( 'gt_spirit_before_footer' ); ?>

	<footer id="colophon" class="site-footer">

		<div id="footer-line" class="footer-main">
			<?php gt_spirit_footer_text(); ?>
		</div><!-- .footer-main -->

	</footer><!-- #colophon -->

	<?php do_action( 'gt_spirit_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
