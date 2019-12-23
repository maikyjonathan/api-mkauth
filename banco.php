<?php
require_once ("conectar.php");

date_default_timezone_set('America/Sao_Paulo');

// QUANTOS CHAMADOS FECHADO NO MOMENTO.
function chamadodia($conexao, $dia, $dmes, $dano) {
	$data = '%' . $dano . '-' . $dmes . '-'. $dia .'%';
	$query = "select COUNT(*) from vtab_suportes where fechamento like '{$data}' and status='fechado' and cli_ativado = 's'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);
}

// QUANTOS CHAMADOS SAO FECHADO NO MES SEPARADO.
function chamado($conexao, $dmes, $dano) {
	$data = '%' . $dano .'-' . $dmes . '%';
	$query = "select COUNT(*) from sis_suporte where fechamento like '{$data}' and status='fechado'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);
}

// QUANTOS CHAMADOS SAO FECHADO MES.
function chamadodate($conexao, $dataM) {
	$data = '%' . $dataM . '%';
	$query = "select COUNT(*) from sis_suporte where fechamento like '{$data}' and status='fechado'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);
}

// QUANTOS CHAMADOS SAO ABERTO NO MOMENTO.
function chamadoaberto($conexao) {
	$query = "select COUNT(*) from vtab_suportes where status='aberto' and cli_ativado = 's'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);
}

// QUANTAS INSTALAÇÃO SAO FEITA NO MES SEPARADO.
function instalacao($conexao, $dmes, $dano) {
	$data = '%' . $dmes .'/' . $dano . '%';
	$data2 = '%' . $dano .'-' . $dmes . '%';
	$query = "select COUNT(*) from sis_solic where datainst like '{$data}' or datainst like '{$data2}' and status  = 'concluido' and instalado = 'sim'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);
}

// QUANTAS INSTALAÇÃO SAO FEITA NO MES.
function instalacaodate($conexao,$dmes, $dano) {
	$data = '%' . $dmes .'/' . $dano . '%';
	$data2 = '%' . $dano .'-' . $dmes . '%';
	$query = "select COUNT(*) from sis_solic where datainst like '{$data}' or datainst like '{$data2}' and status  = 'concluido' and instalado = 'sim'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);
}

// QUANTOS DESATIVADO SAO FEITA NO MES SEPARADO.
function desativado($conexao, $dmes, $dano) {
	$data = '%' . $dano .'-' . $dmes . '%';
	$query = "select COUNT(*) from sis_cliente where data_desativacao like '{$data}'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);
}

function desativadodate($conexao, $dataM) {
	$data = '%' . $dataM . '%';
	$query = "select COUNT(*) from sis_cliente where data_desativacao like '{$data}'";;
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);
}

function desativadogrupo($conexao, $dataM, $grupo) {
	$data = '%' . $dataM . '%';
	$query = "select COUNT(*) from sis_cliente where data_desativacao like '{$data}' and grupo = '{$grupo}'";;
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);
}

function instalacaogrupo($conexao, $dataM, $grupo) {
	$data = '%' . $dataM . '%';
	$query = "select COUNT(*) from sis_cliente where data_ins like '{$data}' and grupo = '{$grupo}'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);
}

function chamadogrupo($conexao, $dataM, $grupo) {
	$data = '%' . $dataM . '%';
	$query = "select COUNT(*) from vtab_suportes where fechamento like '{$data}' and status='fechado' and grupo = '{$grupo}'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);
}

function clientegrupo($conexao) {
	$query = "select distinct grupo from sis_cliente";
	$resultado = mysqli_query($conexao, $query);

	$produtos = array();
	while($produto = mysqli_fetch_assoc($resultado)) {
		array_push($produtos, $produto);
   }
   return $produtos;	
}


function clientenota($conexao, $login) {
	$query = "select * from vtab_titulos where login = '{$login}' and status = 'aberto' order by titulo desc";
	$resultado = mysqli_query($conexao, $query);
	$produtos = array();

	while($produto = mysqli_fetch_assoc($resultado)) {
		array_push($produtos, $produto);
   }
   return $produtos;		
}

function clientenotat($conexao, $login, $titulo) {
	$query = "select * from vtab_titulos where login = '{$login}' and titulo = '{$titulo}'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);	
}

