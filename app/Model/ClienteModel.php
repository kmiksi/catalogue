<?php

class ClienteModel extends Model
{
    public $pagination = array(
        'total' => 0,
        'page' => 0,
        'pages' => 0,
        'limit' => 0,
    );

    /**
     * @param int $page
     * @param int $limit
     * @return array Resultset
     */
    public function paginate($page = 1, $limit = 10)
    {
        $limit = intval($limit);
        $offset = ($page > 1 ? $page - 1 : 0) * $limit;

        $total = $this->query("
            SELECT COUNT(*) AS total
            FROM pessoas AS Pessoa
              INNER JOIN clientes AS Cliente
                ON Pessoa.id = Cliente.pessoa_id
            WHERE Cliente.deleted IS NULL
            ORDER BY Cliente.created DESC");
        $total = $total[0]->total;
        $pages = ceil($total[0]->total / $limit);
        $this->pagination = compact('total', 'page', 'pages', 'limit');

        $sql = "
            SELECT
              Pessoa.id,
              Pessoa.nome,
              Pessoa.email,
              Pessoa.telefone,
              Pessoa.foto,
              Pessoa.created
            FROM pessoas AS Pessoa
              INNER JOIN clientes AS Cliente
                ON Pessoa.id = Cliente.pessoa_id
            WHERE Cliente.deleted IS NULL
            ORDER BY Cliente.created DESC
            LIMIT $limit OFFSET $offset";
        $rows = $this->query($sql);

        return $rows;
    }

}
