<!DOCTYPE html>
<html">
<head>
  <title>Cadastro Clientee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
  <?php
    include_once('../model/cliente.php');

        $msg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';

      if ($msg == 1) {
        echo "<script> alert('Falha ao cadastrar Cliente!')</script>";
      }elseif ($msg == 2){
        echo "<script> alert('Cliente Cadastrado com sucesso!')</script>";
      }elseif ($msg == 3) {
        echo "<script> alert('Usuario atualizado com sucesso!')</script>";
      }elseif ($msg == 4) {
        echo "<script> alert('Usuario Excluido com sucesso!')</script>";
      }
  ?>

<div class="container">

  <h2>Cadastro Cliente</h2>
  
  <form class="form-group col-lg-12 " action="../control/cadCliente.php" method="post">
    <div class="form-group col-lg-6 " >
      <input type="number" name="id_cliente" id="id_cliente" hidden>
      <label  for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    <div class="form-group col-lg-6">
      <label for="UF">Estado</label>
      <select required name="UF" id="uf" class="form-control ">  
        <option value="" disabled selected>Selecione....</option>
        <option value="PR">PR</option>
        <option value="RJ">RJ</option>
        <option value="SP">SP</option>
        <option value="RS">RS</option>
      </select>      
    </div>    
    <button type="submit" class="btn btn-success">Salvar</button>
    <button type="reset" class="btn btn-default">Limpar</button>
    <button type="submit" name="excluir" value="exclur" class="btn btn-danger">Excluir</button>
    
  </form>

  <br><br><br><br><br><br><br><br><br><br><br>
  <h2>Clientes Cadastrados</h2>
  <h5>Clique para editar.</h5>
  <table class="table" >
    <th>ID</th>
    <th>Nome</th>
    <th>UF</th>

    <tr onclick='javascript:getValue(this)'>
      <?php
        $cl = new Cliente();
        $x = $cl->buscar();

        foreach ($x as $k ) {
          echo "<tr onclick='javascript:getValue(this)'>";
          echo "<td>".$k['id_cliente']."</td>";
          echo "<td>".$k['nome']."</td>";
          echo "<td>".$k['uf']."</td></tr>";
        }

       ?>
    

  </table>
</div>


<script>
  
  function getValue(obj){
    document.querySelector("[name='id_cliente']").value   = obj.getElementsByTagName("td")[0].innerHTML;
    document.querySelector("[name='nome']").value         = obj.getElementsByTagName("td")[1].innerHTML;
    document.querySelector("[name='UF']").value           = obj.getElementsByTagName("td")[2].innerHTML;
  }


</script>


</body>
</html>
