<style type="text/css">		
	.h_iframe iframe {position:relative;top:30px;left:0;width:100%; height:550px;}
</style>


<?php 
include "../includes/funcao_generica.php";
include "seguranca_admin.php";

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
?>


<?php 

//Resultado do select da função "funcao_pagina_admin";

$cursos_cadastrado = retornacursosCadastrados($conexao);


date_default_timezone_set('America/Sao_Paulo'); 
								
$date_atual = date("Y-m-d");


$select = "select * from tb_cursos";
$dados = $conexao->prepare($select);	
$dados->execute();
$count = $dados->fetchAll();	

$contaAdmin = retornaTotalAdmin($conexao);
$contaFinanceiro = retornaTotalFinanceiro($conexao);
$contaAlunos = retornaTotalAlunos($conexao);
$contaTotalLogin = retornaTotalLogin($conexao);

?>


<section class="content">
        <div class="container-fluid">
		
            <!-- Widgets -->
            <div class="row clearfix">
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
                            <div class="text">CURSOS CADASTRADOS</div>
								<div class="number">
									<?php 																		echo $cursos_cadastrado ?>
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
                            <div class="text">INSCRIÇÕES ABERTAS</div>
                            <div class="number">
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
                            <div class="text">INSCRIÇÕES ENCERRADAS</div>
                            <div class="number">
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
							</div>
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
                                CONTROLE DE CADASTRADOS:
                            </div>	
                            <ul class="dashboard-stat-list animated flipInX">
							    <li>
                                    TOTAL ADMINISTRADOR:
									<span class="pull-right"><?php echo $contaAdmin ?><b>
									</b></span>										                                </li>                                <li>                                    TOTAL FINANCEIRO:                                     <span class="pull-right"><?php echo $contaFinanceiro ?><b>									</b></span>										                                </li>                                <li>                                    TOTAL USUARIOS:                                     <span class="pull-right"><b><?php echo $contaAlunos ?></b></span>                                </li>                                <li>                                   TOTAL CADASTRADOS:                                     <span class="pull-right"><b><?php echo $contaTotalLogin ?></b></span>                                                                    </li>                            </ul>                        </div>                    </div>                </div>
                <!-- #END# Answered Tickets -->
            </div>
			<!-- FIM DADOS ACESSO USUÁRIO LOGADO -->
			<!-- INSERÇÃO DO GRÁFICO -------------------------------------------------------------------------------------------------------------->			
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
						    <h2>
                                 GRÁFICO ESTATÍSTICO
                            </h2>							
                        </div>
						<div class="container-fluid">
								<div role="tabpanel" class="tab-pane fade in active" id="home"><!-- gráfico barra vertical -->
									<div class="wrapper">
										<div class="h_iframe">	
											<iframe src="grafico_financeiro/index.php" frameborder="0" allowfullscreen></iframe>
										</div>	
									</div>
								</div>
							</div>
			          </div>
                    </div>
                </div>
            </div>
			<!-- FIM GRÁFICO -->
        </div>
    </section>