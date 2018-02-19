<?php
	include "seguranca_admin.php";	//segurança de pagina para admin
?>

<section class="content">
<div class="container-fluid">
<!----------------------------------- FUNÇÃO PARA CADASTRAR DADOS ALUNO -------------------------------------------------------------->

	<?php

		// Recebe o id do cliente do cliente via GET
		$login_id = (isset($_GET['id'])) ? $_GET['id'] : '';

		// Valida se existe um id e se ele é numérico
		if (!empty($login_id) && is_numeric($login_id)):
			// Captura os dados do cliente solicitado	
			$sql = 'SELECT * FROM tb_login WHERE login_id = ?';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(1, $login_id);
			$stm->execute();	
													
			foreach($stm as $row):											
				$login_nome       = $row['login_nome'];									
				$login_email      = $row['login_email'];
				$login_senha      = base64_decode($row['login_senha']);
				$login_nivel      = $row['login_nivel'];
				$login_status     = $row['login_status'];		
			endforeach;
		endif;
	?>

<!-- script para aualização das informações -->
<?php


// Verifica se foi solicitada a edição de dados
		if (isset($_POST['editar'])):

			try{	
				$login_id = (isset($_GET['id'])) ? $_GET['id'] : ''; //recupero variavel id
				
				$sql = 'update tb_login set login_nome = ?, login_email = ?, login_senha = ?, login_nivel = ?, login_status = ?';
				$sql .= 'where login_id = ?';	
				
				$login_nome         = $_POST['login_nome'];
				$login_email        = $_POST['login_email'];
				$login_senha        = base64_encode($_POST['login_senha']);
				$login_nivel        = $_POST['login_nivel'];
				$login_status       = $_POST['login_status'];
				
				$stm = $conexao->prepare($sql);
				
				$stm->bindValue(1, $login_nome);
				$stm->bindValue(2, $login_email);
				$stm->bindValue(3, $login_senha);
				$stm->bindValue(4, $login_nivel);
				$stm->bindValue(5, $login_status);
				$stm->bindValue(6, $login_id);
				
				$retorno = $stm->execute();
				
				if($retorno):
					echo "<div class='alert alert-success' role='alert'>Atualizando os dados, aguarde você está sendo redirecionado ...</div> ";
				else:
					echo "<div class='alert alert-danger' role='alert'>Erro ao se cadastrar no curso!</div> ";
				endif;
					echo "<meta http-equiv=refresh content='3;URL=home.php?acao=crud-login'>";
				
				
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
                            <h2>EDITAR LOGIN</h2>
                        </div>
                        <div class="body">
							<?php if(empty($stm)):?>
							<h3 class="text-center text-danger">Curso não encontrado!</h3>
							<?php else: ?>
                            <form id="form_validation" method="POST" action="" enctype='multipart/form-data'>	
								
								<div class="alert alert-info">
									<small><a href="javascript:void(0);" class="alert-link"> DADOS DE ACESSO AO LOGIN </a></small>
								</div>						
								<div class="card body table-responsive table table-bordered">	
							
																
								
									<div class="form-group form-float"><!-- DADOS PARA CPF PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula" name="login_nome" value="<?=$login_nome?>" id="cursos_nome" required>
											<label class="form-label">NOME E ULTIMO NOME:</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula" value="<?=$login_email?>" id="login_email" name="login_email"required>
											<label class="form-label">EMAIL ATUALIZADO</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- EMAIL JA VINDO DO LOIN DESABILITADO P/ PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control" id="login_senha" value="<?=$login_senha?>" name="login_senha" required>
											<label class="form-label">SENHA DE ACESSO: </label>
										</div>
									</div>							
									
								    <!-- Select -->
									<div class="form-group form-float">										
										<div class="row clearfix">
											<div class="col-sm-12">
											<label class="form-label">NÍVEL</label>
												<select class="form-control show-tick" id="login_nivel" name="login_nivel">													
													<option value="1" <?=($login_nivel == 1) ? 'selected' : ''?>>ADMINISTRADOR</option>
													<option value="0" <?=($login_nivel == 0) ? 'selected' : ''?>>ALUNO</option>												
												</select>
											</div>
										</div>
									</div>
									<!-- #END# Select -->
									
									<!-- Select -->
									<div class="form-group form-float">										
										<div class="row clearfix">
											<div class="col-sm-12">
												<label class="form-label">STATUS</label>
												<select class="form-control show-tick" id="login_status" name="login_status">													
													<option value="1" <?=($login_status == 1) ? 'selected' : ''?>>ATIVO</option>
													<option value="0" <?=($login_status == 0) ? 'selected' : ''?>>INATIVO</option>												
												</select>
											</div>
										</div>
									</div>
									<!-- #END# Select -->
																							
									<button class="btn btn-primary waves-effect"  name="editar" type="submit" data-type="success">ALTERAR DADOS LOGIN</button>
								</div>
                            </form>
						<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>	
	<script type="text/javascript" src="js/custom.js"></script>



