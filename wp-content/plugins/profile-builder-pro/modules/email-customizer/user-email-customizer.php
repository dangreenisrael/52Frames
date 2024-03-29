<?php
/**
 * Function that creates the User Email Customizer menu
 *
 * @since v.2.0
 *
 * @return void
 */
function wppb_user_email_customizer_submenu(){
	$args = array(
				'menu_title' 	=> __( 'User Email Customizer', 'profilebuilder' ),						
				'page_title' 	=> __( 'User Email Customizer', 'profilebuilder' ),						
				'menu_slug'		=> 'user-email-customizer',
				'page_type'		=> 'submenu_page',
				'capability'	=> 'manage_options',
				'priority'		=> 10,
				'parent_slug'	=> 'profile-builder'
			);
	
	new WCK_Page_Creator_PB( $args );
}
add_action( 'init', 'wppb_user_email_customizer_submenu', 10 );

/* on the init hook add the mustache boxes */
add_action( 'init', 'wppb_user_email_customizer_add_mustache_in_backend', 11 );
/**
 * Function that ads the mustache boxes in the backend for user email customizer
 *
 * @since v.2.0
 */
function wppb_user_email_customizer_add_mustache_in_backend(){
	require_once( WPPB_PLUGIN_DIR.'/modules/class-mustache-templates/class-mustache-templates.php' );
		
	$fields = array(
				array(
					'id'	=> 'wppb_admin_emailc_common_settings_header', // field id and name
					'type'	=> 'header', // type of field
					'default'	=> __( 'These settings are also replicated in the "Admin Email Customizer" settings-page upon save.', 'profilebuilder' ).' '.__( 'Valid tags {{reply_to}} and {{site_name}}', 'profilebuilder'), // type of field
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
	new PB_Mustache_Generate_Admin_Box( 'uec_common_settings', __( 'Common Settings', 'profilebuilder' ), 'profile-builder_page_user-email-customizer', 'core', '', '', $fields );
	
	/*
	 * Default Registration
	 */

    // we format the var like this for proper line breaks.
    $uec_default_registration = __("
<h3>Welcome to {{site_name}}!</h3>
<p>Your username is:{{username}} and password:{{password}}</p>
", 'profilebuilder' );
    $mustache_vars = wppb_email_customizer_generate_merge_tags();
    $fields = array(
				array( 
					'label'	=> __( 'Email Subject', 'profilebuilder' ), // <label>
					'desc'	=> '', // description
					'id'	=> 'wppb_user_emailc_default_registration_email_subject', // field id and name
					'type'	=> 'text', // type of field
					'default'	=> 'A new account has been created for you on {{site_name}}', // type of field
				),
                array( // Textarea
                    'label'	=> '', // <label>
                    'desc'	=> '', // description
                    'id'	=> 'wppb_user_emailc_default_registration_email_content', // field id and name
                    'type'	=> 'textarea', // type of field
                    'default'	=> $uec_default_registration, // type of field
                )
			);
	new PB_Mustache_Generate_Admin_Box( 'uec_default_registration', __( 'Default Registration', 'profilebuilder' ), 'profile-builder_page_user-email-customizer', 'core', $mustache_vars, '', $fields );

    /*
     * Registration with Email Confirmation
     */
    // we format the var like this for proper line breaks.
    $uec_reg_with_email_confirm = __( "
<p>To activate your user, please click the following link:<br/>
{{{activation_link}}}</p>
<p>After you activate, you will receive another email with your credentials.</p>
", 'profilebuilder' );
    $mustache_vars = wppb_email_customizer_generate_merge_tags( 'email_confirmation' );
    $fields = array(
				array( 
					'label'	=> __( 'Email Subject', 'profilebuilder' ), // <label>
					'desc'	=> '', // description
					'id'	=> 'wppb_user_emailc_registr_w_email_confirm_email_subject', // field id and name
					'type'	=> 'text', // type of field
					'default'	=> __( '[{{site_name}}] Activate {{username}}', 'profilebuilder' ), // type of field
				),
                array( // Textarea
                    'label'	=> '', // <label>
                    'desc'	=> '', // description
                    'id'	=> 'wppb_user_emailc_registr_w_email_confirm_email_content', // field id and name
                    'type'	=> 'textarea', // type of field
                    'default'	=> $uec_reg_with_email_confirm, // type of field
                )
			);
	
	new PB_Mustache_Generate_Admin_Box( 'uec_reg_with_email_confirmation', __( 'Registration with Email Confirmation', 'profilebuilder' ), 'profile-builder_page_user-email-customizer', 'core', $mustache_vars, '', $fields );

	/*
	 * Registration with Admin Approval
	 */

    $uec_reg_with_admin_approval = __( "
<h3>Welcome to {{site_name}}!</h3>
<p>Your username is:{{username}} and password:{{password}}</p>
<p>Before you can access your account, an administrator needs to approve it. You will be notified via email.</p>
", 'profilebuilder' );
    $mustache_vars = wppb_email_customizer_generate_merge_tags();
	$fields = array(
				array( 
					'label'	=> __( 'Email Subject', 'profilebuilder' ), // <label>
					'desc'	=> '', // description
					'id'	=> 'wppb_user_emailc_registration_with_admin_approval_email_subject', // field id and name
					'type'	=> 'text', // type of field
					'default'	=> __( 'A new account has been created for you on {{site_name}}', 'profilebuilder' ), // type of field
				),
                array( // Textarea
                    'label'	=> '', // <label>
                    'desc'	=> '', // description
                    'id'	=> 'wppb_user_emailc_registration_with_admin_approval_email_content', // field id and name
                    'type'	=> 'textarea', // type of field
                    'default'	=> $uec_reg_with_admin_approval, // type of field
                )
			);
	
	new PB_Mustache_Generate_Admin_Box( 'uec_reg_with_admin_approval', __( 'Registration with Admin Approval', 'profilebuilder' ), 'profile-builder_page_user-email-customizer', 'core', $mustache_vars, '', $fields );

	/*
	 * Admin Approval Notifications ( on user approval )
	 */
    $uec_notif_approved_email = __( "
<h3>Good News!</h3>
<p>An administrator has just approved your account: {{username}} on {{site_name}}.</p>
", 'profilebuilder' );
    $mustache_vars = wppb_email_customizer_generate_merge_tags();
    $fields = array(
				array( 
					'label'	=> __( 'Email Subject', 'profilebuilder' ), // <label>
					'desc'	=> '', // description
					'id'	=> 'wppb_user_emailc_admin_approval_notif_approved_email_subject', // field id and name
					'type'	=> 'text', // type of field
					'default'	=> __( 'Your account on {{site_name}} has been approved!', 'profilebuilder' ), // type of field
				),
                array( // Textarea
                    'label'	=> '', // <label>
                    'desc'	=> '', // description
                    'id'	=> 'wppb_user_emailc_admin_approval_notif_approved_email_content', // field id and name
                    'type'	=> 'textarea', // type of field
                    'default'	=> $uec_notif_approved_email, // type of field
                )
			);
	
	new PB_Mustache_Generate_Admin_Box( 'uec_notif_approved_email', __( 'User Approval Notification', 'profilebuilder' ), 'profile-builder_page_user-email-customizer', 'core', $mustache_vars, '', $fields );
	
	/*
	 * Admin Approval Notifications ( on user unapproval )
	 */
    $uec_notif_unapproved_email = __( "
<h3>Hello,</h3>
<p>Unfortunatelly an administrator has just unapproved your account: {{username}} on {{site_name}}.</p>
", 'profilebuilder' );
    $mustache_vars = wppb_email_customizer_generate_merge_tags();

    $fields = array(
				array( 
					'label'	=> __( 'Email Subject', 'profilebuilder' ), // <label>
					'desc'	=> '', // description
					'id'	=> 'wppb_user_emailc_admin_approval_notif_unapproved_email_subject', // field id and name
					'type'	=> 'text', // type of field
					'default'	=> __( 'Your account on {{site_name}} has been unapproved!', 'profilebuilder' ), // type of field
				),
                array( // Textarea
                    'label'	=> '', // <label>
                    'desc'	=> '', // description
                    'id'	=> 'wppb_user_emailc_admin_approval_notif_unapproved_email_content', // field id and name
                    'type'	=> 'textarea', // type of field
                    'default'	=> $uec_notif_unapproved_email , // type of field
                )
			);
	
	new PB_Mustache_Generate_Admin_Box( 'uec_notif_unapproved_email', __( 'Unapproved User Notification', 'profilebuilder' ), 'profile-builder_page_user-email-customizer', 'core', $mustache_vars, '', $fields );

}