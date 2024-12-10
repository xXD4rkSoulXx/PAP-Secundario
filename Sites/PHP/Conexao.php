<!-- Início do PHP -->
<?php
    $conexao=mysqli_connect("localhost", "root", ""); //Conexão à base de dados com o nome do servidor, username do servidor e palavra passe do servidor
	if(!$conexao) //Se houve falha na conexão:
	{
		die("Erro na conexão ao servidor, por favor informe o administrador: " . mysqli_connect_error); //Para imediatamente a conexão e mostra o erro
	}
?> <!-- Fim do PHP -->