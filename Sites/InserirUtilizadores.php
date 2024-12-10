<!-- Começar a explicar a partir do HTML e só depois voltar aqui para cima -->
<!-- Inicio dos códigos PHP -->
<?php
	include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
	
	session_start(); //Inicia a sessão para puder fazer a verificação se estou logado ou não, sempre que preciso de usar alguma variável da session tenho que obrigatoriamente começar por esse código
	
	if(!isset($_SESSION["idutilizador"])) //Se o id do utilizador não exite:
	{
		$_SESSION["pagina"]="InserirUtilizadores.php"; //Variável que indica que página eu pretendia entrar para assim que fizer o login redirecionar-me de volta para esta página
		header("Location: Login.php"); //Manda para a página do Login por se o id do utilizador não existe significa que não efetoou o login
	}
	
	if(isset($_POST["selectvista"])) //Se mandei alterar a vista então:
	{
		$_SESSION["vista"]=$_POST["selectvista"]; //A variável de sessão recebe a opção que selecionei
		header("Location: InserirUtilizadores.php"); //Recarrega a página para a vista
	}
	
	//Ideia de redirecionar-me para a página que queria sem sucesso
	if((!($_SESSION["tipo_utilizador"]=="A")) OR (!($_SESSION["vista"]=="A"))) //Se o utilizador não é administrador:
	{
		if($_SESSION["pagina"]=="InserirUtilizadores.php") //Se a página que estiver for a InserirUtilizadores.php, significa que provavelmente tinha tentado entrar nesta página mas redirecionou-me para a página de login por ainda não ter sessão inciada aí fiz o login mas a conta aonde estou não contêm permissões de administrador então:
		{
			header("Location: Inicio.php"); //Manda para a página do início porque esta página é só para os administradores
		}
		else //Se não:
		{
			header("Location: " . $_SESSION["pagina"]); //Manda para a página que estava antes porque esta página é só para os administradores
		}
	}
	//Ideia de redirecionar-me para a página que queria sem sucesso
	
	$_SESSION["pagina"]="InserirUtilizadores.php"; //Variável que indica que página eu estou para que assim que entre numa página que não contenha permição redirecione-me de volta a esta página aonde estava antes
	
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
		//Se não fizer essa verificação quando recarregar a página iria gerar o erro de duplicação e ia duplicar 2 ou + vezes o mesmo utilizador
		if(!isset($_SESSION["registado"])) //Se ainda não cliquei no botão para registar:
		{
			if(isset($_POST["nome_utilizador"])) //Se a variável nome de utilizador existe, significa que vim via formulário e que mandei inserir, então:
			{
				//Retira os espaços em branco (trim) de trás e da frente, por exemplo, "          Dado          " passa para "Dado"
				$nome_utilizador=trim($_POST["nome_utilizador"]);
				$email=trim($_POST["email"]);
				$pass=trim($_POST["pass"]);
				$repetepass=trim($_POST["repetepass"]);
				$cargo_utilizador=trim($_POST["cargo_utilizador"]);
				$tipo_utilizador=trim($_POST["tipo_utilizador"]);
				
				for($i=0; $i<100; $i++) //Vai repetir 100 vezes, encriptar a palavra passe e encriptar a palavra passe encriptada e assim por diante por segurança:
				{
					if($pass!="") //Se a palavra passe não está vazia:
					{
						$pass=MD5($pass); //A palavra passe é encriptada com a codificação MD5
					}
					
					if($repetepass!="") //Se o repetir palavra passe não está vazio:
					{
						$repetepass=MD5($repetepass); //O repete palavra passe é encriptado com a codificação MD5
					}
				}
				
				//Mete as variáveis a falso
				$erro=false;
				$passvalidada=false;
				$repetepassvalido=false;
				
				//Nota: Isto é uma função, significa que o código só é executado quando eu chamar a função
				echo "<script>" .
						 //Cria uma função de Validação cujo os parâmetros serão o campo com erro e a mensagem de erro com o objetivo se simplificar e minimizar o código
						 "function Validacao(campo, mensagem)" .
						 "{" .
							 "document.getElementById('nome_utilizador').value='" . $nome_utilizador . "';" . //A caixa de texto do nome do utilizador volta a ter o que estava lá escrito
							 "document.getElementById('email').value='" . $email . "';" . //A caixa de texto do email volta a ter o que estava lá escrito
							 "document.getElementById('cargo_utilizador').value='" . $cargo_utilizador . "';" . //A caixa de texto do cargo do utilizador volta a ter o que estava lá escrito
							 "document.getElementById('tipo_utilizador').value='" . $tipo_utilizador . "';" . //A caixa de seleção do tipo de utilizador volta a ter o que estava lá selecionado
							 
							 "document.getElementById('erro' + campo).innerHTML=mensagem;" . //A zona de erro recebe a mensagem de erro
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
								header("Location: InserirUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
								
							$consultar_email=mysqli_query($conexao, "SELECT * FROM utilizadores WHERE email='" . $email . "';"); //Verifica se já existe alguém com este email
							if($consultar_email) //Se não ocorreu nenhum erro:
							{
								$linhas_email=mysqli_num_rows($consultar_email); //Obtém o número de pessoas com esse email
								if($linhas_email==1) //Se retornar uma linha significa que já existe um utilizador com esse email
								{
									echo "<script>" .
											 "window.addEventListener('load', function()" .
											 "{" .
												 "Validacao('email', 'O email que introduziu já existe.');" . //Usa a função acima que criei indicando o campo com erro (email) e a mensagem de erro (O email que introduziu já existe)
											 "});" .
										 "</script>";
									
									$erro=true; //A variável que indica o erro fica verdadeiro
								}
								elseif($linhas_email>1) //Se não se retornar mais que uma linha, significa que existe 2 pessoas com esse email um utilizador não pode ter um email que já existe então:
									{
										$_SESSION["mensagemerro"]="Erro. O email que introduziu existe mais que uma vez na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
										header("Location: InserirUtilizadores.php");  //Recarrega a página passando o erro para abrir o modal de erro
									}
									elseif($linhas_email<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
										{
											$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
											header("Location: InserirUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
										}
							}
							else //Se não:
							{
								$_SESSION["mensagemerro"]="Erro ao consultar se o email já existe, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: InserirUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
						}
				
				if($pass=="") //Se o campo palavra passe está vazio vai aparecer mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('pass', 'A palavra passe não foi preenchida.');" . //Usa a função acima que criei indicando o campo com erro (palavra passe) e a mensagem de erro (A palavra passe não foi preenchida)
							 "});" .
						 "</script>";
					
					$erro=true; //A variável que indica o erro fica verdadeiro
				}
				else //Se não:
				{
					$passvalidada=true; //A variável que indica se a palavra passe está validada fica verdadeiro
				}
				
				if($repetepass=="") //Se o campo repetir palavra passe está vazio vai aparecer mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('repetepass', 'O repetir palavra passe não foi preenchido.');" . //Usa a função acima que criei indicando o campo com erro (palavra passe) e a mensagem de erro (O repetir palavra passe não foi preenchida)
							 "});" .
						 "</script>";
					
					$erro=true; //A variável que indica o erro fica verdadeiro
				}
				else //Se não:
				{
					$repetepassvalidado=true; //A variável que indica se o repetir palavra passe está validada fica verdadeiro
				}
				
				if(($passvalidada) AND ($repetepassvalidado)) //Se a palavra passe e o repetir palavra passe não estão vazios verifica se eles são iguais então:
				{
					if($pass!=$repetepass) //Se a palavra passe é diferente do repetir palavra passe:
					{
						echo "<script>" .
								 "window.addEventListener('load', function()" .
								 "{" .
									 "Validacao('pass', 'As palavras passes não coincidem.');" . //Usa a função acima que criei indicando o campo com erro (palavra passe) e a mensagem de erro (As palavras passes não coincidem)
									 "document.getElementById('repetepass').style.borderColor='red';" . //A caixa de texto do campo repetir palavra passe fica com as bordas vermelhas
								 "});" .
							 "</script>";
					
						$erro=true; //A variável que indica o erro fica verdadeiro
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
				
				if($tipo_utilizador=="Escolher") //Se está selecionado a opção "Selecione o tipo de utilizador" significa que o utilizador ainda não selecionou então:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('tipo_utilizador', 'O tipo de utilizador não foi selecionado.');" . //Usa a função acima que criei indicando o campo com erro (palavra passe) e a mensagem de erro (O tipo de utilizador não foi selecionado)
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
						header("Location: InserirUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
					
					$inserir_utilizador=mysqli_query($conexao, "INSERT INTO utilizadores VALUES(NULL, '" . $nome_utilizador . "', '" . $email . "', '" . $pass. "', '" . $cargo_utilizador . "', '" . $tipo_utilizador . "');"); //Insere todos os campos na base de dados
					if($inserir_utilizador) //Se não ocorreu nenhum erro:
					{	
						$_SESSION["registado"]=true; //A variável registado fica verdadeiro para assim não fazer a verificação para recarregar a página e não houver erro de duplicação de dados
						
						echo "<script>" .
								 "window.addEventListener('load', function()" .
								 "{" .
									 "Modal('certo', 'Utilizador inserido com sucesso.');" . //Abre o modal de certo para informar ao utilizador que foi inserido com sucesso
								 "});" .
							 "</script>";
					}
					else //Se não:
					{
						$_SESSION["mensagemerro"]="Erro ao inserir o utilizador, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: InserirUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
			}
		}
		else //Se não significa que já cliquei no botão para registar e vai fazer o seguinte:
		{ //Se não fizer essa verificação quando recarregar a página iria gerar o erro de duplicação e ia duplicar 2 ou + vezes o mesmo utilizador
			unset($_SESSION["registado"]); //Elimina a variável
			header("Location: InserirUtilizadores.php"); //Recarrega a página e volta para a página de Inserir Utilizadores
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
				//Quando aparecer o modal, desativa o formulário todo para impedir que haja erros de inserir duplicado
				document.getElementById("nome_utilizador").disabled="disabled";
				document.getElementById("email").disabled="disabled";
				document.getElementById("pass").disabled="disabled";
				document.getElementById("repetepass").disabled="disabled";
				document.getElementById("cargo_utilizador").disabled="disabled";
				document.getElementById("tipo_utilizador").disabled="disabled";
				document.getElementById("btninserirutilizador").disabled="disabled";
				document.getElementById("btninserirutilizador").style.cursor="context-menu"; //O ponteiro do rato volta ao normal
				
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
				}
				
				if(!(document.getElementById("btnokinserir")==null)) //Se o botão ok inserir existir, porque pode não existir no caso usar modals com 2 botões ou modals sem botão então:
				{
					document.getElementById("btnokinserir").addEventListener("click", function() //Quando clicar no botão ok:
					{
						location.href="InserirUtilizadores.php"; //Recarrega a página
					});
				}
				
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
						
								  $vista="administrador"; //A variável recebe o nome Admnistrador para ficar mais apresentável no site
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
								 header("Location: InserirUtilizadores.php"); //Recarrega a página passando o erro para abrir o modal de erro;
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
		<img src="ImagensSite//Computador.jpg" class="imagem" alt="Imagem do miúdo a programar"> <!-- Imagem da página do miúdo a programar -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<h1> Inserir utilizador </h1> <!-- Título do formulário -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<div class="zonainserir" id="zonainserir"> <!-- Inicia a aplicação dos estilos CSS relativos à zona de inserir o formulário -->
		    <form name="frmInserir" action="#" method="POST"> <!-- Início do formulário para inserir utilizadores-->
				<input type="Text" name="nome_utilizador" id="nome_utilizador" placeholder="Introduza o nome do utilizador" title="Nome do utilizador" maxlength="120" required> <!-- Caixa de texto para inserir o nome do utilizador com o máximo de 120 caracteres e obrigatório o preenchimento -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<label name="erronome_utilizador" id="erronome_utilizador"></label> <!-- Caso haja erro, aparecerá em baixo da caixa de texto -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<input type="Text" name="email" id="email" placeholder="Introduza o email" title="Email" maxlength="120" required> <!-- Caixa de texto para inserir o email com o máximo de 120 caracteres e obrigatório o preenchimento -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<label name="erroemail" id="erroemail"></label> <!-- Caso haja erro, aparecerá em baixo da caixa de texto -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<input type="Password" name="pass" id="pass" placeholder="Introduza a palavra passe" title="Palavra passe" maxlength="120" required> <!-- Caixa de texto para inserir a palavra passe com o máximo de 120 caracteres e obrigatório o preenchimento -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<label name="erropass" id="erropass"></label> <!-- Caso haja erro, aparecerá em baixo da caixa de texto -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<input type="Password" name="repetepass" id="repetepass" placeholder="Reintroduza a palavra passe" title="Repetir palavra passe" maxlength="120" required> <!-- Caixa de texto para inserir a repetição da palavra passe com o máximo de 120 caracteres e obrigatório o preenchimento -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<label name="errorepetepass" id="errorepetepass"></label> <!-- Caso haja erro, aparecerá em baixo da caixa de texto -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<input type="Text" name="cargo_utilizador" id="cargo_utilizador" placeholder="Introduza o cargo do utilizador" title="Cargo do utilizador" maxlength="120" required> <!-- Caixa de texto para inserir o cargo do utilizador com o máximo de 120 caracteres e obrigatório o preenchimento -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<label name="errocargo_utilizador" id="errocargo_utilizador"></label> <!-- Caso haja erro, aparecerá em baixo da caixa de texto -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<select name="tipo_utilizador" id="tipo_utilizador"> <!-- Caixa de seleção para selecionar o tipo de utilizador -->
					<option value="Escolher" selected>Selecione o tipo de utilizador:</option> <!-- Mensagem por defeito -->
					<option value="A">Administrador</option> <!-- Opção de Administrador -->
					<option value="E">Estagiário</option> <!-- Opção de Estagiário -->
					<option value="N">Normal</option> <!-- Opção de Normal -->
				</select>
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<label name="errotipo_utilizador" id="errotipo_utilizador"></label> <!-- Caso haja erro, aparecerá em baixo da caixa de seleção -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<input type="Submit" class="btninserir" name="btninserirutilizador" id="btninserirutilizador" value="Inserir utilizador"> <!-- Botão para inserir utilizador -->
			</form> <!-- Fim do formulário para inserir utilizadores-->
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