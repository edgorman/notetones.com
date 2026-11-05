$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	$('[name="bootSwitch"]').bootstrapSwitch();
	
	$(".menu-toggle").click(function(e) {
		e.preventDefault();
		$(".container-wrapper").toggleClass("toggled");
		$(".sidebar-toggle").toggleClass("toggled");
		
		if($(".sidebar-toggle").hasClass("toggled")){
			document.getElementsByClassName('menu-toggle')[1].innerHTML = "<i class='fa fa-toggle-right'> </i>";
		}
		else{
			document.getElementsByClassName('menu-toggle')[1].innerHTML = "<i class='fa fa-toggle-left'> </i>";
		}
	});
	
	$('.dashSwitch').on('switchChange.bootstrapSwitch', function (event, state) {
		if(state){
			var request = $.ajax({
				url : 'includes/php/home/dashboardLock/toggleLock.php',
				type : "POST",
				data: {
					state: 1
				}
			});
		}
		else{
			var request = $.ajax({
				url : 'includes/php/home/dashboardLock/toggleLock.php',
				type : "POST",
				data: {
					state: 0
				}
			});
		}
	});
});

function ConvertSCPlaylist(data){
	if((/\d{8}/.exec(data))){
		return (/\d{8}/.exec(data));
	}
	else if((/\d{9}/.exec(data))){
		return (/\d{9}/.exec(data));
	}
	else {
		return "";
	}
}

function ConvertSCTrack(data){
	if((/\d{9}/.exec(data))){
		return (/\d{9}/.exec(data));
	}
	else {
		return "";
	}
}

//---- CALENDER ----//

function toggleCalendarType(index, date, id){
	for(i = 0; i < document.getElementsByClassName('calendarType').length; i++){
		document.getElementsByClassName('calendarType')[i].style.display = "none";
	}
	document.getElementsByClassName('calendarType')[index].style.display = "block";
	
	if(index == 0){
		var dateObj = new Date();
		if(date == 0) date = String((dateObj.getMonth() + 1) + "/" + dateObj.getFullYear());
		
		date = date.split("/");
		var request = $.ajax({
			url : 'includes/php/calendar/loadCalendar.php',
			type : "POST",
			data: {
				month: date[0], 
				year: date[1]
			}
		});
		
		request.done(function(msg) {
			document.getElementsByClassName('calendarTable')[index].innerHTML = msg;
		});
	}
	else if(index == 1){
		var dateObj = new Date();
		if(date == 0) date = String((dateObj.getMonth() + 1) + "/" + dateObj.getFullYear());
		
		date = date.split("/");
		var request = $.ajax({
			url : 'includes/php/calendar/loadDay.php',
			type : "POST",
			data: {
				day: date[0],
				month: date[1], 
				year: date[2]
			}
		});
		
		request.done(function(msg) {
			document.getElementsByClassName('calendarTable')[index].innerHTML = msg;
		});
	}
	else if(index == 2){
		var dateObj = new Date();
		if(date == 0) date = String((dateObj.getMonth() + 1) + "/" + dateObj.getFullYear());
		
		date = date.split("/");
		var request = $.ajax({
			url : 'includes/php/calendar/loadNew.php',
			type : "POST",
			data: {
				day: date[0],
				month: date[1], 
				year: date[2]
			}
		});
		
		request.done(function(msg) {
			document.getElementsByClassName('calendarTable')[index].innerHTML = msg;
		});
	}
	else if(index == 3){
		var dateObj = new Date();
		if(date == 0) date = String((dateObj.getMonth() + 1) + "/" + dateObj.getFullYear());
		
		date = date.split("/");
		var request = $.ajax({
			url : 'includes/php/calendar/loadEvent.php',
			type : "POST",
			data: {
				id: id,
				day: date[0],
				month: date[1], 
				year: date[2]
			}
		});
		
		request.done(function(msg) {
			document.getElementsByClassName('calendarTable')[index].innerHTML = msg;
		});
	}
}

function changeCalendar(){
	console.log(document.getElementsByName('eventType')[0].value);
	if(document.getElementsByName('eventType')[0].value == "upload"){
		var eventUpload = prompt("Please choose the recipient/type of the upload.","i.e. GR (general release)");
		document.getElementsByName('eventUpload')[0].value = eventUpload;
	}
}

function updateCalendar(index, date, id){
	var errorMessage = "";
	if(document.getElementsByName('eventTitle')[0].value == "") errorMessage += "Please enter a value for the event title!\n";
	if(document.getElementsByName('eventTime')[0].value == "") errorMessage += "Please enter a value for the event time!\n";
	if(document.getElementsByName('eventMessage')[0].value == "") errorMessage += "Please enter a value for the event message!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	date = date.split("/");
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/calendar/updateEvent.php',
		type : "POST",
		data : {
			id: id,
			day: date[0],
			month: date[1],
			year: date[2],
			title: document.getElementsByName('eventTitle')[0].value,
			time: document.getElementsByName('eventTime')[0].value,
			info: document.getElementsByName('eventMessage')[0].value,
			type: document.getElementsByName('eventType')[0].value,
			upload: document.getElementsByName('eventUpload')[0].value
		}
	});
	
	request.done(function(msg) {
		loadCalendar(1, date, 0, "Successfully updated calendar event.");
	});
}

function newCalendar(index, date, id){
	var errorMessage = "";
	if(document.getElementsByName('eventTitle')[0].value == "") errorMessage += "Please enter a value for the event title!\n";
	if(document.getElementsByName('eventTime')[0].value == "") errorMessage += "Please enter a value for the event time!\n";
	if(document.getElementsByName('eventMessage')[0].value == "") errorMessage += "Please enter a value for the event message!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	date = date.split("/");
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/calendar/newEvent.php',
		type : "POST",
		data : {
			day: date[0],
			month: date[1],
			year: date[2],
			title: document.getElementsByName('eventTitle')[0].value,
			time: document.getElementsByName('eventTime')[0].value,
			info: document.getElementsByName('eventMessage')[0].value,
			type: document.getElementsByName('eventType')[0].value,
			upload: document.getElementsByName('eventUpload')[0].value
		}
	});
	
	request.done(function(msg) {
		loadCalendar(1, date, 0, "Successfully created calendar event.");
	});
}

