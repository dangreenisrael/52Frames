<?php
/**
 * Function that creates the "Edit Profile Forms" post type
 *
 * @since v.2.0
 *
 * @return void
 */
function wppb_create_edit_profile_forms_cpt(){
    $labels = array(
        'name' 					=> __( 'Edit-profile Form', 'profilebuilder'),
        'singular_name' 		=> __( 'Edit-profile Form', 'profilebuilder'),
        'add_new' 				=> __( 'Add New', 'profilebuilder' ),
        'add_new_item' 			=> __( 'Add new Edit-profile Form', 'profilebuilder' ),
        'edit_item' 			=> __( 'Edit the Edit-profile Forms', 'profilebuilder' ) ,
        'new_item' 				=> __( 'New Edit-profile Form', 'profilebuilder' ),
        'all_items' 			=> __( 'Edit-profile Forms', 'profilebuilder' ),
        'view_item' 			=> __( 'View the Edit-profile Form', 'profilebuilder' ),
        'search_items' 			=> __( 'Search the Edit-profile Forms', 'profilebuilder' ),
        'not_found' 			=> __( 'No Edit-profile Form found', 'profilebuilder' ),
        'not_found_in_trash' 	=> __( 'No Edit-profile Forms found in trash', 'profilebuilder' ),
        'parent_item_colon' 	=> '',
        'menu_name' 			=> __( 'Edit-profile Forms', 'profilebuilder' )
    );

    $args = array(
        'labels' 				=> $labels,
        'public' 				=> false,
        'publicly_queryable' 	=> false,
        'show_ui' 				=> true,
        'query_var'          	=> true,
        'show_in_menu' 			=> 'profile-builder',
        'has_archive' 			=> false,
        'hierarchical' 			=> false,
        'capability_type' 		=> 'post',
        'supports' 				=> array( 'title' )
    );

    $wppb_addonOptions = get_option('wppb_module_settings');
    if( !empty( $wppb_addonOptions['wppb_multipleEditProfileForms'] ) && $wppb_addonOptions['wppb_multipleEditProfileForms'] == 'show' )
        register_post_type( 'wppb-epf-cpt', $args );
}
add_action( 'init', 'wppb_create_edit_profile_forms_cpt' );

/* EditProfile Form change classes based on Redirect field start */
add_filter( 'wck_update_container_class_wppb_epf_page_settings', 'wppb_epf_update_form_change_class_based_on_redirect_field', 10, 4 );
function wppb_epf_update_form_change_class_based_on_redirect_field($wck_update_container_css_class, $meta, $results, $element_id) {
    $redirect = Wordpress_Creation_Kit_PB::wck_generate_slug( $results[$element_id]["redirect"] );
    return "class='update_container_$meta update_container_$redirect redirect_$redirect'";
}
add_filter( 'wck_element_class_wppb_epf_page_settings', 'wppb_epf_form_listing_change_class_based_on_redirect_field', 10, 4 );
function wppb_epf_form_listing_change_class_based_on_redirect_field($wck_element_class, $meta, $results, $element_id){
    $redirect = Wordpress_Creation_Kit_PB::wck_generate_slug( $results[$element_id]["redirect"] );
    $wck_element_class = "class='redirect_$redirect'";
    return $wck_element_class;
}
/* EditProfile Form change classes based on Redirect field end */

/**
 * Remove certain actions from post list view
 *
 * @since v.2.0
 *
 * @param array $actions
 *
 * return array
 */
function wppb_remove_epf_view_link( $actions ){
	global $post;
	
	if ( $post->post_type == 'wppb-epf-cpt' ){
		unset( $actions['view'] );
		
		if ( wppb_get_post_number ( $post->post_type, 'singular_action' ) )
			unset( $actions['trash'] );
	}

	return $actions;
}
add_filter( 'post_row_actions', 'wppb_remove_epf_view_link', 10, 1 );

/**
 * Remove certain bulk actions from post list view
 *
 * @since v.2.0
 *
 * @param array $actions
 *
 * return array
 */
