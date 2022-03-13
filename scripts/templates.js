// define application name

var appName = "Scrabblit";

// header template

$(".header").html('<button class="backIcon"> < </button> <label class="heading">' + appName + '</label> <span class="navIcon">&#9776;</span>');	

// define backToGame depending on user game status and manipulate side bar with it 

if(sessionStorage.getItem("gameStatus") !== null)  {

	var backToGame = '<label id="sideLinkBackToGame"> Back to Game</label> <br><br>  <label id="sideLinkDashboard"> Dashboard </label> <br><br> ';
	
}

else {

	var backToGame = '<label id="sideLinkJoinAGame">Join a Game</label> <br><br>';

}

if(localStorage.getItem("accountInformation") !== null)  {

	var profileInfo = '<img id="myProfilePicture"></img> <br> <label id="myUsername">' + localStorage.getItem("scrabblitUsername") + '</label> <br><br>';

	var accountLink = '<label id="sideLinkLogOut">Log Out</label> <br><br>';
	
}

else {

	var profileInfo = "";

	var accountLink = '<label id="sideLinkLogin">Log In</label> <br><br>';

}

// define the sidebar HTML

$(".sideNav").html(' <br><br>' + profileInfo + '<label id="sideLinkHome">Home</label> <br><br>  <label id="sideLinkNewGame"> New Game </label> <br><br>' + backToGame + accountLink + '<label id="sideLinkSettings"> Settings </label> <br><br>  <label id="sidesideLinkAbout"> About </label> <br><br>  <label id="sideLinkPrivacyPolicy"> Privacy Policy </label> <br><br> <label id="sideLinkFeedback"> Feedback </label> <br><br> <label id="sideLinkShare"> Share </label> <br><br>  <label id="sideLinkHelp"> Help </label> <br><br> ');

// sidelines event listeners

// main links

$(".sideNav #myProfilePicture").click(function() {

	goToProfile();

});

$(".sideNav #myUsername").click(function() {

	goToProfile();

});

	$.ajax({
		type: "POST",
		url: "../scripts/accounts.php",
		data: {
			request: "myProfileUsercode",
			username: localStorage.getItem("scrabblitUsername")
		},
		success: function(response) {
				
			$(".sideNav #myProfilePicture").attr("src", "../images/profilePictures/" + response + ".jpg");

		}
	});

$("#sideLinkHome").click(function() {

	window.location.href="../join-game";

});

$("#sideLinkNewGame").click(function() {

	window.location.href="../join-game?stage=info";

});

$("#sideLinkSettings").click(function() {

	window.location.href="../settings";

});

$("#sidesideLinkAbout").click(function() {

	window.location.href="../about";

});

$("#sideLinkPrivacyPolicy").click(function() {

	window.location.href="../privacy-policy";

});

$("#sideLinkFeedback").click(function() {

	window.location="mailto:contact@scrabblit.com";

});

$("#sideLinkShare").click(function() {

	window.location.href="../share";

});

$("#sideLinkHelp").click(function() {

	window.location.href="../help";

});

// variable links

$("#sideLinkBackToGame").click(function() {

	window.location.href="../";

});

$("#sideLinkDashboard").click(function() {

	window.location.href="../join-game?stage=dashboard";

});

$("#sideLinkJoinAGame").click(function() {

	window.location.href="../join-game?stage=join";

});

$("#sideLinkLogOut").click(function() {

	localStorage.removeItem("accountInformation");

	window.location.href="../";
	
});

$("#sideLinkLogin").click(function() {

	window.location.href="../login";
	
});

// sidenav navigation 

var navIsOut = false;

$(".backIcon").click(function() {

	history.back();

});

$(".navIcon").click(function() {

	if(navIsOut == false) {

		$(this).css("color", "orange");

		$(".sideNav").css("width", "8cm");
		
		$(".titleBar").css("height", "0");

		navIsOut = true;

	}

	else {

		$(this).css("color", "white");

		$(".sideNav").css("width", "0%");

		$(".titleBar").css("height", "2cm");

		navIsOut = false;

	}

});


function goToProfile() {

	$.ajax({
		type: "POST",
		url: "../scripts/accounts.php",
		data: {
			request: "myProfileUsercode",
			username: localStorage.getItem("scrabblitUsername")
		},
		success: function(response) {
				
			window.location.href="../profile?id=" + response;
			
		}
	});
			
}
