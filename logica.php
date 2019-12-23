<?php
header('Content-Type: application/json; charset=utf-8');

function chaveAPI($string){
	if($string !== 'valor') {
		exit;
	}
}

function utf8_converter($array) {
	array_walk_recursive($array, function(&$item, $key){
		if(!mb_detect_encoding($item, 'utf-8', true)){
				$item = utf8_encode($item);
		}
	});
 
	return $array;
}

?>