<?php
session_start();
require 'database_handler_script.php';

if (isset($_POST['location_submit'])) {

    $location = $_POST['location'];
    $order_status = "Ongoing";

    $sql ="INSERT INTO order_info (Location_ID,Order_status) VALUES(?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../Location_page.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"ss", $location, $order_status);
            mysqli_stmt_execute($stmt);

            $sql = "SELECT * FROM order_info ORDER BY Order_ID DESC LIMIT 1";
			$result = mysqli_query($conn, $sql) or die("Bad Query:$sql");

		    if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_array($result)){
					$_SESSION['Order_ID']= $row['Order_ID'];
					header("Location: ../Menu.php?OrderID={$_SESSION['Order_ID']}");
                exit();
				}
			}
        }

    mysqli_stmt_close($stmt);
	mysqli_close($conn);
        
}

else if (isset($_POST['location_update'])){
    $location = $_POST['location'];

    $sql = "UPDATE order_info SET Location_ID = {$location} WHERE Order_ID = {$_SESSION['Order_ID']}";
    $results = mysqli_query($conn,$sql) or die("Bad Query = $sql");
    header("Location: ../Checkout.php?Update=success");
    exit();

 }

else {
	header("Location: ../Location_page.php");
	exit();
}
?>
