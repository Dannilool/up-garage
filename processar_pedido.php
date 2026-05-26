<?php

session_start();

include 'conexao.php';

if(!isset($_SESSION['cliente'])){

    header("Location: usuario/login.php");

    exit;
}

if(count($_SESSION['carrinho']) <= 0){

    header("Location: carrinho.php");

    exit;
}

$cliente =
$_SESSION['cliente'];

$total = 0;

foreach($_SESSION['carrinho'] as $id){

    $sql = "

    SELECT * FROM produtos

    WHERE id = $id

    ";

    $resultado =
    mysqli_query($conn, $sql);

    $produto =
    mysqli_fetch_assoc($resultado);

    $total += $produto['preco'];
}

$sqlPedido = "

INSERT INTO pedidos

(cliente_id, total)

VALUES

(
    '{$cliente['id']}',
    '$total'
)

";

mysqli_query($conn, $sqlPedido);

$pedido_id =
mysqli_insert_id($conn);

foreach($_SESSION['carrinho'] as $id){

    $sql = "

    SELECT * FROM produtos

    WHERE id = $id

    ";

    $resultado =
    mysqli_query($conn, $sql);

    $produto =
    mysqli_fetch_assoc($resultado);

    $sqlItem = "

    INSERT INTO itens_pedido

    (
        pedido_id,
        produto_id,
        preco
    )

    VALUES

    (
        '$pedido_id',
        '{$produto['id']}',
        '{$produto['preco']}'
    )

    ";

    mysqli_query($conn, $sqlItem);
}

$_SESSION['carrinho'] = [];

?>

<?php include 'includes/header.php'; ?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-body text-center p-5">

                    <h1 class="text-success mb-4">

                        Pedido Confirmado 😄

                    </h1>

                    <p class="fs-5">

                        Sua compra foi realizada com sucesso.

                    </p>

                    <a

                    href="usuario/perfil.php"

                    class="btn btn-dark btn-lg mt-4">

                        Ver Meus Pedidos

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>