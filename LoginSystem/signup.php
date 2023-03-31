<?php
// INSERT INTO `users` (`Srno`, `username`, `password`, `dt`) VALUES (NULL, 'faiyaz', '1234', current_timestamp()); 
$showAlert = false;
$showAlertToAdd = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    include "partials/_dbconnect.php";
    $username = $_POST["userName"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    // check whether this user name exists
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn,$existSql);
    // $numExistRows = mysqli_num_rows($result);
    $numExistRows = mysqli_num_rows($result); 
    if (!$result) { 
        echo "error";
    }
    if ($numExistRows>0) {
        $showError ="Username Already Exists";
    } 
    else {
        if (!empty($username)&&!empty($password) && !empty($password)) {
            if (($password==$confirmPassword)) {
                $hash = password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp()); ";
                $result = mysqli_query($conn,$sql);
                if ($result) {
                    $showAlert = true;
                }
            }
            else {
                $showError ="Passwords do not match";
            }
        } else {
            $showAlertToAdd = true;
        }
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require "partials/_nav.php";
    ?>
    <?php
    if ($showAlert) {
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account has been created and you can login now.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';

    }
    if ($showError) {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Success!</strong> '.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
    if ($showAlertToAdd) {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Please Enter all the values
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
    ?>
    <div class="container">
        <h1 class=" my-3">Signup to our website</h1>
        <form action="/LoginSystem/signup.php" method="post">
            <div class="mb-3 col-md-6">
                <label for="userName" class="form-label">Username</label>
                <input type="text" maxlength="15" class="form-control" id="userName" name="userName">
               
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="23" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 col-md-6">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                <div id="emailHelp" class="form-text">Make sure to type the same password.</div>
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>
