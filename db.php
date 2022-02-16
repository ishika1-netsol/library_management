<?php
$servername="localhost";
$user="root";
$pass="";
$db="library_management";
//database connectivity
$conn = mysqli_connect($servername,$user,$pass,$db);
if (!$conn){
    die("sorry we failed to connect:".mysqli_connect_error());
}
else{
    echo "connection was successful";
    echo "<pre>";
}

?>