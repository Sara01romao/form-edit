<?php
include './conexao.php';



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

   
    
   <div class="container menu-campo">
            <a href="./add.php">+ adicionar campo</a>
   </div>



   <div class="container">
        <form action="" class="formulario">

       
        <?php
                

                $sql= "SELECT * FROM `formcampos`";
               
                $busca = mysqli_query($conexao, $sql);
        
      
        
                while ($array= mysqli_fetch_array($busca)){
                    $id= $array['id'];
                    $name= $array['name'];
                    $tipo= $array['tipo'];
    
        ?>
        
        
    
                <?php
                    if($tipo == "input"){
                        
                        
                        echo " <div><a href='remover.php?id=$id'>Remover</a><div class='campo-container'><label for='$name'>$name</label> <input type='text' name='$name'></div></div>";

                    }elseif ($tipo == "textarea") {
                        echo "<div class='campo-container'><label for='$name'>$name</label><textarea name='$name'></textarea></div>";
                    }
                    
                ?>   

  
        

        <?php } ?>
   
                

        </form>
    </div>



    <style>
        .container{
            border:1px solid red;
            max-width: 600px;
            margin: 0 auto;
        }

        .container form{
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 20px;
        }
       
        .menu-campo{
            display: flex;
            justify-content: end;
        }
        .menu-campo a{
            padding: 10px;

        }

        .campo-container{
            display: flex;
            flex-direction: column;

        }

        .campo-container textarea{
            height: 100px;
            overflow: auto;

        }
    </style>
</body>
</html>