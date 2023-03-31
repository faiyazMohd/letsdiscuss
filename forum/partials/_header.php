<?php
session_start();
echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
<div class="container-fluid">
    <a class="navbar-brand text-info" style="font-weight:bold;" href="index.php">Lets Discuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Top Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql = "SELECT category_name,category_id FROM `categories` LIMIT 4";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li><a class="dropdown-item" href="threadlist.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a></li>';
        }
        echo '</ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
        </ul>';
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    $username = $_SESSION['username'];
    // $username = substr($useremail, 0, strpos($useremail, '@'));
    echo '  <form class="d-flex" role="search" action="search.php" method="get">
            <input class="form-control me-2 my-0" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-info mx-3 my-0" style="font-weight:bold;" type="submit">Search</button>
            <p class="text-light my-0 mx-2 h6">Welcome ' . $username . '</p>
            <a href="partials/_logout.php" class="btn btn-outline-info mx-2 my-0" id="logout">Logout</a>
        </form>';
} else {
    echo '  <form class="d-flex" role="search" action="search.php" method="get">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-info mx-3" style="font-weight:bold;" type="submit">Search</button>
            </form>
                <button class="btn btn-outline-info mx-2" id="login" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button class="btn btn-outline-info mx-2" id="signin" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
}

echo ' </div>
</div>
</nav>';
include "partials/loginModal.php";
include "partials/signupModal.php";

// showing signup alerts and errors
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "1") {
    echo '
        <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success!</strong> Your account has been created and you can login now.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
}
if (isset($_GET['error']) && $_GET['error'] == true) {
    echo '
        <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error!</strong> ' . $_GET['error'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
}

// showing login alerts and errors
if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "1") {
    if (isset($_SESSION['useremail'])) {
        $useremail = $_SESSION['useremail'];
        echo '
        <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success!</strong> You are now Loggedin with ' . $useremail . '.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
}

if (isset($_GET['loginerror']) && $_GET['loginerror'] == true) {
    echo '
        <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error!</strong> ' . $_GET['loginerror'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
}

// showing logout alerts and errors
if (isset($_GET['logoutsuccess']) && $_GET['logoutsuccess'] == "1") {
    echo '
        <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success!</strong> You are logged out.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
}

// showing contact alerts and errors
if (isset($_GET['contactsuccess']) && $_GET['contactsuccess'] == "1") {
    echo '
        <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success!</strong> Your concern has been posted.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
}

if (isset($_GET['contacterror']) && $_GET['contacterror'] == true) {
    echo '
        <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error!</strong> ' . $_GET['contacterror'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
}

