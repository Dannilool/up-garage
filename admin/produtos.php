<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: login.php");
    exit;
}

include '../conexao.php';

$base = "../";

/* EXCLUIR PRODUTO */

if (isset($_GET['delete'])) {

    $id = (int) $_GET['delete'];

    /* BUSCAR IMAGENS */

    $sqlImagens = "

    SELECT * FROM imagens_produto

    WHERE produto_id = $id

    ";

    $resultadoImagens =
        mysqli_query($conn, $sqlImagens);

    while ($imagem =
        mysqli_fetch_assoc($resultadoImagens)
    ) {

        $caminho =
            "../img/" . $imagem['imagem'];
        if (

            !empty($imagem['imagem']) &&

            file_exists($caminho) &&

            !is_dir($caminho)

        ) {

            unlink($caminho);
        }
    }

    /* APAGAR RELAÇÕES */

    mysqli_query(

        $conn,

        "DELETE FROM imagens_produto
        WHERE produto_id = $id"

    );

    mysqli_query(

        $conn,

        "DELETE FROM produtos_marcas
        WHERE produto_id = $id"

    );

    mysqli_query(

        $conn,

        "DELETE FROM pedido_produtos
        WHERE produto_id = $id"

    );

    /* APAGAR PRODUTO */

    mysqli_query(

        $conn,

        "DELETE FROM produtos
        WHERE id = $id"

    );
}

/* LISTAR PRODUTOS */

$sql = "

SELECT * FROM produtos

ORDER BY id DESC

";

$resultado =
    mysqli_query($conn, $sql);

?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5 mb-5">

    <div class="d-flex
                justify-content-between
                align-items-center
                flex-wrap
                gap-3
                mb-4">

        <h1 class="m-0">

            Produtos

        </h1>

        <div class="d-flex gap-2 flex-wrap">

            <a
                href="categorias.php"
                class="btn btn-primary">

                Categorias

            </a>

            <a
                href="cadastrar_produto.php"
                class="btn btn-dark">

                Novo Produto

            </a>

        </div>

    </div>

    <div class="card shadow border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>ID</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Ações</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        if (mysqli_num_rows($resultado) > 0) {

                            while (
                                $produto =
                                mysqli_fetch_assoc($resultado)
                            ) {

                        ?>

                                <tr>

                                    <td>

                                        <?php echo $produto['id']; ?>

                                    </td>

                                    <td>

                                        <?php echo $produto['nome']; ?>

                                    </td>

                                    <td class="text-success fw-bold">

                                        R$

                                        <?php

                                        echo number_format(
                                            $produto['preco'],
                                            2,
                                            ',',
                                            '.'
                                        );

                                        ?>

                                    </td>

                                    <td>

                                        <div class="d-flex gap-2 flex-wrap">

                                            <a

                                                href="editar_produto.php?id=<?php echo $produto['id']; ?>"

                                                class="btn btn-warning btn-sm">

                                                Editar

                                            </a>

                                            <a

                                                href="?delete=<?php echo $produto['id']; ?>"

                                                class="btn btn-danger btn-sm"

                                                onclick="return confirm('Deseja realmente excluir este produto?')">

                                                Excluir

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            <?php

                            }
                        } else {

                            ?>

                            <tr>

                                <td
                                    colspan="4"
                                    class="text-center py-4">

                                    Nenhum produto cadastrado.

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>