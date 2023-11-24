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