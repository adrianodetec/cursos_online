<?php
	include "seguranca_admin.php";	//segurança de pagina para admin
?>

<section class="content">
<div class="container-fluid">
<!----------------------------------- FUNÇÃO PARA CADASTRAR DADOS ALUNO -------------------------------------------------------------->

<?php
// Verifica se foi solicitada a inclusão de dados
		    if(isset($_POST['logar'])):
								
				 $cursos_nome        = $_POST['cursos_nome'];
                 $cursos_descricao   = $_POST['cursos_descricao'];
                 $cursos_carg_hr     = $_POST['cursos_carg_hr'];
				 $date_inicial       = $_POST['cursos_dt_ini'];
				 $date_final         = $_POST['cursos_dt_ter'];	
				 
				// De BR para EN -- converto data inicial para padrao americano
				$data_ini = $date_inicial;
				$data_inicial_ok = preg_replace('/^(\d{2})\/(\d{2})\/(\d{4})$/', '$3-$2-$1', $data_ini);
				
				// De BR para EN -- converto data inicial para padrao americano
				$data_fin = $date_final;
				$data_final_ok = preg_replace('/^(\d{2})\/(\d{2})\/(\d{4})$/', '$3-$2-$1', $data_fin);				
                
                 $cursos_qt_alunos   = $_POST['cursos_qt_alunos'];
                 @$foto_atual         = $_POST['foto'];           	
				
			
				$nome_foto = 'padrao.jpg';
				if(isset($_FILES['foto']) && $_FILES['foto']['size'] > 0): 
					$extensoes_aceitas = array('bmp' ,'png', 'svg', 'jpeg', 'jpg');
					$extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));
					 // Validamos se a extensão do arquivo é aceita
					if (array_search($extensao, $extensoes_aceitas) === false):
					   echo "<h1>Extensão Inválida!</h1>";
					   exit;
					endif;	 
					 // Verifica se o upload foi enviado via POST   
					if(is_uploaded_file($_FILES['foto']['tmp_name'])): 							 
						  // Verifica se o diretório de destino existe, senão existir cria o diretório  
						  if(!file_exists("fotos")):  
							   mkdir("fotos");  
						  endif; 				  
						  // Monta o caminho de destino com o nome do arquivo  
						  $nome_foto = date('dmY') . '_' . $_FILES['foto']['name'];  							
						  // Essa função move_uploaded_file() copia e verifica se o arquivo enviado foi copiado com sucesso para o destino  
						  if (!move_uploaded_file($_FILES['foto']['tmp_name'], 'fotos/'.$nome_foto)):  
							   echo "Houve um erro ao gravar arquivo na pasta de destino!";  
						  endif;  
					endif;  
				endif;

				$sql = 'INSERT INTO tb_cursos (cursos_nome, cursos_descricao, cursos_carg_hr, cursos_dt_ini, cursos_dt_ter, cursos_qt_alunos, foto)
								   VALUES(?, ?, ?, ?, ?, ?, ?)';
				$stm = $conexao->prepare($sql);
				$stm->bindValue(1, $cursos_nome);
				$stm->bindValue(2, $cursos_descricao);
				$stm->bindValue(3, $cursos_carg_hr);
				$stm->bindValue(4, $data_inicial_ok);
				$stm->bindValue(5, $data_final_ok);
				$stm->bindValue(6, $cursos_qt_alunos);
				$stm->bindValue(7, $nome_foto);				
				$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao inserir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=home.php?acao=admin'>";
		endif;
?>

            <!----------------------------------- FIM FUNÇÃO PARA CADASTRAR DADOS ALUNO -------------------------------------------------------------->

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>CADASTRAR NOVO CURSO</h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" action="" enctype='multipart/form-data'>	
								
								<div class="alert alert-info">
									<small><a href="javascript:void(0);" class="alert-link"> DADOS CURSOS </a></small>
								</div>						
								<div class="card body table-responsive table table-bordered">	
							
									<div class="row">
										<label for="nome">Selecionar Foto</label>
											<div class="col-md-2">
												<a href="#" class="thumbnail">
													<img src="fotos/padrao.jpg" height="190" width="150" id="foto-cliente">
												</a>
											</div>
										<input type="file" name="foto" id="foto" value="foto" >
									</div>
								
								
									<div class="form-group form-float"><!-- DADOS PARA CPF PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control" name="cursos_nome" id="cursos_nome" required>
											<label class="form-label">TITULO DO CURSO:</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control converte_maiuscula" id="cursos_descricao" name="cursos_descricao"required>
											<label class="form-label">DESCRIÇÃO DO CURSO</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- EMAIL JA VINDO DO LOIN DESABILITADO P/ PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="number" class="form-control" id="cursos_carg_hr" name="cursos_carg_hr" required>
											<label class="form-label">CARGA HORÁRIA DO CURSO: </label>
										</div>
									</div>
									
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control" id="cursos_dt_ini" name="cursos_dt_ini" data-inputmask="'mask' : '9999/99/99'" required>
											<label class="form-label">DATA INÍCIO CURSO</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="text" class="form-control"  id="cursos_dt_ter" name="cursos_dt_ter" data-inputmask="'mask' : '9999/99/99 23:59:59'" required>
											<label class="form-label">DATA TÉRMINO CURSO</label>
										</div>
									</div>
									<div class="form-group form-float"><!-- DADOS PARA NOME COMPLETO PRÉ MATRICULA ------>
										<div class="form-line">
											<input type="number" class="form-control converte_maiuscula" id="cursos_qt_alunos" name="cursos_qt_alunos" required>
											<label class="form-label">QUANTIDADE MÁXIMA DE ALUNOS PERMITIDO NESSE CURSO</label>
										</div>
									</div>							
									<button class="btn btn-primary waves-effect"  name="logar" type="submit" data-type="success">CADASTRAR CURSO</button>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>	
	<script type="text/javascript" src="js/custom.js"></script>



