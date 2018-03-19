<?php
/**
 * @var object $cliente {id,name,email,telefone}
 */
?>
<div class="container">
    <h1>Cadastro de cliente:</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= $cliente->nome ?>"
                   placeholder="Nome" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $cliente->email ?>"
                   placeholder="E-mail" required>
        </div>
        <div class="form-group">
            <label for="fone">Telefone</label>
            <input type="text" class="form-control" id="fone" name="telefone" value="<?= $cliente->telefone ?>"
                   placeholder="Telefone" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
