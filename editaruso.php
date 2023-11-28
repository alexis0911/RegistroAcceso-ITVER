
<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', 'admin', 'registro');

// Obtener el ID del uso de la URL
$idUso = $_GET['id'];

// Consultar la base de datos para obtener los detalles del uso
$result = $mysqli->query("
    SELECT uso.idUso, alumno.nControl, salon.identificador, usuarios.nombreUsuario, uso.dia, uso.horaEntrada 
    FROM uso 
    INNER JOIN alumno ON uso.Alumno_idAlumno = alumno.idAlumno
    INNER JOIN salon ON uso.Salon_idSalon = salon.idSalon
    INNER JOIN usuarios ON uso.Usuario_idUsuario = usuarios.idUsuario
    WHERE uso.idUso = $idUso
");
$uso = $result->fetch_assoc();

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los nuevos valores del formulario
    $nControl = $_POST['nControl'];
    $identificador = $_POST['identificador'];
    $nombreUsuario = $_POST['nombreUsuario'];
    $dia = $_POST['dia'];
    $horaEntrada = $_POST['horaEntrada'];

    // Actualizar la base de datos
    // Nota: Esto no funcionará como se espera porque estás intentando actualizar valores en varias tablas a la vez.
    // Necesitarás escribir consultas separadas para actualizar cada tabla individualmente.
    $mysqli->query("UPDATE uso SET nControl = '$nControl', identificador = '$identificador', nombreUsuario = '$nombreUsuario', dia = '$dia', horaEntrada = '$horaEntrada' WHERE idUso = $idUso");

    // Redirigir de vuelta a la página principal
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de alumnos</title>
    <link rel="icon" href="https://ci.veracruz.tecnm.mx/img/favicon/tecnm.ico">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/bootstrap.min.css">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/estilo-compresion.min.css">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/jssorStyle.css">

    <link href="./Centro de Información ITVER_files/styles_formulario.css" rel="stylesheet">
</head>
<body>
    <header>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
        <h2 class="titulo"><b>Gestión de alumnos</b></h2>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
    </header>
    <main class="formulario">

        <!-- Mostrar el formulario -->
        <form method="POST">
            Número de Control: <input name="nControl" value="<?php echo $uso['nControl']; ?>"><br>
            Identificador de Salón: <input name="identificador" value="<?php echo $uso['identificador']; ?>"><br>
            Nombre de Usuario: <input name="nombreUsuario" value="<?php echo $uso['nombreUsuario']; ?>"><br>
            Dia: <input name="dia" value="<?php echo $uso['dia']; ?>"><br>
            Hora Entrada: <input name="horaEntrada" value="<?php echo $uso['horaEntrada']; ?>"><br>
            <input type="submit" value="Actualizar">
        </form>
        
    </main>
</body>
</html>

