<?php
include './conexao.php';


$id = $_GET['id'];

$sql = "DELETE FROM `formcampos` WHERE id = $id";

$deletar= mysqli_query($conexao, $sql);


header("Location: ./index.php");

?>