<?php

session_start();

if(!isset($_SESSION['cliente'])){

    $_SESSION['mensagem'] = "

    Você precisa fazer login
    para finalizar a compra.

    ";

    header("Location: usuario/login.php");

    exit;

}

include 'conexao.php';

if(!isset($_SESSION['cliente'])){

    header("Location: usuario/login.php");

    exit;
}

if(!isset($_SESSION['carrinho'])){

    $_SESSION['carrinho'] = [];
}

if(count($_SESSION['carrinho']) <= 0){

    header("Location: carrinho.php");

    exit;
}

$total = 0;

?>

<?php include 'includes/header.php'; ?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <h1 class="mb-4">

                Finalizar Compra

            </h1>

            <div class="row">

                <div class="col-md-8">

                    <div class="card shadow mb-4">

                        <div class="card-body">

                            <h3 class="mb-4">

                                Produtos

                            </h3>

                            <?php

                            foreach($_SESSION['carrinho'] as $id){

                                $sql = "

                                SELECT * FROM produtos

                                WHERE id = $id

                                ";

                                $resultado =
                                mysqli_query($conn, $sql);

                                $produto =
                                mysqli_fetch_assoc($resultado);

                                $sqlImagem = "

                                SELECT * FROM imagens_produto

                                WHERE produto_id = $id

                                LIMIT 1

                                ";

                                $resultadoImagem =
                                mysqli_query($conn, $sqlImagem);

                                $imagem =
                                mysqli_fetch_assoc($resultadoImagem);

                                $total +=
                                $produto['preco'];

                            ?>

                                <div class="row mb-4">

                                    <div class="col-md-3">

                                        <?php if($imagem){ ?>

                                            <img

                                            src="img/<?php echo $imagem['imagem']; ?>"

                                            class="img-fluid rounded"

                                            style="
                                            height:120px;
                                            width:100%;
                                            object-fit:cover;
                                            ">

                                        <?php } ?>

                                    </div>

                                    <div class="col-md-9">

                                        <h4>

                                            <?php echo $produto['nome']; ?>

                                        </h4>

                                        <p class="text-secondary">

                                            <?php

                                            echo substr(
                                                $produto['descricao'],
                                                0,
                                                100
                                            );

                                            ?>...

                                        </p>

                                        <h5 class="text-success">

                                            R$

                                            <?php

                                            echo number_format(
                                                $produto['preco'],
                                                2,
                                                ',',
                                                '.'
                                            );

                                            ?>

                                        </h5>

                                    </div>

                                </div>

                            <?php } ?>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card shadow">

                        <div class="card-body">

                            <h3 class="mb-4">

                                Resumo

                            </h3>

                            <div class="mb-3">

                                <strong>
                                    Cliente:
                                </strong>

                                <br>

                                <?php

                                echo $_SESSION['cliente']['nome'];

                                ?>

                            </div>

                            <div class="mb-4">

                                <strong>
                                    Total:
                                </strong>

                                <h2 class="text-success">

                                    R$

                                    <?php

                                    echo number_format(
                                        $total,
                                        2,
                                        ',',
                                        '.'
                                    );

                                    ?>

                                </h2>

                            </div>

                            <form action="processar_pedido.php"
                                  method="POST">

                                <button

                                class="btn btn-success btn-lg w-100">

                                    Confirmar Compra

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>