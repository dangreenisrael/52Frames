<?php
/**
 * The template for displaying Categories.
 *
 */
get_header(); ?>
<div class="span8">
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
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; 
		if ( function_exists( 'aero_page_navi' ) ) 	:			
				aero_page_navi();
		 endif;

	 else : ?>

		<article id="post-0" class="post no-results not-found">

			<h1 class="entry-title"><?php _e('Page not found','wpbootstrap'); ?></h1>

			<div class="entry-content">
				<p><?php _e( 'No results were found.', 'wpbootstrap' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->

		</article><!-- .post .no-results -->

	<?php endif; ?>
	 </div>
    <?php get_sidebar(); ?>

<?php get_footer();