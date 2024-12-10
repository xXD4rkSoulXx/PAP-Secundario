<!-- Começar a explicar a partir do HTML e só depois voltar aqui para cima -->
<!-- Inicio dos códigos PHP -->
<?php
	include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
	
	session_start(); //Inicia a sessão para puder fazer a verificação se estou logado ou não, sempre que preciso de usar alguma variável da session tenho que obrigatoriamente começar por esse código
	
	if(!isset($_SESSION["idutilizador"])) //Se o id do utilizador não exite:
	{
		$_SESSION["pagina"]="ConsultarProjetores.php"; //Variável que indica que página eu pretendia entrar para assim que fizer o login redirecionar-me de volta para esta página
		header("Location: Login.php"); //Manda para a página do Login por se o id do utilizador não existe significa que não efetoou o login
	}
	
	if(isset($_POST["selectvista"])) //Se mandei alterar a vista então:
	{
		$_SESSION["vista"]=$_POST["selectvista"]; //A variável de sessão recebe a opção que selecionei
		header("Location: ConsultarProjetores.php"); //Recarrega a página para a vista
	}
	
	//Ideia de redirecionar-me para a página que queria sem sucesso
	if(($_SESSION["tipo_utilizador"]=="A")) //Se o utilizador é Administrador
	{
		if(((!($_SESSION["tipo_utilizador"]=="A")) AND (!($_SESSION["vista"]=="A"))) AND ((!($_SESSION["vista"]=="E")))) //Se o utilizador não é administrador ou não está na vista de estagiário:
		{
			
			if($_SESSION["pagina"]=="ConsultarProjetores.php") //Se a página que estiver for a ConsultarProjetores.php, significa que provavelmente tinha tentado entrar nesta página mas redirecionou-me para a página de login por ainda não ter sessão inciada aí fiz o login mas a conta aonde estou não contêm permissões de administrador ou de estagiário então:
			{
				header("Location: Inicio.php"); //Manda para a página do início porque esta página é só para os administradores ou estagiários
			}
			else //Se não:
			{
				header("Location: " . $_SESSION["pagina"]); //Manda para a página que estava antes porque esta página é só para os administradores e estagiários
			}
		}
		
		if($_SESSION["vista"]=="N") //Se o tipo de vista é normal:
		{
			header("Location: Inicio.php"); //Manda para a página do início porque esta página é só para os administradores ou estagiários
		}
	}
	else //Se não:
	{
		if($_SESSION["tipo_utilizador"]=="N") //Se o utilizador não é estagiário:
		{
			header("Location: Inicio.php"); //Manda para a página do início porque esta página é só para os administradores ou estagiários
		}
	}
	//Ideia de redirecionar-me para a página que queria sem sucesso
	
	$_SESSION["pagina"]="ConsultarProjetores.php"; //Variável que indica que página eu estou para que assim que entre numa página que não contenha permissão redirecione-me de volta a esta página aonde estava antes
	
	if(isset($_SESSION["vista"])) //Se a variável vista existe então:
	{
		if($_SESSION["vista"]=="A") //Se a vista que tiver for a de administrador
		{
			echo "<script>" .
					 "window.addEventListener('load', function()" .
					 "{" . //Configura as páginas que tenho acesso e que não tenho numa variável global javascript
						 "sessionStorage.setItem('inserirutilizadores', true);" .
						 "sessionStorage.setItem('consultarutilizadores', true);" .
						 "sessionStorage.setItem('inseriragrupamentos', true);" .
						 "sessionStorage.setItem('consultaragrupamentos', true);" .
						 "sessionStorage.setItem('inserirescolas', true);" .
						 "sessionStorage.setItem('consultarescolas', true);" .
						 "sessionStorage.setItem('inserirblocos', true);" .
						 "sessionStorage.setItem('consultarblocos', true);" .
						 "sessionStorage.setItem('inserirsalas', true);" .
						 "sessionStorage.setItem('consultarsalas', true);" .
						 "sessionStorage.setItem('inserirequipamentos', true);" .
						 "sessionStorage.setItem('consultarequipamentos', true);" .
						 "sessionStorage.setItem('inseriravarias', true);" .
						 "sessionStorage.setItem('consultaravarias', true);" .
					 "});" .
				 "</script>";
		}
		elseif($_SESSION["vista"]=="E") //Se a vista que tiver for a de estagiário então:
			{
				echo "<script>" .
						 "window.addEventListener('load', function()" .
						 "{" . //Configura as páginas que tenho acesso e que não tenho numa variável global javascript
							 "sessionStorage.setItem('inserirutilizadores', false);" .
							 "sessionStorage.setItem('consultarutilizadores', false);" .
							 "sessionStorage.setItem('inseriragrupamentos', false);" .
							 "sessionStorage.setItem('consultaragrupamentos', true);" .
							 "sessionStorage.setItem('inserirescolas', false);" .
							 "sessionStorage.setItem('consultarescolas', true);" .
							 "sessionStorage.setItem('inserirblocos', false);" .
							 "sessionStorage.setItem('consultarblocos', true);" .
							 "sessionStorage.setItem('inserirsalas', false);" .
							 "sessionStorage.setItem('consultarsalas', true);" .
							 "sessionStorage.setItem('inserirequipamentos', false);" .
							 "sessionStorage.setItem('consultarequipamentos', true);" .
							 "sessionStorage.setItem('inseriravarias', true);" .
							 "sessionStorage.setItem('consultaravarias', true);" .
						 "});" .
					 "</script>";
			}
			elseif($_SESSION["vista"]=="N") //Se a vista que tiver for a de normal
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" . //Configura as páginas que tenho acesso e que não tenho numa variável global javascript
								 "sessionStorage.setItem('inserirutilizadores', false);" .
								 "sessionStorage.setItem('consultarutilizadores', false);" .
								 "sessionStorage.setItem('inseriragrupamentos', false);" .
								 "sessionStorage.setItem('consultaragrupamentos', false);" .
								 "sessionStorage.setItem('inserirescolas', false);" .
								 "sessionStorage.setItem('consultarescolas', false);" .
								 "sessionStorage.setItem('inserirblocos', false);" .
								 "sessionStorage.setItem('consultarblocos', false);" .
								 "sessionStorage.setItem('inserirsalas', false);" .
								 "sessionStorage.setItem('consultarsalas', false);" .
								 "sessionStorage.setItem('inserirequipamentos', false);" .
								 "sessionStorage.setItem('consultarequipamentos', false);" .
								 "sessionStorage.setItem('inseriravarias', true);" .
								 "sessionStorage.setItem('consultaravarias', false);" .
							 "});" .
						 "</script>";
				}
	}
	else //Se não como a variável vista não existe, vou procurar a permissão que a conta tem para ver as permissões:
	{
		if($_SESSION["tipo_utilizador"]=="A") //Se a vista que tiver for a de administrador
		{
			echo "<script>" .
					 "window.addEventListener('load', function()" .
					 "{" . //Configura as páginas que tenho acesso e que não tenho numa variável global javascript
						 "sessionStorage.setItem('inserirutilizadores', true);" .
						 "sessionStorage.setItem('consultarutilizadores', true);" .
						 "sessionStorage.setItem('inseriragrupamentos', true);" .
						 "sessionStorage.setItem('consultaragrupamentos', true);" .
						 "sessionStorage.setItem('inserirescolas', true);" .
						 "sessionStorage.setItem('consultarescolas', true);" .
						 "sessionStorage.setItem('inserirblocos', true);" .
						 "sessionStorage.setItem('consultarblocos', true);" .
						 "sessionStorage.setItem('inserirsalas', true);" .
						 "sessionStorage.setItem('consultarsalas', true);" .
						 "sessionStorage.setItem('inserirequipamentos', true);" .
						 "sessionStorage.setItem('consultarequipamentos', true);" .
						 "sessionStorage.setItem('inseriravarias', true);" .
						 "sessionStorage.setItem('consultaravarias', true);" .
					 "});" .
				 "</script>";
		}
		elseif($_SESSION["tipo_utilizador"]=="E") //Se a vista que tiver for a de estagiário
			{
				echo "<script>" .
						 "window.addEventListener('load', function()" .
						 "{" . //Configura as páginas que tenho acesso e que não tenho numa variável global javascript
							 "sessionStorage.setItem('inserirutilizadores', false);" .
							 "sessionStorage.setItem('consultarutilizadores', false);" .
							 "sessionStorage.setItem('inseriragrupamentos', false);" .
							 "sessionStorage.setItem('consultaragrupamentos', true);" .
							 "sessionStorage.setItem('inserirescolas', false);" .
							 "sessionStorage.setItem('consultarescolas', true);" .
							 "sessionStorage.setItem('inserirblocos', false);" .
							 "sessionStorage.setItem('consultarblocos', true);" .
							 "sessionStorage.setItem('inserirsalas', false);" .
							 "sessionStorage.setItem('consultarsalas', true);" .
							 "sessionStorage.setItem('inserirequipamentos', false);" .
							 "sessionStorage.setItem('consultarequipamentos', true);" .
							 "sessionStorage.setItem('inseriravarias', true);" .
							 "sessionStorage.setItem('consultaravarias', true);" .
						 "});" .
					 "</script>";
			}
			elseif($_SESSION["tipo_utilizador"]=="N") //Se a vista que tiver for a de normal
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" . //Configura as páginas que tenho acesso e que não tenho numa variável global javascript
								 "sessionStorage.setItem('inserirutilizadores', false);" .
								 "sessionStorage.setItem('consultarutilizadores', false);" .
								 "sessionStorage.setItem('inseriragrupamentos', false);" .
								 "sessionStorage.setItem('consultaragrupamentos', false);" .
								 "sessionStorage.setItem('inserirescolas', false);" .
								 "sessionStorage.setItem('consultarescolas', false);" .
								 "sessionStorage.setItem('inserirblocos', false);" .
								 "sessionStorage.setItem('consultarblocos', false);" .
								 "sessionStorage.setItem('inserirsalas', false);" .
								 "sessionStorage.setItem('consultarsalas', false);" .
								 "sessionStorage.setItem('inserirequipamentos', false);" .
								 "sessionStorage.setItem('consultarequipamentos', false);" .
								 "sessionStorage.setItem('inseriravarias', true);" .
								 "sessionStorage.setItem('consultaravarias', false);" .
							 "});" .
						 "</script>";
				}
	}
	
	echo "<meta charset='UTF-8'>"; //Permite as acentuações no PHP
	
	if(!isset($_SESSION["mensagemerro"])) //Se não houver mensagem de erro:
	{
		//Se não fizer essa verificação quando recarregar a página iria gerar o erros
		if(!isset($_SESSION["editado_eliminado"])) //Se ainda não cliquei no botão para editar ou eliminar:
		{
			if(isset($_GET["acao"])) //Se a variável acao existe, significa que cliquei ou no botão para editar ou no botão para eliminar
			{
				if($_GET["acao"]=="editar") //Se cliquei no botão para editar então:
				{
					if(isset($_GET["id"])) //Verifico se o id foi passado para não gerar erros
					{
						$idinvalido=false; //Inicializa a variável que vai verificar se o id é inválido a falso
						
						//Anotação: str_split() converte a string num array
						for($i=0; $i<count(str_split($_GET["id"])); $i++) //Vai repetir a quantidade de digitos, por exemplo, 57, repete 2 vezes
						{
							if(!preg_match("|[0-9]|", $_GET["id"][$i])) //Verifica se o id contém algum caractére além de números
							{
								$idinvalido=true; //Se conter algum caractére sem ser números, mete a variável idinválido a verdadeiro
							}
						}
					
						include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
						
						$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
						if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
						{
							$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
						
						$consultar_projetor=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, projetores p WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND tp.idprojetor=p.idprojetor AND tp.idprojetor>1 AND eq.idequipamento=" . $_GET["id"] . ";"); //Vai buscar o projetor que quero editar
						if($consultar_projetor) //Se não ocorreu nenhum erro:
						{
							$linhas_projetor=mysqli_num_rows($consultar_projetor); //Obtém o número de projetores com esse id
							if($linhas_projetor>0) //Se retornar mais que uma linha, significa que existe pelo menos um projetor então:
							{
								$dados_projetor=mysqli_fetch_array($consultar_projetor); //Vai buscar os dados do projetor que quero editar
								
								if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se estava uma pesquisa específica
								{
									if(isset($_GET["ordenadopor"])) //Se estava ordenado
									{
										$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão cancelar:
														   "{" .
														       "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar o projetor pois o que quer-se é cancelar e não editar
															   "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado e com o que estava ordenado
														   "});";
									}
									else //Se não
									{
										$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão cancelar:
														   "{" .
															   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar o projetor pois o que quer-se é cancelar e não editar
															   "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado
														   "});";
									}
								}
								else //Se não:
								{
									if(isset($_GET["ordenadopor"])) //Se estava ordenado
									{
										$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão cancelar:
														   "{" .
															   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar o projetor pois o que quer-se é cancelar e não editar
															   "location.href='?ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava ordenado
														   "});";
									}
									else //Se não
									{
										$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão cancelar:
														   "{" .
															   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar o projetor pois o que quer-se é cancelar e não editar
															   "location.href='ConsultarProjetores.php';" . //Manda de volta para a página que estava
														   "});";
									}
								}
								
								$consultar_sala=mysqli_query($conexao, "SELECT * FROM escolas e, blocos b, salas s WHERE e.idescola=b.idescola AND b.idbloco=s.idbloco ORDER BY e.idescola;"); //Vai buscar as salas de cada bloco de cada escola e os blocos de cada escola e as escolas
								if($consultar_sala) //Se não ocorreu nenhum erro:
								{
									$linhas_sala=mysqli_num_rows($consultar_sala); //Obtém o número de salas com esse id
									if($linhas_sala>0) //Se retornar mais que uma linha, significa que existe pelo menos uma sala então:
									{
										$selectsala="<select name=\'idsala\' class=\'dadotabela\' id=\'idsala\' title=\'Preselecionado: " . $dados_projetor["nome_escola"] . " " . $dados_projetor["nome_bloco"] . $dados_projetor["nome_sala"] . "\' style=\'width: 350px;\'>"; //A variável select vai receber o código HTML do select
										
										for($i=0; $i<$linhas_sala; $i++) /* Vai repetir o número de salas, por exemplo, se houver 10 salas vai repetir 10 vezes */
										{
											$dados_sala=mysqli_fetch_array($consultar_sala); //Vai buscar os dados das salas
											$selectsala.="<option value=\'" . $dados_sala["idsala"] . "\'>" . $dados_sala["nome_escola"] . " " . $dados_sala["nome_bloco"] . $dados_sala["nome_sala"] . "</option>"; //Aqui repete as opções até ser todas as salas de todos os blocos de todas as escolas existentes
										}
										
										$selectsala.="</select>";
										
										echo "<script>" .
												 "window.addEventListener('load', function()" .
												 "{" .
													 "document.getElementById('zonaconsultar').innerHTML='' +" . //A zona consultar vai receber o formulário para editar
																										"'<div class=\'zonatabela\' id=\'zonatabela\'>' +" . //Início da zona da tabela
																											"'<form name=\'frmEditar\' action=\'#\' method=\'POST\'>' +" . //Início do formulário para editar
																												"'<table class=\'tabela\' style=\'width: 2230px;\'>' +" . //Início da tabela
																													"'<thead>' +" . //Início da zona dos cabeçalhos com os títulos das colunas
																														"'<tr>' +" . //Início da linha da tabela
																															"'<th class=\'campotabela\'>Id</th>' +" . //Título dos Ids
																															"'<th class=\'campotabela\'>Tipo de projetor</th>' +" . //Título dos tipos de projetor
																															"'<th class=\'campotabela\'>Número de série</th>' +" . //Título dos números de série
																															"'<th class=\'campotabela\'>Posto</th>' +" . //Título dos postos
																															"'<th class=\'campotabela\'>Fabricante</th>' +" . //Título dos fabricantes 
																															"'<th class=\'campotabela\'>Modelo</th>' +" . //Título dos modelos
																															"'<th class=\'campotabela\'>Prioridade</th>' +" . //Título das prioridades
																															"'<th class=\'campotabela\'>Operacional</th>' +" . //Título dos operacionais
																															"'<th class=\'campotabela\'>Sala</th>' +" . //Título das salas
																															"'<th class=\'campotabela\'></th>' +" . //Nesta coluna conterá o botão para editar
																															"'<th class=\'campoultimo\'></th>' +" . //Nesta coluna conterá o botão para eliminar e possui a classe campoultimo porque as medidas são maiores para ficar alinhado com a barra de rolagem
																														"'</tr>' +" . //Fim da linha da tabela
																													"'</thead>' +" . //Fim da zona dos cabeçalhos com os títulos das colunas
																													"'<tbody>' +" . //Início da zona dos dados da tabela
																														"'<tr>' +" . //Início da linha da tabela
																															"'<td class=\'campotabela\'>' +" .
																																"'<label name=\'idprojetormostrado\'>" . $dados_projetor["idequipamento"] . "</label>' +" . //Aqui conterá o id do equipamento visível porém não permite passar via formulário sendo necessário criar a caixa de texto a baixo para puder passar via formulário
																																"'<input type=\'Text\' name=\'idprojetorescondidoalterar\' class=\'dadotabela\' id=\'idprojetorescondidoalterar\' value=\'" . $dados_projetor["idequipamento"] . "\' style=\'display: none;\'>' +" . //Aqui conterá o id do equipamento numa caixa de texto para puder mandar via formulário para depois puder fazer a verificação se o id do equipamento existe para verificar se mandei editar
																															"'</td>' +" .
																															"'<td class=\'campotabela\'>' +" .
																																"'<select name=\'tipo_projetor\' class=\'dadotabela\' id=\'tipo_projetor\' style=\'width: 120px;\'>' +" . //Caixa de seleção do tipo de projetor
																																	"'<option value=\'V\'>Videoprojetor</option>' +" .
																																	"'<option value=\'Q\'>Quadro interativo multimédia</option>' +" .
																																"'</select>' +" .
																															"'</td>' +" .
																															"'<td class=\'campotabela\'><input type=\'Text\' name=\'serial_number\' class=\'dadotabela\' id=\'serial_number\' maxlength=\'120\' value=\'" . $dados_projetor["serial_number"] . "\' style=\'width: 120px;\'></td>' +" . //Caixa de texto do número de série para puder editá-lo
																															"'<td class=\'campotabela\'><input type=\'Text\' name=\'posto\' class=\'dadotabela\' id=\'posto\' maxlength=\'120\' value=\'" . $dados_projetor["posto"] . "\' style=\'width: 120px;\'></td>' +" . //Caixa de texto do posto para puder editá-lo
																															"'<td class=\'campotabela\'><input type=\'Text\' name=\'fabricante\' class=\'dadotabela\' id=\'fabricante\' maxlength=\'120\' value=\'" . $dados_projetor["fabricante"] . "\' style=\'width: 120px;\'></td>' +" . //Caixa de texto do fabricante para puder editá-lo
																															"'<td class=\'campotabela\'><input type=\'Text\' name=\'modelo\' class=\'dadotabela\' id=\'modelo\' maxlength=\'120\' value=\'" . $dados_projetor["modelo"] . "\' style=\'width: 120px;\'></td>' +" . //Caixa de texto do modelo para puder editá-lo
																															"'<td class=\'campotabela\'>' +" .
																																"'<input type=\'Radio\' name=\'prioridade\' id=\'prioridadesim\' value=\'S\' required>Sim' +" .
																																"'<br>' +" .
																																"'<input type=\'Radio\' name=\'prioridade\' id=\'prioridadenao\' value=\'N\' required>Não' +" .
																															"'</td>' +" .
																															"'<td class=\'campotabela\'>' +" .
																																"'<input type=\'Radio\' name=\'operacional\' id=\'operacionalsim\' value=\'S\' required>Sim' +" .
																																"'<br>' +".
																																"'<input type=\'Radio\' name=\'operacional\' id=\'operacionalnao\' value=\'N\' required>Não' +" .
																															"'</td>' +" .
																															"'<td class=\'campotabela\'>" . $selectsala . "</td>' +" . //Caixa de seleção da escola do bloco da sala do projetor para puder editá-lo
																															"'<td class=\'campotabela\'><div align=\'Center\'><input type=\'Submit\' name=\'btneditar\' class=\'btntabela\' id=\'btneditar\' value=\'Confirmar\'></div></td>' +" . //Botão para confirmar a edição
																															"'<td class=\'campotabela\'><div align=\'Center\'><button class=\'btntabela\' id=\'btncancelar\'>Cancelar</button></div></td>' +" . //Botão para cancelar a edição
																														"'</tr>' +" . //Fim da linha da tabela
																													"'</tbody>' +" . //Fim da zona dos dados da tabela
																												"'</table>' +" . //Fim da tabela
																												"'<label id=\'erro\' style=\'color: Red;\'></label>' +" . //Aqui conterá os erros de validações como por exemplo email já existe ou email inválido ou nome tem números e não pode conter números ou outro erro que apareça
																											"'</form>' +" . //Fim do formulário para editar
																											"'<div class=\'zonamodal\' id=\'zonamodalconsultar\'>' +" . //Início da zona do modal
																												"'<div class=\'\' id=\'modalconsultar\'>' +" . //Início do modal
																													"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo
																													"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo
																													"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo
																													"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo
																													"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo
																													"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo
																													"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo
																													"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo
																													"'<div class=\'resposta\' id=\'respostaconsultar\'></div>' +" . //Aqui vai receber a confirmação se inseriu bem ou mal
																													"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo
																													"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo
																													"'<div id=\'zonabtnmodal\'>' +" . //Zona dos botões do modal
																														"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo
																														"'<button class=\'btnok\' id=\'btnokconsultar\'>Ok</button>' +" . //Botão para continuar
																													"'</div>' +" .
																												"'</div>' +" . //Fim do modal
																											"'</div>' +" . //Fim da zona do modal
																										"'</div>' +" . //Fim da zona da tabela
																										"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo
																										"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo
																										"'<div align=\'Center\' style=\'font-size: Josefin Sans;\'>' +" . //Centra a zona da fotografia
																											"'<h1> Alterar fotografia </h1>' +" . //Título do formulário
																											"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo
																											"'<br>' +" . //Dá uma quebra de linha para o resto ir para baixo 
																											"'<form name=\'frmEditarFotografia\' action=\'#\' method=\'POST\' enctype=\'multipart/form-data\'>' +" . //Início do formulário para atualizar a fotografia, Anotar: O enctype='multipart/form-data' é obrigatório quando quero usar o input type file e enviar para a base de dados com o PHP
																												"'<div class=\'zonafoto\' id=\'zonafotoalterar\'>' +" . //Zona de alterar a fotografia com botão
																													"'<div class=\'foto\' id=\'fotoalterar\'>' +" . //Zona de alterar a fotografia
																														"'<div class=\'bordasfoto\' id=\'bordasfotoalterar\'>' +" . //Bordas da fotografia
																															"'<img class=\'tagimg\' id=\'tagimg\'>' +" . //Fotografia
																														"'</div>' +" . //Fim das bordas da fotografia
																														"'<div>' +" . //Início do que fica quando a fotografia ainda não foi selecionada
																															"'<div class=\'iconenuvem\' id=\'iconenuvemalterar\'><i class=\'fa fa-cloud-upload\'></i></div>' +" . //Ícone da nuvem
																															"'<div class=\'texto\' id=\'textoalterar\'>Sem fotografia selecionada.</div>' +" . //Mensagem que ainda não foi inserido nenhuma fotografia para atualizar
																														"'</div>' +" . //Fim do que fica quando a fotografia ainda não foi selecionada
																														"'<div class=\'btnretirarfoto\' id=\'btnretirarfotoalterar\'><i class=\'fa fa-close\'></i></div>' +" . //Cruz para retirar a fotografia
																														"'<div class=\'nomeficheiro\' id=\'nomeficheiroalterar\'></div>' +" . //Nome da fotografia que vai ser atualizada
																													"'</div>' +" . //Fim da zona de atualizar a fotografia do projetor
																													"'<input type=\'File\' name=\'btnfotoalterarescondido\' class=\'btnfotoescondido\' id=\'btnfotoalterarescondido\' accept=\'image/jpeg, image/png, imagem/bmp\' required>' +" . //Botão para atualizar a fotografia, é obrigatório e fica escondido pois o botão não é muito giro mas é necessário para funcionar
																													"'<button class=\'btnalterar\' id=\'btnfotoalterarmostrado\'>Selecionar fotografia</button>' +" . //Botão mais bonito para atualizar a fotografia do projetor, ele em si é bonito mas não funciona, então quando clicar faz-se depois a programação para ativar o botão escondido de atualizar a fotografia
																													"'<div align=\'Center\'><label name=\'errofoto\' id=\'errofoto\' style=\'color: Red;\'></label></div>' +" . //Caso haja erro, aparecerá em baixo da fotografia
																												"'</div>' +" . //Fim da zona de atualizar a fotografia do projetor com o botão
																												"'<br>' +" .
																												"'<br>' +" .
																												"'<input type=\'Submit\' class=\'btnalterar\' name=\'btnalterarfotografia\' id=\'btnalterarfotografia\' value=\'Alterar fotografia\'>' +" . //Botão para alterar a fotografia
																											"'</form>' +" . //Fim do formulário para inserir salas
																										"'</div>';" . //Fim da zona de inserir a fotografia do projetor com o botão
																										
													 "document.getElementById('btnfotoalterarmostrado').addEventListener('click', function(e)" . //Quando clicar no botão de alterar fotografias que está à mostra
													 "{" .
														 "e.preventDefault();" . //Fica na mesma página
														 "document.getElementById('btnfotoalterarescondido').click();" . //O botão de alterar fotografias escondido recebe a indicação que é para ser clicado para poder escolher a fotografia, por este botão que está escondido é o que contêm o funcionamento e o botão visível é um botão maos bonito porém sem a capacidade de ter a mesma funcionalidade que este botão daí termos que programar que quando clicamos no botão bonito ativa o botão escondido
													 "});" .
													 
													 "document.getElementById('btnfotoalterarescondido').addEventListener('change', function()" . //Quando a fotografia mudar ou receber alguma fotografia:
													 "{" .
														 "var foto=document.getElementById('btnfotoalterarescondido').files[0];" . //A variável foto recebe a fotografia selecionada
														 
														 "document.getElementById('tagimg').addEventListener('click', function()" . //Quando clicar na fotografia:
														 "{" .
															 "Modal('foto', '');" . //Abre o modal fotografia para podermos ver a imagem toda
															 "document.getElementById('zonamodalconsultar').style.backgroundColor='rgba(0, 0, 0, 0.9)';" . //O fundo do modal fica mais escuro
															 
															 "document.getElementById('jsmodal').innerHTML='';" . //Retira o funcionamento do modal do javascript para puder a seguir adicionar o funcionamento do modal da fotografia sem haver erros
															 //A parte HTML do modal muda para consoante o modal da fotografia
															 "document.getElementById('zonamodalconsultar').innerHTML='<span class=\'fecharmodal\' id=\'fecharmodal\'><i class=\'fa fa-close\'></i></span>' +" . //Botão para fechar o modal da fotografia
																													 "'<img class=\'modalfoto\' id=\'modalfoto\'>' +" . //Aqui aparece a fotografia
																													 "'<div class=\'nomefoto\' id=\'nomefoto\'></div>' +" . //Aqui aparece o nome da fotografia
																												 "'</div>';" .
															 
															 "document.getElementById('modalfoto').src=document.getElementById('tagimg').src;" . //Faz o modal receber a fotografia
															 "document.getElementById('nomefoto').innerHTML=document.getElementById('nomeficheiroalterar').textContent;" . //Faz o modal receber o nome da fotografia
															 
															 "document.getElementById('fecharmodal').addEventListener('click', function()" . //Quando clicar para fechar o modal da fotografia:
															 "{" .
																 "document.getElementById('zonamodalconsultar').style.display='none';" . //Esconde o modal
																 "document.getElementById('zonamodalconsultar').style.backgroundColor='rgba(0, 0, 0, 0.4)';" . //O fundo do modal volta a estar mais claro
																 "document.getElementById('nomefoto').innerHTML='';" . //Retira a fotografia do modal
																 
																 //A parte HTML do modal volta a ter os códigos que tinha respetisoa aos outros modals
																 "document.getElementById('zonamodalconsultar').innerHTML='<div class=\'\' id=\'modalconsultar\'>' +" .
																															 "'<br>' +" .
																															 "'<br>' +" .
																															 "'<br>' +" .
																															 "'<br>' +" .
																															 "'<br>' +" .
																															 "'<br>' +" .
																															 "'<br>' +" .
																															 "'<br>' +" .
																															 "'<div class=\'resposta\' id=\'respostaconsultar\'></div>' +" .
																															 "'<br>' +" .
																															 "'<br>' +" .
																															 "'<div id=\'zonabtnmodal\'>' +" .
																																 "'<br>' +" .
																																 "'<button class=\'btnok\' id=\'btnokconsultar\'>Ok</button>' +" .
																															 "'</div>' +" .
																														 "'</div>';" .
																														 
																 //O javascript do modal volta a ter os códigos javascript respetivos aos outros modals
																 "document.getElementById('jsmodal').innerHTML='function Modal(tipo, mensagem)' +" .
																											  "'{' +" .
																												  "'switch(tipo)' +" .
																												  "'{' +" .
																													  "'case \'certo\': document.getElementById(\'respostaconsultar\').style.color=\'#1CEE0E\';' +" .
																																	  "'document.getElementById(\'btnokconsultar\').style.backgroundColor=\'#1CEE0E\';' +" .
																																	  
																																	  "'document.getElementById(\'btnokconsultar\').addEventListener(\'mouseover\', function()' +" .
																																	  "'{' +" .
																																		  "'document.getElementById(\'btnokconsultar\').style.backgroundColor=\'#2DAB24\';' +" .
																																	  "'});' +" .
																																	  
																																	  "'document.getElementById(\'btnokconsultar\').addEventListener(\'mouseout\', function()' +" .
																																	  "'{' +" .
																																		  "'document.getElementById(\'btnokconsultar\').style.backgroundColor=\'#1CEE0E\';' +" .
																																	  "'});' +" .
																																	  "'break;' +" .
																																	  
																													  "'case \'erro\': document.getElementById(\'respostaconsultar\').style.color=\'#E63946\';' +" .
																																	 "'document.getElementById(\'btnokconsultar\').style.backgroundColor=\'#E63946\';' +" .
																																	 
																																	 "'document.getElementById(\'btnokconsultar\').addEventListener(\'mouseover\', function()' +" .
																																	 "'{' +" .
																																		 "'document.getElementById(\'btnokconsultar\').style.backgroundColor=\'#DD3C48\';' +" .
																																	 "'});' +" .
																																	 
																																	 "'document.getElementById(\'btnokconsultar\').addEventListener(\'mouseout\', function()' +" .
																																	 "'{' +" .
																																		 "'document.getElementById(\'btnokconsultar\').style.backgroundColor=\'#E63946\';' +" .
																																	 "'});' +" .
																																	 "'break;' +" .
																																	 
																													  "'case \'utilizador\': document.getElementById(\'respostaconsultar\').style.color=\'#000000\';' +" .
																																		   "'break;' +" .
																																		   
																													  "'case \'escola\': document.getElementById(\'respostaconsultar\').style.color=\'#000000\';' +" .
																																	   "'break;' +" .
																																	   
																													  "'case \'qim\': document.getElementById(\'respostaconsultar\').style.color=\'#000000\';' +" .
																																	"'break;' +" .
																																	
																													  "'case \'computador\': document.getElementById(\'respostaconsultar\').style.color=\'#000000\';' +" .
																																		   "'break;' +" .
																																		   
																													  "'case \'monitor\': document.getElementById(\'respostaconsultar\').style.color=\'#000000\';' +" .
																																		"'break;' +" .
																																		
																													  "'case \'projetor\': document.getElementById(\'respostaconsultar\').style.color=\'#000000\';' +" .
																																		 "'break;' +" .
																																		 
																													  "'case \'avaria\': document.getElementById(\'respostaconsultar\').style.color=\'#000000\';' +" .
																																	   "'break;' +" .
																																	   
																													  "'case \'foto\': ' +" .
																																	 "'break;' +" .
																												  "'}' +" .
																												  
																												  "'if(!(document.getElementById(\'btnokconsultar\')==null))' +" .
																												  "'{' +" .
																													  "'document.getElementById(\'btnokconsultar\').addEventListener(\'click\', function()' +" .
																													  "'{' +" .
																														  "'location.href=\'ConsultarProjetores.php\';' +" .
																													  "'});' +" .
																													  
																													  "'if(!(document.getElementById(\'modalconsultar\')==null))' +" .
																													  "'{' +" .
																														  "'if(mensagem.length>200)' +" .
																														  "'{' +" .
																															  "'document.getElementById(\'modalconsultar\').style.height=\'450px\';' +" .
																														  "'}' +" .
																														  "'else if(mensagem.length>100)' +" .
																															   "'{' +" .
																																   "'document.getElementById(\'modalconsultar\').style.height=\'400px\';' +" .
																															   "'}' +" .
																															   "'else' +" .
																															   "'{' +" .
																																   "'document.getElementById(\'modalconsultar\').style.height=\'330px\';' +" .
																															   "'}' +" .
																													  "'}' +" .
																													 
																													 "'document.getElementById(\'modalconsultar\').className=\'modal\' + tipo;' +" .
																													 "'document.getElementById(\'respostaconsultar\').innerHTML=mensagem;' +" .
																													 "'document.getElementById(\'zonamodalconsultar\').style.display=\'block\';' +" .
																												 "'}' +" .
																											  "'}';" .
															 "});" .
														 "});" .
														 
														 "if(foto)" . //Se a fotografia existe:
														 "{" .
															 "var ler=new FileReader();" . //Variável preparada para receber ficheiros ou imagens
															 
															 "ler.addEventListener('load', function()" . //Quando receber algum ficheiro ou imagem:
															 "{" .
																 "var bytesfoto=ler.result;" . //Variável que vai receber os bytes da fotografia
																 
																 "document.getElementById('tagimg').src=bytesfoto;" . //A zona da fotografia recebe a fotografia
																 "document.getElementById('tagimg').style.cursor='pointer';" . //Quando meto o rato por cima da fotografia o ponteiro do rato muda para o indicador
																 "document.getElementById('tagimg').title='Clique para ver melhor';" . //Quando meto o rato por cima da fotografia aparece uma mensagem a dizer para clicar na fotografia para ver melhor
																 "document.getElementById('fotoalterar').classList.add('escolhida');" . //A fotografia recebe os estilos CSS relativos a uma fotografia já escolhida
															 "});" .
															 
															 "document.getElementById('btnretirarfotoalterar').addEventListener('click', function()" . //Quando clicar no botão para retirar a fotografia:
															 "{" .
																 "document.getElementById('tagimg').src='';" . //Retira a fotografia
																 "document.getElementById('tagimg').style.cursor='context-menu';" . //O ponteiro do rato volta ao normal
																 "document.getElementById('tagimg').title='';" . //Retira a mensagem que apareceria quando metia o rato por cima da fotografia por não faz sentido dizer para clicar para ver uma fotografia que não existe pois ela já foi removida
																 "document.getElementById('btnfotoalterarescondido').value='';" . //O botão de alterar fotografia que está escondido é resetado e fica pronto para receber uma nova fotografia
																 "document.getElementById('fotoalterar').classList.remove('escolhida');" . //A fotografia é-lhe removida os estilos CSS relativos a uma fotografia já escolhida
															 "});" .
															 
															 "ler.readAsDataURL(foto);" . //Faz a conversão dos dados da fotografia para poder ser vista no HTML
															 
															 "if(document.getElementById('btnfotoalterarescondido').value)" . //Se a fotografia tem nome e não existe nenhum erro:
															 "{" .
																 //A zona da fotografia recebe o nome da fotografia sem o caminho da pasta atrás assim ficando só o nome e a extensão
																 "document.getElementById('nomeficheiroalterar').textContent=document.getElementById('btnfotoalterarescondido').value.match(/[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/);" .
															 "}" .
														 "}" .
													 "});" .
													 
													 $codigobtncancelar . //Executa o código do botão cancelar
												 "});" .
											 "</script>";
											 
										echo "<script>" .
												 "window.addEventListener('load', function()" .
												 "{" .
													 "document.getElementById('tipo_projetor').value='" . $dados_projetor["tipo"] . "';" . //A caixa de seleção do tipo do projetor fica com o que já estava selecionado
													 
													 "if('" . $dados_projetor["prioridade"] . "'=='S')" . //Se o projetor tinha prioridade então:
													 "{" .
														 "document.getElementById('prioridadesim').click();" . //Volta a selecionar a opção sim
													 "}" .
													 "else if('" . $dados_projetor["prioridade"] . "'=='N')" . //Se não se o projetor não tinha prioridade então:
														  "{" .
															  "document.getElementById('prioridadenao').click();" . //Volta a selecionar a opção não
														  "}" .
														  "else" . //Se não se acontecer um erro inesperado:
														  "{" .
															  "document.getElementById('erro').value='Erro desconhecido a verificar qual opção de prioridade estava selecionada, por favor contacte o Administrador.';" . //Escreve a mensagem de erro
														  "}" .
													 
													 "if('" . $dados_projetor["operacional"] . "'=='S')" . //Se o projetor está operacional então:
													 "{" .
														 "document.getElementById('operacionalsim').click();" . //Volta a selecionar a opção sim
													 "}" .
													 "else if('" . $dados_projetor["operacional"] . "'=='N')" . //Se não se o projetor não está operacional então:
														  "{" .
															  "document.getElementById('operacionalnao').click();" . //Volta a selecionar a opção não
														  "}" .
														  "else" . //Se não se acontecer um erro inesperado:
														  "{" .
															  "document.getElementById('erro').value='Erro desconhecido a verificar qual opção de operacional estava selecionada, por favor contacte o Administrador.';" . //Escreve a mensagem de erro
														  "}" .
													 
													 "document.getElementById('idsala').value='" . $dados_projetor["idsala"] . "';" . //A caixa de seleção do idsala fica com o que já estava selecionado
												 "});" .
											 "</script>";
									}
									elseif($linhas_sala==0) //Se as linhas são 0 significa que não existe ninguém com esse id então:
										{
											header("Location: ?mensagem=O_Id_que_digitou_nao_existe"); //Manda de volta para a página e aparece uma mensagem a dizer que o id que digitou não existe
										}
										elseif($linhas_sala<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
											{
												$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
												header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
											}
								}
								else //Se não significa que ocorreu um erro ou na base de dados ou o id que passou é inválido e contém catactéres além de números:
								{
									$_SESSION["mensagemerro"]="Erro ao consultar as salas, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
							elseif($linhas_projetor==0) //Se as linhas são 0 significa que não existe ninguém com esse id então:
								{
									header("Location: ?mensagem=O_Id_que_digitou_nao_existe"); //Manda de volta para a página e aparece uma mensagem a dizer que o id que digitou não existe
								}
								elseif($linhas_projetor<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
									{
										$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
										header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
									}
						}
						else //Se não significa que ocorreu um erro ou na base de dados ou o id que passou é inválido e contém catactéres além de números:
						{
							if(!$idinvalido) //Se o id não é inválido então significa que houve algum erro na base de dados então:
							{
								$_SESSION["mensagemerro"]="Erro ao consultar os projetores, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
							else //Se não como o id é inválido:
							{
								header("Location: ?mensagem=O_id_so_pode_conter_numeros"); //Recarrega a página e manda mensagem a dizer que o id só pode conter números
							}
						}
					}
				}
				
				if($_GET["acao"]=="eliminar") //Se cliquei no botão para eliminar então
				{
					if(!(isset($_POST["idprojetorescondidoeliminar"]))) //Se ainda não confirmei que quero eliminar:
					{
						if(isset($_GET["id"])) //Verifico se o id foi passado para não gerar erros
						{
							if(isset($_SESSION["vista"])) //Se a variável sessão existe então:
							{
								if($_SESSION["vista"]=="E") //Se a vista é de estagiário:
								{
									header("Location: ConsultarProjetores.php"); //Recarrega a página e bloqueia a permissão para puder eliminar dados
								}
							}
							else //Se não:
							{
								if($_SESSION["tipo_utilizador"]=="E") //Se o utilizador é um estagiário então:
								{
									header("Location: ConsultarProjetores.php"); //Recarrega a página e bloqueia a pesmissão para puder eliminar dados
								}
							}
							
							$idinvalido=false; //Inicializa a variável que vai verificar se o id é inválido a falso
							
							//Anotação: str_split() converte a string num array
							for($i=0; $i<count(str_split($_GET["id"])); $i++) //Vai repetir a quantidade de digitos, por exemplo, 57, repete 2 vezes
							{
								if(!preg_match("|[0-9]|", $_GET["id"][$i])) //Verifica se o id contém algum caractére além de números
								{
									$idinvalido=true; //Se conter algum caractére sem ser números, mete a variável idinválido a verdadeiro
								}
							}
							
							include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
							
							$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
							if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
							{
								$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
							
							$consultar_projetor=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, projetores p WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND tp.idprojetor=p.idprojetor AND tp.idprojetor>1 AND eq.idequipamento=" . $_GET["id"] . ";"); //Vai buscar o projetor que quero eliminar
							if($consultar_projetor) //Se não ocorreu nenhum erro:
							{
								$linhas_projetor=mysqli_num_rows($consultar_projetor); //Obtém o número de projetores com esse id
								if($linhas_projetor>0) //Se retornar mais que uma linha, significa que existe pelo menos um projetor então:
								{
									if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se estava uma pesquisa específica
									{
										if(isset($_GET["ordenadopor"])) //Se estava ordenado
										{
											$codigobtnnao="document.getElementById('btnnao').addEventListener('click', function(e)" . //Quando clicar no botão não:
														  "{" .
														      "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar o projetor pois o que quer-se é cancelar e não eliminar
															  "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado e com o que estava ordenado
														  "});";
										}
										else //Se não
										{
											$codigobtnnao="document.getElementById('btnnao').addEventListener('click', function(e)" . //Quando clicar no botão não:
														  "{" .
															  "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar o projetor pois o que quer-se é cancelar e não eliminar
															  "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado
														  "});";
										}
									}
									else //Se não:
									{
										if(isset($_GET["ordenadopor"])) //Se estava ordenado
										{
											$codigobtnnao="document.getElementById('btnnao').addEventListener('click', function(e)" . //Quando clicar no botão não:
														  "{" .
														      "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar o projetor pois o que quer-se é cancelar e não eliminar
															  "location.href='?ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava ordenado
														  "});";
										}
										else //Se não
										{
											$codigobtnnao="document.getElementById('btnnao').addEventListener('click', function(e)" . //Quando clicar no botão não:
														  "{" .
															  "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar o projetor pois o que quer-se é cancelar e não eliminar
															  "location.href='ConsultarProjetores.php';" . //Manda de volta para a página que estava
														  "});";
										}
									}
									
									echo "<script>" .
											 "window.addEventListener('load', function()" .
											 "{" .
												 "document.getElementById('zonabtnmodal').innerHTML='<br><button class=\'btnmetade\' id=\'btnnao\'>Não</button> <button class=\'btnmetade\' id=\'btnsimmostrado\'>Sim</button>';" . //Faz aparecer os botões de não e sim
												 
												 "document.getElementById('btnnao').style.backgroundColor='#E63946';" . //O botão não fica vermelho
												 
												 "document.getElementById('btnnao').addEventListener('mouseover', function()" . //Quando passar com o rato por cima do botão:
												 "{" .
													"document.getElementById('btnnao').style.backgroundColor='#DD3C48';" . //O botão não fica com um vermelho mais claro
												 "});" .
												 
												 "document.getElementById('btnnao').addEventListener('mouseout', function()" .  //Quando retirar o rato de cima do botão:
												 "{" .
													 "document.getElementById('btnnao').style.backgroundColor='#E63946';" . //O botão não volta à cor que tinha
												 "});" .
												 
												 "document.getElementById('btnsimmostrado').style.backgroundColor='#1CEE0E';" . //O botão sim fica verde
												 
												 "document.getElementById('btnsimmostrado').addEventListener('mouseover', function()" . //Quando passar com o rato por cima do botão:
												 "{" .
													"document.getElementById('btnsimmostrado').style.backgroundColor='#2DAB24';" . //O botão sim fica com um verde mais claro
												 "});" .
												 
												 "document.getElementById('btnsimmostrado').addEventListener('mouseout', function()" .  //Quando retirar o rato de cima do botão:
												 "{" .
													 "document.getElementById('btnsimmostrado').style.backgroundColor='#1CEE0E';" . //O botão sim volta à cor que tinha
												 "});" .
												 
												 //Abre o modal de aviso e pergunta se desejo mesmo eliminar
												 "Modal('aviso', '' +" .
																"'Deseja mesmo eliminar?' +" .
																"'<form name=\'frmCertezaEliminar\' action=\'#\' method=\'POST\'>' +" .
																	"'<input type=\'Text\' name=\'idprojetorescondidoeliminar\' class=\'dadotabela\' id=\'idprojetorescondidoeliminar\' value=\'" . $_GET["id"] . "\' style=\'display: none;\'>' +" . //Mete o id do projetor escondido para depois poder verificar se mandei mesmo eliminar
																	"'<input type=\'Submit\' name=\'btnsimescondido\' id=\'btnsimescondido\' style=\'display: None;\'>' +" . //Botão do formulário escondido porque haverá outro visível com um visual melhor para mandar eliminar o projetor
																"'</form>'" .
												 ");" .
												 
												 $codigobtnnao . //Executa o código do botão não
												 
												 "document.getElementById('btnsimmostrado').addEventListener('click', function()" . //Quando clicar no botão sim:
												 "{" .
													 "document.getElementById('btnsimescondido').click();" . //Faz com que o botão sim escondido seja clicado para puder eliminar
												 "});" .
											 "});" .
										 "</script>";
								}
								elseif($linhas_projetor==0) //Se não se as linhas são 0, significa que não existe ninguém com esse id então:
									{
										header("Location: ?mensagem=O_Id_que_digitou_nao_existe"); //Recarrega a página passando uma mensagem a dizer que o id que digitou não existe
									}
									elseif($linhas_projetor<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
										{
											$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
							}
							else //Se não significa que houve um erro ou na base de dados ou o id é inválido:
							{
								if(!$idinvalido) //Se o id não é inválido então:
								{
									$_SESSION["mensagemerro"]="Erro ao consultar os projetores, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
								else //Se não:
								{
									header("Location: ?mensagem=O_id_so_pode_conter_numeros"); //Recarrega a página e passa a mensagem de erro que o id é inválido
								}
							}
						}
					}
				}
			}
			
			if(isset($_POST["idprojetorescondidoalterar"])) //Se mandei alterar os dados e já confirmei então:
			{
				//Retira os espaços em branco (trim) de trás e da frente, por exemplo, "          Dado          " passa para "Dado"
				$idequipamento=trim($_GET["id"]);
				$tipo_projetor=trim($_POST["tipo_projetor"]);
				$serial_number=trim($_POST["serial_number"]);
				$posto=trim($_POST["posto"]);
				$fabricante=trim($_POST["fabricante"]);
				$modelo=trim($_POST["modelo"]);
				$prioridade=trim($_POST["prioridade"]);
				$operacional=trim($_POST["operacional"]);
				$idsala=trim($_POST["idsala"]);
				
				include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
				
				$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
				if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
				{
					$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
				
				$consultar_projetor=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, projetores p WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND tp.idprojetor=p.idprojetor AND tp.idprojetor>1 AND eq.idequipamento=" . $idequipamento . ";"); //Vai buscar o projetor que quero editar
				if($consultar_projetor) //Se não ocorreu nenhum erro:
				{
					$linhas_projetor=mysqli_num_rows($consultar_projetor); //Obtém o número de projetores com esse id
					if($linhas_projetor>0) //Se retornar mais que uma linha, significa que existe pelo menos um projetor então:
					{
						$dados_projetor=mysqli_fetch_array($consultar_projetor); //Vai buscar os dados do projetor que quero editar
						$idprojetor=$dados_projetor["idprojetor"];
					}
					elseif($linhas_projetor==0) //Se as linhas são 0 significa que não existe ninguém com esse id então:
						{
							$_SESSION["mensagemerro"]="Erro a procurar o id do projetor, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
						elseif($linhas_projetores<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
							{
								$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
				}
				else //Se não significa que ocorreu um erro ou na base de dados ou o id que passou é inválido e contém catactéres além de números:
				{
					$_SESSION["mensagemerro"]="Erro ao consultar os projetores, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
				
				//Mete as variáveis a falso
				$erro=false;
				
				//Nota: Isto é uma função, significa que o código só é executado quando eu chamar a função
				echo "<script>" .
						 //Cria uma função de Validação cujo os parâmetros serão o campo com erro e a mensagem de erro com o objetivo se simplificar e minimizar o código
						 "function Validacao(campo, mensagem)" .
						 "{" .
							 "document.getElementById('tipo_projetor').value='" . $tipo_projetor . "';" . //A caixa de texto do tipo de projetor volta a ter o que estava lá escrito
							 "document.getElementById('serial_number').value='" . $serial_number . "';" . //A caixa de texto do número de série volta a ter o que estava lá escrito
							 "document.getElementById('posto').value='" . $posto . "';" . //A caixa de texto do posto volta a ter o que estava lá escrito
							 "document.getElementById('fabricante').value='" . $fabricante . "';" . //A caixa de texto do fabricante volta a ter o que estava lá escrito
							 "document.getElementById('modelo').value='" . $modelo . "';" . //A caixa de texto do modelo volta a ter o que estava lá escrito
							 "document.getElementById('idsala').value='" . $idsala . "';" . //A caixa de seleção do id da sala volta a ter o que estava lá selecionado
							 
							 "if('" . $prioridade . "'=='S')" . //Se o projetor tinha prioridade então:
							 "{" .
								 "document.getElementById('prioridadesim').click();" . //Volta a selecionar a opção sim
							 "}" .
							 "else if('" . $prioridade . "'=='N')" . //Se não se o projetor não tinha prioridade então:
								  "{" .
								      "document.getElementById('prioridadenao').click();" . //Volta a selecionar a opção não
								  "}" .
								  "else" . //Se não se acontecer um erro inesperado:
								  "{" .
									  "document.getElementById('erro').value='Erro desconhecido a verificar qual opção de prioridade estava selecionada, por favor contacte o Administrador.';" . //Escreve a mensagem de erro
								  "}" .
							 
							 "if('" . $operacional . "'=='S')" . //Se o projetor está operacional então:
							 "{" .
								 "document.getElementById('operacionalsim').click();" . //Volta a selecionar a opção sim
							 "}" .
							 "else if('" . $operacional . "'=='N')" . //Se não se o projetor não está operacional então:
								  "{" .
									  "document.getElementById('operacionalnao').click();" . //Volta a selecionar a opção não
								  "}" .
								  "else" . //Se não se acontecer um erro inesperado:
								  "{" .
									  "document.getElementById('erro').value='Erro desconhecido a verificar qual opção de operacional estava selecionada, por favor contacte o Administrador.';" . //Escreve a mensagem de erro
								  "}" .
							 
							 "document.getElementById('erro').innerHTML+=mensagem + '<br><br>';" . //A zona de erro recebe a mensagem de erro
							 "document.getElementById(campo).style.borderColor='red';" . //As bordas das caixas com erro ficam a vermelho
						 "}" .
					 "</script>";
				
				if($serial_number=="") //Se o número de série está vazio vai aparecer uma mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('serial_number', 'O número de série não foi preenchido.');" . //Usa a função acima que criei indicando o campo com erro (serial_number) e a mensagem de erro (O número de série não foi preenchido)
							 "});" .
						 "</script>";
					
					$erro=true; //A variável que indica o erro fica verdadeiro
				}
				else //Se não:
				{
					include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
					
					$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
					if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
					{
						$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
						
					$consultar_serial_number=mysqli_query($conexao, "SELECT * FROM equipamentos WHERE serial_number='" . $serial_number . "';"); //Verifica se já existe alguma equipamento com esse número de série
					if($consultar_serial_number) //Se não ocorreu nenhum erro:
					{
						$linhas_serial_number=mysqli_num_rows($consultar_serial_number); //Obtém o número de equipamentos com esse número de série
						if($linhas_serial_number==1) //Se retornar uma linha significa que já existe um equipamento com esse número de série
						{
							$consultar_serial_number_antigo=mysqli_query($conexao, "SELECT * FROM equipamentos WHERE idequipamento=" . $idequipamento . ";"); //Vai buscar o email antigo base de dados
							if($consultar_serial_number_antigo) //Se não ocorreu nenhum erro:
							{
								$linhas_serial_number_antigo=mysqli_num_rows($consultar_serial_number_antigo); //Obtém o número de equipamentos com esse número de série
								if($linhas_serial_number_antigo==1) //Se retornar uma linha significa que a pesquisa foi bem feita
								{
									$dados_serial_number=mysqli_fetch_array($consultar_serial_number); //Recebe os dados do equipamento
									$dados_serial_number_antigo=mysqli_fetch_array($consultar_serial_number_antigo); //Recebe os dados do equipamento que mandei editar
									
									if($dados_serial_number["serial_number"]!=$dados_serial_number_antigo["serial_number"]) //Se o número de série que digitei existe e não é o número de série antigo que tinha então:
									{
										echo "<script>" .
												 "window.addEventListener('load', function()" .
												 "{" .
													 "Validacao('serial_number', 'O número de série que introduziu já existe.');" . //Usa a função acima que criei indicando o campo com erro (serial_number) e a mensagem de erro (O número de série que introduziu já existe)
												 "});" .
											 "</script>";
										
										$erro=true; //A variável que indica o erro fica verdadeiro
									}
								}
								elseif($linhas_serial_number_antigo==0) //Se não se retornar 0 linhas, significa que houve algum erro a procurar o número de série antigo então:
									{
										$_SESSION["mensagemerro"]="Erro a procurar o número de série antigo, por favor informe o administrador."; //Passa a mensagem de erro
										header("Location: ConsultarProjetores.php");  //Recarrega a página passando o erro para abrir o modal de erro
									}
									elseif($linhas_serial_number_antigo>1) //Se não se retornar mais que uma linha, significa que existe 2 equipamentos com esse número de série e um equipamento não pode ter um número de série que já existe então:
										{
											$_SESSION["mensagemerro"]="Erro. O número de série antigo existe mais que uma vez na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarProjetores.php");  //Recarrega a página passando o erro para abrir o modal de erro
										}
										elseif($linhas_serial_number_antigo<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
											{
												$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
												header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
											}
							}
							else //Se não:
							{
								$_SESSION["mensagemerro"]="Erro ao consultar o número de série antigo, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
						elseif($linhas_serial_number>1) //Se não se retornar mais que uma linha, significa que existe 2 equipamentos com esse número de série na base de dados que não se pode repetir então:
							{
								$_SESSION["mensagemerro"]="Erro. O número de série que introduziu existe mais que uma vez na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarProjetores.php");  //Recarrega a página passando o erro para abrir o modal de erro
							}
							elseif($linhas_serial_number<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
								{
									$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
					}
					else //Se não:
					{
						$_SESSION["mensagemerro"]="Erro ao consultar se o número de série já existe, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
				
				if($posto=="") //Se o posto está vazio vai aparecer uma mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('posto', 'O posto não foi preenchido.');" . //Usa a função acima que criei indicando o campo com erro (posto) e a mensagem de erro (O posto não foi preenchido)
							 "});" .
						 "</script>";
					
					$erro=true; //A variável que indica o erro fica verdadeiro
				}
				else //Se não:
				{
					//Anotação: str_split() converte a string num array
					for($i=0; $i<count(str_split($posto)); $i++) //Vai repetir a quantidade de dígitos, por exemplo, 15, repete 2 vezes
					{
						if(!$erro) //Se ainda não houve erro:
						{
							//Verifica cada dígito se algum não é um número, se for um dígito por exemplo 2 de 23, ignora o if porque o if só está configurado em caso de erro, agora se for um dígito não é um número por exemplo D de 23D, aí entra no if para retornar erro
							if(!preg_match("|[0-9]|", $posto[$i]))
							{
								echo "<script>" .
										 "window.addEventListener('load', function()" .
										 "{" .
											 "Validacao('posto', 'O posto que introduziu não pode conter letras ou caracteres especiais.');" . //Usa a função acima que criei indicando o campo com erro (posto) e a mensagem de erro (contém letras ou caratéres especiais)
										 "});" .
									 "</script>";
								
								$erro=true; //A variável que indica o erro fica verdadeiro
							}
						}
					}
					
					if(!$erro)
					{
						include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
						
						$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
						if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
						{
							$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
							
						$consultar_posto=mysqli_query($conexao, "SELECT * FROM equipamentos WHERE posto='" . $posto . "' AND idsala=" . $idsala . ";"); //Verifica se já existe alguma equipamento com esse posto nessa sala
						if($consultar_posto) //Se não ocorreu nenhum erro:
						{
							$linhas_posto=mysqli_num_rows($consultar_posto); //Obtém o número de equipamentos com esse posto nessa sala
							if($linhas_posto==1) //Se retornar uma linha significa que já existe um equipamento com esse posto nessa sala
							{
								$consultar_posto_antigo=mysqli_query($conexao, "SELECT * FROM equipamentos WHERE idequipamento='" . $idequipamento . "' AND idsala=" . $idsala . ";"); //Verifica se já existe alguma equipamento com esse posto antigo
								if($consultar_posto_antigo) //Se não ocorreu nenhum erro:
								{
									$linhas_posto_antigo=mysqli_num_rows($consultar_posto_antigo); //Obtém o número de equipamentos com esse posto antigo
									if($linhas_posto_antigo==1) //Se retornar uma linha significa que já existe um equipamento com esse posto antigo
									{
										$dados_posto=mysqli_fetch_array($consultar_posto); //Recebe os dados do equipamento
										$dados_posto_antigo=mysqli_fetch_array($consultar_posto_antigo); //Recebe os dados do equipamento que mandei editar
										
										if($dados_posto["posto"]!=$dados_posto_antigo["posto"]) //Se o posto que digitei existe e não é o posto antigo que tinha então:
										{
											echo "<script>" .
													 "window.addEventListener('load', function()" .
													 "{" .
														 "Validacao('posto', 'O posto dessa sala que introduziu já existe.');" . //Usa a função acima que criei indicando o campo com erro (posto) e a mensagem de erro (O posto dessa sala que introduziu já existe)
													 "});" .
												 "</script>";
											
											$erro=true; //A variável que indica o erro fica verdadeiro
										}
									}
									elseif($linhas_posto_antigo>1) //Se não se retornar mais que uma linha, significa que existe 2 equipamentos com esse posto na base de dados que não se pode repetir então:
										{
											$_SESSION["mensagemerro"]="Erro. O posto antigo existe mais que uma vez na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarProjetores.php");  //Recarrega a página passando o erro para abrir o modal de erro
										}
										elseif($linhas_posto_antigo<0) //Se não se retornar menos que zero linhas, significa que existe algum erro inesperado na programação então:
											{
												$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
												header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
											}
								}
								else //Se não:
								{
									$_SESSION["mensagemerro"]="Erro ao consultar o posto antigo, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
							elseif($linhas_posto>1) //Se não se retornar mais que uma linha, significa que existe 2 equipamentos com esse posto nessa sala na base de dados que não se pode repetir então:
								{
									$_SESSION["mensagemerro"]="Erro. O posto dessa sala que introduziu existe mais que uma vez na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarProjetores.php");  //Recarrega a página passando o erro para abrir o modal de erro
								}
								elseif($linhas_posto<0) //Se não se retornar menos que zero linhas, significa que existe algum erro inesperado na programação então:
									{
										$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
										header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
									}
						}
						else //Se não:
						{
							$_SESSION["mensagemerro"]="Erro ao consultar se o posto dessa sala já existe, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
					}
				}
				
				if($fabricante=="") //Se o fabricante está vazio vai aparecer uma mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('fabricante', 'O fabricante não foi preenchido.');" . //Usa a função acima que criei indicando o campo com erro (fabricante) e a mensagem de erro (O fabricante não foi preenchido)
							 "});" .
						 "</script>";
					
					$erro=true; //A variável que indica o erro fica verdadeiro
				}
				
				if($modelo=="") //Se o modelo está vazio vai aparecer uma mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('modelo', 'O modelo não foi preenchido.');" . //Usa a função acima que criei indicando o campo com erro (modelo) e a mensagem de erro (O modelo não foi preenchido)
							 "});" .
						 "</script>";
					
					$erro=true; //A variável que indica o erro fica verdadeiro
				}
				
				if(!$erro) //Se não houve nenhum erro nos campos anteriores então:
				{
					include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
					
					$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
					if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
					{
						$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
					
					$editar_tipo_projetor=mysqli_query($conexao, "UPDATE projetores SET tipo='" . $tipo_projetor . "' WHERE idprojetor=" . $idprojetor . ";"); //Edita o campo tipo de projetor
					if($editar_tipo_projetor) //Se não ocorreu nenhum erro:
					{
						$editar_serial_number=mysqli_query($conexao, "UPDATE equipamentos SET serial_number='" . $serial_number . "' WHERE idequipamento=" . $idequipamento . ";"); //Edita o campo número de série
						if($editar_serial_number) //Se não ocorreu nenhum erro:
						{
							$editar_posto=mysqli_query($conexao, "UPDATE equipamentos SET posto='" . $posto . "' WHERE idequipamento=" . $idequipamento . ";"); //Edita o campo posto
							if($editar_posto) //Se não ocorreu nenhum erro:
							{	
								$editar_fabricante=mysqli_query($conexao, "UPDATE projetores SET fabricante='" . $fabricante . "' WHERE idprojetor=" . $idprojetor . ";"); //Edita o campo fabricante
								if($editar_fabricante) //Se não ocorreu nenhum erro:
								{
									$editar_modelo=mysqli_query($conexao, "UPDATE projetores SET modelo='" . $modelo . "' WHERE idprojetor=" . $idprojetor . ";"); //Edita o campo modelo
									if($editar_modelo) //Se não ocorreu nenhum erro:
									{
										$editar_prioridade=mysqli_query($conexao, "UPDATE equipamentos SET prioridade='" . $prioridade . "' WHERE idequipamento=" . $idequipamento . ";"); //Edita o campo prioridade
										if($editar_prioridade) //Se não ocorreu nenhum erro:
										{
											$editar_operacional=mysqli_query($conexao, "UPDATE equipamentos SET operacional='" . $operacional . "' WHERE idequipamento=" . $idequipamento . ";"); //Edita o campo operacional
											if($editar_operacional) //Se não ocorreu nenhum erro:
											{	
												$editar_sala=mysqli_query($conexao, "UPDATE equipamentos SET idsala='" . $idsala . "' WHERE idequipamento=" . $idequipamento . ";"); //Edita o campo sala
												if($editar_sala) //Se não ocorreu nenhum erro:
												{
													$_SESSION["editado_eliminado"]=true; //A variável editado_eliminado fica verdadeiro para assim não fazer a verificação para recarregar a página e não houver erro de duplicação de dados
													
													echo "<script>" .
															 "window.addEventListener('load', function()" .
															 "{" .
																 "Modal('certo', 'Alterações efetuadas com sucesso.');" . //Abre o modal de certo para informar ao utilizador que foi alterado com sucesso
															 "});" .
														 "</script>";
												}
												else //Se não:
												{
													$_SESSION["mensagemerro"]="Erro ao alterar a sala, por favor informe o administrador."; //Passa a mensagem de erro
													header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
												}
											}
											else //Se não:
											{
												$_SESSION["mensagemerro"]="Erro ao alterar o operacional, por favor informe o administrador."; //Passa a mensagem de erro
												header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
											}
										}
										else //Se não:
										{
											$_SESSION["mensagemerro"]="Erro ao alterar a prioridade, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
									}
									else //Se não:
									{
										$_SESSION["mensagemerro"]="Erro ao alterar o modelo, por favor informe o administrador."; //Passa a mensagem de erro
										header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
									}
								}
								else //Se não:
								{
									$_SESSION["mensagemerro"]="Erro ao alterar o fabricante, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
							else //Se não:
							{
								$_SESSION["mensagemerro"]="Erro ao alterar o posto, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
						else //Se não:
						{
							$_SESSION["mensagemerro"]="Erro ao alterar o serial number (número de série), por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
					}
					else //Se não:
					{
						$_SESSION["mensagemerro"]="Erro ao alterar o tipo de projetor, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
			}
			
			if(isset($_POST["idprojetorescondidoeliminar"])) //Se mandei eliminar e selecionei a opção sim então:
			{
				$idequipamento=$_GET["id"]; //Recebe o id do equipamento que quero eliminar
				
				include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
					
				$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
				if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
				{
					$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
				
				$consultar_equipamento=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, projetores p WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND tp.idprojetor=p.idprojetor AND tp.idprojetor>1 AND idequipamento=" . $idequipamento . ";"); //Vai buscar o equipamento que quero eliminar
				if($consultar_equipamento) //Se não ocorreu nenhum erro:
				{
					$linhas_equipamento=mysqli_num_rows($consultar_equipamento); //Obtém o número de equipamentos com esse id
					if($linhas_equipamento>0) //Se retornar mais que uma linha, significa que existe pelo menos um equipamento então:
					{
						$dados_equipamento=mysqli_fetch_array($consultar_equipamento); //Vai buscar os dados do equipamento que quero eliminar
						$idtipoequipamento=$dados_equipamento["idtpequip"]; //Variável que vai guardar o id do tipo de equipamento
						$idprojetor=$dados_equipamento["idprojetor"]; //Variável que vai guardar o id do projetor
						$caminhofoto=$dados_equipamento["foto"]; //Vai receber o caminho da fotografia para depois saber aonde eliminar
					}
					elseif($linhas_equipamento==0) //Se as linhas são 0 significa que não existe ninguém com esse id então:
						{
							$_SESSION["mensagemerro"]="Erro a procurar o id do tipo de equipamento, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
						elseif($linhas_equipamento<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
							{
								$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
				}
				else //Se não significa que ocorreu um erro ou na base de dados ou o id que passou é inválido e contém catactéres além de números:
				{
					$_SESSION["mensagemerro"]="Erro ao consultar os equipamentos, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
				
				$eliminar_equipamento=mysqli_query($conexao, "DELETE FROM equipamentos WHERE idequipamento=" . $idequipamento . ";"); //Elimina o equipamento
				if($eliminar_equipamento) //Se o equipamento foi eliminado com sucesso
				{
					$eliminar_tipo_equipamento=mysqli_query($conexao, "DELETE FROM tipo_equipamentos WHERE idtpequip=" . $idtipoequipamento . ";"); //Elimina o tipo de equipamento
					if($eliminar_tipo_equipamento) //Se o equipamento foi eliminado com sucesso
					{
						$eliminar_projetor=mysqli_query($conexao, "DELETE FROM projetores WHERE idprojetor=" . $idprojetor . ";"); //Elimina o projetor
						if($eliminar_projetor) //Se o equipamento foi eliminado com sucesso
						{
							$eliminar_foto_pasta=unlink($caminhofoto);
							if($eliminar_foto_pasta)
							{
								$_SESSION["editado_eliminado"]=true; //A variável editado_eliminado fica verdadeiro para assim não fazer a verificação para recarregar a página e não houver erro de duplicação de dados
								
								echo "<script>" .
										 "window.addEventListener('load', function()" .
										 "{" .
											 "Modal('certo', 'Projetor eliminado com sucesso.');" . //Abre o modal de certo para informar ao utilizador que foi eliminado com sucesso
										 "});" .
									 "</script>";
							}
							else //Se não:
							{
								$_SESSION["mensagemerro"]="Erro ao eliminar a fotografia do projetor da pasta, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
						else //Se não:
						{
							$_SESSION["mensagemerro"]="Erro ao eliminar o projetor, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
					}
					else //Se não:
					{
						$_SESSION["mensagemerro"]="Erro ao eliminar o tipo de equipamento, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
				else //Se não:
				{
					$_SESSION["mensagemerro"]="Erro ao eliminar o equipamento, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
			}
			
			if(isset($_FILES["btnfotoalterarescondido"]["name"])) //Se o nome da fotografia do projetor existe, significa que a fotografia do projetor existe então:
			{
				$foto=$_FILES["btnfotoalterarescondido"]["tmp_name"]; //Variável que contém a fotografia
				$extensao=$_FILES["btnfotoalterarescondido"]["type"]; //Variável que contém a extensão da fotografia
				$nome_foto_nova=date("dmyhis") . time(); //O novo nome da fotografia será dia, mês, ano, hora, minuto, segundo e total de segundos desde janeiro de 1970 para evitar repetições no nome
				
				//Mete as variáveis a falso
				$erro=false;
				
				include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
				
				$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
				if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
				{
					$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
				
				$consultar_foto_antiga=mysqli_query($conexao, "SELECT * FROM equipamentos WHERE idequipamento='" . $_GET["id"] . "';"); //Vai buscar a fotografia antiga do equipamento
				if($consultar_foto_antiga) //Se não ocorreu nenhum erro:
				{
					$linhas_foto_antiga=mysqli_num_rows($consultar_foto_antiga); //Obtém o número de equipamentos com essa fotografia
					if($linhas_foto_antiga==1) //Se retornar uma linha significa que já existe um equipamento com essa fotografia
					{
						$dados_foto_antiga=mysqli_fetch_array($consultar_foto_antiga); //Recebe os dados da fotografia antiga
					}
					elseif($linhas_foto_antiga>1) //Se não se retornar mais que uma linha, significa que existe 2 equipamentos com essa esse nome para fotografia na base de dados que não se pode repetir então:
						{
							$_SESSION["mensagemerro"]="Erro. A nome da fotografia existe mais que uma vez na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarProjetores.php");  //Recarrega a página passando o erro para abrir o modal de erro
						}
						elseif($linhas_foto_antiga<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
							{
								$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
				}
				else //Se não:
				{
					$_SESSION["mensagemerro"]="Erro ao consultar se a fotografia já existe, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
				
				//Nota: Isto é uma função, significa que o código só é executado quando eu chamar a função
				echo "<script>" .
						 //Cria uma função de Validação cujo os parâmetros serão o campo com erro e a mensagem de erro com o objetivo se simplificar e minimizar o código
						 "function Validacao(campo, mensagem)" .
						 "{" .
							 "if(campo=='foto')" . //Se o campo com erro é o da fotografia do projetor então:
							 "{" .
								 "document.getElementById('btnfotoalterarescondido').style.marginLeft='-350px';" . //Aproxima da esquerda o botão escondido de alterar fotos para não ficar visível pois vai estar debaixo do botão personalizado que foi criado e mais bonito
								 
								 "campo='fotoalterar';" . //A variável campo recebe o id das zona das bordas da foto para ficar vermelho
								 
								 "document.getElementById('errofoto').innerHTML=mensagem;" . //A zona de erro recebe a mensagem de erro
								 "document.getElementById(campo).style.borderColor='red';" . //As bordas das caixas com erro ficam a vermelho
							 "}" .
						 "}" .
					 "</script>";
				
				switch($extensao) //Caso a extensão da fotografia:
				{	
					//Seja jpg:
				    case "image/jpeg": $extensao=".jpg"; //A variável extensão recebe o .jpg
									   $diretorio_novo="ImagensEquipamentos//" . $nome_foto_nova . $extensao; //A variável diretorio_novo recebe o caminho da pasta que vai armazenar as fotografias dos equipamentos todos
									   break;
									   
					//Seja png:
				    case "image/png": $extensao=".png"; //A variável extensão recebe o .png
									  $diretorio_novo="ImagensEquipamentos//" . $nome_foto_nova . $extensao; //A variável diretorio_novo recebe o caminho da pasta que vai armazenar as fotografias dos equipamentos todos
									  break;
									  
					//Seja bmp:
					case "image/bmp": $extensao=".bmp"; //A variável extensão recebe o .bmp
									  $diretorio_novo="ImagensEquipamentos//" . $nome_foto_nova . $extensao; //A variável diretorio_novo recebe o caminho da pasta que vai armazenar as fotografias dos equipamentos todos
									  break;
									 
				    default: echo "<script>" .
								      "window.addEventListener('load', function()" .
									  "{" .
									      "Validacao('foto', 'A fotografia que introduziu contém uma extensão inválida.');" . //Usa a função acima que criei indicando o campo com erro (foto) e a mensagem de erro (A fotografia que introduziu contém uma extensão inválida.)
										  "document.getElementById('btnfotoalterarescondido').style.marginLeft='0px';" . //Mete para que o botão de alterar fotografias escondido fique debaixo do botão de alterar fotografias mostrado escondido para não ver-se
									  "});" .
								  "</script>";
								  
							 $erro=true; //A variável que indica o erro fica verdadeiro
				}
				
				if(!$erro) //Se não houver erro então:
				{
					$eliminar_fotografia=unlink($dados_foto_antiga["foto"]); //Elimina a fotografia antiga
					if($eliminar_fotografia) //Se foi eliminado com sucesso então:
					{
						$atualizar_fotografia=link($foto, $diretorio_novo); //Atualiza a fotografia na pasta
						if($atualizar_fotografia) //Se foi atualizado com sucesso então:
						{
							$atualizar_caminho_fotografia=mysqli_query($conexao, "UPDATE equipamentos SET foto='" . $diretorio_novo . "' WHERE idequipamento=" . $_GET["id"] . ";"); //Atualiza na base de dados o caminho da fotografia
							if($atualizar_caminho_fotografia) //Se foi atualizado com sucesso:
							{
								echo "<script>" .
										 "window.addEventListener('load', function()" .
										 "{" .
											 "Modal('certo', 'Fotografia atualizada com sucesso.');" . //Abre o modal de certo para informar ao utilizador que foi atualizado com sucesso
										 "});" .
									 "</script>";
							}
							else //Se não:
							{
								$_SESSION["mensagemerro"]="Erro ao atualizar o caminho da fotografia na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
						else //Se não:
						{
							$_SESSION["mensagemerro"]="Erro ao atualizar a fotografia nova, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
					}
					else //Se não:
					{
						$_SESSION["mensagemerro"]="Erro ao eliminar a fotografia antiga, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
			}
		}
		else //Se não significa que já cliquei no botão para editar ou para eliminar e vai fazer o seguinte:
		{ //Se não fizer essa verificação quando recarregar a página iria gerar o erros
			unset($_SESSION["editado_eliminado"]); //Elimina a variável
			header("Location: ConsultarProjetores.php"); //Recarrega a página e volta para a página de Consultar Projetores
		}
	}
	else //Se não, se foi passada uma mensagem de erro:
	{
		echo "<script>" .
			     "window.addEventListener('load', function()" .
				 "{" .
					 "Modal('erro', '" . $_SESSION["mensagemerro"] . "');" . //Abre o modal de erro para informar ao utilizador que ocorreu um erro
				 "});" .
			 "</script>";
		
		unset($_SESSION["mensagemerro"]); //Destroi a variável por como o modal já apareceu só há necessidade de aparecer uma vez
	}
?> <!-- Fim dos códigos PHP -->
<!DOCTYPE html> <!-- Permite o uso do HTML5 -->
<html> <!-- Inicio do HTML -->
    <head> <!-- Início do cabeçalho -->
	    <title>Gestão de Avarias</title> <!-- Título da página -->
        <meta charset="UTF-8"> <!-- Permite as acentuações no HTML -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Permite ajustar o tamanho a todos os dispositivos-->
	    <link rel="icon" href="ImagensSite//Logotipo.jpg" type="image/jpg" sizes="16x16"> <!-- Ícone do site -->
		
		<!-- Códigos externos do menu -->
		<link rel="stylesheet" href="CSS//Menu.css"> <!-- Vai importar código css duma pasta para puder reutilizar o código do menu por todas as páginas e reduzir o número de linhas -->
		<script src="JS//Menu.js"></script> <!-- Vai importar código javascript duma pasta para puder reutilizar o código por todas as páginas e reduzir o número de linhas -->
		
		<!-- Códigos externos do consultar, mais geralmente sobre a imagem e o formulário -->
		<link rel="stylesheet" href="CSS//Consultar.css"> <!-- Vai importar código css duma pasta para puder reutilizar o código do menu por todas as páginas e reduzir o número de linhas -->
		<script src="JS//Consultar.js"></script> <!-- Vai importar código javascript duma pasta para puder reutilizar o código por todas as páginas e reduzir o número de linhas -->
		
		<!-- Códigos externos do modal -->
		<link rel="stylesheet" href="CSS//Modal.css"> <!-- Vai importar código css duma pasta para puder reutilizar o código do menu por todas as páginas e reduzir o número de linhas -->
		<script src="JS//Modal.js"></script> <!-- Vai importar código javascript duma pasta para puder reutilizar o código por todas as páginas e reduzir o número de linhas -->
		
		<!-- Códigos externos open source provenientes de outros sites -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Vai importar alguns ícones -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700&amp;lang=en"> <!-- Vai buscar o tipo de letra Josefin Sans -->
		
		<!-- Início dos estilos CSS -->
		<style>
			.tabela
			{
				/* Este width dá-se pela a fórmula de ((comprimento de cada campo * número de campos)+16) considerando que o campo ultimo tem width igual aos outros campo */
				width: 2606px; /* A tabela fica com 1016px de comprimento, ((185px*6 campos)+16)=1116px */
			}
			
			tbody td
			{
				width: 185px; /* O comprimento de cada coluna da tabela é de 185px */
			}
			
			.campotabela
			{
				width: 185px; /* O comprimento de cada coluna da tabela é de 185px */
			}
			
			.campoultimo /* Diferente do de cima, este é destinado para que a tabela fique alinhado com a barra de rolagem */
			{
				width: 201px; /* O comprimento da última coluna da tabela é de 201px por causa para ficar alinhado com os 16px da barra de rolagem */
			}
			
			.zonatabela
			{
				margin: Auto; /* A tabela fica centrada */
				width: 92%; /* A tabela fica com o comprimento a 92% do comprimento do ecrã */
			}
			
			.pesquisar
			{
				margin-left: 55px; /* A caixa de texto afasta-se 55px da esquerda */
			}
			
			.btnpesquisar
			{
				margin-left: 323px; /* O botão de pesquisar afasta-se 323px da esquerda */
			}
			
			.selectpesquisar
			{
				margin-left: 380px; /* A caixa de seleção de pesquisar afasta-se 380px da esquerda */
			}
			
			.textoordenar
			{
				margin-left: 55px; /* O texto afasta-se 55px da esquerda */
			}
			
			.selectordenar
			{
				margin-left: 55px; /* A caixa de seleção de ordenar afasta-se 55px da esquerda */
			}
			
			@media screen and (max-width: 800px) /* Quando o comprimento do ecrã for 800px ou menor vai acontecer o seguinte: */
			{
				.pesquisar
				{
					margin-left: 25px; /* A caixa de texto afasta-se 25px da esquerda */
				}
				
				.btnpesquisar
				{
					margin-left: 290px; /* O botão de pesquisar afasta-se 290px da esquerda */
				}
				
				.selectpesquisar
				{
					width: 300px; /* O comprimento da caixa de seleção de pesquisas fica a 300px */
					margin-left: 25px; /* A caixa de seleção afasta-se 25px da esquerda */
					margin-top: 50px; /* A caixa de seleção afasta-se 50px do topo */
				}
				
				.textoordenar
				{
					margin-left: 25px; /* O texto afasta-se 25px da esquerda */
				}
				
				.selectordenar
				{
					margin-left: 25px; /* A caixa de seleção de ordenar afasta-se 25px da esquerda */
				}
			}
		</style> <!-- Fim dos estilos CSS -->
		<!-- Início dos códigos Javascript -->
		<script id="jsmodal">
			//Nota: Isto é uma função, significa que o código só é executado quando eu chamar a função
			//Cria uma função para abrir um Modal cujo os parâmetros serão o tipo do modal e a mensagem de erro com o objetivo se simplificar e minimizar o código
			function Modal(tipo, mensagem)
			{
				switch(tipo)
				{
					//Caso o tipo de modal seja o certo:
					case "certo": document.getElementById("respostaconsultar").style.color="#1CEE0E"; //O texto do modal fica verde
								  document.getElementById("btnokconsultar").style.backgroundColor="#1CEE0E"; //O botão ok fica verde
								  
								  document.getElementById("btnokconsultar").addEventListener("mouseover", function() //Quando passar com o rato por cima do botão:
								  {
									  document.getElementById("btnokconsultar").style.backgroundColor="#2DAB24"; //O botão ok fica com um verde mais claro
								  });
								  
								  document.getElementById("btnokconsultar").addEventListener("mouseout", function() //Quando retirar o rato de cima do botão:
								  {
									  document.getElementById("btnokconsultar").style.backgroundColor="#1CEE0E"; //O botão ok volta à cor que tinha
								  });
								  break; //Fim da opção
					
					//Caso o tipo de modal seja o de erro:
					case "erro": document.getElementById("respostaconsultar").style.color="#E63946"; //O texto do modal fica vermelho
								 document.getElementById("btnokconsultar").style.backgroundColor="#E63946"; //O botão ok fica vermelho
								 
								 document.getElementById("btnokconsultar").addEventListener("mouseover", function() //Quando passar com o rato por cima do botão:
								 {
									document.getElementById("btnokconsultar").style.backgroundColor="#DD3C48"; //O botão ok fica com um vermelho mais claro
								 });
								 
								 document.getElementById("btnokconsultar").addEventListener("mouseout", function()  //Quando retirar o rato de cima do botão:
								 {
									 document.getElementById("btnokconsultar").style.backgroundColor="#E63946"; //O botão ok volta à cor que tinha
								 });
								 break; //Fim da opção
								 
					//Caso o tipo de modal seja o de aviso:
					case "aviso": document.getElementById("respostaconsultar").style.color="#D7DF01"; //O texto do modal fica amarelo
								  break; //Fim da opção
					
					//Caso o tipo de modal seja o de utilizador:
					case "utilizador": document.getElementById("respostaconsultar").style.color="#000000"; //O texto do modal fica preto
									   break; //Fim da opção
									   
					//Caso o tipo de modal seja o de pass:
					case "pass": document.getElementById("respostaconsultar").style.color="#000000"; //O texto do modal fica preto
								 break; //Fim da opção
					
					//Caso o tipo de modal seja o de escola:
					case "escola": document.getElementById("respostaconsultar").style.color="#000000"; //O texto do modal fica preto
								   break; //Fim da opção
					
					//Caso o tipo de modal seja o de qim:
					case "qim": document.getElementById("respostaconsultar").style.color="#000000"; //O texto do modal fica preto
								break; //Fim da opção
					
					//Caso o tipo de modal seja o de computador:
					case "computador": document.getElementById("respostaconsultar").style.color="#000000"; //O texto do modal fica preto
									   break; //Fim da opção
					
					//Caso o tipo de modal seja o de monitor:
					case "monitor": document.getElementById("respostaconsultar").style.color="#000000"; //O texto do modal fica preto
									break; //Fim da opção
					
					//Caso o tipo de modal seja o de projetor:
					case "projetor": document.getElementById("respostaconsultar").style.color="#000000"; //O texto do modal fica preto
									 break; //Fim da opção
					
					//Caso o tipo de modal seja o de avaria:
					case "avaria": document.getElementById("respostaconsultar").style.color="#000000"; //O texto do modal fica preto
								   break; //Fim da opção
					
					//Caso o tipo de modal seja o de foto:
					case "foto": 
								 break; //Fim da opção
					
					//Não esquecer, anotar para não me esquecer, Caso acrescente um modal novo não esquecer de alterar no script seguinte também
				}
				
				if(!(document.getElementById("btnokconsultar")==null)) //O botão consultar pode não existir por causa de ter aberto o modal com a foto e dar erro daí verificar se ele existe
				{
					document.getElementById("btnokconsultar").addEventListener("click", function() //Quando clicar no botão ok:
					{
						location.href="ConsultarProjetores.php"; //Recarrega a página
					});
				}
				
				if(!(document.getElementById("modalconsultar")==null)) //O botão consultar pode não existir por causa de ter aberto o modal com a foto e dar erro daí verificar se ele existe
				{
					if(mensagem.length>200) //Se a mensagem for muito grande então:
					{
						document.getElementById("modalconsultar").style.height="450px"; //Aumento a altura do modal
					}
					else if(mensagem.length>100) //Se não se a mensagem for grande então:
						 {
							 document.getElementById("modalconsultar").style.height="400px"; //Aumento a altura do modal
						 }
						 else //Se não:
						 {
							 document.getElementById("modalconsultar").style.height="330px"; //Volta a ter a altura original
						 }
				
					document.getElementById("modalconsultar").className="modal" + tipo; //O modal recebe a foto do tipo, por exemplo, caso seja certo fica com a imagem do certo, caso seja erro fica com a imagem do erro
					document.getElementById("respostaconsultar").innerHTML=mensagem; //A mensagem do modal recebe o que for passado no parâmetro mensagem
					document.getElementById("zonamodalconsultar").style.display="block"; //Mete o modal visível
				}
			}
		</script>
		<script>
			window.addEventListener("load", function() //Antes da página iniciar, ele relê o código vendo todos os códigos e processando já o que há de fazer
			{
				if(!(document.getElementById("selectvista")==null)) //Se a caixa de seleção da vista do utilizador existe então:
				{
					document.getElementById("selectvista").addEventListener("change", function() //Se selecionei alguma opção de vista:
					{
						document.getElementById("frmVista").submit(); //Recarrega a página como se fosse um formulário passando qual opção de vista selecionei
					});
				}
				
				if(!(document.getElementById("equipamento")==null)) //Se a caixa de seleção do equipamento existe então:
				{
					document.getElementById("equipamento").addEventListener("change", function() //Quando selecionar outro equipamento:
					{
						location.href="Consultar" + document.getElementById("equipamento").value + ".php"; //Redireciona-me para a página do respetivo equipamento
					});
				}
			});
		</script> <!-- Fim dos códigos Javascript -->
		<!-- Início dos códigos Javascript com PHP -->
		<?php
			if(isset($_SESSION["vista"])) //Se a variável vista existe:
			{
				switch($_SESSION["vista"]) //Caso a variavel vista:
				{
					//Seja E de estagiário
					case "E": echo "<script>" .
									   "window.addEventListener('load', function()" .
									   "{" .
										   "document.getElementById('utilizadores').style.display='none';" . //Vai esconder a opção de utilizadores do menu para ele não entrar pois ele não contêm essa permissão
									   "});" .
								   "</script>";
								   break; //Fim da opção
					
					//Seja N de normal
					case "N": echo "<script>" .
									   "window.addEventListener('load', function()" .
									   "{" .
										   "document.getElementById('utilizadores').style.display='none';" . //Vai esconder a opção de utilizadores do menu para ele não entrar pois ele não contêm essa permissão
										   "document.getElementById('agrupamentos').style.display='none';" . //Vai esconder a opção de agrupamentos do menu para ele não entrar pois ele não contêm essa permissão
										   "document.getElementById('escolas').style.display='none';" . //Vai esconder a opção de escolas do menu para ele não entrar pois ele não contêm essa permissão
										   "document.getElementById('blocos').style.display='none';" . //Vai esconder a opção de blocos do menu para ele não entrar pois ele não contêm essa permissão
										   "document.getElementById('salas').style.display='none';" . //Vai esconder a opção de salas do menu para ele não entrar pois ele não contêm essa permissão
										   "document.getElementById('equipamentos').style.display='none';" . //Vai esconder a opção de equipamentos do menu para ele não entrar pois ele não contêm essa permissão
									   "});" .
								   "</script>";
								   break; //Fim da opção
				}
			}
			else //Se a vista que tiver for a de estagiário então:
			{
				switch($_SESSION["tipo_utilizador"]) //Caso a variavel vista:
				{
					//Seja E de estagiário
					case "E": echo "<script>" .
									   "window.addEventListener('load', function()" .
									   "{" .
										   "document.getElementById('utilizadores').style.display='none';" . //Vai esconder a opção de utilizadores do menu para ele não entrar pois ele não contêm essa permissão
									   "});" .
								   "</script>";
								   break; //Fim da opção
					
					//Seja E de estagiário
					case "N": echo "<script>" .
									   "window.addEventListener('load', function()" .
									   "{" .
										   "document.getElementById('utilizadores').style.display='none';" . //Vai esconder a opção de utilizadores do menu para ele não entrar pois ele não contêm essa permissão
										   "document.getElementById('agrupamentos').style.display='none';" . //Vai esconder a opção de agrupamentos do menu para ele não entrar pois ele não contêm essa permissão
										   "document.getElementById('escolas').style.display='none';" . //Vai esconder a opção de escolas do menu para ele não entrar pois ele não contêm essa permissão
										   "document.getElementById('blocos').style.display='none';" . //Vai esconder a opção de blocos do menu para ele não entrar pois ele não contêm essa permissão
										   "document.getElementById('salas').style.display='none';" . //Vai esconder a opção de salas do menu para ele não entrar pois ele não contêm essa permissão
										   "document.getElementById('equipamentos').style.display='none';" . //Vai esconder a opção de equipamentos do menu para ele não entrar pois ele não contêm essa permissão
									   "});" .
								   "</script>";
								   break; //Fim da opção
				}
			}
			
			if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se foi feita uma pesquisa específica então:
			{
				if(isset($_GET["ordenadopor"])) //Se foi feito uma ordenação então:
				{
					//Programa o botão de pesquisar específico e a caixa de seleção do ordenar
					$javascriptpesquisa="<script>" .
										    "window.addEventListener('load', function()" .
										    "{" .
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum projetor então:
												"{" .
													"document.getElementById('btnpesquisar').addEventListener('click', function()" . //Quando clicar no botão pesquisar:
													"{" .
														//A pesquisa específica fica com o que foi escolhido e a ordenação fica como já estava
														"location.href='?pesquisa=' + document.getElementById('pesquisar').value + '&campo=' + document.getElementById('selectpesquisar').value + '&ordenadopor=" . $_GET["ordenadopor"] . "';" .
													"});" .
													
													"document.getElementById('selectordenar').addEventListener('change', function()" . //Quando selecionar uma opção para ordenar:
													"{" .
														//A pesquisa específica fica como já estava e a ordenação fica com o que foi escolhido
														"location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=' + document.getElementById('selectordenar').value;" .
													"});" .
												"}" .
										    "});" .
									    "</script>";
				}
				else //Se não como não foi feita uma ordenação
				{
					//Programa o botão de pesquisar específico e a caixa de seleção do ordenar
					$javascriptpesquisa="<script>" .
										    "window.addEventListener('load', function()" .
										    "{" .
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum projetor então:
												"{" .
													"document.getElementById('btnpesquisar').addEventListener('click', function()" .  //Quando clicar no botão pesquisar:
													"{" .
														//A pesquisa específica fica com o que foi escolhido
														"location.href='?pesquisa=' + document.getElementById('pesquisar').value + '&campo=' + document.getElementById('selectpesquisar').value;" .
													"});" .
													
													"document.getElementById('selectordenar').addEventListener('change', function()" . //Quando selecionar uma opção para ordenar:
													"{" .
														//A pesquisa específica fica com o que já estava e a ordenação fica com o que foi escolhido
														"location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=' + document.getElementById('selectordenar').value;" .
													"});" .
												"}" .
										    "});" .
									    "</script>";
				}
			}
			else //Se não como não foi feita uma pesquisa específica
			{
				if(isset($_GET["ordenadopor"])) //Se foi feita uma ordenação então:
				{
					//Programa o botão de pesquisar específico e a caixa de seleção do ordenar
					$javascriptpesquisa="<script>" .
										    "window.addEventListener('load', function()" .
										    "{" .
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum projetor então:
												"{" .
													"document.getElementById('btnpesquisar').addEventListener('click', function()" . //Quando clicar no botão pesquisar:
													"{" .
														//A pesquisa específica fica com o que foi escolhido e a ordenação fica com o que já estava
														"location.href='?pesquisa=' + document.getElementById('pesquisar').value + '&campo=' + document.getElementById('selectpesquisar').value + '&ordenadopor=" . $_GET["ordenadopor"] . "';" .
													"});" .
													
													"document.getElementById('selectordenar').addEventListener('change', function()" . //Quando selecionar uma opção para ordenar:
													"{" .
														//A ordenação fica com o que foi escolhido
														"location.href='?ordenadopor=' + document.getElementById('selectordenar').value;" .
													"});" .
												"}" .
										    "});" .
									    "</script>";
				}
				else //Se não como não foi feita uma ordenação
				{
					//Programa o botão de pesquisar específico e a caixa de seleção do ordenar
					$javascriptpesquisa="<script>" .
										    "window.addEventListener('load', function()" .
										    "{" .
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum projetor então:
												"{" .
													"document.getElementById('btnpesquisar').addEventListener('click', function()" . //Quando clicar no botão pesquisar:
													"{" .
														//A pesquisa específica fica com o que foi escolhido
														"location.href='?pesquisa=' + document.getElementById('pesquisar').value + '&campo=' + document.getElementById('selectpesquisar').value;" .
													"});" .
													
													"document.getElementById('selectordenar').addEventListener('change', function()" . //Quando selecionar uma opção para ordenar:
													"{" .
														//A ordenação fica com o que foi escolhido
														"location.href='?ordenadopor=' + document.getElementById('selectordenar').value;" .
													"});" .
												"}" .
										    "});" .
									    "</script>";
				}
			}
		?> <!-- Fim dos códigos Javascript com PHP -->
	</head> <!-- Final do cabeçalho -->
	<body bgcolor="#F1FAEE"> <!-- Início do body com cor de fundo a uma tonalidade de verde sem tom -->
		<div class="menuhorizontal"> <!-- Início da zona do menu horizontal -->
			<div class="btnmenuvertical" id="btnmenuvertical" title="Abrir menu"></div> <!-- Botão para abrir o menu vertical -->
			<div style="padding-left: 30%" title="Página inicial"> <!-- Todos os itens deste div afastam-se da esquerda 30% do comprimento do ecrã -->
				<a href="Inicio.php" class="logotipo" id="logotipo"></a> <!-- Imagem do logotipo com um link que vai redirecionar para a página inicial -->
			</div>
			<ul>
				<li><a href="Inicio.php" class="nomesite" id="nomesite" title="Página inicial">Gestão de Avarias</a></li> <!-- Nome do site com um link que vai redirecionar para a página inicial -->
			</ul>
			<!-- Inicio dos códigos PHP -->
			<?php
				if($_SESSION["tipo_utilizador"]=="A") //Se o tipo de utilizador desta conta for um adminstrador então:
				{
					switch($_SESSION["vista"]) //Caso a vista:
					{
						//Seja A de adminstrador:
						case "A": echo "<script>" .
										   "window.addEventListener('load', function()" .
										   "{" .
											   "document.getElementById('selectvista').style.width='175px';" . //A caixa de seleção fica com 175px de comprimento
										   "});" .
									   "</script>";
						
								  $vista="Administrador"; //A variável recebe o nome Admnistrador para ficar mais apresentável no site
								  break; //Fim da opção
						
						//Seja E de estagiário:
						case "E": echo "<script>" .
										   "window.addEventListener('load', function()" .
										   "{" .
											   "document.getElementById('selectvista').style.width='150px';" . //A caixa de seleção fica com 150px de comprimento
										   "});" .
									   "</script>";
									   
								  $vista="Estagiário"; //A variável recebe o nome Admnistrador para ficar mais apresentável no site
								  break; //Fim da opção
						
						//Seja N de normal:
						case "N": echo "<script>" .
										   "window.addEventListener('load', function()" .
										   "{" .
											   "document.getElementById('selectvista').style.width='130px';" . //A caixa de seleção fica com 130px de comprimento
										   "});" .
									   "</script>";
									   
								  $vista="Normal"; //A variável recebe o nome Admnistrador para ficar mais apresentável no site
								  break; //Fim da opção
						
						default: $_SESSION["mensagemerro"]="Erro, modo de vista inválido, poderá conter erros de programação no site, por favor informe o administrador."; //Passa a mensagem de erro
								 header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro;
					}
					
					echo "<form name='frmVista' id='frmVista' action='#' method='POST'>" . //Meto o form para poder passar os dados para o PHP pois sem isto declarado não funciona
							 "<select name='selectvista' class='selectvista' id='selectvista'>" . //Cria a caixa de seleção para selecionar que vista pretendo (Administrador, Estagiário ou Normal)
								 "<option value='Escolher' selected>Vista: " . $vista . "</option>" . //Mensagem por defeito
								 "<option value='A'>Administrador</option>" . //Opção de administrador
								 "<option value='E'>Estagiário</option>" . //Opção de estagiário
								 "<option value='N'>Normal</option>" . //Opção de normal
							 "</select>" .
						 "</form>";
				}
			?> <!-- Fim dos códigos PHP -->
			<a href="Logout.php" class="logout" id="logout" title="Terminar sessão"></a> <!-- Botão de terminar sessão -->
		</div> <!-- Fim da zona do menu horizontal -->
		<div class="menuvertical" id="menuvertical"> <!-- Início do menu vertical -->
			<ul> <!-- Cria uma lista com os itens do menu -->
				<li><a href="Inicio.php" id="inicio">Início</a></li> <!-- Botão para a página inicial -->
			    <li><a href="#" id="utilizadores">Utilizadores</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar utilizadores -->
				<li><a href="#" id="agrupamentos">Agrupamentos</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar agrupamentos -->
				<li><a href="#" id="escolas">Escolas</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar escolas -->
				<li><a href="#" id="blocos">Blocos</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar blocos -->
				<li><a href="#" id="salas">Salas</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar salas -->
				<li class="ativo"><a href="#" id="equipamentos">Equipamentos</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar equipamentos -->
				<li><a href="#" id="avarias">Avarias</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar avarias -->
			</ul> <!-- Fim da lista -->
		</div> <!-- Fim do menu vertical -->
		<div class="divisoria" id="divisoria"></div> <!-- Linha que divide o menu para o submenu -->
		<div class="submenuvertical" id="submenuvertical"> <!-- Início do submenu vertical -->
			<ul> <!-- Cria uma lista  -->
				<li><a id="inserir" href="#">Inserir</a></li> <!-- Botão para ir para a página de inserir -->
				<li><a id="consultar" href="#">Consultar</a></li> <!-- Botão para ir para a página de consultar -->
			</ul> <!-- Fim da lista -->
		</div> <!-- Fim do submenu vertical -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<div class="zonaconsultar" id="zonaconsultar"> <!-- Início da zona de consultar -->
			<?php
				include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
				
				$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
				if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
				{
					$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
						
				if((isset($_GET["pesquisa"])) AND (isset($_GET["campo"]))) //Se foi mandada uma pesquisa específica então:
				{
					//Se não se a pesquisa foi Videoprojetor e o campo foi tipo então:
					if((($_GET["pesquisa"]=="V") OR ($_GET["pesquisa"]=="Vi") OR ($_GET["pesquisa"]=="Vid") OR ($_GET["pesquisa"]=="Vide") OR ($_GET["pesquisa"]=="Video") OR ($_GET["pesquisa"]=="Videop") OR ($_GET["pesquisa"]=="Videopr") OR ($_GET["pesquisa"]=="Videopro") OR ($_GET["pesquisa"]=="Videoproj") OR ($_GET["pesquisa"]=="Videoproje") OR ($_GET["pesquisa"]=="Videoprojet") OR ($_GET["pesquisa"]=="Videojeto") OR ($_GET["pesquisa"]=="Videoprojetor") OR ($_GET["pesquisa"]=="Videoprojetore") OR ($_GET["pesquisa"]=="Videoprojetores")) AND (($_GET["campo"]=="tipo")))
					{
						$pesquisaexata=$_GET["pesquisa"]; //A pesquisa exata recebe o que o foi pesquisado
						$_GET["pesquisa"]="V"; //Temporariamente vai ser pesquisado por V devido à base de dados
						
					}   //Se não se a pesquisa foi QIM ou Quadro interativo multimédia e o campo foi tipo então:
					elseif((($_GET["pesquisa"]=="QI") OR ($_GET["pesquisa"]=="QIM") OR ($_GET["pesquisa"]=="QIMs") OR ($_GET["pesquisa"]=="Qu") OR ($_GET["pesquisa"]=="Qua") OR ($_GET["pesquisa"]=="Quad") OR ($_GET["pesquisa"]=="Quadr") OR ($_GET["pesquisa"]=="Quadro") OR ($_GET["pesquisa"]=="Quadro I") OR ($_GET["pesquisa"]=="Quadro In") OR ($_GET["pesquisa"]=="Quadro Int") OR ($_GET["pesquisa"]=="Quadro Inte") OR ($_GET["pesquisa"]=="Quadro Inter") OR ($_GET["pesquisa"]=="Quadro Intera") OR ($_GET["pesquisa"]=="Quadro Interat") OR ($_GET["pesquisa"]=="Quadro Interati") OR ($_GET["pesquisa"]=="Quadro Interativ") OR ($_GET["pesquisa"]=="Quadro Interativo") OR ($_GET["pesquisa"]=="Quadro Interativo M") OR ($_GET["pesquisa"]=="Quadro Interativo Mu") OR ($_GET["pesquisa"]=="Quadro Interativo Mul") OR ($_GET["pesquisa"]=="Quadro Interativo Mult") OR ($_GET["pesquisa"]=="Quadro Interativo Multi") OR ($_GET["pesquisa"]=="Quadro Interativo Multim") OR ($_GET["pesquisa"]=="Quadro Interativo Multimé") OR ($_GET["pesquisa"]=="Quadro Interativo Multiméd") OR ($_GET["pesquisa"]=="Quadro Interativo Multimédi") OR ($_GET["pesquisa"]=="Quadro Interativo Multimédia") OR ($_GET["pesquisa"]=="Quadros") OR ($_GET["pesquisa"]=="Quadros I") OR ($_GET["pesquisa"]=="Quadros In") OR ($_GET["pesquisa"]=="Quadros Int") OR ($_GET["pesquisa"]=="Quadros Inte") OR ($_GET["pesquisa"]=="Quadros Inter") OR ($_GET["pesquisa"]=="Quadros Intera") OR ($_GET["pesquisa"]=="Quadros Interat") OR ($_GET["pesquisa"]=="Quadros Interati") OR ($_GET["pesquisa"]=="Quadros Interativ") OR ($_GET["pesquisa"]=="Quadros Interativo") OR ($_GET["pesquisa"]=="Quadros Interativos") OR ($_GET["pesquisa"]=="Quadros Interativos M") OR ($_GET["pesquisa"]=="Quadros Interativos Mu") OR ($_GET["pesquisa"]=="Quadros Interativos Mul") OR ($_GET["pesquisa"]=="Quadros Interativos Mult") OR ($_GET["pesquisa"]=="Quadros Interativos Multi") OR ($_GET["pesquisa"]=="Quadros Interativo Multim") OR ($_GET["pesquisa"]=="Quadros Interativo Multimé") OR ($_GET["pesquisa"]=="Quadros Interativos Multiméd") OR ($_GET["pesquisa"]=="Quadros Interativos Multimédi") OR ($_GET["pesquisa"]=="Quadros Interativos Multimédia")) AND (($_GET["campo"]=="tipo")))
						{
							$pesquisaexata=$_GET["pesquisa"]; //A pesquisa exata recebe o que o foi pesquisado
							$_GET["pesquisa"]="Q"; //Temporariamente vai ser pesquisado por Q devido à base de dados
							
						}   //Se não se a pesquisa foi Sim e o campo foi prioridade ou operacional então:
						elseif((($_GET["pesquisa"]=="S") OR ($_GET["pesquisa"]=="Si") OR ($_GET["pesquisa"]=="Sim")) AND (($_GET["campo"]=="prioridade") OR ($_GET["campo"]=="operacional")))
							{
								$pesquisaexata=$_GET["pesquisa"]; //A pesquisa exata recebe o que o foi pesquisado
								$_GET["pesquisa"]="S"; //Temporariamente vai ser pesquisado por S devido à base de dados
								
							}   //Se não se a pesquisa foi Não e o campo foi prioridade ou operacional então:
							elseif((($_GET["pesquisa"]=="N") OR ($_GET["pesquisa"]=="Nã") OR ($_GET["pesquisa"]=="Não")) AND (($_GET["campo"]=="prioridade") OR ($_GET["campo"]=="operacional")))
								{
									$pesquisaexata=$_GET["pesquisa"]; //A pesquisa exata recebe o que o foi pesquisado
									$_GET["pesquisa"]="N"; //Temporariamente vai ser pesquisado por N devido à base de dados
								}
					
					if($_GET["campo"]!="O_campo_que_digitou_e_invalido") //Se o campo que foi digitado não é inválido então:
					{
						if(isset($_GET["ordenadopor"])) //Se a ordenação existe então:
						{
							if($_GET["ordenadopor"]!="A_ordenacao_que_digitou_e_invalida") //Se a ordenação que foi digitado não é inválida então:
							{
								//Pesquisa na base de dados dos projetores da pesquisa específica com a ordenação
								$consultar_projetores=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, projetores p WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND tp.idprojetor=p.idprojetor AND tp.idprojetor>1 AND " . $_GET["campo"] . " LIKE '%" . $_GET["pesquisa"] . "%' ORDER BY " . $_GET["ordenadopor"] . ";");
								
								if(isset($pesquisaexata)) //Se a pesquisa exata existe então:
								{
									$_GET["pesquisa"]=$pesquisaexata; //A variável $_GET["pesquisa"] volta a ter o que tinha
								}
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum projetor então:
														"{" .
															"document.getElementById('pesquisar').value='" . $_GET["pesquisa"] . "';" .
															"document.getElementById('selectpesquisar').value='" . $_GET["campo"] . "';" .
															"document.getElementById('selectordenar').value='" . $_GET["ordenadopor"] . "';" .
														"}" .
													"});" .
												"</script>";
							}
							else //Se não:
							{
								//Pesquisa na base de dados dos projetores da pesquisa específica
								$consultar_projetores=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, projetores p WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND tp.idprojetor=p.idprojetor AND tp.idprojetor>1 AND " . $_GET["campo"] . " LIKE '%" . $_GET["pesquisa"] . "%' ORDER BY idequipamento;");
								
								if(isset($pesquisaexata)) //Se a pesquisa exata existe então:
								{
									$_GET["pesquisa"]=$pesquisaexata; //A variável $_GET["pesquisa"] volta a ter o que tinha
								}
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum projetor então:
														"{" .
															"document.getElementById('pesquisar').value='" . $_GET["pesquisa"] . "';" .
															"document.getElementById('selectpesquisar').value='" . $_GET["campo"] . "';" .
															"document.getElementById('selectordenar').value='idequipamento';" .
														"}" .
													"});" .
												"</script>";
							}
						}
						else //Se não:
						{
							//Pesquisa na base de dados dos projetores da pesquisa específica
							$consultar_projetores=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, projetores p WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND tp.idprojetor=p.idprojetor AND tp.idprojetor>1 AND " . $_GET["campo"] . " LIKE '%" . $_GET["pesquisa"] . "%' ORDER BY idequipamento;");
							
							if(isset($pesquisaexata)) //Se a pesquisa exata existe então:
							{
								$_GET["pesquisa"]=$pesquisaexata; //A variável $_GET["pesquisa"] volta a ter o que tinha
							}
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum projetor então:
													"{" .
														"document.getElementById('pesquisar').value='" . $_GET["pesquisa"] . "';" .
														"document.getElementById('selectpesquisar').value='" . $_GET["campo"] . "';" .
														"document.getElementById('selectordenar').value='idequipamento';" .
													"}" .
												"});" .
											"</script>";
						}
					}
					else //Se não:
					{
						if(isset($_GET["ordenadopor"])) //Se a ordenação existe então:
						{
							if($_GET["ordenadopor"]!="A_ordenacao_que_digitou_e_invalida") //Se a ordenação que foi digitado não é inválida então:
							{
								//Pesquisa na base de dados dos projetores com a ordenação
								$consultar_projetores=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, projetores p WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND tp.idprojetor=p.idprojetor AND tp.idprojetor>1 ORDER BY " . $_GET["ordenadopor"] . ";");
								
								if(isset($pesquisaexata)) //Se a pesquisa exata existe então:
								{
									$_GET["pesquisa"]=$pesquisaexata; //A variável $_GET["pesquisa"] volta a ter o que tinha
								}
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum projetor então:
														"{" .
															"document.getElementById('selectpesquisar').value='idequipamento';" .
															"document.getElementById('selectordenar').value='" . $_GET["ordenadopor"] . "';" .
														"}" .
													"});" .
												"</script>";
							}
							else //Se não:
							{
								//Pesquisa na base de dados dos projetores
								$consultar_projetores=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, projetores p WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND tp.idprojetor=p.idprojetor AND tp.idprojetor>1 ORDER BY idequipamento;");
								
								if(isset($pesquisaexata)) //Se a pesquisa exata existe então:
								{
									$_GET["pesquisa"]=$pesquisaexata; //A variável $_GET["pesquisa"] volta a ter o que tinha
								}
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum projetor então:
														"{" .
															"document.getElementById('selectpesquisar').value='idequipamento';" .
															"document.getElementById('selectordenar').value='idequipamento';" .
														"}" .
													"});" .
												"</script>";
							}
						}
						else //Se não:
						{
							//Pesquisa na base de dados dos projetores
							$consultar_projetores=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, projetores p WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND tp.idprojetor=p.idprojetor AND tp.idprojetor>1 ORDER BY idequipamento;");
							
							if(isset($pesquisaexata)) //Se a pesquisa exata existe então:
							{
								$_GET["pesquisa"]=$pesquisaexata; //A variável $_GET["pesquisa"] volta a ter o que tinha
							}
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum projetor então:
													"{" .
														"document.getElementById('selectpesquisar').value='idequipamento';" .
														"document.getElementById('selectordenar').value='idequipamento';" .
													"}" .
												"});" .
											 "</script>";
						}
					}
				}
				else //Se não:
				{
					if(isset($_GET["ordenadopor"])) //Se a ordenação existe então:
					{
						if($_GET["ordenadopor"]!="A_ordenacao_que_digitou_e_invalida") //Se a ordenação que foi digitado não é inválida então:
						{
							//Pesquisa na base de dados dos projetores com a ordenação
							$consultar_projetores=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, projetores p WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND tp.idprojetor=p.idprojetor AND tp.idprojetor>1 ORDER BY " . $_GET["ordenadopor"] . ";");
							
							if(isset($pesquisaexata)) //Se a pesquisa exata existe então:
							{
								$_GET["pesquisa"]=$pesquisaexata; //A variável $_GET["pesquisa"] volta a ter o que tinha
							}
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum projetor então:
													"{" .
														"document.getElementById('selectpesquisar').value='idequipamento';" .
														"document.getElementById('selectordenar').value='" . $_GET["ordenadopor"] . "';" .
													"}" .
												"});" .
											 "</script>";
						}
						else //Se não:
						{
							//Pesquisa na base de dados dos projetores
							$consultar_projetores=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, projetores p WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND tp.idprojetor=p.idprojetor AND tp.idprojetor>1 ORDER BY idequipamento;");
							
							if(isset($pesquisaexata)) //Se a pesquisa exata existe então:
							{
								$_GET["pesquisa"]=$pesquisaexata; //A variável $_GET["pesquisa"] volta a ter o que tinha
							}
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum projetor então:
													"{" .
														"document.getElementById('selectpesquisar').value='idequipamento';" .
														"document.getElementById('selectordenar').value='idequipamento';" .
													"}" .
												"});" .
											"</script>";
						}
					}
					else //Se não:
					{
						//Pesquisa na base de dados dos projetores
						$consultar_projetores=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, projetores p WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND tp.idprojetor=p.idprojetor AND tp.idprojetor>1 ORDER BY idequipamento;");
						
						if(isset($pesquisaexata)) //Se a pesquisa exata existe então:
						{
							$_GET["pesquisa"]=$pesquisaexata; //A variável $_GET["pesquisa"] volta a ter o que tinha
						}
						
						//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
						$preselecionado="<script>" .
											"window.addEventListener('load', function()" .
											"{" .
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum projetor então:
												"{" .
													"document.getElementById('selectpesquisar').value='idequipamento';" .
													"document.getElementById('selectordenar').value='idequipamento';" .
												"}" .
											"});" .
										"</script>";
					}
				}
				
				if($consultar_projetores) //Se não ocorreu nenhum erro:
				{
					$linhas_projetores=mysqli_num_rows($consultar_projetores); //Obtém o número de projetores
					if($linhas_projetores>0) //Se retornar mais que uma linha, significa que existe pelo menos um projetor então:
					{
			echo "<a class='btnpesquisar' id='btnpesquisar' href='#'></a>"; //Botão de pesquisa específica
			echo "<input type='Text' name='pesquisar' class='pesquisar' id='pesquisar' placeholder='Introduza o que quer pesquisar' title='Introduza o que quer pesquisar'>"; //Caixa de texto da pesquisa específica
			echo "<select name='selectpesquisar' class='selectpesquisar' id='selectpesquisar'>"; //Caixa de seleção da pesquisa específica
				echo "<option value='idequipamento'>Id</option>";
				echo "<option value='tipo'>Tipo de projetor</option>";
				echo "<option value='serial_number'>Número de série</option>";
				echo "<option value='posto'>Posto</option>";
				echo "<option value='fabricante'>Fabricante</option>";
				echo "<option value='modelo'>Modelo</option>";
				echo "<option value='prioridade'>Prioridade</option>";
				echo "<option value='operacional'>Operacional</option>";
				echo "<option value='nome_escola'>Escola</option>";
				echo "<option value='nome_bloco'>Bloco</option>";
				echo "<option value='nome_sala'>Sala</option>";
			echo "</select>";
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<label class='textoordenar' id='textoordenar'>Ordernar por:</label>"; //Texto ordenar por
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<select name='selectordenar' class='selectordenar' id='selectordenar'>"; //Caixa de seleção de ordenação
				echo "<option value='idequipamento'>Id (Crescente)</option>";
				echo "<option value='idequipamento DESC'>Id (Decrescente)</option>";
				echo "<option value='tipo'>Tipo de projetor (Crescente)</option>";
				echo "<option value='tipo DESC'>Tipo de projetor (Decrescente)</option>";
				echo "<option value='serial_number'>Número de série (Crescente)</option>";
				echo "<option value='serial_number DESC'>Número de série (Decrescente)</option>";
				echo "<option value='posto'>Posto (Crescente)</option>";
				echo "<option value='posto DESC'>Posto (Decrescente)</option>";
				echo "<option value='fabricante'>Fabricante (Crescente)</option>";
				echo "<option value='fabricante DESC'>Fabricante (Decrescente)</option>";
				echo "<option value='modelo'>Modelo (Crescente)</option>";
				echo "<option value='modelo DESC'>Modelo (Decrescente)</option>";
				echo "<option value='prioridade'>Prioridade (Crescente)</option>";
				echo "<option value='prioridade DESC'>Prioridade (Decrescente)</option>";
				echo "<option value='operacional'>Operacional (Crescente)</option>";
				echo "<option value='operacional DESC'>Operacional (Decrescente)</option>";
				echo "<option value='nome_escola'>Escola (Crescente)</option>";
				echo "<option value='nome_escola DESC'>Escola (Decrescente)</option>";
				echo "<option value='nome_bloco'>Bloco (Crescente)</option>";
				echo "<option value='nome_bloco DESC'>Bloco (Decrescente)</option>";
				echo "<option value='nome_sala'>Sala (Crescente)</option>";
				echo "<option value='nome_sala DESC'>Sala (Decrescente)</option>";
			echo "</select>";
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<label class='textoordenar' id='textoequipamento'>Selecione o equipamento que quer consultar:</label>"; //Texto para selecionar o equipamento
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<select name='equipamento' class='selectordenar' id='equipamento'>";
				echo "<option value='QIMs'>Quadro interativo multimédia</option>";
				echo "<option value='Computadores'>Computador</option>";
				echo "<option value='Monitores'>Monitor</option>";
				echo "<option value='Projetores' selected>Projetor</option>"; //Opção por defeito por estou na página de consultar projetores
			echo "</select>";
						echo $javascriptpesquisa; //Executa o que está programado para a pesquisa específica
						echo $preselecionado; //Executa o que está programado para o preselecionamento das caixas de seleção e da caixa de texto ter o que já tinha
			echo "<div class='zonatabela' id='zonatabela'>"; //Início da zona da tabela
				echo "<table class='tabela' id='tabela'>"; //Início da tabela
					echo "<thead>"; //Início do cabeçalho da tabela
						echo "<tr>"; //Início da linha da tabela
							echo "<th class='campotabela'>Id</th>";  //Título Id
							echo "<th class='campotabela'>Tipo de projetor</th>";  //Título Tipo de projetor
							echo "<th class='campotabela'>Número de série</th>"; //Título Número de série
							echo "<th class='campotabela'>Posto</th>"; //Título Posto
							echo "<th class='campotabela'>Fabricante</th>"; //Título Fabricante
							echo "<th class='campotabela'>Modelo</th>"; //Título Modelo
							echo "<th class='campotabela'>Fotografia</th>"; //Título Fotografia
							echo "<th class='campotabela'>Prioridade</th>"; //Título Prioridade
							echo "<th class='campotabela'>Operacional</th>"; //Título Operacional
							echo "<th class='campotabela'>Escola</th>"; //Título Escola
							echo "<th class='campotabela'>Bloco</th>"; //Título Bloco
							echo "<th class='campotabela'>Sala</th>"; //Título Sala
							
						if(isset($_SESSION["vista"])) //Se a variável de sessão existe significa que é o tipo de utilizador é um administrador então:
						{
							if($_SESSION["vista"]=="A") //Se a vista é de administrador cria o cabeçalho para os botões então:
							{
							echo "<th class='campotabela'></th>";
							echo "<th class='campoultimo'></th>"; //Este campo receberá um comprimento diferente para ficar alinhado com com a barra de rolagem
							}
							elseif($_SESSION["vista"]=="E") //Se não não mete os cabeçalhos e os botões e define este campo como último
								{
									echo "<script>" .
											 "window.addEventListener('load', function()" .
											 "{" .
												 "if(!(document.getElementById('tabela')==null))" . //Se a tabela existir então:
												 "{" .
													 "document.getElementById('tabela').style.width='2400px';" . //Dimiui o tamanho da tabela
												 "}" .
											 "});" .
										 "</script>";
										
							echo "<th class='campoultimo'></th>";
								}
						}
						else //Se não não mete os cabeçalhos e os botões e define este campo como último
						{
							echo "<script>" .
									 "window.addEventListener('load', function()" .
									 "{" .
										 "if(!(document.getElementById('tabela')==null))" . //Se a tabela existir então:
										 "{" .
											 "document.getElementById('tabela').style.width='2400px';" . //Dimiui o tamanho da tabela
										 "}" .
									 "});" .
								 "</script>";
								
							echo "<th class='campoultimo'></th>";
						}
							
						echo "</tr>";//Fim da linha da tabela
					echo "</thead>"; //Fim do cabeçalho da tabela
					echo "<tbody>"; //Início dos campos da tabela
						for($i=0; $i<$linhas_projetores; $i++) //Vai repetir o número de projetores, por exemplo, se existir 10 projetores repete 10 vezes
						{
							$dados_projetores=mysqli_fetch_array($consultar_projetores); //Recebe os dados de cada projetor
							
							//Este if, o else e tudo dentro é para definir o link de editar e eliminar para depois, por exemplo, se fiz mandei eliminar e quero cancelar vou voltar para essa página com a pesquisa específica em vez de voltar para a página original
							if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se já havia uma pesquisa específica então:
							{
								if(isset($_GET["ordenadopor"])) //Se já existia uma ordenação então:
								{
									$linkeditar="?acao=editar&id=" . $dados_projetores["idequipamento"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] ."&ordenadopor=" . $_GET["ordenadopor"];
									$linkeliminar="?acao=eliminar&id=" . $dados_projetores["idequipamento"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] ."&ordenadopor=" . $_GET["ordenadopor"];
								}
								else //Se não:
								{
									$linkeditar="?acao=editar&id=" . $dados_projetores["idequipamento"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"];
									$linkeliminar="?acao=eliminar&id=" . $dados_projetores["idequipamento"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"];
								}
							}
							else //Se não:
							{
								if(isset($_GET["ordenadopor"]))
								{
									$linkeditar="?acao=editar&id=" . $dados_projetores["idequipamento"] . "&ordenadopor=" . $_GET["ordenadopor"];
									$linkeliminar="?acao=eliminar&id=" . $dados_projetores["idequipamento"] . "&ordenadopor=" . $_GET["ordenadopor"];
								}
								else  //Se não:
								{
									$linkeditar="?acao=editar&id=" . $dados_projetores["idequipamento"];
									$linkeliminar="?acao=eliminar&id=" . $dados_projetores["idequipamento"];
								}
							}
								
						echo "<tr>"; //Início da linha da tabela
							echo "<td>" . $dados_projetores["idequipamento"] . "</td>" ; //Aqui vai aparecer o id do equipamento
							
							switch($dados_projetores["tipo"]) //Caso o tipo:
							{
				  //Seja V:
				  case "V": echo "<td>Videoprojetor</td>"; //Aparece Videoprojetor na tabela
							break; //Fim da opção
							
				  //Seja Q
				  case "Q": echo "<td>Quadro Interativo Multimédia</td>"; //Aparece Quadro Interativo Multimédia na tabela
							break; //Fim da opção
							
								default: $_SESSION["mensagemerro"]="A tipo de projetor é inválido, por favor informe o administrador."; //Passa a mensagem de erro
										 header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro;
							}
							
							echo "<td>" . $dados_projetores["serial_number"] . "</td>"; //Aqui vai aparecer o número de série
							echo "<td>" . $dados_projetores["posto"] . "</td>"; //Aqui vai aparecer o posto
							echo "<td>" . $dados_projetores["fabricante"] . "</td>"; //Aqui vai aparecer o fabricante
							echo "<td>" . $dados_projetores["modelo"] . "</td>"; //Aqui vai aparecer o modelo
							echo "<td><img src='" . $dados_projetores["foto"] . "' name='foto" . ($i+1) . "' id='foto" . ($i+1) . "' width='50px' height='50px' alt='Erro ao carregar a fotografia do projetor, por favor informe o administrador.' title='Clique na imagem para ver melhor.' style='cursor: Pointer;'></td>"; //Aqui vai aparecer a fotografia
							
							switch($dados_projetores["prioridade"]) //Caso a prioridade:
							{
				  //Seja S:
				  case "S": echo "<td>Sim</td>"; //Aparece Sim na tabela
							break; //Fim da opção
							
				  //Seja N
				  case "N": echo "<td>Não</td>"; //Aparece Não na tabela
							break; //Fim da opção
							
								default: $_SESSION["mensagemerro"]="A prioridade é inválida, por favor informe o administrador."; //Passa a mensagem de erro
										 header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro;
							}
							
							switch($dados_projetores["operacional"]) //Caso o operacional:
							{
				  //Seja S:
				  case "S": echo "<td>Sim</td>"; //Aparece Sim na tabela
							break; //Fim da opção
							
				  //Seja N
				  case "N": echo "<td>Não</td>"; //Aparece Não na tabela
							break; //Fim da opção
							
								default: $_SESSION["mensagemerro"]="O operacional é inválido, por favor informe o administrador."; //Passa a mensagem de erro
										 header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro;
							}
							
							echo "<td><a href='ConsultarEscolas.php?pesquisa=" . $dados_projetores["idescola"] . "&campo=idescola' style='color: Black;'>" . $dados_projetores["nome_escola"] . "</a></td>"; //Aqui vai aparecer o nome da escola e se clicar ele redirecionar-me-à para a página de consultar essa escola em específico
							echo "<td><a href='ConsultarBlocos.php?pesquisa=" . $dados_projetores["idbloco"] . "&campo=idbloco' style='color: Black;'>" . $dados_projetores["nome_bloco"] . "</a></td>"; //Aqui vai aparecer o nome do bloco e se clicar ele redirecionar-me-à para a página de consultar esse bloco em específico
							echo "<td><a href='ConsultarSalas.php?pesquisa=" . $dados_projetores["idsala"] . "&campo=idsala' style='color: Black;'>" . $dados_projetores["nome_sala"] . "</a></td>"; //Aqui vai aparecer o nome da sala e se clicar ele redirecionar-me-à para a página de consultar essa sala em específico
							echo "<td><div align='Center'><a href='" . $linkeditar . "'><i class='fa fa-pencil' style='color: Black;'></i></a></div></td>"; //Botão para editar os dados
							
							if(isset($_SESSION["vista"])) //Se a variável de sessão existe significa que é o tipo de utilizador é um administrador então:
							{
								if($_SESSION["vista"]=="A") //Se a vista é de administrador cria o botão de editar e eliminar então
								{
							echo "<td><div align='Center'><a href='" . $linkeliminar . "'><i class='fa fa-close' style='color: Black;'></i></a></div></td>"; //Botão para eliminar os dados
								}
							}
							
							$nome_foto=""; //Inicializa a variável nome_foto
							
							for($j=21; $j<(count(str_split($dados_projetores["foto"]))); $j++)
							{
								$nome_foto.=$dados_projetores["foto"][$j]; //Faz a variável nome_foto receber o nome da fotografia
							}
							
						echo "</tr>"; //Fim da linha
							
							echo "<script>" .
									 "window.addEventListener('load', function()" .
									 "{" .
										 "if(!(document.getElementById('foto" . ($i+1) . "')==null))" . //Se a fotografia existe porque pode não existir no caso de estivar a editar os dados do projetor então:
										 "{" .
											 "document.getElementById('foto" . ($i+1) . "').addEventListener('click', function()" . //Quando clicar na fotografia:
											 "{" .
												 "Modal('foto', '');" . //Abre o modal fotografia para podermos ver a imagem toda
												 "document.getElementById('zonamodalconsultar').style.backgroundColor='rgba(0, 0, 0, 0.9)';" . //O fundo do modal fica mais escuro
												 
												 "document.getElementById('jsmodal').innerHTML='';" . //Retira o funcionamento do modal do javascript para puder a seguir adicionar o funcionamento do modal da fotografia sem haver erros
												 
												 //A parte HTML do modal muda para consoante o modal da fotografia
												 "document.getElementById('zonamodalconsultar').innerHTML='<span class=\'fecharmodal\' id=\'fecharmodal\'><i class=\'fa fa-close\'></i></span>' +" . //Botão para fechar o modal da fotografia
																											 "'<img class=\'modalfoto\' id=\'modalfoto\'>' +" . //Aqui aparece a fotografia
																											 "'<div class=\'nomefoto\' id=\'nomefoto\'></div>' +" . //Aqui aparece o nome da fotografia
																										 "'</div>';" .
												 
												 "document.getElementById('modalfoto').src='" . $dados_projetores["foto"] . "';" . //Faz o modal receber a fotografia
												 "document.getElementById('nomefoto').innerHTML='" . $nome_foto . "';" . //Faz o modal receber o nome da fotografia
												 
												 "document.getElementById('fecharmodal').addEventListener('click', function()" . //Quando clicar para fechar o modal da fotografia:
												 "{" .
													 "document.getElementById('zonamodalconsultar').style.display='none';" . //Esconde o modal
													 "document.getElementById('zonamodalconsultar').style.backgroundColor='rgba(0, 0, 0, 0.4)';" . //O fundo do modal volta a estar mais claro
													 "document.getElementById('nomefoto').innerHTML='';" . //Retira a fotografia do modal
													 
													 //A parte HTML do modal volta a ter os códigos que tinha respetisoa aos outros modals
													 "document.getElementById('zonamodalconsultar').innerHTML='<div class=\'\' id=\'modalconsultar\'>' +" .
																												 "'<br>' +" .
																												 "'<br>' +" .
																												 "'<br>' +" .
																												 "'<br>' +" .
																												 "'<br>' +" .
																												 "'<br>' +" .
																												 "'<br>' +" .
																												 "'<br>' +" .
																												 "'<div class=\'resposta\' id=\'respostaconsultar\'></div>' +" .
																												 "'<br>' +" .
																												 "'<br>' +" .
																												 "'<div id=\'zonabtnmodal\'>' +" .
																													 "'<br>' +" .
																													 "'<button class=\'btnok\' id=\'btnokconsultar\'>Ok</button>' +" .
																												 "'</div>' +" .
																											 "'</div>';" .
													 
													 //O javascript do modal volta a ter os códigos javascript respetivos aos outros modals
													 "document.getElementById('jsmodal').innerHTML='function Modal(tipo, mensagem)' +" .
																								  "'{' +" .
																									  "'switch(tipo)' +" .
																									  "'{' +" .
																										  "'case \'certo\': document.getElementById(\'respostaconsultar\').style.color=\'#1CEE0E\';' +" .
																														  "'document.getElementById(\'btnokconsultar\').style.backgroundColor=\'#1CEE0E\';' +" .
																														  
																														  "'document.getElementById(\'btnokconsultar\').addEventListener(\'mouseover\', function()' +" .
																														  "'{' +" .
																															  "'document.getElementById(\'btnokconsultar\').style.backgroundColor=\'#2DAB24\';' +" .
																														  "'});' +" .
																														  
																														  "'document.getElementById(\'btnokconsultar\').addEventListener(\'mouseout\', function()' +" .
																														  "'{' +" .
																															  "'document.getElementById(\'btnokconsultar\').style.backgroundColor=\'#1CEE0E\';' +" .
																														  "'});' +" .
																														  "'break;' +" .
																														  
																										  "'case \'erro\': document.getElementById(\'respostaconsultar\').style.color=\'#E63946\';' +" .
																														 "'document.getElementById(\'btnokconsultar\').style.backgroundColor=\'#E63946\';' +" .
																														 
																														 "'document.getElementById(\'btnokconsultar\').addEventListener(\'mouseover\', function()' +" .
																														 "'{' +" .
																															 "'document.getElementById(\'btnokconsultar\').style.backgroundColor=\'#DD3C48\';' +" .
																														 "'});' +" .
																														 
																														 "'document.getElementById(\'btnokconsultar\').addEventListener(\'mouseout\', function()' +" .
																														 "'{' +" .
																															 "'document.getElementById(\'btnokconsultar\').style.backgroundColor=\'#E63946\';' +" .
																														 "'});' +" .
																														 "'break;' +" .
																														 
																										  "'case \'utilizador\': document.getElementById(\'respostaconsultar\').style.color=\'#000000\';' +" .
																															   "'break;' +" .
																															   
																										  "'case \'escola\': document.getElementById(\'respostaconsultar\').style.color=\'#000000\';' +" .
																														   "'break;' +" .
																														   
																										  "'case \'qim\': document.getElementById(\'respostaconsultar\').style.color=\'#000000\';' +" .
																														"'break;' +" .
																														
																										  "'case \'computador\': document.getElementById(\'respostaconsultar\').style.color=\'#000000\';' +" .
																															   "'break;' +" .
																															   
																										  "'case \'monitor\': document.getElementById(\'respostaconsultar\').style.color=\'#000000\';' +" .
																															"'break;' +" .
																															
																										  "'case \'projetor\': document.getElementById(\'respostaconsultar\').style.color=\'#000000\';' +" .
																															 "'break;' +" .
																															 
																										  "'case \'avaria\': document.getElementById(\'respostaconsultar\').style.color=\'#000000\';' +" .
																														   "'break;' +" .
																														   
																										  "'case \'foto\': ' +" .
																														 "'break;' +" .
																									  "'}' +" .
																									  
																									  "'if(!(document.getElementById(\'btnokconsultar\')==null))' +" .
																									  "'{' +" .
																										  "'document.getElementById(\'btnokconsultar\').addEventListener(\'click\', function()' +" .
																										  "'{' +" .
																											  "'location.href=\'ConsultarProjetores.php\';' +" .
																										  "'});' +" .
																										  
																										  "'if(!(document.getElementById(\'modalconsultar\')==null))' +" .
																										  "'{' +" .
																											  "'if(mensagem.length>200)' +" .
																											  "'{' +" .
																												  "'document.getElementById(\'modalconsultar\').style.height=\'450px\';' +" .
																											  "'}' +" .
																											  "'else if(mensagem.length>100)' +" .
																												   "'{' +" .
																													   "'document.getElementById(\'modalconsultar\').style.height=\'400px\';' +" .
																												   "'}' +" .
																												   "'else' +" .
																												   "'{' +" .
																													   "'document.getElementById(\'modalconsultar\').style.height=\'330px\';' +" .
																												   "'}' +" .
																										  "'}' +" .
																										 
																										 "'document.getElementById(\'modalconsultar\').className=\'modal\' + tipo;' +" .
																										 "'document.getElementById(\'respostaconsultar\').innerHTML=mensagem;' +" .
																										 "'document.getElementById(\'zonamodalconsultar\').style.display=\'block\';' +" .
																									 "'}' +" .
																								  "'}';" .
												 "});" .
											 "});" .
										 "}" .
									 "});" .
								 "</script>";
						}
					echo "</tbody>"; //Fim dos campos da tabela
				echo "</table>"; //Fim da tabela
			echo "</div>"; //Fim da zona da tabela
					}
					elseif($linhas_projetores==0) //Se não se retornar 0 linhas, significa que não existe nenhum projetor preenchido então:
						{
							if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se o campo pesquisa existe, significa que na verdade os dados existem mas só mandei fazer uma pesquisa específica que não retornou resultados então:
							{
								//Escreve a código da pesquisa específica e do ordenar outra vez
								echo "<script>" .
										 "window.addEventListener('load', function()" .
										 "{" .
											 "document.getElementById('zonaconsultar').innerHTML='' +" .
																								"'<a class=\'btnpesquisar\' id=\'btnpesquisar\' href=\'#\' style=\'background-image: url(ImagensSite//Lupa.jpg);\'></a>' +" .
																								"'<input type=\'Text\' name=\'pesquisar\' class=\'pesquisar\' id=\'pesquisar\' placeholder=\'Introduza o que quer pesquisar\' title=\'Introduza o que quer pesquisar\'>' +" .
																								"'<select name=\'selectpesquisar\' class=\'selectpesquisar\' id=\'selectpesquisar\'>' +" .
																									"'<option value=\'idequipamento\'>Id</option>' +" .
																									"'<option value=\'tipo\'>Tipo de projetor</option>' +" .
																									"'<option value=\'serial_number\'>Número de série</option>' +" .
																									"'<option value=\'posto\'>Posto</option>' +" .
																									"'<option value=\'fabricante\'>Fabricante</option>' +" .
																									"'<option value=\'modelo\'>Modelo</option>' +" .
																									"'<option value=\'prioridade\'>Prioridade</option>' +" .
																									"'<option value=\'operacional\'>Operacional</option>' +" .
																									"'<option value=\'nome_escola\'>Escola</option>' +" .
																									"'<option value=\'nome_bloco\'>Bloco</option>' +" .
																									"'<option value=\'nome_sala\'>Sala</option>' +" .
																								"'</select>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<label class=\'textoordenar\' id=\'textoordenar\'>Ordernar por:</label>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<select name=\'selectordenar\' class=\'selectordenar\' id=\'selectordenar\'>' +" .
																									"'<option value=\'idequipamento\'>Id (Crescente)</option>' +" .
																									"'<option value=\'idequipamento DESC\'>Id (Decrescente)</option>' +" .
																									"'<option value=\'tipo\'>Tipo de projetor (Crescente)</option>' +" .
																									"'<option value=\'tipo DESC\'>Tipo de projetor (Decrescente)</option>' +" .
																									"'<option value=\'serial_number\'>Número de série (Crescente)</option>' +" .
																									"'<option value=\'serial_number DESC\'>Número de série (Decrescente)</option>' +" .
																									"'<option value=\'posto\'>Posto (Crescente)</option>' +" .
																									"'<option value=\'posto DESC\'>Posto (Decrescente)</option>' +" .
																									"'<option value=\'fabricante\'>Fabricante (Crescente)</option>' +" .
																									"'<option value=\'fabricante DESC\'>Fabricante (Decrescente)</option>' +" .
																									"'<option value=\'modelo\'>Modelo (Crescente)</option>' +" .
																									"'<option value=\'modelo DESC\'>Modelo (Decrescente)</option>' +" .
																									"'<option value=\'prioridade\'>Prioridade (Crescente)</option>' +" .
																									"'<option value=\'prioridade DESC\'>Prioridade (Decrescente)</option>' +" .
																									"'<option value=\'operacional\'>Operacional (Crescente)</option>' +" .
																									"'<option value=\'operacional DESC\'>Operacional (Decrescente)</option>' +" .
																									"'<option value=\'nome_escola\'>Escola (Crescente)</option>' +" .
																									"'<option value=\'nome_escola DESC\'>Escola (Decrescente)</option>' +" .
																									"'<option value=\'nome_bloco\'>Bloco (Crescente)</option>' +" .
																									"'<option value=\'nome_bloco DESC\'>Bloco (Decrescente)</option>' +" .
																									"'<option value=\'nome_sala\'>Sala (Crescente)</option>' +" .
																									"'<option value=\'nome_sala DESC\'>Sala (Decrescente)</option>' +" .
																								"'</select>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<div class=\'textoordenar\' id=\'zonatabela\'>' +" .
																									"'<hr align=\'Left\' width=\'330px\'>' +" . //Cria uma linha em cima da frase
																									"'<br>' +" .
																									"'<label>A pesquisa que efetuou não retornou resultados.</label><br><a class=\'link\' id=\'voltar\'>Voltar para a página original.</a>' +" . //Aparece uma mensagem a dizer que a pesquisa específica não retornou resultados
																									"'<br>' +" .
																									"'<br>' +" .
																									"'<hr align=\'Left\' width=\'330px\'>' +" . //Cria uma linha em baixo da frase
																								"'</div>';" .
											 
											 "document.getElementById('voltar').addEventListener('click', function()" . //Quando clicar no botão voltar:
											 "{" .
												 "location.href='ConsultarProjetores.php';" . //Volta para a página original
											 "});" .
										 "});" .
									 "</script>";
								
								echo $javascriptpesquisa; //Executa o que está programado para a pesquisa específica
								echo $preselecionado; //Executa o que está programado para o preselecionamento das caixas de seleção e da caixa de texto ter o que já tinha
							}
							else //Se não:
							{
								if(isset($_SESSION["vista"])) //Se a variável vista existe
								{
									if($_SESSION["vista"]=="A") //Se a vista é de administrador então pode ser redirecionado para a página de inserir projetores:
									{
										echo "<script>" .
												 "window.addEventListener('load', function()" .
												 "{" .
													 "var segundos=5;" . //Variável que vai conter os segundos
													 
													 "Modal('projetor', 'Sem projetores inseridos.');" . //Abre o Modal de que ainda não foi inserido nada
													 
													 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir projetores dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página de inserir projetores dentro de 5 segundos
													 "document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
													 
													 "setTimeout(function()" . //Ao fim de 6 segundos acontecerá:
													 "{" .
														 "location.href='InserirProjetores.php';" . //Redireciona para a página de inserir projetores
													 "}, 6000);" .
													 
													 "setInterval(function()" . //De 1 em 1 segundo:
													 "{" .
														 "if(segundos==1)" . //Se falta 1 segundo então vai meter a palavra segundos no singular
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir projetores dentro de ' + segundos + ' segundo.';" .
															 "segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
														 "}" .
														 "else" .
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir projetores dentro de ' + segundos + ' segundos.';" .
															 "segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
														 "}" .
													 "}, 1000);" .
												 "});" .
											 "</script>";
									}
									else //Se não, como o utilizador não está na vista de administrador então manda para a página inicial então:
									{
										echo "<script>" .
												 "window.addEventListener('load', function()" .
												 "{" .
													 "var segundos=5;" . //Variável que vai conter os segundos
													 
													 "Modal('projetor', 'Sem projetores inseridos, por favor informe o administrador.');" . //Abre o Modal de que ainda não foi inserido nada
													 
													 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página inicial dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página inicial dentro de 5 segundos
													 "document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
													 
													 "setTimeout(function()" . //Ao fim de 6 segundos acontecerá:
													 "{" .
														 "location.href='Inicio.php';" . //Redireciona para a página inicial
													 "}, 6000);" .
													 
													 "setInterval(function()" . //De 1 em 1 segundo:
													 "{" .
														 "if(segundos==1)" . //Se falta 1 segundo então vai meter a palavra segundos no singular
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página inicial dentro de ' + segundos + ' segundo.';" .
															 "segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
														 "}" .
														 "else" .
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página inicial dentro de ' + segundos + ' segundos.';" .
															 "segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
														 "}" .
													 "}, 1000);" .
												 "});" .
											 "</script>";
									}
								}
								else //Se não como vai verificar o tipo de utilizador da sessão iniciada então:
								{
									if($_SESSION["tipo_utilizador"]=="A") //Se o tipo de utilizador é de administrador então pode ser redirecionado para a página de inserir salas:
									{
										echo "<script>" .
												 "window.addEventListener('load', function()" .
												 "{" .
													 "var segundos=5;" . //Variável que vai conter os segundos
													 
													 "Modal('projetor', 'Sem projetores inseridos.');" . //Abre o Modal de que ainda não foi inserido nada
													 
													 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir projetores dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página de inserir projetores dentro de 5 segundos
													 "document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
													 
													 "setTimeout(function()" . //Ao fim de 6 segundos acontecerá:
													 "{" .
														 "location.href='InserirProjetores.php';" . //Redireciona para a página de inserir projetores
													 "}, 6000);" .
													 
													 "setInterval(function()" . //De 1 em 1 segundo:
													 "{" .
														 "if(segundos==1)" . //Se falta 1 segundo então vai meter a palavra segundos no singular
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir projetores dentro de ' + segundos + ' segundo.';" .
															 "segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
														 "}" .
														 "else" .
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir projetores dentro de ' + segundos + ' segundos.';" .
															 "segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
														 "}" .
													 "}, 1000);" .
												 "});" .
											 "</script>";
									}
									else //Se não, como o utilizador não é administrador então manda para a página inicial então:
									{
										echo "<script>" .
												 "window.addEventListener('load', function()" .
												 "{" .
													 "var segundos=5;" . //Variável que vai conter os segundos
													 
													 "Modal('projetor', 'Sem projetores inseridos, por favor informe o administrador.');" . //Abre o Modal de que ainda não foi inserido nada
													 
													 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página inicial dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página inicial dentro de 5 segundos
													 "document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
													 
													 "setTimeout(function()" . //Ao fim de 6 segundos acontecerá:
													 "{" .
														 "location.href='Inicio.php';" . //Redireciona para a página inicial
													 "}, 6000);" .
													 
													 "setInterval(function()" . //De 1 em 1 segundo:
													 "{" .
														 "if(segundos==1)" . //Se falta 1 segundo então vai meter a palavra segundos no singular
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página inicial dentro de ' + segundos + ' segundo.';" .
															 "segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
														 "}" .
														 "else" .
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página inicial dentro de ' + segundos + ' segundos.';" .
															 "segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
														 "}" .
													 "}, 1000);" .
												 "});" .
											 "</script>";
									}
								}
							}
						}
						elseif($linhas_projetores<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
							{
								$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
				}
				else //Se não, se ocorreu um erro:
				{
					if((isset($_GET["pesquisa"])) AND (isset($_GET["campo"]))) //Se foi feita uma pesquisa específica:
					{
						if(isset($_GET["ordenadopor"])) //Se foi feita uma ordenação então:
						{
							//Se o campo digitado não for nenhum válido
							if(($_GET["campo"]!="idequipamento") AND ($_GET["campo"]!="tipo") AND ($_GET["campo"]!="serial_number") AND ($_GET["campo"]!="posto") AND ($_GET["campo"]!="fabricante") AND ($_GET["campo"]!="modelo") AND ($_GET["campo"]!="prioridade") AND ($_GET["campo"]!="operacional") AND ($_GET["campo"]!="nome_escola") AND ($_GET["campo"]!="nome_bloco") AND ($_GET["campo"]!="nome_sala"))
							{
								//se a ordenação digitada não for nenhum válido
								if(($_GET["ordenadopor"]!="idequipamento") AND ($_GET["ordenadopor"]!="idequipamento DESC") AND ($_GET["ordenadopor"]!="tipo") AND ($_GET["ordenadopor"]!="tipo DESC") AND ($_GET["ordenadopor"]!="serial_number") AND ($_GET["ordenadopor"]!="serial_number DESC") AND ($_GET["ordenadopor"]!="posto") AND ($_GET["ordenadopor"]!="posto DESC") AND ($_GET["ordenadopor"]!="fabricante") AND ($_GET["ordenadopor"]!="fabricante DESC") AND ($_GET["ordenadopor"]!="modelo") AND ($_GET["ordenadopor"]!="modelo DESC") AND ($_GET["ordenadopor"]!="prioridade") AND ($_GET["ordenadopor"]!="prioridade DESC") AND ($_GET["ordenadopor"]!="operacional") AND ($_GET["ordenadopor"]!="operacional DESC") AND ($_GET["ordenadopor"]!="nome_escola") AND ($_GET["ordenadopor"]!="nome_escola DESC") AND ($_GET["ordenadopor"]!="nome_bloco") AND ($_GET["ordenadopor"]!="nome_bloco DESC") AND ($_GET["ordenadopor"]!="nome_sala") AND ($_GET["ordenadopor"]!="nome_sala DESC"))
								{
									//Recarrega a página e mensagem a avisar que o campo que digitou e a ordenação que digitou são inválidos
									header("Location: ?pesquisa=" . $_GET["pesquisa"] . "&campo=O_campo_que_digitou_e_invalido&ordenadopor=A_ordenacao_que_digitou_e_invalida");
								}
								else //Se não
								{
									//Recarrega a página e mensagem a avisar que o campo que digitou é inválido
									header("Location: ?pesquisa=" . $_GET["pesquisa"] . "&campo=O_campo_que_digitou_e_invalido&ordenadopor=" .  $_GET["ordenadopor"]);
								}
							}
							else //Se não
							{
								//Se a ordenação é inválida
								if(($_GET["ordenadopor"]!="idequipamento") AND ($_GET["ordenadopor"]!="idequipamento DESC") AND ($_GET["ordenadopor"]!="tipo") AND ($_GET["ordenadopor"]!="tipo DESC") AND ($_GET["ordenadopor"]!="serial_number") AND ($_GET["ordenadopor"]!="serial_number DESC") AND ($_GET["ordenadopor"]!="posto") AND ($_GET["ordenadopor"]!="posto DESC") AND ($_GET["ordenadopor"]!="fabricante") AND ($_GET["ordenadopor"]!="fabricante DESC") AND ($_GET["ordenadopor"]!="modelo") AND ($_GET["ordenadopor"]!="modelo DESC") AND ($_GET["ordenadopor"]!="prioridade") AND ($_GET["ordenadopor"]!="prioridade DESC") AND ($_GET["ordenadopor"]!="operacional") AND ($_GET["ordenadopor"]!="operacional DESC") AND ($_GET["ordenadopor"]!="nome_escola") AND ($_GET["ordenadopor"]!="nome_escola DESC") AND ($_GET["ordenadopor"]!="nome_bloco") AND ($_GET["ordenadopor"]!="nome_bloco DESC") AND ($_GET["ordenadopor"]!="nome_sala") AND ($_GET["ordenadopor"]!="nome_sala DESC"))
								{
									//Recarrega a página e mensagem a avisar que a ordenação que digitou é inválida
									header("Location: ?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=A_ordenacao_que_digitou_e_invalida");
								}
								else //Se não:
								{
									$_SESSION["mensagemerro"]="Erro ao consultar os projetores, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
						}
						else //Se não
						{
							//Se o campo é inválido
							if(($_GET["campo"]!="idequipamento") AND ($_GET["campo"]!="tipo") AND ($_GET["campo"]!="serial_number") AND ($_GET["campo"]!="posto") AND ($_GET["campo"]!="fabricante") AND ($_GET["campo"]!="modelo") AND ($_GET["campo"]!="resolucao") AND ($_GET["campo"]!="polegadas") AND ($_GET["campo"]!="quantidade") AND ($_GET["campo"]!="prioridade") AND ($_GET["campo"]!="operacional") AND ($_GET["campo"]!="nome_escola") AND ($_GET["campo"]!="nome_bloco") AND ($_GET["campo"]!="nome_sala"))
							{
								//Recarrega a página e mensagem a avisar que o campo que digitou é inválido
								header("Location: ?pesquisa=" . $_GET["pesquisa"] . "&campo=O_campo_que_digitou_e_invalido");
							}
							else //Se não
							{
								$_SESSION["mensagemerro"]="Erro ao consultar os projetores, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
					}
					else //Se não
					{
						if(isset($_GET["ordenadopor"])) //Se foi feita uma ordenação:
						{
							//Se o ordenar é inválido:
							if(($_GET["ordenadopor"]!="idequipamento") AND ($_GET["ordenadopor"]!="idequipamento DESC") AND ($_GET["ordenadopor"]!="tipo") AND ($_GET["ordenadopor"]!="tipo DESC") AND ($_GET["ordenadopor"]!="serial_number") AND ($_GET["ordenadopor"]!="serial_number DESC") AND ($_GET["ordenadopor"]!="posto") AND ($_GET["ordenadopor"]!="posto DESC") AND ($_GET["ordenadopor"]!="fabricante") AND ($_GET["ordenadopor"]!="fabricante DESC") AND ($_GET["ordenadopor"]!="modelo") AND ($_GET["ordenadopor"]!="modelo DESC") AND ($_GET["ordenadopor"]!="prioridade") AND ($_GET["ordenadopor"]!="prioridade DESC") AND ($_GET["ordenadopor"]!="operacional") AND ($_GET["ordenadopor"]!="operacional DESC") AND ($_GET["ordenadopor"]!="nome_escola") AND ($_GET["ordenadopor"]!="nome_escola DESC") AND ($_GET["ordenadopor"]!="nome_bloco") AND ($_GET["ordenadopor"]!="nome_bloco DESC") AND ($_GET["ordenadopor"]!="nome_sala") AND ($_GET["ordenadopor"]!="nome_sala DESC"))	
							{
								//Recarrega a página e mensagem a avisar que a ordenação que digitou é inválida
								header("Location: ?ordenadopor=A_ordenacao_que_digitou_e_invalida");
							}
							else //Se nao
							{
								$_SESSION["mensagemerro"]="Erro ao consultar os projetores, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
						else //Se nao
						{
							$_SESSION["mensagemerro"]="Erro ao consultar os projetores, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarProjetores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
					}
				}
			?>
			<div class="zonamodal" id="zonamodalconsultar"> <!-- Início da zona do modal -->
				<div class="" id="modalconsultar"> <!-- Início do modal -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<div class="resposta" id="respostaconsultar"></div> <!-- Aqui vai receber a confirmação se inseriu bem ou mal -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<div id="zonabtnmodal"> <!-- Zona dos botões do modal -->
						<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
						<button class="btnok" id="btnokconsultar">Ok</button> <!-- Botão para continuar -->
					</div>
				</div>	<!-- Fim do modal -->
			</div> <!-- Fim da zona do modal -->
		</div> <!-- Fim da zona de consultar -->
	</body> <!-- Fim do body -->
</html> <!-- Fim do html -->
<!-- Voltar para cima para explicar o código PHP -->