<?php

include('../../../conexao/conecta.php');
include("function.php");

if(isset($_POST["user_id"]))
{
	$image = get_image_name($_POST["user_id"]);
	if($image != '')
	{
		unlink("upload/" . $image);
	}
	$statement = $conexao->prepare("DELETE FROM tb_cursos WHERE cursos_id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["user_id"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Dados do curso apagado com sucesso';
	}
}

?>