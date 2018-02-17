<?php require_once "includes/header.php"?> <!-- inclusão do cabeçalho -->
<?php require_once "includes/funcao.php"?> <!-- inclusão das funções -->
<?php require_once "includes/bloquea_botao_direito.php" ?> <!-- inclusão bloqueador botão direito -->  

	<body class="login-page">
		<video src="video/institucional.mp4" autoplay loop muted></video>
			<div class="login-box">       
				<div class="card">
					<div class="body">
					<div class="logo demo-color-box padrao-site">
					<a href="javascript:void(0);"><b>EMERJ</b></a>
				<small>Sistema de Inscrição de Cursos Online</small>
				<small>Escola da Magistratura do Estado do Rio de Janeiro</small>
				</div>
					
				<?php        
					if(isset($_POST['cadastrar'])) //Verifico se o meu botão foi acionado
					{				
						$cpf     = $_POST['cpf']; 
						$usuario = $_POST['usuario'];			
						$email	 = $_POST['email'];
						$senha	 = $_POST['confirm'];
						$nivel   = 0;
						$status  = 1;
						
						$validacpf = validaCPF($cpf); //verifico se CPF é válido caso seja não poderá cadastrar até informar um CPF válido				
						
						if($validacpf == false)
						{				
							echo '<div class="alert alert-danger">
								  <button type="button" class="close" data-dismiss="alert">×</button>
								  <strong>CPF INVÁLIDO</strong>
							</div>';
						}
						else // Caso seja TRUE, faço a verificação se CPF já existe
						{												
							$verifica = verificaCPF($cpf, $conexao);
						
							if($verifica == 0){ // Se for == 0, é prq CPF não existe na base de dados, podemos prosseguir com o cadastrado			
								
								$insert = cadastraNovousuario($conexao, $cpf, $usuario, $email, $senha, $nivel, $status);						
								$exibe = retornaDados($cpf, $senha, $conexao);
								
								if($insert):
								
									$usuario = $exibe;							
									$login_cpf   = $usuario['login_cpf']; // capturo o status do usuario logado
									$login_senha = $usuario['login_senha']; // capturo o status do usuario logado
									
									$_SESSION["usuario"]   = $login_cpf;
									$_SESSION["senha"]     = $login_senha;
																
									echo '<div class="alert alert-success">
											  <button type="button" class="close" data-dismiss="alert">×</button>
											  <strong>CADASTRADO! <br> FAÇA AGORA O LOGIN NO SISTEMA! </strong> AGUARDE....
										 </div>';				
									header("Refresh: 3, admin/home.php?acao=pre-cadastro");							
								endif;									
							}
							else
							{ // Caso for == 1, Exibo mensagem de CPF já cadastrado na base de dados.
								echo '<div class="alert alert-danger">
									  <button type="button" class="close" data-dismiss="alert">×</button>
									  Esse "CPF" já esta cadastrado no sistema. Esqueceu sua senha? entre no campo esqueci a senha que enviaremos a senha para o seu e-mail.
								</div>';
							}				
						}				

					}// se clicar no botão entrar no sistema	
				?>  
				<form id="sign_up" method="POST">                    					
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">person</i>
						</span>
						<div class="form-line">
							<input type="text" class="form-control" name="usuario" placeholder="Primeiro e ultimo nome" required autofocus>
						</div>
					</div>			
					<div class="demo-masked-input">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">credit_card</i>
							</span>
							<div class="form-line">
								<input type="text" class="form-control cpf" placeholder="Digite um CPF válido" name="cpf" required>
							</div>
						</div>				
					</div>					
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">email</i>
						</span>
						<div class="form-line">
							<input type="email" class="form-control" name="email" placeholder="Endereço de email válido" required>
						</div>
					</div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">lock</i>
						</span>
						<div class="form-line">                            
							<input type="password" class="form-control" name="password" minlength="6" placeholder="Senha" required="" aria-required="true">
						</div>
					</div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">lock</i>
						</span>
						<div class="form-line">
							
							<input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm senha" required="" aria-required="true" aria-invalid="true">
						</div>
					</div>				

					<div class="form-group">
						<input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
						<label for="terms">Verifiquei as informações acima.</label>
					</div>

					<button class="btn btn-block btn-lg bg-blue waves-effect"  name="cadastrar" type="submit">Cadastrar</button>

					<div class="m-t-25 m-b--5 align-center">
						<a href="index.php">Você já possui uma conta?</a>
					</div>
				</form>				
            </div> 
		

		
		<!-- Jquery Core Js -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap Core Js -->
		<script src="plugins/bootstrap/js/bootstrap.js"></script>
		<!-- Waves Effect Plugin Js -->
		<script src="plugins/node-waves/waves.js"></script>
		<!-- Validation Plugin Js -->
		<script src="plugins/jquery-validation/jquery.validate.js"></script>
		<!-- Custom Js -->
		<script src="js/admin.js"></script>
		<script src="js/pages/examples/sign-up.js"></script>	
		
		
		
		<!-- excensial para funcionamento da maskara input -->
		<!-- Bootstrap Colorpicker Js -->
		<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<!-- Dropzone Plugin Js -->
		<script src="plugins/dropzone/dropzone.js"></script>
		<!-- Input Mask Plugin Js -->
		<script src="plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>	
		<script src="js/pages/forms/advanced-form-elements.js"></script>
		<!-- fim mascara input --> 




		
		
	
	</body>
	
