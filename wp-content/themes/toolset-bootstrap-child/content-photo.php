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

<div class="photo-content entry-content">
	<div class="row container">
		<div class="photo-nav prev">
			<?php $id = get_adjacent_id_smart( true ); ?>
			<a href='<?php echo get_permalink($id); ?>'><i class="fa fa-angle-left"></i></a>
		</div>
		<div class="span8">
			<div class="photo-thumbnail">

				<div class="entry-content clearfix">	

				<?php if ( has_post_thumbnail() && wpbootstrap_get_setting('general_settings','display_thumbnails') ): ?>
					

						<a href='<?php echo wp_get_attachment_url(get_post_thumbnail_id(),'full'); ?>' class='fullsizable'><?php the_post_thumbnail('thumb-h545'); ?></a>


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
				<span class="ico comments"><a class="commentlink" href="#respond"/></a><?php comments_popup_link( __( '<span>0 Comments</span>', 'wpbootstrap' ), __( '<span>1 Comment</span>', 'wpbootstrap' ), __( '<span>% Comments</span>', 'wpbootstrap' ) );?></span>
				<?php
					
					if ($for_sale != '') 
						echo '<a class="ico buy" href="">Buy Photo</a>';

					?>
				<span class="ico rating"><?php echo do_shortcode('[display_rating_result  no_rating_results_text="Add Rating" show_rich_snippets="true" show_count="true" show_title="false"]');?></span>
				</div>
					

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
			<?php $id = get_adjacent_id_smart( false ); ?>
			<a href='<?php echo get_permalink($id); ?>'><i class="fa fa-angle-right"></i></a>
		</div>
	</div>
	<div class="row container">
		<ul class="social clearfix"> 
			<li><label>Share This Photo:</label></li>
	        <li class="twitter"><a href="http://twitter.com/share?text=Currently reading <?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" class="popup" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>" class="popup" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li class="googleplus"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="popup" target="_blank"><i class="fa fa-google-plus"></i></a></li>
            <li class="pinterest"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $image_url; ?>" class="popup" target="_blank"><i class="fa fa-pinterest"></i></a></li>
            <li class="linkedin"><a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="popup" target="_blank"><i class="fa fa-linkedin"></i></a></li>
         </ul>
         <?php if ( current_user_can( 'judge' ) ) : ?>
				<!-- Rating Widget -->

				<?php if(function_exists('the_ratings')) { the_ratings(); } ?>

				<?php endif ?>
	</div>
</div>

				<!-- Start Custom Fileds -->


<?php echo do_shortcode('[post_view]') ?>

 <div class="row-fluid">
	<div class="row container lower">
		<div class="span7 discussion">
			<?php
			

			?>
			<?php if ($moderate_critique) {?>
				<h3>Moderator's Critique</h3>
				<?php	
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
		
		<div class="span5 specs">
			<?php echo do_shortcode('[display_rating_form]'); ?>
			<div class="exif">
				<h3> EXIF Data</h3>
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
				<?php $id = get_adjacent_id_smart( true ); ?>
				<a href='<?php echo get_permalink($id); ?>'><?php echo get_the_post_thumbnail($id, 'thumb-440' ); ?></a>
			</li>
			<li class="nav-next next">
				<?php $id = get_adjacent_id_smart( false ); ?>
				<a href='<?php echo get_permalink($id); ?>'><?php echo get_the_post_thumbnail($id, 'thumb-440' ); ?></a>
			</li>
		</ul>
	</div>
</div>

</article>




