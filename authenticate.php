<?php
include 'db.php';

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Realiza una consulta para obtener el rol del usuario
$sql = "SELECT email, 'profesor' as rol FROM profesores WHERE email='$email' AND password='$password'
UNION
SELECT email, 'administrador' as rol FROM administradores WHERE email='$email' AND password='$password'
UNION
SELECT email, 'alumno' as rol FROM alumnos WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Usuario encontrado en la tabla 'profesores'
    $user = $result->fetch_assoc();
    $rol = $user['rol'];

    // Comprueba el rol y redirige al dashboard correspondiente
    if ($rol == 'administrador') {
        session_start();
        $_SESSION['email'] = $email;
        header('Location: dashboard_administrador.php');
    } elseif ($rol == 'profesor') {
        session_start();
        $_SESSION['email'] = $email;
        header('Location: dashboard_profesor.php');
    } elseif ($rol == 'alumno') {
        session_start();
        $_SESSION['email'] = $email;
        header('Location: dashboard_alumno.php');
    }
} else {
    // Datos incorrectos
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