function deleteCalendar(index, date, id){
	var conf = confirm("Are you sure you want to delete this calender event?");
	if(conf != true) return false;
	
	date = date.split("/");
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/calendar/deleteEvent.php',
		type : "POST",
		data : {
			id: id
		}
	});
	
	request.done(function(msg) {
		loadCalendar(1, date, 0, "Successfully deleted calendar event.");
	});
}

function loadCalendar(index, date, id, successString){
	date = String(date[0] + "/" + date[1] + "/" + date[2]);
	toggleCalendarType(index, date, id);
	$('[data-toggle="tooltip"]').tooltip();
	
	$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
	$(".navbar-ajax-progress .success").fadeOut(3000);
}

//---- STAFF / CLIENT CHAT ----//

function modalIsShown(id) {
	if($("#" + id).hasClass("in")){
		return true;
	}
	else return false;
}

var oldMessage = "";

function refreshChat(table, user_id, lastname, othername, id) {
	var request = $.ajax({
		url : 'includes/php/chat/loadMessage.php',
		type : "POST",
		data : {table: table , id: user_id, lastname: lastname, othername: othername}
	});
	
	request.done(function(msg) {
		if(oldMessage != msg){
			oldMessage = msg;
			$("#" + id).html(msg);
			document.getElementById(id).scrollTop = document.getElementById(id).scrollHeight;
		}
	});
}

var oldOnline = "";

function loadOnline(level, id){
	var request = $.ajax({
		url : 'includes/php/chat/countMessage.php',
		type : "POST",
		data: {level: level, id: id}
	});
	
	request.done(function(msg) {
		if(oldOnline != msg){
			oldOnline = msg;
			document.getElementsByClassName('online-drop')[0].innerHTML = msg;
		}
	});
}

function updateMessage(user_id, table){
	var request = $.ajax({
		url : 'includes/php/chat/updateMessage.php',
		type : "POST",
		data : {
			id: user_id,
			table: table
		}
	});
}

function loadChat(table){
	var request = $.ajax({
		url : 'includes/php/chat/loadChat.php',
		type : "POST",
		data : {
			table: table
		}
	});
}

//---- SETTINGS ----//

//---- NICKNAME ----//

function updateNickname(){
	var errorMessage = "";
	if(document.getElementsByName('nicknameName')[0].value == "") errorMessage += "Please enter a value for your nickname!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/settings/nickname/updateNickname.php',
		type : "POST",
		data : {
			id: document.getElementsByName('nicknameId')[0].value,
			nickname: document.getElementsByName('nicknameName')[0].value
		}
	});
	
	request.done(function(msg) {
		loadNickname("Successfully updated nickname.", document.getElementsByName('nicknameName')[0].value);
	});
}

function loadNickname(successString, newNickname){
	var request = $.ajax({
		url : 'includes/php/settings/nickname/loadNickname.php',
		type : "POST",
		data: {
			id: document.getElementsByName('nicknameUser')[0].value
		}
	});
	
	request.done(function(msg) {
		$('#updateNickname').html(msg);
		$('.navbar-brand').html("Welcome, "+newNickname);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

//---- PASSWORD ----//

function updatePassword(){
	var errorMessage = "";
	if(document.getElementsByName('oldPassword')[0].value == "") errorMessage += "Please enter a value for your old password!\n";
	if(document.getElementsByName('newPassword')[0].value == "") errorMessage += "Please enter both values for your new password!\n";
	if(document.getElementsByName('newPassword')[1].value == "") errorMessage += "Please enter both values for your new password!\n";
	if(document.getElementsByName('newPassword')[0].value != document.getElementsByName('newPassword')[1].value) errorMessage += "Please make sure both new passwords are the same!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/settings/password/updatePassword.php',
		type : "POST",
		data : {
			id: document.getElementsByName('passwordId')[0].value,
			oldPassword: document.getElementsByName('oldPassword')[0].value,
			newPassword: document.getElementsByName('newPassword')[0].value
		}
	});
	
	request.done(function(msg) {
		console.log(msg);
		if(msg == 'true'){
			loadPassword("Successfully updated Password.", 1);
		}
		else {
			loadPassword("ERROR! Password not compatible!", 0)
		}
	});
}

function loadPassword(successString, type){
	var request = $.ajax({
		url : 'includes/php/settings/password/loadPassword.php',
		type : "POST",
		data: {
			id: document.getElementsByName('passwordId')[0].value
		}
	});
	
	request.done(function(msg) {
		if(type) {
			$('#updatePassword').html(msg);
			$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
			$(".navbar-ajax-progress .success").fadeOut(3000);
		}
		else {
			$('.navbar-ajax-progress').html("<div class='error'>"+successString+"</div>");
			$(".navbar-ajax-progress .error").fadeOut(3000);
		}
		
		$('[data-toggle="tooltip"]').tooltip();
	});
}

//---- CONTACT  ----//

function updateContact(){
	var errorMessage = "";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/settings/contact/updateContact.php',
		type : "POST",
		data : {
			id: document.getElementsByName('contactId')[0].value,
			email: document.getElementsByName('emailInfo')[0].value,
			twitter: document.getElementsByName('twitterInfo')[0].value,
			linkedin: document.getElementsByName('linkedinInfo')[0].value,
			soundcloud: document.getElementsByName('soundcloudInfo')[0].value,
			about: document.getElementsByName('aboutInfo')[0].value
		}
	});
	
	request.done(function(msg) {
		loadContact("Successfully updated contact info.");
	});
}

