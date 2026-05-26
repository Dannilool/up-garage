<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: login.php");

    exit;
}

include '../conexao.php';

$id = $_GET['id'];

$sqlPedido = "

SELECT

pedidos.*,

clientes.nome AS cliente

FROM pedidos

INNER JOIN clientes

ON pedidos.cliente_id = clientes.id

WHERE pedidos.id = $id

";

$resultadoPedido =
mysqli_query($conn, $sqlPedido);

$pedido =
mysqli_fetch_assoc($resultadoPedido);

$sqlItens = "

SELECT

itens_pedido.*,

produtos.nome,

produtos.descricao

FROM itens_pedido

INNER JOIN produtos

ON itens_pedido.produto_id = produtos.id

WHERE itens_pedido.pedido_id = $id

";

$resultadoItens =
mysqli_query($conn, $sqlItens);

$base = "../";

?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">

    <?php if($pedido){ ?>

        <div class="d-flex
                    justify-content-between
                    align-items-center
                    mb-4
                    flex-wrap
                    gap-3">

            <div>

                <h1>

                    Pedido #<?php echo $pedido['id']; ?>

                </h1>

                <p class="mb-0">

                    Cliente:
                    <?php echo $pedido['cliente']; ?>

                </p>

            </div>

            <a

            href="pedidos.php"

            class="btn btn-dark">

                Voltar

            </a>

        </div>

        <div class="card shadow mb-4">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4">

                        <strong>
                            Total:
                        </strong>

                        <h3 class="text-success">

                            R$

                            <?php

                            echo number_format(
                                $pedido['total'],
                                2,
                                ',',
                                '.'
                            );

                            ?>

                        </h3>

                    </div>

                    <div class="col-md-4">

                        <strong>
                            Data:
                        </strong>

                        <p>

                            <?php

                            echo date(
                                'd/m/Y H:i',
                                strtotime(
                                    $pedido['data_pedido']
                                )
                            );

                            ?>

                        </p>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <?php

            while($item =
            mysqli_fetch_assoc($resultadoItens)){

                $sqlImagem = "

                SELECT * FROM imagens_produto

                WHERE produto_id = {$item['produto_id']}

                LIMIT 1

                ";

                $resultadoImagem =
                mysqli_query($conn, $sqlImagem);

                $imagem =
                mysqli_fetch_assoc($resultadoImagem);

            ?>

                <div class="col-12 mb-4">

                    <div class="card shadow">

                        <div class="row g-0">

                            <div class="col-md-3">

                                <?php if($imagem){ ?>

                                    <img

                                    src="../img/<?php echo $imagem['imagem']; ?>"

                                    class="img-fluid rounded-start"

                                    style="
                                    height:220px;
                                    width:100%;
                                    object-fit:cover;
                                    ">

                                <?php } ?>

                            </div>

                            <div class="col-md-9">

                                <div class="card-body">

                                    <h3>

                                        <?php echo $item['nome']; ?>

                                    </h3>

                                    <p class="text-secondary">

                                        <?php

                                        echo substr(
                                            $item['descricao'],
                                            0,
                                            150
                                        );

                                        ?>...

                                    </p>

                                    <h4 class="text-success">

                                        R$

                                        <?php

                                        echo number_format(
                                            $item['preco'],
                                            2,
                                            ',',
                                            '.'
                                        );

                                        ?>

                                    </h4>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    <?php }else{ ?>

        <div class="alert alert-danger">

            Pedido não encontrado.

        </div>

    <?php } ?>

</div>

<?php include '../includes/footer.php'; ?>