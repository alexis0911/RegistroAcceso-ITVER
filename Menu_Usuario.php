<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Centro de Información ITVER</title>
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
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            background-color: white;
            border-radius: 10px;

            
            flex-direction: column; /* Ordenar los recuadros en columnas */
            max-height: 360px;
            max-width: none;
            overflow: auto; /* Ocultar los recuadros que sobrepasen el límite */
        }

        li {
            width: 300px; /* Cambiar el ancho a 300px */
            height: 100px;
            margin: 10px;
            background-color: #1B396A;
            border-radius: 10px;
        }

        a {
            color: white;
            text-decoration: none;
            font-size: 20px;
            
            text-align: center; 

            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

    </style>
    <link href="./Centro de Información ITVER_files/styles_formulario.css" rel="stylesheet">
</head>
<body>
    <!-- Slider -->
    <header>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
        <h2 class="titulo"><b>Menú Principal</b></h2>
        <div style="width: 100%; background-color: #1B396A; height: 2vw;"></div>
    </header>
    <!-- MENÚ -->
    <main class="formulario">
        <!-- Lista de opciones -->
        <ul>
            <!-- Cada opción es un enlace a otra página -->
            <li><a href="Registrar.php">Registrar</a></li>
        </ul>

    </main>
</body>
</html>