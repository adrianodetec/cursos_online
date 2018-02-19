<section class="content">
    <div class="container-fluid">
            

            <!----------------------------------- FUNÇÃO PARA UPDATE DADOS ALUNO -------------------------------------------------------------->
			<?php 
				$select = "SELECT aluno_id, aluno_instituicao, aluno_concl_curso, aluno_profissao, aluno_nome_empr, aluno_end_empr, aluno_compl_empr, 
				aluno_bairro_empr, aluno_cep_empr, aluno_cid_empr, aluno_tel_empr, aluno_num_empr
				FROM tb_alunos INNER JOIN tb_login ON tb_alunos.aluno_cpf = tb_login.login_cpf where tb_login.login_cpf = ?";
				$result = $conexao->prepare($select);
				$result->bindvalue(1,$cpfLogado); 
				$result->execute();	
				
				foreach($result as $exibe):					
					$login_id             = $exibe['aluno_id'];
					$instituicao          = $exibe['aluno_instituicao'];
					$conclusao            = $exibe['aluno_concl_curso'];	
					$profissao            = $exibe['aluno_profissao'];	
					$aluno_nome_empresa   = $exibe['aluno_nome_empr'];					
                    $aluno_end            = $exibe['aluno_end_empr'];					
                    $aluno_comp           = $exibe['aluno_compl_empr'];					
                    $aluno_bairro         = $exibe['aluno_bairro_empr'];
					$aluno_cep            = $exibe['aluno_cep_empr'];
					$aluno_cidade         = $exibe['aluno_cid_empr'];
					$aluno_uf_empr        = $exibe['aluno_num_empr'];
					$aluno_telefone       = $exibe['aluno_tel_empr'];
					
				endforeach;	
			
			    // FIM SELECT COM INNER JOIN -->			
			
				if(isset($_POST['logar'])):
		             $inst_ensino      = $_POST['inst_ensino'];
					 $data_conclusao   = $_POST['data_conclusao'];
					 $profissao        = $_POST['profissao'];
					 $nome_empresa     = $_POST['nome_empresa'];
					 $rua2             = $_POST['rua2'];
					 $complemento2     = $_POST['complemento2'];
					 $bairro2          = $_POST['bairro2'];
					 $cep2             = $_POST['cep2'];
					 $cidade2          = $_POST['cidade2'];
					 $uf2              = $_POST['uf2'];
					 $num_casa2        = $_POST['num_casa2'];

					// FAÇO A QUERY PARA UPDATE -->	

                    $buscarusuario = $conexao->prepare("update tb_alunos set 
					aluno_instituicao = ?,
					aluno_concl_curso = ?,
					aluno_profissao = ?,
					aluno_nome_empr = ?,
					aluno_end_empr = ?,
					aluno_compl_empr = ?,
					aluno_bairro_empr = ?,
					aluno_cep_empr = ?,
					aluno_cid_empr = ?,
					aluno_tel_empr = ?,
					aluno_num_empr = ?
					
					where aluno_id = $login_id");
					
					
					$buscarusuario->bindParam(1, $inst_ensino, PDO::PARAM_STR);					
					$buscarusuario->bindParam(2, $data_conclusao, PDO::PARAM_STR);
					$buscarusuario->bindParam(3, $profissao, PDO::PARAM_STR);
					$buscarusuario->bindParam(4, $nome_empresa, PDO::PARAM_STR);
					$buscarusuario->bindParam(5, $rua2, PDO::PARAM_STR);
					$buscarusuario->bindParam(6, $complemento2, PDO::PARAM_STR);
					$buscarusuario->bindParam(7, $bairro2, PDO::PARAM_STR);
					$buscarusuario->bindParam(8, $cep2, PDO::PARAM_STR);
					$buscarusuario->bindParam(9, $cidade2, PDO::PARAM_STR);
					$buscarusuario->bindParam(10, $uf2, PDO::PARAM_STR);
					$buscarusuario->bindParam(11, $num_casa2, PDO::PARAM_STR);
					$buscarusuario->execute();
					
					if($buscarusuario):							
							echo "<div class='alert alert-success' role='alert'>Atualização realizada com sucesso, aguarde estamos finalizando sua inscrição ...</div> ";							
							echo "<meta http-equiv=refresh content='3;URL=home.php?acao=update-dados-academicos'>";
											
					else:
							echo 
							'<div class="alert alert-danger">
							  <button type="button" class="close" data-dismiss="alert">×</button>
							  <strong>Erro ao atualizar os dados </strong>.
							</div>';					
                    endif;
					 
				endif;
             
            ?>            <!----------------------------------- FIM FUNÇÃO PARA CADASTRAR DADOS ALUNO -------------------------------------------------------------->

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>ATUALIZAR DADOS ACADÊMICOS/EMPRESA</h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" action="">	
								
								

                              <div class="alert alert-info">
									<small><a href="javascript:void(0);" class="alert-link">3 - DADOS ACADEMICOS/EMPRESA</a></small>
								</div>	
								<div class="card body table-responsive table table-bordered">
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula"  id="inst_ensino" name="inst_ensino" value="<?php echo $instituicao ?>">
											<label class="form-label">Instituição de ensino: </label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula"  id="profissao" name="profissao" value="<?php echo $profissao ?>">
											<label class="form-label">Profissão: </label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control"  name="data_conclusao" id="data_conclusao"  value="<?php echo $conclusao ?>">
											<label class="form-label">Data de conclusão/previsão: </label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula"  id="nome_empresa" name="nome_empresa" value="<?php echo $aluno_nome_empresa ?>">
											<label class="form-label">Nome da empresa: </label>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-sm-4">
											<div class="form-group">
												<div class="form-line">
													<input type="text" class="form-control"  name="cep2" placeholder="Cep: " id="cep2"  value="<?php echo $aluno_cep ?>">
													<input name="ibge2" type="hidden" id="ibge2">
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<div class="form-line">
													<input type="text" class="form-control"   placeholder="Bairro: " name="bairro2" id="bairro2" value="<?php echo $aluno_bairro ?>"/>

												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<div class="form-line">
													<input type="text" class="form-control"  placeholder="Nº trabalho: " name="num_casa2" id="num_casa2" value="<?php echo $aluno_telefone ?>">
												</div>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="rua2" type="text" id="rua2" placeholder="Endereço: " class="form-control" value="<?php echo $aluno_end ?>"/>

												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="complemento2" type="text" placeholder="Complemento: " id="complemento2" class="form-control"  value="<?php echo $aluno_comp ?>"/>

												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="cidade2" type="text" id="cidade2" placeholder="Cidade: " class="form-control" value="<?php echo $aluno_cidade ?>"/>
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="uf2" type="text" id="uf2" placeholder="Estado: " class="form-control" value="<?php echo $aluno_uf_empr ?>">
												</div>
											</div>
										</div>
									</div>								
									<button class="btn btn-primary waves-effect"  name="logar" type="submit" data-type="success">ATUALIZAR DADOS</button>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->



        </div>
    </section>



