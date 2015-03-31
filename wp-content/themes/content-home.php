<?php
/**
 * The template used for displaying home page content in page-home.php
 *
 */
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/slick/slick.css"/>
          <article <?php post_class('clearfix') ?> id="post-<?php the_ID(); ?>">
             <div id="bg_container">              
  		      	<video width="1920" height="600" poster="<?php echo get_stylesheet_directory_uri()?>/images/video.jpg" autoplay loop class="hidden-phone">
                <source src="<?php echo get_stylesheet_directory_uri()?>/video/video_background-HD.mp4" type="video/mp4">
              </video>
              <div class="overlay"></div>
            </div>  
            <div class="container uber">
              <div class="span6 content-slider">
                <h1 class="site-description"><?php bloginfo( 'description' ); ?></h1>
                <?php 
                 $args = array(
                   'post_type' => 'homepage-slider', 
                   'showposts' => -1,
                   'orderby' => 'menu_order'
                   
                 );?>
                 <div class="home-slider">                   
                    <?php $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                      $title = get_the_title();
                      $link = get_field('slide_link');
                      $link_label = get_field('link_label');
                      if (!empty($link_label)) :
                        $label = $link_label;
                      else :
                        $label= 'More Details';
                      endif;
                      ?>      
                       <div class="slide row">               
                          <div class="span4 slider-img visible-desktop">
                              <?php echo the_post_thumbnail('full'); ?>
                          </div>
                          <div class="span8 caption">
                            <h3><?php echo $title;?></h3>
                            <?php the_content();?>
                            <?php if (!empty($link)):
                              echo'<a href="'.$link.'" class="button red small">'.$label.'</a>';
                            endif;?>
                           
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
                  <a href="<?php echo get_page_link(564)?>">This Week's Challenge</a>
          					<?php
          					$term = get_field('albums_name_above_camera');
          					?>
                    <span class="camera-album-name">&ldquo;<?php echo get_active_album()->name ?>&rdquo;</span>
          					<span class="camera-deadline">Ends Sunday at noon, U.S. Eastern</span>
          					<?php
          					if ( is_user_logged_in() ) {
          					 $submit = get_page_link(86);
                     } else {
                       $submit = get_page_link(57);
                      } 
                      $submit = get_page_link(3753);
                      ?>
                      <div class="camera-action">
              					<a class="red-circle" href="<?php echo $submit ?>">
                            <span class="submit-text">Get</span>
                            <span class="your-photo-text">Started</span>
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
                    $albums = get_terms('photo_alboms');
                    foreach ($albums as $album) {
                       $album_arr[get_field('week_number', $album)] = $album;
                    }
                    $curr_no = get_field('week_number', get_active_album());
                    for ($i=8; $i>= 1; $i--) {
                      $curweek = (($curr_no - $i) > 0) ? ($curr_no - $i) : 52 -($i-$curr_no);
                      if (!isset($album_arr[$curweek]))
                        continue;
                      $cur_album = $album_arr[$curweek];
                      $winner = new WP_Query(
                          array('post_type' => 'photo', 'posts_per_page' => 1, 
                                'meta_query' => array(
                                      array('key' => 'first_place', 'value' => 'Winner', 'compare' => '='), 
                                      array('key' => 'winner_photo', 'value' => '1', 'compare' => '=')
                                     ),
                                    'tax_query' => array(
                                    array(
                                      'taxonomy' => 'photo_alboms', 
                                      'field' => 'slug', 
                                      'terms' => $cur_album->slug,
                                      )
                                    )
                               )
                          );

                      $winner->the_post();
                      $term_link = get_field('fb_link', $cur_album);
                      $winner_name = get_field('winner_name', $cur_album);

                      echo '<div class="album">';
                      echo '<figure class="effect-albums">';
                      echo get_the_post_thumbnail(get_the_id(), 'thumb-480');
                      echo '<figcaption>';
                      echo '<h2><a class="album-name-hp" href="'.esc_url( $term_link ).'" target="_blank">Week '.$curweek.'<span>'.$cur_album->name.'</span></a></h2>';
                      echo '<p class="winner"><span>Photo by: '. $winner_name ./*.get_the_author_meta('display_name', $post->post_author).*/'</span></p>';
                      echo '</figcaption>';
                      echo '<a class="view" href="'.$term_link.'" target="_blank">View more</a>'; 
                      echo '</figure>' ;
                      echo '</div>';
                      wp_reset_postdata();
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

          	<div class="row-fluid stats">
          			<div class="span12 text-center"><a class="button-challenges-hp" href="#">View All Challenges</a></div>
                <div class="container hidden-phone">
              		<div class="counters-hp">
              			<div class="span3 counter-container text-center"><p class="timer count-title" id="count-number" data-to="18645" data-speed="5000"></p><p><span class="counter-bottom">Photographs Submitted</span></p></div>
              			<div class="span3 counter-container text-center"><p class="timer count-title" id="count-number" data-to="741" data-speed="5000"></p><p><span class="counter-bottom">Photographers to Date</span></p></div>
              			<div class="span3 counter-container text-center"><p class="timer count-title" id="count-number" data-to="38" data-speed="5000"></p><p><span class="counter-bottom">Countries Represented</span></p></div>
              			<div class="span3 counter-container text-center"><p class="timer count-title" id="count-number" data-to="218" data-speed="5000"></p><p><span class="counter-bottom">Weekly Challenges</span></p></div>
              		</div>
          	   </div>
          	</div>

            <!-- Latest Posts -->
            <div class="row-fluid latest-posts">
              <div class="container ">
                  <div class="span3 blog-preview">
                    <h3 class="title">From the Blog</h3>
                     <div class="hidden-phone"><?php the_field('lastest_posts_text'); ?></div>
                      <div class="buttons-blog-hp">
                          <a class="button blue small" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Visit Our Blog</a><br/>
                       <?php
                       $post_object = get_field('lastest_posts_post');
                        if( $post_object ): 
                           // override $post
                           $post = $post_object;
                           setup_postdata( $post ); 
                          ?>
                            Just getting started?<br/>
                            <a href="<?php echo get_page_link(1135)?>"> Visit our Beginner’s Guide to Photography</a>
                          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                       <?php endif; ?>
                      </div>  
                  </div>
                  <div class="span9 post-container pull-right">
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
                          <div><a href="<?php the_permalink()?>"><?php the_post_thumbnail('thumb-480' ); ?></a></div>            
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
                         <h3 class="title">Photowalks</h3>
                           <?php the_field('photo_walk_text'); ?>
                     </div>
                      <div class="span3 pull-right"  id="photo-walk-button">
                        <a class="button big" href="<?php echo get_field('photowalk_link')?>"><?php the_field('photo_walk_button'); ?></a>
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
                   <a class="view" href="<?php echo $framer_link ?>">view more</a>
                  <div class="featured-name">
                    <span>Featured <strong>Framer</strong></span>
                  </div>
                   <div class="featured-details"> 
                      <div class="framer-avatar">
                          <a href="<?php echo $framer_link ?>"><?php echo get_wp_user_avatar( $user['ID'], '150'); ?></a>
                      </div>   
                        <div class="framer-name">            
                            <a href="<?php echo $framer_link ?>"><?php echo $user['display_name'] ?></a>
                        </div>
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
                <?php $image = get_the_post_thumbnail($post->ID, 'thumb-640'); ?>
                <div><a href="<?php// the_permalink(); ?>"><?php echo $image; ?></a>
                  <div class="overlay"></div>
                   <!--a class="view" href="https://www.facebook.com/52frames/photos/a.833602159998239.1073742020.180889155269546/833611539997301/?type=3&theater)" target="_blank">view more</a-->
                </div>
                <div class="featured-name">
                    <span>Photo of <strong>the Day</strong></span>
                </div>
                <div class="featured-details">
                  <div class="title-hp">
                     <a <?php // the_permalink()?>><?php the_title();?></a>
                  </div>
                  <div class="framer-name">
                      <!--a href="<?php get_the_author_meta( 'user_url', $post->post_author ); ?>"-->
                    Photo by: <?php echo get_the_author_meta( 'display_name', $post->post_author ); ?></a>
                  </div>
                </div>
              </div>

                  <?php wp_reset_postdata(); 
                  // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
              <?php endif; ?>

              <?php
              $post_object = get_field('audience_award');
              $num_likes  = get_field('audience_award_likes');
              if( $post_object ): 

                // override $post
                $post = $post_object;
                setup_postdata( $post ); 
                ?>

              <div class="span4 featured-item"><?php $image = get_the_post_thumbnail($post->ID, 'thumb-640'); ?>
                <div>
                     <?php echo $image; ?>
                </div>
                <div class="overlay"></div>
                 <!--a class="view" href="https://www.facebook.com/52frames/photos/a.864942296864225.1073742044.180889155269546/864943163530805/?type=3&theater)" targe="_blank">view more</a-->
                <div class="featured-name">
                    <span>Audience <strong>Award</strong></span>
                </div>
                <div class="featured-details">
                <?php $album = get_active_album(); ?>
                  <div class="likes"><i class="fa fa-heart-o"></i><?php echo ' ' .$num_likes ?></div>
                  <?php //if( function_exists('zilla_likes') ) zilla_likes($post->ID); ?>
                  <div class="title-hp">
                     <a><?php the_title();?></a>
                  </div>
                    <div class="framer-name">
                      <!--a href="<?php get_the_author_meta( 'user_url', $post->post_author ); ?>"-->
                    Photo by: <?php echo get_the_author_meta( 'display_name', $post->post_author ); ?></a>
                    </div>   
                  </div>            
              </div>
                  <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
              <?php endif; ?>
          </div>
        </article>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/slick/slick.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
      $('.home-slider').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 4000,
      dots: true,
      arrows: false,
      speed: 500,
      fade: true,
      slide: 'div',
      cssEase: 'linear',
      responsive: [
      {
      breakpoint: 768,
      settings: {
      dots: false

      }
    }
  ]
  });
   $('.home-slider').show();   

     $('.albums-carousel').slick({
      lazyLoad: 'ondemand',
      rtl: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 2000,
      infinite: false,
      responsive: [
    {
      breakpoint: 1030,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        arrows: false,
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
         arrows: false,
      }
    }
  ]
  });
     $('.albums-carousel').show();  
 
});
</script>
<?php wpbootstrap_link_pages(); ?>
<?php //comments_template();