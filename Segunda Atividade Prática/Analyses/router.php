<?php

session_start();

//includes - Framework
include_once 'model/Database.php';
include_once 'model/Procedure.php';
include_once 'model/Test.php';
include_once 'model/User.php';
include_once 'controller/ProcedureController.php';
include_once 'controller/TestController.php';
include_once 'controller/UserController.php';
include_once 'utils/Functions.php';

//tratamento das rotas
use controller\ProcedureController;
use controller\TestController;
use controller\UserController;
use model\Database;
use model\User;
use model\Test;
use model\Procedure;
use utils\Functions;


    $op = $_GET['op'];

    //definição das rotas
    switch($op)
    {
        case 1: $procedureController = new ProcedureController(); //lista exibida na index
                $procedureController->view_list();
                break;

        case 2: $userController = new UserController(); //view login
                if(Functions::isLogged() && $_SESSION['type'] == 3)
                    Functions::redir('router.php?op=7'); //view paciente area
                else if(!Functions::isLogged())
                {
                    $userController->view_login();
                }else
                {
                    $userController->view_accessDenied();
                }
                break;

        case 3: $userController = new UserController(); //view cadastro
                $userController->view_register();
                break;

        case 4: $userController = new UserController(); // efetivar o cadastro do paciente
                if($userController->registerPaciente())
                {
                    echo "<script> alert('Paciente cadastrado com sucesso!'); </script>";
                    Functions::redir('router.php?op=2');
                }
                else
                {
                    echo "<script> alert('Erro ao cadastrar paciente!'); </script>";
                    Functions::redir('router.php?op=3');
                }
                break;

        case 5: $userController = new UserController(); //VALIDAR LOGIN
                if($userController->validarLogin())
                {
                    echo "<script> alert('Logado com sucesso!'); </script>";
                    if($_SESSION['type'] == 3)
                        Functions::redir('router.php?op=7'); //AREA DO PACIENTE!
                    else Functions::redir('router.php?op=11');
                }else
                {
                    echo "<script> alert('Falha ao logar'); </script>";
                    Functions::redir('router.php?op=2');
                }
                break;

        case 6: if(Functions::isLogged()) // LOGOUT
                {
                    session_start();
                    session_unset();
                    session_destroy();
                    echo "<script>alert('Deslogado com sucesso!')</script>";
                    Functions::redir('index.php');
                }
                break;

        case 7: session_start(); // EXIBE AREA DO PACIENTE
                if(Functions::isLogged())
                {
                    if($_SESSION['type'] == 3)
                    {
                        $userController = new UserController();
                        $userController->view_pacienteArea();
                    }else
                    {
                        $userController->view_accessDenied();
                    }
                }else Functions::redir('router.php?op=2');
                break;

        case 8: if(Functions::isLogged() && $_SESSION['type'] == 3) //EXIBE AREA DE CADASTRO DE TESTE
                {
                    $testController = new TestController();
                    $testController->view_register();
                }else Functions::redir('index.php');
                break;

        case 9: session_start(); //EFETIVA O CADASTRO DO TESTE
                if(Functions::isLogged() && $_SESSION['type'] == 3)
                {
                    $testController = new TestController();
                    if($testController->registerTest()) {
                        echo "<script> alert('Teste cadastrado com sucesso!'); </script>";
                        Functions::redir('router.php?op=2');
                    } else {
                        echo "<script> alert('Erro ao cadastrar teste!'); </script>";
                        Functions::redir('router.php?op=8');
                    }
                }else Functions::redir('index.php');
                break;

        case 10: session_start(); //EFEITVA A REMOÇÃO DO TESTE
                 if(Functions::isLogged() && $_SESSION['type'] == 3)
                 {
                    $id = $_GET['id'];
                    $test = new Test();
                    $test->setId($id);
                    if($test->remove())
                        echo "<script> alert('Teste removido com sucesso!'); </script>";
                    else
                        echo "<script> alert('Erro ao remover teste!'); </script>";
                    Functions::redir('router.php?op=7');
                 }else Functions::redir('index.php');
                 break;

        case 11: session_start(); // EXIBE AREA ADMINISTRATIVA
                 $userController = new UserController();
                 if(Functions::isLogged())
                 {
                    if($_SESSION['type'] == 1 || $_SESSION['type'] == 2) $userController->view_adminArea();
                    else $userController->view_accessDenied();
                 }else Functions::redir('router.php?op=2');
                 break;

        case 12: session_start(); //EFEITVA A REMOÇÃO DO PROCEDIMENTO
                 if(Functions::isLogged() && $_SESSION['type'] == 1)
                 {
                    $procedure_id = $_GET['id'];
                    $procedure = new Procedure();
                    $procedure->setId($procedure_id);
                    if($procedure->remove())
                        echo "<script> alert('Procedimento removido com sucesso!'); </script>";
                    else
                    {
                        // AQUI CHECO SE TEM ALGUM TESTE ASSOCIADO A ESTE PROCEDIMENTO
                        $sql = "SELECT *FROM tests WHERE procedure_id = :procedure_id";
                        $stmt = Database::getInstance()->getDB()->prepare($sql);
                        $stmt->bindParam(':procedure_id',$procedure_id);
                        $result = $stmt->execute();
                        if($result)
                        {
                            $rows = $stmt->fetchAll();
                            if(count($rows) > 0)  echo "<script> alert('Não foi possível remover! Foram encontrados ".count($rows)." teste(s) associado(s) à este procedimento!'); </script>";
                        }
                        else echo "<script> alert('Erro ao remover procedimento!'); </script>";
                    }
                    Functions::redir('router.php?op=11');
                 }else Functions::redir('index.php');
                 break;

        case 13: if(isset($_GET['id'])) // EXIBE TELA DE ATUALIZAÇÃO DE PROCEDIMENTO
                 {
                     session_start();
                     $procedureController = new ProcedureController();
                     $procedureController->view_update($_GET['id']);
                 }else Functions::redir('router.php?op=11');
                 break;

        case 14: if(isset($_POST)) //EFETIVA ATUALIZAÇÃO DO PROCEDIMENTO
                 {
                     $procedure_id = $_GET['id'];
                     $procedureController = new ProcedureController();
                     if($procedureController->update($procedure_id,$_POST['name'],$_POST['price']))
                         echo "<script> alert('Procedimento atualizado com sucesso!'); </script>";
                     else "<script> alert('Erro ao atualizar procedimento!'); </script>";
                 }
                 Functions::redir('router.php?op=11');
                 break;

        case 15: if(Functions::isLogged() && $_SESSION['type'] == 1) //EXIBE AREA DE CADASTRO DE PROCEDIMENTO
                 {
                    $procedureController = new ProcedureController();
                    $procedureController->view_register();
                 }else Functions::redir('index.php');
                 break;

        case 16: session_start(); //EFETIVA CADASTRO DE PROCEDIMENTO
                 if(Functions::isLogged() && $_SESSION['type'] == 1)
                 {
                    $procedureController = new ProcedureController();
                    if($procedureController->registerProcedure()) {
                        echo "<script> alert('Procedimento cadastrado com sucesso!'); </script>";
                        Functions::redir('router.php?op=11');
                    } else {
                        echo "<script> alert('Erro ao cadastrar Procedimento!'); </script>";
                        Functions::redir('router.php?op=11');
                    }
                 }else Functions::redir('index.php');
                 break;

        default: echo "<br>Opção invalida!"; break;
    }
