<?php require_once(__DIR__ . "/../partials/header.php"); ?>





<div class="table-data">
    <div class="order">
        <form method="POST" action="/register">
            <fieldset>
                <legend>Cadastro de usuários</legend>
                <div class="mb-3">
                    <label for="name" class="form-label">Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Digite o nome.">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" name="email" class="form-control" placeholder="Digite o e-mail.">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Senha:</label>
                    <input type="password" name="password" class="form-control" placeholder="Digite a senha.">
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </fieldset>
        </form>

    </div>
</div>

<?php require_once(__DIR__ . "/../partials/footer.php"); ?>