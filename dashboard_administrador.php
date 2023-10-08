<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');  // Redirige al usuario al login si no ha iniciado sesión
    exit;
}

// Connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rfid_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch alumnos
    $stmtAlumnos = $conn->prepare("SELECT id, nombre, apellido, uid FROM alumnos"); 
    $stmtAlumnos->execute();
    $alumnos = $stmtAlumnos->fetchAll();

    // Fetch profesores
    $stmtProfesores = $conn->prepare("SELECT id, nombre, apellido FROM profesores"); 
    $stmtProfesores->execute();
    $profesores = $stmtProfesores->fetchAll();

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
<?php include('nav_admin.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Incluir Bootstrap CSS -->
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

    <h2 class="mt-4">Alumnos</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>UID</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($alumnos as $alumno): ?>
            <tr>
                <td><?php echo $alumno['id']; ?></td>
                <td><?php echo $alumno['nombre']; ?></td>
                <td><?php echo $alumno['apellido']; ?></td>
                <td><?php echo $alumno['uid']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="mt-4">Profesores</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($profesores as $profesor): ?>
            <tr>
                <td><?php echo $profesor['id']; ?></td>
                <td><?php echo $profesor['nombre']; ?></td>
                <td><?php echo $profesor['apellido']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
