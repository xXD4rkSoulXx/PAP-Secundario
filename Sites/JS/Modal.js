window.addEventListener("load", function() //Antes da página iniciar, ele relê o código vendo todos os códigos e processando já o que há de fazer
{
	//Quando quero mexer com pseudo-elementos com o javascript tenho que usar o document.head.appendChild(document.createElement("style")).innerHTML
	//Vai adicinar (appendChild) ao head (.head.) a tag style do css (createElement("style")) com o texto que tiver dentro dos parêntesis, nesse caso adicionar a imagem do certo ao modal certo e adicionar a imagem de erro ao modal de erro
	document.head.appendChild(document.createElement("style")).innerHTML=".modalcerto::before" + //Antes do modal certo vai acontecer o seguinte:
																		 "{" +
																			 "background-image: Url(ImagensSite//Certo.jpg);" + //Adiciona a imagem de certo antes do modal
																		 "}" +
																		 
																		 ".modalerro::before" + //Antes do modal de erro vai acontecer o seguinte
																		 "{" +
																			 "background-image: Url(ImagensSite//Erro.jpg);" + //Adiciona a imagem de erro antes do modal
																		 "}" +
																		 
																		 ".modalaviso::before" + //Antes do modal de aviso vai acontecer o seguinte
																		 "{" +
																			 "background-image: Url(ImagensSite//Aviso.jpg);" + //Adiciona a imagem de aviso antes do modal
																		 "}" +
																		 
																		 ".modalutilizador::before" + //Antes do modal utilizador vai acontecer o seguinte
																		 "{" +
																			 "background-image: Url(ImagensSite//Utilizador.jpg);" + //Adiciona a imagem de utilizador antes do modal
																		 "}" +
																		 
																		 ".modalpass::before" + //Antes do modal pass vai acontecer o seguinte
																		 "{" +
																			 "background-image: Url(ImagensSite//Pass.jpg);" + //Adiciona a imagem de pass antes do modal
																		 "}" +
																		 
																		 ".modalescola::before" + //Antes do modal escola vai acontecer o seguinte
																		 "{" +
																			 "background-image: Url(ImagensSite//Escola.jpg);" + //Adiciona a imagem de escola antes do modal
																		 "}" +
																		 
																		 ".modalqim::before" + //Antes do modal qim vai acontecer o seguinte
																		 "{" +
																			 "background-image: Url(ImagensSite//Qim.jpg);" + //Adiciona a imagem de quadro interativo multimédia antes do modal
																		 "}" +
																		 
																		 ".modalcomputador::before" + //Antes do modal computador vai acontecer o seguinte
																		 "{" +
																			 "background-image: Url(ImagensSite//PC.jpg);" + //Adiciona a imagem de computador antes do modal
																		 "}" +
																		 
																		 ".modalmonitor::before" + //Antes do modal monitor vai acontecer o seguinte
																		 "{" +
																			 "background-image: Url(ImagensSite//Monitor.jpg);" + //Adiciona a imagem de monitor antes do modal
																		 "}" +
																		 
																		 ".modalprojetor::before" + //Antes do modal projetor vai acontecer o seguinte
																		 "{" +
																			 "background-image: Url(ImagensSite//Projetor.jpg);" + //Adiciona a imagem de projetor antes do modal
																		 "}" +
																		 
																		 ".modalavaria::before" + //Antes do modal avaria vai acontecer o seguinte
																		 "{" +
																			 "background-image: Url(ImagensSite//Avaria.jpg);" + //Adiciona a imagem de avaria antes do modal
																		 "}";
});