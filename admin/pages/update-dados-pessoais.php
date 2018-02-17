<section class="content">
    <div class="container-fluid">

            <!----------------------------------- FUNÇÃO PARA UPDATE DADOS ALUNO -------------------------------------------------------------->
			<?php 					
			
				$select = "SELECT aluno_id,aluno_nome,aluno_cpf, aluno_dt_nasc,aluno_rg, aluno_org_exp, aluno_naturalidade, aluno_nome_pai, aluno_nome_mae
				FROM tb_alunos INNER JOIN tb_login ON tb_alunos.aluno_cpf = tb_login.login_cpf where tb_login.login_cpf = ?";
				
				
				$result = $conexao->prepare($select);
				$result->bindvalue(1,$cpfLogado); 
				$result->execute(); 	
				
				foreach($result as $exibe):					
					$login_id       = $exibe['aluno_id'];
					$nome           = $exibe['aluno_nome'];
					$cpf            = $exibe['aluno_cpf'];	
					$data_nasc      = $exibe['aluno_dt_nasc'];	
					$rg             = $exibe['aluno_rg'];
                    $org_exp        = $exibe['aluno_org_exp'];
                    $naturalidade   = $exibe['aluno_naturalidade'];	
                    $pai            = $exibe['aluno_nome_pai'];
					$mae            = $exibe['aluno_nome_mae'];
				endforeach;	
			
			    // FIM SELECT COM INNER JOIN -->			
			
				if(isset($_POST['logar'])):
					 $nome_completo    = $_POST['nome_completo'];
					 $data_nascimento  = $_POST['data_nascimento'];
					 $num_rg           = $_POST['num_rg'];
					 $org_exp          = $_POST['org_exp'];
					 $naturalidade     = $_POST['naturalidade'];					 
					 $nome_pai         = $_POST['nome_pai'];
					 $nome_mae         = $_POST['nome_mae'];

					// FAÇO A QUERY PARA UPDATE -->	

                    $buscarusuario = $conexao->prepare("update tb_alunos set aluno_nome = ?, aluno_dt_nasc = ?, aluno_rg = ?,
					aluno_org_exp = ?, aluno_naturalidade = ?, aluno_nome_pai = ?, aluno_nome_mae = ? where aluno_id = $login_id");
					
						
					$buscarusuario->bindParam(1, $nome_completo, PDO::PARAM_STR);					
					$buscarusuario->bindParam(2, $data_nascimento, PDO::PARAM_STR);
					$buscarusuario->bindParam(3, $num_rg, PDO::PARAM_STR);
					$buscarusuario->bindParam(4, $org_exp, PDO::PARAM_STR);
					$buscarusuario->bindParam(5, $naturalidade, PDO::PARAM_STR);					
					$buscarusuario->bindParam(6, $nome_pai, PDO::PARAM_STR);
					$buscarusuario->bindParam(7, $nome_mae, PDO::PARAM_STR);
					
					$buscarusuario->execute();
					
					if($buscarusuario):							
							echo "<div class='alert alert-success' role='alert'>Atualização realizada com sucesso, aguarde estamos finalizando sua inscrição ...</div> ";							
							echo "<meta http-equiv=refresh content='3;URL=home.php?acao=update-dados-pessoais'>";
					else:
							echo 
							'<div class="alert alert-danger">
							  <button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>Erro ao atualizar os dados </strong>.
							</div>';					
                    endif;
					 
				endif;
             
            ?>

            <!----------------------------------- FIM FUNÇÃO PARA CADASTRAR DADOS ALUNO -------------------------------------------------------------->

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>ATUALIZAR DADOS PESSOAIS</h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" action="">	
								
								<div class="alert alert-info">
									<small><a href="javascript:void(0);" class="alert-link">1 - DADOS PESSOAIS </a></small>
								</div>						
								<div class="card body table-responsive table table-bordered">	
									<div class="form-group form-float"><!-- DADOS PARA CPF PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control" name="cpf" id="cpf" value="<?php echo $cpf ?>" data-inputmask="'mask' : '999.999.999-99'" disabled>
											<label class="form-label">CPF</label>
										</div>
									</div>										
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula" value="<?php echo $nome ?>" id="nome_completo" name="nome_completo">
											<label class="form-label">Nome completo</label>
										</div>
									</div>
								
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control" id="data_nascimento" value="<?php echo $data_nasc ?>" name="data_nascimento" data-inputmask="'mask' : '99/99/9999'">
											<label class="form-label">Data de nascimento</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control"  id="num_rg" name="num_rg" value="<?php echo $rg ?>">
											<label class="form-label">Nº do RG</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula" id="org_exp" name="org_exp" value="<?php echo $org_exp ?>">
											<label class="form-label">Orgao Experdidor</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula" id="naturalidade" name="naturalidade" value="<?php echo $naturalidade ?>">
											<label class="form-label">Naturalidade</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula"  id="nome_pai" name="nome_pai" value="<?php echo $pai ?>">
											<label class="form-label">Nome Pai</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula" id="nome_mae" name="nome_mae" value="<?php echo $mae ?>">
											<label class="form-label">Nome Mãe</label>
										</div>
									</div>									
								</div>
								<div class="row clearfix js-sweetalert">
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<button class="btn btn-primary waves-effect"  name="logar" type="submit">ATUALIZAR DADOS</button>
									</div>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>
	
	
	






