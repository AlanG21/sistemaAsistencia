<?php
include 'config.php';

function obtenerTarjetasDisponibles() {
    global $mysqli;

    $tarjetas = array();

    $sql = "SELECT tarjeta_id, numero_tarjeta FROM tarjetas_rfid WHERE tarjeta_id NOT IN (SELECT tarjeta_rfid_id FROM profesores WHERE tarjeta_rfid_id IS NOT NULL) AND tarjeta_id NOT IN (SELECT tarjeta_rfid_id FROM alumnos WHERE tarjeta_rfid_id IS NOT NULL)";

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tarjetas[] = $row;
        }
    }

    return $tarjetas;
}
?>
