<?php
	include "seguranca_admin.php";	//segurança de pagina para admin
?>

<section class="content">
        <div class="container-fluid">
           	<div class="span12">			
				<!-- Caso seja acionado o botão de deletar, executa o script de deletar dados -->
				<?php 
					$login_id = (isset($_GET['deletar'])) ? $_GET['deletar'] : ''; //aqui eu recupero o valor vindo da url para fazer a exclusão
						
					// Verifica se foi solicitada a exclusão dos dados
					if (isset($_GET['deletar'])):					
						$retorno = cancelar_Login($conexao, $login_id);
						if ($retorno):
							echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, limpando dados do banco... aguarde aguarde um momento ...</div> ";
						else:
							echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div> ";
						endif;
						echo "<meta http-equiv=refresh content='3;URL=home.php?acao=crud-login'>";					
					endif;
				?>
			</div>
            <div class="row clearfix"><a href='home.php?acao=cad-novo-curso' class="btn btn-success pull-right">Cadastrar novo login</a>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
											<th>CPF</th>
                                            <th>Email</th>
                                            <th>Senha</th>
											<th>Nível</th>
											<th>Status</th>                                           
                                            <th>Editar</th>
                                            <th>Deletar</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
										    <th>Nome</th>
											<th>CPF</th>
                                            <th>Email</th>
                                            <th>Senha</th>
											<th>Nível</th>
											<th>Status</th>                                            
                                            <th>Editar</th>
                                            <th>Deletar</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php									
									$select = $conexao->query("SELECT login_id, login_nome, login_cpf, login_email, login_senha, login_nivel, login_status FROM tb_login");
									
									$result = $select->fetchAll();
									
									foreach($result as $row):
										$login_id   = $row['login_id'];									
										$nome       = $row['login_nome'];
										$cpf        = $row['login_cpf'];
										$email      = $row['login_email'];
										$senha      = $row['login_senha'];
										$nivel      = $row['login_nivel'];
                                        $status     = $row['login_status'];	 								
										
									?>
                                        <tr class="converte_maiuscula">
                                            <td><?php echo $nome ?></td>
											<td><?php echo $cpf ?></td>
                                            <td><?php echo $email ?></td>
                                            <td><?php echo $senha ?></td>
											<td><?php if($nivel == 1): echo "Admin"; else: echo "Aluno"; endif ?></td>
											<td><?php if($status == 1): echo "Ativo"; else: echo "Inativo"; endif ?></td>                                                                               
                                            <td><a href='home.php?acao=editar-login&id=<?php echo $login_id ?>'><button type="button" class="btn bg-orange waves-effect">Editar</button></a></td>
                                            <td><a onclick="return confirm ('Deseja realmente apagar os dados?')" href='home.php?acao=crud-login&deletar=<?php echo $login_id ?>'><button type="button" class="btn bg-pink waves-effect" id='btn-apagar'>Deletar</button></a></td>
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
