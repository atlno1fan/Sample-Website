<?php
session_start();
    $quantity = $_POST['quantity'];
    $Order_ID = $_POST['order_id'];
    $Item_ID = $_POST['item_id'];
    $Addon_ID = $_POST['addon_id'];
    $number = 1;
if (isset($_POST['quantity_increase'])) {

    require 'database_handler_script.php';

    $updated_quantity = $quantity + 1;

    $sql =mysqli_query($conn,"UPDATE order_items SET Quantity = {$updated_quantity} WHERE Order_ID = {$Order_ID} AND Item_ID = {$Item_ID} AND Addon_ID = {$Addon_ID}");
    if (!$sql) {
        echo mysqli_error($conn);
        header("Location:../cart.php?error=1");
        exit();
    }

	mysqli_close($conn);
     header("Location:../cart.php?error=success");
        exit();   
}

else if (isset($_POST['quantity_decrease'])) {

    require 'database_handler_script.php';

    if ($quantity > 1){
        $updated_quantity = $quantity - 1;

        $sql =mysqli_query($conn,"UPDATE order_items SET Quantity = {$updated_quantity} WHERE Order_ID = {$Order_ID} AND Item_ID = {$Item_ID} AND Addon_ID = {$Addon_ID}");
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
        $sql =mysqli_query($conn,"DELETE FROM order_items  WHERE Order_ID = {$Order_ID} AND Item_ID = {$Item_ID} AND Addon_ID = {$Addon_ID}");
        if (!$sql) {
            echo mysqli_error($conn);
            header("Location:../cart.php");
            exit();
        }
        mysqli_close($conn);
        header("Location:../cart.php");
        exit();
    }    
}

else if (isset($_POST['delete_item'])) {

    require 'database_handler_script.php';

    $sql =mysqli_query($conn,"DELETE FROM order_items  WHERE Order_ID = {$Order_ID} AND Item_ID = {$Item_ID} AND Addon_ID = {$Addon_ID}");
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
	header("Location: ../cart.php?error=nothing_done");
	exit();
}
?>
