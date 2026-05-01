<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "employee_crud_db";
$port = 3307;

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

$_SESSION['login_status'] = "Employee Admin is logged in";
?>