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
            WHERE Pessoa.deleted IS NULL
            ORDER BY Pessoa.created DESC");
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
            WHERE Pessoa.deleted IS NULL
            ORDER BY Pessoa.created DESC
            LIMIT $limit OFFSET $offset";
        $rows = $this->query($sql);

        return $rows;
    }

    public function find($id)
    {
        $sql = "
            SELECT
              Pessoa.id,
              Pessoa.nome,
              Pessoa.email,
              Pessoa.telefone
            FROM pessoas AS Pessoa
            WHERE Pessoa.deleted IS NULL
              AND Pessoa.id = :id";
        $return = $this->query($sql, compact('id'));
        return $return[0];
    }

    public function delete($id)
    {
        $sql = "
            UPDATE pessoas
            SET deleted = NOW()
            WHERE id = :id";
        return $this->query($sql, compact('id'));
    }

    public function add(array $data)
    {
        $sql = "
            INSERT INTO pessoas (nome, email, telefone, foto, created)
            VALUES (:nome, :email, :telefone, :foto, NOW());";
        return $this->query($sql, $data);
    }

    public function edit($id, array $data)
    {
        $data[':id'] = $id;
        $sql = "
            UPDATE pessoas
            SET nome = :nome, email = :email, telefone = :telefone, updated = NOW()
            WHERE id = :id";
        return $this->query($sql, $data);
    }

}
