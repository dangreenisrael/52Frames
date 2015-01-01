<?php
/**
 * The template used for displaying home page content in page-home.php
 *
 */
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/slick/slick.css"/>
<script>
jQuery(function() {
    function count($this){
        var current = parseInt($this.html(), 10);
        $this.html(++current);
        if(current !== $this.data('count')){
            setTimeout(function(){count($this)}, 50);
        }
    }        
  // jQuery(".counter").each(function() {
  //     jQuery(this).data('count', parseInt(jQuery(this).html(), 10));
  //     jQuery(this).html('0');
  //     count(jQuery(this));
  // });
});
</script>

<!-- Load the slider with "slider1" alias every time -->
      <?php //putRevSlider("homepage") ?>
          <article <?php post_class('clearfix') ?> id="post-<?php the_ID(); ?>">
             <div id="bg_container">
              <!--<iframe src="//player.vimeo.com/video/115478018?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=1" width="1920" height="599" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
              -->
		      	<video width="1920" height="600" autoplay>
              <source src="http://52frames.com/wp-content/themes/toolset-bootstrap-child/video/video_background-HD.mp4" type="video/mp4"></video>
            </div>  
            <div class="container uber">
              <div class="row span12"><h1 class="site-description"><?php bloginfo( 'description' ); ?></h1></div>
              <div class="span6 text-slider">
                <?php if (function_exists('rps_show')) echo rps_show(); ?>
              </div>
              <div class="submission-form-hp span3 pull-right">
                <div class="camera-text">
                  <a href="<?php echo home_url()?>/submit-new-photo/">This Weeks Challenge</a>
					<?php
					$term = get_field('albums_name_above_camera');
					?>
                    <p class="camera-album-span">&ldquo;Self-Portrait<?php //the_field('name', $term); ?>&rdquo;</p>
					<p class="camera-span">Ends Sunday at noon, U.S. Eastern</p>
					<?php
					if ( is_user_logged_in() ) {
					
					echo '<a href="http://52frames.com/submit-new-photo/"><p class="red-circle"><span class="submit-text">Submit</span><br /><span class="your-photo-text">Your Photo</span></p></a>
                    <div class="camera-icn">
                      <img src="'.get_stylesheet_directory_uri().'/images/camera.png"></img>';
					  
					} else {
					
						echo '<a href="http://52frames.com/register-a-new-account/"><p class="red-circle"><span class="submit-text">Submit</span><br /><span class="your-photo-text">Your Photo</span></p></a>
                    <div class="camera-icn">
                      <img src="'.get_stylesheet_directory_uri().'/images/camera.png"></img>';
					  } 
					  ?>
                    </div>
                </div>
              </div>
            </div>
             <div class="row-fluid latest-albums">
                 <div class="title-container">
                   <h1 class="title">Our Latest Challenges</h1>
                 </div>
                 <div class="albums-carousel">
              <?php
              $terms2 = get_terms('photo_alboms'); 
                if ( !empty( $terms2 ) && !is_wp_error( $terms2 ) ){
                	 foreach ( $terms2 as $term2 ) {
                      if (get_field('', $term2) == 'CLOSE')
                        continue;
                      $term_link = get_term_link( $term2, 'photo_alboms' ); 
                      $variable = get_field('winning_photo_1th', 'photo_alboms_'.$term2->term_id);
                       echo '<div class="span3 winning_image"><a href="'.get_permalink($variable->ID).'">'.get_the_post_thumbnail($variable->ID, "thumb-480").'</a>';
                       echo '<div class="week-name"><div class="album-stats"><span class="week-number-hp">Week 47</span></br><a class="album-name-hp" href="'.esc_url( $term_link ).'">'.$term2->name.'</a></div></div></div>';

                    }
              }
              ?>
                 </div>
              </div>
              




              <?php
              // count posts
              $n_post = wp_count_posts();
              $n_post_publish = $n_post->publish;
              $n_post_drafts = $n_post->draft;
              // count pages
              $n_page = wp_count_posts('page');
              $n_page_publish = $n_page->publish;
              $n_page_drafts = $n_page->draft;
              // count custom post types
              $n_cpt = wp_count_posts('photo');
              $n_cpt_publish = $n_cpt->publish;
              $n_cpt_drafts = $n_cpt->draft;
              // count comments
              $n_comments = wp_count_comments();
              $n_comments_moderated = $n_comments->moderated;
              $n_comments_approved = $n_comments->approved;
              $n_comments_spam = $n_comments->spam;
              $n_comments_trash = $n_comments->trash;
              $n_comments_total = $n_comments->total_comments;
              ?>

              <!--  
