<?php
// Desactivar la caché
header('Cache-Control: no-cache, must-revalidate, max-age=0');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Centro de Información ITVER</title>
    <link rel="icon" href="https://ci.veracruz.tecnm.mx/img/favicon/tecnm.ico">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/bootstrap.min.css">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
        <!-- DataTable -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <!-- Custom CSS -->
        <link rel="stylesheet" href="styles.css" />
  

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

        /* Estilos de la tabla */
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid black;
        }

        th {
            background-color: #1B396A;
            color: black;
        }

        /* Estilos de los botones */
        .boton-agregar, .boton-editar, .boton-eliminar {
            color: white;
            background-color: #1B396A;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .boton-agregar {
            margin-bottom: 20px; 
        }

        /* Estilos del campo de búsqueda */
        .busqueda {
            margin-top: 20px; 
            margin-bottom: 20px; 
        }

        input[type="search"] {
            width: 50%;
            padding: 10px; 
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            /* Agregar estas propiedades */
            background-color: white; /* para que el fondo sea blanco */
            border-radius: 10px; /* para que los bordes sean redondeados */
        }

        th, td {
            padding: 10px;
            border: 1px solid black;
            /* Agregar esta propiedad */
            background-color: transparent; /* para que el fondo sea transparente y se vea el blanco de la tabla */
        }
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
        
        .select,
        #locale {
          width: 100%;
        }
        .like {
          margin-right: 10px;
        }
    </style>
    <link href="./Centro de Información ITVER_files/styles_formulario.css" rel="stylesheet">
</head>
<body>
    <!-- Encabezado -->
    <header>
        <div class="barra"></div> 
        <h2 class="titulo"><b>Gestión de ubicaciones</b></h2>
        <div class="barra"></div>
    </header>

    <!-- Contenido principal -->
    <main class="formulario">
    <form id="myForm"  method="post" onsubmit="return validateForm()">
    <a href="Menu_administrador.php" id="back-button">Regresar</a>
    <a href="Registrar_Alumno.php" id="new-button" class="boton">Nuevo</a>
    <?php

    // Conectar a la base de datos
    $mysqli = new mysqli('localhost', 'root', 'admin', 'registro');
    // Comprobar si la conexión fue exitosa
    if ($mysqli->connect_error) {
        die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }
    // Consultar la base de datos
    $result = $mysqli->query("SELECT idUbicacion, nombreUbicacion, pisos, descripcion FROM ubicacion");
    // Comprobar si la consulta fue exitosa
    if (!$result) {
        die("Error en la consulta: " . $mysqli->error);
    }
    // Construir la tabla
    echo '<table id="example" class="display nowrap" style="width:100%">';
    echo '<thead>
            <tr>
                <th>ID</th>
                <th>Nombre de Ubicación</th>
                <th>Pisos</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>';

    // Iterar sobre los resultados y añadirlos a la tabla
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['idUbicacion'] . '</td>
                <td>' . $row['nombreUbicacion'] . '</td>
                <td>' . $row['pisos'] . '</td>
                <td>' . $row['descripcion'] . '</td>
                <td>
                    <button type="button" data-id="' . $row['idUbicacion'] . '" class="btn btn-sm btn-danger eliminar"><i class="fa-solid fa-trash-can"></i></button>
                    <button type="button" data-id="' . $row['idUbicacion'] . '" class="btn btn-sm btn-primary edit-button"><i class="fa-solid fa-pencil"></i></button>
                </td>
            </tr>';
    }

    echo '</tbody></table>';

    // Cerrar la conexión a la base de datos
    $mysqli->close();
    ?>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                dom: 'Bfrtip', // Define where the buttons should appear
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "scrollX": true,

                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                }
            });
        });

        $(document).on('click', '.edit-button', function (event) {
            event.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: 'editar.php',
                type: 'POST',
                data: { id: id },
                success: function (response) {
                    // Aquí puedes manejar la respuesta del servidor
                }
            });
        });

        // Obtener todos los botones de editar por su clase
        var editButtons = document.getElementsByClassName("editar");

        // Agregar un evento de clic a cada botón de editar
        for (var i = 0; i < editButtons.length; i++) {
            editButtons[i].addEventListener("click", function () {
                var id = this.parentNode.parentNode.firstChild.textContent;
                window.location.href = "editar_alumno.php?id=" + id;
            });
        }

        $(document).on('click', '.eliminar', function () {
            var row = $(this).closest('tr');
            var id = $(this).data('id'); // Obtener el ID de la ubicación del atributo de datos
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Vas a eliminar la ubicación con id " + id,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "eliminar_ubicacion.php",
                        type: "POST",
                        data: { id: id },
                        dataType: "json",
                        success: function (response) {
                            if(response.status == "success"){
                                row.remove(); // Elimina la fila de la tabla
                                table.ajax.reload(); // Recargar la tabla
                                Swal.fire(
                                    'Eliminado!',
                                    'La ubicación ha sido eliminada exitosamente.',
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Hubo un error al eliminar la ubicación.',
                                    'error'
                                )
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire(
                                'Error!',
                                'Hubo un error al realizar la solicitud: ' + textStatus,
                                'error'
                            )
                        }
                    });
                }
            })
        });
    </script>
    </form>
    </main>
    <div id="notification" style="display: none; position: fixed; bottom: 0; right: 0; background-color: #4CAF50; color: white; padding: 15px;">
</body>
</html>
