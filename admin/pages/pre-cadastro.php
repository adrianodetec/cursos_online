<section class="content">
    <div class="container-fluid">	
	
	
	
			<?php
				//caso eu precise apaggar o login do usuario
			
				function cancelar($conexao,$idLogado)
				{
					$retorno = cancelar_Login($conexao, $idLogado);
					if($retorno):
					@session_unset($_SESSION['usuario']);

					@header("Location: ../index.php");
					endif;
				}
			?>	
	
	

            <?php 
			
				if(isset($_POST['precadastro']))
				{

					 @$nome_completo    = trim(strip_tags(addslashes($_POST['nome_completo'])));
					 @$cpf              = trim(strip_tags(addslashes($cpfLogado)));
					 @$estado_civil     = trim(strip_tags(addslashes($_POST['estado_civil'])));
					 @$data_nascimento  = trim(strip_tags(addslashes($_POST['data_nascimento'])));
					 @$num_rg           = trim(strip_tags(addslashes($_POST['num_rg'])));
					 @$org_exp          = trim(strip_tags(addslashes($_POST['org_exp'])));
					 @$naturalidade     = trim(strip_tags(addslashes($_POST['naturalidade'])));
					 @$email            = trim(strip_tags(addslashes($emailLogado)));
					 @$nome_pai         = trim(strip_tags(addslashes($_POST['nome_pai'])));
					 @$nome_mae         = trim(strip_tags(addslashes($_POST['nome_mae'])));
					 @$num_casa         = trim(strip_tags(addslashes($_POST['num_casa'])));
					 @$rua              = trim(strip_tags(addslashes($_POST['rua'])));
					 @$complemento      = trim(strip_tags(addslashes($_POST['complemento'])));
					 @$bairro           = trim(strip_tags(addslashes($_POST['bairro'])));
					 @$cep              = trim(strip_tags(addslashes($_POST['cep'])));
					 @$cidade           = trim(strip_tags(addslashes($_POST['cidade'])));
					 @$uf               = trim(strip_tags(addslashes($_POST['uf'])));
					 @$telefone         = trim(strip_tags(addslashes($_POST['telefone'])));
					 @$celular          = trim(strip_tags(addslashes($_POST['celular'])));
					 @$inst_ensino      = trim(strip_tags(addslashes($_POST['inst_ensino'])));
					 @$data_conclusao   = trim(strip_tags(addslashes($_POST['data_conclusao'])));
					 @$profissao        = trim(strip_tags(addslashes($_POST['profissao'])));
					 @$nome_empresa     = trim(strip_tags(addslashes($_POST['nome_empresa'])));
					 @$rua2             = trim(strip_tags(addslashes($_POST['rua2'])));
					 @$complemento2     = trim(strip_tags(addslashes($_POST['complemento2'])));
					 @$bairro2          = trim(strip_tags(addslashes($_POST['bairro2'])));
					 @$cep2             = trim(strip_tags(addslashes($_POST['cep2'])));
					 @$cidade2          = trim(strip_tags(addslashes($_POST['cidade2'])));
					 @$uf2              = trim(strip_tags(addslashes($_POST['uf2'])));
					 @$num_casa2        = trim(strip_tags(addslashes($_POST['num_casa2'])));					 				 
					 date_default_timezone_set('America/Sao_Paulo');    
					 @$date_cadastro = date("d/m/Y H:i:s");


					try
					{
						$contar = verificaCPF($cpf, $conexao); //verifico se o aluno que está logado, já preencheu o formulário

						if($contar == 0){ 

							$insere_bd = insertPrecadastro($conexao, $nome_completo, $cpf, $estado_civil, $data_nascimento, $num_rg, $org_exp,
							$naturalidade, $email, $nome_pai, $nome_mae, $num_casa, $rua, $complemento, $bairro, $cep, $cidade, $uf, $telefone,$celular,
							$inst_ensino, $data_conclusao, $profissao, $nome_empresa, $rua2, $complemento2, $bairro2, $cep2, $cidade2 , $uf2, $num_casa2, $date_cadastro);

							if($insere_bd):
								echo '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong>Cadastrado! <br> redirecionando</strong> Aguarde....
								</div>';
								
								echo "<meta http-equiv=refresh content='3;URL=home.php?acao=welcome'>";								
							
							endif;
						}else
						{
							echo '<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong>Erro ao logar!</strong> <br>Você já tem cadastro no sistema, entre em contato pelo telefone: 3133-1880 ou Recupere sua senha.
							</div>';
						}
					}catch(PDOException $e){
						echo $e;
					}
				}
            ?>

            <!----------------------------------- FIM FUNÇÃO PARA CADASTRAR DADOS ALUNO -------------------------------------------------------------->

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>PRÉ MATRICULA</h2>
                        </div>
						
                        <div class="body">
                            <form id="form_validation" method="POST" action="">	
								
								<div class="alert alert-info">
									<small><a href="javascript:void(0);" class="alert-link">1 - DADOS PESSOAIS </a></small>
								</div>						
								<div class="card body table-responsive table table-bordered">	
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="cpf" id="cpf" value="<?php echo $cpfLogado ?>" data-inputmask="'mask' : '999.999.999-99'" disabled>
											<label class="form-label">CPF</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" id="email" name="email" value="<?php echo $emailLogado ?>">
											<label class="form-label">Email</label>
										</div>
									</div>
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula" id="nome_completo" name="nome_completo"required>
											<label class="form-label">Nome completo</label>
										</div>
									</div>									
									<!-- Select -->
									<div class="form-group form-float">										
										<div class="row clearfix">
											<div class="col-sm-12">
												<select class="form-control show-tick" id="estado_civil" name="estado_civil">
													<option value="">Selecione seu estado civil</option>
													<option value="Casado(a)">Casado(a)</option>
													<option value="Viuvo(a)">Viuvo(a)</option>
													<option value="Divorciado(a)">Divorciado(a)</option>
													<option value="Solteiro(a)">Solteiro(a)</option>
												</select>
											</div>
										</div>
									</div>
									<!-- #END# Select -->
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control" id="data_nascimento" name="data_nascimento" data-inputmask="'mask' : '99/99/9999'" required>
											<label class="form-label">Data de nascimento</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control"  id="num_rg" name="num_rg" required>
											<label class="form-label">Nº do RG</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula" id="org_exp" name="org_exp" required>
											<label class="form-label">Orgao Expedidor</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula" id="naturalidade" name="naturalidade" required>
											<label class="form-label">Naturalidade</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula"  id="nome_pai" name="nome_pai" required>
											<label class="form-label">Nome Pai</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula" id="nome_mae" name="nome_mae" required>
											<label class="form-label">Nome Mãe</label>
										</div>
									</div>									
								</div>	
                                <div class="alert alert-info">
									<small><a href="javascript:void(0);" class="alert-link">2 - DADOS RESIDENCIAL</a></small>
								</div>	                               
								<div class="card body table-responsive table table-bordered">
									<div class="row clearfix">
										<div class="col-sm-4">
											<div class="form-group">
												<div class="form-line">
													<input type="text" class="form-control"  placeholder="Cep: " name="cep" id="cep"  required onblur="pesquisacep(this.value);"/>

													<input name="ibge" type="hidden" id="ibge">
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<div class="form-line">
													<input type="text" class="form-control"  placeholder="Bairro: " name="bairro" id="bairro"/>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<div class="form-line">
													<input type="text" class="form-control " placeholder="Nº casa:"  name="num_casa" id="num_casa"/>
												</div>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="rua" type="text" id="rua" placeholder="Rua: " class="form-control"/>

												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="complemento" type="text" id="complemento" placeholder="Complemento: " class="form-control"/>

												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="cidade" type="text" id="cidade" placeholder="Cidade: " class="form-control" />
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="uf" type="text" id="uf" placeholder="Estado: " class="form-control" />

												</div>
											</div>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control"  name="telefone" id="telefone" data-inputmask="'mask' : '(99)9999-9999'" required>
											<label class="form-label">Telefone residencial: </label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control" name="celular" id="celular" data-inputmask="'mask' : '(99)99999-9999'" required>
											<label class="form-label">Celular: </label>
										</div>
									</div>
								</div>
                              <div class="alert alert-info">
									<small><a href="javascript:void(0);" class="alert-link">3 - DADOS ACADEMICOS/EMPRESA</a></small>
								</div>	
								<div class="card body table-responsive table table-bordered">
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula"  id="inst_ensino" name="inst_ensino" required>
											<label class="form-label">Instituição de ensino que estuda ou estudou: </label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control"  name="data_conclusao" id="data_conclusao" data-inputmask="'mask' : '99/99/9999'" required>
											<label class="form-label">Data de conclusão/previsão (Graduação): </label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula"  id="profissao" name="profissao" required>
											<label class="form-label">Profissão: </label>
										</div>
									</div>									
									
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">										
											   <label class="radio-inline">
												 <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline3" 
												   value="option3" onClick="habilitacao()" checked>Não Trabalha
												</label>
												<label for="radio4" class="radio-inline">
												  <input type="radio" name="optionsRadiosInline" id="radio" 
												  onClick="habilitacao()" value="option4" >Trabalha 
												 </label>
										</div>
										
									</div>
									
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula"  id="nome_empresa" name="nome_empresa" disabled>
											<label class="form-label">Nome da empresa: </label>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-sm-4">
											<div class="form-group">
												<div class="form-line">
													<input type="text" class="form-control"  name="cep2" placeholder="Cep: "id="cep2" disabled>
													<input name="ibge2" type="hidden" id="ibge2">
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<div class="form-line">
													<input type="text" class="form-control"   placeholder="Bairro: " name="bairro2" id="bairro2" disabled>

												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<div class="form-line">
													<input type="text" class="form-control"  placeholder="Nº trabalho: " name="num_casa2" id="num_casa2" disabled>

												</div>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="rua2" type="text" id="rua2" placeholder="Endereço: " class="form-control" disabled>

												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="complemento2" type="text" placeholder="Complemento: " id="complemento2" class="form-control" disabled>

												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="cidade2" type="text" id="cidade2" placeholder="Cidade: " class="form-control" disabled>
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<div class="form-line">
													<input name="uf2" type="text" id="uf2" placeholder="Estado: " class="form-control" disabled>
												</div>
											</div>
										</div>
									</div>
									<!-- LEITURA DO CONTRATO ----------------------------------------------------------------------------------------------------->
									<div class="alert alert-info">
									<small><a href="javascript:void(0);" class="alert-link">4 - LEITURA DO CONTRATO</a></small>
								</div>	
								<div class="card body table-responsive table table-bordered">
									<a class="fancybox" data-fancybox-type="iframe" href="contrato/contrato.pdf">
										<button type="button" class="btn bg-pink waves-effect">
											<i class="material-icons">insert_drive_file</i>
											<span>LEITURA DO CONTRATO</span>
										</button>									
									</a>
								</div>
									
									<!-- FIM LEIURA DO CONTRATO -------------------------------------------------------------------------------------------------->
									
									
									<div class="form-group">
										<input type="checkbox" id="checkbox" name="checkbox">
										<label for="checkbox">Li o contrato e aceito os termos</label>
									</div>									
									<button class="btn btn-primary waves-effect"  name="precadastro" type="submit" data-type="success">ACEITO OS TERMOS - EFETUAR CADASTRO</button>									
								</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>

	<!-- JANELA MODAL PARA LEITURA DO CONTRATO -->
	<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="largeModalLabel"></h4>
				</div>
				<div class="modal-body">
					<?=require_once "contrato/contrato.html"?>
				</div>
				<div class="modal-footer">                            
					<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">FECHAR JANELA</button>
				</div>
			</div>
		</div>
	</div>
	
  <script language="javascript">
    function habilitacao(){
	
      if(document.getElementById('radio').checked == true){
        document.getElementById('nome_empresa').disabled = false;
        document.getElementById('bairro2').disabled = false;
		document.getElementById('num_casa2').disabled = false;
		document.getElementById('cep2').disabled = false;
		document.getElementById('rua2').disabled = false;
		document.getElementById('complemento2').disabled = false;
		document.getElementById('cidade2').disabled = false;
		document.getElementById('uf2').disabled = false;
      }
	  
      if(document.getElementById('radio').checked == false){        
        document.getElementById('nome_empresa').disabled = true;
        document.getElementById('bairro2').disabled = true;
		document.getElementById('num_casa2').disabled = true;
		document.getElementById('cep2').disabled = true;
		document.getElementById('rua2').disabled = true;
		document.getElementById('complemento2').disabled = true;
		document.getElementById('cidade2').disabled = true;
		document.getElementById('uf2').disabled = true;
      }
    }
  </script>

