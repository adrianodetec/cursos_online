


<?php
	
	include("funcoes/funcao.php"); // declaro chamada de funções
	
	include("../conexao/conecta.php");
		
	$cursos_id = (isset($_GET['id'])) ? $_GET['id'] : '';  // recupero id do curso para trazer dados para o PDF
	
	//faço query paa recuperar dados do curso
		try{
			$select = "SELECT * from tb_cursos WHERE cursos_id = ?";	
			$result = $conexao->prepare($select);		
			$result->bindvalue(1, $cursos_id);
			$result->execute();			
			$dados = $result->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($dados as $mostra)
			{
				$nome_curso    = $mostra['cursos_nome'];	
				$carga_horaria = $mostra['cursos_carg_hr'];	
				$cursos_valor  = $mostra['cursos_valor'];	
					
			}
			
		}catch(PDOException $e){
			echo $e;
		}
	//fim query
	

	
	include ('pdf/mpdf.php');
	
	ob_start();
	session_start();
	$usuarioLogado = $_SESSION['usuario'];
	$retorna_dados_aluno = retornaIDaluno($usuarioLogado, $conexao);	
	//pego dia, mes e ano
	$data = new DateTime();	
	
	
	$html = 
		"<html>
			<body>	
					
				<p><b>CONTRATANTE:</b> <u><span class='converte_letras'> ".$retorna_dados_aluno['aluno_nome']." INSCRITO NO CPF Nº: ".$retorna_dados_aluno['aluno_cpf']."</span></u></p>
				<br>
		
				<strong>CONTRATADA</strong>: ESCOLA  DA  MAGISTRATURA  DO  ESTADO  DO  RIO  DE  JANEIRO   –  EMERJ,  COM  SEDE  NA  RUA  DOM  MANUEL,  25,  CENTRO- RIO  DE  JANEIRO,  INSCRITO   NO    CNPJ    SOB    O    Nº    35.949.858/0001- 81,  NESTE    ATO    REPRESENTADA    PELA  SECRETÁRIA-GERAL    DE    ENSINO,    SRA. ANA CRISTINA SARGENTELLI PORTO:		<p>
				&nbsp;</p>
			<p>
				As&nbsp;&nbsp; partes&nbsp; acima&nbsp; acordam&nbsp; com&nbsp; o&nbsp; presente &nbsp;Contrato&nbsp; de&nbsp; Presta&ccedil;&atilde;o&nbsp; de&nbsp; Servi&ccedil;os&nbsp; Educacionais,&nbsp; que&nbsp; se&nbsp;&nbsp; reger&aacute; pelas cl&aacute;usulas seguintes:&nbsp;</p>
			<p>
				&nbsp;</p>
			<p>
				<strong>DO OBJETO</strong></p>
				<p>&nbsp;</p>
			<p>
				CLÁUSULA 1ª -  Constitui objeto do presente Contrato a prestação de serviços educacionais pela  Contratada , referente ao Curso Livre de Direito Eletrônico, na modalidade a distância com tutoria, exclusivamente on line, em plataforma virtual de aprendizagem, disponibilizado no endereço eletrônico virtual.emerj.com.br 			<p>
				&nbsp;</p>
			<p>
				CLÁUSULA 2ª -  O curso é composto por 10 (dez) módulos, nos quais serão utilizados variados recursos educacionais, como videoaulas, materiais escritos, hipertextos, links para vídeos hospedados em páginas  eletrônicas externas, e outras estratégias adequadas aos objetos de aprendizagem propostos.			<p>
				&nbsp;</p>
			<p>
				CL&Aacute;USULA 3&ordf; - A carga hor&aacute;ria do curso &eacute; de <strong> ". $carga_horaria ." </strong> horas-aula, podendo, a crit&eacute;rio da EMERJ, oferecer horas excedentes de bonifica&ccedil;&atilde;o.</p>
			<p>
				&nbsp;</p>
			<p>
				CLÁUSULA 4ª - O conteúdo programático refere-se àquele divulgado na página da EMERJ e demais veiculações.  O curso será iniciado em 22.01.2018 e ficará disponível para acesso até 23.03.2018.			<p>
				Parágrafo único –  Havendo novas alterações na legislação de regência  acerca do conteúdo ministrado, a EMERJ não se obriga a oferecer complementação de conteúdo programático.  Mas, poderá ao seu turno, oferecer curso on line complementar, com incidência de novos custos.			<p>
				&nbsp;</p>
			<p>
				CL&Aacute;USULA 5 &ordf; - Para acessar o curso, o aluno precisar&aacute; ter acesso a um computador com conex&atilde;o &agrave; internet, cujos requisitos m&iacute;nimos de configura&ccedil;&atilde;o exigidos s&atilde;o:</p>
			<p>
				&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Processador Dual Core ou superior, 2 GB de mem&oacute;ria RAM;</p>
			<p>
				&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Windows 7, Mac OS 10.6;</p>
			<p>
				&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Navegador Internet Explorer, Google Chrome, Mozilla ou Safari (com o plugin Flash Player);</p>
			<p>
				&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Windows Media Player ou VLC player;</p>
			<p>
				&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pacote Office ou LibreOffice &nbsp;e Adobe Reader;</p>
			<p>
				&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Todos os aplicativos devem estar atualizados;</p>
			<p>
				&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; O curso tamb&eacute;m pode ser acessado de celulares ou tablets rodando Android (Google) ou iOS (Apple)</p>
			<p>
				&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Recomend&aacute;vel Internet banda Larga, velocidade a partir de 1 mbps para que os v&iacute;deos n&atilde;o sofram interrup&ccedil;&otilde;es.</p>
			<p>
				Par&aacute;grafo &uacute;nico:&nbsp; N&atilde;o &eacute; aconselh&aacute;vel a utiliza&ccedil;&atilde;o das tecnologias 3G e 4G, uma vez que a taxa de transfer&ecirc;ncia de dados pode sofrer varia&ccedil;&atilde;o e dificultar ou impedir o acesso ao curso, n&atilde;o sendo a EMERJ responsabilizada.</p>
			<p>
				&nbsp;</p>
			<p>
				CL&Aacute;USULA 6&ordf; -&nbsp; Atendidos os requisitos previstos na cl&aacute;usula 5&ordf;, o suporte para eventual dificuldade de acesso &agrave; plataforma do curso se dar&aacute; mediante o envio de mensagem, contendo a descri&ccedil;&atilde;o do problema, para emerj.virtual@tjrj.jus.br.</p>
			<p>
				&nbsp;</p>
			
				<strong>DA MATR&Iacute;CULA</strong></p>
			<p>
				&nbsp;</p>
			<p>
				CLÁUSULA 7ª - A prestação do serviço contratado é onerosa e exige a pré -matrícula do aluno, por meio do preenchimento de cadastro eletrônico, disponibilizado no endereço: www.emerj.tjrj.jus.br/cursos_livres/direito_eletronico/curso_livre_emerj.html, contendo dados pessoais  e/ou  outros  exigidos  pela  EMERJ  e  do  pagamento  antecipado,  através  de  depósito, identificado com CPF, em conta corrente do Fundo Especial da EMERJ- Banco Bradesco S/A (237), Agência: 6246-4, C/C: 3005-8, no valor de R$ 374,00 (trezentos e setenta e quatro reais).<p>
				Par&aacute;grafo Primeiro - &Eacute; vedado o fornecimento de informa&ccedil;&otilde;es cadastrais inexatas ou incompletas no ato do cadastramento para a pr&eacute;-matr&iacute;cula.</p>
			<p>
				Parágrafo Segundo - O contratante somente terá liberado o seu acesso ao curso após a confirmação do pagamento pelo banco.			<p>
				&nbsp;</p>
			<p>
				CLÁUSULA 8ª - Para a confirmação da matrícula, o aluno deverá enviar cópias digitalizadas do comprovante do depósito identificado realizado, da cópia da Identidade e do CPF para o e-mail: emerj.matriculaonline@tjrj.jus.br, até o dia 16/01/2018. O aluno receberá no e-mail indicado no seu cadastro de pré-matrícula, as informações de confirmação de matrícula, login e senha de acesso ao curso, através do e-mail: emerj.virtual@tjrj.jus.br, até o dia 19/01/2018.
				<p>&nbsp;</p>
			<p>
				CLÁUSULA 9ª - O login e a senha são de uso pessoal e intransferível, sendo vedada a cessão a terceiros, a qualquer título.  A senha garantirá o acesso à plataforma de aprendizagem no prazo de duração do curso, sendo bloqueada imediatamente após expirado esse período.
			</p>
				Par&aacute;grafo&nbsp; primeiro -&nbsp; O in&iacute;cio, adiamento ou cancelamento do curso sujeitam-se a um qu&oacute;rum m&iacute;nimo, a ser fixado pela contratada, conforme as suas disponibilidades t&eacute;cnicas e/ou log&iacute;sticas.</p>
			<p>&nbsp;</p>
			<p>
				CLÁUSULA 10ª - O aluno concorda e declara-se ciente de que a leitura e a aceitação eletrônica dos termos disponibilizados e condições ajustadas, nas fases de pré-matrícula e de matrícula, significarão integral e incondicional concordância a este contrato.</p>
				<p>Parágrafo primeiro - O início, adiamento ou cancelamento do curso sujeitam-se a um quórum mínimo, a ser fixado pela contratada, conforme as suas disponibilidades técnicas e/ou logísticas.</p>
				<p>Parágrafo segundo - Em caso de cancelamento do curso, o valor pago será integralmente devolvido ao aluno regularmente matriculado. </p>
			<p>
				&nbsp;</p>
			<p>						
			<p>
				<strong>DAS CONDI&Ccedil;&Otilde;ES PACTUADAS</strong></p>
			<p>
				&nbsp;</p>
			<p>				
				CLÁUSULA 11ª -  O aluno poderá enviar dúvidas sobre o conteúdo ministrado, no período do curso, por meio do ambiente virtual do curso, no “Fórum Tira Dúvidas”, onde as respostas dadas pelo professor-tutor também ficarão disponibilizadas.			<p>
				<p>&nbsp;</p>
				CLÁUSULA 12ª -  As dúvidas deverão ser formuladas em tese, de caráter geral e abstrato (situações hipotéticas), e não podendo referir-se a casos concretos, especificados ou que contenham outra forma de identificação.			<p>
				<p>&nbsp;</p>
				CLÁUSULA 13ª -  Não há número limite de perguntas que poderão ser enviadas pelo aluno, mas o professor não se obriga a responder a todas, ficando a seu critério a escolha daquelas que serão por ele respondidas.			<p>
				<p>&nbsp;</p>
				CLÁUSULA 14ª –  O módulo de início será disponibilizado no primeiro dia do curso. Os módulos subsequentes serão disponibilizados pela contratada de acordo com o cronograma disponível no ambiente de aprendizagem. <p>
				&nbsp;</p>
			<p>			
				<strong>DA RESPONSABILIDADE DO ALUNO</strong></p>
			<p>
				&nbsp;</p>
			<p>
				CLÁUSULA 15ª -  O conteúdo do curso on line é de uso exclusivo e pessoal do aluno matriculado, sendo vedada, por quaisquer meios e a qualquer título, a sua reprodução, cópia, divulgação e distribuição.			<p>
				<p>&nbsp;</p>
				CLÁUSULA 16ª -  O aluno não poderá ter mais de um acesso simultâneo à área restrita do site com a mesma senha. Tentativas nesse sentido implicarão bloqueio eletrônico imediato da senha em uso, ficando a  EMERJ autorizada a fazê-lo sem comunicação prévia ao contratante, independente da comprovação da culpa ou do dolo do aluno.			<p>
				<p>&nbsp;</p>
				CLÁUSULA 17ª –  Serão proibidas quaisquer condutas antissociais ou perigosas praticadas pelo contratante no ambiente virtual da EMERJ, tais como ofensas aos colegas e aos professores e tentativas de fraude ou manipulação do sistema.		<p>
				Parágrafo único: As sanções serão o afastamento temporário ou definitivo do aluno, e serão definidas de acordo com extensão do seu resultado.			<p>
				&nbsp;</p>
			<p>
				<strong>DO PAGAMENTO</strong></p>
			<p>
				&nbsp;</p>
			<p>
				CL&Aacute;USULA 18&ordf; -&nbsp; O valor do curso &eacute; <strong>R$ " . number_format($cursos_valor, 2) ." </strong>(trezentos e setenta e quatro reais).</p>
			<p>
				&nbsp;</p>
			<p>
				CL&Aacute;USULA 19&ordf; -&nbsp; N&atilde;o haver&aacute; restitui&ccedil;&atilde;o do valor pago pelo Contratante, salvo desist&ecirc;ncia manifestada expressamente e pr&eacute;via ao in&iacute;cio do curso para o e-mail emerjdifin@tjrj.jus.br, com a exposi&ccedil;&atilde;o clara e sucinta dos motivos.</p>
			<p>
				&nbsp;</p>
			<p>
				<strong>DO CERTIFICADO</strong></p>
			<p>
				&nbsp;</p>
			<p>
				CLÁUSULA 20ª -  Fará jus ao certificado o aluno que cumprir as etapas do curso na forma estruturada no ambiente virtual de aprendizagem e que obtiver, no mínimo, 70% (setenta por cento) de acertos na Avaliação Final, composta por 10 (dez) questões objetivas.  O certificado de conclusão de Curso Livre de Direito Eletrônico ficará disponível para download no ambiente virtual do curso, até 12.02.2018.			<p>
				&nbsp;</p>
			<br><br>
			<p>
				<strong>DAS DISPOSI&Ccedil;&Otilde;ES FINAIS</strong></p>
			<p>
			<p>
				&nbsp;</p>	
			<p>
				CL&Aacute;USULA 21&ordf; -&nbsp; O presente contrato rege-se pela legisla&ccedil;&atilde;o vigente.</p>
			<p>
				&nbsp;</p>
			<p>
				CL&Aacute;USULA 22&ordf; &ndash; &nbsp;Por estarem justos e contratados, assinam o presente instrumento, nos termos do aceite eletr&ocirc;nico de ".$retorna_dados_aluno['aluno_dt_cad'].". O presente contrato, com indicação do referido aceite eletrônico, será enviado pelo e-mail:  emerj.virtual@tjrj.jus.br, para o e-mail informado pelo aluno neste cadastro, após concordar com os termos do contrato.</p>
			<p>
				&nbsp;</p>
			<p>
				Rio de Janeiro , ".$data->format('d/m/Y')."</p>
			<p>
				&nbsp;
			</p>						
			
				<p>
					<u><span class='converte_letras'> ANA CRISTINA SARGENTELLI PORTO</span></u><br>
					<span class='converte_letras'>SECRETÁRIA-GERAL DA EMERJ</span><br>
					<span class='converte_letras'><b>CONTRATADA</b></span> 
				</p>
				<br>
				<p>
					<u><span class='converte_letras'> ".$retorna_dados_aluno['aluno_nome']." </span></u><br>
					<span class='converte_letras'><b>CONTRATANTE</b></span> 
				</p>
			
			
			</body>
		</html>
		";

$arquivo = "Cadastro01.pdf";

$mpdf=new mPDF('c'); 

$mpdf->SetDisplayMode('fullpage');

// LOAD a stylesheet
$stylesheet = file_get_contents('pdf/examples/mpdfstyleA4.css');

$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html);

$mpdf->Output($arquivo, 'I');

// I - Abre no navegador
// F - Salva o arquivo no servido
// D - Salva o arquivo no computador do usuário
?>
