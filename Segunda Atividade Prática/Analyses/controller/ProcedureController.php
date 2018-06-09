<?php

namespace controller;

include_once("model/Database.php");
include_once("model/Procedure.php");
include_once("utils/Functions.php");

use model\Database;
use model\User;
use model\Procedure;
use controller\UserController;
use utils\Functions;

class ProcedureController
{
    public function getByID($id)
    {
        $procedure = new Procedure();
        $rows = $procedure->getAll();

        foreach($rows as $row)
        {
            if($row['id'] == $id)
            {
                return $row;
            }
        }

        return null;
    }

    public function view_list()
    {
        $userController = new UserController();
        $procedure = new Procedure();
        $rows = $procedure->getAll();
        include("view/proceduresList.php");
    }

    public function view_register()
    {
        include("view/registerProcedure.php");
    }

    public function admin_view_list()
    {
        $userController = new UserController();
        $procedure = new Procedure();
        $rows = $procedure->getAll();
        include("view/procedureListAdmin.php");
    }

    public function view_update($procedure_id)
    {
        $procedure = new Procedure();
        $procedure->setProcedure($procedure_id);
        include ("view/updateProcedure.php");
    }

    public function update($procedure_id,$new_name,$new_price)
    {
        $procedure = new Procedure();
        $procedure->setProcedure($procedure_id);
        $procedure->setName($new_name);
        $procedure->setPrice($new_price);
        return ($procedure->update());
    }

    public function registerProcedure()
    {
        session_start();
        var_dump($_POST);
        $procedure = new Procedure();
        $procedure->setName($_POST['name']);
        $procedure->setPrice($_POST['price']);
        $procedure->setUserId($_POST['user_id']);
        return $procedure->save();
    }
}