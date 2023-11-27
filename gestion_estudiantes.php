<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de alumnos</title>
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
        <h2 class="titulo"><b>Gestión de alumnos</b></h2>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
    </header>
    <!-- FORMULARIO -->
    <main class="formulario">
        <form id="myForm"  method="post" onsubmit="return validateForm()">
            <a href="Menu.html" id="back-button">Regresar</a>
            <a href="Registrar_Alumno.php" id="new-button" class="boton">Nuevo</a>



            <table id="example" class="display nowrap" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011-04-25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011-07-25</td>
                <td>$170,750</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009-01-12</td>
                <td>$86,000</td>
        </tfoot>
    </table>

            <script>
                $(document).ready(function() {
                    $('#example').DataTable( {
                        dom: 'Bfrtip', // Define where the buttons should appear
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                        ,"scrollX": true
                    } );
                } );
                

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
