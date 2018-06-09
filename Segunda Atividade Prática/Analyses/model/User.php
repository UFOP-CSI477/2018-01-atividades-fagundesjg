<?php

namespace model;

use model\Database;

class User
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $type;
    private $created_at;
    private $updated_at;
    protected $db = null;

    public function __construct()
    {
        $this->id = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->type = null;
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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
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
        $sql = "INSERT INTO users (name,email,password,type,created_at) VALUES (:user,:email,:pass,:type,NOW())";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':user',$this->name);
        $stmt->bindParam(':email',$this->email);
        $stmt->bindParam(':pass',$this->password);
        $stmt->bindParam(':type',$this->type);
        $result = $stmt->execute();

        if(!$result) return false;
        else return true;
    }

    public function update()
    {
        $sql = "UPDATE users SET name = :name,email = :email,password = :pass,type = :type,updated_at = NOW() WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name',$this->name);
        $stmt->bindParam(':email',$this->email);
        $stmt->bindParam(':pass',$this->password);
        $stmt->bindParam(':type',$this->type);

        $result = $stmt->execute();

        if(!$result) return false;
        else return true;
    }

    public function remove()
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $result = $stmt->execute();

        if($result) return true;
        else return false;
    }

    public function getAll()
    {
        $sql = "SELECT *FROM users";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();

        if($result) return $stmt->fetchAll();
        else return null;
    }

    public function setUser($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
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
                        $this->email = $row['email'];
                        $this->password = $row['password'];
                        $this->type = $row['type'];
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