<?php

/*

Template Name: Home page template

*/

get_header(); ?>

	<?php
	
		while ( have_posts() ) : the_post();

			get_template_part( 'content', 'home' );

		endwhile;

	?>


<?php get_footer();