 <?php
if (isset($_POST['orderID_submit'])) {

    require 'database_handler_script.php';

    $Orderid = $_POST['orderid'];

    $sql ="INSERT INTO order_items (Order_ID) VALUES(?)";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../Location_page.php?error=sqlerror");
            exit();
        }
        
        else {
            mysqli_stmt_bind_param($stmt,"s", $Orderid);
            mysqli_stmt_execute($stmt);
        }

    mysqli_stmt_close($stmt);
	mysqli_close($conn);
        
}
        
}

else {
    header("Location: ../Location_page.php");
    exit();
}
?>
