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
            setTimeout(function(){count($this)}, 10);
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
             <div id="bg_container">              
  		      	<video width="1920" height="600" autoplay loop class="hidden-phone">
                <source src="<?php echo get_stylesheet_directory_uri()?>/video/video_background-HD.mp4" type="video/mp4">
              </video>
              <div class="overlay"></div>
            </div>  
            <div class="container uber">
              <div class="row span12"><h1 class="site-description"><?php bloginfo( 'description' ); ?></h1></div>
              <div class="span6 content-slider">
                <?php //if (function_exists('rps_show')) echo rps_show(); ?>
                <?php 
                 $args = array(
                   'post_type' => 'homepage-slider', 
                   'showposts' => -1
                   
                 );?>
                 <div class="home-slider">
                   
                    <?php $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                      $title = get_the_title();
                      $link = get_field('slide_link');
                      ?>      
                       <div class="slide row">               
                          <div class="span4 slider-img visible-desktop">
                              <?php echo the_post_thumbnail('full'); ?>
                          </div>
                          <div class="span8 caption">
                            <h3><?php echo $title;?></h3>
                            <?php the_content();?>
                            <a href="<?php echo $link; ?>" class="slider-button-hp">More Details</a>
                          </div>
                        </div>
                    <?php 
                  endwhile;
                    wp_reset_query();
                     ?>          
                </div>  
              </div>
              <div class="submission-form-hp span6 pull-right">
                <div class="camera-text">
                  <a href="<?php echo home_url()?>/submit/">This Weeks Challenge</a>
          					<?php
          					$term = get_field('albums_name_above_camera');
          					?>
                    <span class="camera-album-name">&ldquo;Self-Portrait<?php //the_field('name', $term); ?>&rdquo;</span>
          					<span class="camera-deadline">Ends Sunday at noon, U.S. Eastern</span>
          					<?php
          					if ( is_user_logged_in() ) {
          					 $submit = 'submit';
                     } else {
                       $submit = 'register-a-new-account';
                      } 
                      ?>
                      <div class="camera-action">
              					<a class="red-circle" href="<?php echo home_url().'/'.$submit ?>">
                            <span class="submit-text">Submit</span><br />
                            <span class="your-photo-text">Your Photo</span>
                        </a>                   
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
                            $week = get_field('week_number', $term2);
                            $term_link = get_term_link( $term2, 'photo_alboms' ); 
                            $variable = get_field('winning_photo_1th', 'photo_alboms_'.$term2->term_id);
                            $term_link = get_field('fb_link', $term2);
                            // echo '<div class="span3 winning_image"><a href="'.get_permalink($variable->ID).'">'.get_the_post_thumbnail($variable->ID, "thumb-480").'</a>';
                            echo '<div class="album"><a href="'.$term_link.'">'.get_the_post_thumbnail($variable->ID, "thumb-780").'</a>';
                            echo '<div class="details"><div class="detai  ls-inner"><a class="album-name-hp" href="'.esc_url( $term_link ).'">Week '.$week.'<span>'.$term2->name.'</span></a></div></div></div>';

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

          	<div class="row-fluid stats" style="background-color: #76B2D4;padding: 30px 0;">
          			<div class="span12 text-center"><a class="button-challenges-hp" href="#">View All Challenges</a></div>
                <div class="container hidden-phone">
              		<div class="counters-hp">
              			<div class="span3 counter-container text-center"><p class="counter">16067</p><p><span class="counter-bottom">Photographs Submitted</span></p></div>
              			<div class="span3 counter-container text-center"><p class="counter">697</p><p><span class="counter-bottom">Photographers to Date</span></p></div>
              			<div class="span3 counter-container text-center"><p class="counter">38</p><p><span class="counter-bottom">Countries Represented</span></p></div>
              			<div class="span3 counter-container text-center"><p class="counter">210</p><p><span class="counter-bottom">Weekly Challenges</span></p></div>
              		</div>
          	   </div>
          	</div>

            <!-- Latest Posts -->
            <div class="row-fluid latest-posts">
              <div class="container ">
                  <div class="span3 blog-preview">
                    <h3 class="title">From the Blog</h3>
                     <div class="hidden-phone"><?php the_field('lastest_posts_text'); ?></div>
                      <div class="buttons-blog-hp hidden-phone">
                          <a class="button-latest-hp" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Visit Our Blog</a>
                       <?php
                       $post_object = get_field('lastest_posts_post');
                        if( $post_object ): 
                           // override $post
                           $post = $post_object;
                           setup_postdata( $post ); 
                          ?>
                            <a class="button-latest-hp" href="">Photo Guid 101</a>
                          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                       <?php endif; ?>

                      <!-- <a href="<?php $post->guid ;?>"><?php $post->post_title; ?></a> -->
                      </div>  
                  </div>
                  <div class="span9 pull-right">
                    <div class="row-fluid">
                    <?php
                    	 $args = array(
                   'post_type' => 'post', 
                   'showposts' => 3
                   
                 );?>
                    	<?php $postloop = new WP_Query( $args );
                    while ( $postloop->have_posts() ) : $postloop->the_post();
                    		?>
                    	<div class="span4"> 
                        <div article class="post">           	
                          <div><a href="<?php the_permalink()?>"><?php the_post_thumbnail('thumb-440' ); ?></a></div>            
                          <h3><a href="<?php the_permalink()?>"><?php	the_title() ?></a></h3>
                        </div>
                     </div>
                		<?php
                	 endwhile;
                   wp_reset_query();
                    ?>
                    </div>
                  </div>
              </div>

            </div>
            <div id="photo-walk-hp" class="row-fluid">
                <div class="container">
                    <div class="span2 photowalk-monster"><?php $image = wp_get_attachment_image_src(get_field('photo_walk_image'), 'full'); ?>
                      <img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_field('photo_walk_image')) ?>" />
                    </div>
                    <div class="span7" id="photowalk-text-hp">
                         <h3 class="title">Photowalk</h3>
                           <?php the_field('photo_walk_text'); ?>
                     </div>
                      <div class="span3 pull-right"  id="photo-walk-button">
                        <a class="button" href="#"><?php the_field('photo_walk_button'); ?></a>
                     </div>
                 </div>
            </div>
            <div class="row-fluid featured hidden-phone">             
                <?php
                $user = get_field('featured_framer');
                $framer_link = get_field('featured_framer_link');
                 ?>
              <div id="featured-framer" class="featured-item span4">
                  <?php echo get_wp_user_avatar( $user['ID'], 'thumb-640');?>
                  <div class="overlay"></div>
                  <div class="featured-name">
                    <span>Featured <strong>Framer</strong></span>
                  </div>
                    <div class="framer-avatar">
                        <a href="<?php echo $framer_link ?>"><?php echo get_wp_user_avatar( $user['ID'], '150'); ?></a>
                    </div>
                  <div class="featured-details">                      
                        <a href="<?php echo $framer_link ?>">Nomi Hirshman Rave</a>
                  </div>
              </div>
              <?php

              $post_object = get_field('photo_of_the_day');

              if( $post_object ): 

                // override $post
                $post = $post_object;
                setup_postdata( $post ); 
                ?>
              <div class="span4 featured-item">
                <?php $image = get_the_post_thumbnail($post->ID, 'thumb-780'); ?>
                <div><a href="<?php the_permalink(); ?>"><?php echo $image; ?></a>
                  <div class="overlay"></div>
                </div>
                <div class="featured-name">
                    <span>Photo of <strong>the Day</strong></span>
                </div>
                <div class="featured-details">
                  <div class="title-hp">
                     <a href="<?php the_permalink()?>"><?php the_title();?></a>
                  </div>
                  <div class="framer-name">
                      <a href="<?php get_the_author_meta( 'user_url', $post->post_author ); ?>"><?php echo get_the_author_meta( 'nickname', $post->post_author ); ?></a>
                  </div>
                </div>
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

              <div class="span4 featured-item"><?php $image = get_the_post_thumbnail($post->ID, 'thumb-780'); ?>
                <div><?php //the_permalink(); ?><?php echo $image; ?></div>
                <div class="overlay"></div>
                <div class="featured-name">
                    <span>Audience <strong>Award</strong></span>
                </div>
                <div class="featured-details">
                  <div class="title-hp">
                     <a href="<?php the_permalink()?>"><?php the_title();?></a>
                  </div>
                 <?php if( function_exists('zilla_likes') ) zilla_likes($post->ID); ?>
                    <div class="framer-name">
                      <a href="<?php get_the_author_meta( 'user_url', $post->post_author ); ?>"><?php echo get_the_author_meta( 'nickname', $post->post_author ); ?></a>
                    </div>   
                  </div>            
              </div>
                  <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
              <?php endif; ?>
          </div>
        </article>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/slick/slick.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
      $('.home-slider').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 2000,
      dots: true,
      arrows: false,
      speed: 500,
      fade: true,
      slide: 'div',
      cssEase: 'linear'
  });
   $('.home-slider').show();   

     $('.albums-carousel').slick({
      lazyLoad: 'ondemand',
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 2000,
      responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
  });
 
});
</script>
<?php wpbootstrap_link_pages(); ?>
<?php //comments_template();