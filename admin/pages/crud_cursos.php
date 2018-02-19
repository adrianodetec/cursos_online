<?php
	include "seguranca_admin.php";	//segurança de pagina para admin
?>

<section class="content">
        <div class="container-fluid">
           	<div class="span12">
				<?php
				$cursos_id = (isset($_GET['cursos_id'])) ? $_GET['cursos_id'] : ''; //aqui eu recupero o valor vindo da url para fazer a exclusão				
					// Verifica se foi solicitada a exclusão dos dados
					if (isset($_GET['cursos_id'])):	
						
						// Captura o nome da foto para excluir da pasta
						$sql = "SELECT foto FROM tb_cursos WHERE cursos_id = ? AND foto <> 'padrao.jpg'";
						$stm = $conexao->prepare($sql);
						$stm->bindValue(1, $cursos_id);
						$stm->execute();
						$cursos = $stm->fetch(PDO::FETCH_OBJ);

						if (!empty($cursos) && file_exists('fotos/'.$cursos->foto)):
							unlink("fotos/" . $cursos->foto);
						endif;

						// Exclui o registro do banco de dados
						$sql = 'DELETE FROM tb_cursos WHERE cursos_id = ?';
						$stm = $conexao->prepare($sql);
						$stm->bindValue(1, $cursos_id);
						$retorno = $stm->execute();

						if ($retorno):
							echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, limpando dados do banco... aguarde aguarde um momento ...</div> ";
						else:
							echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div> ";
						endif;
						echo "<meta http-equiv=refresh content='3;URL=home.php?acao=crud-cursos'>";
						
					else:				
						echo "OBS: nao sera possivel excluir o curso enquanto tiver alunos cadastrados";					
					endif;
				?>
      		</div>
            <div class="row clearfix"><a href='home.php?acao=cad-novo-curso' class="btn btn-success pull-right">Cadastrar curso</a>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">                       
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Nome curso</th>                                            											
											<th>Cara horária</th>
                                            <th>Data início</th>
                                            <th>Data término</th>
											<th>Status Inscrições</th>
											<th>Total vagas</th>
											<th>Total inscritos</th>
											<th>Ver</th>
                                            <th>Editar</th>
                                            <th>Deletar</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
										<tr>
                                            <th>Nome curso</th>                                            											
											<th>Cara horária</th>
                                            <th>Data início</th>
                                            <th>Data término</th>
											<th>Status Inscrições</th>
											<th>Total vagas</th>
											<th>Total inscritos</th>
											<th>Ver</th>
                                            <th>Editar</th>
                                            <th>Deletar</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php									
									$select = $conexao->query("SELECT * FROM tb_cursos");
									$result = $select->fetchAll();
									foreach($result as $row):
										$cursos_id           = $row['cursos_id'];									
										$cursos_nome         = $row['cursos_nome'];
										$cusos_descricao     = $row['cursos_descricao'];										
										$cursos_carg_hr      = $row['cursos_carg_hr'];
										$cursos_dt_ini       = $row['cursos_dt_ini'];
										$cursos_dt_ter       = $row['cursos_dt_ter'];
										$vagas               = $row['cursos_qt_alunos'];
									?>									
                                        <tr class="converte_maiuscula">
                                            <td><?php echo $cursos_nome ?></td>                                            											
											<td><?php echo $cursos_carg_hr ?></td>
                                            <td><?php echo $cursos_dt_ini ?></td>
											<td><?php echo $cursos_dt_ter ?></td>
											
											<td>											
											<?php
												//Pego a minha data atual paa verificação de encerramento de curso. 
												@$timestamp = mktime(date("H")-4, date("i"), date("s"), date("m"), date("d"), date("Y"), 0);
												@$data_hora_atual = gmdate("Y-m-d H:i:s", $timestamp);
												
												if($data_hora_atual > $cursos_dt_ter)
												{
													echo "Encerrada";
												}
												else
												{
													echo "Abertas";
												}												
											?>
											</td>
											<td><?php echo $vagas ?></td>
											<td>
												<?php 
													$select = "SELECT matricula_id FROM tb_matricula where matricula_curso_id = ?";	
													$result = $conexao->prepare($select);
													$result->bindValue(1, $cursos_id );													
													$result->execute();													
													echo $contar = $result->rowCount();
												?>
											</td>											
                                            <td ><a href='home.php?acao=turmas-alunos&id=<?php echo $cursos_id ?>'><button type="button" class="btn btn-success js-modal-buttons">Ver</button></a></td>                                   
                                            <td><a href='home.php?acao=editar-cursos&id=<?php echo $cursos_id ?>'><button type="button" class="btn bg-orange waves-effect">Editar</button></a></td>
                                            <td><a onclick="return confirm ('Deseja realmente apagar os dados?')" href='home.php?acao=crud-cursos&cursos_id=<?php echo $cursos_id ?>'><button type="button" class="btn bg-pink waves-effect" <?php if($contar >= 1): echo "disabled"; endif ?>>Deletar</button></a></td>
                                        </tr>										
									<?php endforeach; ?>																	
                                    </tbody>
                                </table>						
                            </div>
                        </div>
                    </div>
                </div>
            </div>		
		</div>
	</div>
</section>
	

