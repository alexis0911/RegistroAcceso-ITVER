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
    // Ejecutar la consulta SQL
    $stmt->execute();
    // Obtener los resultados
    $result = $stmt->get_result();
    $alumno = $result->fetch_assoc();

    //$db = mysqli_connect('localhost', 'root', 'admin');
    //mysqli_select_db($db, 'registro');
    //$alumno = mysqli_query($db, "SELECT * FROM alumno WHERE nControl = $numeroControl OR rfid = $numeroControl");

    if ($alumno) {
        $uso = new Cuso();
        $uso->Alumno_idAlumno=intval($alumno['idAlumno']);
        $uso->Salon_idSalon=intval($_POST['salon']);
        $uso->Usuario_idUsuario=intval(1);
        $uso->dia=Date('Y-m-d');
        $uso->horaEntrada=Date('H-i-s');
        $uso->insert();
        echo "qwe." . $numeroControl;
    } else {
        // El alumno no existe, mostrar un mensaje de error y emitir un sonido de error
        echo "Usuario no registrado." . $numeroControl;
        //echo "<audio src='error_sound.mp3' autoplay></audio>";
    }
}
// Cerrar la conexión
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Centro de Información ITVER</title>
    <link rel="icon" href="https://ci.veracruz.tecnm.mx/img/favicon/tecnm.ico">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/bootstrap.min.css">
    <style>
        /* Estilos generales */
        .card:hover {
            box-shadow: 8px 8px 8px blue;
            transform: scale(1.2);
        }
        .one-time.slick-initialized {
            visibility: visible;
        }
        /* Estilos del encabezado */
        .titulo {
            background-color: #1B396A;
            margin: 0;
            text-align: center;
        }
        .barra {
            width: 100%;
            background-color: #1B396A;
            height: 2vw;
        }
        /* Estilos del contenido principal */
        .formulario {
            color: #777;
            background-color: #1B396A;
            text-align: center;
            padding: 50px 80px;
        }
        #menu-button {
            color: #1B396A;
            background-color: white;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
            border-radius: 10px;
        }
        .cuadro {
            width: 300px;
            height: 200px;
            background-color: white;
            margin: auto;
            border-radius: 10px;
            /* Usar flexbox para centrar los elementos */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        h3 {
            color: #1B396A; /* Cambiar el color del texto */
            margin: 0; 
        }
        input, button {
            margin: 10px; 
            width: 50%; 
            align-self: center; /* Centrar horizontalmente */
        }
        button {
            margin-top: auto; /* Posicionar al final del cuadro */
            
        }
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 1em;
        }
        .form-group label {
            margin-bottom: 0.5em;
        }
    </style>
    <link href="./Centro de Información ITVER_files/styles_formulario.css" rel="stylesheet">
</head>
<body>
    <header>
        <h2 class="titulo"><b>Registrar</b></h2>
        <div class="barra"></div>
    </header>
    <main class="formulario">
        <form method="POST">
            <div class="form-group">
                <a href="Menu_administrador.php" id="back-button">Regresar</a>
            </div>
            <div class="form-group">
                <label for="Ubicacion_idUbicacion">Ubicación:</label>
                <select id="Ubicacion_idUbicacion" name="Ubicacion_idUbicacion" required>
                    <?php foreach ($ubicaciones as $ubicacion): ?>
                        <option value="<?= $ubicacion['idUbicacion'] ?>"><?= $ubicacion['nombreUbicacion'] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="salon">Salón:</label>
                <select id="salon" name="salon" required>
                    <!-- Las opciones se llenarán con JavaScript -->
                </select>
                <h3>Número de control</h3>
                <input type="text" id="numero-control" name="numero-control" class="input-text" maxlength="10" pattern="[A-Z]\d{8}" required placeholder="Ejemplo: A12345678">
                <button type="submit" id="enviar-formulario" class="boton-enviar" style="width: 100px;">Enviar</button>
            </div>
        </form>
    </main>
    <script>
        document.getElementById('enviar-formulario').addEventListener('click', function(e) {
            // Simplemente permitir que el formulario se envíe normalmente
            document.querySelector('form').submit();
        });
            document.getElementById("Ubicacion_idUbicacion").addEventListener("change", function() {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "get_salones.php?idUbicacion=" + this.value, true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        // Parsear los resultados
                        var salones = JSON.parse(this.responseText);
                        // Limpiar las opciones de salones
                        var salonSelect = document.getElementById("salon");
                        salonSelect.innerHTML = "";
                        // Llenar las opciones de salones
                        for (var i = 0; i < salones.length; i++) {
                            var option = document.createElement("option");
                            option.text = salones[i].identificador;
                            option.value = salones[i].idSalon;
                            salonSelect.add(option);
                        }
                    }
                };
                xhr.send();
            });
            var numeroControl = document.getElementById("numero-control");
            var timer = null;
            numeroControl.addEventListener("input", function() {
                clearTimeout(timer);
                timer = setTimeout(function() {
                    numeroControl.value = "";
                }, 10000);
            });
         </script>
</body>
</html>