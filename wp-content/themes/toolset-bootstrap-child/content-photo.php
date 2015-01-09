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
					
						<?php the_post_thumbnail('full'); ?>


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
				<?php
					$extra_credit	= get_post_meta(get_the_id(), 'wpcf-extra-challenge', true );
					if ($extra_credit) {
						$album = get_active_album();
						$album_credit = get_field('extra_challange_desc', $album);
						echo 'Extra Credit: '.$album_credit;
					}
				?>
				</div>
				<div class="actions">
				<?php
					$for_sale = types_render_field("for_sale", array());
					if ($for_sale != '') echo 'Buy Photo';

					?>
				</div>
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
			<?php
			$moderate_critique = get_field('moderate_critique');
			$author_id = get_the_author_meta( 'ID' );
			$author_badge = get_field('moderator', 'user_'. $author_id ); // image field, return type = "Image Object"

			?>
			<?php if ($moderate_critique) {
				echo '<div class="moderate-critique">';
				echo '<img src="'.$author_badge['url'].'" alt="'.$author_badge['alt'].'" />';
				echo '<p>'.$moderate_critique.'</p>';
				echo '</div>';
				
			}
			 comments_template(); ?>		

		</div>
		
		<div class="span6">
			<div class="exif">
				<h3> Exif</h3>
				<ul>
				<?php
				 
				$shutter =  types_render_field("shutter-speed", array("show_name"=>"true","output"=>"raw","id"=>"shutter-speed"));
				$aperture  = types_render_field("aperture", array("show_name"=>"true","output"=>"raw","id"=>"aperture"));
				$iso  = types_render_field("iso", array("show_name"=>"true","output"=>"raw","id"=>"iso"));
				$focal_length  = types_render_field("focal-length", array("show_name"=>"true","output"=>"raw","id"=>"focal-length"));
				$camera_manufacturer  = types_render_field("camera-manufacturer", array("show_name"=>"true","output"=>"raw","id"=>"camera-manufacturer"));
				$camera_model  = types_render_field("camera-model", array("show_name"=>"true","output"=>"raw","id"=>"camera-model"));
				$lens  = types_render_field("lens", array("show_name"=>"true","output"=>"raw","id"=>"lens"));
				$flash  = types_render_field("flash", array("show_name"=>"true","output"=>"raw","id"=>"flash"));


				 if($shutter != '') echo '<li><label>Shutter Speed</label><span>'.$shutter.'</span></li>';
				 if($aperture  != '') echo '<li><label>Aperture</label><span>'.$aperture .'</span></li>';
				 if($iso != '') echo '<li><label>ISO</label><span>'.$iso.'</span></li>';
			     if($focal_length != '') echo '<li><label>Focal Lenth</label><span>'.$focal_length.'</span></li>';
				 if($camera_manufacturer != '') echo '<li><label>Camera Manufacturer</label><span>'.$camera_manufacturer.'</span></li>';
				 if($camera_model  != '') echo '<li><label>Camera Model</label><span>'.$camera_model .'</span></li>';
				 if($lens != '') echo '<li><label>Lens</label><span>'.$lens.'</span></li>';
				 if($flash != '') echo '<li><label>Flash</label><span>'.$flash.'</span></li>';
				?> 
			</ul>
		</div>
		<!--exifograpgy Shortcode -->

		<?php

		if (function_exists('exifography_display_exif')) {
			$id = get_post_thumbnail_id($post->ID);
			echo exifography_display_exif('all',$id);

		}

		?>
		<!-- Tags -->
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

