<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', 'admin', 'registro');

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos de la solicitud POST
    $nombreUbicacion = $_POST['nombreUbicacion'];
    $pisos = $_POST['pisos'];
    $descripcion = $_POST['descripcion'];

    // Preparar la consulta SQL para insertar la nueva ubicación
    $stmt = $mysqli->prepare("INSERT INTO ubicacion (nombreUbicacion, pisos, descripcion) VALUES (?, ?, ?)");

    // Vincular los datos a la consulta SQL
    $stmt->bind_param("sis", $nombreUbicacion, $pisos, $descripcion);

    // Ejecutar la consulta SQL
    if ($stmt->execute()) {
        // Si la consulta fue exitosa, redirigir al usuario a gestion_ubicaciones.php
        header("Location: gestion_ubicaciones.php");
    } else {
        // Si la consulta falló, mostrar un mensaje de error
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva Ubicación</title>
    <link rel="icon" href="https://ci.veracruz.tecnm.mx/img/favicon/tecnm.ico">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/bootstrap.min.css">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/estilo-compresion.min.css">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/jssorStyle.css">
    <link href="./Centro de Información ITVER_files/styles_formulario.css" rel="stylesheet">
    <style>
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 1em;
        }
        .form-group label {
            margin-bottom: 0.5em;
        }
        #back-button {
            float: left;
            color: white;
            background-color: #1B396A;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            right: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <header>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
        <h2 class="titulo"><b>Nueba Ubicacion</b></h2>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
    </header>
    <main class="formulario">
        <form method="POST">
            <div class="form-group">
                <a href="gestion_ubicaciones.php" id="back-button">Regresar</a>
            </div>
            <div class="form-group">
                <label for="nombreUbicacion">Nombre de Ubicación:</label>
                <input type="text" id="nombreUbicacion" name="nombreUbicacion" required>
            </div>

            <div class="form-group">
                <label for="pisos">Pisos:</label>
                <input type="number" id="pisos" name="pisos">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion">
            </div>

            <input type="submit" value="Agregar Ubicación">
        </form>
    </main>
</body>
</html>

