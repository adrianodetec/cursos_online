<style type="text/css">
		
		body
		{			
			background: url(../images/404.jpg) no-repeat right top fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		
		/* estilo para 404 */
		
		.four-zero-four-container
		{
			float: left;
			left: 50%; /* posiciona a 90px para a esquerda */ 
			top: 50%; /* posiciona a 70px para baixo */
			width: 100%;
			text-align: center;
			margin: 5% auto;
		}
		.error-code
		{
			font-size: 160px;
		}
		.error-message
		{
			font-size: 26px;
			color: #333;
			font-weight: bold;
			margin-top: -40px;
		}
		.button-place
		{
			margin-top: 32px;
		}
		
		/* fim estilo para 404 */
		
		
		
	
		
    </style>


<section class="content">
        <div class="container-fluid">
           	<div class="span12"></div>	
			
            <!-- INSERIR PRÓXIMAS INFORMAÇÕES -->
				<body class="four-zero-four">
					<div class="four-zero-four-container">
						<div class="error-code">404</div>
						<div class="error-message">Esta página não existe</div>
						<div class="button-place">
							<a href="home.php?acao=welcome" class="btn btn-default btn-lg waves-effect">VOLTAR PARA PÁGINA INICIAL</a>
							
							<?php 
							if($nivelLogado == 1)
							{
								echo "<meta http-equiv=refresh content='2;URL=home.php?acao=admin'>";
							}
							elseif($nivelLogado == 2)
							{
								echo "<meta http-equiv=refresh content='2;URL=home.php?acao=financeiro'>";
							}
							elseif($nivelLogado == 3)
							{
								echo "<meta http-equiv=refresh content='2;URL=home.php?acao=dense'>";
							}
							else
							{
								echo "<meta http-equiv=refresh content='2;URL=home.php?acao=welcome'>";
							}
							?>
						</div>
					</div>
				</body>
				<!-- #END# PROXIMAS INFORMAÇÕES -->
				
            </div>
        </div>
</section>
