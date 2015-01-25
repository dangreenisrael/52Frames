
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
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/favicon.ico">
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

</head>
<!--div class="js"-->
<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=422585397892387&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="preloader"></div>
	<?php do_action( 'wpbootstrap_before_container' ); ?>
	<?php if(is_singular('post')):
		$background = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'full' );
	
	 endif; ?>

<header id="header"  role="banner" >
		<?php if (is_singular('post'))
		echo '<div class="post-image" style="background-image:url('.$background[0] .')"></div>';
		?>
		<?php if ( !is_singular( 'photo' ) && !is_page_template( 'page-home.php' )) :
			echo '<div class="overlay"></div>';
		endif;
	?>		
		<div class="row-fluid top-bar">
			<div class="container">	
				<hgroup class="span2">
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/logo.png"></a>
					</h1>
				</hgroup>
				<?php get_template_part('_navbar'); ?>	
			</div>
		</div>
			<?php if ( wpbootstrap_get_setting('titles_settings', 'display_pages_titles' ) && !is_page_template( 'page-home.php' )): ?>
		
		<div class="row-fluid page-title">
			<div class="container ">
				<?php if (is_home()) :?>
					<h1>Our Blog</h1>
					<H2>52Frames is a weekly photo challenge. <a href="">Join us!</a></h2>
				<?php elseif(is_singular('post')): ?>	
					<h1><?php the_title(); ?></h1>
					<p class="author">
						<?php echo __( 'By', 'wpbootstrap' ); ?> <!--a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author"-->
							<?php echo get_the_author(); ?>
						<!--/a-->
						<time datetime="<?php echo get_the_time( 'c' ); ?>">
							<?php echo sprintf( ' / %s ', get_the_date()); ?>
						</time>	
					</p>
				<?php
					$cat = $wp_query->get_queried_object();
					elseif (is_tax()):					
					$term_week_num	= get_field('week_number','photo_alboms_'. $cat->term_id);
					 echo '<h1><span>Week '. $term_week_num .' (' .get_the_date('Y').')</span>';
					 echo single_cat_title().'</h1>';
					 echo term_description($cat->term_id, 'photo_alboms'  ); 
					elseif ( is_singular( 'photo' )):
				/*
					 * Page Variables
					 */
					$user_id		= $post->post_author;
					$user 			= get_user_by( 'id', $user_id );
					$author_name	= $user->display_name;
					$album 			= wp_get_post_terms(get_the_ID(),'photo_alboms')[0];
					$week_num	= get_field('week_number',$album);
					$author_pic		= get_avatar( $user->ID, '70');
					$album_name 	= $album->name;
					$album_slug 	= $album->slug;
					$extra_credit	= get_post_meta(get_the_id(), 'wpcf-extra-challenge', true );
				 ?>
					<h1><?php echo'Week '.$week_num . ' <span>'.$album_name.'</span>'?></h1>	
				<?php elseif(is_404()): ?>
					<h1>404 - Page Not Found</h1>
				<?php else: ?>
				<h1><?php the_title(); ?></h1>
				<?php endif; ?>
			</div>			
		</div>
	<?php endif; ?>		

	</header><!-- #header -->
	

		<?php do_action( 'wpbootstrap_after_header' ); ?>
	<div class="row-fluid">	
		<div class="row" id="main">
			<?php do_action( 'wpbootstrap_before_content' ); ?>
			<?php if (!is_page_template( 'page-home.php' ) && !is_singular( 'photo' ) && !is_tax( 'photo_alboms' )) {
				$container = 'class="container"';				
			}?>
			<section <?php echo $container ?> id="content" role="main">