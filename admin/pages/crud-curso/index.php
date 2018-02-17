<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}
</script>

<section class="content">
    <div class="container-fluid">

<!--
	<script src="js/jquery.min.js"></script>
-->
	
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue-grey">
                            <h2>
                                GERENCIAMENTO DE CURSOS/ALUNOS INSCRITOS<small>Abaixo será exibido a relação de cursos ativo e não ativo e os alunos inscritos...</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="../images/logo.png" width="50">
                                    </a>
                                </li>                             
                            </ul>
                        </div>
						
						<?php if($nivelLogado == 2 || $nivelLogado == 0)
						{							
							echo "";							
						}
						else{
						?>
						<div align="right">
							<button type="button" id="add_button" data-toggle="modal" data-target="#largeModal" class="btn btn-info btn-lg">Adicionar novo curso</button>
						</div>
						<?php } ?>
                    </div>

			<div class="table-responsive">
								
		
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%">Foto</th>
							<th width="35%">Nome Curso</th>
							<th width="35%">Status Inscrições</th>
							<th width="35%">Carga Horária</th>
							<th width="35%">Inicio Inscrições</th>
							<th width="35%">Encerramento Inscrições</th>
							<th width="35%">Total Vagas</th>
							<th width="35%">Total Inscritos</th>
							<th width="10%">Ver</th>
							
							<?php if($nivelLogado == 2 || $nivelLogado == 0)
								{							
									echo "";							
								}
								else{ ?>
							
							
							<th width="10%">Editar</th>
							<th width="10%">Apagar</th>
							
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
					<label>Nome Curso</label>
					<input type="text" name="cursos_nome" id="cursos_nome" class="form-control" required/>
					<br />
					<label>Valor do Curso</label>
					<input type="number" name="cursos_valor" id="cursos_valor" class="form-control" required/>
					<br />
					<label>Carga Horária</label>
					<input type="number" name="cursos_carg_hr" id="cursos_carg_hr" class="form-control" required/>
					<br />
					<label>Inicio Inscrições</label>
					<input type="date" name="cursos_dt_ini" id="cursos_dt_ini" class="form-control" required/>
					<br />
					<label>Encerramento Inscrições</label>
					<input type="date" name="cursos_dt_ter" id="cursos_dt_ter" class="form-control" required/>
					<br />
					<label>Total Vagas</label>
					<input type="number" name="cursos_qt_alunos" id="cursos_qt_alunos" class="form-control" required/>
					<br />
					<label>Selecione banner do curso</label>
					<input type="file" name="user_image" id="user_image" />
					<span id="user_uploaded_image"></span>
				</div>
				
				<div class="modal-footer">
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
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
		$('#action').val("Cadastrar Curso");
		$('#operation').val("Add");
		$('#user_uploaded_image').html('');
	});
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			"url":"pages/crud-curso/fetch.php",
			"type":"POST"
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
		var cursos_nome = $('#cursos_nome').val();
		var valor_curso = $('#cursos_valor').val();
		var cursos_descricao  = $('#cursos_descricao').val();
		var cursos_carg_hr = $('#cursos_carg_hr').val();
		var cursos_dt_ini  = $('#cursos_dt_ini').val();
		var cursos_dt_ter  = $('#cursos_dt_ter').val();
		var cursos_qt_alunos  = $('#cursos_qt_alunos').val();
		var extension = $('#user_image').val().split('.').pop().toLowerCase();
		if(extension != '')
		{
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
			{
				alert("Extensão de imagem não aceita");
				$('#user_image').val('');
				return false;
			}
		}	
		if(cursos_nome != '' && cursos_carg_hr != '' && cursos_dt_ini != '')
		{
			$.ajax({
				url:"pages/crud-curso/insert.php",
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
			url:"pages/crud-curso/fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#largeModal').modal('show');				
				$('#cursos_nome').val(data.cursos_nome);
				$('#cursos_valor').val(data.cursos_valor);
				$('#cursos_descricao').val(data.cursos_descricao);
				$('#cursos_carg_hr').val(data.cursos_carg_hr);
				$('#cursos_dt_ini').val(data.cursos_dt_ini);
				$('#cursos_dt_ter').val(data.cursos_dt_ter);
				$('#cursos_qt_alunos').val(data.cursos_qt_alunos);
				$('.modal-title').text("Alterar dados do curso");
				$('#user_id').val(user_id);
				$('#user_uploaded_image').html(data.user_image);
				$('#action').val("Alterar Dados Curso");
				$('#operation').val("Edit");
			}
		})
	});
	
	
	
	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		if(confirm("Deseja realmente apagar esse registro?"))
		{
			$.ajax({
				url:"pages/crud-curso/delete.php",
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