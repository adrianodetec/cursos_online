
<?php	
	$exibe = retornaIDaluno($cpfLogado, $conexao);
	if($exibe)
	{		
		$aluno_id = $exibe['aluno_id']; // capturo o "ID" do usuario logado
		@session_start();
		echo $_SESSION['id_aluno'] = $aluno_id;
		@$session_aluno_id = $_SESSION['id_aluno'];
	}

	//Recupero valor do curso	
	$sql = 'SELECT cursos_valor FROM tb_cursos';
	$stm = $conexao->prepare($sql);
	$stm->execute();	
	$dados = $stm->fetch(PDO::FETCH_ASSOC);
	$valor_curso = $dados['cursos_valor'];

	
?>

	<section class="content">
        <div class="container-fluid">			
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">						
                        <div class="header">
                            <h2>SISTEMA DE INSCRIÇÃO</h2>
						</div>
							<div class="header bg-blue-grey">
								<p align="justify" class="m-t-15 m-b-30">
									<i class="material-icons">attach_file</i> Após finalizar sua inscrição em um novo curso, confira se todos os seus DADOS CADASTRAIS e DADOS PESSOAIS estão atualizados. 
									É necessário que seus dados estejam corretos para contatos durante o prazo do curso. 
								</p>							
							</div>
					   </div>
                        <div class="body">	
							<?php 								
// AQUI EU FAÇO O INSERT, CASO O BOTÃO DE CADASTRAR SEJA PRESSIONADO///////////////////////////////////////////////////////////////////////////////


								
								$cursos_id = (isset($_GET['cursos_id'])) ? $_GET['cursos_id'] : ''; 	//faço insert de novo aluno							
								if (!empty($cursos_id) && is_numeric($cursos_id)):	

													
								$contar = verifica_Alunoid_Cursoid($conexao, $aluno_id, $cursos_id);
															
									if($contar):
										$pg = "PENDENTE";
										$retorno = efetua_Incricao($conexao, $aluno_id, $cursos_id, $pg);
										
									//insiro valor do curso na tabela tb_matricula
										$sql = 'update tb_matricula set valor_pago = ? where matricula_aluno_id = ?';
										$stm = $conexao->prepare($sql);
										$stm->bindValue(1, $valor_curso);
										$stm->bindValue(2, $session_aluno_id);			
										$retorno = $stm->execute();	
									//fim inserção valor tb_matricula	
										
											
										
										if ($retorno): 	

        // AQUI EU FAÇO O INCREMENTO - UPDATE PARA ALIMENTAÇÃO DO GRÁFICO, CASO O BOTÃO DE CADASTRAR SEJA ATIVADO////////////////////////////////////////
										$select = "SELECT cursos_qt_inscritos from tb_cursos where cursos_id = ?";	
										$result = $conexao->prepare($select);											
										$result->bindvalue(1, $cursos_id);
										$result->execute();
									
										foreach($result as $exibe):											
											$contar_inscritos = $exibe['cursos_qt_inscritos'];										
										endforeach;									
										
										$sql = 'update tb_cursos set cursos_qt_inscritos = ? where cursos_id = ?';
										$stm = $conexao->prepare($sql);
										$stm->bindValue(1, $contar_inscritos = $contar_inscritos + 1 );
										$stm->bindValue(2, $cursos_id);
										$retorno = $stm->execute();	
                // FIM UPDATE PARA ALIMENTAÇÃO DO GRÁFICO /////////////////////////////////////////////////////////////////////////////////////////										
										echo "<div class='alert alert-success' role='alert'>Inscrição realizada com sucesso, aguarde estamos finalizando sua inscrição ...</div> ";
										else:
											echo "<div class='alert alert-danger' role='alert'>Erro ao se cadastrar no curso!</div> ";
										endif;
										echo "<meta http-equiv=refresh content='2;URL=home.php?acao=inscricao'>";
									else:								
										echo "<div class='alert alert-danger' role='alert'><span class='converte_maiuscula'> $nomeLogado</span>, você já está inscrito nesse curso!</div> ";
										echo "<meta http-equiv=refresh content='2;URL=home.php?acao=inscricao'>";
									endif;	
								endif;
							?>
	
							<?php
