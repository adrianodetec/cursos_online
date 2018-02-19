<?php

//////////////////////////////////////////////////////////////////////PAGINA PRÉ CADASTRO /////////////////////////////////////////////////////////////////////

	function insertPrecadastro($conexao, $nome_completo, $cpf, $estado_civil, $data_nascimento, $num_rg, $org_exp,
							$naturalidade, $email, $nome_pai, $nome_mae, $num_casa, $rua, $complemento, $bairro, $cep, $cidade, $uf, $telefone,$celular,
							$inst_ensino, $data_conclusao, $profissao, $nome_empresa, $rua2, $complemento2, $bairro2, $cep2, $cidade2 , $uf2, $num_casa2, $date_cadastro){

		$insert = "insert into tb_alunos (aluno_nome, aluno_cpf, aluno_est_civ, aluno_dt_nasc, aluno_rg, aluno_org_exp, aluno_naturalidade, aluno_email,
                                   aluno_nome_pai, aluno_nome_mae, aluno_num_casa, aluno_end, aluno_compl, aluno_bairro, aluno_cep, aluno_cidade, aluno_est, aluno_tel_fixo, aluno_tel_cel, aluno_instituicao,
                                   aluno_concl_curso, aluno_profissao, aluno_nome_empr, aluno_end_empr, aluno_compl_empr, aluno_bairro_empr, aluno_cep_empr, 
                                   aluno_cid_empr, aluno_tel_empr, aluno_num_empr, aluno_dt_cad) 
                                   values 
                                   (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
		try{			
			$verifica = $conexao->prepare($insert);
			$verifica->bindValue(1,  $nome_completo);
			$verifica->bindValue(2,  $cpf);
			$verifica->bindValue(3,  $estado_civil);
			$verifica->bindValue(4,  $data_nascimento);
			$verifica->bindValue(5,  $num_rg);
			$verifica->bindValue(6,  $org_exp);
			$verifica->bindValue(7,  $naturalidade);
			$verifica->bindValue(8,  $email);
			$verifica->bindValue(9,  $nome_pai);
			$verifica->bindValue(10, $nome_mae);
			$verifica->bindValue(11, $num_casa);
			$verifica->bindValue(12, $rua);
			$verifica->bindValue(13, $complemento);
			$verifica->bindValue(14, $bairro);
			$verifica->bindValue(15, $cep);
			$verifica->bindValue(16, $cidade);
			$verifica->bindValue(17, $uf);
			$verifica->bindValue(18, $telefone);
			$verifica->bindValue(19, $celular);
			$verifica->bindValue(20, $inst_ensino);
			$verifica->bindValue(21, $data_conclusao);
			$verifica->bindValue(22, $profissao);
			$verifica->bindValue(23, $nome_empresa);
			$verifica->bindValue(24, $rua2);
			$verifica->bindValue(25, $complemento2);
			$verifica->bindValue(26, $bairro2);
			$verifica->bindValue(27, $cep2);
			$verifica->bindValue(28, $cidade2);
			$verifica->bindValue(29, $uf);
			$verifica->bindValue(30, $num_casa2);
			$verifica->bindValue(31, $date_cadastro);

			$insere_bd = $verifica->execute();;
						
			if($verifica){	
							
				return true;	
			}
			else{
				return false;
			}		
		}catch(PDOException $e){
			echo $e;
		}
	}
		
	function verificaCPF($cpf, $conexao)
	{

		$select = "SELECT aluno_cpf from tb_alunos WHERE aluno_cpf = ?";
				
		try{
			$result = $conexao->prepare($select);
			$result->bindParam(1, $cpf, PDO::PARAM_STR);
			$result->execute();
			$contar = $result->rowCount();
			
			if($contar){			
				return true;			
			}
			else{
				return false;
			}		
		}catch(PDOException $e){
			echo $e;
		}
	}


