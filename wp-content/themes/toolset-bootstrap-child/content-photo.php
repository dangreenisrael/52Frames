<?php

/**
 * The default template for displaying a photo page.
 *
 */
$photo_caption =  types_render_field("photo-caption", array());
$extra_credit	= get_post_meta(get_the_id(), 'wpcf-extra-challenge', true );
$moderate_critique = get_field('moderate_critique');
$author_id = get_the_author_meta( 'ID' );
$author_badge = get_field('moderator', 'user_'. $author_id ); // image field, return type = "Image Object"
$for_sale = types_render_field("for_sale", array());
$shutter =  types_render_field("shutter-speed", array("show_name"=>"true","output"=>"raw","id"=>"shutter-speed"));
$aperture  = types_render_field("aperture", array("show_name"=>"true","output"=>"raw","id"=>"aperture"));
$iso  = types_render_field("iso", array("show_name"=>"true","output"=>"raw","id"=>"iso"));
$focal_length  = types_render_field("focal-length", array("show_name"=>"true","output"=>"raw","id"=>"focal-length"));
$camera_manufacturer  = types_render_field("camera-manufacturer", array("show_name"=>"true","output"=>"raw","id"=>"camera-manufacturer"));
$camera_model  = types_render_field("camera-model", array("show_name"=>"true","output"=>"raw","id"=>"camera-model"));
$lens  = types_render_field("lens", array("show_name"=>"true","output"=>"raw","id"=>"lens"));
$flash  = types_render_field("flash", array("show_name"=>"true","output"=>"raw","id"=>"flash"));

?>


<article <?php post_class('clearfix') ?> id="post-<?php the_ID(); ?>">


	<?php
		block_page($album_slug);
	?>

<div class="photo-content">
	<div class="row container">
		<div class="photo-nav prev">
			<?php $id = get_adjacent_id_smart( false ); ?>
			<a href='<?php echo get_permalink($id); ?>'><i class="fa fa-angle-left"></i></a>
		</div>
		<div class="span8">
			<div class="photo-thumbnail">

				<div class="entry-content clearfix">	

				<?php if ( has_post_thumbnail() && wpbootstrap_get_setting('general_settings','display_thumbnails') ): ?>
					
						<a href='<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>' class='thickbox'><?php the_post_thumbnail('thumb-h545'); ?></a>


				<?php endif; ?>


				</div>
			</div><!-- .entry-content -->

		</div>
		<div class="span4">
			<div class="photo-description">
				
				<div id="author_det" class="clearfix">

					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author">

					<?php echo get_avatar( get_the_author_meta('ID'), 70); ?>
					</a>
					<div class="author_name">
						<h2><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author">
							<?php echo the_author_meta('first_name'); ?> <?php echo the_author_meta('last_name'); ?>
							</a>
						</h2>
						<input type="button" class="follow" value="Follow" data-author="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" />
					</div>
				</div>

				

				<h1><?php the_title(); ?></h1>
				<?php if( get_field('winner_photo') ):
				 if (get_field('first_place') == 'Winner') {
						echo 'Winner';
					} else if (get_field('first_place') == '1st Runner-up') {
					         echo '1st Runner-up';
					} else if (get_field('first_place') == '2nd Runner-up') {
					       echo '2nd Runner-up';
					}
				endif;
				?>
				<div class="actions">
				<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
				<a class="ico comments" href="<?php the_permalink(); ?>#disqus_thread"><span class="disqus-comment-count" data-disqus-url="<?php the_permalink(); ?>"></span></a>
				<?php
					
					if ($for_sale != '') 
						echo '<a class="ico buy" href="">Buy Photo</a>';

					?>
				</div>
				<?php if ( current_user_can( 'judge' ) ) : ?>
				<!-- Rating Widget -->

				<?php if(function_exists('the_ratings')) { the_ratings(); } ?>

				<?php endif ?>	

				<!-- Content -->
				<p class="photo-caption">
					<?php echo $photo_caption;?>
				</p>
				<!-- End Content -->
				<?php
					
					if ($extra_credit) {
						$album = get_active_album();
						$album_credit = get_field('extra_challange_desc', $album);
						echo '<div class="extra-challenge">Extra Credit: '.$album_credit,'</div>';
					}
				?>
			</div>
		</div>
		<div class="photo-nav next">
			<?php $id = get_adjacent_id_smart( true ); ?>
			<a href='<?php echo get_permalink($id); ?>'><i class="fa fa-angle-right"></i></a>
		</div>
	</div>
	<div class="row container">
		<ul class="social clearfix"> 
			<li>Share This Photo:</li>
	        <li class="facebook"><a href=""  target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li class="twitter"><a href="https://twitter.com/oktopost" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li class="googleplus"><a href="https://plus.google.com/+Oktopost/posts"  target="_blank"><i class="fa fa-google-plus"></i></a></li>
            <li class="linkedin"><a href="https://www.linkedin.com/company/oktopost" target="_blank"><i class="fa fa-linkedin"></i></a></li>
         </ul>
	</div>
