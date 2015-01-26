<?php
/*
Template Name: Register and Edit Profile
*/

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie6 ie-lte7 ie-lte8 ie-lte9"><![endif]-->
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie7 ie-lte7 ie-lte8 ie-lte9"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js ie ie8 ie-lte8 ie-lte9"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="no-js ie ie9 ie-lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo bloginfo("name") ?> <?php echo wp_title( '&ndash;', false, 'left' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />	
	<?php if ( of_get_option( 'favicon' ) ): ?>
		<link rel="shortcut icon" href="<?php echo of_get_option( 'favicon' ); ?>">
	<?php else: ?>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/favicon.ico">
	<?php endif ?>
	<!--[if lt IE 9]>
		<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IEs: http://code.google.com/p/html5shiv/ ?>
		<script src="<?php echo get_template_directory_uri() ?>/js/html5shiv.js" type="text/javascript"></script>
		<?php // Loads selectivizr script to add support for some CSS3 selectors in older IEs. More info: http://selectivizr.com/ ?>
		<script src="<?php echo get_template_directory_uri() ?>/js/selectivizr.min.js" type="text/javascript"></script>
		<?php // Loads respons.js script to add baisc support for @media-queries for older IEs. More info: https://github.com/scottjehl/Respond ?>
		<script src="<?php echo get_template_directory_uri() ?>/js/respond.min.js" type="text/javascript"></script>
	<![endif]-->
	<?php
		do_action( 'wpbootstrap_before_wp_head' );
		wp_head();
		do_action( 'wpbootstrap_after_wp_head' );
	?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
</head>

<body <?php body_class(); ?>>
	<div class="container">	
		<div class="row" id="main">
			<?php do_action( 'wpbootstrap_before_content' ); ?>
			<section class="row" id="content" role="main">
			<?php
				while ( have_posts() ) : the_post();?>
					<article <?php post_class('clearfix') ?> id="post-<?php the_ID(); ?>">	
					<header class="article-header clearfix">	
						<img src="<?php echo get_stylesheet_directory_uri() ?>/images/camera_monster.png" class="monster">				
					</header>	
					<div class="entry-content">
							<h1><?php the_title()?> </h1>
							<?php the_content(); ?>
					</div><!-- .entry-content -->

					</article>
				<?php endwhile;
			?>

			</section>
		</div>
	</div>	
<script>

	jQuery(document).ready(function($){
		if ( $('#wppb_general_top_error_message').length ) { 
			$(".register-form").show();
			$(".welcome-text").hide();
			$(".register-trigger").addClass('hidden');
		}
		else{
			$(".register-form").hide();
			$(".welcome-text").show();

		}
	  $(".register-trigger a").click(function(){
		$(".register-form").slideToggle();
		$('html,body').animate({scrollTop: $(this).offset().top - 20}, 700);
      	$(".register-trigger").addClass('hidden'); 
	  });
	  $('#send_credentials_via_email').attr('checked','checked');

	});
	</script>
<?php do_action( 'wpbootstrap_before_wp_footer' ); ?>
<?php wp_footer(); ?>
<?php do_action( 'wpbootstrap_after_wp_footer' ); ?>

</body>
</html>