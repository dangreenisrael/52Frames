!function(i){"use strict";"function"==typeof define&&define.amd?define(["jquery"],i):"undefined"!=typeof exports?module.exports=i(require("jquery")):i(jQuery)}(function($){"use strict";var i=window.Slick||{};i=function(){function i(i,t){var o=this,s,n;if(o.defaults={accessibility:!0,adaptiveHeight:!1,appendArrows:$(i),appendDots:$(i),arrows:!0,asNavFor:null,prevArrow:'<button type="button" data-role="none" class="slick-prev"><i class="fa fa-angle-left"></i> Previous</button>',nextArrow:'<button type="button" data-role="none" class="slick-next">Next <i class="fa fa-angle-right"></i></button>',autoplay:!1,autoplaySpeed:3e3,centerMode:!1,centerPadding:"50px",cssEase:"ease",customPaging:function(i,e){return'<button type="button" data-role="none">'+(e+1)+"</button>"},dots:!1,dotsClass:"slick-dots",draggable:!0,easing:"linear",fade:!1,focusOnSelect:!1,infinite:!0,initialSlide:0,lazyLoad:"ondemand",onBeforeChange:null,onAfterChange:null,onInit:null,onReInit:null,onSetPosition:null,pauseOnHover:!0,pauseOnDotsHover:!1,respondTo:"window",responsive:null,rtl:!1,slide:"div",slidesToShow:1,slidesToScroll:1,speed:500,swipe:!0,swipeToSlide:!1,touchMove:!0,touchThreshold:5,useCSS:!0,variableWidth:!1,vertical:!1,waitForAnimate:!0},o.initials={animating:!1,dragging:!1,autoPlayTimer:null,currentDirection:0,currentLeft:null,currentSlide:0,direction:1,$dots:null,listWidth:null,listHeight:null,loadIndex:0,$nextArrow:null,$prevArrow:null,slideCount:null,slideWidth:null,$slideTrack:null,$slides:null,sliding:!1,slideOffset:0,swipeLeft:null,$list:null,touchObject:{},transformsEnabled:!1},$.extend(o,o.initials),o.activeBreakpoint=null,o.animType=null,o.animProp=null,o.breakpoints=[],o.breakpointSettings=[],o.cssTransitions=!1,o.paused=!1,o.positionProp=null,o.respondTo=null,o.shouldClick=!0,o.$slider=$(i),o.$slidesCache=null,o.transformType=null,o.transitionType=null,o.windowWidth=0,o.windowTimer=null,o.options=$.extend({},o.defaults,t),o.currentSlide=o.options.initialSlide,o.originalSettings=o.options,s=o.options.responsive||null,s&&s.length>-1){o.respondTo=o.options.respondTo||"window";for(n in s)s.hasOwnProperty(n)&&(o.breakpoints.push(s[n].breakpoint),o.breakpointSettings[s[n].breakpoint]=s[n].settings);o.breakpoints.sort(function(i,e){return e-i})}o.autoPlay=$.proxy(o.autoPlay,o),o.autoPlayClear=$.proxy(o.autoPlayClear,o),o.changeSlide=$.proxy(o.changeSlide,o),o.clickHandler=$.proxy(o.clickHandler,o),o.selectHandler=$.proxy(o.selectHandler,o),o.setPosition=$.proxy(o.setPosition,o),o.swipeHandler=$.proxy(o.swipeHandler,o),o.dragHandler=$.proxy(o.dragHandler,o),o.keyHandler=$.proxy(o.keyHandler,o),o.autoPlayIterator=$.proxy(o.autoPlayIterator,o),o.instanceUid=e++,o.htmlExpr=/^(?:\s*(<[\w\W]+>)[^>]*)$/,o.init(),o.checkResponsive()}var e=0;return i}(),i.prototype.addSlide=function(i,e,t){var o=this;if("boolean"==typeof e)t=e,e=null;else if(0>e||e>=o.slideCount)return!1;o.unload(),"number"==typeof e?0===e&&0===o.$slides.length?$(i).appendTo(o.$slideTrack):t?$(i).insertBefore(o.$slides.eq(e)):$(i).insertAfter(o.$slides.eq(e)):t===!0?$(i).prependTo(o.$slideTrack):$(i).appendTo(o.$slideTrack),o.$slides=o.$slideTrack.children(this.options.slide),o.$slideTrack.children(this.options.slide).detach(),o.$slideTrack.append(o.$slides),o.$slides.each(function(i,e){$(e).attr("index",i)}),o.$slidesCache=o.$slides,o.reinit()},i.prototype.animateSlide=function(i,e){var t={},o=this;if(1===o.options.slidesToShow&&o.options.adaptiveHeight===!0&&o.options.vertical===!1){var s=o.$slides.eq(o.currentSlide).outerHeight(!0);o.$list.animate({height:s},o.options.speed)}o.options.rtl===!0&&o.options.vertical===!1&&(i=-i),o.transformsEnabled===!1?o.options.vertical===!1?o.$slideTrack.animate({left:i},o.options.speed,o.options.easing,e):o.$slideTrack.animate({top:i},o.options.speed,o.options.easing,e):o.cssTransitions===!1?$({animStart:o.currentLeft}).animate({animStart:i},{duration:o.options.speed,easing:o.options.easing,step:function(i){o.options.vertical===!1?(t[o.animType]="translate("+i+"px, 0px)",o.$slideTrack.css(t)):(t[o.animType]="translate(0px,"+i+"px)",o.$slideTrack.css(t))},complete:function(){e&&e.call()}}):(o.applyTransition(),t[o.animType]=o.options.vertical===!1?"translate3d("+i+"px, 0px, 0px)":"translate3d(0px,"+i+"px, 0px)",o.$slideTrack.css(t),e&&setTimeout(function(){o.disableTransition(),e.call()},o.options.speed))},i.prototype.asNavFor=function(i){var e=this,t=null!=e.options.asNavFor?$(e.options.asNavFor).getSlick():null;null!=t&&t.slideHandler(i,!0)},i.prototype.applyTransition=function(i){var e=this,t={};t[e.transitionType]=e.options.fade===!1?e.transformType+" "+e.options.speed+"ms "+e.options.cssEase:"opacity "+e.options.speed+"ms "+e.options.cssEase,e.options.fade===!1?e.$slideTrack.css(t):e.$slides.eq(i).css(t)},i.prototype.autoPlay=function(){var i=this;i.autoPlayTimer&&clearInterval(i.autoPlayTimer),i.slideCount>i.options.slidesToShow&&i.paused!==!0&&(i.autoPlayTimer=setInterval(i.autoPlayIterator,i.options.autoplaySpeed))},i.prototype.autoPlayClear=function(){var i=this;i.autoPlayTimer&&clearInterval(i.autoPlayTimer)},i.prototype.autoPlayIterator=function(){var i=this;i.options.infinite===!1?1===i.direction?(i.currentSlide+1===i.slideCount-1&&(i.direction=0),i.slideHandler(i.currentSlide+i.options.slidesToScroll)):(i.currentSlide-1===0&&(i.direction=1),i.slideHandler(i.currentSlide-i.options.slidesToScroll)):i.slideHandler(i.currentSlide+i.options.slidesToScroll)},i.prototype.buildArrows=function(){var i=this;i.options.arrows===!0&&i.slideCount>i.options.slidesToShow&&(i.$prevArrow=$(i.options.prevArrow),i.$nextArrow=$(i.options.nextArrow),i.htmlExpr.test(i.options.prevArrow)&&i.$prevArrow.appendTo(i.options.appendArrows),i.htmlExpr.test(i.options.nextArrow)&&i.$nextArrow.appendTo(i.options.appendArrows),i.options.infinite!==!0&&i.$prevArrow.addClass("slick-disabled"))},i.prototype.buildDots=function(){var i=this,e,t;if(i.options.dots===!0&&i.slideCount>i.options.slidesToShow){for(t='<ul class="'+i.options.dotsClass+'">',e=0;e<=i.getDotCount();e+=1)t+="<li>"+i.options.customPaging.call(this,i,e)+"</li>";t+="</ul>",i.$dots=$(t).appendTo(i.options.appendDots),i.$dots.find("li").first().addClass("slick-active")}},i.prototype.buildOut=function(){var i=this;i.$slides=i.$slider.children(i.options.slide+":not(.slick-cloned)").addClass("slick-slide"),i.slideCount=i.$slides.length,i.$slides.each(function(i,e){$(e).attr("index",i)}),i.$slidesCache=i.$slides,i.$slider.addClass("slick-slider"),i.$slideTrack=0===i.slideCount?$('<div class="slick-track"/>').appendTo(i.$slider):i.$slides.wrapAll('<div class="slick-track"/>').parent(),i.$list=i.$slideTrack.wrap('<div class="slick-list"/>').parent(),i.$slideTrack.css("opacity",0),i.options.centerMode===!0&&(i.options.slidesToScroll=1),$("img[data-lazy]",i.$slider).not("[src]").addClass("slick-loading"),i.setupInfinite(),i.buildArrows(),i.buildDots(),i.updateDots(),i.options.accessibility===!0&&i.$list.prop("tabIndex",0),i.setSlideClasses("number"==typeof this.currentSlide?this.currentSlide:0),i.options.draggable===!0&&i.$list.addClass("draggable")},i.prototype.checkResponsive=function(){var i=this,e,t,o,s=i.$slider.width(),n=window.innerWidth||$(window).width();if("window"===i.respondTo?o=n:"slider"===i.respondTo?o=s:"min"===i.respondTo&&(o=Math.min(n,s)),i.originalSettings.responsive&&i.originalSettings.responsive.length>-1&&null!==i.originalSettings.responsive){t=null;for(e in i.breakpoints)i.breakpoints.hasOwnProperty(e)&&o<i.breakpoints[e]&&(t=i.breakpoints[e]);null!==t?null!==i.activeBreakpoint?t!==i.activeBreakpoint&&(i.activeBreakpoint=t,i.options=$.extend({},i.originalSettings,i.breakpointSettings[t]),i.refresh()):(i.activeBreakpoint=t,i.options=$.extend({},i.originalSettings,i.breakpointSettings[t]),i.refresh()):null!==i.activeBreakpoint&&(i.activeBreakpoint=null,i.options=i.originalSettings,i.refresh())}},i.prototype.changeSlide=function(i,e){var t=this,o=$(i.target),s,n,l,r,d;switch(o.is("a")&&i.preventDefault(),l=t.slideCount%t.options.slidesToScroll!==0,s=l?0:(t.slideCount-t.currentSlide)%t.options.slidesToScroll,i.data.message){case"previous":n=0===s?t.options.slidesToScroll:t.options.slidesToShow-s,t.slideCount>t.options.slidesToShow&&t.slideHandler(t.currentSlide-n,!1,e);break;case"next":n=0===s?t.options.slidesToScroll:s,t.slideCount>t.options.slidesToShow&&t.slideHandler(t.currentSlide+n,!1,e);break;case"index":var a=0===i.data.index?0:i.data.index||$(i.target).parent().index()*t.options.slidesToScroll;if(r=t.getNavigableIndexes(),d=0,r[a]&&r[a]===a)if(a>r[r.length-1])a=r[r.length-1];else for(var c in r){if(a<r[c]){a=d;break}d=r[c]}t.slideHandler(a,!1,e);default:return}},i.prototype.clickHandler=function(i){var e=this;e.shouldClick===!1&&(i.stopImmediatePropagation(),i.stopPropagation(),i.preventDefault())},i.prototype.destroy=function(){var i=this;i.autoPlayClear(),i.touchObject={},$(".slick-cloned",i.$slider).remove(),i.$dots&&i.$dots.remove(),i.$prevArrow&&"object"!=typeof i.options.prevArrow&&i.$prevArrow.remove(),i.$nextArrow&&"object"!=typeof i.options.nextArrow&&i.$nextArrow.remove(),i.$slides.parent().hasClass("slick-track")&&i.$slides.unwrap().unwrap(),i.$slides.removeClass("slick-slide slick-active slick-center slick-visible").removeAttr("index").css({position:"",left:"",top:"",zIndex:"",opacity:"",width:""}),i.$slider.removeClass("slick-slider"),i.$slider.removeClass("slick-initialized"),i.$list.off(".slick"),$(window).off(".slick-"+i.instanceUid),$(document).off(".slick-"+i.instanceUid)},i.prototype.disableTransition=function(i){var e=this,t={};t[e.transitionType]="",e.options.fade===!1?e.$slideTrack.css(t):e.$slides.eq(i).css(t)},i.prototype.fadeSlide=function(i,e,t){var o=this;o.cssTransitions===!1?(o.$slides.eq(e).css({zIndex:1e3}),o.$slides.eq(e).animate({opacity:1},o.options.speed,o.options.easing,t),o.$slides.eq(i).animate({opacity:0},o.options.speed,o.options.easing)):(o.applyTransition(e),o.applyTransition(i),o.$slides.eq(e).css({opacity:1,zIndex:1e3}),o.$slides.eq(i).css({opacity:0}),t&&setTimeout(function(){o.disableTransition(e),o.disableTransition(i),t.call()},o.options.speed))},i.prototype.filterSlides=function(i){var e=this;null!==i&&(e.unload(),e.$slideTrack.children(this.options.slide).detach(),e.$slidesCache.filter(i).appendTo(e.$slideTrack),e.reinit())},i.prototype.getCurrent=function(){var i=this;return i.currentSlide},i.prototype.getDotCount=function(){var i=this,e=0,t=0,o=0;if(i.options.infinite===!0)o=Math.ceil(i.slideCount/i.options.slidesToScroll);else for(;e<i.slideCount;)++o,e=t+i.options.slidesToShow,t+=i.options.slidesToScroll<=i.options.slidesToShow?i.options.slidesToScroll:i.options.slidesToShow;return o-1},i.prototype.getLeft=function(i){var e=this,t,o,s=0,n,l;return e.slideOffset=0,o=e.$slides.first().outerHeight(),e.options.infinite===!0?(e.slideCount>e.options.slidesToShow&&(e.slideOffset=e.slideWidth*e.options.slidesToShow*-1,s=o*e.options.slidesToShow*-1),e.slideCount%e.options.slidesToScroll!==0&&i+e.options.slidesToScroll>e.slideCount&&e.slideCount>e.options.slidesToShow&&(i>e.slideCount?(e.slideOffset=(e.options.slidesToShow-(i-e.slideCount))*e.slideWidth*-1,s=(e.options.slidesToShow-(i-e.slideCount))*o*-1):(e.slideOffset=e.slideCount%e.options.slidesToScroll*e.slideWidth*-1,s=e.slideCount%e.options.slidesToScroll*o*-1))):i+e.options.slidesToShow>e.slideCount&&(e.slideOffset=(i+e.options.slidesToShow-e.slideCount)*e.slideWidth,s=(i+e.options.slidesToShow-e.slideCount)*o),e.slideCount<=e.options.slidesToShow&&(e.slideOffset=0,s=0),e.options.centerMode===!0&&e.options.infinite===!0?e.slideOffset+=e.slideWidth*Math.floor(e.options.slidesToShow/2)-e.slideWidth:e.options.centerMode===!0&&(e.slideOffset=0,e.slideOffset+=e.slideWidth*Math.floor(e.options.slidesToShow/2)),t=e.options.vertical===!1?i*e.slideWidth*-1+e.slideOffset:i*o*-1+s,e.options.variableWidth===!0&&(l=e.$slideTrack.children(".slick-slide").eq(e.slideCount<=e.options.slidesToShow||e.options.infinite===!1?i:i+e.options.slidesToShow),t=l[0]?-1*l[0].offsetLeft:0,e.options.centerMode===!0&&(l=e.$slideTrack.children(".slick-slide").eq(e.options.infinite===!1?i:i+e.options.slidesToShow+1),t=l[0]?-1*l[0].offsetLeft:0,t+=(e.$list.width()-l.outerWidth())/2)),t},i.prototype.getNavigableIndexes=function(){for(var i=this,e=0,t=0,o=[];e<i.slideCount;)o.push(e),e=t+i.options.slidesToScroll,t+=i.options.slidesToScroll<=i.options.slidesToShow?i.options.slidesToScroll:i.options.slidesToShow;return o},i.prototype.getSlideCount=function(){var i=this,e;if(i.options.swipeToSlide===!0){var t=null;return i.$slideTrack.find(".slick-slide").each(function(e,o){return o.offsetLeft+$(o).outerWidth()/2>-1*i.swipeLeft?(t=o,!1):void 0}),e=Math.abs($(t).attr("index")-i.currentSlide)}return i.options.slidesToScroll},i.prototype.init=function(){var i=this;$(i.$slider).hasClass("slick-initialized")||($(i.$slider).addClass("slick-initialized"),i.buildOut(),i.setProps(),i.startLoad(),i.loadSlider(),i.initializeEvents(),i.updateArrows(),i.updateDots()),null!==i.options.onInit&&i.options.onInit.call(this,i)},i.prototype.initArrowEvents=function(){var i=this;i.options.arrows===!0&&i.slideCount>i.options.slidesToShow&&(i.$prevArrow.on("click.slick",{message:"previous"},i.changeSlide),i.$nextArrow.on("click.slick",{message:"next"},i.changeSlide))},i.prototype.initDotEvents=function(){var i=this;i.options.dots===!0&&i.slideCount>i.options.slidesToShow&&$("li",i.$dots).on("click.slick",{message:"index"},i.changeSlide),i.options.dots===!0&&i.options.pauseOnDotsHover===!0&&i.options.autoplay===!0&&$("li",i.$dots).on("mouseenter.slick",function(){i.paused=!0,i.autoPlayClear()}).on("mouseleave.slick",function(){i.paused=!1,i.autoPlay()})},i.prototype.initializeEvents=function(){var i=this;i.initArrowEvents(),i.initDotEvents(),i.$list.on("touchstart.slick mousedown.slick",{action:"start"},i.swipeHandler),i.$list.on("touchmove.slick mousemove.slick",{action:"move"},i.swipeHandler),i.$list.on("touchend.slick mouseup.slick",{action:"end"},i.swipeHandler),i.$list.on("touchcancel.slick mouseleave.slick",{action:"end"},i.swipeHandler),i.$list.on("click.slick",i.clickHandler),i.options.pauseOnHover===!0&&i.options.autoplay===!0&&(i.$list.on("mouseenter.slick",function(){i.paused=!0,i.autoPlayClear()}),i.$list.on("mouseleave.slick",function(){i.paused=!1,i.autoPlay()})),i.options.accessibility===!0&&i.$list.on("keydown.slick",i.keyHandler),i.options.focusOnSelect===!0&&$(i.options.slide,i.$slideTrack).on("click.slick",i.selectHandler),$(window).on("orientationchange.slick.slick-"+i.instanceUid,function(){i.checkResponsive(),i.setPosition()}),$(window).on("resize.slick.slick-"+i.instanceUid,function(){$(window).width()!==i.windowWidth&&(clearTimeout(i.windowDelay),i.windowDelay=window.setTimeout(function(){i.windowWidth=$(window).width(),i.checkResponsive(),i.setPosition()},50))}),$("*[draggable!=true]",i.$slideTrack).on("dragstart",function(i){i.preventDefault()}),$(window).on("load.slick.slick-"+i.instanceUid,i.setPosition),$(document).on("ready.slick.slick-"+i.instanceUid,i.setPosition)},i.prototype.initUI=function(){var i=this;i.options.arrows===!0&&i.slideCount>i.options.slidesToShow&&(i.$prevArrow.show(),i.$nextArrow.show()),i.options.dots===!0&&i.slideCount>i.options.slidesToShow&&i.$dots.show(),i.options.autoplay===!0&&i.autoPlay()},i.prototype.keyHandler=function(i){var e=this;37===i.keyCode&&e.options.accessibility===!0?e.changeSlide({data:{message:"previous"}}):39===i.keyCode&&e.options.accessibility===!0&&e.changeSlide({data:{message:"next"}})},i.prototype.lazyLoad=function(){function i(i){$("img[data-lazy]",i).each(function(){var i=$(this),e=$(this).attr("data-lazy");i.load(function(){i.animate({opacity:1},200)}).css({opacity:0}).attr("src",e).removeAttr("data-lazy").removeClass("slick-loading")})}var e=this,t,o,s,n;e.options.centerMode===!0?e.options.infinite===!0?(s=e.currentSlide+(e.options.slidesToShow/2+1),n=s+e.options.slidesToShow+2):(s=Math.max(0,e.currentSlide-(e.options.slidesToShow/2+1)),n=2+(e.options.slidesToShow/2+1)+e.currentSlide):(s=e.options.infinite?e.options.slidesToShow+e.currentSlide:e.currentSlide,n=s+e.options.slidesToShow,e.options.fade===!0&&(s>0&&s--,n<=e.slideCount&&n++)),t=e.$slider.find(".slick-slide").slice(s,n),i(t),e.slideCount<=e.options.slidesToShow?(o=e.$slider.find(".slick-slide"),i(o)):e.currentSlide>=e.slideCount-e.options.slidesToShow?(o=e.$slider.find(".slick-cloned").slice(0,e.options.slidesToShow),i(o)):0===e.currentSlide&&(o=e.$slider.find(".slick-cloned").slice(-1*e.options.slidesToShow),i(o))},i.prototype.loadSlider=function(){var i=this;i.setPosition(),i.$slideTrack.css({opacity:1}),i.$slider.removeClass("slick-loading"),i.initUI(),"progressive"===i.options.lazyLoad&&i.progressiveLazyLoad()},i.prototype.postSlide=function(i){var e=this;null!==e.options.onAfterChange&&e.options.onAfterChange.call(this,e,i),e.animating=!1,e.setPosition(),e.swipeLeft=null,e.options.autoplay===!0&&e.paused===!1&&e.autoPlay()},i.prototype.progressiveLazyLoad=function(){var i=this,e,t;e=$("img[data-lazy]",i.$slider).length,e>0&&(t=$("img[data-lazy]",i.$slider).first(),t.attr("src",t.attr("data-lazy")).removeClass("slick-loading").load(function(){t.removeAttr("data-lazy"),i.progressiveLazyLoad()}).error(function(){t.removeAttr("data-lazy"),i.progressiveLazyLoad()}))},i.prototype.refresh=function(){var i=this,e=i.currentSlide;i.destroy(),$.extend(i,i.initials),i.init(),i.changeSlide({data:{message:"index",index:e}},!0)},i.prototype.reinit=function(){var i=this;i.$slides=i.$slideTrack.children(i.options.slide).addClass("slick-slide"),i.slideCount=i.$slides.length,i.currentSlide>=i.slideCount&&0!==i.currentSlide&&(i.currentSlide=i.currentSlide-i.options.slidesToScroll),i.slideCount<=i.options.slidesToShow&&(i.currentSlide=0),i.setProps(),i.setupInfinite(),i.buildArrows(),i.updateArrows(),i.initArrowEvents(),i.buildDots(),i.updateDots(),i.initDotEvents(),i.options.focusOnSelect===!0&&$(i.options.slide,i.$slideTrack).on("click.slick",i.selectHandler),i.setSlideClasses(0),i.setPosition(),null!==i.options.onReInit&&i.options.onReInit.call(this,i)},i.prototype.removeSlide=function(i,e,t){var o=this;return"boolean"==typeof i?(e=i,i=e===!0?0:o.slideCount-1):i=e===!0?--i:i,o.slideCount<1||0>i||i>o.slideCount-1?!1:(o.unload(),t===!0?o.$slideTrack.children().remove():o.$slideTrack.children(this.options.slide).eq(i).remove(),o.$slides=o.$slideTrack.children(this.options.slide),o.$slideTrack.children(this.options.slide).detach(),o.$slideTrack.append(o.$slides),o.$slidesCache=o.$slides,void o.reinit())},i.prototype.setCSS=function(i){var e=this,t={},o,s;e.options.rtl===!0&&(i=-i),o="left"==e.positionProp?i+"px":"0px",s="top"==e.positionProp?i+"px":"0px",t[e.positionProp]=i,e.transformsEnabled===!1?e.$slideTrack.css(t):(t={},e.cssTransitions===!1?(t[e.animType]="translate("+o+", "+s+")",e.$slideTrack.css(t)):(t[e.animType]="translate3d("+o+", "+s+", 0px)",e.$slideTrack.css(t)))},i.prototype.setDimensions=function(){var i=this;if(i.options.vertical===!1?i.options.centerMode===!0&&i.$list.css({padding:"0px "+i.options.centerPadding}):(i.$list.height(i.$slides.first().outerHeight(!0)*i.options.slidesToShow),i.options.centerMode===!0&&i.$list.css({padding:i.options.centerPadding+" 0px"})),i.listWidth=i.$list.width(),i.listHeight=i.$list.height(),i.options.vertical===!1&&i.options.variableWidth===!1)i.slideWidth=Math.ceil(i.listWidth/i.options.slidesToShow),i.$slideTrack.width(Math.ceil(i.slideWidth*i.$slideTrack.children(".slick-slide").length));else if(i.options.variableWidth===!0){var e=0;i.slideWidth=Math.ceil(i.listWidth/i.options.slidesToShow),i.$slideTrack.children(".slick-slide").each(function(){e+=Math.ceil($(this).outerWidth(!0))}),i.$slideTrack.width(Math.ceil(e)+1)}else i.slideWidth=Math.ceil(i.listWidth),i.$slideTrack.height(Math.ceil(i.$slides.first().outerHeight(!0)*i.$slideTrack.children(".slick-slide").length));var t=i.$slides.first().outerWidth(!0)-i.$slides.first().width();i.options.variableWidth===!1&&i.$slideTrack.children(".slick-slide").width(i.slideWidth-t)},i.prototype.setFade=function(){var i=this,e;i.$slides.each(function(t,o){e=i.slideWidth*t*-1,$(o).css(i.options.rtl===!0?{position:"relative",right:e,top:0,zIndex:800,opacity:0}:{position:"relative",left:e,top:0,zIndex:800,opacity:0})}),i.$slides.eq(i.currentSlide).css({zIndex:900,opacity:1})},i.prototype.setHeight=function(){var i=this;if(1===i.options.slidesToShow&&i.options.adaptiveHeight===!0&&i.options.vertical===!1){var e=i.$slides.eq(i.currentSlide).outerHeight(!0);i.$list.css("height",e)}},i.prototype.setPosition=function(){var i=this;i.setDimensions(),i.setHeight(),i.options.fade===!1?i.setCSS(i.getLeft(i.currentSlide)):i.setFade(),null!==i.options.onSetPosition&&i.options.onSetPosition.call(this,i)},i.prototype.setProps=function(){var i=this,e=document.body.style;i.positionProp=i.options.vertical===!0?"top":"left","top"===i.positionProp?i.$slider.addClass("slick-vertical"):i.$slider.removeClass("slick-vertical"),(void 0!==e.WebkitTransition||void 0!==e.MozTransition||void 0!==e.msTransition)&&i.options.useCSS===!0&&(i.cssTransitions=!0),void 0!==e.OTransform&&(i.animType="OTransform",i.transformType="-o-transform",i.transitionType="OTransition",void 0===e.perspectiveProperty&&void 0===e.webkitPerspective&&(i.animType=!1)),void 0!==e.MozTransform&&(i.animType="MozTransform",i.transformType="-moz-transform",i.transitionType="MozTransition",void 0===e.perspectiveProperty&&void 0===e.MozPerspective&&(i.animType=!1)),void 0!==e.webkitTransform&&(i.animType="webkitTransform",i.transformType="-webkit-transform",i.transitionType="webkitTransition",void 0===e.perspectiveProperty&&void 0===e.webkitPerspective&&(i.animType=!1)),void 0!==e.msTransform&&(i.animType="msTransform",i.transformType="-ms-transform",i.transitionType="msTransition",void 0===e.msTransform&&(i.animType=!1)),void 0!==e.transform&&i.animType!==!1&&(i.animType="transform",i.transformType="transform",i.transitionType="transition"),i.transformsEnabled=null!==i.animType&&i.animType!==!1},i.prototype.setSlideClasses=function(i){var e=this,t,o,s,n;e.$slider.find(".slick-slide").removeClass("slick-active").removeClass("slick-center"),o=e.$slider.find(".slick-slide"),e.options.centerMode===!0?(t=Math.floor(e.options.slidesToShow/2),e.options.infinite===!0&&(i>=t&&i<=e.slideCount-1-t?e.$slides.slice(i-t,i+t+1).addClass("slick-active"):(s=e.options.slidesToShow+i,o.slice(s-t+1,s+t+2).addClass("slick-active")),0===i?o.eq(o.length-1-e.options.slidesToShow).addClass("slick-center"):i===e.slideCount-1&&o.eq(e.options.slidesToShow).addClass("slick-center")),e.$slides.eq(i).addClass("slick-center")):i>=0&&i<=e.slideCount-e.options.slidesToShow?e.$slides.slice(i,i+e.options.slidesToShow).addClass("slick-active"):o.length<=e.options.slidesToShow?o.addClass("slick-active"):(n=e.slideCount%e.options.slidesToShow,s=e.options.infinite===!0?e.options.slidesToShow+i:i,e.options.slidesToShow==e.options.slidesToScroll&&e.slideCount-i<e.options.slidesToShow?o.slice(s-(e.options.slidesToShow-n),s+n).addClass("slick-active"):o.slice(s,s+e.options.slidesToShow).addClass("slick-active")),"ondemand"===e.options.lazyLoad&&e.lazyLoad()},i.prototype.setupInfinite=function(){var i=this,e,t,o;if(i.options.fade===!0&&(i.options.centerMode=!1),i.options.infinite===!0&&i.options.fade===!1&&(t=null,i.slideCount>i.options.slidesToShow)){for(o=i.options.centerMode===!0?i.options.slidesToShow+1:i.options.slidesToShow,e=i.slideCount;e>i.slideCount-o;e-=1)t=e-1,$(i.$slides[t]).clone(!0).attr("id","").attr("index",t-i.slideCount).prependTo(i.$slideTrack).addClass("slick-cloned");for(e=0;o>e;e+=1)t=e,$(i.$slides[t]).clone(!0).attr("id","").attr("index",t+i.slideCount).appendTo(i.$slideTrack).addClass("slick-cloned");i.$slideTrack.find(".slick-cloned").find("[id]").each(function(){$(this).attr("id","")})}},i.prototype.selectHandler=function(i){var e=this,t=parseInt($(i.target).parents(".slick-slide").attr("index"));return t||(t=0),e.slideCount<=e.options.slidesToShow?(e.$slider.find(".slick-slide").removeClass("slick-active"),e.$slides.eq(t).addClass("slick-active"),e.options.centerMode===!0&&(e.$slider.find(".slick-slide").removeClass("slick-center"),e.$slides.eq(t).addClass("slick-center")),void e.asNavFor(t)):void e.slideHandler(t)},i.prototype.slideHandler=function(i,e,t){var o,s,n,l,r,d=null,a=this;return e=e||!1,a.animating===!0&&a.options.waitForAnimate===!0||a.options.fade===!0&&a.currentSlide===i||a.slideCount<=a.options.slidesToShow?void 0:(e===!1&&a.asNavFor(i),o=i,d=a.getLeft(o),l=a.getLeft(a.currentSlide),a.currentLeft=null===a.swipeLeft?l:a.swipeLeft,a.options.infinite===!1&&a.options.centerMode===!1&&(0>i||i>a.getDotCount()*a.options.slidesToScroll)?void(a.options.fade===!1&&(o=a.currentSlide,t!==!0?a.animateSlide(l,function(){a.postSlide(o)}):a.postSlide(o))):a.options.infinite===!1&&a.options.centerMode===!0&&(0>i||i>a.slideCount-a.options.slidesToScroll)?void(a.options.fade===!1&&(o=a.currentSlide,t!==!0?a.animateSlide(l,function(){a.postSlide(o)}):a.postSlide(o))):(a.options.autoplay===!0&&clearInterval(a.autoPlayTimer),s=0>o?a.slideCount%a.options.slidesToScroll!==0?a.slideCount-a.slideCount%a.options.slidesToScroll:a.slideCount+o:o>=a.slideCount?a.slideCount%a.options.slidesToScroll!==0?0:o-a.slideCount:o,a.animating=!0,null!==a.options.onBeforeChange&&i!==a.currentSlide&&a.options.onBeforeChange.call(this,a,a.currentSlide,s),n=a.currentSlide,a.currentSlide=s,a.setSlideClasses(a.currentSlide),a.updateDots(),a.updateArrows(),a.options.fade===!0?void(t!==!0?a.fadeSlide(n,s,function(){a.postSlide(s)}):a.postSlide(s)):void(t!==!0?a.animateSlide(d,function(){a.postSlide(s)}):a.postSlide(s))))},i.prototype.startLoad=function(){var i=this;i.options.arrows===!0&&i.slideCount>i.options.slidesToShow&&(i.$prevArrow.hide(),i.$nextArrow.hide()),i.options.dots===!0&&i.slideCount>i.options.slidesToShow&&i.$dots.hide(),i.$slider.addClass("slick-loading")},i.prototype.swipeDirection=function(){var i,e,t,o,s=this;return i=s.touchObject.startX-s.touchObject.curX,e=s.touchObject.startY-s.touchObject.curY,t=Math.atan2(e,i),o=Math.round(180*t/Math.PI),0>o&&(o=360-Math.abs(o)),45>=o&&o>=0?s.options.rtl===!1?"left":"right":360>=o&&o>=315?s.options.rtl===!1?"left":"right":o>=135&&225>=o?s.options.rtl===!1?"right":"left":"vertical"},i.prototype.swipeEnd=function(i){var e=this,t;if(e.dragging=!1,e.shouldClick=e.touchObject.swipeLength>10?!1:!0,void 0===e.touchObject.curX)return!1;if(e.touchObject.swipeLength>=e.touchObject.minSwipe)switch(e.swipeDirection()){case"left":e.slideHandler(e.currentSlide+e.getSlideCount()),e.currentDirection=0,e.touchObject={};break;case"right":e.slideHandler(e.currentSlide-e.getSlideCount()),e.currentDirection=1,e.touchObject={}}else e.touchObject.startX!==e.touchObject.curX&&(e.slideHandler(e.currentSlide),e.touchObject={})},i.prototype.swipeHandler=function(i){var e=this;if(!(e.options.swipe===!1||"ontouchend"in document&&e.options.swipe===!1||e.options.draggable===!1&&-1!==i.type.indexOf("mouse")))switch(e.touchObject.fingerCount=i.originalEvent&&void 0!==i.originalEvent.touches?i.originalEvent.touches.length:1,e.touchObject.minSwipe=e.listWidth/e.options.touchThreshold,i.data.action){case"start":e.swipeStart(i);break;case"move":e.swipeMove(i);break;case"end":e.swipeEnd(i)}},i.prototype.swipeMove=function(i){var e=this,t,o,s,n;return n=void 0!==i.originalEvent?i.originalEvent.touches:null,!e.dragging||n&&1!==n.length?!1:(t=e.getLeft(e.currentSlide),e.touchObject.curX=void 0!==n?n[0].pageX:i.clientX,e.touchObject.curY=void 0!==n?n[0].pageY:i.clientY,e.touchObject.swipeLength=Math.round(Math.sqrt(Math.pow(e.touchObject.curX-e.touchObject.startX,2))),o=e.swipeDirection(),"vertical"!==o?(void 0!==i.originalEvent&&e.touchObject.swipeLength>4&&i.preventDefault(),s=(e.options.rtl===!1?1:-1)*(e.touchObject.curX>e.touchObject.startX?1:-1),e.swipeLeft=e.options.vertical===!1?t+e.touchObject.swipeLength*s:t+e.touchObject.swipeLength*(e.$list.height()/e.listWidth)*s,e.options.fade===!0||e.options.touchMove===!1?!1:e.animating===!0?(e.swipeLeft=null,!1):void e.setCSS(e.swipeLeft)):void 0)},i.prototype.swipeStart=function(i){var e=this,t;return 1!==e.touchObject.fingerCount||e.slideCount<=e.options.slidesToShow?(e.touchObject={},!1):(void 0!==i.originalEvent&&void 0!==i.originalEvent.touches&&(t=i.originalEvent.touches[0]),e.touchObject.startX=e.touchObject.curX=void 0!==t?t.pageX:i.clientX,e.touchObject.startY=e.touchObject.curY=void 0!==t?t.pageY:i.clientY,void(e.dragging=!0))},i.prototype.unfilterSlides=function(){var i=this;null!==i.$slidesCache&&(i.unload(),i.$slideTrack.children(this.options.slide).detach(),i.$slidesCache.appendTo(i.$slideTrack),i.reinit())},i.prototype.unload=function(){var i=this;$(".slick-cloned",i.$slider).remove(),i.$dots&&i.$dots.remove(),i.$prevArrow&&"object"!=typeof i.options.prevArrow&&i.$prevArrow.remove(),i.$nextArrow&&"object"!=typeof i.options.nextArrow&&i.$nextArrow.remove(),i.$slides.removeClass("slick-slide slick-active slick-visible").css("width","")},i.prototype.updateArrows=function(){var i=this,e;e=Math.floor(i.options.slidesToShow/2),i.options.arrows===!0&&i.options.infinite!==!0&&i.slideCount>i.options.slidesToShow&&(i.$prevArrow.removeClass("slick-disabled"),i.$nextArrow.removeClass("slick-disabled"),0===i.currentSlide?(i.$prevArrow.addClass("slick-disabled"),i.$nextArrow.removeClass("slick-disabled")):i.currentSlide>=i.slideCount-i.options.slidesToShow&&i.options.centerMode===!1?(i.$nextArrow.addClass("slick-disabled"),i.$prevArrow.removeClass("slick-disabled")):i.currentSlide>i.slideCount-i.options.slidesToShow+e&&i.options.centerMode===!0&&(i.$nextArrow.addClass("slick-disabled"),i.$prevArrow.removeClass("slick-disabled")))},i.prototype.updateDots=function(){var i=this;null!==i.$dots&&(i.$dots.find("li").removeClass("slick-active"),i.$dots.find("li").eq(Math.floor(i.currentSlide/i.options.slidesToScroll)).addClass("slick-active"))},$.fn.slick=function(e){var t=this;return t.each(function(t,o){o.slick=new i(o,e)})},$.fn.slickAdd=function(i,e,t){var o=this;return o.each(function(o,s){s.slick.addSlide(i,e,t)})},$.fn.slickCurrentSlide=function(){var i=this;return i.get(0).slick.getCurrent()},$.fn.slickFilter=function(i){var e=this;return e.each(function(e,t){t.slick.filterSlides(i)})},$.fn.slickGoTo=function(i,e){var t=this;return t.each(function(t,o){o.slick.changeSlide({data:{message:"index",index:parseInt(i)}},e)})},$.fn.slickNext=function(){var i=this;return i.each(function(i,e){e.slick.changeSlide({data:{message:"next"}})})},$.fn.slickPause=function(){var i=this;return i.each(function(i,e){e.slick.autoPlayClear(),e.slick.paused=!0})},$.fn.slickPlay=function(){var i=this;return i.each(function(i,e){e.slick.paused=!1,e.slick.autoPlay()})},$.fn.slickPrev=function(){var i=this;return i.each(function(i,e){e.slick.changeSlide({data:{message:"previous"}})})},$.fn.slickRemove=function(i,e){var t=this;return t.each(function(t,o){o.slick.removeSlide(i,e)})},$.fn.slickRemoveAll=function(){var i=this;return i.each(function(i,e){e.slick.removeSlide(null,null,!0)})},$.fn.slickGetOption=function(i){var e=this;return e.get(0).slick.options[i]},$.fn.slickSetOption=function(i,e,t){var o=this;return o.each(function(o,s){s.slick.options[i]=e,t===!0&&(s.slick.unload(),s.slick.reinit())})},$.fn.slickUnfilter=function(){var i=this;return i.each(function(i,e){e.slick.unfilterSlides()})},$.fn.unslick=function(){var i=this;return i.each(function(i,e){e.slick&&e.slick.destroy()})},$.fn.getSlick=function(){var i=null,e=this;return e.each(function(e,t){i=t.slick}),i}});