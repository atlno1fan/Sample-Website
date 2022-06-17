<?php 
session_start();
require 'database_handler_script.php';

if (isset($_POST['update_item'])) {
	$itemID = $_POST['item_id'];
	$itemName = $_POST['item_name'];
	$itemCat = $_POST['item_category'];
	$itemPic = $_POST['item_pic'];
	$itemQuan = $_POST['item_quantity'];
	$itemPrice = $_POST['item_price'];

	$sql ="UPDATE item_info SET Item_name = ?, Category = ?, Item_price = ?, Item_pic_dir = ?, Item_quantity = ?  WHERE Item_ID = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../Admin_view_product_script.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"ssssss", $itemName, $itemCat, $itemPrice, $itemPic, $itemQuan, $itemID);
            mysqli_stmt_execute($stmt);
            header("Location:../Admin_view_products.php?update=success");
	        exit();
        }

	    mysqli_stmt_close($stmt);
		mysqli_close($conn);

}

if (isset($_POST['add_item'])) {

	$itemName = $_POST['item_name'];
	$itemCat = $_POST['item_category'];
	$itemPic = $_POST['item_pic'];
	$itemQuan = $_POST['item_quantity'];
	$itemPrice = $_POST['item_price'];

	$sql ="INSERT INTO item_info (Item_name,Category,Item_price,Item_pic_dir,Item_quantity) VALUES (?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../Admin_view_product_script.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"sssss", $itemName, $itemCat, $itemPrice, $itemPic, $itemQuan);
            mysqli_stmt_execute($stmt);
            header("Location:../Admin_view_products.php?add=success");
	        exit();
        }

	    mysqli_stmt_close($stmt);
		mysqli_close($conn);

}

if (isset($_POST['add_barista'])) {

    $username = $_POST['user_name'];
    $useremail = $_POST['user_email'];
    $userphone = $_POST['user_phone_num'];
    $status = $_POST['Barista_status'];
    $pass = $_POST['user_pass'];

    $sql ="INSERT INTO user_info (Username,User_email,User_password,User_phone_num,Barista_status) VALUES (?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../Admin_view_baristas_script.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"sssss", $username, $useremail, $pass, $userphone, $status);
            mysqli_stmt_execute($stmt);
            header("Location:../Admin_view_baristas.php?add=success");
            exit();
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

}

if (isset($_POST['update_user'])) {
    $username = $_POST['user_name'];
    $useremail = $_POST['user_email'];
    $userphone = $_POST['user_phone_num'];
    $userID = $_POST['$userID'];
    $sql ="UPDATE user_info SET Username = ?, User_email = ?, User_phone_num = ? WHERE User_ID = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../Admin_view_user_script.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"ssss", $username, $useremail, $userphone, $userID);
            mysqli_stmt_execute($stmt);
            header("Location:../Admin_view_user.php?update=success");
            exit();
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

}

if (isset($_POST['update_location'])) {
    $locationName = $_POST['location_name'];
    $locationID = $_POST['$location_id'];
$sql ="UPDATE delivery_locations SET Location_name = ? WHERE Location_ID = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../Admin_view_locations_script.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"ss", $locationName, $locationID);
            mysqli_stmt_execute($stmt);
            header("Location:../Admin_view_locations.php?update=success");
            exit();
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

}

if (isset($_POST['update_barista'])) {
    $username = $_POST['user_name'];
    $useremail = $_POST['user_email'];
    $userphone = $_POST['user_phone_num'];
    $userID = $_POST['$userID'];
    $sql ="UPDATE user_info SET Username = ?, User_email = ?, User_phone_num = ? WHERE User_ID = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../Admin_view_baristas_script.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"ssss", $username, $useremail, $userphone, $userID);
            mysqli_stmt_execute($stmt);
            header("Location:../Admin_view_baristas.php?update=success");
            exit();
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

}


if (isset($_POST['add_user'])) {

    $username = $_POST['user_name'];
    $useremail = $_POST['user_email'];
    $userphone = $_POST['user_phone_num'];
    $pass = $_POST['user_pass'];

    $sql ="INSERT INTO user_info (Username,User_email,User_password,User_phone_num) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../Admin_view_user_script.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"ssss", $username, $useremail, $pass, $userphone);
            mysqli_stmt_execute($stmt);
            header("Location:../Admin_view_user.php?add=success");
            exit();
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

}

if (isset($_POST['add_location'])) {

    $locationName = $_POST['location_name'];

    $sql ="INSERT INTO delivery_locations (Location_name) VALUES (?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../Admin_view_locations_script.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"s", $locationName);
            mysqli_stmt_execute($stmt);
            header("Location:../Admin_view_locations.php?add=success");
            exit();
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

}

if (isset($_POST['delete_item'])) {
	$itemID = $_POST['item_id'];

	$sql =mysqli_query($conn,"DELETE FROM item_info  WHERE Item_ID = {$itemID}");
        if (!$sql) {
            echo mysqli_error($conn);
            header("Location:../Admin_view_products.php?delete=failed");
            exit();
        }
        mysqli_close($conn);
        header("Location:../Admin_view_products.php?delete=success");
        exit();
}

if (isset($_POST['delete_location'])) {
    $locationID = $_POST['location_id'];

    $sql =mysqli_query($conn,"DELETE FROM delivery_locations  WHERE Location_ID = {$locationID}");
        if (!$sql) {
            echo mysqli_error($conn);
            header("Location:../Admin_view_locations.php?delete=failed");
            exit();
        }
        mysqli_close($conn);
        header("Location:../Admin_view_locations.php?delete=success");
        exit();
}

if (isset($_POST['delete_order'])) {
    $orderID = $_POST['order_id'];

    $sql =mysqli_query($conn,"DELETE FROM order_info  WHERE Order_ID = {$orderID}");
        if (!$sql) {
            echo mysqli_error($conn);
            header("Location:../Admin_view_orders.php?delete=failed");
            exit();
        }
        mysqli_close($conn);
        header("Location:../Admin_view_orders.php?delete=success");
        exit();
}

if (isset($_POST['delete_barista'])) {
    $userID = $_POST['user_id'];

    $sql =mysqli_query($conn,"DELETE FROM user_info  WHERE User_ID = {$userID}");
        if (!$sql) {
            echo mysqli_error($conn);
            header("Location:../Admin_view_baristas.php?delete=failed");
            exit();
        }
        mysqli_close($conn);
        header("Location:../Admin_view_baristas.php?delete=success");
        exit();
}

if (isset($_POST['delete_user'])) {
    $userID = $_POST['user_id'];

    $sql =mysqli_query($conn,"DELETE FROM user_info  WHERE User_ID = {$userID}");
        if (!$sql) {
            echo mysqli_error($conn);
            header("Location:../Admin_view_user.php?delete=failed");
            exit();
        }
        mysqli_close($conn);
        header("Location:../Admin_view_user.php?delete=success");
        exit();
}


else {
	header("Location: ../Admin_view_overview.php?error=nothing_done");
	exit();
}
?>