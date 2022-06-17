<?php
if(isset($_GET['Item_ID'])) {
	require 'database_handler_script.php';

	$id = mysqli_real_escape_string($conn, $_GET('Item_ID'));

	$sql = "SELECT * FROM item_info WHERE Item_ID = '$id' ";
	$result = mysqli_fetch_array($result);
	$resultcheck = mysqli_num_rows($result);
	if ($resultcheck < 1) {
			header("Location: ../index.php?error=idNotFound");
			exit();
		} 
	else{
		if(isset($_GET['Item_name'])){
			$item_name = mysqli_real_escape_string($conn,$_GET['Item_name']);
			$item_price = mysqli_real_escape_string($conn,$_GET['Item_price']); 
			$item_pic = mysqli_real_escape_string($conn,$_GET['Item_pic_dir']);
		}
	}
} 
else{
	header('Location: index.php');
}