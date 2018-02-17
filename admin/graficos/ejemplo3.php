<?php

	require_once("../../conexao/conecta.php");

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title></title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
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
			
			],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Inscrito(s)/curso(s)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' aluno(s)'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: '<?php echo gmdate("Y"); ?>',
            data: [
	<?php
		$select = "SELECT * from tb_cursos where cursos_dt_ter >= ? order by cursos_qt_alunos desc";
		$result = $conexao->prepare($select);
		$result->bindvalue(1, $date_atual);
		$result->execute();
		$dados = $result->fetchAll();
		foreach($dados as $row)
		{
		$barra = "/";
	?>				
			[<?php echo $row['cursos_qt_inscritos']; ?>],
		
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
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

</body>
</html>
