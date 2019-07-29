<?php

namespace App\classes;

use PDO;

/**
 * Description of Database
 */
class Database
{
    /**
     * @var object
     */
    private static $instance = null;

    /**
     * @var object
     */
    public $pdo;
    

    /**
     * Construct
     */
    private function __construct()
    {
        $this->pdo = new PDO('mysql:dbhost=' . DB_HOST . '; dbname=' . DB . '; charset=utf8', DB_USER , DB_PASS);
    }

    /**
     * @return object
     */
    static function getInstance()
    {
        if(!self::$instance) {

            self::$instance = new Database;
        }

        return self::$instance;
    }
}