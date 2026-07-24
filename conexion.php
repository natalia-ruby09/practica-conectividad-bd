<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "bd_universidad";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>