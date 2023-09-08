
<?php

include './conexao.php';
 
 



 
if(isset($_POST['acao'])){
    $name = $_POST['name'];
    $tipo = $_POST['tipo'];

    $lista = $_POST['itens'];

    $array_lista =  json_decode($lista);

   


    // Insira o campo na tabela "campo"
    $sql_campo = "INSERT INTO `formcampos`(`name`, `tipo`)  VALUES ('$name', '$tipo')";

    if ($inserir_campo = mysqli_query($conexao, $sql_campo)) {
        echo "Campo criado com sucesso: $name<br>";

        // Obtém o ID do campo recém-inserido
        $id_campo = $conexao->insert_id;

        // Insira as opções na tabela "opcoes" associadas ao campo


        if (is_array($array_lista )) {
            foreach ($array_lista  as $item) {
                $sql_opcao = "INSERT INTO `opcaocampo`(`id_formcampo`, `nome_opcao`) VALUES ('$id_campo', '$item')";
    
                if ($inserir_opcao = mysqli_query($conexao, $sql_opcao)) {
                    // Sucesso na inserção da opção
                } else {
                    echo "Erro ao inserir opção: " . $conexao->error . "<br>";
                }
            }
        } else {
            // Trate o caso em que $lista não é um array
            echo "A variável \$lista não é um array.";
        }


        
    } else {
        echo "Erro ao criar campo: " . $conexao->error . "<br>";
    }

    // Feche a conexão com o banco de dados quando terminar
    $conexao->close();


    $lista = $_POST['itens'];

  
    
    
    // echo $lista;

    // echo $name;
    // echo $tipo;

    

    
}






?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>itens</h1>

<style>
    #lista-container {
            display: none; /* Esconde a lista inicialmente */
        }
</style>

   <form action="teste.php" class="cadastrar-campo" method="post">
           <input type="hidden" name="acao">


           
           <label for="">Nome do campo</label>
           <input type="text" name="name" required>
           

           <select name="tipo" id="tipo" onchange="mostrarLista()">
             <option value="">selecione</option>
             <option value="input">Campo Simples</option>
             <option value="textarea">Texto Longo</option>
             <option value="select">Lista com Itens</option>
           </select>
          
           <div class="lista-container" id="lista-container">
             <!-- Campo de entrada e botão de adição -->
            <input type="text" id="item" placeholder="Digite um item">
            <button type="button" onclick="adicionarItem()">Adicionar</button>

            <ul id="lista">
          
           </ul>
           </div>
           
           <input type="hidden" name="itens" id="itens-hidden" value="">

          
           
          
        <button>Salvar</button>
              
    </form>


   

    <!-- Lista de itens -->
    <!-- <ul id="lista">
    </ul> -->

    <script>
        //   function adicionarItem() {
        //     var itemInput = document.getElementById("item");
        //     var itemTexto = itemInput.value;

        //     if (itemTexto.trim() !== "") {
        //         var lista = document.getElementById("lista");
        //         var novoItem = document.createElement("li");
        //         novoItem.textContent = itemTexto;

        //         // Botão "Editar" para editar o item
        //         var botaoEditar = document.createElement("button");
        //         botaoEditar.textContent = "Editar";
        //         botaoEditar.onclick = function() {
        //             // Troca para o modo de edição
        //             novoItem.innerHTML = ""; // Limpa o conteúdo

        //             // Campo de entrada para edição
        //             var inputEditar = document.createElement("input");
        //             inputEditar.type = "text";
        //             inputEditar.value = itemTexto;

        //             // Botão "Salvar" para salvar a edição
        //             var botaoSalvar = document.createElement("button");
        //             botaoSalvar.textContent = "Salvar";
        //             botaoSalvar.onclick = function() {
        //                 itemTexto = inputEditar.value;
        //                 novoItem.innerHTML = itemTexto;
        //                 novoItem.appendChild(botaoEditar);
        //                 novoItem.appendChild(botaoRemover);
        //             };

        //             novoItem.appendChild(inputEditar);
        //             novoItem.appendChild(botaoSalvar);
        //         };

        //         // Botão "Remover" para remover o item
        //         var botaoRemover = document.createElement("button");
        //         botaoRemover.textContent = "Remover";
        //         botaoRemover.onclick = function() {
        //             lista.removeChild(novoItem); // Remove o item da lista
        //         };

        //         novoItem.appendChild(botaoEditar);
        //         novoItem.appendChild(botaoRemover);

        //         lista.appendChild(novoItem);

        //         // Limpa o campo de entrada após adicionar o item
        //         itemInput.value = "";
        //     }
        // }

        function adicionarItem() {
    var itemInput = document.getElementById("item");
    var itemTexto = itemInput.value;

    if (itemTexto.trim() !== "") {
        var lista = document.getElementById("lista");
        var novoItem = document.createElement("li");

        // Cria um elemento <p> para o texto do item
        var paragrafo = document.createElement("p");
        paragrafo.textContent = itemTexto;

        // Adiciona o parágrafo à <li>
        novoItem.appendChild(paragrafo);

        lista.appendChild(novoItem);

        // Botão "Editar" para editar o item
        var botaoEditar = document.createElement("button");
        botaoEditar.textContent = "Editar";
        botaoEditar.onclick = function() {
            // Troca para o modo de edição
            paragrafo.innerHTML = ""; // Limpa o conteúdo

            // Campo de entrada para edição
            var inputEditar = document.createElement("input");
            inputEditar.type = "text";
            inputEditar.value = itemTexto;

            // Botão "Salvar" para salvar a edição
            var botaoSalvar = document.createElement("button");
            botaoSalvar.textContent = "Salvar";
            botaoSalvar.onclick = function() {
                itemTexto = inputEditar.value;
                paragrafo.textContent = itemTexto;
                atualizarItens();
            };

            novoItem.appendChild(inputEditar);
            novoItem.appendChild(botaoSalvar);
        };

        // Botão "Remover" para remover o item
        var botaoRemover = document.createElement("button");
        botaoRemover.textContent = "Remover";
        botaoRemover.onclick = function() {
            lista.removeChild(novoItem); // Remove o item da lista
            atualizarItens();
        };

        // Adicione os botões "Editar" e "Remover" fora do parágrafo
        novoItem.appendChild(botaoEditar);
        novoItem.appendChild(botaoRemover);

        // Limpa o campo de entrada após adicionar o item
        itemInput.value = "";

        // Atualize o campo oculto "itens-hidden" com a lista de itens reais
        atualizarItensReais();
    }
}



function atualizarItensReais() {
    var lista = document.getElementById("lista");
    var itensArray = [];

    // Coleta os itens reais da lista atual, excluindo os que contêm "Editar" ou "Remover"
    for (var i = 0; i < lista.children.length; i++) {
        var item = lista.children[i];

        // Verifica se o elemento contém um parágrafo
        var paragrafo = item.querySelector("p");

        // Se o elemento contiver um parágrafo, adiciona o conteúdo do parágrafo
        if (paragrafo) {
            itensArray.push(paragrafo.textContent);
        }
    }

    // Atualiza o campo oculto "itens-hidden" com a lista em formato JSON
    var itensHidden = document.getElementById("itens-hidden");
    itensHidden.value = JSON.stringify(itensArray);
}



        function mostrarLista() {
            var tipoSelecionado = document.getElementById("tipo").value;
            var lista = document.getElementById("lista-container");

            if (tipoSelecionado === "select") {
                lista.style.display = "block"; // Mostra a lista
            } else {
                lista.style.display = "none";  // Esconde a lista
            }
        }
</script>
</body>
</html>