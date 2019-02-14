<?php 
	include_once('banco.php');
	/**
  * Classe Pedido
  * Autor: Plínio Araújo
  */

	class Pedido{

		public $id_item;
		public $id_pedido;
		public $id_cliente;
		public $id_produto = array();
		public $total;


		function __construct(){

		}

		function clientePR(){

			$cl = new Cliente();
			$a = $cl->buscaC($this->getId_cliente());

			foreach ($a as $k) {
				$cl->setNome($k['nome']);
				$cl->setUF($k['uf']);
			}

			$uf = $cl->getUF();

			if($uf == 'PR'){
				$x = $this->total;
				$x = ($x * 10 )/100;
				$y = $this->total - $x;
				return setTotal($y);
			}			

		}

		function criar(){
			try{
				$sql = "insert into pedido (id_pedido,id_cliente,id_produto) 
						values (".$this->id_pedido.",".$this->id_cliente.",".$this->id_produto.");";
				$bd = new Banco();
				return $bd->executaSQL($sql);
				unset($bd);

			} catch (Exception $e){
				print $e;
			}
		}

		function atualizar($id_){
			try{
				$sql = "update pedido ############## where id_pedido = ".$this->id_pedido.";";
				$bd = new Banco();
				return $bd->executaSQL($sql);

				unset($bd);
			} catch (Exception $e){
				print $e;
			}

		}

		function buscar(){
			try {
				$sql = "selec * from pedido;";

				$bd = new Banco();
				return $bd->executaSQL($sql);
				usnet($bd);

			} catch (Exception $e){
				print $e;
			}
		}

		function buscarP($id_){
			try{
				$sql = "select * from pedido where id_pedido = ".$this->id_pedido." ;";

				$bd = new Banco();
				return $bd->executaSQL($sql);

				unset($bd);

			} catch (Exception $e){
				print $e;
			}
		}

		function excluir(){
			try{
				$sql = "delete from pedido where id_pedido = ".$this->id_pedido.";";
				$bd = new Banco();
				return $bd->executaSQL($sql);
				unset($bd);
			} catch (Exception $e){
				print $e;
			}

		}

		function getId_pedido(){
			return $this->id_pedido;
		}

		function getId_item(){
			return $this->id_item;
		}

		function getId_cliente(){
			return $this->id_cliente;
		}

		function getId_produto(){
			return $this->id_produto;
		}

		function getTotal(){
			return $this->total;
		}

		function setId_pedido($id_pedido){
			$this->id_pedido = $id_pedido;
		}

		function setId_cliente($id_cliente){
			$this->id_cliente = $id_cliente;
		}

		function setId_produto($id_produto){
			$this->id_produto = $id_produto;
		}

		function setTotal($total){			
			$this->total = $total;
		}

		function setId_item($id_item){
			$this->id_item = $id_item;
		}



		

	
	}



 ?>