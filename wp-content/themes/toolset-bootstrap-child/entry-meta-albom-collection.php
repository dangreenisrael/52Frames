<?php
/**
 * The template for entry meta section
 *
 */
?>

<?php 
if ((is_single()) && ( 'post' != get_post_type() )) {
?>             

<?php if(wpbootstrap_get_setting('general_settings','display_postmeta_cpt')): ?>
	<div class="entry-meta">
		<p>
			<?php echo __( 'By', 'wpbootstrap' ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author">
				<?php echo get_the_author(); ?>
			</a>
		</p>
	</div><!-- .entry-meta -->
<?php endif; ?>

<?php 
} else {
?>
<?php if(wpbootstrap_get_setting('general_settings','display_postmeta')): ?>
	<div class="entry-meta">
		<p>
			<?php //echo __( 'By', 'wpbootstrap' ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author">
				<?php //echo get_the_author(); ?>
			</a>
		</p>

		<?php GetWtiLikePost(); ?>
		
	</div><!-- .entry-meta -->
<?php endif; ?>
<?php } ?>