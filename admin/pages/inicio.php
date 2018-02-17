<style type="text/css">		
	.h_iframe iframe {position:relative;top:30px;left:0;width:100%; height:450px;}
</style>


<?php 

$tokenUser = md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']); //gerei token para sessão do usuário logado

if(!isset($_SESSION['usuario']) and !isset($_SESSION['userSessao']) != $tokenUser):	
	header("Location: ../index.php");exit;
endif;

$unix_data1 = strtotime($datasaidaLogado);
$unix_data2 = strtotime($dataacessoLogado);

$nHoras   = ($unix_data1 - $unix_data2) / 3600;
$nMinutos = (($unix_data1 - $unix_data2) % 3600) / 60;


	require('user_info.php');
	$c_info = new Users_info;
	$ttt    = new Users_info;
	
//Select para exibir cursos ativos e nao ativos 
date_default_timezone_set('America/Sao_Paulo'); 
								
$date_atual = date("Y-m-d");

$select = "select * from tb_cursos";
$dados = $conexao->prepare($select);	
$dados->execute();
$count = $dados->fetchAll();



?>
<?php	
	$exibe = retornaIDaluno($cpfLogado, $conexao);
	if($exibe)
	{		
		$aluno_id = $exibe['aluno_id']; // capturo o "ID" do usuario logado
		@session_start();
		echo $_SESSION['id_aluno'] = $aluno_id;
		@$session_aluno_id = $_SESSION['id_aluno'];
	}	
?>

<?php 

//INSCRIÇÕES PENDENTES	

$select = "select * from tb_matricula where matricula_aluno_id = ? and matricula_status_pg = 'PENDENTE' ";
$dados = $conexao->prepare($select);
$dados->bindValue(1, $session_aluno_id);	
$dados->execute();
$inscricaoPendentes = $dados->rowCount();

$select = "select * from tb_matricula where matricula_aluno_id = ? and matricula_status_pg = 'PAGAMENTO APROVADO' ";
$dados = $conexao->prepare($select);
@$dados->bindValue(1, $session_aluno_id);	
$dados->execute();
$inscricaoAprovadas = $dados->rowCount();

foreach($dados as $dados)
{
	$valor_pago = $dados['valor_pago'];
}

@$valor_investido = ($valor_pago * $inscricaoAprovadas);

?>



