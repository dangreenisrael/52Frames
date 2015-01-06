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

    wp_enqueue_style('child', get_stylesheet_directory_uri() . '/child.css');
    wp_enqueue_style( 'fontAwesome', get_stylesheet_directory_uri() . '/font-awesome.min.css', array(), '' );
    wp_enqueue_style( 'glyphicons', get_stylesheet_directory_uri() . '/font-awesome.min.css', array(), '' );
   	wp_enqueue_style( 'parent-style', get_stylesheet_directory_uri() . '/assets/styles.css' ); 
	wp_enqueue_style( 'countdown', get_stylesheet_directory_uri() . '/assets/jquery.countdown.css' ); 

	wp_enqueue_script('blur', get_stylesheet_directory_uri() . '/js/blur.js');
	wp_enqueue_script('script', get_stylesheet_directory_uri() . '/js/script.js');
	wp_enqueue_script( 'countdown', get_stylesheet_directory_uri() . '/js/jquery.countdown.js', array('jquery') ); 
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

add_image_size( 'thumb-780', 780, 520, true );
add_image_size( 'thumb-480', 480, 320, true );

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
		$tags = get_terms('post_tag', array('include' => $album_tag_ids, 'fields' => 'names'));
		$tags = implode(',', $tags);
		$extra_challange = addslashes(get_field('extra_challange_desc', $active_album));
		$weekno = get_field('week_number', $active_album);
	}

	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#parent_tags').text('<?php echo $tags; ?>');
		$('#album_name').text('<?php echo $album_title; ?>');
		$('#challange_desc').text('<?php echo  $extra_challange; ?>');
		$('#weekno').text('<?php echo  $weekno; ?>');
	});
	</script>
	<?php
}

add_action('wp_footer', 'add_photo_js');

add_action('cred_save_data', 'add_data_to_photo',10,2);
function add_data_to_photo($post_id, $form_data){
	// if Photo Add Form
	if ($form_data['id'] == 92) {
		$active_album = get_active_album();
		// Add Photo association to the album
		var_dump(wp_set_object_terms($post_id, $active_album->slug, 'photo_alboms'));

		// Add Photo association to Editor tags
		$album_tag_ids = get_field('album_tags', $active_album);
		$tag_names = get_terms('post_tag', array('include' => $album_tag_ids, 'fields' => 'names'));
		wp_set_post_tags($post_id, $tag_names, true);
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

add_filter('acf/validate_value/name=album_status', 'validate_album_status', 10, 4);
function validate_album_status( $valid, $value, $field, $input ){
	if( !$valid ) {
		return $valid;
	}

	if ($value != 'OPEN')
		return $valid;

	$valid = 'AAAAAA';

	// $albums = get_terms('photo_alboms', array('hide_empty' => 0));
	// foreach ($albums as $album) {
	// 	if (get_field('album_status', $album) == 'OPEN')
	// 		return false;
	// }
	return $valid;
}