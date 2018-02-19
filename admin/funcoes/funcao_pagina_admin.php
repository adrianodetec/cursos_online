<?php

//Essas funções serão usadas na pagina do admistrador


function retornacursosCadastrados($conexao)
{
	$select = "select cursos_id from tb_cursos";
	$dados = $conexao->prepare($select);	
	$dados->execute();
	$count = $dados->rowCount();
	
	return $count;	
}



function retornaTotalAlunos($conexao)
{
	$select = "select * from tb_login where login_nivel = 0";
	$dados = $conexao->prepare($select);	
	$dados->execute();
	$resultado = $dados->rowCount();
	
	return $resultado;	
}


function retornaTotalAdmin($conexao)
{
	$select = "select * from tb_login where login_nivel = 1";
	$dados = $conexao->prepare($select);	
	$dados->execute();
	$resultado = $dados->rowCount();
	
	return $resultado;	
}

function retornaTotalFinanceiro($conexao)
{
	$select = "select * from tb_login where login_nivel = 2";
	$dados = $conexao->prepare($select);	
	$dados->execute();
	$resultado = $dados->rowCount();
	
	return $resultado;	
}

function retornaTotalLogin($conexao)
{
	$select = "select * from tb_login";
	$dados = $conexao->prepare($select);	
	$dados->execute();
	$resultado = $dados->rowCount();
	
	return $resultado;	
}



?>



