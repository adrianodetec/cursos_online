<?php
include('../../../conexao/conecta.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM tb_login ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE login_nome LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR login_cpf LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY login_id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $conexao->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$image = '';
	if($row["image"] != '')
	{
		$image = '<img src="pages/crud-login/upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />';
	}
	else
	{
		$image = '';
	}
	$sub_array = array();
	
	
	$nivel  = $row["login_nivel"];	
	
	if($nivel == 1)
	{
		$nivel = "Admin";
	}
	elseif($nivel == 2)
	{
		$nivel = "Financeiro";
	}
	else
	{
		$nivel = "Aluno";
	}
	
	
	$status = $row["login_status"];
	
	if($status == 1)
	{
		$status = "Ativo";
	}
	else{
		$status = "Desativado";
	}
	
	$sub_array[0] = $image;
	$sub_array[1] = $row["login_nome"];
	$sub_array[2] = $row["login_cpf"];
	$sub_array[3] = $row["login_email"];
	$sub_array[4] = $row["login_senha"];
	$sub_array[5] = $nivel;
	$sub_array[6] = $status;
	$sub_array[7] = '<button type="button" name="update" id="'.$row["login_id"].'" class="btn btn-warning btn-xs update">Atualizar</button>';
	$sub_array[8] = '<button type="button" name="delete" id="'.$row["login_id"].'" class="btn btn-danger btn-xs delete">Deletar</button>';	
	
	$data[] = $sub_array; 	
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>