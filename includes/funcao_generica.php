 <?php

  /*************************************************************************************************************** 
 * @author Adriano Silva do Carmo                                                                                *  
 * Data: 09/02/2018                                                                                             *
 * Título: CRUD genérico                                                                                        *  
 * Descrição: A Classe de CRUD genérico foi elaborada com o objetivo de auxlilar nas operações CRUDs em diversos* 
 * SGBDS, possui funcionalidades para construir instruções de INSERT, UPDATE E DELETE onde as mesmas podem ser  *
 * executadas nos principais SGBDs, exemplo SQL Server, MySQL e Firebird. Instruções SELECT são recebidas       *
 * integralmente via parâmetro.                                                                                 *  
 ****************************************************************************************************************/ 
 
 
/************************************************************************************************************************************************************************************
                                                          0 - FUNÇÃO DE SELECIONAR NO BANCO - CRUD GENÉRICO (SELECT COM ROWCOUNT)
************************************************************************************************************************************************************************************/

function selectrowcount($conexao, $tabela, $condicao)
{
		
	try
	{
		$select = "SELECT * FROM {$tabela} WHERE {$condicao}";
				
		$result = $conexao->prepare($select);
		
		$result->execute();
		
		$contar = $result->rowCount();
		
		if($contar)
		{			
			return true;			
		}
		else
		{
			return false;
		}		
	}catch(PDOException $e){
		echo $e;
	}
		
}

 
/************************************************************************************************************************************************************************************
                                                             1 - FUNÇÃO DE CADASTROS NO BANCO - CRUD GENÉRICO (INSERT)
************************************************************************************************************************************************************************************/
 
   
function insert($conexao, $tabela, $arrayDados)
{ 		
	try
	{
		// Loop para montar a instrução com os campos e valores   
		foreach($arrayDados as $chave => $valor):   
		@$campos .= $chave . ', ';   
		@$valores .= '?, ';   
		endforeach;   

		// Retira vírgula do final da string   
		$campos = (substr($campos, -2) == ', ') ? trim(substr($campos, 0, (strlen($campos) - 2))) : $campos ;    

		// Retira vírgula do final da string   
		$valores = (substr($valores, -2) == ', ') ? trim(substr($valores, 0, (strlen($valores) - 2))) : $valores ;

		// Concatena todas as variáveis e finaliza a instrução   
		$sql = "INSERT INTO {$tabela} (" . $campos . ")VALUES(" . $valores . ")";

		// Passa a instrução para o PDO   
		$stm = $conexao->prepare($sql);   

		// Loop para passar os dados como parâmetro   
		$cont = 1;   
		foreach ($arrayDados as $valor):   
		$stm->bindValue($cont, $valor);   
		$cont++;   
		endforeach;   

		// Executa a instrução SQL e captura o retorno 
		$retorno = $stm->execute(); 

		return $retorno;   

	}
	catch(PDOException $e)
	{
		echo 'ERROR: ' . $e->getMessage();
	}	
}

/************************************************************************************************************************************************************************************
                                                               2 -  FUNÇÃO DE SELECIONAR NO BANCO - CRUD GENÉRICO (SELECT)
															   
	  
   * Método genérico para executar instruções de consulta independente do nome da tabela passada no _construct  
   * @param $sql = Instrução SQL inteira contendo, nome das tabelas envolvidas, JOINS, WHERE, ORDER BY, GROUP BY e LIMIT  
   * @param $arrayParam = Array contendo somente os parâmetros necessários para clásusla WHERE  
   * @param $fetchAll  = Valor booleano com valor default TRUE indicando que serão retornadas várias linhas, FALSE retorna apenas a primeira linha  
   * @return Retorna array de dados da consulta em forma de objetos  
    
															   
************************************************************************************************************************************************************************************/

function select($conexao, $sql, $arrayParams=true, $fetchAll=true)
{  
	try
	{   
		// Passa a instrução para o PDO   
		$stm = $conexao->prepare($sql);   

		// Verifica se existem condições para carregar os parâmetros    
		if (!empty($arrayParams)):   

		// Loop para passar os dados como parâmetro cláusula WHERE   
		$cont = 1;   
		foreach ($arrayParams as $valor):   
		$stm->bindValue($cont, $valor);   
		$cont++;   
		endforeach;   

		endif;   

		// Executa a instrução SQL    
		$stm->execute();   

		// Verifica se é necessário retornar várias linhas  
		if($fetchAll):   
			$dados = $stm->fetchAll(PDO::FETCH_OBJ);   
		else:  
			$dados = $stm->fetch(PDO::FETCH_OBJ);   
		endif;  

		return $dados;  

	}
	catch (PDOException $e)
	{   
		echo "Erro: " . $e->getMessage();   
	}   
}  


/************************************************************************************************************************************************************************************
                                                             3 -  FUNÇÃO DE EDITAR NO BANCO - CRUD GENÉRICO (UPDATE)															 
      
   * Método público para atualizar os dados na tabela   
   * @param $arrayDados = Array de dados contendo colunas e valores   
   * @param $arrayCondicao = Array de dados contendo colunas e valores para condição WHERE - Exemplo array('$id='=>1)   
   * @return Retorna resultado booleano da instrução SQL   
   
															 
************************************************************************************************************************************************************************************/
	
