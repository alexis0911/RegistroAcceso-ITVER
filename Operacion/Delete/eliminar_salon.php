<?php
	session_start();
	$_SESSION["ubicado"]="../../";
    require_once($_SESSION["ubicado"]."Clases/Csalon.php");
    $obj = new Csalon();
    $obj->selselectByIdec($_POST['id']);
    $obj->delete();
?>