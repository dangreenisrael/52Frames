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
				<li class="comment-counter"><?php comments_popup_link( __( '<i class="fa fa-comments-o"></i><span>0</span>', 'wpbootstrap' ), __( '<span>1</span>', 'wpbootstrap' ), __( '<span>%</li>', 'wpbootstrap' ) );?></li>
				<ul class="social cf">
					<li class="share">share</li>                       
	                <li class="twitter"><a href="http://twitthis.com/twit?url=<?php the_permalink(); ?>" class="popup" target="_blank"><i class="fa fa-twitter"></i></a></li>
	                <li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>" class="popup" target="_blank"><i class="fa fa-facebook"></i></a></li>
	                <li class="googleplus"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="popup" target="_blank"><i class="fa fa-google-plus"></i></a></li>
	                <li class="pinterest"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $image_url; ?>" class="popup" target="_blank"><i class="fa fa-pinterest"></i></a></li>
	                <li class="linkedin"><a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="popup" target="_blank"><i class="fa fa-linkedin"></i></a></li>
	             </ul>
	         </div>
			<?php	get_template_part( 'content', get_post_format() );
			endwhile;
		?>

		<ul class="nav-single pager" role="navigation">
			<li class="nav-previous previous">
				<?php previous_post_link( '%link', '' . '&larr; '.'%title' ); ?>
			</li>
			<li class="nav-next next">
				<?php next_post_link( '%link', '%title' .' &rarr;'); ?>
			</li>
		</ul>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer();