<!-- Início do PHP -->
<?php
    session_start(); //Começa a sessão
	session_destroy(); //Elimina a sessão junto com todas as variáveis se sessão
	
	echo "<script>" .
			 "window.addEventListener('load', function()" .
			 "{" .
				 "if(!(typeof(sessionStorage.getItem('inserirutilizadores'))=='undefined'))" . //Se a variável inserirutilizadores existir:
				 "{" .
					 //Elimina todas as variáveis
					 "sessionStorage.removeItem('inserirutilizadores');" .
					 "sessionStorage.removeItem('consultarutilizadores');" .
					 "sessionStorage.removeItem('inseriragrupamentos');" .
					 "sessionStorage.removeItem('consultaragrupamentos');" .
					 "sessionStorage.removeItem('inserirescolas');" .
					 "sessionStorage.removeItem('consultarescolas');" .
					 "sessionStorage.removeItem('inserirblocos');" .
					 "sessionStorage.removeItem('consultarblocos');" .
					 "sessionStorage.removeItem('inserirsalas');" .
					 "sessionStorage.removeItem('consultarsalas');" .
					 "sessionStorage.removeItem('inserirequipamentos');" .
					 "sessionStorage.removeItem('consultarequipamentos');" .
					 "sessionStorage.removeItem('inseriravarias');" .
					 "sessionStorage.removeItem('consultaravarias');" .
				 "}" .
			 "});" .
		 "</script>";
	
	header("Location: Login.php"); //Redireciona-me para a página do Login
?> <!-- Fim do PHP -->