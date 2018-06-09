<?php

namespace utils;

include_once ("model/Database.php");
use model\Database;

class Functions
{
    public static function user_exist_byID($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = Database::getInstance()->getDB()->prepare($sql);
        $stmt->bindParam(':id',$id);
        $result = $stmt->execute();

        if($result && count($stmt->fetchAll()) > 0)
            return true;

        return false;
    }

    public static function user_exist_byEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = Database::getInstance()->getDB()->prepare($sql);
        $stmt->bindParam(':email',$email);
        $result = $stmt->execute();

        if($result && count($stmt->fetchAll()) > 0)
            return true;

        return false;
    }

    public static function user_getByEmail($email)
    {
        $sql = "SELECT *FROM users WHERE email = :email";
        $stmt = Database::getInstance()->getDB()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $result = $stmt->execute();
        $rows = $stmt->fetchAll();

        foreach($rows as $row)
        {
            if($row['email'] == $email)
                return $row;
        }

        return null;
    }

    public static function user_getID($email)
    {
        $sql = "SELECT *FROM users WHERE email = :email";
        $stmt = Database::getInstance()->getDB()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $result = $stmt->execute();
        $rows = $stmt->fetchAll();

        foreach($rows as $row)
        {
            if($row['email'] == $email)
                return $row['id'];
        }

        return null;
    }

    public static function getUser($id)
    {
        $sql = "SELECT *FROM users WHERE id = :id";
        $stmt = Database::getInstance()->getDB()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        $rows = $stmt->fetchAll();

        foreach($rows as $row)
        {
            if($row['id'] == $id)
                return $row;
        }

        return null;
    }

    public static function getProcedure($id)
    {
        $sql = "SELECT *FROM procedures WHERE id = :id";
        $stmt = Database::getInstance()->getDB()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        $rows = $stmt->fetchAll();

        foreach($rows as $row)
        {
            if($row['id'] == $id)
                return $row;
        }

        return null;
    }

    public static function redir($location)
    {
        echo "<script>location.href='".$location."';</script>";
    }

    public static function isLogged()
    {
        session_start();
        return isset($_SESSION['login']);
    }
}



?>