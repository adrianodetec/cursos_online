
<?php 
	
	include "funcao_status_pg.php";	
	
	$curso_id = (isset($_GET['id'])) ? $_GET['id'] : '';
		
	$select = "SELECT * FROM `tb_cursos` WHERE cursos_id = ?";
	$result = $conexao->prepare($select);
	$result->bindvalue(1, $curso_id);
	$result->execute();
		
	foreach($result as $row):
	$cursos_nome = $row['cursos_nome'];
	$total_vagas = $row['cursos_qt_alunos'];
	$qt_alunos_inscritos = $row['cursos_qt_inscritos'];
	$valor_curso = $row['cursos_valor'];
	endforeach;
	
	@session_start();
	
	$_SESSION['id_curso'] = $curso_id;
			
	
	$pendentes  = retornaPendente($curso_id, $conexao);
	
	$PGaprovado = retornaPGaprovado($curso_id, $conexao);
		
	$valorArrecadado = totalPGpago($PGaprovado, $conexao, $valor_curso);
		
	$porcentagemPagos = porcentagemPGpago($PGaprovado, $conexao, $valor_curso);
	
	$valorPendente = totalPGpendente($pendentes, $conexao, $valor_curso);
	
	$totalInscritos = retornaTotalInscritos($curso_id, $conexao);
	
	$porcentagemPendentes = porcentagem_total($pendentes, $totalInscritos);
	
	$porcentagemPGaprovados = porcentagem_total($PGaprovado, $totalInscritos);
	
