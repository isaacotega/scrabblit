//array of objects of cards

var cardSelection = [

	{shape: "Carpet", point: 1},
	{shape: "Ball", point: 1},
	{shape: "Star", point: 1},
	{shape: "Angle", point: 1},
	{shape: "Cross", point: 1},
	{shape: "Carpet", point: 2},
	{shape: "Cross", point: 2},
	{shape: "Star", point: 2},
	{shape: "Angle", point: 2},
	{shape: "Cross", point: 2},
	{shape: "Carpet", point: 5},
	{shape: "Ball", point: 5},
	{shape: "Star", point: 5},
	{shape: "Angle", point: 5},
	{shape: "Cross", point: 5},
	{shape: "Cross", point: 7},
	{shape: "Ball", point: 7},
	{shape: "Star", point: 7},
	{shape: "Angle", point: 7},
	{shape: "Cross", point: 7},
	{shape: "Carpet", point: 10},
	{shape: "Ball", point: 10},
	{shape: "Star", point: 10},
	{shape: "Angle", point: 10},
	{shape: "Cross", point: 10},
	{shape: "Carpet", point: 11},
	{shape: "Cross", point: 11},
	{shape: "Star", point: 11},
	{shape: "Angle", point: 11},
	{shape: "Cross", point: 11},
	{shape: "Carpet", point: 14},
	{shape: "Ball", point: 14},
	{shape: "Star", point: 14},
	{shape: "Angle", point: 14},
	{shape: "Cross", point: 14},
	{shape: "Whot", point: 20},
	{shape: "Whot", point: 20},
	{shape: "Whot", point: 20},
	{shape: "Whot", point: 20},
	{shape: "Whot", point: 20},
	{shape: "Ball", point: 4},
	{shape: "Star", point: 4},
	{shape: "Angle", point: 4},
	{shape: "Cross", point: 4},
	{shape: "Carpet", point: 4},
	{shape: "Ball", point: 8},
	{shape: "Star", point: 8},
	{shape: "Angle", point: 9},
	{shape: "Cross", point: 9},
	{shape: "Carpet", point: 10},
	{shape: "Ball", point: 10},
	{shape: "Star", point: 11},
	{shape: "Angle", point: 11},
	{shape: "Cross", point: 15},
	
];

function remark(text) {

	$("#remark").html(text).css("fontSize", "60px");
	
}

function sendCard(receiver) {

			// before picking card check if cards in market are still remaining
			
			if(Number($("#cardSelectionIndex").html()) > 53) {
			
				// if not turn card Selection Index file content to zero through AJAX
			
				$.ajax({
					type: "POST",
					url: "../scripts/whot/filesUpdater.php",
					data: {
						gameFolder: sessionStorage.getItem("gameStatus"),
						request: "emptyCardSelectionIndex",
					},
					cache: false
				});
				
				// also empty card stack except from card on the top
				
				var reshuffling = true; 
				
				var x = 0;
				
				while(x < $("#cardStack").children(".cards").length - 1) {
				
					$("#cardStack").children(".cards").eq(x).remove();
				
					x++;
				
				}
				
				setTimout(function() {
	
					reshuffling = false;
					
				}, 500);
				
				// and finally update card stack
			
				updateCardStack();
		
			}
			
			// first load card Selection Index
			
			$("#cardSelectionIndex").load("../session/" + sessionStorage.getItem("gameStatus") + "/cardSelectionIndex.txt", function() {
			
			// after that generate the card index before creating the random card
			
			var cardIndex = cardSelectionArray[Number($("#cardSelectionIndex").html())];

			
			var randomCard = '<button class="cards"> <label class="number">' + cardSelection[cardIndex].point + '</label> <br><br> <div class="smallShape"> <span class="small' + cardSelection[cardIndex].shape + '">  </span> </div> <br> <div class="largeShape"> <span class="' + cardSelection[cardIndex].shape + '">  </span> </div>  <div class="smallShape2"> <span class="small' + cardSelection[cardIndex].shape + '">  </span> </div> <br><br> <label class="number2">' + cardSelection[cardIndex].point + '</label> </button>';
	
			// AJAX request to send card to the person who received the command 
	
	$.ajax({
		type: "POST",
		url: "../scripts/whot/filesUpdater.php",
		data: {
			gameFolder: sessionStorage.getItem("gameStatus"),
			request: "sendCard",
			card: randomCard,
			name: receiver
		},
		cache: false,
		success: function() {
		
				// update card selection index file 
			
				$.ajax({
					type: "POST",
					url: "../scripts/whot/filesUpdater.php",
					data: {
						gameFolder: sessionStorage.getItem("gameStatus"),
						request: "updateCardSelectionIndex"
					},
					cache: false,
					success: function() {}
				});
				
				}				
				
			});
		});
			
}


