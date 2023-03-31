<?php
echo "Hello World<br>";
$servername = "localhost";
$username = "root";
$password = "";
$cont = mysqli_connect($servername,$username,$password);
// create a database
$sql = "CREATE DATABASE faiyazDatabase";
mysqli_query($cont, $sql);

if (!$cont) {
    die("Sorry we failed to connect".mysqli_connect_error());
} 
else {
    echo"Connection was successfull";
}

?>