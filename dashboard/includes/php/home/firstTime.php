<?php
    echo '<div id="firstTime" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">×</span><span class="sr-only">Close</span>
						</button>
						<h2 class="modal-title" id="myModalLabel">THANKS FOR CHOOSING NOTETONES :)</h2>
					</div>
					<div class="modal-body" style="line-height: 20px; font-size: 14px; text-align: left;">
						<b>Dashboard</b><br>
						This home page is called the Dashboard, where you can view, creat, edit and delete tracks Notetones has been commissioend to produce.
						This first section is an overall update to the progress of your commission, giving you an idea of what stage we are at.
						Below that is where we present your individual tracks, where you can view individual track stats and update info on the fly!
						<br><br>
						<b>Download Centre</b><br>
						From here you will be able to download your bundle of music directly from the Notetones staff, we&#8216ll send you a heads up when we&#8216ve finshed it all up and handed you the check. 
						However some of your tracks may be finshed before others, so a preview will be available for you to hear the finsished product. We might put little tasters 
						of what we&#8216re doing and the stage we are at, so keep and eye out for those.
						<br><br>
						<b>Production Log</b><br>
						In this section we&#8216ll store information about our business with you, any tracks you commission us to create, the different stages of production we reach and 
						records of the samples we prepare for you.
						<br><br>
						<b>Messaging</b><br>
						This is our dedicated private instant messenger for a direct link with you and the Notetones staff, where you can discuss details quickly and easily.
						<br><br>
						<b>Invoice Summary</b><br>
						On this page we will provide you with a display for an invoice confirming your transaction with us, which you will also be able to download if you choose to do so.
						<br><br>
						<b>Thanks again</b><br>
						This service is relatively new to us, and we would appreciate it if you let us know about any improvements you want/bugs you find by <a style="color: blue;" href="messaging.php">messaging our staff</a>. 
						If you want to read this info again, it can be found at the top right, indicated by the information sign <i style="padding-top: 5px;" class="glyphicon glyphicon-info-sign"></i>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">
							Close
						</button>
					</div>
				</div>
			</div>
		</div>';
	
	if(!isset($_SESSION)) session_start();
	if($_SESSION['firstTimeClient']){
		echo "<script>
				$(document).ready(function(){
					$('#firstTime').modal('show');
				})
			</script>";
	}
?>