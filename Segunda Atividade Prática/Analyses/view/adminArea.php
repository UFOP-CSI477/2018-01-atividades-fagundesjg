<?php

namespace view;

include_once ("utils/Functions.php");
include_once ("controller/TestController.php");

use controller\ProcedureController;
use utils\Functions;
use controller\TestController;

session_start();

if(!Functions::isLogged() || $_SESSION['type'] == 3 )
    Functions::redir('index.php');

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Analyses Lab</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script>

    </script>
    <style type="text/css">

    </style>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav col-md-12">
        <div class="row col-md-3">
            <li class="nav-item">
                <a class="nav-link" href="index.php" >Área Geral</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="router.php?op=2" >Pacientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="router.php?op=11">Administrador</a>
            </li>
        </div>
        <li class="col-md-7"></li>
        <li class="col-md-2">
            <div class="row">
                <?php
                if(Functions::isLogged())
                {
                    echo "<label class=\"nav-link\" style='font-size: 13px'>Bem vindo ".$_SESSION['login']."</label>";
                    echo "<a class=\"nav-link\" style='font-size: 13px' href=\"router.php?op=6\" id=\"login\">Logout</a>";
                }else echo "<a class=\"nav-link\" href=\"router.php?op=2\" id=\"login\">Login</a>";
                ?>
            </div>
        </li>
    </ul>
</nav>
<br>
<div class="container-fluid">
    <?php
    $procedureController = new ProcedureController();
    $procedureController->admin_view_list();
    ?>
</div>

</body>
</html>