function loadContact(successString){
	var request = $.ajax({
		url : 'includes/php/settings/contact/loadContact.php',
		type : "POST",
		data: {
			id: document.getElementsByName('contactId')[0].value
		}
	});
	
	request.done(function(msg) {
		$('#updateContact').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

//---- STAFF ALERTS ----//

function newStaffAlert(id){
	var errorMessage = "";
	if(document.getElementsByName('alertTitle')[id].value == "") errorMessage += "Please enter a value for the title!\n";
	if(document.getElementsByName('alertDesc')[id].value == "") errorMessage += "Please enter a value for the description!\n";
	if(document.getElementsByName('alertType')[id].value == "") errorMessage += "Please enter a value for the type!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/alerts/newAlert.php',
		type : "POST",
		data : {
			title : document.getElementsByName('alertTitle')[id].value,
			description: document.getElementsByName('alertDesc')[id].value,
			type: document.getElementsByName('alertType')[id].value,
			person: (document.getElementsByClassName('navbar-brand')[0].innerHTML).substring(9)
		}
	});
	
	request.done(function(msg) {
		loadStaffAlert("Successfully added alert message.");
	});
}

function updateStaffAlert(id){
	var errorMessage = "";
	if(document.getElementsByName('alertTitle')[id].value == "") errorMessage += "Please enter a value for the title!\n";
	if(document.getElementsByName('alertDesc')[id].value == "") errorMessage += "Please enter a value for the description!\n";
	if(document.getElementsByName('alertType')[id].value == "") errorMessage += "Please enter a value for the type!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/alerts/updateAlerts.php',
		type : "POST",
		data : {
			id: document.getElementsByName('alertId')[id].value,
			title : document.getElementsByName('alertTitle')[id].value,
			description: document.getElementsByName('alertDesc')[id].value,
			type: document.getElementsByName('alertType')[id].value,
			person: (document.getElementsByClassName('navbar-brand')[0].innerHTML).substring(9)
		}
	});
	
	request.done(function(msg) {
		loadStaffAlert("Successfully updated alert message.");
	});
}

function deleteStaffAlert(id){
	var conf = confirm("Are you sure you want to delete this alert message?");
	if(conf != true) return false;
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/alerts/deleteAlert.php',
		type : "POST",
		data : {
			id: document.getElementsByName('alertId')[id].value
		}
	});
	
	request.done(function(msg) {
		loadStaffAlert("Successfully deleted alert message.");
	});
}

function loadStaffAlert(successString){
	var request = $.ajax({
		url : 'includes/php/alerts/loadAlerts.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createAlerts').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

//---- STAFF LOGIN ----//

function newLogin(id){
	var errorMessage = "";
	if(document.getElementsByName('loginUser')[id].value == "") errorMessage += "Please enter a value for the username!\n";
	if(document.getElementsByName('loginNick')[id].value == "") errorMessage += "Please enter a value for the nickname!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var loginLock = 0;
	if(document.getElementsByName('loginLock')[id].checked) loginLock = 1;
	
	var request = $.ajax({
		url : 'includes/php/home/staffLogin/newLogin.php',
		type : "POST",
		data : {
			username: document.getElementsByName('loginUser')[id].value,
			nickname: document.getElementsByName('loginNick')[id].value,
			level: document.getElementsByName('loginDept')[id].value,
			contact: document.getElementsByName('loginContact')[id].value,
			lock: loginLock
		}
	});
	
	request.done(function(msg) {
		alert("LOGIN INFO: \nUsername = "+document.getElementsByName('loginUser')[id].value+" \nPassword: 'pasword'");
		loadLogin("Successfully added login.");
	});
}

function updateLogin(id){
	var errorMessage = "";
	if(document.getElementsByName('loginUser')[id].value == "") errorMessage += "Please enter a value for the username!\n";
	if(document.getElementsByName('loginNick')[id].value == "") errorMessage += "Please enter a value for the nickname!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var loginLock = 0;
	if(document.getElementsByName('loginLock')[id].checked) loginLock = 1;
	
	var request = $.ajax({
		url : 'includes/php/home/staffLogin/updateLogin.php',
		type : "POST",
		data : {
			id: document.getElementsByName('loginId')[id].value,
			username: document.getElementsByName('loginUser')[id].value,
			nickname: document.getElementsByName('loginNick')[id].value,
			level: document.getElementsByName('loginDept')[id].value,
			contact: document.getElementsByName('loginContact')[id].value,
			lock: loginLock
		}
	});
	
	request.done(function(msg) {
		loadLogin("Successfully updated login.");
	});
}

function deleteLogin(id){
	var conf = confirm("Are you sure you want to delete this login?");
	if(conf != true) return false;
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/home/staffLogin/deleteLogin.php',
		type : "POST",
		data : {
			id: document.getElementsByName('loginId')[id].value
		}
	});
	
	request.done(function(msg) {
		loadLogin("Successfully deleted login.");
	});
}

function loadLogin(successString){
	var request = $.ajax({
		url : 'includes/php/home/staffLogin/loadLogin.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createLogin').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

function deptLogin(id){
	var conf = confirm("Changing the department causes the login username to change.\nDo you want to continue?\n\n(Clicking cancel will cause value to reset)");
	if(conf == true) {
		var newTier = document.getElementsByName('loginDept')[id].value;
		var oldUsername = document.getElementsByName('loginUser')[id].value;
		var oldUsernameLength = document.getElementsByName('loginUser')[id].value.length;
		
		switch(newTier){
			case '1': document.getElementsByName('loginUser')[id].value = String("SLT" + oldUsername.substring(3, oldUsernameLength));
			break;
			case '2': document.getElementsByName('loginUser')[id].value = String("ADM" + oldUsername.substring(3, oldUsernameLength));
			break;
			case '3': document.getElementsByName('loginUser')[id].value = String("CNT" + oldUsername.substring(3, oldUsernameLength));
			break;
			case '4': document.getElementsByName('loginUser')[id].value = String("PRD" + oldUsername.substring(3, oldUsernameLength));
			break;
		}	
	}
}

//---- EDIT SITE ----//

//---- CAROUSEL ----//

function newTarousel(id){
	var errorMessage = "";
	if(document.getElementsByName('carouselOrder')[id].value == "") errorMessage += "Please enter a value for the order!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/carousel/newCarousel.php',
		type : "POST",
		data : {
			title: document.getElementsByName('carouselTitle')[id].value,
			description: document.getElementsByName('carouselDesc')[id].value,
			file: document.getElementsByName('carouselFile')[id].value,
			position: document.getElementsByName('carouselPosition')[id].value,
			order: document.getElementsByName('carouselOrder')[id].value,
			screenPos: document.getElementsByName('carouselScreenPos')[id].value
		}
	});
	
	request.done(function(msg) {
		loadCarousel("Successfully added Carousel.");
	});
}

