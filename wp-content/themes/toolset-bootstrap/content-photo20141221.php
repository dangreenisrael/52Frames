<?php
/**
 * The default template for displaying a photo page.
 *
 */
?>
<div class="raw">
<article <?php post_class('clearfix') ?> id="post-<?php the_ID(); ?>">

<div class="col-md-12">
	<div class="albom-name-photo">
	<h1><?php
	echo types_render_field("alboms-name", array("show_name"=>"false","output"=>"html","id"=>"$parent"));
	?></h1>
	</div>
</div>
		
<div class="col-md-8">	
	<div class="photo-thumbnail">
		<div class="entry-content clearfix">

		<?php if (is_search()): ?>
			<?php the_excerpt(); ?>
		<?php else: ?>

			<?php if ( has_post_thumbnail() && wpbootstrap_get_setting('general_settings','display_thumbnails') ): ?>
				<a href="<?php the_permalink(); ?>" class="post-thumbnail thumbnail pull-left">
					<?php the_post_thumbnail('full'); ?>
					<?php exifography_display_exif($options); ?>
				</a>
			<?php endif; ?>

			

			

			<?php wpbootstrap_link_pages(); ?>

			<?php if ( is_sticky() && is_home() ): ?>
				<a class="btn btn-primary btn-large" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to', 'wpbootstrap' ).' %s', the_title_attribute( 'echo=0' ) ) ); ?>">
					<?php _e( 'Read more', 'wpbootstrap' ) ?>
				</a>
			<?php endif; ?>
		<?php endif; ?>
	</div></div><!-- .entry-content -->
</div>

<div class="col-md-4">		
		<div class="photo-description">
		<?php 
        	if ((is_single()) && (wpbootstrap_get_setting('general_settings','display_postmeta')) && !(wpbootstrap_get_setting('titles_settings','display_single_post_titles'))) {   
		?>
		
		<header>
			<header>
		<?php }?>
		<div id="author_pic">
		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author">
		<?php echo get_avatar( get_the_author_meta('ID'), 60); ?></a>
		</div>
		<?php get_template_part('entry-meta-photo'); ?>
		<?php 
        	if ((is_single()) && (wpbootstrap_get_setting('general_settings','display_postmeta'))) {   
		?>
		</header>
		<div class="clear"></div>
		<?php } elseif (( 'post' != get_post_type() ) && (wpbootstrap_get_setting('general_settings','display_postmeta_cpt'))) {?>
		</header>
		<?php } elseif (isset($archive_looped_page)) {
		    if ($archive_looped_page) {
        ?>
        </header>
		<?php } elseif (( 'post' != get_post_type() ) && (wpbootstrap_get_setting('general_settings','display_postmeta_cpt')) && !(wpbootstrap_get_setting('titles_settings','display_single_post_titles_cpt'))) {?>
        <?php }}?>
		
			<?php if (is_single()): ?>
		    <?php 
		    if ( 'post' != get_post_type() ) {
            ?>  
			<?php if (wpbootstrap_get_setting('titles_settings','display_single_post_titles_cpt')): ?>
			    <header>
				<h1><?php the_title(); ?></h1>
			<?php endif; ?>
            <?php 
            } else {
		    ?>
			<?php if (wpbootstrap_get_setting('titles_settings','display_single_post_titles')): ?>
			    <header>
				<h1><?php the_title(); ?></h1>
			<?php endif; ?>
			<?php } ?>
		<?php else: ?>
			<?php if (
					( wpbootstrap_get_setting('titles_settings','display_categories_post_titles') && is_category() ) || // for cateogires
					( wpbootstrap_get_setting('titles_settings','display_tags_post_titles') && is_tag() ) || // for tags
					( wpbootstrap_get_setting('titles_settings','display_archives_post_titles') && is_archive() && ( !is_tag() && !is_category() ) ) || // for archives. There is an additional condition needed because is_archove() returns true not only for archives but for tags and categories as well
					( wpbootstrap_get_setting('titles_settings','display_home_post_titles') && is_home() ) || // for homepage blog index
					( wpbootstrap_get_setting('titles_settings','display_search_post_titles') && is_search() ) // for homepage blog index
				): ?>
				<header>
				<?php $archive_looped_page=TRUE;?>
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to', 'wpbootstrap' ).' %s', the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h2>
			<?php endif; ?>
		<?php endif; ?>

		<!-- Rating Widget -->
		<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
		
		<!-- Content -->
		<?php the_content( '<span class="btn btn-small btn-primary pull-right">'.__( 'Read more', 'wpbootstrap' ).' &raquo;</span>' ); ?>
		<!-- End Content -->
		
		<!-- Start Custom Fileds -->
		<?php
		echo types_render_field("extra-challange", array("show_name"=>"true","output"=>"html","id"=>"extra-challange"));
		echo types_render_field("type-of-photo", array("show_name"=>"true","output"=>"html","id"=>"type-of-photo"));
		?>
		</div>
<?php setPostViews(get_the_ID()); ?>
<?php echo getPostViews(get_the_ID()); ?>
	</div>

</article>
</div> 

<!-- Tags -->
<?php if (has_category() || has_tag() ):?>
		<p>
			<?php if (has_tag()): ?>
			<?php _e( 'Tags:', 'wpbootstrap' ); echo ' ';echo get_the_tag_list('',', ',''); ?>.
			<?php endif; ?>
		</p>
		<?php endif; ?>

<!--exifograpgy Shortcode -->
<?php
if (function_exists('exifography_display_exif')) {
	echo exifography_display_exif();
}
?>

<?php comments_template(); ?>