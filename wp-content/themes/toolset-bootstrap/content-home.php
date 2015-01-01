<?php
/**
 * The template used for displaying home page content in page-home.php
 *
 */
?>
<script>
jQuery(function() {
    function count($this){
        var current = parseInt($this.html(), 10);
        $this.html(++current);
        if(current !== $this.data('count')){
            setTimeout(function(){count($this)}, 50);
        }
    }        
  jQuery(".counter").each(function() {
      jQuery(this).data('count', parseInt(jQuery(this).html(), 10));
      jQuery(this).html('0');
      count(jQuery(this));
  });
});
</script>

<!-- Load the slider with "slider1" alias every time -->
      <?php //putRevSlider("homepage") ?>
          <article <?php post_class('clearfix') ?> id="post-<?php the_ID(); ?>">

          <?php if ( wpbootstrap_get_setting('titles_settings', 'display_pages_titles' ) ): ?>
          		<?php if (is_front_page()): ?>
          		    <?php if ( wpbootstrap_get_setting('titles_settings', 'display_pages_titles_on_homepage' ) ): ?>
          				<h1><?php the_title(); ?></h1>
          			<?php endif; ?>
          		<?php else: ?>
          			<h1><?php the_title(); ?></h1>
          		<?php endif; ?>
          	<?php endif; ?>

             <div id="bg_container">
                <iframe id="bg" src="http://www.youtube.com/embed/byDullqAvtM?autohide=1&autoplay=1&fs=0&showinfo=0&loop=1&modestBranding=1&start=0&controls=0&rel=0&disablekb=1&iv_load_policy=3&wmode=transparent&enablejsapi=1&origin=http%3A%2F%2Fdemos.gambit.ph" frameborder="0"></iframe>
             </div>
            <div class="container uber">
              <div class="text-slider">
                <?php if (function_exists('rps_show')) echo rps_show(); ?>
              </div>
              <div class="submission-form-hp">
                <div class="camera-text">
                  <a href="<?php echo home_url()?>/submit-new-photo/">This Weeks Challenge</a>
                    <p class="camera-span">Looks like this...</p>
                    <div class="camera-icn">
                      <img src="<?php echo get_stylesheet_directory_uri()?>/images/camera.png"></img>
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
                      $term_link = get_term_link( $term2, 'photo_alboms' ); 
                      $variable = get_field('winning_photo_first', 'photo_alboms_'.$term2->term_id);
                       echo '<div class="span3 winning_image"><a href="'.get_permalink($variable->ID).'">'.get_the_post_thumbnail($variable->ID, "full").'</a>';
                       echo '<div class="week-name"><div class="album-stats"><span class="week-number-hp">Week 47</span></br><a class="album-name-hp" href="'.esc_url( $term_link ).'">'.$term2->name.'</a></div></div></div>';

                    }
              }
              ?>
                 </div>
              </div>
              <!--<div class="for-columns-1"><div class="row-fluid">
              <div class="holder span12">
              <div id="carousel">
                  <img src="http://188.240.51.133/~contest/wp-content/uploads/2014/11/---------------------.jpg" width="300" />
                  <img src="http://188.240.51.133/~contest/wp-content/uploads/2014/11/---------------------.jpg" width="300" />
                  <img src="http://188.240.51.133/~contest/wp-content/uploads/2014/11/---------------------.jpg" width="300" />
                  <img src="http://188.240.51.133/~contest/wp-content/uploads/2014/11/---------------------.jpg" width="300" />
                  <img src="http://188.240.51.133/~contest/wp-content/uploads/2014/11/---------------------.jpg" width="300" />
                  <img src="http://188.240.51.133/~contest/wp-content/uploads/2014/11/---------------------.jpg" width="300" />
                  <img src="http://188.240.51.133/~contest/wp-content/uploads/2014/11/---------------------.jpg" width="300" />
                  <img src="http://188.240.51.133/~contest/wp-content/uploads/2014/11/---------------------.jpg" width="300" />
                  <img src="http://188.240.51.133/~contest/wp-content/uploads/2014/11/---------------------.jpg" width="300" />
              </div>

              </div>
              </div>
              </div>-->


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

      echo '<div class="holder span3"><a href="' . esc_url( $term_link ) . '"><span class="counter">'.$term->count.'</span></br>' . $term->name . '</a></div>'; 
  } 
  // echo '</div></div>';
  }

