<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: login.php");

    exit;
}

include '../conexao.php';

$sql = "

SELECT

pedidos.*,

clientes.nome AS cliente

FROM pedidos

INNER JOIN clientes

ON pedidos.cliente_id = clientes.id

ORDER BY pedidos.id DESC

";

$resultado =
mysqli_query($conn, $sql);
if(!$resultado){

    die(mysqli_error($conn));

}

$base = "../";

?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">

    <div class="d-flex
                justify-content-between
                align-items-center
                mb-4
                flex-wrap
                gap-3">

        <h1>
            Pedidos
        </h1>

        <a

        href="painel.php"

        class="btn btn-dark">

            Voltar Painel

        </a>

    </div>

    <?php

    if(mysqli_num_rows($resultado) > 0){

    ?>

        <div class="table-responsive">

            <table class="table
                          table-striped
                          table-hover
                          align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>Cliente</th>

                        <th>Total</th>

                        <th>Data</th>

                        <th>Detalhes</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    while($pedido =
                    mysqli_fetch_assoc($resultado)){

                    ?>

                        <tr>

                            <td>

                                #<?php echo $pedido['id']; ?>

                            </td>

                            <td>

                                <?php echo $pedido['cliente']; ?>

                            </td>

                            <td class="text-success">

                                R$

                                <?php

                                echo number_format(
                                    $pedido['total'],
                                    2,
                                    ',',
                                    '.'
                                );

                                ?>

                            </td>

                            <td>

                                <?php

                                echo date(
                                    'd/m/Y H:i',
                                    strtotime(
                                        $pedido['data_pedido']
                                    )
                                );

                                ?>

                            </td>

                            <td>

                                <a

                                href="detalhes_pedido.php?id=<?php echo $pedido['id']; ?>"

                                class="btn btn-primary btn-sm">

                                    Ver Pedido

                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    <?php }else{ ?>

        <div class="alert alert-warning">

            Nenhum pedido encontrado.

        </div>

    <?php } ?>

</div>

<?php include '../includes/footer.php'; ?>