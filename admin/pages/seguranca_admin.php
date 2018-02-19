<?php
	if($nivelLogado == 0):		
		echo ("<script>alert('Sem permição de acesso !')</script>\n<script>window.location=('home.php?acao=welcome')</script>");
		//echo "<meta http-equiv=refresh content='0;URL=home.php?acao=welcome'>";		
	endif;
	
	if($nivelLogado == 2):		
		echo ("<script>alert('Sem permição de acesso !')</script>\n<script>window.location=('home.php?acao=financeiro')</script>");
		//echo "<meta http-equiv=refresh content='0;URL=home.php?acao=welcome'>";		
	endif;		if($nivelLogado == 3):				echo ("<script>alert('Sem permição de acesso !')</script>\n<script>window.location=('home.php?acao=dense')</script>");		//echo "<meta http-equiv=refresh content='0;URL=home.php?acao=welcome'>";			endif;
?>