<?php
/**
 * The default template for displaying a photo page.
 *
 */
?>
<?php $nudity = get_post_meta( get_the_id(), 'wpcf-this-photo-contains-nudity', true);
	$nude = '';
	if ($nudity != 0) $nude = " nude" ;
?>
<div class="span3">
	<article <?php post_class('clearfix') ?> id="post-<?php the_ID(); ?>">
		<figure>
			<a href="<?php the_permalink(); ?>" class="post-thumbnail thumbnail<?php echo $nude ?>">
				<?php the_post_thumbnail('thumb-480'); ?>			
			</a>
			<figcaption>		
				<h2><?php /* echo <a href="get_author_posts_url( get_the_author_meta( 'ID' ) ) rel="author">*/
					echo get_the_author(); ?>
				<?php if( function_exists('zilla_likes') ) zilla_likes();?>
				<i class="fa fa-comments"></i><?php comments_popup_link( __( '<span>0</span>', 'wpbootstrap' ), __( '<span>1</span>', 'wpbootstrap' ), __( '<span>%</span>', 'wpbootstrap' ) );?>
				</h2>
				<p><a href=<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
			</figcaption>			
		</figure>	
		<?php if ( current_user_can( 'judge' ) ) : ?>
			<div class="rating">
			<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
			</div>
		<?php endif ?>	
	</article>
</div>