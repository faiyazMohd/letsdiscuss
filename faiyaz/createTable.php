<?php
echo "Hello World<br>";
$servername = "localhost";
$username = "root";
$password = "";
$database = "faiyazdatabase";
$cont = mysqli_connect($servername,$username,$password,$database);
if (!$cont) {
    die("Sorry we failed to connect".mysqli_connect_error());
} 
else {
    echo"Connection was successfull";
} 

// create table in the  in the database
$sql = "CREATE TABLE .`employee` (`EmpId` INT NOT NULL AUTO_INCREMENT , `EmpName` VARCHAR(14) NOT NULL , `Role` VARCHAR(12) NOT NULL , `DOJ` DATE NOT NULL , PRIMARY KEY (`EmpId`));";
$result = mysqli_query($cont,$sql);
if ($result) {
    echo "TAble created";
} else {
    echo "table not created";
}

?>