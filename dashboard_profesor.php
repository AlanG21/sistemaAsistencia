<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rfid";

$mesActual = isset($_GET['mes']) ? intval($_GET['mes']) : 10;  // Por defecto es octubre

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch solo los alumnos
    $stmtAlumnos = $conn->prepare("SELECT id, nombre, apellido, uid FROM alumnos"); 
    $stmtAlumnos->execute();
    $alumnos = $stmtAlumnos->fetchAll();

    // Fetch todas las asistencias del mes actual 2023
    $stmtAsistencias = $conn->prepare("SELECT uid, DATE(fecha) as fecha FROM asistencias WHERE MONTH(fecha) = :mes AND YEAR(fecha) = 2023");
    $stmtAsistencias->bindParam(':mes', $mesActual, PDO::PARAM_INT);
    $stmtAsistencias->execute();
    $asistencias = $stmtAsistencias->fetchAll();

    // Convertir asistencias en un formato más manejable
    $asistenciasPorAlumno = [];
    foreach ($asistencias as $asistencia) {
        $uid = $asistencia['uid'];
        $fecha = $asistencia['fecha'];
        $asistenciasPorAlumno[$uid][] = $fecha;
    }

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

$meses = [
    10 => 'octubre',
    11 => 'noviembre',
    12 => 'diciembre'
];

$fechaActual = new DateTime();  // Fecha actual
$fechaActual->setTime(0, 0, 0);  // Establecer la hora a medianoche para comparar solo fechas

?>

<?php include('nav_profesor.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Dashboard</h1>
    <div class="alert alert-primary" role="alert">
        <?php
        $user = $_SESSION['user'];
        echo "Bienvenido, " . $user['nombre'];
        ?>
    </div>
    <h3>Asistencia del mes de <?php echo $meses[$mesActual]; ?></h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <?php
                $start = new DateTime("2023-$mesActual-01");
                $end = new DateTime("2023-$mesActual-31");
                $interval = new DateInterval('P1D');
                $period = new DatePeriod($start, $interval, $end);
                $days = ["L", "M", "M", "J", "V"];
                foreach ($period as $date) {
                    if ($date->format('N') < 6) {
                        echo "<th>" . $days[$date->format('N') - 1] . " " . $date->format('d') . "</th>";
                    }
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
 foreach ($alumnos as $alumno) {
    echo "<tr>";
    echo "<td>" . $alumno['nombre'] . "</td>";
    foreach ($period as $date) {
        if ($date->format('N') < 6) {
            // Comprobar si el alumno asistió ese día
            if (isset($asistenciasPorAlumno[$alumno['uid']]) && in_array($date->format('Y-m-d'), $asistenciasPorAlumno[$alumno['uid']])) {
                echo "<td style='background-color: green;'>✓</td>";  // Indicador de asistencia con fondo verde
            } else {
                // Si el día ya ha pasado y no hay registro de asistencia, la celda se llenará de rojo
                if ($date < $fechaActual && $date->format('Y-m-d') != $fechaActual->format('Y-m-d')) {
                    echo "<td style='background-color: red;'></td>";
                } else {
                    echo "<td></td>";  // Celda vacía si no hay registro de asistencia y el día aún no ha pasado o es el día actual
                }
            }
        }
    }
    echo "</tr>";
}
            ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            for ($i = 10; $i <= 12; $i++) {
                echo '<li class="page-item ' . ($mesActual == $i ? 'active' : '') . '"><a class="page-link" href="?mes=' . $i . '">' . $meses[$i] . '</a></li>';
            }
            ?>
        </ul>
    </nav>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
