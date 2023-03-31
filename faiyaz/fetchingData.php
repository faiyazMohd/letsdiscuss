<?php
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

$sql = "SELECT * FROM `employee`";
$result = mysqli_query($cont,$sql);

$num = mysqli_num_rows($result);
echo"<br>";
echo "$num Entries found in the database";
echo"<br>";

if ($num>0) {
    
    while($row = mysqli_fetch_assoc($result)){
        // echo var_dump(($row));
         echo $row['EmpId']." Name is ". $row['EmpName'] . " and Role is ".$row['Role']." Date Of Joining is ".$row['DOJ'];
        echo"<br>";
    }
}
