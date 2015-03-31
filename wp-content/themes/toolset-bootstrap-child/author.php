<?php
/**
 * The template for displaying Categories.
 *
 */
get_header(); ?>
<div class="span8">
	<div class="author-box">
		<div class="about-author-container clearfix">
	        <div class="avatar-cell span3">
	          <?php echo get_avatar(get_queried_object_id(), '100'); ?>
	        </div>
	        <div class="description span9">
	        	<h2 class="title"><?php echo get_queried_object()->display_name; ?></h2>
	         	 <?php echo get_queried_object()->description; ?>
	        	<!--div class="author-link">View All Posts By <?php the_author_posts_link(''); ?></div-->
	        </div>
	  	</div>
	 </div>

	<div class="badges">
		<h2>Badges:</h2>
	<?php
	$winners = new WP_Query(array ('author' => get_the_author_id(),
		'meta_query' => array(
			array('key' => 'winner_photo', 'value' => '1'),
			array('key' => 'first_place', 'value' => 'winner')
		),
	));
	if ($winner->found_posts)
		echo "winner badge<br/>";

	$winners = new WP_Query(array ('author' => get_the_author_id(),
		'meta_query' => array(
			array('key' => 'winner_photo', 'value' => '1'),
			array('key' => 'first_place', 'value' => '1runner')
		),
	));
	if ($winner->found_posts)
		echo "1st Runner-up badge<br/>";

	$winners = new WP_Query(array ('author' => get_the_author_id(),
		'meta_query' => array(
			array('key' => 'winner_photo', 'value' => '1'),
			array('key' => 'first_place', 'value' => '2runner')
		),
	));
	if ($winner->found_posts)
		echo "2nd Runner-up badge<br/>";

	wp_reset_postdata();
	
	global $wpdb;
	$comment_count = $wpdb->get_var('SELECT COUNT(comment_ID) FROM ' . $wpdb->comments. ' WHERE comment_author_email = "' . get_the_author_meta('email') . '"');
	if ($comment_count > 0)
		echo "Top Commenter badge <br/>";

	?>
	</div>
	<div id='following'>
		<h2>Following:</h2>
		<?php 
		$uid = get_queried_object_id();
		$following = get_user_meta($uid , 'following', true );
		$following = explode(',', $following); 
		$f_users = new WP_User_Query(array ('include'        => $following));
		if ( ! empty( $f_users->results ) ) {
			foreach ( $f_users->results as $user ) {
				echo '<p>' . $user->display_name . '</p>';
			}
		} else {
			echo 'No users found.';
		}
		?>
	</div>
	<div id="stats">
		<h2>Stats:</h2>
		<?php 
		$aposts = new WP_Query(array ('author' => get_the_author_id(), 'posts_per_page' => -1));
		if ($aposts->have_posts()): while ($aposts->have_posts()): $aposts->the_post();
			$count += get_post_meta(get_the_id(), '_zilla_likes', true);
		endwhile; endif;
		echo "Photos: ".$aposts->found_posts."<br/>";
		echo "Likes: $count<br />";
		echo "Comments: $comment_count<br/>";
		 ?>
	</div>
	<div id="photos">
		<h2>User Photos:</h2>
		<?php 
		$photos = new WP_Query(array('post_type' => 'photo', 'author' => get_queried_object_id(), 'posts_per_page' => -1));
		// var_dump($photos);
		if ($photos->have_posts()) {
			while ( $photos->have_posts() ) : $photos->the_post();
				get_template_part( 'content-albums_collection' );
			endwhile;
			wp_reset_postdata();
		}
		?>
	</div>
	<div id="posts">
	<h2>Blog Posts:</h2>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; 
		if ( function_exists( 'aero_page_navi' ) ) 	:			
				aero_page_navi();
		 endif;

	 ?>
	 </div>

	<?php endif; ?>
	 </div>
    <?php get_sidebar(); ?>

<?php get_footer();