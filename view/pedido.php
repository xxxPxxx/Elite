<!DOCTYPE html>
<html>
<head>
  <title>Pedidos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="../control/ajax.js"></script>
  <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
  <?php
    include_once('../model/produto.php');
    include_once('../model/cliente.php');
        

        $msg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';
        $id_cliente = isset($_REQUEST['id_cliente']) ? $_REQUEST['id_cliente'] : 0;


        if($id_cliente !=0){
          $cliente = new Cliente();
          $x = $cliente->buscaCl($id_cliente);
          foreach ($x as $k){
            $cliente->setId($k['id_cliente']);
            $cliente->setNome($k['nome']);
            $cliente->setUF($k['uf']);
          }

        }

      if ($msg == 1) {
        echo "<script> alert('Falha ao cadastrar Produto!')</script>";
      }elseif ($msg == 2){
        echo "<script> alert('Produto Cadastrado com sucesso!')</script>";
      }elseif ($msg == 3) {
        echo "<script> alert('Produto atualizado com sucesso!')</script>";
      }elseif ($msg == 4) {
        echo "<script> alert('Produto Excluido com sucesso!')</script>";
      }
  ?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="pedido.php">Pedidos</a></li>
        <li><a href="cadCliente.php">Cadastro Cliente</a></li>
        <li><a href="cadProduto.php">Cadastro Produto</a></li>
        <li><a href="#">Relatórios</a></li>
      </ul>      
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
    
    </div>
    <div class="col-sm-8 text-left"> 
      <h1 align="center">Criar Pedido</h1>
      <form class="form-group col-lg-12 " action="../control/cadProduto.php" method="post">
       
        <div class="col-lg-10">                    
            <input type="number" name="id_cliente" id="id_cliente" hidden <?php if (isset($cliente)) {echo "value='".$cliente->getId()."'";}?>>
            <label>Cliente:</label>
            <input type="text" name="nome" id="nome" disabled  <?php if (isset($cliente)) {echo "value='".$cliente->getNome()."'";}?>>

            <label>UF:</label>
            <input type="text" name="uf" id="uf" disabled  <?php if (isset($cliente)) {echo "value='".$cliente->getUF()."'";}?>>          
        </div>
        <div class="col-lg-2">
          <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Clientes</button>          
        </div>
        

        <div class="col-lg-12">
          <hr>
          <br>
          <h4 class="col-lg-10"><b>Pedido</b></h4>
          <div class="col-lg-2">
            <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal1">Produtos</button>
            
          </div>
          <br>

        </div>
        <div class="col-lg-12">
          <table class="table table-hover table-bordered" id="pedido">
            
          </table>          
        </div>
        <div id="teste">
          
        </div>
        <div class="col-lg-12">
          <hr>
          <h5 align="right">Total: </h5>
          <h5 align="right">Desconto: 0.00 </h5>
          <h5 align="right">Valor Total:</h5>
          
        </div>         
        <div class="col-lg-">
          <br>
          <br>
          <br>
          <br>

          <button type="submit" class="btn btn-success">Salvar</button>
          <button type="reset" class="btn btn-default" >Limpar</button>
          <button type="submit" name="excluir" value="exclur" class="btn btn-danger">Excluir</button>    
          <br>
          <br><br>
        </div>

      </form>
        
          <!-- Modal -->
      <div class="modal fade" id="myModal1" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Selecione um produto</h4>
            </div>
            <div class="modal-body">
              <select class="" onchange ="javascript:ajaxGet(this.value);">
                <option value="#" disabled selected>Selecione...</option>
                <?php
                  $pr = new Produto();
                  $x = $pr->buscar();
                  foreach ($x as $registro ) {
                    echo "<option value='".$registro['id_produto']."'>".$registro['nome']." - R$ ".$registro['valor']."</option>";
                  }

               ?>
             </select>
            </div>
            <div class="modal-footer">
              
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
          </div>
          
        </div>
      </div>
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Clientes</h4>
            </div>
            <div class="modal-body">
              <select required id="clientes" name="clientes" class="form-control">
              <option value="" disabled selected> Selecione...</option>
              <?php
                $cl = new Cliente();
                $x = $cl->buscar();
                foreach ($x as $k) {
                  echo "<option value='".$k['id_cliente']."'>".$k['nome']." -- UF: ".$k['uf']."</option>";
                  $clientes[] = array($k['id_cliente'],$k['nome'],$k['uf']);
                }
                
               ?>
            </select>      
            </div>
            <div class="modal-footer">
              <a class="btn btn-info" href="#"  onclick="abreLink();">Buscar</a>
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:id();">Fechar</button>

            </div>
          </div>
          
        </div>
      </div>

    </div>
    <div class="col-sm-2 sidenav">
      
    </div>
  </div>
</div>
<footer class="container-fluid text-center">
  <p>Candidato Plínio Araújo</p>
  <p>E-mail: obrplinio18@gmail.com</p>
  <p>Contato: 9 9803-1955</p>
</footer>

<script>

    function getValue(obj){
      document.querySelector("[name='id_produto']").value   = obj.getElementsByTagName("td")[0].innerHTML;
      document.querySelector("[name='nome']").value         = obj.getElementsByTagName("td")[1].innerHTML;
      document.querySelector("[name='valor']").value        = obj.getElementsByTagName("td")[2].innerHTML;
      document.querySelector("[name='qtd']").value          = obj.getElementsByTagName("td")[2].innerHTML;
    }

    function abreLink(){
      var v1 = document.querySelector("[name='clientes']").value;
      if(v1 ==''){
        alert('Selecione um Cliente!');
      }else{
        location.href = "pedido.php?id_cliente="+v1;
      }
    }    
  

</script>

</body>
</html>
