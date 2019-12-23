<?php 
	require_once ("logica.php"); 
	require_once ("banco.php");

	chaveAPI($_GET['api']); 

	if ($_GET['dia'] === ''){
		$ddia = date('d');
	} else {
		$ddia = $_GET['dia'];
	}

	if ($_GET['mes'] === ''){
		$dmes = date('m');
	} else {
		$dmes = $_GET['mes'];
	}

	if ($_GET['ano'] === ''){
		$dano = date('y');
	} else {
		$dano = $_GET['ano'];
	}

	$reladorioMes = chamadodia($conexao, $ddia, $dmes, $dano);

	echo json_encode($reladorioMes);

?>