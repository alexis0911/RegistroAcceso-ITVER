<?php
require_once("Clases/Cuso.php");
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', 'admin', 'registro');
// Comprobar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}
// Preparar la consulta SQL para obtener las ubicaciones
$stmt = $mysqli->prepare("SELECT * FROM ubicacion");
// Ejecutar la consulta SQL
$stmt->execute();
// Obtener los resultados
$result = $stmt->get_result();
$ubicaciones = $result->fetch_all(MYSQLI_ASSOC);
// Comprobar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el número de control o RFID desde el formulario
    $numeroControl = $_POST['numero-control'];
    // Preparar la consulta SQL para buscar el alumno
    $stmt = $mysqli->prepare("SELECT * FROM alumno WHERE nControl = ? OR rfid = ?");
    $stmt->bind_param("ss", $numeroControl, $numeroControl);
    $stmt->execute();
    $result = $stmt->get_result();
    $alumno = $result->fetch_assoc();

    if ($alumno) {
        $uso = new Cuso();
        $uso->Alumno_idAlumno=$alumno['idAlumno'];
        // Recuperar los valores de "salon" y "ubicacion" de la sesión de PHP
        if (isset($_SESSION['salon']) && isset($_SESSION['Ubicacion_idUbicacion'])) {
            $uso->Salon_idSalon=$_SESSION['salon'];
            $ubicacion = $_SESSION['Ubicacion_idUbicacion'];
        }
        $uso->Usuario_idUsuario=intval(1);
        $uso->dia=Date('Y-m-d');
        $uso->horaEntrada=Date('H:i:s');
        $uso->insert();
        echo "Uso Registrado." . $numeroControl;
                // Almacenar los valores de "salon" y "ubicacion" en la sesión de PHP
    } else {
        // El alumno no existe, mostrar un mensaje de error y emitir un sonido de error
        echo "Usuario no registrado." . $numeroControl;
        //echo "<audio src='error_sound.mp3' autoplay></audio>";
    }
}
// Cerrar la conexión
$mysqli->close();
?>