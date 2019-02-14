<?php

	session_start();
	include_once("../model/pedido.php");
	include_once("../model/cliente.php");
	/**
  * Control Pedido
  * Autor: Plínio Araújo
  */
	

	if(isset($_SESSION['itensCarrinho']) && $_SESSION['cliente']){
		echo "Sessao Cliente <br>";
		var_dump($_SESSION['cliente']);
		echo "<hr><br>";
		echo "Sessao Carrinho <br>";
		var_dump($_SESSION['itensCarrinho']);
		echo "<hr><br>";
		$pedido = new Pedido();
		$cliente = new Cliente();

		$cl = $_SESSION['cliente'];		
		
		$cliente->setId($cl[0]);
		$cliente->setNome($cl[1]);
		$cliente->setUF($cl[2]);
			
		$pedido->setId_cliente($cliente->getId());

		echo "<hr><br>";
		echo "Obj Cliente <br>";
		var_dump($cliente);		
		echo "<hr><br>";


		$itens = $_SESSION['itensCarrinho'];
		$x = 0;

		foreach ($itens as $key => $item) {
			echo "ID:".$item[0]." - Nome: ".$item[1]." Qtd ".$item[2]." Valor Total: ".$item[4];
			$prod[$x] = $item[0];
			$pedido->setTotal($item[4]);
			$x++;
		}
		$pedido->setId_produto($prod);
		echo "<hr><br>";
		echo "Obj Pedido <br>";
		var_dump($prod);
		echo "<br>";		
		var_dump($pedido);
		echo "<hr><br>";
		
	}else{
		$msg = 3;
		header("Location: ../view/pedido.php?msg=".$msg);
		exit();
	}





 ?>