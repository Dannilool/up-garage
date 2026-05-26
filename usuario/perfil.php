<?php

session_start();

include '../conexao.php';

if(!isset($_SESSION['cliente'])){

    header("Location: login.php");

    exit;
}

$cliente =
$_SESSION['cliente'];

$idCliente =
$cliente['id'];

$sql = "

SELECT * FROM pedidos

WHERE cliente_id = $idCliente

ORDER BY id DESC

";

$resultado =
mysqli_query($conn, $sql);

$base = "../";

?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow mb-4">

                <div class="card-body p-4">

                    <div class="d-flex
                                justify-content-between
                                align-items-center
                                flex-wrap
                                gap-3">

                        <div>

                            <h1>

                                Minha Conta

                            </h1>

                            <p class="mb-0">

                                Bem-vindo,
                                <?php echo $cliente['nome']; ?>

                            </p>

                        </div>

                        <a

                        href="logout.php"

                        class="btn btn-danger">

                            Sair

                        </a>

                    </div>

                </div>

            </div>

            <div class="card shadow">

                <div class="card-body p-4">

                    <h2 class="mb-4">

                        Meus Pedidos

                    </h2>

                    <?php

                    if(mysqli_num_rows($resultado) > 0){

                        while($pedido =
                        mysqli_fetch_assoc($resultado)){

                    ?>

                        <div class="border rounded p-3 mb-3">

                            <div class="row">

                                <div class="col-md-4">

                                    <strong>
                                        Pedido:
                                    </strong>

                                    #<?php echo $pedido['id']; ?>

                                </div>

                                <div class="col-md-4">

                                    <strong>
                                        Total:
                                    </strong>

                                    R$

                                    <?php

                                    echo number_format(
                                        $pedido['total'],
                                        2,
                                        ',',
                                        '.'
                                    );

                                    ?>

                                </div>

                                <div class="col-md-4">

                                    <strong>
                                        Data:
                                    </strong>

                                    <?php

                                    echo date(
                                        'd/m/Y H:i',
                                        strtotime(
                                            $pedido['data_pedido']
                                        )
                                    );

                                    ?>

                                </div>

                            </div>

                        </div>

                    <?php

                        }

                    }else{

                    ?>

                        <div class="alert alert-warning">

                            Você ainda não realizou pedidos.

                        </div>

                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>