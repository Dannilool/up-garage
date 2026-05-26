<?php

include 'conexao.php';

$sql = "SELECT * FROM categorias";

$resultado = mysqli_query($conn, $sql);

$categorias = [];

while ($categoria = mysqli_fetch_assoc($resultado)) {

    $categorias[] = $categoria;

}

function totalCategorias($array)
{

    return count($array);

}

?>

<?php include 'includes/header.php'; ?>

<div class="container mt-5 mb-5">

    <h1 class="mb-4">

        Categorias

    </h1>

    <div class="alert alert-dark">

        Total de categorias:
        <?php echo totalCategorias($categorias); ?>

    </div>

    <div class="row">

        <?php

        if (count($categorias) > 0) {

            foreach ($categorias as $categoria) {

        ?>

                <div

                    class="col-md-3"

                    data-aos="zoom-in">

                    <a

                        href="produtos.php?categoria=<?php echo $categoria['id']; ?>"

                        class="text-decoration-none text-dark">

                        <div class="card shadow mb-4 h-100 categoria-card">

                            <div class="card-body text-center d-flex align-items-center justify-content-center">

                                <h4 class="mb-0">

                                    <?php echo $categoria['nome']; ?>

                                </h4>

                            </div>

                        </div>

                    </a>

                </div>

            <?php

            }

        } else {

            ?>

            <div class="col-12">

                <div class="alert alert-warning">

                    Nenhuma categoria encontrada.

                </div>

            </div>

        <?php } ?>

    </div>

</div>

<style>

.categoria-card{

    transition: 0.3s ease;

    cursor:pointer;

}

.categoria-card:hover{

    transform: translateY(-5px);

}

</style>

<?php include 'includes/footer.php'; ?>