jQuery(function($){function e(){return offset=-5,clientDate=new Date,utc=clientDate.getTime()+6e4*clientDate.getTimezoneOffset(),serverDate=new Date(utc+36e5*offset)}var t=e(),n=$("#note"),a=new Date(t.getFullYear(),t.getMonth(),t.getDate()+(7-t.getDay()),t.getHours(),t.getMinutes(),t.getSeconds()),o=new Date,u=new Date(o.getFullYear(),o.getMonth(),o.getDate()+(7-o.getDay()));newYear=!1,new Date>a&&(a=(new Date).getTime()+864e6,newYear=!1),$("#countdown").countdown({timestamp:a,callback:function(e,t,a,o){var u="";u+=e+" day"+(1==e?"":"s")+", ",u+=t+" hour"+(1==t?"":"s")+", ",u+=a+" minute"+(1==a?"":"s")+" and ",u+=o+" second"+(1==o?"":"s")+" <br />",u+=newYear?"left until next sunday!":"left to 10 days from now!",n.html(u)}})});