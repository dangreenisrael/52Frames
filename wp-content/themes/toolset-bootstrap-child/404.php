<?php

/*

Template Name: 404 template

*/

get_header(); ?>

	<article <?php post_class('clearfix') ?> id="post-<?php the_ID(); ?>">
	<div class="entry-content">
		<h2>whoopsie!</h2>
		<h3>Looks like we forgot to take the lens cap off before making this page. There’s nothing here!<br>
		 <a href="<?php echo home_url() ?>">Click here</a> to return to the homepage.</h3>
	</div><!-- .entry-content -->

</article>
	


<?php get_footer();