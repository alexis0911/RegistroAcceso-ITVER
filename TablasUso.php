<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Centro de Información ITVER</title>
    <link rel="icon" href="https://ci.veracruz.tecnm.mx/img/favicon/tecnm.ico">
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
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css" />
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
    <!-- Slider -->
    <header>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
        <h2 class="titulo"><b>Historial uso salones</b></h2>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
    </header>
    <!-- FORMULARIO -->
    <main class="formulario">
        <form id="myForm"  method="post" onsubmit="return validateForm()">
            <a class="boton" href="Menu_administrador.php" id="back-button">Regresar</a>

            <?php
            // Conectar a la base de datos
            $mysqli = new mysqli('localhost', 'root', 'admin', 'registro');

            if ($mysqli->connect_error) {
              die('Error de Conexión (' . $mysqli->connect_errno . ') '
                  . $mysqli->connect_error);
            }

            // Consultar la base de datos
            $result = $mysqli->query("
                SELECT uso.idUso, alumno.nControl, salon.identificador, usuarios.nombreUsuario, uso.dia, uso.horaEntrada 
                FROM uso 
                INNER JOIN alumno ON uso.Alumno_idAlumno = alumno.idAlumno
                INNER JOIN salon ON uso.Salon_idSalon = salon.idSalon
                INNER JOIN usuarios ON uso.Usuario_idUsuario = usuarios.idUsuario
            ");

            // Comprobar si la consulta fue exitosa
            if(!$result) {
              die("Error en la consulta: " . $mysqli->error);
            }

            // Construir la tabla
            echo '<table id="example" class="display nowrap" style="width:100%">';
            echo '<thead>
                <tr>
                  <th>ID Uso</th>
                  <th>Número de Control</th>
                  <th>Identificador de Salón</th>
                  <th>Nombre de Usuario</th>
                  <th>Dia</th>
                  <th>Hora Entrada</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>';

            // Iterar sobre los resultados y añadirlos a la tabla
            while($row = $result->fetch_assoc()) {
              echo '<tr>
                  <td>' . $row['idUso'] . '</td>
                  <td>' . $row['nControl'] . '</td>
                  <td>' . $row['identificador'] . '</td>
                  <td>' . $row['nombreUsuario'] . '</td>
                  <td>' . $row['dia'] . '</td>
                  <td>' . $row['horaEntrada'] . '</td>
                  <td>
                    <button type="button" data-id="' . $row['idUso'] . '" class="btn btn-sm btn-danger eliminar"><i class="fa-solid fa-trash-can"></i></button>
                    <a href="editaruso.php?id=' . $row['idUso'] . '" class="btn btn-sm btn-primary"><i class="fa-solid fa-pencil"></i></a>
                  </td>
                  </tr>';
            }

            echo '</tbody></table>';

            // Cerrar la conexión a la base de datos
            $mysqli->close();
            ?>

            <script>
                $(document).ready(function() {
                  $('#example').DataTable( {
                    dom: 'Bfrtip', // Define where the buttons should appear
                    buttons: [
                      'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    "scrollX": true,

                    language: {
                      url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                    }
                  } );
                });
                

$(document).on('click', '.edit-button', function(event) {
  event.preventDefault();
  var id = $(this).data('id');
  $.ajax({
    url: 'editar.php',
    type: 'POST',
    data: { id: id },
    success: function(response) {
      // Aquí puedes manejar la respuesta del servidor
    }
  });
});

                // Obtener todos los botones de editar por su clase
                var editButtons = document.getElementsByClassName("editar");

                // Agregar un evento de clic a cada botón de editar
                for (var i = 0; i < editButtons.length; i++) {
                    editButtons[i].addEventListener("click", function() {
                        var id = this.parentNode.parentNode.firstChild.textContent;
                        window.location.href = "editar_alumno.php?id=" + id;
                    });
                }
                $(document).on('click', '.eliminar', function() {
                  var row = $(this).closest('tr');
                  var id = $(this).data('id'); // Obtener el ID del alumno del atributo de datos
                  var confirmacion = confirm("¿Estás seguro de que quieres eliminar el alumno con id " + id + "?");
                  if (confirmacion) {
                    $.ajax({
                      url: "eliminar_alumno.php",
                      type: "GET",
                      data: { id: id },
                      success: function(response) {
                        var notification = $("#notification");
                        notification.text(response);
                        notification.show();
                        setTimeout(function() {
                          notification.hide();
                          row.remove(); // Remove the row from the table
                        }, 2000);
                      }
                    });
                  }
                });
            </script>
        </form>
    </main>
<div id="notification" style="display: none; position: fixed; bottom: 0; right: 0; background-color: #4CAF50; color: white; padding: 15px;">

</div>

</body>
</html>
