<?php
$showError = false;
$showAlert = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "_dbconnect.php";
    $user_email = $_POST['loginEmail'];
    $user_pass = $_POST['loginPass'];
    if (!empty($user_email) && !empty($user_pass)) {
        $sql = "SELECT * FROM `users` WHERE `user_email` = '$user_email'";
        $result = mysqli_query($conn, $sql);
        $numExistRows = mysqli_num_rows($result);
        if ($numExistRows == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($user_pass, $row['user_pass'])) {
                session_start();
                $_SESSION['loggedIn'] = true;
                $_SESSION['useremail'] = $user_email;
                $_SESSION['sno'] = $row['sno'];
                $_SESSION['username'] = $row['user_name'];
                $showAlert = true;
                header("location:/forum/index.php?loginsuccess=$showAlert");
                exit();
            } else {
                $showError = "Invalid Credentials";
                header("location:/forum/index.php?loginsuccess=$showAlert&loginerror=$showError");
            }
        }
        else {
            $showError = "Invalid Credentials";
            header("location:/forum/index.php?loginsuccess=$showAlert&loginerror=$showError");
        }

    } 
    else {
        $showError = "Please Enter all the values";
        header("location:/forum/index.php?loginsuccess=$showAlert&loginerror=$showError");
    }
}