<section class="content">
        <div class="container-fluid">
            <!-- Widgets -->
            <div class="row clearfix">
			
			
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">	
					<div class="info-box bg-pink">
							<div class="icon">
								<i class="material-icons">playlist_add_check</i>
							</div>
							<div class="content">
								<div class="text">ORIENTAÇÕES PARA INSCRIÇÃO</div>
								<div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">
									<div class="text">
										<div class="button-demo js-modal-buttons">
											<button type="button" data-color="pink" class="btn bg-orange btn-block waves-effect"><strong>CLIQUEI AQUI</strong></button>
										</div>
									</div>
								</div>									
							</div>
							
					</div>
                </div>
			
			
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-light-blue">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="content">
                            <div class="text">CONTROLE ACESSO</div>
                            <div class="text">LOGIN:
							<?php							
								echo $data_ultimo_login = date("d/m/Y H:i:s",strtotime($dataacessoLogado)); //converto data padrao americano para o padrao brasileiro
							?>
							</div>
							
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-blue">
                            <i class="material-icons">devices</i>
                        </div>
                        <div class="content">
                            <div class="text">CURSOS INSCRITOS</div>
                            <div class="number">
							<?php 							
								$exibe = retornaIDaluno($cpfLogado, $conexao);
								if($exibe)
								{		
									$aluno_id = $exibe['aluno_id']; // capturo o "ID" do usuario logado	
									$cursos_inscritos = retorna_dados_aluno($conexao, $aluno_id);
									
									if($cursos_inscritos == 0):
										echo "<span class='number'>";
										echo "0";
										echo "</span>";
									else:
										echo "<span class='number'>";
										echo $cursos_inscritos;
										echo "</span>";
									endif;									
								}
							?>							
							</div>
                        </div>
                    </div>
                </div>
				
				 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                   <div class="info-box hover-zoom-effect">
                        <div class="icon bg-blue">
                            <i class="material-icons">attach_money</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL INVESTIDO</div>
                            <div class="number"><?php echo number_format($valor_investido,2) ?></div>
                        </div>
                    </div>
                </div>				
				              
				
               
            </div>
            <!-- #END# Widgets -->
			
			
			<!-- DADOS DE ACESSO DO USUÁRIO LOGADO -->
			
			 <div class="row clearfix">
                <!-- Visitors -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-pink">
                            <div class="sparkline_conteudo">
                                DETALHES DE NAVEGAÇÃO: 
                            </div>							
                            <ul class="dashboard-stat-list tab-pane animated flipInX" id="profile_animation_1">
							    <li>
                                    SEU IP: 
                                    <span class="pull-right"><b><?php echo $ttt->c_ip();?></b></span>
                                </li>
                                <li>
                                    NAVEGADOR: 
                                    <span class="pull-right"><b><?php echo $ttt->c_Browser();?></b></span>
                                </li>
                                <li>
                                    SISTEMA OPERACIONAL: 
                                    <span class="pull-right"><b><?php echo $ttt->c_OS(); ?></b></span>
                                </li>
                                <li>
                                    DISPOSITIVO CONECTADO: 
                                    <span class="pull-right"><b><?php echo $c_info->c_Device();?></b></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Visitors -->
                <!-- Latest Social Trends -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-cyan">
                            <div class="sparkline_conteudo">
                                CONTROLE DE ACESSO:
                            </div>	
                            <ul class="dashboard-stat-list animated flipInX">
							    <li>
                                    CPF USUÁRIO LOGADO: 
                                    <span class="pull-right"><b><?php echo $cpfLogado?></b></span>
                                </li>
                                <li>
                                    DATA ULTIMO LOGIN: 
                                    <span class="pull-right"><b><?php echo $data_ultimo_login = date("d/m/Y H:i:s",strtotime($dataacessoLogado));?></b></span>
                                </li>
                                <li>
                                    DATA ULTIMO LOGOUT: 
                                    <span class="pull-right"><b><?php echo $data_ultimo_login = date("d/m/Y H:i:s",strtotime($datasaidaLogado)); ?></b></span>
                                </li>
                                <li>
                                    TEMPO DE CONEXÃO: 
                                    <span class="pull-right"><b><?php printf('%02d hora(s) e %02d min', $nHoras, $nMinutos);?></b></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Latest Social Trends -->
                <!-- Answered Tickets -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal">
                           <div class="sparkline_conteudo">
                                CONTROLE DE INSCRIÇÃO:
                            </div>	
                            <ul class="dashboard-stat-list animated flipInX">
							    <li>
                                    INSCRIÇÕES PENDENTE(S) PAGAMENTO(S):
									<span class="pull-right"><b>
										<?php echo $inscricaoPendentes ?>
									</b></span>										
									
                                </li>
                                <li>
                                    INSCRIÇÕES APROVADA(S) PAGAMENTO(S): 
                                    <span class="pull-right"><b>
										<?php echo $inscricaoAprovadas ?>
									</b></span>										
								
                                </li>
                                <li>
                                    CURSOS INSCRIÇÕES ABERTAS: 
                                    <span class="pull-right"><b>
										<?php 								
											$contador=0;
										
											foreach($count as $mostra)
											{
												$cursos_dt_ter = $mostra['cursos_dt_ter'];
												$cursos_dt_ini = $mostra['cursos_dt_ini'];
												
												if((strtotime($cursos_dt_ini) >= $date_atual) and (strtotime($date_atual) <= strtotime($cursos_dt_ter)))
												{
													$contador++;
												}
											
											}
											echo @$aculmulador = $acumulador + $contador;
										?>
									</b></span>
                                </li>
                                <li>
                                    CURSOS INSCRIÇÕES ENCERRADAS: 
                                    <span class="pull-right"><b>
										<?php								
											$contador=0;
										
											foreach($count as $mostra)
											{
												$cursos_dt_ter = $mostra['cursos_dt_ter'];
												
												if(strtotime($date_atual) > strtotime($cursos_dt_ter))
												{
													$contador++;
												}			
											
											}
											echo @$aculmulador = $acumulador + $contador;
										?>
									</b></span>                                    
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Answered Tickets -->
            </div>

			<!-- FIM DADOS ACESSO USUÁRIO LOGADO -->
			
			
               
            
			<!-- INSERIR PRÓXIMAS INFORMAÇÕES -->
			
			
			<!-- Example Tab -
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> 
                                <span id="mousespeed">Loading..</span>GRÁFICOS DEMONSTRATIVOS DO TOTAL DE ALUNOS INSCRITOS EM CURSOS ATIVOS                             
                            </h2>                        
                        </div>
                        <div class="body">
                            
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
								<li role="presentation" class="active"><a href="#grafico-vertical" data-toggle="tab">GRÁFICO BARRA VERTICAL</a></li>
                            </ul>

                            
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="grafico-vertical">
								<div class="wrapper">
										<div class="h_iframe">													
											<iframe src="graficos/ejemplo4.php" frameborder="0" allowfullscreen></iframe>
										</div>					
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             -->
			 
			<!-- With Captions -->
                 <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>CALENDÁRIO DE EVENTOS</h2>                            
                        </div>                        
						<div id="carousel-example-generic_2" class="carousel slide" data-ride="carousel">							
							<div class="h_iframe">													
								<iframe src="calendario/index.html" frameborder="0" allowfullscreen></iframe>
							</div>																
						</div> 
                    </div>
				</div>
                <!-- #END# With Captions -->
				
				<!-- With Captions -->
                 <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2>GRÁFICO DE CURSO(S) ATIVO(S)</h2>                            
                        </div>                        
						<div id="carousel-example-generic_2" class="carousel slide" data-ride="carousel">							
							<div class="h_iframe">													
								<iframe src="graficos/ejemplo4.php" frameborder="0" allowfullscreen></iframe>
							</div>																
						</div> 
                    </div>
				</div>
                <!-- #END# With Captions -->
				
			 
        </div>
    </section>
