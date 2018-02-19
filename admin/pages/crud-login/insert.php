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
			INSERT INTO tb_login (login_nome, login_nivel, login_email, login_cpf, login_senha, login_status, image) 
			VALUES (:login_nome, :login_nivel, :login_email, :login_cpf, :login_senha, :login_status, :image)
		");
		$result = $statement->execute(
				
			array(
				':login_nome'	=>	$_POST["login_nome"],
				':login_nivel'	=>	$_POST["login_nivel"],
				':login_email'	=>	$_POST["login_email"],
				':login_cpf'	=>	$_POST["login_cpf"],
				':login_senha'	=>	base64_encode($_POST['login_senha']),				
				':login_status'	=>	$status = 1,
				':image'	    =>	$image
			)
		);
		if(!empty($result))
		{
			echo 'Administrador cadastrado com sucesso';
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
			"UPDATE tb_login 
			SET login_nome = :login_nome, login_nivel = :login_nivel, login_email = :login_email, login_cpf = :login_cpf, login_senha = :login_senha,  image = :image  
			WHERE login_id = :id
			"
		);
		$result = $statement->execute(
			array(
				':login_nome'	=>	$_POST["login_nome"],
				':login_nivel'	=>	$_POST["login_nivel"],
				':login_email'	=>	$_POST["login_email"],
				':login_cpf'	=>	$_POST["login_cpf"],
				':login_senha'	=>	base64_encode($_POST['login_senha']),
				':image'		=>	$image,
				':id'	        =>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Dados de Login atualizados com sucesso!';
		}
	}
}