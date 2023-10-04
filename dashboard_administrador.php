<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Control del Administrador</title>
    <!-- Incluye Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Estilo personalizado para añadir un margen superior adicional -->
    <style>
        .custom-margin {
            margin-top: 6rem; /* O el valor que desees */
        }
    </style>
</head>
<body>
    <!-- Incluye el menú -->
    <?php include 'menu.php'; ?>

    <div class="container custom-margin">
        <h2>Lista de Profesores</h2>
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Profesor</th>
                    <th>Asignaturas</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Datos ficticios de profesores
                $profesores = [
                    "Profesor 1" => [
                        "asignaturas" => ["Matemáticas", "Ciencias"],
                        "email" => "profesor1@example.com",
                    ],
                    "Profesor 2" => [
                        "asignaturas" => ["Historia", "Literatura"],
                        "email" => "profesor2@example.com",
                    ],
                    "Profesor 3" => [
                        "asignaturas" => ["Inglés", "Educación Física"],
                        "email" => "profesor3@example.com",
                    ],
                ];

                foreach ($profesores as $nombre => $datos) {
                    echo "<tr>";
                    echo "<td>$nombre</td>";
                    echo "<td>" . implode(", ", $datos["asignaturas"]) . "</td>";
                    echo "<td>" . $datos["email"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Lista de Alumnos</h2>
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Alumno</th>
                    <th>Clase</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Datos ficticios de alumnos
                $alumnos = [
                    "Juan Pérez" => [
                        "clase" => "Clase A",
                        "email" => "juan@example.com",
                    ],
                    "María García" => [
                        "clase" => "Clase B",
                        "email" => "maria@example.com",
                    ],
                    "Carlos Rodríguez" => [
                        "clase" => "Clase A",
                        "email" => "carlos@example.com",
                    ],
                ];

                foreach ($alumnos as $nombre => $datos) {
                    echo "<tr>";
                    echo "<td>$nombre</td>";
                    echo "<td>" . $datos["clase"] . "</td>";
                    echo "<td>" . $datos["email"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Incluye Bootstrap JS y jQuery (opcional, para características interactivas) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