function updateCarousel(id){
	var errorMessage = "";
	if(document.getElementsByName('carouselOrder')[id].value == "") errorMessage += "Please enter a value for the type!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/carousel/updateCarousel.php',
		type : "POST",
		data : {
			id: document.getElementsByName('carouselId')[id].value,
			title: document.getElementsByName('carouselTitle')[id].value,
			description: document.getElementsByName('carouselDesc')[id].value,
			file: document.getElementsByName('carouselFile')[id].value,
			position: document.getElementsByName('carouselPosition')[id].value,
			order: document.getElementsByName('carouselOrder')[id].value,
			screenPos: document.getElementsByName('carouselScreenPos')[id].value
		}
	});
	
	request.done(function(msg) {
		loadCarousel("Successfully updated Carousel.");
	});
}

function deleteCarousel(id){
	var conf = confirm("Are you sure you want to delete this carousel?");
	if(conf != true) return false;
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/carousel/deleteCarousel.php',
		type : "POST",
		data : {
			id: document.getElementsByName('carouselId')[id].value
		}
	});
	
	request.done(function(msg) {
		loadCarousel("Successfully deleted Carousel.");
	});
}

function loadCarousel(successString){
	var request = $.ajax({
		url : 'includes/php/site/carousel/loadCarousel.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createCarousel').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

//---- JOBS ----//

function newTacancies(id){
	var errorMessage = "";
	if(document.getElementsByName('vacanciesTitle')[id].value == "") errorMessage += "Please enter a value for the title!\n";
	if(document.getElementsByName('vacanciesDesc')[id].value == "") errorMessage += "Please enter a value for the description!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	var conf = confirm("If you accept this it will send an email to those subscribed to our notification system. Updating this entry will not re-send or update the email.");
	if(conf != true) return false;
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/vacancies/newVacancies.php',
		type : "POST",
		data : {
			title: document.getElementsByName('vacanciesTitle')[id].value,
			description: document.getElementsByName('vacanciesDesc')[id].value,
			department: document.getElementsByName('vacanciesDept')[id].value
		}
	});
	
	request.done(function(msg) {
		loadVacancies("Successfully added Job.");
	});
}

function updateVacancies(id){
	var errorMessage = "";
	if(document.getElementsByName('vacanciesTitle')[id].value == "") errorMessage += "Please enter a value for the title!\n";
	if(document.getElementsByName('vacanciesDesc')[id].value == "") errorMessage += "Please enter a value for the description!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/vacancies/updateVacancies.php',
		type : "POST",
		data : {
			id: document.getElementsByName('vacanciesId')[id].value,
			title: document.getElementsByName('vacanciesTitle')[id].value,
			description: document.getElementsByName('vacanciesDesc')[id].value,
			department: document.getElementsByName('vacanciesDept')[id].value
		}
	});
	
	request.done(function(msg) {
		loadVacancies("Successfully updated Job.");
	});
}

function deleteVacancies(id){
	var conf = confirm("Are you sure you want to delete this job?");
	if(conf != true) return false;
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/vacancies/deleteVacancies.php',
		type : "POST",
		data : {
			id: document.getElementsByName('vacanciesId')[id].value
		}
	});
	
	request.done(function(msg) {
		loadVacancies("Successfully deleted Carousel.");
	});
}

function loadVacancies(successString){
	var request = $.ajax({
		url : 'includes/php/site/vacancies/loadVacancies.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createVacancies').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

//---- PEOPLE ----//

function updatePeople(id){
	var errorMessage = "";
	if(document.getElementsByName('peopleName')[id].value == "") errorMessage += "Please enter a value for the name!\n";
	if(document.getElementsByName('peopleTitle')[id].value == "") errorMessage += "Please enter a value for the title!\n";
	if(document.getElementsByName('peopleOrder')[id].value == "") errorMessage += "Please enter a value for the order!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/people/updatePeople.php',
		type : "POST",
		data : {
			id: document.getElementsByName('peopleId')[id].value,
			name: document.getElementsByName('peopleName')[id].value,
			title: document.getElementsByName('peopleTitle')[id].value,
			img: document.getElementsByName('peopleImg')[id].value,
			order: document.getElementsByName('peopleOrder')[id].value,
			about: document.getElementsByName('peopleDesc')[id].value
		}
	});
	
	request.done(function(msg) {
		loadPeople("Successfully updated Person.");
	});
}

function loadPeople(successString){
	var request = $.ajax({
		url : 'includes/php/site/people/loadPeople.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createPeople').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

//---- LIBRARY ----//

function newLibrary(id){
	var errorMessage = "";
	if(document.getElementsByName('libraryTrack')[id].value == "") errorMessage += "Please enter a value for the track!\n";
	if(document.getElementsByName('libraryArtist')[id].value == "") errorMessage += "Please enter a value for the artist!\n";
	if(document.getElementsByName('libraryGenre')[id].value == "") errorMessage += "Please enter a value for the genre!\n";
	if(document.getElementsByName('libraryDate')[id].value == "") errorMessage += "Please enter a value for the date!\n";
	if(document.getElementsByName('libraryTags')[id].value == "") errorMessage += "Please enter a value for the tags!\n";
	if(document.getElementsByName('librarySCLink')[id].value == "") errorMessage += "Please enter a value for the SoundCloud Track!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var libraryFavourite = 0;
	if(document.getElementsByName('libraryFavourite')[id].checked) libraryFavourite = 1;
	
	var request = $.ajax({
		url : 'includes/php/site/library/newLibrary.php',
		type : "POST",
		data : {
			track: document.getElementsByName('libraryTrack')[id].value,
			artist: document.getElementsByName('libraryArtist')[id].value,
			genre: document.getElementsByName('libraryGenre')[id].value,
			date: document.getElementsByName('libraryDate')[id].value,
			tags: document.getElementsByName('libraryTags')[id].value,
			favourite: libraryFavourite,
			SCLink: document.getElementsByName('librarySCLink')[id].value
		}
	});
	
	request.done(function(msg) {
		loadLibrary("Successfully added Track.");
	});
}

function updateLibrary(id){
	var errorMessage = "";
	if(document.getElementsByName('libraryTrack')[id].value == "") errorMessage += "Please enter a value for the track!\n";
	if(document.getElementsByName('libraryArtist')[id].value == "") errorMessage += "Please enter a value for the artist!\n";
	if(document.getElementsByName('libraryGenre')[id].value == "") errorMessage += "Please enter a value for the genre!\n";
	if(document.getElementsByName('libraryDate')[id].value == "") errorMessage += "Please enter a value for the date!\n";
	if(document.getElementsByName('libraryTags')[id].value == "") errorMessage += "Please enter a value for the tags!\n";
	if(document.getElementsByName('librarySCLink')[id].value == "") errorMessage += "Please enter a value for the SoundCloud Track!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var libraryFavourite = 0;
	if(document.getElementsByName('libraryFavourite')[id].checked) libraryFavourite = 1;
	
	var request = $.ajax({
		url : 'includes/php/site/library/updateLibrary.php',
		type : "POST",
		data : {
			id: document.getElementsByName('libraryId')[id].value,
			track: document.getElementsByName('libraryTrack')[id].value,
			artist: document.getElementsByName('libraryArtist')[id].value,
			genre: document.getElementsByName('libraryGenre')[id].value,
			date: document.getElementsByName('libraryDate')[id].value,
			tags: document.getElementsByName('libraryTags')[id].value,
			favourite: libraryFavourite,
			SCLink: document.getElementsByName('librarySCLink')[id].value
		}
	});
	
	request.done(function(msg) {
		loadLibrary("Successfully updated Track.");
	});
}

function deleteLibrary(id){
	var conf = confirm("Are you sure you want to delete this track?");
	if(conf != true) return false;
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/library/deleteLibrary.php',
		type : "POST",
		data : {
			id: document.getElementsByName('libraryId')[id].value
		}
	});
	
	request.done(function(msg) {
		loadLibrary("Successfully deleted Track.");
	});
}

