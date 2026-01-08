<?php
$host = "localhost";
$user = "user_minimal";
$password = "alma";
$database = "minimal";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Sikertelen kapcsolat: " . $conn->connect_error);
}