</div>

				<!-- Start Custom Fileds -->


<?php setPostViews(get_the_ID()); ?>

<?php echo getPostViews(get_the_ID()); ?>
 <div class="row-fluid">
	<div class="row container lower">
		<div class="span6 discussion">
			<?php
			

			?>
			<?php if ($moderate_critique) {
				echo '<h3>Moderate Critique</h3>';	
				echo '<div class="row moderate-critique">';
				echo '<div class="span2">'.get_avatar( get_the_author_meta('ID'), 70).'</div>'; 
				echo '<div class="span9">';
				echo '<h4>'.the_author_meta('first_name'); ?> <?php echo the_author_meta('last_name').'</h4>'; 
				echo '<p>'.$moderate_critique.'</p>';
				echo '</div>';
				echo '</div>';
				
			}
			 comments_template(); ?>		

		</div>
		
		<div class="span6 specs">
			<?php //echo do_shortcode('[display_rating_form]'); ?>
			<div class="exif">
				<h3> Exif</h3>
				<ul class="row-fluid">
				<?php
				 if($shutter != '') echo '<li class="span3"><label>Shutter Speed</label><span>'.$shutter.'</span></li>';
				 if($aperture  != '') echo '<li class="span3"><label>Aperture</label><span>ƒ/'.$aperture .'</span></li>';
				 if($iso != '') echo '<li class="span3"><label>ISO</label><span>'.$iso.'</span></li>';
			     if($focal_length != '') echo '<li class="span3"><label>Focal Lenth</label><span>'.$focal_length.'mm.</span></li>';
				 if($camera_manufacturer != '') echo '<li class="span3"><label>Camera </label><span>'.$camera_manufacturer.'</span></li>';
				 if($camera_model  != '') echo '<li class="span3"><label>Model</label><span>'.$camera_model .'</span></li>';
				 if($lens != '') echo '<li class="span3"><label>Lens</label><span>'.$lens.'</span></li>';
				 if($flash != '') echo '<li class="span3"><label>Flash</label><span>'.$flash.'</span></li>';
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

			<?php if (has_tag()): ?>
			<div class="tags">
			<h3>Tags</h3>
			<?php echo get_the_tag_list('<li>','</li><li>','</li>'); ?>

			<?php endif; endif; ?>

			</div>
		</div>
	</div>
	<div class="row container">
		<ul class="nav-single pager" role="navigation">
			<li class="nav-previous previous">
				<?php $id = get_adjacent_id_smart( false ); ?>
				<a href='<?php echo get_permalink($id); ?>'><?php echo get_the_post_thumbnail($id, 'thumb-440' ); ?></a>
			</li>
			<li class="nav-next next">
				<?php $id = get_adjacent_id_smart( true ); ?>
				<a href='<?php echo get_permalink($id); ?>'><?php echo get_the_post_thumbnail($id, 'thumb-440' ); ?></a>
			</li>
		</ul>
	</div>
</div>

</article>




