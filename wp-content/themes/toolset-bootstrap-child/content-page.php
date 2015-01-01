<?php
/**
 * The template used for displaying page content in page.php
 *
 */
?>

<article <?php post_class('clearfix') ?> id="post-<?php the_ID(); ?>">
	<div class="entry-content">
		<?php the_content(); ?>
		<?php edit_post_link( __('Edit page','wpbootstrap'), '<p class="btn">', '</p>' ); ?>
	</div><!-- .entry-content -->

</article>

<?php wpbootstrap_link_pages(); ?>
