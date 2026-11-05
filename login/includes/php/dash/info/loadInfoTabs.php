<?php
	require(dirname(__FILE__)."/../../config.php");
	
   	echo '
   		<div class="col-lg-12">
			<ul class="nav nav-tabs nav-justified">
		    	<li role="presentation" class="active"><a href="#">Track Updates</a></li>
		      	<li role="presentation"><a href="#">Production Log</a></li>
		      	<li role="presentation"><a href="#">Client Messenger</a></li>
		    </ul>
		    <script>
		    	$("ul.nav-tabs li a").click(function (e) {
					$("ul.nav-tabs li.active").removeClass("active");
				  	$(this).parent("li").addClass("active");
				  	
				  	$(".clientInfo .clientInfoContent").removeClass("active");
				  	if($(this).html() == "Track Updates") $(".clientInfo .clientInfoContent:eq(0)").addClass("active");
				  	if($(this).html() == "Production Log") $(".clientInfo .clientInfoContent:eq(1)").addClass("active");
				  	if($(this).html() == "Client Messenger") $(".clientInfo .clientInfoContent:eq(2)").addClass("active");
				});
		    </script>
		    <div class="clientInfoContent active"></div>
		    <div class="clientInfoContent"></div>
		    <div class="clientInfoContent"></div>
		    <script>
				var chatInterval = setInterval(function(){
			    	if($(".clientInfoContent:eq(2)").hasClass("active")){
						loadInfoChatMessages(document.getElementsByName("chosenClient")[0].value,2);
			    	}
				},1000);
			</script>
		</div>';
?>