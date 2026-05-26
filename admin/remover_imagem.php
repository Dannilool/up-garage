<?php

session_start();

include '../conexao.php';

$id = $_GET['id'];

$produto = $_GET['produto'];

$sql = "

SELECT * FROM imagens_produto

WHERE id = $id

";

$resultado =
    mysqli_query($conn, $sql);

$imagem =
    mysqli_fetch_assoc($resultado);

if ($imagem) {

    if (
        file_exists(
            "../img/" . $imagem['imagem']
        )
    ) {

        unlink(
            "../img/" . $imagem['imagem']
        );
    }

    mysqli_query(

        $conn,

        "DELETE FROM imagens_produto
         WHERE id = $id"
    );
}

header(
    "Location: editar_produto.php?id=$produto"
);
