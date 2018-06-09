<?php

namespace view;

include_once("utils/Functions.php");
use utils\Functions;

session_start();

?>

<html>
    <head>
        <title>Registrar Teste</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script type="text/javascript">

        </script>
    </head>
    <body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav col-md-12">
            <div class="row col-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="index.php" >Área Geral</a>
                </li>
                <li class="nav-item active">
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
            <h5>Preencha os campos do teste!</h5>
        </div>

        <?php
        $procedures = new \model\Procedure();
        $procs = $procedures->getAll();
        ?>

        <form action="router.php?op=9" method="post" class="form-horizontal">
            <label class="control-label" for="procedure_id"><b>Procedimento</b></label>
            <select class="form-control" name="procedure_id">
                <?php if(count($procs) > 0) foreach($procs as $p): ?>
                <option value="<?= $p['id']?>"><?= $p['name']?></option>
                <?php endforeach ?>
            </select>
            <label class="control-label" for="date"><b>Data</b></label>
            <input type="date" class="form-control" name="date">

            <br>
            <div align="center">
                <a href="router.php?op=2" class="btn btn-info">Voltar</a>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>

        </form>
    </div>
    </body>
</html>