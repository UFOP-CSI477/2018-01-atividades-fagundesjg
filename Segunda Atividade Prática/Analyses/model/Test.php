<?php

namespace model;

use model\Database;

class Test
{
    private $id;
    private $user_id;
    private $procedure_id;
    private $date;
    private $created_at;
    private $updated_at;
    protected $db = null;

    public function __construct()
    {
        $this->db = Database::getInstance()->getDB();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getProcedureId()
    {
        return $this->procedure_id;
    }

    public function setProcedureId($procedure_id)
    {
        $this->procedure_id = $procedure_id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function save()
    {
        $sql = "INSERT INTO tests (user_id,procedure_id,date,created_at) VALUES (:user_id,:procedure_id,:date,NOW())";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':user_id',$this->user_id);
        $stmt->bindParam(':procedure_id',$this->procedure_id);
        $stmt->bindParam(':date',$this->date);
        $result = $stmt->execute();

        if(!$result) return false;
        else return true;
    }

    public function update()
    {
        $sql = "UPDATE tests SET user_id = :user_id,procedure_id = :procedure_id,date = :date,updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id',$this->user_id);
        $stmt->bindParam(':procedure_id',$this->procedure_id);
        $stmt->bindParam(':date',$this->date);
        $stmt->bindParam(':id',$this->id);

        $result = $stmt->execute();

        if(!$result) return false;
        else return true;
    }

    public function remove()
    {
        $sql = "DELETE FROM tests WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $result = $stmt->execute();

        if($result) return true;
        else return false;
    }

    public function getAll()
    {
        $sql = "SELECT *FROM tests";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();

        if($result) return $stmt->fetchAll();
        else return null;
    }

    public function setTest($id)
    {
        $sql = "SELECT * FROM tests WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id',$id);
        $result = $stmt->execute();

        if($result)
        {
            $rows = $stmt->fetchAll();
            if(count($rows) > 0)
            {
                foreach($rows as $row)
                {
                    if($row['id'] == $id)
                    {
                        $this->id = $row['id'];
                        $this->user_id = $row['user_id'];
                        $this->procedure_id = $row['procedure_id'];
                        $this->date = $row['date'];
                        $this->created_at = $row['created_at'];
                        $this->updated_at = $row['updated_at'];
                        return true;
                    }
                }
            }
        }

        return false;
    }

}

?>