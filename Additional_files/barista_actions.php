<?php
session_start();
    $updated_quantity = $_POST['quantity'];
    $order_ID = $_POST['orderID'];
    $Item_ID = $_POST['itemID'];
    $orderStatus = "ready-for-delievry";


if (isset($_POST['change_quantity'])) {

    require 'database_handler_script.php';

    $sql =mysqli_query($conn,"UPDATE items_info SET Quantity = {$updated_quantity} WHERE Item_ID = {$Item_ID}");
    if (!$sql) {
        echo mysqli_error($conn);
        header("Location:../barista_homepage.php?error=1");
        exit();
    }

	mysqli_close($conn);
     header("Location:../barista_homepage.php?error=success");
        exit();   
}

else if (isset($_POST['change_order_status'])) {

    require 'database_handler_script.php';


   $sql ="UPDATE order_info SET Order_status = ?  WHERE Order_ID = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../barista_homepage.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"ss", $orderStatus, $order_ID);
            mysqli_stmt_execute($stmt);
            header("Location:../barista_homepage.php?order=success");
            exit();
        }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location:../barista_homepage.php?error=success");
    exit();   
}

else {
    header("Location: ../barista_homepage.php?error=nothing_done");
    exit();
}
?>
