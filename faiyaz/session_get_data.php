<?php
session_start();
if (isset($_SESSION['username'])) {
    
    echo "Welcome ".$_SESSION['username'];
    echo "<br>";
    echo "Your fav cat is ".$_SESSION['favcat'];
} else {
    echo"Please Login to proceed";
}

?>
