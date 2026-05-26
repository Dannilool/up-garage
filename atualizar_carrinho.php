<?php

session_start();

$id = $_POST['id'];

$quantidade =
(int) $_POST['quantidade'];

if($quantidade <= 0){

    unset($_SESSION['carrinho'][$id]);

}else{

    $_SESSION['carrinho'][$id]
    = $quantidade;

}

header('Location: carrinho.php');