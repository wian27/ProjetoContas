<?php
require_once"conexao.php";  

$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$mes = $_POST['mes'];
$ano =$_POST['ano'];
$foto = $_FILES['foto'];
$id = $_POST['id'];
// Inicio Arquivo de upload

date_default_timezone_set("America/Sao_paulo");
$dataEHora = date('dmYHi');
$nome_arquivo = "fotos/".$dataEHora . $_FILES["foto"]["name"];
$nome_arquivo_tmp = $_FILES["foto"]["tmp_name"];
$msgErroArquivo = "";
if (move_uploaded_file($nome_arquivo_tmp,$nome_arquivo)==false) {
	$msgErroArquivo = "Arquivo de foto não pode ser enviado";
}

// Fim Arquivo de upload

if($id==0){
	
	$sql = "INSERT INTO contas (descricao,valor,mes,ano,foto) values(?,?,?,?,?)";
	$sqlprep = $conexao->prepare($sql);
	$sqlprep->bind_param("sdiis",$descricao,$valor,$mes,$ano,$nome_arquivo);
	$sqlprep->execute();

	$msgOk = "Conta inserida com sucesso";
}else{
	$sql = "UPDATE contas SET descricao=?,valor=?,mes=?,ano=?,foto=? where id=?";
	$sqlprep = $conexao->prepare($sql);
	$sqlprep->bind_param("sdiisi",$descricao,$valor,$mes,$ano,$nome_arquivo,$id);
	$sqlprep->execute();
	$msgOk = "Conta atualizada com sucesso";
}

?>
<?php header("Location:FormConta.php?msgOk=". $msgOk);?> 