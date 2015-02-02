<?php
/**
 * The template for the right sidebar
 *
 */?>
<section id="sidebar" class="<?php echo 'span'.of_get_option( 'sidebar_width' ) ?> pull-right" role="complementary">
	<?php if (is_single()): ?>
	<aside class="about52">	
		<p>52Frames offers photography enthusiasts from around the world a free, fun weekly photo challenge. Want to improve your photography?</p>
		 <a href="<?php echo get_page_link(564); ?>">Come join us!</a>
	</aside>
	<?php endif; ?>
	<aside class="cat-list">	
		<h3 class="widget-title">Blog Categories</h3>
<?php		
	$catsy = get_the_category();
	$myCat = $catsy[0]->cat_ID;
	$currentcategory = '&current_category='.$myCat;
	wp_list_categories('hierarchical=1&show_count=1&style=list&use_desc_for_title=0&exclude=12&depth=1&orderby=id&title_li='.$currentcategory);
?>
	</aside>
	<?php
	if ( is_dynamic_sidebar() ):
		dynamic_sidebar( 'Sidebar' );
	 endif; ?>
</section><!-- #sidebar -->