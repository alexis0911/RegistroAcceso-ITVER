<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', 'admin', 'registro');

// Obtener el ID de la ubicación de la URL
$idUbicacion = $_GET['id'];

// Preparar la consulta SQL
$stmt = $mysqli->prepare("SELECT * FROM ubicacion WHERE idUbicacion = ?");

// Verificar si la consulta se preparó correctamente
if ($stmt === false) {
    die("Error: " . $mysqli->error);
}

// Vincular los parámetros a la consulta SQL
$stmt->bind_param("i", $idUbicacion);

// Ejecutar la consulta SQL
$stmt->execute();

// Obtener los resultados de la consulta
$result = $stmt->get_result();
$ubicacion = $result->fetch_assoc();

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos de la solicitud POST
    $nombreUbicacion = $_POST['nombreUbicacion'];
    $pisos = $_POST['pisos'];
    $descripcion = $_POST['descripcion'];

    // Preparar la consulta SQL para actualizar la ubicación
    $stmt = $mysqli->prepare("UPDATE ubicacion SET nombreUbicacion = ?, pisos = ?, descripcion = ? WHERE idUbicacion = ?");

    // Vincular los datos a la consulta SQL
    $stmt->bind_param("sisi", $nombreUbicacion, $pisos, $descripcion, $idUbicacion);

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
        .formulario {
            margin: auto;
        }
        .styled-checkbox {
            display: none;
        }

        .styled-checkbox + label {
            position: relative;
            padding-left: 35px;
            cursor: pointer;
            display: inline-block;
            color: #666;
            font-size: 14px;
        }
        .styled-checkbox + label:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 25px;
            height: 25px;
            border: 2px solid #ddd;
            border-radius: 3px;
            background-color: #f8f8f8;
        }
        .styled-checkbox:checked + label:after {
            content: "";
            position: absolute;
            left: 9px;
            top: 5px;
            width: 8px;
            height: 14px;
            border: solid #000;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }
    </style>
</head>
<body>
    <header>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
        <h2 class="titulo"><b>Editar aula</b></h2>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
    </header>
    <main class="formulario">
        <form method="POST">
            <div class="form-group">
                <a href="gestion_ubicaciones.php" id="back-button">Regresar</a>
            </div>
            <div class="form-group">
                <label for="nombreUbicacion">Nombre de Ubicación:</label>
                <input type="text" id="nombreUbicacion" name="nombreUbicacion" value="<?= $ubicacion['nombreUbicacion'] ?>" required>
            </div>

            <div class="form-group">
                <label for="pisos">Pisos:</label>
                <input type="number" id="pisos" name="pisos" value="<?= $ubicacion['pisos'] ?>" min="1">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" value="<?= $ubicacion['descripcion'] ?>">
            </div>

            <input type="hidden" name="idUbicacion" value="<?= $ubicacion['idUbicacion'] ?>">
            <input type="submit" value="Actualizar Ubicación">
        </form>
        <script>
            function updatePisos() {
                // Obtener la ubicación seleccionada y su cantidad de pisos
                var ubicacion = document.getElementById('Ubicacion_idUbicacion').selectedOptions[0];
                var pisos = ubicacion.getAttribute('data-pisos');

                // Obtener el menú desplegable de pisos
                var selectPisos = document.getElementById('pisos');

                // Limpiar las opciones existentes
                selectPisos.innerHTML = '';

                // Agregar nuevas opciones para cada piso
                for (var i = 1; i <= pisos; i++) {
                    var option = document.createElement('option');
                    option.value = i;
                    option.text = 'Piso ' + i;
                    // Si el piso actual del aula es igual a i, seleccionar esta opción
                    if (i == <?= $ubicacion['pisos'] ?>) {
                        option.selected = true;
                    }
                    selectPisos.appendChild(option);
                }
            }

            // Llamar a updatePisos cuando la página se carga para generar las opciones de piso iniciales
            window.onload = updatePisos;
        </script>
    </main>