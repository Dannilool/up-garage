<?php

include 'conexao.php';

/* PRODUTOS DESTAQUE */

$sql = "

SELECT * FROM produtos

ORDER BY id DESC

LIMIT 6

";

$resultado =
    mysqli_query($conn, $sql);

/* CATEGORIAS */

$sqlCategorias = "

SELECT * FROM categorias

";

$resultadoCategorias =
    mysqli_query($conn, $sqlCategorias);

?>

<?php include 'includes/header.php'; ?>

<!-- HERO -->

<section

    class="bg-dark text-light py-5"

    data-aos="fade-up">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h1 class="display-4 fw-bold mb-4">

                    Performance,
                    Som e LED
                    para seu carro 🚗💨

                </h1>

                <p class="lead text-secondary mb-4">

                    Os melhores acessórios automotivos,
                    iluminação LED, som automotivo
                    e equipamentos premium.

                </p>

                <a

                    href="produtos.php"

                    class="btn btn-danger btn-lg">

                    Ver Produtos

                </a>

            </div>

            <div class="col-lg-6 text-center">

                <img

                    src="img/logo.png"

                    class="img-fluid"

                    style="
                max-height:400px;
                object-fit:contain;
                ">

            </div>

        </div>

    </div>

</section>

<!-- CATEGORIAS -->

<section class="py-5">

    <div class="container">

        <h2 class="mb-5 text-center">

            Categorias

        </h2>

        <div class="row g-4">

            <?php

            while ($categoria =
                mysqli_fetch_assoc($resultadoCategorias)
            ) {

            ?>

                <div class="col-12 col-md-6 col-lg-3">

                    <a

                        href="produtos.php?categoria=<?php echo $categoria['id']; ?>"

                        class="text-decoration-none">

                        <div

                            class="card shadow h-100 text-center p-4 categoria-card">

                            <h3 class="mb-3">

                                <?php

                                if ($categoria['nome'] == 'Alto-Falantes') {

                                    echo '🔊';
                                } elseif ($categoria['nome'] == 'Lâmpadas') {

                                    echo '💡';
                                } elseif ($categoria['nome'] == 'Baterias') {

                                    echo '🔋';
                                } elseif ($categoria['nome'] == 'Rádios') {

                                    echo '📻';
                                }

                                ?>

                            </h3>

                            <h4 class="text-dark">

                                <?php echo $categoria['nome']; ?>

                            </h4>

                        </div>

                    </a>

                </div>

            <?php } ?>

        </div>

    </div>

</section>

<!-- PRODUTOS -->

<section class="py-5 bg-light">

    <div class="container">

        <h2 class="mb-5 text-center">

            Produtos em Destaque

        </h2>

        <div class="row">

            <?php

            while ($produto =
                mysqli_fetch_assoc($resultado)
            ) {

                $sqlImagem = "

                SELECT * FROM imagens_produto

                WHERE produto_id = {$produto['id']}

                LIMIT 1

                ";

                $resultadoImagem =
                    mysqli_query($conn, $sqlImagem);

                $imagem =
                    mysqli_fetch_assoc($resultadoImagem);

            ?>

                <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">

                    <div class="card shadow w-100 h-100 border-0">

                        <?php if ($imagem) { ?>

                            <img

                                src="img/<?php echo $imagem['imagem']; ?>"

                                class="card-img-top"

                                style="
                            height:250px;
                            object-fit:cover;
                            ">

                        <?php } ?>

                        <div class="card-body d-flex flex-column">

                            <h5>

                                <?php echo $produto['nome']; ?>

                            </h5>

                            <p class="text-secondary">

                                <?php

                                echo substr(
                                    $produto['descricao'],
                                    0,
                                    70
                                );

                                ?>...

                            </p>

                            <h4 class="text-success mt-auto">

                                R$

                                <?php

                                echo number_format(
                                    $produto['preco'],
                                    2,
                                    ',',
                                    '.'
                                );

                                ?>

                            </h4>

                            <a

                                href="produto.php?id=<?php echo $produto['id']; ?>"

                                class="btn btn-dark mt-3">

                                Ver Produto

                            </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</section>

<!-- VANTAGENS -->

<section class="py-5">

    <div class="container">

        <div class="row text-center g-4">

            <div

                class="col-md-3"

                data-aos="flip-left">

                <div class="card shadow p-4 h-100 border-0">

                    <h2>🚚</h2>

                    <h5>Entrega Rápida</h5>

                </div>

            </div>

            <div

                class="col-md-3"

                data-aos="flip-left">

                <div class="card shadow p-4 h-100 border-0">

                    <h2>🔒</h2>

                    <h5>Compra Segura</h5>

                </div>

            </div>

            <div

                class="col-md-3"

                data-aos="flip-left">

                <div class="card shadow p-4 h-100 border-0">

                    <h2>⭐</h2>

                    <h5>Qualidade Premium</h5>

                </div>

            </div>

            <div

                class="col-md-3"

                data-aos="flip-left">

                <div class="card shadow p-4 h-100 border-0">

                    <h2>💳</h2>

                    <h5>Melhor Preço</h5>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include 'includes/footer.php'; ?>