<?php
/**
 * The template for the right sidebar
 *
 */?>
<section id="sidebar" class="<?php echo 'span'.of_get_option( 'sidebar_width' ) ?>" role="complementary">
	<?php
	if ( is_dynamic_sidebar() ):
		dynamic_sidebar( 'Sidebar' );
	?>
	<?php endif; ?>
</section><!-- #sidebar -->