function loadLibrary(successString){
	var request = $.ajax({
		url : 'includes/php/site/library/loadLibrary.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createLibrary').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

//---- SFX ----//

function newTfx(id){
	var errorMessage = "";
	if(document.getElementsByName('sfxEffect')[id].value == "") errorMessage += "Please enter a value for the effect!\n";
	if(document.getElementsByName('sfxDate')[id].value == "") errorMessage += "Please enter a value for the date!\n";
	if(document.getElementsByName('sfxTags')[id].value == "") errorMessage += "Please enter a value for the tags!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/sfx/newSfx.php',
		type : "POST",
		data : {
			effect: document.getElementsByName('sfxEffect')[id].value,
			date: document.getElementsByName('sfxDate')[id].value,
			tags: document.getElementsByName('sfxTags')[id].value,
			directory: document.getElementsByName('sfxDirectory')[id].value
		}
	});
	
	request.done(function(msg) {
		loadSfx("Successfully added Sound Effect.");
	});
}

function updateSfx(id){
	var errorMessage = "";
	if(document.getElementsByName('sfxEffect')[id].value == "") errorMessage += "Please enter a value for the effect!\n";
	if(document.getElementsByName('sfxDate')[id].value == "") errorMessage += "Please enter a value for the date!\n";
	if(document.getElementsByName('sfxTags')[id].value == "") errorMessage += "Please enter a value for the tags!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/sfx/updateSfx.php',
		type : "POST",
		data : {
			id: document.getElementsByName('sfxId')[id].value,
			effect: document.getElementsByName('sfxEffect')[id].value,
			date: document.getElementsByName('sfxDate')[id].value,
			tags: document.getElementsByName('sfxTags')[id].value,
			directory: document.getElementsByName('sfxDirectory')[id].value
		}
	});
	
	request.done(function(msg) {
		loadSfx("Successfully updated Sound Effect.");
	});
}

function deleteSfx(id){
	var conf = confirm("Are you sure you want to delete this sound effect?");
	if(conf != true) return false;
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/sfx/deleteSfx.php',
		type : "POST",
		data : {
			id: document.getElementsByName('sfxId')[id].value
		}
	});
	
	request.done(function(msg) {
		loadSfx("Successfully deleted SoundEffect.");
	});
}

function loadSfx(successString){
	var request = $.ajax({
		url : 'includes/php/site/sfx/loadSfx.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createSfx').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

//---- PORTFOLIO ----//

function newPortfolio(id){
	var errorMessage = "";
	if(document.getElementsByName('portfolioName')[id].value == "") errorMessage += "Please enter a value for the name!\n";
	if(document.getElementsByName('portfolioDesc')[id].value == "") errorMessage += "Please enter a value for the description!\n";
	if(document.getElementsByName('portfolioTier')[id].value == "") errorMessage += "Please enter a value for the tier number!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/portfolio/newPortfolio.php',
		type : "POST",
		data : {
			name: document.getElementsByName('portfolioName')[id].value,
			desc: document.getElementsByName('portfolioDesc')[id].value,
			quote: document.getElementsByName('portfolioQuote')[id].value,
			logo: document.getElementsByName('portfolioLogo')[id].value,
			trackNum: document.getElementsByName('portfolioTrackNo')[id].value,
			tier: document.getElementsByName('portfolioTier')[id].value,
			type: document.getElementsByName('portfolioType')[id].value
		}
	});
	
	request.done(function(msg) {
		loadPortfolio("Successfully added Client.");
	});
}

function updatePortfolio(id){
	var errorMessage = "";
	if(document.getElementsByName('portfolioName')[id].value == "") errorMessage += "Please enter a value for the name!\n";
	if(document.getElementsByName('portfolioDesc')[id].value == "") errorMessage += "Please enter a value for the description!\n";
	if(document.getElementsByName('portfolioTier')[id].value == "") errorMessage += "Please enter a value for the tier number!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/portfolio/updatePortfolio.php',
		type : "POST",
		data : {
			id: document.getElementsByName('portfolioId')[id].value,
			oldName: document.getElementsByName('portfolioOldName')[id].value,
			name: document.getElementsByName('portfolioName')[id].value,
			desc: document.getElementsByName('portfolioDesc')[id].value,
			quote: document.getElementsByName('portfolioQuote')[id].value,
			logo: document.getElementsByName('portfolioLogo')[id].value,
			trackNum: document.getElementsByName('portfolioTrackNo')[id].value,
			tier: document.getElementsByName('portfolioTier')[id].value,
			type: document.getElementsByName('portfolioType')[id].value
		}
	});
	
	request.done(function(msg) {
		loadPortfolio("Successfully updated Client.");
	});
}

