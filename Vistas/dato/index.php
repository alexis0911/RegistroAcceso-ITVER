<?php
	session_start();
	$_SESSION["ubicado"]="../../";
    require_once($_SESSION["ubicado"]."Clases/Cuso.php");

    $uso = new Cuso();

    $uso->Alumno_idAlumno=1;
    $uso->Salon_idSalon=1;
    $uso->Usuario_idUsuario=1;
    $uso->dia=Date('Y-m-d');
    $uso->horaEntrada=Date('H-i-s');
    $uso->insert();


    $_SESSION["seleccion"]=isset($_GET["vista"])&&!empty($_GET["vista"])?$_GET["vista"]:'';
	$_SESSION["tituloPagina"]="Pagina Formulario ".$_SESSION["seleccion"];
	$_SESSION["Encabezado"]="Pagina de Formulario ".$_SESSION["seleccion"];
	$_SESSION["footerText"]="Recursos Humanos  | <b>_ _ _ _</b>";
	//require_once $_SESSION["ubicado"]."includes/header.php";
	//require_once $_SESSION["ubicado"]."includes/menumain.php";
	//require_once $_SESSION["seleccion"].".php";
	//require_once $_SESSION["ubicado"]."includes/formafooter.php";
	//require_once $_SESSION["ubicado"]."includes/footer.php";
?>