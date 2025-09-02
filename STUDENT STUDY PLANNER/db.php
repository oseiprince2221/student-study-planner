<?php
$host = "localhost";
$user = "root";   // default XAMPP user
$pass = "";       // leave empty in XAMPP
$dbname = "study_planner";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