function update($conexao, $tabela, $arrayDados, $arrayCondicao)
{   
	try 
	{  
		// Loop para montar a instrução com os campos e valores   
       foreach($arrayDados as $chave => $valor):   
          @$valCampos .= $chave . '=?, ';   
       endforeach;   
              
       // Loop para montar a condição WHERE   
       foreach($arrayCondicao as $chave => $valor):   
          @$valCondicao .= $chave . '? AND ';   
       endforeach;   
              
       // Retira vírgula do final da string   
       $valCampos = (substr($valCampos, -2) == ', ') ? trim(substr($valCampos, 0, (strlen($valCampos) - 2))) : $valCampos ;    
              
       // Retira vírgula do final da string   
       $valCondicao = (substr($valCondicao, -4) == 'AND ') ? trim(substr($valCondicao, 0, (strlen($valCondicao) - 4))) : $valCondicao ;    
              
        // Concatena todas as variáveis e finaliza a instrução   
        $sql = "UPDATE {$tabela} SET " . $valCampos . " WHERE " . $valCondicao;

		// Passa a instrução para o PDO   
		$stm = $conexao->prepare($sql);   

		// Loop para passar os dados como parâmetro   
		$cont = 1;   
		foreach ($arrayDados as $valor):   
			$stm->bindValue($cont, $valor);   
			$cont++;   
		endforeach;   
			  
		// Loop para passar os dados como parâmetro cláusula WHERE   
		foreach ($arrayCondicao as $valor):   
			$stm->bindValue($cont, $valor);   
			$cont++;   
		endforeach;   

		// Executa a instrução SQL e captura o retorno   
		$retorno = $stm->execute();   

		return $retorno;   
		   
	}
	catch (PDOException $e)
	{   
		echo "Erro: " . $e->getMessage();   
	}   
}   
 
 
/************************************************************************************************************************************************************************************
                                                             4 -  FUNÇÃO DE APAGAR NO BANCO - CRUD GENÉRICO (DELETAR)															 
	   
	* Método público para excluir os dados na tabela   
	* @param $arrayCondicao = Array de dados contendo colunas e valores para condição WHERE - Exemplo array('$id='=>1)   
	* @return Retorna resultado booleano da instrução SQL   
	
	
************************************************************************************************************************************************************************************/
 
 
 function delete($conexao, $tabela, $arrayCondicao)
 {   
      try
	  {   
    
        // Loop para montar a instrução com os campos e valores   
        foreach($arrayCondicao as $chave => $valor):   
           @$valCampos .= $chave . '? AND ';   
        endforeach;   
              
        // Retira a palavra AND do final da string   
			@$valCampos = (substr($valCampos, -4) == 'AND ') ? trim(substr($valCampos, 0, (strlen($valCampos) - 4))) : $valCampos ;    
              
        // Concatena todas as variáveis e finaliza a instrução   
        $sql = "DELETE FROM {$tabela} WHERE " . $valCampos;    
    
        // Passa a instrução para o PDO   
        $stm = $conexao->prepare($sql);   
    
              // Loop para passar os dados como parâmetro cláusula WHERE   
              $cont = 1;   
              foreach ($arrayCondicao as $valor):   
                $stm->bindValue($cont, $valor);   
                $cont++;   
              endforeach;   
    
        // Executa a instrução SQL e captura o retorno   
        $retorno = $stm->execute();   
    
        return $retorno;   
           
      } 
	  catch (PDOException $e)
	  {   
        echo "Erro: " . $e->getMessage();   
      }   
}
 
 
 
function usuario_online($conexao, $times)

{
	if(empty($_SESSION['start_View']['sessao']))
	{
		$_SESSION['start_View']['sessao']   = session_id();
		$_SESSION['start_View']['ip']       = $_SERVER['REMOTE_ADDR'];
		$_SESSION['start_View']['time_end'] = time() + $times;	
		
		$arrayUser = array('user_online_sessao' => $_SESSION['start_View']['sessao'], 'user_online_ip' => $_SESSION['start_View']['ip'], 'user_online_time_end' => $_SESSION['start_View']['time_end']); 										 
		$result = insert($conexao, ' tb_user_online', $arrayUser);
		
	}
	else
	{
		$id_session = $_SESSION['start_View']['time_end'];
		if($_SESSION['start_View']['time_end'] <= time())
		{
			$deletar = $conexao->prepare("delete from  tb_user_online where user_online_sessao = '$id_session' or user_online_time_end <= time(now())");
			$deletar ->execute();			
			unset($_SESSION['start_View']);
		}
		else
		{
			$atualizatempo = $_SESSION['start_View']['time_end'];
			$_SESSION['start_View']['time_end'] = time() + $times;
			$sql = "update tb_user_online set user_online_sessao = '$atualizatempo'";
			$altera = $conexao->prepare($sql);			
			$altera ->execute();
		}		
	}
	
}

 
 
 
 
 
  
 
 /*
 
 EXEMPLOS
 
 
 // Exclui o registro do usuário com id 1 
 $arrayCond = array('login_id=' => 216);  
 $retorno   = delete($conexao, 'tb_login', $arrayCond);   
   
// Editar os dados do usuario com id 1
/* 
 $arrayParam = array('login_nome' => 'marcio da Silva', 'login_email' => 'joao@gmail.com.br', 'login_senha' => base64_encode('654321'), 'login_nivel' => 1);  
 $arrayCond = array('login_id=' => 80);  
 $retorno   = update($conexao, 'tb_login', $arrayParam, $arrayCond); 
  
Consulta os dados do usuário com id 1 e privilegio A 
$sql        = "SELECT login_nome, login_email, login_cpf FROM tb_login WHERE login_id = ?";  
$arrayParam = array(217);  
$dados      = select($conexao, $sql, $arrayParam, TRUE);  

foreach ($dados as $key => $object) {
    echo $object->login_nome;
	echo $object->login_cpf;
}
 
 // método de Inseri os dados do usuário 
 //$arrayUser = array('login_nome' => 'João', 'login_email' => 'joao@gmail.com', 'login_senha' => base64_encode('123456'), 'login_nivel' => 1);  
 //$retorno   = insert($conexao, 'tb_login', $arrayUser);


*/
   
   ?>