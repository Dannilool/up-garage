<?php

session_start();

include 'conexao.php';
include 'funcoes.php';

if (!isset($_SESSION['carrinho'])) {

    $_SESSION['carrinho'] = [];
}

/* ADICIONAR PRODUTO */

if (isset($_GET['add'])) {

    $id = (int) $_GET['add'];

    $quantidade = isset($_GET['quantidade'])
        ? (int) $_GET['quantidade']
        : 1;

    $quantidade =
        validarQuantidade($quantidade);

    if (isset($_SESSION['carrinho'][$id])) {

        $_SESSION['carrinho'][$id] += $quantidade;
    } else {

        $_SESSION['carrinho'][$id] = $quantidade;
    }
}

/* REMOVER PRODUTO */

if (isset($_GET['remove'])) {

    $id = (int) $_GET['remove'];

    unset($_SESSION['carrinho'][$id]);
}

/* ATUALIZAR QUANTIDADE */

if (isset($_POST['atualizar'])) {

    $id = (int) $_POST['id'];

    $quantidade = (int) $_POST['quantidade'];

    $quantidade =
        validarQuantidade($quantidade);

    $_SESSION['carrinho'][$id] =
        $quantidade;
}

?>

<?php include 'includes/header.php'; ?>

<div class="container mt-5 mb-5">

    <h1 class="mb-4">

        Carrinho

    </h1>

    <?php

    $total = 0;

    if (count($_SESSION['carrinho']) > 0) {

    ?>

        <div class="row">

            <?php

            foreach ($_SESSION['carrinho'] as $id => $quantidade) {

                $sql = "

                SELECT * FROM produtos

                WHERE id = $id

                ";

                $resultado =
                    mysqli_query($conn, $sql);

                $produto =
                    mysqli_fetch_assoc($resultado);

                if (!$produto) {

                    continue;
                }

                $sqlImagem = "

                SELECT * FROM imagens_produto

                WHERE produto_id = $id

                LIMIT 1

                ";

                $resultadoImagem =
                    mysqli_query($conn, $sqlImagem);

                $imagem =
                    mysqli_fetch_assoc($resultadoImagem);

                $subtotal =
                    calcularSubtotal(
                        $produto['preco'],
                        $quantidade
                    );

                $total =
                    calcularTotal(
                        $total,
                        $subtotal
                    );

            ?>

                <div class="col-12 mb-4">

                    <div class="card shadow border-0 rounded-4 overflow-hidden">

                        <div class="row g-0 align-items-center">

                            <!-- IMAGEM -->

                            <div class="col-md-3">

                                <?php if ($imagem) { ?>

                                    <img

                                        src="img/<?php echo $imagem['imagem']; ?>"

                                        class="img-fluid"

                                        style="
                                    height:220px;
                                    width:100%;
                                    object-fit:cover;
                                    ">

                                <?php } ?>

                            </div>

                            <!-- INFO -->

                            <div class="col-md-9">

                                <div class="card-body p-4">

                                    <h3 class="mb-3">

                                        <?php echo $produto['nome']; ?>

                                    </h3>

                                    <p class="text-secondary">

                                        <?php

                                        echo substr(
                                            $produto['descricao'],
                                            0,
                                            120
                                        );

                                        ?>...

                                    </p>

                                    <h4 class="text-success mb-4">

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

                                    <!-- QUANTIDADE -->

                                    <form

                                        method="POST"

                                        class="d-flex
align-items-center
gap-2
flex-wrap
mb-4">

                                        <input

                                            type="hidden"

                                            name="id"

                                            value="<?php echo $produto['id']; ?>">

                                        <label class="fw-bold">

                                            Quantidade:

                                        </label>

                                        <div class="d-flex align-items-center gap-2">

                                            <button

                                                type="button"

                                                class="btn btn-outline-dark"

                                                onclick="alterarQuantidade(
        <?php echo $produto['id']; ?>,
        -1
        )">

                                                -

                                            </button>

                                            <input

                                                type="number"

                                                name="quantidade"

                                                id="quantidade-<?php echo $produto['id']; ?>"

                                                value="<?php echo $quantidade; ?>"

                                                min="1"

                                                class="form-control text-center"

                                                style="
        width:80px;
        "

                                                onchange="this.form.submit()">

                                            <button

                                                type="button"

                                                class="btn btn-outline-dark"

                                                onclick="alterarQuantidade(
                                                <?php echo $produto['id']; ?>,
                                                1
                                                )">

                                                +

                                            </button>

                                        </div>

                                        <input

                                            type="hidden"

                                            name="atualizar"

                                            value="1">

                                    </form>

                                    <!-- SUBTOTAL -->

                                    <h5 class="mb-4">

                                        Subtotal:

                                        <span class="text-success">

                                            R$

                                            <?php

                                            echo number_format(
                                                $subtotal,
                                                2,
                                                ',',
                                                '.'
                                            );

                                            ?>

                                        </span>

                                    </h5>

                                    <!-- REMOVER -->

                                    <a

                                        href="carrinho.php?remove=<?php echo $produto['id']; ?>"

                                        class="btn btn-danger">

                                        Remover

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

        <!-- TOTAL -->

        <div class="card shadow border-0 rounded-4 p-4">

            <h2 class="mb-3">

                Total:

                <span class="text-success">

                    R$

                    <?php

                    echo number_format(
                        $total,
                        2,
                        ',',
                        '.'
                    );

                    ?>

                </span>

            </h2>

            <a

                href="finalizar.php"

                class="btn btn-success btn-lg">

                Finalizar Compra

            </a>

        </div>

    <?php } else { ?>

        <div class="alert alert-warning shadow-sm">

            Seu carrinho está vazio.

        </div>

    <?php } ?>

</div>

<script>

function alterarQuantidade(id, valor){

    let input =
    document.getElementById(
    'quantidade-' + id
    );

    let quantidade =
    parseInt(input.value);

    quantidade += valor;

    if(quantidade < 1){

        quantidade = 1;

    }

    input.value = quantidade;

    input.form.submit();

}

</script>

<?php include 'includes/footer.php'; ?>