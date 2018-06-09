<?php

namespace controller;

include_once ("model/User.php");
include_once ("model/Procedure.php");
include_once ("model/Test.php");
include_once ("utils/Functions.php");

use model\Database;
use model\User;
use model\Procedure;
use model\Test;
use utils\Functions;

class TestController
{
    public function view_list($id)
    {
        $sql = "SELECT *FROM tests";
        $stmt = Database::getInstance()->getDB()->prepare($sql);
        $stmt->bindParam(':id',$id);
        $result = $stmt->execute();
        if($result)
        {
            $rows = $stmt->fetchAll();
            include("view/testsList.php");
        }else Functions::redir('index.php');
    }

    public function view_register()
    {
        include ("view/registerTest.php");
    }

    public function registerTest()
    {
        session_start();
        $test = new Test();
        $test->setUserId(Functions::user_getID($_SESSION['login']));
        $test->setProcedureId($_POST['procedure_id']);
        $test->setDate($_POST['date']);
        return $test->save();
    }
}

?>