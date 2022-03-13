$(document).ready(function() {	

	var gender;

	$("#male").click(function() {
	
		gender = $(this).attr("id");
	
	});

	$("#female").click(function() {
	
		gender = $(this).attr("id");
	
	});

	$("#btnSignUp").click(function() {
	
		var username = $("#username").val().trim().replace(/  /g,  " ");
		
		var usercode = rn() + rn() + rn() + rn() + rn() + rn() + rn() + rn() + rn() + rn() + rn() + rn() + rn() + rn() + rn() + rn() + rn() + rn() + rn() + rn();
		
		function rn() {
		
			return String(Math.floor(Math.random() * 10));
		
		}
		
		if(username !== "" && $("#password").val() !== "" && $("#email").val() !== "" && gender !== undefined) {
		
			$.ajax({
				type: "POST",
				url: "../scripts/accounts.php",
				data: {
					request: "register",
					username: username,
					password: $("#password").val(),
					email: $("#email").val(),
					gender: gender,
					usercode: usercode
				},
				success: function(response, statusTxt,  xhr) {
				
					if(xhr.status !== 200) {
					
						toast("Error processing request. Please try again");
					
					}
					
					else {
					
						if(response == "success") {
						
							localStorage.setItem("scrabblitUsername", username);
						
							localStorage.setItem("accountInformation", username.trim().toLowerCase().replace(/ /g,  ""));
						
							window.location.href = "../join-game?stage=new";
						
						}
						
						else if(response == "exist") {
						
							toast("This account already exists");
						
						}
						
						
						else {
						
							toast("Error processing request. Please try again");
						
						}
						
					}
				
				},
				error: function() {
				
					toast("Unable to connect to server. Please ensure cellular data or wi-fi network is active");
				
				}
			});
		
		}
		
		else {
		
			toast("Please fill in the details");
		
		}

	});
	
	
	
	
	
	$("#btnLogIn").click(function() {
	
		var username = $("#username").val().trim().replace(/  /g,  " ");

		if(username !== "" && $("#password").val() !== "") {
		
			$.ajax({
				type: "POST",
				url: "../scripts/accounts.php",
				data: {
					request: "login",
					username: username,
					password: $("#password").val()
				},
				success: function(response, statusTxt,  xhr) {
				
					if(xhr.status !== 200) {
					
						toast("Error processing request. Please try again");
					
					}
					
					else {
					
						if(response == "success") {
						
							localStorage.setItem("scrabblitUsername", username);
						
							localStorage.setItem("accountInformation", username.trim().toLowerCase().replace(/ /g,  ""));
						
							returnToPreviousPage();
						
						}
						
						else if(response == "error") {
						
							toast("No account exists with this information");
						
						}
						
						else {
						
							toast("Error processing request. Please try again");
						
						}
						
					}
				
				},
				error: function() {
				
					toast("Unable to connect to server. Please ensure cellular data or wi-fi network is active");
				
				}
			});
		
		}
		
		else {
		
			toast("Please fill in the details");
		
		}

	});
});