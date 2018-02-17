<head>
	<?php include("includes/header.php");?>
	
	<body>
	
		<?php include "includes/bloquea_botao_direito.php"; ?>      	
	
		<?php include("includes/topo.php");?>		
		
		<?php include("funcoes/funcao.php");?>
		
		<?php include("funcoes/funcao_pagina_admin.php"); ?>

		<?php include("includes/menu_lateral_esquerdo.php");?>

		<?php include("includes/menu_lateral_direito.php");?>

		<?php
			if(isset($_GET['acao'])):
				
				$acao = $_GET['acao'];
				
				switch($acao): 
				
					case 'welcome': 						
						include("pages/inicio.php");						
					break; 
					
					case 'turmas-alunos': 
						include("pages/turmas-alunos.php"); 
					break;
					
					case 'admin': 
						include("pages/admin.php"); 
					break;
					
					case 'financeiro': 
						include("pages/financeiro.php"); 
					break;
					
					
					case 'crud-alunos': 
						include("pages/crud_alunos.php");
					break;
					
					
					
					case 'pendentes': 
						include("pages/pg-admin/index.php");
					break;	
					
					case 'crud-turma': 
						include("pages/crud-curso/index.php");
					break;
					
					case 'crud-login': 
						include("pages/crud-login/index.php");
					break;
					
					case 'pg-curso': 
						include("pages/crud-pg-curso/index.php");
					break;	
					
					case 'crud-cursos': 
						include("pages/crud_cursos.php");
					break;
					
					case 'editar-login': 
						include("pages/editar-login.php");
					break;
					
					case 'editar-login-aluno': 
						include("pages/editar-login-aluno.php");
					break;
					
					case 'editar-cursos': 
						include("pages/editar-curso.php");
					break;
					
					case 'cad-novo-curso': 
						include("pages/cad-novo-curso.php");
					break;
					
					case 'pre-cadastro': 
						include("pages/pre-cadastro.php");
					break;
					
					case 'update-dados-pessoais': 
						include("pages/update-dados-pessoais.php");
					break;
					
					case 'update-dados-cadastrais': 
						include("pages/update-dados-cadastrais.php");
					break;
					
					case 'update-dados-academicos': 
						include("pages/update-dados-academicos.php");
					break;
					
					case 'inscricao': 
						include("pages/inscricao_curso.php");
					break;
					
					case 'meus-cursos': 
						include("pages/meus_cursos.php");
					break;	
					
					default:
						include ("pages/404.php");
					break;
				
				endswitch;
				
			endif;

		?>
		<?php include("includes/footer.php");?>
	</body>
</html>


