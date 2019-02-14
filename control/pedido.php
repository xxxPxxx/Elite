<?php

	session_start();
	

	if(isset($_SESSION['itensCarrinho']) && $_SESSION['cliente']){
		var_dump($_SESSION['cliente']);
		var_dump($_SESSION['itensCarrinho']);
		var_dump($_SESSION['vFinal']);
	}else{
		$msg = 3;
		header("Location: ../view/pedido.php?msg=".$msg);
		exit();
	}





 ?>