//replacement of cards

//check if game has begun 

	 //loading status file to check game status on interval of 1 second
	 		
	 	setInterval(function() {
	 		
	 		$("#gameStatus").load("../session/" + sessionStorage.getItem("gameStatus") + "/status.txt", function(responseTxt,  statusTxt, xhr) {
	 		
	
	 	//display status on rack as appropriate 
	 		
	 			if($("#gameStatus").html() == "pending") {
	 			
	 				$("#gameStatus").html("Waiting for host to begin this game");
	 			
					$("#myCards").html("");
					
					$("#othersCardsHolder").css("display", "none");
					
					$("#cardStack").css("display", "none");
					
					$("#market").css("display", "none");
					
	 			}
	 			
	 			else if($("#gameStatus").html() == "ongoing") {
	 			
	 				$("#gameStatus").html("");
	 			
					$("#othersCardsHolder").css("display", "block");
					
					$("#cardStack").css("display", "block");
					
					$("#market").css("display", "block");
							
					fillCards();
				
	 			}
	 			
	 			// if someone just won
	 		
	 			else if($("#gameStatus").html() == "won"){
	 			
	 				// call function which will display winner remark to everyone 
	 				
	 				displayWinner();
	 			
	 			}
	 		
	 			// if next round is under preparation 
	 		
	 			else if($("#gameStatus").html() == "next") {
	 			
	 				$("#gameStatus").html("Preparing next round");
	 				
	 					setTimeout(function() {
	 						
	 						window.location = window.location;
	 						
	 					}, 3000);
	 				
	 			
	 			}
	 		
	 			else if($("#gameStatus").html() == "paused"){
	 			
	 				$("#gameStatus").html("Paused");
	 			
					$("#myCards").html("");
					
	 			}
	 		
	 			else if($("#gameStatus").html() == "ended"){
	 			
	 				endGame();
					
	 			}
	 		
	 			else {}
	 			
	 	});
	
	}, 1000);

	function fillCards() {
	
		// load cards into hidden element then compare 

	$("#hiddenCards").load("../session/" + sessionStorage.getItem("gameStatus") + "/cards/" + localStorage.getItem("accountInformation") + ".html", function(responseTxt, statusTxt, xhr) {
	
	// if user just joined game his file would not exist and so his cards should be filled up by picking four (myCards must be checked to be empty because card file might not have been saved on picking a card and Ajax will still return 404)
	
	if(xhr.status == 404 && $("#myCards").html() == "") {
	
			pick(4);
	
	}
	
	else {
		
	// if cards have been changed
	
		if($("#hiddenCards .cards").length !== $("#myCards .cards").length) {
		
			// refresh them
		
			$("#myCards").load("../session/" + sessionStorage.getItem("gameStatus") + "/cards/" + localStorage.getItem("accountInformation") + ".html", function() {
			
				// and return their event listener 
	
				activateCardEventListener();
			
			});
	
		}
		
		}

	});

}
	
// function handling picking of cards

var picking = false;

