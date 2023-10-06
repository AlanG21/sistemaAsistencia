<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Profesores</title>
    <?php include 'menu.php'; ?>
    <!-- Incluye Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Formulario de Profesores</h1>
        <form action="procesar_formulario.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
            
        <div class="form-group">
    <label for="tarjeta_rfid">Selecciona una Tarjeta RFID:</label>
    <select name="tarjeta_rfid" id="tarjeta_rfid" class="form-control">
        <option value="">Selecciona una tarjeta RFID</option>
        <?php
        // Obtén las tarjetas RFID disponibles desde tu base de datos o datos ficticios
        $tarjetas_disponibles = obtenerTarjetasDisponibles(); // Reemplaza esto con tu función real
        foreach ($tarjetas_disponibles as $tarjeta) {
            echo '<option value="' . $tarjeta['tarjeta_id'] . '">' . $tarjeta['numero_tarjeta'] . '</option>';
        }
        ?>
    </select>
</div>

            </form>


    <!-- Incluye Bootstrap JS y jQuery (opcional, para características interactivas) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
