window.addEventListener("load", function() //Antes da página iniciar, ele relê o código vendo todos os códigos e processando já o que há de fazer
{
	//Declaração das variáveis
	var submenu=document.querySelector(".submenuvertical"); //Variável que contem as informações do submenu
	var submenuUL=document.querySelector(".submenuvertical ul"); //Variável que contem as informações de cada item do submenu
	var submenuA=document.querySelectorAll(".submenuvertical a"); //Variável que contem as informações do link de cada item do submenu
	var divisoria=document.querySelector(".divisoria"); //Variável que contem as informações da linha que divide o menu para o submenu
	var menuaberto=false; //Variável que verifica se o menu está aberto ou fechado
	var submenuaberto=false; //Variável que verifica se o submenu está aberto ou fechado
	
	if(typeof(sessionStorage.getItem("inserirutilizadores"))=="undefined") //Se a variável global inserir utilizadores não existe então:
	{
		sessionStorage.setItem("inserirutilizadores", true); //Variável global (visível em todas as páginas) que verifica se contenho permissão de entrar na página para inserir utilizadores
		sessionStorage.setItem("consultarutilizadores", true); //Variável global (visível em todas as páginas) que verifica se contenho permissão de entrar na página para consultar utilizadores
		sessionStorage.setItem("inseriragrupamentos", true); //Variável global (visível em todas as páginas) que verifica se contenho permissão de entrar na página para inserir agrupamentos
		sessionStorage.setItem("consultaragrupamentos", true); //Variável global (visível em todas as páginas) que verifica se contenho permissão de entrar na página para consultar agrupamentos
		sessionStorage.setItem("inserirescolas", true); //Variável global (visível em todas as páginas) que verifica se contenho permissão de entrar na página para inserir escolas
		sessionStorage.setItem("consultarescolas", true); //Variável global (visível em todas as páginas) que verifica se contenho permissão de entrar na página para consultar escolas
		sessionStorage.setItem("inserirblocos", true); //Variável global (visível em todas as páginas) que verifica se contenho permissão de entrar na página para inserir blocos
		sessionStorage.setItem("consultarblocos", true); //Variável global (visível em todas as páginas) que verifica se contenho permissão de entrar na página para consultar blocos
		sessionStorage.setItem("inserirsalas", true); //Variável global (visível em todas as páginas) que verifica se contenho permissão de entrar na página para inserir salas
		sessionStorage.setItem("consultarsalas", true); //Variável global (visível em todas as páginas) que verifica se contenho permissão de entrar na página para consultar salas
		sessionStorage.setItem("inserirequipamentos", true); //Variável global (visível em todas as páginas) que verifica se contenho permissão de entrar na página para inserir equipamentos
		sessionStorage.setItem("consultarequipamentos", true); //Variável global (visível em todas as páginas) que verifica se contenho permissão de entrar na página para consultar equipamentos
		sessionStorage.setItem("inseriravarias", true); //Variável global (visível em todas as páginas) que verifica se contenho permissão de entrar na página para inserir avarias
		sessionStorage.setItem("consultaravarias", true); //Variável global (visível em todas as páginas) que verifica se contenho permissão de entrar na página para consultar avarias
	}
	
	document.getElementById("btnmenuvertical").style.backgroundImage="url(ImagensSite//MenuFechado.jpg)"; //Configura a imagem do ícone do menu vertical
	document.getElementById("logotipo").style.backgroundImage="url(ImagensSite//Logotipo.jpg)"; //Configura a imagem do logotipo
	document.getElementById("logout").style.backgroundImage="url(ImagensSite//Logout.jpg)"; //Configura a imagem botão de terminar sessão
	
	//Inicio
	document.getElementById("logotipo").addEventListener("mouseover", function() //Quando passar de cima do logotipo com o rato por cima:
	{
		document.getElementById("logotipo").style.opacity="0.7"; //O logotipo perde a opacidade ficando mais translúcido com uma opacidade de 0.7
		document.getElementById("nomesite").style.opacity="0.7"; //O nome do site perde a opacidade ficando mais translúcido com uma opacidade de 0.7
	});
	
	document.getElementById("nomesite").addEventListener("mouseover", function() //Quando passar de cima do nome do site com o rato por cima:
	{
		document.getElementById("logotipo").style.opacity="0.7"; //O logotipo perde a opacidade ficando mais translúcido com uma opacidade de 0.7
		document.getElementById("nomesite").style.opacity="0.7"; //O nome do site perde a opacidade ficando mais translúcido com uma opacidade de 0.7
	});
	
	document.getElementById("logotipo").addEventListener("mouseout", function() //Quando retiro o rato de cima do logotipo após de tê-lo passado por cima:
	{
		document.getElementById("logotipo").style.opacity="1"; //O logotipo volta a estar opaco
		document.getElementById("nomesite").style.opacity="1"; //O nome do site volta a estar opaco
	});
	
	document.getElementById("nomesite").addEventListener("mouseout", function() //Quando retiro o rato de cima do nome do site após de tê-lo passado por cima:
	{
		document.getElementById("logotipo").style.opacity="1"; //O logotipo volta a estar opaco
		document.getElementById("nomesite").style.opacity="1"; //O logotipo volta a estar opaco
	});
	
	document.getElementById("btnmenuvertical").addEventListener("mouseover", function() //Quando passar com o rato por cima do ícone do menu vertical:
	{
		document.getElementById("btnmenuvertical").style.backgroundImage="url(ImagensSite//MenuAberto.jpg)"; //Ícone do menu fica vermelho
	});
	
	document.getElementById("btnmenuvertical").addEventListener("mouseout", function() //Quando retiro o rato após de tê-lo passado por cima do ícone do menu vertical:
	{
		if(!menuaberto) //Se o menu está fechado:
		{
			document.getElementById("btnmenuvertical").style.backgroundImage="url(ImagensSite//MenuFechado.jpg)"; //Ícone do menu volta ao original
		}
	});
	
	//Abrir Menu
	document.getElementById("btnmenuvertical").addEventListener("click", function() //Quando clicar no ícone do menu vertical:
	{
		var menu=document.querySelector(".menuvertical"); //Zona azul do menu
		var menuUL=document.querySelector(".menuvertical ul"); //Zona dos itens do menu
		var menuA=document.querySelectorAll(".menuvertical a"); //Itens do menu
		
		if(!menuaberto) //Se o menu está fechado:
		{
			menuUL.style.visibility="visible"; //Mostra o menu
			menu.style.width="272px"; //Aumenta o tamanho do menu sem submenu
			
			for(var i=0; i<menuA.length; i++) //Vai repetir o número de itens, exemplo, se são 5 no menu vai repetir 5 vezes:
			{
				menuA[i].style.opacity="1"; //Mostra todos os itens do menu
			}
			
			document.getElementById("btnmenuvertical").style.backgroundImage="url(ImagensSite//MenuAberto.jpg)"; //Ícone do menu fica vermelho
			document.getElementById("btnmenuvertical").title="Fechar menu"; //Mensagem que aparece quando meto o rato por cima
			menuaberto=true; //Variável que indica que o menu aberto
		}
		else if(menuaberto) //Se não se o menu está aberto:
			 {
			     if(submenuaberto) //Se o submenu está aberto:
				 {
				     //Consultar primeiro a parte de baixo das funções Avarias e etc porque faz mais sentido começar a ver primeiro como se abre um submenu do que como fechar sem saber como foi aberto
					 
					 //Fechar com submenu
					 //Ao fim de 0,5 segundos o seguinte acontecerá:
					 setTimeout(function()
					 {
					     menu.style.width="50px"; //O menu volta ao tamanho original
						 
						 for(var i=0; i<menuA.length; i++) //Vai repetir o número de itens, exemplo, se são 5 no menu vai repetir 5 vezes:
						 {
							 menuA[i].style.opacity="0"; //Esconde todos os itens do menu
				 		 }
						 
						 menuUL.style.visibility="hidden"; //Esconde o menu
						 menuaberto=false; //Variável que indica que o menu está fechado
						 submenuaberto=false; //Variável que indica que o submenu está fechado
					 }, 500);
					 
					 submenu.style.width="0px"; //Esconde o submenu
					 divisoria.style.width="0px"; //Esconde a linha que divide do menu para o submenu
					 
					 for(var i=0; i<submenuA.length; i++) //Vai repetir o número de itens, exemplo, se são 5 no menu vai repetir 5 vezes:
					 {
						 submenuA[i].style.opacity="0"; //Esconde os itens do submenu
					 }
					 
					 submenuUL.style.visibility="hidden"; //Esconde a zona dos itens do submenu
					 document.getElementById("btnmenuvertical").style.backgroundImage="url(ImagensSite//MenuFechado.jpg)"; //Ícone do menu volta ao original
					 document.getElementById("btnmenuvertical").title="Abrir menu"; //Mensagem que aparece quando meto o rato por cima
					 
					 //Cor da letra volta a a branco
					 document.getElementById("avarias").style.color="white";
					 document.getElementById("equipamentos").style.color="white";
					 document.getElementById("utilizadores").style.color="white";
					 document.getElementById("agrupamentos").style.color="white";
					 document.getElementById("escolas").style.color="white";
					 document.getElementById("blocos").style.color="white";
					 document.getElementById("salas").style.color="white";
				 }
				 else if(!submenuaberto) //Se não se o submenu está fechado:
					  {
					      //Fechar sem submenu
						  menu.style.width="50px"; //O menu volta ao tamanho original
						  
						  for(var i=0; i<menuA.length; i++) //Vai repetir o número de itens, exemplo, se são 5 no menu vai repetir 5 vezes:
						  {
							  menuA[i].style.opacity="0"; //Esconde todos os itens do menu
						  }
						  
						  menuUL.style.visibility="hidden"; //Esconde o menu
						  document.getElementById("btnmenuvertical").style.backgroundImage="url(ImagensSite//MenuFechado.jpg)"; //Ícone do menu volta ao original
						  document.getElementById("btnmenuvertical").title="Abrir menu"; //Mensagem que aparece quando meto o rato por cima
						  menuaberto=false; //Variável que indica que o menu está fechado
					  }
					  else
					  {
						  Modal("erro", "Erro inesperado com o submenu"); //Abre o modal de erro para informar ao utilizador que ocurreu um erro
					  }
			 }
			 else
			 {
				 Modal("erro", "Erro inesperado com o menu"); //Abre o modal de erro para informar ao utilizador que ocurreu um erro
			 }
	});
	
	
	//Abrir submenu
	//Função para abrir o submenu
	function AbrirSubmenu(submenuparametro)
	{
		/* Início do código relativo ao submenu ativo  */
		var pagina=location.pathname.split("?"); //Variável que contém o link atual em forma de array o que está antes e depois aonde estiver o ? no link, nesse caso o ? representa o final do link, então só existirá 1 índice para o array, 2 ou + se for um método GET
		var tamanholetraspagina=pagina[0].length; //Variável que contém o número de letras do link antes do primeiro ? que nesse caso o final se não houver método GET
		var extensao=".php"; //Variável que contem a extensão da página, nesse caso as páginas todas contém a extensão .php
		var tamanholetrasextensao=extensao.length; //Variável que contém o número de letras da extensão, nesse caso 4
		var tamanholetrassubmenu=submenuparametro.length; //Variável que contém o número de letras do submenu ao qual cliquei, por exemplo, Utilizadores, 12 letras
		var parousubmenu=false; //Variável que verifica se o submenu que cliquei é aonde estou atualmente ou não
		var j=0; //Variável contador para ir contando o número de letras do submenu ao qual cliquei

		if(submenuparametro=="Computadores") //Se o submenu ao qual cliquei foi o Equipamentos que tem como parâmetro Computadores:
		{
			//Faz-se estas verificações porque caso se o parâmetro é Computadores significa que o submenu ao qual cliquei foi o de Equipamentos e o Equipamentos divide-se em 4: Computadores, QIMs(Quadros Interativos Multiméticas), Monitores e Projetores. E preciso verificar em qual destes equipamentos estou para poder fazer as verificações que vão verificar qual destes equipamentos está no link
			//Começo a contar do 5 porque, por exemplo o link InserirUtilizadores.php, são 23 letras, aí em forma de array conta-se do 0 ao 22, aí como a contagem é da direita para a esquerda eu quero começar a contar pelo s do final do utilizadores, aí o índice dele é o 18, mas como nunca sabemos quanto o número de letras da página usamos o tamanholetraspagina para identificar, nesse caso seria 23, aí fazendo as contas querendo saltar o .php que seriam os índices, respetivamente, 19 20 21 22, o s teria o índice 18, como todas as páginas contêm a extensão .php sempre será isto no final, assim fazendo as contas, 23-18=5, sempre seria 5 de diferença pois a extensão nunca muda
			if(pagina[0][tamanholetraspagina-8]=="Q" && pagina[0][tamanholetraspagina-7]=="I" && pagina[0][tamanholetraspagina-6]=="M" && pagina[0][tamanholetraspagina-5]=="s") //Se estiver na página QIMs(Quadros Interativos Multimédias) então:
			{
				tamanholetrassubmenu=4; //O número de letras passa a 4
			}
			else if(pagina[0][tamanholetraspagina-13]=="M" && pagina[0][tamanholetraspagina-12]=="o" && pagina[0][tamanholetraspagina-11]=="n" && pagina[0][tamanholetraspagina-10]=="i" && pagina[0][tamanholetraspagina-9]=="t" && pagina[0][tamanholetraspagina-8]=="o" && pagina[0][tamanholetraspagina-7]=="r" && pagina[0][tamanholetraspagina-6]=="e" && pagina[0][tamanholetraspagina-5]=="s") //Se não se estiver na página Monitores então:
				 {
					 tamanholetrassubmenu=9; //O número de letras passa a 9
				 }
				 else if(pagina[0][tamanholetraspagina-14]=="P" && pagina[0][tamanholetraspagina-13]=="r" && pagina[0][tamanholetraspagina-12]=="o" && pagina[0][tamanholetraspagina-11]=="j" && pagina[0][tamanholetraspagina-10]=="e" && pagina[0][tamanholetraspagina-9]=="t" && pagina[0][tamanholetraspagina-8]=="o" && pagina[0][tamanholetraspagina-7]=="r" && pagina[0][tamanholetraspagina-6]=="e" && pagina[0][tamanholetraspagina-5]=="s") //Se não se estiver na página Projetores então:
					  {
						  tamanholetrassubmenu=10; //O número de letras passa a 10
					  }
					  else if(pagina[0][tamanholetraspagina-16]=="C" && pagina[0][tamanholetraspagina-15]=="o" && pagina[0][tamanholetraspagina-14]=="m" && pagina[0][tamanholetraspagina-13]=="p" && pagina[0][tamanholetraspagina-12]=="u" && pagina[0][tamanholetraspagina-11]=="t" && pagina[0][tamanholetraspagina-10]=="a" && pagina[0][tamanholetraspagina-9]=="d" && pagina[0][tamanholetraspagina-8]=="o" && pagina[0][tamanholetraspagina-7]=="r" && pagina[0][tamanholetraspagina-6]=="e" && pagina[0][tamanholetraspagina-5]=="s") //Se não se estiver na página Computadores então:
						   {
							   tamanholetrassubmenu=12; //O número de letras passa a 12
						   }
						   else
						   {
							   parousubmenu=true; //A variável que indica para parar fica verdadeira significando que o submenu ao qual cliquei não corresponde à página em que estou
						   }
		}
		else //Se não vai fazer o resto das verificações a comparar se o submenu ao qual cliquei é igual ao link:
		{
			//Vai repetir o número de letras do submenu ao qual cliquei, por exemplo, vai repetir 12 vezes se for o Utilizadores o seguinte:
			for(var i=tamanholetrasextensao; i<(tamanholetrassubmenu+tamanholetrasextensao); i++)
			{ //Soma-se a variável tamanholetrasextensão para começar a contas a palavra sem a extensão, por exemplo, InserirUtilizadores.php, ele verifica da direita para a esquerda e salta a extensão por causa da soma assim só contando o InserirUtilizadores, mas ele só vai contar o número de letras do submenu ao qual cliquei, ou seja, se cliquei no Utilizadores ele só vai verificar as 12 letras antes da extensão então vai verificar o Utilizadores, agora se fosse Salas ele ia verificar da palavra as 5 letras antes da extensão, ou seja, ele verificaria a parte dores e verificaria se era igual a Salas
				if(!parousubmenu) //Se ainda não mandei parar a verificação:
				{
					//Verifica se o submenu ao qual cliquei igual à página aonde estou
					if(!(pagina[0][tamanholetraspagina-(i+1)]==submenuparametro[tamanholetrassubmenu-(j+1)])) //Se a letra do link for diferente da letra do parâmetro:
					{
						parousubmenu=true; //A variável que indica para parar fica verdadeira significando que o submenu ao qual cliquei não corresponde à página em que estou
					}
					
					j++; //O contador aumenta em 1, por exemplo, era 10 passa a 11
				}
			}
		}

		if(!parousubmenu) //Se não mandei parar a variável parousubmenu, significa que em princípio estou dentro da página, restando apenas saber se estou no Inserir ou no consultar, então:
		{
			var parouinserir=false; //Variável que verifica se aonde estou atualmente é o inserir
			var parouconsultar=false; //Variável que verifica se aonde estou atualmente é o consultar
			var inserir="Inserir"; //Variável string que vai conter a palavra inserir para comparar com o link
			var consultar="Consultar"; //Variável string que vai conter a palavra consultar para comparar com o link
			var tamanholetrasinserir=inserir.length; //Variável que contém o número de letras da palavra inserir, nesse caso 7
			var tamanholetrasconsultar=consultar.length; //Variável que contém o número de letras da palavra consultar, nesse caso 9
			var l=0; //Variável contador para ir contando o número de letras é o mesmo que Inserir ou o mesmo que consultar
			
			i=tamanholetrassubmenu+tamanholetrasextensao; //A variável i vai receber o número de letras do submenu ao qual cliquei + o número de letras da extensão, por exemplo, Utilizadores são 12 letras, .php são 4 letras, 12+4=16, o i receberia 16, para assim puder saber a partir de que número começo a contagem
			
			//Vai repetir o número de letras de inserir, ou seja, 7 vezes:
			for(var k=i; k<(tamanholetrasinserir+i); k++)
			{
				if(!parouinserir) //Se ainda não mandei parar a verificação:
				{
					//Verifica se a página é Inserir
					if(!(pagina[0][tamanholetraspagina-(k+1)]==inserir[tamanholetrasinserir-(l+1)])) //Se a letra do link for diferente da letra do inserir:
					{
						parouinserir=true; //A variável que indica para parar fica verdadeira significando que a página aonde estou não é o inserir
					}
					
					l++; //O contador aumenta em 1, por exemplo, era 10 passa a 11
				}
			}
			
			//Estas 2 variáveis abaixo voltam a ter o valor que tinha antes para poder fazer a verificação se a página é o consultar caso não seja o inserir
			i=tamanholetrassubmenu+tamanholetrasextensao;
			l=0;
			
			//Vai repetir o número de letras de consultar, ou seja, 9 vezes:
			for(var k=i; k<(tamanholetrasconsultar+i); k++)
			{
				if(!parouconsultar) //Se ainda não mandei parar a verificação:
				{
					//Verifica se a página é Consultar
					if(!(pagina[0][tamanholetraspagina-(k+1)]==consultar[tamanholetrasconsultar-(l+1)])) //Se a letra do link for diferente da letra do consultar:
					{
						parouconsultar=true; //A variável que indica para parar fica verdadeira significando que a página aonde estou não é o consultar
					}
				
					l++; //O contador aumenta em 1, por exemplo, era 10 passa a 11
				}
			}
			
			
			if(!parouinserir) //Se eu não mandei parar a variável parouinserir então significa que estou na página de inserir, então:
			{
				document.getElementById("inserir").className="ativo"; //O submenu inserir fica o fundo com uma tonalidade de azul mais clara para simbolizar que estou nesse consultar atualmente
			}
			else //Se não:
			{
				document.getElementById("inserir").className=""; //Retira a classe que tiver para ficar normal
			}
			
			if(!parouconsultar) //Se eu não mandei parar a variável parouconsultar então significa que estou na página de consultar, então:
			{
				document.getElementById("consultar").className="ativo"; //O submenu consultar fica o fundo com uma tonalidade de azul mais clara para simbolizar que estou nesse consultar atualmente
			}
			else //Se não:
			{
				document.getElementById("consultar").className=""; //Retira a classe que tiver para ficar normal
			}
		}
		else //Se não:
		{
			document.getElementById("inserir").className=""; //Retira a classe que tiver para ficar normal
			document.getElementById("consultar").className=""; //Retira a classe que tiver para ficar normal
		}
		/* Fim do código relativo ao submenu ativo */
		
		submenuUL.style.visibility="visible"; //Mostra o submenu
		submenu.style.width="272px"; //Aumenta o tamanho do submenu
		divisoria.style.width="2px"; //Aumenta o tamanho da linha que divide o menu para o submenu
		
		for(var i=0; i<submenuA.length; i++) //Vai repetir o número de itens, exemplo, se são 5 no menu vai repetir 5 vezes
		{
			submenuA[i].style.opacity="1"; //Mostra todos os itens do submenu
		}
		
		submenuaberto=true; //Variável que indica que o submenu está aberto
		document.getElementById("inserir").href="Inserir" + submenuparametro + ".php"; //Mete o link na parte do inserir
		document.getElementById("consultar").href="Consultar" + submenuparametro + ".php"; //Mete o link na parte do consultar
	}
	
	document.getElementById("utilizadores").addEventListener("click", function() //Quando clicar no item utilizadores:
	{
		AbrirSubmenu("Utilizadores"); //Executa a função para abrir o submenu e mete o link para a página das utilizadores
		
		if(sessionStorage.getItem("inserirutilizadores")=="true") //Se tenho permissão para entrar na página inserir utilizadores então:
		{
			document.getElementById("inserir").style.display="block"; //Mete a subopção inserir visível
		}
		else //Se não:
		{
			document.getElementById("inserir").style.display="none"; //Mete a subopção inserir invisível
		}
		
		if(sessionStorage.getItem("consultarutilizadores")=="true") //Se tenho permissão para entrar na página consultar utilizadores então:
		{
			document.getElementById("consultar").style.display="block"; //Mete a subopção consultar visível
		}
		else //Se não:
		{
			document.getElementById("consultar").style.display="none"; //Mete a subopção consultar invisível
		}
		
		//Mete a cor da letra dos utilizadores a #F3F30E que é uma tonalidade de amarelo em hexadecimal e o resto a branco para identificar em que parte do submenu estou
		document.getElementById("utilizadores").style.color="#F3F30E";
		document.getElementById("agrupamentos").style.color="white";
		document.getElementById("escolas").style.color="white";
		document.getElementById("blocos").style.color="white";
		document.getElementById("salas").style.color="white";
		document.getElementById("equipamentos").style.color="white";
		document.getElementById("avarias").style.color="white";
	});
	
	document.getElementById("agrupamentos").addEventListener("click", function() //Quando clicar no item agrupamentos:
	{
		AbrirSubmenu("Agrupamentos"); //Executa a função para abrir o submenu e mete o link para a página das agrupamentos
		
		if(sessionStorage.getItem("inseriragrupamentos")=="true") //Se tenho permissão para entrar na página inserir agrupamentos então:
		{
			document.getElementById("inserir").style.display="block"; //Mete a subopção inserir visível
		}
		else //Se não:
		{
			document.getElementById("inserir").style.display="none"; //Mete a subopção inserir invisível
		}
		
		if(sessionStorage.getItem("consultaragrupamentos")=="true") //Se tenho permissão para entrar na página consultar agrupamentos então:
		{
			document.getElementById("consultar").style.display="block"; //Mete a subopção consultar visível
		}
		else //Se não:
		{
			document.getElementById("consultar").style.display="none"; //Mete a subopção consultar invisível
		}
		
		//Mete a cor da letra dos agrupamentos a #F3F30E que é uma tonalidade de amarelo em hexadecimal e o resto a branco para identificar em que parte do submenu estou
		document.getElementById("utilizadores").style.color="white";
		document.getElementById("agrupamentos").style.color="#F3F30E";
		document.getElementById("escolas").style.color="white";
		document.getElementById("blocos").style.color="white";
		document.getElementById("salas").style.color="white";
		document.getElementById("equipamentos").style.color="white";
		document.getElementById("avarias").style.color="white";
	});
	
	document.getElementById("escolas").addEventListener("click", function() //Quando clicar no item escolas:
	{
		AbrirSubmenu("Escolas"); //Executa a função para abrir o submenu e mete o link para a página das escolas
		
		if(sessionStorage.getItem("inserirescolas")=="true") //Se tenho permissão para entrar na página inserir escolas então:
		{
			document.getElementById("inserir").style.display="block"; //Mete a subopção inserir visível
		}
		else //Se não:
		{
			document.getElementById("inserir").style.display="none"; //Mete a subopção inserir invisível
		}
		
		if(sessionStorage.getItem("consultarescolas")=="true") //Se tenho permissão para entrar na página consultar escolas então:
		{
			document.getElementById("consultar").style.display="block"; //Mete a subopção consultar visível
		}
		else //Se não:
		{
			document.getElementById("consultar").style.display="none"; //Mete a subopção consultar invisível
		}
		
		//Mete a cor da letra dos escolas a #F3F30E que é uma tonalidade de amarelo em hexadecimal e o resto a branco para identificar em que parte do submenu estou
		document.getElementById("utilizadores").style.color="white";
		document.getElementById("agrupamentos").style.color="white";
		document.getElementById("escolas").style.color="#F3F30E";
		document.getElementById("blocos").style.color="white";
		document.getElementById("salas").style.color="white";
		document.getElementById("equipamentos").style.color="white";
		document.getElementById("avarias").style.color="white";
	});
	
	document.getElementById("blocos").addEventListener("click", function() //Quando clicar no item blocos:
	{
		AbrirSubmenu("Blocos"); //Executa a função para abrir o submenu e mete o link para a página das blocos
		
		if(sessionStorage.getItem("inserirblocos")=="true") //Se tenho permissão para entrar na página inserir blocos então:
		{
			document.getElementById("inserir").style.display="block"; //Mete a subopção inserir visível
		}
		else //Se não:
		{
			document.getElementById("inserir").style.display="none"; //Mete a subopção inserir invisível
		}
		
		if(sessionStorage.getItem("consultarblocos")=="true") //Se tenho permissão para entrar na página consultar blocos então:
		{
			document.getElementById("consultar").style.display="block"; //Mete a subopção consultar visível
		}
		else //Se não:
		{
			document.getElementById("consultar").style.display="none"; //Mete a subopção consultar invisível
		}
		
		//Mete a cor da letra dos blocos a #F3F30E que é uma tonalidade de amarelo em hexadecimal e o resto a branco para identificar em que parte do submenu estou
		document.getElementById("utilizadores").style.color="white";
		document.getElementById("agrupamentos").style.color="white";
		document.getElementById("escolas").style.color="white";
		document.getElementById("blocos").style.color="#F3F30E";
		document.getElementById("salas").style.color="white";
		document.getElementById("equipamentos").style.color="white";
		document.getElementById("avarias").style.color="white";
	});
	
	document.getElementById("salas").addEventListener("click", function() //Quando clicar no item salas:
	{
		AbrirSubmenu("Salas"); //Executa a função para abrir o submenu e mete o link para a página das salas
		
		if(sessionStorage.getItem("inserirsalas")=="true") //Se tenho permissão para entrar na página inserir salas então:
		{
			document.getElementById("inserir").style.display="block"; //Mete a subopção inserir visível
		}
		else //Se não:
		{
			document.getElementById("inserir").style.display="none"; //Mete a subopção inserir invisível
		}
		
		if(sessionStorage.getItem("consultarsalas")=="true") //Se tenho permissão para entrar na página consultar salas então:
		{
			document.getElementById("consultar").style.display="block"; //Mete a subopção consultar visível
		}
		else //Se não:
		{
			document.getElementById("consultar").style.display="none"; //Mete a subopção consultar invisível
		}
		
		//Mete a cor da letra dos salas a #F3F30E que é uma tonalidade de amarelo em hexadecimal e o resto a branco para identificar em que parte do submenu estou
		document.getElementById("utilizadores").style.color="white";
		document.getElementById("agrupamentos").style.color="white";
		document.getElementById("escolas").style.color="white";
		document.getElementById("blocos").style.color="white";
		document.getElementById("salas").style.color="#F3F30E";
		document.getElementById("equipamentos").style.color="white";
		document.getElementById("avarias").style.color="white";
	});
	
	document.getElementById("equipamentos").addEventListener("click", function() //Quando clicar no item equipamentos:
	{
		AbrirSubmenu("Computadores"); //Executa a função para abrir o submenu e mete o link para a página das equipamentos
		
		if(sessionStorage.getItem("inserirequipamentos")=="true") //Se tenho permissão para entrar na página inserir equipamentos então:
		{
			document.getElementById("inserir").style.display="block"; //Mete a subopção inserir visível
		}
		else //Se não:
		{
			document.getElementById("inserir").style.display="none"; //Mete a subopção inserir invisível
		}
		
		if(sessionStorage.getItem("consultarequipamentos")=="true") //Se tenho permissão para entrar na página consultar equipamentos então:
		{
			document.getElementById("consultar").style.display="block"; //Mete a subopção consultar visível
		}
		else //Se não:
		{
			document.getElementById("consultar").style.display="none"; //Mete a subopção consultar invisível
		}
		
		//Mete a cor da letra dos equipamentos a #F3F30E que é uma tonalidade de amarelo em hexadecimal e o resto a branco para identificar em que parte do submenu estou
		document.getElementById("utilizadores").style.color="white";
		document.getElementById("agrupamentos").style.color="white";
		document.getElementById("escolas").style.color="white";
		document.getElementById("blocos").style.color="white";
		document.getElementById("salas").style.color="white";
		document.getElementById("equipamentos").style.color="#F3F30E";
		document.getElementById("avarias").style.color="white";
	});
	
	document.getElementById("avarias").addEventListener("click", function() //Quando clicar no item avarias:
	{
		AbrirSubmenu("Avarias"); //Executa a função para abrir o submenu e mete o link para a página das avarias
		
		if(sessionStorage.getItem("inseriravarias")=="true") //Se tenho permissão para entrar na página inserir avarias então:
		{
			document.getElementById("inserir").style.display="block"; //Mete a subopção inserir visível
		}
		else //Se não:
		{
			document.getElementById("inserir").style.display="none"; //Mete a subopção inserir invisível
		}
		
		if(sessionStorage.getItem("consultaravarias")=="true") //Se tenho permissão para entrar na página consultar avarias então:
		{
			document.getElementById("consultar").style.display="block"; //Mete a subopção consultar visível
		}
		else //Se não:
		{
			document.getElementById("consultar").style.display="none"; //Mete a subopção consultar invisível
		}
		
		//Mete a cor da letra das avarias a #F3F30E que é uma tonalidade de amarelo em hexadecimal e o resto a branco para identificar em que parte do submenu estou
		document.getElementById("utilizadores").style.color="white";
		document.getElementById("agrupamentos").style.color="white";
		document.getElementById("escolas").style.color="white";
		document.getElementById("blocos").style.color="white";
		document.getElementById("salas").style.color="white";
		document.getElementById("equipamentos").style.color="white";
		document.getElementById("avarias").style.color="#F3F30E";
	});
	
	//Voltar para cima para explicar como fechar o submenu
});