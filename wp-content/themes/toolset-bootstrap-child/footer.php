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
					  <ul class="social-footer-container">
						  <li class="facebook"><a href="<?php the_field('facebooks_link',194); ?>"><i class="fa fa-facebook"></i></a></li>
						  <li class="instagram"><a href="<?php the_field('instagrams_link',194); ?>"><i class="fa fa-instagram"></i></a></li>
						  <li class="twitter"><a href="<?php the_field('twiters_link',194); ?>"><i class="fa fa-twitter"></i></a></li>
					  </ul>
					</div>
				</div>
				<div class="container-fluid bottom-footer">
					<div class="container ">
						<div class="footer-menu pull-left"><?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?></div>
						<div class="pull-right"><?php echo of_get_option('display_credit_footer_right'); ?></div>
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
(function ($) {
	$.fn.countTo = function (options) {
		options = options || {};
		
		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);
			
			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;
			
			// references & variables that will change with each update
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};
			
			$self.data('countTo', data);
			
			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);
			
			// initialize the element with the starting value
			render(value);
			
			function updateTimer() {
				value += increment;
				loopCount++;
				
				render(value);
				
				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}
				
				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;
					
					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}
			
			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
	};
	
	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};
	
	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}(jQuery));

jQuery(function ($) {
  // custom formatting example
  $('#count-number').data('countToOptions', {
	formatter: function (value, options) {
	  return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
	}
  });
  
  // start all the timers
  $('.timer').each(count);  
  
  function count(options) {
	var $this = $(this);
	options = $.extend({}, options || {}, $this.data('countToOptions') || {});
	$this.countTo(options);
  }
});
    /*jQuery(function() {
    function count($this){
        var current = parseInt($this.html(), 10);
        $this.html(++current);
        if(current !== $this.data('count')){
            setTimeout(function(){count($this)}, 10);
        }
    }        
	  jQuery(".counter").each(function() {
	       jQuery(this).data('count', parseInt(jQuery(this).html(), 10));
	      jQuery(this).html('0');
	      count(jQuery(this));
	  });
	   jQuery(".counter.big").each(function() {
	       jQuery(this).data('count', parseInt(jQuery(this).html(), 10));
	      jQuery(this).html('15000');
	      count(jQuery(this));
	  });
	});*/
    jQuery( "#FileInput" ).change(function($) {
      $( "#Up" ).click();
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
	 $('a.popup').click(function(event) {
    	  window.open($(this).attr("href"), "popupWindow", "width=600,height=600,scrollbars=yes");
  });
	//$(window).load(function(){
		//$('#preloader').fadeOut('slow',function(){$(this).remove();});
	//});
});
</script>
</body>
<!--/div-->
</html>