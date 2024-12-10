<!-- Começar a explicar a partir do HTML e só depois voltar aqui para cima -->
<!-- Inicio dos códigos PHP -->
<?php
	include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
	
	session_start(); //Inicia a sessão para puder fazer a verificação se estou logado ou não, sempre que preciso de usar alguma variável da session tenho que obrigatoriamente começar por esse código
	
	if(!isset($_SESSION["idutilizador"])) //Se o id do utilizador não exite:
	{
		$_SESSION["pagina"]="Inicio.php"; //Variável que indica que página eu pretendia entrar para assim que fizer o login redirecionar-me de volta para esta página
		header("Location: Login.php"); //Manda para a página do Login por se o id do utilizador não existe significa que não efetoou o login
	}
	
	if(isset($_POST["selectvista"])) //Se mandei alterar a vista então:
	{
		$_SESSION["vista"]=$_POST["selectvista"]; //A variável de sessão recebe a opção que selecionei
		header("Location: Inicio.php"); //Recarrega a página para a vista
	}
	
	$_SESSION["pagina"]="Inicio.php"; //Variável que indica que página eu estou para que assim que entre numa página que não contenha permssão redirecione-me de volta a esta página aonde estava antes
	
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
	
	if(isset($_SESSION["mensagemerro"])) //Se houver mensagem de erro:
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
			*
			{
				font-family: Josefin Sans;
			}
			
			.tabela
			{
				/* Este width dá-se pela a fórmula de ((comprimento de cada campo * número de campos)+16) considerando que o campo ultimo tem width igual aos outros campo */
				width: 2600px; /* A tabela fica com 1016px de comprimento, ((185px*6 campos)+16)=1116px */
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
			//Cria uma função para abrir um Modal cujo o parâmetro será a mensagem de erro com o objetivo se simplificar e minimizar o código
			function Modal(mensagem)
			{
				document.getElementById("respostainicio").style.color="#E63946"; //O texto do modal fica vermelho
				document.getElementById("btnokinicio").style.backgroundColor="#E63946"; //O botão ok fica vermelho
				
				document.getElementById("btnokinicio").addEventListener("mouseover", function() //Quando passar com o rato por cima do botão:
				{
					document.getElementById("btnokinicio").style.backgroundColor="#DD3C48"; //O botão ok fica com um vermelho mais claro
				});
				
				document.getElementById("btnokinicio").addEventListener("mouseout", function()  //Quando retirar o rato de cima do botão:
				{
					document.getElementById("btnokinicio").style.backgroundColor="#E63946"; //O botão ok volta à cor que tinha
				});
				
				document.getElementById("btnokinicio").addEventListener("click", function() //Quando clicar no botão ok:
				{
					location.href="Inicio.php"; //Recarrega a página
				});
				
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
				
				document.getElementById("respostainicio").innerHTML=mensagem; //A mensagem do modal recebe o que for passado no parâmetro mensagem
				document.getElementById("zonamodalinicio").style.display="block"; //Mete o modal visível
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
								 header("Location: Inicio.php"); //Recarrega a página passando o erro para abrir o modal de erro;
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
				<li class="ativo"><a href="Inicio.php" id="inicio">Início</a></li> <!-- Botão para a página inicial -->
			    <li><a href="#" id="utilizadores">Utilizadores</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar utilizadores -->
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
		<div class="zonaconsultar" id="zonaconsultar"> <!-- Início da zona de consultar -->
			<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
			<?php
				if(isset($_SESSION["vista"])) //Se a variável vista existe então:
				{
					if($_SESSION["vista"]!="N") //Se a vista não é de normal então:
					{
						$avaria=true; //Mete a variável avaria a verdadeiro para aparecer a avaria
					}
				}
				else //Se não:
				{
					if($_SESSION["tipo_utilizador"]!="N") //Se o utilizador não é utilizador normal então:
					{
						$avaria=true; //Mete a variável a verdadeiro para aparecer a avaria
					}
				}
				
				if(isset($avaria)) //Se a variável avaria existe então:
				{
					include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
					
					$bd=mysqli_select_db($conexao, "Avarias"); //Seleciona a base de dados Avarias
					if(!$bd) //Se a base de dados não existe ou ocorreu um erro:
					{
						$_SESSION["mensagemerro"]="Erro na conexão à base de dados, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: Inicio.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
					
					//Pesquisa na base de dados das avarias por resolver
					$consultar_avarias=mysqli_query($conexao, "SELECT * FROM escolas es, blocos b, salas s, equipamentos eq, tipo_equipamentos tp, avarias a, tecnicos t, utilizadores u WHERE es.idescola=b.idescola AND b.idbloco=s.idbloco AND s.idsala=eq.idsala AND eq.idtpequip=tp.idtpequip AND eq.idequipamento=a.idequipamento AND a.idtecnico=t.idtecnico AND a.idutilizador=u.idutilizador AND estado='N' ORDER BY a.estado, eq.prioridade DESC;");
					
					if($consultar_avarias) //Se não ocorreu nenhum erro:
					{
						$linhas_avarias=mysqli_num_rows($consultar_avarias); //Obtém o número de avarias
						if($linhas_avarias>0) //Se retornar mais que uma linha, significa que existe pelo menos uma avaria então:
						{
			echo "<div align='Center'><h1>Avarias</h1></div>"; //Título Avarias
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
							echo "<th class='campoultimo'>Data do conserto</th>"; //Título Data de conserto
						echo "</tr>";//Fim da linha da tabela
					echo "</thead>"; //Fim do cabeçalho da tabela
					echo "<tbody>"; //Início dos campos da tabela
							for($i=0; $i<$linhas_avarias; $i++) //Vai repetir o número de avarias, por exemplo, se existir 10 avarias repete 10 vezes
							{
								$dados_avarias=mysqli_fetch_array($consultar_avarias); //Recebe os dados de cada avaria
								
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
											 header("Location: Inicio.php"); //Recarrega a página passando o erro para abrir o modal de erro;
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
												header("Location: Inicio.php"); //Recarrega a página passando o erro para abrir o modal de erro
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
											 header("Location: Inicio.php"); //Recarrega a página passando o erro para abrir o modal de erro;
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
						echo "</tr>"; //Fim da linha
							}
					echo "</tbody>"; //Fim dos campos da tabela
				echo "</table>"; //Fim da tabela
			echo "</div>"; //Fim da zona da tabela
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<div align='Center'><a href='ConsultarAvarias.php' class='link'>Ir para a página de consultar avarias</a></div>"; //Mete o link para ir para a página de consultar avarias
						}
						elseif($linhas_avarias==0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
							{
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<div align='Center'><label>Sem equipamentos avariados.</label></div>"; //Mete uma mensagem de que não existe equipamentos avariados
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
							}
							elseif($linhas_avarias<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
								{
									$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: Inicio.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
					}
					else //Se não, se ocorreu um erro:
					{ //Nota: Importante, a página estiver a dar erro de estar a ser redirecionada várias vezes poderá ser da query da tabela normal que está mal
						$_SESSION["mensagemerro"]="Erro ao consultar as avarias, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: Inicio.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
			echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
			echo "<div align='Center'><h1>Manual de Instruções</h1></div>"; //Título de manual de instruções
				
				if(isset($_SESSION["vista"])) //Se a variável vista existe então:
				{
					if($_SESSION["vista"]=="A") //Se a vista é de administrador então:
					{
			echo "<div align='Center'><iframe src='Manuais//ManualAdministrador.pdf' width='1000px' height='700px'></div>"; //Aparece o manual de instruções para os administradores
					}
					elseif($_SESSION["vista"]=="E") //Se não se a vista é de estagiário então:
						{
			echo "<div align='Center'><iframe src='Manuais//ManualEstagiario.pdf' width='1000px' height='700px'></div>"; //Aparece o manual de instruções para os estagiários
						}
						elseif($_SESSION["vista"]=="N") //Se não se a vista é de normal então:
							{
			echo "<div align='Center'><iframe src='Manuais//ManualNormal.pdf' width='1000px' height='700px'></div>"; //Aparece o manual de instruções para os utilizadores normais
							}
				}
				else //Se não:
				{
					if($_SESSION["tipo_utilizador"]=="A") //Se o utilizador é administrador então:
					{
			echo "<div align='Center'><iframe src='Manuais//ManualAdministrador.pdf' width='1000px' height='700px'></div>"; //Aparece o manual de instruções para os administradores
					}
					elseif($_SESSION["tipo_utilizador"]=="E") //Se não se o utilizador é um estagiário então:
						{
			echo "<div align='Center'><iframe src='Manuais//ManualEstagiario.pdf' width='1000px' height='700px'></div>"; //Aparece o manual de instruções para os estagiários
						}
						elseif($_SESSION["tipo_utilizador"]=="N") //Se não se o utilizador é um utilizador normal então:
							{
			echo "<div align='Center'><iframe src='Manuais//ManualNormal.pdf' width='1000px' height='700px'></div>"; //Aparece o manual de instruções para os utilizadores normais
							}
				}
			?>
		</div><!-- Fim da zona de consultar -->
		<div class="zonamodal" id="zonamodalinicio"> <!-- Início da zona do modal -->
			<div class="modalerro" id="modalinicio"> <!-- Início do modal -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<div class="resposta" id="respostainicio"></div> <!-- Aqui vai receber a mensagem de erro passada -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<div id="zonabtnmodal"> <!-- Zona dos botões do modal -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<button class="btnok" id="btnokinicio">Ok</button> <!-- Botão para continuar -->
				</div>
			</div>	<!-- Fim do modal -->
		</div> <!-- Fim da zona do modal -->
	</body> <!-- Fim do body -->
</html> <!-- Fim do html -->
<!-- Voltar para cima para explicar o código PHP -->