<!-- Começar a explicar a partir do HTML e só depois voltar aqui para cima -->
<!-- Inicio dos códigos PHP -->
<?php
	include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
	
	session_start(); //Inicia a sessão para puder fazer a verificação se estou logado ou não, sempre que preciso de usar alguma variável da session tenho que obrigatoriamente começar por esse código
	
	if(!isset($_SESSION["idutilizador"])) //Se o id do utilizador não exite:
	{
		$_SESSION["pagina"]="ConsultarUtilizadores.php"; //Variável que indica que página eu pretendia entrar para assim que fizer o login redirecionar-me de volta para esta página
		header("Location: Login.php"); //Manda para a página do Login por se o id do utilizador não existe significa que não efetoou o login
	}
	
	if(isset($_POST["selectvista"])) //Se mandei alterar a vista então:
	{
		$_SESSION["vista"]=$_POST["selectvista"]; //A variável de sessão recebe a opção que selecionei
		header("Location: ConsultarUtilizadores.php"); //Recarrega a página para a vista
	}
	
	//Ideia de redirecionar-me para a página que queria sem sucesso
	if((!($_SESSION["tipo_utilizador"]=="A")) OR (!($_SESSION["vista"]=="A"))) //Se o utilizador não é administrador:
	{
		if($_SESSION["pagina"]=="ConsultarUtilizadores.php") //Se a página que estiver for a ConsultarUtilizadores.php, significa que provavelmente tinha tentado entrar nesta página mas redirecionou-me para a página de login por ainda não ter sessão inciada aí fiz o login mas a conta aonde estou não contêm permissões de administrador então:
		{
			header("Location: Inicio.php"); //Manda para a página do início porque esta página é só para os administradores
		}
		else //Se não:
		{
			header("Location: " . $_SESSION["pagina"]); //Manda para a página que estava antes porque esta página é só para os administradores
		}
	}
	//Ideia de redirecionar-me para a página que queria sem sucesso
	
	$_SESSION["pagina"]="ConsultarUtilizadores.php"; //Variável que indica que página eu estou para que assim que entre numa página que não contenha permissão redirecione-me de volta a esta página aonde estava antes
	
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
							header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
						
						$consultar_utilizador=mysqli_query($conexao, "SELECT * FROM utilizadores WHERE idutilizador=" . $_GET["id"] . ";"); //Vai buscar o utilizador que quero editar
						if($consultar_utilizador) //Se não ocorreu nenhum erro:
						{
							$linhas_utilizador=mysqli_num_rows($consultar_utilizador); //Obtém o número de utilizadores com esse id
							if($linhas_utilizador>0) //Se retornar mais que uma linha, significa que existe pelo menos um utilizador então:
							{
								$dados_utilizador=mysqli_fetch_array($consultar_utilizador); //Vai buscar os dados do utilizador que quero editar
								
								if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se estava uma pesquisa específica
								{
									if(isset($_GET["ordenadopor"])) //Se estava ordenado
									{
										$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão cancelar:
														   "{" .
														       "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar o utilizador pois o que quer-se é cancelar e não editar
															   "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado e com o que estava ordenado
														   "});";
									}
									else //Se não
									{
										$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão cancelar:
														   "{" .
															   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar o utilizador pois o que quer-se é cancelar e não editar
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
															   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar o utilizador pois o que quer-se é cancelar e não editar
															   "location.href='?ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava ordenado
														   "});";
									}
									else //Se não
									{
										$codigobtncancelar="document.getElementById('btncancelar').addEventListener('click', function(e)" . //Quando clicar no botão cancelar:
														   "{" .
															   "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar editar o utilizador pois o que quer-se é cancelar e não editar
															   "location.href='ConsultarUtilizadores.php';" . //Manda de volta para a página que estava
														   "});";
									}
								}
								
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
																													"'<th class=\'campotabela\'>Nome</th>' +" . //Título dos nomes
																													"'<th class=\'campotabela\'>Email</th>' +" . //Título dos emails
																													"'<th class=\'campotabela\'>Cargo</th>' +" . //Título dos cargos
																													"'<th class=\'campotabela\'>Tipo de utilizador</th>' +" . //Título dos tipos de utilizador
																													"'<th class=\'campotabela\'></th>' +" . //Nesta coluna conterá o botão para editar
																													"'<th class=\'campoultimo\'></th>' +" . //Nesta coluna conterá o botão para eliminar e possui a classe campoultimo porque as medidas são maiores para ficar alinhado com a barra de rolagem
																												"'</tr>' +" . //Fim da linha da tabela
																											"'</thead>' +" . //Fim da zona dos cabeçalhos com os títulos das colunas
																											"'<tbody>' +" . //Início da zona dos dados da tabela
																												"'<tr>' +" . //Início da linha da tabela
																													"'<td class=\'campotabela\'>' +" .
																													    "'<label name=\'idutilizadormostrado\'>" . $dados_utilizador["idutilizador"] . "</label>' +" . //Aqui conterá o id do utilizador visível porém não permite passar via formulário sendo necessário criar a caixa de texto a baixo para puder passar via formulário
																														"'<input type=\'Text\' name=\'idutilizadorescondidoalterar\' class=\'dadotabela\' id=\'idutilizadorescondidoalterar\' value=\'" . $dados_utilizador["idutilizador"] . "\' style=\'display: none;\'>' +" . //Aqui conterá o id do utilizador numa caixa de texto para puder mandar via formulário para depois puder fazer a verificação se o id do utilizador existe para verificar se mandei editar
																													"'</td>' +" .
																													"'<td class=\'campotabela\'><input type=\'Text\' name=\'nome_utilizador\' class=\'dadotabela\' id=\'nome_utilizador\' maxlength=\'120\' value=\'" . $dados_utilizador["nome_utilizador"] . "\' style=\'width: 120px;\'></td>' +" . //Caixa de texto do nome para puder editá-lo
																													"'<td class=\'campotabela\'><input type=\'Text\' name=\'email\' class=\'dadotabela\' id=\'email\' maxlength=\'120\' value=\'" . $dados_utilizador["email"] . "\' style=\'width: 120px;\'></td>' +" . //Caixa de texto do email para puder editá-lo
																													"'<td class=\'campotabela\'><input type=\'Text\' name=\'cargo_utilizador\' class=\'dadotabela\' id=\'cargo_utilizador\' maxlength=\'120\' value=\'" . $dados_utilizador["cargo_utilizador"] . "\' style=\'width: 120px;\'></td>' +" . //Caixa de texto do cargo para puder editá-lo
																													"'<td class=\'campotabela\'>' +" .
																														"'<select name=\'tipo_utilizador\' class=\'dadotabela\' id=\'tipo_utilizador\'>' +" . //Caixa de seleção do tipo de utilizador
																															"'<option value=\'A\'>Administrador</option>' +" .
																															"'<option value=\'E\'>Estagiário</option>' +" .
																															"'<option value=\'N\'>Normal</option>' +" .
																														"'</select>' +" .
																													"'</td>' +" .
																													"'<td class=\'campotabela\'><div align=\'Center\'><input type=\'Submit\' name=\'btneditar\' class=\'btntabela\' id=\'btneditar\' value=\'Confirmar\'></div></td>' +" . //Botão para confirmar a edição
																													"'<td class=\'campotabela\'><div align=\'Center\'><button class=\'btntabela\' id=\'btncancelar\'>Cancelar</button></div></td>' +" . //Botão para cancelar a edição
																												"'</tr>' +" . //Fim da linha da tabela
																											"'</tbody>' +" . //Fim da zona dos dados da tabela
																										"'</table>' +" . //Fim da tabela
																										"'<label id=\'erro\' style=\'color: Red;\'></label>' +" . //Aqui conterá os erros de validações como por exemplo email já existe ou email inválido ou nome tem números e não pode conter números ou outro erro que apareça
																										"'<label>Mudar a palavra-passe?</label> <a class=\'link\' id=\'alterarpass\'>Clique aqui.</a>' +" . //Aqui aparece uma mensagem a perguntar se quero mudar a palavra passe
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
											 
											 "document.getElementById('alterarpass').addEventListener('click', function()" . //Se mandei alterar a palavra passe
											 "{" .
												 "document.getElementById('zonabtnmodal').innerHTML='<br><button class=\'btnmetade\' id=\'btncancelarconsultar\'>Cancelar</button> <button class=\'btnmetade\' id=\'btncontinuarconsultarmostrado\'>Continuar</button>';" . //Faz aparecer os 2 botões, o de cancelar e o de editar visível com um visual mais bonito
												 
												 "document.getElementById('btncancelarconsultar').style.backgroundColor='#E63946';" . //O botão cancelar fica vermelho
												 
												 "document.getElementById('btncancelarconsultar').addEventListener('mouseover', function()" . //Quando passar com o rato por cima do botão:
												 "{" .
													"document.getElementById('btncancelarconsultar').style.backgroundColor='#DD3C48';" . //O botão cancelar fica com um vermelho mais claro
												 "});" .
												 
												 "document.getElementById('btncancelarconsultar').addEventListener('mouseout', function()" .  //Quando retirar o rato de cima do botão:
												 "{" .
													 "document.getElementById('btncancelarconsultar').style.backgroundColor='#E63946';" . //O botão cancelar volta à cor que tinha
												 "});" .
												 
												 "document.getElementById('btncontinuarconsultarmostrado').style.backgroundColor='#1CEE0E';" . //O botão continuar fica verde
												 
												 "document.getElementById('btncontinuarconsultarmostrado').addEventListener('mouseover', function()" . //Quando passar com o rato por cima do botão:
												 "{" .
													"document.getElementById('btncontinuarconsultarmostrado').style.backgroundColor='##2DAB24';" . //O botão continuar fica com um verde mais claro
												 "});" .
												 
												 "document.getElementById('btncontinuarconsultarmostrado').addEventListener('mouseout', function()" .  //Quando retirar o rato de cima do botão:
												 "{" .
													 "document.getElementById('btncontinuarconsultarmostrado').style.backgroundColor='#1CEE0E';" . //O botão continuar volta à cor que tinha
												 "});" .
												 
												 //Abre o modal de palavra passe e faz com que no modal apareça o formulário para verificar a palavra passe antes de puder alterar porque se não assim qualquer um ia e alterava a palavra passe de todos
												 "Modal('pass', '' +" .
													 "'<form name=\'frmVerificaPass\' action=\'#\' method=\'POST\'>' +" .
														 "'<input type=\'Password\' name=\'passantiga\' class=\'caixatextomodal\' id=\'passantiga\' placeholder=\'Introduza a palavra passe antiga\' title=\'Palavra passe antiga\' maxlength=\'120\' required>' +" . //Caixa de texto para meter a palavra passe para verificar se a palavra passe está certa
														 "'<input type=\'Submit\' name=\'btncontinuarconsultarescondido\' id=\'btncontinuarconsultarescondido\' style=\'display: None;\'>' +" . //Botão do formulário escondido porque haverá outro visível com um visual melhor para mandar verificar se a palavra passe está certa
													 "'</form>'" .
												 ");" .
												 
												 "document.getElementById('btncancelarconsultar').addEventListener('click', function(e)" . //Quando mandar cancelar o mudar palavra passe:
												 "{" .
													 "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar mandar a mudança da palavra passe pois o que quer-se é cancelar e não mudar a palavra passe
													 "document.getElementById('passantiga').value='';" . //Mete a caixa de texto da palavra passe vazia
													 "document.getElementById('zonamodalconsultar').style.display='none';" . //Esconde o modal
												 "});" .
												 
												 "document.getElementById('btncontinuarconsultarmostrado').addEventListener('click', function()" . //Quando clicar no botão de editar visível: 
												 "{" .
													 "document.getElementById('btncontinuarconsultarescondido').click();" . //Faz com que o botão de editar escondido seja clicado para poder verificar se a palavra passe está correta
												 "});" .
											 "});" .
										 "});" .
									 "</script>";
									 
									echo "<script>" .
											 "window.addEventListener('load', function()" .
											 "{" .
												 "document.getElementById('tipo_utilizador').value='" . $dados_utilizador["tipo_utilizador"] . "';" . //A caixa de seleção do tipo de utilizador fica com o que já estava selecionado
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
										header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
									}
						}
						else //Se não significa que ocorreu um erro ou na base de dados ou o id que passou é inválido e contém catactéres além de números:
						{
							if(!$idinvalido) //Se o id não é inválido então significa que houve algum erro na base de dados então:
							{
								$_SESSION["mensagemerro"]="Erro ao consultar os utilizadores, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
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
					if(!(isset($_POST["idutilizadorescondidoeliminar"]))) //Se ainda não confirmei que quero eliminar:
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
								header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
							
							$consultar_utilizador=mysqli_query($conexao, "SELECT * FROM utilizadores WHERE idutilizador=" . $_GET["id"] . ";"); //Vai buscar o utilizador que quero eliminar
							if($consultar_utilizador) //Se não ocorreu nenhum erro:
							{
								$linhas_utilizador=mysqli_num_rows($consultar_utilizador); //Obtém o número de utilizadores com esse id
								if($linhas_utilizador>0) //Se retornar mais que uma linha, significa que existe pelo menos um utilizador então:
								{
									if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se estava uma pesquisa específica
									{
										if(isset($_GET["ordenadopor"])) //Se estava ordenado
										{
											$codigobtnnao="document.getElementById('btnnao').addEventListener('click', function(e)" . //Quando clicar no botão não:
														  "{" .
														      "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar o utilizador pois o que quer-se é cancelar e não eliminar
															  "location.href='?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava pesquisado e com o que estava ordenado
														  "});";
										}
										else //Se não
										{
											$codigobtnnao="document.getElementById('btnnao').addEventListener('click', function(e)" . //Quando clicar no botão não:
														  "{" .
															  "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar o utilizador pois o que quer-se é cancelar e não eliminar
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
														      "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar o utilizador pois o que quer-se é cancelar e não eliminar
															  "location.href='?ordenadopor=" . $_GET["ordenadopor"] . "';" . //Manda de volta para a página que estava com o que estava ordenado
														  "});";
										}
										else //Se não
										{
											$codigobtnnao="document.getElementById('btnnao').addEventListener('click', function(e)" . //Quando clicar no botão não:
														  "{" .
															  "e.preventDefault();" . //Diz para não enviar nada via formulário para evitar eliminar o utilizador pois o que quer-se é cancelar e não eliminar
															  "location.href='ConsultarUtilizadores.php';" . //Manda de volta para a página que estava
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
																	"'<input type=\'Text\' name=\'idutilizadorescondidoeliminar\' class=\'dadotabela\' id=\'idutilizadorescondidoeliminar\' value=\'" . $_GET["id"] . "\' style=\'display: none;\'>' +" . //Mete o id do utilizador escondido para depois poder verificar se mandei mesmo eliminar
																	"'<input type=\'Submit\' name=\'btnsimescondido\' id=\'btnsimescondido\' style=\'display: None;\'>' +" . //Botão do formulário escondido porque haverá outro visível com um visual melhor para mandar eliminar o utilizador
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
								elseif($linhas_utilizador==0) //Se não se as linhas são 0, significa que não existe ninguém com esse id então:
									{
										header("Location: ?mensagem=O_Id_que_digitou_nao_existe"); //Recarrega a página passando uma mensagem a dizer que o id que digitou não existe
									}
									elseif($linhas_utilizador<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
										{
											$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
							}
							else //Se não significa que houve um erro ou na base de dados ou o id é inválido:
							{
								if(!$idinvalido) //Se o id não é inválido então:
								{
									$_SESSION["mensagemerro"]="Erro ao consultar os utilizadores, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
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
			
			if(isset($_POST["idutilizadorescondidoalterar"])) //Se mandei alterar os dados e já confirmei então:
			{
				//Retira os espaços em branco (trim) de trás e da frente, por exemplo, "          Dado          " passa para "Dado"
				$idutilizador=trim($_GET["id"]); //Esta variável é enviada por via GET em vez de ser enviada por via POST por proteção de dados e para evitar erros
				$nome_utilizador=trim($_POST["nome_utilizador"]);
				$email=trim($_POST["email"]);
				$cargo_utilizador=trim($_POST["cargo_utilizador"]);
				$tipo_utilizador=trim($_POST["tipo_utilizador"]);
				
				//Mete as variáveis a falso
				$erro=false;
				
				//Nota: Isto é uma função, significa que o código só é executado quando eu chamar a função
				echo "<script>" .
						 //Cria uma função de Validação cujo os parâmetros serão o campo com erro e a mensagem de erro com o objetivo se simplificar e minimizar o código
						 "function Validacao(campo, mensagem)" .
						 "{" .
							 "document.getElementById('nome_utilizador').value='" . $nome_utilizador . "';" . //A caixa de texto do nome do utilizador volta a ter o que estava lá escrito
							 "document.getElementById('email').value='" . $email . "';" . //A caixa de texto do email volta a ter o que estava lá escrito
							 "document.getElementById('cargo_utilizador').value='" . $cargo_utilizador . "';" . //A caixa de texto do cargo do utilizador volta a ter o que estava lá escrito
							 "document.getElementById('tipo_utilizador').value='" . $tipo_utilizador . "';" . //A caixa de seleção do tipo de utilizador volta a ter o que estava lá selecionado
							 
							 "document.getElementById('erro').innerHTML+=mensagem + '<br><br>';" . //A zona de erro recebe a mensagem de erro
							 "document.getElementById(campo).style.borderColor='red';" . //As bordas das caixas com erro ficam a vermelho
						 "}" .
					 "</script>";
				
				
				if($nome_utilizador=="") //Se o nome de utilizador está vazio vai aparecer uma mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('nome_utilizador', 'O nome do utilizador não foi preenchido.');" . //Usa a função acima que criei indicando o campo com erro (nome de utilizador) e a mensagem de erro (O nome de utilizador não foi preenchido)
							 "});" .
						 "</script>";
					
					$erro=true; //A variável que indica o erro fica verdadeiro
				}
				else //Se não:
				{
					//Anotação: str_split() converte a string num array
					for($i=0; $i<count(str_split($nome_utilizador)); $i++) //Vai repetir a quantidade de letras, por exemplo, Tiago, repete 5 vezes
					{
						if(!$erro) //Se ainda não houve erro:
						{
							//Verifica cada letra se é um caractére não pertencente a um nome, se for um caractére que pertence a um nome como o T do Tiago, ignora o if porque o if só está configurado em caso de erro, agora se for um caractére não pertecente a um nome por exemplo um 7 de 7iago, aí entra no if para retornar erro
							if(!preg_match("|[a-zA-Z áàâãäéèêëíìîïóòôõöúùûüçÁÀÂÃÄÉÈÊËÍÌÎÏÓÒÔÕÖÚÙÛÜÇ]|", $nome_utilizador[$i]))
							{
								echo "<script>" .
										 "window.addEventListener('load', function()" .
										 "{" .
											 "Validacao('nome_utilizador', 'O nome que introduziu não pode conter caracteres especiais que não pertecem a nomes.');" . //Usa a função acima que criei indicando o campo com erro (nome de utilizador) e a mensagem de erro (contém caratéres não pertecentes a um nome)
										 "});" .
									 "</script>";
								
								$erro=true; //A variável que indica o erro fica verdadeiro
							}
						}
					}
				}
				
				if($email=="") //Se o campo email está vazio vai aparecer mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('email', 'O email não foi preenchido.');" . //Usa a função acima que criei indicando o campo com erro (email) e a mensagem de erro (não foi preenchido)
							 "});" .
						 "</script>";
					
					$erro=true; //A variável que indica o erro fica verdadeiro
				}
				elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) //Se o email não é válido vai aparecer mensagem de erro:
					{
						echo "<script>" .
								 "window.addEventListener('load', function()" .
								 "{" .
									 "Validacao('email', 'O email que introduziu é inválido.');" . //Usa a função acima que criei indicando o campo com erro (email) e a mensagem de erro (email não válido)
								 "});" .
							 "</script>";
						
						$erro=true; //A variável que indica o erro fica verdadeiro
					}
					elseif((!preg_match("|@esec-danielsampaio.pt|", $email)) AND (!preg_match("|@ae-danielsampaio.pt|", $email))) //Se não se o email não é esec-danielsampaio ou ae-danielsampaio
						{
							echo "<script>" .
									 "window.addEventListener('load', function()" .
									 "{" .
										 "Validacao('email', 'O email que introduziu não pretence ao Agrupamento de Escolas Daniel Sampaio.');" . //Usa a função acima que criei indicando o campo com erro (email) e a mensagem de erro (O email que introduziu não pertecente ao Agrupamento de Escolas Daniel Sampaio)
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
								header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
								
							$consultar_email=mysqli_query($conexao, "SELECT * FROM utilizadores WHERE email='" . $email . "';"); //Verifica se já existe alguém com este email
							if($consultar_email) //Se não ocorreu nenhum erro:
							{
								$linhas_email=mysqli_num_rows($consultar_email); //Obtém o número de pessoas com esse email
								if($linhas_email==1) //Se retornar uma linha significa que já existe um utilizador com esse email
								{
									$consultar_email_antigo=mysqli_query($conexao, "SELECT * FROM utilizadores WHERE idutilizador=" . $idutilizador . ";"); //Vai buscar o email antigo base de dados
									if($consultar_email_antigo) //Se não ocorreu nenhum erro:
									{
										$linhas_email_antigo=mysqli_num_rows($consultar_email_antigo); //Obtém o número de pessoas com esse email
										if($linhas_email_antigo==1) //Se retornar uma linha significa que a pesquisa foi bem feita
										{
											$dados_email=mysqli_fetch_array($consultar_email); //Recebe os dados so utilizador com esse email
											$dados_email_antigo=mysqli_fetch_array($consultar_email_antigo); //Recebe os dados do utilizador que mandei editar
											
											if($dados_email["email"]!=$dados_email_antigo["email"]) //Se o email que digitei existe e não é o email antigo que tinha então:
											{
												echo "<script>" .
														 "window.addEventListener('load', function()" .
														 "{" .
															 "Validacao('email', 'O email que introduziu já existe.');" . //Usa a função acima que criei indicando o campo com erro (email) e a mensagem de erro (O email que introduziu já existe)
														 "});" .
													 "</script>";
												
												$erro=true; //A variável que indica o erro fica verdadeiro
											}
										}
										elseif($linhas_email_antigo==0) //Se não se retornar 0 linhas, significa que houve algum erro a procurar o email antigo então:
											{
												$_SESSION["mensagemerro"]="Erro a procurar o email antigo, por favor informe o administrador."; //Passa a mensagem de erro
												header("Location: ConsultarUtilizadores.php");  //Recarrega a página passando o erro para abrir o modal de erro
											}
											elseif($linhas_email_antigo>1) //Se não se retornar mais que uma linha, significa que existe 2 pessoas com esse email um utilizador não pode ter um email que já existe então:
												{
													$_SESSION["mensagemerro"]="Erro. O email antigo existe mais que uma vez na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
													header("Location: ConsultarUtilizadores.php");  //Recarrega a página passando o erro para abrir o modal de erro
												}
												elseif($linhas_email_antigo<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
													{
														$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
														header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
													}
									}
									else //Se não:
									{
										$_SESSION["mensagemerro"]="Erro ao consultar se o email já existe, por favor informe o administrador."; //Passa a mensagem de erro
										header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
									}
								}
								elseif($linhas_email>1) //Se não se retornar mais que uma linha, significa que existe 2 pessoas com esse email um utilizador não pode ter um email que já existe então:
									{
										$_SESSION["mensagemerro"]="Erro. O email que introduziu existe mais que uma vez na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
										header("Location: ConsultarUtilizadores.php");  //Recarrega a página passando o erro para abrir o modal de erro
									}
									elseif($linhas_email<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
										{
											$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
							}
							else //Se não:
							{
								$_SESSION["mensagemerro"]="Erro ao consultar se o email já existe, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
				
				if($cargo_utilizador=="") //Se o campo cargo do utilizador está vazio vai aparecer mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('cargo_utilizador', 'O cargo do utilizador não foi preenchido.');" . //Usa a função acima que criei indicando o campo com erro (palavra passe) e a mensagem de erro (O cargo do utilizador não foi preenchido)
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
						header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
					
					$editar_nome_utilizador=mysqli_query($conexao, "UPDATE utilizadores SET nome_utilizador='" . $nome_utilizador . "' WHERE idutilizador=" . $idutilizador . ";"); //Edita o campo nome do utilizador
					if($editar_nome_utilizador) //Se não ocorreu nenhum erro:
					{	
						$editar_email=mysqli_query($conexao, "UPDATE utilizadores SET email='" . $email . "' WHERE idutilizador=" . $idutilizador . ";"); //Edita o campo email
						if($editar_email) //Se não ocorreu nenhum erro:
						{	
							$editar_cargo_utilizador=mysqli_query($conexao, "UPDATE utilizadores SET cargo_utilizador='" . $cargo_utilizador . "' WHERE idutilizador=" . $idutilizador . ";"); //Edita o campo cargo do utilizador
							if($editar_cargo_utilizador) //Se não ocorreu nenhum erro:
							{	
								$editar_tipo_utilizador=mysqli_query($conexao, "UPDATE utilizadores SET tipo_utilizador='" . $tipo_utilizador . "' WHERE idutilizador=" . $idutilizador . ";"); //Edita o campo tipo de utilizador
								if($editar_tipo_utilizador) //Se não ocorreu nenhum erro:
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
									$_SESSION["mensagemerro"]="Erro ao alterar o tipo de utilizador, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
							else //Se não:
							{
								$_SESSION["mensagemerro"]="Erro ao alterar o cargo do utilizador, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
						else //Se não:
						{
							$_SESSION["mensagemerro"]="Erro ao alterar o email, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
					}
					else //Se não:
					{
						$_SESSION["mensagemerro"]="Erro ao alterar o nome do utilizador, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
			}
			
			if(isset($_POST["passantiga"])) //Se mandei verificar a palavra passe então:
			{
				//Retira os espaços em branco (trim) de trás e da frente, por exemplo, "          Dado          " passa para "Dado"
				$idutilizador=$_GET["id"];
				$passantiga=trim($_POST["passantiga"]);
				
				for($i=0; $i<100; $i++) //Vai repetir 100 vezes, encriptar a palavra passe e encriptar a palavra passe encriptada e assim por diante por segurança:
				{
					if($passantiga!="") //Se a palavra passe não está vazia:
					{
						$passantiga=MD5($passantiga); //A palavra passe é encriptada com a codificação MD5
					}
				}
				
				if($passantiga=="") //Se a palavra passe está vazia então:
				{
					//Volta a escrever o modal de verificar a palavra passe outra vez passando a mensagem de erro:
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "document.getElementById('zonabtnmodal').innerHTML='<br><button class=\'btnmetade\' id=\'btncancelarconsultar\'>Cancelar</button> <button class=\'btnmetade\' id=\'btncontinuarconsultarmostrado\'>Continuar</button>';" .
								 
								 "document.getElementById('btncancelarconsultar').style.backgroundColor='#E63946';" .
								 
								 "document.getElementById('btncancelarconsultar').addEventListener('mouseover', function()" .
								 "{" .
									 "document.getElementById('btncancelarconsultar').style.backgroundColor='#DD3C48';" .
								 "});" .
								 
								 "document.getElementById('btncancelarconsultar').addEventListener('mouseout', function()" .
								 "{" .
									 "document.getElementById('btncancelarconsultar').style.backgroundColor='#E63946';" .
								 "});" .
								 
								 "document.getElementById('btncontinuarconsultarmostrado').style.backgroundColor='#E63946';" .
								 
								 "document.getElementById('btncontinuarconsultarmostrado').addEventListener('mouseover', function()" .
								 "{" .
									 "document.getElementById('btncontinuarconsultarmostrado').style.backgroundColor='#DD3C48';" .
								 "});" .
								 
								 "document.getElementById('btncontinuarconsultarmostrado').addEventListener('mouseout', function()" .
								 "{" .
									 "document.getElementById('btncontinuarconsultarmostrado').style.backgroundColor='#E63946';" .
								 "});" .
								 
								 "Modal('pass', '' +" .
											   "'<form name=\'frmVerificaPass\' action=\'#\' method=\'POST\'>' +" .
												   //A borda da caixa de texto fica vermelha com o border-color: Red; para destacar melhor o campo com erro
												   "'<input type=\'Password\' name=\'passantiga\' class=\'caixatextomodal\' id=\'passantiga\' placeholder=\'Introduza a palavra passe antiga\' title=\'Palavra passe antiga\' maxlength=\'120\' style=\'border-color: Red;\' required>' +" .
												   "'<br>' +" .
												   "'<label id=\'erro\' style=\'color: Red;\'>A palavra passe não foi preenchida.</label>' +" . //Aqui aparece a mensagem de erro
												   "'<input type=\'Submit\' name=\'btncontinuarconsultarescondido\' id=\'btncontinuarconsultarescondido\' style=\'display: None;\'>' +" .
											   "'</form>'" .
								 ");" .
								 
								 "document.getElementById('btncancelarconsultar').addEventListener('click', function(e)" .
								 "{" .
									 "e.preventDefault();" .
									 "document.getElementById('passantiga').value='';" .
									 "document.getElementById('zonamodalconsultar').style.display='none';" .
								 "});" .
								 
								 "document.getElementById('btncontinuarconsultarmostrado').addEventListener('click', function()" .
								 "{" .
									 "document.getElementById('btncontinuarconsultarescondido').click();" .
								 "});" .
							 "});" .
						 "</script>";
				}
				else //Se não:
				{
					include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
					
					$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
					if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
					{
						$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
					
					$consultar_pass_antiga=mysqli_query($conexao, "SELECT * FROM utilizadores WHERE pass='" . $passantiga . "' AND idutilizador=" . $idutilizador . ";"); //Verifica se a palavra passe está correta
					if($consultar_pass_antiga) //Se não ocorreu nenhum erro:
					{
						$linhas_pass_antiga=mysqli_num_rows($consultar_pass_antiga);
						if($linhas_pass_antiga==1) //Se retornar uma linha significa que a palavra passe está correta
						{
							echo "<script>" .
									 "window.addEventListener('load', function()" .
									 "{" .
										 //Abre o modal para escrever a palavra passe nova:
										 "Modal('pass', '' +" .
													   "'<form name=\'frmAlteraPass\' action=\'#\' method=\'POST\'>' +" .
														   //Caixa de texto para a palavra passe
														   "'<input type=\'Password\' name=\'passnova\' class=\'caixatextomodal\' id=\'passnova\' placeholder=\'Introduza a palavra passe nova\' title=\'Palavra passe nova\' maxlength=\'120\' required>' +" .
														   "'<br>' +" .
														   //Caixa de texto para repetir a palavra passe nova
														   "'<input type=\'Password\' name=\'repetepassnova\' class=\'caixatextomodal\' id=\'repetepassantiga\' placeholder=\'Reintroduza a palavra passe nova\' title=\'Repetir palavra passe nova\' maxlength=\'120\' required>' +" .
														   "'<br>' +" .
														   "'<input type=\'Submit\' name=\'btnalterarpass\' id=\'btnalterarpass\' style=\'display: None;\'>' +" . //Botão para mudar a palavra passe escondido
													   "'</form>'" .
										 ");" .
										 
										 "document.getElementById('btnokconsultar').style.backgroundColor='#E63946';" . //O botão ok fica vermelho
								 
										 "document.getElementById('btnokconsultar').addEventListener('mouseover', function()" . //Quando passar com o rato por cima do botão:
										 "{" .
											"document.getElementById('btnokconsultar').style.backgroundColor='#DD3C48';" . //O botão ok fica com um vermelho mais claro
										 "});" .
										 
										 "document.getElementById('btnokconsultar').addEventListener('mouseout', function()" . //Quando retirar o rato de cima do botão:
										 "{" .
											 "document.getElementById('btnokconsultar').style.backgroundColor='#E63946';" . //O botão ok volta à cor que tinha
										 "});" .
										 
										 "document.getElementById('btnokconsultar').innerHTML='Alterar palavra passe';" . //O botão recebe o texto Alterar palavra passe
										 
										 "document.getElementById('btnokconsultar').addEventListener('click', function()" . //Quando clicar no botão para alterar a palavra passe:
										 "{" .
											 "document.getElementById('btnalterarpass').click();" . //Faz com que o botão de alterar a palavra passe escondido seja acionado para alterar a palavra passe
										 "});" .
									 "});" .
								 "</script>";
						}
						elseif($linhas_pass_antiga==0) //Se não se retornar 0 linhas significa que a palavra passe está errada então:
							{
								//Volta a aparecer o modal de novo para verificar a palavra passe mostrando a mensagem de erro que a palavra passe está errada, usando outra vez o mesmo código
								echo "<script>" .
										 "window.addEventListener('load', function()" .
										 "{" .
											 "document.getElementById('zonabtnmodal').innerHTML='<br><button class=\'btnmetade\' id=\'btncancelarconsultar\'>Cancelar</button> <button class=\'btnmetade\' id=\'btncontinuarconsultarmostrado\'>Continuar</button>';" .
											 
											 "document.getElementById('btncancelarconsultar').style.backgroundColor='#E63946';" .
											 
											 "document.getElementById('btncancelarconsultar').addEventListener('mouseover', function()" .
											 "{" .
												 "document.getElementById('btncancelarconsultar').style.backgroundColor='#DD3C48';" .
											 "});" .
											 
											 "document.getElementById('btncancelarconsultar').addEventListener('mouseout', function()" .
											 "{" .
												 "document.getElementById('btncancelarconsultar').style.backgroundColor='#E63946';" .
											 "});" .
											 
											 "document.getElementById('btncontinuarconsultarmostrado').style.backgroundColor='#E63946';" .
											 
											 "document.getElementById('btncontinuarconsultarmostrado').addEventListener('mouseover', function()" .
											 "{" .
												 "document.getElementById('btncontinuarconsultarmostrado').style.backgroundColor='#DD3C48';" .
											 "});" .
											 
											 "document.getElementById('btncontinuarconsultarmostrado').addEventListener('mouseout', function()" .
											 "{" .
												 "document.getElementById('btncontinuarconsultarmostrado').style.backgroundColor='#E63946';" .
											 "});" .
											 
											 "Modal('pass', '' +" .
														   "'<form name=\'frmVerificaPass\' action=\'#\' method=\'POST\'>' +" .
															   //A borda da caixa de texto fica vermelha com o border-color: Red; para destacar melhor o campo com erro
															   "'<input type=\'Password\' name=\'passantiga\' class=\'caixatextomodal\' id=\'passantiga\' placeholder=\'Introduza a palavra passe antiga\' title=\'Palavra passe antiga\' maxlength=\'120\' style=\'border-color: Red;\' required>' +" .
															   "'<br>' +" .
															   "'<label id=\'erro\' style=\'color: Red;\'>A palavra passe está errada.</label>' +" . //Aqui aparece a mensagem de erro que a palavra passe está errada
															   "'<input type=\'Submit\' name=\'btncontinuarconsultarescondido\' id=\'btncontinuarconsultarescondido\' style=\'display: None;\'>' +" .
														   "'</form>'" .
											 ");" .
											  
											 "document.getElementById('btncancelarconsultar').addEventListener('click', function(e)" .
											 "{" .
												 "e.preventDefault();" .
												 "document.getElementById('passantiga').value='';" .
												 "document.getElementById('zonamodalconsultar').style.display='none';" .
											 "});" .
											 
											 "document.getElementById('btncontinuarconsultarmostrado').addEventListener('click', function()" .
											 "{" .
												 "document.getElementById('btncontinuarconsultarescondido').click();" .
											 "});" .
										 "});" .
									 "</script>";
							}
							elseif($linhas_pass_antiga<0) //Se não se retornar mais que uma linha, que existe mais que um id repetido ou algum erro inesperado na programação então:
								{
									$_SESSION["mensagemerro"]="Erro desconhecido. Existe dois ou mais Ids repetidos, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
								elseif($linhas_pass_antiga<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
									{
										$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
										header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
									}
					}
					else //Se não:
					{
						$_SESSION["mensagemerro"]="Erro ao verificar se a palavra passe está correta, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
			}
			
			if(isset($_POST["passnova"])) //Se mandei alterar a palavra passe então:
			{
				//Retira os espaços em branco (trim) de trás e da frente, por exemplo, "          Dado          " passa para "Dado"
				$idutilizador=$_GET["id"];
				$passnova=trim($_POST["passnova"]);
				$repetepassnova=trim($_POST["repetepassnova"]);
				
				for($i=0; $i<100; $i++) //Vai repetir 100 vezes, encriptar a palavra passe e encriptar a palavra passe encriptada e assim por diante por segurança:
				{
					if($passnova!="") //Se a palavra passe não está vazia:
					{
						$passnova=MD5($passnova); //A palavra passe é encriptada com a codificação MD5
					}
					
					if($repetepassnova!="") //Se o repetir palavra passe não está vazio:
					{
						$repetepassnova=MD5($repetepassnova); //O repetir palavra passe é encriptado com a codificação MD5
					}
				}
				
				if(($passnova=="") AND ($repetepassnova=="")) //Se a palavra passe e o repetir palavra passe estão vazios então:
				{
					//Abre o modal outra vez para meter a palavra passe com o mesmo código com a mensagem de erro
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Modal('pass', '' +" .
											   "'<form name=\'frmAlteraPass\' action=\'#\' method=\'POST\'>' +" .
												   //A borda da caixa de texto fica vermelha com o border-color: Red; para destacar melhor o campo com erro
												   "'<input type=\'Password\' name=\'passnova\' class=\'caixatextomodal\' id=\'passnova\' placeholder=\'Introduza a palavra passe nova\' title=\'Palavra passe nova\' maxlength=\'120\' style=\'border-color: Red;\' required>' +" .
												   "'<br>' +" .
												   "'<label id=\'erro\' style=\'color: Red;\'>A palavra passe não foi preenchida.</label>' +" . //Aqui fica a mensagem de erro que a palavra passe não foi preenchida
												   "'<br>' +" .
												   //A borda da caixa de texto fica vermelha com o border-color: Red; para destacar melhor o campo com erro
												   "'<input type=\'Password\' name=\'repetepassnova\' class=\'caixatextomodal\' id=\'repetepassantiga\' placeholder=\'Reintroduza a palavra passe nova\' title=\'Repetir palavra passe nova\' maxlength=\'120\' style=\'border-color: Red;\' required>' +" .
												   "'<br>' +" .
												   "'<label id=\'erro\' style=\'color: Red;\'>O repetir palavra passe não foi preenchido.</label>' +" . //Aqui fica a mensagem de erro que o repetir palavra passe não foi preenchido
												   "'<br>' +" .
												   "'<input type=\'Submit\' name=\'btnalterarpass\' id=\'btnalterarpass\' style=\'display: None;\'>' +" .
											   "'</form>'" .
								 ");" .
								 
								 "document.getElementById('modalconsultar').style.height='500px';" . //Aumento a altura do modal
								 
								 "document.getElementById('btnokconsultar').style.backgroundColor='#E63946';" .
								 
								 "document.getElementById('btnokconsultar').addEventListener('mouseover', function()" .
								 "{" .
									"document.getElementById('btnokconsultar').style.backgroundColor='#DD3C48';" .
								 "});" .
								 
								 "document.getElementById('btnokconsultar').addEventListener('mouseout', function()" .
								 "{" .
									 "document.getElementById('btnokconsultar').style.backgroundColor='#E63946';" .
								 "});" .
								 
								 "document.getElementById('btnokconsultar').innerHTML='Alterar palavra passe';" .
								 
								 "document.getElementById('btnokconsultar').addEventListener('click', function()" .
								 "{" .
									 "document.getElementById('btnalterarpass').click();" .
								 "});" .
							 "});" .
						 "</script>";
				}
				elseif($passnova=="") //Se não se a palavra passe nova está vazia então:
					{
						//Abre o modal outra vez para meter a palavra passe com o mesmo código com a mensagem de erro
						echo "<script>" .
								 "window.addEventListener('load', function()" .
								 "{" .
									 "Modal('pass', '' +" .
												   "'<form name=\'frmAlteraPass\' action=\'#\' method=\'POST\'>' +" .
													   //A borda da caixa de texto fica vermelha com o border-color: Red; para destacar melhor o campo com erro
													   "'<input type=\'Password\' name=\'passnova\' class=\'caixatextomodal\' id=\'passnova\' placeholder=\'Introduza a palavra passe nova\' title=\'Palavra passe nova\' maxlength=\'120\' style=\'border-color: Red;\' required>' +" .
													   "'<br>' +" .
													   "'<label id=\'erro\' style=\'color: Red;\'>A palavra passe não foi preenchida.</label>' +" . //Aqui fica a mensagem de erro que a palavra passe não foi preenchida
													   "'<br>' +" .
													   "'<input type=\'Password\' name=\'repetepassnova\' class=\'caixatextomodal\' id=\'repetepassantiga\' placeholder=\'Reintroduza a palavra passe nova\' title=\'Repetir palavra passe nova\' maxlength=\'120\' required>' +" .
													   "'<br>' +" .
													   "'<input type=\'Submit\' name=\'btnalterarpass\' id=\'btnalterarpass\' style=\'display: None;\'>' +" .
												   "'</form>'" .
									 ");" .
									 
									 "document.getElementById('btnokconsultar').style.backgroundColor='#E63946';" .
									 
									 "document.getElementById('btnokconsultar').addEventListener('mouseover', function()" .
									 "{" .
										"document.getElementById('btnokconsultar').style.backgroundColor='#DD3C48';" .
									 "});" .
									 
									 "document.getElementById('btnokconsultar').addEventListener('mouseout', function()" .
									 "{" .
										 "document.getElementById('btnokconsultar').style.backgroundColor='#E63946';" .
									 "});" .
									 
									 "document.getElementById('btnokconsultar').innerHTML='Alterar palavra passe';" .
									 
									 "document.getElementById('btnokconsultar').addEventListener('click', function()" .
									 "{" .
										 "document.getElementById('btnalterarpass').click();" .
									 "});" .
								 "});" .
							 "</script>";
					}
					elseif($repetepassnova=="") //Se não se o repetir palavra passe está vazio então:
						{
							//Abre o modal outra vez para meter a palavra passe com o mesmo código com a mensagem de erro
							echo "<script>" .
									 "window.addEventListener('load', function()" .
									 "{" .
										 "Modal('pass', '' +" .
													   "'<form name=\'frmAlteraPass\' action=\'#\' method=\'POST\'>' +" .
														   "'<input type=\'Password\' name=\'passnova\' class=\'caixatextomodal\' id=\'passnova\' placeholder=\'Introduza a palavra passe nova\' title=\'Palavra passe nova\' maxlength=\'120\' required>' +" .
														   "'<br>' +" .
														   //A borda da caixa de texto fica vermelha com o border-color: Red; para destacar melhor o campo com erro
														   "'<input type=\'Password\' name=\'repetepassnova\' class=\'caixatextomodal\' id=\'repetepassantiga\' placeholder=\'Reintroduza a palavra passe nova\' title=\'Repetir palavra passe nova\' maxlength=\'120\' style=\'border-color: Red;\' required>' +" .
														   "'<br>' +" .
														   "'<label id=\'erro\' style=\'color: Red;\'>O repetir palavra passe não foi preenchido.</label>' +" . //Aqui fica a mensagem de erro que o repetir palavra passe não foi preenchido
														   "'<br>' +" .
														   "'<input type=\'Submit\' name=\'btnalterarpass\' id=\'btnalterarpass\' style=\'display: None;\'>' +" .
													   "'</form>'" .
										 ");" .
										 
										 "document.getElementById('btnokconsultar').style.backgroundColor='#E63946';" .
										 
										 "document.getElementById('btnokconsultar').addEventListener('mouseover', function()" .
										 "{" .
											"document.getElementById('btnokconsultar').style.backgroundColor='#DD3C48';" .
										 "});" .
										 
										 "document.getElementById('btnokconsultar').addEventListener('mouseout', function()" .
										 "{" .
											 "document.getElementById('btnokconsultar').style.backgroundColor='#E63946';" .
										 "});" .
										 
										 "document.getElementById('btnokconsultar').innerHTML='Alterar palavra passe';" .
										 
										 "document.getElementById('btnokconsultar').addEventListener('click', function()" .
										 "{" .
											 "document.getElementById('btnalterarpass').click();" .
										 "});" .
									 "});" .
								 "</script>";
						}
						elseif($passnova!=$repetepassnova) //Se não se a palavra passe não coincidir com o repetir palavra passe então:
							{
								//Abre o modal outra vez para meter a palavra passe com o mesmo código com a mensagem de erro
								echo "<script>" .
									 "window.addEventListener('load', function()" .
									 "{" .
										 "Modal('pass', '' +" .
													   "'<form name=\'frmAlteraPass\' action=\'#\' method=\'POST\'>' +" .
														   //A borda da caixa de texto fica vermelha com o border-color: Red; para destacar melhor o campo com erro
														   "'<input type=\'Password\' name=\'passnova\' class=\'caixatextomodal\' id=\'passnova\' placeholder=\'Introduza a palavra passe nova\' title=\'Palavra passe nova\' maxlength=\'120\' style=\'border-color: Red;\' required>' +" .
														   "'<br>' +" .
														   "'<label id=\'erro\' style=\'color: Red;\'>As palavras passes não coincidem.</label>' +" . //Aqui fica a mensagem de erro que as palavras passes não foram preenchidas
														   "'<br>' +" .
														   //A borda da caixa de texto fica vermelha com o border-color: Red; para destacar melhor o campo com erro
														   "'<input type=\'Password\' name=\'repetepassnova\' class=\'caixatextomodal\' id=\'repetepassantiga\' placeholder=\'Reintroduza a palavra passe nova\' title=\'Repetir palavra passe nova\' maxlength=\'120\' style=\'border-color: Red;\' required>' +" .
														   "'<br>' +" .
														   "'<input type=\'Submit\' name=\'btnalterarpass\' id=\'btnalterarpass\' style=\'display: None;\'>' +" .
													   "'</form>'" .
										 ");" .
										 
										 "document.getElementById('btnokconsultar').style.backgroundColor='#E63946';" .
										 
										 "document.getElementById('btnokconsultar').addEventListener('mouseover', function()" .
										 "{" .
											"document.getElementById('btnokconsultar').style.backgroundColor='#DD3C48';" .
										 "});" .
										 
										 "document.getElementById('btnokconsultar').addEventListener('mouseout', function()" .
										 "{" .
											 "document.getElementById('btnokconsultar').style.backgroundColor='#E63946';" .
										 "});" .
										 
										 "document.getElementById('btnokconsultar').innerHTML='Alterar palavra passe';" .
										 
										 "document.getElementById('btnokconsultar').addEventListener('click', function()" .
										 "{" .
											 "document.getElementById('btnalterarpass').click();" .
										 "});" .
									 "});" .
								 "</script>";
							}
							else //Se não significa que está tudo certo então:
							{
								$editar_pass=mysqli_query($conexao, "UPDATE utilizadores SET pass='" . $passnova . "' WHERE idutilizador=" . $idutilizador . ";"); //Edita o campo palavra passe
								if($editar_pass) //Se não ocorreu nenhum erro:
								{	
									$_SESSION["editado_eliminado"]=true; //A variável editado_eliminado fica verdadeiro para assim não fazer a verificação para recarregar a página e não houver erro de duplicação de dados
									
									echo "<script>" .
											 "window.addEventListener('load', function()" .
											 "{" .
												 "Modal('certo', 'A palavra passe foi alterada com sucesso.');" . //Abre o modal de certo para informar ao utilizador que a palavra passe foi alterado com sucesso
											 "});" .
										 "</script>";
								}
								else //Se não:
								{
									$_SESSION["mensagemerro"]="Erro ao alterar a palavra passe, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
			}
			
			if(isset($_POST["idutilizadorescondidoeliminar"])) //Se mandei eliminar e selecionei a opção sim então:
			{
				$idutilizador=$_GET["id"]; //Recebe o id do utilizador que quero eliminar
				
				include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
					
				$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
				if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
				{
					$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
				
				$eliminar_utilizador=mysqli_query($conexao, "DELETE FROM utilizadores WHERE idutilizador=" . $idutilizador . ";"); //Elimina o utilizador
				if($eliminar_utilizador) //Se o utilizador foi eliminado com sucesso
				{
					$_SESSION["editado_eliminado"]=true; //A variável editado_eliminado fica verdadeiro para assim não fazer a verificação para recarregar a página e não houver erro de duplicação de dados
					
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Modal('certo', 'Utilizador eliminado com sucesso.');" . //Abre o modal de certo para informar ao utilizador que foi eliminado com sucesso
							 "});" .
						 "</script>";
				}
				else //Se não:
				{
					$_SESSION["mensagemerro"]="Erro ao eliminar o utilizador, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
			}
		}
		else //Se não significa que já cliquei no botão para editar ou para eliminar e vai fazer o seguinte:
		{ //Se não fizer essa verificação quando recarregar a página iria gerar o erros
			unset($_SESSION["editado_eliminado"]); //Elimina a variável
			header("Location: ConsultarUtilizadores.php"); //Recarrega a página e volta para a página de Consultar Utilizadores
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
				width: 1101px; /* A tabela fica com 1101px de comprimento, ((155px*7campos)+16)=1101px */
			}
			
			tbody td
			{
				width: 155px; /* O comprimento de cada coluna da tabela é de 155px */
			}
			
			.campotabela
			{
				width: 155px; /* O comprimento de cada coluna da tabela é de 155px */
			}
			
			.campoultimo /* Diferente do de cima, este é destinado para que a tabela fique alinhado com a barra de rolagem */
			{
				width: 171px; /* O comprimento da última coluna da tabela é de 171px por causa para ficar alinhado com os 16px da barra de rolagem */
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
						location.href="ConsultarUtilizadores.php"; //Recarrega a página
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
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum utilizador então:
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
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum utilizador então:
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
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum utilizador então:
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
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum utilizador então:
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
								 header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro;
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
			    <li class="ativo"><a href="#" id="utilizadores">Utilizadores</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar utilizadores -->
				<li><a href="#" id="agrupamentos">Agrupamentos</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar agrupamentos -->
				<li><a href="#" id="escolas">Escolas</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar escolas -->
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
					header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
				
				if((isset($_GET["pesquisa"])) AND (isset($_GET["campo"]))) //Se foi mandada uma pesquisa específica então:
				{
					//Se a pesquisa foi Administrador e o campo foi tipo de utilizador então:
					if((($_GET["pesquisa"]=="Ad") OR ($_GET["pesquisa"]=="Adm") OR ($_GET["pesquisa"]=="Admi") OR ($_GET["pesquisa"]=="Admin") OR ($_GET["pesquisa"]=="Admini") OR ($_GET["pesquisa"]=="Adminis") OR ($_GET["pesquisa"]=="Administ") OR ($_GET["pesquisa"]=="Administr") OR ($_GET["pesquisa"]=="Administra") OR ($_GET["pesquisa"]=="Administrad") OR ($_GET["pesquisa"]=="Administrado") OR ($_GET["pesquisa"]=="Administrador") OR ($_GET["pesquisa"]=="Administradora") OR ($_GET["pesquisa"]=="Administradore") OR ($_GET["pesquisa"]=="Administradores") OR ($_GET["pesquisa"]=="Administradoras")) AND ($_GET["campo"]=="tipo_utilizador"))
					{
						$pesquisaexata=$_GET["pesquisa"]; //A pesquisa exata recebe o que o foi pesquisado
						$_GET["pesquisa"]="A"; //Temporariamente vai ser pesquisado por A devido à base de dados
						
					}	//Se não se a pesquisa foi Estagiário e o campo foi tipo de utilizador então:
					elseif((($_GET["pesquisa"]=="Es") OR ($_GET["pesquisa"]=="Est") OR ($_GET["pesquisa"]=="Esta") OR ($_GET["pesquisa"]=="Estag") OR ($_GET["pesquisa"]=="Estagi") OR ($_GET["pesquisa"]=="Estagiá") OR ($_GET["pesquisa"]=="Estagiár") OR ($_GET["pesquisa"]=="Estagiári") OR ($_GET["pesquisa"]=="Estagiário") OR ($_GET["pesquisa"]=="Estagiária") OR ($_GET["pesquisa"]=="Estagiários") OR ($_GET["pesquisa"]=="Estagiárias")) AND ($_GET["campo"]=="tipo_utilizador"))
						{
							$pesquisaexata=$_GET["pesquisa"]; //A pesquisa exata recebe o que o foi pesquisado
							$_GET["pesquisa"]="E"; //Temporariamente vai ser pesquisado por E devido à base de dados
							
						}	//Se não se a pesquisa foi Normal e o campo foi tipo de utilizador então:
						elseif((($_GET["pesquisa"]=="No") OR ($_GET["pesquisa"]=="Nor") OR ($_GET["pesquisa"]=="Norm") OR ($_GET["pesquisa"]=="Norma") OR ($_GET["pesquisa"]=="Normal") OR ($_GET["pesquisa"]=="Normai") OR ($_GET["pesquisa"]=="Normais")) AND ($_GET["campo"]=="tipo_utilizador"))
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
								//Pesquisa na base de dados os utilizadores da pesquisa específica com a ordenação
								$consultar_utilizadores=mysqli_query($conexao, "SELECT * FROM utilizadores WHERE " . $_GET["campo"] . " LIKE '%" . $_GET["pesquisa"] . "%' ORDER BY " . $_GET["ordenadopor"] . ";");
								
								if(isset($pesquisaexata)) //Se a pesquisa exata existe então:
								{
									$_GET["pesquisa"]=$pesquisaexata; //A variável $_GET["pesquisa"] volta a ter o que tinha
								}
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum utilizador então:
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
								//Pesquisa na base de dados os utilizadores da pesquisa específica
								$consultar_utilizadores=mysqli_query($conexao, "SELECT * FROM utilizadores WHERE " . $_GET["campo"] . " LIKE '%" . $_GET["pesquisa"] . "%';");
								
								if(isset($pesquisaexata)) //Se a pesquisa exata existe então:
								{
									$_GET["pesquisa"]=$pesquisaexata; //A variável $_GET["pesquisa"] volta a ter o que tinha
								}
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum utilizador então:
														"{" .
															"document.getElementById('pesquisar').value='" . $_GET["pesquisa"] . "';" .
															"document.getElementById('selectpesquisar').value='" . $_GET["campo"] . "';" .
															"document.getElementById('selectordenar').value='idutilizador';" .
														"}" .
													"});" .
												"</script>";
							}
						}
						else //Se não:
						{
							//Pesquisa na base de dados os utilizadores da pesquisa específica
							$consultar_utilizadores=mysqli_query($conexao, "SELECT * FROM utilizadores WHERE " . $_GET["campo"] . " LIKE '%" . $_GET["pesquisa"] . "%';");
							
							if(isset($pesquisaexata)) //Se a pesquisa exata existe então:
							{
								$_GET["pesquisa"]=$pesquisaexata; //A variável $_GET["pesquisa"] volta a ter o que tinha
							}
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum utilizador então:
													"{" .
														"document.getElementById('pesquisar').value='" . $_GET["pesquisa"] . "';" .
														"document.getElementById('selectpesquisar').value='" . $_GET["campo"] . "';" .
														"document.getElementById('selectordenar').value='idutilizador';" .
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
								//Pesquisa na base de dados os utilizadores com a ordenação
								$consultar_utilizadores=mysqli_query($conexao, "SELECT * FROM utilizadores ORDER BY " . $_GET["ordenadopor"] . ";");
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum utilizador então:
														"{" .
															"document.getElementById('selectpesquisar').value='idutilizador';" .
															"document.getElementById('selectordenar').value='" . $_GET["ordenadopor"] . "';" .
														"}" .
													"});" .
												"</script>";
							}
							else //Se não:
							{
								//Pesquisa na base de dados os utilizadores
								$consultar_utilizadores=mysqli_query($conexao, "SELECT * FROM utilizadores;");
								
								//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
								$preselecionado="<script>" .
													"window.addEventListener('load', function()" .
													"{" .
														"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum utilizador então:
														"{" .
															"document.getElementById('selectpesquisar').value='idutilizador';" .
															"document.getElementById('selectordenar').value='idutilizador';" .
														"}" .
													"});" .
												"</script>";
							}
						}
						else //Se não:
						{
							//Pesquisa na base de dados os utilizadores
							$consultar_utilizadores=mysqli_query($conexao, "SELECT * FROM utilizadores;");
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum utilizador então:
													"{" .
														"document.getElementById('selectpesquisar').value='idutilizador';" .
														"document.getElementById('selectordenar').value='idutilizador';" .
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
							//Pesquisa na base de dados os utilizadores com a ordenação
							$consultar_utilizadores=mysqli_query($conexao, "SELECT * FROM utilizadores ORDER BY " . $_GET["ordenadopor"] . ";");
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum utilizador então:
													"{" .
														"document.getElementById('selectpesquisar').value='idutilizador';" .
														"document.getElementById('selectordenar').value='" . $_GET["ordenadopor"] . "';" .
													"}" .
												"});" .
											 "</script>";
						}
						else //Se não:
						{
							//Pesquisa na base de dados os utilizadores
							$consultar_utilizadores=mysqli_query($conexao, "SELECT * FROM utilizadores;");
							
							//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
							$preselecionado="<script>" .
												"window.addEventListener('load', function()" .
												"{" .
													"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum utilizador então:
													"{" .
														"document.getElementById('selectpesquisar').value='idutilizador';" .
														"document.getElementById('selectordenar').value='idutilizador';" .
													"}" .
												"});" .
											"</script>";
						}
					}
					else //Se não:
					{
						//Pesquisa na base de dados os utilizadores
						$consultar_utilizadores=mysqli_query($conexao, "SELECT * FROM utilizadores;");
						
						//O preselecionado recebe o código para a caixa de texto receber o que já tinha e as caixas de seleção tarem selecionadas o que já estava selecionado
						$preselecionado="<script>" .
											"window.addEventListener('load', function()" .
											"{" .
												"if(!(document.getElementById('btnpesquisar')==null))" . //Se a botão pesquisar existe porque pode não existir quando eu mando editar algum utilizador então:
												"{" .
													"document.getElementById('selectpesquisar').value='idutilizador';" .
													"document.getElementById('selectordenar').value='idutilizador';" .
												"}" .
											"});" .
										"</script>";
					}
				}
				
				if($consultar_utilizadores) //Se não ocorreu nenhum erro:
				{
					$linhas_utilizadores=mysqli_num_rows($consultar_utilizadores); //Obtém o número de utilizadores
					if($linhas_utilizadores>0) //Se retornar mais que uma linha, significa que existe pelo menos um utilizador então:
					{
			echo "<a class='btnpesquisar' id='btnpesquisar' href='#'></a>"; //Botão de pesquisa específica
			echo "<input type='Text' name='pesquisar' class='pesquisar' id='pesquisar' placeholder='Introduza o que quer pesquisar' title='Introduza o que quer pesquisar'>"; //Caixa de texto da pesquisa específica
			echo "<select name='selectpesquisar' class='selectpesquisar' id='selectpesquisar'>"; //Caixa de seleção da pesquisa específica
				echo "<option value='idutilizador'>Id</option>";
				echo "<option value='nome_utilizador'>Nome</option>";
				echo "<option value='email'>Email</option>";
				echo "<option value='cargo_utilizador'>Cargo</option>";
				echo "<option value='tipo_utilizador'>Tipo de utilizador</option>";
			echo "</select>";
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<label class='textoordenar' id='textoordenar'>Ordernar por:</label>"; //Texto ordenar por
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<select name='selectordenar' class='selectordenar' id='selectordenar'>"; //Caixa de seleção de ordenação
				echo "<option value='idutilizador'>Id (Crescente)</option>";
				echo "<option value='idutilizador DESC'>Id (Decrescente)</option>";
				echo "<option value='nome_utilizador'>Nome (Crescente)</option>";
				echo "<option value='nome_utilizador DESC'>Nome (Descrescente)</option>";
				echo "<option value='email'>Email (Crescente)</option>";
				echo "<option value='email DESC'>Email (Decrescente)</option>";
				echo "<option value='cargo_utilizador'>Cargo (Crescente)</option>";
				echo "<option value='cargo_utilizador DESC'>Cargo (Decrescente)</option>";
				echo "<option value='tipo_utilizador'>Tipo de utilizador (Crescente)</option>";
				echo "<option value='tipo_utilizador DESC'>Tipo de utilizador (Decrescente)</option>";
			echo "</select>";
						echo $javascriptpesquisa; //Executa o que está programado para a pesquisa específica
						echo $preselecionado; //Executa o que está programado para o preselecionamento das caixas de seleção e da caixa de texto ter o que já tinha
			echo "<div class='zonatabela' id='zonatabela'>"; //Início da zona da tabela
				echo "<table class='tabela'>"; //Início da tabela
					echo "<thead>"; //Início do cabeçalho da tabela
						echo "<tr>"; //Início da linha da tabela
							echo "<th class='campotabela'>Id</th>";  //Título Id
							echo "<th class='campotabela'>Nome</th>"; //Título Nome
							echo "<th class='campotabela'>Email</th>"; //Título Email
							echo "<th class='campotabela'>Cargo</th>"; //Título Cargo
							echo "<th class='campotabela'>Tipo de utilizador</th>";	//Título Tipo de Utilizador
							echo "<th class='campotabela'></th>";
							echo "<th class='campoultimo'></th>"; //Este campo receberá um comprimento diferente para ficar alinhado com com a barra de rolagem
						echo "</tr>";//Fim da linha da tabela
					echo "</thead>"; //Fim do cabeçalho da tabela
					echo "<tbody>"; //Início dos campos da tabela
						for($i=0; $i<$linhas_utilizadores; $i++) //Vai repetir o número de utilizadores, por exemplo, se existir 10 utilizadores repete 10 vezes
						{
							$dados_utilizadores=mysqli_fetch_array($consultar_utilizadores); //Recebe os dados de cada utilizador
							
							//Este if, o else e tudo dentro é para definir o link de editar e eliminar para depois, por exemplo, se fiz mandei eliminar e quero candelar vou voltar para essa página com a pesquisa específica em vez de voltar para a página original
							if(isset($_GET["pesquisa"]) AND isset($_GET["campo"])) //Se já havia uma pesquisa específica então:
							{
								if(isset($_GET["ordenadopor"])) //Se já existia uma ordenação então:
								{
									$linkeditar="?acao=editar&id=" . $dados_utilizadores["idutilizador"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] ."&ordenadopor=" . $_GET["ordenadopor"];
									$linkeliminar="?acao=eliminar&id=" . $dados_utilizadores["idutilizador"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] ."&ordenadopor=" . $_GET["ordenadopor"];
								}
								else //Se não:
								{
									$linkeditar="?acao=editar&id=" . $dados_utilizadores["idutilizador"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"];
									$linkeliminar="?acao=eliminar&id=" . $dados_utilizadores["idutilizador"] . "&pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"];
								}
							}
							else //Se não:
							{
								if(isset($_GET["ordenadopor"]))
								{
									$linkeditar="?acao=editar&id=" . $dados_utilizadores["idutilizador"] . "&ordenadopor=" . $_GET["ordenadopor"];
									$linkeliminar="?acao=eliminar&id=" . $dados_utilizadores["idutilizador"] . "&ordenadopor=" . $_GET["ordenadopor"];
								}
								else  //Se não:
								{
									$linkeditar="?acao=editar&id=" . $dados_utilizadores["idutilizador"];
									$linkeliminar="?acao=eliminar&id=" . $dados_utilizadores["idutilizador"];
								}
							}
							
						echo "<tr>"; //Início da linha da tabela
							echo "<td>" . $dados_utilizadores["idutilizador"] . "</td>" ; //Aqui vai aparecer o id do utilizador
							echo "<td>" . $dados_utilizadores["nome_utilizador"] . "</td>"; //Aqui vai aparecer o nome do utilizador
							echo "<td>" . $dados_utilizadores["email"] . "</td>"; //Aqui vai aparecer o email do utilizador
							echo "<td>" . $dados_utilizadores["cargo_utilizador"] . "</td>"; //Aqui vai aparecer o cargo do utilizador
							
							switch($dados_utilizadores["tipo_utilizador"]) //Caso o tipo de utilizador:
							{
				  //Seja A:
				  case "A": echo "<td>Administrador</td>"; //Aparece Administrador na tabela
							break; //Fim da opção
							
				  //Seja E
				  case "E": echo "<td>Estagiário</td>"; //Aparece Estagiário na tabela
							break; //Fim da opção
							
				  //Seja N
				  case "N": echo "<td>Normal</td>"; //Aparece Normal na tabela
							break; //Fim da opção
							
								default: $_SESSION["mensagemerro"]="O tipo de utilizador é inválido, por favor informe o administrador."; //Passa a mensagem de erro
										 header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro;
							}
								
							echo "<td><div align='Center'><a href='" . $linkeditar . "'><i class='fa fa-pencil' style='color: Black;'></i></a></div></td>"; //Botão para editar os dados
							echo "<td><div align='Center'><a href='" . $linkeliminar . "'><i class='fa fa-close' style='color: Black;'></i></a></div></td>"; //Botão para eliminar os dados
						echo "</tr>"; //Fim da linha
						}
					echo "</tbody>"; //Fim dos campos da tabela
				echo "</table>"; //Fim da tabela
			echo "</div>"; //Fim da zona da tabela
					}
					elseif($linhas_utilizadores==0) //Se não se retornar 0 linhas, significa que não existe nenhum utilizador preenchida então:
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
																									"'<option value=\'idutilizador\'>Id</option>' +" .
																									"'<option value=\'nome_utilizador\'>Nome</option>' +" .
																									"'<option value=\'email\'>Email</option>' +" .
																									"'<option value=\'cargo_utilizador\'>Cargo</option>' +" .
																									"'<option value=\'tipo_utilizador\'>Tipo de utilizador</option>' +" .
																								"'</select>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<label class=\'textoordenar\' id=\'textoordenar\'>Ordernar por:</label>' +" .
																								"'<br>' +" .
																								"'<br>' +" .
																								"'<select name=\'selectordenar\' class=\'selectordenar\' id=\'selectordenar\'>' +" .
																									"'<option value=\'idutilizador\'>Id (Crescente)</option>' +" .
																									"'<option value=\'idutilizador DESC\'>Id (Decrescente)</option>' +" .
																									"'<option value=\'nome_utilizador\'>Nome (Crescente)</option>' +" .
																									"'<option value=\'nome_utilizador DESC\'>Nome (Descrescente)</option>' +" .
																									"'<option value=\'email\'>Email (Crescente)</option>' +" .
																									"'<option value=\'email DESC\'>Email (Decrescente)</option>' +" .
																									"'<option value=\'cargo_utilizador\'>Cargo (Crescente)</option>' +" .
																									"'<option value=\'cargo_utilizador DESC\'>Cargo (Decrescente)</option>' +" .
																									"'<option value=\'tipo_utilizador\'>Tipo de utilizador (Crescente)</option>' +" .
																									"'<option value=\'tipo_utilizador DESC\'>Tipo de utilizador (Decrescente)</option>' +" .
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
												 "location.href='ConsultarUtilizadores.php';" . //Volta para a página original
											 "});" .
										 "});" .
									 "</script>";
								
								echo $javascriptpesquisa; //Executa o que está programado para a pesquisa específica
								echo $preselecionado; //Executa o que está programado para o preselecionamento das caixas de seleção e da caixa de texto ter o que já tinha
							}
							else //Se não:
							{
								echo "<script>" .
										"window.addEventListener('load', function()" .
										"{" .
											"var segundos=5;" . //Variável que vai conter os segundos
											
											"Modal('utilizador', 'Sem utilizadores inseridos.');" . //Abre o Modal de que ainda não foi inserido nada
											
											"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir utilizadores dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página de inserir utilizadores dentro de 5 segundos
											"document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
											
											"setTimeout(function()" . //Ao fim de 6 segundos acontecerá:
											"{" .
												"location.href='InserirUtilizadores.php';" . //Redireciona para a página de inserir utilizadores
											"}, 6000);" .
											
											"setInterval(function()" . //De 1 em 1 segundo:
											"{" .
												"if(segundos==1)" . //Se falta 1 segundo então vai meter a palavra segundos no singular
												"{" .
													"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir utilizadores dentro de ' + segundos + ' segundo.';" .
													"segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
												"}" .
												"else" .
												"{" .
													"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir utilizadores dentro de ' + segundos + ' segundos.';" .
													"segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
												"}" .
											"}, 1000);" .
										"});" .
									"</script>";
							}
						}
						elseif($linhas_utilizadores<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
							{
								$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
				}
				else //Se não, se ocorreu um erro:
				{
					if((isset($_GET["pesquisa"])) AND (isset($_GET["campo"]))) //Se foi feita uma pesquisa específica:
					{
						if(isset($_GET["ordenadopor"])) //Se foi feita uma ordenação então:
						{
							//Se o campo digitado não for nenhum válido
							if(($_GET["campo"]!="idutilizador") AND ($_GET["campo"]!="nome_utilizador") AND ($_GET["campo"]!="email") AND ($_GET["campo"]!="cargo_utilizador") AND ($_GET["campo"]!="tipo_utilizador"))
							{
								//se a ordenação digitada não for nenhum válido
								if(($_GET["ordenadopor"]!="idutilizador") AND ($_GET["ordenadopor"]!="idutilizador DESC") AND ($_GET["ordenadopor"]!="nome_utilizador") AND ($_GET["ordenadopor"]!="nome_utilizador DESC") AND ($_GET["ordenadopor"]!="email") AND ($_GET["ordenadopor"]!="email DESC") AND ($_GET["ordenadopor"]!="cargo_utilizador") AND ($_GET["ordenadopor"]!="cargo_utilizador DESC") AND ($_GET["ordenadopor"]!="tipo_utilizador") AND ($_GET["ordenadopor"]!="tipo_utilizador DESC"))
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
								if(($_GET["ordenadopor"]!="idutilizador") AND ($_GET["ordenadopor"]!="idutilizador DESC") AND ($_GET["ordenadopor"]!="nome_utilizador") AND ($_GET["ordenadopor"]!="nome_utilizador DESC") AND ($_GET["ordenadopor"]!="email") AND ($_GET["ordenadopor"]!="email DESC") AND ($_GET["ordenadopor"]!="cargo_utilizador") AND ($_GET["ordenadopor"]!="cargo_utilizador DESC") AND ($_GET["ordenadopor"]!="tipo_utilizador") AND ($_GET["ordenadopor"]!="tipo_utilizador DESC"))
								{
									//Recarrega a página e mensagem a avisar que a ordenação que digitou é inválida
									header("Location: ?pesquisa=" . $_GET["pesquisa"] . "&campo=" . $_GET["campo"] . "&ordenadopor=A_ordenacao_que_digitou_e_invalida");
								}
								else //Se não:
								{
									$_SESSION["mensagemerro"]="Erro ao consultar os utilizadores, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
						}
						else //Se não
						{
							//Se o campo é inválido
							if(($_GET["campo"]!="idutilizador") AND ($_GET["campo"]!="nome_utilizador") AND ($_GET["campo"]!="email") AND ($_GET["campo"]!="cargo_utilizador") AND ($_GET["campo"]!="tipo_utilizador"))
							{
								//Recarrega a página e mensagem a avisar que o campo que digitou é inválido
								header("Location: ?pesquisa=" . $_GET["pesquisa"] . "&campo=O_campo_que_digitou_e_invalido");
							}
							else //Se não
							{
								$_SESSION["mensagemerro"]="Erro ao consultar os utilizadores, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
					}
					else //Se não
					{
						if(isset($_GET["ordenadopor"])) //Se foi feita uma ordenação:
						{
							//Se o ordenar é inválido:
							if(($_GET["ordenadopor"]!="idutilizador") AND ($_GET["ordenadopor"]!="idutilizador DESC") AND ($_GET["ordenadopor"]!="nome_utilizador") AND ($_GET["ordenadopor"]!="nome_utilizador DESC") AND ($_GET["ordenadopor"]!="email") AND ($_GET["ordenadopor"]!="email DESC") AND ($_GET["ordenadopor"]!="cargo_utilizador") AND ($_GET["ordenadopor"]!="cargo_utilizador DESC") AND ($_GET["ordenadopor"]!="tipo_utilizador") AND ($_GET["ordenadopor"]!="tipo_utilizador DESC"))
							{
								//Recarrega a página e mensagem a avisar que a ordenação que digitou é inválida
								header("Location: ?ordenadopor=A_ordenacao_que_digitou_e_invalida");
							}
							else //Se nao
							{
								$_SESSION["mensagemerro"]="Erro ao consultar os utilizadores, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
						else //Se nao
						{
							$_SESSION["mensagemerro"]="Erro ao consultar os utilizadores, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: ConsultarUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
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