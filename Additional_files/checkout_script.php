<?php
session_start();
if (isset($_POST['checkout'])) {
	require 'database_handler_script.php';

	    $total = $_POST['order_total'];
	    $orderID = $_SESSION['Order_ID'];
	    $itemTotal = $_POST['item_total'];
	    

	    $sql =mysqli_query($conn," UPDATE order_info SET Total = {$total}, item_quantity_ordered = {$itemTotal} WHERE Order_ID = {$orderID}");
	    if (!$sql) {
	        echo mysqli_error($conn);
	        header("Location:../cart.php?error=totalAdditionfailed");
	        exit();
	    }

		mysqli_close($conn);
	     header("Location:../checkout.php");
	        exit();
	        
}
else if (isset($_POST['checkout_submit'])) {
	require 'database_handler_script.php';

	    $name = $_POST['name'];
	    $email = $_POST['email'];
	    $phoneNumber = $_POST['phone_number'];
	    $location_comment = $_POST['location_details'];
	    $orderID = $_SESSION['Order_ID'];
	    $orderStatus = "to-be-prepared";


	    if ( empty($name) || empty($email) || empty($phoneNumber) || empty($location_comment)) {

        header("Location: ../checkout.php?error=emptyfields");
        exit();
    }

    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../checkout.php?error=invalidemail");
        exit();
    }

    else if (!preg_match("/^[a-zA-Z\d]{2,}$/",$name)) {
        header("Location: ../checkout.php?error=invalidname");
        exit();
    }
    

    else if (!preg_match("/^[0-9]{10}$/",$phoneNumber)) {
        header("Location: ../checkout.php?error=invalidnumber");
        exit();
    }
    else{

	    $sql ="UPDATE order_info SET Name = ?, email = ?, Location_comment = ?, Phone_number = ?, Order_status = ?  WHERE Order_ID = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../Location_page.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"ssssss", $name, $email, $location_comment, $phoneNumber, $orderStatus, $orderID);
            mysqli_stmt_execute($stmt);
            header("Location:../reciept.php");
	        exit();
        }

	    mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}   
}
else {
	header("Location: ../checkout.php");
	exit();
}
?>
