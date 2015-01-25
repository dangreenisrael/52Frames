<?php
/**
 * The template for displaying all single posts
 *
 */
get_header(); ?>

<div class="row">
	<div class="span8">
		<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;
		?>

		<ul class="nav-single pager" role="navigation">
			<li class="nav-previous previous">
				<?php previous_post_link( '%link', '' . '&larr; '.'%title' ); ?>
			</li>
			<li class="nav-next next">
				<?php next_post_link( '%link', '%title' .' &rarr;'); ?>
			</li>
		</ul>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer();