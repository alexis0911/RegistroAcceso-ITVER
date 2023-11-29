<?php
	session_start();
	$_SESSION["ubicado"]="../../";
    require_once($_SESSION["ubicado"]."Clases/Calumno.php");
    $alumno = new Calumno();
    $alumno->selselectByIdec($_GET['id']);
    $alumno->delete();
?>