<?php
$servername = "localhost"; 
$username = "root"; 
$password = "";
$database = "caycanh1"; 
$conn = new mysqli($servername, $username, $password, $database);
$con = mysqli_connect($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}
?>