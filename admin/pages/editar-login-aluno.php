<section class="content">
<div class="container-fluid">
<!----------------------------------- FUNÇÃO PARA CADASTRAR DADOS ALUNO -------------------------------------------------------------->

	<?php	
						
		$select = "SELECT login_id, login_nome, login_email, login_senha FROM tb_login where login_cpf = ?";
		
		$result = $conexao->prepare($select);
		$result->bindValue(1, $cpfLogado);
		$result->execute(); 	
												
		foreach($result as $row):
			$id               = $row['login_id'];
			$login_nome       = $row['login_nome'];									
			$login_email      = $row['login_email'];
			$login_senha      = base64_decode($row['login_senha']);	//descryptografo a senha para exibir ao usuário	
		endforeach;
		
	?>

<!-- script para aualização das informações -->
<?php


// Verifica se foi solicitada a edição de dados
		if (isset($_POST['editar'])):

			try{					
				$sql = 'update tb_login set login_nome = ?, login_email = ?, login_senha = ?  where login_id = ?';				
								         
				$login_nomep         = $_POST['login_nome'];
				$login_emailp        = $_POST['login_email'];
				$login_senhap        = base64_encode($_POST['login_senha']);   //encryptografo novamente          			
				
				$stm = $conexao->prepare($sql);
				
				$stm->bindValue(1, $login_nomep);
				$stm->bindValue(2, $login_emailp);
				$stm->bindValue(3, $login_senhap);
				$stm->bindValue(4, $id);				
			
				
				$retorno = $stm->execute();
												
				if($retorno):
					echo "<div class='alert alert-success' role='alert'>Atualizando os dados, aguarde você está sendo redirecionado ...</div> ";
				else:
					echo "<div class='alert alert-danger' role='alert'>Erro ao se cadastrar no curso!</div> ";
				endif;
					echo "<meta http-equiv=refresh content='3;URL=home.php?acao=editar-login-aluno'>";
				
				
			}
			catch(PDOException $error)
			{
				echo $error ->getMessage();
			}
				
		endif;
?>

            <!----------------------------------- FIM FUNÇÃO PARA CADASTRAR DADOS ALUNO -------------------------------------------------------------->

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDITAR DADOS LOGIN - ALUNO</h2>
                        </div>
                        <div class="body">
							
                            <form id="form_validation" method="POST" action="" enctype='multipart/form-data'>	
								
								<div class="alert alert-info">
									<small><a href="javascript:void(0);" class="alert-link"> DADOS DE ACESSO AO LOGIN </a></small>
								</div>						
								<div class="card body table-responsive table table-bordered">	
							
																
										<div class="form-group form-float"><!-- DADOS PARA CPF PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula" name="login_cpf" value="<?=$cpfLogado?>" id="cursos_cpf" disabled>
											<label class="form-label">CPF:</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA CPF PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula" name="login_nome" value="<?=$login_nome?>" id="cursos_nome" required>
											<label class="form-label">NOME E ULTIMO NOME:</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control" value="<?=$login_email?>" id="login_email" name="login_email"required>
											<label class="form-label">EMAIL ATUALIZADO</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- EMAIL JA VINDO DO LOIN DESABILITADO P/ PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control" id="login_senha" value="<?=$login_senha?>" name="login_senha" required>
											<label class="form-label">SENHA DE ACESSO: </label>
										</div>
									</div>	
																							
									<button class="btn btn-primary waves-effect"  name="editar" type="submit" data-type="success">ALTERAR DADOS LOGIN</button>
								</div>
                            </form>
						
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>	
	<script type="text/javascript" src="js/custom.js"></script>



