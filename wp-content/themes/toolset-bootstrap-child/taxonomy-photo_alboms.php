<?php

/**
 * The template for displaying Albums.
 *
 */

get_header(); 

$album = get_queried_object();
$winners = new WP_Query(array('post_type' => 'photo', 
	'meta_query' => array(array('key' => 'winner_photo', 'value' => '1', 'compare' => '=')),
	'tax_query' => array(array('taxonomy' => 'photo_alboms', 'field' => 'slug', 'terms' => $album->slug))));
if ($winners->have_posts()): while($winners->have_posts()): $winners->the_post();
	$tag = get_field('first_place');
	$w_arr[$tag] = get_the_id();
endwhile; endif;

if (is_user_logged_in()) {
	global $current_user;
    get_currentuserinfo();
	$nudity = get_user_meta($current_user->ID, 'show_nudity', true);
	$nudity_class = ($nudity == 1) ? 'show_nudity' : 'hide_nudity';
} else {
	$nudity = $_COOKIE["show_nudity"];
	$nudity_class = ($nudity == 1) ? 'show_nudity' : 'hide_nudity';
}
	?>

<div class="js <?php echo $nudity_class;?>">
<!--div id="preloader"></div-->
<div class="row-fluid winners">
	<div class="container">
		<?php 
		foreach (array('winner'=>'Winner', '1runner' => '1st Runner-up', '2runner' => '2nd Runner-up') as $key=>$val) { 
			$nudity = get_post_meta( get_the_id(), 'wpcf-this-photo-contains-nudity', true);
			$nude = ($nudity != 0) ? 'nude' : '';
			?>
			<div class="span4 <?php echo $key; ?>">
				<figure>		
				<?php echo get_the_post_thumbnail($w_arr[$val],'thumb-480'); ?>
					<span class="badge winner">Judges’ Pick</span>		
					<figcaption>		
						<h2>
							<a href="<?php echo get_author_posts_url( $w_arr[$val],get_the_author_meta( 'ID' ) )?>" rel="author" class="<?php echo $nude; ?>">
						 	<?php echo  get_the_author_meta('display_name', get_post($w_arr[$val])->post_author);?></a>
						 	<span class="pull-right">
								<?php 
								if( function_exists('zilla_likes') ) zilla_likes($w_arr[$val]);?>
								<i class="fa fa-comments"></i><?php comments_popup_link( __( '<span>0</span>', 'wpbootstrap' ), __( '<span>1</span>', 'wpbootstrap' ), __( '<span>%</span>', 'wpbootstrap' ) );?>
							</span>
						</h2>
						<p><a href="<?php echo get_the_permalink($w_arr[$val])?>"><?php echo get_the_title($w_arr[$val])?></a></p>
					</figcaption>			
				</figure>			
			</div>
		<?php } ?>
		
	</div>
</div>

<div class="container album-lists">
	<div class="row-fluid filter-container">
		<div class="filterbox span3">
			<!-- <form action="" method="get" class="searchandfilter">
				<ul>
					<li class="sf-field-sort_order" >
						<h4>Sort By</h4>
						<select class="postform" name="sortorder">
							<option class="level-0" value="">Sort Results By</option>
							<option class="level-0" value="date">Date</option>
							<option class="level-0" value="title">Title</option>
							<option class="level-0" value="rating">Ratings score</option>
							//<option class="level-0" value="ratings_average">Ratings average</option>
							<option class="level-0" value="zilla_likes">Most Liked</option>
						</select>
					</li>
				</ul>
			</form> -->
			<?php echo do_shortcode( '[searchandfilter id="133"]' ); ?>
			<div class="nudity-filter">
				<label>Display Nudity</label>
			    <div class="toggle-container" id='nudity-toggle'>
			       <input id="toggle-on" class="toggle toggle-left" name="toggle-on" type="radio" >
			       <label for="toggle-on" class="btn">On</label>
			       <input id="toggle-off" class="toggle toggle-right" name="toggle-off" type="radio" checked>
			       <label for="toggle-off" class="btn">Off</label>
			    </div>
			</div>

		</div>
		<?php if ( current_user_can( 'judge' ) ) : ?>
		<div class="filterbox span6">
		<?php else :?>
		<div class="filterbox span9">
		<?php endif;?>
			<h4>Filter By</h4>
			<!-- <form action="" method="get" class="searchandfilter" >
				<ul>
					<li class="sf-field-post-meta-wpcf-this-photo-contains-nudity">
						<select class="postform" name="_sfm_wpcf-this-photo-contains-nudity[]">
							<option class="level-0" value="">Photo Type</option>
							<option class="level-0" value="2">Portrait</option>
							<option class="level-0" value="1">Landscape</option>
						</select>
					</li>
					<li class="sf-field-search" data-sf-field-name="search" data-sf-field-type="search" data-sf-field-input-type="">
						<input type="text" name="_sf_search" placeholder="Search …" value="">
					</li>
					<input type="hidden" name="_sf_submitted" value="1" />
					<input type="hidden" name="_sf_form_id" value="130" class="sf_form_id" />
				</ul>
			</form> -->
			<?php echo do_shortcode( '[searchandfilter id="130"]' ); ?></div>
		<?php if ( current_user_can( 'judge' ) ) : ?>
			<div class="filterbox span3"><?php echo do_shortcode( '[searchandfilter id="164"]' ); ?></div>
		<?php endif;?>
	</div>

	<?php 
	// $args = array('post_type' => 'photo', 'photo_alboms' => get_queried_object()->slug);
	// if (isset($_GET['sortorder']) && $_GET['sortorder'] == 1) {
	// 	switch ($_GET['sortorder']) {
	// 		case 'date':
	// 			$args['orderby'] = 'date';
	// 			$args['order'] = 'ASC';
	// 		case 'title':
	// 			$args['orderby'] = 'title';
	// 			$args['order'] = 'ASC';
	// 			break;
	// 		case 'zilla_likes':
	// 			$args['orderby'] = 'meta_value_num';
	// 			$args['meta_key'] = '_zilla_likes';
	// 			break;
	// 		case 'rating':
	// 			$args['orderby'] = 'meta_value_num';
	// 			$args['meta_key'] = 'ratings_users';
	// 			$args['order'] = 'DESC';
	// 			break;
	// 	}
	// }
	// $photos = new WP_Query($args);
	if ( have_posts() ) : ?>
		<div class="row-fluid  clearfix">
			<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'content-albums_collection' );
				endwhile;
			?>			
		</div>
	<?php endif; 
	 if ( function_exists( 'aero_page_navi' ) ) 				
				aero_page_navi()
	?>
	</div>
</div>
<?php get_footer();