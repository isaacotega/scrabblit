 <!DOCTYPE html>

	<html>
	
		<head>
		
		</head>
		
		<body>
		
			<form method="post">
			
				<input name="gameFolder">
				
			</form>
			
			<div id="cardsHolder"></div> 
	 
			 <script src="../JQuery.js"></script>
	 
			 <script src='../../session/<?php echo $_POST["gameFolder"] ?>/participantsArray.js'></script>
	 
			 <script>
			 
			 sessionStorage.setItem("gameStatus", "isaacgame");
			 
			 var allSums = [];
			 
			var x = 0;
			 
			var y = 0;
			
			while(x <  participantsArray.length) {
			 
			 	$("#cardsHolder").load('../../session/' + sessionStorage.getItem('gameStatus') + '/cards/' + participantsArray[x].trim().toLowerCase().replace(/ /g,  '') + '.html', function() {
			 	
			 	var i = 0;
			 	
			 	var sum = 0;
			 	
			 	while(i <  $("#cardsHolder .cards").length)  {
			 	
			 		sum += Number( $("#cardsHolder .cards").eq(i).children(".number").html() );
			 	
			 		i++;
			 	
			 	}
			 	
			 	y++;
			 	
			 	allSums.push(sum);
			 	
			 	if(y == participantsArray.length) {
			 	
			 	sendSums();
			 	
			 	}
			 	
			 	});
			 	
			 	x++;
			 	
			 	}
			 	
			 function sendSums() {
			 
			 	alert(allSums);
			 	
			 	var i = 0;
			 	
			 	var index = 0;
			 	
			 	while(i < allSums.length) {
			 	
			 	//	if(
			 		
			 		i++;
			 	
			 	}
			 	
			 }
			 	
			 </script>
	
	 	</body>
	 
	 </html>

	<?php
	
	 ?>
	 