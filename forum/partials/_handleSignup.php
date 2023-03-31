<?php
$showError = false;
$showAlert = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "_dbconnect.php";
    $user_email = $_POST['signupEmail'];
    $user_name = $_POST['username'];
    $user_pass = $_POST['signupPassword'];
    $user_cpass = $_POST['signupcPassword'];

    // check whether this username exists
    $userNameExistSql = "SELECT * FROM `users` WHERE user_name = '$user_name'";
    $userNameExistSqlResult = mysqli_query($conn, $userNameExistSql);
    $usernameNumExistRows = mysqli_num_rows($userNameExistSqlResult);
    
    // check whether this email exists
    $existSql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if ($usernameNumExistRows > 0) {
        $showError = "This Username has already been taken";
        header("Location:/forum/index.php?signupsuccess=$showAlert&error=$showError");
    } 
    else if ($numExistRows > 0) {
        $showError = "Email is already been registered with Lets Discuss";
        header("Location:/forum/index.php?signupsuccess=$showAlert&error=$showError");
    } 
    else {
        if (!empty($user_name) && !empty($user_email) && !empty($user_pass) && !empty($user_cpass)) {
            if (($user_pass == $user_cpass)) {
                $hash = password_hash($user_pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`user_name`,`user_email`, `user_pass`, `timestamp`) VALUES ('$user_name','$user_email', '$hash', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $showAlert = true;
                    header("Location:/forum/index.php?signupsuccess=$showAlert");
                    exit();
                }
            } else {
                $showError = "Passwords do not match";
                header("Location:/forum/index.php?signupsuccess=$showAlert&error=$showError");
            }
        } else {
            $showError = "Please Enter all the values";
            header("Location:/forum/index.php?signupsuccess=$showAlert&error=$showError");
        }
    }
}