function wppb_remove_trash_bulk_option_epf( $actions ){
	global $post;
	if( !empty( $post ) ){
        if ( $post->post_type == 'wppb-epf-cpt' ){
            unset( $actions['view'] );

            if ( wppb_get_post_number ( $post->post_type, 'bulk_action' ) )
                unset( $actions['trash'] );
        }
    }
	return $actions;
}
add_filter( 'bulk_actions-edit-wppb-epf-cpt', 'wppb_remove_trash_bulk_option_epf' );

/**
 * Function to hide certain publishing options
 *
 * @since v.2.0
 *
 */
function wppb_hide_epf_publishing_actions(){
	global $post;

	if ( $post->post_type == 'wppb-epf-cpt' ){
		echo '<style type="text/css">#misc-publishing-actions, #minor-publishing-actions{display:none;}</style>';
		
		$epf = get_posts( array( 'posts_per_page' => -1, 'post_status' => apply_filters ( 'wppb_check_singular_epf_form_publishing_options', array( 'publish' ) ) , 'post_type' => 'wppb-epf-cpt' ) );
		if ( count( $epf ) == 1 )
			echo '<style type="text/css">#major-publishing-actions #delete-action{display:none;}</style>';
	}
}
add_action('admin_head-post.php', 'wppb_hide_epf_publishing_actions');
add_action('admin_head-post-new.php', 'wppb_hide_epf_publishing_actions');


/**
 * Add custom columns to listing
 *
 * @since v.2.0
 *
 * @param array $columns
 * @return array $columns
 */
function wppb_add_extra_column_for_epf( $columns ){
	$columns['epf-shortcode'] = __( 'Shortcode', 'profilebuilder' );
	
	return $columns;
}
add_filter( 'manage_wppb-epf-cpt_posts_columns', 'wppb_add_extra_column_for_epf' );

/**
 * Add content to the displayed column
 *
 * @since v.2.0
 *
 * @param string $column_name
 * @param integer $post_id
 * @return void
 */
function wppb_epf_custom_column_content( $column_name, $post_id ){
	if( $column_name == 'epf-shortcode' ){
		$post = get_post( $post_id );
		
		if( empty( $post->post_title ) )
			$post->post_title = __( '(no title)', 'profilebuilder' );

        echo "<input readonly spellcheck='false' type='text' class='wppb-shortcode input' value='[wppb-edit-profile form_name=\"" . Wordpress_Creation_Kit_PB::wck_generate_slug( $post->post_title ) . "\"]' />";
	}
}
add_action( "manage_wppb-epf-cpt_posts_custom_column",  "wppb_epf_custom_column_content", 10, 2 );


/**
 * Add side metaboxes
 *
 * @since v.2.0
 *
 * @return void
 */
function wppb_epf_content(){
	global $post;

	$form_shortcode = trim( Wordpress_Creation_Kit_PB::wck_generate_slug( $post->post_title ) );
	if ( $form_shortcode == '' ) {
        echo '<p><em>' . __( 'The shortcode will be available after you publish this form.', 'profilebuilder' ) . '</em></p>';
    } else {
        echo '<p>' . __( 'Use this shortcode on the page you want the form to be displayed:', 'profilebuilder' );
        echo '<br/>';
        echo "<textarea readonly spellcheck='false' class='wppb-shortcode textarea'>[wppb-edit-profile form_name=\"" . $form_shortcode . "\"]</textarea>";
        echo '</p><p>';
        echo __( '<span style="color:red;">Note:</span> changing the form title also changes the shortcode!', 'profilebuilder' );
        echo '</p>';
    }
}

function wppb_epf_side_box(){
	add_meta_box( 'wppb-epf-side', __( 'Form Shortcode', 'profilebuilder' ), 'wppb_epf_content', 'wppb-epf-cpt', 'side', 'low' );	
}
add_action( 'add_meta_boxes', 'wppb_epf_side_box' );

/**
 * Function that manages the Edit Profile CPT
 *
 * @since v.2.0
 *
 * @return void
 */