// AQUI EU FAÇO O DELETE, CASO O BOTÃO DE CANCELAR SEJA PRESSIONADO///////////////////////////////////////////////////////////////////////////////							
								$id_matriculado = (isset($_GET['cancelar'])) ? $_GET['cancelar'] : ''; //recupero o id do matriculado
								$cursos_id     = (isset($_GET['curso'])) ? $_GET['curso'] : ''; // recupero o id do curso
								
								if (isset($_GET['cancelar']) and isset($_GET['curso'])):									
									$retorno = cancelar_Incricao($conexao, $id_matriculado, @tb_matricula);									
									if ($retorno):

										$select = "SELECT cursos_qt_inscritos from tb_cursos where cursos_id = ?";	
										$result = $conexao->prepare($select);											
										$result->bindvalue(1, $cursos_id);
										$result->execute();									
										foreach($result as $exibe):											
											$contar_inscritos_m = $exibe['cursos_qt_inscritos'];										
										endforeach;
										
        // AQUI EU FAÇO A DECREMENTAÇÃO - UPDATE PARA ALIMENTAÇÃO DO GRÁFICO, CASO O BOTÃO DE CADASTRAR SEJA CANCELAR////////////////////////////////////////	
											if($contar_inscritos_m >= 0):
												$sql = 'update tb_cursos set cursos_qt_inscritos = ? where cursos_id = ?';
												$stm = $conexao->prepare($sql);
												$stm->bindValue(1, $contar_inscritos_m = $contar_inscritos_m - 1 );
												$stm->bindValue(2, $cursos_id);
												$retorno = $stm->execute();	
        // FIM UPDATE PARA ALIMENTAÇÃO DO GRÁFICO /////////////////////////////////////////////////////////////////////////////////////////													
												echo "<div class='alert alert-success' role='alert'>Inscrição cancelada com sucesso...aguarde mais um momento</div> ";
											else:
													echo "<div class='alert alert-danger' role='alert'>Você não tem permissão para essa ação</div> ";
													echo "<meta http-equiv=refresh content='1;URL=home.php?acao=inscricao'>";
											endif;
											
									else:
										echo "<div class='alert alert-danger' role='alert'>Erro ao excluir inscrição!</div> ";
									endif;
									echo "<meta http-equiv=refresh content='1;URL=home.php?acao=inscricao'>";								
								endif;
							?>
							<?php
								// Recebe o termo de pesquisa se existir
								$termo = (isset($_POST['termo'])) ? $_POST['termo'] : '';
								// Verifica se o termo de pesquisa está vazio, se estiver executa uma consulta completa
								if (empty($termo)):	
									$sql = 'SELECT * FROM tb_cursos';
									$stm = $conexao->prepare($sql);
									$stm->execute();
									$clientes = $stm->fetchAll(PDO::FETCH_OBJ);
								else:
									// Executa uma consulta baseada no termo de pesquisa passado como parâmetro
									$sql = 'SELECT * FROM tb_cursos WHERE cursos_nome LIKE :titulo OR cursos_descricao LIKE :descricao';
									$stm = $conexao->prepare($sql);
									$stm->bindValue(':titulo', $termo.'%');
									$stm->bindValue(':descricao', $termo.'%');
									$stm->execute();
									$clientes = $stm->fetchAll(PDO::FETCH_OBJ);
								endif;								
							?>
							
							<form action="" method="post" id='form-contato' class="form-horizontal col-md-12">
								<label class="col-md-2 control-label" for="termo">Pesquisa</label>							
								<div class='col-md-7'>
									<input type="text" class="form-control" id="termo" name="termo" placeholder="Infome o titulo ou descrição do curso">
								</div>
								<button type="submit" class="btn btn-primary">Pesquisar</button>
								<a href='home.php?acao=inscricao' class="btn btn-primary">Ver Todos</a>
							</form>
							
							<div class='clearfix'></div>
							<?php if(!empty($clientes)):?>					
							<div class="row clearfix">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="card">                      
							<div class="body">
							<div class="row">							
							<?php foreach($clientes as $cliente):
							
								$id = $cliente->cursos_id;

								$quantidade_vagas = $cliente->cursos_qt_alunos; //recupero quantidade de vagas
								$quantidade_inscritos = $cliente->cursos_qt_inscritos; //recupero quantidade de alunos inscritos
								
								$data_final = $cliente->cursos_dt_ter; 
																 
								$data = strtotime("$data_final");  //transformo em milisegundos
								
								date_default_timezone_set('America/Sao_Paulo'); 
								
								$date_atual = date("Y/m/d");

								$valor = $cliente->cursos_valor;
								
								
								//Enquanto a data do evento estiver dentro do prazo é exibido o conteudo 
								
								if(strtotime($data_final) >= strtotime($date_atual)){					
							?>	
																					
									<div class="col-sm-6 col-md-3">
									<div class="contador" data-respond>                 
									<div class="dias block">
									<!--
									<div class="label font-bold col-pink">Dias</div>
									<div class="conta"></div> 
									-->
									</div>
									 
									<div class="horas block">
									<!--
									<div class="label font-bold col-pink">Hr</div>
									<div class="conta"></div> 
									-->
									</div>
									 
									<div class="minutos block">
									<!--
									<div class="label font-bold col-pink">Min</div>
									<div class="conta"></div> 
									-->
									</div>
									 
									<div class="segundos block">
									<!--
									<div class="label font-bold col-pink">Seg</div>
									<div class="conta"></div>
									-->
									</div>                  
									</div>	
									

									<div class="thumbnail">
									<a class="example-image-link" href="pages/crud-curso/upload/<?=$cliente->foto?>" data-lightbox="example-2"><img src='pages/crud-curso/upload/<?=$cliente->foto?>' height='211' width='297' class="example-image" alt="image-1"></a>
																	
									
									<div class="caption">
									
									<div class="alert bg-blue-grey">
										<center>
											<h5>Valor curso: R$ <?php echo number_format($valor,2) ?></h5>
										</center>
									</div>
									
									<?php	
									$select = "SELECT * FROM tb_matricula where matricula_curso_id = ? and matricula_aluno_id = ?";	
									$result = $conexao->prepare($select);
									$result->bindvalue(1,$id);
									$result->bindvalue(2,$session_aluno_id);
									$result->execute();

									foreach($result as $exibe):										
									$id_matricula = $exibe['matricula_id'];
									$id_curso_matriculado = $exibe['matricula_curso_id'];											
									endforeach;
									
									$contar = $result->rowCount();
									
									
									if($quantidade_inscritos <= $quantidade_vagas){ 
									
										if($contar == 0)
										{									
										?>								
										
											<button type="button" class="btn bg-green btn-block waves-effect" size="2" data-trigger="focus" data-container="body" data-toggle="popover"
											data-placement="top" title="<?php echo $cliente->cursos_nome;?>" 
											data-content="
											Quantidade vagas: <?php echo $cliente->cursos_qt_alunos;?> <br> Total inscritos:
											<?php

											$data     = $cliente->cursos_dt_ter;
											
											$dataencerramento = date("d/m/Y 23:59:59",strtotime($data));

											$select = "SELECT matricula_id FROM tb_matricula where matricula_curso_id = ?";	
											$result = $conexao->prepare($select);
											$result->bindValue(1, $id );													
											$result->execute();													
											echo $contar = $result->rowCount();
											?>
											<br>
											Carga horária: <?php echo $cliente->cursos_carg_hr;?> horas <br>Encerramento: <?php echo $dataencerramento;?>
											">
											INFORMAÇÃO CURSO
											</button>
											
											<a href='home.php?acao=inscricao&cursos_id=<?php echo $id ?>'>											
											<button class="btn btn-primary btn-block waves-effect" data-type="success">
											INSCREVA-SE</button>											
											</a>
											
										<?php
										}else{
											//aqui converto a data para o padrao brasileiro 								
											$data = $cliente->cursos_dt_ter;

											$dataencerramento = date("d/m/Y 23:59:59",strtotime($data)); //converto data padrao americano para o padrao brasileiro

											?>
											<button type="button" class="btn bg-green btn-block waves-effect" size="2" data-trigger="focus" data-container="body" data-toggle="popover"
											data-placement="top" title="<?php echo $cliente->cursos_nome;?>" data-content="Quantidade vagas: <?php echo $cliente->cursos_qt_alunos;?> <br> Total inscritos:
											<?php 
											$select = "SELECT matricula_id FROM tb_matricula where matricula_curso_id = ?";	
											$result = $conexao->prepare($select);
											$result->bindValue(1, $id );													
											$result->execute();													
											echo $contar = $result->rowCount();
											?>
											<br>
											Carga horária: <?php echo $cliente->cursos_carg_hr;?> horas <br>Encerramento: <?php echo $dataencerramento;?>">
											INFORMAÇÃO CURSO
											</button>
											<a onclick="return confirm ('Deseja realmente cancelar sua inscrição?')" href='home.php?acao=inscricao&cancelar=<?php echo $id_matricula ?>&curso=<?php echo $id_curso_matriculado ?>'>
											<button class="btn btn-danger btn-block waves-effect">CANCELAR INSCRIÇÃO</button>
											</a>
									<?php }}else
									{echo "<button class='btn btn-danger btn-block waves-effect' data-type='success' disabled>VAGAS ESGOTADAS</button>";}?>
									</div>
								</div>									
							</div> 
								<?php }
								else{ ?>
								
								
										
										
										<div class="header bg-blue-grey">
											<p align="justify" class="m-t-15 m-b-30">
											<center><h1>Não há nenhum curso disponível no momento</h1></center>
											</p>							
										</div>
										
										
									<?php } // Se curso estiver fora do periodo exibo conteudo vazio
						
						endforeach;?>				                        
				</div>		 
            </div>      
	    </div>
			<?php else: ?>
				<!-- Mensagem caso não exista clientes ou não encontrado  -->
				<h5 class="text-center text-primary">Nenhum curso encontra com essa busca</h5>
			<?php endif; ?>	
    </div>
</section>












