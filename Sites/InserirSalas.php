<!-- Começar a explicar a partir do HTML e só depois voltar aqui para cima -->
<!-- Inicio dos códigos PHP -->
<?php
	include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
	
	session_start(); //Inicia a sessão para puder fazer a verificação se estou logado ou não, sempre que preciso de usar alguma variável da session tenho que obrigatoriamente começar por esse código
	
	if(!isset($_SESSION["idutilizador"])) //Se o id do utilizador não exite:
	{
		$_SESSION["pagina"]="InserirSalas.php"; //Variável que indica que página eu pretendia entrar para assim que fizer o login redirecionar-me de volta para esta página
		header("Location: Login.php"); //Manda para a página do Login por se o id do utilizador não existe significa que não efetoou o login
	}
	
	if(isset($_POST["selectvista"])) //Se mandei alterar a vista então:
	{
		$_SESSION["vista"]=$_POST["selectvista"]; //A variável de sessão recebe a opção que selecionei
		header("Location: InserirSalas.php"); //Recarrega a página para a vista
	}
	
	//Ideia de redirecionar-me para a página que queria sem sucesso
	if((!($_SESSION["tipo_utilizador"]=="A")) OR (!($_SESSION["vista"]=="A"))) //Se o utilizador não é Administrador:
	{
		if($_SESSION["pagina"]=="InserirSalas.php") //Se a página que estiver for o InserirSalas.php, significa que provavelmente tinha tentado entrar nesta página mas redirecionou-me para a página de login por ainda não ter sessão inciada aí fiz o login mas a conta aonde estou não contêm permissões de Administrador então:
		{
			header("Location: Inicio.php"); //Manda para a página do início porque esta página é só para os Administradores
		}
		else //Se não:
		{
			header("Location: " . $_SESSION["pagina"]); //Manda para a página que estava antes porque esta página é só para os Administradores
		}
	}
	//Ideia de redirecionar-me para a página que queria sem sucesso
	
	$_SESSION["pagina"]="InserirSalas.php"; //Variável que indica que página eu estou para que assim que entre numa página que não contenha permição redirecione-me de volta a esta página aonde estava antes
	
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
		//Se não fizer essa verificação quando recarregar a página iria gerar o erro de duplicação e ia duplicar 2 ou + vezes a mesma sala
		if(!isset($_SESSION["registado"])) //Se ainda não cliquei no botão para registar:
		{
			if(isset($_POST["nome_sala"])) //Se a variável nome sala existe, significa que vim via formulário e que mandei inserir, então:
			{
				//Retira os espaços em branco (trim) de trás e da frente, por exemplo, "          Dado          " passa para "Dado"
				$nome_sala=trim($_POST["nome_sala"]);
				$idbloco=trim($_POST["idbloco"]);
				
				//Mete as variáveis a falso
				$erro=false;
				
				//Nota: Isto é uma função, significa que o código só é executado quando eu chamar a função
				echo "<script>" .
						 //Cria uma função de Validação cujo os parâmetros serão o campo com erro e a mensagem de erro com o objetivo se simplificar e minimizar o código
						 "function Validacao(campo, mensagem)" .
						 "{" .
							 "document.getElementById('nome_sala').value='" . $nome_sala . "';" . //A caixa de texto do nome da sala volta a ter o que estava lá escrito
							 "document.getElementById('idbloco').value='" . $idbloco . "';" . //A caixa de seleção do id do bloco volta a ter o que estava lá selecionado
							 
							 "document.getElementById('erro' + campo).innerHTML=mensagem;" . //A zona de erro recebe a mensagem de erro
							 "document.getElementById(campo).style.borderColor='red';" . //As bordas das caixas com erro ficam a vermelho
						 "}" .
					 "</script>";
				
				
				if($nome_sala=="") //Se o nome da sala está vazio vai aparecer uma mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('nome_sala', 'O nome da sala não foi preenchido.');" . //Usa a função acima que criei indicando o campo com erro (nome da sala) e a mensagem de erro (O nome da sala não foi preenchido)
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
						header("Location: InserirSalas.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
						
					$consultar_nome=mysqli_query($conexao, "SELECT * FROM salas s WHERE s.nome_sala='" . $nome_sala . "' AND s.idbloco='" . $idbloco . "';"); //Verifica se já existe alguma sala dum bloco duma escola repetido, por exemplo se existe 2 salas 10 do bloco B da Escola Secundária Daniel Sampaio
					if($consultar_nome) //Se não ocorreu nenhum erro:
					{
						$linhas_nome=mysqli_num_rows($consultar_nome); //Obtém o número de salas com esse bloco com essa escola com esse nome
						if($linhas_nome==1) //Se retornar uma linha significa que já existe uma sala com esse bloco com essa escola com esse nome
						{
							echo "<script>" .
									 "window.addEventListener('load', function()" .
									 "{" .
										 "Validacao('nome_sala', 'O nome da sala com esse bloco com essa escola com esse nome que introduziu já existe.');" . //Usa a função acima que criei indicando o campo com erro (nome_sala) e a mensagem de erro (O nome da sala com esse bloco com essa escola com esse nome que introduziu já existe)
									 "});" .
								 "</script>";
							
							$erro=true; //A variável que indica o erro fica verdadeiro
						}
						elseif($linhas_nome>1) //Se não se retornar mais que uma linha, significa que existe 2 salas com esse bloco com essa escola com esse nome com esse nome na base de dados que não se pode repetir então:
							{
								$_SESSION["mensagemerro"]="Erro. O nome da sala com esse bloco com essa escola com esse nome que introduziu existe mais que uma vez na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: InserirSalas.php");  //Recarrega a página passando o erro para abrir o modal de erro
							}
							elseif($linhas_nome<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
								{
									$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: InserirSalas.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
					}
					else //Se não:
					{
						$_SESSION["mensagemerro"]="Erro ao consultar se o nome da sala com esse bloco com essa escola com esse nome já existe, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: InserirSalas.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
				
				if($idbloco=="Escolher") //Se o id do bloco não foi selecionado vai aparecer uma mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('idbloco', 'O bloco não foi selecionado.');" . //Usa a função acima que criei indicando o campo com erro (idbloco) e a mensagem de erro (O bloco não foi selecionado)
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
						header("Location: InserirSalas.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
					
					$inserir_sala=mysqli_query($conexao, "INSERT INTO salas VALUES(NULL, '" . $nome_sala . "', " . $idbloco . ");"); //Insere todos os campos na base de dados
					if($inserir_sala) //Se não ocorreu nenhum erro:
					{	
						$_SESSION["registado"]=true; //A variável registado fica verdadeiro para assim não fazer a verificação para recarregar a página e não houver erro de duplicação de dados
						
						echo "<script>" .
								 "window.addEventListener('load', function()" .
								 "{" .
									 "Modal('certo', 'Sala inserida com sucesso.');" . //Abre o modal de certo para informar ao utilizador que foi inserido com sucesso
								 "});" .
							 "</script>";
					}
					else //Se não:
					{
						$_SESSION["mensagemerro"]="Erro ao inserir a sala, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: InserirSalas.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
			}
		}
		else //Se não significa que já cliquei no botão para registar e vai fazer o seguinte:
		{ //Se não fizer essa verificação quando recarregar a página iria gerar o erro de duplicação e ia duplicar 2 ou + vezes a mesma sala
			unset($_SESSION["registado"]); //Elimina a variável
			header("Location: InserirSalas.php"); //Recarrega a página e volta para a página de Inserir Salas
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
				if(!(document.getElementById("idbloco")==null)) //Se a caixa de seleção idbloco existir, porque pode não existir no caso de ainda não existir blocos inseridos:
				{
					//Quando aparecer o modal, desativa o formulário todo para impedir que haja erros de inserir duplicado
					document.getElementById("nome_sala").disabled="disabled";
					document.getElementById("idbloco").disabled="disabled";
					document.getElementById("btninserirsala").disabled="disabled";
					document.getElementById("btninserirsala").style.cursor="context-menu"; //O ponteiro do rato volta ao normal
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
				}
				
				if(!(document.getElementById("btnokinserir")==null)) //Se o botão ok inserir existir, porque pode não existir no caso usar modals com 2 botões ou modals sem botão então:
				{
					document.getElementById("btnokinserir").addEventListener("click", function() //Quando clicar no botão ok:
					{
						location.href="InserirSalas.php"; //Recarrega a página
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
								 header("Location: InserirSalas.php"); //Recarrega a página passando o erro para abrir o modal de erro;
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
				<li class="ativo"><a href="#" id="salas">Salas</a></li> <!-- Botão para abrir o submenu com as opções para depois inserir ou consultar salas -->
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
				header("Location: InserirSalas.php"); //Recarrega a página passando o erro para abrir o modal de erro
			}
			
			$consultar_blocos=mysqli_query($conexao, "SELECT * FROM escolas e, blocos b WHERE e.idescola=b.idescola ORDER BY nome_escola, nome_bloco;"); //Vai buscar todas os blocos de todas as escolas à base de dados
			if($consultar_blocos) //Se não ocorreu nenhum erro:
			{
				$linhas_blocos=mysqli_num_rows($consultar_blocos); //Obtém o número de blocos
				if($linhas_blocos>0) //Se retornar mais que uma linha, significa que existe pelo menos um blocos então:
				{
		echo "<h1> Inserir sala </h1>"; //Título do formulário
		echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
		echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo 
		echo "<div class='zonainserir' id='zonainserir'>"; //Inicia a aplicação dos estilos CSS relativos à zona de inserir o formulário
			echo "<form name='frmInserir' action='#' method='POST'>"; //Início do formulário para inserir salas
				echo "<input type='Text' name='nome_sala' id='nome_sala' placeholder='Introduza o nome da sala' title='Nome da sala' maxlength='120' required>"; //Caixa de texto para inserir o nome da sala com o máximo de 120 caracteres e obrigatório o preenchimento
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<label name='erronome_sala' id='erronome_sala'></label>"; //Caso haja erro, aparecerá em baixo da caixa de texto
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<select name='idbloco' id='idbloco' title='Bloco'>"; //Caixa de seleção para selecionar o bloco a que esta sala pertence
					echo "<option value='Escolher' selected>Selecione o bloco:</option>"; //Opção por defeito
					
					for($i=0; $i<$linhas_blocos; $i++) //Vai repetir o número de blocos, por exemplo, se houver 2 blocos vai repetir 2 vezes
					{
						$dados_blocos=mysqli_fetch_array($consultar_blocos); //Vai buscar os dados do bloco
						echo "<option value='" . $dados_blocos["idbloco"] . "'>" . $dados_blocos["nome_escola"] . " Bloco " . $dados_blocos["nome_bloco"] . "</option>"; //Cria as opções com os nomes dos blocos existentes
					}
				
				echo "</select>";
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<label name='erroidbloco' id='erroidbloco'></label>"; //Caso haja erro, aparecerá em baixo da caixa de seleção
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<input type='Submit' class='btninserir' name='btninserirsala' id='btninserirsala' value='Inserir sala'>"; //Botão para inserir salas
			echo "</form>"; //Fim do formulário para inserir salas
				}
				elseif($linhas_blocos==0) //Se não se retornar 0 linhas, significa que não existe nenhum bloco preenchida então:
					{
						echo "<script>" .
									"window.addEventListener('load', function()" .
									"{" .
										"var segundos=5;" . //Variável que vai conter os segundos
										
										"Modal('escola', 'Sem blocos inseridos.');" . //Abre o Modal de que ainda não foi inserido nada
										
										"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir blocos dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página de inserir blocos dentro de 5 segundos
										"document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
										"document.getElementById('imagemsite').style.marginLeft='30%';" . //A imagem afasta-se da esquerda 30% da ecrã
										
										"setTimeout(function()" . //Ao fim de 6 segundos acontecerá:
										"{" .
											"location.href='InserirBlocos.php';" . //Redireciona para a página de inserir blocos
										"}, 6000);" .
										
										"setInterval(function()" . //De 1 em 1 segundo:
										"{" .
											"if(segundos==1)" . //Se falta 1 segundo então vai meter a palavra segundos no singular
											"{" .
												"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir blocos dentro de ' + segundos + ' segundo.';" .
												"segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
											"}" .
											"else" .
											"{" .
												"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir blocos dentro de ' + segundos + ' segundos.';" .
												"segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
											"}" .
										"}, 1000);" .
									"});" .
								"</script>";
					}
					elseif($linhas_blocos<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
						{
							$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: InserirSalas.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
			}
			else //Se não:
			{
				$_SESSION["mensagemerro"]="Erro ao inserir os blocos, por favor informe o administrador."; //Passa a mensagem de erro
				header("Location: InserirSalas.php"); //Recarrega a página passando o erro para abrir o modal de erro
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