<?php 

  $terms = get_terms('photo_alboms'); 
  if ( !empty( $terms ) && !is_wp_error( $terms ) ){ 
  echo '<div class="for-columns-4" style="background-color: #76B2D4;"><div class="row-fluid">'; 

  foreach ( $terms as $term ) { 
     $term = sanitize_term( $term, 'photo_alboms' ); 
     $term_link = get_term_link( $term, 'photo_alboms' ); 

      echo '<div class="span3"><a href="' . esc_url( $term_link ) . '"><span class="counter">'.$term->count.'</span></br>' . $term->name . '</a></div>'; 
  } 
  // echo '</div></div>';
  }

?> 
<div class="holder span3"><a href="http://188.240.51.133/~contest/photo_alboms/mobile-2/"><span class="counter">200</span><br>Mobile</a></div>
</div></div> -->


<div class="for-columns-3" style="background-color: #76B2D4;padding: 51px 0;">
	<div class="row-fluid">
		<div class="span3 text-center"><!-- <a class="button-arrows-hp" href="#">< Previous</a> --></div>
		<div class="child span6">
			<div class="row-fluid">
			<div class="span12 text-center"><a class="button-challenges-hp" href="#">View All Challenges</a></div>
			</div>
		</div>
<div class="span3 text-center"><!-- <a class="button-arrows-hp" href="#">Next ></a> --></div>
	<div class="span12">
		<div class="counters-hp">
			<div class="span3 counter-container text-center"><p class="counter">16067</p><p><span class="counter-bottom">Photographs Submitted</span></p></div>
			<div class="span3 counter-container text-center"><p class="counter">697</p><p><span class="counter-bottom">Photographers to Date</span></p></div>
			<div class="span3 counter-container text-center"><p class="counter">26</p><p><span class="counter-bottom">Countries Represented</span></p></div>
			<div class="span3 counter-container text-center"><p class="counter">208</p><p><span class="counter-bottom">Weekly Challenges</span></p></div>
			<!--<div class="holder span3 text-center"><p class="counter"><?php //echo $n_cpt->publish;?></p><p>PHOTOS SUBMITTED</p></div>
			<div class="holder span3 text-center"><p class="counter"><?php //echo $n_comments->total_comments;?></p><p>TOTAL COMMENTS</p>
		</div>-->
	</div>
	</div>
	</div>
</div>



<div class="for-columns-4" style="background-color:#fafafa;padding: 40px 0;">
<div class="row-fluid">
<div class="span1"></div>
<div class="span3" style="padding-right: 40px;">
<h3 class="latest-hp">From the Blog</h3>
<?php the_field('lastest_posts_text'); ?>
<div class="buttons-blog-hp">
<a class="button-latest-hp" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Visit Our Blog</a>
<?php

$post_object = get_field('lastest_posts_post');

if( $post_object ): 

  // override $post
  $post = $post_object;
  setup_postdata( $post ); 

  ?>
      <a class="button-latest-hp" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>

<!-- <a href="<?php $post->guid ;?>"><?php $post->post_title; ?></a> -->
</div>
</div>
<div class="span8">
<div class="for-columns-3">
<div class="row-fluid">
<?php
	$args = array( 'numberposts' => '3' );
	$recent_posts = wp_get_recent_posts( $args );
	foreach( $recent_posts as $recent ){
		?>
	<div id="post-hp" class="holder span4">

		<div class="for-columns-1">
<div class="row-fluid">
<div class="span12"><?php echo get_the_post_thumbnail($recent["ID"], "medium" ); ?> </div>
</div>
</div>
<div class="for-columns-1" id="post-text-hp">
<div class="row-fluid">
<div class="holder span12">	<?php
		echo $recent["post_title"].'<br />';
	// echo $recent["post_excerpt"].'<br /><br />';
    // echo $recent["post_content"].'<br /><br />';
				echo '<a href="' . get_permalink($recent["ID"]) . '">Read More <span style="color: red; font-weight: bold;">></span></a>';
		?></div>
</div>
</div>
 </div>
		<?php
	}
