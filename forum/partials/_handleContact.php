<?php
session_start();
$showError = false;
$showAlert = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "_dbconnect.php";
    $user_query = $_POST['select'];
    $user_info = $_POST['contactUserInfo'];
    $user_concern = $_POST['contactUserConcern'];
    $user_id = $_SESSION['sno'];
    if (!empty($user_query) && !empty($user_info) && !empty($user_concern)) {
        $sql = "INSERT INTO `concerns` ( `user_id`, `user_query`, `user_info`, `user_concern`, `concern_time`) VALUES ('$user_id', '$user_query', '$user_info', '$user_concern', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
            header("Location:/forum/index.php?contactsuccess=$showAlert");
            exit();
        }
    } else {
        $showError = "Please Enter all the values";
        header("Location:/forum/index.php?contactsuccess=$showAlert&contacterror=$showError");
    }
}
