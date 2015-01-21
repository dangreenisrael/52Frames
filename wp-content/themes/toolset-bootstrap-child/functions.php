<?php
require('functions_dan.php');
require('functions_hanit.php');

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
	
function theme_enqueue_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'parent-style' ) );
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/bootstrap-responsive.min.css' ); 
}

add_filter('wp_enqueue_scripts', 'enqueue_my_scripts', 20);

function enqueue_my_scripts() {
	if (!is_admin()) {
	    wp_enqueue_style('main-css', get_stylesheet_directory_uri() . '/css/main.css', array(), false);
	    wp_enqueue_style( 'fontAwesome', get_stylesheet_directory_uri() . '/font-awesome.min.css', array(), '' );
	    wp_enqueue_style( 'glyphicons', get_stylesheet_directory_uri() . '/font-awesome.min.css', array(), '' );
	   	wp_enqueue_style( 'parent-style', get_stylesheet_directory_uri() . '/assets/styles.css' ); 
		wp_enqueue_style( 'countdown', get_stylesheet_directory_uri() . '/assets/jquery.countdown.css' ); 

		wp_enqueue_script('blur', get_stylesheet_directory_uri() . '/js/blur.js');
		wp_enqueue_script('script', get_stylesheet_directory_uri() . '/js/script.js');
		wp_enqueue_script( 'countdown', get_stylesheet_directory_uri() . '/js/jquery.countdown.js', array('jquery') ); 
		wp_enqueue_script( 'countdown', get_stylesheet_directory_uri() . '/js/jquery.counterup.min.js', array('jquery') );

		wp_enqueue_script('thickbox',null,array('jquery'));
		wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
	}
}


/** Add Bottom Menu **/

function register_my_menu() {
  register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'register_my_menu' );


// function switch_homepage() {
// 	if ( is_user_logged_in()) {
// 		$page = get_page_by_title( 'Submit Your Photo' );
// 	    update_option( 'page_on_front', $page->ID );
// 	    update_option( 'show_on_front', 'page' );
// 	}else{
//         wp_redirect( 'http://qa.52frames.com' );
//         exit;
//     }
// }
// add_action( 'init', 'switch_homepage' );

/************* THUMBNAIL SIZE OPTIONS *************/
add_image_size( 'thumb-2048', 2048, auto, true );
add_image_size( 'thumb-h545', auto, 545, true );
add_image_size( 'thumb-780', 780, 520, true );
add_image_size( 'thumb-640', 640, 427, true );
add_image_size( 'thumb-480', 480, 320, true );
add_image_size( 'thumb-440', 440, 250, true );

function get_active_album() {
	$albums = get_terms('photo_alboms', array('hide_empty' => false));
	foreach ($albums as $a):
		if (get_field('album_status', $a) == 'OPEN')
			return $a;
	endforeach;
	return null;
}

function add_photo_js() {
	$active_album = get_active_album();
	if ($active_album != null) {
		$album_title = addslashes($active_album->name);
		$album_tag_ids = get_field('album_tags', $active_album);
		$tags = get_terms('photo-tags', array('include' => $album_tag_ids, 'fields' => 'names'));
		$tags = implode(',', $tags);
		$extra_challange = addslashes(get_field('extra_challange_desc', $active_album));
		$weekno = get_field('week_number', $active_album);
		if (is_user_logged_in())
			$user = wp_get_current_user()->display_name;
	}

	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#parent_tags').text('<?php echo $tags; ?>');
		$('#album_name').text('<?php echo $album_title; ?>');
		$('#challange_desc').text('<?php echo  $extra_challange; ?>');
		$('#weekno').text('<?php echo  $weekno; ?>');
		$('.cred-field-contains-nudity input[type="checkbox"]').attr('checked', false);
		$('.cred-field-extra-challange input[type="checkbox"]').attr('checked', false);
		$('.cred-field-for-sale input[type="checkbox"]').attr('checked', false);
		$('.creation input[type="checkbox"]').attr('checked', false);
		$('.cred-field-post_title input[type="text"]').attr('maxlength', 40);
		$('.cred-field-post_content textarea').attr('maxlength', 1000);
		<?php if (is_user_logged_in()) { ?>
			$('.nav .users').html($('.nav .users').html().replace('My Account', '<?php echo $user; ?>'));
		<?php } ?>
		$('.wpt-form-submit').click(function(){
			if (jQuery('#_featured_image_file').val() == '') { alert('You must add an image to this submission'); return false;}
		});
		
	});
	</script>
	<?php
}

