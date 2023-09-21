<?php
include './conexao.php';




    if (isset($_POST['dadosCompletos'])) {
        // Receba os dados enviados via POST
        $dadosCompletosJSON = $_POST['dadosCompletos'];
    
        // Decodifique o JSON para obter os dados em um array associativo
        $dadosCompletos = json_decode($dadosCompletosJSON, true);


        $nomeFormularioValue = $_POST['nomeFormulario'];

        $nome_form = "INSERT INTO `formulario` (nome) VALUES ('$nomeFormularioValue')";
        $inserir_formulario = mysqli_query($conexao, $nome_form );
  

        echo $nomeFormularioValue;
        //var_dump($dadosCompletos);
    
        // Acesse os dados dos campos de texto e textarea
        $camposData = $dadosCompletos['camposData'];
        //var_dump($camposData );
          
        $formulario_id = $conexao->insert_id;

        foreach ($camposData as $campo) {
            $tipo = $campo['type'];
            $nome = $campo['name'];

            
    
          
            // Verifique se o nome do campo não é "nomeFormulario"
            if ($nome !== "nomeFormulario") {
                // Exemplo de inserção em banco de dados para campos de texto
                $sql_campo = "INSERT INTO `campo` (nome, tipo, formulario_id) VALUES ('$nome', '$tipo', '$formulario_id')";
                $inserir_campo = mysqli_query($conexao, $sql_campo);
            }
        }
    
        // Acesse os dados dos campos <select> se estiverem presentes
        if (isset($dadosCompletos['selectData'])) {
            $selectData = $dadosCompletos['selectData'];
            var_dump($selectData);


            foreach ($selectData as $select) {
                $nomeSelect = $select['name'];
                $valoresSelect = $select['optionValues'];
        
                // Defina o tipo como "select"
                $tipo = "select";
        
                // Insira os dados do campo <select> na tabela "campo" com um formulario_id associado
                $sqlCampo = "INSERT INTO `campo` (`nome`, `tipo`, `formulario_id`) VALUES ('$nomeSelect', '$tipo', '$formulario_id')";
                $inserir_campo = mysqli_query($conexao, $sqlCampo);
        
                if ($inserir_campo) {
                    $campo_id = mysqli_insert_id($conexao); // Obtém o ID gerado para o campo <select>
                    // echo "Inserção bem-sucedida na tabela 'campo' para o campo '<select>' com ID: $campo_id<br>";
        
                    // Agora, insira as opções do campo <select> na tabela "opcao" com o campo_id associado
                    foreach ($valoresSelect as $valorSelect) {
                        if (!empty($valorSelect)) {
                            $sqlOpcao = "INSERT INTO `opcoes` (`valor`, `campo_id`) VALUES ('$valorSelect', '$campo_id')";
                            $inserir_opcao = mysqli_query($conexao, $sqlOpcao);
                        
                        }
                    }
                } 
            }
        }
        
        
        
        
        
        
        
    
        // Redirecione ou exiba uma mensagem de sucesso, etc.
    }
    
  
  
  
  
  
  

      
  




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Document</title>
</head>
<body>
    

    
  <section class="form-section">

      <form action="total.php" id="formulario" method="POST">
          <div class="campo-container">
              <label for="name">Título do Formulário</label>
              <input type="text" name="nomeFormulario" required>
          </div>

          <div class="add-campo-container">
              <h3 class="title-form">Campo</h3>
              <div class="menu-campo">
                  <button type="button" id="open-modal-campo" onclick="openModalCampo()">+ Adicionar Campo</button>
              </div>
          </div>
          
          <div class="form-vazio">
             <p>Seu formulário está vazio. Clique no botão 'Adicionar Campo' para começar a criar seu formulário.</p>
               
          </div>
        
          

        <!-- <div class="campo-container">
            <div><button type="button">Editar</button><button type="button">Remover</button>
            </div>
            <label for="nome">nome:</label>
            <input type="text" id="nome" name="nome" >

        </div>

        <div class="campo-container">
                <div><button type="button">Editar</button><button type="button">Remover</button>
                </div>
                <label for="mensagem">mensagem:</label>
                <textarea id="mensagem" name="mensagem" required=""> </textarea>
        </div> -->


        <div class="campo-container novo-campo"><div>
        <button type="button"><i class="fa fa-edit"></i> Editar</button>
        <button type="button"><i class="fa fa-trash-alt"></i> Remover</button>
              </div><label for="dsada">dsada:</label><select id="dsada" name="dsada"><option value="">Selecionar</option><option value="dasda">dasda</option></select>
        </div>
         

        <input type="hidden" name="acao">


          <button class="btn-salvar salvar-formularia" type="button" onclick="coletarCampos()" >Salvar</button>
      </form>

  </section>


   <div class="modal-add-container">
      <div class="modal">
        <button id="close-modal" onclick="closeModalCampo()">x</button>
        <form  class="cadastrar-campo" >
             


              <div class="campo-container">
                <label for="name">Nome do campo</label>
                <input type="text" name="name" id="nameCampo" required >
              </div>
              
              
              <div class="campo-container">
                  <label for="tipo">Tipo do campo</label>
                  <select name="tipo" id="tipoCampo" onchange="mostrarLista()" required>
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
              
              

              
              
              
              <button class="btn-salvar" type="button" id="add-campo" onclick="salvarCampo()" >Salvar</button>
                  
          </form>
        </div>
   </div>


  



