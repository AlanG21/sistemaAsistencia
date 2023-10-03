<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_asistencia";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexión
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