add_action('wp_footer', 'add_photo_js');

/*
 * Add custom fields to album on submission
 */
add_action('cred_save_data', 'add_data_to_photo',10,2);
function add_data_to_photo($post_id, $form_data){
	// if Photo Add Form
	if ($form_data['id'] == 92) {
		$active_album = get_active_album();
		// Add Photo association to the album
		wp_set_object_terms($post_id, $active_album->slug, 'photo_alboms');

		// Add Photo association to Editor tags
		$album_tag_ids = get_field('album_tags', $active_album);
		$tag_names = get_terms('photo-tags', array('include' => $album_tag_ids, 'fields' => 'names'));
		wp_set_post_tags($post_id, $tag_names, true);
	}
}
// function to display number of posts.
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// Add it to a column in WP-Admin
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('Views');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
	if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}

/*
 *  Check if the user has posted to the open album
 *
 *  Returns true is the user hasn't posted yet (allowed to post)
 */
function allowed_to_post_photo(){

	$current_user = wp_get_current_user()->ID;
	if ($current_user == 0) return true;
	$args = array(
		'post_type' => 'photo',
		'numberposts' => -1,
		'author'    => $current_user,
		'post_author' => $current_user,
		'tax_query' => array(
			array(
				'taxonomy' => 'photo_alboms',
				'field' => 'slug',
				'terms' => get_active_album()
			)
		)
	);

	$all_attachments = get_posts( $args );
	$i=0;
	foreach ($all_attachments as $attachment){
		$i++;
	}
	return ($i < 1);
}


/*
 * Block users from pages they don't have access to
 */

function block_page($album_slug){
	$current_user = wp_get_current_user();
	if ( !($current_user instanceof WP_User) ) return;
	$roles = $current_user->roles;
	$open_album_slug = get_active_album()->slug;
	if ($album_slug == $open_album_slug) {
		if ( !(in_array('administrator', $roles) || in_array('judge', $roles) || in_array('moderator', $roles)) ){
			echo "<h2> You shouldn't be here </h2>";
			get_footer();
			exit;
		}
	}
}

/*
* Filter Posts by Author 
*/

add_filter('posts_join', 'zipsearch_search_join' );
function zipsearch_search_join ($join){
    global $pagenow, $wpdb;
    if ( is_admin() && $pagenow=='edit.php' && $_GET['post_type']=='photo' && $_GET['s'] != '') {    
        $join .='LEFT JOIN '.$wpdb->users. ' ON '. $wpdb->posts . '.post_author = ' . $wpdb->users . '.ID ';
    }
    return $join;	
}
add_filter( 'posts_where', 'zipsearch_search_where' );
function zipsearch_search_where( $where ){
    global $pagenow, $wpdb;
    if ( is_admin() && $pagenow=='edit.php' && $_GET['post_type']=='yphoto' && $_GET['s'] != '') {
       $where = preg_replace(
       "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
       "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->users.".display_name LIKE $1)", $where );
    }
    return $where;
}

/**************************************************************/
/*                     ADMIN ACF Validations                  */
/**************************************************************/  

// if it's the admin, add a hidden input with the post_id
if ( is_admin() ){
    // add the post_ID to the acf[] form
    add_action( 'edit_form_after_editor', 'my_edit_form_after_editor' );
}
function my_edit_form_after_editor( $post ){
    echo "<input type='hidden' name='acf[post_ID]' value='{$post->ID}'/>";
}

// restrict OPEN albums to 1
add_filter('acf/validate_value/name=album_status', 'validate_album_status', 10, 4);
function validate_album_status( $valid, $value, $field, $input ){
	if( !$valid ) {
		return $valid;
	}

	if ($value != 'OPEN')
		return $valid;

	$albums = get_terms('photo_alboms', array('hide_empty' => 0));
	foreach ($albums as $album) {
		if (get_field('album_status', $album) == 'OPEN')
			 return 'Album '.$album->name." already marked as OPEN";
	}
	return $valid;
}

// make sure there are only 3 winners on active album
add_filter('acf/validate_value/name=winner_photo', 'validate_up_to_tree_winners', 10, 4);
function validate_up_to_tree_winners( $valid, $value, $field, $input ){
	if( !$valid ) {
		return $valid;
	}

	if ($value != '1')
		return $valid;
	
	$post_id = $_POST['acf']['post_ID'];
	if (get_field('winner_photo', $post_id) == $value)
		return $valid;

	$album = get_active_album();
	$winners = new WP_Query(array('post_type' => 'photo', 
			'meta_query' => array(array('key' => 'winner_photo', 'value' => '1', 'compare' => '=')),
			'tax_query' => array(array('taxonomy' => 'photo_alboms', 'field' => 'slug', 'terms' => $album->slug))));
	if ($winners->found_posts > 2) {
		return "Only 3 photoes can be marked as winners (per album), currently there are :".$winners->found_posts;
	}
	return $valid;
}

