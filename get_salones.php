<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', 'admin', 'registro');

// Comprobar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Obtener el id de la ubicación desde la solicitud GET
$idUbicacion = isset($_GET['idUbicacion']) ? $_GET['idUbicacion'] : null;

// Preparar la consulta SQL para obtener los salones
$stmt = $mysqli->prepare("SELECT * FROM salon WHERE Ubicacion_idUbicacion = ?");

// Vincular el id de la ubicación al parámetro de la consulta
$stmt->bind_param("i", $idUbicacion);

// Ejecutar la consulta SQL
$stmt->execute();

// Obtener los resultados
$result = $stmt->get_result();
$salones = $result->fetch_all(MYSQLI_ASSOC);

// Devolver los salones en formato JSON
echo json_encode($salones);
?>