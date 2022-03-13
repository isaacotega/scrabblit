<!DOCTYPE html>

	<html>
	
		<head>
			
			<title>Scrabble</title>
			
			<link rel="stylesheet" href="../styles/index.css">
			
			<script src="../scripts/JQuery.js"></script>
		
			<script src="../scripts/elements.js"></script>
		
			<script>
			
			//ensuring user is logged in

			if(localStorage.getItem("accountInformation") == null || localStorage.getItem("accountInformation") == "") {

				window.location.href = "../login?return=" + window.location;
				
			}
				
			//ensuring game session is going on

			else if(sessionStorage.getItem("gameStatus") == null) {

				window.location.href = "../join-game";
				
			}

			else {}
				
			</script>
			
		</head>
		
		<body></body>
		<!--
			<meta http-equiv=”Pragma” content=”no-cache”>

			<meta http-equiv=”Expires” content=”-1″>
			
			<meta http-equiv="Cache-Control" content="no-store">
			
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
		 -->
	</html>
	
	