<?php

namespace model;

use model\Database;

class Procedure
{
    private $id;
    private $name;
    private $price;
    private $user_id;
    private $created_at;
    private $updated_at;
    protected $db = null;

    public function __construct()
    {
        $this->id = null;
        $this->name = null;
        $this->price = null;
        $this->user_id = null;
        $this->created_at = null;
        $this->updated_at = null;
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
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
        $sql = "INSERT INTO procedures (name,price,user_id,created_at) VALUES (:name,:price,:user_id,NOW())";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':name',$this->name);
        $stmt->bindParam(':price',$this->price);
        $stmt->bindParam(':user_id',$this->user_id);
        $result = $stmt->execute();

        if(!$result) return false;
        else return true;
    }

    public function update()
    {
        $sql = "UPDATE procedures SET name = :name,price = :price,user_id = :user_id,updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':name',$this->name);
        $stmt->bindParam(':price',$this->price);
        $stmt->bindParam(':user_id',$this->user_id);

        $result = $stmt->execute();

        if(!$result) return false;
        else return true;
    }

    public function remove()
    {
        $sql = "DELETE FROM procedures WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $result = $stmt->execute();

        if($result) return true;
        else return false;
    }

    public function getAll()
    {
        $sql = "SELECT *FROM procedures ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();

        if($result) return $stmt->fetchAll();
        else return null;
    }

    /*
     * Essa função é responsável por preencher os campos do procedimento
     */
    public function setProcedure($id)
    {
        $sql = "SELECT * FROM procedures WHERE id = :id";
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
                        $this->name = $row['name'];
                        $this->price = $row['price'];
                        $this->user_id = $row['user_id'];
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