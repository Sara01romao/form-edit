<?php


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    

    
  <section class="form-section">

      <form action="" id="formulario">
          <div class="campo-container">
              <label for="name">Nome =</label>
              <input type="text" name="nomeFomulario" required>
          </div>

          <div class="add-campo-container">
              <h3 class="title-form">Campo</h3>
              <div class="menu-campo">
                  <button type="button">+ Adicionar Campo</button>
              </div>
          </div>
      </form>

  </section>


   <div class="modal-add-container">
      <div class="modal">
        <form  class="cadastrar-campo" >
              <input type="hidden" name="acao">


              <div class="campo-container">
                <label for="name">Nome do campo</label>
                <input type="text" name="name" id="nameCampo" >
              </div>
              
              
              <div class="campo-container">
                  <label for="tipo">Tipo do campo</label>
                  <select name="tipo" id="tipoCampo" onchange="mostrarLista()" >
                      <option value="">Selecionar</option>
                      <option value="input">Campo Simples</option>
                      <option value="textarea">Texto Longo</option>
                      <option value="select">Lista com Itens</option>
                  </select>

              </div>
              
        
              <div class="lista-container" id="lista-container">
                  <div class="campo-container">
                      <!-- Campo de entrada e botão de adição -->
                      <label for="tipo">Adicionar Opções</label>
                      
                      <div>
                          <input type="text" id="optionCampo" placeholder="Digite um item">
                          <button type="button" onclick="adicionarItem()">Adicionar</button>
                      </div>
                  </div>
                  
                  <div class="lista-container">
                      <p class="opcao-title">Opções</p>
                      <ul  id="lista">
                       
                      </ul>
                  </div>
              
              </div>
              
              <input type="hidden" name="itens" id="itens-hidden" value="">

              
              
              
              <button class="btn-salvar" type="button" id="add-campo" onclick="salvarCampo()" >Salvar</button>
                  
          </form>
        </div>
   </div>


  



<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script>










    function mostrarLista() {
              var tipoSelecionado = document.getElementById("tipoCampo").value;
              var lista = document.getElementById("lista-container");

              if (tipoSelecionado === "select") {
                  lista.style.display = "block"; // Mostra a lista
              } else {
                  lista.style.display = "none";  // Esconde a lista
              }
    }


    function adicionarItem() {
        var nomeCampo = document.getElementById('optionCampo').value;

        // Verifique se o nome do campo não está vazio
        if (nomeCampo.trim() === "") {
            alert("Por favor, insira um nome válido para o item.");
            return;
        }

        var lista = document.getElementById('lista');

        // Crie um novo elemento li
        var novoItem = document.createElement('li');

        // Conteúdo HTML do novo item
        novoItem.innerHTML = `
            <input type="text" value="${nomeCampo}" disabled="disabled" name="option">
            <div>
                <button type="button" onclick="editarItem(this)">Editar</button>
                <button type="button" onclick="removerItem(this)">Remover</button>
            </div>
        `;

        // Adicione o novo item à lista
        lista.appendChild(novoItem);

        
    }



    function editarItem(botaoEditar) {
          var li = botaoEditar.parentElement.parentElement;
          var input = li.querySelector('input');
          var button = botaoEditar;

          if (button.textContent === "Editar") {
              button.textContent = "Salvar";
              input.removeAttribute('disabled');
              input.focus();
          } else {
              button.textContent = "Editar";
              input.setAttribute('disabled', 'disabled');
          }
    }


    function removerItem(botaoRemover) {
        var li = botaoRemover.parentElement.parentElement;
        var lista = li.parentElement;
        lista.removeChild(li);
    }

    
   
    
    function salvarCampo() {
    var nome_campo = document.getElementById('nameCampo').value;
    var tipo_campo = document.getElementById('tipoCampo').value;
    var formulario = document.getElementById('formulario');

    // Crie um novo elemento div com a classe "campo-container"
    var novoCampo = document.createElement('div');
    novoCampo.className = 'campo-container';

    if (tipo_campo === "input") {

        novoCampo.innerHTML = `
            <div><button type="button">Editar</button><button type="button">Remover</button>
            </div>
            <label for="${nome_campo}">${nome_campo}:</label>
            <input type="text" id="${nome_campo}" name="${nome_campo}" required>

        `;

        formulario.appendChild(novoCampo);


    } else if (tipo_campo === "textarea") {

        

        novoCampo.innerHTML = `
              <div><button type="button">Editar</button><button type="button">Remover</button>
              </div>
              <label for="${nome_campo}">${nome_campo}:</label>
              <textarea  id="${nome_campo}" name="${nome_campo}" required> 

          `;

        formulario.appendChild(novoCampo);
        
    }else if (tipo_campo === "select") {
        // Crie um novo elemento <div> com os botões "Editar" e "Remover"
        var divBotoes = document.createElement('div');
        divBotoes.innerHTML = `
            <button type="button">Editar</button>
            <button type="button">Remover</button>
        `;

        // Crie um novo elemento <label>
        var labelCampo = document.createElement('label');
        labelCampo.setAttribute('for', nome_campo);
        labelCampo.textContent = nome_campo + ":";

        // Crie um novo elemento <select>
        var novoSelect = document.createElement('select');
        novoSelect.id = nome_campo;
        novoSelect.name = nome_campo;

        // Percorra a lista de itens e adicione opções ao novo select
        var lista = document.getElementById('lista');
        var options = lista.getElementsByTagName('input');

        for (var i = 0; i < options.length; i++) {
            var optionValue = options[i].value;
            var novaOpcao = document.createElement('option');
            novaOpcao.value = optionValue;
            novaOpcao.text = optionValue;
            novoSelect.appendChild(novaOpcao);
        }

        // Adicione os elementos ao novoCampo na ordem desejada
        novoCampo.appendChild(divBotoes);
        novoCampo.appendChild(labelCampo);
        novoCampo.appendChild(novoSelect);
    }

    formulario.appendChild(novoCampo);

    document.getElementById('nameCampo').value ='';
    document.getElementById('tipoCampo').value = '';
}






   





  


</script>  
</body>
</html>