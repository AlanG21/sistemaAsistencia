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
    <title>Dashboard del Alumno</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Dashboard del Alumno</h2>
        <a href="logout.php" class="btn btn-danger">Cerrar sesión</a> <!-- Botón para cerrar sesión -->
    </div>
    
    <h3>Lista de Alumnos</h3>
    <table class="table table-bordered">
        <!-- Resto del código HTML sin cambios ... -->

    </table>

    <h3>Gráfica de Asistencias</h3>
    <canvas id="asistenciasChart"></canvas>
</div>

<script>
    // Resto del código JavaScript sin cambios ...
</script>
</body>
</html>