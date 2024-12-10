<!-- Começar a explicar a partir do HTML e só depois voltar aqui para cima -->
<!-- Inicio dos códigos PHP -->
<?php
	include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
	
	session_start(); //Inicia a sessão para puder fazer a verificação se estou logado ou não, sempre que preciso de usar alguma variável da session tenho que obrigatoriamente começar por esse código
	
	if(!isset($_SESSION["idutilizador"])) //Se o id do utilizador não exite:
	{
		$_SESSION["pagina"]="InserirMonitores.php"; //Variável que indica que página eu pretendia entrar para assim que fizer o login redirecionar-me de volta para esta página
		header("Location: Login.php"); //Manda para a página do Login por se o id do utilizador não existe significa que não efetoou o login
	}
	
	if(isset($_POST["selectvista"])) //Se mandei alterar a vista então:
	{
		$_SESSION["vista"]=$_POST["selectvista"]; //A variável de sessão recebe a opção que selecionei
		header("Location: InserirMonitores.php"); //Recarrega a página para a vista
	}
	
	//Ideia de redirecionar-me para a página que queria sem sucesso
	if((!($_SESSION["tipo_utilizador"]=="A")) OR (!($_SESSION["vista"]=="A"))) //Se o utilizador não é Administrador:
	{
		if($_SESSION["pagina"]=="InserirMonitores.php") //Se a página que estiver for o InserirMonitores.php, significa que provavelmente tinha tentado entrar nesta página mas redirecionou-me para a página de login por ainda não ter sessão inciada aí fiz o login mas a conta aonde estou não contêm permissões de Administrador então:
		{
			header("Location: Inicio.php"); //Manda para a página do início porque esta página é só para os Administradores
		}
		else //Se não:
		{
			header("Location: " . $_SESSION["pagina"]); //Manda para a página que estava antes porque esta página é só para os Administradores
		}
	}
	//Ideia de redirecionar-me para a página que queria sem sucesso
	
	$_SESSION["pagina"]="InserirMonitores.php"; //Variável que indica que página eu estou para que assim que entre numa página que não contenha permição redirecione-me de volta a esta página aonde estava antes
	
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
		//Se não fizer essa verificação quando recarregar a página iria gerar o erro de duplicação e ia duplicar 2 ou + vezes o mesmo monitor
		if(!isset($_SESSION["registado"])) //Se ainda não cliquei no botão para registar:
		{
			if(isset($_POST["serial_number"])) //Se a variável serial_number existe, significa que vim via formulário e que mandei inserir, então:
			{
				if(isset($_FILES["btnfotoinserirescondido"]["name"])) //Se o nome da fotografia do monitor existe, significa que a fotografia do monitor existe então:
				{
					//Retira os espaços em branco (trim) de trás e da frente, por exemplo, "          Dado          " passa para "Dado"
					$serial_number=trim($_POST["serial_number"]);
					$posto=trim($_POST["posto"]);
					$fabricante=trim($_POST["fabricante"]);
					$modelo=trim($_POST["modelo"]);
					$resolucao=trim($_POST["resolucao"]);
					$polegadas=trim($_POST["polegadas"]);
					$quantidade=trim($_POST["quantidade"]);
					$novo_nome_foto=date("dmyhis") . time(); //O novo nome da fotografia será dia, mês, ano, hora, minuto, segundo e total de segundos desde janeiro de 1970 para evitar repetições no nome
					$foto=$_FILES["btnfotoinserirescondido"]["tmp_name"]; //Variável que contém a fotografia
					$extensao=$_FILES["btnfotoinserirescondido"]["type"]; //Variável que contém a extensão da fotografia
					$prioridade=trim($_POST["prioridade"]);
					$operacional=trim($_POST["operacional"]);
					$idsala=trim($_POST["idsala"]);
					
					//Mete as variáveis a falso
					$erro=false;
					$x=false; //Variável que verificará se a resolução contêm o x ou o X
					
					//Nota: Isto é uma função, significa que o código só é executado quando eu chamar a função
					echo "<script>" .
							 //Cria uma função de Validação cujo os parâmetros serão o campo com erro e a mensagem de erro com o objetivo se simplificar e minimizar o código
							 "function Validacao(campo, mensagem)" .
							 "{" .
								 "document.getElementById('serial_number').value='" . $serial_number . "';" . //A caixa de texto do número de série volta a ter o que estava lá escrito
								 "document.getElementById('posto').value='" . $posto . "';" . //A caixa de texto do posto volta a ter o que estava lá escrito
								 "document.getElementById('fabricante').value='" . $fabricante . "';" . //A caixa de texto do fabricante volta a ter o que estava lá escrito
								 "document.getElementById('modelo').value='" . $modelo . "';" . //A caixa de texto do modelo volta a ter o que estava lá escrito
								 "document.getElementById('resolucao').value='" . $resolucao . "';" . //A caixa de texto da resolução volta a ter o que estava lá escrito
								 "document.getElementById('polegadas').value='" . $polegadas . "';" . //A caixa de texto das polegadas volta a ter o que estava lá escrito
								 "document.getElementById('quantidade').value='" . $quantidade . "';" . //A caixa de texto da quantidade volta a ter o que estava lá escrito
								 "document.getElementById('idsala').value='" . $idsala . "';" . //A caixa de seleção do id da sala volta a ter o que estava lá selecionado
								 
								 "if('" . $prioridade . "'=='S')" . //Se o monitor tinha perioridade então:
								 "{" .
									 "document.getElementById('prioridadesim').click();" . //Volta a selecionar a opção sim
								 "}" .
								 "else if('" . $prioridade . "'=='N')" . //Se não se o monitor não tinha prioridade então:
									 "{" .
									     "document.getElementById('prioridadenao').click();" . //Volta a selecionar a opção não
									 "}" .
									 "else" . //Se não se acontecer um erro inesperado:
									 "{" .
										 "document.getElementById('erroprioridade').value='Erro desconhecido a verificar qual opção de prioridade estava selecionada, por favor contacte o Administrador.';" . //Escreve a mensagem de erro
									 "}" .
								 
								 "if('" . $operacional . "'=='S')" . //Se o monitor está operacional então:
								 "{" .
									 "document.getElementById('operacionalsim').click();" . //Volta a selecionar a opção sim
								 "}" .
								 "else if('" . $operacional . "'=='N')" . //Se não se o monitor não está operacional então:
									 "{" .
										 "document.getElementById('operacionalnao').click();" . //Volta a selecionar a opção não
									 "}" .
									 "else" . //Se não se acontecer um erro inesperado:
									 "{" .
										 "document.getElementById('errooperacional').value='Erro desconhecido a verificar qual opção de operacional estava selecionada, por favor contacte o Administrador.';" . //Escreve a mensagem de erro
									 "}" .
								 
								 "document.getElementById('erro' + campo).innerHTML=mensagem;" . //A zona de erro recebe a mensagem de erro
								 
								 "if(campo=='foto')" . //Se o campo com erro é o da fotografia do monitor então:
								 "{" .
									 "document.getElementById('btnfotoinserirescondido').style.marginLeft='-350px';" . //Aproxima da esquerda o botão escondido de inserir fotos para não ficar visível pois vai estar debaixo do botão personalizado que foi criado e mais bonito
									 "campo='fotoinserir';" . //A variável campo recebe o id das zona das bordas da foto para ficar vermelho
								 "}" .
								 
								 "document.getElementById(campo).style.borderColor='red';" . //As bordas das caixas com erro ficam a vermelho
							 "}" .
						 "</script>";
					
					switch($extensao) //Caso a extensão da fotografia:
					{	
						//Seja jpg:
					    case "image/jpeg": $extensao=".jpg"; //A variável extensão recebe o .jpg
										   $diretorio_novo="ImagensEquipamentos//" . $novo_nome_foto . $extensao; //A variável diretorio_novo recebe o caminho da pasta que vai armazenar as fotografias dos equipamentos todos
										   break;
										   
						//Seja png:
					    case "image/png": $extensao=".png"; //A variável extensão recebe o .png
										  $diretorio_novo="ImagensEquipamentos//" . $novo_nome_foto . $extensao; //A variável diretorio_novo recebe o caminho da pasta que vai armazenar as fotografias dos equipamentos todos
										  break;
										  
						//Seja bmp:
						case "image/bmp": $extensao=".bmp"; //A variável extensão recebe o .bmp
										  $diretorio_novo="ImagensEquipamentos//" . $novo_nome_foto . $extensao; //A variável diretorio_novo recebe o caminho da pasta que vai armazenar as fotografias dos equipamentos todos
										  break;
										 
					    default: echo "<script>" .
									      "window.addEventListener('load', function()" .
										  "{" .
										      "Validacao('foto', 'A fotografia que introduziu contém uma extensão inválida.');" . //Usa a função acima que criei indicando o campo com erro (foto) e a mensagem de erro (A fotografia que introduziu contém uma extensão inválida.)
											  "document.getElementById('btnfotoinserirescondido').style.marginLeft='0px';" . //Mete para que o botão de inserir fotografias escondido fique debaixo do botão de inserir fotografias mostrado escondido para não ver-se
										  "});" .
									  "</script>";
									  
									  $erro=true; //A variável que indica o erro fica verdadeiro
					}
					
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
							header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
							
						$consultar_serial_number=mysqli_query($conexao, "SELECT * FROM equipamentos WHERE serial_number='" . $serial_number . "';"); //Verifica se já existe alguma equipamento com esse número de série
						if($consultar_serial_number) //Se não ocorreu nenhum erro:
						{
							$linhas_serial_number=mysqli_num_rows($consultar_serial_number); //Obtém o número de equipamentos com esse número de série
							if($linhas_serial_number==1) //Se retornar uma linha significa que já existe um equipamento com esse número de série
							{
								echo "<script>" .
										 "window.addEventListener('load', function()" .
										 "{" .
											 "Validacao('serial_number', 'O número de série que introduziu já existe.');" . //Usa a função acima que criei indicando o campo com erro (serial_number) e a mensagem de erro (O número de série que introduziu já existe)
										 "});" .
									 "</script>";
								
								$erro=true; //A variável que indica o erro fica verdadeiro
							}
							elseif($linhas_serial_number>1) //Se não se retornar mais que uma linha, significa que existe 2 equipamentos com esse número de série na base de dados que não se pode repetir então:
								{
									$_SESSION["mensagemerro"]="Erro. O número de série que introduziu existe mais que uma vez na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: InserirMonitores.php");  //Recarrega a página passando o erro para abrir o modal de erro
								}
								elseif($linhas_serial_number<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
									{
										$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
										header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
									}
						}
						else //Se não:
						{
							$_SESSION["mensagemerro"]="Erro ao consultar se o número de série já existe, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
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
								header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
								
							$consultar_posto=mysqli_query($conexao, "SELECT * FROM equipamentos WHERE posto='" . $posto . "' AND idsala=" . $idsala . ";"); //Verifica se já existe alguma equipamento com esse posto nessa sala
							if($consultar_posto) //Se não ocorreu nenhum erro:
							{
								$linhas_posto=mysqli_num_rows($consultar_posto); //Obtém o número de equipamentos com esse posto nessa sala
								if($linhas_posto==1) //Se retornar uma linha significa que já existe um equipamento com esse posto nessa sala
								{
									echo "<script>" .
											 "window.addEventListener('load', function()" .
											 "{" .
												 "Validacao('posto', 'O posto dessa sala que introduziu já existe.');" . //Usa a função acima que criei indicando o campo com erro (posto) e a mensagem de erro (O posto dessa sala que introduziu já existe)
											 "});" .
										 "</script>";
									
									$erro=true; //A variável que indica o erro fica verdadeiro
								}
								elseif($linhas_posto>1) //Se não se retornar mais que uma linha, significa que existe 2 equipamentos com esse posto nessa sala na base de dados que não se pode repetir então:
									{
										$_SESSION["mensagemerro"]="Erro. O posto dessa sala que introduziu existe mais que uma vez na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
										header("Location: InserirMonitores.php");  //Recarrega a página passando o erro para abrir o modal de erro
									}
									elseif($linhas_posto<0) //Se não se retornar menos que zero linhas, significa que existe algum erro inesperado na programação então:
										{
											$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
							}
							else //Se não:
							{
								$_SESSION["mensagemerro"]="Erro ao consultar se o posto dessa sala já existe, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
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
					
					if($resolucao=="") //Se a resolução está vazia vai aparecer uma mensagem de erro:
					{
						echo "<script>" .
								 "window.addEventListener('load', function()" .
								 "{" .
									 "Validacao('resolucao', 'A resolução não foi preenchida.');" . //Usa a função acima que criei indicando o campo com erro (resolucao) e a mensagem de erro (A resolução não foi preenchida)
								 "});" .
							 "</script>";
						
						$erro=true; //A variável que indica o erro fica verdadeiro
					}
					else //Se não:
					{
						//Anotação: str_split() converte a string num array
						for($i=0; $i<count(str_split($resolucao)); $i++) //Vai repetir a quantidade de dígitos, por exemplo, 1080x400, repete 8 vezes
						{
							if(!$erro) //Se ainda não houve erro:
							{
								//Verifica cada dígito se algum não é um número ou se não é x, se for um dígito por exemplo 1 de 1080x400 ou um x, ignora o if porque o if só está configurado em caso de erro, agora se for um dígito não é um número ou um x por exemplo D de 1080Dx400, aí entra no if para retornar erro
								if(!preg_match("|[0-9xX]|", $resolucao[$i]))
								{
									echo "<script>" .
											 "window.addEventListener('load', function()" .
											 "{" .
												 "Validacao('resolucao', 'A resolução que introduziu não pode conter letras excepto a letra x ou e a letra X que são as únicas permitidas ou não pode conter caracteres especiais.');" . //Usa a função acima que criei indicando o campo com erro (resolucao) e a mensagem de erro (contém letras (excepto o x ou o X) ou caratéres especiais)
											 "});" .
										 "</script>";
									
									$erro=true; //A variável que indica o erro fica verdadeiro
								}
								else //Se não:
								{
									if(!$x) //Se ainda não foi usado o x ou o X da resolução então:
									{
										if(($resolucao[$i]=="x") OR ($resolucao[$i]=="X")) //Se é um x ou um X então:
										{
											$x=true; //A variável que indica que foi usado o x ou o X da resolução fica a verdadeiro
										}
									}
									else //Se não, se já foi usado o x ou o X da resolução então:
									{
										if(($resolucao[$i]=="x") OR ($resolucao[$i]=="X")) //Se é um x ou um X então:
										{
											echo "<script>" .
													 "window.addEventListener('load', function()" .
													 "{" .
														 "Validacao('resolucao', 'A resolução só pode conter um x ou um X.');" . //Usa a função acima que criei indicando o campo com erro (resolucao) e a mensagem de erro (A resolução só pode conter um x ou um X.)
													 "});" .
												 "</script>";
													
											$erro=true; //A variável que indica o erro fica verdadeiro
										}
									}
								}
							}
						}
						
						if(!$erro) //Se ainda não houve erro:
						{
							if(!$x) //Se o x ou o X da resolução não foi usado então:
							{
								echo "<script>" .
										 "window.addEventListener('load', function()" .
										 "{" .
											 "Validacao('resolucao', 'A resolução que introduziu não contêm o x ou o X da resolução.');" . //Usa a função acima que criei indicando o campo com erro (resolucao) e a mensagem de erro (A resolução que introduziu não contém o x ou o X da resolução.)
										 "});" .
									 "</script>";
										
								$erro=true; //A variável que indica o erro fica verdadeiro
							}
						}
					}
					
					if($polegadas=="") //Se as polegadas estão vazias vai aparecer uma mensagem de erro:
					{
						echo "<script>" .
								 "window.addEventListener('load', function()" .
								 "{" .
									 "Validacao('polegadas', 'As polegadas não estão preenchidas.');" . //Usa a função acima que criei indicando o campo com erro (polegadas) e a mensagem de erro (As polegadas não foram preenchidas.)
								 "});" .
							 "</script>";
						
						$erro=true; //A variável que indica o erro fica verdadeiro
					}
					else //Se não:
					{
						//Anotação: str_split() converte a string num array
						for($i=0; $i<count(str_split($polegadas)); $i++) //Vai repetir a quantidade de dígitos, por exemplo, 15, repete 2 vezes
						{
							if(!$erro) //Se ainda não houve erro:
							{
								//Verifica cada dígito se algum não é um número, se for um dígito por exemplo 2 de 23, ignora o if porque o if só está configurado em caso de erro, agora se for um dígito não é um número por exemplo D de 23D, aí entra no if para retornar erro
								if(!preg_match("|[0-9]|", $polegadas[$i]))
								{
									echo "<script>" .
											 "window.addEventListener('load', function()" .
											 "{" .
												 "Validacao('polegadas', 'As polegadas que introduziu não pode conter letras ou caracteres especiais.');" . //Usa a função acima que criei indicando o campo com erro (polegadas) e a mensagem de erro (contém letras ou carateres especiais)
											 "});" .
										 "</script>";
									
									$erro=true; //A variável que indica o erro fica verdadeiro
								}
							}
						}
					}
					
					if($quantidade=="") //Se a quantidade está vazia vai aparecer uma mensagem de erro:
					{
						echo "<script>" .
								 "window.addEventListener('load', function()" .
								 "{" .
									 "Validacao('quantidade', 'A quantidade não foi preenchida.');" . //Usa a função acima que criei indicando o campo com erro (quantidade) e a mensagem de erro (A quantidade não foi preenchida.)
								 "});" .
							 "</script>";
						
						$erro=true; //A variável que indica o erro fica verdadeiro
					}
					else //Se não:
					{
						//Anotação: str_split() converte a string num array
						for($i=0; $i<count(str_split($quantidade)); $i++) //Vai repetir a quantidade de dígitos, por exemplo, 15, repete 2 vezes
						{
							if(!$erro) //Se ainda não houve erro:
							{
								//Verifica cada dígito se algum não é um número, se for um dígito por exemplo 2 de 23, ignora o if porque o if só está configurado em caso de erro, agora se for um dígito não é um número por exemplo D de 23D, aí entra no if para retornar erro
								if(!preg_match("|[0-9]|", $quantidade[$i]))
								{
									echo "<script>" .
											 "window.addEventListener('load', function()" .
											 "{" .
												 "Validacao('quantidade', 'A quantidade que introduziu não pode conter letras ou caracteres especiais.');" . //Usa a função acima que criei indicando o campo com erro (quantidade) e a mensagem de erro (contém letras ou caratéres especiais)
											 "});" .
										 "</script>";
									
									$erro=true; //A variável que indica o erro fica verdadeiro
								}
							}
						}
					}
					
					if($idsala=="Escolher") //Se o id da sala não foi selecionado vai aparecer uma mensagem de erro:
					{
						echo "<script>" .
								 "window.addEventListener('load', function()" .
								 "{" .
									 "Validacao('idsala', 'A sala não foi selecionada.');" . //Usa a função acima que criei indicando o campo com erro (idsala) e a mensagem de erro (A sala não foi selecionada)
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
							header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
						
						$inserir_foto_pasta=link($foto, $diretorio_novo); //Mete a fotografia do monitora na pasta de imagens dos equipamentos
						if($inserir_foto_pasta) //Se a fotografia foi inserida com sucesso na pasta então:
						{	//Insere na base de dados os dados relativos ao monitor
							$inserir_monitor=mysqli_query($conexao, "INSERT INTO monitores VALUES(NULL, '" . $fabricante . "', '" . $modelo . "', '" . $resolucao . "', '" . $polegadas . "', " . $quantidade . ");");
							if($inserir_monitor) //Se foi inserido com sucesso então:
							{
								$consultar_monitor=mysqli_query($conexao, "SELECT * FROM monitores;"); //Vai buscar os dados do monitor para puder buscar o id do monitor que foi inserido à pouco
								if($consultar_monitor) //Se foi consultado com sucesso então:
								{
									$linhas_monitor=mysqli_num_rows($consultar_monitor); //Vai buscar o número de monitores que existe para depois fazer uma repetição até chegar ao último monitor inserido e buscar o id
									$idmonitor=0; //Reseta a variável com o valor 0
									
									for($i=0; $i<$linhas_monitor; $i++) //Vai repetir o número de vezes da quantidade de monitor, por exemplo, se houver 3 monitores vai repetir 3 vezes
									{
										$dados_monitor=mysqli_fetch_array($consultar_monitor); //Vai buscar os dados dos monitores à base de dados
										$idmonitor=$dados_monitor["idmonitor"]; //Vai buscar o id do monitor até chegar ao último monitor inserido e buscar o id dele
									}
									
									//Insere na base de dados os dados relativos ao tipo de equipamento daí que foi necessário ter buscado à base de dados o id do monitor para puder indicar que monitor inserir, quando o id é 1 significa que não existe, como não quero inserir nem um computador, nem um quadro interativo multimédia, nem um projetor eles todos levam o valor de 1 e indico só o id do monitor que é o equipamento que quero inserir 
									$inserir_tipoequipamento=mysqli_query($conexao, "INSERT INTO tipo_equipamentos VALUES(NULL, 1, " . $idmonitor . ", 1, 1);");
									if($inserir_tipoequipamento) //Se foi inserido com sucesso então:
									{
										$consultar_tipoequipamento=mysqli_query($conexao, "SELECT * FROM tipo_equipamentos;"); //Vai buscar os dados dos tipos de equipamentos para puder buscar o último id da tabela do tipo de equipamentos
										if($consultar_tipoequipamento) //Se foi consultado com sucesso então:
										{
											$linhas_tipoequipamento=mysqli_num_rows($consultar_tipoequipamento); //Vai buscar o número de tipo de equipamentos que existe para depois fazer uma repetição até chegar ao último tipo de equipamentos que foi inserido e buscar o id
											$idtipoequipamento=0; //Reseta a variável com o valor 0
											
											for($i=0; $i<$linhas_tipoequipamento; $i++) //Vai repetir o número de vezes da quantidade de tipo de equipamentos, por exemplo, se houver 3 tipos de equipamentos vai repetir 3 vezes
											{
												$dados_tipoequipamento=mysqli_fetch_array($consultar_tipoequipamento); //Vai buscar os dados dos tipos de equipamentos à base de dados
												$idtipoequipamento=$dados_tipoequipamento["idtpequip"]; //Vai buscar o id do tipo de equipamento até chegar ao último tipo de equipamento inserido e buscar o id dele
											}
											
											//Insere na tabela equipamentos os dados relativos ao equipamento daí que foi necessário ter buscado à base de dados o id do tipo de equipamento para indicar que tipo de equipamento é que inseri à pouco
											$inserir_equipamento=mysqli_query($conexao, "INSERT INTO equipamentos VALUES(NULL, '" . $serial_number . "', '" . $diretorio_novo . "', " . $posto . ", '" . $prioridade . "', '" . $operacional . "', " . $idsala . ", " . $idtipoequipamento . ");");
											if($inserir_equipamento) //Se foi inserido com sucesso então:
											{
												echo "<script>" .
														 "window.addEventListener('load', function()" .
														 "{" .
															 "Modal('certo', 'Monitor inserido com sucesso.');" . //Abre o modal de certo para informar ao utilizador que foi inserido com sucesso
														 "});" .
													 "</script>";
											}
											else //Se não inseriu o monitor, significa que ocorreu algum erro na base de dados
											{
												$_SESSION["mensagemerro"]="Erro ao inserir o equipamento, por favor informe o administrador."; //Passa a mensagem de erro
												header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
											}
										}
										else //Se não foi consultado com sucesso, significa que ocorreu algum erro na base de dados
										{
											$_SESSION["mensagemerro"]="Erro ao consultar o id do tipo de equipamento, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
									}
									else //Se não inseriu o tipo de equipamento, significa que ocorreu algum erro na base de dados
									{
										$_SESSION["mensagemerro"]="Erro ao inserir o tipo de equipamento, por favor informe o administrador."; //Passa a mensagem de erro
										header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
									}
								}
								else //Se não foi consultado com sucesso, significa que ocorreu algum erro na base de dados
								{
									$_SESSION["mensagemerro"]="Erro ao consultar o id do monitor, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
							else //Se não foi inserido na base de dados os dados relativos ao monitor, significa que ocorreu algum erro
							{
								$_SESSION["mensagemerro"]="Erro ao inserir o monitor, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
						else //Se a fotografia não foi inserida, significa que ocorreu algum erro
						{
							$_SESSION["mensagemerro"]="Erro ao inserir a imagem na pasta, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
					}
				}
				else //Se a fotografia não existe, significa que ocorreu algum erro a passar a imagem do formulário para o PHP pois a fotografia está de preenchimento obrigatório
				{
					$_SESSION["mensagemerro"]="Erro ao procurar a fotografia do monitor, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
			}
		}
		else //Se não significa que já cliquei no botão para registar e vai fazer o seguinte:
		{ //Se não fizer essa verificação quando recarregar a página iria gerar o erro de duplicação e ia duplicar 2 ou + vezes o mesmo monitor
			unset($_SESSION["registado"]); //Elimina a variável
			header("Location: InserirMonitores.php"); //Recarrega a página e volta para a página de Inserir Monitores
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
?> <!-- Fim do PHP -->
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
		
		<!-- Códigos externos do inserir, mais geralmente sobre a imagem e o formulário -->
		<link rel="stylesheet" href="CSS//Inserir.css"> <!-- Vai importar código css duma pasta para puder reutilizar o código do menu por todas as páginas e reduzir o número de linhas -->
		
		<!-- Códigos externos do modal -->
		<link rel="stylesheet" href="CSS//Modal.css"> <!-- Vai importar código css duma pasta para puder reutilizar o código do menu por todas as páginas e reduzir o número de linhas -->
		<script src="JS//Modal.js"></script> <!-- Vai importar código javascript duma pasta para puder reutilizar o código por todas as páginas e reduzir o número de linhas -->
		
		<!-- Códigos externos open source provenientes de outros sites -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Vai importar alguns ícones -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700&amp;lang=en"> <!-- Vai buscar o tipo de letra Josefin Sans -->
		
		<!-- Início dos estilos CSS -->
		<style>
			.imagem
			{
				position: Static; /* A imagem retorna por defeito aonde estava originalmente */
				width: 700px; /* Mete o comprimento da imagem a 700px */
				margin-left: 30%; /* Afasta da esquerda a imagem 30% do comprimento do ecrã do centro do ecrã */
			}
			
			.zonaequipamento
			{
				margin: Auto; /* Centra a caixa de seleção do equipamento */
				width: 65%; /* A caixa de seleção do equipamento fica com o comprimento a 65% do comprimento do ecrã */
				position: Static; /* A caixa de seleção do equipamento volta ao sítio original */
				margin-left: 25%; /* Afasta da esquerda a caixa de seleção do equipamento 25% do comprimento do ecrã do centro do ecrã */
				border-left: 100px solid transparent; /* Mete para a borda esquerda da caixa de seleção do equipamento ficar com uma grossura de 100px mas tranparente para dar espaço sem ver-se */
			}
			
			.zonainserirequipamento
			{
				margin: Auto; /* Centra a caixa de seleção do equipamento */
				width: 65%; /* A caixa de seleção do equipamento fica com o comprimento a 65% do comprimento do ecrã */
				position: Static; /* A caixa de seleção do equipamento volta ao sítio original */
				margin-left: 25%; /* Afasta da esquerda a caixa de seleção do equipamento 25% do comprimento do ecrã do centro do ecrã */
				border-left: 100px solid transparent; /* Mete para a borda esquerda da caixa de seleção do equipamento ficar com uma grossura de 100px mas tranparente para dar espaço sem ver-se */
			}
			
			h1
			{
				margin: Auto; /* Centra o título do formulário */
				width: 65%; /* Mete para o título do formulário ficar com o comprimento de 65% do comprimento do ecrã do computador */
				margin-left: 25%; /* Afasta o título do formulário 25% do comprimento do ecrã do centro do ecrã */
				border-left: 100px solid transparent; /* Mete para a borda esquerda do título do formulário ficar com uma grossura de 100px mas tranparente para dar espaço sem ver-se */
			}
			
			input[type=text], input[type=password], select 
			{
				width: 700px; /* Mete as caixas de texto e a caixa de seleção com o comprimento de 700px */
			}
			
			.zonafoto
			{
				width: 700px; /* O comprimento da fotografia fica a 700px */
			}
			
			.btninserir
			{
				width: 700px; /* Mete o botão com comprimento de 700px */
			}
			
			@media screen and (max-width: 1650px) /* Quando o comprimento do ecrã for 1650px ou menor vai acontecer o seguinte: */
			{
				.imagem
				{
					width: 500px; /* Mete o comprimento da imagem a 500px */
				}
				
				.zonaequipamento
				{
					width: 50%; /* A caixa de seleção do equipamento fica com o comprimento a 50% do comprimento do ecrã */
				}
				
				.zonainserir
				{
					width: 50%; /* Mete para o formulário ficar com o comprimento de 50% do comprimento do ecrã do computador */
				}
				
				h1
				{
					width: 50%; /* Mete para o título do formulário ficar com o comprimento de 50% do comprimento do ecrã do computador */
				}
				
				input[type=text], input[type=password], select 
				{
					width: 500px; /* Mete as caixas de texto e a caixa de seleção com o comprimento de 500px */
				}
				
				.zonafoto
				{
					width: 500px; /* O comprimento da fotografia fica a 500px */
				}
				
				.btninserir
				{
					width: 500px; /* Mete o botão com comprimento de 500px */
				}
			}
			
			@media screen and (max-width: 1100px) /* Quando o comprimento do ecrã for 1100px ou menor vai acontecer o seguinte: */
			{
				.zonaequipamento
				{
					border-left: None; /* Retira a borda esquerda da zona do equipamento */
				}
				
				.zonainserirequipamento
				{
					border-left: None; /* Retira a borda esquerda do formulário */
				}
				
				h1
				{
					border-left: None; /* Retira a borda esquerda do título do formulário */
				}
			}

			@media screen and (max-width: 800px) /* Quando o comprimento do ecrã for 800px ou menor vai acontecer o seguinte: */
			{
				.imagem
				{
					width: 300px; /* A imagem fica com 300px de comprimento */
				}
				
				input[type=text], input[type=password], select 
				{
					width: 350px; /* Mete as caixas de texto e a caixa de seleção ficam com 350px de comprimento */
				}
				
				.zonafoto
				{
					width: 350px; /* A zona da fotografia fica com 350px de comprimento */
				}
				
				.btninserir
				{
					width: 350px; /* O botão fica com 350px de comprimento */
				}
			}
		</style> <!-- Fim dos estilos CSS -->
		<!-- Início dos códigos Javascript -->
		<script id="jsmodal">
			//Nota: Isto é uma função, significa que o código só é executado quando eu chamar a função
			//Cria uma função para abrir um Modal cujo os parâmetros serão o tipo do modal e a mensagem de erro com o objetivo se simplificar e minimizar o código
			function Modal(tipo, mensagem)
			{
				if(!(document.getElementById("idsala")==null)) //Se a caixa de seleção idsala existir, porque pode não existir no caso de ainda não existir salas inseridos:
				{
					if(tipo!="foto") //Se o modal não é o de foto então:
					{
						//Quando aparecer o modal, desativa o formulário todo para impedir que haja erros de inserir duplicado
						document.getElementById("equipamento").disabled="disabled";
						document.getElementById("serial_number").disabled="disabled";
						document.getElementById("posto").disabled="disabled";
						document.getElementById("fabricante").disabled="disabled";
						document.getElementById("modelo").disabled="disabled";
						document.getElementById("resolucao").disabled="disabled";
						document.getElementById("polegadas").disabled="disabled";
						document.getElementById("quantidade").disabled="disabled";
						document.getElementById("btnfotoinserirmostrado").disabled="disabled";
						document.getElementById("prioridadesim").disabled="disabled";
						document.getElementById("prioridadenao").disabled="disabled";
						document.getElementById("operacionalsim").disabled="disabled";
						document.getElementById("operacionalnao").disabled="disabled";
						document.getElementById("idsala").disabled="disabled";
						document.getElementById("btninserirmonitor").disabled="disabled";
						document.getElementById("btnfotoinserirmostrado").style.cursor="context-menu"; //O ponteiro do rato volta ao normal
						document.getElementById("btninserirmonitor").style.cursor="context-menu"; //O ponteiro do rato volta ao normal
					}
				}
				
				switch(tipo)
				{
					//Caso o tipo de modal seja o certo:
					case "certo": document.getElementById("respostainserir").style.color="#1CEE0E"; //O texto do modal fica verde
								  document.getElementById("btnokinserir").style.backgroundColor="#1CEE0E"; //O botão ok fica verde
								  
								  document.getElementById("btnokinserir").addEventListener("mouseover", function() //Quando passar com o rato por cima do botão:
								  {
									  document.getElementById("btnokinserir").style.backgroundColor="#2DAB24"; //O botão ok fica com um verde mais claro
								  });
								  
								  document.getElementById("btnokinserir").addEventListener("mouseout", function() //Quando retirar o rato de cima do botão:
								  {
									  document.getElementById("btnokinserir").style.backgroundColor="#1CEE0E"; //O botão ok volta à cor que tinha
								  });
								  break; //Fim da opção
					
					//Caso o tipo de modal seja o de erro:
					case "erro": document.getElementById("respostainserir").style.color="#E63946"; //O texto do modal fica vermelho
								 document.getElementById("btnokinserir").style.backgroundColor="#E63946"; //O botão ok fica vermelho
								 
								 document.getElementById("btnokinserir").addEventListener("mouseover", function() //Quando passar com o rato por cima do botão:
								 {
									document.getElementById("btnokinserir").style.backgroundColor="#DD3C48"; //O botão ok fica com um vermelho mais claro
								 });
								 
								 document.getElementById("btnokinserir").addEventListener("mouseout", function()  //Quando retirar o rato de cima do botão:
								 {
									 document.getElementById("btnokinserir").style.backgroundColor="#E63946"; //O botão ok volta à cor que tinha
								 });
								 break; //Fim da opção
								 
					//Caso o tipo de modal seja o de aviso:
					case "aviso": document.getElementById("respostainserir").style.color="#D7DF01"; //O texto do modal fica amarelo
								  break; //Fim da opção
					
					//Caso o tipo de modal seja o de utilizador:
					case "utilizador": document.getElementById("respostainserir").style.color="#000000"; //O texto do modal fica preto
									   break; //Fim da opção
									   
					//Caso o tipo de modal seja o de pass:
					case "pass": document.getElementById("respostainserir").style.color="#000000"; //O texto do modal fica preto
								 break; //Fim da opção
					
					//Caso o tipo de modal seja o de escola:
					case "escola": document.getElementById("respostainserir").style.color="#000000"; //O texto do modal fica preto
								   break; //Fim da opção
					
					//Caso o tipo de modal seja o de qim:
					case "qim": document.getElementById("respostainserir").style.color="#000000"; //O texto do modal fica preto
								break; //Fim da opção
					
					//Caso o tipo de modal seja o de computador:
					case "computador": document.getElementById("respostainserir").style.color="#000000"; //O texto do modal fica preto
									   break; //Fim da opção
					
					//Caso o tipo de modal seja o de monitor:
					case "monitor": document.getElementById("respostainserir").style.color="#000000"; //O texto do modal fica preto
									break; //Fim da opção
					
					//Caso o tipo de modal seja o de projetor:
					case "projetor": document.getElementById("respostainserir").style.color="#000000"; //O texto do modal fica preto
									 break; //Fim da opção
					
					//Caso o tipo de modal seja o de avaria:
					case "avaria": document.getElementById("respostainserir").style.color="#000000"; //O texto do modal fica preto
								   break; //Fim da opção
					
					//Caso o tipo de modal seja o de foto:
					case "foto": 
								 break; //Fim da opção
					
					//Não esquecer, anotar para não me esquecer, Caso acrescente um modal novo não esquecer de alterar no script seguinte também
				}
				
				if(!(document.getElementById("btnokinserir")==null)) //O botão inserir pode não existir por causa de ter aberto o modal com a foto e dar erro daí verificar se ele existe
				{
					document.getElementById("btnokinserir").addEventListener("click", function() //Quando clicar no botão ok:
					{
						location.href="InserirMonitores.php"; //Recarrega a página
					});
				}
				
				if(!(document.getElementById("modalinserir")==null)) //O modal inserir pode não existir por causa de ter aberto o modal com a foto e dar erro daí verificar se ele existe
				{
					if(mensagem.length>200) //Se a mensagem for muito grande então:
					{
						document.getElementById("modalinserir").style.height="450px"; //Aumento a altura do modal
					}
					else if(mensagem.length>100) //Se não se a mensagem for grande então:
						 {
							 document.getElementById("modalinserir").style.height="400px"; //Aumento a altura do modal
						 }
						 else //Se não:
						 {
							 document.getElementById("modalinserir").style.height="330px"; //Volta a ter a altura original
						 }
					
					document.getElementById("modalinserir").className="modal" + tipo; //O modal recebe a foto do tipo, por exemplo, caso seja certo fica com a imagem do certo, caso seja erro fica com a imagem do erro
					document.getElementById("respostainserir").innerHTML=mensagem; //A mensagem do modal recebe o que for passado no parâmetro mensagem
					document.getElementById("zonamodalinserir").style.display="block"; //Mete o modal visível
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
						location.href="Inserir" + document.getElementById("equipamento").value + ".php"; //Redireciona-me para a página do respetivo equipamento
					});
					
					document.getElementById("btnfotoinserirmostrado").addEventListener("click", function(e) //Quando clicar no botão de inserir fotografias que está à mostra
					{
						e.preventDefault(); //Fica na mesma página
						document.getElementById("btnfotoinserirescondido").click(); //O botão de inserir fotografias escondido recebe a indicação que é para ser clicado para poder escolher a fotografia, por este botão que está escondido é o que contêm o funcionamento e o botão visível é um botão maos bonito porém sem a capacidade de ter a mesma funcionalidade que este botão daí termos que programar que quando clicamos no botão bonito ativa o botão escondido
					});
					
					document.getElementById("btnfotoinserirescondido").addEventListener("change", function() //Quando a fotografia mudar ou receber alguma fotografia:
					{
						var foto=document.getElementById("btnfotoinserirescondido").files[0]; //A variável foto recebe a fotografia selecionada
						
						document.getElementById("tagimg").addEventListener("click", function() //Quando clicar na fotografia:
						{
							Modal("foto", ""); //Abre o modal fotografia para podermos ver a imagem toda
							document.getElementById("zonamodalinserir").style.backgroundColor="rgba(0, 0, 0, 0.9)"; //O fundo do modal fica mais escuro
							
							document.getElementById("jsmodal").innerHTML=""; //Retira o funcionamento do modal do javascript para puder a seguir adicionar o funcionamento do modal da fotografia sem haver erros
							//A parte HTML do modal muda para consoante o modal da fotografia
							document.getElementById("zonamodalinserir").innerHTML="<span class='fecharmodal' id='fecharmodal'><i class='fa fa-close'></i></span>" + //Botão para fechar o modal da fotografia
																					  "<img class='modalfoto' id='modalfoto'>" + //Aqui aparece a fotografia
																					  "<div class='nomefoto' id='nomefoto'></div>" + //Aqui aparece o nome da fotografia
																				  "</div>";
							
							document.getElementById("modalfoto").src=document.getElementById("tagimg").src; //Faz o modal receber a fotografia
							document.getElementById("nomefoto").innerHTML=document.getElementById("nomeficheiroinserir").textContent; //Faz o modal receber o nome da fotografia
							
							document.getElementById("fecharmodal").addEventListener("click", function() //Quando clicar para fechar o modal da fotografia:
							{
								document.getElementById("zonamodalinserir").style.display="none"; //Esconde o modal
								document.getElementById("zonamodalinserir").style.backgroundColor="rgba(0, 0, 0, 0.4)"; //O fundo do modal volta a estar mais claro
								document.getElementById("nomefoto").innerHTML = ""; //Retira a fotografia do modal
								
								//A parte HTML do modal volta a ter os códigos que tinha respetisoa aos outros modals
								document.getElementById("zonamodalinserir").innerHTML="<div class='' id='modalinserir'>" +
																						  "<br>" +
																						  "<br>" +
																						  "<br>" +
																						  "<br>" +
																						  "<br>" +
																						  "<br>" +
																						  "<br>" +
																						  "<br>" +
																						  "<div class='resposta' id='respostainserir'></div>" +
																						  "<br>" +
																						  "<br>" +
																						  "<div id='zonabtnmodal'>" +
																							  "<br>" +
																							  "<button class='btnok' id='btnokinserir'>Ok</button>" +
																						  "</div>" +
																					  "</div>";
								
								//O javascript do modal volta a ter os códigos javascript respetivos aos outros modals
								document.getElementById("jsmodal").innerHTML="function Modal(tipo, mensagem)" +
																			 "{" +
																				 "if(!(document.getElementById('idsala')==null))" +
																				 "{" +
																					 "if(tipo!='foto')" +
																					 "{" +
																						 "document.getElementById('equipamento').disabled='disabled';" +
																						 "document.getElementById('serial_number').disabled='disabled';" +
																						 "document.getElementById('posto').disabled='disabled';" +
																						 "document.getElementById('fabricante').disabled='disabled';" +
																						 "document.getElementById('modelo').disabled='disabled';" +
																						 "document.getElementById('resolucao').disabled='disabled';" +
																						 "document.getElementById('polegadas').disabled='disabled';" +
																						 "document.getElementById('quantidade').disabled='disabled';" +
																						 "document.getElementById('btnfotoinserirmostrado').disabled='disabled';" +
																						 "document.getElementById('prioridadesim').disabled='disabled';" +
																						 "document.getElementById('prioridadenao').disabled='disabled';" +
																						 "document.getElementById('operacionalsim').disabled='disabled';" +
																						 "document.getElementById('operacionalnao').disabled='disabled';" +
																						 "document.getElementById('idsala').disabled='disabled';" +
																						 "document.getElementById('btninserirmonitor').disabled='disabled';" +
																						 "document.getElementById('btnfotoinserirmostrado').style.cursor='context-menu';" +
																						 "document.getElementById('btninserirmonitor').style.cursor='context-menu';" +
																					 "}" +
																				 "}" +
																				 
																				 "switch(tipo)" +
																				 "{" +
																					 "case 'certo': document.getElementById('respostainserir').style.color='#1CEE0E';" +
																								   "document.getElementById('btnokinserir').style.backgroundColor='#1CEE0E';" +
																								   
																								   "document.getElementById('btnokinserir').addEventListener('mouseover', function()" +
																								   "{" +
																									   "document.getElementById('btnokinserir').style.backgroundColor='#2DAB24';" +
																								   "});" +
																								   
																								   "document.getElementById('btnokinserir').addEventListener('mouseout', function()" +
																								   "{" +
																									   "document.getElementById('btnokinserir').style.backgroundColor='#1CEE0E';" +
																								   "});" +
																								   "break;" +
																								   
																					 "case 'erro': document.getElementById('respostainserir').style.color='#E63946';" +
																								  "document.getElementById('btnokinserir').style.backgroundColor='#E63946';" +
																								  
																								  "document.getElementById('btnokinserir').addEventListener('mouseover', function()" +
																								  "{" +
																									  "document.getElementById('btnokinserir').style.backgroundColor='#DD3C48';" +
																								  "});" +
																								  
																								  "document.getElementById('btnokinserir').addEventListener('mouseout', function()" +
																								  "{" +
																									  "document.getElementById('btnokinserir').style.backgroundColor='#E63946';" +
																								  "});" +
																								  "break;" +
																					 			  
																					 "case 'aviso': document.getElementById('respostainserir').style.color='#D7DF01';" +
																								   "break;" +
																					 
																					 "case 'utilizador': document.getElementById('respostainserir').style.color='#000000';" +
																										"break;" +
																										
																					 "case 'pass': document.getElementById('respostainserir').style.color='#000000';" +
																								  "break;" +
																										
																					 "case 'escola': document.getElementById('respostainserir').style.color='#000000';" +
																									"break;" +
																					 
																					 "case 'qim': document.getElementById('respostainserir').style.color='#000000';" +
																								 "break;" +
																					 
																					 "case 'computador': document.getElementById('respostainserir').style.color='#000000';" +
																										"break;" +
																					 
																					 "case 'monitor': document.getElementById('respostainserir').style.color='#000000';" +
																									 "break;" +
																					 
																					 "case 'projetor': document.getElementById('respostainserir').style.color='#000000';" +
																									  "break;" +
																					 
																					 "case 'avaria': document.getElementById('respostainserir').style.color='#000000';" +
																									"break;" +
																									
																					 "case 'foto': " +
																								  "break;" +
																				"}" +
																				
																				"document.getElementById('btnokinserir').addEventListener('click', function()" +
																				"{" +
																					"location.href='InserirMonitores.php';" +
																				"});" +
																				
																				"if(!(document.getElementById('btnokinserir')==null))" +
																				"{" +
																					"document.getElementById('btnokinserir').addEventListener('click', function()" +
																					"{" +
																						"location.href='InserirMonitores.php';" +
																					"});" +
																				"}" +
																				
																				"if(!(document.getElementById('modalinserir')==null))" +
																				"{" +
																					"if(mensagem.length>200)" +
																					"{" +
																						"document.getElementById('modalinserir').style.height='450px';" +
																					"}" +
																					"else if(mensagem.length>100)" +
																						 "{" +
																							 "document.getElementById('modalinserir').style.height='400px';" +
																						 "}" +
																						 "else" +
																						 "{" +
																							 "document.getElementById('modalinserir').style.height='330px';" +
																						 "}" +
																					
																					"document.getElementById('modalinserir').className='modal' + tipo;" +
																					"document.getElementById('respostainserir').innerHTML=mensagem;" +
																					"document.getElementById('zonamodalinserir').style.display='block';" +
																				"}" +
																				
																				"document.getElementById('modalinserir').className='modal' + tipo;" +
																				"document.getElementById('respostainserir').innerHTML=mensagem;" +
																				"document.getElementById('zonamodalinserir').style.display='block';" +
																			 "}";
							});
						});
						
						if(foto) //Se a fotografia existe:
						{
							var ler=new FileReader(); //Variável preparada para receber ficheiros ou imagens
							ler.addEventListener("load", function() //Quando receber algum ficheiro ou imagem:
							{
								var bytesfoto=ler.result; //Variável que vai receber os bytes da fotografia
								
								document.getElementById("tagimg").src=bytesfoto; //A zona da fotografia recebe a fotografia
								document.getElementById("tagimg").style.cursor="pointer"; //Quando meto o rato por cima da fotografia o ponteiro do rato muda para o indicador
								document.getElementById("tagimg").title="Clique para ver melhor"; //Quando meto o rato por cima da fotografia aparece uma mensagem a dizer para clicar na fotografia para ver melhor
								document.getElementById("fotoinserir").classList.add("escolhida"); //A fotografia recebe os estilos CSS relativos a uma fotografia já escolhida
							});
							
							document.getElementById("btnretirarfotoinserir").addEventListener("click", function() //Quando clicar no botão para retirar a fotografia:
							{
								document.getElementById("tagimg").src=""; //Retira a fotografia
								document.getElementById("tagimg").style.cursor="context-menu"; //O ponteiro do rato volta ao normal
								document.getElementById("tagimg").title=""; //Retira a mensagem que apareceria quando metia o rato por cima da fotografia por não faz sentido dizer para clicar para ver uma fotografia que não existe pois ela já foi removida
								document.getElementById("btnfotoinserirescondido").value=""; //O botão de inserir fotografia que está escondido é resetado e fica pronto para receber uma nova fotografia
								document.getElementById("fotoinserir").classList.remove("escolhida"); //A fotografia é-lhe removida os estilos CSS relativos a uma fotografia já escolhida
							});
							
							ler.readAsDataURL(foto); //Faz a conversão dos dados da fotografia para poder ser vista no HTML
							
							if(document.getElementById("btnfotoinserirescondido").value) //Se a fotografia tem nome e não existe nenhum erro:
							{
								//A zona da fotografia recebe o nome da fotografia sem o caminho da pasta atrás assim ficando só o nome e a extensão
								document.getElementById("nomeficheiroinserir").textContent=document.getElementById("btnfotoinserirescondido").value.match(/[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/);
							}
						}
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
								 header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro;
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
		<img src="ImagensSite//Computador.jpg" class="imagem" id="imagemsite" alt="Imagem do miúdo a programar"> <!-- Imagem da página do miúdo a programar -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<!-- Inicio dos códigos PHP -->
		<?php
			include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
			
			$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
			if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
			{
				$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
				header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
			}
			
			$consultar_salas=mysqli_query($conexao, "SELECT * FROM escolas e, blocos b, salas s WHERE e.idescola=b.idescola AND b.idbloco=s.idbloco ORDER BY nome_escola, nome_bloco, nome_sala;"); //Vai buscar todas as salas de todos os blocos de todas as escolas à base de dados
			if($consultar_salas) //Se não ocorreu nenhum erro:
			{
				$linhas_salas=mysqli_num_rows($consultar_salas); //Obtém o número de salas
				if($linhas_salas>0) //Se retornar mais que uma linha, significa que existe pelo menos uma sala então:
				{
		echo "<div class='zonaequipamento'>"; //Início da zona de selecionar qual equipamento quero inserir
			echo "Equipamento:";
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<select name='equipamento' id='equipamento' title='Equipamento'>"; //Caixa de seleção para selecionar a qual equipamento quero inserir e redirecionar-me à página correta
				echo "<option value='QIMs'>Quadro interativo multimédia</option>";
				echo "<option value='Computadores'>Computador</option>";
				echo "<option value='Monitores' selected>Monitor</option>"; //Opção por defeito por estou na página de inserir monitores
				echo "<option value='Projetores'>Projetor</option>";
			echo "</select>";
		echo "</div>";
		echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
		echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
		echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
		echo "<h1> Inserir monitores </h1>"; //Título do formulário
		echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
		echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo 
		echo "<div class='zonainserirequipamento' id='zonainserir'>"; //Inicia a aplicação dos estilos CSS relativos à zona de inserir o formulário
			echo "<form name='frmInserir' action='#' method='POST' enctype='multipart/form-data'>"; //Início do formulário para inserir monitores, Anotar: O enctype='multipart/form-data' é obrigatório quando quero usar o input type file e enviar para a base de dados com o PHP
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<input type='Text' name='serial_number' id='serial_number' placeholder='Introduza o número de série' title='Número de série' maxlength='120' required>"; //Caixa de texto para inserir o número de série com o máximo de 120 caracteres e obrigatório o preenchimento
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<label name='erroserial_number' id='erroserial_number'></label>"; //Caso haja erro, aparecerá em baixo da caixa de texto
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<input type='Text' name='posto' id='posto' placeholder='Introduza o posto' title='Posto' maxlength='2' required>"; //Caixa de texto para inserir o posto com o máximo de 2 caracteres e obrigatório o preenchimento
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<label name='erroposto' id='erroposto'></label>"; //Caso haja erro, aparecerá em baixo da caixa de texto
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<input type='Text' name='fabricante' id='fabricante' placeholder='Introduza o fabricante' title='Fabricante' maxlength='120' required>"; //Caixa de texto para inserir o fabricante com o máximo de 120 caracteres e obrigatório o preenchimento
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<label name='errofabricante' id='errofabricante'></label>"; //Caso haja erro, aparecerá em baixo da caixa de texto
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<input type='Text' name='modelo' id='modelo' placeholder='Introduza o modelo' title='Modelo' maxlength='120' required>"; //Caixa de texto para inserir o modelo com o máximo de 120 caracteres e obrigatório o preenchimento
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<label name='erromodelo' id='erromodelo'></label>"; //Caso haja erro, aparecerá em baixo da caixa de texto
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<input type='Text' name='resolucao' id='resolucao' placeholder='Introduza a resolução' title='Resolução' maxlength='9' required>"; //Caixa de texto para inserir o resolução com o máximo de 9 caracteres e obrigatório o preenchimento
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<label name='erroresolucao' id='erroresolucao'></label>"; //Caso haja erro, aparecerá em baixo da caixa de texto
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<input type='Text' name='polegadas' id='polegadas' placeholder='Introduza as polegadas' title='Polegadas' maxlength='5' required>"; //Caixa de texto para inserir a polegada com o máximo de 5 caracteres e obrigatório o preenchimento
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<label name='erromodelo' id='erropolegadas'></label>"; //Caso haja erro, aparecerá em baixo da caixa de texto
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<input type='Text' name='quantidade' id='quantidade' placeholder='Introduza a quantidade' title='Quantidade' maxlength='4' required>"; //Caixa de texto para inserir a quantidade com o máximo de 4 caracteres e obrigatório o preenchimento
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<label name='erroquantidade' id='erroquantidade'></label>"; //Caso haja erro, aparecerá em baixo da caixa de texto
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<div class='zonafoto' id='zonafotoinserir'>"; //Zona de inserir a fotografia do monitor com o botão
					echo "<div class='foto' id='fotoinserir'>"; //Zona de inserir a fotografia do monitor
						echo "<div class='bordasfoto' id='bordasfotoinserir'>"; //Bordas da fotografia do monitor
							echo "<img class='tagimg' id='tagimg'>"; //Fotografia do monitor
						echo "</div>"; //Fim das bordas da fotografia do monitor
						echo "<div>"; //Início do que fica quando a fotografia ainda não foi selecionada
							echo "<div class='iconenuvem' id='iconenuveminserir'><i class='fa fa-cloud-upload'></i></div>"; //Ícone da nuvem
							echo "<div class='texto' id='textoinserir'>Sem fotografia selecionada.</div>"; //Mensagem que ainda não foi inserido nenhuma fotografia
						echo "</div>"; //Fim do que fica quando a fotografia ainda não foi selecionada
						echo "<div class='btnretirarfoto' id='btnretirarfotoinserir'><i class='fa fa-close'></i></div>"; //Cruz para retirar a fotografia
						echo "<div class='nomeficheiro' id='nomeficheiroinserir'></div>"; //Nome da fotografia que foi inserida
					echo "</div>"; //Fim da zona de inserir a fotografia do monitor
					echo "<input type='File' name='btnfotoinserirescondido' class='btnfotoescondido' id='btnfotoinserirescondido' accept='image/jpeg, image/png, imagem/bmp' required>"; //Botão para inserir a fotografia, é obrigatório e fica escondido pois o botão não é muito giro mas é necessário para funcionar
					echo "<button class='btninserir' id='btnfotoinserirmostrado'>Selecionar fotografia</button>"; //Botão mais bonito para inserir a fotografia do monitor, ele em si é bonito mas não funciona, então quando clicar faz-se depois a programação para ativar o botão escondido de inserir a fotografia
					echo "<div align='Center'><label name='errofoto' id='errofoto'></label></div>"; //Caso haja erro, aparecerá em baixo da fotografia
				echo "</div>"; //Fim da zona de inserir a fotografia do monitor com o botão
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "Prioridade: <input type='Radio' name='prioridade' id='prioridadesim' value='S' required>Sim <input type='Radio' name='prioridade' id='prioridadenao' value='N' required>Não"; //Opções sim ou não se o monitor tem prioridade para ser arranjado
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<label name='erroprioridade' id='erroprioridade'></label>"; //Caso haja erro, aparecerá em baixo da fotografia
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "Operacional: <input type='Radio' name='operacional' id='operacionalsim' value='S' required>Sim <input type='Radio' name='operacional' id='operacionalnao' value='N' required>Não"; //Opções sim ou não se o monitor está operacional, a funcionar
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<label name='errooperacional' id='errooperacional'></label>"; //Caso haja erro, aparecerá em baixo da fotografia
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<select name='idsala' id='idsala' title='Sala'>"; //Caixa de seleção para selecionar a sala a que este monitor pertence
					echo "<option value='Escolher' selected>Selecione a sala:</option>"; //Opção por defeito
					
					for($i=0; $i<$linhas_salas; $i++) //Vai repetir o número de salas, por exemplo, se houver 2 salas vai repetir 2 vezes
					{
						$dados_salas=mysqli_fetch_array($consultar_salas); //Vai buscar os dados da sala
						echo "<option value='" . $dados_salas["idsala"] . "'>" . $dados_salas["nome_escola"] . " " . $dados_salas["nome_bloco"] . $dados_salas["nome_sala"] . "</option>"; //Cria as opções com os nomes das salas existentes
					}
				
				echo "</select>";
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<label name='erroidsala' id='erroidsala'></label>"; //Caso haja erro, aparecerá em baixo da caixa de seleção
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<input type='Submit' class='btninserir' name='btninserirmonitor' id='btninserirmonitor' value='Inserir monitor'>"; //Botão para inserir monitores
			echo "</form>"; //Fim do formulário para inserir salas
				}
				elseif($linhas_salas==0) //Se não se retornar 0 linhas, significa que não existe nenhuma sala preenchida então:
					{
						echo "<script>" .
									"window.addEventListener('load', function()" .
									"{" .
										"var segundos=5;" . //Variável que vai conter os segundos
										
										"Modal('escola', 'Sem salas inseridas.');" . //Abre o Modal de que ainda não foi inserido nada
										
										"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir salas dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página de inserir salas dentro de 5 segundos
										"document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
										"document.getElementById('imagemsite').style.marginLeft='30%';" . //A imagem afasta-se da esquerda 30% da ecrã
										
										"setTimeout(function()" . //Ao fim de 6 segundos acontecerá:
										"{" .
											"location.href='InserirSalas.php';" . //Redireciona para a página de inserir salas
										"}, 6000);" .
										
										"setInterval(function()" . //De 1 em 1 segundo:
										"{" .
											"if(segundos==1)" . //Se falta 1 segundo então vai meter a palavra segundos no singular
											"{" .
												"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir salas dentro de ' + segundos + ' segundo.';" .
												"segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
											"}" .
											"else" .
											"{" .
												"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir salas dentro de ' + segundos + ' segundos.';" .
												"segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
											"}" .
										"}, 1000);" .
									"});" .
								"</script>";
					}
					elseif($linhas_salas<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
						{
							$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
			}
			else //Se não:
			{
				$_SESSION["mensagemerro"]="Erro ao consultar as salas, por favor informe o administrador."; //Passa a mensagem de erro
				header("Location: InserirMonitores.php"); //Recarrega a página passando o erro para abrir o modal de erro
			}
		?> <!-- Fim dos códigos PHP -->
			<div class="zonamodal" id="zonamodalinserir"> <!-- Início da zona do modal -->
				<div class="" id="modalinserir"> <!-- Início do modal -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<div class="resposta" id="respostainserir"></div> <!-- Aqui vai receber a confirmação se inseriu bem ou mal -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<div id="zonabtnmodal"> <!-- Zona dos botões do modal -->
						<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
						<button class="btnok" id="btnokinserir">Ok</button> <!-- Botão para continuar -->
					</div>
				</div>	<!-- Fim do modal -->
			</div> <!-- Fim da zona do modal -->
		</div> <!-- Fim da aplicação dos estilos CSS relativos à zona de inserir o formulário -->
	</body> <!-- Fim do body -->
</html> <!-- Fim do html -->
<!-- Voltar para cima para explicar o código PHP -->