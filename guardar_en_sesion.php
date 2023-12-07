<?php
// Iniciar la sesión de PHP
session_start();
echo 'MAS DISTINTIVO';
// Comprobar si los valores de "Ubicacion_idUbicacion" y "salon" están en la solicitud POST
if (isset($_POST['Ubicacion_idUbicacion']) && isset($_POST['salon'])) {
    // Guardar estos valores en la sesión
    $_SESSION['Ubicacion_idUbicacion'] = $_POST['Ubicacion_idUbicacion'];
    $_SESSION['salon'] = $_POST['salon'];
    echo $_SESSION['salon'] . $_POST['salon'];
}
?>