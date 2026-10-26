<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nandusdb";

// Create connection
//$conn = mysqli_connect("localhost", "root", "", "mydb");
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "<script> alert ('Connected successfully');</script>";
?>