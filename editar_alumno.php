<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', 'admin', 'registro');

// Obtener el ID del alumno de la URL
$idAlumno = $_GET['id'];

// Preparar la consulta SQL
$stmt = $mysqli->prepare("SELECT * FROM alumno WHERE idAlumno = ?");

// Verificar si la consulta se preparó correctamente
if ($stmt === false) {
    die("Error: " . $mysqli->error);
}

// Vincular los parámetros a la consulta SQL
$stmt->bind_param("i", $idAlumno);

// Ejecutar la consulta SQL
$stmt->execute();

// Obtener los resultados de la consulta
$result = $stmt->get_result();
$alumno = $result->fetch_assoc();

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos de la solicitud POST
    $nombre = $_POST['nombre'];
    $nControl = $_POST['nControl'];
    $rfid = $_POST['rfid'];
    $carrera = $_POST['carrera'];
    $semestre = $_POST['semestre'];
    $sexo = $_POST['sexo'];

    // Preparar la consulta SQL para actualizar el alumno
    $stmt = $mysqli->prepare("UPDATE alumno SET nombre = ?, nControl = ?, rfid = ?, carrera = ?, semestre = ?, sexo = ? WHERE idAlumno = ?");

    // Vincular los datos a la consulta SQL
    $stmt->bind_param("ssssisi", $nombre, $nControl, $rfid, $carrera, $semestre, $sexo, $idAlumno);

    // Ejecutar la consulta SQL
    if ($stmt->execute()) {
        // Si la consulta fue exitosa, redirigir al usuario a gestion_alumnos.php
        header("Location: gestion_estudiantes.php");
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
        <form method="POST">
            <div class="form-group">
                <a href="gestion_estudiantes.php" id="back-button">Regresar</a>
            </div>
            <div class="form-group">
                <label for="nControl">Número de Control:</label>
                <input type="text" id="nControl" name="nControl" value="<?= isset($alumno['nControl']) ? $alumno['nControl'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= isset($alumno['nombre']) ? $alumno['nombre'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="rfid">RFID:</label>
                <input type="text" id="rfid" name="rfid" value="<?= isset($alumno['rfid']) ? $alumno['rfid'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="carrera">Carrera:</label>
                <select id="carrera" name="carrera" class="campo" required>
                    <option value="" disabled selected>Carrera</option>
                    <option value="0" <?= isset($alumno['carrera']) && $alumno['carrera'] == '0' ? 'selected' : '' ?>>Licenciatura en Administración</option>
                    <option value="1" <?= isset($alumno['carrera']) && $alumno['carrera'] == '1' ? 'selected' : '' ?>>Ingeniería Bioquímica</option>
                    <option value="2" <?= isset($alumno['carrera']) && $alumno['carrera'] == '2' ? 'selected' : '' ?>>Ingeniería Eléctrica</option>
                    <option value="3" <?= isset($alumno['carrera']) && $alumno['carrera'] == '3' ? 'selected' : '' ?>>Ingeniería Electrónica</option>
                    <option value="4" <?= isset($alumno['carrera']) && $alumno['carrera'] == '4' ? 'selected' : '' ?>>Ingeniería Industrial</option>
                    <option value="5" <?= isset($alumno['carrera']) && $alumno['carrera'] == '5' ? 'selected' : '' ?>>Ingeniería Mecatrónica</option>
                    <option value="6" <?= isset($alumno['carrera']) && $alumno['carrera'] == '6' ? 'selected' : '' ?>>Ingeniería Mecánica</option>
                    <option value="7" <?= isset($alumno['carrera']) && $alumno['carrera'] == '7' ? 'selected' : '' ?>>Ingeniería en Sistemas Computacionales</option>
                    <option value="8" <?= isset($alumno['carrera']) && $alumno['carrera'] == '8' ? 'selected' : '' ?>>Ingeniería Química</option>
                    <option value="9" <?= isset($alumno['carrera']) && $alumno['carrera'] == '9' ? 'selected' : '' ?>>Ingeniería en Energías Renovables</option>
                    <option value="10" <?= isset($alumno['carrera']) && $alumno['carrera'] == '10' ? 'selected' : '' ?>>Ingeniería en Gestión Empresarial</option>
                </select>
            </div>
            <div class="form-group">
                <label for="semestre">Semestre:</label>
                <select id="semestre" name="semestre" class="campo" required>
                    <option value="" disabled selected>Semestre</option>
                    <option value="1" <?= isset($alumno['semestre']) && $alumno['semestre'] == '1' ? 'selected' : '' ?>>1</option>
                    <option value="2" <?= isset($alumno['semestre']) && $alumno['semestre'] == '2' ? 'selected' : '' ?>>2</option>
                    <option value="3" <?= isset($alumno['semestre']) && $alumno['semestre'] == '3' ? 'selected' : '' ?>>3</option>
                    <option value="4" <?= isset($alumno['semestre']) && $alumno['semestre'] == '4' ? 'selected' : '' ?>>4</option>
                    <option value="5" <?= isset($alumno['semestre']) && $alumno['semestre'] == '5' ? 'selected' : '' ?>>5</option>
                    <option value="6" <?= isset($alumno['semestre']) && $alumno['semestre'] == '6' ? 'selected' : '' ?>>6</option>
                    <option value="7" <?= isset($alumno['semestre']) && $alumno['semestre'] == '7' ? 'selected' : '' ?>>7</option>
                    <option value="8" <?= isset($alumno['semestre']) && $alumno['semestre'] == '8' ? 'selected' : '' ?>>8</option>
                    <option value="9" <?= isset($alumno['semestre']) && $alumno['semestre'] == '9' ? 'selected' : '' ?>>9</option>
                    <option value="10" <?= isset($alumno['semestre']) && $alumno['semestre'] == '10' ? 'selected' : '' ?>>10</option>
                    <option value="11" <?= isset($alumno['semestre']) && $alumno['semestre'] == '11' ? 'selected' : '' ?>>11</option>
                    <option value="12" <?= isset($alumno['semestre']) && $alumno['semestre'] == '12' ? 'selected' : '' ?>>12</option>
                    <option value="13" <?= isset($alumno['semestre']) && $alumno['semestre'] == '13' ? 'selected' : '' ?>>13</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo">
                    <option value="0" <?= isset($alumno['sexo']) && $alumno['sexo'] == '0' ? 'selected' : '' ?>>Hombre</option>
                    <option value="1" <?= isset($alumno['sexo']) && $alumno['sexo'] == '1' ? 'selected' : '' ?>>Mujer</option>
                </select>
            </div>
            <input type="hidden" name="nControl" value="<?= $alumno['nControl'] ?>">
            <input type="submit" value="Actualizar Alumno">
        </form>
    </main>
</body>
</html>