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
<form name="contactForm" method="post">
	<div class="col-md-12 col-lg-10 col-lg-offset-1 contact-form">
		<label class="textTitle" style="text-align: left;" for="contactFormName">NAME: 
			<span class="contact-required" data-toggle="tooltip" data-placement="right" title="This field is required to complete this form.">required</span></label><br>
		<input type="text" class="contact-input" name="name" id="contactFormName">
		<div class="contact-error col-md-12"></div>
		<label class="textTitle" style="text-align: left;" for="contactFormEmail">EMAIL:
			<span class="contact-required" data-toggle="tooltip" data-placement="right" title="This field is required to complete this form.">required</span></label><br>
		<input type="text" class="contact-input" name="email" id="contactFormEmail">
		<div class="contact-error col-md-12"></div>
		<br><br><br>
		<input type="hidden" name='enquiry' value=''/>
		<div class="contact-dropdown dropdown">
			<button class="button-link dropdown-toggle" type="button" id="enquiryType" data-toggle="dropdown" aria-expanded="false">
				<h3>TYPE OF ENQUIRY <span class="caret"></span></h3>
			</button>
			<div class="dropdown-menu" role="menu" aria-labelledby="enquiryType">
				<p onclick='document.contactForm.enquiry.value = "enquire"; document.getElementById("enquiryType").innerHTML = "<h3>ENQUIRY: GENERAL</h3>"'>GENERAL</p>
		    	<p onclick='document.contactForm.enquiry.value = "business"; document.getElementById("enquiryType").innerHTML = "<h3>ENQUIRY: BUSINESS</h3>"'>BUSINESS</p>
		    	<p onclick='document.contactForm.enquiry.value = "technical"; document.getElementById("enquiryType").innerHTML = "<h3>ENQUIRY: TECHNICAL</h3>"'>TECHNICAL</p>
		    	<p onclick='document.contactForm.enquiry.value = "jobs"; document.getElementById("enquiryType").innerHTML = "<h3>ENQUIRY: JOBS</h3>"'>JOBS</p>
			</div>
		</div>
		<div class="contact-error col-md-12"></div>
		<label class="textTitle" style="text-align: left;" for="contactFormMessage">MESSAGE:
			<span class="contact-required" data-toggle="tooltip" data-placement="right" title="This field is required to complete this form.">required</span></label><br>
		<textarea type="text" class="contact-input" name="message" id="contactFormMessage"></textarea>
		<div class="contact-error col-md-12"></div>
		<br><br><br>
		<div style="text-align: center;">
			<button class="button-link" type="submit" name="submit" onclick="return contactValidation();">
				<h3>SUBMIT IT</h3>
			</button>
		</div>
		<br><br>
	</div>
</form>
<?php
	} else {
		$mailCheck = spamcheck($_POST["email"]);
		if($mailCheck == FALSE){
			echo '  <div class="col-md-12 col-lg-10 col-lg-offset-1 contact-form">
						<h3 class="textTitle offPage">INVALID INPUT</h3>
					</div>
					<form name="contactForm" method="post">
						<div class="col-md-12 col-lg-10 col-lg-offset-1 contact-form">
							<h3 class="textTitle offPage">SUBMISSION FORM</h3>
							<label class="textTitle" style="text-align: left;" for="contactFormName">NAME: 
								<span class="contact-required" data-toggle="tooltip" data-placement="right" title="This field is required to complete this form.">required</span></label><br>
							<input type="text" class="contact-input" name="name" id="contactFormName">
							<div class="contact-error col-md-12"></div>
							<label class="textTitle" style="text-align: left;" for="contactFormEmail">EMAIL:
								<span class="contact-required" data-toggle="tooltip" data-placement="right" title="This field is required to complete this form.">required</span></label><br>
							<input type="text" class="contact-input" name="email" id="contactFormEmail">
							<div class="contact-error col-md-12"></div>
							<br><br><br>
							<input type="hidden" name="enquiry" value=""/>
							<div class="contact-dropdown dropdown">
								<button class="button-link dropdown-toggle" type="button" id="enquiryType" data-toggle="dropdown" aria-expanded="false">
									<h3>TYPE OF ENQUIRY <span class="caret"></span></h3>
								</button>
								<div class="dropdown-menu" role="menu" aria-labelledby="enquiryType">
									<p onclick=&quot;document.contactForm.enquiry.value = "enquire"; document.getElementById("enquiryType").innerHTML = "<h3>ENQUIRY: GENERAL</h3>"&quot;>GENERAL</p>
							    	<p onclick=&quot;document.contactForm.enquiry.value = "business"; document.getElementById("enquiryType").innerHTML = "<h3>ENQUIRY: BUSINESS</h3>"&quot;>BUSINESS</p>
							    	<p onclick=&quot;document.contactForm.enquiry.value = "technical"; document.getElementById("enquiryType").innerHTML = "<h3>ENQUIRY: TECHNICAL</h3>"&quot;>TECHNICAL</p>
							    	<p onclick=&quot;document.contactForm.enquiry.value = "jobs"; document.getElementById("enquiryType").innerHTML = "<h3>ENQUIRY: JOBS</h3>"&quot;>JOBS</p>
								</div>
							</div>
							<div class="contact-error col-md-12"></div>
							<label class="textTitle" style="text-align: left;" for="contactFormMessage">MESSAGE:
								<span class="contact-required" data-toggle="tooltip" data-placement="right" title="This field is required to complete this form.">required</span></label><br>
							<textarea type="text" class="contact-input" name="message" id="contactFormMessage"></textarea>
							<div class="contact-error col-md-12"></div>
							<br><br><br>
							<div style="text-align: center;">
								<button class="button-link" type="submit" name="submit" onclick="return contactValidation();">
									<h3>SUBMIT IT</h3>
								</button>
							</div>
							<br><br>
						</div>
					</form>';
		}
		else{
			$name = $_POST["name"];
			$email = $_POST["email"];
			$enquiry = $_POST["enquiry"];
			$msg = $_POST["message"];
			$msg = wordwrap($msg, 70);

			mail($enquiry."@notetones.com",$email,$msg,"From: $name\n");
			echo '  <div class="col-md-12 col-lg-10 col-lg-offset-1 contact-form">
						<h3 class="textTitle offPage">THANKYOU!</h3>
					</div>';
		}
	}
?>