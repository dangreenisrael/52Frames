<?php
/**
 * The template for the right sidebar
 *
 */?>
<section id="sidebar" class="<?php echo 'span'.of_get_option( 'sidebar_width' ) ?> pull-right" role="complementary">
	<aside class="cat-list">	
		<h3 class="widget-title">Categories</h3>
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
	?>
	<?php endif; ?>
</section><!-- #sidebar -->