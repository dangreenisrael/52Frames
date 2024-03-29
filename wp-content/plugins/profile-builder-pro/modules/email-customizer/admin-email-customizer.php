<?php
/**
 * Function that creates the Admin Email Customizer menu
 *
 * @since v.2.0
 *
 * @return void
 */
function wppb_admin_email_customizer_submenu(){
	$args = array(
				'menu_title' 	=> __( 'Admin Email Customizer', 'profilebuilder' ),						
				'page_title' 	=> __( 'Admin Email Customizer', 'profilebuilder' ),						
				'menu_slug'		=> 'admin-email-customizer',
				'page_type'		=> 'submenu_page',
				'capability'	=> 'manage_options',
				'priority'		=> 10,
				'parent_slug'	=> 'profile-builder'
			);
	
	new WCK_Page_Creator_PB( $args );
}
add_action( 'init', 'wppb_admin_email_customizer_submenu', 10 );

/* on the init hook add the mustache boxes */
add_action( 'init', 'wppb_admin_email_customizer_add_mustache_in_backend', 11 );
/**
 * Function that ads the mustache boxes in the backend for admin email customizer
 *
 * @since v.2.0
 */
function wppb_admin_email_customizer_add_mustache_in_backend(){
	require_once( WPPB_PLUGIN_DIR.'/modules/class-mustache-templates/class-mustache-templates.php' );
		
	$fields = array(
				array(
					'id'	=> 'wppb_admin_emailc_common_settings_header', // field id and name
					'type'	=> 'header', // type of field
                    'default'	=> __( 'These settings are also replicated in the "User Email Customizer" settings-page upon save.', 'profilebuilder' ).' '.__( 'Valid tags {{reply_to}} and {{site_name}}', 'profilebuilder'), // type of field
				),
				array(
					'label'	=> __( 'From (name)', 'profilebuilder' ), // <label>
					'desc'	=> '', // description
					'id'	=> 'wppb_emailc_common_settings_from_name', // field id and name
					'type'	=> 'text', // type of field
					'default'	=> '{{site_name}}', // type of field
					'desc' => '',
				),
				array(
					'label'	=> __( 'From (reply-to email)', 'profilebuilder' ), // <label>
					'desc'	=> '', // description
					'id'	=> 'wppb_emailc_common_settings_from_reply_to_email', // field id and name
					'type'	=> 'text', // type of field
					'default'	=> '{{reply_to}}', // type of field
					'desc' => __( 'Must be a valid email address or the tag {{reply_to}} which defaults to the administrator email', 'profilebuilder' ),
				),				
			);
	new PB_Mustache_Generate_Admin_Box( 'aec_common_settings', __( 'Common Settings', 'profilebuilder' ), 'profile-builder_page_admin-email-customizer', 'core', '', '', $fields );


    $registration_default_email_content = __( "
<p>New subscriber on {{site_name}}.</p>
<p>Username:{{username}}</p>
<p>E-mail:{{user_email}}</p>
", 'profilebuilder' );
    $mustache_vars = wppb_email_customizer_generate_merge_tags( 'email_confirmation' );

    $fields = array(
				array(
					'label'	=> __( 'Email Subject', 'profilebuilder' ), // <label>
					'desc'	=> '', // description
					'id'	=> 'wppb_admin_emailc_default_registration_email_subject', // field id and name
					'type'	=> 'text', // type of field
					'default'	=> '[{{site_name}}] '.__( 'A new subscriber has (been) registered!', 'profilebuilder' ), // type of field
				),
                array( // Textarea
                    'label'	=> '', // <label>
                    'desc'	=> '', // description
                    'id'	=> 'wppb_admin_emailc_default_registration_email_content', // field id and name
                    'type'	=> 'textarea', // type of field
                    'default'	=> $registration_default_email_content, // type of field
                )
			);

	new PB_Mustache_Generate_Admin_Box( 'aec_default_registration', __( 'Default Registration & Registration with Email Confirmation', 'profilebuilder' ), 'profile-builder_page_admin-email-customizer', 'core', $mustache_vars, '', $fields);


    $registration_admin_approval_email_content = __( "
<p>New subscriber on {{site_name}}.</p>
<p>Username:{{username}}</p>
<p>E-mail:{{user_email}}</p>
<p>The Admin Approval feature was activated at the time of registration,
so please remember that you need to approve this user before he/she can log in!</p>
", 'profilebuilder' );

    $mustache_vars = wppb_email_customizer_generate_merge_tags();

    $fields = array(
				array(
					'label'	=> __( 'Email Subject', 'profilebuilder' ), // <label>
					'desc'	=> '', // description
					'id'	=> 'wppb_admin_emailc_registration_with_admin_approval_email_subject', // field id and name
					'type'	=> 'text', // type of field
					'default'	=> '[{{site_name}}] A new subscriber has (been) registered!', // type of field
				),
                array( // Textarea
                    'label'	=> '', // <label>
                    'desc'	=> '', // description
                    'id'	=> 'wppb_admin_emailc_registration_with_admin_approval_email_content', // field id and name
                    'type'	=> 'textarea', // type of field
                    'default'	=> $registration_admin_approval_email_content , // type of field
                )
			);
	
	new PB_Mustache_Generate_Admin_Box( 'aec_reg_with_admin_approval', __( 'Registration with Admin Approval', 'profilebuilder' ), 'profile-builder_page_admin-email-customizer', 'core', $mustache_vars, '', $fields );
}