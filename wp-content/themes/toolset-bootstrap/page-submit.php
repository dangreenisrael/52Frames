<?php
/*
Template Name: Full width template - submit form
*/
get_header(); ?>

<h4><?php echo 'Week: ', date("W"); ?>
	<?php get_the_category( $id ); ?>
</h4>

	<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'content', 'submit' );
		endwhile;
	?>

<?php get_footer();