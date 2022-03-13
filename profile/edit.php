	<?php
	
		if(!empty($_POST["passwordConfirmed"])) {
	
			if($_POST["passwordConfirmed"] !== "true") {
		
				echo '<script>
			
					window.location.replace("../scripts/passwordConfirmer.php?return=" + window.location);
			
				</script>';
		
			}
		
		}
		
		else {
		
			echo '<script>
			
				window.location.replace("../scripts/passwordConfirmer.php?return=" + window.location);
			
			</script>';
		
		}
	
	?>
	
	<!DOCTYPE html>

	<html>
	
		<head>
		
			<title>Scrabble</title>
			
			<link rel="stylesheet" href="../styles/index.css">
			
			<link rel="stylesheet" href="../styles/templates.css">
			
			<style>
			
				body {
					text-align: center;
				}
			
				#profilePictureHolder {
					height: 50vw;
					width: 50vw;
					background-color: green; 
					position: absolute;
					top: 5cm;
					 -ms-transform: translateX(-50%);
  					transform: translateX(-50%);
  					border: none;
				}
				
				#profilePicture {
					height: 100%;
					width: 100%;
					border-radius: 50%;
					opacity: 0.5;
					border: 3px dotted white;
				}
				
				#inpProfilePicture {
					width: 0.1px; 	
					height: 0.1px; 	
					opacity: 0; 	
					overflow: hidden; 	
					position: absolute; 	
					z-index: -1;
				}
				
				#inpProfilePicture + label {
					background-color: blue; 
					display: inline-block; 
					cursor: pointer;
					text-align: center;
					height: 26%;
					width: 26%;
					border-radius: 50%;
					position: absolute;
					top: 37%;
					left: 37%;
				} 
				
				#inpProfilePicture + label:active {
					background-color: red; 
					height: 24%;
					width: 24%;
					top: 38%;
					left: 38%;
				} 
				
				#inpProfilePicture + label svg {
					font-weight: 700; 
					color: white; 
					height: 60%;
					width: 60%;
					margin-top: 20%;
				} 

				#leftAlignedHolder {
					width: 50%;
					float: left;
					text-align: left;
					margin-top: 50vw;
				}
				
				.leftAligned {
					font-size: 6vw;
					font-weight: 300;
					color: white;
					font-family: times;
					margin: 10px;
				}
			
				#rightAlignedHolder {
					width: 50%;
					float: right;
					text-align: left;
					margin-top: 50vw;
				}
				
				.rightAligned {
					font-size: 6vw;
					font-weight: 300;
					color: cyan;
					font-family: times;
					margin: 10px;
					background-color: green;
				}
				
				#btnUpdate {
					background-color: indigo;
					border-radius: 20%;
					float: right;
					font-size: 5vw;
					font-weight: 700;
					color: white;
					margin: 10px;
					height: 12vw;
					width: 35vw;
				}
				
				#btnCancel {
					background-color: red;
					border-radius: 20%;
					float: left;
					font-size: 5vw;
					font-weight: 700;
					color: white;
					margin: 10px;
					height: 12vw;
					width: 35vw;
				}
				
				
			</style>
			
		</head>
		
		<body>
		
			<div class="sideNav"></div>
		
			<button class="header"></button>
		
			<button class="titleBar">Edit Profile</button>
		
			<br><br><br><br><br><br><br><br><br><br><br><br>
			
			<button id="profilePictureHolder">
			
				<img id="profilePicture"></img>
			
				<input type="file" id="inpProfilePicture">
				
				<label for="inpProfilePicture"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> </label>
				
			</button>
			
			<br><br><br><br>
			
			<br><br><br>
			
			<div id="leftAlignedHolder">
		
			<p class="leftAligned">Username</p>
		
			<p class="leftAligned">Email Address</p>
		
			<p class="leftAligned">Gender</p>
		
			<br><br><br><br>
		
			<p class="leftAligned">Password</p>
			
			<br>
		
			<button class="leftAligned" id="btnCancel">Cancel</button>
		
			</div>
		
			<div id="rightAlignedHolder">
		
			<input class="rightAligned" id="username">
		
			<input class="rightAligned" id="email">
		
			<input type="radio" class="rightAligned" id="genderMale" name="email">
			
			<label class="rightAligned">Male</label>
			
			<br>
		
			<input type="radio" class="rightAligned" id="genderFemale" name="email">
			
			<label class="rightAligned">Female</label>
		
			<input class="hidden" id="gender">
			
			<input class="rightAligned" id="password" type="password">
		
			<br><br>
		
			<button class="rightAligned" id="btnUpdate">Apply Changes</button>
		
		
			</div>
		
			 <script src="../scripts/JQuery.js"></script>
	 
			 <script src="../scripts/templates.js"></script>
	 
			 <script src="../scripts/profile.js"></script>
	 
			 <script src="../scripts/methods.js"></script>
			 
			 <script>
			 
				$.ajax({
					type: "POST",
					url: "../scripts/accounts.php",
					data: {
						request: "myProfileUsercode",
						username: localStorage.getItem("scrabblitUsername")
					},
					success: function(response) {
				
						var usercode = response; 
			
						$("#profilePicture").attr("src", "../images/profilePictures/" + usercode + ".jpg");
			
						$("#btnCancel").click(function() {
			
							window.location.href = "../profile?id=" + usercode;
			
						});
				
						$("#inpProfilePicture").change(function() {
						
							var fd = new FormData();
							
							var files = $('#inpProfilePicture')[0].files;
							
							if(files.length > 0 ) {
							
								fd.append('picture', files[0]);
								
								fd.append('request', "previewPicture");
								
								fd.append('usercode', usercode);
							
								$.ajax({
									type: "POST",
									url: "../scripts/profiles.php",
									data: fd,
									contentType: false,
									processData: false,
									success: function(response) {
									
										if(response.length !== 0) {
									
											toast(response);
											
											$("#inpProfilePicture").val("");
											
											$("#profilePicture").attr("src", "../images/profilePictures/" + usercode + ".jpg");
											
										}
										
										else {
										
											$("#profilePicture").attr("src", "../images/avatar/" + gender + ".jpg");
											
											setTimeout(function() {
										
												$("#profilePicture").attr("src", "../images/preview/" + usercode + ".jpg");
			
											}, 500);
			
										}
									
									}
								});
								
							}
							
						});
						
							
						$("#btnUpdate").click(function() {
						
							if($("#inpProfilePicture").val() !== "") {
											
								$.ajax({
									type: "POST",
									url: "../scripts/profiles.php",
									data: {
										request: "updateProfilePicture",
										usercode: usercode
									}
								});
								
							}
								
							$.ajax({
								type: "POST",
								url: "../scripts/profiles.php",
								data: {
									request: "editProfile",
									usercode: usercode,
									username: $("#username").val(),
									password: $("#password").val(),
									email: $("#email").val(),
									gender: $("#gender").val()
								},
								success: function(response) {
								
									if(response == "success") {
									
										toast("Your profile has been successfully updated");
										
										window.location.href = "../profile?id=" + usercode;
										
										localStorage.setItem("scrabblitUsername", $("#username").val());
									
										localStorage.setItem("accountInformation", $("#username").val().toLowerCase().replace(/ /g,  ""));
									
									}
									
									else {
									
										toast("Update error");
									
									}
									
								},
								error: function() {
								
									toast("error");
									
								}
							});
							
						});
				
						$.ajax({
							type: "POST",
							url: "../scripts/profiles.php",
							dataType: "JSON",
							data: {
								request: "profileData",
								usercode: usercode
							},
							success: function(response) {
				
								$("#username").val(response[0].username);
			
								$("#email").val(response[0].email);
			
								$("#gender").val(response[0].gender);
						
								if(response[0].gender == "male") {
						
									$("#genderMale").attr("checked", "ischecked");
									
								}
						
								else {
						
									$("#genderFemale").attr("checked", "ischecked");
						
								}
						
								$("#password").val(response[0].password);
			
								var username =  $("#username").val();
						
							}
						});
				
					}
				});
			
				$("#genderMale").click(function() {
						
					$("#gender").val("male");
					
				});
							
				$("#genderFemale").click(function() {
						
					$("#gender").val("female");
					
				});
				
				
				
			 </script>
			 
		</body>
	 
	</html>
	
	