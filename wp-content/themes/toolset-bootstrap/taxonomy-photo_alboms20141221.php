<?php
/**
 * The template for displaying Alboms.
 *
 */
get_header(); ?>

<h4 class="album-week"><?php echo 'Week: ', date("W") . ' ', date("Y"); ?></h4>

<h1 class="album-title"><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?></h1>

<div class="album-description"><?php echo category_description( $category_id ); ?></div>

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
			get_template_part( 'content', 'alboms_collection' );
		endwhile;
		wpbootstrap_content_nav();
	?>

<?php endif; ?>

</div>
<?php get_footer();