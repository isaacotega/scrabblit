<?php

	if($_POST["request"] == "updateBackupParticipantsArray") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/backupParticipantsArray.js";
	
		file_put_contents($file, 'var backupParticipantsArray = [' . $_POST['array'] . '];');
	
		exit();
	
	}
	
	else if($_POST["request"] == "emptyCardSelectionIndex") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/cardSelectionIndex.txt";
	
		file_put_contents($file, "0");
	
		exit();
		
	}
	
	else if($_POST["request"] == "updateCardSelectionIndex") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/cardSelectionIndex.txt";
	
		file_put_contents($file, file_get_contents($file) + 1);
	
		exit();
		
	}
	
	else if($_POST["request"] == "sendCard") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/cards/" . $_POST['name'] . ".html";
	
		$fh = fopen($file, 'a') or die("Error");
	
		fwrite($fh, $_POST['card']);
	
		fclose($file);
	
		exit();
		
	}
	
	else if($_POST["request"] == "updateCardStack") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/cardStack.html";
	
		file_put_contents($file, $_POST['cardStack']);
	
		exit();
		
	}
	
	else if($_POST["request"] == "updateCards") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/cards/" . $_POST['username'] . ".html";
	
		file_put_contents($file, $_POST["cards"]);
	
		exit();
		
	}
	
	else if($_POST["request"] == "updateCommand") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/command.txt";
	
		file_put_contents($file, $_POST['number']);
	
		exit();
		
	}
	
	else if($_POST["request"] == "updateCurrentPlayer") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/currentPlayerIndex.txt";
	
		if(file_get_contents($file) < $_POST['maxIndex']) {
	
			$nextPlayerIndex = file_get_contents($file) + 1;
	
		}
	
		else {
	
			$nextPlayerIndex = 0;
	
		}
	
		file_put_contents($file, $nextPlayerIndex);
	
		exit();
	
	}
	
	else if($_POST["request"] == "updateHoldOnHolder") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/holdOnHolder.txt";
	
		file_put_contents($file, $_POST['name']);
	
		exit();
		
	}
	
	else if($_POST["request"] == "updateParticipantsArray") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/participantsArray.js";
	
		file_put_contents($file, 'var participantsArray = [' . $_POST['array'] . '];');
	
		exit();
		
	}
	
	else if($_POST["request"] == "emptyPickThreeStatus") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/pickThreeStatus.txt";
	
		file_put_contents($file, "");
	
		exit();
		
	}
	
	else if($_POST["request"] == "updatePickThreeStatus") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/pickThreeStatus.txt";
	
		if(!empty(file_get_contents($file))) {
	
			file_put_contents($file, file_get_contents($file) - 1);
		
		}
	
		else {
	
			file_put_contents($file, "5");
	
		}
	
		exit();
		
	}
	
	else if($_POST["request"] == "updatePickedCardsIndexes") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/pickedCardsIndexes.txt";
	
		file_put_contents($file, file_get_contents($file) . $_POST['newIndex'] . ", " );
	
		exit();
		
	}
	
	else if($_POST["request"] == "updatePlayerStatus") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/playerStatus/" . $_POST['name'] . ".txt";
	
		file_put_contents($file, $_POST['status']);
	
		exit();
		
	}
	
	else if($_POST["request"] == "updatePositionArray") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/positionArray.js";
	
		if(!empty(file_get_contents($file))) {
	
			$updatedArray = str_replace("];", ', "' . $_POST['name'] . '"];', file_get_contents($file));
		
			file_put_contents($file, $updatedArray);
	
		}
	
		else {
	
			file_put_contents($file, 'var positionArray = ["' . $_POST['name'] . '"];');
	
		}
	
		exit();
		
	}
	
	else if($_POST["request"] == "updatePosition") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/position/positionHolder.txt";
	
		file_put_contents($file, $_POST['name']);
	
		$file2 = "../../session/" . $_POST['gameFolder'] . "/position/position.txt";
		
		if($_POST["action"] == "increment") {
	
			file_put_contents($file2, file_get_contents($file2) + 1);
			
		}
		
		else if($_POST["action"] == "decrement") {
		
			if(!empty(file_get_contents($file2))) {
	
				file_put_contents($file2, file_get_contents($file2) - 1);
				
			}
			
			else {
	
				file_put_contents($file2, $_POST["initialPosition"]);
				
			}
			
		}
			
		else {}
		
		exit();
		
	}
	
	else if($_POST["request"] == "updateThreePicker") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/threePicker.txt";
	
		file_put_contents($file, $_POST['name']);
	
		exit();
		
	}
	
	else if($_POST["request"] == "updateGameStatus") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/status.txt";
	
		file_put_contents($file, $_POST['status']);
	
		exit();
		
	}
	
	else if($_POST["request"] == "setWhotCommand") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/whotCommand.txt";
	
		file_put_contents($file, $_POST['name']);
	
		exit();
		
	}
	
	else if($_POST["request"] == "updateWhotRequesterIndex") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/whotRequesterIndex.txt";
	
		file_put_contents($file, $_POST['index']);
	
		exit();
		
	}
	
	else if($_POST["request"] == "setWhotShape") {
	
		$file = "../../session/" . $_POST['gameFolder'] . "/whotShape.txt";
	
		file_put_contents($file, $_POST['shape']);
	
		exit();
		
	}
	
	else {}
	
 ?>