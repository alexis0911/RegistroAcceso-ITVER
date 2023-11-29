<?php
	session_start();
	$_SESSION["ubicado"]="../../";
    require_once($_SESSION["ubicado"]."Clases/Calumno.php");
    $obj = new Calumno();
    $obj->selselectByIdec($_GET['id']);
    $obj->delete();
?>