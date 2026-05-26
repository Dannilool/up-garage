<?php

session_start();

include '../conexao.php';

if ($_POST) {

    $email = $_POST['email'];

    $senha = $_POST['senha'];

    $sql = "

    SELECT * FROM clientes

    WHERE email = '$email'

    AND senha = '$senha'

    ";

    $resultado =
        mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {

        $cliente =
            mysqli_fetch_assoc($resultado);

        $_SESSION['cliente'] =
            $cliente;

        header("Location: perfil.php");
    } else {

        $erro = "Login inválido.";
    }
}

$base = "../";

?>

<?php include '../includes/header.php'; ?>

<?php

if(isset($_SESSION['mensagem'])){

?>

    <div class="container mt-4">

        <div class="alert alert-warning shadow">

            <?php

            echo $_SESSION['mensagem'];

            unset($_SESSION['mensagem']);

            ?>

        </div>

    </div>

<?php } ?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h1 class="mb-4">

                        Login

                    </h1>

                    <?php if (isset($erro)) { ?>

                        <div class="alert alert-danger">

                            <?php echo $erro; ?>

                        </div>

                    <?php } ?>

                    <form method="POST">

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

                            Entrar

                        </button>

                        <a

                            href="cadastro.php"

                            class="btn btn-outline-dark w-100">

                            Criar Conta

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>