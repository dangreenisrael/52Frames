<?php
/**
 * The default template for displaying content.
 *
 */
?>

<article <?php post_class('clearfix') ?> id="post-<?php the_ID(); ?>">
	 <header>
	 	<?php if (is_single()): ?>
		<h1><?php the_title(); ?></h1>			
		<?php else: 
		$archive_looped_page=TRUE;?>
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to', 'wpbootstrap' ).' %s', the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
			<?php the_title(); ?>
			</a>
		</h2>
		<?php get_template_part('entry-meta'); ?>
		<?php endif; ?>
	</header>
	<div class="entry-content clearfix">
	<?php if ( has_post_thumbnail()): ?>
		<a href="<?php the_permalink(); ?>" class="post-thumbnail thumbnail pull-left">
		<?php the_post_thumbnail('thumb-780'); ?>
		</a>
	<?php endif; ?>
	<?php if (!is_single()):?>
		
		<?php the_excerpt(); ?>
		<a class="btn btn-primary btn-large" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to', 'wpbootstrap' ).' %s', the_title_attribute( 'echo=0' ) ) ); ?>">
		<?php _e( 'Read more', 'wpbootstrap' ) ?>
		</a>
		<?php else:
			the_content( '<span class="btn btn-small btn-primary pull-right">'.__( 'Read more', 'wpbootstrap' ).' &raquo;</span>' ); 
		 wpbootstrap_link_pages(); 
	 endif; ?>
	</div><!-- .entry-content -->

</article>

<?php comments_template();