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
    

   


<section class="form-section">
        <h2>Configurar Formulário</h2>
        

        <form action="" class="formulario">
        <div class="campo-container">
            <label for="name">Nome do Formulário</label>
            <input type="text" name="name" required>
        </div>
       
        <div class="campo-form-container">
            <h3 class="title-form">Editar Campo</h3>
            <div class="menu-campo">
                <a href="./add.php">+ Adicionar Campo</a>
            </div>
        </div>
        
        <?php

                $sql= "SELECT * FROM `formcampos`";
               
                $busca = mysqli_query($conexao, $sql);
        
      
                while ($array = mysqli_fetch_array($busca)) {
                    $id = $array['id'];
                    $name = $array['name'];
                    $tipo = $array['tipo'];
                
                    echo "<div class='campo-bloco'><div class='campo-bloco-menu'><a href='edit_campo.php?id=$id'><svg width='14' height='14' viewBox='0 0 14 14' fill='none' xmlns='http://www.w3.org/2000/svg'>
                    <path d='M7.95001 2.54937L11.4505 6.04997L3.84938 13.6514L0.728442 13.9959C0.31064 14.0421 -0.0423582 13.6888 0.00412498 13.271L0.351382 10.1478L7.95001 2.54937ZM13.6155 2.02819L11.9719 0.384528C11.4592 -0.128176 10.6277 -0.128176 10.115 0.384528L8.56878 1.93084L12.0692 5.43145L13.6155 3.88513C14.1282 3.37215 14.1282 2.54089 13.6155 2.02819Z' fill='#262626'/>
                    </svg>
                     </a><a href='remover.php?id=$id'> <svg width='13' height='15' viewBox='0 0 13 15' fill='none' xmlns='http://www.w3.org/2000/svg'>
                     <path d='M0.928571 13.5938C0.928571 13.9667 1.07532 14.3244 1.33653 14.5881C1.59774 14.8518 1.95202 15 2.32143 15H10.6786C11.048 15 11.4023 14.8518 11.6635 14.5881C11.9247 14.3244 12.0714 13.9667 12.0714 13.5938V3.75H0.928571V13.5938ZM8.82143 6.09375C8.82143 5.96943 8.87034 5.8502 8.95741 5.7623C9.04448 5.67439 9.16258 5.625 9.28571 5.625C9.40885 5.625 9.52694 5.67439 9.61401 5.7623C9.70108 5.8502 9.75 5.96943 9.75 6.09375V12.6563C9.75 12.7806 9.70108 12.8998 9.61401 12.9877C9.52694 13.0756 9.40885 13.125 9.28571 13.125C9.16258 13.125 9.04448 13.0756 8.95741 12.9877C8.87034 12.8998 8.82143 12.7806 8.82143 12.6563V6.09375ZM6.03571 6.09375C6.03571 5.96943 6.08463 5.8502 6.1717 5.7623C6.25877 5.67439 6.37686 5.625 6.5 5.625C6.62314 5.625 6.74123 5.67439 6.8283 5.7623C6.91537 5.8502 6.96429 5.96943 6.96429 6.09375V12.6563C6.96429 12.7806 6.91537 12.8998 6.8283 12.9877C6.74123 13.0756 6.62314 13.125 6.5 13.125C6.37686 13.125 6.25877 13.0756 6.1717 12.9877C6.08463 12.8998 6.03571 12.7806 6.03571 12.6563V6.09375ZM3.25 6.09375C3.25 5.96943 3.29892 5.8502 3.38599 5.7623C3.47306 5.67439 3.59115 5.625 3.71429 5.625C3.83742 5.625 3.95551 5.67439 4.04258 5.7623C4.12966 5.8502 4.17857 5.96943 4.17857 6.09375V12.6563C4.17857 12.7806 4.12966 12.8998 4.04258 12.9877C3.95551 13.0756 3.83742 13.125 3.71429 13.125C3.59115 13.125 3.47306 13.0756 3.38599 12.9877C3.29892 12.8998 3.25 12.7806 3.25 12.6563V6.09375ZM12.5357 0.937505H9.05357L8.7808 0.389653C8.72302 0.272529 8.63402 0.174006 8.5238 0.105169C8.41358 0.0363316 8.28652 -8.87099e-05 8.15692 5.13654e-06H4.84018C4.71087 -0.000496734 4.58403 0.0357877 4.47421 0.104701C4.36438 0.173615 4.276 0.272371 4.2192 0.389653L3.94643 0.937505H0.464286C0.341149 0.937505 0.223057 0.986891 0.135986 1.0748C0.0489157 1.16271 0 1.28193 0 1.40625L0 2.34375C0 2.46807 0.0489157 2.5873 0.135986 2.67521C0.223057 2.76312 0.341149 2.8125 0.464286 2.8125H12.5357C12.6588 2.8125 12.7769 2.76312 12.864 2.67521C12.9511 2.5873 13 2.46807 13 2.34375V1.40625C13 1.28193 12.9511 1.16271 12.864 1.0748C12.7769 0.986891 12.6588 0.937505 12.5357 0.937505Z' fill='#262626'/>
                     </svg>
                      </a></div><div class='campo-container'>";
                
                    if ($tipo == "input") {
                        echo "<label for='$name'>$name</label> <input type='text' name='$name'>";
                        
                    } elseif ($tipo == "textarea") {
                        echo "<label for='$name'>$name</label><textarea name='$name'></textarea>";
                    } elseif ($tipo == "select") {
                        echo "<label for='$name'>$name</label><select name='$name'>";
                        
                        $sql_option = "SELECT opcaocampo.*
                                        FROM opcaocampo
                                        JOIN formcampos ON opcaocampo.id_formcampo = formcampos.id
                                        WHERE formcampos.id = $id";
                                        
                        $busca_option = mysqli_query($conexao, $sql_option);
                
                        while ($option_array = mysqli_fetch_array($busca_option)) {
                            $id_op = $option_array['id'];
                            $nome_opcao = $option_array['nome_opcao'];
                
                            echo "<option value='$id_op'>$nome_opcao</option>";
                        }
                        
                        echo "</select>";
                    }
                
                    echo "</div></div>";
                }
                ?> 


      
        </form>
    </section>



    <style>

         @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;700&display=swap');

         *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        
    }
      
        body{
            font-family: 'arial', sans-serif;
        }

        .form-section{
            max-width: 1200px;
            margin: 0 auto;

            padding: 30px;
            box-shadow: 0 2px 2px 0 rgba(0,0,0,.05), 0 3px 1px -2px rgba(0,0,0,.08), 0 1px 5px 0 rgba(0,0,0,.08);
            background: #fff;
        }

        .form-section h2{
            max-width: 600px;
            margin: 0 auto;
            color: #444;
            margin-bottom: 20px;
        }


        .container{
            border:1px solid red;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-section form{
           

            
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px 30px;
            max-width: 600px;
            margin: 0 auto;
        }
        

        .campo-form-container{
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #F7F7F7;
            
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

        .campo-container{
        display: flex;
        flex-direction: column;
        gap: 10px;
        
    }

        .campo-container input{
        
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

        .title-form{
            color: #4d4d4d;
            font-size: 18px;
            padding: 10px;

          

        }

        .campo-bloco{
            position: relative;
        }


        .campo-bloco-menu{
            display: flex;
            
            justify-content: end;
            gap: 24px;

            position: absolute;
            right: 0px;
            top: -6px;
        }
       
        .campo-bloco-menu a{
            text-decoration: none;
            color: #444;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 16px;
            padding: 8px;
            
        }

        .campo-bloco-menu a:hover {
            font-weight: bold;
            
        }


        .menu-campo a{
            color: #0094E1;
            text-decoration: none;
            

        }

        .menu-campo a:hover{
            text-decoration: underline;
        }


    </style>
</body>
</html>