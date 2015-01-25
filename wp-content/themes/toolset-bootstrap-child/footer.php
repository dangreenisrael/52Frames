<?php
/**
 * The template for displaying the footer.
 *
 */
?>
			</section><!-- #content -->
			
		</div><!-- #main -->
		<div class="row-fluid" id="newsletter-hp">
			<div class="container">
				<div class="span6">
					<h3 class="title-newsletter"><?php// the_field('newsletter_title',194); ?>Monthly Newsletter</h3>
					<div id="newsletter-text-hp"><?php the_field('newsletter_body',194); ?></div>
				</div>
				<div class="span6 pull-right">
					<!-- Begin MailChimp Signup Form -->
					<link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
					<style type="text/css">
						#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
						/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
						   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
					</style>
					<div id="mc_embed_signup">
					<form action="//52frames.us6.list-manage.com/subscribe/post?u=ca0e4a185c9c1a4999da516b1&amp;id=76a97343f6" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<div id="mc_embed_signup_scroll">
						<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
						<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						<div style="position: absolute; left: -5000px;"><input type="text" name="b_ca0e4a185c9c1a4999da516b1_76a97343f6" tabindex="-1" value=""></div>
						<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button big"></div>
						</div>
					</form>
					</div>

					<!--End mc_embed_signup-->
				</div>
			</div>
		</div>
		<?php
			if ( wpbootstrap_get_setting('general_settings','display_footer_widgets') ) {
				get_sidebar('footer-widgets');
			}
		?>

		<?php do_action( 'wpbootstrap_before_footer' ); ?>
		<?php if ( wpbootstrap_get_setting('general_settings', 'display_footer' ) ): ?>
		    <?php if (of_get_option('display_credit_footer')) : ?>
		   
			

			<footer id="footer" class="muted">
				<div class="container-fluid top-footer">
					<div class="container">
					  <h3><?php the_field('footer_text_title',194); ?></h3>
					  <p><?php the_field('footer_text_body',194); ?></p>
					  <div class="social-footer-container">
						  <div class="social-footer"><a href="<?php the_field('facebooks_link',194); ?>"><i class="fa fa-facebook"></i></a></div>
						  <div class="social-footer"><a href="<?php the_field('instagrams_link',194); ?>"><i class="fa fa-instagram"></i></a></div>
						  <div class="social-footer"><a href="<?php the_field('twiters_link',194); ?>"><i class="fa fa-twitter"></i></a></div>
					  </div>
					</div>
				</div>
				<div class="container-fluid bottom-footer">
					<div class="container ">
						<p class="pull-left"><?php //echo of_get_option('display_credit_footer_left'); ?></p>
						<p class="pull-left"><div class="footer-menu"><?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?></div></p>
						<p class="pull-right"><?php echo of_get_option('display_credit_footer_right'); ?></p>
						
					</div>
				</div>
			</footer>
			<?php endif; ?>
		<?php endif; ?>
		<?php do_action( 'wpbootstrap_after_footer' ); ?>

	</div><!-- .container -->

<?php do_action( 'wpbootstrap_before_wp_footer' ); ?>
<?php wp_footer(); ?>
<?php do_action( 'wpbootstrap_after_wp_footer' ); ?>
<script>
    
    
    jQuery( "#FileInput" ).change(function() {
      jQuery( "#Up" ).click();
    });

	jQuery(document).ready(function($){
		$(".search-top").click(function(){
			$("#search-form").fadeToggle();
		});
		$('.navbar .dropdown').hover(function() {
		  $(this).find('.dropdown-menu').first().stop(true, true).slideDown(100);
		}, function() {
			$(this).find('.dropdown-menu').first().stop(true, true).slideUp(110);
		});
	//$(window).load(function(){
	//$('#preloader').fadeOut('slow',function(){$(this).remove();});
//});
	});

</script>
</body>
<!--/div-->
</html>