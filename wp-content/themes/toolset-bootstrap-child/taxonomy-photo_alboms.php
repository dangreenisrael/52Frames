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

<div class="row-fluid winners">
	<div class="container">
		<div class="span4 winner">
			<figure>		
			<?php echo get_the_post_thumbnail($w_arr['Winner'],'thumb-480'); ?>
				<span class="badge winner">Winner</span>		
				<figcaption>		
					<h2><!--a href="'.get_author_posts_url( $w_arr['Winner'],get_the_author_meta( 'ID' ) ) .'" rel="author"-->
					 <?php echo  get_the_author_meta('display_name', get_post($w_arr['Winner'])->post_author);
					if( function_exists('zilla_likes') ) zilla_likes($w_arr['Winner']);?>
					<i class="fa fa-comments"></i><?php comments_popup_link($w_arr['Winner'], __( '<span>0</span>', 'wpbootstrap' ), __( '<span>1</span>', 'wpbootstrap' ), __( '<span>%</span>', 'wpbootstrap' ) );?>
					</h2>
					<p><a href="<?php echo get_the_permalink($w_arr['Winner'])?>"><?php echo get_the_title($w_arr['Winner'])?></a></p>
				</figcaption>			
			</figure>			
		</div>
		<div class="span4 1runner">
			<figure>		
			<?php echo get_the_post_thumbnail($w_arr['1st Runner-up'],'thumb-480'); ?>
				<span class="badge winner">1st Runner-up</span>		
				<figcaption>		
					<h2><!--a href="'.get_author_posts_url( $w_arr['1st Runner-up'],get_the_author_meta( 'ID' ) ) .'" rel="author"-->
					 <?php echo  get_the_author_meta('display_name', get_post($w_arr['1st Runner-up'])->post_author);
					if( function_exists('zilla_likes') ) zilla_likes($w_arr['1st Runner-up']);?>
					<i class="fa fa-comments"></i><?php comments_popup_link($w_arr['1st Runner-up'], __( '<span>0</span>', 'wpbootstrap' ), __( '<span>1</span>', 'wpbootstrap' ), __( '<span>%</span>', 'wpbootstrap' ) );?>
					</h2>
					<p><a href="<?php echo get_the_permalink($w_arr['1st Runner-up'])?>"><?php echo get_the_title($w_arr['1st Runner-up'])?></a></p>
				</figcaption>			
			</figure>		
		</div>
		<div class="span4 2runner">
			<figure>		
			<?php echo get_the_post_thumbnail($w_arr['2nd Runner-up'],'thumb-480'); ?>
				<span class="badge winner">2nd Runner-up</span>		
				<figcaption>		
					<h2><!--a href="'.get_author_posts_url( $w_arr['2nd Runner-up'],get_the_author_meta( 'ID' ) ) .'" rel="author"-->
					 <?php echo  get_the_author_meta('display_name', get_post($w_arr['2nd Runner-up'])->post_author);
					if( function_exists('zilla_likes') ) zilla_likes($w_arr['2nd Runner-up']);?>
					<i class="fa fa-comments"></i><?php comments_popup_link($w_arr['2nd Runner-up'], __( '<span>0</span>', 'wpbootstrap' ), __( '<span>1</span>', 'wpbootstrap' ), __( '<span>%</span>', 'wpbootstrap' ) );?>
					</h2>
					<p><a href="<?php echo get_the_permalink($w_arr['2nd Runner-up'])?>"><?php echo get_the_title($w_arr['2nd Runner-up'])?></a></p>
				</figcaption>			
			</figure>		
		</div>
	</div>
</div>

<div class="container">
	<div class="row-fluid filter-container">
		<div class="filterbox span3"><?php echo do_shortcode( '[searchandfilter id="133"]' ); ?></div>
		<?php if ( current_user_can( 'judge' ) ) : ?>
		<div class="filterbox span6">
		<?php else :?>
		<div class="filterbox span9">
		<?php endif;?>
			<h4>Filter By</h4>
			<?php echo do_shortcode( '[searchandfilter id="130"]' ); ?></div>
		<?php if ( current_user_can( 'judge' ) ) : ?>
			<div class="filterbox span3"><?php echo do_shortcode( '[searchandfilter id="164"]' ); ?></div>
		<?php endif;?>
	</div>

	<?php if ( have_posts() ) : ?>
		<div class="row-fluid album-lists">
			<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'content-albums_collection' );
				endwhile;
				wpbootstrap_content_nav();
			?>
		</div>
	<?php endif; ?>
</div>
<?php get_footer();