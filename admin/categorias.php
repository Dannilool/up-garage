<?php

session_start();

include '../conexao.php';

$base = "../";

if (!isset($_SESSION['admin'])) {

    header("Location: login.php");
    exit;

}

/* CADASTRAR */

if (isset($_POST['adicionar'])) {

    $nome = mysqli_real_escape_string(
        $conn,
        $_POST['nome']
    );

    if (!empty($nome)) {

        mysqli_query(

            $conn,

            "INSERT INTO categorias(nome)
            VALUES('$nome')"

        );

    }

}

/* EDITAR */

if (isset($_POST['editar'])) {

    $id = (int) $_POST['id'];

    $nome = mysqli_real_escape_string(
        $conn,
        $_POST['nome']
    );

    mysqli_query(

        $conn,

        "UPDATE categorias
        SET nome = '$nome'
        WHERE id = $id"

    );

}

/* EXCLUIR */

if (isset($_GET['delete'])) {

    $id = (int) $_GET['delete'];

    mysqli_query(

        $conn,

        "DELETE FROM categorias
        WHERE id = $id"

    );

}

/* BUSCAR CATEGORIAS */

$sql = "

SELECT * FROM categorias

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

            Categorias

        </h1>

        <a
        href="painel.php"
        class="btn btn-dark">

            Painel

        </a>

    </div>

    <!-- CADASTRAR -->

    <div class="card shadow border-0 mb-4">

        <div class="card-body">

            <form method="POST">

                <div class="row g-3">

                    <div class="col-md-10">

                        <input

                        type="text"

                        name="nome"

                        class="form-control"

                        placeholder="Nome da categoria"

                        required>

                    </div>

                    <div class="col-md-2">

                        <button

                        type="submit"

                        name="adicionar"

                        class="btn btn-success w-100">

                            Adicionar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- LISTAGEM -->

    <div class="card shadow border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>ID</th>
                            <th>Categoria</th>
                            <th width="300">

                                Ações

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        while (
                            $categoria =
                            mysqli_fetch_assoc($resultado)
                        ) {

                        ?>

                            <tr>

                                <td>

                                    <?php echo $categoria['id']; ?>

                                </td>

                                <td>

                                    <form
                                    method="POST"
                                    class="d-flex gap-2">

                                        <input

                                        type="hidden"

                                        name="id"

                                        value="<?php echo $categoria['id']; ?>">

                                        <input

                                        type="text"

                                        name="nome"

                                        value="<?php echo $categoria['nome']; ?>"

                                        class="form-control">

                                </td>

                                <td>

                                        <div class="d-flex gap-2">

                                            <button

                                            type="submit"

                                            name="editar"

                                            class="btn btn-warning btn-sm">

                                                Editar

                                            </button>

                                            <a

                                            href="?delete=<?php echo $categoria['id']; ?>"

                                            class="btn btn-danger btn-sm"

                                            onclick="return confirm('Deseja excluir esta categoria?')">

                                                Excluir

                                            </a>

                                        </div>

                                    </form>

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