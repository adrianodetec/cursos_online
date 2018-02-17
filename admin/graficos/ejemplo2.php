<?php

	require_once("../../conexao/conecta.php");

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {

    $('#container').highcharts({
        chart: {
            type: 'pyramid',
            marginRight: 200
        },
	
        title: {
            text: '',
            x: -50
        },

		
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b> ({point.y:,.0f})',
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                    softConnector: true
                }
            }
        },
        legend: {
            enabled: false
        },
        series: [{
            name: '',
            data: [
			
				<?php
				
					date_default_timezone_set('America/Sao_Paulo');    
					$date_atual = date("Y-m-d");
				
					$select = "SELECT * from tb_cursos where cursos_dt_ter >= ? order by cursos_qt_alunos desc";
					$result = $conexao->prepare($select);
					$result->bindvalue(1, $date_atual);
					$result->execute();
					$dados = $result->fetchAll();
					foreach($dados as $row)
					{			
				?>				
			
['<?php echo $row['cursos_nome'] ?>', <?php echo $row['cursos_qt_inscritos'] ?>],

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
<script src="Highcharts-4.1.5/js/modules/funnel.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="min-width: 410px; max-width: 600px; height: 400px; margin: 0 auto"></div>
</body>
</html>
