<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rfid_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['asistencia'] as $asi_id => $estado) {
        if ($estado == "Asistencia") {
            $sql = "UPDATE asistencias SET asistio=1 WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $asi_id);
        } else {
            $sql = "UPDATE asistencias SET asistio=0 WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $asi_id);
        }

        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

$sql = "SELECT 
    asi.id AS asi_id,
    asi.uid,
    CASE 
        WHEN asi.fecha IS NULL THEN 'Ausente' 
        ELSE DATE_FORMAT(asi.fecha, '%Y-%m-%d %H:%i:%s') 
    END AS fecha_asistencia,
    asi.asistio
FROM asistencias asi
ORDER BY asi.fecha DESC;
";




$result = $conn->query($sql);
?>

<?php include('nav_profesor.php'); ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencias</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Registro de Asistencias</h1>
    <form action="" method="post">
        <table class="table table-striped table-bordered">
        <thead>
    <tr>
        <th>UID</th>
        <th>Fecha de Asistencia</th>
        <th>Asistencia</th>
    </tr>
</thead>
            <tbody>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['uid'] . "</td>";  // Mostramos el UID
            echo "<td>" . $row['fecha_asistencia'] . "</td>";  // Mostramos la fecha de asistencia
            echo "<td>";
            echo '<select name="asistencia[' . $row['asi_id'] . ']">';
            echo '<option value="Asistencia"' . ($row['asistio'] == 1 ? ' selected' : '') . '>Asistencia</option>';
            echo '<option value="Inasistencia"' . ($row['asistio'] == 0 ? ' selected' : '') . '>Inasistencia</option>';
            echo '</select>';
            echo "</td>";
            echo "</tr>";
        }
    }
    
    ?>
</tbody>
        </table>
        <button type="submit" class="btn btn-primary">Actualizar Asistencias</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>