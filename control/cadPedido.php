<?php
	
	header('Access-Control-Allow-Origin: *');
	include_once('../model/cliente.php');
	include_once('../model/produto.php');

	$id_produto = isset($_REQUEST['id_produto']) ? $_REQUEST['id_produto'] : 0;
	if($id_produto !=0){
		$pr = new Produto();
		$res = $pr->buscarP($id_produto);

		if ($res) {
			$i = 0;
			foreach ($res as $reg) {
				$als[$i]['id_produto']  = $reg['id_produto'];
				$als[$i]['nome']  = $reg['nome'];
				$als[$i]['valor']  = $reg['valor'];			
				$i++;
			}					
		}
		echo json_encode($als);
		
	}
 ?>