<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script>




   function openModalCampo(){
        document.querySelector('.modal-add-container').classList.add('active-modal-campo');
                
   }


   function closeModalCampo(){
        document.querySelector('.modal-add-container').classList.remove('active-modal-campo');
                
   }





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
                <button type="button" class="edit-opcao" onclick="editarItem(this)"><i class="fa fa-edit"></i></button>
                <button type="button" class="remover-opcao" onclick="removerItem(this)"><i class="fa fa-xmark"></i></button>
            </div>
        `;

        // Adicione o novo item à lista
        lista.appendChild(novoItem);
        document.getElementById('optionCampo').value = '';

        
    }



    function editarItem(botaoEditar) {
    var li = botaoEditar.parentElement.parentElement;
    var input = li.querySelector('input');
    var button = botaoEditar;

    if (button.textContent === "") {
        button.style.color="#555555";
        button.textContent = "Salvar"; // Adiciona o ícone para "Salvar"
        input.removeAttribute('disabled');
        input.focus();
    } else {
        button.innerHTML = '<i class="fas fa-edit"></i>'; // Adiciona o ícone para "Editar"
        button.style.color="#44BA5B";
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
        novoCampo.className = 'campo-container novo-campo';



        if(nome_campo != '' && tipo_campo != ''){
            
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


                var lista = document.getElementById('lista');

                if (lista.children.length === 0) {
                    // Se a lista estiver vazia, coloque o foco no campo para adicionar opções
                    alert('A lista está vazia. Adicione opções antes de salvar.');
                    document.getElementById('optionCampo').focus();
                    return; // Saia da função para não criar o campo vazio
                }
                
                divBotoes.innerHTML = `
                    <button type="button"><i class="fa fa-edit"></i> Editar</button>
                    <button type="button"><i class="fa fa-trash-alt"></i> Remover</button>
                `;




                // Crie um novo elemento <label>
                var labelCampo = document.createElement('label');
                labelCampo.setAttribute('for', nome_campo);
                labelCampo.textContent = nome_campo + ":";

                // Crie um novo elemento <select>
                var novoSelect = document.createElement('select');
                novoSelect.id = nome_campo;
                novoSelect.name = nome_campo;

                // Adicione a primeira opção com valor vazio e texto "Selecione"
                var opcaoSelecione = document.createElement('option');
                opcaoSelecione.value = ''; // Valor vazio
                opcaoSelecione.text = 'Selecionar'; // Texto "Selecione"
                novoSelect.appendChild(opcaoSelecione);

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
            
            formulario.insertBefore(novoCampo, document.querySelector('.salvar-formularia'));

            document.getElementById('nameCampo').value ='';
            document.getElementById('tipoCampo').value = '';
            document.getElementById('lista').innerHTML = '';
            document.getElementById('optionCampo').value = '';

            closeModalCampo()
        }else{
            
        }

}




function coletarCampos() {
    const formulario = document.getElementById('formulario');
    const campos = formulario.querySelectorAll('input[type="text"], textarea');
    const selects = formulario.querySelectorAll('.campo-container select');

    const camposData = [];
    const selectData = [];

    campos.forEach(function (campo) {
        if (campo.name === 'nomeFormulario') {
            // Se o campo for o primeiro input com name 'nomeFormulario', pegue seu valor
            camposData.push({
                type: campo.type,
                name: campo.name,
                value: campo.value // Adicione o valor do campo
            });
        } else {
            camposData.push({
                type: campo.type,
                name: campo.name
            });
        }
    });

    selects.forEach(function (select) {
        const selectValues = [];
        const selectName = select.name;
        for (let i = 0; i < select.options.length; i++) {
            selectValues.push(select.options[i].value);
        }
        selectData.push({
            name: selectName,
            optionValues: selectValues
        });
    });

    const dadosCompletos = {
        camposData: camposData,
        selectData: selectData
    };

    // Verifique se há campos <select> no formulário
    if (selectData.length > 0) {
        // Campos <select> estão presentes, você pode fazer algo com eles aqui
        console.log('Campos <select> estão presentes:', selectData);
    } else {
        // Nenhum campo <select> encontrado, você pode lidar com isso aqui
        console.log('Nenhum campo <select> encontrado.');
    }

    // Agora você pode enviar os dados para o PHP usando AJAX ou definir um campo oculto no formulário e definir seu valor para dadosCompletos.
    const dadosCompletosInput = document.createElement('input');
    dadosCompletosInput.type = 'hidden';
    dadosCompletosInput.name = 'dadosCompletos';
    dadosCompletosInput.value = JSON.stringify(dadosCompletos);
    formulario.appendChild(dadosCompletosInput);

    // Agora você pode enviar o formulário
    formulario.submit();
}




</script>  













</body>
</html>