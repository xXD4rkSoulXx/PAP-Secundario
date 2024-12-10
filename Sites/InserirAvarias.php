<!-- Começar a explicar a partir do HTML e só depois voltar aqui para cima -->
<!-- Inicio dos códigos PHP -->
<?php
	include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
	
	session_start(); //Inicia a sessão para puder fazer a verificação se estou logado ou não, sempre que preciso de usar alguma variável da session tenho que obrigatoriamente começar por esse código
	
	if(!isset($_SESSION["idutilizador"])) //Se o id do utilizador não exite:
	{
		$_SESSION["pagina"]="InserirAvarias.php"; //Variável que indica que página eu pretendia entrar para assim que fizer o login redirecionar-me de volta para esta página
		header("Location: Login.php"); //Manda para a página do Login por se o id do utilizador não existe significa que não efetoou o login
	}
	
	if(isset($_POST["selectvista"])) //Se mandei alterar a vista então:
	{
		$_SESSION["vista"]=$_POST["selectvista"]; //A variável de sessão recebe a opção que selecionei
		header("Location: InserirAvarias.php"); //Recarrega a página para a vista
	}
	
	$_SESSION["pagina"]="InserirAvarias.php"; //Variável que indica que página eu estou para que assim que entre numa página que não contenha permição redirecione-me de volta a esta página aonde estava antes
	
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
		//Se não fizer essa verificação quando recarregar a página iria gerar o erro de duplicação e ia duplicar 2 ou + vezes a mesma avaria
		if(!isset($_SESSION["registado"])) //Se ainda não cliquei no botão para registar:
		{
			if(isset($_POST["descricao"])) //Se a variável descricao existe, significa que vim via formulário e que mandei inserir, então:
			{
				//Retira os espaços em branco (trim) de trás e da frente, por exemplo, "          Dado          " passa para "Dado"
				$descricao=trim($_POST["descricao"]);
				$idequipamento=trim($_POST["idequipamento"]);
				
				//Mete as variáveis a falso
				$erro=false;
				
				//Nota: Isto é uma função, significa que o código só é executado quando eu chamar a função
				echo "<script>" .
						 //Cria uma função de Validação cujo os parâmetros serão o campo com erro e a mensagem de erro com o objetivo se simplificar e minimizar o código
						 "function Validacao(campo, mensagem)" .
						 "{" .
							 "document.getElementById('descricao').value='" . $descricao . "';" . //A caixa de texto da descrição da avaria volta a ter o que estava lá escrito
							 "document.getElementById('idequipamento').value='" . $idequipamento . "';" . //A caixa de seleção do id do equipamento volta a ter o que estava lá selecionado
							 
							 "document.getElementById('erro' + campo).innerHTML=mensagem;" . //A zona de erro recebe a mensagem de erro
							 "document.getElementById(campo).style.borderColor='red';" . //As bordas das caixas com erro ficam a vermelho
						 "}" .
					 "</script>";
				
				
				if($descricao=="") //Se a descrição está vazia vai aparecer uma mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('descricao', 'A descrição não foi preenchida.');" . //Usa a função acima que criei indicando o campo com erro (descricao) e a mensagem de erro (A descrição não foi preenchida)
							 "});" .
						 "</script>";
					
					$erro=true; //A variável que indica o erro fica verdadeiro
				}
				
				if($idequipamento=="Escolher") //Se o id do equipamento não foi selecionado vai aparecer uma mensagem de erro:
				{
					echo "<script>" .
							 "window.addEventListener('load', function()" .
							 "{" .
								 "Validacao('idequipamento', 'O equipamento não foi selecionado.');" . //Usa a função acima que criei indicando o campo com erro (idequipamento) e a mensagem de erro (O equipamento não foi selecionado)
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
						header("Location: InserirAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
					
					$consultar_avaria=mysqli_query($conexao, "SELECT * FROM avarias WHERE idequipamento=" . $idequipamento . " AND estado='N';"); //Consulta se já existe alguma avaria reportada deste equipamento
					if($consultar_avaria) //Se foi consultado com sucesso
					{
						$linhas_avaria=mysqli_num_rows($consultar_avaria); //A variável recebe o número de avarias já reportada desse equipamento
						if($linhas_avaria>=1) //Se existe 1 ou mais avarias reportadas desse equipamento então não insere a avaria para os estagiários não tarem a ver avarias desnecessários porque se já está reportado uma vez os estágiários só precisam de ver uma ver para consertar então:
						{
							$_SESSION["registado"]=true; //A variável registado fica verdadeiro para assim não fazer a verificação para recarregar a página e não houver erro de duplicação de dados
							
							echo "<script>" .
									"window.addEventListener('load', function()" .
									"{" .
										"Modal('certo', 'Obrigado por nos informar que este equipamento está avariado mas, aparentemente, a avaria já foi reportada anteriormente, os nossos técnicos e estagiários tentarão arranjá-lo o mais brevemente possível.');" . //Abre o modal de certo para informar ao utilizador que já existe uma avaria deste equipamento
									"});" .
								 "</script>";
						}
						elseif($linhas_avaria==0) //Se não se ainda não existe nenhuma avaria deste equipamento então insere na base de dados então:
							{
								$inserir_avaria=mysqli_query($conexao, "INSERT INTO avarias VALUES(NULL, '" . $descricao . "', curdate(), 'N', NULL, " . $idequipamento . ", " . $_SESSION["idutilizador"] . ", 1);"); //Insere todos os campos na base de dados
								if($inserir_avaria) //Se não ocorreu nenhum erro:
								{	
									$_SESSION["registado"]=true; //A variável registado fica verdadeiro para assim não fazer a verificação para recarregar a página e não houver erro de duplicação de dados
									
									echo "<script>" .
											 "window.addEventListener('load', function()" .
											 "{" .
												 "Modal('certo', 'Avaria reportada com sucesso, obrigado por avisar-nos.');" . //Abre o modal de certo para informar ao utilizador que foi inserido com sucesso
											 "});" .
										 "</script>";
								}
								else //Se não:
								{
									$_SESSION["mensagemerro"]="Erro ao inserir a avaria, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: InserirAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
							}
							elseif($linhas_avaria<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
								{
									$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: InserirAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
					}
					else //Se não:
					{
						$_SESSION["mensagemerro"]="Erro ao consultar a avaria, por favor informe o administrador."; //Passa a mensagem de erro
						header("Location: InserirAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
					}
				}
			}
		}
		else //Se não significa que já cliquei no botão para registar e vai fazer o seguinte:
		{ //Se não fizer essa verificação quando recarregar a página iria gerar o erro de duplicação e ia duplicar 2 ou + vezes a mesma avaria
			unset($_SESSION["registado"]); //Elimina a variável
			header("Location: InserirAvarias.php"); //Recarrega a página e volta para a página de Inserir Avarias
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
				if(!(document.getElementById("idequipamento")==null)) //Se a caixa de seleção idequipamento existir, porque pode não existir no caso de ainda não existir equipamentos inseridos:
				{
					//Quando aparecer o modal, desativa o formulário todo para impedir que haja erros de inserir duplicado
					document.getElementById("descricao").disabled="disabled";
					document.getElementById("idequipamento").disabled="disabled";
					document.getElementById("btninseriravaria").disabled="disabled";
					document.getElementById("btninseriravaria").style.cursor="context-menu"; //O ponteiro do rato volta ao normal
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
						location.href="InserirAvarias.php"; //Recarrega a página
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
						
								  $vista="Administrador"; //A variável recebe o nome administrador para ficar mais apresentável no site
								  break; //Fim da opção
						
						//Seja E de estagiário:
						case "E": echo "<script>" .
										   "window.addEventListener('load', function()" .
										   "{" .
											   "document.getElementById('selectvista').style.width='150px';" . //A caixa de seleção fica com 150px de comprimento
										   "});" .
									   "</script>";
									   
								  $vista="Estagiário"; //A variável recebe o nome estagiário para ficar mais apresentável no site
								  break; //Fim da opção
						
						//Seja N de normal:
						case "N": echo "<script>" .
										   "window.addEventListener('load', function()" .
										   "{" .
											   "document.getElementById('selectvista').style.width='130px';" . //A caixa de seleção fica com 130px de comprimento
										   "});" .
									   "</script>";
									   
								  $vista="Normal"; //A variável recebe o nome normal para ficar mais apresentável no site
								  break; //Fim da opção
						
						default: $_SESSION["mensagemerro"]="Erro, modo de vista inválido, poderá conter erros de programação no site, por favor informe o administrador."; //Passa a mensagem de erro
								 header("Location: InserirAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro;
					}
					
					echo "<form name='frmVista' id='frmVista' action='#' method='POST'>" . //Meto o form para poder passar os dados para o PHP pois sem isto declarado não funciona
							 "<select name='selectvista' class='selectvista' id='selectvista'>" . //Cria a caixa de seleção para selecionar que vista pretendo (administrador, Estagiário ou Normal)
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
				header("Location: InserirAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
			}
			
			$consultar_equipamentos=mysqli_query($conexao, "SELECT * FROM equipamentos ORDER BY serial_number;"); //Vai buscar todos os equipamentos à base de dados
			if($consultar_equipamentos) //Se não ocorreu nenhum erro:
			{
				$linhas_equipamentos=mysqli_num_rows($consultar_equipamentos); //Obtém o número de equipamentos
				if($linhas_equipamentos>0) //Se retornar mais que uma linha, significa que existe pelo menos um equipamento então:
				{
		echo "<h1> Reportar avaria </h1>"; //Título do formulário
		echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
		echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo 
		echo "<div class='zonainserir' id='zonainserir'>"; //Inicia a aplicação dos estilos CSS relativos à zona de inserir o formulário
			echo "<form name='frmInserir' action='#' method='POST'>"; //Início do formulário para inserir avarias
				echo "<textarea name='descricao' id='descricao' placeholder='Introduza o descrição da avaria com todos os promenores que conseguir citar.' title='Descrição da avaria' cols='20' rows='50' maxlength='1000' required></textarea>"; //Caixa de texto para inserir a descrição da avaria com o máximo de 1000 caracteres e obrigatório o preenchimento
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<label name='errodescricao' id='errodescricao'></label>"; //Caso haja erro, aparecerá em baixo da caixa de texto
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<select name='idequipamento' id='idequipamento' title='Equipamento (Por ordem alfabética)'>"; //Caixa de seleção para selecionar o equipamento avariado
					echo "<option value='Escolher' selected>Selecione o número de série do equipamento avariado:</option>"; //Opção por defeito
					
					for($i=0; $i<$linhas_equipamentos; $i++) //Vai repetir o número de equipamentos, por exemplo, se houver 2 equipamentos vai repetir 2 vezes
					{
						$dados_equipamentos=mysqli_fetch_array($consultar_equipamentos); //Vai buscar os dados do equipamento
						echo "<option value='" . $dados_equipamentos["idequipamento"] . "'>" . $dados_equipamentos["serial_number"] . "</option>"; //Cria as opções com os números de série existentes
					}
				
				echo "</select>";
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<label name='erroidequipamento' id='erroidequipamento'></label>"; //Caso haja erro, aparecerá em baixo da caixa de seleção
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<br>"; //Dá uma quebra de linha para o resto ir para baixo
				echo "<input type='Submit' class='btninserir' name='btninseriravaria' id='btninseriravaria' value='Reportar avaria'>"; //Botão para inserir avarias
			echo "</form>"; //Fim do formulário para inserir avarias
				}
				elseif($linhas_equipamentos==0) //Se não se retornar 0 linhas, significa que não existe nenhum equipamento preenchido então:
					{
						if(isset($_SESSION["vista"])) //Se a variável vista existe
						{
							if($_SESSION["vista"]=="A") //Se a vista é de administrador então pode ser redirecionado para a página de inserir equipamentos:
							{
								echo "<script>" .
											"window.addEventListener('load', function()" .
											"{" .
												"var segundos=5;" . //Variável que vai conter os segundos
												
												"Modal('computador', 'Sem equipamentos inseridos.');" . //Abre o Modal de que ainda não foi inserido nada
												
												"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir equipamentos dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página de inserir equipamentos dentro de 5 segundos
												"document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
												"document.getElementById('imagemsite').style.marginLeft='30%';" . //A imagem afasta-se da esquerda 30% da ecrã
												
												"setTimeout(function()" . //Ao fim de 6 segundos acontecerá:
												"{" .
													"location.href='InserirComputadores.php';" . //Redireciona para a página de inserir equipamentos
												"}, 6000);" .
												
												"setInterval(function()" . //De 1 em 1 segundo:
												"{" .
													"if(segundos==1)" . //Se falta 1 segundo então vai meter a palavra segundos no singular
													"{" .
														"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir equipamentos dentro de ' + segundos + ' segundo.';" .
														"segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
													"}" .
													"else" .
													"{" .
														"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir equipamentos dentro de ' + segundos + ' segundos.';" .
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
												
												"Modal('avaria', 'Sem equipamentos inseridos, por favor informe o administrador.');" . //Abre o Modal de que ainda não foi inserido nada
												
												"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página inicial dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página inicial dentro de 5 segundos
												"document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
												"document.getElementById('imagemsite').style.marginLeft='30%';" . //A imagem afasta-se da esquerda 30% da ecrã
												
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
							if($_SESSION["tipo_utilizador"]=="A") //Se o tipo de utilizador é de administrador então pode ser redirecionado para a página de inserir equipamentos:
							{
								echo "<script>" .
											"window.addEventListener('load', function()" .
											"{" .
												"var segundos=5;" . //Variável que vai conter os segundos
												
												"Modal('computador', 'Sem equipamentos inseridos.');" . //Abre o Modal de que ainda não foi inserido nada
												
												"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir equipamentos dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página de inserir equipamentos dentro de 5 segundos
												"document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
												"document.getElementById('imagemsite').style.marginLeft='30%';" . //A imagem afasta-se da esquerda 30% da ecrã
												
												"setTimeout(function()" . //Ao fim de 6 segundos acontecerá:
												"{" .
													"location.href='InserirComputadores.php';" . //Redireciona para a página de inserir equipamentos
												"}, 6000);" .
												
												"setInterval(function()" . //De 1 em 1 segundo:
												"{" .
													"if(segundos==1)" . //Se falta 1 segundo então vai meter a palavra segundos no singular
													"{" .
														"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir equipamentos dentro de ' + segundos + ' segundo.';" .
														"segundos--;" . //Diminui a variável segundos para ir acompanhando o tempo
													"}" .
													"else" .
													"{" .
														"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página para inserir equipamentos dentro de ' + segundos + ' segundos.';" .
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
												
												"Modal('avaria', 'Sem equipamentos inseridos, por favor informe o administrador.');" . //Abre o Modal de que ainda não foi inserido nada
												
												"document.getElementById('zonabtnmodal').innerHTML='Será redirecionado à página inicial dentro de ' + segundos + ' segundos.';" . //Faz os botões desaparecerem e aparece a mensagem que vai redirecionar para a página inicial dentro de 5 segundos
												"document.getElementById('zonabtnmodal').className='resposta';" . //A zona dos botões foi removido os botões e apareceu a mensagem da contagem recebe o estilo de texto igual ao do texto de cima
												"document.getElementById('imagemsite').style.marginLeft='30%';" . //A imagem afasta-se da esquerda 30% da ecrã
												
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
					elseif($linhas_equipamentos<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
						{
							$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: InserirAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
						}
			}
			else //Se não:
			{
				$_SESSION["mensagemerro"]="Erro ao consultar os equipamentos, por favor informe o administrador."; //Passa a mensagem de erro
				header("Location: InserirAvarias.php"); //Recarrega a página passando o erro para abrir o modal de erro
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