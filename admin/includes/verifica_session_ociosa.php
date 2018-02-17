<?php

	if(!isset($_SESSION))
	{	
		session_start(); //inicio a minha session

		if(!isset($_SESSION['usuario']) and !isset($_SESSION['userSessao'])):	
			header("Location: ../index.php");exit;
		endif;	
	}

	if($_SESSION['registro']) //verifico se minha session está ativa, caso estiver...
	{
		$segundos = time() - $_SESSION['registro']; //timer == hora que o participante logou. Subtraio a sessão da hora atual.
	}

	if($segundos > $_SESSION['limite']) //SE O PARTICIPANTE FICAR OCIOSO MAIS DO QUE O TEMPO LIMITE, DESTRUO AS SESSÕES
	{
				
		//TODA VEZ QUE O USUÁRIO SAIR DO SISTEMA, DELETAR SEUS DADOS DA TBL_PARTICIPANTE_ONLINE

			$deletar = $conexao->prepare("DELETE FROM tbl_participante_online WHERE part_online_cpf = ?");
			$deletar->bindParam(1, $_SESSION['usuario']);	
			$deletar ->execute();

		//FIM DELETE DATA SAÍDA DO SISTEMA.		
		
		unset($_SESSION['registro']);
		unset($_SESSION['limite']);
		unset($_SESSION['usuario']);
		unset($_SESSION['login_id']);
		unset($_SESSION['userSessao']);
		session_destroy();
		header("Location: ../index.php");exit;
	}
	else
	{
		$_SESSION['registro'] = $segundos + time(now);
	}


?>