function clientenotagrupopago($conexao, $grupo, $vencimento) {
	$query = "select * from vtab_titulos where grupo = '{$grupo}' and datavenc like '%{$vencimento}%' and cli_ativado = 's' and datapag is not null order by titulo desc";
	$resultado = mysqli_query($conexao, $query);
	$produtos = array();

	while($produto = mysqli_fetch_assoc($resultado)) {
		array_push($produtos, $produto);
   }
   return $produtos;
}

function clientenotagrupopagoc($conexao, $grupo, $vencimento) {
	$query = "select COUNT(*) from vtab_titulos where grupo = '{$grupo}' and datavenc like '%{$vencimento}%' and cli_ativado = 's' and datapag is not null";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);	
}

function clientenotagrupoaberto($conexao, $grupo, $vencimento) {
	$query = "select * from vtab_titulos where grupo = '{$grupo}' and datavenc like '%{$vencimento}%' and cli_ativado = 's' and datapag is null order by titulo desc";
	$resultado = mysqli_query($conexao, $query);
	$produtos = array();

	while($produto = mysqli_fetch_assoc($resultado)) {
		array_push($produtos, $produto);
   }
   return $produtos;		
}

function clientenotagrupoabertoc($conexao, $grupo, $vencimento) {
	$query = "select COUNT(*) from vtab_titulos where grupo = '{$grupo}' and datavenc like '%{$vencimento}%' and cli_ativado = 's' and datapag is null";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);	
}


function clientenotagrupotodos($conexao, $grupo, $vencimento) {
	$query = "select * from vtab_titulos where grupo = '{$grupo}' and datavenc like '%{$vencimento}%' and cli_ativado = 's' order by titulo desc";
	$resultado = mysqli_query($conexao, $query);
	$produtos = array();

	while($produto = mysqli_fetch_assoc($resultado)) {
		array_push($produtos, $produto);
   }
   return $produtos;		
}

function clientenotagrupotodosc($conexao, $grupo, $vencimento) {
	$query = "select COUNT(*) from vtab_titulos where grupo = '{$grupo}' and datavenc like '%{$vencimento}%' and cli_ativado = 's'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);	
}

function clientenotagrupocli($conexao, $grupo, $login, $vencimento) {
	$query = "select * from vtab_titulos where grupo = '{$grupo}' and login = '{$login}' and datavenc like '%{$vencimento}%' and cli_ativado = 's'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);			
}

function somagrupo($conexao, $grupo, $vencimento) {
	$query = "select sum(valor) from vtab_titulos where grupo = '{$grupo}' and datavenc like '%{$vencimento}%' and cli_ativado = 's'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);			
}

function totalgrupo($conexao, $grupo) {
	$query = "select COUNT(*) from sis_cliente where grupo = '{$grupo}' and cli_ativado = 's' and isento = 'nao'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);			
}

function totalgrupois($conexao, $grupo) {
	$query = "select COUNT(*) from sis_cliente where grupo = '{$grupo}' and cli_ativado = 's' and isento = 'sim'";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);			
}

function totalgrupoc($conexao, $grupo) {
	$query = "select * from sis_cliente where grupo = '{$grupo}' and cli_ativado = 's' and isento = 'nao' and data_desativacao IS NULL";
	$resultado = mysqli_query($conexao, $query);
	$produtos = array();

	while($produto = mysqli_fetch_assoc($resultado)) {
		array_push($produtos, $produto);
   }
   return $produtos;			
}

function totallogin($conexao, $login) {
	$query = "select * from vtab_titulos where login = '{$login}' order by titulo desc limit 1";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);			
}

function buscatitulo($conexao, $titulo) {
	$query = "select * from vtab_titulos where titulo = '{$titulo}'";
	$resultado = mysqli_query($conexao, $query);
	$produtos = array();

	while($produto = mysqli_fetch_assoc($resultado)) {
		array_push($produtos, $produto);
   	}
   	return $produtos;		
}

function buscaisentos($conexao, $grupo) {
	$query = "select * from sis_cliente where grupo = '{$grupo}' and isento = 'sim' and data_desativacao IS NULL and cli_ativado = 's'";
	$resultado = mysqli_query($conexao, $query);
	$produtos = array();

	while($produto = mysqli_fetch_assoc($resultado)) {
		array_push($produtos, $produto);
   	}
   	return $produtos;		
}

// BUSCA CLIENTE VIA CODIGO
function buscacliente($conexao, $codigo) {
	$query = "select * from sis_cliente where codigo = '{$codigo}' limit 1";
	$resultado = mysqli_query($conexao, $query);
	return mysqli_fetch_assoc($resultado);
}

?>