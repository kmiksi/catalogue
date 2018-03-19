<div class="container">
    <h1>Cadastro de cliente:</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
        </div>
        <div class="form-group">
            <label for="fone">Telefone</label>
            <input type="text" class="form-control" id="fone" name="telefone" placeholder="Telefone" required>
        </div>
        <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
