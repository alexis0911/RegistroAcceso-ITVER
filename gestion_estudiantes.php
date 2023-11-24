<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de alumnos</title>
    <link rel="icon" href="https://ci.veracruz.tecnm.mx/img/favicon/tecnm.ico">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/bootstrap.min.css">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/estilos.css">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/fa-svg-with-js.css">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/iconos.css">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/estilo-compresion.min.css">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/jssorStyle.css">
    <link href="./Centro de Información ITVER_files/slick-theme.css" rel="stylesheet">
    <link href="./Centro de Información ITVER_files/slick.css" rel="stylesheet">
    <style>
        .card:hover {
            box-shadow: 8px 8px 8px blue;
            transform: scale(1.2);
        }
        
        .one-time.slick-initialized {
            visibility: visible;
        }
        .titulo {
            background-color: #1B396A;
            margin: 0%;
            text-align: center;
        }
        .formulario {
            color: #777;
            background-color: #1B396A;
            text-align: center;
            padding: 50px 80px;
            text-align: justify;
        }
        #back-button {
            color: white;
            background-color: #1B396A;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            right: 20px;
            border-radius: 10px;
        }
        /* Agregar un estilo para los botones de editar y eliminar */
        .boton {
            color: white;
            border: none;
            padding: 5px 10px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
        }
        .editar {
            background-color: green;
        }
        .eliminar {
            background-color: red;
        }
    </style>
    <link href="./Centro de Información ITVER_files/styles_formulario.css" rel="stylesheet">
</head>
<body>
    <!-- Slider -->
    <header>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
        <h2 class="titulo"><b>Gestión de alumnos</b></h2>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
    </header>
    <!-- FORMULARIO -->
    <main class="formulario">
        <form id="myForm" action="https://ci.veracruz.tecnm.mx/gestion_alumnos.php" method="post" onsubmit="return validateForm()">
            <!-- Tabla de datos -->
            <a href="#" id="back-button">Regresar</a>
            <?php
            // Conectar a la base de datos registro usando el usuario root y la contraseña admin
            $conexion = mysqli_connect("localhost", "root", "admin", "registro");
            // Verificar si la conexión fue exitosa
            if ($conexion) {
                // Crear una consulta SQL para obtener todos los datos de la tabla alumno
                $consulta = "SELECT * FROM alumno";
                // Ejecutar la consulta y obtener el resultado
                $resultado = mysqli_query($conexion, $consulta);
                // Verificar si el resultado tiene filas
                if (mysqli_num_rows($resultado) > 0) {
                    // Crear una tabla HTML para mostrar los datos
                    echo "<table style='margin: 1;'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>idAlumno</th>";
                    echo "<th>Número de control</th>";
                    echo "<th>RFID</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>Carrera</th>";
                    echo "<th>Semestre</th>";
                    echo "<th>Sexo</th>";
                    echo "<th>Acciones</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    // Recorrer cada fila del resultado
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        // Mostrar los datos de la fila en una columna de la tabla HTML
                        echo "<tr>";
                        echo "<td>" . $fila["idAlumno"] . "</td>";
                        echo "<td>" . $fila["nControl"] . "</td>";
                        echo "<td>" . $fila["rfid"] . "</td>";
                        echo "<td>" . $fila["nombre"] . "</td>";
                        echo "<td>" . $fila["carrera"] . "</td>";
                        echo "<td>" . $fila["semestre"] . "</td>";
                        echo "<td>" . $fila["sexo"] . "</td>";
                        echo "<td>";
                        echo "<button class='boton editar'>Editar</button>";
                        echo "<button class='boton eliminar'>Eliminar</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    // Si el resultado no tiene filas, mostrar un mensaje de que no hay datos
                    echo "<p>No hay datos en la tabla alumno.</p>";
                }
                // Cerrar la conexión
                mysqli_close($conexion);
            } else {
                // Si la conexión falló, mostrar un mensaje de error
                echo "<p>Hubo un error al conectar a la base de datos.</p>";
            }
            ?>
        </form>
    </main>
</body>
</html>
