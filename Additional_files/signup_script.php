<?php
if (isset($_POST['signup_submit'])) {

    require 'database_handler_script.php';

    $username = $_POST['uid'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['pass'];
    $passwordConfirm = $_POST['pass-confirm'];

    if ( empty($username) || empty($email) || empty($phone_number) || empty($password) || empty($passwordConfirm)) {

        header("Location: ../signup.php?error=emptyfields");
        exit();
    }

    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidemail");
        exit();
    }

    else if (!preg_match("/^[a-zA-Z\d]{2,}$/",$username)) {
        header("Location: ../signup.php?error=username");
        exit();
    }
    

    else if (!preg_match("/^[0-9]{10}$/",$phone_number)) {
        header("Location: ../signup.php?error=invalidnumber");
        exit();
    }

    else if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{4,}$/" ,$_POST["pass"]) === 0) {
        header("Location: ../signup.php?error=invalidpass");
        exit();
    }

    else if ($password !== $passwordConfirm) {
        header("Location: ../signup.php?error=passwordcheck");
    }
    else{

        $sql = "SELECT User_email FROM user_info WHERE User_email =?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
        }
        
    else {
        mysqli_stmt_bind_param($stmt,"s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultcheck = mysqli_stmt_num_rows($stmt);
        if ($resultcheck > 0) {
            header("Location: ../signup.php?error=usertaken");
        exit();
        }
        else {
            $sql ="INSERT INTO user_info (Username,User_email,User_password,User_phone_num) VALUES(?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
            }
            else {
                $hashedpass = password_hash($password, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt,"ssss", $username, $email, $hashedpass, $phone_number);
                mysqli_stmt_execute($stmt);
                header("Location: ../index.php?signup=success");
                exit();
            }
        }
        }
    }
mysqli_stmt_close($stmt);
mysqli_close($conn);

}
else {
header("Location: ../signup.php");
exit();
}
