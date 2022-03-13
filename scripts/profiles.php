<?php

	include("connection.php");
	
	if($_POST["request"] == "updateProfilePicture") {
	
		// move image from preview folder to profile picture folder
	
		$file1 = "../images/preview/" . $_POST["usercode"] . ".jpg";
	
		$file2 = "../images/profilePictures/" . $_POST["usercode"] . ".jpg";
	
		copy($file1, $file2);
		
		// delete image from preview folder
		
		unlink($file1);
	
	}

	if($_POST["request"] == "previewPicture") {

		$file = "../images/preview/" . $_POST["usercode"] . ".jpg";
	
		$uploadOk = 1;
	
		$imageFileType = strtolower(pathinfo(basename($_FILES["picture"]["name"]) , PATHINFO_EXTENSION));
	
		// first ensure file is an actual image 
	
		if(isset($_POST["submit"])) {
	
			$check = getimagesize($_FILES["picture"]["tmp_name"]);
		
			if($check !== false)  {
		
				$uploadOk = 1;
		
			}
		
			else {
		
				echo "Upload denied: Only actual image files are allowed";
		
				$uploadOk = 0;
		
			}
	
		}
		
		// next validate file type
	
		if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
	
			echo "Upload denied: Image must be in either JPG, JPEG,  or PNG extension";
		
			$uploadOk = 0;
	
		}
		
		// validate file size
	
		if($_FILES["picture"]["size"] > 1024000) {
	
			echo "Upload denied: Your image file size must be less than 1MB";
		
			$uploadOk = 0;
	
		}
		
		// determine whether picture gets uploaded or not
	
		if($uploadOk != 0) {
	
			if(!move_uploaded_file($_FILES["picture"]["tmp_name"] , $file)) {
		
				echo "Error processing image";
		
			}
	
		}
		
	}
	

	if($_POST["request"] == "profileData") {
	
		$usercode = $_POST["usercode"];
	
		$sql = "SELECT * FROM Accounts WHERE usercode = '$usercode' ";
		
		if($sql)  {
		
			$return_arr = array(); 

			$result = mysqli_query($conn, $sql);
			
			while($row = mysqli_fetch_array($result)) { 
			
				$username = $row['Username']; 
				
				$password = $row['Password']; 
				
				$email = $row['Email'];
				
				$gender = $row['Gender'];
				
				$return_arr[] = array("username" => $username, "password" => $password, "email" => $email, "gender" => $gender); 
				
				echo json_encode($return_arr);
				
			} 
			
		}
	
	}
	
	
	if($_POST["request"] == "editProfile") {
	
		$usercode = $_POST["usercode"];
	
		$username = $_POST['username']; 
				
		$email = $_POST['email'];
				
		$password = $_POST['password']; 
				
		$gender = $_POST['gender'];
				
		$sql = "UPDATE Accounts SET Username = '$username', Email = '$email',  Password = '$password', Gender = '$gender' WHERE usercode = '$usercode' ";
		
		if(mysqli_query($conn, $sql)) {
		
				echo "success";
		
		}
		
		else {
		
				echo "error";
		
		}
	
	}
	
	$conn->close();

?>