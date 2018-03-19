<?php

class Model {

    /** @var PDO PDO connection */
    static $db = null;
    public $errors = array();

    /**
     * Set a PDO connection to be reused
     */
    private static function setDataSourse() {
        try {
            $datasoursename = AppConfig::DB_TYPE . ':host=' . AppConfig::DB_HOST . ';dbname=' . AppConfig::DB_NAME;
            $options = array(
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            );

            self::$db = new PDO($datasoursename, AppConfig::USER, AppConfig::PASS, $options);
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * @return PDO PDO connection
     */
    public function db() {
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
    public function query($sql, $named_params = array()) {
        $query = $this->db()->prepare($sql);
        if (!$query) {
            $this->errors[] = $this->db()->errorInfo();
            return FALSE;
        }
        $success = $query->execute($named_params);
        if (!$success) {
            $this->errors[] = $query->errorInfo();
            return FALSE;
        }

        return $query->fetchAll();
    }

}
