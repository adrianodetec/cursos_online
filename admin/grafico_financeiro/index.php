<?php

include("../../conexao/conecta.php");

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
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 55
            }
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        plotOptions: {
            pie: {
                innerSize: 150,
                depth: 35
            }
        },
        series: [{
            name: 'Alunos inscritos: ',
            data: [
					<?php
					$select = "SELECT * from tb_cursos";
					$result = $conexao->prepare($select);					
					$result->execute();
					$dados = $result->fetchAll();
					foreach($dados as $row)
					{												
						$curso_id = $row['cursos_id'];
						
						$select = 'SELECT * FROM tb_matricula WHERE matricula_curso_id = ? and matricula_status_pg = "PENDENTE"';
						$result = $conexao->prepare($select);
						$result->bindvalue(1, $curso_id);
						$result->execute();	
						$pendente = $result->rowCount();						
						$valor_pendente = $pendente * $row['cursos_valor'];
						
						/////////////////////////////////////////////////////////////////////////////////////////////////////////
						
						$select = 'SELECT * FROM tb_matricula WHERE matricula_curso_id = ? and matricula_status_pg = "PAGAMENTO APROVADO"';
						$result = $conexao->prepare($select);
						$result->bindvalue(1, $curso_id);
						$result->execute();	
						$aprovado = $result->rowCount();						
						$valor_aprovado = $aprovado * $row['cursos_valor'];
						
						/////////////////////////////////////////////////////////////////////////////////////////////////////////
						
						
						?>
	
						['<?= $row['cursos_nome']; ?>, <br> Vagas :<?= $row['cursos_qt_alunos'] ?>  <br>Inscritos :<?= $row['cursos_qt_inscritos'] ?> <br>Valor pendente: <?= number_format($valor_pendente, 2, '.', ',') ?> - <?= $pendente ?> alunos <br>Valor pago: <?= number_format($valor_aprovado, 2, '.', ',') ?> - <?= $aprovado ?> alunos ' , <?= $row['cursos_qt_inscritos'] ?>],
	
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

<script src="js/highcharts.js"></script>
<script src="js/highcharts-3d.js"></script>
<script src="js/exporting.js"></script>

<div id="container" style="height: 500px"></div>
	</body>
</html>
