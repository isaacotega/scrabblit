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
			
				#profilePicture {
					height: 50vw;
					width: 50vw;
					border-radius: 50%;
				}

				 #username {
					font-size: 15vw;
					font-weight: 700;
					color: indigo;
					font-family: times;
				}
				
				#leftAlignedHolder {
					width: 50%;
					float: left;
					text-align: left;
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
				}
				
				.rightAligned {
					font-size: 6vw;
					font-weight: 300;
					color: cyan;
					font-family: times;
					margin: 10px;
				}
			
			</style>
			
		</head>
		
		<body>
		
			<div class="sideNav"></div>
		
			<button class="header"></button>
		
			<br><br><br><br><br><br><br><br>
			
			<img id="profilePicture"></img>
			
			<br><br><br><br><br><br>
			
			<label id="username"></label>
			
			<br><br><br>
			
			<div id="leftAlignedHolder">
		
			<p class="leftAligned">Email Address</p>
		
			<p class="leftAligned">Gender</p>
		
			<p class="leftAligned">Favourite Game</p>
			
			<p class="leftAligned">No of games hosted</p>
			
			<p class="leftAligned">No of games played</p>
			
			</div>
		
			<div id="rightAlignedHolder">
		
			<p class="rightAligned" id="email"></p>
		
			<p class="rightAligned" id="gender"></p>
		
			<p class="rightAligned" id="favouriteGame">Whot</p>
		
			</div>
		
	 <!--
				<input type="file" id="password" placeholder="Enter Password">
	 -->
			 <script src="../scripts/JQuery.js"></script>
	 
			 <script src="../scripts/templates.js"></script>
	 
			 <script src="../scripts/methods.js"></script>
			 
			 <script>
			 
			 	var usercode = '<?php echo $_GET["id"] ?>';
			 
				$.ajax({
					type: "POST",
					url: "../scripts/profiles.php",
					dataType: "JSON",
					data: {
						request: "profileData",
						usercode: usercode
					},
					success: function(response) {
				
						$("#profilePicture").attr("src", "../images/profilePictures/" + usercode + ".jpg");
			
						$("#username").html(response[0].username);
			
						$("#email").html(response[0].email);
			
						$("#gender").html(response[0].gender);
			
						$("#favouriteGame").html(response[0].favouriteGame);
			
					}
				});
				
				$.ajax({
					type: "POST",
					url: "../scripts/accounts.php",
					data: {
						request: "myProfileUsercode",
						username: localStorage.getItem("scrabblitUsername")
					},
					success: function(response) {
				
						if(response == '<?php echo $_GET["id"] ?>') {
						
							$(".navIcon").after('<a href="edit.php"> <img class="headIcon" src="../images/icons/edit.png"></img> </a>');
						
						}
			
					}
				});
				
			 </script>
			 
		</body>
	 
	</html>