<?php

class Crud
{

    private object $query;
    private string $sql;


    /**
     * @param $table_name
     * @param $conditions
     * @param array|null $values
     * @return array
     */
    public function create($table_name, $conditions, array $values): array
    {
        try {
            $this->sql  = "insert into {$table_name} set {$conditions} ";
            $this->query = Connection::getConnection()->prepare($this->sql);
            $this->query->execute($values);
            return [
                "status" => true,
                "lastId" => Connection::getConnection()->lastInsertId()
            ];
        }catch(PDOException $error){
            return  DatabaseException::dbException($error);
        }
    }

    /**
     * @param $table_name
     * @param $table_fields
     * @param null $conditions
     * @param array|null $values
     * @return array|false|PDOStatement|string|null
     */
    public function read($table_name, $table_fields,$conditions = null, array $values = null){
        try {
            $this->sql  = "select {$table_fields} from {$table_name}  {$conditions} ";
            $this->query = Connection::getConnection()->prepare($this->sql);
            $this->query->execute($values);
        }catch(PDOException $error){
            return  DatabaseException::dbException($error);
        }
        return $this->query;
    }

    /**
     * @param $table_name
     * @param $conditions
     * @param array|null $values
     * @return array|void
     */
    public function update($table_name, $conditions, array $values = null)
    {
        try {
            $this->sql  = "update {$table_name} set {$conditions} ";
            $this->query = Connection::getConnection()->prepare($this->sql);
            $this->query->execute($values);
            return true;
        }catch(PDOException $error){
            return  DatabaseException::dbException($error);
        }
    }

    /**
     * @param $table_name
     * @param $conditions
     * @param array|null $values
     * @return array|void
     */
    public function delete($table_name, $conditions, array $values = null)
    {
        try {
            $this->sql  = "delete from {$table_name} {$conditions} ";
            $this->query = Connection::getConnection()->prepare($this->sql);
            $this->query->execute($values);
            return true;
        }catch(PDOException $error){
            return  DatabaseException::dbException($error);
        }
    }
}