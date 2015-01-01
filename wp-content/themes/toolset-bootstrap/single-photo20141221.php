<?php
/**
 * The template for displaying single photo page
 *
 */
get_header(); ?>

	<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'content', 'photo' );
		endwhile;
	?>

	<ul class="nav-single pager" role="navigation">
			<li class="nav-previous previous">
				<?php previous_post_smart( '%link', '' . '&larr; '.'%title' ); ?>
			</li>
			<li class="nav-next next">
				<?php next_post_smart( '%link', '%title' .' &rarr;'); ?>
			</li>
		</ul>

		<?php //wp_related_posts()?>



<?php get_footer();