<!-- Começar a explicar a partir do HTML e só depois voltar aqui para cima -->
<!-- Inicio dos códigos PHP -->
<?php
	include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
	
	session_start(); //Inicia a sessão para puder fazer a verificação se estou logado ou não, sempre que preciso de usar alguma variável da session tenho que obrigatoriamente começar por esse código
	
	if(!isset($_SESSION["idutilizador"])) //Se o id do utilizador não exite:
	{
		$_SESSION["pagina"]="ConsultarAvarias.php"; //Variável que indica que página eu pretendia entrar para assim que fizer o login redirecionar-me de volta para esta página
		header("Location: Login.php"); //Manda para a página do Login por se o id do utilizador não existe significa que não efetoou o login
	}
	
	if(isset($_POST["selectvista"])) //Se mandei alterar a vista então:
	{
		$_SESSION["vista"]=$_POST["selectvista"]; //A variável de sessão recebe a opção que selecionei
		header("Location: ConsultarAvarias.php"); //Recarrega a página para a vista
	}
	
	//Ideia de redirecionar-me para a página que queria sem sucesso
	if(($_SESSION["tipo_utilizador"]=="A")) //Se o utilizador é Administrador
	{
		if(((!($_SESSION["tipo_utilizador"]=="A")) AND (!($_SESSION["vista"]=="A"))) AND ((!($_SESSION["vista"]=="E")))) //Se o utilizador não é administrador ou não está na vista de estagiário:
		{
			
			if($_SESSION["pagina"]=="ConsultarAvarias.php") //Se a página que estiver for a ConsultarAvarias.php, significa que provavelmente tinha tentado entrar nesta página mas redirecionou-me para a página de login por ainda não ter sessão inciada aí fiz o login mas a conta aonde estou não contêm permissões de administrador ou de estagiário então:
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
	
	$_SESSION["pagina"]="ConsultarAvarias.php"; //Variável que indica que página eu estou para que assim que entre numa página que não contenha permissão redirecione-me de volta a esta página aonde estava antes
	
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
							header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
						
						$consultar_avaria=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, avarias a, tecnicos t, utilizadores u WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idequipamento=a.idequipamento AND a.idtecnico=t.idtecnico AND a.idutilizador=u.idutilizador AND a.idavaria=" . $_GET["id"] . ";"); //Vai buscar a avaria que quero editar
						if($consultar_avaria) //Se não ocorreu nenhum erro:
						{
							$linhas_avaria=mysqli_num_rows($consultar_avaria); //Obtém o número de avarias com esse id
							if($linhas_avaria>0) //Se retornar mais que uma linha, significa que existe pelo menos uma avaria então:
							{
								$dados_avaria=mysqli_fetch_array($consultar_avaria); //Vai buscar os dados da avaria que quero editar
								
								if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se estava uma pesquisa específica
								{
									if(isset($_GET["ordenadopor"])) //Se estava ordenado
									{
										$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão cancelar:
														   "{" .
														       "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar a avaria pois o que quer-se é cancelar e não editar
															   "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado e com o que estava ordenado
														   "});";
									}
									else //Se não
									{
										$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão cancelar:
														   "{" .
															   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar a avaria pois o que quer-se é cancelar e não editar
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
															   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar a avaria pois o que quer-se é cancelar e não editar
															   "location.href='?ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava ordenado
														   "});";
									}
									else //Se não
									{
										$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão cancelar:
														   "{" .
															   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar a avaria pois o que quer-se é cancelar e não editar
															   "location.href='ConsultarAvarias.php';" . //Manda de volta para a página que estava
														   "});";
									}
								}
								
								$consultar_equipamento=mysqli_query($conexao, "SELECT * FROM equipamentos ORDER BY serial_number;"); //Vai buscar os equipamentos
								if($consultar_equipamento) //Se não ocorreu nenhum erro:
								{
									$linhas_equipamento=mysqli_num_rows($consultar_equipamento); //Obtém o número de equipamentos com esse id
									if($linhas_equipamento>0) //Se retornar mais que uma linha, significa que existe pelo menos um equipamento então:
									{
										$consultar_utilizador=mysqli_query($conexao, "SELECT * FROM utilizadores ORDER BY nome_utilizador;"); //Vai buscar os utilizadores
										if($consultar_utilizador) //Se não ocorreu nenhum erro:
										{
											$linhas_utilizador=mysqli_num_rows($consultar_utilizador); //Obtém o número de utilizadores com esse id
											if($linhas_utilizador>0) //Se retornar mais que uma linha, significa que existe pelo menos um utilizador então:
											{
												if($dados_avaria["estado"]=="S") //Se o equipamento está arranjado então:
												{
													$titulo_arranjado="'<th class=\'campotabela\'>Data de conserto</th>' +"; //Adiciona a opção de editar a data de conserto
													$titulo_arranjado.="'<th class=\'campotabela\'>Técnico que consertou</th>' +"; //Adiciona a opção de editar o técnico que a consertou
													$titulo_arranjado.="'<th class=\'campotabela\'>Cargo do técnico</th>' +"; //Adiciona a opção de editar o cargo do técnico que consertou
													$codigo_arranjado="'<td class=\'campotabela\'><input type=\'Date\' name=\'data_conserto\' class=\'dadotabela\' id=\'data_conserto\' value=\'" . $dados_avaria["data_conserto"] . "\' style=\'width: 150px;\'></td>' +"; //Caixa de texto da data de conserto para puder editá-lo
													$codigo_arranjado.="'<td class=\'campotabela\'><input type=\'Text\' name=\'nome_tecnico\' class=\'dadotabela\' id=\'nome_tecnico\' maxlength=\'120\' value=\'" . $dados_avaria["nome_tecnico"] . "\' style=\'width: 150px;\'></td>' +"; //Caixa de texto do nome do técnico para puder editá-lo
													$codigo_arranjado.="'<td class=\'campotabela\'><input type=\'Text\' name=\'cargo_tecnico\' class=\'dadotabela\' id=\'cargo_tecnico\' maxlength=\'120\' value=\'" . $dados_avaria["cargo_tecnico"] . "\' style=\'width: 150px;\'></td>' +"; //Caixa de texto do cargo do técnico para puder editá-lo
													$tamanho_tabela="1850"; //Ajusta o comprimento da tabela conforme os campos da tabela
												}
												else //Se não:
												{
													$titulo_arranjado=""; //Remove a opção de editar a data de conserto e o técnico que consertou e a data de conserto porque não dá para editar algo que não há e um equipamento não tem data de conserto e técnico que consertou e o cargo do técnico se ele nem arranjado está
													$codigo_arranjado=""; //Remove o código de editar a data de conserto e o técnico que consertou e a data de conserto porque não dá para editar algo que não há e um equipamento não tem data de conserto e técnico que consertou e o cargo do técnico se ele nem arranjado está
													$tamanho_tabela="1300";//Ajusta o comprimento da tabela conforme os campos da tabela
												}
												
												$selectequipamento="<select name=\'idequipamento\' class=\'dadotabela\' id=\'idequipamento\' title=\'Preselecionado: " . $dados_avaria["serial_number"] . "\' style=\'width: 150px;\'>"; //A variável select vai receber o código HTML do select
												
												for($i=0; $i<$linhas_equipamento; $i++) /* Vai repetir o número de equipamentos, por exemplo, se houver 10 equipamentos vai repetir 10 vezes */
												{
													$dados_equipamento=mysqli_fetch_array($consultar_equipamento); //Vai buscar os dados dos equipamentos
													$selectequipamento.="<option value=\'" . $dados_equipamento["idequipamento"] . "\'>" . $dados_equipamento["serial_number"] . "</option>"; //Aqui repete as opções até ser todos os números de série dos equipamentos existentes
												}
												
												$selectequipamento.="</select>";
												
												$selectutilizador="<select name=\'idutilizador\' class=\'dadotabela\' id=\'idutilizador\' title=\'Preselecionado: " . $dados_avaria["nome_utilizador"] . "\' style=\'width: 150px;\'>"; //A variável select vai receber o código HTML do select
												
												for($i=0; $i<$linhas_utilizador; $i++) /* Vai repetir o número de utilizadores, por exemplo, se houver 10 utilizador vai repetir 10 vezes */
												{
													$dados_utilizador=mysqli_fetch_array($consultar_utilizador); //Vai buscar os dados dos utilizadores
													$selectutilizador.="<option value=\'" . $dados_utilizador["idutilizador"] . "\'>" . $dados_utilizador["nome_utilizador"] . "</option>"; //Aqui repete as opções até ser todos os nomes dos utilizadores existentes
												}
												
												$selectutilizador.="</select>";
												
												echo "<script>" .
														 "window.addEventListener('load', function()" .
														 "{" .
															 "document.getElementById('zonaconsultar').innerHTML='' +" . //A zona consultar vai receber o formulário para editar
																												"'<div class=\'zonatabela\' id=\'zonatabela\'>' +" . //Início da zona da tabela
																													"'<form name=\'frmEditar\' action=\'#\' method=\'POST\'>' +" . //Início do formulário para editar
																														"'<table class=\'tabela\' style=\'width: " . $tamanho_tabela . "px;\'>' +" . //Início da tabela
																															"'<thead>' +" . //Início da zona dos cabeçalhos com os títulos das colunas
																																"'<tr>' +" . //Início da linha da tabela
																																	"'<th class=\'campotabela\'>Id</th>' +" . //Título dos Ids
																																	"'<th class=\'campotabela\'>Descrição</th>' +" . //Título das descrições
																																	"'<th class=\'campotabela\'>Número de série<br>do equipamento</th>' +" . //Título dos números de série dos equipamentos
																																	"'<th class=\'campotabela\'>Data de avaria</th>' +" . //Título das datas de avaria
																																	$titulo_arranjado . //Título das datas de conserto, dos técnicos que consertaram a avaria e dos seus respetivos cargos
																																	"'<th class=\'campotabela\'>Utilizador que reportou a avaria</th>' +" . //Título dos utilizadores que reportaram a avaria
																																	"'<th class=\'campotabela\'></th>' +" . //Nesta coluna conterá o botão para editar
																																	"'<th class=\'campoultimo\'></th>' +" . //Nesta coluna conterá o botão para eliminar e possui a classe campoultimo porque as medidas são maiores para ficar alinhado com a barra de rolagem
																																"'</tr>' +" . //Fim da linha da tabela
																															"'</thead>' +" . //Fim da zona dos cabeçalhos com os títulos das colunas
																															"'<tbody>' +" . //Início da zona dos dados da tabela
																																"'<tr>' +" . //Início da linha da tabela
																																	"'<td class=\'campotabela\'>' +" .
																																		"'<label name=\'idavariamostrado\'>" . $dados_avaria["idavaria"] . "</label>' +" . //Aqui conterá o id da avaria visível porém não permite passar via formulário sendo necessário criar a caixa de texto a baixo para puder passar via formulário
																																		"'<input type=\'Text\' name=\'idavariaescondidoalterar\' class=\'dadotabela\' id=\'idavariaescondidoalterar\' value=\'" . $dados_avaria["idavaria"] . "\' style=\'display: none;\'>' +" . //Aqui conterá o id da avaria numa caixa de texto para puder mandar via formulário para depois puder fazer a verificação se o id da avaria existe para verificar se mandei editar
																																	"'</td>' +" .
																																	"'<td class=\'campotabela\'><textarea name=\'descricao\' class=\'dadotabela\' id=\'descricao\' maxlength=\'1000\' style=\'width: 150px; height: 150px; resize: None;\'>" . $dados_avaria["descricao"] . "</textarea>' +" . //Caixa de texto da descrição para puder editá-lo
																																	"'<td class=\'campotabela\'>" . $selectequipamento . "</td>' +" . //Caixa de seleção do equipamento para puder editá-lo
																																	"'<td class=\'campotabela\'><input type=\'Date\' name=\'data_avaria\' class=\'dadotabela\' id=\'data_avaria\' value=\'" . $dados_avaria["data_avaria"] . "\' style=\'width: 150px;\'></td>' +" . //Caixa de texto da data de avaria para puder editá-lo
																																	$codigo_arranjado . //Caixas de texto para editar a data de conserto, os técnicos que consertaram as avarias e os seus respetivos cargos
																																	"'<td class=\'campotabela\'>" . $selectutilizador . "</td>' +" . //Caixa de seleção dos utilizadores para puder editá-lo
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
																												"'</div>';" . //Fim da zona da tabela
															 
															 $codigobtncancelar . //Executa o código do botão cancelar
														 "});" .
													 "</script>";
													 
												echo "<script>" .
														 "window.addEventListener('load', function()" .
														 "{" .
															 "document.getElementById('idequipamento').value='" . $dados_avaria["idequipamento"] . "';" . //A caixa de seleção do número de série do equipamento fica com o que já estava selecionado
															 "document.getElementById('idutilizador').value='" . $dados_avaria["idutilizador"] . "';" . //A caixa de seleção do utilizador que reportou a avaria fica com o que já estava selecionado
														 "});" .
													 "</script>";
											 
											}
											elseif($linhas_utilizador==0) //Se as linhas são 0 significa que não existe ninguém com esse id então:
												{
													header("Location: ?mensagem=O_Id_que_digitou_nao_existe"); //Manda de volta para a página e aparece uma mensagem a dizer que o id que digitou não existe
												}
												elseif($linhas_utilizador<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
													{
														$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
														header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
													}
										}
										else //Se não significa que ocorreu um erro ou na base de dados ou o id que passou é inválido e contém catactéres além de números:
										{
											$_SESSION["mensagemerro"]="Erro ao consultar os utilizadores, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
									}
									elseif($linhas_equipamento==0) //Se as linhas são 0 significa que não existe ninguém com esse id então:
										{
											header("Location: ?mensagem=O_Id_que_digitou_nao_existe"); //Manda de volta para a página e aparece uma mensagem a dizer que o id que digitou não existe
										}
										elseif($linhas_equipamento<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
											{
												$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
												header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
											}
								}
								else //Se não significa que ocorreu um erro ou na base de dados ou o id que passou é inválido e contém catactéres além de números:
								{
									$_SESSION["mensagemerro"]="Erro ao consultar os equipamentos, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
							elseif($linhas_avaria==0) //Se as linhas são 0 significa que não existe ninguém com esse id então:
								{
									header("Location: ?mensagem=O_Id_que_digitou_nao_existe"); //Manda de volta para a página e aparece uma mensagem a dizer que o id que digitou não existe
								}
								elseif($linhas_avaria<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
									{
										$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
										header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
									}
						}
						else //Se não significa que ocorreu um erro ou na base de dados ou o id que passou é inválido e contém catactéres além de números:
						{
							if(!$idinvalido) //Se o id não é inválido então significa que houve algum erro na base de dados então:
							{
								$_SESSION["mensagemerro"]="Erro ao consultar as avarias, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
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
					if(!(isset($_POST["idavariaescondidoeliminar"]))) //Se ainda não confirmei que quero eliminar:
					{
						if(isset($_GET["id"])) //Verifico se o id foi passado para não gerar erros
						{
							if(isset($_SESSION["vista"])) //Se a variável sessão existe então:
							{
								if($_SESSION["vista"]=="E") //Se a vista é de estagiário:
								{
									header("Location: ConsultarAvarias.php"); //Recarrega a página e bloqueia a pesmissão para puder editar dados
								}
							}
							else //Se não:
							{
								if($_SESSION["tipo_utilizador"]=="E") //Se o utilizador é um estagiário então:
								{
									header("Location: ConsultarAvarias.php"); //Recarrega a página e bloqueia a pesmissão para puder editar dados
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
								header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
							
							$consultar_avaria=mysqli_query($conexao, "SELECT * FROM avarias WHERE idavaria=" . $_GET["id"] . ";"); //Vai buscar a avaria que quero eliminar
							if($consultar_avaria) //Se não ocorreu nenhum erro:
							{
								$linhas_avaria=mysqli_num_rows($consultar_avaria); //Obtém o número de avarias com esse id
								if($linhas_avaria>0) //Se retornar mais que uma linha, significa que existe pelo menos uma sala então:
								{
									if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se estava uma pesquisa específica
									{
										if(isset($_GET["ordenadopor"])) //Se estava ordenado
										{
											$codigobtnnao="document.getElementById('btnnao').addEventListener('click', function(e)" . //Quando clicar no botão não:
														  "{" .
														      "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar a avaria pois o que quer-se é cancelar e não eliminar
															  "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado e com o que estava ordenado
														  "});";
										}
										else //Se não
										{
											$codigobtnnao="document.getElementById('btnnao').addEventListener('click', function(e)" . //Quando clicar no botão não:
														  "{" .
															  "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar a avaria pois o que quer-se é cancelar e não eliminar
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
														      "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar a avaria pois o que quer-se é cancelar e não eliminar
															  "location.href='?ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava ordenado
														  "});";
										}
										else //Se não
										{
											$codigobtnnao="document.getElementById('btnnao').addEventListener('click', function(e)" . //Quando clicar no botão não:
														  "{" .
															  "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar a avaria pois o que quer-se é cancelar e não eliminar
															  "location.href='ConsultarAvarias.php';" . //Manda de volta para a página que estava
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
																	"'<input type=\'Text\' name=\'idavariaescondidoeliminar\' class=\'dadotabela\' id=\'idavariaescondidoeliminar\' value=\'" . $_GET["id"] . "\' style=\'display: none;\'>' +" . //Mete o id da avaria escondido para depois poder verificar se mandei mesmo eliminar
																	"'<input type=\'Submit\' name=\'btnsimescondido\' id=\'btnsimescondido\' style=\'display: None;\'>' +" . //Botão do formulário escondido porque haverá outro visível com um visual melhor para mandar eliminar a avaria
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
								elseif($linhas_avaria==0) //Se não se as linhas são 0, significa que não existe ninguém com esse id então:
									{
										header("Location: ?mensagem=O_Id_que_digitou_nao_existe"); //Recarrega a página passando uma mensagem a dizer que o id que digitou não existe
									}
									elseif($linhas_avaria<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
										{
											$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
							}
							else //Se não significa que houve um erro ou na base de dados ou o id é inválido:
							{
								if(!$idinvalido) //Se o id não é inválido então:
								{
									$_SESSION["mensagemerro"]="Erro ao consultar as avarias, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
								else //Se não:
								{
									header("Location: ?mensagem=O_id_so_pode_conter_numeros"); //Recarrega a página e passa a mensagem de erro que o id é inválido
								}
							}
						}
					}
				}
				
				if($_GET["acao"]=="consertar") //Se cliquei no botão para consertar então:
				{
					if(!(isset($_POST["idavariaescondidoconsertar"]))) //Se ainda não confirmei que quero consertar:
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
								header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
							
							$consultar_avaria=mysqli_query($conexao, "SELECT * FROM avarias WHERE idavaria=" . $_GET["id"] . ";"); //Vai buscar a avaria que quero consertar
							if($consultar_avaria) //Se não ocorreu nenhum erro:
							{
								$linhas_avaria=mysqli_num_rows($consultar_avaria); //Obtém o número de avarias com esse id
								if($linhas_avaria>0) //Se retornar mais que uma linha, significa que existe pelo menos uma avaria então:
								{
									$dados_avaria=mysqli_fetch_array($consultar_avaria); //Vai buscar os dados da avaria
									
									if($dados_avaria["estado"]=="S") //Se o equipamento já está consertado então:
									{
										header("Location: ?mensagem=O_id_ja_esta_consertado"); //Recarrega a página e passa a mensagem de erro que o id já está consertado e não se pode consertar algo que já está consertado
									}
									
									if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se estava uma pesquisa específica
									{
										if(isset($_GET["ordenadopor"])) //Se estava ordenado
										{
											$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
															   "{" .
																   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
																   "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado e com o que estava ordenado
															   "});";
										}
										else //Se não
										{
											$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
															   "{" .
																   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
																   "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado
															   "});";
										}
									}
									else //Se não:
									{
										if(isset($_GET["ordenadopor"])) //Se estava ordenado
										{
											$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
															   "{" .
																   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
																   "location.href='?ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava ordenado
															   "});";
										}
										else //Se não
										{
											$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
															   "{" .
																   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
																   "location.href='ConsultarAvarias.php';" . //Manda de volta para a página que estava
															   "});";
										}
									}
									
									echo "<script>" .
											 "window.addEventListener('load', function()" .
											 "{" .
												 "document.getElementById('zonabtnmodal').innerHTML='<br><button class=\'btnmetade\' id=\'btncancelar\'>Cancelar</button> <button class=\'btnmetade\' id=\'btncontinuarmostrado\'>Continuar</button>';" .
									 
												 "document.getElementById('btncancelar').style.backgroundColor='#E63946';" .
												 
												 "document.getElementById('btncancelar').addEventListener('mouseover', function()" .
												 "{" .
													 "document.getElementById('btncancelar').style.backgroundColor='#DD3C48';" .
												 "});" .
												 
												 "document.getElementById('btncancelar').addEventListener('mouseout', function()" .
												 "{" .
													 "document.getElementById('btncancelar').style.backgroundColor='#E63946';" .
												 "});" .
												 
												 "document.getElementById('btncontinuarmostrado').style.backgroundColor='#E63946';" .
												 
												 "document.getElementById('btncontinuarmostrado').addEventListener('mouseover', function()" .
												 "{" .
													 "document.getElementById('btncontinuarmostrado').style.backgroundColor='#DD3C48';" .
												 "});" .
												 
												 "document.getElementById('btncontinuarmostrado').addEventListener('mouseout', function()" .
												 "{" .
													 "document.getElementById('btncontinuarmostrado').style.backgroundColor='#E63946';" .
												 "});" .
												 
												 "Modal('avaria', '' +" .
															   "'<form name=\'frmConsertar\' action=\'#\' method=\'POST\'>' +" .
																   "'<input type=\'Text\' name=\'idavariaescondidoconsertar\' class=\'dadotabela\' id=\'idavariaescondidoconsertar\' value=\'" . $_GET["id"] . "\' style=\'display: none;\'>' +" . //Mete o id da avaria escondido para depois poder verificar se mandei mesmo consertar
																   "'<input type=\'Text\' name=\'nome_tecnico\' class=\'caixatextomodal\' id=\'nome_tecnico\' placeholder=\'Introduza a nome do técnico\' title=\'Nome do técnico\' maxlength=\'120\' required>' +" .
																   "'<br>' +" .
																   "'<input type=\'Text\' name=\'cargo_tecnico\' class=\'caixatextomodal\' id=\'cargo_tecnico\' placeholder=\'Introduza o cargo do técnico\' title=\'Cargo do técnico\' maxlength=\'120\' required>' +" .
																   "'<br>' +" .
																   "'<input type=\'Submit\' name=\'btncontinuarescondido\' id=\'btncontinuarescondido\' style=\'display: None;\'>' +" .
															   "'</form>'" .
												 ");" .
												 
												 $codigobtncancelar .
												 
												 "document.getElementById('btncontinuarmostrado').addEventListener('click', function()" .
												 "{" .
													 "document.getElementById('btncontinuarescondido').click();" .
												 "});" .
											 "});" .
										 "</script>";
								}
								elseif($linhas_avaria==0) //Se não se as linhas são 0, significa que não existe ninguém com esse id então:
									{
										header("Location: ?mensagem=O_Id_que_digitou_nao_existe"); //Recarrega a página passando uma mensagem a dizer que o id que digitou não existe
									}
									elseif($linhas_avaria<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
										{
											$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
							}
							else //Se não significa que houve um erro ou na base de dados ou o id é inválido:
							{
								if(!$idinvalido) //Se o id não é inválido então:
								{
									$_SESSION["mensagemerro"]="Erro ao consultar as avarias, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
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
			
			if(isset($_POST["idavariaescondidoalterar"])) //Se mandei alterar os dados e já confirmei então:
			{
				//Retira os espaços em branco (trim) de trás e da frente, por exemplo, "          Dado          " passa para "Dado"
				$idavaria=trim($_GET["id"]); //Esta variável é enviada por via GET em vez de ser enviada por via POST por proteção de dados e para evitar erros
				$descricao=trim($_POST["descricao"]);
				$data_avaria=trim($_POST["data_avaria"]);
				$idequipamento=trim($_POST["idequipamento"]);
				$idutilizador=trim($_POST["idutilizador"]);
				
				if(isset($_POST["data_conserto"])) //Se a data de conserto existe, significa que o nome do técnico e o cargo do técnico existem então:
				{
					$data_conserto=$_POST["data_conserto"];
					$nome_tecnico=$_POST["nome_tecnico"];
					$cargo_tecnico=$_POST["cargo_tecnico"];
					
					include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
					
					$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
					if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
					{
						$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
					
					$consultar_avaria=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, avarias a, tecnicos t, utilizadores u WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idequipamento=a.idequipamento AND a.idtecnico=t.idtecnico AND a.idutilizador=u.idutilizador AND a.idavaria=" . $idavaria . ";"); //Vai buscar o técnico da avaria que quero editar
					if($consultar_avaria) //Se não ocorreu nenhum erro:
					{
						$linhas_avaria=mysqli_num_rows($consultar_avaria); //Obtém o número de avarias com esse id
						if($linhas_avaria>0) //Se retornar mais que uma linha, significa que existe pelo menos uma avaria então:
						{
							$dados_avaria=mysqli_fetch_array($consultar_avaria); //Vai buscar os dados da avaria que quero editar
							$idtecnico=$dados_avaria["idtecnico"];
						}
						elseif($linhas_avaria==0) //Se as linhas são 0 significa que não existe ninguém com esse id então:
							{
								$_SESSION["mensagemerro"]="Erro a procurar o id da avaria, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
							elseif($linhas_avaria<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
								{
									$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
					}
					else //Se não significa que ocorreu um erro ou na base de dados ou o id que passou é inválido e contém catactéres além de números:
					{
						$_SESSION["mensagemerro"]="Erro ao consultar as avarias, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
				
				//Mete as variáveis a falso
				$erro=false;
				
				if(isset($data_conserto)) //Se a data de conserto existe então:
				{
					//Nota: Isto é uma função, significa que o código só é executado quando eu chamar a função
					echo "<script>" .
							 //Cria uma função de Validação cujo os parâmetros serão o campo com erro e a mensagem de erro com o objetivo se simplificar e minimizar o código
							 "function Validacao(campo, mensagem)" .
							 "{" .
								 "document.getElementById('descricao').value='" . $descricao . "';" . //A caixa de texto da descrição volta a ter o que estava lá escrito
								 "document.getElementById('data_avaria').value='" . $data_avaria . "';" . //A caixa de texto da data de avaria volta a ter o que estava lá escrito
								 "document.getElementById('idequipamento').value='" . $idequipamento . "';" . //A caixa de seleção do id do equipamento volta a ter o que estava lá selecionado
								 "document.getElementById('idutilizador').value='" . $idutilizador . "';" . //A caixa de seleção do id do utilizador volta a ter o que estava lá selecionado
								 "document.getElementById('data_conserto').value='" . $data_conserto . "';" . //A caixa de texto da data de conserto volta a ter o que estava lá escrito
								 "document.getElementById('nome_tecnico').value='" . $nome_tecnico . "';" . //A caixa de texto do nome do técnico volta a ter o que estava lá escrito
								 "document.getElementById('cargo_tecnico').value='" . $cargo_tecnico . "';" . //A caixa de texto do cargo do técnico volta a ter o que estava lá escrito
								 
								 "document.getElementById('erro').innerHTML+=mensagem + '<br><br>';" . //A zona de erro recebe a mensagem de erro
								 "document.getElementById(campo).style.borderColor='red';" . //As bordas das caixas com erro ficam a vermelho
							 "}" .
						 "</script>";
				}
				else //Se não:
				{
					//Nota: Isto é uma função, significa que o código só é executado quando eu chamar a função
					echo "<script>" .
							 //Cria uma função de Validação cujo os parâmetros serão o campo com erro e a mensagem de erro com o objetivo se simplificar e minimizar o código
							 "function Validacao(campo, mensagem)" .
							 "{" .
								 "document.getElementById('descricao').value='" . $descricao . "';" . //A caixa de texto da descrição volta a ter o que estava lá escrito
								 "document.getElementById('data_avaria').value='" . $data_avaria . "';" . //A caixa de texto da data de avaria volta a ter o que estava lá escrito
								 "document.getElementById('idequipamento').value='" . $idequipamento . "';" . //A caixa de seleção do id do equipamento volta a ter o que estava lá selecionado
								 "document.getElementById('idutilizador').value='" . $idutilizador . "';" . //A caixa de seleção do id do utilizador volta a ter o que estava lá selecionado
								 
								 "document.getElementById('erro').innerHTML+=mensagem + '<br><br>';" . //A zona de erro recebe a mensagem de erro
								 "document.getElementById(campo).style.borderColor='red';" . //As bordas das caixas com erro ficam a vermelho
							 "}" .
						 "</script>";
				}
				
				if($descricao=="") //Se a descrição está vazia vai aparecer uma mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('descricao', 'A descrição da avaria não foi preenchida.');" . //Usa a função acima que criei indicando o campo com erro (descricao) e a mensagem de erro (A descrição da avaria não foi preenchida)
							 "});" .
						 "</script>";
					
					$erro=true; //A variável que indica o erro fica verdadeiro
				}
				
				if(isset($_POST["data_conserto"])) //Se a data de conserto existe, significa que o nome do técnico e o cargo do técnico existem então:
				{
					if($nome_tecnico=="") //Se o nome do técnico está vazio vai aparecer uma mensagem de erro:
					{
						echo "<script>" .
								 "window.addEventListener('load', function()" .
								 "{" .
									 "Validacao('nome_tecnico', 'O nome do técnico não foi preenchido.');" . //Usa a função acima que criei indicando o campo com erro (nome_tecnico) e a mensagem de erro (O nome do técnico não foi preenchido)
								 "});" .
							 "</script>";
						
						$erro=true; //A variável que indica o erro fica verdadeiro
					}
					
					if($cargo_tecnico=="") //Se o cargo do técnico está vazio vai aparecer uma mensagem de erro:
					{
						echo "<script>" .
								 "window.addEventListener('load', function()" .
								 "{" .
									 "Validacao('cargo_tecnico', 'O cargo do técnico não foi preenchido.');" . //Usa a função acima que criei indicando o campo com erro (cargo_tecnico) e a mensagem de erro (O cargo do técnico não foi preenchido)
								 "});" .
							 "</script>";
						
						$erro=true; //A variável que indica o erro fica verdadeiro
					}
				}
				
				if(!$erro) //Se não houve nenhum erro nos campos anteriores então:
				{
					include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
					
					$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
					if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
					{
						$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
					
					$editar_descricao=mysqli_query($conexao, "UPDATE avarias SET descricao='" . $descricao . "' WHERE idavaria=" . $idavaria . ";"); //Edita o campo descricao
					if($editar_descricao) //Se não ocorreu nenhum erro:
					{
						$editar_data_avaria=mysqli_query($conexao, "UPDATE avarias SET data_avaria='" . $data_avaria . "' WHERE idavaria=" . $idavaria . ";"); //Edita o campo data de avaria
						if($editar_data_avaria) //Se não ocorreu nenhum erro:
						{
							$editar_equipamento=mysqli_query($conexao, "UPDATE avarias SET idequipamento='" . $idequipamento . "' WHERE idavaria=" . $idavaria . ";"); //Edita o campo id do equipamento
							if($editar_equipamento) //Se não ocorreu nenhum erro:
							{
								$editar_utilizador=mysqli_query($conexao, "UPDATE avarias SET idutilizador='" . $idutilizador . "' WHERE idavaria=" . $idavaria . ";"); //Edita o campo id do utilizador
								if($editar_utilizador) //Se não ocorreu nenhum erro:
								{
									if(isset($data_conserto)) //Se a data de conserto existe então:
									{
										$editar_data_conserto=mysqli_query($conexao, "UPDATE avarias SET data_conserto='" . $data_conserto . "' WHERE idavaria=" . $idavaria . ";"); //Edita o campo data de conserto
										if($editar_data_conserto) //Se não ocorreu nenhum erro:
										{
											$editar_nome_tecnico=mysqli_query($conexao, "UPDATE tecnicos SET nome_tecnico='" . $nome_tecnico . "' WHERE idtecnico=" . $idtecnico . ";"); //Edita o campo nome do técnico
											if($editar_nome_tecnico) //Se não ocorreu nenhum erro:
											{
												$editar_cargo_tecnico=mysqli_query($conexao, "UPDATE tecnicos SET cargo_tecnico='" . $cargo_tecnico . "' WHERE idtecnico=" . $idtecnico . ";"); //Edita o campo cargo do técnico
												if($editar_cargo_tecnico) //Se não ocorreu nenhum erro:
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
													$_SESSION["mensagemerro"]="Erro ao alterar o cargo do técnico, por favor informe o administrador."; //Passa a mensagem de erro
													header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
												}
											}
											else //Se não:
											{
												$_SESSION["mensagemerro"]="Erro ao alterar o nome do técnico avariado, por favor informe o administrador."; //Passa a mensagem de erro
												header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
											}
										}
										else //Se não:
										{
											$_SESSION["mensagemerro"]="Erro ao alterar a data de conserto, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
									}
									else
									{
										$_SESSION["editado_eliminado"]=true; //A variável editado_eliminado fica verdadeiro para assim não fazer a verificação para recarregar a página e não houver erro de duplicação de dados
										
										echo "<script>" .
												 "window.addEventListener('load', function()" .
												 "{" .
													 "Modal('certo', 'Alterações efetuadas com sucesso.');" . //Abre o modal de certo para informar ao utilizador que foi alterado com sucesso
												 "});" .
											 "</script>";
									}
								}
								else //Se não:
								{
									$_SESSION["mensagemerro"]="Erro ao alterar o utilizador que reportou a avaria, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
							else //Se não:
							{
								$_SESSION["mensagemerro"]="Erro ao alterar o equipamento avariado, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
						else //Se não:
						{
							$_SESSION["mensagemerro"]="Erro ao alterar a data de avaria, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
					}
					else //Se não:
					{
						$_SESSION["mensagemerro"]="Erro ao alterar a descrição da avaria, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
			}
			
			if(isset($_POST["idavariaescondidoeliminar"])) //Se mandei eliminar e selecionei a opção sim então:
			{
				$idavaria=$_GET["id"]; //Recebe o id da avaria que quero eliminar
				
				include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
					
				$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
				if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
				{
					$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
				
				$consultar_avaria=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, avarias a, tecnicos t, utilizadores u WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idequipamento=a.idequipamento AND a.idtecnico=t.idtecnico AND a.idutilizador=u.idutilizador AND a.idavaria=" . $idavaria . ";"); //Vai buscar o técnico da avaria que quero editar
				if($consultar_avaria) //Se não ocorreu nenhum erro:
				{
					$linhas_avaria=mysqli_num_rows($consultar_avaria); //Obtém o número de avarias com esse id
					if($linhas_avaria>0) //Se retornar mais que uma linha, significa que existe pelo menos uma avaria então:
					{
						$dados_avaria=mysqli_fetch_array($consultar_avaria); //Vai buscar os dados da avaria que quero editar
						
						if($dados_avaria["estado"]=="S") //Se a avaria está arranjada então:
						{
							$idtecnico=$dados_avaria["idtecnico"]; //Vai buscar o id do técnico que a consertou
						}
					}
					elseif($linhas_avaria==0) //Se as linhas são 0 significa que não existe ninguém com esse id então:
						{
							$_SESSION["mensagemerro"]="Erro a procurar o id da avaria, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
						elseif($linhas_avaria<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
							{
								$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
				}
				else //Se não significa que ocorreu um erro ou na base de dados ou o id que passou é inválido e contém catactéres além de números:
				{
					$_SESSION["mensagemerro"]="Erro ao consultar as avarias, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
				
				$eliminar_avaria=mysqli_query($conexao, "DELETE FROM avarias WHERE idavaria=" . $idavaria . ";"); //Elimina a avaria
				if($eliminar_avaria) //Se a avaria foi eliminado com sucesso
				{
					if(isset($idtecnico))
					{
						$eliminar_tecnico=mysqli_query($conexao, "DELETE FROM tecnicos WHERE idtecnico=" . $idtecnico . ";"); //Elimina o técnico que consertou a avaria
						if($eliminar_tecnico) //Se a avaria foi eliminado com sucesso
						{
							$_SESSION["editado_eliminado"]=true; //A variável editado_eliminado fica verdadeiro para assim não fazer a verificação para recarregar a página e não houver erro de duplicação de dados
							
							echo "<script>" .
									 "window.addEventListener('load', function()" .
									 "{" .
										 "Modal('certo', 'Avaria eliminada com sucesso.');" . //Abre o modal de certo para informar ao utilizador que foi eliminada com sucesso
									 "});" .
								 "</script>";
						}
						else //Se não:
						{
							$_SESSION["mensagemerro"]="Erro ao eliminar o técnico que consertou a avaria, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
					}
					else
					{
						$_SESSION["editado_eliminado"]=true; //A variável editado_eliminado fica verdadeiro para assim não fazer a verificação para recarregar a página e não houver erro de duplicação de dados
							
						echo "<script>" .
								 "window.addEventListener('load', function()" .
								 "{" .
									 "Modal('certo', 'Avaria eliminada com sucesso.');" . //Abre o modal de certo para informar ao utilizador que foi eliminada com sucesso
								 "});" .
							 "</script>";
					}
				}
				else //Se não:
				{
					$_SESSION["mensagemerro"]="Erro ao eliminar a avaria, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
			}
			
			if(isset($_POST["idavariaescondidoconsertar"])) //Se mandei consertar então:
			{
				//Retira os espaços em branco (trim) de trás e da frente, por exemplo, "          Dado          " passa para "Dado"
				$idavaria=$_GET["id"];
				$nome_tecnico=trim($_POST["nome_tecnico"]);
				$cargo_tecnico=trim($_POST["cargo_tecnico"]);
				
				$erro=false; //Variável que deteta se há algum erro
				
				if(($nome_tecnico=="") AND ($cargo_tecnico=="")) //Se o nome do técnico e o cargo do técnico estão vazios então:
				{
					echo "<script>console.log('Teste1');</script>";
					//Volta a escrever o modal de introduzir o técnico outra vez passando a mensagem de erro:
					if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se estava uma pesquisa específica
					{
						if(isset($_GET["ordenadopor"])) //Se estava ordenado
						{
							$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
											   "{" .
												   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
												   "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado e com o que estava ordenado
											   "});";
						}
						else //Se não
						{
							$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
											   "{" .
												   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
												   "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado
											   "});";
						}
					}
					else //Se não:
					{
						if(isset($_GET["ordenadopor"])) //Se estava ordenado
						{
							$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
											   "{" .
												   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
												   "location.href='?ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava ordenado
											   "});";
						}
						else //Se não
						{
							$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
											   "{" .
												   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
												   "location.href='ConsultarAvarias.php';" . //Manda de volta para a página que estava
											   "});";
						}
					}
					
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "document.getElementById('zonabtnmodal').innerHTML='<br><button class=\'btnmetade\' id=\'btncancelar\'>Cancelar</button> <button class=\'btnmetade\' id=\'btncontinuarmostrado\'>Continuar</button>';" .
					 
								 "document.getElementById('btncancelar').style.backgroundColor='#E63946';" .
								 
								 "document.getElementById('btncancelar').addEventListener('mouseover', function()" .
								 "{" .
									 "document.getElementById('btncancelar').style.backgroundColor='#DD3C48';" .
								 "});" .
								 
								 "document.getElementById('btncancelar').addEventListener('mouseout', function()" .
								 "{" .
									 "document.getElementById('btncancelar').style.backgroundColor='#E63946';" .
								 "});" .
								 
								 "document.getElementById('btncontinuarmostrado').style.backgroundColor='#E63946';" .
								 
								 "document.getElementById('btncontinuarmostrado').addEventListener('mouseover', function()" .
								 "{" .
									 "document.getElementById('btncontinuarmostrado').style.backgroundColor='#DD3C48';" .
								 "});" .
								 
								 "document.getElementById('btncontinuarmostrado').addEventListener('mouseout', function()" .
								 "{" .
									 "document.getElementById('btncontinuarmostrado').style.backgroundColor='#E63946';" .
								 "});" .
								 
								 "Modal('avaria', '' +" .
											     "'<form name=\'frmConsertar\' action=\'#\' method=\'POST\'>' +" .
												     "'<input type=\'Text\' name=\'idavariaescondidoconsertar\' class=\'dadotabela\' id=\'idavariaescondidoconsertar\' value=\'" . $_GET["id"] . "\' style=\'display: none;\'>' +" .
													 //A borda da caixa de texto fica vermelha com o border-color: Red; para destacar melhor o campo com erro
												     "'<input type=\'Text\' name=\'nome_tecnico\' class=\'caixatextomodal\' id=\'nome_tecnico\' placeholder=\'Introduza a nome do técnico\' title=\'Nome do técnico\' maxlength=\'120\' style=\'border-color: Red;\' required>' +" .
												     "'<br>' +" .
												     "'<label id=\'erro\' style=\'color: Red;\'>O nome do técnico não foi preenchido.</label>' +" . //Aqui aparece a mensagem de erro que o nome do técnico não foi preenchido
												     //A borda da caixa de texto fica vermelha com o border-color: Red; para destacar melhor o campo com erro
												     "'<input type=\'Text\' name=\'cargo_tecnico\' class=\'caixatextomodal\' id=\'cargo_tecnico\' placeholder=\'Introduza o cargo do técnico\' title=\'Cargo do técnico\' maxlength=\'120\' style=\'border-color: Red;\' required>' +" .
												     "'<br>' +" .
												     "'<label id=\'erro\' style=\'color: Red;\'>O cargo do técnico não foi preenchido.</label>' +" . //Aqui aparece a mensagem de erro que o cargo do técnico não foi preenchido
												     "'<input type=\'Submit\' name=\'btncontinuarescondido\' id=\'btncontinuarescondido\' style=\'display: None;\'>' +" .
											     "'</form>'" .
								 ");" .
								 
								 "document.getElementById('nome_tecnico').value='" . $nome_tecnico . "';" . //O nome do técnico recebe o que já tinha
								 "document.getElementById('cargo_tecnico').value='" . $cargo_tecnico . "';" . //O cargo do técnico recebe o que já tinha
								 
								 $codigobtncancelar .
								 
								 "document.getElementById('modalconsultar').style.height='500px';" . //Aumento a altura do modal
								 
								 "document.getElementById('btncontinuarmostrado').addEventListener('click', function()" .
								 "{" .
									 "document.getElementById('btncontinuarescondido').click();" .
								 "});" .
							 "});" .
						 "</script>";
						 
					$erro=true; //Mete a variável erro a verdadeiro
				}
				elseif($nome_tecnico=="") //Se não se o nome do técnico está vazio então:
					{
						echo "<script>console.log('Teste2');</script>";
						//Volta a escrever o modal de introduzir o técnico outra vez passando a mensagem de erro:
						if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se estava uma pesquisa específica
						{
							if(isset($_GET["ordenadopor"])) //Se estava ordenado
							{
								$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
												   "{" .
													   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
													   "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado e com o que estava ordenado
												   "});";
							}
							else //Se não
							{
								$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
												   "{" .
													   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
													   "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado
												   "});";
							}
						}
						else //Se não:
						{
							if(isset($_GET["ordenadopor"])) //Se estava ordenado
							{
								$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
												   "{" .
													   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
													   "location.href='?ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava ordenado
												   "});";
							}
							else //Se não
							{
								$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
												   "{" .
													   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
													   "location.href='ConsultarAvarias.php';" . //Manda de volta para a página que estava
												   "});";
							}
						}
						
						echo "<script>" .
								 "window.addEventListener('load', function()" .
								 "{" .
									 "document.getElementById('zonabtnmodal').innerHTML='<br><button class=\'btnmetade\' id=\'btncancelar\'>Cancelar</button> <button class=\'btnmetade\' id=\'btncontinuarmostrado\'>Continuar</button>';" .
						 
									 "document.getElementById('btncancelar').style.backgroundColor='#E63946';" .
									 
									 "document.getElementById('btncancelar').addEventListener('mouseover', function()" .
									 "{" .
										 "document.getElementById('btncancelar').style.backgroundColor='#DD3C48';" .
									 "});" .
									 
									 "document.getElementById('btncancelar').addEventListener('mouseout', function()" .
									 "{" .
										 "document.getElementById('btncancelar').style.backgroundColor='#E63946';" .
									 "});" .
									 
									 "document.getElementById('btncontinuarmostrado').style.backgroundColor='#E63946';" .
									 
									 "document.getElementById('btncontinuarmostrado').addEventListener('mouseover', function()" .
									 "{" .
										 "document.getElementById('btncontinuarmostrado').style.backgroundColor='#DD3C48';" .
									 "});" .
									 
									 "document.getElementById('btncontinuarmostrado').addEventListener('mouseout', function()" .
									 "{" .
										 "document.getElementById('btncontinuarmostrado').style.backgroundColor='#E63946';" .
									 "});" .
									 
									 "Modal('avaria', '' +" .
													 "'<form name=\'frmConsertar\' action=\'#\' method=\'POST\'>' +" .
														 "'<input type=\'Text\' name=\'idavariaescondidoconsertar\' class=\'dadotabela\' id=\'idavariaescondidoconsertar\' value=\'" . $_GET["id"] . "\' style=\'display: none;\'>' +" .
														 //A borda da caixa de texto fica vermelha com o border-color: Red; para destacar melhor o campo com erro
														 "'<input type=\'Text\' name=\'nome_tecnico\' class=\'caixatextomodal\' id=\'nome_tecnico\' placeholder=\'Introduza a nome do técnico\' title=\'Nome do técnico\' maxlength=\'120\' style=\'border-color: Red;\' required>' +" .
														 "'<br>' +" .
														 "'<label id=\'erro\' style=\'color: Red;\'>O nome do técnico não foi preenchido.</label>' +" . //Aqui aparece a mensagem de erro que o nome do técnico não foi preenchido
														 "'<input type=\'Text\' name=\'cargo_tecnico\' class=\'caixatextomodal\' id=\'cargo_tecnico\' placeholder=\'Introduza o cargo do técnico\' title=\'Cargo do técnico\' maxlength=\'120\' required>' +" .
														 "'<br>' +" .
														 "'<input type=\'Submit\' name=\'btncontinuarescondido\' id=\'btncontinuarescondido\' style=\'display: None;\'>' +" .
													 "'</form>'" .
									 ");" .
									 
									 "document.getElementById('nome_tecnico').value='" . $nome_tecnico . "';" . //O nome do técnico recebe o que já tinha
									 "document.getElementById('cargo_tecnico').value='" . $cargo_tecnico . "';" . //O cargo do técnico recebe o que já tinha
									 
									 
									 $codigobtncancelar .
									 
									 "document.getElementById('btncontinuarmostrado').addEventListener('click', function()" .
									 "{" .
										 "document.getElementById('btncontinuarescondido').click();" .
									 "});" .
								 "});" .
							 "</script>";
							 
						$erro=true; //Mete a variável erro a verdadeiro
					}
					elseif($cargo_tecnico=="") //Se se não se o cargo do técnico está vazio então:
						{
							echo "<script>console.log('Teste3');</script>";
							
							//Volta a escrever o modal de introduzir o técnico outra vez passando a mensagem de erro:
							if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se estava uma pesquisa específica
							{
								if(isset($_GET["ordenadopor"])) //Se estava ordenado
								{
									$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
													   "{" .
														   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
														   "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado e com o que estava ordenado
													   "});";
								}
								else //Se não
								{
									$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
													   "{" .
														   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
														   "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado
													   "});";
								}
							}
							else //Se não:
							{
								if(isset($_GET["ordenadopor"])) //Se estava ordenado
								{
									$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
													   "{" .
														   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
														   "location.href='?ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava ordenado
													   "});";
								}
								else //Se não
								{
									$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão não:
													   "{" .
														   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar consertar a avaria pois o que quer-se é cancelar e não consertar
														   "location.href='ConsultarAvarias.php';" . //Manda de volta para a página que estava
													   "});";
								}
							}
							
							echo "<script>" .
									 "window.addEventListener('load', function()" .
									 "{" .
										 "document.getElementById('zonabtnmodal').innerHTML='<br><button class=\'btnmetade\' id=\'btncancelar\'>Cancelar</button> <button class=\'btnmetade\' id=\'btncontinuarmostrado\'>Continuar</button>';" .
							 
										 "document.getElementById('btncancelar').style.backgroundColor='#E63946';" .
										 
										 "document.getElementById('btncancelar').addEventListener('mouseover', function()" .
										 "{" .
											 "document.getElementById('btncancelar').style.backgroundColor='#DD3C48';" .
										 "});" .
										 
										 "document.getElementById('btncancelar').addEventListener('mouseout', function()" .
										 "{" .
											 "document.getElementById('btncancelar').style.backgroundColor='#E63946';" .
										 "});" .
										 
										 "document.getElementById('btncontinuarmostrado').style.backgroundColor='#E63946';" .
										 
										 "document.getElementById('btncontinuarmostrado').addEventListener('mouseover', function()" .
										 "{" .
											 "document.getElementById('btncontinuarmostrado').style.backgroundColor='#DD3C48';" .
										 "});" .
										 
										 "document.getElementById('btncontinuarmostrado').addEventListener('mouseout', function()" .
										 "{" .
											 "document.getElementById('btncontinuarmostrado').style.backgroundColor='#E63946';" .
										 "});" .
										 
										 "Modal('avaria', '' +" .
														 "'<form name=\'frmConsertar\' action=\'#\' method=\'POST\'>' +" .
															 "'<input type=\'Text\' name=\'idavariaescondidoconsertar\' class=\'dadotabela\' id=\'idavariaescondidoconsertar\' value=\'" . $_GET["id"] . "\' style=\'display: none;\'>' +" .
															 "'<input type=\'Text\' name=\'nome_tecnico\' class=\'caixatextomodal\' id=\'nome_tecnico\' placeholder=\'Introduza a nome do técnico\' title=\'Nome do técnico\' maxlength=\'120\' required>' +" .
															 "'<br>' +" .
															 //A borda da caixa de texto fica vermelha com o border-color: Red; para destacar melhor o campo com erro
															 "'<input type=\'Text\' name=\'cargo_tecnico\' class=\'caixatextomodal\' id=\'cargo_tecnico\' placeholder=\'Introduza o cargo do técnico\' title=\'Cargo do técnico\' maxlength=\'120\' style=\'border-color: Red;\' required>' +" .
															 "'<br>' +" .
															 "'<label id=\'erro\' style=\'color: Red;\'>O cargo do técnico não foi preenchido.</label>' +" . //Aqui aparece a mensagem de erro que o cargo do técnico não foi preenchido
															 "'<input type=\'Submit\' name=\'btncontinuarescondido\' id=\'btncontinuarescondido\' style=\'display: None;\'>' +" .
														 "'</form>'" .
										 ");" .
										 
										 "document.getElementById('nome_tecnico').value='" . $nome_tecnico . "';" . //O nome do técnico recebe o que já tinha
										 "document.getElementById('cargo_tecnico').value='" . $cargo_tecnico . "';" . //O cargo do técnico recebe o que já tinha
										  
										 
										 $codigobtncancelar .
										 
										 "document.getElementById('btncontinuarmostrado').addEventListener('click', function()" .
										 "{" .
											 "document.getElementById('btncontinuarescondido').click();" .
										 "});" .
									 "});" .
								 "</script>";
								 
							$erro=true; //Mete a variável erro a verdadeiro
						}
						
				if(!$erro) //Se não houve erro então:
				{
					include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
					
					$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
					if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
					{
						$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
					
					$editar_estado=mysqli_query($conexao, "UPDATE avarias SET estado='S' WHERE idavaria=" . $idavaria . ";"); //Mete o estado da avaria para S de sim de consertado
					if($editar_estado) //Se não ocorreu nenhum erro:
					{
						$editar_data_conserto=mysqli_query($conexao, "UPDATE avarias SET data_conserto=curdate() WHERE idavaria=" . $idavaria . ";"); //Mete a data de conserto da avaria
						if($editar_data_conserto) //Se não ocorreu nenhum erro:
						{
							$inserir_tecnico=mysqli_query($conexao, "INSERT INTO tecnicos VALUES(NULL, '" . $nome_tecnico . "', '" . $cargo_tecnico . "');"); //Insere o técnico que consertou a avaria
							if($inserir_tecnico) //Se não ocorreu nenhum erro:
							{
								$consultar_tecnico=mysqli_query($conexao, "SELECT * FROM tecnicos;"); //Vai buscar o técnico consertou a avaria
								if($consultar_tecnico) //Se não ocorreu nenhum erro:
								{
									$linhas_tecnico=mysqli_num_rows($consultar_tecnico); //Obtém o número de técnicos com esse id
									if($linhas_tecnico>1) //Se retornar mais que uma linha, significa que existe pelo menos um técnico então:
									{
										for($i=0; $i<$linhas_tecnico; $i++) //Vai repetir até obter o último id inserido
										{
											$dados_tecnico=mysqli_fetch_array($consultar_tecnico); //Vai buscar os dados do tecnico que consertou a avaria
											$idtecnico=$dados_tecnico["idtecnico"]; //Vai buscar o id do técnico que a consertou
										}
										
										$editar_idtecnico=mysqli_query($conexao, "UPDATE avarias SET idtecnico=" . $idtecnico . " WHERE idavaria=" . $idavaria . ";"); //Atualiza o id do técnico que consertou a avaria												if($editar_estado) //Se não ocorreu nenhum erro:
										if($editar_idtecnico) //Se não ocorreu nenhum erro:
										{
											$_SESSION["editado_eliminado"]=true; //A variável editado_eliminado fica verdadeiro para assim não fazer a verificação para recarregar a página e não houver erro de duplicação de dados
								
											echo "<script>" .
													 "window.addEventListener('load', function()" .
													 "{" .
														 "Modal('certo', 'Equipamento consertado com sucesso.');" . //Abre o modal de certo para informar ao utilizador que foi consertado com sucesso
													 "});" .
												 "</script>";
										}
										else //Se não:
										{
											$_SESSION["mensagemerro"]="Erro ao alterar o id do técnico, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
									}
									elseif($linhas_tecnico==1) //Se as linhas são 1 significa houve algum erro ao buscar o técnico inserido então:
										{
											$_SESSION["mensagemerro"]="Erro a procurar o id do técnico que consertou a avaria, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
										elseif($linhas_tecnico==0) //Se as linhas são 0 significa que não existe nenhum técnico na base de dados:
											{
												$_SESSION["mensagemerro"]="Erro inesperado. A tabela técnicos não possui o primeiro id que tudo nulo, por favor informe o administrador."; //Passa a mensagem de erro
												header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
											}
											elseif($linhas_tecnico<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
												{
													$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
													header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
												}
								}
								else //Se não significa que ocorreu um erro ou na base de dados ou o id que passou é inválido e contém catactéres além de números:
								{
									$_SESSION["mensagemerro"]="Erro ao consultar os técnicos, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
							else //Se não:
							{
								$_SESSION["mensagemerro"]="Erro ao inserir o técnico que consertou a avaria, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
						else //Se não:
						{
							$_SESSION["mensagemerro"]="Erro ao alterar a data de conserto, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
					}
					else //Se não:
					{
						$_SESSION["mensagemerro"]="Erro ao alterar o estado da avaria, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
			}
		}
		else //Se não significa que já cliquei no botão para editar ou para eliminar e vai fazer o seguinte:
		{ //Se não fizer essa verificação quando recarregar a página iria gerar o erros
			unset($_SESSION["editado_eliminado"]); //Elimina a variável
			header("Location: ConsultarAvarias.php"); //Recarrega a página e volta para a página de Consultar Avarias
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
				width: 3145px; /* A tabela fica com 1016px de comprimento, ((185px*6 campos)+16)=1116px */
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
				
				if(!(document.getElementById("selectpesquisar")==null)) //Se a caixa de seleção de pesquisar existe então:
				{
					//Se estou a pesquisar a data de avaria ou a data de conserto então:
					if((document.getElementById("selectpesquisar").value=="data_avaria") || (document.getElementById("selectpesquisar").value=="data_conserto"))
					{
						document.getElementById("pesquisar").value=""; //Retira o que estiver na caixa de texto
						document.getElementById("pesquisar").type="Date"; //Mete um calendário para puder selecionar a data que quero pesqusiar
					}
					else //Se não:
					{
						document.getElementById("pesquisar").type="Text"; //Mete a caixa de texto para escrever o que quero pesquisar
					}
					
					document.getElementById("selectpesquisar").addEventListener("change", function() //Se selecionei alguma opção de pesquisa específica:
					{
						//Se estou a pesquisar a data de avaria ou a data de conserto então:
						if((document.getElementById("selectpesquisar").value=="data_avaria") || (document.getElementById("selectpesquisar").value=="data_conserto"))
						{
							document.getElementById("pesquisar").value=""; //Retira o que estiver na caixa de texto
							document.getElementById("pesquisar").type="Date"; //Mete um calendário para puder selecionar a data que quero pesqusiar
						}
						else //Se não:
						{
							document.getElementById("pesquisar").type="Text"; //Mete a caixa de texto para escrever o que quero pesquisar
						}
					});
				}
			});
			
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
				}
				
				if(!(document.getElementById("btnokconsultar")==null)) //Se o botão ok consultar existir, porque pode não existir no caso usar modals com 2 botões ou modals sem botão então:
				{
					document.getElementById("btnokconsultar").addEventListener("click", function() //Quando clicar no botão ok:
					{
						location.href="ConsultarAvarias.php"; //Recarrega a página
					});
				}
				
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
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma avaria então:
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
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma avaria então:
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
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma avaria então:
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
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma avaria então:
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
								 header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro;
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
				<li><a href="#" id="equipamentos">Equipamentos</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar equipamentos -->
				<li class="ativo"><a href="#" id="avarias">Avarias</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar avarias -->
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
					header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
				
				if((isset($_GET["pesquisa"])) AND (isset($_GET["campo"]))) //Se foi mandada uma pesquisa específica então:
				{
					//Se não se a pesquisa foi Sim e o campo foi prioridade ou operacional então:
					if((($_GET["pesquisa"]=="S") OR ($_GET["pesquisa"]=="Si") OR ($_GET["pesquisa"]=="Sim")) AND (($_GET["campo"]=="estado") OR ($_GET["campo"]=="prioridade")))
					{
						$pesquisaexata=$_GET["pesquisa"]; //A pesquisa exata recebe o que o foi pesquisado
						$_GET["pesquisa"]="S"; //Temporariamente vai ser pesquisado por S devido à base de dados
					
					}   //Se não se a pesquisa foi Não e o campo foi prioridade ou operacional então:
					elseif((($_GET["pesquisa"]=="N") OR ($_GET["pesquisa"]=="Nã") OR ($_GET["pesquisa"]=="Não")) AND (($_GET["campo"]=="estado") OR ($_GET["campo"]=="prioridade")))
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
								//Pesquisa na base de dados das avarias da pesquisa específica com a ordenação
								$consultar_avarias=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, avarias a, tecnicos t, utilizadores u WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND eq.idequipamento=a.idequipamento AND a.idtecnico=t.idtecnico AND a.idutilizador=u.idutilizador AND " . $_GET["campo"] . " LIKE '%" . $_GET["pesquisa"] . "%' ORDER BY " . $_GET["ordenadopor"] . ";");
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma avaria então:
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
								//Pesquisa na base de dados das avarias da pesquisa específica
								$consultar_avarias=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, avarias a, tecnicos t, utilizadores u WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND eq.idequipamento=a.idequipamento AND a.idtecnico=t.idtecnico AND a.idutilizador=u.idutilizador AND " . $_GET["campo"] . " LIKE '%" . $_GET["pesquisa"] . "%' ORDER BY a.estado, eq.prioridade DESC;");
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma avaria então:
														"{" .
															"document.getElementById('pesquisar').value='" . $_GET["pesquisa"] . "';" .
															"document.getElementById('selectpesquisar').value='" . $_GET["campo"] . "';" .
															"document.getElementById('selectordenar').value='estado';" .
														"}" .
													"});" .
												"</script>";
							}
						}
						else //Se não:
						{
							//Pesquisa na base de dados das avarias da pesquisa específica
							$consultar_avarias=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, avarias a, tecnicos t, utilizadores u WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND eq.idequipamento=a.idequipamento AND a.idtecnico=t.idtecnico AND a.idutilizador=u.idutilizador AND " . $_GET["campo"] . " LIKE '%" . $_GET["pesquisa"] . "%' ORDER BY a.estado, eq.prioridade DESC;");
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma avaria então:
													"{" .
														"document.getElementById('pesquisar').value='" . $_GET["pesquisa"] . "';" .
														"document.getElementById('selectpesquisar').value='" . $_GET["campo"] . "';" .
														"document.getElementById('selectordenar').value='estado';" .
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
								//Pesquisa na base de dados das avarias com a ordenação
								$consultar_avarias=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, avarias a, tecnicos t, utilizadores u WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND eq.idequipamento=a.idequipamento AND a.idtecnico=t.idtecnico AND a.idutilizador=u.idutilizador ORDER BY " . $_GET["ordenadopor"] . ";");
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma avaria então:
														"{" .
															"document.getElementById('selectpesquisar').value='idavaria;" .
															"document.getElementById('selectordenar').value='" . $_GET["ordenadopor"] . "';" .
														"}" .
													"});" .
												"</script>";
							}
							else //Se não:
							{
								//Pesquisa na base de dados das avarias
								$consultar_avarias=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, avarias a, tecnicos t, utilizadores u WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND eq.idequipamento=a.idequipamento AND a.idtecnico=t.idtecnico AND a.idutilizador=u.idutilizador ORDER a.estado, eq.prioridade DESC;");
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma avaria então:
														"{" .
															"document.getElementById('selectpesquisar').value='idavaria';" .
															"document.getElementById('selectordenar').value='estado';" .
														"}" .
													"});" .
												"</script>";
							}
						}
						else //Se não:
						{
							//Pesquisa na base de dados das avarias
							$consultar_avarias=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, avarias a, tecnicos t, utilizadores u WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND eq.idequipamento=a.idequipamento AND a.idtecnico=t.idtecnico AND a.idutilizador=u.idutilizador ORDER a.estado, eq.prioridade DESC;");
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma avaria então:
													"{" .
														"document.getElementById('selectpesquisar').value='idavaria';" .
														"document.getElementById('selectordenar').value='estado';" .
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
							//Pesquisa na base de dados das avarias com a ordenação
							$consultar_avarias=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, avarias a, tecnicos t, utilizadores u WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND eq.idequipamento=a.idequipamento AND a.idtecnico=t.idtecnico AND a.idutilizador=u.idutilizador ORDER BY " . $_GET["ordenadopor"] . ";");
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma avaria então:
													"{" .
														"document.getElementById('selectpesquisar').value='idavaria';" .
														"document.getElementById('selectordenar').value='" . $_GET["ordenadopor"] . "';" .
													"}" .
												"});" .
											 "</script>";
						}
						else //Se não:
						{
							//Pesquisa na base de dados das avarias
							$consultar_avarias=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, avarias a, tecnicos t, utilizadores u WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND eq.idequipamento=a.idequipamento AND a.idtecnico=t.idtecnico AND a.idutilizador=u.idutilizador ORDER BY a.estado, eq.prioridade DESC;");
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma avaria então:
													"{" .
														"document.getElementById('selectpesquisar').value='idavaria';" .
														"document.getElementById('selectordenar').value='estado';" .
													"}" .
												"});" .
											"</script>";
						}
					}
					else //Se não:
					{
						//Pesquisa na base de dados das avarias
						$consultar_avarias=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, avarias a, tecnicos t, utilizadores u WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND eq.idequipamento=a.idequipamento AND a.idtecnico=t.idtecnico AND a.idutilizador=u.idutilizador ORDER BY a.estado, eq.prioridade DESC;");
						
						//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
						$preselecionado="<script>" .
											"window.addEventListener('load', function()" .
											"{" .
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma avaria então:
												"{" .
													"document.getElementById('selectpesquisar').value='idavaria';" .
													"document.getElementById('selectordenar').value='estado';" .
												"}" .
											"});" .
										"</script>";
					}
				}
				
				if($consultar_avarias) //Se não ocorreu nenhum erro:
				{
					$linhas_avarias=mysqli_num_rows($consultar_avarias); //Obtém o número de avarias
					if($linhas_avarias>0) //Se retornar mais que uma linha, significa que existe pelo menos uma avaria então:
					{
			echo "<a class='btnpesquisar' id='btnpesquisar' href='#'></a>"; //Botão de pesquisa específica
			echo "<input type='Text' name='pesquisar' class='pesquisar' id='pesquisar' placeholder='Introduza o que quer pesquisar' title='Introduza o que quer pesquisar'>"; //Caixa de texto da pesquisa específica
			echo "<select name='selectpesquisar' class='selectpesquisar' id='selectpesquisar'>"; //Caixa de seleção da pesquisa específica
				echo "<option value='idavaria'>Id</option>";
				echo "<option value='descricao'>Descrição</option>";
				echo "<option value='data_avaria'>Data de avaria</option>";
				echo "<option value='estado'>Arranjado</option>";
				echo "<option value='serial_number'>Número de série do equipamento</option>";
				echo "<option value='prioridade'>Prioridade</option>";
				echo "<option value='nome_escola'>Escola</option>";
				echo "<option value='nome_bloco'>Bloco</option>";
				echo "<option value='nome_sala'>Sala</option>";
				echo "<option value='posto'>Posto</option>";
				echo "<option value='nome_utilizador'>Utilizador que reportou</option>";
				echo "<option value='nome_tecnico'>Técnico que consertou</option>";
				echo "<option value='cargo_tecnico'>Cargo do técnico</option>";
				echo "<option value='data_conserto'>Data de conserto</option>";
			echo "</select>";
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<label class='textoordenar' id='textoordenar'>Ordernar por:</label>"; //Texto ordenar por
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<select name='selectordenar' class='selectordenar' id='selectordenar'>"; //Caixa de seleção de ordenação
				echo "<option value='idavaria'>Id (Crescente)</option>";
				echo "<option value='idavaria DESC'>Id (Decrescente)</option>";
				echo "<option value='descricao'>Descrição (Crescente)</option>";
				echo "<option value='descricao DESC'>Descrição (Decrescente)</option>";
				echo "<option value='data_avaria'>Data de avaria (Crescente)</option>";
				echo "<option value='data_avaria DESC'>Data de avaria (Decrescente)</option>";
				echo "<option value='estado'>Arranjado (Crescente)</option>";
				echo "<option value='estado DESC'>Arranjado (Decrescente)</option>";
				echo "<option value='serial_number'>Número de série do equipamento (Crescente)</option>";
				echo "<option value='serial_number DESC'>Número de série do equipamento (Decrescente)</option>";
				echo "<option value='prioridade'>Prioridade (Crescente)</option>";
				echo "<option value='prioridade DESC'>Prioridade (Decrescente)</option>";
				echo "<option value='nome_escola'>Escola (Crescente)</option>";
				echo "<option value='nome_escola DESC'>Escola (Decrescente)</option>";
				echo "<option value='nome_bloco'>Bloco (Crescente)</option>";
				echo "<option value='nome_bloco DESC'>Bloco (Decrescente)</option>";
				echo "<option value='nome_sala'>Sala (Crescente)</option>";
				echo "<option value='nome_sala DESC'>Sala (Decrescente)</option>";
				echo "<option value='posto'>Posto (Crescente)</option>";
				echo "<option value='posto DESC'>Posto (Decrescente)</option>";
				echo "<option value='nome_utilizador'>Utilizador que reportou (Crescente)</option>";
				echo "<option value='nome_utilizador DESC'>Utilizador que reportou (Decrescente)</option>";
				echo "<option value='nome_tecnico'>Técnico que consertou (Crescente)</option>";
				echo "<option value='nome_tecnico DESC'>Técnico que consertou (Decrescente)</option>";
				echo "<option value='cargo_tecnico'>Cargo do técnico (Crescente)</option>";
				echo "<option value='cargo_tecnico DESC'>Cargo do técnico (Decrescente)</option>";
				echo "<option value='data_conserto'>Data de conserto (Crescente)</option>";
				echo "<option value='data_conserto DESC'>Data de conserto (Decrescente)</option>";
			echo "</select>";
						echo $javascriptpesquisa; //Executa o que está programado para a pesquisa específica
						echo $preselecionado; //Executa o que está programado para o preselecionamento das caixas de seleção e da caixa de texto ter o que já tinha
			echo "<div class='zonatabela' id='zonatabela'>"; //Início da zona da tabela
				echo "<table class='tabela' id='tabela'>"; //Início da tabela
					echo "<thead>"; //Início do cabeçalho da tabela
						echo "<tr>"; //Início da linha da tabela
							echo "<th class='campotabela'>Id</th>";  //Título Id
							echo "<th class='campotabela'>Descrição</th>"; //Título Descrição
							echo "<th class='campotabela'>Data de avaria</th>"; //Título Data de avaria
							echo "<th class='campotabela'>Arranjado</th>"; //Título Arranjado
							echo "<th class='campotabela'>Número de série<br>do equipamento</th>"; //Título Número de série do equipamento
							echo "<th class='campotabela'>Prioridade</th>"; //Título Prioridade
							echo "<th class='campotabela'>Escola</th>"; //Título Escola
							echo "<th class='campotabela'>Bloco</th>"; //Título Bloco
							echo "<th class='campotabela'>Sala</th>"; //Título Sala
							echo "<th class='campotabela'>Posto</th>"; //Título Posto
							echo "<th class='campotabela'>Utilizador que reportou</th>"; //Título Utilizador que reportou
							echo "<th class='campotabela'>Técnico que consertou</th>"; //Título Técnico que consertou
							echo "<th class='campotabela'>Cargo do técnico</th>"; //Título Cargo do técnico
							echo "<th class='campotabela'>Data do conserto</th>"; //Título Data de conserto
							
						if(isset($_SESSION["vista"])) //Se a variável de sessão existe significa que é o tipo de utilizador é um administrador então:
						{
							if($_SESSION["vista"]=="A") //Se a vista é de administrador cria o cabeçalho para os botões então:
							{
							echo "<th class='campotabela'></th>";
							echo "<th class='campotabela'></th>";
							echo "<th class='campoultimo'></th>"; //Este campo receberá um comprimento diferente para ficar alinhado com com a barra de rolagem
							}
							elseif($_SESSION["vista"]=="E") //Se não não mete os cabeçalhos e os botões e define este campo como último
								{
									echo "<script>" .
											 "window.addEventListener('load', function()" .
											 "{" .
												 "if(!(document.getElementById('tabela')==null))" . //Se a tabela normal existe então:
												 "{" .
													 "document.getElementById('tabela').style.width='2900px';" . //Dimiui o tamanho da tabela
												 "}" .
											 "});" .
										 "</script>";
									
							echo "<th class='campotabela'></th>";
							echo "<th class='campoultimo'></th>";
								}
						}
						else //Se não não mete os cabeçalhos e os botões e define este campo como último
						{
							echo "<script>" .
									 "window.addEventListener('load', function()" .
									 "{" .
										 "if(!(document.getElementById('tabela')==null))" . //Se a tabela normal existe então:
										 "{" .
											 "document.getElementById('tabela').style.width='2900px';" . //Dimiui o tamanho da tabela
										 "}" .
									 "});" .
								 "</script>";
							
							echo "<th class='campotabela'></th>";
							echo "<th class='campoultimo'></th>";
						}
						
						echo "</tr>";//Fim da linha da tabela
					echo "</thead>"; //Fim do cabeçalho da tabela
					echo "<tbody>"; //Início dos campos da tabela
						for($i=0; $i<$linhas_avarias; $i++) //Vai repetir o número de avarias, por exemplo, se existir 10 avarias repete 10 vezes
						{
							$dados_avarias=mysqli_fetch_array($consultar_avarias); //Recebe os dados de cada avaria
							
							//Este if, o else e tudo dentro é para definir o link de editar e eliminar para depois, por exemplo, se fiz mandei eliminar e quero cancelar vou voltar para essa página com a pesquisa específica em vez de voltar para a página original
							if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se já havia uma pesquisa específica então:
							{
								if(isset($_GET["ordenadopor"])) //Se já existia uma ordenação então:
								{
									$linkeditar="?acao=editar&id=" . $dados_avarias["idavaria"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] ."&ordenadopor=" . $_GET["ordenadopor"];
									$linkeliminar="?acao=eliminar&id=" . $dados_avarias["idavaria"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] ."&ordenadopor=" . $_GET["ordenadopor"];
									$linkconsertar="?acao=consertar&id=" . $dados_avarias["idavaria"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] ."&ordenadopor=" . $_GET["ordenadopor"];
								}
								else //Se não:
								{
									$linkeditar="?acao=editar&id=" . $dados_avarias["idavaria"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"];
									$linkeliminar="?acao=eliminar&id=" . $dados_avarias["idavaria"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"];
									$linkconsertar="?acao=consertar&id=" . $dados_avarias["idavaria"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"];
								}
							}
							else //Se não:
							{
								if(isset($_GET["ordenadopor"])) //Se já existia uma ordenação então:
								{
									$linkeditar="?acao=editar&id=" . $dados_avarias["idavaria"] . "&ordenadopor=" . $_GET["ordenadopor"];
									$linkeliminar="?acao=eliminar&id=" . $dados_avarias["idavaria"] . "&ordenadopor=" . $_GET["ordenadopor"];
									$linkconsertar="?acao=consertar&id=" . $dados_avarias["idavaria"] . "&ordenadopor=" . $_GET["ordenadopor"];
								}
								else  //Se não:
								{
									$linkeditar="?acao=editar&id=" . $dados_avarias["idavaria"];
									$linkeliminar="?acao=eliminar&id=" . $dados_avarias["idavaria"];
									$linkconsertar="?acao=consertar&id=" . $dados_avarias["idavaria"];
								}
							}
							
							if(($dados_avarias["prioridade"]=="S") AND ($dados_avarias["estado"]=="N")) //Se a avaria é urgente e ainda não foi consertada:
							{
						echo "<tr style='color: #FF0000;'>"; //Início da linha da tabela com cor da letra vermelho
								$corlink="#FF0000"; //A cor do link fica a vermelho
							}
							else //Se não:
							{
						echo "<tr>"; //Início da linha da tabela
								$corlink="Black"; //A cor do link fica a preto
							}
							
							echo "<td>" . $dados_avarias["idavaria"] . "</td>" ; //Aqui vai aparecer o id da avaria
							echo "<td>" . $dados_avarias["descricao"] . "</td>"; //Aqui vai aparecer o descrição da avaria
							
							//Mete a data por ordem de dia/mês/ano
							$data_avaria=$dados_avarias["data_avaria"][8];
							$data_avaria.=$dados_avarias["data_avaria"][9];
							$data_avaria.="/";
							$data_avaria.=$dados_avarias["data_avaria"][5];
							$data_avaria.=$dados_avarias["data_avaria"][6];
							$data_avaria.="/";
							$data_avaria.=$dados_avarias["data_avaria"][0];
							$data_avaria.=$dados_avarias["data_avaria"][1];
							$data_avaria.=$dados_avarias["data_avaria"][2];
							$data_avaria.=$dados_avarias["data_avaria"][3];
							
							echo "<td>" . $data_avaria . "</td>"; //Aqui vai aparecer a data da avaria
							
							switch($dados_avarias["estado"]) //Caso o estado:
							{
				  //Seja S:
				  case "S": echo "<td>Sim</td>"; //Aparece Sim na tabela
							break; //Fim da opção
							
				  //Seja N
				  case "N": echo "<td>Não</td>"; //Aparece Não na tabela
							break; //Fim da opção
							
								default: $_SESSION["mensagemerro"]="O estado da avaria é inválido, por favor informe o administrador."; //Passa a mensagem de erro
										 header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro;
							}
							
							if($dados_avarias["idcomputador"]>1) //Se o equipamento é um computador então:
							{
								echo "<td><a href='ConsultarComputadores.php?pesquisa=" . $dados_avarias["idequipamento"] . "&campo=idequipamento' style='color: " . $corlink . ";'>" . $dados_avarias["serial_number"] . "</a></td>"; //Aqui vai aparecer o número de série e se clicar ele redirecionar-me-à para a página de consultar o computador com esse número de série em específico
							}
							elseif($dados_avarias["idqim"]>1) //Se o equipamento é um quadro interativo multimédia então:
								{
									echo "<td><a href='ConsultarQIMs.php?pesquisa=" . $dados_avarias["idequipamento"] . "&campo=idequipamento' style='color: " . $corlink . ";'>" . $dados_avarias["serial_number"] . "</a></td>"; //Aqui vai aparecer o número de série e se clicar ele redirecionar-me-à para a página de consultar o quadro interativo multimédia com esse número de série em específico
								}
								elseif($dados_avarias["idmonitor"]>1) //Se o equipamento é um monitor então:
									{
										echo "<td><a href='ConsultarMonitores.php?pesquisa=" . $dados_avarias["idequipamento"] . "&campo=idequipamento' style='color: " . $corlink . ";'>" . $dados_avarias["serial_number"] . "</a></td>"; //Aqui vai aparecer o número de série e se clicar ele redirecionar-me-à para a página de consultar o monitor com esse número de série em específico
									}
									elseif($dados_avarias["idprojetor"]>1) //Se o equipamento é um projetor então:
										{
											echo "<td><a href='ConsultarProjetores.php?pesquisa=" . $dados_avarias["idequipamento"] . "&campo=idequipamento' style='color: " . $corlink . ";'>" . $dados_avarias["serial_number"] . "</a></td>"; //Aqui vai aparecer o número de série e se clicar ele redirecionar-me-à para a página de consultar o projetor com esse número de série em específico
										}
										else //Se não:
										{
											$_SESSION["mensagemerro"]="Erro ao verificar o tipo de equipamento, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
							
							switch($dados_avarias["prioridade"]) //Caso a prioridade:
							{
				  //Seja S:
				  case "S": echo "<td>Sim</td>"; //Aparece Sim na tabela
							break; //Fim da opção
							
				  //Seja N
				  case "N": echo "<td>Não</td>"; //Aparece Não na tabela
							break; //Fim da opção
							
								default: $_SESSION["mensagemerro"]="A prioridade é inválida, por favor informe o administrador."; //Passa a mensagem de erro
										 header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro;
							}
							
							echo "<td><a href='ConsultarEscolas.php?pesquisa=" . $dados_avarias["idescola"] . "&campo=idescola' style='color: " . $corlink . ";'>" . $dados_avarias["nome_escola"] . "</a></td>"; //Aqui vai aparecer o nome da escola e se clicar ele redirecionar-me-à para a página de consultar essa escola em específico
							echo "<td><a href='ConsultarBlocos.php?pesquisa=" . $dados_avarias["idbloco"] . "&campo=idbloco' style='color: " . $corlink . ";'>" . $dados_avarias["nome_bloco"] . "</a></td>"; //Aqui vai aparecer o nome do bloco e se clicar ele redirecionar-me-à para a página de consultar esse bloco em específico
							echo "<td><a href='ConsultarSalas.php?pesquisa=" . $dados_avarias["idsala"] . "&campo=idsala' style='color: " . $corlink . ";'>" . $dados_avarias["nome_sala"] . "</a></td>"; //Aqui vai aparecer o nome da sala e se clicar ele redirecionar-me-à para a página de consultar essa sala em específico
							echo "<td>" . $dados_avarias["posto"] . "</td>"; //Aqui vai aparecer o posto do equipamento avariado
							
							if(isset($_SESSION["vista"])) //Se a variável vista existe
							{
								if($_SESSION["vista"]=="A") //Se a vista é de administrador
								{
									echo "<td><a href='ConsultarUtilizadores.php?pesquisa=" . $dados_avarias["idutilizador"] . "&campo=idutilizador' style='color: " . $corlink . ";'>" . $dados_avarias["nome_utilizador"] . "</a></td>"; //Aqui vai aparecer o nome do utilizador e se clicar ele redirecionar-me-à para a página de consultar esse utilizador em específico
								}
								else //Se não:
								{
									echo "<td>" . $dados_avarias["nome_utilizador"] . "</td>"; //Aqui vai aparecer o nome do utilizador
								}
							}
							else //Se não:
							{
								echo "<td>" . $dados_avarias["nome_utilizador"] . "</td>"; //Aqui vai aparecer o nome do utilizador
							}
							
							if($dados_avarias["estado"]=="N") //Se a avaria ainda não foi consertada então:
							{
								echo "<td>Sem técnico.</td>"; //Aqui vai informar que não existe técnico
								echo "<td>Sem cargo.</td>"; //Aqui vai informar que não existe cargo
								echo "<td>Sem data de conserto.</td>"; //Aqui vai informar que não existe data de conserto
							}
							else //Se não:
							{
								echo "<td>" . $dados_avarias["nome_tecnico"] . "</td>"; //Aqui vai aparecer o nome do técnico
								echo "<td>" . $dados_avarias["cargo_tecnico"] . "</td>"; //Aqui vai aparecer o cargo do técnico
								
								//Mete a data por ordem de dia/mês/ano
								$data_conserto=$dados_avarias["data_conserto"][8];
								$data_conserto.=$dados_avarias["data_conserto"][9];
								$data_conserto.="/";
								$data_conserto.=$dados_avarias["data_conserto"][5];
								$data_conserto.=$dados_avarias["data_conserto"][6];
								$data_conserto.="/";
								$data_conserto.=$dados_avarias["data_conserto"][0];
								$data_conserto.=$dados_avarias["data_conserto"][1];
								$data_conserto.=$dados_avarias["data_conserto"][2];
								$data_conserto.=$dados_avarias["data_conserto"][3];
								
								echo "<td>" . $data_conserto . "</td>"; //Aqui vai aparecer a data de conserto
							}
							
							echo "<td><div align='Center'><a href='" . $linkeditar . "'><i class='fa fa-pencil' style='color: Black;'></i></a></div></td>"; //Botão para editar os dados
							
							if(isset($_SESSION["vista"])) //Se a variável de sessão existe significa que é o tipo de utilizador é um administrador então:
							{
								if($_SESSION["vista"]=="A") //Se a vista é de administrador cria o botão de editar e eliminar então
								{
							echo "<td><div align='Center'><a href='" . $linkeliminar . "'><i class='fa fa-close' style='color: Black;'></i></a></div></td>"; //Botão para eliminar os dados
								}
							}
							
							if($dados_avarias["estado"]=="N") //Se a avaria ainda não arranjada vai aparecer o botão para meter que já está consertado então:
							{
								echo "<td><div align='Center'><button class='btntabela' id='btnconsertar" . ($i+1) . "'>Consertar avaria</button></div></td>"; //Botão para consertar a avaria
								
								echo "<script>" .
										 "window.addEventListener('load', function()" .
										 "{" .
											 "if(!(document.getElementById('btnconsertar" . ($i+1) . "')==null))" . //Se o botão consertar existe então:
											 "{" .
												 "document.getElementById('btnconsertar" . ($i+1) . "').addEventListener('click', function()" .
												 "{" .
													 "location.href='" . $linkconsertar . "';" . //Abre o modal para inserir o técnico que consertou a avaria
												 "});" .
											 "}" .
										 "});" .
									 "</script>";
							}
							else //Se não
							{
								echo "<td></td>"; //Mete o campo vazio
							}
						echo "</tr>"; //Fim da linha
						}
					echo "</tbody>"; //Fim dos campos da tabela
				echo "</table>"; //Fim da tabela
			echo "</div>"; //Fim da zona da tabela
					}
					elseif($linhas_avarias==0) //Se não se retornar 0 linhas, significa que não existe nenhuma avaria preenchida então:
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
																									"'<option value=\'idavaria\'>Id</option>' +" .
																									"'<option value=\'descricao\'>Descrição</option>' +" .
																									"'<option value=\'data_avaria\'>Data de avaria</option>' +" .
																									"'<option value=\'estado\'>Arranjado</option>' +" .
																									"'<option value=\'serial_number\'>Número de série do equipamento</option>' +" .
																									"'<option value=\'prioridade\'>Prioridade</option>' +" .
																									"'<option value=\'nome_escola\'>Escola</option>' +" .
																									"'<option value=\'nome_bloco\'>Bloco</option>' +" .
																									"'<option value=\'nome_sala\'>Sala</option>' +" .
																									"'<option value=\'posto\'>Posto</option>' +" .
																									"'<option value=\'nome_utilizador\'>Utilizador que reportou</option>' +" .
																									"'<option value=\'nome_tecnico\'>Técnico que consertou</option>' +" .
																									"'<option value=\'cargo_tecnico\'>Cargo do técnico</option>' +" .
																									"'<option value=\'data_conserto\'>Data de conserto</option>' +" .
																								"'</select>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<label class=\'textoordenar\' id=\'textoordenar\'>Ordernar por:</label>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<select name=\'selectordenar\' class=\'selectordenar\' id=\'selectordenar\'>' +" . 
																									"'<option value=\'idavaria\'>Id (Crescente)</option>' +" .
																									"'<option value=\'idavaria DESC\'>Id (Decrescente)</option>' +" .
																									"'<option value=\'descricao\'>Descrição (Crescente)</option>' +" .
																									"'<option value=\'descricao DESC\'>Descrição (Decrescente)</option>' +" .
																									"'<option value=\'data_avaria\'>Data de avaria (Crescente)</option>' +" .
																									"'<option value=\'data_avaria DESC\'>Data de avaria (Decrescente)</option>' +" .
																									"'<option value=\'estado\'>Arranjado (Crescente)</option>' +" .
																									"'<option value=\'estado DESC\'>Arranjado (Decrescente)</option>' +" .
																									"'<option value=\'serial_number\'>Número de série do equipamento (Crescente)</option>' +" .
																									"'<option value=\'serial_number DESC\'>Número de série do equipamento (Decrescente)</option>' +" .
																									"'<option value=\'prioridade\'>Prioridade (Crescente)</option>' +" .
																									"'<option value=\'prioridade DESC\'>Prioridade (Decrescente)</option>' +" .
																									"'<option value=\'nome_escola\'>Escola (Crescente)</option>' +" .
																									"'<option value=\'nome_escola DESC\'>Escola (Decrescente)</option>' +" .
																									"'<option value=\'nome_bloco\'>Bloco (Crescente)</option>' +" .
																									"'<option value=\'nome_bloco DESC\'>Bloco (Decrescente)</option>' +" .
																									"'<option value=\'nome_sala\'>Sala (Crescente)</option>' +" .
																									"'<option value=\'nome_sala DESC\'>Sala (Decrescente)</option>' +" .
																									"'<option value=\'posto\'>Posto (Crescente)</option>' +" .
																									"'<option value=\'posto DESC\'>Posto (Decrescente)</option>' +" .
																									"'<option value=\'nome_utilizador\'>Utilizador que reportou (Crescente)</option>' +" .
																									"'<option value=\'nome_utilizador DESC\'>Utilizador que reportou (Decrescente)</option>' +" .
																									"'<option value=\'nome_tecnico\'>Técnico que consertou (Crescente)</option>' +" .
																									"'<option value=\'nome_tecnico DESC\'>Técnico que consertou (Decrescente)</option>' +" .
																									"'<option value=\'cargo_tecnico\'>Cargo do técnico (Crescente)</option>' +" .
																									"'<option value=\'cargo_tecnico DESC\'>Cargo do técnico (Decrescente)</option>' +" .
																									"'<option value=\'data_conserto\'>Data de conserto (Crescente)</option>' +" .
																									"'<option value=\'data_conserto DESC\'>Data de conserto (Decrescente)</option>' +" .
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
												 "location.href='ConsultarAvarias.php';" . //Volta para a página original
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
									if($_SESSION["vista"]=="A") //Se a vista é de administrador então pode ser redirecionado para a página de inserir avarias:
									{
										echo "<script>" .
												 "window.addEventListener('load', function()" .
												 "{" .
													 "var segundos=5;" . //Variável que vai conter os segundos
													 
													 "Modal('avaria', 'Sem avarias inseridas.');" . //Abre o Modal de que ainda não foi inserido nada
													 
													 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir avarias dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página de inserir avarias dentro de 5 segundos
													 "document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
													 
													 "setTimeout(function()" . //Ao fim de 6 segundos acontecerá:
													 "{" .
														 "location.href='InserirAvarias.php';" . //Redireciona para a página de inserir avarias
													 "}, 6000);" .
													 
													 "setInterval(function()" . //De 1 em 1 segundo:
													 "{" .
														 "if(segundos==1)" . //Se falta 1 segundo então vai meter a palavra segundos no singular
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir avarias dentro de ' + segundos + ' segundo.';" .
															 "segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
														 "}" .
														 "else" .
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir avarias dentro de ' + segundos + ' segundos.';" .
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
													 
													 "Modal('avaria', 'Sem avarias inseridas.');" . //Abre o Modal de que ainda não foi inserido nada
													 
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
									if($_SESSION["tipo_utilizador"]=="A") //Se o tipo de utilizador é de administrador então pode ser redirecionado para a página de inserir avarias:
									{
										echo "<script>" .
												 "window.addEventListener('load', function()" .
												 "{" .
													 "var segundos=5;" . //Variável que vai conter os segundos
													 
													 "Modal('avaria', 'Sem avarias inseridas.');" . //Abre o Modal de que ainda não foi inserido nada
													 
													 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir avarias dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página de inserir avarias dentro de 5 segundos
													 "document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
													 
													 "setTimeout(function()" . //Ao fim de 6 segundos acontecerá:
													 "{" .
														 "location.href='InserirAvarias.php';" . //Redireciona para a página de inserir avarias
													 "}, 6000);" .
													 
													 "setInterval(function()" . //De 1 em 1 segundo:
													 "{" .
														 "if(segundos==1)" . //Se falta 1 segundo então vai meter a palavra segundos no singular
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir avarias dentro de ' + segundos + ' segundo.';" .
															 "segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
														 "}" .
														 "else" .
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir avarias dentro de ' + segundos + ' segundos.';" .
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
													 
													 "Modal('avaria', 'Sem avarias inseridas.');" . //Abre o Modal de que ainda não foi inserido nada
													 
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
						elseif($linhas_avarias<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
							{
								$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
				}
				else //Se não, se ocorreu um erro:
				{ //Nota: Importante, a página estiver a dar erro de estar a ser redirecionara várias vezes poderá ser da query da tabela normal que está mal
					if((isset($_GET["pesquisa"])) AND (isset($_GET["campo"]))) //Se foi feita uma pesquisa específica:
					{
						if(isset($_GET["ordenadopor"])) //Se foi feita uma ordenação então:
						{
							//Se o campo digitado não for nenhum válido
							if(($_GET["campo"]!="idavaria") AND ($_GET["campo"]!="descricao") AND ($_GET["campo"]!="data_avaria") AND ($_GET["campo"]!="estado") AND ($_GET["campo"]!="serial_number") AND ($_GET["campo"]!="prioridade") AND ($_GET["campo"]!="escola") AND ($_GET["campo"]!="bloco") AND ($_GET["campo"]!="sala") AND ($_GET["campo"]!="posto") AND ($_GET["campo"]!="nome_utilizador") AND ($_GET["campo"]!="nome_tecnico") AND ($_GET["campo"]!="cargo_tecnico") AND ($_GET["campo"]!="data_conserto"))
							{
								//se a ordenação digitada não for nenhum válido
								if(($_GET["ordenadopor"]!="idavaria") AND ($_GET["ordenadopor"]!="idavaria DESC") AND ($_GET["ordenadopor"]!="descricao") AND ($_GET["ordenadopor"]!="descricao DESC") AND ($_GET["ordenadopor"]!="data_avaria") AND ($_GET["ordenadopor"]!="data_avaria DESC") AND ($_GET["ordenadopor"]!="estado") AND ($_GET["ordenadopor"]!="estado DESC") AND ($_GET["ordenadopor"]!="serial_number") AND ($_GET["ordenadopor"]!="serial_number DESC") AND ($_GET["ordenadopor"]!="prioridade") AND ($_GET["ordenadopor"]!="prioridade DESC") AND ($_GET["ordenadopor"]!="escola") AND ($_GET["ordenadopor"]!="escola DESC") AND ($_GET["ordenadopor"]!="bloco") AND ($_GET["ordenadopor"]!="bloco DESC") AND ($_GET["ordenadopor"]!="sala") AND ($_GET["ordenadopor"]!="sala DESC") AND ($_GET["ordenadopor"]!="posto") AND ($_GET["ordenadopor"]!="posto DESC") AND ($_GET["ordenadopor"]!="nome_utilizador") AND ($_GET["ordenadopor"]!="nome_utilizador DESC") AND ($_GET["ordenadopor"]!="nome_tecnico") AND ($_GET["ordenadopor"]!="nome_tecnico DESC") AND ($_GET["ordenadopor"]!="cargo_tecnico") AND ($_GET["ordenadopor"]!="cargo_tecnico DESC") AND ($_GET["ordenadopor"]!="data_conserto") AND ($_GET["ordenadopor"]!="data_conserto DESC"))
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
								if(($_GET["ordenadopor"]!="idavaria") AND ($_GET["ordenadopor"]!="idavaria DESC") AND ($_GET["ordenadopor"]!="descricao") AND ($_GET["ordenadopor"]!="descricao DESC") AND ($_GET["ordenadopor"]!="data_avaria") AND ($_GET["ordenadopor"]!="data_avaria DESC") AND ($_GET["ordenadopor"]!="estado") AND ($_GET["ordenadopor"]!="estado DESC") AND ($_GET["ordenadopor"]!="serial_number") AND ($_GET["ordenadopor"]!="serial_number DESC") AND ($_GET["ordenadopor"]!="prioridade") AND ($_GET["ordenadopor"]!="prioridade DESC") AND ($_GET["ordenadopor"]!="escola") AND ($_GET["ordenadopor"]!="escola DESC") AND ($_GET["ordenadopor"]!="bloco") AND ($_GET["ordenadopor"]!="bloco DESC") AND ($_GET["ordenadopor"]!="sala") AND ($_GET["ordenadopor"]!="sala DESC") AND ($_GET["ordenadopor"]!="posto") AND ($_GET["ordenadopor"]!="posto DESC") AND ($_GET["ordenadopor"]!="nome_utilizador") AND ($_GET["ordenadopor"]!="nome_utilizador DESC") AND ($_GET["ordenadopor"]!="nome_tecnico") AND ($_GET["ordenadopor"]!="nome_tecnico DESC") AND ($_GET["ordenadopor"]!="cargo_tecnico") AND ($_GET["ordenadopor"]!="cargo_tecnico DESC") AND ($_GET["ordenadopor"]!="data_conserto") AND ($_GET["ordenadopor"]!="data_conserto DESC"))
								{
									//Recarrega a página e mensagem a avisar que a ordenação que digitou é inválida
									header("Location: ?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=A_ordenacao_que_digitou_e_invalida");
								}
								else //Se não:
								{
									$_SESSION["mensagemerro"]="Erro ao consultar as avarias, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
						}
						else //Se não
						{
							//Se o campo é inválido
							if(($_GET["campo"]!="idavaria") AND ($_GET["campo"]!="descricao") AND ($_GET["campo"]!="data_avaria") AND ($_GET["campo"]!="estado") AND ($_GET["campo"]!="serial_number") AND ($_GET["campo"]!="prioridade") AND ($_GET["campo"]!="escola") AND ($_GET["campo"]!="bloco") AND ($_GET["campo"]!="sala") AND ($_GET["campo"]!="posto") AND ($_GET["campo"]!="nome_utilizador") AND ($_GET["campo"]!="nome_tecnico") AND ($_GET["campo"]!="cargo_tecnico") AND ($_GET["campo"]!="data_conserto"))
							{
								//Recarrega a página e mensagem a avisar que o campo que digitou é inválido
								header("Location: ?pesquisa=" . $_GET["pesquisa"] . "&campo=O_campo_que_digitou_e_invalido");
							}
							else //Se não
							{
								$_SESSION["mensagemerro"]="Erro ao consultar as avarias, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
					}
					else //Se não
					{
						if(isset($_GET["ordenadopor"])) //Se foi feita uma ordenação:
						{
							//Se o ordenar é inválido:
							if(($_GET["ordenadopor"]!="idavaria") AND ($_GET["ordenadopor"]!="idavaria DESC") AND ($_GET["ordenadopor"]!="descricao") AND ($_GET["ordenadopor"]!="descricao DESC") AND ($_GET["ordenadopor"]!="data_avaria") AND ($_GET["ordenadopor"]!="data_avaria DESC") AND ($_GET["ordenadopor"]!="estado") AND ($_GET["ordenadopor"]!="estado DESC") AND ($_GET["ordenadopor"]!="serial_number") AND ($_GET["ordenadopor"]!="serial_number DESC") AND ($_GET["ordenadopor"]!="prioridade") AND ($_GET["ordenadopor"]!="prioridade DESC") AND ($_GET["ordenadopor"]!="escola") AND ($_GET["ordenadopor"]!="escola DESC") AND ($_GET["ordenadopor"]!="bloco") AND ($_GET["ordenadopor"]!="bloco DESC") AND ($_GET["ordenadopor"]!="sala") AND ($_GET["ordenadopor"]!="sala DESC") AND ($_GET["ordenadopor"]!="posto") AND ($_GET["ordenadopor"]!="posto DESC") AND ($_GET["ordenadopor"]!="nome_utilizador") AND ($_GET["ordenadopor"]!="nome_utilizador DESC") AND ($_GET["ordenadopor"]!="nome_tecnico") AND ($_GET["ordenadopor"]!="nome_tecnico DESC") AND ($_GET["ordenadopor"]!="cargo_tecnico") AND ($_GET["ordenadopor"]!="cargo_tecnico DESC") AND ($_GET["ordenadopor"]!="data_conserto") AND ($_GET["ordenadopor"]!="data_conserto DESC"))
							{
								//Recarrega a página e mensagem a avisar que a ordenação que digitou é inválida
								header("Location: ?ordenadopor=A_ordenacao_que_digitou_e_invalida");
							}
							else //Se nao
							{
								$_SESSION["mensagemerro"]="Erro ao consultar as avarias, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
						else //Se nao
						{
							$_SESSION["mensagemerro"]="Erro ao consultar as avarias, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
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