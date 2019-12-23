<?php 
	require_once ("logica.php"); 
	require_once ("banco.php");

	chaveAPI($_GET['api']); 

	if ($_GET['codigo'] == ''){
		exit();
	} else {
		$codigo = $_GET['codigo'];
	}

	$reladorioMes = buscacliente($conexao, $codigo);
	$reladorioMes = utf8_converter($reladorioMes);

	echo json_encode($reladorioMes);
?>