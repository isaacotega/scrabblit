<?php
/*
	echo 
'<form method="post">
<input name="request">
<input name="username">
<input name="email">
<input name="password">
<input name="gender">
<button>submit</button>
</form>';
			$check = "SELECT * FROM Accounts WHERE Email = $email";
		
			$rs = mysqli_query($conn,$check);
			
			$data = mysqli_fetch_array($rs, MYSQLI_NUM);
			
			if($data[0] > 1) {
			
				echo "exist";
				
			}
			
			else {
	
	*/

	include "connection.php";
	
	if($conn)  {
	
		$request = $_POST["request"];
	
		if($request == "register") {
	
			$username = $_POST["username"];
	
			$email = $_POST["email"];
	
			$password = $_POST["password"];
	
			$gender = $_POST["gender"];
	 
			$usercode = $_POST["usercode"];
	
			$date = date("d m Y h:i:a");
			
			$check = "SELECT * FROM Accounts WHERE Username = '$username' AND Password = '$password' ";
		
			$rs = mysqli_query($conn,$check);
			
			$data = mysqli_fetch_array($rs, MYSQLI_NUM);
			
			if($data[0] > 1) {
			
				echo "exist";
				
			}
			
			else {
	
				$sql = "INSERT INTO Accounts (Username, Email, Password, Gender, usercode, Date) VALUES('$username', '$email', '$password', '$gender', '$usercode', '$date')";
	
				if(mysqli_query($conn, $sql)) {
	
					file_put_contents("../images/profilePictures/" . $usercode . ".jpg", file_get_contents("../images/avatars/" . $gender . ".jpg"));

					echo "success";
	
				}
	
				else {
	
					echo "error";
	
				}
		
			}
		
		}
	
		if($request == "login") {
	
			$username = $_POST["username"];
	
			$password = $_POST["password"];
	
			$date = date("d m Y h:i:a");
			
			$sql= "SELECT * FROM Accounts WHERE Username = '$username' AND Password = '$password' ";
			
			$result = mysqli_query($conn, $sql);
			
			$check = mysqli_fetch_array($result);
			
			if(isset($check)) {
			
				echo 'success';
				
			}
			
			else {
			
				echo 'error';
				
			}
			
		}
	
		if($request == "myProfileUsercode") {
		
			$username = $_POST["username"];
		
			$sql = "SELECT usercode FROM Accounts WHERE Username = '$username'";
			
			if($sql)  {
			
				$result = mysqli_query($conn, $sql);
				
				echo mysqli_fetch_array($result)["usercode"];
				
			}
		
		}
	
	
		$conn->close();
		
	}
	
?>