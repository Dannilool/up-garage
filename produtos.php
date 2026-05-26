<?php

include 'conexao.php';

$pesquisa = "";
$categoriaAtual = "";

/* PESQUISA */

if(isset($_GET['pesquisa'])){

    $pesquisa =
    mysqli_real_escape_string(
        $conn,
        $_GET['pesquisa']
    );

    $sql = "

    SELECT * FROM produtos

    WHERE nome LIKE '%$pesquisa%'

    ORDER BY id DESC

    ";

}else{

    /* FILTRO POR CATEGORIA */

    if(isset($_GET['categoria'])){

        $categoriaAtual =
        (int) $_GET['categoria'];

        $sql = "

        SELECT * FROM produtos

        WHERE categoria_id = $categoriaAtual

        ORDER BY id DESC

        ";

    }else{

        /* TODOS PRODUTOS */

        $sql = "

        SELECT * FROM produtos

        ORDER BY id DESC

        ";

    }

}

$resultado =
mysqli_query($conn, $sql);

/* LISTAR CATEGORIAS */

$sqlCategorias = "

SELECT * FROM categorias

ORDER BY nome ASC

";

$resultadoCategorias =
mysqli_query($conn, $sqlCategorias);

?>

<?php include 'includes/header.php'; ?>

<div class="container mt-5 mb-5">

    <div class="d-flex
                justify-content-between
                align-items-center
                flex-wrap
                gap-3
                mb-4">

        <h1>

            Produtos

        </h1>

    </div>

    <!-- BUSCA -->

    <form method="GET"
          class="mb-5">

        <div class="row g-2">

            <div class="col-md-10">

                <input type="text"

                       name="pesquisa"

                       class="form-control"

                       placeholder="Pesquisar produto..."

                       value="<?php echo $pesquisa; ?>">

            </div>

            <div class="col-md-2">

                <button class="btn btn-dark w-100">

                    Buscar

                </button>

            </div>

        </div>

    </form>

    <!-- CATEGORIAS -->

    <div class="mb-5">

        <h4 class="mb-3">

            Categorias

        </h4>

        <div class="d-flex
                    gap-2
                    flex-wrap">

            <a

            href="produtos.php"

            class="btn btn-outline-dark">

                Todos

            </a>

            <?php

            while(
                $categoria =
                mysqli_fetch_assoc($resultadoCategorias)
            ){

            ?>

                <a

                href="produtos.php?categoria=<?php echo $categoria['id']; ?>"

                class="btn <?php

                if(
                    $categoriaAtual ==
                    $categoria['id']
                ){

                    echo 'btn-dark';

                }else{

                    echo 'btn-outline-dark';

                }

                ?>">

                    <?php echo $categoria['nome']; ?>

                </a>

            <?php } ?>

        </div>

    </div>

    <!-- PRODUTOS -->

    <div class="row">

        <?php

        if(mysqli_num_rows($resultado) > 0){

            while(
                $produto =
                mysqli_fetch_assoc($resultado)
            ){

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

            <div

                class="col-12 col-md-6 col-lg-4 mb-4 d-flex"

                data-aos="fade-up">

                <div class="card shadow border-0 w-100 h-100">

                    <?php if($imagem){ ?>

                        <img

                        src="img/<?php echo $imagem['imagem']; ?>"

                        class="card-img-top"

                        style="
                        height:250px;
                        object-fit:cover;
                        width:100%;
                        ">

                    <?php } ?>

                    <div class="card-body d-flex flex-column">

                        <h5 class="card-title">

                            <?php echo $produto['nome']; ?>

                        </h5>

                        <p class="card-text text-secondary">

                            <?php

                            echo substr(
                                $produto['descricao'],
                                0,
                                80
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

                            Ver detalhes

                        </a>

                    </div>

                </div>

            </div>

        <?php

            }

        }else{

        ?>

            <div class="col-12">

                <div class="alert alert-danger shadow-sm">

                    Nenhum produto encontrado.

                </div>

            </div>

        <?php } ?>

    </div>

</div>

<?php include 'includes/footer.php'; ?>