?>



</div>
</div>
</div>
<div class="holder span2"></div>
</div>
</div>


<div id="photo-walk-hp">
    <div class="container">
        <div class="span2"><?php $image = wp_get_attachment_image_src(get_field('photo_walk_image'), 'full'); ?>
        <img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_field('photo_walk_image')) ?>" /></div>
        <div class="span5" id="photowalk-text-hp"><h3 class="title">Photowalk</h3><?php the_field('photo_walk_text'); ?></div>
        <div class="span4 text-center" id="photo-walk-button"><a class="button" href="#"><?php the_field('photo_walk_button'); ?></a></div>
    </div>
</div>
<div class="for-columns-3"><div class="row-fluid">
<div id="blur-dropshadow" class="holder span4 featured-framer_image featured_image" style="width:33.33%;">
<?php

$user = get_field('featured_framer');
echo get_avatar( $user['ID'], '640');

?>

<div class="overlay"></div>
<div class="featured-name"><div class="featured-name-inner"><span>Featured Framer</span></div></div>
<div class="featured-avatar"><div class="featured-avatar-inner"><span class="winning-avatar-hp"><?php echo $user['user_avatar']; ?></span></div></div>
<div class="featured-name-photo"><p class="featured-photo-inner">Nomi Hirshman Rave</p></div>
</div>
<?php

$post_object = get_field('photo_of_the_day');

if( $post_object ): 

  // override $post
  $post = $post_object;
  setup_postdata( $post ); 
  ?>
<div class="span4 winning_image" style="width:33.33%;"><?php $image = get_the_post_thumbnail($post->ID, 'full'); ?>
<div><?php //the_permalink(); ?><?php echo $image; ?><div class="overlay"></div></div>
<div class="photo-of-the-day-hp"style="top: 100px;"><div class="photo-hp"><span>Photo of <strong>the Day</strong></span></div></div>
<div class="photo-title-hp"><div class="title-hp"><span class="week-number-hp"><?php the_title();?></span></div></div>
<div class="photographer-name-hp"style="top: 400px;"><div class="photographer-hp"><a class="album-name-hp" href="<?php get_the_author_meta( 'user_url', $post->post_author ); ?>"><?php echo get_the_author_meta( 'nickname', $post->post_author ); ?></a></div></div>

</div>

    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>

<?php
$post_object = get_field('audience_award');

if( $post_object ): 

  // override $post
  $post = $post_object;
  setup_postdata( $post ); 
  ?>

<div class="span4 winning_image" style="width:33.33%;"><?php $image = get_the_post_thumbnail($post->ID, 'full'); ?>
<div><?php //the_permalink(); ?><?php echo $image; ?></div>
<div class="overlay"></div>
<div class="photo-of-the-day-hp" style="top: 100px;"><div class="photo-hp"><span>Audience <strong>Award</strong></span></div></div>
<div class="photo-title-hp" style="top: 130px; left: 31%;"><div class="title-hp"><span class="week-number-hp"><?php the_title();?></span></div></div>
<div class="photographer-name-hp" style="top: 400px;"><div class="photographer-hp"><a class="album-name-hp" href="<?php get_the_author_meta( 'user_url', $post->post_author ); ?>"><?php echo get_the_author_meta( 'nickname', $post->post_author ); ?></a></div></div>
</div>

    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>

</div></div>





</div>
</article>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/slick/slick.min.js"></script>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script> -->
<!--<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.carouFredSel-6.2.1.js" type="text/javascript"></script>-->
<script type="text/javascript">
$(document).ready(function() {
  $('.albums-carousel').slick({
      lazyLoad: 'ondemand',
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 2000
  });
});
</script>
<?php wpbootstrap_link_pages(); ?>
<?php //comments_template();