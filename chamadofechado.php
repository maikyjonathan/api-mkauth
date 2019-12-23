<?php 
	require_once ("logica.php"); 
	require_once ("banco.php");

	chaveAPI($_GET['api']); 

	if ($_GET['mes'] === ''){
		$dmes = date('m');
	} else {
		$dmes = $_GET['mes'];
	}

	if ($_GET['ano'] === ''){
		$dano = date('Y');
	} else {
		$dano = $_GET['ano'];
	}

	$reladorioMes = chamado($conexao, $dmes, $dano);

	echo json_encode($reladorioMes);
?>