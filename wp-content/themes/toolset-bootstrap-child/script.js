$(function(){


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
		newYear = true;

	if((new Date()) > ts){
		// The new year is here! Count towards something else.
		// Notice the *1000 at the end - time must be in milliseconds
		ts = (new Date()).getTime() + 10*24*60*60*1000;
		newYear = false;
	}
		
	$('#countdown').countdown({
		addClass('boo');
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
	
});


document.getElementById("_featured_image_file").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};