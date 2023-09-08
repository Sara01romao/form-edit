
<?php

include './conexao.php';
 
 



 
if(isset($_POST['acao'])){
    $name = $_POST['name'];

    $tipo = $_POST['tipo'];

    
 



  
     $sql= "INSERT INTO `formcampos`(`name`, `tipo`) VALUES ('$name','$tipo')";
       
     $inserir= mysqli_query($conexao, $sql);


    header("Location: ./index.php");
    
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
    
   edit

   
    
  

   <div class="container">
         
       <form action="add.php" class="cadastrar-campo" method="post">
           <input type="hidden" name="acao">

           
           <label for="">Nome do campo</label>
           <input type="text" name="name" required>
           

           <div>
                <label>
                    <p>Texto Curto</p>
                    <input type="radio" name="tipo" value="input" required>
                    <img src="./txt-icone.png" alt="Option 1">
                </label>

                <label>
                    <p>Texto Longo</p>
                    <input type="radio" name="tipo" value="textarea" >
                    <img src="./txt-icone.png" alt="Option 2">
                </label>
                
           </div>
           
          
        <button>Salvar</button>
              
       </form>

   </div>



   <div class="container">
         
       <form action="add.php" class="cadastrar-campo" method="post">
           <input type="hidden" name="acao">

           
           <label for="">Nome do campo</label>
           <input type="text" name="name" required>
           


           <label for="">Selecione o Tipo</label>

           <select name="" id="">
             <option value="">Campo Texto Simples</option>
             <option value="">Campo para texto longo</option>
             <option value="">Lista de opções</option>
             
           </select>

           <div class="list-option-container">
                
                <div class="opcao">
                    <label for="">Adicionar opção</label>
                    <input type="text" id="opcao-value" name="opcao" required>
                    <button type="button" id="add-opcao">Adicionar</button>
                </div>
               
                
                

           </div>
           

           <script>
            //  var listaOpcao =[];
            

            //  document.querySelector('#add-opcao').addEventListener('click', function(){
                  
            //     document.querySelector('.opcao').value;


            //  })


             document.querySelector('#add-opcao').addEventListener('click', function(){
                
                var num= document.querySelector('#opcao-value' ).value;
                  
               
                var listaOpcao =[];
                
                 listaOpcao

                


             })

            

             

             

           </script>
           
          
        <button>Salvar</button>
              
       </form>

   </div>





    <style>
        .container{
            border:1px solid red;
            max-width: 800px;
            margin: 0 auto;
        }

        .container form{
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 20px;
        }


        .cadastrar-campo  input:checked {
            background: blue;

            
        }

        /* HIDE RADIO */
        [type=radio] { 
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
        cursor: pointer;
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
            outline: 2px solid #f00;
        
        }
    
    </style>
</body>
</html>