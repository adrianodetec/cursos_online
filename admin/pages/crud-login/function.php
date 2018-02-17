<?php

function upload_image()
{
	if(isset($_FILES["user_image"]))
	{
		$extension = explode('.', $_FILES['user_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = './upload/' . $new_name;
		move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		return $new_name;
	}
}

function get_image_name($user_id)
{
	include('../../../conexao/conecta.php');
	$statement = $conexao->prepare("SELECT image FROM tb_login WHERE login_id = '$user_id'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["image"];
	}
}

function get_total_all_records()
{
	include('../../../conexao/conecta.php');
	$statement = $conexao->prepare("SELECT * FROM tb_login");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

?>