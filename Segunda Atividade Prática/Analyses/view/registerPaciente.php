<?php

namespace view;

include_once ("utils/Functions.php");
use utils\Functions;

session_start();
?>

<html>
<head>
    <title>Registrar Paciente</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script type="text/javascript">
        function validar()
        {
            var pass1 = document.getElementById("pass1").value;
            var pass2 = document.getElementById("pass2").value;

            if( (pass1.length != pass2.length) || (pass1 != pass2) )
            {
                document.getElementById("alerta1").style.display = "block";
                document.getElementById("grupo1").classList.add("has-error");
                document.getElementById("pass2").focus();
                return false;
            }else
            {
                document.getElementById("alerta1").style.display = "none";
                document.getElementById("grupo1").classList.remove("has-error");
            }

            if(pass1.length < 8)
            {
                document.getElementById("alerta2").style.display = "block";
                document.getElementById("grupo1").classList.add("has-error");
                document.getElementById("pass2").focus();
                return false;
            }else
            {
                document.getElementById("alerta2").style.display = "none";
                document.getElementById("grupo1").classList.remove("has-error");
            }
        }
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
        <h2 style="color: #1675A8">Dados Cadastrais</h2>
        <h5>Todos os campos são de preenchimento obrigatórios!</h5>
    </div>

    <form action="router.php?op=4" method="post" class="form-horizontal" onsubmit="return validar()">
        <label class="control-label" for="name"><b>Nome</b></label>
        <input class="form-control" type="text" placeholder="Digite o usuário" name="name" required>

        <label class="control-label" for="email"><b>E-mail</b></label>
        <input class="form-control" type="email" placeholder="Digite seu e-mail" name="email" required>

        <div id="grupo1">
            <label class="control-label" for="pass1"><b>Senha</b></label>
            <input class="form-control" id="pass1" type="password" placeholder="Digite a senha" name="pass1" required>

            <label class="control-label" for="pass2"><b>Confirme a senha</b></label>
            <input class="form-control" id="pass2" type="password" placeholder="Confirme sua senha" name="pass2" required>
        </div>

        <br>

        <div class="alert alert-danger" style="display: none" id="alerta1">
            <p>As senhas não são iguais.</p>
        </div>
        <div class="alert alert-danger" style="display: none" id="alerta2">
            <p>Sua senha precisa ter no mínimo 8 caracteres.</p>
        </div>

        <div align="center">
            <a href="router.php?op=2" class="btn btn-info">Voltar</a>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>

        <br>
        <div align="center">
            <a>Não tem uma conta? </a>
            <a href="router.php?op=2" style="font-size: 15px; color: #2b669a">Crie uma!</a>
        </div>
    </form>
</div>
</body>
</html>