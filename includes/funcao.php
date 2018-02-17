<?php

////////////////////////////////////////////////////////    PAGINA CADASTRO USUARIO     ////////////////////////////////////////////////////////////////

//Função para verificar se CPF é válido

	function validaCPF($cpf){
	 
		// Extrai somente os números
		$cpf = preg_replace( '/[^0-9]/is', '', $cpf );
		 
		// Verifica se foi informado todos os digitos corretamente
		if (strlen($cpf) != 11) {
			return false;
		}
		// Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
		if (preg_match('/(\d)\1{10}/', $cpf)) {
			return false;
		}
		// Faz o calculo para validar o CPF
		for ($t = 9; $t < 11; $t++) {
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf{$c} != $d) {
				return false;
			}
		}
		return true;
	}
	
//faço um array e retorno as informações necesárias 

	function verificaCPF($cpf, $conexao){

		$select = "SELECT login_cpf from tb_login WHERE login_cpf = ?";
				
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
	
//função para cadastrar novo usuario 

	function cadastraNovousuario($conexao, $cpf, $usuario, $email, $senha, $nivel, $status){

		$insert = "insert into tb_login (login_nome, login_email, login_cpf, login_senha, login_nivel, login_status) values (?, ?, ?, ?, ?, ?)";
		
		try{			
			$verifica = $conexao->prepare($insert);
			$verifica->bindValue(1, $usuario);
			$verifica->bindValue(2, $email);
			$verifica->bindValue(3, $cpf);							
			$verifica->bindValue(4, base64_encode($senha));				
			$verifica->bindValue(5, $nivel);
			$verifica->bindValue(6, $status);
			$verifica->execute();
						
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


?>