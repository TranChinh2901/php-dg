<?php
$server = 'localhost';
$name = 'root';
$pass = '';
$database = 'compare_work';

$conn = new mysqli($server, $name, $pass, $database);
if ($conn) {
    mysqli_query($conn, "SET NAMES 'utf8'");
    // echo "Connected to database successfully";
} else {
    echo 'Connection failed: ' . mysqli_connect_error();
}
