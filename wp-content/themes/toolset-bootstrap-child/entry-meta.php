<?php
/**
 * The template for entry meta section
 *
 */
?>
<p class="author">
	<?php echo __( 'By', 'wpbootstrap' ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author"-->
		<?php echo get_the_author(); ?>
	</a>
	<time datetime="<?php echo get_the_time( 'c' ); ?>">
		<?php echo sprintf( '/ %s ', get_the_date()); ?>
	</time>	
</p>

<div class="entry-meta">
	<?php if (has_category() || has_tag() ):?>			
		<?php if (has_category()): ?>
		<span class="post-cat"><?php _e( '<strong>Category</strong>', 'wpbootstrap' ); echo ' ';echo get_the_category_list( ', ' ); ?></span>
		<?php endif; ?>
		<span class="post-comments"><i class="fa fa-comments-o"></i><?php comments_popup_link( __( '<span>No</span> Comments', 'wpbootstrap' ), __( '<span>1</span> Comment', 'wpbootstrap' ), __( '<span>%</span> Comments', 'wpbootstrap' ) );?></span>
	<?php endif; ?>
</div>
