<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);

ini_set('error_log', dirname(_FILE_) . '/error_log.txt');
error_reporting(E_ALL);


include('../../../conexao/conecta.php');
include('function.php');
$query = '';

@session_start();
@$id_curso = $_SESSION['id_curso'];
$output = array();
$query = "SELECT tb_alunos.aluno_nome,tb_alunos.aluno_cpf, tb_matricula.matricula_id, tb_matricula.data_pg, tb_matricula.data_matricula, tb_matricula.foto, tb_matricula.matricula_status_pg FROM tb_alunos INNER JOIN tb_matricula ON tb_alunos.aluno_id = tb_matricula.matricula_aluno_id and matricula_curso_id = ?";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE aluno_cpf LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR aluno_nome LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY matricula_id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $conexao->prepare($query);
$statement->bindvalue(1,$id_curso); 
$statement->execute();

$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$image = '';
	
	$arquivo = $row["foto"];
	
    $ext = pathinfo($arquivo, PATHINFO_EXTENSION);
	
	if($ext == ''){
		$image = '<img src="pages/crud-pg-curso/upload/no_image.jpg" class="img-thumbnail" width="50" height="35" />';		
	}
	elseif($ext == 'pdf')
	{
		$image = '<a class="fancybox" data-fancybox-type="iframe" href="pages/crud-pg-curso/upload/'.$row["foto"].'" target="_blank"><img src="pages/crud-pg-curso/upload/pdf.png" class="img-thumbnail" width="50" height="35" /></a>';
	}
	else
	{
		$image = '<a class="fancybox" data-fancybox-type="iframe" href="pages/crud-pg-curso/upload/'.$row["foto"].'" target="_blank"><img src="pages/crud-pg-curso/upload/'.$row["foto"].'" class="img-thumbnail" width="50" height="35" /></a>';
	}
	
	
	$statusPG = $row["matricula_status_pg"];
	
	if($statusPG == "PENDENTE")
	{
		$exibeMensagem = "<strong><font color='red'>PENDENTE</font></strong>";
	}
	else{
		$exibeMensagem = "<strong><font color='green'>PAGAMENTO APROVADO</font></strong>";
	}
	
	if($row["data_pg"] == '')
	{
		$mensagemdtPG = "<strong><font color='red'>NÃO PAGO</font></strong>";
	}
	else{
		
		$data_pagamento = $row["data_pg"];
	
	    $dataEndPG = date("d/m/Y",strtotime($data_pagamento)); //converto data padrao americano para o padrao brasileiro
		
		$mensagemdtPG =  $dataEndPG;
	}
	
	//Converto data da matricula e pagamento para padrao brasileiro
	
	$data_matricula = $row['data_matricula'];;
	
	$dataMatriculaOn = date("d/m/Y H:i:s",strtotime($data_matricula)); //converto data padrao americano para o padrao brasileiro
	


	//fim conversao	
		
	$matricula_id = $row["matricula_id"];
	
	$sub_array = array();
	
	$sub_array[] = $image;
	$sub_array[] = $row['aluno_nome'];
	$sub_array[] = $row['aluno_cpf'];
	$sub_array[] = $row['matricula_id'] . '/' . $ano = gmdate("Y");
	$sub_array[] = $dataMatriculaOn;	
    $sub_array[] = $exibeMensagem;
	$sub_array[] = $mensagemdtPG;
	//$sub_array[] =  '<button type="button" name="update" id="'.$matricula_id.'" class="btn btn-warning btn-xs update">Pagamento</button>';
	$sub_array[] = '<a href="#" name="update" id="'.$matricula_id.'" class="  btn-xs update"><i class="material-icons">attach_money</i></button>';
	$sub_array[] = '<a href="#" name="delete" id="'.$matricula_id.'" class="  btn-xs delete"><i class="material-icons">delete</i></button>';
		
	
	$data[] = $sub_array; 	
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);

echo json_encode($output);
//echo json_encode(utf8_encode($output));



?>