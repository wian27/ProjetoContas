<?php require_once"conexao.php";?>
<?php
if (isset($_POST['id'])) {
	$id = $_POST['id'];
}else{
	$id = 0;
}

$sql = "SELECT * FROM contas where id=?";
$sqlprep = $conexao->prepare($sql);
$sqlprep->bind_param("i",$id);
$sqlprep->execute();
$sqlResultado = $sqlprep->get_result();
$vetorUmRegistro = $sqlResultado->fetch_assoc();

?>
<?php if (isset($_GET["msgOk"])) { ?>
	<div class="bg-success">
		
		<?php echo "<script>alert('".$_GET["msgOk"]."')</script>";?>
	</div>
<?php } ?>

<?php require_once"Cabecalho.php";  ?>
	
	<h2>Nova Conta</h2>	

	<form  name="myForm" action="SalvarConta.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
				 <label for="id">ID</label>
				 <input value="<?=$vetorUmRegistro['id'];?>" readonly="true" class="form-control" type="number" name="id" id="id" >
				</div>
			</div>	
			<div class="col-md-8">
				<div class="form-group"> 
				 <label for="descrição">Descrição</label>
				 <input value="<?=$vetorUmRegistro['descricao'];?>" class="form-control" type="text" name="descricao" id="descricao"  autofocus="true">
				</div>
			</div>
			<div class="col-md-2">		
				<div class="form-group"> 
				 <label for="valor">Valor</label>
				 <input value="<?=$vetorUmRegistro['valor'];?>" class="form-control" type="number" name="valor" id="valor" >
				</div>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-6">		
				<div class="form-group"> 
				 <label for="mes">Mês</label>
				 <input value="<?=$vetorUmRegistro['mes'];?>" class="form-control" type="number" name="mes" id="mes" >
				</div>
			</div>	
			<div class="col-md-6">	
				<div class="form-group"> 
				 <label for="ano">Ano</label>
				 <input value="<?=$vetorUmRegistro['ano'];?>" class="form-control" type="number" name="ano" id="ano" >
				</div>
			</div>	
		</div>		
			<div class="form-group"> 
			 <label for="foto">Foto Boleto</label>
			 <input value="<?=$vetorUmRegistro['foto'];?>" class="form-control" type="file" name="foto" id="foto" >
			</div> 
			<button type="submit" class="btn btn-success">Enviar</button>
				
	</form>

	</div>

</body>
	<script type="text/javascript">
		function validateForm() {
  var x = document.forms["myForm"]["descricao"].value;
  if (x == "") {
    alert("Campo descrição precisa ser preenchido!");
    return false;
  }
   var x = document.forms["myForm"]["valor"].value;
  if (x == "") {
    alert("Campo valor precisa ser preenchido!");
    return false;
  }
   var x = document.forms["myForm"]["mes"].value;
  if (x == "") {
    alert("Campo mês precisa ser preenchido!");
    return false;
  }
   var x = document.forms["myForm"]["ano"].value;
  if (x == "") {
    alert("Campo ano precisa ser preenchido!");
    return false;
  }
   var x = document.forms["myForm"]["foto"].value;
  if (x == "") {
    alert("É obrigatorio carregar uma foto!");
    return false;
  }
  
}
	</script>
</html>