function updatePortfolioLinks(id){
	var errorMessage = "";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/portfolio/updatePortfolioLinks.php',
		type : "POST",
		data : {
			id: document.getElementsByName('portfolioLId')[id].value,
			site: document.getElementsByName('portfolioSite')[id].value,
			SCLink: document.getElementsByName('portfolioSCLink')[id].value,
			youtube: document.getElementsByName('portfolioYoutube')[id].value,
			twitter: document.getElementsByName('portfolioTwitter')[id].value,
			soundcloud: document.getElementsByName('portfolioSoundcloud')[id].value,
			facebook: document.getElementsByName('portfolioFacebook')[id].value
		}
	});
	
	request.done(function(msg) {
		loadPortfolio("Successfully updated Client.");
	});
}

function deletePortfolio(id){
	var conf = confirm("Are you sure you want to delete this client?");
	if(conf != true) return false;
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/site/portfolio/deletePortfolio.php',
		type : "POST",
		data : {
			id: document.getElementsByName('portfolioId')[id].value
		}
	});
	
	request.done(function(msg) {
		loadPortfolio("Successfully deleted Client.");
	});
}

function loadPortfolio(successString){
	var request = $.ajax({
		url : 'includes/php/site/portfolio/loadPortfolio.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createPortfolio').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
	
	var request = $.ajax({
		url : 'includes/php/site/portfolio/loadPortfolioLinks.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createPortfolioLinks').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

//---- EDIT DASHBOARD ----//

//---- CLIENTS ----//

function newTlient(id){
	var errorMessage = "";
	if(document.getElementsByName('clientUsername')[id].value == "") errorMessage += "Please enter a value for the username!\n";
	if(document.getElementsByName('clientNickname')[id].value == "") errorMessage += "Please enter a value for the nickname!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	var loginLock = 0;
	if(document.getElementsByName('clientLock')[id].checked) loginLock = 1;
	
	var request = $.ajax({
		url : 'includes/php/dash/clients/newClient.php',
		type : "POST",
		data : {
			username: document.getElementsByName('clientUsername')[id].value,
			nickname: document.getElementsByName('clientNickname')[id].value,
			tier: document.getElementsByName('clientTier')[id].value,
			contact: document.getElementsByName('clientContact')[id].value,
			lock: loginLock
		}
	});
	
	request.done(function(msg) {
		alert("LOGIN INFO: \nUsername = "+document.getElementsByName('clientUsername')[id].value+" \nPassword: 'pasword'");
		loadClient("Successfully added client.");
	});
}

function updateClient(id){
	var errorMessage = "";
	if(document.getElementsByName('clientUsername')[id].value == "") errorMessage += "Please enter a value for the username!\n";
	if(document.getElementsByName('clientNickname')[id].value == "") errorMessage += "Please enter a value for the nickname!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	var loginLock = 0;
	if(document.getElementsByName('clientLock')[id].checked) loginLock = 1;
	
	var request = $.ajax({
		url : 'includes/php/dash/clients/updateClient.php',
		type : "POST",
		data : {
			id: document.getElementsByName('clientId')[id].value,
			username: document.getElementsByName('clientUsername')[id].value,
			nickname: document.getElementsByName('clientNickname')[id].value,
			tier: document.getElementsByName('clientTier')[id].value,
			contact: document.getElementsByName('clientContact')[id].value,
			lock: loginLock
		}
	});
	
	request.done(function(msg) {
		loadClient("Successfully updated client.");
	});
}

function deleteClient(id){
	var conf = confirm("Are you sure you want to delete this client?\nAll connected database data will be deleted,however files will remain in the system.");
	if(conf != true) return false;
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/dash/clients/deleteClient.php',
		type : "POST",
		data : {
			id: document.getElementsByName('clientId')[id].value
		}
	});
	
	request.done(function(msg) {
		loadClient("Successfully deleted client.");
	});
}

function loadClient(successString){
	var request = $.ajax({
		url : 'includes/php/dash/clients/loadClient.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createClients').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
	
	loadCommission(successString);
	loadClientAlert(successString);
}

function tierClient(id, check){
	if(check == true){
		var conf = confirm("Changing the tier causes the client username to change.\nDo you want to continue?\n\n(Clicking cancel will cause value to reset)");
		if(conf != true) {
			var newTier = document.getElementsByName('clientTier')[id].value;
			
			if(newTier == 10) document.getElementsByName('clientTier')[id].selectedIndex = "1";
			else if(newTier == 11) document.getElementsByName('clientTier')[id].selectedIndex = "0";
			
			return false;
		}
		else {
			var newTier = document.getElementsByName('clientTier')[id].value;
			var oldUsername = document.getElementsByName('clientUsername')[id].value;
			var oldUsernameLength = document.getElementsByName('clientUsername')[id].value.length;
			
			if(newTier == 10) document.getElementsByName('clientUsername')[id].value = oldUsername.substring(0, oldUsernameLength - 1) + "2";
			else if(newTier == 11) document.getElementsByName('clientUsername')[id].value = oldUsername.substring(0, oldUsernameLength - 1) + "3";
		}
	}
	else {
		var newTier = document.getElementsByName('clientTier')[id].value;
		var oldUsername = document.getElementsByName('clientUsername')[id].value;
		var oldUsernameLength = document.getElementsByName('clientUsername')[id].value.length;
		
		if(newTier == 10) document.getElementsByName('clientUsername')[id].value = oldUsername.substring(0, oldUsernameLength - 1) + "2";
		else if(newTier == 11) document.getElementsByName('clientUsername')[id].value = oldUsername.substring(0, oldUsernameLength - 1) + "3";
	}
	
}

//---- COMMISSION ----//

function updateCommission(id){
	var errorMessage = "";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/dash/commission/updateComm.php',
		type : "POST",
		data : {
			login_id: document.getElementsByName('commClient')[id].value,
			manager: document.getElementsByName('commManager')[id].value,
			phase: document.getElementsByName('commPhase')[id].value,
			download: document.getElementsByName('commDownload')[id].value,
			complete: document.getElementsByName('commComplete')[id].value
		}
	});
	
	request.done(function(msg) {
		loadCommission("Successfully updated client commission.");
	});
}

