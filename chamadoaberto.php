<?php 
	require_once ("logica.php"); 
	require_once ("banco.php");

	chaveAPI($_GET['api']); 

	$reladorioMes = chamadoaberto($conexao);

	echo json_encode($reladorioMes);
?>