<?php

class Model
{

    /** @var PDO PDO connection */
    static $db = null;
    public $errors = array();

    /**
     * Set a PDO connection to be reused
     */
    private static function setDataSourse()
    {
        try {
            $datasoursename = AppConfig::DB_TYPE . ':host=' . AppConfig::DB_HOST . ';dbname=' . AppConfig::DB_NAME;
            $options = array(
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            );

            self::$db = new PDO($datasoursename, AppConfig::DB_USER, AppConfig::DB_PASS, $options);
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * @return PDO PDO connection
     */
    public function db()
    {
        if (empty(self::$db)) {
            self::setDataSourse();
        }
        return self::$db;
    }

    /**
     * @param string $sql
     * @param array $named_params
     * @return Model Object representation of query
     */
    public function query($sql, $named_params = array())
    {
        $query = $this->db()->prepare($sql);
        if (!$query) {
            $this->errors[] = $this->db()->errorInfo();
            return FALSE;
        }
        // se faz bind de parâmetros
        if (!empty($named_params)) {
            $key = key($named_params);
            // se o primeiro índice não é inteiro nem começa com ":"
            if (!is_int($key) && $key[0] !== ':') {
                $params = array();
                // a gente adiciona :)
                foreach ($named_params as $name => $value) {
                    $params[":$name"] = $value;
                }
                $named_params = $params;
            }
        }
        $success = $query->execute($named_params);
        if (!$success) {
            $this->errors[] = $query->errorInfo();
            return FALSE;
        }

        return $query->fetchAll();
    }

}
