<?php
namespace App\Models;

use PDO;
use PDOException;

class BaseModel {
    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host=localhost; dbname=assignment_php; charset=utf8', 'root', '');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw $e;
        }
    }
    
    public static function getOrder(){
        $model = new static;
        $sql = "SELECT DISTINCT user_email, user_name , status FROM receipts";
        $statement = $model->conn->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public static function all(){
        $model = new static;
        $sql = "select * from " . $model->tableName . " where status = 0 order by id desc";
        $statement = $model->conn->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public static function getOne($row,$id){
        $model = new static;
        $sql = "select * from " . $model->tableName . " where " . $row . " = "  . $id;
        $statement = $model->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_CLASS);
        return $result[0] ?? $result;
    }

    public function add($arrs){
        $this->sql = 'insert into ' . $this->tableName;
        $cols = '(';
        $params = '(';
        foreach($arrs as $key=>$value){
            $cols .= "$key, ";
            $params .= ":$key, ";
        }
        $cols = rtrim($cols, ", ") . ")";
        $params = rtrim($params, ", ") . ")";
        $this->sql .= $cols . " values " . $params;
        $statement = $this->conn->prepare($this->sql);
        $statement->execute($arrs);
    }

    public function update($arrs){
        $this->sql = 'update  ' . $this->tableName . " set ";
        foreach($arrs as $key=>$value){
            $this->sql .= "$key = :$key, ";
        }
        $this->sql = rtrim($this->sql, ", ");
        $this->sql .= " where id = :id";
        $statement = $this->conn->prepare($this->sql);
        $statement->execute($arrs);
    }

    public static function delete($id){
        $model = new static;
        $sql = "delete from " . $model->tableName . " where id = " .  $id;
        $statement = $model->conn->prepare($sql);
        $statement->execute();
    }

    public static function deleteByForeign($where){
        $model = new static;
        $sql = "delete from " . $model->tableName . $where;
        $statement = $model->conn->prepare($sql);
        $statement->execute();
    }

    public static function where($column, $operator, $value){
        $model = new static;
        $model->sql = "select * from " . $model->tableName . " where $column $operator $value";
        return $model;
    }
    
    public function andWhere($column, $operator, $value) {
        $this->sql .= " and $column $operator $value";
        return $this;
    }

    public function orWhere($column, $operator, $value) {
        $this->sql .= " or $column $operator $value";
        return $this;
    }

    public function get() {
        $statement = $this->conn->prepare($this->sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, get_class($this));
    }
}

?>