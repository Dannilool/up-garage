<?php

$base = "../";

include '../conexao.php';

if ($_POST) {

    $nome = mysqli_real_escape_string(
        $conn,
        $_POST['nome']
    );

    $descricao = mysqli_real_escape_string(
        $conn,
        $_POST['descricao']
    );

    $preco = mysqli_real_escape_string(
        $conn,
        $_POST['preco']
    );

    $categoria_id = (int) $_POST['categoria_id'];

    if (
        empty($nome) ||
        empty($descricao) ||
        empty($preco) ||
        empty($categoria_id)
    ) {

        $erro = "Preencha todos os campos.";

    } else {

        $sql = "

        INSERT INTO produtos

        (
            nome,
            descricao,
            preco,
            categoria_id
        )

        VALUES

        (
            '$nome',
            '$descricao',
            '$preco',
            '$categoria_id'
        )

        ";

        $resultado = mysqli_query($conn, $sql);

        if (!$resultado) {

            die(mysqli_error($conn));

        }

        $produto_id = mysqli_insert_id($conn);

        /* UPLOAD IMAGENS */

        if (!empty($_FILES['imagens']['name'][0])) {

            foreach (
                $_FILES['imagens']['tmp_name']
                as $key => $tmp_name
            ) {

                $nomeImagem =
                    $_FILES['imagens']['name'][$key];

                $nomeImagem = time() . "_" . $nomeImagem;

                move_uploaded_file(

                    $tmp_name,

                    "../img/" . $nomeImagem

                );

                $sqlImagem = "

                INSERT INTO imagens_produto

                (
                    produto_id,
                    imagem
                )

                VALUES

                (
                    '$produto_id',
                    '$nomeImagem'
                )

                ";

                mysqli_query($conn, $sqlImagem);

            }

        }

        $sucesso = "Produto cadastrado com sucesso!";

    }

}

?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5 mb-5">

    <h1 class="mb-4">

        Cadastrar Produto

    </h1>

    <?php if (isset($erro)) { ?>

        <div class="alert alert-danger">

            <?php echo $erro; ?>

        </div>

    <?php } ?>

    <?php if (isset($sucesso)) { ?>

        <div class="alert alert-success">

            <?php echo $sucesso; ?>

        </div>

    <?php } ?>

    <form
    method="POST"
    enctype="multipart/form-data">

        <div class="mb-3">

            <label class="form-label">

                Nome do Produto

            </label>

            <input
            type="text"
            name="nome"
            class="form-control"
            required>

        </div>

        <div class="mb-3">

            <label class="form-label">

                Descrição

            </label>

            <textarea
            name="descricao"
            class="form-control"
            rows="5"
            required></textarea>

        </div>

        <div class="mb-3">

            <label class="form-label">

                Preço

            </label>

            <input
            type="number"
            step="0.01"
            name="preco"
            class="form-control"
            required>

        </div>

        <div class="mb-3">

            <label class="form-label">

                Categoria

            </label>

            <select
            name="categoria_id"
            class="form-select"
            required>

                <option value="">

                    Selecione uma categoria

                </option>

                <?php

                $sqlCategorias = "

                SELECT * FROM categorias

                ORDER BY nome ASC

                ";

                $resultadoCategorias =
                    mysqli_query($conn, $sqlCategorias);

                while (
                    $categoria =
                    mysqli_fetch_assoc($resultadoCategorias)
                ) {

                ?>

                    <option
                    value="<?php echo $categoria['id']; ?>">

                        <?php echo $categoria['nome']; ?>

                    </option>

                <?php } ?>

            </select>

        </div>

        <div class="mb-4">

            <label class="form-label">

                Imagens do Produto

            </label>

            <input
            type="file"
            name="imagens[]"
            class="form-control"
            multiple>

        </div>

        <div class="d-flex gap-2 flex-wrap">

            <button class="btn btn-dark">

                Cadastrar

            </button>

            <a
            href="painel.php"
            class="btn btn-primary">

                Painel

            </a>

            <a
            href="logout.php"
            class="btn btn-danger">

                Sair

            </a>

        </div>

    </form>

</div>

<?php include '../includes/footer.php'; ?>