jQuery(document).ready(function($){function t(){var t=window,e=document,n=e.documentElement,a=e.getElementsByTagName("body")[0],o=t.innerWidth||n.clientWidth||a.clientWidth,i=t.innerHeight||n.clientHeight||a.clientHeight;return{width:o,height:i}}function e(){topBarHeight=$("#ehu-bar").height(),headerHeight=$("#header").height(),windowHeight=$(window).innerHeight()-headerHeight-topBarHeight-30,$(".photo-thumbnail img").css("max-height",windowHeight)}function n(){return offset=-5,clientDate=new Date,utc=clientDate.getTime()+6e4*clientDate.getTimezoneOffset(),serverDate=new Date(utc+36e5*offset),serverDate}function a(t,e){return t.toFixed(e.decimals)}function o(t){var e=$(this);t=$.extend({},t||{},e.data("countToOptions")||{}),e.countTo(t)}var i=t();$(".search-top").click(function(){$("#search-form").fadeToggle()}),i.width>=980&&$(".navbar .dropdown").hover(function(){$(this).find(".dropdown-menu").first().stop(!0,!0).slideDown(100)},function(){$(this).find(".dropdown-menu").first().stop(!0,!0).slideUp(110)}),$("a.popup").click(function(t){window.open($(this).attr("href"),"popupWindow","width=600,height=600,scrollbars=yes")}),$("a.btn-navbar").click(function(){$(this).hasClass("active")?$(this).removeClass("active"):$(this).addClass("active")}),$('.main-content a[href^="#"]').on("click",function(t){t.preventDefault();var e=this.hash,n=$(e);$("html, body").stop().animate({scrollTop:n.offset().top},900,"swing",function(){window.location.hash=e})}),$(".nudity-filter").on("change",'input[type="radio"].toggle',function(){this.checked&&($('input[name="'+this.name+'"].checked').removeClass("checked"),$(this).addClass("checked"),$(".toggle-container").addClass("force-update").removeClass("force-update"))}),$('.nudity-filter input[type="radio"].toggle:checked').addClass("checked"),$("a.fullsizable").fullsizable(),$(".rating-result").click(function(){$("html, body").animate({scrollTop:$(".rating-form").offset().top},500)}),$(".photo-description .ico.comments").click(function(){$("html, body").animate({scrollTop:$("#comments-title").offset().top},500)}),e(),$(window).resize(function(){e()}),$(".latest-albums .album").hover(function(){var t=$(this).find(".winner").height()+12;$(this).find("h2").css({transform:"translate3d(0, "+-t+"px, 0)"})},function(){$(this).find("h2").css({transform:"translate3d(0, 0, 0)"})}),$(".vote-up").each(function(){var t=$(this).text();$(this).html(t.replace("▲",'<i class="fa fa-thumbs-up"></i>'))});var r=n(),c=$("#note"),s=new Date(r.getFullYear(),r.getMonth(),r.getDate()+(7-r.getDay()),r.getHours(),r.getMinutes(),r.getSeconds()),l=new Date,d=new Date(l.getFullYear(),l.getMonth(),l.getDate()+(7-l.getDay()));newYear=!1,new Date>s&&(s=(new Date).getTime()+864e6,newYear=!1),$("#countdown").countdown({timestamp:s,callback:function(t,e,n,a){var o="";o+=t+" day"+(1==t?"":"s")+", ",o+=e+" hour"+(1==e?"":"s")+", ",o+=n+" minute"+(1==n?"":"s")+" and ",o+=a+" second"+(1==a?"":"s")+" <br />",o+=newYear?"left until next sunday!":"left to 10 days from now!",c.html(o)}}),$.fn.countTo=function(t){return t=t||{},$(this).each(function(){function e(){l+=i,s++,n(l),"function"==typeof a.onUpdate&&a.onUpdate.call(r,l),s>=o&&(c.removeData("countTo"),clearInterval(d.interval),l=a.to,"function"==typeof a.onComplete&&a.onComplete.call(r,l))}function n(t){var e=a.formatter.call(r,t,a);c.html(e)}var a=$.extend({},$.fn.countTo.defaults,{from:$(this).data("from"),to:$(this).data("to"),speed:$(this).data("speed"),refreshInterval:$(this).data("refresh-interval"),decimals:$(this).data("decimals")},t),o=Math.ceil(a.speed/a.refreshInterval),i=(a.to-a.from)/o,r=this,c=$(this),s=0,l=a.from,d=c.data("countTo")||{};c.data("countTo",d),d.interval&&clearInterval(d.interval),d.interval=setInterval(e,a.refreshInterval),n(l)})},$.fn.countTo.defaults={from:0,to:0,speed:1e3,refreshInterval:100,decimals:0,formatter:a,onUpdate:null,onComplete:null},$("#count-number").data("countToOptions",{formatter:function(t,e){return t.toFixed(e.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g,",")}}),$(".timer").each(o),$("#FileInput").change(function($){$("#Up").click()})});