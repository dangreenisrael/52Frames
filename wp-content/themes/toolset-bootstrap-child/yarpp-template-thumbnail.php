<?php
/*
YARPP Template: Thumbnails
Description: Requires a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/ ?>
<h3>Let's Read Some More!</h3>
<?php if (have_posts()):?>
<div class="row yarpp-thumbnails-horizontal">
	<?php while (have_posts()) : the_post(); ?>
		<?php if (has_post_thumbnail()):?>
		<div class="yarpp-thumbnail span3">
			<div class="yarpp-item">
				<?php the_post_thumbnail('thumb-480'); ?>
				<span class="yarpp-thumbnail-title"><?php the_title()?></span>
				<a class="view" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">Read More</a>

			</div>
		</div>
		<?php endif; ?>
	<?php endwhile; ?>
</div>

<?php else: ?>
<p>No related photos.</p>
<?php endif; ?>
