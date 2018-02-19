<?php
include('../../../conexao/conecta.php');
include('function.php');
if(isset($_POST["operation"]))
{		
	
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
			"UPDATE tb_matricula 
			SET data_pg = :data_pg, matricula_status_pg = :matricula_status_pg, foto = :foto  
			WHERE matricula_id = :id
			"
		);
		$result = $statement->execute(
			array(
				':data_pg'	    =>	$_POST["data_pg"],				
				':matricula_status_pg'	=>	$_POST["matricula_status_pg"],				
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