// make sure there are only 1 winner per place
add_filter('acf/validate_value/name=first_place', 'validate_winner_type_restriction', 10, 4);
function validate_winner_type_restriction( $valid, $value, $field, $input ){
	if( !$valid ) {
		return $valid;
	}

	$post_id = $_POST['acf']['post_ID'];
	if (get_field('first_place', $post_id) == $value)
		return $valid;

	$album = get_active_album();
	$winners = new WP_Query(array('post_type' => 'photo', 
			'meta_query' => array(array('key' => 'first_place', 'value' => $value, 'compare' => '=')),
			'tax_query' => array(array('taxonomy' => 'photo_alboms', 'field' => 'slug', 'terms' => $album->slug))));
	if ($winners->found_posts != 0) {
		return "Only 1 photo can be marked can be marked as $value (per album)";
	}
	return $valid;
}

/**********************************************************/
/*                   Admin Photo Listing                  */
/**********************************************************/

// Add Photo Extra columns (each on it's right place)
add_filter('manage_photo_posts_columns', 'add_albums_to_photos_list');
function add_albums_to_photos_list( $posts_columns ) {
	if (!isset($posts_columns['author'])) {
		$new_posts_columns = $posts_columns;
	} else {
		$new_posts_columns = array();
		$index = 0;
		foreach($posts_columns as $key => $posts_column) {
			if ($key=='author') {
				$new_posts_columns['albums'] = null;
				$new_posts_columns['winner'] = null;
			}
			else if ($key == 'title') {
				$new_posts_columns['photo_thumb'] = null;
			}
			$new_posts_columns[$key] = $posts_column;

		}
	}
	$new_posts_columns['albums'] = 'Albums';
	$new_posts_columns['winner'] = 'Winner';
	$new_posts_columns['photo_thumb'] = __('Thumbs');

	return $new_posts_columns;
}

// Show data on Photo Extra columns
add_action('manage_photo_posts_custom_column', 'show_albums_for_photos_list',10,2);
function show_albums_for_photos_list( $column_id,$post_id ) {
	switch ($column_id) {
		case 'albums':
			$albums = get_the_terms($post_id,'photo_alboms');
			if (is_array($albums)) {
				foreach($albums as $key => $album) {
					$edit_link = get_term_link($album,$taxonomy);
					$albums[$key] = '<a href="'.$edit_link.'">' . $album->name . '</a>';
				}
				echo implode(' | ',$albums);
			}
		break;
		case 'photo_thumb':
        	echo the_post_thumbnail(array(125, 80));
        break;
        case 'winner': 
        	$winner = get_post_meta(get_the_id(), 'winner_photo', true );
        	if ($winner == '1')
        		$pos = get_post_meta(get_the_id(), 'first_place', true );
        	echo (($winner == '1') ? $pos : 'No');
        break;
	}
}

add_action('restrict_manage_posts','restrict_photos_by_albums');
function restrict_photos_by_albums() {
	global $typenow;
	global $wp_query;
	if ($typenow=='photo') {
		$albums = get_taxonomy('photo_alboms');
		wp_dropdown_categories(array(
			'show_option_all' => __("Show All {$albums->label}"),
			'taxonomy' => 'photo_alboms',
			'name' => 'photo_alboms',
			'orderby' => 'name',
			'selected' => $wp_query->query['photo_alboms'],
			'hierarchical' => true,
			'depth' => 3,
			'show_count' => true, 
			'hide_empty' => true,
		));
	}
}

add_filter('parse_query','convert_album_id_to_taxonomy_term_in_query');
function convert_album_id_to_taxonomy_term_in_query($query) {
    global $pagenow;
    $qv = &$query->query_vars;
    if ($pagenow=='edit.php' && isset($qv['photo_alboms']) && is_numeric($qv['photo_alboms'])) {
        $term = get_term_by('id',$qv['photo_alboms'],'photo_alboms');
        $qv['photo_alboms'] = ($term ? $term->slug : '');
    }
}
// This removes the annoying […] to a Read More link
function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');