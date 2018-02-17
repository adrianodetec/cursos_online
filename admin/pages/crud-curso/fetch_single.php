<?php
include('../../../conexao/conecta.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $conexao->prepare(
		"SELECT * FROM tb_cursos 
		WHERE cursos_id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["cursos_nome"]         = $row["cursos_nome"];
		$output["cursos_valor"]        = $row["cursos_valor"];
		$output["cursos_descricao"]    = $row["cursos_descricao"];
		$output["cursos_carg_hr"]      = $row["cursos_carg_hr"];
		$output["cursos_dt_ini"]       = $row['cursos_dt_ini'];
		$output["cursos_dt_ter"]       = $row['cursos_dt_ter'];
		$output["cursos_qt_alunos"]    = $row['cursos_qt_alunos'];
		if($row["foto"] != '')
		{
			$output['user_image'] = '<img src="pages/crud-curso/upload/'.$row["foto"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["foto"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>