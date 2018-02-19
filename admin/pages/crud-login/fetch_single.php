<?php
include('../../../conexao/conecta.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $conexao->prepare(
		"SELECT * FROM tb_login 
		WHERE login_id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["login_nome"]   = $row["login_nome"];
		$output["login_nivel"]  = $row["login_nivel"];
		$output["login_cpf"]    = $row["login_cpf"];
		$output["login_email"]  = $row["login_email"];
		$output["login_senha"]  = base64_decode($row['login_senha']);
		if($row["image"] != '')
		{
			$output['user_image'] = '<img src="pages/crud-login/upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>