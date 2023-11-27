<?php
$id = $_GET['id'];
$conexion = mysqli_connect('localhost', 'root', 'admin', 'registro');
if (!$conexion) {
    die('Error de conexión: ' . mysqli_connect_error());
}
$sql = "DELETE FROM alumno WHERE idAlumno = $id";
if (mysqli_query($conexion, $sql)) {
    echo "Registro eliminado con éxito";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}
mysqli_close($conexion);
?>