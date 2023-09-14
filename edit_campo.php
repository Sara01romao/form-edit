
<?php

include './conexao.php';
 
 

$id = $_GET['id'];

 
if(isset($_POST['acao'])){
    $name = $_POST['name'];
    $tipo = $_POST['tipo'];

    $lista = $_POST['itens'];

    $array_lista =  json_decode($lista);

   


    // Insira o campo na tabela "campo"
    $sql_campo = "UPDATE `formcampos` SET `name`='$name',`tipo`='$tipo'  WHERE id = $id" ;

    

    if ($inserir_campo = mysqli_query($conexao, $sql_campo)) {
        echo "Campo criado com sucesso: $name<br>";

        // Obtém o ID do campo recém-inserido
        $id_campo = $conexao->insert_id;

        // Insira as opções na tabela "opcoes" associadas ao campo

          
        if (is_array($array_lista )) {
            foreach ($array_lista  as $item) {
                $sql_opcao = " UPDATE `opcaocampo` SET `nome_opcao`='nome_opcao'  WHERE id_formcampo = $id" ;
    
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

        header("Location: ./index.php");
        
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

<section class="form-section">

   <h2>Editar do campo</h2>

   <form action="edit_campo.php" class="cadastrar-campo" method="post">

   <?php

    
    $sql= "SELECT * FROM `formcampos` WHERE id = $id";

    $buscar = mysqli_query($conexao, $sql);

   
    
    


    while ($array = mysqli_fetch_array($buscar)){
        
                        $id = $array['id'];
                        $name = $array['name'];
                        $tipo = $array['tipo'];
                    


?>



        <input type="hidden" name="acao">


        <div class="campo-container">
        <label for="name">Nome do campo</label>
        <input type="text" name="name" value= "<?php echo $name ?>" required>
        </div>
        
        
        <div class="campo-container">
            <label for="tipo">Tipo do campo</label>
            <select name="tipo" id="tipo" onchange="mostrarLista()">
                <option value="">Selecionar</option>
                <option value="input" <?php if ($tipo === "input") echo "selected"; ?>>Campo Simples</option>
                <option value="textarea" <?php if ($tipo === "textarea") echo "selected"; ?>>Texto Longo</option>
                <option value="select" <?php if ($tipo === "select") echo "selected"; ?>>Lista com Itens</option>
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
         
        <div class="lista-container">
            <p class="opcao-title">Opções</p>
            <ul  id="lista">

            <?php
                    $sqlOpcaocampo = "SELECT * FROM `opcaocampo` WHERE id_formcampo = $id";
                    $editOpcaocampo = mysqli_query($conexao, $sqlOpcaocampo);

                    while ($option_array = mysqli_fetch_array($editOpcaocampo)) {
                        $id_op = $option_array['id'];
                        $nome_opcao = $option_array['nome_opcao'];

                        echo "<li><p>$nome_opcao</p> <button type='button' >Editar</button> <button type='button' >Remover</button></li>";

                    }

                    

            ?>
            
            </ul>
        </div>
        
        </div>
        
        <input type="hidden" name="itens" id="itens-hidden" value="">

        
        
        
        <button class="btn-salvar">Salvar</button>
            
<?php }?>
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
                paragrafo.style.display = "flex"; // Exibe o parágrafo novamente
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
        botaoRemover.textContent = " Remover";
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
        font-family: 'arial', sans-serif;
    }

    body{
        background: #ebeff2;
    }

    ul{
        text-decoration: none;
    }

    .form-section{
        max-width: 1200px;
        margin: 0 auto;

        padding: 30px;
        box-shadow: 0 2px 2px 0 rgba(0,0,0,.05), 0 3px 1px -2px rgba(0,0,0,.08), 0 1px 5px 0 rgba(0,0,0,.08);
        background: #fff;
    }

    

    /* #lista-container {
        display: none;
    } */
     
    .form-section h2{
        max-width: 600px;
        margin: 0 auto;
        color: #444;
        margin-bottom: 20px;
    }

    .cadastrar-campo{
        border: 1px solid #d1d1d1;
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding: 20px 30px;
        max-width: 600px;
        margin: 0 auto;
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
    
    .lista-container:has(li) .opcao-title{
        display: block;
    }

    .opcao-title{
        margin: 10px 0px;
        display: none;
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

    #lista  li:has(input){
        padding-left: 0px;
    }

    #lista  li input{
        width: 100%;
        padding: 10px;
        font-size: 16px;
    }
    
    .btn-salvar{
        width: 150px;
        height: 40px;
        margin: 0 auto;
        background: #1C813C;
        border: none;
        color: #fff;
        border-radius: 3px;
        font-size: 16px;
    }

</style>
</body>
</html>