
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



<section class="form-section">
   <form action="teste.php" class="cadastrar-campo" method="post">
        <input type="hidden" name="acao">


        <div class="campo-container">
        <label for="name">Nome do campo</label>
        <input type="text" name="name" required>
        </div>
        
        
        <div class="campo-container">
            <label for="tipo">Tipo do campo</label>
            <select name="tipo" id="tipo" onchange="mostrarLista()">
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
                <input type="text" id="item" placeholder="Digite um item">
                <button type="button" onclick="adicionarItem()">Adicionar</button>
            </div>
        </div>
         
        <ul id="lista">
        
        </ul>
        </div>
        
        <input type="hidden" name="itens" id="itens-hidden" value="">

        
        
        
        <button>Salvar</button>
            
    </form>

    </section>
   

 

<script>
       

    

    
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
        botaoEditar.onclick = function () {
            // Troca para o modo de edição
            paragrafo.style.display = "none"; // Oculta o parágrafo
            botaoEditar.style.display = "none"; // Oculta o botão "Editar"
            botaoRemover.style.display = "none"; // Oculta o botão "Remover"

            // Campo de entrada para edição
            var inputEditar = document.createElement("input");
            inputEditar.type = "text";
            inputEditar.value = itemTexto;

            // Botão "Salvar" para salvar a edição
            var botaoSalvar = document.createElement("button");
            botaoSalvar.textContent = "Salvar";
            botaoSalvar.onclick = function () {
                itemTexto = inputEditar.value;
                paragrafo.textContent = itemTexto;
                paragrafo.style.display = "block"; // Exibe o parágrafo novamente
                botaoEditar.style.display = "inline"; // Exibe o botão "Editar"
                botaoRemover.style.display = "inline"; // Exibe o botão "Remover"

                // Remove os campos de edição e salvar
                novoItem.removeChild(inputEditar);
                novoItem.removeChild(botaoSalvar);

                atualizarItens();
            };

            novoItem.appendChild(inputEditar);
            novoItem.appendChild(botaoSalvar);
        };

        // Botão "Remover" para remover o item
        var botaoRemover = document.createElement("button");
        botaoRemover.textContent = "Remover";
        botaoRemover.onclick = function () {
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


<style>
    @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;700&display=swap');

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Ubuntu', sans-serif;
    }

    ul{
        text-decoration: none;
    }

    #lista-container {
            /*display: none;*/ /* Esconde a lista inicialmente */
        }


    .cadastrar-campo{
        border: 1px solid red;
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding: 20px 30px;
    }

    .campo-container{
        display: flex;
        flex-direction: column;
        gap: 10px;
        
    }

    .campo-container input{
        width: 100%;
        height: 35px;
        border: solid 1px #CCCCCC;
        padding: 0px 10px;
        font-size: 16px;

    }

    .campo-container select{
        width: 100%;
        height: 35px;
        border: solid 1px #CCCCCC;
        font-size: 16px;
        padding: 0px 10px;
    }

    .form-section{
        max-width: 1200px;
        border: 1px solid blue;
        margin: 0 auto;
    }

    .lista-container .campo-container div{
        display: flex;

    }

    .lista-container .campo-container button{
        width: 148px;
        font-size: 15px;
        background: #0094E1;
        border: none;
        color: #fff;
        
    }

    #lista li{
        display: flex;
        border: solid 1px #CCCCCC;
        height: 35px;
        padding-left:10px ;
        margin-top: 10px;

    }

    #lista li p{
        display: flex;
        align-items: center;
    }
    
    #lista  li > button{
      width: 62.5px;
    }

    #lista  li > button:nth-child(2){
        margin: 0px 0px 0px auto;
    }


</style>
</body>
</html>