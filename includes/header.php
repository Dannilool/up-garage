<?php
if (!isset($base)) {
    $base = "";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Up Garage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <link rel="icon"

        type="image/png"

        href="<?php echo $base; ?>img/favicon.png">

    <link

        rel="stylesheet"

        href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
    <link

        rel="stylesheet"

        href="../style.css">

</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="container">

            <!-- LOGO -->

            <a

                class="navbar-brand d-flex align-items-center gap-2"

                href="<?php echo $base; ?>index.php">

                <img

                    src="<?php echo $base; ?>img/logo.png"

                    height="70"

                    style="
            object-fit:contain;">

            </a>

            <!-- BOTÃO MOBILE -->

            <button

                class="navbar-toggler"

                type="button"

                data-bs-toggle="collapse"

                data-bs-target="#menuMobile"

                aria-controls="menuMobile"

                aria-expanded="false"

                aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <!-- MENU -->

            <div

                class="collapse navbar-collapse"

                id="menuMobile">

                <div class="navbar-nav ms-auto gap-2">

                    <a class="btn btn-outline-light"

                        href="<?php echo $base; ?>index.php">

                        Home

                    </a>

                    <a class="btn btn-outline-light"

                        href="<?php echo $base; ?>produtos.php">

                        Produtos

                    </a>

                    <a class="btn btn-outline-light"

                        href="<?php echo $base; ?>categorias.php">

                        Categorias

                    </a>

                    <a class="btn btn-outline-light"

                        href="<?php echo $base; ?>contato.php">

                        Contato

                    </a>

                    <a class="btn btn-warning"

                        href="<?php echo $base; ?>carrinho.php">

                        Carrinho

                    </a>

                    <?php if (isset($_SESSION['admin'])) { ?>

                        <a class="btn btn-warning"

                            href="<?php echo $base; ?>admin/painel.php">

                            Painel Admin

                        </a>

                        <a class="btn btn-danger"

                            href="<?php echo $base; ?>admin/logout.php">

                            Sair Admin

                        </a>

                    <?php } elseif (isset($_SESSION['cliente'])) { ?>

                        <a class="btn btn-success"

                            href="<?php echo $base; ?>usuario/perfil.php">

                            Minha Conta

                        </a>

                        <a class="btn btn-danger"

                            href="<?php echo $base; ?>usuario/logout.php">

                            Sair

                        </a>

                    <?php } else { ?>

                        <a class="btn btn-outline-warning"

                            href="<?php echo $base; ?>usuario/login.php">

                            Login

                        </a>

                    <?php } ?>

                </div>

            </div>

        </div>

    </nav>