</body>

<!-- Mirrored from seantheme.com/color-admin-v3.0/admin/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 Nov 2017 23:21:21 GMT -->
</html>



	    <!-- Modal Dialogs ====================================================================================================================== -->
           
            <!-- ORIENTAÇÕES PARA PAGAMENTO -->
            <div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Orientações para inscrição e pagamento do Curso</h4>
                        </div>
                        <div class="modal-body text">
							<p><center><h5 class="modal-title center">INSCRIÇÃO</h5></center></p>
						
                            <p><h5 class="modal-title center">1 - Ao acessar o Sistema de Cursos Online, será exibido ao lado esquerdo um menu vertical.</h5></p>
							<p><h5 class="modal-title center">2 - Após identificá-lo, clique no link "Inscrição Cursos / efetuar inscrição".</h5></p>
							<p><h5 class="modal-title center">3 - Feito isto, identifique o curso no qual deseja se candidatar.</h5></p>
							<p><h5 class="modal-title center">3.1 - Uma vez inscrito no curso, o candidato terá até a data de encerramento das inscrições para cancelá-la. Após isso, não será possível mais desistir da participação.</h5></p>
							<hr color="white">
							
							<p><h5 class="modal-title center"><center><strong>PAGAMENTO</strong></center></p></h5>
							<p><h5 class="modal-title center">4 - Efetuada a inscrição, clique no link "Status Inscrição" no menu lateral esquerdo.</h5></p>
							<p><h5 class="modal-title center">4.1 - Você será direcionado para a página "MEUS CURSOS INSCRITOS". Nesta página você terá a opção de imprimir o contrato e verificar detalhadamente o status da inscrição.</h5></p>
							<p><h5 class="modal-title center">4.2 - Na aba "DADOS PARA DEPÓSITO", serão exibidos os dados para que seja efetuado o depósito bancário, lembrando que no contranto também serão apresentadas essas informações.</h5></p>
							<p><h5 class="modal-title center">4.3 - Efetuado o pagamento, aguarde a aprovação de sua matricula para efetuarmos a liberação do curso.</h5></p>
                        </div>
                        <div class="modal-footer">                            
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal"><h5 class="modal-title center">FECHAR JANELA</h5></button>
                        </div>
                    </div>
                </div>
            </div>
	
	
