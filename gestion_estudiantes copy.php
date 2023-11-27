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
        /* Agregar un estilo para el botón de nuevo */
        #new-button {
            float: right; /* Alinear el botón a la derecha */
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
        <form id="myForm"  method="post" onsubmit="return validateForm()">
            <a href="Menu.html" id="back-button">Regresar</a>
            <a href="Registrar_Alumno.php" id="new-button" class="boton">Nuevo</a>
            
            <?php
                $conexion = mysqli_connect("localhost", "root", "admin", "registro");
                if ($conexion) {
                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
                    $first_row = ($page - 1) * 20;
                    echo "Sección 1";
                    // Get the search query
                    $search_query = isset($_GET['search']) ? $_GET['search'] : '';

                    // Add the search form
                    echo '<form action="gestion_estudiantes.php" method="get" style="margin-bottom: 20px;">';
                    echo '<input type="text" name="search" value="' . htmlspecialchars($search_query, ENT_QUOTES) . '" placeholder="Buscar" style="width: 200px; padding: 5px;">';
                    echo '<input type="submit" value="Buscar" style="margin-left: 10px; padding: 5px;">';
                    echo '</form>';

                    // Modify the SQL query to filter the results
                    if ($search_query != '') {
                        $consulta = "SELECT * FROM alumno WHERE nombre LIKE '%$search_query%' OR carrera LIKE '%$search_query%' OR semestre LIKE '%$search_query%' LIMIT $first_row, 20";
                    } else {
                        $consulta = "SELECT * FROM alumno LIMIT $first_row, 20";
                    }
                    $resultado = mysqli_query($conexion, $consulta);
                    
                if (mysqli_num_rows($resultado) > 0) {
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

                    echo "Sección 2";
                    // Get the search query
                    $search_query = isset($_GET['search']) ? $_GET['search'] : '';

                    // Add the search form
                    echo '<form action="gestion_estudiantes.php" method="get" style="margin-bottom: 20px;">';
                    echo '<input type="text" name="search" value="' . htmlspecialchars($search_query, ENT_QUOTES) . '" placeholder="Buscar" style="width: 200px; padding: 5px;">';
                    echo '<input type="submit" value="Buscar" style="margin-left: 10px; padding: 5px;">';
                    echo '</form>';

                    // Modify the SQL query to filter the results
                    if ($search_query != '') {
                        $consulta = "SELECT * FROM alumno WHERE nombre LIKE '%$search_query%' OR carrera LIKE '%$search_query%' OR semestre LIKE '%$search_query%' LIMIT $first_row, 20";
                    } else {
                        $consulta = "SELECT * FROM alumno LIMIT $first_row, 20";
                    }
                    $resultado = mysqli_query($conexion, $consulta);

                    if (mysqli_num_rows($resultado) > 0) {
                        while ($fila = mysqli_fetch_assoc($resultado)) {
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
                    } else {
                        echo "<p>No se encontraron resultados para su búsqueda.</p>";
                    }

                    echo "</tbody>";
                    echo "</table>";
                    // Get the total number of students
                    $resultado = mysqli_query($conexion, "SELECT COUNT(*) AS total FROM alumno");
                    $fila = mysqli_fetch_assoc($resultado);
                    $total_alumnos = $fila['total'];

                    // Calculate the total number of pages
                    $total_paginas = ceil($total_alumnos / 20);

                    // Calculate the start and end page
                    $start_page = max(1, $page - 4);
                    $end_page = min($total_paginas, $page + 4);

                    // Display a link to the first page
                    echo '<a href="gestion_estudiantes.php?page=1">Primera</a> ';
                    // Display links to the pages
                    for ($i = $start_page; $i <= $end_page; $i++) {
                        if ($i == $page) {
                            // Highlight the current page
                            echo '<strong>' . $i . '</strong> ';
                        } else {
                            echo '<a href="gestion_estudiantes.php?page=' . $i . '">' . $i . '</a> ';
                        }
                    }
                    // If there are more pages, display an ellipsis
                    if ($end_page < $total_paginas) {
                        echo '... ';
                    }
                    // Display a link to the last page
                    echo '<a href="gestion_estudiantes.php?page=' . $total_paginas . '">Última</a>';
                } else {
                    echo "<p>No hay datos en la tabla alumno.</p>";
                }
                mysqli_close($conexion);
            } else {
                echo "<p>Hubo un error al conectar a la base de datos.</p>";
            }
            ?>
            <script>
                // Obtener todos los botones de editar por su clase
                var editButtons = document.getElementsByClassName("editar");

                // Agregar un evento de clic a cada botón de editar
                for (var i = 0; i < editButtons.length; i++) {
                    editButtons[i].addEventListener("click", function() {
                        var id = this.parentNode.parentNode.firstChild.textContent;
                        window.location.href = "editar_alumno.php?id=" + id;
                    });
                }
                // Obtener todos los botones de eliminar por su clase
                var deleteButtons = document.getElementsByClassName("eliminar");

                // Agregar un evento de clic a cada botón de eliminar
                for (var i = 0; i < deleteButtons.length; i++) {
                    deleteButtons[i].addEventListener("click", function() {
                        var id = this.parentNode.parentNode.firstChild.textContent;
                        var confirmacion = confirm("¿Estás seguro de que quieres eliminar el alumno con id " + id + "?");
                        if (confirmacion) {
                            // Make an AJAX request to the server
                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", "eliminar_alumno.php?id=" + id, true);
                            xhr.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    // Update the UI to reflect the deletion
                                    var notification = document.getElementById("notification");
                                    notification.textContent = this.responseText;
                                    notification.style.display = "block";
                                    setTimeout(function() {
                                        notification.style.display = "none";
                                        location.reload(); // Reload the page
                                    }, 2000);
                                }
                            };
                            xhr.send();
                        }
                    });
                }
            </script>
        </form>
    </main>
<div id="notification" style="display: none; position: fixed; bottom: 0; right: 0; background-color: #4CAF50; color: white; padding: 15px;">
</div>
</body>
</html>