function wppb_manage_epf_cpt(){

	$available_time = array();
	for( $i=0; $i<=250; $i++ )
		$available_time[] = $i;

	// set up the fields array
	$settings_fields = array( 		
		array( 'type' => 'select', 'slug' => 'redirect', 'title' => __( 'Redirect', 'profilebuilder' ), 'options' => array( '%Choose...%-', 'No', 'Yes' ), 'default' => '-', 'description' => __( 'Whether to redirect the user to a specific page or not', 'profilebuilder' ) ),
		array( 'type' => 'select', 'slug' => 'display-messages', 'title' => __( 'Display Messages', 'profilebuilder' ), 'options' => $available_time, 'default' => 1, 'description' => __( 'Allowed time to display any success messages (in seconds)', 'profilebuilder' ) ),
		array( 'type' => 'text', 'slug' => 'url', 'title' => __( 'URL', 'profilebuilder' ), 'description' => __( 'Specify the URL of the page users will be redirected once they updated their profile using this form<br/>Use the following format: http://www.mysite.com', 'profilebuilder' ) )
	);
	
	
	// set up the box arguments
	$args = array(
		'metabox_id' => 'wppb-epf-settings-args',
		'metabox_title' => __( 'After Profile Update...', 'profilebuilder' ),
		'post_type' => 'wppb-epf-cpt',
		'meta_name' => 'wppb_epf_page_settings',
		'meta_array' => $settings_fields,
		'sortable' => false,
		'single' => true
	);
	new Wordpress_Creation_Kit_PB( $args );

	$epf_fields = array ();
	
	$wppb_manage_fields = get_option ( 'wppb_manage_fields', 'not_set' );
	if ( ( $wppb_manage_fields != 'not_set' ) && ( ( is_array( $wppb_manage_fields ) ) && ( !empty( $wppb_manage_fields ) ) ) ){
		foreach ( $wppb_manage_fields as $key => $value ){
			if (  $value['field'] != 'reCAPTCHA' )
				array_push( $epf_fields, wppb_field_format( $value['field-title'], $value['field'] ) );
		}
	}
	
	$epf_fields = apply_filters( 'wppb_epf_fields_types', $epf_fields );
	
	// set up the box arguments for the edit profile forms and create them
	$args = array(
		'metabox_id' => 'wppb-epf-fields',
		'metabox_title' => __( 'Add New Field to the List', 'profilebuilder' ),
		'post_type' => 'wppb-epf-cpt',
		'meta_name' => 'wppb_epf_fields',
		'meta_array' => apply_filters( 'wppb_epf_fields', array( 
																	array( 'type' => 'select', 'slug' => 'field', 'title' => __( 'Field', 'profilebuilder' ), 'options' => $epf_fields, 'default-option' => true, 'description' => __( 'Choose one of the supported fields you manage <a href="'.admin_url( 'admin.php?page=manage-fields' ).'">here</a>', 'profilebuilder' ) ),
																	array( 'type' => 'text', 'slug' => 'id', 'title' => __( 'ID', 'profilebuilder' ), 'default' =>  '', 'description' => __( "A unique, auto-generated ID for this particular field<br/>You can use this in conjuction with filters to target this element if needed<br/>Can't be edited", 'profilebuilder' ), 'readonly' => true )
															   ) 
									 )
		);
	new Wordpress_Creation_Kit_PB( $args );
}
add_action( 'init', 'wppb_manage_epf_cpt', 10 );


add_filter( "wck_before_listed_wppb_epf_fields_element_0", 'wppb_manage_fields_display_field_title_slug', 10, 3 );
add_filter( 'wck_update_container_class_wppb_epf_fields', 'wppb_update_container_class', 10, 4 );
add_filter( 'wck_element_class_wppb_epf_fields', 'wppb_element_class', 10, 4 );

/**
 * Function that displays a message in the footer of the edit form fields table in case there are no fields present
 *
 * @since v.2.0.5
 *
 * @param string $footer
 * @param int $id
 *
 * @return string
 *
 */
function wppb_empty_epf_fields_display_message( $footer, $id ){
    $post_meta = get_post_meta( $id, 'wppb_epf_fields', true);

    if( empty($post_meta) ) {
        return '<tfoot><tr><td>' . __('This form is empty.', 'profilebuilder') . '</td></tr></tfoot>';
    }

}
add_filter('wck_metabox_content_footer_wppb_epf_fields', 'wppb_empty_epf_fields_display_message', 10, 2);