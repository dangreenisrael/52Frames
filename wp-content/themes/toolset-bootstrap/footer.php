<?php
/**
 * The template for displaying the footer.
 *
 */
?>
			</section><!-- #content -->
			<?php
				// Display the sidebar if enabled except the full page template.
				if ( wpbootstrap_get_setting('general_settings','display_sidebar') && (!is_page_template('page-fullwidth.php')) ) {
					do_action( 'wpbootstrap_get_sidebar' );
				}
			?>
		</div><!-- #main -->

		<?php
			if ( wpbootstrap_get_setting('general_settings','display_footer_widgets') ) {
				get_sidebar('footer-widgets');
			}
		?>

		<?php do_action( 'wpbootstrap_before_footer' ); ?>
		<?php if ( wpbootstrap_get_setting('general_settings', 'display_footer' ) ): ?>
		    <?php if (of_get_option('display_credit_footer')) : ?>
			<footer id="footer" class="muted">
				<div class="container top-footer">
					<div class="container">
					  <h3>Just Some Title</h3>
					  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
					</div>
				</div>
				<div class="container-fluid bottom-footer">
					<div class="container ">
						<p class="pull-left"><?php echo of_get_option('display_credit_footer_left'); ?></p>
						<p class="pull-right"><?php echo of_get_option('display_credit_footer_right'); ?></p>
					</div>
				</div>
			</footer>
			<?php endif; ?>
		<?php endif; ?>
		<?php do_action( 'wpbootstrap_after_footer' ); ?>

	</div><!-- .container -->

<?php do_action( 'wpbootstrap_before_wp_footer' ); ?>
<?php wp_footer(); ?>
<?php do_action( 'wpbootstrap_after_wp_footer' ); ?>

</body>
</html>