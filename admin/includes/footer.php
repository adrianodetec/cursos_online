<!-- PAGINA INICIAL PARA ALUNOS ------------------------------------------------------------------------------------------------------------>

<?php
	if(isset($_GET['acao']))
	{
		$acao = $_GET['acao'];
		if($acao=='welcome')
		{
			
?>	

<script src="../js/pages/ui/modals.js"></script><!-- janela modal -->  
<script src="../plugins/bootstrap/js/bootstrap.js"></script><!-- Bootstrap Core Js -->    
<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script><!-- Select Plugin Js -->    
<script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script><!-- Slimscroll Plugin Js -->    
<script src="../plugins/node-waves/waves.js"></script><!-- Waves Effect Plugin Js -->	 
<script src="../js/demo.js"></script><!-- Demo Js -->
<!-- Sparkline Plugin Js -->
<script src="../plugins/jquery-sparkline/jquery.sparkline.js"></script>
<script src="../js/pages/charts/sparkline.js"></script>	 
<script src="../js/admin.js"></script><!-- Custom Js -->
	
	
<!-- PAGINA INICIAL PARA PÁGINA ADMIN E FINANCEIRO  ----------------------------------------------------------------------------------------------->	

<?php
}elseif($acao=='admin' || $acao=='financeiro'){	
?>  


    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>
    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>
    <!-- Chart Plugins Js -->
	<!-- Demo Js -->
    <script src="../js/demo.js"></script>
    <script src="../plugins/chartjs/Chart.bundle.js"></script>
    <!-- Custom Js -->		
    <script src="../js/admin.js"></script>
    <script src="../js/pages/charts/chartjs.js"></script>
	

	
<!-- PAGINA INICIAL PARA PÁGINA CRUD ALUNOS, CRUD CURSOS E TURMA-ALUNOS  ------------------------------------------------------------------------------------>
		
<?php
}
	elseif(($acao=='crud-alunos') || ($acao == 'crud-cursos') || ($acao  == 'turmas-alunos')){
?>

<script src="../plugins/jquery/jquery.min.js"></script><!-- Jquery Core Js -->    
<script src="../plugins/bootstrap/js/bootstrap.js"></script><!-- Bootstrap Core Js -->    
<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script><!-- Select Plugin Js -->    
<script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script><!-- Slimscroll Plugin Js -->    
<script src="../plugins/node-waves/waves.js"></script><!-- Waves Effect Plugin Js -->	 
<script src="../js/demo.js"></script><!-- Demo Js -->

<!-- Jquery DataTable Plugin Js -->
<script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<script src="../js/admin.js"></script><!-- Custom Js -->
<script src="../js/pages/tables/jquery-datatable.js"></script>    
<script src="../js/demo.js"></script><!-- Demo Js -->


     		
<!-- NÃO ESTÁ SERVINDO PARA NADA RETIRAR DEPOIS ------------------------------------------------------------------------------------>	
<?php
	}elseif($acao=='meus-cursos2'){	
?>

	<script src="../plugins/jquery/jquery.min.js"></script><!-- Jquery Core Js -->    
	<script src="../plugins/bootstrap/js/bootstrap.js"></script><!-- Bootstrap Core Js -->    
	<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script><!-- Select Plugin Js -->    
	<script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script><!-- Slimscroll Plugin Js -->    
	<script src="../plugins/node-waves/waves.js"></script><!-- Waves Effect Plugin Js -->	 
	<script src="../js/demo.js"></script><!-- Demo Js -->
	<script src="../js/admin.js"></script><!-- Custom Js -->

<!-- PAGINA INICIAL PARA PÁGINA INSCRIÇÃO  ----------------------------------------------------------------------------------------->	
<?php
	}elseif($acao=='inscricao'){	
?>    
	
<script src="../plugins/jquery/jquery.min.js"></script><!-- Jquery Core Js -->    
<script src="../plugins/bootstrap/js/bootstrap.js"></script><!-- Bootstrap Core Js -->    
<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script><!-- Select Plugin Js -->    
<script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script><!-- Slimscroll Plugin Js -->    
<script src="../plugins/node-waves/waves.js"></script><!-- Waves Effect Plugin Js -->			
<script src="../js/demo.js"></script><!-- Demo Js -->
<script src="../js/admin.js"></script><!-- Custom Js -->	
<script src="../js/pages/ui/tooltips-popovers.js"></script><!-- tooltips-popovers Js - usei na pagina inscrição-->	

		
		
<!-- PAGINA INICIAL PARA PÁGINA CRUD-TURMA, PENDENTES, CRUD-LOGIN, PG-CURSOS E MEUS CURSOS ------------------------------------------------------------------>
		
<?php
}elseif($acao=='crud-turma' || $acao=='pendentes' || $acao == 'pg-curso' || $acao == 'meus-cursos'){	
?>  
	
<script type="text/javascript">
	$(document).ready(function(){
			
		$(".fancybox").fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
			iframe : {
				preload: false
			}
		});
		
		
		
		$(".various").fancybox({
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none'
		});		
		
		$('.fancybox-media').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
			helpers : {
				media : {}
			}
		});
	});
