<?php

/**
 * The template for displaying Albums.
 *
 */

get_header(); ?>

<div class="row-fluid winners">
	<div class="container">
		<div class="span4 winner">
		<?php
		$variable = get_field('winning_photo_first', 'photo_alboms_'.$term->term_id);
		echo get_the_post_thumbnail($variable->ID, array(440, 295));
		?>
		</div>
		<div class="span4 1runner">
		<?php
		$variable2 = get_field('winning_photo_second', 'photo_alboms_'.$term->term_id);
		echo get_the_post_thumbnail($variable2->ID, array(440, 295));
		?>
		</div>
		<div class="span4 2runner">
		<?php
		$variable3 = get_field('winning_photo_third', 'photo_alboms_'.$term->term_id);
		echo get_the_post_thumbnail($variable3->ID, array(440, 295));
		?>
		</div>
	</div>
</div>

<div class="container">

<div class="row-fluid">

<div class="holder span3"><?php echo do_shortcode( '[searchandfilter id="133"]' ); ?></div>

<div class="holder span6"><?php echo do_shortcode( '[searchandfilter id="130"]' ); ?></div>

<?php if ( current_user_can( 'judge' ) ) : ?>

<div class="holder span3"><?php echo do_shortcode( '[searchandfilter id="164"]' ); ?></div>

<?php endif;?>

</div>





<?php

     // if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Custom Widget Area') ) : ?>

<?php //endif; ?>







<?php if ( have_posts() ) : ?>



	<?php

		while ( have_posts() ) : the_post();

			get_template_part( 'content-albums_collection' );

		endwhile;

		wpbootstrap_content_nav();

	?>



<?php endif; ?>



</div>

<?php get_footer();