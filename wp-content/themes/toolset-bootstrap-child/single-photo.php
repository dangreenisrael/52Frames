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

		<?php //echo get_adjacent_id_smart( true ); ?>

		<?php //wp_related_posts()?>



<?php get_footer();