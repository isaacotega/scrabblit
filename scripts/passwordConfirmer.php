<!DOCTYPE html>

	<html>
	
		<head>
		
			<title>Scrabble</title>
			
			<link rel="stylesheet" href="../styles/index.css">
			
			<link rel="stylesheet" href="../styles/templates.css">
			
			<style>
			
			</style>
		
		</head>
		
		<body>
		
			<div class="sideNav"></div>
		
			<button class="header"></button>
	
			<form class="form" id="frmConfirmPassword" method="post" action='<?php echo $_GET["return"] ?>'>
			
				<label class="formHeading">Confirm Password</label>
				
				<br><br><br><br>
				
				<input id="inpPassword" placeholder="Enter Password" type="password">
				
				<input id="hiddenPswd" class="hidden" type="password">
				
				<input value="true" name="passwordConfirmed" class="hidden">
				
				<br><br><br>
				
				<button type="submit">Submit</button>
			
			</form>
		
		
			 <script src="../scripts/JQuery.js"></script>
	 
			 <script src="../scripts/templates.js"></script>
	 
			 <script src="../scripts/methods.js"></script>
			 
			<script>
		
					$.ajax({
						type: "POST",
						url: "accounts.php",
						data: {
							request: "myProfileUsercode",
							username: localStorage.getItem("scrabblitUsername")
						},
						success: function(response) {
					
							var usercode = response;
				
							$.ajax({
								type: "POST",
								url: "profiles.php",
								dataType: "JSON",
								data: {
									request: "profileData",
									usercode: usercode
								},
								success: function(response, statusTxt) {
								
									var password = response[0].password;
									
									$("#hiddenPswd").val(password);
									
								}
							});
				
						}
					});
					

				$("#frmConfirmPassword").submit(function() {
				
					if($("#inpPassword").val() !== $("#hiddenPswd").val()) {
				
						event.preventDefault();
						
						toast("Access denied: Wrong password");
						
					}
				
				});
		
			</script>
		
		</body>
		
	</html>
			