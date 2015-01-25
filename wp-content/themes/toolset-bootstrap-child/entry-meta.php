<?php
/**
 * The template for entry meta section
 *
 */
?>
<?php  if (!is_single()): ?>		

		<p class="author">
			<?php echo __( 'By', 'wpbootstrap' ); ?> <!--a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author"-->
				<?php echo get_the_author(); ?>
			<!--/a-->
			<time datetime="<?php echo get_the_time( 'c' ); ?>">
				<?php echo sprintf( '/ %s ', get_the_date()); ?>
			</time>	
		</p>
<?php endif;?>
		<div class="entry-meta">
			<?php if (has_category() || has_tag() ):?>			
				<?php if (has_category()): ?>
				<?php _e( '<strong>Categories</strong>', 'wpbootstrap' ); echo ' ';echo get_the_category_list( ', ' ); ?>.
				<?php endif; ?>
				<?php if (has_tag()): ?>
				<?php _e( '<strong>Tags</strong>', 'wpbootstrap' ); echo ' ';echo get_the_tag_list('',', ',''); ?>.
				<?php endif; ?>
				<i class="fa fa-comments-o"></i><?php comments_popup_link( __( '<span>No</span> Comments', 'wpbootstrap' ), __( '<span>1</span> Comment', 'wpbootstrap' ), __( '<span>%</span> Comments', 'wpbootstrap' ) );?>
			<?php endif; ?>
		</div>
