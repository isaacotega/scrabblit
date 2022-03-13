<?php
	
	// update card stack
	
	file_put_contents("../../session/" . $_POST['gameFolder'] . "/cardStack.html", '<button class="cards"> <label class="number">7</label> <br><br> <div class="smallShape"> <span class="smallCarpet">  </span> </div> <br> <div class="largeShape"> <span class="Carpet">  </span> </div>  <div class="smallShape2"> <span class="smallCarpet">  </span> </div> <br><br> <label class="number2">7</label> </button>');
	
	// update current player index 
	
	file_put_contents("../../session/" . $_POST['gameFolder'] . "/currentPlayerIndex.txt", "0");
	
	// update card selection index 
	
	file_put_contents("../../session/" . $_POST['gameFolder'] . "/cardSelectionIndex.txt", "0");
	
	// empty whot command
	
	file_put_contents("../../session/" . $_POST['gameFolder'] . "/whotCommand.txt", "");
	
	// empty whot shape
	
	file_put_contents("../../session/" . $_POST['gameFolder'] . "/whotShape.txt", "");
	
	// empty whot requester index 
	
	file_put_contents("../../session/" . $_POST['gameFolder'] . "/whotRequesterIndex.txt", "");
	
	// empty hold on holder
	
	file_put_contents("../../session/" . $_POST['gameFolder'] . "/holdOnHolder.txt", "");
	
	// empty pick three status file 
	
	file_put_contents("../../session/" . $_POST['gameFolder'] . "/pickThreeStatus.txt", "");
	
	// empty three picker file 
	
	file_put_contents("../../session/" . $_POST['gameFolder'] . "/threePicker.txt", "");
	
	// empty command 
	
	file_put_contents("../../session/" . $_POST['gameFolder'] . "/command.txt", "");
	
	// delete all files. in cards folder
	
	$files = glob("../../session/" . $_POST['gameFolder'] . "/cards/*");

	foreach($files as $file) {
	
		if(is_file($file)) {
		
			unlink($file);
			
		}
		
	} 

	// delete all files. in position folder
	
	$files = glob("../../session/" . $_POST['gameFolder'] . "/position/*");

	foreach($files as $file) {
	
		if(is_file($file)) {
		
			unlink($file);
			
		}
		
	} 

	// delete all files. in playerStatus folder
	
	$files = glob("../../session/" . $_POST['gameFolder'] . "/playerStatus/*");

	foreach($files as $file) {
	
		if(is_file($file)) {
		
			unlink($file);
			
		}
		
	} 


	exit();
	
 ?>	