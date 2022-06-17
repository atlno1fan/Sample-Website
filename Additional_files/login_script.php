<?php
 session_start();

if(isset($_POST['login_submit'])) {

	require 'database_handler_script.php';
	
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['pass']);

	if(empty($email) || empty($password)) {
	header("Location: ../index.php?error=noinput");
	exit();
	}
	else{
		$sql = "SELECT * FROM user_info WHERE User_email ='$email' OR Username ='$email'";
		$result = mysqli_query($conn,$sql);
		$resultcheck = mysqli_num_rows($result);
		if ($resultcheck <1) {
			header("Location: ../index.php?error=nouser");
			exit();
		} 
		else {
			if ($row = mysqli_fetch_assoc($result)) {
				$hashedpasscheck = password_verify($password,$row['User_password']);
				if ($hashedpasscheck == false) {
					header("Location: ../index.php?error=wrongpassword");
					exit();
				}
				else if ($hashedpasscheck == true) {
					$_SESSION['Username']= $row['Username'];
					$_SESSION['User_email']= $row['User_email'];
					$_SESSION['User_phone_num']= $row['User_phone_num'];
					$_SESSION['Admin_status']= $row['Admin_status'];
					$_SESSION['Barista_status']=$row['Barista_status'];

					if ($row['Admin_status'] == 1) {
						header("Location: ../Admin_view_overview.php");
						exit();
					}
					else if ($row['Barista_status'] == 1) {
						header("Location: ../barista_homepage.php");
						exit();
					}  
					else {
						header("Location: ../index.php?login=success");
						exit();
					}
				}
			}
		}
	}
} 
else {
	header("Location: ../index.php?login=nouser");
	exit();
}
	 