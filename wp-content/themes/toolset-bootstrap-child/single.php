<?php
/**
 * The template for displaying all single posts
 *
 */
get_header(); ?>

<div class="row">
	<div class="span8">
		<?php
			while ( have_posts() ) : the_post();?>
			<div class="toolbar pull-left">
				<li id="comments-anchor" class="comment-counter"><a class="commentlink" href="#respond"/><?php comments_popup_link( __( '<i class="fa fa-comments-o"></i><span>0</span>', 'wpbootstrap' ), __( '<i class="fa fa-comments-o"></i><span>1</span>', 'wpbootstrap' ), __( '<i class="fa fa-comments-o"></i><span>%</li>', 'wpbootstrap' ));?></li>
				<ul class="social cf">
					<li class="share">share</li>                       
	                <li class="twitter"><a href="http://twitter.com/share?text=Currently reading <?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" class="popup" target="_blank"><i class="fa fa-twitter"></i></a></li>
	                <li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>" class="popup" target="_blank"><i class="fa fa-facebook"></i></a></li>
	                <li class="googleplus"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="popup" target="_blank"><i class="fa fa-google-plus"></i></a></li>
	                <li class="pinterest"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $image_url; ?>" class="popup" target="_blank"><i class="fa fa-pinterest"></i></a></li>
	                <li class="linkedin"><a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="popup" target="_blank"><i class="fa fa-linkedin"></i></a></li>
	                <li class="facebook-like"><div class="fb-like" data-href="<?php the_permalink()?>" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div><li>
	             </ul>
	         </div>
			<?php	get_template_part( 'content', get_post_format() );
			endwhile;
		?>

	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer();