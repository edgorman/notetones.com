<?php
	function loadContact($contactType){
		require(dirname(__FILE__)."/../config.php");
		
		$stmt = $conn -> prepare("SELECT nickname, contact FROM login WHERE level= :levelData");
		$stmt -> bindParam(":levelData", $contactType);
		$stmt -> execute();
		$stmt -> bindColumn('nickname', $nicknameData);
		$stmt -> bindColumn('contact', $contactData);
	
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			echo '<p><b>'.$nicknameData.'</b> - '.$contactData.'</p>';
		}
	}
	
	//LEFT
	echo '<div class="col-lg-6 col-md-12">';
	
	//SLT
	echo '<div class="panel panel-default" id="slt">
				<a href="#contactSLT" data-toggle="collapse" data-parent="slt">
					<div class="panel-heading" style="background-color: #d9edf7; color: #31708f;">
						<b>Senior Leadership Team</b>
					</div>
				</a>
				<div id="contactSLT" class="panel-collapse collapse in">
					<div class="panel-body">';
				
				loadContact(1);
				
		echo '		</div>
				</div>
			</div>';
	
	//CNT
	echo '<div class="panel panel-default" id="cnt">
				<a href="#contactCNT" data-toggle="collapse" data-parent="cnt">
					<div class="panel-heading" style="background-color: #F0AD4E; color: #724504;">
						<b>Content</b>
					</div>
				</a>
				<div id="contactCNT" class="panel-collapse collapse in">
					<div class="panel-body">';
				
				loadContact(3);
				
		echo '		</div>
				</div>
			</div>';
			
	//TIER 2
	echo '<div class="panel panel-default" id="ttwo">
				<a href="#contactTTWO" data-toggle="collapse" data-parent="ttwo">
					<div class="panel-heading panel-default">
						<b>Tier 2</b>
					</div>
				</a>
				<div id="contactTTWO" class="panel-collapse collapse in">
					<div class="panel-body">';
				
				loadContact(10);
				
		echo '		</div>
				</div>
			</div>';
	
	echo '</div>';
	
	//RIGHT
	echo '<div class="col-lg-6 col-md-12">';
	
	//ADM
	echo '<div class="panel panel-default" id="adm">
				<a href="#contactADM" data-toggle="collapse" data-parent="adm">
					<div class="panel-heading" style="background-color: #5CB85C; color: #225C23;">
						<b>Administration</b>
					</div>
				</a>
				<div id="contactADM" class="panel-collapse collapse in">
					<div class="panel-body">';
				
				loadContact(2);
				
		echo '		</div>
				</div>
			</div>';
	
	//PRD
	echo '<div class="panel panel-default" id="prd">
				<a href="#contactPRD" data-toggle="collapse" data-parent="prd">
					<div class="panel-heading" style="background-color: #D9534F; color: #5A0302;">
						<b>Production</b>
					</div>
				</a>
				<div id="contactPRD" class="panel-collapse collapse in">
					<div class="panel-body">';
				
				loadContact(4);
				
		echo '		</div>
				</div>
			</div>';
			
	//TIER 3
	echo '<div class="panel panel-default" id="tthree">
				<a href="#contactTTHREE" data-toggle="collapse" data-parent="tthree">
					<div class="panel-heading panel-default">
						<b>Tier 3</b>
					</div>
				</a>
				<div id="contactTTHREE" class="panel-collapse collapse in">
					<div class="panel-body">';
				
				loadContact(11);
				
		echo '		</div>
				</div>
			</div>';
	
	echo '</div>';
?>