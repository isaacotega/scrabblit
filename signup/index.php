<!DOCTYPE html>

	<html>
	
		<head>
		
			<title>Scrabble</title>
			
			<link rel="stylesheet" href="../styles/index.css">
			
			<link rel="stylesheet" href="../styles/templates.css">
			
		</head>
		
		<body>
		
			<div class="sideNav"></div>
		
			<button class="header"></button>
		
			<br><br><br><br>
		
	 
	 		<form id="frmSignUp" class="form">
	 
				<label class="formHeading">Sign up</label>
	 
	 			<br><br>
	
				<input id="username" placeholder="Enter Username">
	 
	 			<br><br>
	
				 <input type="email" id="email" placeholder="Enter Email Address ">
	 
	 			<br><br>
	
				<input type="password" id="password" placeholder="Enter Password">
	 
	 			<br><br>
	 
	 			<div class="radioHolder"> 
	 
					<label class="lblRadio">Select Gender</label>
	 
	 				<br><br>

	 				<input id="male" class="radio" type="radio" name="gender">
	 
	 				<label class="lblRadio">Male</label>
	 
	 				<br><br>
	
					 <input id="female" class="radio" type="radio" name="gender">
	 
					 <label class="lblRadio">Female</label>
	 
				 </div>
	 
	 			<br><br>
	
	 			<button type="button" id="btnSignUp">Sign up</button>
	 
				 <br><br>
	
				 <label class="formHeading">Already have an account?</label>
	 
				 <br><br>
	
				 <a href="../login"> <button class="otherButton" type="button">Login</button> </a>
	 
			 </form>
	 
			 <script src="../scripts/JQuery.js"></script>
	 
			 <script src="../scripts/templates.js"></script>
	 
			 <script src="../scripts/accounts.js"></script>
	 
			 <script src="../scripts/methods.js"></script>
			 
		</body>
	 
	</html>