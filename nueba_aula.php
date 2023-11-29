<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', 'admin', 'registro');
// Obtener todas las ubicaciones
$result = $mysqli->query("SELECT * FROM ubicacion");
$ubicaciones = $result->fetch_all(MYSQLI_ASSOC);
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
    // Preparar la consulta SQL para insertar el nuevo salon
    $stmt = $mysqli->prepare("INSERT INTO salon (identificador, piso, categoria, capacidadUso, climas, horaApertura, horaCierre, Ubicacion_idUbicacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    // Vincular los datos a la consulta SQL
    $stmt->bind_param("siisissi", $identificador, $piso, $categoria, $capacidadUso, $climas, $horaApertura, $horaCierre, $Ubicacion_idUbicacion);
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
                <input type="text" id="identificador" name="identificador" required>
            </div>
            <div class="form-group">
                <label for="Ubicacion_idUbicacion">ID de Ubicación:</label>
                <select id="Ubicacion_idUbicacion" name="Ubicacion_idUbicacion" required onchange="updatePisos()">
                    <?php foreach ($ubicaciones as $ubicacion): ?>
                        <option value="<?= $ubicacion['idUbicacion'] ?>" data-pisos="<?= $ubicacion['pisos'] ?>"><?= $ubicacion['nombreUbicacion'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="piso">Piso:</label>
                <select id="piso" name="piso"></select>
            </div>
            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria">
                    <option value="1">Categoría 1</option>
                    <option value="2">Categoría 2</option>
                    <option value="3">Categoría 3</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
            </div>
            <div class="form-group">
                <label for="capacidadUso">Capacidad de Uso:</label>
                <input type="number" id="capacidadUso" name="capacidadUso" min="0">
            </div>
            <div class="form-group">
                <input type="checkbox" id="climas" name="climas" class="styled-checkbox">
                <label for="climas">Climas</label>
            </div>
            <div class="form-group">
                <label for="horaApertura">Hora de Apertura:</label>
                <input type="time" id="horaApertura" name="horaApertura">
            </div>
            <div class="form-group">
                <label for="horaCierre">Hora de Cierre:</label>
                <input type="time" id="horaCierre" name="horaCierre">
            </div>
            <input type="submit" value="Agregar Salón">
        </form>
        <script>
            function updatePisos() {
                // Obtener la ubicación seleccionada y su cantidad de pisos
                var ubicacion = document.getElementById('Ubicacion_idUbicacion').selectedOptions[0];
                var pisos = ubicacion.getAttribute('data-pisos')    ;
                // Obtener el menú desplegable de pisos
                var selectPisos = document.getElementById('piso');
                // Limpiar las opciones existentes
                selectPisos.innerHTML = '';
                // Agregar nuevas opciones para cada piso
                for (var i = 1; i <= pisos; i++) {
                    var option = document.createElement('option');
                    option.value = i;
                    option.text = i;
                    selectPisos.add(option);
                }
            }
            // Actualizar los pisos cuando se carga la página
            window.onload = updatePisos;
            </script>
    </main>
</body>
</html>