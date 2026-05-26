<?php

$base = "../";

session_start();

include '../conexao.php';

if ($_POST) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM admins

            WHERE email = '$email'

            AND senha = '$senha'";

    $resultado =
        mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {

        $_SESSION['admin'] = $email;

        header("Location: painel.php");
    } else {

        $erro = "Email ou senha inválidos.";
    }
}

?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-body">

                    <h2 class="mb-4 text-center">

                        Login Admin

                    </h2>

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

                        <button class="btn btn-dark w-100">

                            Entrar

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>