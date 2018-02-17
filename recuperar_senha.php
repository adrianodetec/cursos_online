<!DOCTYPE html>
<html>
<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<head>
<?php include "includes/header.php"?> <!-- inclusão do cabeçalho -->
<?php include "includes/bloquea_botao_direito.php" ?> <!-- inclusão bloqueador botão direito -->  
</head>

<body class="fp-page">



<video src="video/institucional.mp4" autoplay loop muted></video>

    <div class="fp-box">       
        <div class="card">
            <div class="body">			
			<div class="logo demo-color-box padrao-site">
					<a href="javascript:void(0);"><b>EMERJ</b></a>
				<small>Sistema de Inscrição de Cursos Online</small>
				<small>Escola da Magistratura do Estado do Rio de Janeiro</small>
				</div>			
			<?php
			
			
			  
	if(isset($_POST['recuperar'])){
			include("conexao/conecta.php");
			$email    = utf8_decode (addslashes(strip_tags(trim($_POST['email']))));			
			$select = "SELECT * from tb_login WHERE login_email='$email' ";
		
		try{
			$result = $conexao->prepare($select);
			//$result->bindValue(':email', $email, PDO::PARAM_STR);
			$result->execute();
			$contar = $result->rowCount();
			
			if($contar>0){
				foreach($conexao->query($select) as $exibe):
				
					$nomeUser 		= $exibe['login_nome'];
					$emailUser 		= $exibe['login_email'];
					$cpfUser 	    = $exibe['login_cpf'];
					$senhaUser 		= base64_decode($exibe['login_senha']);	
					
				endforeach; // Termina foreach
					
			
			   $email_dest = $emailUser; // destinatário
						
				$eol     = PHP_EOL;
				$subject = "Escola da Magistratura do Rio de Janeiro - EMERJ / Recuperação de Senha:";
				$message = 'Sistema de Inscrições Online';
				
				$from_name = "emerj.virtual@tjrj.jus.br";
				$from_mail = $email_dest;				
				$mailto    = $email_dest;
				$header    = "From: " . $from_name . " <" . $from_mail . ">\n";				
				$header .= "MIME-Version: 1.0\n";				
				$emessage = "\n";
							
				$emessage .= $message . "\n\n";				
				$emessage .= "Estamos enviando o usuário e a senha para acesso ao Sistema de Inscrição de Cursos Online. Se você já recebeu seu usuário e está utilizando o Sistema, por favor desconsidere esta mensagem.\n";
				
				$emessage = "\n";
				$emessage = "\n";
				$emessage .= "Nome: $nomeUser\n";
				$emessage .= "E-mail: $emailUser\n";
				$emessage .= "CPF: $cpfUser\n";
				$emessage .= "Senha: $senhaUser\n";
				mail($mailto, $subject, $emessage, $header);
			   
			    
			   										
			
			if($emailUser){
				echo '<div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Sucesso!</strong><br> Uma mensagem com as informações de acesso foi enviada p/ o e-mail informado.
                </div>';
			}	
				
				
			}else{
				echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Erro ao recuperar!</strong><br> O e-mail digitado não consta cadastrado em nosso sistema.
                </div>';
			}			
		}catch(PDOException $e){
			echo $e;
		}	
	}// se clicar
?> 
                <form id="forgot_password" method="POST">
                    <div class="msg">                        
                    Digite seu endereço de e-mail que você usou para se registrar.
					Nós lhe enviaremos um e-mail com seu nome de usuário e um link para redefinir sua senha.
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                        </div>
                    </div>

                    <button class="btn btn-block btn-lg bg-red waves-effect" name="recuperar" type="submit">Enviar minha senha</button>

                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="index.php">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
     
    

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
    <script src="js/pages/examples/forgot-password.js"></script>
</body>

</html>