<?php 

	function porcentagem_total($status_inscrito, $total_inscritos)
	{	
		if($total_inscritos > 0)
		{							
			$resultado = (($status_inscrito / $total_inscritos) * 100);
			return number_format($resultado,0);
						
		}
        else
		{
			return 0;
		}			
			
	}

	function retornaPendente($curso_id, $conexao){	
			
		$select = 'SELECT * FROM tb_matricula WHERE matricula_curso_id = ? and matricula_status_pg = "PENDENTE"';
		$result = $conexao->prepare($select);
		$result->bindvalue(1, $curso_id);
		$result->execute();	
		return $result->rowCount();		
	}

	function retornaPGaprovado($curso_id, $conexao){	
			
		$select = 'SELECT * FROM tb_matricula WHERE matricula_curso_id = ? and matricula_status_pg = "PAGAMENTO APROVADO"';
		$result = $conexao->prepare($select);
		$result->bindvalue(1, $curso_id);
		$result->execute();	
		return $result->rowCount();		
	}
	
	function retornaTotalInscritos($curso_id, $conexao){	
			
		$select = 'SELECT * FROM tb_matricula WHERE matricula_curso_id = ?';
		$result = $conexao->prepare($select);
		$result->bindvalue(1, $curso_id);
		$result->execute();	
		return $result->rowCount();		
	}

	function totalPGpago($PGaprovado, $conexao, $valor_curso){	
			
		$valor = ($PGaprovado * $valor_curso);
		return number_format($valor,2);
	}

	function totalPGpendente($pendentes, $conexao, $valor_curso){	
			
		$valor = ($pendentes * $valor_curso);
		return number_format($valor,2);
	}


	function porcentagemPGpago($PGaprovado, $conexao, $valor_curso){	
			
		return $valor = (($PGaprovado * $valor_curso) / $valor_curso);	
	}

?>