<?php
session_start();
session_destroy();
$showAlert = true;
header("Location:/forum/index.php?logoutsuccess=$showAlert");
?>