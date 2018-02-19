<?php

include('../../../conexao/conecta.php');
include("function.php");

$id_matricula_aluno = $_POST["user_id"];
//Recupero id_curso para decrementar no grafico da página INICIAL(welcome)
$query = "SELECT matricula_curso_id from tb_matricula where matricula_id = ?";
$statement = $conexao->prepare($query);
$statement->bindvalue(1,$id_matricula_aluno); 
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
	$id_curso = $row["matricula_curso_id"];
}
//fim recuperação ID


if(isset($_POST["user_id"]))
{
	//IMPORTANTE --> AQUI FAÇO O DECREMENTO NO GRÁFICO
	$select = "SELECT cursos_qt_inscritos from tb_cursos where cursos_id = ?";	
	$result = $conexao->prepare($select);											
	$result->bindvalue(1, $id_curso);
	$result->execute();									
	foreach($result as $exibe):											
		$contar_inscritos_m = $exibe['cursos_qt_inscritos'];										
	endforeach;
	
	
	$sql = 'update tb_cursos set cursos_qt_inscritos = ? where cursos_id = ?';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(1, $contar_inscritos_m = $contar_inscritos_m - 1 );
	$stm->bindValue(2, $id_curso);
	$retorno = $stm->execute();	
	
	//FIM DECREMENTO NO GRÁFICO
		
	
	
	$image = get_image_name($_POST["user_id"]);
	if($image != '')
	{
		unlink("pages/crud-curso/upload/" . $image);
	}
	$statement = $conexao->prepare("DELETE FROM tb_matricula WHERE matricula_id = :id"
	);
	$result = $statement->execute(
		array(
			':id' =>	$_POST["user_id"]
		)
	);
	
	if(!empty($result))
	{
		echo "Dados do curso apagado com sucesso $contar_inscritos_m";
	}
}

?>