function pick(amount) {

	picking = true;

	var currentAmount = 1;
	
	pickOne();
	
	function pickOne() {
	
		var lnth = $("#market .cards").length; 
		
		$("#market").children(".cards").eq(lnth - 1).animate({
			top: "500px"
		}, 200);
		
		$("#cardSelectionIndex").load("../session/" + sessionStorage.getItem("gameStatus") + "/cardSelectionIndex.txt", function() {
			
		
			// before picking card check if cards in market are still remaining
			
			if(Number($("#cardSelectionIndex").html()) > 53) {
			
				// if not turn card Selection Index file content to zero through AJAX
			
				$.ajax({
					type: "POST",
					url: "../scripts/whot/filesUpdater.php",
					data: {
						gameFolder: sessionStorage.getItem("gameStatus"),
						request: "emptyCardSelectionIndex"
					},
					cache: false
				});
				
				// also empty card stack except from card on the top
				
				var reshuffling = true; 
				
				var x = 0;
				
				while(x < $("#cardStack").children(".cards").length - 1) {
				
					$("#cardStack").children(".cards").eq(x).remove();
				
					x++;
				
				}
				
				setTimout(function() {
	
					reshuffling = false;
					
				}, 500);
				
				// and finally update card stack
			
				updateCardStack();
		
			}
			
		setTimeout(function() {
	
			var cardIndex = cardSelectionArray[Number($("#cardSelectionIndex").html())];

			
			var randomCard = '<button class="cards"> <label class="number">' + cardSelection[cardIndex].point + '</label> <br><br> <div class="smallShape"> <span class="small' + cardSelection[cardIndex].shape + '">  </span> </div> <br> <div class="largeShape"> <span class="' + cardSelection[cardIndex].shape + '">  </span> </div>  <div class="smallShape2"> <span class="small' + cardSelection[cardIndex].shape + '">  </span> </div> <br><br> <label class="number2">' + cardSelection[cardIndex].point + '</label> </button>';
	
			$("#myCards").append(randomCard);
			
				// update card selection index file 
			
				$.ajax({
					type: "POST",
					url: "../scripts/whot/filesUpdater.php",
					data: {
						gameFolder: sessionStorage.getItem("gameStatus"),
						request: "updateCardSelectionIndex"
					},
					cache: false,
					success: function() {
					
						$("#market").children(".cards").eq(lnth - 1).remove();
		
						repeat();
	
					}
				});
			
				}, 500);
	
			});
			
	}
	
	
	
	function repeat() {
	
	if(currentAmount < amount) {
	
		currentAmount++;
	
		pickOne();
	
	}
	
	else {
	
		picking = false;
	
		// call the updateCards function 
	
		updateCards();

	}
	
	}
			
}

function updateCards() {

// update cards
		 
	$.ajax({
		type: "POST",
		url: "../scripts/whot/filesUpdater.php",
		data: {
			gameFolder: sessionStorage.getItem("gameStatus"),
			request: "updateCards",
			cards: $("#myCards").html(),
			username: localStorage.getItem("accountInformation")
		},
		cache: false
		
	});
	
}
/*
	toast( "aaa" );
	
	setTimeout(function() {
	
	toast( "" );
	}, 700);
	*/
// function to update current player index 

function updateCurrentPlayer() {

	$.ajax({
		type: "POST",
		url: "../scripts/whot/filesUpdater.php",
		data: {
			gameFolder: sessionStorage.getItem("gameStatus"),
			request: "updateCurrentPlayer",
			maxIndex: participantsArray.length - 1
		},
		cache: false
	});

}


// function to play a card as the current player

function playAsCurrentPlayer(number) {
	
	// call the updateCards function 
	
	updateCards();
	
	// update playerStatus of himself as true

	$.ajax({
		type: "POST",
		url: "../scripts/whot/filesUpdater.php",
		data: {
			gameFolder: sessionStorage.getItem("gameStatus"),
			request: "updatePlayerStatus",
			name: localStorage.getItem("accountInformation"),
			status: "true"
		},
		cache: false
	});
	
	updateCardStack();
	
	// update command file to the number on the card he played
	
	$.ajax({
		type: "POST",
		url: "../scripts/whot/filesUpdater.php",
		data: {
			gameFolder: sessionStorage.getItem("gameStatus"),
			request: "updateCommand",
			number: number
		},
		cache: false
	});
	
	// also execute commands like pick two which may have been played by player
	
	executeCommands(number);
	
	// then call function which will do the necessary if he just played his last card( won )
	
	awardPosition();
			
}
	
// function to play a card as a successive player

function playAsSuccessivePlayer(number) {

	// call the updateCards function 
	
	updateCards();

	// update playerStatus of current player to false

	$.ajax({
		type: "POST",
		url: "../scripts/whot/filesUpdater.php",
		data: {
			gameFolder: sessionStorage.getItem("gameStatus"),
			request: "updatePlayerStatus",
			name: participantsArray[Number($("#currentPlayer").html())].trim().toLowerCase().replace(/ /g,  ""),
			status: "false"
		},
		cache: false
	});

	// update playerStatus of himself as true( he is now the current player )

	$.ajax({
		type: "POST",
		url: "../scripts/whot/filesUpdater.php",
		data: {
			gameFolder: sessionStorage.getItem("gameStatus"),
			request: "updatePlayerStatus",
			name: localStorage.getItem("accountInformation"),
			status: "true"
		},
		cache: false,
		success: function() {
		
			// then update current player index 
	
			updateCurrentPlayer();
			
			updateCardStack();
		
			// also execute commands like pick two which may have been played by player
	
			executeCommands(number);
			
			// then call function which will do the necessary if he just played his last card( won )
	
			awardPosition();
			
		}
	});
	
	// update command file to the number on the card he played
	
	$.ajax({
		type: "POST",
		url: "../scripts/whot/filesUpdater.php",
		data: {
			gameFolder: sessionStorage.getItem("gameStatus"),
			request: "updateCommand",
			number: number
		},
		cache: false
	});
	
}
	
