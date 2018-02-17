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
        <?php 		
		
		$alunos_id = (isset($_GET['id'])) ? $_GET['id'] : ''; //aqui eu recupero o valor vindo da url para fazer a exclusão
		
		// Verifica se foi solicitada a exclusão dos dados
		if (isset($_GET['id'])):				

			// Exclui o registro do banco de dados
			$sql = 'DELETE FROM tb_alunos WHERE aluno_id = ?';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(1, $alunos_id);
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, limpando dados do banco... aguarde aguarde um momento ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=home.php?acao=crud-alunos'>";
		endif;		
		?>
                <!-- INSERIR PRÓXIMAS INFORMAÇÕES -->
				
				 <!-- Exportable Table -->
            <div class="row clearfix">
			<div class='clearfix'>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
                        <div class="header bg-blue-grey">
                            <h2>
                                GERENCIAR ALUNOS CADASTRADOS NO SISTEMA<small>Abaixo será exibido a relação de alunos cadastrados no Sistema...</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <a href="javascript:void(0);">
                                        <i class="material-icons">mic</i>
                                    </a>
                                </li>                                
                            </ul>
                        </div>
						<div align="right">
							<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Adicionar novo admnistrador</button>
						</div>
                    </div>
				                      
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>CPF</th>											
											<th>Email</th>
                                            <th>Profissão</th>
                                            <th>Ver</th>                                            
                                            <th>Deletar</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nome</th>
                                            <th>CPF</th>											
											<th>Email</th>
                                            <th>Profissão</th>
                                            <th>Ver</th>                                            
                                            <th>Deletar</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php									
									$select = $conexao->query("SELECT aluno_id, aluno_nome, aluno_cpf, aluno_profissao, aluno_email FROM tb_alunos");
									$result = $select->fetchAll();
									foreach($result as $row):
										$alunos_id   = $row['aluno_id'];
										$nome        = $row['aluno_nome'];
										$cpf         = $row['aluno_cpf'];										
										$email       = $row['aluno_email'];
										$profissao   = $row['aluno_profissao'];									
									?>
                                        <tr>
                                            <td><?php echo $nome ?></td>
                                            <td><?php echo $cpf ?></td>											
											<td><?php echo $email ?></td>
                                            <td><?php echo $profissao ?></td>
                                            <td><button type="button" class="btn btn-success waves-effect">Ver</button></td>
                                            <td><a onclick="return confirm ('Deseja realmente apagar os dados?')" href='home.php?acao=crud-alunos&id=<?php echo $alunos_id ?>'><button type="button" class="btn bg-pink waves-effect">Deletar</button></a></td>
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
