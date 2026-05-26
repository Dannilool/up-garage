<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: login.php");
}

include '../conexao.php';

$id = $_GET['id'];

$sql = "SELECT * FROM produtos
        WHERE id = $id";

$resultado =
    mysqli_query($conn, $sql);

$produto =
    mysqli_fetch_assoc($resultado);

if ($produto) {

    if (
        !empty($produto['imagem']) &&

        file_exists("../img/" . $produto['imagem'])
    ) {

        unlink("../img/" . $produto['imagem']);
    }

    $delete = "DELETE FROM produtos
               WHERE id = $id";

    mysqli_query($conn, $delete);
}

header("Location: produtos.php");
