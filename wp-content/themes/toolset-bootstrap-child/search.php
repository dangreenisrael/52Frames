<?php
/**
 * The template for displaying Search results.
 *
 */
get_header(); ?>
<div class="span8">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; 
		if ( function_exists( 'aero_page_navi' ) ) 	:			
				aero_page_navi();
		 endif;
	else : ?>

		<article id="post-0" class="post no-results not-found">

			<div class="entry-content">
				<p class="alert alert-error">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?php _e( 'No results were found for: "<strong>'.get_search_query().'"</strong>', 'wpbootstrap' ); ?>
				</p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->

		</article><!-- .post .no-results -->

	<?php endif; ?>
	 </div>
    <?php get_sidebar(); ?>

<?php get_footer();