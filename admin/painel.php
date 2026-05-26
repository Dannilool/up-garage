<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: login.php");
}

include '../conexao.php';

$totalProdutos =
    mysqli_num_rows(
        mysqli_query(
            $conn,
            "SELECT * FROM produtos"
        )
    );

$totalCategorias =
    mysqli_num_rows(
        mysqli_query(
            $conn,
            "SELECT * FROM categorias"
        )
    );

$totalUsuarios =
    mysqli_num_rows(
        mysqli_query(
            $conn,
            "SELECT * FROM admins"
        )
    );

$base = "../";

?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">

    <div class="d-flex
                justify-content-between
                align-items-center
                mb-4">

        <h1>
            Painel Administrativo
        </h1>

    </div>

    <div class="row">

        <div class="col-md-4">

            <div class="card
                        shadow
                        text-center
                        mb-4">

                <div class="card-body">

                    <h5>
                        Produtos
                    </h5>

                    <h1>

                        <?php echo $totalProdutos; ?>

                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card
                        shadow
                        text-center
                        mb-4">

                <div class="card-body">

                    <h5>
                        Categorias
                    </h5>

                    <h1>

                        <?php echo $totalCategorias; ?>

                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card
                        shadow
                        text-center
                        mb-4">

                <div class="card-body">

                    <h5>
                        Usuários
                    </h5>

                    <h1>

                        <?php echo $totalUsuarios; ?>

                    </h1>

                </div>

            </div>

        </div>

    </div>

    <div class="mt-4">

        <a href="cadastrar_produto.php"
            class="btn btn-dark me-2">

            Cadastrar Produto

        </a>

        <a
         href="categorias.php"

            class="btn btn-primary me-2">

            Categorias

        </a>

        <a href="produtos.php"
            class="btn btn-secondary me-2">

            Gerenciar Produtos

        </a>

        <a

            href="pedidos.php"

            class="btn btn-success me-2">

            Ver Pedidos

        </a>

        <a href="logout.php"
            class="btn btn-danger me-2">

            Sair

        </a>

    </div>

</div>

<?php include '../includes/footer.php'; ?>