/////////////////////////////////////////////////////////////////////// PAGINA INSCRIÇÃO /////////////////////////////////////////////////////////////////////

	function retornaIDaluno($cpf, $conexao)
	{
		$select = "SELECT * FROM tb_alunos INNER JOIN tb_login ON tb_alunos.aluno_cpf = tb_login.login_cpf where tb_login.login_cpf = ?";
				
		try{
			$result = $conexao->prepare($select);
			$result->bindvalue(1,$cpf); 
			$result->execute();
			
			$dados = $result->fetch(PDO::FETCH_ASSOC);
			
			if($result->rowCount() == 1){	
							
				return $dados;		
			}
			else{
				return false;
			}		
		}catch(PDOException $e){
			echo $e;
		}
	}
	
	function verifica_Alunoid_Cursoid($conexao, $aluno_id, $cursos_id) // faço um filtro mais detalhado
	{		
		try{
			$select = "SELECT * from tb_matricula WHERE matricula_aluno_id = ? and matricula_curso_id = ?";	
			$result = $conexao->prepare($select);
			$result->bindvalue(1, $aluno_id);	
			$result->bindvalue(2, $cursos_id);
			$result->execute();
			$contar = $result->rowCount();
			
			if($contar == 0){	
							
				return true;		
			}
			else{
				return false;
			}		
		}catch(PDOException $e){
			echo $e;
		}
	}
	
	
		function retorna_dados_aluno($conexao, $aluno_id) // faço um filtro mais detalhado
	{		
		try{
			$select = "SELECT * from tb_matricula WHERE matricula_aluno_id = ?";	
			$result = $conexao->prepare($select);
			$result->bindvalue(1, $aluno_id);				
			$result->execute();
			$contar = $result->rowCount();
			
			if($contar){	
							
				return $contar;		
			}
			else{
				return false;
			}		
		}catch(PDOException $e){
			echo $e;
		}
	}	
	
	
	function efetua_Incricao($conexao, $aluno_id, $cursos_id, $pg)
	{	
		try{
			$sql = 'INSERT INTO tb_matricula (matricula_curso_id, matricula_aluno_id, data_matricula, matricula_status_pg) VALUES(?, ?, NOW(), ?)';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(1, $cursos_id);
			$stm->bindValue(2, $aluno_id);
            $stm->bindValue(3, $pg);           			
			$retorno = $stm->execute();
			
			if($retorno){
				
				return true;		
			}
			else{
				return false;
			}		
		}catch(PDOException $e){
			echo $e;
		}
	}
	
	function cancelar_Incricao($conexao, $id_matriculado, $tabela)
	{	
		try{
			$sql = "DELETE FROM $tabela where matricula_id = ?";
			$stm = $conexao->prepare($sql);
			$stm->bindValue(1, $id_matriculado);				
			$retorno = $stm->execute();
			
			if($retorno){
				
				return true;		
			}
			else{
				return false;
			}		
		}catch(PDOException $e){
			echo $e;
		}
	}
	

/////////////////////////////////////////////////////////////////////// CRUD ALUNOS //////////////////////////////////////////////////////////////////

	function cancelar_Login($conexao, $login_id)
	{	
		try{
			$sql = 'DELETE FROM tb_login WHERE login_id = ?';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(1, $login_id);
			$retorno = $stm->execute();
			
			if($retorno){
				
				return true;		
			}
			else{
				return false;
			}		
		}catch(PDOException $e){
			echo $e;
		}
	}

	
	/////////////////////////////////////////////////////////////////////// MEUS CURSOS //////////////////////////////////////////////////////////////////
	
	
		function retorna_dados_aluno_matricula($conexao, $aluno_id, $cursos_id) // faço um filtro mais detalhado
	{		
		try{
			$select = "SELECT * from tb_matricula WHERE matricula_aluno_id = ? and matricula_curso_id = ?";	
			$result = $conexao->prepare($select);
			$result->bindvalue(1, $aluno_id); 
			$result->bindvalue(2, $cursos_id);
			$result->execute();			
			$dados = $result->fetchAll(PDO::FETCH_ASSOC);
			
			if($result->rowCount() == 1){	
							
				return $dados;		
			}
			else{
				return false;
			}		
		}catch(PDOException $e){
			echo $e;
		}
	}
	
	
	
	
		function retornaDadosCursoPDF($conexao,$cursos_id) // faço um filtro mais detalhado
	    {		
		try{
			$select = "SELECT * from tb_cursos WHERE cursos_id = ?";	
			$result = $conexao->prepare($select);		
			$result->bindvalue(1, $cursos_id);
			$result->execute();			
			$dados = $result->fetchAll(PDO::FETCH_ASSOC);
			
			if($result->rowCount() >= 1){	
							
				return $dados;		
			}					
		}catch(PDOException $e){
			echo $e;
		}
	}
	
	
	

?>

