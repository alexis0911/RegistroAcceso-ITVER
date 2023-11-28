<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', 'admin', 'registro');

if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Obtener el ID de la ubicación de la URL
$id = $_POST['id'];

// Ejecutar la consulta SQL para eliminar la ubicación
if ($mysqli->query("DELETE FROM ubicacion WHERE idUbicacion = $id") === TRUE) {
    // Devolver una respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'success'));
} else {
    // Devolver una respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'error', 'message' => 'Error al eliminar ubicación: ' . $mysqli->error));
}

// Cerrar la conexión a la base de datos
$mysqli->close();
?>