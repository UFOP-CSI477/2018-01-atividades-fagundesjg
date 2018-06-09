<?php

include_once ("utils/Functions.php");
use utils\Functions;

session_start();
?>

<html>
    <head>
        <title>Área de login</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
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
                    <a class="nav-link" href="router.php?op=11">Administrador</a>
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

    <div class="container">
        <br>
        <div align="center">
            <h2 style="color: #1675A8">Analyses Lab</h2>
            <h5>Entre com seus dados</h5>
        </div>

        <form action="router.php?op=5" method="post" class="form-horizontal">
            <label class="control-label" for="login"><b>Username</b></label>
            <input class="form-control" type="text" placeholder="Digite o usuário" name="login" required>

            <label class="control-label" for="pass"><b>Password</b></label>
            <input class="form-control" type="password" placeholder="Digite a senha" name="pass" required>

            <br>

            <div align="center">
                    <a href="index.php" class="btn btn-info">Voltar</a>
                    <button type="submit" class="btn btn-success">Login</button>
            </div>

            <br>
            <div align="center">
                <a>Não tem uma conta? </a>
                <a href="router.php?op=3" style="font-size: 15px; color: #2b669a">Crie uma!</a>
            </div>
        </form>
    </div>
    </body>
</html>