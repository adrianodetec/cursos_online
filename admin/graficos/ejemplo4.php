<?php

	require_once("../../conexao/conecta.php");

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	
			<script src="Highcharts-4.1.5/js/jquery.min.js"></script>	
			<style type="text/css">
				#container {
					height: 500px; 
					min-width: 310px; 
					max-width: 1200px;
					margin: 0 auto;
				}
		    </style>
					<script type="text/javascript">
			$(function () {
				$('#container').highcharts({
					chart: {
						type: 'column',
						margin: 95,
						options3d: {
							enabled: true,
							alpha: 10,
							beta: 35,
							depth: 70
						}
					},
					title: {
						text: ''
					},
					subtitle: {
						text: ''
					},
					plotOptions: {
						column: {
							depth: 25
						}
					},
					xAxis: {
						categories: [
				<?php
				
					date_default_timezone_set('America/Sao_Paulo');    
					$date_atual = date("Y-m-d");
				
					$select = "SELECT cursos_nome, cursos_id from tb_cursos where cursos_dt_ter >= ? order by cursos_nome desc";
					$result = $conexao->prepare($select);
					$result->bindvalue(1, $date_atual);
					$result->execute();
					$dados = $result->fetchAll();
					foreach($dados as $row)
					{

						$curso_id = $row['cursos_id'];
					?>					
								
						    ['<?php echo $row['cursos_nome']; ?>'],
					<?php
					}
					?>
								]
							},
							yAxis: {
								title: {
									text: null
								}
							},
							series: [{
								name: 'Total de alunos inscritos',
								data: [
								
				<?php
					$select = "SELECT * from tb_cursos where cursos_dt_ter >= ? order by cursos_qt_alunos desc";
					$result = $conexao->prepare($select);
					$result->bindvalue(1, $date_atual);
					$result->execute();
					$dados = $result->fetchAll();
					foreach($dados as $row)
					{			
				?>			
							
					[<?php echo $row['cursos_qt_inscritos'] ?>], 
							
							<?php
							}
							?>
							]
						}]
					});
				});
	    </script>
	</head>
<body>
<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<!-- <script src="Highcharts-4.1.5/js/highcharts-3d.js"></script> -->
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>
<div id="container" style="height: 400px"></div>
	</body>
</html>
