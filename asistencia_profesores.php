<?php

//Asistencia de alumnos

// Datos ficticios para simular la información
$alumnos = [
    "Juan Pérez" => [
        "asistencias" => [
            ["fecha" => "2023-10-01", "hora" => "10:00 AM"],
            ["fecha" => "2023-10-02", "hora" => "11:00 AM"]
        ],
        "inasistencias" => [
            ["fecha" => "2023-10-03", "hora" => "09:00 AM"]
        ]
    ],
    "María García" => [
        "asistencias" => [
            ["fecha" => "2023-10-01", "hora" => "10:00 AM"]
        ],
        "inasistencias" => []
    ],
    "Carlos Rodríguez" => [
        "asistencias" => [],
        "inasistencias" => [
            ["fecha" => "2023-10-03", "hora" => "09:00 AM"]
        ]
    ],
    "Ana López" => [
        "asistencias" => [
            ["fecha" => "2023-10-04", "hora" => "10:00 AM"]
        ],
        "inasistencias" => []
    ],
    "Luis Torres" => [
        "asistencias" => [
            ["fecha" => "2023-10-01", "hora" => "10:00 AM"],
            ["fecha" => "2023-10-02", "hora" => "11:00 AM"]
        ],
        "inasistencias" => [
            ["fecha" => "2023-10-03", "hora" => "09:00 AM"],
            ["fecha" => "2023-10-04", "hora" => "10:00 AM"]
        ]
    ],
];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Menu -->
<?php include 'menu.php'; ?>
<div class="container mt-5">
    <h2>Dashboard del Profesor</h2>
    <h3>Lista de Alumnos</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Alumno</th>
                <th>Asistencias</th>
                <th>Inasistencias</th>
                <th>Porcentaje de Asistencia</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alumnos as $nombre => $datos): ?>
                <tr>
                    <td><?php echo $nombre; ?></td>
                    <td>
                        <?php foreach ($datos["asistencias"] as $asistencia): ?>
                            <?php echo $asistencia["fecha"] . " - " . $asistencia["hora"]; ?><br>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <?php foreach ($datos["inasistencias"] as $inasistencia): ?>
                            <?php echo $inasistencia["fecha"] . " - " . $inasistencia["hora"]; ?><br>
                        <?php endforeach; ?>
                    </td>
                    <td><?php echo round((count($datos["asistencias"]) / (count($datos["asistencias"]) + count($datos["inasistencias"]))) * 100) . "%"; ?></td>
                    <td><button class="btn btn-primary">Editar</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Gráfica de Asistencias</h3>
    <canvas id="asistenciasChart"></canvas>
</div>

<script>
    var ctx = document.getElementById('asistenciasChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_keys($alumnos)); ?>,
            datasets: [{
                label: 'Asistencias',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                data: <?php echo json_encode(array_map(function($alumno) { return count($alumno["asistencias"]); }, $alumnos)); ?>
            }, {
                label: 'Inasistencias',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                data: <?php echo json_encode(array_map(function($alumno) { return count($alumno["inasistencias"]); }, $alumnos)); ?>
            }]
        },
        options: {}
    });
</script>
</body>
</html>
