	jQuery(document).ready(function($) {
	function updateViewportDimensions() {
  	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
  	return { width:x,height:y }
	}
	// setting the viewport width
	var viewport = updateViewportDimensions();	

		$(".search-top").click(function(){
			$("#search-form").fadeToggle();
	 	 });
	if( viewport.width >= 980 ) {		
		$('.navbar .dropdown').hover(function() {
		  $(this).find('.dropdown-menu').first().stop(true, true).slideDown(100);
		}, function() {
	  	$(this).find('.dropdown-menu').first().stop(true, true).slideUp(110);
		});
	}
	 $('a.popup').click(function(event) {
		  window.open($(this).attr("href"), "popupWindow", "width=600,height=600,scrollbars=yes");
		});
	 
	 $('a.btn-navbar').click(function() {
		if ($(this).hasClass('active'))
      	  $(this).removeClass('active');
        else {
           $(this).addClass('active');
         }
	});
	 
	 $('.entry-content a[href^="#"]').on('click',function (e) {
	    e.preventDefault();

	    var target = this.hash;
	    var $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing', function () {
	        window.location.hash = target;
	    });
	});

	 $('a.fullsizable').fullsizable();

	 $(".rating-result").click(function() {
   	 	$('html, body').animate({
        scrollTop: $(".rating-form").offset().top
    	}, 500);
	});
	  $(".photo-description .ico.comments").click(function() {
   	 	$('html, body').animate({
        scrollTop: $("#comments-title").offset().top
    	}, 500);
	});

	function setHeight() {
		 topBarHeight = $('#ehu-bar').height();
		 headerHeight = $('#header').height();
   		 windowHeight = $(window).innerHeight() - headerHeight - topBarHeight - 30;
    		$('.photo-thumbnail img').css('max-height', windowHeight);
 		 }
 		 setHeight();
  
  		$(window).resize(function() {
 		   setHeight();
  		});
		
		function convertToServerTimeZone(){

	    //EST
	    offset = -5.0

	    clientDate = new Date();
	    utc = clientDate.getTime() + (clientDate.getTimezoneOffset() * 60000);

	    serverDate = new Date(utc + (3600000*offset));
	    return serverDate;

	    
	    // alert (serverDate.toLocaleString());


	}


	// var today = new Date(); // Israel time
	var today = convertToServerTimeZone(); //EST time
	var note = $('#note'),
		// ts = new Date(2012, 0, 1),
		ts = new Date(today.getFullYear(),today.getMonth(),today.getDate()+(7-today.getDay()),today.getHours(),today.getMinutes(),today.getSeconds());
		var td = new Date();
		var nextSunday= new Date(td.getFullYear(),td.getMonth(),td.getDate()+(7-td.getDay()));
		newYear = false;

	if((new Date()) > ts){
		// The new year is here! Count towards something else.
		// Notice the *1000 at the end - time must be in milliseconds
		ts = (new Date()).getTime() + 10*24*60*60*1000;
		newYear = false;
	}
	//ts = parseInt($('#countdown_ts').text());
	//newYear = false;
		
	$('#countdown').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
			
			var message = "";
			
			message += days + " day" + ( days==1 ? '':'s' ) + ", ";
			message += hours + " hour" + ( hours==1 ? '':'s' ) + ", ";
			message += minutes + " minute" + ( minutes==1 ? '':'s' ) + " and ";
			message += seconds + " second" + ( seconds==1 ? '':'s' ) + " <br />";
			
			if(newYear){
				message += "left until next sunday!";
			}
			else {
				message += "left to 10 days from now!";
			}
			
			note.html(message);
		}
	});
	
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

  $( "#FileInput" ).change(function($) {
      $( "#Up" ).click();
  });

});