<?php
include './conexao.php';


$id = $_GET['id'];



// $sql = "DELETE FROM `formcampos` WHERE id = $id";

// $deletar= mysqli_query($conexao, $sql);


// Exclua na tabela opcaocampo
$sqlOpcaocampo = "DELETE FROM opcaocampo WHERE id_formcampo = $id";
$deletarOpcaocampo = mysqli_query($conexao, $sqlOpcaocampo);



// Exclua na tabela formcampos
$sqlFormcampos = "DELETE FROM formcampos WHERE id = $id";
$deletarFormcampos = mysqli_query($conexao, $sqlFormcampos);






header("Location: ./index.php");

?>