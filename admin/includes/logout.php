<?php
if(isset($_GET['acao']))
{
    $acao = $_GET['acao'];
    if($acao=='deslogar'){
		unset($_SESSION['registro']);
		unset($_SESSION['limite']);
		unset($_SESSION['usuario']);
		unset($_SESSION['login_id']);
		unset($_SESSION['userSessao']);
		session_destroy();
		header("Location: ../index.php");
    }
	
	//atualizo data de saida do sistema
	date_default_timezone_set('America/Sao_Paulo'); 								
	$data_saida = date("Y-m-d H:i:s");	
	
	@$login_id = $_SESSION['login_id']; //recupero id usuario logado atravéz de session
	
	//TODA VEZ QUE O USUÁRIO SAIR DO SISTEMA, SUA DATA DE SAÍDA SERÁ ALTERADA.
	$altera = $conexao->prepare("update tb_login set login_data_final = ? where login_id = ?");
	$altera->bindParam(1, $data_saida);
	$altera->bindParam(2, $login_id);
	$altera ->execute();
	//FIM ATUALIZAÇÃO DATA SAÍDA DO SISTEMA.
	
}
?>