<?php include 'includes/header.php'; ?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h1 class="mb-4">

                       Entre em contato

                    </h1>

                    <form>

                        <div class="mb-3">

                            <label>
                                Seu nome:
                            </label>

                            <input type="text"
                                   class="form-control"
                                   placeholder="Ex: João">

                        </div>

                        <div class="mb-3">

                            <label>
                                Seu e-mail:
                            </label>

                            <input type="email"
                                   class="form-control"
                                   placeholder="seu@email.com">

                        </div>
                        <div class="mb-3">

                            <label>
                                Seu telefone:
                            </label>

                            <input type="text"
                                   class="form-control"
                                   placeholder="(00) 0 0000-0000">

                        </div>

                        <div class="mb-3">

                            <label>
                                Mensagem
                            </label>

                            <textarea
                            class="form-control"
                            placeholder="Deixe a sua mensagem aqui =)"
                            rows="5"></textarea>

                        </div>

                        <button class="btn btn-dark">

                            Enviar

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>