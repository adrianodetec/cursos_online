<?php
@ob_start();
@session_start();
if(!isset($_SESSION['usuario'])){
	header("Location: ../index.php?acao=negado");exit;
}
	include("../conexao/conecta.php");
	include("includes/logout.php");
	
	$usuarioLogado = $_SESSION['usuario'];	
	
	//AQUI é o seguinte, verifico se o usuário já prencheu o formulario.. caso não tenha peenchido irei ocultar o menu dele.
	
	$verifica = "SELECT aluno_cpf FROM tb_alunos WHERE aluno_cpf = ?";		
			$analisar = $conexao->prepare($verifica);
            $analisar->bindParam(1, $cpfLogado, PDO::PARAM_STR);			
			$analisar->execute();
			$verifica_preenc_cadastro = $analisar->rowCount();
?>	


 <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
				<div class="user_imagem" div="logomarca"></div>
				
                <div  class="img-circle img-raised img-responsive usuario_logado">
                    <img src="../images/logo.png" width="50" >
                </div>
				
				<div class="info-container">
					<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><strong>Usuario: <span class="converte_maiuscula"><?php echo $nomeLogado ?></span></strong></div>
					<div class="email"><strong>CPF: <span class="converte_maiuscula"><?php echo $cpfLogado ?></span></strong></div>
					<div class="email"><strong>E-mail: <span class="converte_maiuscula"><?php echo $emailLogado ?></span></strong></div>                  
				</div>
				
            </div>            			
            <div class="menu">
			<?php 
				if($verifica_preenc_cadastro == 0 and $nivelLogado == 0){ //aqui verifico se usuário já preencheu o formulário, caso não tenha preenchido não posso exibir menu p/ ele
			?>
                <ul class="list">
                    <li class="header">MENU DE NAVEGAÇÃO - ALUNO</li>
                    <li class="active"></li> 
                    <li>
                        <a href="home.php?acao=deslogar">
                            <i class="material-icons">power_settings_new</i>
                            <span>Deslogar</span>
                        </a>
                    </li>                  
                </ul>
				<?php 
					}elseif($nivelLogado == 0 and $verifica_preenc_cadastro == 1){//Caso o usuário seja aluno e tenha preenchido o formulario, exibir este menu p/ ele		
										
					?>
					<ul class="list">
						<li class="header">MENU DE NAVEGAÇÃO - ALUNO</li>
						<li class="active">
							<a href="home.php?acao=welcome">
								<i class="material-icons">home</i>
								<span>Principal</span>
							</a>
						</li>						
						<li>
                        <a href="javascript:void(0);" class="menu-toggle">
                             <i class="material-icons">create</i>
                            <span>Inscrição cursos</span>
                        </a>
                        <ul class="ml-menu">
							<li>
								<a href="home.php?acao=inscricao">
									<i class="material-icons">create</i>
									<span>Efetuar inscrição</span>
								</a>                     
							</li>					
                        </ul>
                    </li>
                    <li>
                        <a href="home.php?acao=meus-cursos">
                            <i class="material-icons">layers</i>
                            <span>Status inscrição</span>
                        </a>
                    </li>
					<li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment_ind</i>
                            <span>Atualizar dados</span>
                        </a>
                        <ul class="ml-menu">
							<li>
								<a href="home.php?acao=editar-login-aluno">									
									<span>Dados login</span>
								</a>                      
							</li> 
							<li>
								<a href="home.php?acao=update-dados-pessoais">									
									<span>Dados pessoais</span>
								</a>                     
							</li>
							<li>
								<a href="home.php?acao=update-dados-cadastrais">									
									<span>Dados residencial</span>
								</a>                        
							</li>
							<li>
								<a href="home.php?acao=update-dados-academicos">									
									<span>Dados acadêmicos/trabalho</span>
								</a>                        
							</li>					
                        </ul>
                    </li>
                    <li>
                        <a href="home.php?acao=deslogar">
                            <i class="material-icons">power_settings_new</i>
                            <span>Deslogar</span>
                        </a>
                    </li>                  
                </ul>
				
				
				<!-------------------------- MENU ADMNISTRADOR --------------------------------------------------------------------------------->				
				
					<?php } elseif($nivelLogado == 1){ ?>
				 <ul class="list">
                    <li class="header">MENU DE NAVEGAÇÃO - ADMIN</li>
                    <li class="active">
                        <a href="home.php?acao=admin">
                            <i class="material-icons">home</i>
                            <span>Principal</span>
                        </a>
                    </li>
					
					<li class="list-group-item">
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">search</i>
							<span>Consultar Inscritos: </span> <span class="badge bg-orange"></span>
						</a>
						<ul class="ml-menu">
							<li>
								<a href="home.php?acao=crud-turma">
									<span>Gerenciar Inscritos</span>
								</a>						
							</li>                         
					    </ul>
					</li>
					
									
					
					<li class="list-group-item">
					<a href="javascript:void(0);" class="menu-toggle">
						<i class="material-icons">widgets</i>
						<span>Gerenciar Dados: </span>
					</a>
					<ul class="ml-menu">
						<li>
							<a href="home.php?acao=crud-login">
								<span>Gerenciar Login</span>
							</a>						
						</li>
						 <li>
							<a href="home.php?acao=crud-alunos">
								<span>Gerenciar Alunos</span>
							</a>							 
						</li>
					</ul>
					
					</li>					                  
                    <li>
                        <a href="home.php?acao=deslogar">
                            <i class="material-icons">power_settings_new</i>
                            <span>Deslogar</span>
                        </a>
                    </li>                  
                </ul>
				
				
				<!-------------------------- MENU DENSE --------------------------------------------------------------------------------->
				
				<?php } elseif($nivelLogado == 3){ ?>
				
				    <ul class="list">
                    <li class="header">MENU DE NAVEGAÇÃO - DENSE</li>
                    <li class="active">
                        <a href="home.php?acao=dense">
                            <i class="material-icons">home</i>
                            <span>Principal</span>
                        </a>
                    </li>
					
					<li class="list-group-item">
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">widgets</i>
							<span>Gerenciar Pagamento: </span> <span class="badge bg-orange"></span>
						</a>
						<ul class="ml-menu">
							<li>
								<a href="home.php?acao=crud-turma">
									<span>Status Inscrição</span>
								</a>						
							</li>                         
					    </ul>
					</li>		
					                  
                    <li>
                        <a href="home.php?acao=deslogar">
                            <i class="material-icons">power_settings_new</i>
                            <span>Deslogar</span>
                        </a>
                    </li>                  
                </ul>
				
				
				
				<?php }else{?>
				
								
					<!-------------------------- MENU FINANCEIRO --------------------------------------------------------------------------------->
				
				    <ul class="list">
                    <li class="header">MENU DE NAVEGAÇÃO - FINANCEIRO</li>
                    <li class="active">
                        <a href="home.php?acao=financeiro">
                            <i class="material-icons">home</i>
                            <span>Principal</span>
                        </a>
                    </li>
					
					<li class="list-group-item">
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">widgets</i>
							<span>Gerenciar Pagamento: </span> <span class="badge bg-orange"></span>
						</a>
						<ul class="ml-menu">
							<li>
								<a href="home.php?acao=crud-turma">
									<span>Status Inscrição</span>
								</a>						
							</li>                         
					    </ul>
					</li>		
					                  
                    <li>
                        <a href="home.php?acao=deslogar">
                            <i class="material-icons">power_settings_new</i>
                            <span>Deslogar</span>
                        </a>
                    </li>                  
                </ul>
								
				<?php } ?>
				
            </div>
            <!-- #Menu -->
            <div class="legal">
                <div class="copyright">
                    &copy;<?php echo $ano = gmdate("Y"); ?><a href="javascript:void(0);"> - EMERJ</a>.<b>Version: </b> 1.0
                </div>                
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
		       
		
		
	
		