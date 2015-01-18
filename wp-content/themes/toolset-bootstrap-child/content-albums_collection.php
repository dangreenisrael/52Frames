<?php
/**
 * The default template for displaying a photo page.
 *
 */
?>


<!--<div class="raw">-->
<div class="span3">
	<article <?php post_class('clearfix') ?> id="post-<?php the_ID(); ?>">
	<!--<div class="col-md-8">-->
		<div class="photo-thumbnail">
			<div class="entry-content clearfix">

					<?php if ( has_post_thumbnail() && wpbootstrap_get_setting('general_settings','display_thumbnails') ): ?>
						<a href="<?php the_permalink(); ?>" class="post-thumbnail thumbnail pull-left">
							<?php the_post_thumbnail('thumb-480'); ?>
							<?php if (function_exists('exifography_display_exif')) exifography_display_exif($options); ?>
							<?php echo "nudity:".get_post_meta( get_the_id(), 'wpcf-this-photo-contains-nudity', true);?>
						</a>
					<?php endif; ?>
				
			</div>
			<div class="photo-meta">
			<p>
				<?php /* echo <a href="get_author_posts_url( get_the_author_meta( 'ID' ) ) rel="author">*/
					echo get_the_author(); ?>
			</p>
			<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
			<h4 class="photo-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	
				<?php if ( current_user_can( 'judge' ) ) : ?>
					<div class="rating">
					<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
					</div>
				<?php endif ?>	
			</div> 
	</article>
</div>