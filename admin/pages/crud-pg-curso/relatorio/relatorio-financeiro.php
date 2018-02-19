
<?php


$curso_id = (isset($_GET['id'])) ? $_GET['id'] : ''; //recupero id passado via get

require_once "../../../../conexao/conecta.php"; //Conexao com o banco de dados

// ------------------------------------------------------------- FUNÇÃO PARA GERAR CABEÇALHO ----------------------------------------------------------------
function getHeader($curso_id, $conexao)
{  
	
   
    $retorno = "<html>";

	$retorno = "

	<table class=\"tbl_header\">  
		   <tr>  
			 <td align=\"left\" width=\"5%\"><img src=\"../../../../images/logo-relatorio.png\" width=\"50\"></td>  
			 <td align=\"center\"><h1>EMERJ - ESCOLA DA MAGISTRATURA DO ESTADO DO RIO DE JANEIRO</h1>
	                             <h1>DETEC - Departamento de Tecnologia de Informação e Comunicação</h1>
								 <h1>SCO - SISTEMA DE INSCRIÇÃO DE CURSOS ONLINE</h1>
								 
			</td>
			<td align=\"right\" width=\"5%\"></td> 
		   </tr>  
		 </table>";
	
	$retorno .= "<body>";
   return $retorno;  
 } 

 

 
// ------------------------------------------------------------- FUNÇÃO PARA GERAR RODAPÉ ----------------------------------------------------------------
function getFooter()
{  

   date_default_timezone_set('America/Sao_Paulo'); 
   $data = date('j/m/Y');
   $hora = date('H:m:s');
   $retorno = "<table class=\"tbl_footer\" width=\"1000\">  
		   <tr>  
			 <td align=\"left\">Gerado em: $data às $hora</td>  
			 <td align=\"right\">Página: {PAGENO} de {nb}</td>  
		   </tr>  
		 </table>";
		 
   return $retorno;  
 }  
 
// ----------------------------------------------------------- FUNÇÃO PARA GERAR TABELAS COM FOREACH -------------------------------------------------------
 
function getTabela($curso_id, $conexao)
{  

	
	$select = "SELECT cursos_valor, cursos_nome FROM tb_cursos WHERE cursos_id = ?";		
	$result = $conexao->prepare($select);
	$result->bindValue(1, $curso_id);
	$result->execute();
	$select = $result->fetchAll();
	
	foreach($select as $reg)
	{
		$valor_curso = $reg['cursos_valor'];
		$nome_curso = $reg['cursos_nome'];
	}
	
	  require_once "../funcao_status_pg.php"; //INCLUSAO DE FUNÇÕES
	  
	  $PGaprovado = retornaPGaprovado($curso_id, $conexao);
	  
	  $valorArrecadado = totalPGpago($PGaprovado, $conexao, $valor_curso);


	 		
	  //require_once "../../../../conexao/conecta.php"; //Conexao com o banco de dados
	  
      $color  = false;  
      $retorno = "";	 
	  $retorno .= "<h2 style=\"text-align:center\"></h2>";  
      $retorno .= "<table class=\"tabela\" width=\"100%\" cellpadding=\"8\" border=\"1\">
		<thead class=\"teste\">
		<tr>
		<td colspan=\"5\"><h2>$nome_curso</h2></td>		
		</tr>
		</thead>
		
		<thead>
		<tr>
		<td width=\"5%\">N</td>
		<td>E-MAIL</td>
		<td>NOME ALUNO</td>		
        <td>STATUS PAGAMENTO</td>
        <td>DATA LANÇAMENTO</td>		
		
		</tr>
		</thead>
		<tbody>"; 	
		
		try //Tratamento de erro
		{
		
		$select = "SELECT tb_alunos.aluno_nome,tb_alunos.aluno_email, tb_matricula.matricula_status_pg, tb_matricula.data_pg FROM tb_alunos INNER JOIN tb_matricula ON tb_alunos.aluno_id = tb_matricula.matricula_aluno_id and matricula_curso_id = ? order by tb_matricula.data_pg desc";
		$result = $conexao->prepare($select);
		$result->bindValue(1, $curso_id);
		$result->execute();
		$select = $result->fetchAll();
		
		$contador = 1; //Criei contador para fazer ordenação da tabela
		
		}catch(PDOException $e)
		{
			echo $e; //Caso tenha erro, exibo mensagem
		}
		
		
		
		foreach($select as $reg):
		    
		    //recuperar valor das datas de cadastro
		    
    		if($reg['data_pg'] == '')
    		{
    			$mensagem = "Não informado";
    		}
    		else
    		{
    			$mensagem = date("d/m/Y",strtotime($reg['data_pg']));				
    		}
		    
			$retorno .= ($color) ? "<tr>" : "<tr class=\"zebra\">";  
			$retorno .= "<td align=\"center\">$contador</td>";
			$retorno .= "<td align=\"center\" class=\"converte_maiusculo\">{$reg['aluno_email']}</td>"; 
			$retorno .= "<td align=\"center\" class=\"converte_maiusculo\">{$reg['aluno_nome']}</td>";
			$retorno .= "<td align=\"center\" class=\"converte_maiusculo\">{$reg['matricula_status_pg']}</td>";
			$retorno .= "<td align=\"center\" class=\"converte_maiusculo\">{$mensagem}</td>";       
			$retorno .= "</tr>";  
			$color = !$color;  
			$contador++;
        endforeach; 
		
		
		
		
		$retorno .= "<tr>";  
		$retorno .= "<td colspan=\"5\" align=\"center\">TOTAL ARRECADADO: {$valorArrecadado}</td>";		
		$retorno .= "</tr>"; 
		
			
        $retorno .= "</table>";
		$retorno .= "<br>"; 
		$retorno .= "</body>"; 
		$retorno .= "</html>"; 
        return $retorno;  
} 
 
//==============================================================
//==============================================================

include("../../../pdf/mpdf.php");

$mpdf=new mPDF('c'); 

$mpdf->SetDisplayMode('fullpage');

$mpdf=new mPDF('','','','',5,5,25,15,5,5); //Margem para o PDF no formato A4

$css = file_get_contents('relatorio.css'); //Aponto para o arquivo Css 

$mpdf->WriteHTML($css,1);	// Parametro para importar CSS -> importante!

$mpdf->SetHTMLHeader(getHeader($curso_id, $conexao, 'O',true)); //Faço exibição do cabeçalho 

$mpdf->SetHTMLFooter(getFooter($retorno)); //Faço exibição do rodapé

$mpdf->WriteHTML(getTabela($curso_id, $conexao)); //Faço exibição da tabela com os dados do Sistema

//$mpdf->WriteHTML($html);

$mpdf->Output($arquivo, 'I');

exit;

?>