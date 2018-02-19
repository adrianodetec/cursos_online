<?php

//header("Content-Type: text/html; charset=ISO-8859-1", true);

session_start();

if(!isset($_SESSION['usuario']) and !isset($_SESSION['userSessao'])):	
	header("Location: ../index.php");exit;
endif;

	include("../conexao/conecta.php");	
	
	include "includes/verifica_session_ociosa.php"; //AQUI VERIFICO SESSION OCIOSA, CASO EXISTA DESLOGA O USUÁRIO DA PÁGINA E MATA AS SESSION
	
	include("includes/logout.php"); //destruo a sessão do usuário logado
	
	$usuarioLogado = $_SESSION['usuario'];		
	
        // seleciona a usuario logado
	$selecionaLogado = "SELECT * from tb_login WHERE login_cpf = ?";
	try{
		$result = $conexao->prepare($selecionaLogado);	
		$result->bindParam(1,$usuarioLogado, PDO::PARAM_STR);	
			
		$result->execute();
		$contar = $result->rowCount(); 	
		
		if($contar):
			$loop = $result->fetchAll();
			foreach ($loop as $show):
				$idLogado          = $show['login_id'];
				$nomeLogado        = $show['login_nome'];
				$cpfLogado         = $show['login_cpf'];					
				$emailLogado       = $show['login_email'];
				$senhaLogado       = $show['login_senha'];
				$nivelLogado       = $show['login_nivel'];
				$dataacessoLogado  = $show['login_data_inicial'];
				$datasaidaLogado   = $show['login_data_final'];
			endforeach;
		endif;
		
		}catch (PDOWException $erro){ echo $erro;}
	
?>

<!DOCTYPE html>
<html lang="pt">
<head>

    <style type="text/css">
        .converte_maiuscula
        {
            text-transform: uppercase;
        }
    </style>

   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>.: EMERJ - DETEC :.</title>
    
	
	<!-- css em comum para todas as páginas -->
	<link rel="icon" href="../favicon.ico" type="image/x-icon"><!-- Favicon -->    
	<link href="../css/font/font_oficial_site.css" rel="stylesheet"><!-- Fonts -->	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css"><!-- icones site -->	
	<link href="../css/logo_imagem.css" rel="stylesheet" />
	<link href="../plugins/node-waves/waves.css" rel="stylesheet" /><!-- Waves Effect Css -->
	<link href="../plugins/animate-css/animate.css" rel="stylesheet" /><!-- Animation Css OK -->		   
	<link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet"> <!-- Bootstrap Core Css OK-->
	<link href="../css/style.css" rel="stylesheet"><!-- Custom Css OK-->
	<link href="../css/themes/all-themes.css" rel="stylesheet" />
	<link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet"><!-- JQuery DataTable Css -->
	   <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
	



    <?php
    if(isset($_GET['acao']))
    {
    $acao = $_GET['acao'];
	
    if($acao=='inscricao' || $acao=='crud-turma' || $acao == 'pg-curso' || $acao == 'welcome' || $acao == 'pre-cadastro' || $acao == 'meus-cursos')
    {
    ?>  		
			
		<link rel="stylesheet" href="../dist/css/lightbox.min.css">
		<script src="../dist/js/lightbox-plus-jquery.min.js"></script>       

		<script type="text/javascript" src="../fancybox/jquery-lib.js"></script>
		<link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
        <script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js"></script>
		
	
    <?php	
	}} ?>
		
		
	



</head>