?>			
								
	
<section class="content">
    <div class="container-fluid">

	
	<!--
	
	<script src="js/jquery.min.js"></script>
	
	-->
	
	
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue-grey">
                            <h2>
                                <center><h1><?php echo $cursos_nome; ?></h1></center><small>Abaixo será exibido a relação de cursos ativo e não ativo e os alunos inscritos...</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="../images/logo.png" width="50">
                                    </a>
                                </li>                             
                            </ul>
                        </div>
						<div align="right">
							<a href="home.php?acao=crud-turma"><button type="button" id="add_button"  class="btn btn-info btn-lg">Voltar página anterior</button></a>
						</div>						
                    </div>					
					
					
						<!-- Chart Samples -->
		<div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">people</i>
                        </div>
                        <div class="content">
                            <div class="text">ALUNOS QUE PAGARAM</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $PGaprovado ?>" data-speed="1000" data-fresh-interval="20"><?php echo $PGaprovado ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red">
                        <div class="icon">
                            <i class="material-icons">people</i>
                        </div>
                        <div class="content">
                            <div class="text">ALUNOS NÃO PAGARAM</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $pendentes ?>" data-speed="1000" data-fresh-interval="20"><?php echo $pendentes ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-purple">
                        <div class="icon">
                            <i class="material-icons">people</i>
                        </div>
                        <div class="content">
                            <div class="text">ALUNOS INSCRITOS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $totalInscritos ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-deep-purple">
                        <div class="icon">
                            <i class="material-icons">thumb_up</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL VAGAS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total_vagas ?>" data-speed="1500" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Counter Examples -->
					
					
					
					
					
					
					
					<!-- Start Widget -->
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow">
                                    <span class="mini-stat-icon bg-success"><i class="ion-social-usd"></i></span>
                                    
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase">PG APROVADO(S)<span class="pull-right"><?php echo $porcentagemPGaprovados ?>%</span></h5>
											<div class="progress">
												<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0"
													aria-valuemax="100" style="width: <?php echo $porcentagemPGaprovados ?>%">
													<span class="sr-only">40% Complete (success)</span>
												</div>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow">
                                    <span class="mini-stat-icon bg-info"><i class="ion-ios7-cart"></i></span>
                                   
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase">PG PENDENTE(S)<span class="pull-right"><?php echo $porcentagemPendentes ?>%</span></h5>
											<div class="progress">
												<div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="80" aria-valuemin="0"
													aria-valuemax="100" style="width: <?php echo $porcentagemPendentes ?>%">
													<span class="sr-only">80% Complete (danger)</span>
												</div>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow">
                                    <span class="mini-stat-icon bg-purple"><i class="ion-eye"></i></span>
                                    
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase">TOTAL ARRECADADO<span class="pull-right"><?php echo $valorArrecadado ?></span></h5>
											<div class="progress">
												<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0"
													aria-valuemax="100" style="width: <?php echo $porcentagemPGaprovados?>%">
													<span class="sr-only">20% Complete</span>
												</div>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow">
                                    <span class="mini-stat-icon bg-pink"><i class="ion-android-contacts"></i></span>
                                    
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase">TOTAL PENDENTE<span class="pull-right"><?php echo $valorPendente ?></span></h5>
											<div class="progress">
												<div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0"
													aria-valuemax="100" style="width: <?php echo $porcentagemPendentes ?>%">
													<span class="sr-only">60% Complete (warning)</span>
												</div>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <!-- End row-->
						<div class="row">
							<div class="col-md-12 col-sm-12 col-lg-12">
								<div class="mini-stat clearfix bx-shadow">
									<span class="mini-stat-icon bg-pink"><i class="ion-android-contacts"></i></span>
									
									<div class="tiles-progress">
										<div class="m-t-10">
											<h5 class="text-uppercase">ALUNOS INSCRITOS / VAGAS<span class="pull-right"><?php echo $totalInscritos ?> / <?php echo $total_vagas ?></span></h5>
											<div class="progress">
												<div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0"
													aria-valuemax="100" style="width: <?php echo $totalInscritos ?>%">
													<span class="sr-only">60% Complete (warning)</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
			
						
			
				<?php
				
				$conta_linhas = retornaTotalInscritos($curso_id, $conexao); // Verifico se existe aluno cadastrado no curso
				
				if($conta_linhas > 0)
				{
				?>
				
				<?php if($nivelLogado  == '1' || $nivelLogado  == '3')
				{					
				?>
				
				
				<table>
				<tr>
				<td><div align="left">
				   <a href="pages/crud-pg-curso/relatorio/relatorio.php?id=<?php echo $curso_id ?>" class="fancybox" data-fancybox-type="iframe">
				   <button type="button" class="btn bg-red waves-effect" name="enviar">																
						<i class="material-icons">print</i>
						<span>IMPRIMIR RELATÓRIO INSCRITOS</span>																
					</button>
					</a>
				</div>
				</td>
				
				<td>
				<div align="right">
				   <a href="pages/crud-pg-curso/relatorio/relatorio-financeiro.php?id=<?php echo $curso_id ?>" class="fancybox" data-fancybox-type="iframe">
				   <button type="button" class="btn bg-red waves-effect" name="enviar">																
						<i class="material-icons">print</i>
						<span>IMPRIMIR RELATÓRIO FINANCEIRO</span>																
					</button>
					</a>
				</div>
				</td>
				<td>
				<div align="right">
				   <a href="pages/crud-pg-curso/relatorio/relatorio-aprovados.php?id=<?php echo $curso_id ?>" class="fancybox" data-fancybox-type="iframe">
				   <button type="button" class="btn bg-red waves-effect" name="enviar">																
						<i class="material-icons">print</i>
						<span>IMPRIMIR RELATÓRIO APROVADOS</span>																
					</button>
					</a>
				</div>
				</td>
				</tr>
				</table>
				
				
				<?php }else{ ?>
				
				
				<div align="left">
				   <a href="pages/crud-pg-curso/relatorio/relatorio-financeiro.php?id=<?php echo $curso_id ?>" class="fancybox" data-fancybox-type="iframe">
				   <button type="button" class="btn bg-red waves-effect" name="enviar">																
						<i class="material-icons">print</i>
						<span>IMPRIMIR RELATÓRIO FINANCEIRO</span>																
					</button>
					</a>
				</div>
				
				
				<?php }}?>				
							
				
			
			<div class="table-responsive">		
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%" valign="middle">Comprovante</th>					
							<th width="25%" valign="middle">Nome Aluno</th>
							<th width="10%" valign="middle">CPF</th>
							<th width="12%" valign="middle">Nº Matricula</th>
							<th width="15%" valign="middle">Data Matricula</th>
							<th width="15%" valign="middle">Status Pagamento</th>
							<th width="10%" valign="middle">Data Pagamento</th>
							<th width="10%" valign="middle">Pagamento</th>
							<?php if($nivelLogado == 2 || $nivelLogado == 0 || $nivelLogado == 3)
								{							
									echo "";							
								}
								else{ ?>
							<th width="10%" valign="middle">Deletar Matricula</th>
								<?php } ?>
						</tr>
					</thead>
				</table>				
			</div>
		</div>

	
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cadastrar novo curso</h4>
				</div>
												
				
				<div class="modal-body">
					
						<?php				
							//CASO SEJA FINANEIRO NÃO PODERA INFORMAR, SOMENTE O DENSE
							if($nivelLogado == 3)
							{
								echo "
									<div align='center' style=color:magenta'> Olá, $nomeLogado! Por favor, preencha os ítens abaixo</div>
									<hr>
									<label>1 - Informe a data do pagamento efetuada pelo aluno</label>
									<input type='date' name='data_pg' id='data_pg' class='form-control' required/>
									<br />
																		
									<label>2 - Anexar comprovante de pagamento</label>
									<input type='file' name='user_image' id='user_image' />
									<span id='user_uploaded_image' style='display:none'></span>

									<div style='display:none'>
										<select name='matricula_status_pg' id='matricula_status_pg' class='form-control' required>
										<option value='PENDENTE'>PENDENTE</option>
										<option value='PAGAMENTO APROVADO'>PAGAMENTO APROVADO</option>					
										</select>
									</div>
								  ";
							}
							//CASO SEJA FINANEIRO NÃO PODERA INFORMAR, SOMENTE O DENSE
							elseif($nivelLogado == 1)
							{
								echo "
									<div align='center' style=color:magenta'> Olá, $nomeLogado! Por favor, preencha os ítens abaixo</div>
									<hr>
									<label>1 - Informe a data do pagamento efetuada pelo aluno</label>
									<input type='date' name='data_pg' id='data_pg' class='form-control' required/>
									<br />
																		
									<label>2 - Anexar comprovante de pagamento</label>
									<input type='file' name='user_image' id='user_image' />
									<span id='user_uploaded_image' style='display:none'></span>
									<br>
									<div>
										<label>3 - Selecione o status de pagamento</label>
										<select name='matricula_status_pg' id='matricula_status_pg' class='form-control' required>
										<option value='PENDENTE'>PENDENTE</option>
										<option value='PAGAMENTO APROVADO'>PAGAMENTO APROVADO</option>					
										</select>
									</div>
								  ";
							}
							else
							{	
								echo "
									<div style='display:none'>
										<label>Informar data do pagamento</label>
										<input type='date' name='data_pg' id='data_pg' class='form-control' required/>
										<br />
										<label>Status do pagamento</label>
										
										<label>Anexar comprovante de pagamento</label>
										<input type='file' name='user_image' id='user_image' />
										<span id='user_uploaded_image'></span>									
									</div>
									

									<div class=''>
									
									<div align='center' style=color:magenta'> Olá, $nomeLogado! Por favor, verifique se o dinheiro foi depositado. Caso sim, APROVAR O PAGAMENTO</br></div>
									
									<hr>
									<select name='matricula_status_pg' id='matricula_status_pg' class='form-control' required>
									<option value='PENDENTE'>PENDENTE</option>
									<option value='PAGAMENTO APROVADO'>PAGAMENTO APROVADO</option>					
									</select>
									</div>

									
								  ";
							}
						?>
				
				
				<div class="modal-footer">
					<input type="hidden" name="curso_id" id="curso_id" />
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Alterar data pagamento" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</form>
	</div>