</script>

<script src="../js/admin.js"></script><!-- Custom Js -->	
<script src="../jquery/data_table/jquery.dataTables.min.js"></script>
<script src="../jquery/data_table/dataTables.bootstrap.min.js"></script>
<script src="../jquery/data_table/bootstrap.min.js"></script>		
<!-- Waves Effect Plugin Js -->
<script src="../plugins/node-waves/waves.js"></script>
<!-- Jquery CountTo Plugin Js -->
<script src="../plugins/jquery-countto/jquery.countTo.js"></script>
<!-- Sparkline Chart Plugin Js -->
<script src="../plugins/jquery-sparkline/jquery.sparkline.js"></script>
<script src="../js/pages/widgets/infobox/infobox-4.js"></script>
<script src="../js/pages/ui/modals.js"></script><!-- janela modal -->



<?php
}elseif($acao=='crud-login'){	
?>  



<script src="../plugins/jquery/jquery.min.js"></script><!-- Jquery Core Js -->  
<script src="../js/admin.js"></script><!-- Custom Js -->	
<script src="../jquery/data_table/jquery.dataTables.min.js"></script>
<script src="../jquery/data_table/dataTables.bootstrap.min.js"></script>
<script src="../jquery/data_table/bootstrap.min.js"></script>		


		
<!-- PAGINA INICIAL PARA PÁGINA PRE-CADASTRO -------------------------------------------------------------------------------------------------------------->		
<?php
}elseif($acao=='pre-cadastro'){	
?>  


   
<script src="../plugins/bootstrap/js/bootstrap.js"></script><!-- Bootstrap Core Js -->    
<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script><!-- Select Plugin Js -->    
<script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script><!-- Slimscroll Plugin Js -->    
<script src="../plugins/node-waves/waves.js"></script><!-- Waves Effect Plugin Js -->		

<script src="../plugins/jquery-validation/jquery.validate.js"></script><!-- Jquery Validation Plugin Css -->  
<script src="../js/admin.js"></script><!--carrega abertura menu -->
<script src="../js/pages/forms/form-validation.js"></script>    
<script src="../js/demo.js"></script><!-- Demo Js -->    
<script src="../js/pages/funcao_cep.js"></script><!-- função carrega CEP -->

<script src="../js/pages/jquery.inputmask.bundle.min.js"></script><!-- jquery.inputmask -->
<script><!-- jquery.inputmask -->
	$(document).ready(function () {
		$(":input").inputmask();
	});
</script>


	
<script type="text/javascript">
	$(document).ready(function(){
			
		$(".fancybox").fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
			iframe : {
				preload: false
			}
		});
		
		
		
		$(".various").fancybox({
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none'
		});
		
		
		
		$('.fancybox-media').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
			helpers : {
				media : {}
			}
		});
	});
</script>

<script src="../js/admin.js"></script><!-- Custom Js -->
		
		
		
<!-- SCRIPTY PARA DEMAIS PAGINAS ------------------------------------------------------------------------------------------------------------------------>	
<?php
}else{			
?>

<script src="../plugins/jquery/jquery.min.js"></script><!-- Jquery Core Js -->    
<script src="../plugins/bootstrap/js/bootstrap.js"></script><!-- Bootstrap Core Js -->    
<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script><!-- Select Plugin Js -->    
<script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script><!-- Slimscroll Plugin Js -->    
<script src="../plugins/node-waves/waves.js"></script><!-- Waves Effect Plugin Js -->		

<script src="../js/pages/ui/modals.js"></script><!-- janela modal -->
<script src="../plugins/jquery-validation/jquery.validate.js"></script><!-- Jquery Validation Plugin Css -->  
<script src="../js/admin.js"></script><!--carrega abertura menu -->
<script src="../js/pages/forms/form-validation.js"></script>    
<script src="../js/demo.js"></script><!-- Demo Js -->    
<script src="../js/pages/funcao_cep.js"></script><!-- função carrega CEP -->

<script src="../js/pages/jquery.inputmask.bundle.min.js"></script><!-- jquery.inputmask -->
<script><!-- jquery.inputmask -->
	$(document).ready(function () {
		$(":input").inputmask();
	});
</script>

<?php }} ?>

</body>
</html>