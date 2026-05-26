<?php

include 'conexao.php';

$id = $_GET['id'];

$sql = "

SELECT * FROM produtos

WHERE id = $id

";

$resultado =
    mysqli_query($conn, $sql);

$produto =
    mysqli_fetch_assoc($resultado);

$sqlImagens = "

SELECT * FROM imagens_produto

WHERE produto_id = $id

";

$resultadoImagens =
    mysqli_query($conn, $sqlImagens);

$imagens = [];

while ($img = mysqli_fetch_assoc($resultadoImagens)) {

    $imagens[] = $img;
}

?>

<?php include 'includes/header.php'; ?>

<div class="container mt-5">

    <?php if ($produto) { ?>

        <div class="row g-5">

            <!-- GALERIA -->

            <div class="col-md-6">

                <div

                    id="carouselProduto"

                    class="carousel slide shadow rounded overflow-hidden bg-white"

                    data-bs-ride="carousel"

                    data-bs-interval="3000">
                    <div class="carousel-inner">

                        <?php

                        $ativo = true;

                        foreach ($imagens as $imagem) {

                        ?>

                            <div class="carousel-item <?php

                                                        if ($ativo) {

                                                            echo 'active';

                                                            $ativo = false;
                                                        }

                                                        ?>">

                                <img

                                    src="img/<?php echo $imagem['imagem']; ?>"

                                    class="d-block w-100 imagem-produto"

                                    style="
                                height:500px;
                                object-fit:cover;
                                cursor:pointer;
                                "

                                    data-imagem="img/<?php echo $imagem['imagem']; ?>">

                            </div>

                        <?php } ?>

                    </div>

                    <!-- SETA ESQUERDA -->

                    <button

                        class="carousel-control-prev"

                        type="button"

                        data-bs-target="#carouselProduto"

                        data-bs-slide="prev">

                        <span class="carousel-control-prev-icon"></span>

                    </button>

                    <!-- SETA DIREITA -->

                    <button

                        class="carousel-control-next"

                        type="button"

                        data-bs-target="#carouselProduto"

                        data-bs-slide="next">

                        <span class="carousel-control-next-icon"></span>

                    </button>

                </div>

                <!-- MINIATURAS -->

                <div class="d-flex
                            gap-2
                            mt-3
                            flex-wrap
                            justify-content-center">

                    <?php

                    foreach ($imagens as $index => $imagem) {

                    ?>

                        <button

                            type="button"

                            class="border-0 bg-transparent p-0"

                            onclick="trocarSlide(<?php echo $index; ?>)">

                            <img

                                src="img/<?php echo $imagem['imagem']; ?>"

                                width="80"

                                height="80"

                                class="rounded shadow border"

                                style="
                            object-fit:cover;
                            cursor:pointer;
                            ">

                        </button>

                    <?php } ?>

                </div>

            </div>

            <!-- INFO PRODUTO -->

            <div class="col-md-6 d-flex flex-column justify-content-center">

                <h1 class="mb-4">

                    <?php echo $produto['nome']; ?>

                </h1>

                <p class="fs-5 text-secondary">

                    <?php echo $produto['descricao']; ?>

                </p>

                <h2 class="text-success mt-4">

                    R$

                    <?php

                    echo number_format(
                        $produto['preco'],
                        2,
                        ',',
                        '.'
                    );

                    ?>

                </h2>

<form

action="carrinho.php"

method="GET"

class="mt-4">

    <input

    type="hidden"

    name="add"

    value="<?php echo $produto['id']; ?>">

    <div class="d-flex align-items-center gap-3 mb-3">

        <button

        type="button"

        class="btn btn-outline-dark"

        onclick="diminuirQuantidade()">

            -

        </button>

        <input

        type="number"

        name="quantidade"

        id="quantidade"

        value="1"

        min="1"

        class="form-control text-center"

        style="
        width:80px;
        ">

        <button

        type="button"

        class="btn btn-outline-dark"

        onclick="aumentarQuantidade()">

            +

        </button>

    </div>

    <button

    type="submit"

    class="btn btn-dark btn-lg w-100">

        Adicionar ao Carrinho

    </button>

</form>
                <p></p>
            </div>

        </div>

    <?php } else { ?>

        <div class="alert alert-danger">

            Produto não encontrado.

        </div>

    <?php } ?>

</div>

<!-- MODAL COM CAROUSEL -->

<div

    class="modal fade"

    id="imagemModal"

    tabindex="-1">

    <div class="modal-dialog
                modal-dialog-centered
                modal-xl">

        <div class="modal-content bg-dark border-0">

            <div class="modal-body p-0">

                <div

                    id="carouselModal"

                    class="carousel slide"

                    data-bs-ride="false">

                    <div class="carousel-inner">

                        <?php

                        $ativoModal = true;

                        foreach ($imagens as $imagem) {

                        ?>

                            <div class="carousel-item <?php

                                                        if ($ativoModal) {

                                                            echo 'active';

                                                            $ativoModal = false;
                                                        }

                                                        ?>">

                                <img

                                    src="img/<?php echo $imagem['imagem']; ?>"

                                    class="d-block w-100"

                                    style="
                                max-height:90vh;
                                object-fit:contain;
                                ">

                            </div>

                        <?php } ?>

                    </div>

                    <!-- SETA ESQUERDA -->

                    <button

                        class="carousel-control-prev"

                        type="button"

                        data-bs-target="#carouselModal"

                        data-bs-slide="prev">

                        <span
                            class="carousel-control-prev-icon">

                        </span>

                    </button>

                    <!-- SETA DIREITA -->

                    <button

                        class="carousel-control-next"

                        type="button"

                        data-bs-target="#carouselModal"

                        data-bs-slide="next">

                        <span
                            class="carousel-control-next-icon">

                        </span>

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const carouselElement =
            document.querySelector('#carouselProduto');

        const carousel =
            new bootstrap.Carousel(carouselElement);

        window.trocarSlide = function(index) {

            carousel.to(index);

        }

        const modalCarousel =
            new bootstrap.Carousel(
                document.querySelector('#carouselModal')
            );

        document
            .querySelectorAll('.imagem-produto')

            .forEach((imagem, index) => {

                imagem.addEventListener('click', function() {

                    modalCarousel.to(index);

                    let modal =
                        new bootstrap.Modal(
                            document.getElementById('imagemModal')
                        );

                    modal.show();

                });

            });

    });
</script>

<script>

function aumentarQuantidade(){

    let input =
    document.getElementById('quantidade');

    input.value =
    parseInt(input.value) + 1;

}

function diminuirQuantidade(){

    let input =
    document.getElementById('quantidade');

    if(parseInt(input.value) > 1){

        input.value =
        parseInt(input.value) - 1;

    }

}

</script>

<?php include 'includes/footer.php'; ?>