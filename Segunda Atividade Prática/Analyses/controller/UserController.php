<?php

namespace controller;

include_once ("model/User.php");
include_once ("utils/Functions.php");

use model\User;
use utils\Functions;

class UserController
{
    public function getByID($id)
    {
        $user = new User();
        $rows = $user->getAll();

        foreach($rows as $row)
        {
            if($row['id'] == $id)
            {
                return $row;
            }
        }

        return null;
    }

    public function view_login()
    {
        include ("view/login.php");
    }

    public function view_register()
    {
        include ("view/registerPaciente.php");
    }

    public function view_pacienteArea()
    {
        include ("view/pacienteArea.php");
    }

    public function view_adminArea()
    {
        include ("view/adminArea.php");
    }

    public function view_accessDenied()
    {
        include ("view/accessDenied.php");
    }

    public function registerPaciente()
    {
        if(isset($_POST))
        {
            if(!Functions::user_exist_byEmail($_POST['email']))
            {
                $user = new User();
                $user->setName($_POST['name']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['pass1']);
                $user->setType(3);
                return $user->save();
            }
        }

        return false;
    }

    public function registerOperador()
    {
        if(isset($_POST))
        {
            if(!Functions::user_exist_byEmail($_POST['email']))
            {
                $user = new User();
                $user->setName($_POST['name']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['pass1']);
                $user->setType(2);
                return $user->save();
            }
        }

        return false;
    }

    public function registerAdmin()
    {
        if(isset($_POST))
        {
            if(!Functions::user_exist_byEmail($_POST['email']))
            {
                $user = new User();
                $user->setName($_POST['name']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['pass1']);
                $user->setType(1);
                return $user->save();
            }
        }

        return false;
    }

    public function validarLogin()
    {
        session_start();

        if(!isset($_SESSION['login']))
        {
            $user = Functions::user_getByEmail($_POST['login']);

            $login = $_POST['login'];
            $pass = $_POST['pass'];
            if($user['email'] == $login && $pass == $user['password'])
            {
                $_SESSION['login'] = $login;
                $_SESSION['type'] = $user['type'];
                return true;
            }
        }

        return false;
    }

}