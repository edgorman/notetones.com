$(document).ready(function(){
	$(".menu-toggle").click(function(e) {
		e.preventDefault();
		$(".container-wrapper").toggleClass("toggled");
		$(".sidebar-toggle").toggleClass("toggled");
	});
	
	$('[data-toggle="tooltip"]').tooltip();
});

var preventReloadPage = false;
window.onbeforeunload = function (e) {
	if(preventReloadPage) return "There may be work that is not saved.";
};

$(document).on('click', '.audiojs .play-pause', function(e){
	var audio = document.getElementsByClassName('audiojs');
	var audioParent = this.parentElement;
	
	for(i = 0; i < audio.length; i++){
		if(audio[i] != audioParent && (e.screenX && e.screenX != 0 && e.screenY && e.screenY != 0)){
			if(!audio[i].children[0].paused){
				$(audio[i].children[1]).click();
			}
		}
	}
});

//---- STAFF / CLIENT CHAT ----//

function sendUserMessage(){
	if(document.userMessage.userMessageTextarea.value == ""){		$(document.getElementsByClassName('main-chat-footer')[0].children[1]).addClass("btn-danger");
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
			loadChatMessages(loadExtraMessages);
		});
		
		$(document.getElementsByClassName('main-chat-footer')[0].children[1]).addClass("btn-success");
		$(document.getElementsByClassName('main-chat-footer')[0].children[0]).val("");
		setTimeout(function(){$(document.getElementsByClassName('main-chat-footer')[0].children[1]).removeClass("btn-success");},3000);
		document.getElementsByClassName('main-chat-body')[0].scrollTop = document.getElementsByClassName('main-chat-body')[0].scrollHeight;
	}
}

var loadExtraMessages = "0";
var lastChatMessages = "";
function loadChatMessages(load){
	if(load == "2") loadExtraMessages = loadExtraMessages;
	else loadExtraMessages = load;
	
	var request = $.ajax({
		url : 'includes/php/dash/messaging/loadMessages.php',
		type : "POST",
		data : {
			loadRest: loadExtraMessages
		}
	});
	request.done(function(msg) {
		if(lastChatMessages != msg){
			$('.main-chat-body').html(msg);
			if(loadExtraMessages == "0") document.getElementsByClassName('main-chat-body')[0].scrollTop = document.getElementsByClassName('main-chat-body')[0].scrollHeight;
			lastChatMessages = msg;
		}
	});
}

function updateSeenMessages(){
	var request = $.ajax({
		url : 'includes/php/dash/messaging/updateSeenMessage.php',
		type : "POST",
		data : {
			table: document.getElementsByName('userMessageTableId')[0].value,
			id: document.getElementsByName('userMessageUserId')[0].value
		}
	});
}

//---- MAIN ----//

//---- NEW TRACK ----//

function createNewTrack(){
	var newTrackErrors = false;
	var newTrackMsgs = "";
	
	if(document.newTrack.trackName.value == ""){
		newTrackErrors = true;
		newTrackMsgs += "The name of the track.\n";
	}
	
	if(document.newTrack.trackLength.value == ""){
		newTrackErrors = true;
		newTrackMsgs += "The estimated time of the track.\n";
	}
	
	if(document.newTrack.trackDesc.value == ""){
		newTrackErrors = true;
		newTrackMsgs += "The description of the track.\n";
	}
	
	if(newTrackErrors){
		alert("Please confirm you have entered a valid value for:\n\n" + newTrackMsgs + "\nThen you will be allowed to complete this form.");
		return false;
	}
	else{
		$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
		
		var request = $.ajax({
			url : 'includes/php/dash/tracks/newTracks.php',
			type : "POST",
			data: {
				commId: document.newTrack.commId.value,
				name: document.newTrack.trackName.value,
				endDate: document.newTrack.trackLength.value,
				clientInfo: document.newTrack.trackDesc.value
			}
		});
		
		request.done(function(msg) {
			loadTracks("Successfully added track to your commission");
		});
		
		document.newTrack.reset();
		preventReloadPage = false;
		$('#newTrack').modal('hide');
		
		return true;
	}
	
}

