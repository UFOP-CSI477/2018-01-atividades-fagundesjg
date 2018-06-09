<?php

namespace view;

include_once("utils/Functions.php");

use controller\UserController;
use model\User;
use utils\Functions;

session_start();

if(!Functions::isLogged())
    Functions::redir('index.php');
else if($_SESSION['type'] != 1)
    Functions::redir('router.php?op=11');


?>
<html>
<head>
    <title>Cadastrar Procedimento</title>
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
            <li class="nav-item active">
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
        <h5>Preencha todos os campos do procedimento!</h5>
    </div>

    <?php
        $user = new User();
        $rows = $user->getAll();
    ?>

    <form action="router.php?op=16" method="post" class="form-horizontal">
        <label for="name">Nome</label>
        <input class="form-control" type="text" placeholder="Digite o nome do procedimento" name="name" required>

        <label for="price">Preço</label>
        <input class="form-control" type="text" placeholder="Digite o valor do procedimento" name="price" required>

        <label for="user_id">Usuario</label>
        <select class="form-control" name="user_id">
            <?php if(count($rows) > 0) foreach($rows as $row): ?>
            <option value="<?= $row['id'] ?>"> <?= $row['name'] ?></option>
            <?php endforeach ?>
        </select>
        <br>
        <div align="center">
            <a href="router.php?op=11" class="btn btn-info">Voltar</a>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
    </form>
</div>
</body>
</html>
