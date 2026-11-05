<?php
	function spamcheck($field) {
		$field = filter_var($field, FILTER_SANITIZE_EMAIL);
		if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	if( !isset($_POST['submit'])){
?>
<form name="jobForm" method="post">
	<div class="col-md-12 col-lg-10 col-lg-offset-1 contact-form">
		<label class="textTitle" style="text-align: left;" for="jobFormEmail">EMAIL:
			<span class="contact-required" data-toggle="tooltip" data-placement="right" title="This field is required to complete this form.">required</span></label><br>
		<input type="text" class="contact-input" name="email" id="jobFormEmail">
		<div class="contact-error col-md-12"></div>
		<br><br>
		<div style="text-align: center;">
			<button class="button-link" type="submit" name="submit" onclick="return jobNoteValidation();">
				<h3>SUBMIT IT</h3>
			</button>
		</div>
	</div>
</form>
<?php
	} else {
		$mailCheck = spamcheck($_POST["email"]);
		if($mailCheck == FALSE){
			echo '  <form name="jobForm" method="post">
						<div class="col-md-12 col-lg-10 col-lg-offset-1 contact-form">
							<h3 class="textTitle offPage textTitleBig">SUBSCRIPTION 
FORM</h3>
							<label class="textTitle" style="text-align: left;" for="jobFormEmail">EMAIL:
								<span class="contact-required" data-toggle="tooltip" data-placement="right" title="This field is required to complete this form.">required</span></label><br>
							<input type="text" class="contact-input" name="email" id="jobFormEmail">
							<div class="contact-error col-md-12"></div>
							<br><br>
							<div style="text-align: center;">
								<button class="button-link" type="submit" name="submit" onclick="return jobNoteValidation();">
									<h3>SUBMIT IT</h3>
								</button>
							</div>
						</div>
					</form>';
		}
		else{
			$emailData = $_POST["email"];
			require_once("config.php");
			
			$stmt = $conn -> prepare("SELECT id FROM jobemails WHERE email= :emailData");
			$stmt -> bindParam(':emailData', $emailData);
			$stmt -> execute();
			$stmt -> bindColumn('id', $idData);
			$numData = $stmt -> rowCount();
			
			if($numData == 0){
				$stmt = $conn -> prepare("INSERT INTO jobemails (email) VALUES (:emailData)");
				$stmt -> bindParam(':emailData', $emailData);
				$stmt -> execute();
				
				echo '<div class="col-md-12 col-lg-10 col-lg-offset-1 contact-form">
						<h3 class="textTitle offPage" id="complete">YOU HAVE
SUBSCRIBED!</h3>
					</div>';
			}
			else {
				$stmt = $conn -> prepare("DELETE FROM jobemails WHERE email= :emailData ");
				$stmt -> bindParam(':emailData', $emailData);
				$stmt -> execute();
				
				echo '<div class="col-md-12 col-lg-10 col-lg-offset-1 contact-form">
						<h3 class="textTitle offPage" id="complete">SUCCESSFULLY
UNSUBSCRIBED!</h3>
					</div>';
			} 
		}
	}
?>