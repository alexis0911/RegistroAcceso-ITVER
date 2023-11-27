<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', 'admin', 'registro');

if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Obtener el ID del alumno de la URL
$id = $_GET['id'];

// Ejecutar la consulta SQL para eliminar el alumno
if ($mysqli->query("DELETE FROM alumno WHERE idAlumno = $id") === TRUE) {
    echo "Alumno eliminado con éxito";
} else {
    echo "Error al eliminar alumno: " . $mysqli->error;
}

// Cerrar la conexión a la base de datos
$mysqli->close();
?>