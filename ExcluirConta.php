<?php

$id = $_POST['id'];
require_once"conexao.php";

$sql = "DELETE FROM contas where id=?";
$sqlprep = $conexao->prepare($sql);
$sqlprep->bind_param("i",$id);
$sqlprep->execute();
 $msgOk = "Conta excluida com sucesso.";

?>
<?php header('Location:ListarContas.php?msgOk='.$msgOk);?>