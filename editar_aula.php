<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', 'admin', 'registro');

// Obtener todas las ubicaciones
$result = $mysqli->query("SELECT * FROM ubicacion");
$ubicaciones = $result->fetch_all(MYSQLI_ASSOC);

// Obtener el ID del aula de la URL
$id = $_GET['id'];

// Preparar la consulta SQL
$stmt = $mysqli->prepare("SELECT * FROM salon WHERE idSalon = ?");

// Verificar si la consulta se preparó correctamente
if ($stmt === false) {
    die("Error: " . $mysqli->error);
}

// Vincular los parámetros a la consulta SQL
$stmt->bind_param("i", $id);

// Ejecutar la consulta SQL
$stmt->execute();

// Obtener los resultados de la consulta
$result = $stmt->get_result();
$aula = $result->fetch_assoc();

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos de la solicitud POST
    $identificador = $_POST['identificador'];
    $piso = $_POST['piso'];
    $categoria = $_POST['categoria'];
    $capacidadUso = $_POST['capacidadUso'];
    $climas = isset($_POST['climas']) ? 1 : 0;
    $horaApertura = $_POST['horaApertura'];
    $horaCierre = $_POST['horaCierre'];
    $Ubicacion_idUbicacion = $_POST['Ubicacion_idUbicacion'];

    // Preparar la consulta SQL para actualizar el aula
    $stmt = $mysqli->prepare("UPDATE salon SET identificador = ?, piso = ?, categoria = ?, capacidadUso = ?, climas = ?, horaApertura = ?, horaCierre = ?, Ubicacion_idUbicacion = ? WHERE idSalon = ?");

    // Vincular los datos a la consulta SQL
    $stmt->bind_param("siisissii", $identificador, $piso, $categoria, $capacidadUso, $climas, $horaApertura, $horaCierre, $Ubicacion_idUbicacion, $id);

    // Ejecutar la consulta SQL
    if ($stmt->execute()) {
        // Si la consulta fue exitosa, redirigir al usuario a gestion_aulas.php
        header("Location: gestion_aulas.php");
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
        <h2 class="titulo"><b>Nueva aula</b></h2>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
    </header>
    <main class="formulario">
        <form method="POST">
            <div class="form-group">
                <a href="gestion_aulas.php" id="back-button">Regresar</a>
            </div>
            <div class="form-group">
                <label for="identificador">Identificador:</label>
                <input type="text" id="identificador" name="identificador" value="<?= $aula['identificador'] ?>" required>
            </div>
            <div class="form-group">
                <label for="Ubicacion_idUbicacion">ID de Ubicación:</label>
                <select id="Ubicacion_idUbicacion" name="Ubicacion_idUbicacion" required onchange="updatePisos()">
                    <?php foreach ($ubicaciones as $ubicacion): ?>
                        <option value="<?= $ubicacion['idUbicacion'] ?>" data-pisos="<?= $ubicacion['pisos'] ?>" <?= $ubicacion['idUbicacion'] == $aula['Ubicacion_idUbicacion'] ? 'selected' : '' ?>><?= $ubicacion['nombreUbicacion'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="piso">Piso:</label>
                <select id="piso" name="piso">
                    <!-- Aquí deberías generar las opciones de piso basándote en la ubicación seleccionada y seleccionar el piso actual del aula -->
                </select>
            </div>
            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria">
                    <!-- Aquí deberías generar las opciones de categoría y seleccionar la categoría actual del aula -->
                </select>
            </div>
            <div class="form-group">
                <label for="capacidadUso">Capacidad de Uso:</label>
                <input type="number" id="capacidadUso" name="capacidadUso" min="0" value="<?= $aula['capacidadUso'] ?>">
            </div>
            <div class="form-group">
                <input type="checkbox" id="climas" name="climas" class="styled-checkbox" <?= $aula['climas'] ? 'checked' : '' ?>>
                <label for="climas">Climas</label>
            </div>
            <div class="form-group">
                <label for="horaApertura">Hora de Apertura:</label>
                <input type="time" id="horaApertura" name="horaApertura" value="<?= $aula['horaApertura'] ?>">
            </div>
            <div class="form-group">
                <label for="horaCierre">Hora de Cierre:</label>
                <input type="time" id="horaCierre" name="horaCierre" value="<?= $aula['horaCierre'] ?>">
                </div>
                <input type="submit" value="Actualizar Salón">
        </form>
        <script>
            function updatePisos() {
                // Obtener la ubicación seleccionada y su cantidad de pisos
                var ubicacion = document.getElementById('Ubicacion_idUbicacion').selectedOptions[0];
                var pisos = ubicacion.getAttribute('data-pisos');

                // Obtener el menú desplegable de pisos
                var selectPisos = document.getElementById('piso');

                // Limpiar las opciones existentes
                selectPisos.innerHTML = '';

                // Agregar nuevas opciones para cada piso
                for (var i = 1; i <= pisos; i++) {
                    var option = document.createElement('option');
                    option.value = i;
                    option.text = 'Piso ' + i;
                    // Si el piso actual del aula es igual a i, seleccionar esta opción
                    if (i == <?= $aula['piso'] ?>) {
                        option.selected = true;
                    }
                    selectPisos.appendChild(option);
                }
            }

            // Llamar a updatePisos cuando la página se carga para generar las opciones de piso iniciales
            window.onload = updatePisos;
        </script>
    </main>