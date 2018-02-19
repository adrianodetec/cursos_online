<?php
include('../../../conexao/conecta.php');
include('function.php');
if(isset($_POST["operation"]))
{
		
	if($_POST["operation"] == "Add")
	{
		
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $conexao->prepare("
			INSERT INTO tb_cursos (cursos_nome, cursos_valor, cursos_carg_hr, cursos_dt_ini, cursos_dt_ter, cursos_qt_alunos, foto) 
			VALUES (:cursos_nome, :cursos_valor, :cursos_carg_hr, :cursos_dt_ini, :cursos_dt_ter, :cursos_qt_alunos, :foto)
		");
		$result = $statement->execute(
				
			array(
				':cursos_nome'	        =>	$_POST["cursos_nome"],
                ':cursos_valor'	        =>	$_POST["cursos_valor"],					
				':cursos_carg_hr'	    =>	$_POST["cursos_carg_hr"],
				':cursos_dt_ini'	    =>	$_POST['cursos_dt_ini'],
				':cursos_dt_ter'	    =>	$_POST['cursos_dt_ter'],
				':cursos_qt_alunos'	    =>	$_POST['cursos_qt_alunos'],
				':foto'	                =>	$image
			)
		);
		if(!empty($result))
		{
			echo 'Novo curso cadastrado com sucesso';
		}
	}
	
	
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $conexao->prepare(
			"UPDATE tb_cursos 
			SET cursos_nome = :cursos_nome, cursos_valor = :cursos_valor, cursos_carg_hr = :cursos_carg_hr, cursos_dt_ini = :cursos_dt_ini, cursos_dt_ter = :cursos_dt_ter, cursos_qt_alunos = :cursos_qt_alunos,  foto = :foto  
			WHERE cursos_id = :id
			"
		);
		$result = $statement->execute(
			array(
				':cursos_nome'	    =>	$_POST["cursos_nome"],
                ':cursos_valor'	    =>	$_POST["cursos_valor"],				
				':cursos_carg_hr'	=>	$_POST["cursos_carg_hr"],
				':cursos_dt_ini'	=>	$_POST['cursos_dt_ini'],
				':cursos_dt_ter'	=>	$_POST['cursos_dt_ter'],
				':cursos_qt_alunos'	=>	$_POST['cursos_qt_alunos'],
				':foto'		        =>	$image,
				':id'	            =>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Dados do curso atualizados com sucesso!';
		}
	}
}

?>