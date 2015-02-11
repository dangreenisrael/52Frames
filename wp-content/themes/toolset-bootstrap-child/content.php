<?php
/**
 * The default template for displaying content.
 *
 */
?>

<article <?php post_class('clearfix') ?> id="post-<?php the_ID(); ?>">
	 <header>
	 	<?php if (!is_single()):
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
	<?php if (!is_single()):?>
	<?php if ( has_post_thumbnail()): ?>
		<a href="<?php the_permalink(); ?>" class="post-thumbnail thumbnail">
		<?php the_post_thumbnail('thumb-780'); ?>
		</a>
	<?php endif; ?>
		
		<?php the_excerpt(); ?>
		<a class="btn btn-primary btn-large" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to', 'wpbootstrap' ).' %s', the_title_attribute( 'echo=0' ) ) ); ?>">
		<?php _e( '... Read More', 'wpbootstrap' ) ?>
		</a>
		<?php else:
			the_content( '<span class="btn btn-small btn-primary pull-right">'.__( 'Read more', 'wpbootstrap' ).' &raquo;</span>' ); 
			?>
			<div class="entry-meta row">
				<?php if (has_category() || has_tag() ):?>			
					<?php if (has_category()): ?>
					<div class="post-cat span4"><?php _e( '<strong>Category</strong>', 'wpbootstrap' ); echo ' ';echo get_the_category_list( ', ' ); ?></div>
					<?php endif; ?>
					<?php if (has_tag()): ?>
					<div class="post-tags span8"><?php _e( '<strong>Tags</strong>', 'wpbootstrap' ); echo ' ';echo get_the_tag_list('',', ',''); ?></div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<div class="about-author-container clearfix">
	            <div class="avatar-cell span3">
	              <?php echo get_avatar(get_the_author_meta('email'), '100'); ?>
	            </div>
	            <div class="description span9">
	            	<h2 class="title"><?php the_author(); ?></h2>
	             	 <?php the_author_meta("description"); ?>
	            	<!--div class="author-link">View All Posts By <?php the_author_posts_link(''); ?></div-->
	            </div>
          </div>
	<?php  endif; ?>
	</div><!-- .entry-content -->
	<?php comments_template();?>
</article>