?> 
<div class="holder span3"><a href="http://188.240.51.133/~contest/photo_alboms/mobile-2/"><span class="counter">200</span><br>Mobile</a></div>
</div></div> -->


<div class="for-columns-3" style="background-color: #76B2D4;padding: 40px 0;">
	<div class="row-fluid">
		<div class="holder span3 text-center"><a class="button-arrows-hp" href="#">< Previous</a></div>
		<div class="child span6">
			<div class="row-fluid">
			<div class="holder span12 text-center"><a class="button-challenges-hp" href="#">View All Challenges</a></div>
			</div>
			<div class="row-fluid">
				<div class="counters-hp">
					<div class="holder span3 text-center"><p class="counter">16067</p><p>Photographs Submitted</p></div>
					<div class="holder span3 text-center"><p class="counter">697</p><p>Photographers to Date</p></div>
					<div class="holder span3 text-center"><p class="counter">26</p><p>Countries Represented</p></div>
					<div class="holder span3 text-center"><p class="counter">208</p><p>Weekly Challenges</p></div>
					<!--<div class="holder span3 text-center"><p class="counter"><?php //echo $n_cpt->publish;?></p><p>PHOTOS SUBMITTED</p></div>
					<div class="holder span3 text-center"><p class="counter"><?php //echo $n_comments->total_comments;?></p><p>TOTAL COMMENTS</p>
				</div>-->
			</div>
			</div>
		</div>
<div class="holder span3 text-center"><a class="button-arrows-hp" href="#">Next ></a></div>
	</div>
</div>



<div class="for-columns-4" style="background-color:#fafafa;padding: 40px 0;">
<div class="row-fluid">
<div class="holder span1"></div>
<div class="holder span3" style="padding-right: 40px;">
<h3 class="latest-hp">Our Latest Posts</h3>
<?php the_field('lastest_posts_text'); ?>
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
<div class="holder span8">
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
<div class="holder span12"><?php echo get_the_post_thumbnail($recent["ID"], "medium" ); ?> </div>
</div>
</div>
<div class="for-columns-1" id="post-text-hp">
<div class="row-fluid">
<div class="holder span12">	<?php
		echo $recent["post_content"].'<br /><br />';
				echo '<a href="' . get_permalink($recent["ID"]) . '">Read More</a>';
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


<div class="for-columns-5" id="photo-walk-hp">
<div class="row-fluid">
<div class="holder span1"></div>
<div class="holder span2"><?php $image = wp_get_attachment_image_src(get_field('photo_walk_image'), 'full'); ?>
<img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_field('photo_walk_image')) ?>" /></div>
<div class="holder span5" id="photowalk-text-hp"><h3 class="title">Photowalk</h3><?php the_field('photo_walk_text'); ?></div>
<div class="holder span4 text-center" id="photo-walk-button"><a class="button" href="#"><?php the_field('photo_walk_button'); ?></a></div>
<div class="holder span2"></div>
</div>
</div>


<?php
$terms2 = get_terms('photo_alboms'); 
  if ( !empty( $terms2 ) && !is_wp_error( $terms2 ) ){
    echo '<div class="for-columns-3"><div class="row-fluid">';
     foreach ( $terms2 as $term2 ) {
$term_link = get_term_link( $term2, 'photo_alboms' ); 
$variable = get_field('winning_photo_first', 'photo_alboms_'.$term2->term_id);
echo $variable->ID;
echo '<div class="holder span4 winning_image"><a href="'.get_permalink($variable->ID).'">'.get_the_post_thumbnail($variable->ID, "full").'</a><div class="week-name">Week 47</br><a href="'.esc_url( $term_link ).'">'.$term2->name.'</a></div></div>';
}
echo '</div></div>';
}
?>





</div>



	<div class="entry-content">
		<?php //the_content(); ?>
		<?php edit_post_link( __('Edit page','wpbootstrap'), '<p class="btn">', '</p>' ); ?>
	</div><!-- .entry-content -->

</article>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.carouFredSel-6.2.1.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    // Using default configuration
    // $('#carousel').carouFredSel();

    // Using custom configuration
    $('#carousel').carouFredSel({
        width               : '100%',
        // items               : 2,
        circular            : true,
        responsive          : false, 
        direction           : "right",
        align               : "center",
        scroll : {
            items           : 1,
            easing          : "linear",
            duration        : 1000,                         
            pauseOnHover    : true
        }                   
    });
});
</script>
<?php wpbootstrap_link_pages(); ?>
<?php //comments_template();