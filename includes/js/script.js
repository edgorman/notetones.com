$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
	console.info("Oh hey ;) We see you checking us out, how about applying for a placement here? http://notetones.com/jobs");
	
	$(window).scroll( function(){
	    $('.hideme').each( function(i){
	        var bottom_of_object = $(this).offset().top + $(this).outerHeight() / 3;
	        var bottom_of_window = $(window).scrollTop() + $(window).height();
	        
	        if( bottom_of_window > bottom_of_object ) {
	        	$(this).animate({'opacity':'1'},1000);
	        }
	    });
	});
});

function navbarAnimation(){
	$('.nav-slider').animate({
    	width: "100%"
	},800);
	
	$('.nav-slider').animate({
    	opacity: "0"
	},800);
}

//---- VALIDATION ----//

(function(i, s, o, g, r, a, m) {
	i['GoogleAnalyticsObject'] = r;
	i[r] = i[r] ||
	function() {
		(i[r].q = i[r].q || []).push(arguments)
	}, i[r].l = 1 * new Date();
	a = s.createElement(o), m = s.getElementsByTagName(o)[0];
	a.async = 1;
	a.src = g;
	m.parentNode.insertBefore(a, m)
})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

ga('create', 'UA-47710580-1', 'auto');
ga('send', 'pageview');

//---- ABOUT ----//

function scrollToAbout(e, down){
	if(down) $('html, body').animate({scrollTop:$(window).scrollTop() + ($(window).height() * 0.9 + 2)}, 800);
	else $('html, body').animate({scrollTop:1}, 1000);
}

function aboutOnScroll(){
    var arrowElement = document.getElementsByClassName('about-arrow')[0];
    
   	if($(window).scrollTop() + $(window).height() > $(document).height() - 260) {
    	arrowElement.innerHTML = '<i class="fa fa-chevron-up" onclick="scrollToAbout(event, false);"></i>';
   	}
   	else {
    	arrowElement.innerHTML = '<i class="fa fa-chevron-down" onclick="scrollToAbout(event, true);"></i>';
   	}
};

//---- CONTACT ----//

function contactValidation(){
	validation = true;
	
	if(document.contactForm.name.value == ""){
		document.getElementsByClassName('contact-error')[0].innerHTML = 
		'<br><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>The "Name" field is empty.</div>';
		validation = false;
	}
	
	if(document.contactForm.email.value == ""){
		document.getElementsByClassName('contact-error')[1].innerHTML = 
		'<br><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>The "Email" field is empty.</div>';
		validation = false;
	}
	
	if(document.contactForm.enquiry.value == ""){
		document.getElementsByClassName('contact-error')[2].innerHTML = 
		'<br><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Please choose a type of enquiry.</div>';
		validation = false;
	}
	
	if(document.contactForm.message.value == ""){
		document.getElementsByClassName('contact-error')[3].innerHTML = 
		'<br><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>The "Message" field is empty.</div>';
		validation = false;
	}
	
	return validation;
}

//---- JOB NOTIFICATION ----//

function jobNoteValidation(){
	validation = true;
	
	if(document.jobForm.email.value == ""){
		document.getElementsByClassName('contact-error')[0].innerHTML = 
		'<br><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>The "Email" field is empty.</div>';
		validation = false;
	}
	
	return validation;
}

//---- PUBLIC LIBRARY ----//

function toggleLibraryType(index){
	var searchParent = document.getElementsByClassName('librarySort')[0].children;
	
	for(i = 0; i < searchParent.length; i++){
		$(searchParent[i]).removeClass("active");
		document.getElementsByClassName('libraryType')[i].style.display = "none";
	}
	
	$(searchParent[index]).addClass("active");
	document.getElementsByClassName('libraryType')[index].style.display = "block";
}

