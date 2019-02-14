<?php

/**
  * Classe Banco
  * Autor: Plínio Araújo
  */
	class Conexao{
		
		function executaSQL($sql) {
		
			
			$dsn = 'mysql:dbname=eliteSoft;host=localhost:3307';
			$user = 'root';
			$pass = 'usbw';			

			try{
	        	$con = new PDO($dsn, $user, $pass);
	        	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        	$res = $con->query($sql);
	        	return $res;
	    	}catch(PDOException $e){
		        echo 'ERROR: ' . $e->getMessage();
	    	}
		
		}
	}



  ?>