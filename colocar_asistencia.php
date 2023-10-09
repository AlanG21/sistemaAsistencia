<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rfid";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Si se recibe un UID, verifica si está asignado a un alumno
if(isset($_POST['uid'])) {
    $uid = $_POST['uid'];

    // Verificar si el UID está asignado a un alumno
    $stmt_check = $conn->prepare("SELECT id FROM alumnos WHERE uid = ?");
    $stmt_check->bind_param("s", $uid);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // Si el UID está asignado a un alumno, inserta la asistencia
        $stmt = $conn->prepare("INSERT INTO asistencias (uid, fecha) VALUES (?, NOW())");
        $stmt->bind_param("s", $uid);

        if ($stmt->execute()) {
            echo "UID recibido y almacenado: " . $uid . "<br>";
        } else {
            echo "Error al almacenar el UID: " . $stmt->error . "<br>";
        }

        $stmt->close();
    } else {
        echo "El UID no está asignado a ningún alumno.<br>";
    }

    $stmt_check->close();
}

// Consultar y mostrar todos los UIDs almacenados
$sql = "SELECT uid, fecha FROM asistencias ORDER BY fecha DESC";
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
