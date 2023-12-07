<?php
session_start();
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

    $ubica = $_POST['Ubicacion_idUbicacion'];
    $stmt = $mysqli->prepare("SELECT * FROM salon WHERE Ubicacion_idUbicacion = '$ubica'");
    // Ejecutar la consulta SQL
    $stmt->execute();
    // Obtener los resultados
    $result = $stmt->get_result();
    $salones = $result->fetch_all(MYSQLI_ASSOC);

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
        echo "<audio src='interface-1-126517.mp3' autoplay></audio>";
        //echo('<script language="javascript">alert("'.'Base de datos inexistente'.'");</script>');
                // Almacenar los valores de "salon" y "ubicacion" en la sesión de PHP
    } else {
        // El alumno no existe, mostrar un mensaje de error y emitir un sonido de error
        echo "Usuario no registrado." . $numeroControl;
        echo "<audio src='error_sound.mp3' autoplay></audio>";
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
        .button {
            display: block;
            width: 100px;
            padding: 10px;
            background-color: #1B396A;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-align: center;
            align: center;
            
        }

        .button:hover {
            background-color: #807E82;
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
                <a href="Menu_administrador.php" id="back-button" >Regresar</a>
            </div>
            <div class="form-group">
                <label for="Ubicacion_idUbicacion">Ubicación:</label>
                <select id="Ubicacion_idUbicacion" name="Ubicacion_idUbicacion" required <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {echo ($_POST['check-activo']) ? 'disabled' : '';} ?>>
                        <?php foreach ($ubicaciones as $ubicacion): ?>
                            <option value="<?php echo $ubicacion['idUbicacion']; ?>" <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {echo ($_POST['Ubicacion_idUbicacion'] == $ubicacion['idUbicacion']) ? 'selected' : '';} ?>><?php echo $ubicacion['nombreUbicacion']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="salon">Salón:</label>
                    <select id="salon" name="salon" required <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {echo ($_POST['check-activo']) ? 'disabled' : '';} ?>>
                        <?php foreach ($salones as $salon): ?>
                            <option value="<?php echo $salon['idSalon']; ?>" <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {echo ($_POST['salon'] == $salon['idSalon']) ? 'selected' : '';} ?>><?php echo $salon['identificador']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="checkbox" id="check-activo" name="check-activo" style="display: none;" <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {echo ($_POST['check-activo']) ? 'checked' : '';} ?>/>
                    <div style="display: grid; justify-content: center; "><p class="button" onclick="toggleCheck()" id = "BotonConfirma" <?php echo ($_SERVER['REQUEST_METHOD'] === 'POST') ? ($_POST['check-activo']) ? 'style = "background-color: grey">Cancelar' : '>Confirmar' : '>Confirmar' ?></p></div>
                    <div id="elementos-ocultos" style="border-style: dotted; border-radius: 15px; padding:15px; display: <?php echo ($_SERVER['REQUEST_METHOD'] === 'POST') ? ($_POST['check-activo']) ? 'block' : 'none' : 'none' ?>;" >
                    <div style="display: grid; justify-content: center; background-color: green; border-radius: 5px;opacity: 0.8;padding:20px;margin-bottom:8px"><b style = "color: white">Listo para registrar</b></div>
                        <h3>Número de control</h3>
                        
                        <input type="text" id="numero-control" name="numero-control" class="input-text" maxlength="10" pattern="([A-Z]\d{8})|(\d{10})" required placeholder="Ejemplo: A12345678" <?php echo ($_SERVER['REQUEST_METHOD'] === 'POST') ? ($_POST['check-activo']) ? 'autofocus' : 'disabled' : 'disabled' ?>/>
                        <button onclick="enableAll()" type="submit"  class="boton-enviar" style="width: 100px;">Enviar</button>
                    </div>
            </div>
        </form>
    </main>
    <script>
        function enableAll() {
                                document.getElementById('Ubicacion_idUbicacion').disabled = false;
                                document.getElementById('salon').disabled = false;
                                document.getElementById('numero-control').disabled = false;
                        }
        function toggleCheck() {
                            var checkActivo = document.getElementById('check-activo');
                            checkActivo.checked = !checkActivo.checked;
                                document.getElementById('Ubicacion_idUbicacion').disabled = checkActivo.checked;
                                document.getElementById('salon').disabled = checkActivo.checked;
                                document.getElementById('numero-control').disabled = !checkActivo.checked;
                                if(checkActivo.checked){
                                    
                                    document.getElementById('elementos-ocultos').style['cssText']='border-style: dotted; border-radius: 15px; padding:15px; display:block;';
                                    document.getElementById('numero-control').focus();
                                    document.getElementById('BotonConfirma').innerHTML='Cancelar';
                                    document.getElementById('BotonConfirma').style['cssText']='background-color: grey;';
                                }
                                else{
                                    document.getElementById('elementos-ocultos').style['cssText']='border-style: dotted; border-radius: 15px; padding:15px; display:none';
                                    document.getElementById('BotonConfirma').innerHTML = "Confirmar";
                                    document.getElementById('BotonConfirma').style['cssText']='';

                                }
                        }

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
            }, 3500);
        });
    </script>
</body>
</html>