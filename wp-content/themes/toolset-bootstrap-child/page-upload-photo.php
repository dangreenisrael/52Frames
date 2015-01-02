<?php
/*
Template Name: Page Upload Template
*/
get_header(); ?>

	<?php
		if(allowed_to_post_photo()){
			/* The user is allowed to post photo */
			while ( have_posts() ) :
				the_post();
				get_template_part( 'content', 'page' );
			endwhile;
		} else{
			/* The user already posted a photo */
			echo "<h2> Already Posted </h2>";
		}
	?>

<?php
	get_footer();
?>