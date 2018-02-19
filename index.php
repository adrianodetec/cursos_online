<?php
	include "includes/header.php"; 
	include "includes/funcao_generica.php"; 
	include "includes/bloquea_botao_direito.php" 
?> 

<html>
	<body class="login-page">
		<video src="" autoplay loop muted></video>
		<div class="login-box">       
			<div class="card">
				<div class="body">
				<div class="logo demo-color-box padrao-site">
				<a href="javascript:void(0);"><b>EMERJ</b></a>
				<small>Sistema de Inscrição de Cursos Online</small>
				<small>Escola da Magistratura do Estado do Rio de Janeiro</small>
			</div>
			<?php				
				
				if(isset($_POST['logar']))
				{					
										
					date_default_timezone_set('America/Sao_Paulo'); 
					
					$data_acesso = date("Y-m-d H:i:s");					
					
					//limpando post contra injeção de sql e na função são tratados com PDO	
					$cpf    = trim(strip_tags(addslashes($_POST['cpf']))); 
					
					//limpando post contra injeção de sql e na função são tratados com PDO
					$senha	= trim(strip_tags(addslashes(base64_encode($_POST['confirm']))));
					
					/*Nº 1  - VERIFICO SE USUARIO EXISTE NA TABELA TB_USUARIO*/
					$check_formulario  = selectrowcount($conexao, 'tb_alunos', "aluno_cpf = '$cpf'");
					
					/*Nº 2  - RETORNO OS DADOS EM FORMA DE OBJETO*/
						
						$sql        = "SELECT * from tb_login WHERE login_cpf = ? AND login_senha = ?";  
						$arrayParam = array($cpf, $senha);						
						$exibe      = select($conexao, $sql, $arrayParam, TRUE);
												
						if($exibe)
						{
							foreach ($exibe as $key => $object)
							{
								$login_id    = $object->login_id;
								$login_nome = $object->login_nome;
								$login_cpf   = $object->login_cpf;
								$login_nivel = $object->login_nivel;
								$login_senha = $object->login_senha;
							}
						}
						
					// FIM 2
					
					/*Nº 3  - VERIFICO SE USUARIO E SENHA CONFEREM*/
						$contar  = selectrowcount($conexao, 'tb_login', "login_cpf = '$cpf' and login_senha = '$senha'");
					// FIM 3												
					
					// se usuário existir no banco
					if($contar > 0)
					{ 	
						
						
/************************************************************************************************************************************************************************************
                                                              4 -  CONTROLE DE SESSÃO DO USUÁRIO LOGADO
************************************************************************************************************************************************************************************/
						
					
						$_SESSION['registro']           = time(); 
						$_SESSION['limite']             = 600; // em segundos
						$_SESSION['login_id']           = $login_id;
						$ip_user_logado                 = $_SERVER['REMOTE_ADDR'];
						$tempo_on                       = date('d-m-Y H:i:s');
						
						
						$dados = array("part_online_sessao" => $_SESSION['login_id'], "part_online_ip" => $ip_user_logado, "part_online_data" => $tempo_on, "part_online_nome" => $login_nome,"part_online_cpf"  => $login_cpf);					
																		
		                insert($conexao, 'tbl_participante_online', $dados);						
												
																
						//TODA VEZ QUE O USUÁRIO ACESSAR O SISTEMA, SUA DATA DE ACESSO SERÁ ALTERADA.							
							$altera = $conexao->prepare("update tb_login set login_data_inicial = ? where login_id = ?");
							$altera->bindParam(1, $data_acesso);
							$altera->bindParam(2, $login_id);
							$altera ->execute();
						//FIM ATUALIZAÇÃO DATA INICIAL ACESSO AO SISTEMA.
					
						echo '<div class="alert alert-success">
								  <button type="button" class="close" data-dismiss="alert">×</button>
								  <strong>Logado com Sucesso!</strong> <br>Redirecionando para o sistema.
							</div>';
							
						if($login_nivel == 1)
						{ //Se usuário for administrador, mando ele para página de admin			
							$_SESSION['usuario'] = $login_cpf;							
							if($login_cpf)
							{
								@$_SESSION['userSessao'] =  md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']); //gero um token para segurança
							}
							header("Refresh: 1, admin/home.php?acao=admin");
						}
						
						elseif($login_nivel == 2){ //Se usuário for financeiro, mando ele para página do financeiro			
						$_SESSION['usuario'] = $login_cpf;							
						if($login_cpf)
						{
							@$_SESSION['userSessao'] =  md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']); //gero um token para segurança
						}
						header("Refresh: 1, admin/home.php?acao=financeiro");
						}
						
						elseif($login_nivel == 3){ //Se usuário for do DENSE, mando ele para página do DENSE			
						$_SESSION['usuario'] = $login_cpf;							
						if($login_cpf)
						{
							@$_SESSION['userSessao'] =  md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']); //gero um token para segurança
						}
						header("Refresh: 1, admin/home.php?acao=dense");
						}
						
						else
						{	//Caso seja aluno,verifico se ele já preencheu a página de cadastro
							if($check_formulario == 0){					
									$_SESSION['usuario'] = $login_cpf;									
								header("Refresh: 1, admin/home.php?acao=pre-cadastro");
							}					
							else{ //Caso preenchido, mando para página principal
									$_SESSION['usuario'] = $login_cpf;									
									if($login_cpf)
									{
										@$_SESSION['userSessao'] =  md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']); //gero um token para segurança
									}
								header("Refresh: 1, admin/home.php?acao=welcome");	
							}
						}
							
					}
					else{		
						echo '<div class="alert alert-danger">
							  <button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>Erro ao logar!</strong> Os dados estão incorretos.
						</div>';		
					}		
				}	
			?>
					
			<form id="sign_in" method="POST">	
				<div class="demo-masked-input">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">credit_card</i>
						</span>
						<div class="form-line">
							<input type="text" class="form-control cpf" placeholder="Ex: Digite seu CPF" name="cpf" required>
						</div>
					</div>				
				</div>				
				<div class="input-group">
					<span class="input-group-addon">
						<i class="material-icons">lock</i>
					</span>
					<div class="form-line">
						<input type="password" class="form-control" name="confirm" placeholder="Digite sua senha" required>
					</div>
				</div>
				<div class="row">
				
					<div class="col-xs-8 p-t-5">
						<input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
						<label for="rememberme">Lembrar-me</label>
					</div>
					<div class="col-xs-4">
						<button type="submit" data-color="blue" name="logar" class="btn bg-light-green waves-effect" type="submit">Conectar</button>							
					</div>
				</div>
				<div class="row m-t-15 m-b--20">                        
					<div class="button-demo js-modal-buttons col-xs-6">
						 <a href="cadastro_usuario.php"><button type="button" class="btn bg-blue waves-effect">Cadastrar usuário</button></a>                                
					</div>
					<div class="col-xs-6 align-right">
						<a href="recuperar_senha.php"><button type="button" data-color="red" class="btn bg-red waves-effect">Esqueceu a senha?</button></a>
					</div>
				</div>
			</form>			
		</div>
	</body>
</html>
<?php include "includes/footer.php"?> <!-- inclusão scripts -->


<!-- excensial para funcionamento da maskara input -->
	<!-- Bootstrap Colorpicker Js -->
	<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
	<!-- Dropzone Plugin Js -->
	<script src="plugins/dropzone/dropzone.js"></script>
	<!-- Input Mask Plugin Js -->
	<script src="plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>	
	<script src="js/pages/forms/advanced-form-elements.js"></script>
<!-- fim mascara input --> 
