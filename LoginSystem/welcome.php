<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
    header("location:login.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - <?php echo$_SESSION['username']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require "partials/_nav.php";
    ?>
    <div class="container my-3">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcome <?php echo$_SESSION['username']; ?></h4>
            <p>Hey! how are you doing you</p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to logout <a href="/LoginSystem/logout.php"> using this link </a>.</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>
