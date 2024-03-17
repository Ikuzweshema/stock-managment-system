<?php
$server_name="localhost";
$username="root";
$password="";
$db="saint";

$conn=mysqli_connect($server_name,$username,$password,$db);
if (!$conn) {
 echo "Not connected";
}
?>