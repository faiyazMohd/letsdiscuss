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
$EmpName = "Adil";
$Role = "Analyzer";
$sql = "INSERT INTO `employee` (`EmpId`, `EmpName`, `Role`, `DOJ`) VALUES (NULL, '$EmpName', '$Role', '2021-06-14');";
$result = mysqli_query($cont,$sql);
if ($result) {
    echo "record inserted created";
} else {
    echo "record not  inserted created";
}

?>