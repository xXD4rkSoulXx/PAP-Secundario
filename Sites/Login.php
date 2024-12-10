<!-- Começar a explicar a partir do HTML e só depois voltar aqui para cima -->
<!-- Inicio dos códigos PHP -->
<?php
	include "PHP//Conexao.php"; //Executa o código da página Conexao.php dentro da página PHP para fazer a ligação à base de dados
	
	session_start(); //Inicia a sessão para puder fazer a verificação se estou logado ou não, sempre que preciso de usar alguma variável da session tenho que obrigatoriamente começar por esse código
	
	if(isset($_SESSION["idutilizador"])) //Se o id do utilizador existe, significa que já tenho sessão iniciada então:
	{
		$pagina=$_SESSION["pagina"]; //A variável página recebe a página a qual estava antes
		header("Location: " . $pagina); //Redireciona-me para a página que estava antes
	}
	
	echo "<meta charset='UTF-8'>"; //Permite as acentuações no PHP
	
	if(!isset($_SESSION["mensagemerro"])) //Se não houver mensagem de erro:
	{
		if(isset($_POST["email"])) //Se a variável email existe, significa que vim via formulário e que mandei efetuar o login, então:
		{
			//Retira os espaços em branco (trim) de trás e da frente, por exemplo, "          Dado          " passa para "Dado"
			$email=trim($_POST["email"]);
			$pass=trim($_POST["pass"]);
			
			for($i=0; $i<100; $i++) //Vai repetir 100 vezes, encriptar a palavra passe e encriptar a palavra passe encriptada e assim por diante para poder ser comparada com a palavra passe do utilizador pois a palavra passe do utilizador também foi encriptada da mesma forma:
			{
				if($pass!="") //Se a palavra passe não está vazia:
				{
					$pass=MD5($pass); //A palavra passe é encriptada com a codificação MD5
				}
			}
			
			//Mete as variáveis a falso
			$erro=false;
			
			//Nota: Isto é uma função, significa que o código só é executado quando eu chamar a função
			echo "<script>" .
					 //Cria uma função de Validação cujo os parâmetros serão o campo com erro e a mensagem de erro com o objetivo se simplificar e minimizar o código
					 "function Validacao(campo, mensagem)" .
					 "{" .
						 "document.getElementById('email').value='" . $email . "';" . //A caixa de texto do email volta a ter o que estava lá escrito
						 
						 "document.getElementById('erro' + campo).innerHTML=mensagem;" . //A zona de erro recebe a mensagem de erro
						 "document.getElementById(campo).style.borderColor='red';" . //As bordas das caixas com erro ficam a vermelho
					 "}" .
				 "</script>";
			
			
			if($email=="") //Se o email está vazio vai aparecer uma mensagem de erro:
			{
				echo "<script>" .
						 "window.addEventListener('load', function()" .
						 "{" .
							 "Validacao('email', 'O email não foi preenchido.');" . //Usa a função acima que criei indicando o campo com erro (email) e a mensagem de erro (O email não foi preenchido)
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
					header("Location: Login.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
					
				$consultar_email=mysqli_query($conexao, "SELECT * FROM utilizadores WHERE email='" . $email . "';"); //Verifica se o email que introduziu existe para informar ao utilizador que enganou-se no email caso não exista
				if($consultar_email) //Se não ocorreu nenhum erro:
				{
					$linhas_email=mysqli_num_rows($consultar_email); //Obtém o número de emails iguais a esse que introduziu na base de dados 
					if($linhas_email==0) //Se retornar 0 linhas significa que esse email não existe
					{
						echo "<script>" .
								 "window.addEventListener('load', function()" .
								 "{" .
									 "Validacao('email', 'O email que introduziu não existe, poderá ter-se enganado a introduzi-lo.');" . //Usa a função acima que criei indicando o campo com erro (email) e a mensagem de erro (O email que introduziu não existe, poderá ter-se enganado a introduzi-lo.)
								 "});" .
							 "</script>";
						
						$erro=true; //A variável que indica o erro fica verdadeiro
					}
					elseif($linhas_email>1) //Se não se retornar mais que uma linha, significa que existe 2 emails iguais na base de dados que não se pode repetir então:
						{
							$_SESSION["mensagemerro"]="Erro. O email que introduziu existe mais que uma vez na base de dados, por favor informe o administrador."; //Passa a mensagem de erro
							header("Location: Login.php");  //Recarrega a página passando o erro para abrir o modal de erro
						}
						elseif($linhas_email<0) //Se não se retornar menos que zero linhas, que existe algum erro inesperado na programação então:
							{
								$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: Login.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
				}
				else //Se não:
				{
					$_SESSION["mensagemerro"]="Erro na verificação do email, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: Login.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
			}
			
			if($pass=="") //Se a palavra passe está vazia vai aparecer uma mensagem de erro:
			{
				echo "<script>" .
						 "window.addEventListener('load', function()" .
						 "{" .
							 "Validacao('pass', 'A palavra passe não foi preenchida.');" . //Usa a função acima que criei indicando o campo com erro (pass) e a mensagem de erro (A palavra passe não foi preenchida)
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
					header("Location: Login.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
				
				$login=mysqli_query($conexao, "SELECT * FROM utilizadores WHERE email='" . $email . "' AND pass='" . $pass . "';"); //Efetua o Login verificando se o email e a palavra passe estão corretos
				if($login) //Se não ocorreu nenhum erro:
				{	
					$linhas_login=mysqli_num_rows($login); //Obtém o número de contas com esse email e essa palavra passe 
					if($linhas_login==1) //Se houver uma conta então:
					{
						$dados_login=mysqli_fetch_array($login); //Obtém os dados da conta
						$_SESSION["idutilizador"]=$dados_login["idutilizador"]; //Guarda o id do utilizador
						$_SESSION["tipo_utilizador"]=$dados_login["tipo_utilizador"]; //Guarda o tipo de utilizador
						
						if($_SESSION["tipo_utilizador"]=="A") //Se o tipo de utilizador for um administrador então:
						{
							$_SESSION["vista"]="A"; //Inicializa o modo de vista como administrador
						}
						
						if(isset($_SESSION["pagina"])) //Se a variável de sessão página existe:
						{
							header("Location: " . $_SESSION["pagina"]); //Redireciona para a página que estava
						}
						else
						{
							header("Location: Inicio.php"); //Redireciona para a página inicial
						}
					}
					elseif($linhas_login==0) //Se não se não houver nenhuma conta com esse email e essa palavra passe significa que ou o utilizador errou no email ou o utilizador errou na palavra passe então:
						{
							echo "<script>" .
									 "window.addEventListener('load', function()" .
									 "{" .
										 "Validacao('pass', 'O email ou a palavra passe estão errados.');" . //Usa a função acima que criei indicando o campo com erro (pass) e a mensagem de erro (O email ou a palavra passe estão errados.)
									 "});" .
								 "</script>";
						}
						elseif($linhas_login>1) //Se não se existe mais que uma conta vai passar mensagem de erro pois não pode existir 2 contas com o mesmo email e a mesma palavra passe muito menos existir 2 emails iguais então:
							{
								$_SESSION["mensagemerro"]="Erro. Existe mais que uma conta com esse email e essa palavra passe, por favor informe o administrador."; //Passa a mensagem de erro
								header("Location: Login.php"); //Recarrega a página passando o erro para abrir o modal de erro
							}
							elseif($linhas_login<0) //Se não se retornar menos que 0 linhas significa que existe algum erro na programação:
								{
									$_SESSION["mensagemerro"]="Erro desconhecido. O número de linhas é inferior a 0, por favor informe o administrador."; //Passa a mensagem de erro
									header("Location: Login.php"); //Recarrega a página passando o erro para abrir o modal de erro
								}
				}
				else //Se não:
				{
					$_SESSION["mensagemerro"]="Erro ao verificar se o email e a palavra passe estão certos, por favor informe o administrador."; //Passa a mensagem de erro
					header("Location: Login.php"); //Recarrega a página passando o erro para abrir o modal de erro
				}
			}
		}
	}
	else //Se não, se foi passada uma mensagem de erro:
	{
		echo "<script>" .
				 "window.addEventListener('load', function()" .
				 "{" .
					 "Modal(" . $_SESSION["mensagemerro"] . ");" . //Abre o modal de erro para informar ao utilizador que ocorreu um erro
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
		
		<!-- Códigos externos do inserir, mais geralmente sobre a imagem e o formulário -->
		<link rel="stylesheet" href="CSS//Inserir.css"> <!-- Vai importar código css duma pasta para puder reutilizar o código do visual do formulário de inserir por todas as páginas e reduzir o número de linhas -->
		
		<!-- Códigos externos do modal -->
		<link rel="stylesheet" href="CSS//Modal.css"> <!-- Vai importar código css duma pasta para puder reutilizar o código do modal por todas as páginas e reduzir o número de linhas -->
		<script src="JS//Modal.js"></script> <!-- Vai importar código javascript duma pasta para puder reutilizar o código por todas as páginas e reduzir o número de linhas -->
		
		<!-- Códigos externos open source provenientes de outros sites -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Vai importar alguns ícones -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700&amp;lang=en"> <!-- Vai buscar o tipo de letra Josefin Sans -->
		
		<!-- Início dos estilos CSS -->
		<style>
		</style> <!-- Fim dos estilos CSS -->
		<!-- Início dos códigos Javascript -->
		<script>
			//Nota: Isto é uma função, significa que o código só é executado quando eu chamar a função
			//Cria uma função para abrir um Modal cujo o parâmetro será a mensagem de erro com o objetivo se simplificar e minimizar o código
			function Modal(mensagem)
			{	
				//Quando aparecer o modal, desativa o formulário todo para impedir que haja erros
				document.getElementById("email").disabled="disabled";
				document.getElementById("pass").disabled="disabled";
				document.getElementById("btnlogin").disabled="disabled";
				document.getElementById("btnlogin").style.cursor="context-menu"; //O ponteiro do rato volta ao normal
				
				document.getElementById("respostalogin").style.color="#E63946"; //O texto do modal fica vermelho
				document.getElementById("btnoklogin").style.backgroundColor="#E63946"; //O botão ok fica vermelho
				
				document.getElementById("btnoklogin").addEventListener("mouseover", function() //Quando passar com o rato por cima do botão:
				{
					document.getElementById("btnoklogin").style.backgroundColor="#DD3C48"; //O botão ok fica com um vermelho mais claro
				});
				
				document.getElementById("btnoklogin").addEventListener("mouseout", function()  //Quando retirar o rato de cima do botão:
				{
					document.getElementById("btnoklogin").style.backgroundColor="#E63946"; //O botão ok volta à cor que tinha
				});
				
				document.getElementById("btnoklogin").addEventListener("click", function() //Quando clicar no botão ok:
				{
					location.href="Login.php"; //Recarrega a página
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
				
				document.getElementById("respostalogin").innerHTML=mensagem; //A mensagem do modal recebe o que for passado no parâmetro mensagem
				document.getElementById("zonamodallogin").style.display="block"; //Mete o modal visível
			}
		</script> <!-- Fim dos códigos Javascript -->
	</head> <!-- Final do cabeçalho -->
	<body bgcolor="#F1FAEE"> <!-- Início do body com cor de fundo a uma tonalidade de verde sem tom -->
		<img src="ImagensSite//Computador.jpg" class="imagem" alt="Imagem do miúdo a programar"> <!-- Imagem da página do miúdo a programar -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<h1> Login </h1> <!-- Título do formulário -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
		<div class="zonainserir" id="zonalogin"> <!-- Inicia a aplicação dos estilos CSS relativos à zona de login -->
		    <form name="frmLogin" action="#" method="POST"> <!-- Início do formulário de login -->
				<input type="Text" name="email" id="email" placeholder="Introduza o email" title="Email" maxlength="120" required> <!-- Caixa de texto do email com o máximo de 120 caracteres e obrigatório o preenchimento -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<label name="erroemail" id="erroemail"></label> <!-- Caso o email não existe na base de dados, aparecerá em baixo da caixa de texto -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<input type="Password" name="pass" id="pass" placeholder="Introduza a palavra passe" title="Palavra passe" maxlength="120" required> <!-- Caixa de texto da palavra passe com o máximo de 120 caracteres e obrigatório o preenchimento -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<label name="erropass" id="erropass"></label> <!-- Caso a palavra passe esteja errada, aparecerá em baixo da caixa de texto -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
				<input type="Submit" class="btninserir" name="btnlogin" id="btnlogin" value="Iniciar sessão"> <!-- Botão para iniciar sessão -->
			</form> <!-- Fim do formulário do login -->
			<div class="zonamodal" id="zonamodallogin"> <!-- Início da zona do modal -->
				<div class="modalerro" id="modallogin"> <!-- Início do modal -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<div class="resposta" id="respostalogin"></div> <!-- Aqui vai aparecer se houve algum erro inesperado no login -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
					<div id="zonabtnmodal"> <!-- Zona dos botões do modal -->
						<br> <!-- Dá uma quebra de linha para o resto ir para baixo -->
						<button class="btnok" id="btnoklogin">Ok</button> <!-- Botão para continuar -->
					</div>
				</div>	<!-- Fim do modal -->
			</div> <!-- Fim da zona do modal -->
		</div> <!-- Fim da aplicação dos estilos CSS relativos à zona de login -->
	</body> <!-- Fim do body -->
</html> <!-- Fim do html -->
<!-- Voltar para cima para explicar o código PHP -->