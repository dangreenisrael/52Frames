<?php
/**
 * Template Name: Contact
 * The main template file for display contact page.
 *
 * @package WordPress
*/


/**
*	if not submit form
**/

if(!isset($_GET['your_name']))
{

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}
?>
		<br class="clear"/>

		<!-- Begin content -->
		<div id="content_wrapper">
			
			<div class="inner">

				<!-- Begin main content -->
				<div class="inner_wrapper">
				
				
					<div class="sidebar_content">
					
						<h2 class="widgettitle header"><?php the_title(); ?></h2>
						
						<div class="page_fullwidth">
						<?php 
							if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		

									<?php the_content(); ?>

						<?php endwhile; 
						?>
						
						<form id="contact_form" method="get" action="<?php echo curPageURL(); ?>">
						    <input id="your_name" name="your_name" title="<?php echo _e( 'Name', THEMEDOMAIN ); ?>*" type="text" style="width:47%"/>
						    <br/><br/>
						    <input id="email" name="email" type="text" title="<?php echo _e( 'Email', THEMEDOMAIN ); ?>*" style="width:47%"/>
						    <br/><br/>
						    <textarea id="message" name="message" title="<?php echo _e( 'Message', THEMEDOMAIN ); ?>*" rows="7" cols="10" style="width:97%"></textarea>
						    <br/><br/>
						    <input type="submit" value="<?php echo _e( 'Send Message', THEMEDOMAIN ); ?>"/><br/><br/>
						</form>
						<div id="reponse_msg"></div>
						
						</div>
					</div>
					
					<div class="sidebar_wrapper">
						<?php
						    $twitter_id = get_option(SHORTNAME.'_twitter_username');
						    $pp_facebook_username = get_option('pp_facebook_username');
						    
						    if(!empty($twitter_id) OR !empty($fb_id)):
						?>
						<div class="social_profile">
						    <div class="profile">
						    	<a href="<?php echo $pp_facebook_username; ?>">
						    		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_facebook.png" alt="" class="alignleft social"/>
						    	</a>
						    	<h4><?php pp_facebook_fans(); ?></h4>
						    	<span class="count">fans</span>
						    </div>
						
						    <div class="profile">
						    	<a href="http://twitter.com/<?php echo $twitter_id; ?>">
						    		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_twitter.png" alt="" class="alignleft social"/>
						    	</a>
						    	<h4><?php pp_twitter_followers(); ?></h4>
						    	<span class="count">followers</span>
						    </div>
						    
						     <br class="clear"/>
						</div>
						<?php
						    endif; 
						?>
    					
    					<div class="ads125_wrapper">
						    <?php
						        $pp_side_banner = get_option('pp_side_banner');
						    
						        if(!empty($pp_side_banner))
						        {
						        	echo stripslashes($pp_side_banner);
						        }
						    ?>
						</div>
					
						<div class="sidebar">
							
							<div class="content">
							
								<ul class="sidebar_widget">
								<?php dynamic_sidebar('Contact Sidebar'); ?>
								</ul>
								
							</div>
						
						</div>
					</div>
				
				</div>
				<!-- End main content -->
							
				<br class="clear"/>
				
<script>
$j(document).ready(function(){ 
    $j.validator.setDefaults({
    	submitHandler: function() { 
    		var actionUrl = $j('#contact_form').attr('action');
    	    
    	    $j.ajax({
  		        type: 'GET',
  		        url: actionUrl,
  		        data: $j('#contact_form').serialize(),
  		        success: function(msg){
  		        	$j('#contact_form').hide();
  		        	$j('#reponse_msg').html('<br/>'+msg);
  		        }
    	    });
    	    
    	    return false;
    	}
    });    
    	
    $j('#contact_form').validate({
    	rules: {
    	    your_name: "required",
    	    email: {
    	    	required: true,
    	    	email: true
    	    },
    	    message: "required"
    	},
    	messages: {
    	    your_name: "<?php echo _e( 'Please enter your name', THEMEDOMAIN ); ?>",
    	    email: "<?php echo _e( 'Please enter a valid email address', THEMEDOMAIN ); ?>",
    	    agree: "<?php echo _e( 'Please enter some message', THEMEDOMAIN ); ?>"
    	}
    });
});
</script>
				
<?php
if(!isset($hide_header) OR !$hide_header)
{
?>	
			</div>
			
			<br class="clear"/>
		</div>
		<!-- End content -->
				

<?php get_footer(); ?>

<?php
}
?>
				
<?php
}

//if submit form
else
{

	/*
	|--------------------------------------------------------------------------
	| Mailer module
	|--------------------------------------------------------------------------
	|
	| These module are used when sending email from contact form
	|
	*/
	
	//Get your email address
	$contact_email = get_option('pp_contact_email');
	$pp_contact_thankyou = get_option('pp_contact_thankyou');
	
	//Enter your email address, email from contact form will send to this addresss. Please enter inside quotes ('myemail@email.com')
	define('DEST_EMAIL', $contact_email);
	
	//Change email subject to something more meaningful
	define('SUBJECT_EMAIL', 'Email from contact form');
	
	//Thankyou message when message sent
	define('THANKYOU_MESSAGE', $pp_contact_thankyou);
	
	//Error message when message can't send
	define('ERROR_MESSAGE', 'Oops! something went wrong, please try to submit later.');
	
	
	/*
	|
	| Begin sending mail
	|
	*/
	
	$from_name = $_GET['your_name'];
	$from_email = $_GET['email'];
	
	$mime_boundary_1 = md5(time());
    $mime_boundary_2 = "1_".$mime_boundary_1;
    $mail_sent = false;
 
    # Common Headers
    $headers = "";
    $headers .= 'From: '.$from_name.'<'.$from_email.'>'.PHP_EOL;
    $headers .= 'Reply-To: '.$from_name.'<'.$from_email.'>'.PHP_EOL;
    $headers .= 'Return-Path: '.$from_name.'<'.$from_email.'>'.PHP_EOL;        // these two to set reply address
    $headers .= "Message-ID: <".$now."webmaster@".$_SERVER['SERVER_NAME'].">";
    $headers .= "X-Mailer: PHP v".phpversion().PHP_EOL;                  // These two to help avoid spam-filters
	
	$message = 'Name: '.$from_name.PHP_EOL;
	$message.= 'Email: '.$from_email.PHP_EOL.PHP_EOL;
	$message.= 'Message: '.PHP_EOL.$_GET['message'];
	    
	
	if(!empty($from_name) && !empty($from_email) && !empty($message))
	{
		mail(DEST_EMAIL, SUBJECT_EMAIL, $message, $headers);
	
		echo THANKYOU_MESSAGE;
		
		exit;
	}
	else
	{
		echo ERROR_MESSAGE;
		
		exit;
	}
	
	/*
	|
	| End sending mail
	|
	*/
}

?>