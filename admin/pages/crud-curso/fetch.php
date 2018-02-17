
<?php
ini_set('display_errors', 0);
ini_set('log_errors', 2);

ini_set('error_log', dirname(_FILE_) . '/error_log.txt');
error_reporting(E_ALL);


include('../../../conexao/conecta.php');
include('function.php');
//$query = '';
$output = array();
$query = "SELECT * FROM tb_cursos ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE cursos_nome LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR cursos_descricao LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY cursos_id DESC ';
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
	if($row["foto"] != '')
	{
		$image = '<a class="fancybox" href="pages/crud-curso/upload/'.$row["foto"].'"><img src="pages/crud-curso/upload/'.$row["foto"].'" class="img-thumbnail" width="50" height="35" /></a>';
	}
	else
	{
		$image = '';
	}
	
	//Faço query para exibir status inscrição do curso.
	
	date_default_timezone_set('America/Sao_Paulo'); 
								
    $date_atual = date("Y-m-d");
	
	if(strtotime($date_atual) > strtotime($row["cursos_dt_ter"]))
	{
		$mensagem = "Encerrada(s)";
	}
	else
	{
		$mensagem = "Aberta(s)";
	}	
	
	//Pego a minha data atual paa verificação de encerramento de curso. 
	
	$curso_id = $row["cursos_id"];
	
	$select = "SELECT matricula_id FROM tb_matricula where matricula_curso_id = ?";	
	$result = $conexao->prepare($select);
	$result->bindValue(1, $curso_id );													
	$result->execute();													
	$contar = $result->rowCount();
	foreach($result as $linha)
	{
		$id_matricula = $linha["matricula_id"];
	}
	
	
	//Data curso convertida
	
	$data_inicio = $row["cursos_dt_ini"];
	
	$dataOn = date("d/m/Y",strtotime($data_inicio)); //converto data padrao americano para o padrao brasileiro
	
	$data_final = $row["cursos_dt_ter"];
	
	$dataEnd = date("d/m/Y",strtotime($data_final)); //converto data padrao americano para o padrao brasileiro
	
	
	
	
	$sub_array = array();
	
	$sub_array[0] = $image;
	$sub_array[1] = $row["cursos_nome"];
    $sub_array[2] = $mensagem;
	$sub_array[3] = $row["cursos_carg_hr"];
	$sub_array[4] = $dataOn;
	$sub_array[5] = $dataEnd ;
	$sub_array[6] = $row["cursos_qt_alunos"];
	$sub_array[7] = $contar;
	$sub_array[8] =  '<a href="home.php?acao=pg-curso&id='.$curso_id.'"><i class="material-icons">remove_red_eye</i></a>';
	$sub_array[9] =  '<a href="#" name="update" id="'.$curso_id.'" class="  btn-xs update"><i class="material-icons">mode_edit</i></a>';
	$sub_array[10] = '<a href="#" name="delete" id="'.$curso_id.'" class="  btn-xs delete"><i class="material-icons">delete</i></button>';	
	
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

