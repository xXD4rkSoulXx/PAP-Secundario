<!-- Começar a explicar a partir do HTML e só depois voltar aqui para cima -->
<!-- Inicio dos códigos PHP -->
<?php
	include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
	
	session_start(); //Inicia a sessão para puder fazer a verificação se estou logado ou não, sempre que preciso de usar alguma variável da session tenho que obrigatoriamente começar por esse código
	
	if(!isset($_SESSION["idutilizador"])) //Se o id do utilizador não exite:
	{
		$_SESSION["pagina"]="ConsultarEscolas.php"; //Variável que indica que página eu pretendia entrar para assim que fizer o login redirecionar-me de volta para esta página
		header("Location: Login.php"); //Manda para a página do Login por se o id do utilizador não existe significa que não efetoou o login
	}
	
	if(isset($_POST["selectvista"])) //Se mandei alterar a vista então:
	{
		$_SESSION["vista"]=$_POST["selectvista"]; //A variável de sessão recebe a opção que selecionei
		header("Location: ConsultarEscolas.php"); //Recarrega a página para a vista
	}
	
	//Ideia de redirecionar-me para a página que queria sem sucesso
	if(($_SESSION["tipo_utilizador"]=="A")) //Se o utilizador é Administrador
	{
		if(((!($_SESSION["tipo_utilizador"]=="A")) AND (!($_SESSION["vista"]=="A"))) AND ((!($_SESSION["vista"]=="E")))) //Se o utilizador não é administrador ou não está na vista de estagiário:
		{
			
			if($_SESSION["pagina"]=="ConsultarEscolas.php") //Se a página que estiver for a ConsultarEscolas.php, significa que provavelmente tinha tentado entrar nesta página mas redirecionou-me para a página de login por ainda não ter sessão inciada aí fiz o login mas a conta aonde estou não contêm permissões de administrador ou de estagiário então:
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
	
	$_SESSION["pagina"]="ConsultarEscolas.php"; //Variável que indica que página eu estou para que assim que entre numa página que não contenha permissão redirecione-me de volta a esta página aonde estava antes
	
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
						if(isset($_SESSION["vista"])) //Se a variável sessão existe então:
						{
							if($_SESSION["vista"]=="E") //Se a vista é de estagiário:
							{
								header("Location: ConsultarEscolas.php"); //Recarrega a página e bloqueia a pesmissão para puder editar dados
							}
						}
						else //Se não:
						{
							if($_SESSION["tipo_utilizador"]=="E") //Se o utilizador é um estagiário então:
							{
								header("Location: ConsultarEscolas.php"); //Recarrega a página e bloqueia a pesmissão para puder editar dados
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
							header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
						
						$consultar_escola=mysqli_query($conexao, "SELECT * FROM agrupamentos a, escolas e WHERE a.idagrupamento=e.idagrupamento AND idescola=" . $_GET["id"] . ";"); //Vai buscar a escola que quero editar
						if($consultar_escola) //Se não ocorreu nenhum erro:
						{
							$linhas_escola=mysqli_num_rows($consultar_escola); //Obtém o número de escolas com esse id
							if($linhas_escola>0) //Se retornar mais que uma linha, significa que existe pelo menos uma escola então:
							{
								$dados_escola=mysqli_fetch_array($consultar_escola); //Vai buscar os dados da escola que quero editar
								
								if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se estava uma pesquisa específica
								{
									if(isset($_GET["ordenadopor"])) //Se estava ordenado
									{
										$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão cancelar:
														   "{" .
														       "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar a escola pois o que quer-se é cancelar e não editar
															   "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado e com o que estava ordenado
														   "});";
									}
									else //Se não
									{
										$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão cancelar:
														   "{" .
															   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar a escola pois o que quer-se é cancelar e não editar
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
															   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar a escola pois o que quer-se é cancelar e não editar
															   "location.href='?ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava ordenado
														   "});";
									}
									else //Se não
									{
										$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão cancelar:
														   "{" .
															   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar a escola pois o que quer-se é cancelar e não editar
															   "location.href='ConsultarEscolas.php';" . //Manda de volta para a página que estava
														   "});";
									}
								}
								
								$consultar_agrupamento=mysqli_query($conexao, "SELECT * FROM agrupamentos;"); //Vai buscar os agrupamentos
								if($consultar_agrupamento) //Se não ocorreu nenhum erro:
								{
									$linhas_agrupamento=mysqli_num_rows($consultar_agrupamento); //Obtém o número de agrupamentos com esse id
									if($linhas_agrupamento>0) //Se retornar mais que uma linha, significa que existe pelo menos um agrupamento então:
									{
										$selectagrupamento="<select name=\'idagrupamento\' class=\'dadotabela\' id=\'idagrupamento\' title=\'Preselecionado: " . $dados_escola["nome_agrupamento"] . "\' style=\'width: 120px;\'>"; //A variável select vai receber o código HTML do select
										
										for($i=0; $i<$linhas_agrupamento; $i++) /* Vai repetir o número de agrupamentos, por exemplo, se houver 10 agrupamentos vai repetir 10 vezes */
										{
											$dados_agrupamento=mysqli_fetch_array($consultar_agrupamento); //Vai buscar os dados dos agrupamentos
											$selectagrupamento.="<option value=\'" . $dados_agrupamento["idagrupamento"] . "\'>" . $dados_agrupamento["nome_agrupamento"] . "</option>"; //Aqui repete as opções até ser todos os agrupamentos existentes
										}
										
										$selectagrupamento.="</select>";
										
										echo "<script>" .
												 "window.addEventListener('load', function()" .
												 "{" .
													 "document.getElementById('zonaconsultar').innerHTML='' +" . //A zona consultar vai receber o formulário para editar
																										"'<div class=\'zonatabela\' id=\'zonatabela\'>' +" . //Início da zona da tabela
																											"'<form name=\'frmEditar\' action=\'#\' method=\'POST\'>' +" . //Início do formulário para editar
																												"'<table class=\'tabela\'>' +" . //Início da tabela
																													"'<thead>' +" . //Início da zona dos cabeçalhos com os títulos das colunas
																														"'<tr>' +" . //Início da linha da tabela
																															"'<th class=\'campotabela\'>Id</th>' +" . //Título dos Ids
																															"'<th class=\'campotabela\'>Escola</th>' +" . //Título das escolas
																															"'<th class=\'campotabela\'>Localização</th>' +" . //Título das localizações
																															"'<th class=\'campotabela\'>Agrupamento</th>' +" . //Título dos agrupamentos
																															"'<th class=\'campotabela\'></th>' +" . //Nesta coluna conterá o botão para editar
																															"'<th class=\'campoultimo\'></th>' +" . //Nesta coluna conterá o botão para eliminar e possui a classe campoultimo porque as medidas são maiores para ficar alinhado com a barra de rolagem
																														"'</tr>' +" . //Fim da linha da tabela
																													"'</thead>' +" . //Fim da zona dos cabeçalhos com os títulos das colunas
																													"'<tbody>' +" . //Início da zona dos dados da tabela
																														"'<tr>' +" . //Início da linha da tabela
																															"'<td class=\'campotabela\'>' +" .
																																"'<label name=\'idescolamostrado\'>" . $dados_escola["idescola"] . "</label>' +" . //Aqui conterá o id da escola visível porém não permite passar via formulário sendo necessário criar a caixa de texto a baixo para puder passar via formulário
																																"'<input type=\'Text\' name=\'idescolaescondidoalterar\' class=\'dadotabela\' id=\'idescolaescondidoalterar\' value=\'" . $dados_escola["idescola"] . "\' style=\'display: none;\'>' +" . //Aqui conterá o id da escola numa caixa de texto para puder mandar via formulário para depois puder fazer a verificação se o id da escola existe para verificar se mandei editar
																															"'</td>' +" .
																															"'<td class=\'campotabela\'><input type=\'Text\' name=\'nome_escola\' class=\'dadotabela\' id=\'nome_escola\' maxlength=\'120\' value=\'" . $dados_escola["nome_escola"] . "\' style=\'width: 120px;\'></td>' +" . //Caixa de texto do nome para puder editá-lo
																															"'<td class=\'campotabela\'><input type=\'Text\' name=\'localizacao\' class=\'dadotabela\' id=\'localizacao\' maxlength=\'120\' value=\'" . $dados_escola["localizacao"] . "\' style=\'width: 120px;\'></td>' +" . //Caixa de texto da localização da escola para puder editá-lo
																															"'<td class=\'campotabela\'>" . $selectagrupamento . "</td>' +" . //Caixa de seleção do agrupamento da escola para puder editá-lo
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
													 "document.getElementById('idagrupamento').value='" . $dados_escola["idagrupamento"] . "';" . //A caixa de seleção do idagrupamento fica com o que já estava selecionado
												 "});" .
											 "</script>";
									}
									elseif($linhas_agrupamento==0) //Se as linhas são 0 significa que não existe ninguém com esse id então:
										{
											header("Location: ?mensagem=O_Id_que_digitou_nao_existe"); //Manda de volta para a página e aparece uma mensagem a dizer que o id que digitou não existe
										}
										elseif($linhas_agrupamento<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
											{
												$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
												header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
											}
											
								}
								else //Se não significa que ocorreu um erro ou na base de dados ou o id que passou é inválido e contém catactéres além de números:
								{
									$_SESSION["mensagemerro"]="Erro ao consultar os agrupamentos, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
							elseif($linhas_escola==0) //Se as linhas são 0 significa que não existe ninguém com esse id então:
								{
									header("Location: ?mensagem=O_Id_que_digitou_nao_existe"); //Manda de volta para a página e aparece uma mensagem a dizer que o id que digitou não existe
								}
								elseif($linhas_escola<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
									{
										$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
										header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
									}
						}
						else //Se não significa que ocorreu um erro ou na base de dados ou o id que passou é inválido e contém catactéres além de números:
						{
							if(!$idinvalido) //Se o id não é inválido então significa que houve algum erro na base de dados então:
							{
								$_SESSION["mensagemerro"]="Erro ao consultar as escolas, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
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
					if(!(isset($_POST["idescolaescondidoeliminar"]))) //Se ainda não confirmei que quero eliminar:
					{
						if(isset($_GET["id"])) //Verifico se o id foi passado para não gerar erros
						{
							if(isset($_SESSION["vista"])) //Se a variável sessão existe então:
							{
								if($_SESSION["vista"]=="E") //Se a vista é de estagiário:
								{
									header("Location: ConsultarEscolas.php"); //Recarrega a página e bloqueia a pesmissão para puder editar dados
								}
							}
							else //Se não:
							{
								if($_SESSION["tipo_utilizador"]=="E") //Se o utilizador é um estagiário então:
								{
									header("Location: ConsultarEscolas.php"); //Recarrega a página e bloqueia a pesmissão para puder editar dados
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
								header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
							
							$consultar_escola=mysqli_query($conexao, "SELECT * FROM escolas WHERE idescola=" . $_GET["id"] . ";"); //Vai buscar a escola que quero eliminar
							if($consultar_escola) //Se não ocorreu nenhum erro:
							{
								$linhas_escola=mysqli_num_rows($consultar_escola); //Obtém o número de escolas com esse id
								if($linhas_escola>0) //Se retornar mais que uma linha, significa que existe pelo menos uma escola então:
								{
									if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se estava uma pesquisa específica
									{
										if(isset($_GET["ordenadopor"])) //Se estava ordenado
										{
											$codigobtnnao="document.getElementById('btnnao').addEventListener('click', function(e)" . //Quando clicar no botão não:
														  "{" .
														      "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar a escola pois o que quer-se é cancelar e não eliminar
															  "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado e com o que estava ordenado
														  "});";
										}
										else //Se não
										{
											$codigobtnnao="document.getElementById('btnnao').addEventListener('click', function(e)" . //Quando clicar no botão não:
														  "{" .
															  "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar a escola pois o que quer-se é cancelar e não eliminar
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
														      "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar a escola pois o que quer-se é cancelar e não eliminar
															  "location.href='?ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava ordenado
														  "});";
										}
										else //Se não
										{
											$codigobtnnao="document.getElementById('btnnao').addEventListener('click', function(e)" . //Quando clicar no botão não:
														  "{" .
															  "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar a escola pois o que quer-se é cancelar e não eliminar
															  "location.href='ConsultarEscolas.php';" . //Manda de volta para a página que estava
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
																	"'<input type=\'Text\' name=\'idescolaescondidoeliminar\' class=\'dadotabela\' id=\'idescolaescondidoeliminar\' value=\'" . $_GET["id"] . "\' style=\'display: none;\'>' +" . //Mete o id da escola escondido para depois poder verificar se mandei mesmo eliminar
																	"'<input type=\'Submit\' name=\'btnsimescondido\' id=\'btnsimescondido\' style=\'display: None;\'>' +" . //Botão do formulário escondido porque haverá outro visível com um visual melhor para mandar eliminar a escola
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
								elseif($linhas_escola==0) //Se não se as linhas são 0, significa que não existe ninguém com esse id então:
									{
										header("Location: ?mensagem=O_Id_que_digitou_nao_existe"); //Recarrega a página passando uma mensagem a dizer que o id que digitou não existe
									}
									elseif($linhas_escola<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
										{
											$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
							}
							else //Se não significa que houve um erro ou na base de dados ou o id é inválido:
							{
								if(!$idinvalido) //Se o id não é inválido então:
								{
									$_SESSION["mensagemerro"]="Erro ao consultar as escolas, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
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
			
			if(isset($_POST["idescolaescondidoalterar"])) //Se mandei alterar os dados e já confirmei então:
			{
				//Retira os espaços em branco (trim) de trás e da frente, por exemplo, "          Dado          " passa para "Dado"
				$idescola=trim($_GET["id"]); //Esta variável é enviada por via GET em vez de ser enviada por via POST por proteção de dados e para evitar erros
				$nome_escola=trim($_POST["nome_escola"]);
				$localizacao=trim($_POST["localizacao"]);
				$idagrupamento=trim($_POST["idagrupamento"]);
				
				//Mete as variáveis a falso
				$erro=false;
				
				//Nota: Isto é uma função, significa que o código só é executado quando eu chamar a função
				echo "<script>" .
						 //Cria uma função de Validação cujo os parâmetros serão o campo com erro e a mensagem de erro com o objetivo se simplificar e minimizar o código
						 "function Validacao(campo, mensagem)" .
						 "{" .
							 "document.getElementById('nome_escola').value='" . $nome_escola . "';" . //A caixa de texto do nome da escola volta a ter o que estava lá escrito
							 "document.getElementById('localizacao').value='" . $localizacao . "';" . //A caixa de texto da localização volta a ter o que estava lá escrito
							 "document.getElementById('idagrupamento').value='" . $idagrupamento . "';" . //A caixa de seleção do id do agrupamento volta a ter o que estava lá selecionado
							 
							 "document.getElementById('erro').innerHTML+=mensagem + '<br><br>';" . //A zona de erro recebe a mensagem de erro
							 "document.getElementById(campo).style.borderColor='red';" . //As bordas das caixas com erro ficam a vermelho
						 "}" .
					 "</script>";
				
				
				if($nome_escola=="") //Se o nome da escola está vazio vai aparecer uma mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('nome_escola', 'O nome da escola não foi preenchido.');" . //Usa a função acima que criei indicando o campo com erro (nome da escola) e a mensagem de erro (O nome da escola não foi preenchido)
							 "});" .
						 "</script>";
					
					$erro=true; //A variável que indica o erro fica verdadeiro
				}
				else
				{
					include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
					
					$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
					if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
					{
						$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
						
					$consultar_nome=mysqli_query($conexao, "SELECT * FROM escolas WHERE nome_escola='" . $nome_escola . "';"); //Verifica se já existe alguma escola com este nome
					if($consultar_nome) //Se não ocorreu nenhum erro:
					{
						$linhas_nome=mysqli_num_rows($consultar_nome); //Obtém o número de escolas com esse nome
						if($linhas_nome==1) //Se retornar uma linha significa que já existe uma escola com esse nome
						{
							$consultar_nome_antigo=mysqli_query($conexao, "SELECT * FROM escolas WHERE idescola=" . $idescola . ";"); //Vai buscar o nome antigo à base de dados
							if($consultar_nome_antigo) //Se não ocorreu nenhum erro:
							{
								$linhas_nome_antigo=mysqli_num_rows($consultar_nome_antigo); //Obtém o número de escolas com esse nome
								if($linhas_nome_antigo==1) //Se retornar uma linha significa que a pesquisa foi bem feita
								{
									$dados_nome=mysqli_fetch_array($consultar_nome); //Recebe os dados da escola com esse nome
									$dados_nome_antigo=mysqli_fetch_array($consultar_nome_antigo); //Recebe os dados da escola que mandei editar
									
									if($dados_nome["nome_escola"]!=$dados_nome_antigo["nome_escola"]) //Se o nome que digitei existe e não é o nome antigo que tinha então:
									{
										echo "<script>" .
												 "window.addEventListener('load', function()" .
												 "{" .
													 "Validacao('nome_escola', 'O nome da escola que introduziu já existe.');" . //Usa a função acima que criei indicando o campo com erro (nome_escola) e a mensagem de erro (O nome da escola que introduziu já existe)
												 "});" .
											 "</script>";
										
										$erro=true; //A variável que indica o erro fica verdadeiro
									}
								}
								elseif($linhas_nome_antigo==0) //Se não se retornar 0 linhas, significa que houve algum erro a procurar o nome antigo então:
									{
										$_SESSION["mensagemerro"]="Erro a procurar o nome antigo, por favor informe o administrador."; //Passa a mensagem de erro
										header("Location: ConsultarEscolas.php");  //Recarrega a página passando o erro para abrir o modal de erro
									}
									elseif($linhas_nome_antigo>1) //Se não se retornar mais que uma linha, significa que existe 2 escolas com esse nome um escola não pode ter um nome que já existe então:
										{
											$_SESSION["mensagemerro"]="Erro. O nome antigo existe mais que uma vez na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarEscolas.php");  //Recarrega a página passando o erro para abrir o modal de erro
										}
										elseif($linhas_nome_antigo<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
											{
												$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
												header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
											}
							}
							else //Se não:
							{
								$_SESSION["mensagemerro"]="Erro ao consultar se o nome da escola antigo já existe, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
						elseif($linhas_nome>1) //Se não se retornar mais que uma linha, significa que existe 2 escolas com esse nome na base de dados que não se pode repetir então:
							{
								$_SESSION["mensagemerro"]="Erro. O nome da escola que introduziu existe mais que uma vez na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarEscolas.php");  //Recarrega a página passando o erro para abrir o modal de erro
							}
							elseif($linhas_nome<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
								{
									$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
					}
					else //Se não:
					{
						$_SESSION["mensagemerro"]="Erro ao consultar se o nome da escola já existe, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
				
				if($localizacao=="") //Se a localização está vazia vai aparecer uma mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('localizacao', 'A localização não foi preenchida.');" . //Usa a função acima que criei indicando o campo com erro (localizacao) e a mensagem de erro (A localização não foi preenchida)
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
						header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
					
					$editar_nome_escola=mysqli_query($conexao, "UPDATE escolas SET nome_escola='" . $nome_escola . "' WHERE idescola=" . $idescola . ";"); //Edita o campo nome da escola
					if($editar_nome_escola) //Se não ocorreu nenhum erro:
					{	
						$editar_localizacao=mysqli_query($conexao, "UPDATE escolas SET localizacao='" . $localizacao . "' WHERE idescola=" . $idescola . ";"); //Edita o campo localização
						if($editar_localizacao) //Se não ocorreu nenhum erro:
						{	
							$editar_agrupamento=mysqli_query($conexao, "UPDATE escolas SET idagrupamento='" . $idagrupamento . "' WHERE idescola=" . $idescola . ";"); //Edita o campo agrupamento
							if($editar_agrupamento) //Se não ocorreu nenhum erro:
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
								$_SESSION["mensagemerro"]="Erro ao alterar o agrupamento, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
						else //Se não:
						{
							$_SESSION["mensagemerro"]="Erro ao alterar a localização, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
					}
					else //Se não:
					{
						$_SESSION["mensagemerro"]="Erro ao alterar o nome da escola, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
			}
			
			if(isset($_POST["idescolaescondidoeliminar"])) //Se mandei eliminar e selecionei a opção sim então:
			{
				$idescola=$_GET["id"]; //Recebe o id da escola que quero eliminar
				
				include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
					
				$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
				if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
				{
					$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
				
				$eliminar_escola=mysqli_query($conexao, "DELETE FROM escolas WHERE idescola=" . $idescola . ";"); //Elimina a escola
				if($eliminar_escola) //Se a escola foi eliminado com sucesso
				{
					$_SESSION["editado_eliminado"]=true; //A variável editado_eliminado fica verdadeiro para assim não fazer a verificação para recarregar a página e não houver erro de duplicação de dados
					
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Modal('certo', 'Escola eliminada com sucesso.');" . //Abre o modal de certo para informar ao utilizador que foi eliminado com sucesso
							 "});" .
						 "</script>";
				}
				else //Se não:
				{
					$_SESSION["mensagemerro"]="Erro ao eliminar a escola, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
			}
		}
		else //Se não significa que já cliquei no botão para editar ou para eliminar e vai fazer o seguinte:
		{ //Se não fizer essa verificação quando recarregar a página iria gerar o erros
			unset($_SESSION["editado_eliminado"]); //Elimina a variável
			header("Location: ConsultarEscolas.php"); //Recarrega a página e volta para a página de Consultar Escolas
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
				width: 941px; /* A tabela fica com 941px de comprimento, ((185px*5 campos)+16)=941px */
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
						location.href="ConsultarEscolas.php"; //Recarrega a página
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
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma escola então:
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
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma escola então:
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
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma escola então:
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
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma escola então:
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
								 header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro;
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
				<li class="ativo"><a href="#" id="escolas">Escolas</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar escolas -->
				<li><a href="#" id="blocos">Blocos</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar blocos -->
				<li><a href="#" id="salas">Salas</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar salas -->
				<li><a href="#" id="equipamentos">Equipamentos</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar equipamentos -->
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
					header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
				
				if((isset($_GET["pesquisa"])) AND (isset($_GET["campo"]))) //Se foi mandada uma pesquisa específica então:
				{
					if($_GET["campo"]!="O_campo_que_digitou_e_invalido") //Se o campo que foi digitado não é inválido então:
					{
						if(isset($_GET["ordenadopor"])) //Se a ordenação existe então:
						{
							if($_GET["ordenadopor"]!="A_ordenacao_que_digitou_e_invalida") //Se a ordenação que foi digitado não é inválida então:
							{
								//Pesquisa na base de dados as escolas da pesquisa específica com a ordenação
								$consultar_escolas=mysqli_query($conexao, "SELECT * FROM agrupamentos a, escolas e WHERE a.idagrupamento=e.idagrupamento AND " . $_GET["campo"] . " LIKE '%" . $_GET["pesquisa"] . "%' ORDER BY " . $_GET["ordenadopor"] . ";");
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma escola então:
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
								//Pesquisa na base de dados as escolas da pesquisa específica
								$consultar_escolas=mysqli_query($conexao, "SELECT * FROM agrupamentos a, escolas e WHERE a.idagrupamento=e.idagrupamento AND " . $_GET["campo"] . " LIKE '%" . $_GET["pesquisa"] . "%' ORDER BY idescola;");
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma escola então:
														"{" .
															"document.getElementById('pesquisar').value='" . $_GET["pesquisa"] . "';" .
															"document.getElementById('selectpesquisar').value='" . $_GET["campo"] . "';" .
															"document.getElementById('selectordenar').value='idescola';" .
														"}" .
													"});" .
												"</script>";
							}
						}
						else //Se não:
						{
							//Pesquisa na base de dados as escolas da pesquisa específica
							$consultar_escolas=mysqli_query($conexao, "SELECT * FROM agrupamentos a, escolas e WHERE a.idagrupamento=e.idagrupamento AND " . $_GET["campo"] . " LIKE '%" . $_GET["pesquisa"] . "%' ORDER BY idescola;");
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma escola então:
													"{" .
														"document.getElementById('pesquisar').value='" . $_GET["pesquisa"] . "';" .
														"document.getElementById('selectpesquisar').value='" . $_GET["campo"] . "';" .
														"document.getElementById('selectordenar').value='idescola';" .
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
								//Pesquisa na base de dados as escolas com a ordenação
								$consultar_escolas=mysqli_query($conexao, "SELECT * FROM agrupamentos a, escolas e WHERE a.idagrupamento=e.idagrupamento ORDER BY " . $_GET["ordenadopor"] . ";");
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma escola então:
														"{" .
															"document.getElementById('selectpesquisar').value='idescola';" .
															"document.getElementById('selectordenar').value='" . $_GET["ordenadopor"] . "';" .
														"}" .
													"});" .
												"</script>";
							}
							else //Se não:
							{
								//Pesquisa na base de dados as escolas
								$consultar_escolas=mysqli_query($conexao, "SELECT * FROM agrupamentos a, escolas e WHERE a.idagrupamento=e.idagrupamento ORDER BY idescola;");
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma escola então:
														"{" .
															"document.getElementById('selectpesquisar').value='idescola';" .
															"document.getElementById('selectordenar').value='idescola';" .
														"}" .
													"});" .
												"</script>";
							}
						}
						else //Se não:
						{
							//Pesquisa na base de dados as escolas
							$consultar_escolas=mysqli_query($conexao, "SELECT * FROM agrupamentos a, escolas e WHERE a.idagrupamento=e.idagrupamento ORDER BY idescola;");
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma escola então:
													"{" .
														"document.getElementById('selectpesquisar').value='idescola';" .
														"document.getElementById('selectordenar').value='idescola';" .
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
							//Pesquisa na base de dados as escolas com a ordenação
							$consultar_escolas=mysqli_query($conexao, "SELECT * FROM agrupamentos a, escolas e WHERE a.idagrupamento=e.idagrupamento ORDER BY " . $_GET["ordenadopor"] . ";");
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma escola então:
													"{" .
														"document.getElementById('selectpesquisar').value='idescola';" .
														"document.getElementById('selectordenar').value='" . $_GET["ordenadopor"] . "';" .
													"}" .
												"});" .
											 "</script>";
						}
						else //Se não:
						{
							//Pesquisa na base de dados as escolas
							$consultar_escolas=mysqli_query($conexao, "SELECT * FROM agrupamentos a, escolas e WHERE a.idagrupamento=e.idagrupamento ORDER BY idescola;");
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma escola então:
													"{" .
														"document.getElementById('selectpesquisar').value='idescola';" .
														"document.getElementById('selectordenar').value='idescola';" .
													"}" .
												"});" .
											"</script>";
						}
					}
					else //Se não:
					{
						//Pesquisa na base de dados as escolas
						$consultar_escolas=mysqli_query($conexao, "SELECT * FROM agrupamentos a, escolas e WHERE a.idagrupamento=e.idagrupamento ORDER BY idescola;");
						
						//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
						$preselecionado="<script>" .
											"window.addEventListener('load', function()" .
											"{" .
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar alguma escola então:
												"{" .
													"document.getElementById('selectpesquisar').value='idescola';" .
													"document.getElementById('selectordenar').value='idescola';" .
												"}" .
											"});" .
										"</script>";
					}
				}
				
				if($consultar_escolas) //Se não ocorreu nenhum erro:
				{
					$linhas_escolas=mysqli_num_rows($consultar_escolas); //Obtém o número de escolas
					if($linhas_escolas>0) //Se retornar mais que uma linha, significa que existe pelo menos uma escola então:
					{
			echo "<a class='btnpesquisar' id='btnpesquisar' href='#'></a>"; //Botão de pesquisa específica
			echo "<input type='Text' name='pesquisar' class='pesquisar' id='pesquisar' placeholder='Introduza o que quer pesquisar' title='Introduza o que quer pesquisar'>"; //Caixa de texto da pesquisa específica
			echo "<select name='selectpesquisar' class='selectpesquisar' id='selectpesquisar'>"; //Caixa de seleção da pesquisa específica
				echo "<option value='idescola'>Id</option>";
				echo "<option value='nome_escola'>Escola</option>";
				echo "<option value='localizacao'>Localização</option>";
				echo "<option value='nome_agrupamento'>Agrupamento</option>";
			echo "</select>";
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<label class='textoordenar' id='textoordenar'>Ordernar por:</label>"; //Texto ordenar por
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<select name='selectordenar' class='selectordenar' id='selectordenar'>"; //Caixa de seleção de ordenação
				echo "<option value='idescola'>Id (Crescente)</option>";
				echo "<option value='idescola DESC'>Id (Decrescente)</option>";
				echo "<option value='nome_escola'>Escola (Crescente)</option>";
				echo "<option value='nome_escola DESC'>Escola (Descrescente)</option>";
				echo "<option value='localizacao'>Localização (Crescente)</option>";
				echo "<option value='localizacao DESC'>Localização (Decrescente)</option>";
				echo "<option value='nome_agrupamento'>Agrupamento (Crescente)</option>";
				echo "<option value='nome_agrupamento DESC'>Agrupamento (Descrescente)</option>";
			echo "</select>";
						echo $javascriptpesquisa; //Executa o que está programado para a pesquisa específica
						echo $preselecionado; //Executa o que está programado para o preselecionamento das caixas de seleção e da caixa de texto ter o que já tinha
			echo "<div class='zonatabela' id='zonatabela'>"; //Início da zona da tabela
				echo "<table class='tabela' id='tabela'>"; //Início da tabela
					echo "<thead>"; //Início do cabeçalho da tabela
						echo "<tr>"; //Início da linha da tabela
							echo "<th class='campotabela'>Id</th>";  //Título Id
							echo "<th class='campotabela'>Escola</th>"; //Título Escola
							echo "<th class='campotabela'>Localização</th>"; //Título Localização
							
						if(isset($_SESSION["vista"])) //Se a variável de sessão existe significa que é o tipo de utilizador é um administrador então:
						{
							if($_SESSION["vista"]=="A") //Se a vista é de administrador cria o cabeçalho para os botões então:
							{
							echo "<th class='campotabela'>Agrupamento</th>"; //Título Agrupamento
							echo "<th class='campotabela'></th>";
							echo "<th class='campoultimo'></th>"; //Este campo receberá um comprimento diferente para ficar alinhado com com a barra de rolagem
							}
							elseif($_SESSION["vista"]=="E") //Se não não mete os cabeçalhos e os botões e define este campo como último
								{
									echo "<script>" .
											 "window.addEventListener('load', function()" .
											 "{" .
												"document.getElementById('tabela').style.width='750px';" . //Dimiui o tamanho da tabela
											 "});" .
										 "</script>";
									
							echo "<th class='campoultimo'>Agrupamento</th>"; //Título Agrupamento
								}
						}
						else //Se não não mete os cabeçalhos e os botões e define este campo como último
						{
							echo "<script>" .
									 "window.addEventListener('load', function()" .
									 "{" .
										"document.getElementById('tabela').style.width='750px';" . //Dimiui o tamanho da tabela
									 "});" .
								 "</script>";
							
							echo "<th class='campoultimo'>Agrupamento</th>"; //Título Agrupamento
						}
							
						echo "</tr>";//Fim da linha da tabela
					echo "</thead>"; //Fim do cabeçalho da tabela
					echo "<tbody>"; //Início dos campos da tabela
						for($i=0; $i<$linhas_escolas; $i++) //Vai repetir o número de escolas, por exemplo, se existir 10 escolas repete 10 vezes
						{
							$dados_escolas=mysqli_fetch_array($consultar_escolas); //Recebe os dados de cada escola
							
							//Este if, o else e tudo dentro é para definir o link de editar e eliminar para depois, por exemplo, se fiz mandei eliminar e quero cancelar vou voltar para essa página com a pesquisa específica em vez de voltar para a página original
							if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se já havia uma pesquisa específica então:
							{
								if(isset($_GET["ordenadopor"])) //Se já existia uma ordenação então:
								{
									$linkeditar="?acao=editar&id=" . $dados_escolas["idescola"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] ."&ordenadopor=" . $_GET["ordenadopor"];
									$linkeliminar="?acao=eliminar&id=" . $dados_escolas["idescola"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] ."&ordenadopor=" . $_GET["ordenadopor"];
								}
								else //Se não:
								{
									$linkeditar="?acao=editar&id=" . $dados_escolas["idescola"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"];
									$linkeliminar="?acao=eliminar&id=" . $dados_escolas["idescola"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"];
								}
							}
							else //Se não:
							{
								if(isset($_GET["ordenadopor"]))
								{
									$linkeditar="?acao=editar&id=" . $dados_escolas["idescola"] . "&ordenadopor=" . $_GET["ordenadopor"];
									$linkeliminar="?acao=eliminar&id=" . $dados_escolas["idescola"] . "&ordenadopor=" . $_GET["ordenadopor"];
								}
								else  //Se não:
								{
									$linkeditar="?acao=editar&id=" . $dados_escolas["idescola"];
									$linkeliminar="?acao=eliminar&id=" . $dados_escolas["idescola"];
								}
							}
							
						echo "<tr>"; //Início da linha da tabela
							echo "<td>" . $dados_escolas["idescola"] . "</td>" ; //Aqui vai aparecer o id da escola
							echo "<td>" . $dados_escolas["nome_escola"] . "</td>"; //Aqui vai aparecer o nome da escola
							echo "<td>" . $dados_escolas["localizacao"] . "</td>"; //Aqui vai aparecer a localização da escola
							echo "<td><a href='ConsultarAgrupamentos.php?pesquisa=" . $dados_escolas["idagrupamento"] . "&campo=idagrupamento' style='color: Black;'>" . $dados_escolas["nome_agrupamento"] . "</a></td>"; //Aqui vai aparecer o nome do agrupamento e se clicar ele redirecionar-me-à para a página de consultar esse agrupamento em específico
							
							if(isset($_SESSION["vista"])) //Se a variável de sessão existe significa que é o tipo de utilizador é um administrador então:
							{
								if($_SESSION["vista"]=="A") //Se a vista é de administrador cria o botão de editar e eliminar então
								{
							echo "<td><div align='Center'><a href='" . $linkeditar . "'><i class='fa fa-pencil' style='color: Black;'></i></a></div></td>"; //Botão para editar os dados
							echo "<td><div align='Center'><a href='" . $linkeliminar . "'><i class='fa fa-close' style='color: Black;'></i></a></div></td>"; //Botão para eliminar os dados
								}
							}
							
						echo "</tr>"; //Fim da linha
						}
					echo "</tbody>"; //Fim dos campos da tabela
				echo "</table>"; //Fim da tabela
			echo "</div>"; //Fim da zona da tabela
					}
					elseif($linhas_escolas==0) //Se não se retornar 0 linhas, significa que não existe nenhuma escola preenchida então:
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
																									"'<option value=\'idescola\'>Id</option>' +" .
																									"'<option value=\'nome_escola\'>Escola</option>' +" .
																									"'<option value=\'localizacao\'>Localização</option>' +" .
																									"'<option value=\'nome_agrupamento\'>Agrupamento</option>' +" .
																								"'</select>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<label class=\'textoordenar\' id=\'textoordenar\'>Ordernar por:</label>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<select name=\'selectordenar\' class=\'selectordenar\' id=\'selectordenar\'>' +" .
																									"'<option value=\'idescola\'>Id (Crescente)</option>' +" .
																									"'<option value=\'idescola DESC\'>Id (Decrescente)</option>' +" .
																									"'<option value=\'nome_escola\'>Escola (Crescente)</option>' +" .
																									"'<option value=\'nome_escola DESC\'>Escola (Descrescente)</option>' +" .
																									"'<option value=\'localizacao\'>Localização (Crescente)</option>' +" .
																									"'<option value=\'localizacao DESC\'>Localização (Decrescente)</option>' +" .
																									"'<option value=\'nome_agrupamento\'>Agrupamento (Crescente)</option>' +" .
																									"'<option value=\'nome_agrupamento DESC\'>Agrupamento (Descrescente)</option>' +" .
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
												 "location.href='ConsultarEscolas.php';" . //Volta para a página original
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
									if($_SESSION["vista"]=="A") //Se a vista é de administrador então pode ser redirecionado para a página de inserir escolas:
									{
										echo "<script>" .
												 "window.addEventListener('load', function()" .
												 "{" .
													 "var segundos=5;" . //Variável que vai conter os segundos
													 
													 "Modal('escola', 'Sem escolas inseridas.');" . //Abre o Modal de que ainda não foi inserido nada
													 
													 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir escolas dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página de inserir escolas dentro de 5 segundos
													 "document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
													 
													 "setTimeout(function()" . //Ao fim de 6 segundos acontecerá:
													 "{" .
														 "location.href='InserirEscolas.php';" . //Redireciona para a página de inserir escolas
													 "}, 6000);" .
													 
													 "setInterval(function()" . //De 1 em 1 segundo:
													 "{" .
														 "if(segundos==1)" . //Se falta 1 segundo então vai meter a palavra segundos no singular
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir escolas dentro de ' + segundos + ' segundo.';" .
															 "segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
														 "}" .
														 "else" .
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir escolas dentro de ' + segundos + ' segundos.';" .
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
													 
													 "Modal('escola', 'Sem escolas inseridas, por favor informe o administrador.');" . //Abre o Modal de que ainda não foi inserido nada
													 
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
									if($_SESSION["tipo_utilizador"]=="A") //Se o tipo de utilizador é de administrador então pode ser redirecionado para a página de inserir escolas:
									{
										echo "<script>" .
												 "window.addEventListener('load', function()" .
												 "{" .
													 "var segundos=5;" . //Variável que vai conter os segundos
													 
													 "Modal('escola', 'Sem escolas inseridas.');" . //Abre o Modal de que ainda não foi inserido nada
													 
													 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir escolas dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página de inserir escolas dentro de 5 segundos
													 "document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
													 
													 "setTimeout(function()" . //Ao fim de 6 segundos acontecerá:
													 "{" .
														 "location.href='InserirEscolas.php';" . //Redireciona para a página de inserir escolas
													 "}, 6000);" .
													 
													 "setInterval(function()" . //De 1 em 1 segundo:
													 "{" .
														 "if(segundos==1)" . //Se falta 1 segundo então vai meter a palavra segundos no singular
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir escolas dentro de ' + segundos + ' segundo.';" .
															 "segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
														 "}" .
														 "else" .
														 "{" .
															 "document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir escolas dentro de ' + segundos + ' segundos.';" .
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
													 
													 "Modal('escola', 'Sem escolas inseridas, por favor informe o administrador.');" . //Abre o Modal de que ainda não foi inserido nada
													 
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
						elseif($linhas_escolas<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
							{
								$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
				}
				else //Se não, se ocorreu um erro:
				{
					if((isset($_GET["pesquisa"])) AND (isset($_GET["campo"]))) //Se foi feita uma pesquisa específica:
					{
						if(isset($_GET["ordenadopor"])) //Se foi feita uma ordenação então:
						{
							//Se o campo digitado não for nenhum válido
							if(($_GET["campo"]!="idescola") AND ($_GET["campo"]!="nome_escola") AND ($_GET["campo"]!="localizacao") AND ($_GET["campo"]!="nome_agrupamento"))
							{
								//se a ordenação digitada não for nenhum válido
								if(($_GET["ordenadopor"]!="idescola") AND ($_GET["ordenadopor"]!="idescola DESC") AND ($_GET["ordenadopor"]!="nome_escola") AND ($_GET["ordenadopor"]!="nome_escola DESC") AND ($_GET["ordenadopor"]!="localizacao") AND ($_GET["ordenadopor"]!="localizacao DESC") AND ($_GET["ordenadopor"]!="nome_agrupamento") AND ($_GET["ordenadopor"]!="nome_agrupamento DESC"))
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
								if(($_GET["ordenadopor"]!="idescola") AND ($_GET["ordenadopor"]!="idescola DESC") AND ($_GET["ordenadopor"]!="nome_escola") AND ($_GET["ordenadopor"]!="nome_escola DESC") AND ($_GET["ordenadopor"]!="localizacao") AND ($_GET["ordenadopor"]!="localizacao DESC") AND ($_GET["ordenadopor"]!="nome_agrupamento") AND ($_GET["ordenadopor"]!="nome_agrupamento DESC"))
								{
									//Recarrega a página e mensagem a avisar que a ordenação que digitou é inválida
									header("Location: ?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=A_ordenacao_que_digitou_e_invalida");
								}
								else //Se não:
								{
									$_SESSION["mensagemerro"]="Erro ao consultar as escolas, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
						}
						else //Se não
						{
							//Se o campo é inválido
							if(($_GET["campo"]!="idescola") AND ($_GET["campo"]!="nome_escola") AND ($_GET["campo"]!="localizacao") AND ($_GET["campo"]!="nome_agrupamento"))
							{
								//Recarrega a página e mensagem a avisar que o campo que digitou é inválido
								header("Location: ?pesquisa=" . $_GET["pesquisa"] . "&campo=O_campo_que_digitou_e_invalido");
							}
							else //Se não
							{
								$_SESSION["mensagemerro"]="Erro ao consultar as escolas, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
					}
					else //Se não
					{
						if(isset($_GET["ordenadopor"])) //Se foi feita uma ordenação:
						{
							//Se o ordenar é inválido:
							if(($_GET["ordenadopor"]!="idescola") AND ($_GET["ordenadopor"]!="idescola DESC") AND ($_GET["ordenadopor"]!="nome_escola") AND ($_GET["ordenadopor"]!="nome_escola DESC") AND ($_GET["ordenadopor"]!="localizacao") AND ($_GET["ordenadopor"]!="localizacao DESC") AND ($_GET["ordenadopor"]!="nome_agrupamento") AND ($_GET["ordenadopor"]!="nome_agrupamento DESC"))	
							{
								//Recarrega a página e mensagem a avisar que a ordenação que digitou é inválida
								header("Location: ?ordenadopor=A_ordenacao_que_digitou_e_invalida");
							}
							else //Se nao
							{
								$_SESSION["mensagemerro"]="Erro ao consultar as escolas, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
						else //Se nao
						{
							$_SESSION["mensagemerro"]="Erro ao consultar as escolas, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarEscolas.php"); //Recarrega a página passando o erro para abrir o modal de erro
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