<?php
require_once"conexao.php";
$sql = "SELECT * FROM contas";
$resultadoSql = $conexao->query($sql);
$vetorTodosRegistros = $resultadoSql->fetch_all(MYSQLI_ASSOC);

?>
<!--Inicio codigo do campo pesquisar-->
<?php
if (isset($_POST['pesquisar'])) {
  $tipo = $_POST['selecionar'];

 $pesquisar = $_POST['pesquisar'];
 $pesquisarLike = "%".$pesquisar."%";
 $sql = "SELECT * FROM contas where " . $tipo ."  like ? order by mes DESC";
 $sqlprep = $conexao->prepare($sql);
 $sqlprep->bind_param("s",$pesquisarLike);
 $sqlprep->execute();
 $resultadoSql = $sqlprep->get_result();
}else{
  $pesquisar = "";
  $sql = "SELECT * FROM contas order by ano,mes desc";
  $resultadoSql = $conexao->query($sql);
}
$vetorTodosRegistros = $resultadoSql->fetch_all(MYSQLI_ASSOC);

?>

 <?php require_once"Cabecalho.php";  ?>
  
        <form method="post" action="ListarContas.php"class="form-inline text-right">
          <div class="form-group">
            <label for="pesquisar">Pesquisar por nome :</label><hr>
            <select name="selecionar" id="selecionar">
              <option value="">Selecione </option>
              <option value="descricao">Descrição</option>
              <option value="mes">Mês</option>
              <option value="ano">Ano</option>
            </select>
            <input type="text" name="pesquisar" id="pesquisar" class="form-control" value="<?=$pesquisar;?>">
            <button type="submit" class="bnt bnt-default">Pesquisa</button>
          </div>
        </form>
    	<h2>Contas</h2>	
        		<table class="table table-dark">
          <thead>
            <tr>
              <th scope="col">Boleto</th>
              <th scope="col">ID</th>
              <th scope="col">Descrição</th>
              <th scope="col">Valor</th>
              <th scope="col">Mês</th>
              <th scope="col">Ano</th>
              <th scope="col">Editar</th>
              <th scope="col">Excluir</th>
            </tr>
          </thead>      
         
          <tbody>
      <?php foreach ($vetorTodosRegistros as$value) {?>
            <tr>
              <td><img style="width: 40px; height: 50px" src="<?=$value["foto"];?>" class="img-responsive"></td>
              <td><?=$value["id"];?></td>
              <td><?=$value["descricao"];?></td>
              <td><?=$value["valor"];?></td>
              <td><?=$value["mes"];?></td>
              <td><?=$value["ano"];?></td>
              <td>
                <form method="post" action="FormConta.php">
                  <input type="hidden"  name="id" value="<?=$value['id'];?>">
                  <button type="submit" class="btn btn-success">Editar</button>
                </form>
              </td>
              <td>
                 <form method="post" name="myForm"  action="ExcluirConta.php" onsubmit="return   confirm('Você tem certeza que quer excluir essa conta?')">
                  <input type="hidden" name="id" value="<?=$value['id'];?>">
                  <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
              </td>
              <?php };?>
            </tr>
           
          </tbody>
     </div> 
      </table> 
</body>

      <script type="text/javascript">
       function myFunction(){
      ;
     
       }
      </script>
</html>