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

?>	
<div class="js">
<!--div id="preloader"></div-->
<div class="row-fluid winners">
	<div class="container">
		<?php 
		$labels = array('winner' => 'Judges\' Pick', '1runner' => '2nd Place', '2runner' => '3rd Place');
		foreach (array('winner'=>'Winner', '1runner' => '1st Runner-up', '2runner' => '2nd Runner-up') as $key=>$val) { 
			$nudity = get_post_meta( $w_arr[$val], 'wpcf-this-photo-contains-nudity', true);
			$nude = ($nudity != 0) ? 'nude' : '';
			?>
			<div class="span4 <?php echo $key; ?>">
				<figure>
				<a href="<?php the_permalink(); ?>" class="<?php echo $nude ?>">		
					<?php echo get_the_post_thumbnail($w_arr[$val],'thumb-480'); ?>
				</a>
					<span class="badge winner"><?php echo $labels[$key]; ?></span>		
					<figcaption>		
						<h2>
							<a href="<?php echo get_author_posts_url( $w_arr[$val],get_the_author_meta( 'ID' ) )?>" rel="author">
						 	<?php echo  get_the_author_meta('display_name', get_post($w_arr[$val])->post_author);?></a>
						 	<span class="pull-right">
								<?php 
								if( function_exists('zilla_likes') ) zilla_likes($w_arr[$val]);?>
								<i class="fa fa-comments"></i><?php comments_number( __( '<span>0</span>', 'wpbootstrap' ), __( '<span>1</span>', 'wpbootstrap' ), __( '<span>%</span>', 'wpbootstrap' ) );?>
							</span>
						</h2>
						<p><a href="<?php echo get_the_permalink($w_arr[$val])?>"><?php echo get_the_title($w_arr[$val])?></a></p>
					</figcaption>			
				</figure>			
			</div>
		<?php } ?>
		
	</div>
</div>

<?php 
if (!empty($_SERVER['QUERY_STRING'])) { ?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$( 'html, body' ).scrollTop($('#searchandfilter').position().top + 150);

	});
</script>
 <?php }?>
<div class="container album-lists">
	<div class="row-fluid filter-container">
		<div class="filterbox span3">
			<form action="" method="get" class="searchandfilter" id='searchandfilter'>
				<ul>
					<li class="sf-field-sort_order" >
						<h4>Sort By</h4>
						<select class="postform" name="sortorder" id='sortorder'>
							<option class="level-0" value="">Sort Results By</option>
							<?php foreach (array('date' => 'Date', 'title' =>'Title', 'rating' => 'Rating score', 'zilla_likes' => 'Most Liked' ) as $k=>$v) {
								$selected = ($_GET['sortorder'] == $k) ? 'selected' : '';
								echo "<option class='level-0' value='".$k."' $selected>".$v."</option>";
							} ?>
						</select>
					</li>
				</ul>
			</form>
			<?php //echo do_shortcode( '[searchandfilter id="133"]' ); ?>
			<div class="nudity-filter">
				<label>Display Nudity</label>
			    <div class="toggle-container" id='nudity-toggle'>
			       <input type="radio" id="toggle-on" class="toggle toggle-left" name="show_nudity" value='on'  >
			       <label for="toggle-on" class="btn">On</label>
			       <input id="toggle-off" class="toggle toggle-right" name="show_nudity" value='off' type="radio" checked>
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
			<form action="" method="get" class="searchandfilter" >
				<ul>
					<li class="sf-field-post-meta-wpcf-this-photo-contains-nudity">
						<select class="postform" name="filterby" id='filterby'>
							<option class="level-0" value="">FilterBy</option>
							<?php foreach (get_lists_arr() as $k=>$v) {
								$selected = ($_GET['filterby'] == $k) ? 'selected' : '';
								echo "<option class='level-0' value='".$k."' $selected>".$v."</option>";
							} ?>
						</select>
					</li>
					<li class="sf-field-post-meta-wpcf-this-photo-contains-nudity">
						<select class="postform" name="photo_type" id='photo_type'>
							<option class="level-0" value="">Photo Type</option>
							<?php 
							foreach (get_photo_type_arr() as $k=>$v) {
								$selected = ($_GET['photo_type'] == $k) ? 'selected' : '';
								echo "<option class='level-0' value='".$k."' $selected>".$v."</option>";
							} ?>
						</select>
					</li>
					<li class="sf-field-search" data-sf-field-name="search" data-sf-field-type="search" data-sf-field-input-type="">
						<input type="text" name="search" placeholder="Search …" value="">
					</li>
				</ul>
			</form>
			<?php //echo do_shortcode( '[searchandfilter id="130"]' ); ?></div>
		<?php if ( current_user_can( 'judge' ) ) : ?>
			<div class="filterbox span3"><?php echo do_shortcode( '[searchandfilter id="164"]' ); ?></div>
		<?php endif;?>
	</div>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#sortorder,#filterby,#photo_type').change(function(event) {
				val = $(this).val();
				id = $(this).attr('id');
				var queryParameters = {}, queryString = location.search.substring(1),
				    re = /([^&=]+)=([^&]*)/g, m;
				 
				while (m = re.exec(queryString)) {
				    queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
				}				 
				queryParameters[id] = val;
				location.search = $.param(queryParameters); // Causes page to reload
			});
		});
	</script>
	<?php 
	$args = album_query_args($w_arr);

	// get ad photo
	$ad_id == 0;
	$ad_photo = new WP_Query(array('post_type' => 'photo', 'photo_alboms' => get_queried_object()->slug, 'meta_query' => array(array('key'=>'ad_photo', 'value' => '1'))));
	if ($ad_photo->have_posts()) {
		$ad_photo->the_post();
		$ad_id = get_the_id();
		$ad_photo->rewind_posts();
		$args['post__not_in'] = array($ad_id);
	}

	$photos = new WP_Query($args);
	$i = 0;
	if ( $photos->have_posts() ) : ?>
		<div class="row-fluid  clearfix">
			<?php
				while ( $photos->have_posts() ) : $photos->the_post(); 
					$i++;
					if ($i == 4 && $ad_id != 0) {
						$ad_photo->the_post();
						get_template_part( 'content-albums_collection' );
						$photos->reset_postdata();	
					}
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