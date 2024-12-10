window.addEventListener("load", function() //Antes da página iniciar, ele relê o código vendo todos os códigos e processando já o que há de fazer
{
	if(!(document.getElementById("btnpesquisar")==null)) //Se o botão de pesquisae existir porque pode não existir no caso de estiver a editar
	{
		document.getElementById("btnpesquisar").style.backgroundImage="url(ImagensSite//Lupa.jpg)"; //Configura a imagem da lupa
	}
});