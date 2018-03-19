<?php
/**
 * @var array $clientes {id,name,email,telefone,foto}
 * @var array $pagination {total,page,pages,limit}
 */
?>
<div class="container">
    <h1>Lista de clientes:</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" title="Foto"></th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Fone</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($clientes as $cliente) { ?>
            <tr>
                <th scope="row"><?= $cliente->id ?></th>
                <td></td>
                <td><?= $cliente->name ?></td>
                <td><?= $cliente->email ?></td>
                <td><?= $cliente->telefone ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <nav aria-label="navigation">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>