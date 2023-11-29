<?php
session_start();
require_once("Clases/Cusuarios.php");

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    // Redirigir al panel de control o a la página de inicio de sesión exitosa
    if($_SESSION['usuario']==1){
        header("Location: Menu_administrador.php");
    }else{
        header("Location: Menu_Usuario.php");
    }
    exit;
}

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Cusuarios();
    // Verificar si las credenciales son válidas (aquí debes implementar tu lógica de autenticación)
    if ($usuario->selectByLogin($_POST['usuario'],$_POST['contrasena'])) {
        // Iniciar sesión y redirigir al panel de control o a la página de inicio de sesión exitosa
        $_SESSION['usuario'] = $usuario->idUsuario;
        if($usuario->idUsuario==1){
            header("Location: Menu_administrador.php");
        }else{
            header("Location: Menu_Usuario.php");
        }
        exit;
    } else {
        // Mostrar un mensaje de error si las credenciales son incorrectas
        $error = "Credenciales inválidas. Por favor, inténtalo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menú de inicio de sesión</title>
    <link rel="icon" href="https://ci.veracruz.tecnm.mx/img/favicon/tecnm.ico">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/bootstrap.min.css">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/estilos.css">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/fa-svg-with-js.css">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/iconos.css">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/estilo-compresion.min.css">
    <link rel="stylesheet" href="./Centro de Información ITVER_files/jssorStyle.css">
    <link href="./Centro de Información ITVER_files/slick-theme.css" rel="stylesheet">
    <link href="./Centro de Información ITVER_files/slick.css" rel="stylesheet">

    <!-- Agrega aquí los estilos adicionales que necesites -->

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
    </style>
    <link href="./Centro de Información ITVER_files/styles_formulario.css" rel="stylesheet">
</head>
<body>
    <!-- Slider -->
    <header>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
        <h2 class="titulo"><b>Menú de inicio de sesión</b></h2>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
    </header>
    <main class="formulario">
        <form method="POST" action="">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" id="contrasena" class="form-control" required>
            </div>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </form>
    </main>
</body>
</html>