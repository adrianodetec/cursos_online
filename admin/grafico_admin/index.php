<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/Chart.js"></script>
    </head>
    <style>
        .caja{
            margin: auto;
            max-width: 250px;
            padding: 20px;
            border: 1px solid #BDBDBD;
        }
        .caja select{
            width: 100%;
            font-size: 16px;
            padding: 5px;
        }
        .resultados{
            margin: auto;
            margin-top: 40px;
            width: 1000px;
        }
    </style>
    <body> 
        <div class="caja" align="center">
            <select onChange="mostrarResultados(this.value);">
                <?php
				
				    $ano_atual = gmdate("Y");
				
                    for($i=2017;$i<=2020;$i++){
                        if($i == $ano_atual){
                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                        }else{
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="resultados"><canvas id="grafico" width= "400" ></canvas></div>
    </body>
    <script>
            $(document).ready(mostrarResultados(2017));  
                function mostrarResultados(ano){
                    $.ajax({
                        type:'POST',
                        url:'controlador/procesar.php',
                        data:'ano='+ano,
                        success:function(data){

                            var valores = eval(data);

                            var e   = valores[0];
                            var f   = valores[1];
                            var m   = valores[2];
                            var a   = valores[3];
                            var ma  = valores[4];
                            var j   = valores[5];
                            var jl  = valores[6];
                            var ag  = valores[7];
                            var s   = valores[8];
                            var o   = valores[9];
                            var n   = valores[10];
                            var d   = valores[11];
                                
                            var Datos = {
                                    labels : ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                                    datasets : [
                                        {
											fillColor : "rgba(151,187,205,0.5)",
											strokeColor : "rgba(151,187,205,0.8)",
											highlightFill : "rgba(151,187,205,0.75)",
											highlightStroke : "rgba(151,187,205,1)",
											
                                            data : [e, f, m, a, ma, j, jl, ag, s, o, n, d],
                                        }
                                    ]
                                }
                                
                            var contexto = document.getElementById('grafico').getContext('2d');
                            window.Barra = new Chart(contexto).Bar(Datos, { responsive : true });
                        }
                    });
                    return false;
                }
    </script>
</html>