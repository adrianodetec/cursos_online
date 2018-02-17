<section class="content">
    <div class="container-fluid">


            <!----------------------------------- FUNÇÃO PARA CADASTRAR DADOS ALUNO -------------------------------------------------------------->

            	<?php 					
			
				$select = "SELECT aluno_id,aluno_num_casa,aluno_end, aluno_compl,aluno_bairro, aluno_cep, aluno_cidade, aluno_est, aluno_tel_fixo, aluno_tel_cel 
				FROM tb_alunos INNER JOIN tb_login ON tb_alunos.aluno_cpf = tb_login.login_cpf where tb_login.login_cpf = ?";
				
				
				$result = $conexao->prepare($select);
				$result->bindvalue(1,$cpfLogado); 
				$result->execute(); 	
				
				foreach($result as $exibe):					
					$login_id         = $exibe['aluno_id'];
					$aluno_num_casa   = $exibe['aluno_num_casa'];
					$aluno_end        = $exibe['aluno_end'];	
					$aluno_compl      = $exibe['aluno_compl'];	
					$aluno_bairro     = $exibe['aluno_bairro'];
                    $aluno_cep        = $exibe['aluno_cep'];
                    $aluno_cidade     = $exibe['aluno_cidade'];	
                    $aluno_est        = $exibe['aluno_est'];
					$aluno_tel_fixo   = $exibe['aluno_tel_fixo'];
					$aluno_tel_cel    = $exibe['aluno_tel_cel'];
				endforeach;	
			
			    // FIM SELECT COM INNER JOIN -->			
			
				if(isset($_POST['logar'])):
					 $num_casa         = $_POST['num_casa'];
					 $rua              = $_POST['rua'];
					 $complemento      = $_POST['complemento'];
					 $bairro           = $_POST['bairro'];
					 $cep              = $_POST['cep'];
					 $cidade           = $_POST['cidade'];
					 $uf               = $_POST['uf'];
					 $telefone         = $_POST['telefone'];
					 $celular          = $_POST['celular'];

					// FAÇO A QUERY PARA UPDATE -->	

                    $buscarusuario = $conexao->prepare("update tb_alunos set aluno_num_casa = ?, aluno_end = ?, aluno_compl = ?,
					aluno_bairro = ?, aluno_cep = ?, aluno_cidade = ?, aluno_est = ?, aluno_tel_fixo = ?, aluno_tel_cel = ? where aluno_id = $login_id");
					
						
					$buscarusuario->bindParam(1, $num_casa, PDO::PARAM_STR);					
					$buscarusuario->bindParam(2, $rua, PDO::PARAM_STR);
					$buscarusuario->bindParam(3, $complemento, PDO::PARAM_STR);
					$buscarusuario->bindParam(4, $bairro, PDO::PARAM_STR);
					$buscarusuario->bindParam(5, $cep, PDO::PARAM_STR);					
					$buscarusuario->bindParam(6, $cidade, PDO::PARAM_STR);
					$buscarusuario->bindParam(7, $uf, PDO::PARAM_STR);
					$buscarusuario->bindParam(8, $telefone, PDO::PARAM_STR);
					$buscarusuario->bindParam(9, $celular, PDO::PARAM_STR);
					
					$buscarusuario->execute();
					
					if($buscarusuario):							
							echo "<div class='alert alert-success' role='alert'>Atualização realizada com sucesso, aguarde estamos finalizando sua inscrição ...</div> ";							
							echo "<meta http-equiv=refresh content='3;URL=home.php?acao=update-dados-cadastrais'>";
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
                            <h2>ATUALIZAR DADOS RESIDENCIAL</h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" action="">	
								
																

                                <div class="alert alert-info">
									<small><a href="javascript:void(0);" class="alert-link">2 - DADOS RESIDENCIAL</a></small>
								</div>	                               
								<div class="card body table-responsive table table-bordered">
									<div class="row clearfix">
										<div class="col-sm-4">
											<div class="form-group">
												<div class="form-line">
													<input type="text" class="form-control"  placeholder="Cep: " name="cep" id="cep" value="<?php echo $aluno_cep ?>"/>

													<input name="ibge" type="hidden" id="ibge">
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<div class="form-line">
													<input type="text" class="form-control"  placeholder="Bairro: " name="bairro" id="bairro" value="<?php echo $aluno_bairro ?>"/>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<div class="form-line">
													<input type="text" class="form-control " placeholder="Nº casa:"  name="num_casa" id="num_casa" value="<?php echo $aluno_num_casa ?>"/>
												</div>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="rua" type="text" id="rua" placeholder="Rua: " class="form-control" value="<?php echo $aluno_end ?>"/>

												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="complemento" type="text" id="complemento" placeholder="Complemento: " class="form-control" value="<?php echo $aluno_compl ?>"/>

												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="cidade" type="text" id="cidade" placeholder="Cidade: " class="form-control" value="<?php echo $aluno_cidade ?>"/>
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="uf" type="text" id="uf" placeholder="Estado: " class="form-control" value="<?php echo $aluno_est ?>"/>

												</div>
											</div>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control"  name="telefone" id="telefone" data-inputmask="'mask' : '(99)9999-9999'" value="<?php echo $aluno_tel_fixo ?>">
											<label class="form-label">Telefone residencial: </label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control" name="celular" id="celular" data-inputmask="'mask' : '(99)99999-9999'" value="<?php echo $aluno_tel_cel ?>">
											<label class="form-label">Celular: </label>
										</div>
									</div>
								</div>
                              
									<button class="btn btn-primary waves-effect"  name="logar" type="submit">ATUALIZAR DADOS</button>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->



        </div>
    </section>



