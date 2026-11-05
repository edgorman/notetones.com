<?php
	require(dirname(__FILE__)."/../config.php");
	$totalHoursArray = [];
	
	$stmt = $conn -> prepare("SELECT invoice_link FROM commission WHERE login_id= :loginIdData LIMIT 1");
	$stmt -> bindParam(":loginIdData", $myIdData);
	$stmt -> execute();
	$stmt -> bindColumn('invoice_link', $invoiceData);
		
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		if(isset($invoiceData) && !($invoiceData == " ") && !($invoiceData == "")){
			echo '<div class="row">
					<div class="col-lg-12 col-md-12" style="text-align: center;">
						<a href="includes/download/invoices/'.$invoiceData.'" download onclick="downloadInvClick('.$myIdData.')">
							<button class="button-link" style="margin-bottom: 0; margin-right: 20px;">
								<h5>Download PDF </h5>
							</button>
						</a>
					</div>
				</div>
				<div class="row" style="padding-bottom: 0;">
					<div class="main-invoice">
						<object data="includes/download/invoices/'.$invoiceData.'" type="application/pdf" width="100%" height="100%">
					    	<p>
					    		It appears you don&#39t have a PDF plugin for this browser. You can 
					    		download the pdf file above.
					    	</p>
						</object>
					</div>
				</div>';
		}
		else{
			echo '<div class="row">
					<div class="col-lg-6 col-lg-offset-3 col-md-12 col-md-offset-0" style="text-align: center;">
						<div class="alert alert-info">
							<h4><b>PLEASE NOTE:</b></h4>
							<h5 style="line-height: 25px;">
								Your invoice has not been prepared yet by the Notetones Staff. 
								Please check here again for more updates at a later time, 
								or when the Notetones staff inform you of its creation.
							</h5>
						</div>
					</div>
				</div>';
		}
	}
?>