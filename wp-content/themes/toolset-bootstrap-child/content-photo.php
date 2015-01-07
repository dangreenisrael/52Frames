<?php

/**
 * The default template for displaying a photo page.
 *
 */


?>


<article <?php post_class('clearfix') ?> id="post-<?php the_ID(); ?>">


	<?php
		block_page($album_slug);
	?>

<div class="photo-content">
	<div class="row container">
		<div class="span8">
			<div class="photo-thumbnail">

				<div class="entry-content clearfix">	

				<?php if ( has_post_thumbnail() && wpbootstrap_get_setting('general_settings','display_thumbnails') ): ?>

					<a href="<?php the_permalink(); ?>" class="post-thumbnail thumbnail pull-left">

						<?php the_post_thumbnail('full'); ?>


					</a>

				<?php endif; ?>


				</div>
			</div><!-- .entry-content -->

		</div>
		<div class=" span4">
			<div class="photo-description">
				
				<div id="author_pic">

					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author">

					<?php echo get_avatar( get_the_author_meta('ID'), 60); ?></a>

				</div>

				<div class="auth_follow"><input type="button" class="follow" value="Follow" data-author="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" /></div>

				<h1><?php the_title(); ?></h1>


				<?php if ( current_user_can( 'judge' ) ) : ?>
				<!-- Rating Widget -->

				<?php if(function_exists('the_ratings')) { the_ratings(); } ?>

				<?php endif ?>	

				<!-- Content -->

				<?php the_content();?>
				<!-- End Content -->
				<div class="extra_challange">
					Extra Credit: <?php echo (($extra_credit == '1') ? $extra_credit : 'No') ?>
				</div>
				<div><?php echo types_render_field("type-of-photo", array("show_name"=>"true","output"=>"html","id"=>"type-of-photo"));?></div>
			</div>
		</div>
		
	</div>
	<div class="row container">
			<ul class="social clearfix"> 
		        <li class="facebook"><a href="https://www.facebook.com/oktopost"  target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li class="twitter"><a href="https://twitter.com/oktopost" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li class="googleplus"><a href="https://plus.google.com/+Oktopost/posts"  target="_blank"><i class="fa fa-google-plus"></i></a></li>
                <li class="linkedin"><a href="https://www.linkedin.com/company/oktopost" target="_blank"><i class="fa fa-linkedin"></i></a></li>
             </ul>
		</div>
</div>

				<!-- Start Custom Fileds -->

				<?php

			

			

			?>
		</div>
	</div>
</div>


<?php //setPostViews(get_the_ID()); ?>

<?php //echo getPostViews(get_the_ID()); ?>
</article>

</div>


<div class="row-fluid">
	<div class="row container">
		<div class="span6 discussion">
			<?php comments_template(); ?>		

		</div>
		
		<div class="span6">
			
<!-- Tags -->
		<!--exifograpgy Shortcode -->

		<?php

		if (function_exists('exifography_display_exif')) {
			$id = get_post_thumbnail_id($post->ID);
			echo exifography_display_exif('all',$id);

		}

		?>
		<?php if (has_category() || has_tag() ):?>

				<p>

					<?php if (has_tag()): ?>

					<?php _e( 'Tags:', 'wpbootstrap' ); echo ' ';echo get_the_tag_list('',', ',''); ?>.

					<?php endif; ?>

				</p>

				<?php endif; ?>
		

		</div>
</div>
</div>

