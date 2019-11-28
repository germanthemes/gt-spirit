<?php
/**
 * Theme Links Control for the Customizer
 *
 * @package GT Spirit
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays the theme links in the Customizer.
	 */
	class GT_Spirit_Customize_Links_Control extends WP_Customize_Control {
		/**
		 * Render Control
		 */
		public function render_content() {
			?>

			<div class="theme-links">

				<span class="customize-control-title"><?php esc_html_e( 'Theme Links', 'gt-spirit' ); ?></span>

				<p>
					<a href="<?php echo esc_url( __( 'https://germanthemes.de/en/themes/gt-spirit/', 'gt-spirit' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Theme Page', 'gt-spirit' ); ?>
					</a>
				</p>

				<p>
					<a href="https://demo.germanthemes.de/?demo=gt-spirit" target="_blank">
						<?php esc_html_e( 'Theme Demo', 'gt-spirit' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://germanthemes.de/en/docs/gt-spirit-documentation/', 'gt-spirit' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Theme Documentation', 'gt-spirit' ); ?>
					</a>
				</p>

			</div>

			<?php
		}
	}

endif;
