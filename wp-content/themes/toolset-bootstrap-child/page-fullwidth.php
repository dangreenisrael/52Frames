<?php
/*
Template Name: Full width template - without sidebar
*/
get_header(); ?>


	<?php
		//get_active_album();
		while ( have_posts() ) :

			the_post();
			$albums = get_terms('photo_alboms', array('hide_empty' => false));
			//var_dump( get_active_album());
			//get_template_part( 'content', 'page' );
		endwhile;
	?>

<pre>
<?php

	$args = array(
		'post_type' => 'attachment',
		'numberposts' => -1,
		'post_status' => null,
		'post_parent' => null, // any parent,

	);

	$attachments = get_posts($args);
	var_dump( term_exists( 'photo-alboms') );
	echo get_active_album()->slug;
	if ($attachments) {
		foreach ($attachments as $post) {

			$product_terms = wp_get_object_terms( $post->ID,  'photo-alboms' );
			var_dump($product_terms);
		}
	}

	exit;
?>

<?php
	get_footer();
?>