function loadCommission(successString){
	var request = $.ajax({
		url : 'includes/php/dash/commission/loadComm.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createCommission').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

function updateCommissionStats(id){
	var errorMessage = "";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/dash/commission/updateCommStats.php',
		type : "POST",
		data : {
			login_id: document.getElementsByName('commClient')[id].value,
			sDate: document.getElementsByName('commSDate')[id].value,
			eDate: document.getElementsByName('commEDate')[id].value,
			invNum: document.getElementsByName('commINum')[id].value,
			invLink: document.getElementsByName('commIDown')[id].value
		}
	});
	
	request.done(function(msg) {
		loadCommissionStats("Successfully updated client commission.");
	});
}

function loadCommissionStats(successString){
	var request = $.ajax({
		url : 'includes/php/dash/commission/loadCommStats.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createCommission').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

//---- CLIENT ALERTS ----//

function newClientAlert(id){
	var errorMessage = "";
	if(document.getElementsByName('alertTitle')[id].value == "") errorMessage += "Please enter a value for the title!\n";
	if(document.getElementsByName('alertDesc')[id].value == "") errorMessage += "Please enter a value for the description!\n";
	if(document.getElementsByName('alertType')[id].value == "") errorMessage += "Please enter a value for the type!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/dash/alerts/newAlert.php',
		type : "POST",
		data : {
			title : document.getElementsByName('alertTitle')[id].value,
			description: document.getElementsByName('alertDesc')[id].value,
			type: document.getElementsByName('alertType')[id].value,
			destination: document.getElementsByName('alertDest')[id].value,
			person: (document.getElementsByClassName('navbar-brand')[0].innerHTML).substring(9)
		}
	});
	
	request.done(function(msg) {
		loadClientAlert("Successfully added alert message.");
	});
}

function updateClientAlert(id){
	var errorMessage = "";
	if(document.getElementsByName('alertTitle')[id].value == "") errorMessage += "Please enter a value for the title!\n";
	if(document.getElementsByName('alertDesc')[id].value == "") errorMessage += "Please enter a value for the description!\n";
	if(document.getElementsByName('alertType')[id].value == "") errorMessage += "Please enter a value for the type!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/dash/alerts/updateAlerts.php',
		type : "POST",
		data : {
			id: document.getElementsByName('alertId')[id].value,
			title : document.getElementsByName('alertTitle')[id].value,
			description: document.getElementsByName('alertDesc')[id].value,
			type: document.getElementsByName('alertType')[id].value,
			destination: document.getElementsByName('alertDest')[id].value,
			person: (document.getElementsByClassName('navbar-brand')[0].innerHTML).substring(9)
		}
	});
	
	request.done(function(msg) {
		loadClientAlert("Successfully updated alert message.");
	});
}

function deleteClientAlert(id){
	var conf = confirm("Are you sure you want to delete this alert message?");
	if(conf != true) return false;
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/dash/alerts/deleteAlert.php',
		type : "POST",
		data : {
			id: document.getElementsByName('alertId')[id].value
		}
	});
	
	request.done(function(msg) {
		loadClientAlert("Successfully deleted alert message.");
	});
}

function loadClientAlert(successString){
	var request = $.ajax({
		url : 'includes/php/dash/alerts/loadAlerts.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createAlerts').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

//---- CLIENT TRACKS ----//

function newBrack(id){
	var errorMessage = "";
	if(document.getElementsByName('trackName')[id].value == "") errorMessage += "Please enter a value for the name!\n";
	if(document.getElementsByName('trackEnd')[id].value == "") errorMessage += "Please enter a value for the end date!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/dash/tracks/newTracks.php',
		type : "POST",
		data : {
			name: document.getElementsByName('trackName')[id].value,
			login: document.getElementsByName('trackClient')[id].value,
			status: document.getElementsByName('trackStatus')[id].value,
			eDate: document.getElementsByName('trackEnd')[id].value,
			download: document.getElementsByName('trackSample')[id].value
		}
	});
	
	request.done(function(msg) {
		loadTrack("Successfully added track.");
	});
}

function updateTrack(id){
	var errorMessage = "";
	if(document.getElementsByName('trackName')[id].value == "") errorMessage += "Please enter a value for the name!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/dash/tracks/updateTracks.php',
		type : "POST",
		data : {
			id: document.getElementsByName('trackId')[id].value,
			name: document.getElementsByName('trackName')[id].value,
			login: document.getElementsByName('trackClient')[id].value,
			status: document.getElementsByName('trackStatus')[id].value,
			eDate: document.getElementsByName('trackEnd')[id].value,
			download: document.getElementsByName('trackSample')[id].value
		}
	});
	
	request.done(function(msg) {
		loadTrack("Successfully updated track.");
	});
}

function deleteTrack(id){
	var conf = confirm("Are you sure you want to delete this track?\nAll producers connected to this track will have their 'time spent' removed as well.");
	if(conf != true) return false;
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/dash/tracks/deleteTracks.php',
		type : "POST",
		data : {
			id: document.getElementsByName('trackId')[id].value
		}
	});
	
	request.done(function(msg) {
		loadTrack("Successfully deleted track.");
	});
}

function loadTrack(successString){
	var request = $.ajax({
		url : 'includes/php/dash/tracks/loadTracks.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createTracks').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		loadProducer(successString);
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

//---- PRODUCERS ----//

function newTroducer(id){
	var errorMessage = "";
	if(document.getElementsByName('producerTime')[id].value == "") errorMessage += "Please enter a value for the time spent!\n";
	if((document.getElementsByName('producerTime')[id].value).match(/[a-z]/i)) errorMessage += "Please remove all alphabetical letters from time spent!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/dash/producers/newProducers.php',
		type : "POST",
		data : {
			track: document.getElementsByName('producerTrack')[id].value,
			producer: document.getElementsByName('producerStaff')[id].value,
			time: document.getElementsByName('producerTime')[id].value
		}
	});
	
	request.done(function(msg) {
		loadProducer("Successfully added Producer.");
	});
}

