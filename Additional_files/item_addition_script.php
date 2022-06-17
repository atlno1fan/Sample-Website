<?php
session_start();
if (isset($_POST['order_submit'])) {

    require 'database_handler_script.php';

    $itemName = $_POST['item_name'];
    $itemID = $_POST['item_ID'];
    $itemPrice = $_POST['item_price'];
    $addon = $_POST['addon'];
    $orderID = $_SESSION['Order_ID'];
    $quantity = $_POST['quantity'];

    $sql =mysqli_query($conn,"INSERT INTO order_items (Order_ID,Item_ID,Addon_ID,Quantity) VALUES ({$orderID},{$itemID},{$addon},{$quantity})");
    if (!$sql) {
        echo mysqli_error($conn);
        header("Location:../cart.php");
        exit();
    }

	mysqli_close($conn);
     header("Location:../cart.php");
        exit();

        
}

else {
	header("Location: ../Menu.php");
	exit();
}
?>
