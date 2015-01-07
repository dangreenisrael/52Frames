<?php

/**
 * The template for displaying Albums.
 *
 */

get_header(); ?>

<div class="for-columns-3">
<div class="row-fluid">
<div class="holder span4">
<?php
$variable = get_field('winning_photo_first', 'photo_alboms_'.$term->term_id);
echo get_the_post_thumbnail($variable->ID, array(370, 270));
?>
</div>
<div class="holder span4">
<?php
$variable2 = get_field('winning_photo_second', 'photo_alboms_'.$term->term_id);
echo get_the_post_thumbnail($variable2->ID, array(370, 270));
?>
</div>
<div class="holder span4">
<?php
$variable3 = get_field('winning_photo_third', 'photo_alboms_'.$term->term_id);
echo get_the_post_thumbnail($variable3->ID, array(370, 270));
?>
</div>
</div>
</div>

<div class="for-columns-4">

<div class="row-fluid">

<div class="holder span3"><?php echo do_shortcode( '[searchandfilter id="133"]' ); ?></div>

<div class="holder span6"><?php echo do_shortcode( '[searchandfilter id="130"]' ); ?></div>

<?php if ( current_user_can( 'judge' ) ) : ?>

<div class="holder span3"><?php echo do_shortcode( '[searchandfilter id="164"]' ); ?></div>

<?php endif;?>

</div>

</div>



<?php

     // if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Custom Widget Area') ) : ?>

<?php //endif; ?>

<div class="for-columns-4">





<?php if ( have_posts() ) : ?>



	<?php

		while ( have_posts() ) : the_post();

			get_template_part( 'content', 'Albums_collection' );

		endwhile;

		wpbootstrap_content_nav();

	?>



<?php endif; ?>



</div>

<?php get_footer();