// function to update card Stack

function updateCardStack() {

	$.ajax({
		type: "POST",
		url: "../scripts/whot/filesUpdater.php",
		data: {
			gameFolder: sessionStorage.getItem("gameStatus"),
			request: "updateCardStack",
			cardStack: $("#cardStack").html()
		},
		cache: false
	});

}


	// function which will update command file with the number on played card

function updateCommandFile() {

	$.ajax({
		type: "POST",
		url: "../scripts/whot/filesUpdater.php",
		data: {
			gameFolder: sessionStorage.getItem("gameStatus"),
			request: "updateCommand",
			number: number
		},
		cache: false
	});
	
}

		// function which will display sums of card numbers of each player if someone checks in a highest number out game
		
		function displaySums() {
		
			var highestSum = 0;
		
			var y = 0;
			
			begin();
			
			function begin() {
		
				var url = '../session/' + sessionStorage.getItem('gameStatus') + '/cards/' + participantsArray[y].trim().toLowerCase().replace(/ /g,  '') + '.html';
						
				 $("#cardsHolder").load(url, function() {
			 	
			 		var i = 0;
			 	
			 		var sum = 0;
			 	
					 while(i <  $("#cardsHolder .cards").length)  {
			 	
			 		sum += Number( $("#cardsHolder .cards").eq(i).children(".number").html() );
			 	
			 		i++;
			 	
			 	}
			 			
			 	if(sum > highestSum)  {
			 			
			 		highestSum = sum; 
			 			
			 	}
			 	
			 	$(".othersCards").eq(y).after('<button class="eachSum">' + sum + '</button>');
			
					if(y == participantsArray.length - 1) {
							
						displayLoser();
							
					}
							
					if(y < participantsArray.length) {
							
						y++;
								
						repeat();
							
					}
							
			 	});
		
			}
					
			function repeat() {
			
					begin();
					
			}
					
			function displayLoser() {
					
				var i = 0;
						
				while(i < participantsArray.length) {
						
					if($(".eachSum").eq(i).html() == highestSum) {
							
						$(".eachParticipant").eq(i).css({
							background: "red"
						});
							
					}
							
					i++;
						
				}
					
				setTimeout(function() {
									
					window.location = window.location;
								
				}, 2000);
							
			}

		}
	
	
function endGame() {

	 $("#gameStatus").html("");
	 			
	// check what check type this game session is using
	 			
	$("#checkType").load("../session/" + sessionStorage.getItem("gameStatus") + "/checkType.txt", function() {
	 				
	 	// if it is Individual check(single)
	 			
	 	if($("#checkType").html() == "Individual check(Single)") {
	 					
			$("#myCards").html("");
	
			$("#othersCardsHolder").css("display", "none");
					
			$("#cardStack").css("display", "none");
					
			$("#market").css("display", "none");
			
			// load backup participants array

			var backupParticipantsArrayScript = '<script src="../session/' + sessionStorage.getItem("gameStatus") + '/backupParticipantsArray.js"></script>';
	
			$("body").append(backupParticipantsArrayScript);
			
			// load position array 

			var positionArrayScript = '<script src="../session/' + sessionStorage.getItem("gameStatus") + '/positionArray.js"></script>';
	
			$("body").append(positionArrayScript);
			
			// create full position depending on number of participants 
			
			var x = 0;
			
			var finalPosition = "";
	
			var positionHolders = "";
	
			while(x < backupParticipantsArray.length) {
			
	 			var positionSuffix = "";
	 								
	 			if(x + 1 == 1) {
	 								
	 				positionSuffix = "st";
	 									 								
				}		
				
	 			else if(x + 1 == 2) {
	 								
	 				positionSuffix = "nd";
	 									 								
				}
										
	 			else if(x + 1 == 3) {
	 								
	 				positionSuffix = "rd";
	 									 								
				}
										
	 			else {
	 								
	 				positionSuffix = "th";
	 									 								
				}
								
				finalPosition += "<p>" + (x + 1) + positionSuffix + " position</p>";
				
				positionHolders += "<p>" + positionArray[x] + "</p>";
				
				x++;
			
			}
			
			$("#finalPositionColumn1").html(finalPosition);
					
			$("#finalPositionColumn2").html(positionHolders);
					
		}
		
	});

}