function updateProducer(id){
	var errorMessage = "";
	if(document.getElementsByName('producerTime')[id].value == "") errorMessage += "Please enter a value for the time spent!\n";
	if((document.getElementsByName('producerTime')[id].value).match(/[a-z]/i)) errorMessage += "Please remove all alphabetical letters from time spent!\n";
	if(!errorMessage == "") {alert(errorMessage); return false;}
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/dash/producers/updateProducers.php',
		type : "POST",
		data : {
			id: document.getElementsByName('producerId')[id].value,
			track: document.getElementsByName('producerTrack')[id].value,
			producer: document.getElementsByName('producerStaff')[id].value,
			time: document.getElementsByName('producerTime')[id].value
		}
	});
	
	request.done(function(msg) {
		loadProducer("Successfully updated Producer.");
	});
}

function deleteProducer(id){
	var conf = confirm("Are you sure you want to delete this producer?");
	if(conf != true) return false;
	
	$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
	
	var request = $.ajax({
		url : 'includes/php/dash/producers/deleteProducers.php',
		type : "POST",
		data : {
			id: document.getElementsByName('producerId')[id].value
		}
	});
	
	request.done(function(msg) {
		loadProducer("Successfully deleted Producer.");
	});
}

function loadProducer(successString){
	var request = $.ajax({
		url : 'includes/php/dash/producers/loadProducers.php',
		type : "POST"
	});
	
	request.done(function(msg) {
		$('#createProducers').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

//---- CLIENT INFO ----//

function loadClientInfo(offset){
	var request = $.ajax({
		url : 'includes/php/dash/info/loadInfo.php',
		type : "POST",
		data: {
			offset: offset
		}
	});
	
	request.done(function(msg) {
		$('.clientInfo:eq(0)').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		if(document.getElementsByName('chosenClient')[0].value != "0") loadClientInfoTabs(document.getElementsByName('chosenClient')[0].value);
		if(typeof $('.list-group-item.active span#user').html() != "undefined") $('.clientInfoHead').html($('.list-group-item.active span#user').html());
	});
}

function loadClientInfoTabs(id){
	document.getElementsByName('chosenClient')[0].value = id;
	var request = $.ajax({
		url : 'includes/php/dash/info/loadInfoTabs.php',
		type : "POST",
		data : {
			id: id
		}
	});
	
	request.done(function(msg) {
		$('.clientInfo:eq(1)').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
	
		loadTrackInfo(id, 0);
		loadClientInfoProduction(id, 0);
		
		loadExtraMessages = "0";
		lastChatMessages = "";
		loadInfoChatMessages(id, 0);
		
		if(typeof $('.list-group-item.active span#user').html() != "undefined") $('.clientInfoHead').html($('.list-group-item.active span#user').html());
	});
}

//---- CLIENT TRACKS ----//

function updateTrackInfo(id, clientId){
	var request = $.ajax({
		url : 'includes/php/dash/tracks/updateInfoTracks.php',
		type : "POST",
		data : {
			id: document.getElementsByName('trackId')[id].value,
			staff: document.getElementsByName('trackInfo')[id].value
		}
	});
	
	request.done(function(msg) {
		loadTrackInfo(clientId,1);
		$('[data-toggle="tooltip"]').tooltip();
	});
}

function loadTrackInfo(id, successString){
	var request = $.ajax({
		url : 'includes/php/dash/tracks/loadInfoTracks.php',
		type : "POST",
		data : {
			id: id
		}
	});
	
	request.done(function(msg) {
		$('.clientInfoContent:eq(0)').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		if(successString){
			$('.navbar-ajax-progress').html("<div class='success'>Successfully update track info.</div>");
			$(".navbar-ajax-progress .success").fadeOut(3000);
		}
	});
}

//---- CLIENT PRODUCTION ----//

function loadClientInfoProduction(id, rest){
	var request = $.ajax({
		url : 'includes/php/dash/production/productionTable.php',
		type : "POST",
		data : {
			id: id,
			rest: rest
		}
	});
	
	request.done(function(msg) {
		$('.clientInfoContent:eq(1)').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
	});
}

//---- CLIENT MESSAGING ----//

function sendInfoUserMessage(id){
	if(document.userMessage.userMessageTextarea.value == ""){
		$(document.getElementsByClassName('main-chat-footer')[0].children[1]).addClass("btn-danger");
		setTimeout(function(){$(document.getElementsByClassName('main-chat-footer')[0].children[1]).removeClass("btn-danger");},3000);
	}
	else{
		var request = $.ajax({
			url : 'includes/php/dash/messaging/sendMessages.php',
			type : "POST",
			data : {
				table: document.userMessage.userMessageTableId.value,
				from: document.userMessage.userMessageUserId.value,
				message: document.userMessage.userMessageTextarea.value
			}
		});
		request.done(function(msg) {
			loadInfoChatMessages(id, loadExtraMessages);
		});
		
		$(document.getElementsByClassName('main-chat-footer')[0].children[1]).addClass("btn-success");
		$(document.getElementsByClassName('main-chat-footer')[0].children[0]).val("");
		setTimeout(function(){$(document.getElementsByClassName('main-chat-footer')[0].children[1]).removeClass("btn-success");},3000);
		document.getElementsByClassName('main-chat-body')[0].scrollTop = document.getElementsByClassName('main-chat-body')[0].scrollHeight;
	}
}

var loadExtraMessages = "0";
var lastChatMessages = "";
function loadInfoChatMessages(id, load){
	if(load == "2") loadExtraMessages = loadExtraMessages;
	else loadExtraMessages = load;
	
	var request = $.ajax({
		url : 'includes/php/dash/messaging/loadMessages.php',
		type : "POST",
		data : {
			id, id,
			loadRest: loadExtraMessages
		}
	});
	request.done(function(msg) {
		if(lastChatMessages != msg){
			$('.clientInfoContent:eq(2)').html(msg);
			
			if(loadExtraMessages == "0") document.getElementsByClassName('main-chat-body')[0].scrollTop = document.getElementsByClassName('main-chat-body')[0].scrollHeight;
			lastChatMessages = msg;
		}
	});
}

function updateInfoSeenMessages(){
	var request = $.ajax({
		url : 'includes/php/dash/messaging/updateSeenMessage.php',
		type : "POST",
		data : {
			table: document.getElementsByName('userMessageTableId')[0].value,
			id: document.getElementsByName('userMessageUserId')[0].value
		}
	});
}
