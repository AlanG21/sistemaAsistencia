<?php
include 'db.php';

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$sql = "SELECT * FROM profesores WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // datos correctos
    session_start();
    $_SESSION['email'] = $email;
    header('Location: dashboard.php');  // redirige a la página de inicio
} else {
    // datos incorrectos
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
