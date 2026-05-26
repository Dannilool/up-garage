<?php

function calcularSubtotal($preco, $quantidade){

    return $preco * $quantidade;

}

function calcularTotal($totalAtual, $subtotal){

    return $totalAtual + $subtotal;

}

function validarQuantidade($quantidade){

    if($quantidade < 1){

        return 1;

    }

    return $quantidade;

}