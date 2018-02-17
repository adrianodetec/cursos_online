<?php  


 // Require no script da classe relaorio 
 require_once "relatorio.php"; 
  
 if(isset($_GET['submit'])):  
   //$report = new reportCliente("css/estilo.css", "Relatório de Clientes");  
   echo BuildPDF();  
   $report->Exibir("Relatório de Clientes");  
 endif;  
 ?>  
<div style="clear:both; margin-top:0em; margin-bottom:1em;">
<!DOCTYPE html>  
 <html>  
   <head>  
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
     <title>Testando relatório com mPDF</title>  
   </head>  
   <body>  
     <form action="" method="GET" target="_blank">  
       <input type="submit" value="Gerar relatório" name="submit"/>  
     </form>  
   </body>  
 </html>  