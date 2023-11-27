<?php
if (isset($_POST['nControl'])) {
    // Conectar a la base de datos
    $conexion = mysqli_connect('localhost', 'root', 'admin', 'registro');

    // Verificar la conexión
    if (!$conexion) {
        die('Error de conexión: ' . mysqli_connect_error());
    }

    // Recoger los datos del formulario
    $nControl = $_POST['nControl'];
    $nombre = $_POST['nombre'];
    $rfid = $_POST["rfid"];
    $carrera = $_POST['carrera'];
    $semestre = $_POST['semestre'];
    $sexo = $_POST['sexo'];

    // Crear la consulta SQL
    $sql = "INSERT INTO alumno (nControl, rfid, nombre, carrera, semestre, sexo) VALUES ('$nControl', '$rfid', '$nombre', '$carrera', '$semestre', '$sexo')";

    // Ejecutar la consulta SQL
    if (mysqli_query($conexion, $sql)) {
        echo "Nuevo registro creado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_error($conexion).
    mysqli_close($conexion);
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
        <form id="myForm"  method="post" onsubmit="return validateForm()">
            <a href="gestion_estudiantes.php" id="back-button">Regresar</a>
            <!-- Campos de entrada para los datos del nuevo alumno -->
            <input type="text" name="nControl" id="nControl" class="campo" placeholder="Número de control" required>
            <input type="text" name="rfid" id="rfid" class="campo" placeholder="RFID" required>
            <input type="text" name="nombre" id="nombre" class="campo" placeholder="Nombre" required>
            <!-- Cambiar el elemento input por un elemento select para la carrera -->
            <select name="carrera" id="carrera" class="campo" required>
                <!-- Agregar once elementos option para la carrera -->
                <option value="" disabled selected>Carrera</option>
                <option value="0">Licenciatura en Administración</option>
                <option value="1">Ingeniería Bioquímica</option>
                <option value="2">Ingeniería Eléctrica</option>
                <option value="3">Ingeniería Electrónica</option>
                <option value="4">Ingeniería Industrial</option>
                <option value="5">Ingeniería Mecatrónica</option>
                <option value="6">Ingeniería Mecánica</option>
                <option value="7">Ingeniería en Sistemas Computacionales</option>
                <option value="8">Ingeniería Química</option>
                <option value="9">Ingeniería en Energías Renovables</option>
                <option value="10">Ingeniería en Gestión Empresarial</option>
            </select>
            <select name="semestre" id="semestre" class="campo" required>
                <option value="" disabled selected>Semestre</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
            </select>
            <select name="sexo" id="sexo" class="campo" required>
                <option value="" disabled selected>Sexo</option>
                <option value="0">Masculino</option>
                <option value="1">Femenino</option> 
            </select>
            <button type="submit" id="save-button">Guardar</button> 
        </form>
    </main>
</body>
</html>