// function which will display winner to everyone 

function displayWinner() {

	 				// check what check type this game session is using
	 			
	 				$("#checkType").load("../session/" + sessionStorage.getItem("gameStatus") + "/checkType.txt", function() {
	 				
	 					// if it is Individual check(single)
	 			
	 					if($("#checkType").html() == "Individual check(Single)") {
	 					
	 						// display position and name of winner
	 			
	 						$("#position").load("../session/" + sessionStorage.getItem("gameStatus") + "/position/position.txt", function() {
	 			
	 							$("#positionHolder").load("../session/" + sessionStorage.getItem("gameStatus") + "/position/positionHolder.txt", function() {
	 			
	 								var positionSuffix = "th";
	 								
	 								if($("#position").html() == "1") {
	 								
	 									positionSuffix = "st";
	 									 								
									}
									
									else if($("#position").html() == "2") {
	 								
	 									positionSuffix = "nd";
	 									 								
									}
									
									else if($("#position").html() == "3") {
	 								
	 									positionSuffix = "rd";
	 									 								
									}
									
									else {
	 								
	 									positionSuffix = "th";
	 									 								
									}
									
	 								
	 								remark($("#position").html() + positionSuffix + " position: " + $("#positionHolder").html());
	 						
	 								setTimeout(function() {
	 						
	 									window.location = window.location;
	 						
	 								}, 3000);
	 				
	 							});
	 				
	 						});
	 				
	 					}
	 				
			 // else if it is Individual check(Recurring)
	 			
 			else if($("#checkType").html() == "Individual check(Recurring)") {
 		
	 						// display position and name of winner
	 			
	 						$("#position").load("../session/" + sessionStorage.getItem("gameStatus") + "/position/position.txt", function() {
	 			
	 							$("#positionHolder").load("../session/" + sessionStorage.getItem("gameStatus") + "/position/positionHolder.txt", function() {
	 			
	 								var positionSuffix = "th";
	 								
	 								if($("#position").html() == "1") {
	 								
	 									positionSuffix = "st";
	 									 								
									}
									
									else if($("#position").html() == "2") {
	 								
	 									positionSuffix = "nd";
	 									 								
									}
									
									else if($("#position").html() == "3") {
	 								
	 									positionSuffix = "rd";
	 									 								
									}
									
									else {
	 								
	 									positionSuffix = "th";
	 									 								
									}
									
	 								
	 								remark($("#position").html() + positionSuffix + " position: " + $("#positionHolder").html());
	 						
	 								setTimeout(function() {
	 						
	 									window.location = window.location;
	 						
	 								}, 1000);
	 				
	 							});
	 				
	 						});
	 						
 			}
 			
 			
			 // else if it is Highest number out
	 			
 			else if($("#checkType").html() == "Highest number out") {
 		
	 						// display position and name of winner
	 			
	 						$("#position").load("../session/" + sessionStorage.getItem("gameStatus") + "/position/position.txt", function() {
	 			
	 							$("#positionHolder").load("../session/" + sessionStorage.getItem("gameStatus") + "/position/positionHolder.txt", function() {
	 			
	 								var positionSuffix = "th";
	 								
	 								if($("#position").html() == "1") {
	 								
	 									positionSuffix = "st";
	 									 								
									}
									
									else if($("#position").html() == "2") {
	 								
	 									positionSuffix = "nd";
	 									 								
									}
									
									else if($("#position").html() == "3") {
	 								
	 									positionSuffix = "rd";
	 									 								
									}
									
									else {
	 								
	 									positionSuffix = "th";
	 									 								
									}
								
									if($("#hasRepeated").html() !== "true") {
									
									$("#hasRepeated").html("true");
	 								
	 								remark($("#position").html() + positionSuffix + " position: " + $("#positionHolder").html());
	 										
 									displaySums();
 									
 									}
 				
	 						});
	 						
	 				});
	 				
 			}
 			
	 		else {}
	 				
	 });
	 
	 
}