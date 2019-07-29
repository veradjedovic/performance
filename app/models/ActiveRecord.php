<?php

namespace App\models;

use App\classes\Database;
use PDO;

/**
 * Description of ActiveRecord
 */
abstract class ActiveRecord
{
    /**
     * @var string
     */
    public static $table = '';

    /**
     * @var string
     */
    public static $id_column = '';


    /**
     * Get all records
     *
     * @param string $fields
     * @param string $filter
     * @return array
     */
    public function getAll($fields = "*", $filter = "")
    {
        $db = Database::getInstance();
        $pdo = $db->pdo;

        $r = $pdo->prepare("SELECT " . $fields . " FROM " . static::$table . " " . $filter);
        $r->execute();
        $r = $r->fetchAll(PDO::FETCH_CLASS, get_called_class());

        if (count($r) > 0) {

            return $r;

        } else {

            return false;
        }
    }

    /**
     * Get by id
     *
     * @param int $id
     * @param string $filter
     * @return object
     */
    public function get($id, $filter = "")
    {
        $db = Database::getInstance();
        $pdo = $db->pdo;

        $r = $pdo->prepare("SELECT * FROM " . static::$table . " WHERE " . static::$id_column . "=:p1 " . $filter);
        $r->bindParam(":p1", $id);
        $r->execute();
        $r = $r->fetchAll(PDO::FETCH_CLASS, get_called_class());

        if (count($r) > 0) {

            return $r[0];

        } else {
            
            return false;
        }
    }

    /**
     * Insert method
     *
     * @return mixed
     */
    public function insert()
    {
        $db = Database:: getInstance();
        $obj = get_object_vars($this);
        $q = "INSERT INTO " . static::$table . " (";

        foreach ($obj as $k => $v) {
            if($k == static::$id_column) continue;
            $q .= $k . ", ";
        }

        $q = rtrim($q, ", ");
        $q .= ")values(";

        foreach ($obj as $k => $v) {
            if($k==static::$id_column) continue;
            $q .= ":" . $k . ", ";
        }

        $q = rtrim($q, ", ");
        $q .= ")";
        $r = $db->pdo->prepare($q);

        foreach ($obj as $k => &$v) {
            if($k==static::$id_column) continue;
            $r->bindParam(":" . $k, $v);
        }

        $r->execute();

        if ($r->rowCount() == 1) {

            return $db->pdo->lastInsertId();

        } else {

            return false;
        }
    }

    /**
     * Update method
     *
     * @return boolean
     */
    public function save()
    {
        $db = Database::getInstance();
        $q = "UPDATE " . static::$table . " SET ";
        $obj = get_object_vars($this);

        foreach ($obj as $k => $v) {
            if ($k == static::$id_column)
                continue;
            $q .= $k . " = :" . $k . ", ";
        }

        $q = rtrim($q, ", ");
        $q .= " WHERE " . static::$id_column . " = :id";
        $r = $db->pdo->prepare($q);

        foreach ($obj as $k => &$v) {
            if ($k == static::$id_column)
                continue;
            $r->bindParam(":" . $k, $v);
        }

        $keyField = static::$id_column;
        $r->bindParam(":id", $this->$keyField);

        if ($r->execute() == 1) {

            return true;

        } else {
            
            return false;
        }
    }

    /**
     * Delete method
     *
     * @param int $id
     * @param string $filter
     * @return boolean
     */
    public function delete($id, $filter = "")
    {
        $db = Database::getInstance();
        $pdo = $db->pdo;

        $r = $pdo->prepare("DELETE FROM " . static::$table . " WHERE " . static::$id_column . "=:p1 " . $filter);
        $r->bindParam(":p1", $id);
        $r->execute();
        $r = $r->fetchAll(PDO::FETCH_CLASS, get_called_class());

        if (count($r) > 0) {

            return $r[0];

        } else {

            return false;
        }
    }
}