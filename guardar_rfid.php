<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rfid_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Si se recibe un UID, insertarlo en la base de datos junto con la fecha actual
if(isset($_POST['uid'])) {
    $uid = $_POST['uid'];

    $stmt = $conn->prepare("INSERT INTO asistencias (uid, fecha) VALUES (?, NOW())");
    $stmt->bind_param("s", $uid);

    if ($stmt->execute()) {
        echo "UID recibido y almacenado: " . $uid . "<br>";
    } else {
        echo "Error al almacenar el UID: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

// Consultar y mostrar todos los UIDs almacenados
$sql = "SELECT uid, fecha FROM asistencias ORDER BY fecha DESC";  // Cambié 'registros' a 'asistencias'
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>UIDs almacenados:</h2>";
    while($row = $result->fetch_assoc()) {
        echo "UID: " . $row["uid"] . " - Fecha: " . $row["fecha"] . "<br>";
    }
} else {
    echo "No hay UIDs almacenados.";
}

$conn->close();

?>
