<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: login.php");
}

include '../conexao.php';

$id = $_GET['id'];

$sql = "SELECT * FROM produtos
        WHERE id = $id";

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

if ($_POST) {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    if (!empty($_FILES['imagens']['name'][0])) {

        foreach (

            $_FILES['imagens']['tmp_name']

            as $key => $tmp_name
        ) {

            $nomeImagem =

                $_FILES['imagens']['name'][$key];

            move_uploaded_file(

                $tmp_name,

                "../img/" . $nomeImagem

            );

            $sqlImagem = "

        INSERT INTO imagens_produto

        (produto_id, imagem)

        VALUES

        (
            '$id',
            '$nomeImagem'
        )

        ";

            mysqli_query($conn, $sqlImagem);
        }
    }


    $update = "UPDATE produtos SET

        nome = '$nome',
        descricao = '$descricao',
        preco = '$preco',
        imagem = '$imagem'

        WHERE id = $id";

    mysqli_query($conn, $update);

    header("Location: produtos.php");
}

$base = "../";

?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">

    <h1 class="mb-4">
        Editar Produto
    </h1>

    <div class="row mb-4">

        <?php

        while ($imagem =
            mysqli_fetch_assoc($resultadoImagens)
        ) {

        ?>

            <div class="col-md-3">

                <div class="card shadow">

                    <img

                        src="../img/<?php echo $imagem['imagem']; ?>"

                        class="card-img-top"

                        style="height:200px;
                   object-fit:cover;">

                    <div class="card-body">

                        <a

                            href="remover_imagem.php?id=<?php echo $imagem['id']; ?>&produto=<?php echo $id; ?>"

                            class="btn btn-danger w-100"

                            onclick="return confirm('Remover imagem?')">

                            Remover

                        </a>

                    </div>

                </div>

            </div>

        <?php } ?>

    </div>

    <form method="POST"
        enctype="multipart/form-data">

        <div class="mb-3">

            <label>
                Nome
            </label>

            <input type="text"

                name="nome"

                class="form-control"

                value="<?php echo $produto['nome']; ?>">

        </div>

        <div class="mb-3">

            <label>
                Descrição
            </label>

            <textarea name="descricao"

                class="form-control"><?php echo $produto['descricao']; ?></textarea>

        </div>

        <div class="mb-3">

            <label>
                Preço
            </label>

            <input type="number"

                step="0.01"

                name="preco"

                class="form-control"

                value="<?php echo $produto['preco']; ?>">

        </div>

        <div class="mb-3">

            <label>
                Nova Imagem
            </label>

            <input type="file"

                name="imagens[]"

                class="form-control"

                multiple>

        </div>

        <div class="form-check mb-4">

            <input type="checkbox"

                name="remover_imagem"

                class="form-check-input"

                id="remover">

            <label class="form-check-label"
                for="remover">

                Remover imagem atual

            </label>

        </div>

        <button class="btn btn-warning">

            Atualizar Produto

        </button>

        <a href="produtos.php"
            class="btn btn-secondary">

            Voltar

        </a>

    </form>

</div>

<?php include '../includes/footer.php'; ?>