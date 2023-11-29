<?php
	session_start();
	$_SESSION["ubicado"]="../../";
    require_once($_SESSION["ubicado"]."Clases/Cubicacion.php");
    $obj = new Cubicacion();
    $obj->selselectByIdec($_POST['id']);
    $obj->delete();
?>