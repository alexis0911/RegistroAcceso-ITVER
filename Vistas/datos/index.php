<?php
	session_start();
	$_SESSION["ubicado"]="../../";
	if(isset($_GET["vista"])&&!empty($_GET["vista"]))
		$_SESSION["seleccion"]=$_GET["vista"];
	$_SESSION["tituloPagina"]="Pagina Formulario ".$_SESSION["seleccion"];
	$_SESSION["Encabezado"]="Pagina de Formulario ".$_SESSION["seleccion"];
	$_SESSION["footerText"]="Recursos Humanos  | <b>_ _ _ _</b>";
	require_once $_SESSION["ubicado"]."includes/header.php";
	require_once $_SESSION["ubicado"]."includes/menumain.php";
	require_once $_SESSION["seleccion"].".php";
	require_once $_SESSION["ubicado"]."includes/formafooter.php";
	require_once $_SESSION["ubicado"]."includes/footer.php";
?>