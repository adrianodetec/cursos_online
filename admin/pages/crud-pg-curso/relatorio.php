<?php 
 
  //require_once "../../../conexao/conecta.php";   
   
	$conexao = new PDO('mysql:host=localhost;dbname=detec', 'root', '');
	//$conexao ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	
	include "../../pdf/mpdf.php";  

    
    function setarCSS($file){  
     if (file_exists($file)):  
       $this->css = file_get_contents($file);  
     else:  
       echo 'Arquivo inexistente!';  
     endif;  
    }  

    /*  
    * M�todo para montar o Cabe�alho do relat�rio em PDF  
    */  
    function getHeader(){  
       $data = date('j/m/Y');  
       $retorno = "<table class=\"tbl_header\" width=\"1000\">  
               <tr>  
                 <td align=\"left\">Biblioteca mPDF</td>  
                 <td align=\"right\">Gerado em: $data</td>  
               </tr>  
             </table>";  
       return $retorno;  
     }  

     /*  
     * M�todo para montar o Rodap� do relat�rio em PDF  
     */  
     function getFooter(){  
       $retorno = "<table class=\"tbl_footer\" width=\"1000\">  
               <tr>  
                 <td align=\"left\"><a href=''>devwilliam.blogspot.com</a></td>  
                 <td align=\"right\">P�gina: {PAGENO}</td>  
               </tr>  
             </table>";  
       return $retorno;  
     }  

    /*   
    * M�todo para construir a tabela em HTML com todos os dados  
    * Esse m�todo tamb�m gera o conte�do para o arquivo PDF  
    */  
    function getTabela(){  
	
	
	$conexao = new PDO('mysql:host=localhost;dbname=detec', 'root', '');
	
      $color  = false;  
      $retorno = "";  

      $retorno .= "<h2 style=\"text-align:center\"></h2>";  
      $retorno .= "<table border='1' width='1000' align='center'>  
           <tr class='header'>  
             <th>Nome</td>  
             <th>Telefone</td>  
             <th>Idade</td>  
             <th>Profiss�o</td>  
             <th>E-mail</td>  
             <th>Endere�o</td>  
             <th>Cidade</td>  
             <th>Estado</td>  
           </tr>";  
		
		
		$select = "SELECT * FROM tb_cursos";	
		$result = $conexao->prepare($select);
		$result->execute();
		$select = $result->fetchAll();
		foreach($select as $reg):
		 
         $retorno .= ($color) ? "<tr>" : "<tr class=\"zebra\">";  
         $retorno .= "<td class='destaque'>{$reg['cursos_nome']}</td>";  
         $retorno .= "<td>{$reg['cursos_carg_hr']}</td>";  
         $retorno .= "<td>{$reg['cursos_dt_ini']}</td>";  
         $retorno .= "<td>{$reg['cursos_dt_ter']}</td>";  
         $retorno .= "<td>{$reg['cursos_qt_alunos']}</td>";  
         $retorno .= "<td>{$reg['cursos_qt_inscritos']}</td>";  
         $retorno .= "<td>{$reg['foto']}</td>";  
         $retorno .= "<td>{$reg['cursos_valor']}</td>";  
       $retorno .= "<tr>";  
       $color = !$color;  
      endforeach;  

      $retorno .= "</table>";  
      return $retorno;  
    } 

    /*   
    * M�todo para construir o arquivo PDF  
    */  
     function BuildPDF(){  
     //$mpdf = new mPDF('utf-8', 'A4-L');  
     $mpdf->WriteHTML($stylesheet, 1);  
     $mpdf->SetHTMLHeader(getHeader());  
     $mpdf->SetHTMLFooter(getFooter());  
     $mpdf->WriteHTML(getTabela()); 
     $mpdf->charset_in='windows-1252';

	 
    }   
	
	
    /*   
    * M�todo para exibir o arquivo PDF  
    * @param $name - Nome do arquivo se necess�rio grava-lo  
    */  
     function Exibir($name = null) {  
     $this->pdf->Output($name, 'I');  
    }  
    

?>  