//TEST PLAY TRACK
/*
function playTrack(track, id){
	document.getElementsByClassName('pre-track')[id].innerHTML = '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/'+track+'&amp;color=C50000&amp;auto_play=true&amp;hide_related=false&amp;show_comments=false&amp;show_user=true&amp;show_reposts=false"></iframe>';
}
*/

//MUSIC

function musicBar(content, page, searchContent) {
	var searchParent = document.getElementsByClassName('musicSort')[0].children;
	
	$(searchParent[0]).removeClass("active");
	$(searchParent[1]).removeClass("active");
	$(searchParent[2]).removeClass("active");
	$(searchParent[3]).removeClass("active");
	
	$(".musicArea").html("<i class='fa fa-circle-o-notch fa-spin' style='color: red; text-align: center; width: 100%;'> </i><br><br><br>");
	
	if(content == 0 || content == 1 || content == 2 || content == 3){
		$(searchParent[content]).addClass("active");
		content = (searchParent[content].innerHTML).trim();
	}
	else if(content == 4){
		content = "Popular";
	}
	
	//CONTENT
	var request = $.ajax({
		url : '../includes/php/library/musicBar.php',
		type : "POST",
		data : {
			content : content,
			page: page,
			searchContent: searchContent
		}
	});
	
	request.done(function(msg) {
		$(".musicArea").html(msg);
		$('[data-toggle="tooltip"]').tooltip();
		
		if(msg.indexOf("No results returned from search") > -1){
			$(".librarySearch").addClass("failure");
		}
		else $(".librarySearch").addClass("success");
		
		setTimeout(function(){ $(".librarySearch").removeClass("success"); $(".librarySearch").removeClass("failure"); }, 2000);
	});
	
	//TAGS
	request = $.ajax({
		url : '../includes/php/library/musicTags.php',
		type : "POST",
		data : {
			searchContent: searchContent
		}
	});
	
	request.done(function(msg) {
		$(".musicTag").html(msg);
	});
	
	//PAGINATION
	request = $.ajax({
		url : '../includes/php/library/musicPage.php',
		type : "POST",
		data : {
			content : content,
			page: page,
			searchContent: searchContent
		}
	});
	
	request.done(function(msg) {
		$(".musicPagination").html(msg);
	});
}

//SFX

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

function sfxBar(content, page, searchContent) {
	var searchParent = document.getElementsByClassName('sfxSort')[0].children;
	
	$(searchParent[0]).removeClass("active");
	$(searchParent[1]).removeClass("active");
	
	$(".sfxArea").html("<i class='fa fa-circle-o-notch fa-spin' style='color: red; text-align: center; width: 100%;'> </i><br><br><br>");
	
	if(content == 0 || content == 1){
		$(searchParent[content]).addClass("active");
		content = (searchParent[content].innerHTML).trim();
	}
	
	//CONTENT
	var request = $.ajax({
		url : '../includes/php/library/sfxBar.php',
		type : "POST",
		data : {
			content : content,
			page: page,
			searchContent: searchContent
		}
	});
	
	request.done(function(msg) {
		$(".sfxArea").html(msg);
		audiojs.createAll();
		$('[data-toggle="tooltip"]').tooltip();
		
		if(msg.indexOf("No results returned from search") > -1){
			$(".librarySearch").addClass("failure");
		}
		else $(".librarySearch").addClass("success");
		
		setTimeout(function(){ $(".librarySearch").removeClass("success"); $(".librarySearch").removeClass("failure"); }, 2000);
	});
	
	//TAGS
	request = $.ajax({
		url : '../includes/php/library/sfxTags.php',
		type : "POST",
		data : {
			searchContent: searchContent
		}
	});
	
	request.done(function(msg) {
		$(".sfxTag").html(msg);
	});
	
	//PAGINATION
	request = $.ajax({
		url : '../includes/php/library/sfxPage.php',
		type : "POST",
		data : {
			content : content,
			page: page,
			searchContent: searchContent
		}
	});
	
	request.done(function(msg) {
		$(".sfxPagination").html(msg);
	});
}