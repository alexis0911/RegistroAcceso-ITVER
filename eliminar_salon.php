<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', 'admin', 'registro');

if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Obtener el ID del salón de la URL
$id = $_POST['id'];

// Ejecutar la consulta SQL para eliminar el salón
if ($mysqli->query("DELETE FROM salon WHERE idSalon = $id") === TRUE) {
    // Devolver una respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'success'));
} else {
    // Devolver una respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'error', 'message' => 'Error al eliminar salón: ' . $mysqli->error));
}

// Cerrar la conexión a la base de datos
$mysqli->close();
?>