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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	-->
	
	<script src="js/jquery.min.js"></script>
	
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue-grey">
                            <h2>
                                CONSULTAR "LOGIN ADMIN E ALUNOS"<small>OBS: ANTES DE EXCLUIR UM LOGIN, VERIFIQUE SE ESSE LOGIN ESTÁ ASSOCIADO A ALGUMA MATRICULA. CASO SIM, EXCLUIR A MATRICULA DO ALUNO TAMBÉM</small>
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
							<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Cadastrar Administrador</button>
						</div>
                    </div>

			<div class="table-responsive">
								
		
				<br /><br />
			<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%">Foto</th>
							<th width="35%">Nome e Sobrenome</th>
							<th width="35%">CPF</th>
							<th width="35%">Email</th>
							<th width="35%">Senha</th>
							<th width="35%">Nível</th>
							<th width="35%">Status</th>
							<th width="10%">Editar</th>
							<th width="10%">Apagar</th>
						</tr>
					</thead>
				</table>
				
			</div>
		</div>

		
<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Adicionar novo Administrador</h4>
				</div>
				<div class="modal-body">
					<label>Nome e Sobrenome</label>
					<input type="text" name="login_nome" id="login_nome" class="form-control" required/>
					<br />
					<label>CPF</label>
					<input type="text" name="login_cpf" id="login_cpf" class="form-control" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" required/>					
					<br />
					<label>Gerenciador do sistema por níveis</label>
					<div class="">
					  <select name="login_nivel" id="login_nivel" class="form-control" required>
						<option value="1">ADMINISTRADOR</option>
						<option value="2">FINANCEIRO</option>
						<option value="0">ALUNO(A)</option>
					  </select>
					</div>
					<br />
					<label>E-mail</label>
					<input type="email" name="login_email" id="login_email" class="form-control" required/>
					<br />
					<label>Senha</label>
					<input type="text" name="login_senha" id="login_senha" class="form-control" required/>
					<br />					
					<label>Selecione foto do usuário</label>
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
		$('.modal-title').text("Adicionar novo Administrador");
		$('#action').val("Cadastrar Administrador");
		$('#operation').val("Add");
		$('#user_uploaded_image').html('');
	});
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"pages/crud-login/fetch.php",
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
		var login_nome = $('#login_nome').val();
		var login_nivel = $('#login_nivel').val();
		var login_cpf  = $('#login_cpf').val();
		var login_email = $('#login_email').val();
		var login_senha  = $('#login_senha').val();
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
		if(login_nome != '' && login_nivel != '' && login_cpf != '' && login_email != '' && login_senha != '')
		{
			$.ajax({
				url:"pages/crud-login/insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
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
			url:"pages/crud-login/fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');				
				$('#login_nome').val(data.login_nome);
				$('#login_nivel').val(data.login_nivel);
				$('#login_cpf').val(data.login_cpf);
				$('#login_email').val(data.login_email);
				$('#login_senha').val(data.login_senha);
				$('.modal-title').text("Editar dados login");
				$('#user_id').val(user_id);
				$('#user_uploaded_image').html(data.user_image);
				$('#action').val("Atualizar");
				$('#operation').val("Edit");
			}
		})
	});
	
	
	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		if(confirm("Deseja realmente apagar esse registro?"))
		{
			$.ajax({
				url:"pages/crud-login/delete.php",
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