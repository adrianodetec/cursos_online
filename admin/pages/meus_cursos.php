<style type="text/css">

	p
	{
		 text-align: justify;
         text-justify: inter-word;
	}
	
	.alinha_botao_imprimir
	{	
		position: relative;
		top: -10px;
	}


</style>

<?php	
	$exibe = retornaIDaluno($cpfLogado, $conexao);
	
	if($exibe)
	{		
		$aluno_id = $exibe['aluno_id']; // capturo o "ID" do usuario logado	
	    $dados = retorna_dados_aluno($conexao, $aluno_id); // Pego o id do aluno logado para gerar a matricula.		
	}	
?>
	<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                    
					<div class="card">
                        <div class="header">
                            <h2>
                                MEUS CURSOS INSCRITOS								
								<br>
								<!-- <small>Orientações para pagamento: </small> -->
								
                            </h2>                        
                        </div>						
                       								
						<div class="panel-group full-body">
							<?php	
								$contador = 1;								
								
								$select = "SELECT cursos_id, cursos_nome, cursos_descricao, cursos_carg_hr, cursos_dt_ini, cursos_dt_ter, cursos_qt_alunos, cursos_valor  FROM tb_cursos INNER JOIN tb_matricula ON tb_matricula.matricula_curso_id = tb_cursos.cursos_id where tb_matricula.matricula_aluno_id = ?";
								$result = $conexao->prepare($select);
								$result->bindvalue(1,$aluno_id);								
								$result->execute();
								$contar = $result->rowCount();
								
								foreach($result as $row):

									if($contar > 0){
									
									$cursos_id             = $row['cursos_id'];
									$cursos_nome           = $row['cursos_nome'];									
									$cursos_descricao      = $row['cursos_descricao'];
									$cursos_carg_hr        = $row['cursos_carg_hr'];
									$cursos_dt_ini         = $row['cursos_dt_ini'];
									$cursos_dt_ter         = $row['cursos_dt_ter'];
									$cursos_qt_alunos      = $row['cursos_qt_alunos'];
									$cursos_valor          = $row['cursos_valor'];	
									
									$inicio  = date("d/m/Y H:i:s",strtotime($cursos_dt_ini)); //converto data padrao americano para o padrao brasileiro
									$termino = date("d/m/Y 23:59:59",strtotime($cursos_dt_ter)); //converto data padrao americano para o padrao brasileiro												
																													
							?>
									<?php //recupero id do curso para passar para a pagina de contrato 
									
									$id_curso = $_session['id_curso'] = $cursos_id;
									
									?>
							
									<div class="row clearfix">
									<div class="card">
									    <!-- Tabs With Icon Title -->
										<div class="row clearfix">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="card" >
													<div class="header bg-light-blue">
														<h2>
														   <?php echo $contador; ?> - <span class="converte_maiuscula"><?php echo $cursos_nome; ?></span>
														   
														   <div class="right alinha_botao_imprimir">
														   <a href="gerar_pdf.php?id=<?php echo $id_curso ?>" class="fancybox" data-fancybox-type="iframe">
														   <button type="button" class="btn bg-pink waves-effect">																
																<i class="material-icons">print</i>
																<span>IMPRIMIR CONTRATO</span>																
															</button>
															</a>
															</div>
															
														</h2> 
													</div>
													<div class="body">
														<!-- Nav tabs -->
														<ul class="nav nav-tabs" role="tablist">
														
															<li role="presentation" class="active">
																<a href="#dados_bancarios<?php echo $contador; ?>" data-toggle="tab">
																	<i class="material-icons">date_range</i> DADOS PARA DEPÓSITO
																</a>
															</li>
														
															<li role="presentation">
																<a href="#home_with_icon_title<?php echo $contador; ?>" data-toggle="tab">
																	<i class="material-icons">date_range</i> DADOS CURSO
																</a>
															</li>
															<li role="presentation">
																<a href="#objeto_with_icon_title<?php echo $contador; ?>" data-toggle="tab">
																	<i class="material-icons">face</i> DO OBJETO
																</a>
															</li>
															<li role="presentation">
																<a href="#settings_with_icon_title<?php echo $contador; ?>" data-toggle="tab">
																	<i class="material-icons">settings</i> CONFIGURAÇÃO EXIGIDA
																</a>
															</li>
															<li role="presentation">
																<a href="#matricula_with_icon_title<?php echo $contador; ?>" data-toggle="tab">
																	<i class="material-icons">create</i> MATRICULA
																</a>
															</li>															
															<li role="presentation">
																<a href="#condicao_with_icon_title<?php echo $contador; ?>" data-toggle="tab">
																	<i class="material-icons">playlist_add_check</i> CONDIÇÕES
																</a>
															</li>
															<li role="presentation">
																<a href="#pagamento_with_icon_title<?php echo $contador; ?>" data-toggle="tab">
																	<i class="material-icons">attach_money</i> PAGAMENTO
																</a>
															</li>
														</ul>

														<!-- Tab panes -->
														<div class="tab-content">
														
														
															<div role="tabpanel" class="tab-pane fade in active" id="dados_bancarios<?php echo $contador; ?>">
																<div class="header bg-blue-grey">
																	<p align="justify">
																		CLÁUSULA 7ª<br>  A prestação do serviço contratado é onerosa e exige a pré -matrícula do aluno, por meio do preenchimento de cadastro eletrônico. <br>Disponibilizado no endereço: www.emerj.tjrj.jus.br/cursos_livres/direito_eletronico/curso_livre_emerj.html<br> Contendo dados pessoais  e/ou  outros  exigidos  pela  EMERJ  e  do  pagamento  antecipado,  através  de  depósito.<br> Identificado com CPF<br> Em conta corrente do Fundo Especial da EMERJ <br> Banco Bradesco S/A (237)<br> Agência: 6246-4<br> C/C: 3005-8<br> Valor de R$ <?php echo number_format($cursos_valor,2); ?> reais.
																	</p>

					
																	<address>&nbsp;</address>
																</div>
															</div>
														
															<div role="tabpanel" class="tab-pane" id="home_with_icon_title<?php echo $contador; ?>">																
																<div class="header bg-blue-grey">																	
																	<div class="right">
																	
																	
																		<?php 
																		   
																		    $mt_aluno = retorna_dados_aluno_matricula($conexao, $aluno_id, $cursos_id);
																			
																			foreach($mt_aluno as $mt_exibe):																			
																				$id_mt          = $mt_exibe['matricula_id'];
																				$data_mt        = $mt_exibe['data_matricula'];
																				$pagamento_mt   = $mt_exibe['matricula_status_pg'];
																				$data_pagamento = $mt_exibe['data_pg'];
																			endforeach;
																			
																		
																		?>
																	
																		<div align="center"> Data da inscrição candidato: <?php echo date("d/m/Y H:i:s",strtotime($data_mt)); ?></div>
																		
																		<div align="center"> Nº Matricula do candidato: <?php echo $id_mt ?>/<?php echo $ano = gmdate("Y") ?></div>
																		
																		<div align="center"><span class="converte_maiuscula"><button data-color="green"  class="btn bg-green btn-block waves-effect" data-type="success">STATUS PAGAMENTO: <font color="red"><b><?php echo $pagamento_mt ?></b></font></button></span></div>
																		<?php if($data_pagamento == '')
																		{
																			echo "";
																		}
																		else
																		{
																			echo '<div align="center">';
																			echo "<h5>Pagamento lançado em: ";
																			echo date("d/m/Y",strtotime($data_pagamento));
																			echo '</h5></div>';
																		}
																		
																		?>	
																		
																		
																		
																		<!--															
																		<div class="button-demo js-modal-buttons">
																			<button data-color="green"  class="btn bg-green btn-block waves-effect" data-type="success">VISUALIZAR DADOS DEPÓSITO</button>
																		</div>
																		-->
																	</div>													
																	Descrição: <?php if(isset($cursos_descricao)): echo $cursos_descricao; endif; ?>
																	<br>
																	Carga horária: <?php if(isset($cursos_carg_hr)): echo $cursos_carg_hr; endif; ?> horas.
																	<br>
																	Data início das inscrições: <?php if(isset($inicio)): echo $inicio; endif; ?>.
																	<br>
																	Data término das inscrições: <?php if(isset($termino)): echo $termino; endif; ?>.
																	<br>
																	Quantidade de vagas: <?php if(isset($cursos_qt_alunos)): echo $cursos_qt_alunos; endif; ?>.
																</div>
															</div>
															<div role="tabpanel" class="tab-pane fade" id="objeto_with_icon_title<?php echo $contador; ?>">
																<div class="header bg-blue-grey">
																	<p>CLÁUSULA 1ª -  Constitui objeto do presente Contrato a prestação de serviços educacionais pela  Contratada , referente ao Curso Livre de Direito Eletrônico, na modalidade a distância com tutoria, exclusivamente on line, em plataforma virtual de aprendizagem, disponibilizado no endereço eletrônico virtual.emerj.com.br.</p>

																	<p>CLÁUSULA 2ª -  O curso é composto por 10 (dez) módulos, nos quais serão utilizados variados recursos educacionais, como videoaulas, materiais escritos, hipertextos, links para vídeos hospedados em páginas  eletrônicas externas, e outras estratégias adequadas aos objetos de aprendizagem propostos.</p>

																	<p>CL&Aacute;USULA 3&ordf; - A carga hor&aacute;ria do curso &eacute; de <strong><?php echo $cursos_carg_hr ?></strong> horas-aula, podendo, a crit&eacute;rio da EMERJ, oferecer horas excedentes de bonifica&ccedil;&atilde;o.</p>

																	<p>CLÁUSULA 4ª - O conteúdo programático refere-se àquele divulgado na página da EMERJ e demais veiculações.  O curso será iniciado em 22.01.2018 e ficará disponível para acesso até 23.03.2018.</p>

																	<p>Parágrafo único –  Havendo novas alterações na legislação de regência  acerca do conteúdo ministrado, a EMERJ não se obriga a oferecer complementação de conteúdo programático.  Mas, poderá ao seu turno, oferecer curso on line complementar, com incidência de novos custos.</p>

																	<address>&nbsp;</address>
																</div>
															</div>
															<div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title<?php echo $contador; ?>">
																<div class="header bg-blue-grey">											
																	<p>CL&Aacute;USULA 5 &ordf; - Para acessar o curso, o aluno precisar&aacute; ter acesso a um computador com conex&atilde;o &agrave; internet, cujos requisitos m&iacute;nimos de configura&ccedil;&atilde;o exigidos s&atilde;o:</p>
																	<ul>
																	<li>Processador Dual Core ou superior, 2 GB de mem&oacute;ria RAM;</li>
																	<li>Windows 7, Mac OS 10.6;</li>
																	<li>Navegador Internet Explorer, Google Chrome, Mozilla ou Safari (com o plugin Flash Player);</li>
																	<li>Windows Media Player ou VLC player;</li>
																	<li>Pacote Office ou LibreOffice &nbsp;e Adobe Reader;</li>
																	<li>Todos os aplicativos devem estar atualizados;</li>
																	<li>O curso tamb&eacute;m pode ser acessado de celulares ou tablets rodando Android (Google) ou iOS (Apple)</li>
																	<li>Recomend&aacute;vel Internet banda Larga, velocidade a partir de 1 mbps para que os v&iacute;deos n&atilde;o sofram interrup&ccedil;&otilde;es.</li>
																	</ul>
																	<p>Par&aacute;grafo &uacute;nico:&nbsp; N&atilde;o &eacute; aconselh&aacute;vel a utiliza&ccedil;&atilde;o das tecnologias 3G e 4G, uma vez que a taxa de transfer&ecirc;ncia de dados pode sofrer varia&ccedil;&atilde;o e dificultar ou impedir o acesso ao curso, n&atilde;o sendo a EMERJ responsabilizada.</p>
																	<p>CL&Aacute;USULA 6&ordf; -&nbsp; Atendidos os requisitos previstos na cl&aacute;usula 5&ordf;, o suporte para eventual dificuldade de acesso &agrave; plataforma do curso se dar&aacute; mediante o envio de mensagem, contendo a descri&ccedil;&atilde;o do problema, para emerj.virtual@tjrj.jus.br.</p>
																	<address>&nbsp;</address>
																</div>																
															</div>
															<div role="tabpanel" class="tab-pane fade" id="matricula_with_icon_title<?php echo $contador; ?>">
																<div class="header bg-blue-grey">											
																	<p>CLÁUSULA 7ª -  A prestação do serviço contratado é onerosa e exige a pré -matrícula do aluno, por meio do preenchimento de cadastro eletrônico, disponibilizado no endereço: www.emerj.tjrj.jus.br/cursos_livres/direito_eletronico/curso_livre_emerj.html, contendo dados pessoais  e/ou  outros  exigidos  pela  EMERJ  e  do  pagamento  antecipado,  através  de  depósito, identificado com CPF, em conta corrente do Fundo Especial da EMERJ- Banco Bradesco S/A (237), Agência: 6246-4, C/C: 3005-8, no valor de R$ <?php echo number_format($cursos_valor,2); ?>.</p>

																	<p>Par&aacute;grafo Primeiro - &Eacute; vedado o fornecimento de informa&ccedil;&otilde;es cadastrais inexatas ou incompletas no ato do cadastramento para a pr&eacute;-matr&iacute;cula.</p>

																	<p>Parágrafo Segundo - O contratante somente terá liberado o seu acesso ao curso após a confirmação do pagamento pelo banco.</p>

																	<p>CLÁUSULA 8ª - Para a confirmação da matrícula, o aluno deverá enviar cópias digitalizadas do comprovante do depósito identificado realizado, da cópia da Identidade e do C.P.F para o e-mail: emerj.matriculaonline@tjrj.jus.br, até o dia 16/01/2018. O aluno receberá no e-mail indicado no seu cadastro de pré-matrícula, as informações de confirmação de matrícula, login e senha de acesso ao curso, através do e-mail: emerj.virtual@tjrj.jus.br, até o dia 19/01/2018.</p>

																	<p>CLÁUSULA 9ª -  O login e a senha são de uso pessoal e intransferível, sendo vedada a cessão a terceiros, a qualquer título.  A senha garantirá o acesso à plataforma de aprendizagem no prazo de duração do curso, sendo bloqueada imediatamente após expirado esse período.</p>

																	<p>CLÁUSULA 10ª -  O aluno concorda e declara-se ciente de que a leitura e a aceitação eletrônica dos termos disponibilizados e condições ajustadas, nas fases de pré-matrícula e de matrícula, significarão integral e incondicional concordância a este contrato.</p>
																	<p>Parágrafo  primeiro -  O início, adiamento ou cancelamento do curso sujeitam-se a um quórum mínimo, a ser fixado pela contratada, conforme as suas disponibilidades técnicas e/ou logísticas.</p>
																	<p>Parágrafo segundo -  Em caso de cancelamento do curso, o valor pago será integralmente devolvido ao aluno regularmente matriculado. </p>

																</div>																
															</div>
					
															<div role="tabpanel" class="tab-pane fade" id="condicao_with_icon_title<?php echo $contador; ?>">
																<div class="header bg-blue-grey">
																	
																	<p>CLÁUSULA 11ª -  O aluno poderá enviar dúvidas sobre o conteúdo ministrado, no período do curso, por meio do ambiente virtual do curso, no “Fórum Tira Dúvidas”, onde as respostas dadas pelo professor-tutor também ficarão disponibilizadas.</p>

																	<p>CLÁUSULA 12ª -  As dúvidas deverão ser formuladas em tese, de caráter geral e abstrato (situações hipotéticas), e não podendo referir-se a casos concretos, especificados ou que contenham outra forma de identificação.</p>

																	<p>CLÁUSULA 13ª -  Não há número limite de perguntas que poderão ser enviadas pelo aluno, mas o professor não se obriga a responder a todas, ficando a seu critério a escolha daquelas que serão por ele respondidas.</p>

																	<p>CLÁUSULA 14ª –  O módulo de início será disponibilizado no primeiro dia do curso. Os módulos subsequentes serão disponibilizados pela contratada de acordo com o cronograma disponível no ambiente de aprendizagem.</p>

																	<p><strong>DA RESPONSABILIDADE DO ALUNO</strong></p>

																	<p>CL&Aacute;USULA 15&ordf; - &nbsp;O conte&uacute;do do curso <em>on line</em> &eacute; de uso exclusivo e pessoal do aluno matriculado, sendo vedada, por quaisquer meios e a qualquer t&iacute;tulo, a sua reprodu&ccedil;&atilde;o, c&oacute;pia, divulga&ccedil;&atilde;o e distribui&ccedil;&atilde;o.</p>

																	<p>CL&Aacute;USULA 16&ordf; - &nbsp;O aluno n&atilde;o poder&aacute; ter mais de um acesso simult&acirc;neo &agrave; &aacute;rea restrita do site com a mesma senha. Tentativas nesse sentido implicar&atilde;o bloqueio eletr&ocirc;nico imediato da senha em uso, ficando a&nbsp; EMERJ autorizada a faz&ecirc;-lo sem comunica&ccedil;&atilde;o pr&eacute;via ao contratante, independente da comprova&ccedil;&atilde;o da culpa ou do dolo do aluno.</p>

																	<p>CL&Aacute;USULA 17&ordf; &ndash; &nbsp;Ser&atilde;o proibidas quaisquer condutas antissociais ou perigosas praticadas pelo contratante no ambiente virtual da EMERJ, tais como ofensas aos colegas e aos professores e tentativas de fraude ou manipula&ccedil;&atilde;o do sistema.</p>

																	<p>Par&aacute;grafo &uacute;nico: As san&ccedil;&otilde;es ser&atilde;o o afastamento tempor&aacute;rio ou definitivo do aluno, e ser&atilde;o definidas de acordo com extens&atilde;o do seu resultado.</p>
                                                                 </div>
															</div>
															
															<div role="tabpanel" class="tab-pane fade" id="pagamento_with_icon_title<?php echo $contador; ?>">
																<div class="header bg-blue-grey">
																	<p>CL&Aacute;USULA 18&ordf; -&nbsp; O valor do curso &eacute; <strong>R$ <?php echo number_format($cursos_valor,2); ?> </strong>.</p>

																	<p>CL&Aacute;USULA 19&ordf; -&nbsp; N&atilde;o haver&aacute; restitui&ccedil;&atilde;o do valor pago pelo Contratante, salvo desist&ecirc;ncia manifestada expressamente e pr&eacute;via ao in&iacute;cio do curso para o e-mail emerjdifin@tjrj.jus.br, com a exposi&ccedil;&atilde;o clara e sucinta dos motivos.</p>

																	<p><strong>DO CERTIFICADO</strong></p>

																	<p>CL&Aacute;USULA 19&ordf; -&nbsp; Far&aacute; jus ao certificado o aluno que cumprir as etapas do curso na forma estruturada no ambiente virtual de aprendizagem e que obtiver, no m&iacute;nimo, 70% (setenta por cento) de acertos na Avalia&ccedil;&atilde;o Final, composta por dez (10) quest&otilde;es objetivas.&nbsp; O certificado de conclus&atilde;o do "<?php echo $cursos_nome ?>",  ficar&aacute; dispon&iacute;vel para download no ambiente virtual do curso, at&eacute; 12.02.2018.</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div><!-- #END# Tabs With Icon Title -->
									</div>
									<?php $contador++; }
									else{echo "teste";}endforeach; ?>
									
									<?php 
									if($contar <= 0)
									{ ?>
										
									
									
									<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													
												</div>
												<div class="modal-body alert alert-warning">
												
												<center><h5 class="modal-title" id="myModalLabel"><u><span class='converte_maiuscula'> <?php echo $nomeLogado ?></span>, AVISO!</h5></center></u>
												
												<br>
												<center><b>NO MOMENTO VOCÊ NÃO ESTÁ ESCRITO EM NENHUM CURSO!</b></center>
												</div>
												
											</div>
										</div>
									</div>				
									<script>
										$(document).ready(function () {
											$('#myModal').modal('show');
										});
									</script>
									
									<?php 
									echo "<meta http-equiv=refresh content='3;URL=home.php?acao=welcome'>";
									}
									?>
									
							</div>			
						</div>
					</div>
				</div>
			</div>						
        </section>
 <!-- #END# Material Design Colors -->
  