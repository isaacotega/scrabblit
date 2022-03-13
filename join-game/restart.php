<style>

	#divRestartGame .leftAligned {
		width: 50%;
		float: left;
		text-align: left;
		font-size: 30px;
		font-weight: 300;
		color: white;
		font-family: times;
	}
	
	#divRestartGame .rightAligned {
		width: 50%;
		float: right;
		text-align: left;
		font-size: 30px;
		font-weight: 300;
		color: cyan;
		font-family: times;
	}
	
	.btnLowPriority {
    		float: left; 
		background-color: red !important;
	}

	.btnHighPriority {
    		float: right; 
		background-color: indigo !important;
	}
	
</style>

	<a href=""><button class="titleBar">Dashboard</button></a>
 	 
	 	<div class="form" id="divRestartGame">
	 
	 		<label class="formHeading">Restart Game</label>
	 		
	 		<br><br><br><br><br>
	 		
	 		<div class="leftAligned style=": ;"">
	 	
	 			<label class="statement">Game Id:</label>
	 		
	 			<br>
	 		
	 			<label class="statement">Game:</label>
	 		
	 			<br>
	 		
	 			<label class="statement">Participants:</label>
	 		
	 			<br>
	 		
	 			<label class="statement">Status:</label>
	 		
	 			<br><br>
	 			
	 			<button id="btnCancel" class="btnLowPriority">Cancel</button>
	 			
	 		<!--	<button id="btnEmptyParticipants" class="btnLowPriority" style="display: none">Empty participants</button>-->
	 		
	 		</div>
	 		
	 		<div class="rightAligned">
	 	
	 			<label class="statement" id="gameId"></label>
	 		
	 			<br>
	 		
	 			<label class="statement" id="gameName"></label>
	 		
	 			<br>
	 		
	 			<label class="statement" id="participantsNumber"></label>
	 		
	 			<br>
	 		
	 			<label class="statement" id="gameStatus"></label>
	 		
	 			<br><br>
	 			
	 			<button id="btnRestartGame" class="btnHighPriority">Restart Game</button>
	 			
	 			<button id="btnRetainParticipants" class="btnHighPriority" style="display: none">Retain participants</button>
	 		
	 		</div>
	 	
	 	<div id="gameDetails" class="hidden">
	 		<p id="password"></p>
	 		<p id="game"></p>
	 		<p id="checkType">cc</p>
	 	</div>
	 	
	 	</div>
	 	
	 	<p class="hidden" id="hiddenGameParticipants"></p>
	 	
	 	
	 	
	<script>
	
		setInterval(function() {
	
			$("#gameId").html(sessionStorage.getItem("gameStatus"));

			$("#gameName").load("../session/" + sessionStorage.getItem("gameStatus") + "/game.txt");
			
			$("#hiddenGameParticipants").load("../session/" + sessionStorage.getItem("gameStatus") + "/participants.html", function() {
			
				$("#participantsNumber").html($("[id=participantName]").length);
			
			});
		
			$("#gameStatus").load("../session/" + sessionStorage.getItem("gameStatus") + "/status.txt");
			
		}, 500);
			
		$("#btnCancel").click(function() {
			
			window.location.href = "?stage=dashboard";
		
		});
		
		$("#btnRestartGame").click(function() {
		
			$("#btnCancel").hide();
		
			$("#btnRestartGame").hide();
		
			$("#btnEmptyParticipants").css("display", "block");
		
			$("#btnRetainParticipants").css("display", "block");
		
		});
		
		
		
		
			
		$("#btnEmptyParticipants").click(function() {
			
			// load game info to be used in restarting game
		
			$("#gameDetails #password").load("../session/" + sessionStorage.getItem("gameStatus") + "/pswd.txt");
					
			$("#gameDetails #game").load("../session/" + sessionStorage.getItem("gameStatus") + "/game.txt");
					
			$("#gameDetails #checkType").load("../session/" + sessionStorage.getItem("gameStatus") + "/checkType.txt");

	 		// end game through AJAX  
	 				
			$.ajax({
				type: "POST",
				url: "../scripts/gameFilesCreator.php",
				data: {
					request: "endGame",
					gameFolder: sessionStorage.getItem("gameStatus")
				},
				cache: false,
				success: function(response) {
				
					if(response == "success") {
					
						// create a new game session via AJAX 
						
						$.ajax({
							type: "POST",
							url: "../scripts/newGameCreator.php",
							data: {
								newGameId: sessionStorage.getItem("gameStatus"),
								game: $("#gameDetails #game").html(), 
								newGamePassword: $("#gameDetails #password").html(), 
								username: localStorage.getItem("scrabblitUsername"),
								userVariable: localStorage.getItem("accountInformation"),
								whotCheckType: $("#gameDetails #checkType").html(),
								usercode: "test"
							},
							cache: false,
							success: function() {
				
								toast("The game session (" +  sessionStorage.getItem("gameStatus") + ") has been restarted");
								
							//	window.location.href = "?stage=dashboard";
				
							}
						});
					
					}
					
					else {
					
						toast("Error processing request");
					
					}
				
				}
			});
			
		});
		
		
			
		// import originalParticipantsArray script from current game session 
		
		// separation of text prevents misleading closing tag of script
	
		$("body").append('<script src="../session/' + sessionStorage.getItem("gameStatus") + '/originalParticipantsArray.js"><' + '/script>');
		
		
		
		
		
		

		$("#btnRetainParticipants").click(function() {
		
			// load game info to be used in restarting game
		
			$("#gameDetails #password").load("../session/" + sessionStorage.getItem("gameStatus") + "/pswd.txt");
					
			$("#gameDetails #game").load("../session/" + sessionStorage.getItem("gameStatus") + "/game.txt");
					
			$("#gameDetails #checkType").load("../session/" + sessionStorage.getItem("gameStatus") + "/checkType.txt");
			
			// backup all files in usercodes folder
			
			$.ajax({
				type: "POST",
				url: "../scripts/gameFilesCreator.php",
				data: {
					request: "backupAndRestore",
					action: "backup",
					item: "usercode",
					gameFolder: sessionStorage.getItem("gameStatus")
				},
				cache: false,
				success: function(response) {
				
					$(".form").append(response);

	 				// end game through AJAX  
	 				
					$.ajax({
						type: "POST",
						url: "../scripts/gameFilesCreator.php",
						data: {
							request: "endGame",
							gameFolder: sessionStorage.getItem("gameStatus")
						},
						cache: false,
						success: function(response) {
				
							if(response == "success") {
					
								// create a new game session via AJAX 
						
								$.ajax({
									type: "POST",
									url: "../scripts/newGameCreator.php",
									data: {
										newGameId: sessionStorage.getItem("gameStatus"),
										game: $("#gameDetails #game").html(), 
										newGamePassword: $("#gameDetails #password").html(), 
										username: localStorage.getItem("scrabblitUsername"),
										userVariable: localStorage.getItem("accountInformation"),
										whotCheckType: $("#gameDetails #checkType").html(),
										usercode: "test",
										cardSelectionArray: cardSelectionArray()
									},
									cache: false,
									success: function() {
				
										// recreate all participants files using original participants array of previous session hanging in the client side
							
										var  participantsString = '"' + originalParticipantsArray.join('", "') + '"';
			
										$.ajax({
											type: "POST",
											url: "../scripts/gameFilesCreator.php",
											data: {
												request: "createMainFiles",
												gameFolder: sessionStorage.getItem("gameStatus"),
												participants: participantsString
											},
											cache: false,
											success: function(response) {
				
												$(".form").append(response);
					
												// restore usercode files backed up earlier and clear backup
				
												$.ajax({
													type: "POST",
													url: "../scripts/gameFilesCreator.php",
													data: {
														request: "backupAndRestore",
														action: "restore",
														item: "usercode",
														gameFolder: sessionStorage.getItem("gameStatus")
													},
													cache: false,
													success: function(response) {
													
														// send all participants name into participants file via AJAX 
													
														// index is set to one so hosts name can be skipped over as newGameCreator file has already added it 
				
														var i = 1;
		
														var name = "";
		
														while(i < originalParticipantsArray.length) {
		
															name = originalParticipantsArray[i];
		
															$.ajax({
																type: "POST",
																url: "../scripts/participantsAdder.php",
																data: {
																	gameId: sessionStorage.getItem("gameStatus"),
																	name: name
																},
																cache: false
															});
								
															i++;
								
														}
				
														$(".form").append(response);
														
														// toast success message and redirect user to dashboard 
				
														toast("The game session (" +  sessionStorage.getItem("gameStatus") + ") has been restarted");
								
														window.location.href = "?stage=dashboard";
							
													}
												}); // ends restoration
			
											}
										}); // ends recreation of participants files
			
									}
								}); // ends create of new session 
					
							}
					
							else {
					
								toast("Error processing request");
					
							}
				
						}
					}); // ends delete
			
				}
			}); // ends backup
		
		});
		
	 	// method which generates 54 random numbers for whot card selection array 
	 	
	 	function cardSelectionArray() {
	 	
			var arr = [];

			var x = 0;

			var rn;

			while ( x < 54 ) {
 
				rn = randomNumb();
	
				if(arr.indexOf(rn) == -1) {
	
					arr.push(" " + rn);
	
					x++;

				}
	
			}
			
			return arr.toString();

			function randomNumb() {

				return Math.floor(Math.random() * 54);
	
			}
			
		}
			
		// remember csa
	</script>