</div>

</div>
</section>


<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Cadastrar novo curso");
		$('#action').val("Add2");
		$('#operation').val("Add");
		$('#user_uploaded_image').html('');
	});
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"pages/crud-pg-curso/fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":false,
			},
		],

	});

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var data_pg = $('#data_pg').val();
		var matricula_status_pg  = $('#matricula_status_pg').val();		
		var extension = $('#user_image').val().split('.').pop().toLowerCase();
		if(extension != '')
		{
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg', 'pdf']) == -1)
			{
				alert("Extensão não aceita");
				$('#user_image').val('');
				return false;
			}
		}	
		if(data_pg != '' && matricula_status_pg != '')
		{
			$.ajax({
				url:"pages/crud-pg-curso/insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#largeModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Todos os campos são obrigatórios");
		}
	});
	
		
	
	
	$(document).on('click', '.update', function(){
		var user_id = $(this).attr("id");
		$.ajax({
			url:"pages/crud-pg-curso/fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#largeModal').modal('show');				
				$('#data_pg').val(data.data_pg);
				$('#matricula_status_pg').val(data.matricula_status_pg);				
				$('.modal-title').text("Autorizar dados pagamento do aluno");
				$('#user_id').val(user_id);
				$('#user_uploaded_image').html(data.user_image);
				$('#action').val("Cadastrar Pagamento");
				$('#operation').val("Edit");
			}
		})
	});
	
	
	
	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		if(confirm("Deseja realmente apagar essa Matricula?"))
		{
			$.ajax({
				url:"pages/crud-pg-curso/delete.php",
				method:"POST",
				data:{user_id:user_id},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
	
});
</script>