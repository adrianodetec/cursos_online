<?php
	include "seguranca_admin.php";	//segurança de pagina para admin
?>

<section class="content">
        <div class="container-fluid">
           	<div class="span12">            
				<?php				
					if($nivelLogado < 1):				
						session_unset($_SESSION['usuario']);
						session_unset($_SESSION['senha']);
						header("Location: ../index.php?acao=negado");					 
					endif;			
				?>	
      		</div>
            <!-- INSERIR PRÓXIMAS INFORMAÇÕES -->				
			<!-- Exportable Table -->
			<div class="container">		
			
			<center>
				<?php 
					$curso_id = (isset($_GET['id'])) ? $_GET['id'] : '';
					
					$select = "SELECT cursos_nome FROM `tb_cursos` WHERE cursos_id = ?";
					$result = $conexao->prepare($select);
					$result->bindvalue(1, $curso_id);
					$result->execute();	
					foreach($result as $row):
				?>			
					<h1><?php echo $cursos_nome = $row['cursos_nome']; ?></h1>			
				<?php endforeach; ?>			
			</center>
			
			
			
		
			
			
            <div class="row clearfix">	
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">                       
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Nome aluno</th>                                            											
											<th>Matricula</th>
                                            <th>CPF</th>
                                            <th>Data matricula</th>
											<th>Total vagas</th>
											<th>Total inscritos</th>
											<th>Ver</th>
                                            <th>Editar</th>
                                            <th>Deletar</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
										<tr>
                                            <th>Nome aluno</th>                                            											
											<th>Matricula</th>
                                            <th>CPF</th>
                                            <th>Data matricula</th>
											<th>Total vagas</th>
											<th>Total inscritos</th>
											<th>Ver</th>
                                            <th>Editar</th>
                                            <th>Deletar</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php
									$curso_id = (isset($_GET['id'])) ? $_GET['id'] : '';																	
									$select = "SELECT tb_alunos.aluno_nome,tb_alunos.aluno_cpf, tb_matricula.matricula_id,tb_matricula.data_matricula FROM tb_alunos INNER JOIN tb_matricula ON tb_alunos.aluno_id = tb_matricula.matricula_aluno_id and matricula_curso_id = ?";
									$result = $conexao->prepare($select);
									$result->bindvalue(1,$curso_id); 
									$result->execute();
									foreach($result as $row):
										$ano = gmdate("Y");
										$nome_aluno         = $row['aluno_nome'];
										$nome_cpf           = $row['aluno_cpf'];
										$matricula_id       = $row['matricula_id'];
										$data_matricula     = $row['data_matricula'];
									?>					
									<tr class="converte_maiuscula">
										<td><?php echo $nome_aluno ?></td>                                            											
										<td><?php echo $matricula_id ?>/<?php echo $ano ?></td>
										<td><?php echo $nome_cpf ?></td>
										<td><?php echo $data_matricula ?></td>
										<td></td>
										<td>												
										</td>											
										<td></td>                                   
										<td></td>
										<td></td>
									</tr>										
									<?php endforeach; ?>																	
                                    </tbody>
                                </table>						
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->                
            <!-- #END# PROXIMAS INFORMAÇÕES -->			
            </div>
        </div>
    </section>
	

