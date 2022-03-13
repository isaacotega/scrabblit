// function which will do the necessary if he just played his last card( won )

function awardPosition() {

	// first check if it is his last card
			
	if($("#myCards .cards").length == 0) {

		// first load check type file
			
		$("#checkType").load("../session/" + sessionStorage.getItem("gameStatus") + "/checkType.txt", function() {
		
			// if check type is Individual check(Single)
		
			if($("#checkType").html() == "Individual check(Single)") {
			
				// remove players name from participants array 
				participantsArray.splice(participantsArray.indexOf(localStorage.getItem("scrabblitUsername")), 1);
				
				// loop through participants array to create a new array without winners name
				
			var newParticipantsArray = "";
			
			var x = 0;
				
			while(x < participantsArray.length) {
			
				// check if this is the last players name
			
				if(x + 1 !== participantsArray.length) {
				
					// if so add comma and space
			
					newParticipantsArray += '"' + participantsArray[x] + '", ';
					
				}
				
				else {
				
					// if not dont add any comma
				
					newParticipantsArray += '"' + participantsArray[x] + '"';
					
				}
				
				x++;
			
			}

			// update participants array without winners name 
			
			$.ajax({
				type: "POST",
				url: "../scripts/whot/filesUpdater.php",
				data: {
					gameFolder: sessionStorage.getItem("gameStatus"),
					request: "updateParticipantsArray",
					array: newParticipantsArray
				},
				cache: false,
				success: function() {
		
			// update position array with winners name 
			
			$.ajax({
				type: "POST",
				url: "../scripts/whot/filesUpdater.php",
				data: {
					gameFolder: sessionStorage.getItem("gameStatus"),
					request: "updatePositionArray",
					name: localStorage.getItem("scrabblitUsername")
				},
				cache: false,
				success: function() {
		
			// update position and positionHolder file
			
			$.ajax({
				type: "POST",
				url: "../scripts/whot/filesUpdater.php",
				data: {
					gameFolder: sessionStorage.getItem("gameStatus"),
					request: "updatePosition",
					action: "increment",
					name: localStorage.getItem("scrabblitUsername")
				},
				cache: false,
				success: function() {
				
					updateCurrentPlayer();
			
					remark("Check!");
					
					toast("Check!");
					
					// updateStatus to won so winners name can be displayed on every players screen
					
					updateStatus("won");
					
					setTimeout(function() {
					
	 					// check if the length of participants array is one ( that means it is the second to the last person who just checked) 
	 				
	 					if(participantsArray.length == 1) {
	 				
	 						// if so send the last persons name to position array
	 						
	 						$.ajax({
								type: "POST",
								url: "../scripts/whot/filesUpdater.php",
								data: {
									gameFolder: sessionStorage.getItem("gameStatus"),
									request: "updatePositionArray",
									name: participantsArray[participantsArray.length - 1]
								},
								cache: false,
								success: function() {
								
									// then empty participants array
								
									$.ajax({
										type: "POST",
										url: "../scripts/whot/filesUpdater.php",
										data: {
											gameFolder: sessionStorage.getItem("gameStatus"),
											request: "updateParticipantsArray",
											array: ""
										},
										cache: false,
										success: function() {
		
	 										// finally update status to ended

											updateStatus("ended");
											
										}
									});
									
								}
							});
	 					
	 					}
	 					
	 					else {
	 					
	 						// if not update status back to ongoing
	 				
							updateStatus("ongoing");
							
						}
					
					}, 1000);
					
					}
					});
					
				}
				});
					
			}
			});
			
			}
			
			
			
			
			
			
			
			// if check type is Individual check(Recurring)
		
			if($("#checkType").html() == "Individual check(Recurring)") {
				
				remark("Check!");
					
				toast("Check!");
				
				// updateStatus to won so win information can be displayed on every players screen
					
				updateStatus("won");
				
				setTimeout(function() {
				
					updateStatus("ongoing");
				
				}, 2000);
								
				// remove players name from participants array 
				participantsArray.splice(participantsArray.indexOf(localStorage.getItem("scrabblitUsername")), 1);
				
				// loop through participants array to create a new array without winners name
				
			var newParticipantsArray = "";
			
			var x = 0;
				
			while(x < participantsArray.length) {
			
				// check if this is the last players name
			
				if(x + 1 !== participantsArray.length) {
				
					// if so add comma and space
			
					newParticipantsArray += '"' + participantsArray[x] + '", ';
					
				}
				
				else {
				
					// if not dont add any comma
				
					newParticipantsArray += '"' + participantsArray[x] + '"';
					
				}
				
				x++;
			
			}
			
			// update participants array without winners name 
			
			$.ajax({
				type: "POST",
				url: "../scripts/whot/filesUpdater.php",
				data: {
					gameFolder: sessionStorage.getItem("gameStatus"),
					request: "updateParticipantsArray",
					array: newParticipantsArray
				},
				cache: false,
				success: function(responseTxt, statusTxt,  xhr) {
				
				// update position and positionHolder file
			
					$.ajax({
						type: "POST",
						url: "../scripts/whot/filesUpdater.php",
						data: {
							gameFolder: sessionStorage.getItem("gameStatus"),
							request: "updatePosition",
							action: "increment",
							name: localStorage.getItem("scrabblitUsername")
						},
						cache: false,
						success: function() {
					// @@@@@@@@
					
					
	 						// check if the length of participants array is one ( that means it is the second to the last person who just checked) 
	 				
	 						if(participantsArray.length == 1) {
	 					
	 							//  if so create new participants array without losers name through AJAX 
	 						
								// remove losers name name from backup participants array 
				
								backupParticipantsArray.splice(backupParticipantsArray.indexOf(participantsArray[0]), 1);
						
								// loop through backup participants array to create a new array without winners name
				
								var newParticipantsArray = "";
			
								var x = 0;
				
								while(x < backupParticipantsArray.length) {
			
									// check if this is the last players name
			
									if(x + 1 !== backupParticipantsArray.length) {
				
										// if so add comma and space
			
										newParticipantsArray += '"' + backupParticipantsArray[x] + '", ';
					
									}
				
									else {
				
										// if not dont add any comma
				
										newParticipantsArray += '"' + backupParticipantsArray[x] + '"';
					
									}
				
									x++;
			
								}
			
							// update participants array with the newly updated backup through AJAX 
				
							$.ajax({
								type: "POST",
								url: "../scripts/whot/filesUpdater.php",
								data: {
									gameFolder: sessionStorage.getItem("gameStatus"),
									request: "updateParticipantsArray",
									array: newParticipantsArray
								},
								cache: false,
								success: function() {
								
									// update backup participants array without winners name 
			
									$.ajax({
										type: "POST",
										url: "../scripts/whot/filesUpdater.php",
										data: {
											gameFolder: sessionStorage.getItem("gameStatus"),
											request: "updateBackupParticipantsArray",
											array: newParticipantsArray
										},
										cache: false,
										success: function() {
										
											// make an AJAX call which will update all files
								
											$.ajax({
												type: "POST",
												url: "../scripts/whot/filesReverser.php",
												data: {
													gameFolder: sessionStorage.getItem("gameStatus")
												},
												cache: false,
												success: function() {
													
													// finally check if backup participants array length is not one ( if it is one it means the second to the last person has won on the last round and thus the game has permanently ended)
			//		toast(backupParticipantsArray.length  );
													if(backupParticipantsArray.length !== 1) {
													
														// if not
												
														updateStatus("next");

														setTimeout(function() {
					
															updateStatus("ongoing");

														}, 5000);
													
											//			toast( "yeahhh" );
														
													}
													
													else {
													
														// if so end game for all timeout to override status update to ongoing above
													
														setTimeout(function() {
														
															updateStatus("ended");
													
														//	toast( "yeaaaa" );
														
														}, 2000);
							
													}
				
												}
											});
								
											}
										});
			
									}
								});
						
							}
					
					// @@@@@
					
						}
					});
				
				}
			});
			
			
	 					
			}
			
			
			
			
			
			
			// if check type is Individual check(Recurring)
		
			if($("#checkType").html() == "Highest number out") {
				
				// updateStatus to won so win information can be displayed on every players screen
					
				updateStatus("won");
				
				remark("Check!");
					
				toast("Check!");
				
				// code block which will remove player with the highest sum of numbers on his card from participants array 
	
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
							
							generateLoser();
							
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
					
				function generateLoser() {
					
					var i = 0;
						
					while(i < participantsArray.length) {
						
						if($(".eachSum").eq(i).html() == highestSum) {
						
						// when the losers index has finally been generated carry on with normal procedures 
							
							remark("Higest number holder: " + participantsArray[i]);
												
							participantsArray.splice(i - 1, 1);
				
							// loop through participants array to create a new array without winners name
				
							var newParticipantsArray = "";
			
							var x = 0;
				
							while(x < participantsArray.length) {
			
								// check if this is the last players name
			
								if(x + 1 !== participantsArray.length) {
				
									// if so add comma and space
			
									newParticipantsArray += '"' + participantsArray[x] + '", ';
					
								}
				
								else {
				
									// if not dont add any comma
				
									newParticipantsArray += '"' + participantsArray[x] + '"';
					
								}
				
								x++;
			
							}
			
							// update participants array without winners name 
			
							$.ajax({
								type: "POST",
								url: "../scripts/whot/filesUpdater.php",
								data: {
									gameFolder: sessionStorage.getItem("gameStatus"),
									request: "updateParticipantsArray",
									array: newParticipantsArray
								},
								cache: false,
								success: function(responseTxt, statusTxt,  xhr) {
				
								// update position and positionHolder file
			
									$.ajax({
										type: "POST",
										url: "../scripts/whot/filesUpdater.php",
										data: {
											gameFolder: sessionStorage.getItem("gameStatus"),
											request: "updatePosition",
											action: "decrement",
											name: localStorage.getItem("scrabblitUsername"),
											initialPosition: participantsArray.length
										},
										cache: false,
										success: function() {
										
											setTimeout(function() {
																				
	 											// check if the length of participants array is one ( that means it is the second to the last person who just checked) 
	 				
	 											if(participantsArray.length == 1) {
	 										
	 												// if so end game
	 											
													updateStatus("ended");	
	 										
	 											}
	 										
	 											if(participantsArray.length !== 1) {
	 										
	 												// if not continue game 
	 										
													updateStatus("ongoing");
												
												}
											
											}, 1000);
	 					
										}
									});
									
								}
							});
										
						}
							
						i++;
						
					}
					
				}							
				
		
	
		}
		
		
		
		
		
			
 // (ends of if statement which executes different endings of game depending on the loaded check type) 
			
			
		}); // (ends AJAX call which loads check type) 
		
	} // (ends if statement which ensures it is last player) 

} // (ends awardPosition function) 




// function which will update status 
			
function updateStatus(status) {
	
	$.ajax({
		type: "POST",
		url: "../scripts/whot/filesUpdater.php",
		data: {
			gameFolder: sessionStorage.getItem("gameStatus"),
			request: "updateGameStatus",
			status: status
		},
		cache: false
	});
	
}
	