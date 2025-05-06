<?php
$host = 'localhost';
$user = 'root';
$pass = 'balaji7418$S';
$db = 'bustrackingsystem';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}