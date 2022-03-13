<?php

	if($_POST["request"] == "createUsercodeFile") {
	
		$usercodeFile = "../session/" . $_POST["gameFolder"] . "/usercodes/" . $_POST["userVariable"] . ".txt";
		
		file_put_contents($usercodeFile, $_POST["usercode"]);
	
	}

	if($_POST["request"] == "createMainFiles") {

		$participantsArray = "../session/".  $_POST["gameFolder"] . "/participantsArray.js";
	
		$backupParticipantsArray = "../session/".  $_POST["gameFolder"] . "/backupParticipantsArray.js";
	
		$originalParticipantsArray = "../session/".  $_POST["gameFolder"] . "/originalParticipantsArray.js";
	
		$currentPlayerFile = "../session/".  $_POST["gameFolder"] . "/currentPlayerIndex.txt";
	
		file_put_contents($participantsArray, "var participantsArray = [" . $_POST["participants"] . "];"); 
	
		file_put_contents($backupParticipantsArray, "var backupParticipantsArray = [" . $_POST["participants"] . "];"); 
	
		file_put_contents($originalParticipantsArray, "var originalParticipantsArray = [" . $_POST["participants"] . "];"); 
	
		file_put_contents($currentPlayerFile, "0"); 
	
	}
	
	if($_POST["request"] == "endGame") {

		$gameFolder = "../session/" . $_POST["gameFolder"];
		
		array_map('unlink', glob("$gameFolder/*.*"));
		
		array_map('unlink', glob("$gameFolder/*/*.*"));
		
		array_map('rmdir', glob("$gameFolder/*"));
		
		if(rmdir($gameFolder)) {
		
			echo "success";
		
		}
	
	}

	if($_POST["request"] == "backupAndRestore") {
	
		if($_POST["item"] == "usercode") {
		
			$originalFolder = "../session/" . $_POST["gameFolder"] . "/usercodes";
				
			$backupFolder = "../session/backup/usercodes/" . $_POST["gameFolder"];
				
			if($_POST["action"] == "backup") {
			
				foreach (scandir($originalFolder) as $file) {
				
					if ($file !== '.' && $file !== '..') {
					
						copy($originalFolder . $file, $backupFolder . $file);
					
					}
					
				}
					
			}
			
			if($_POST["action"] == "restore") {
			
				foreach (scandir($backupFolder) as $file) {
				
					if ($file !== '.' && $file !== '..') {
					
						copy($backupFolder . $file, $originalFolder . $file);
					
					}
					
				}
					
				unlink($backupFolder . "/*.*");
				
				rmdir($backupFolder);
	
			}
	
		}
	
	}
	
 ?>