$(document).on('hide.bs.modal','#newTrack', function () {
	if(!(document.newTrack.trackName.value == "" && document.newTrack.trackLength.value == "" && document.newTrack.trackDesc.value == "")){
		document.getElementById('newTrackDraft').style.display = "block";
		preventReloadPage = true;
	}
	else{
		document.getElementById('newTrackDraft').style.display = "none";
		preventReloadPage = false;
	}
});

//---- EDIT TRACK ----//

function updateOldTrack(id, save){
	if((document.getElementsByClassName('commission-single')[id].className).indexOf("editing") > -1){
		$(('.commission-single:eq('+id+')')).removeClass("editing");
	}
	else {
		$(('.commission-single:eq('+id+')')).addClass("editing");
	}
	
	if(save){
		$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
		
		var request = $.ajax({
			url : 'includes/php/dash/tracks/updateTracks.php',
			type : "POST",
			data : {
				id: document.getElementsByName('commTrackId')[id].value,
				name: document.getElementsByName('oldTrackName')[id].value,
				desc: document.getElementsByName('oldTrackDesc')[id].value,
				eDate: document.getElementsByName('oldTrackDate')[id].value
			}
		});
		
		request.done(function(msg) {
			loadTracks("Successfully updated track.");
		});
	}
}

//---- DELETE TRACK ----//

function deleteNewTrack(){
	var conf = confirm("Are you sure you want to discard your draft?");
	if(conf){
		document.newTrack.reset();
		preventReloadPage = false;
		$('#newTrack').modal('hide');
		
		document.getElementById('newTrackDraft').style.display = "block";
		document.getElementById('newTrackDraft').innerHTML = "Draft has been discarded.";
		setTimeout(function(){
			document.getElementById('newTrackDraft').style.display = "none";
			document.getElementById('newTrackDraft').innerHTML = "Draft has been saved.";
		},3000);
	}
}

function deleteOldTracks(id){
	var conf = confirm("IMPORTANT: If this track is deleted it cannot be restored? Please confer with the Notetones Staff before proceeding.\nAre you sure you want to delete this track?");
	if(conf){
		$('.navbar-ajax-progress').html("<i class='fa fa-circle-o-notch fa-spin' style='color: red;'> </i>");
		
		var request = $.ajax({
			url : 'includes/php/dash/tracks/deleteTracks.php',
			type : "POST",
			data: {
				id: document.getElementsByName('commTrackId')[id].value,
			}
		});
		
		request.done(function(msg) {
			loadTracks("Successfully deleted track from commission");
		});
	}
}

//---- LOAD TRACK ----//

function loadTracks(successString){
	var request = $.ajax({
		url : 'includes/php/dash/tracks/loadTracks.php',
		type : "POST",
		data: {
			id: document.getElementsByName('userLoginId')[0].value
		}
	});
	
	request.done(function(msg) {
		$('.main-commission:eq(0)').html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.navbar-ajax-progress').html("<div class='success'>"+successString+"</div>");
		$(".navbar-ajax-progress .success").fadeOut(3000);
	});
}

//---- DOWNLOAD ----//

function downloadCommClick(id){
	var request = $.ajax({
		url : 'includes/php/dash/download/downloadedZip.php',
		type : "POST",
		data: {
			id: id
		}
	});
}

//---- PRODUCTION ----//

function loadProduction(loadRest){
	var request = $.ajax({
		url : 'includes/php/dash/production/productionTable.php',
		type : "POST",
		data: {
			loadRest: loadRest
		}
	});
	
	request.done(function(msg) {
		$('.main-log:eq(0)').html(msg);
	});
}

//---- INVOICE ----//

function downloadInvClick(id){
	var request = $.ajax({
		url : 'includes/php/dash/commission/downloadedInvoice.php',
		type : "POST",
		data: {
			id: id
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
		if(msg == 'true'){
			loadPassword("Successfully updated Password.", 1);
		}
		else {
			loadPassword("ERROR! Check you entered the correct password!", 0)
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
			document.getElementsByName('oldPassword')[0].value = "";
			document.getElementsByName('newPassword')[0].value = "";
			document.getElementsByName('newPassword')[1].value = "";
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
			email: document.getElementsByName('emailInfo')[0].value
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