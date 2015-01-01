<?php
/*
Template Name: Full width template - without sidebar
*/
get_header(); ?>

/*
	<?php

		while ( have_posts() ) : the_post();
			get_template_part( 'content', 'page' );
		endwhile;
	?>
*/

	$images =& get_children( 'post_type=attachment&post_mime_type=image&post_parent=10' );

	$counter=0;
	foreach( (array) $images as $attachment_id => $attachment )
	{
	$counter++;
	echo "<a href='".wp_get_attachment_link( $attachment_id ) . "'>image $counter</a><br />";
	}

<?php get_footer();