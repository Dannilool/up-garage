<?php

include '../conexao.php';

if ($_POST) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "

    INSERT INTO clientes

    (nome, email, senha)

    VALUES

    (
        '$nome',
        '$email',
        '$senha'
    )

    ";

    mysqli_query($conn, $sql);

    $sucesso = "Cadastro realizado!";
}

$base = "../";

?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h1 class="mb-4">

                        Cadastro

                    </h1>

                    <?php if (isset($sucesso)) { ?>

                        <div class="alert alert-success">

                            <?php echo $sucesso; ?>

                        </div>

                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">

                            <input type="text"

                                name="nome"

                                class="form-control"

                                placeholder="Nome">

                        </div>

                        <div class="mb-3">

                            <input type="email"

                                name="email"

                                class="form-control"

                                placeholder="Email">

                        </div>

                        <div class="mb-3">

                            <input type="password"

                                name="senha"

                                class="form-control"

                                placeholder="Senha">

                        </div>

                        <button class="btn btn-dark w-100 mb-3">

                            Cadastrar

                        </button>

                        <a

                            href="login.php"

                            class="btn btn-outline-dark w-100">

                            Já tenho conta

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>