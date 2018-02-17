<?php
include('../../../conexao/conecta.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $conexao->prepare(
		"SELECT * FROM tb_matricula 
		WHERE matricula_id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$id_matricula  = $row["matricula_id"];
		
		$output["data_pg"]   = $row["data_pg"];
		$output["matricula_status_pg"]  = $row["matricula_status_pg"];
		
		
	
		
		if($row["foto"] != '')
		{
			$output['user_image'] = '<a href="pages/crud-pg-curso/upload/'.$row["foto"].'" class="img-thumbnail" width="50" height="35" />clique aqui</a><input type="hidden" name="hidden_user_image" value="'.$row["foto"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
		
		
	}
	echo json_encode($output);
}
?>