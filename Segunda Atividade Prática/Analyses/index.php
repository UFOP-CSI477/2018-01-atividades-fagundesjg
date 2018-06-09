<?php

include_once ("utils/Functions.php");
use utils\Functions;

    session_start();
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
                  <a class="nav-link active" href="index.php" >Área Geral</a>
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

  <div class="container-fluid">
      <br>
      <?php
      include_once("controller/UserController.php");
      include_once("controller/ProcedureController.php");
      include_once("controller/TestController.php");
      use controller\UserController;
      use controller\ProcedureController;
      use controller\TestController;

      $procedureController = new ProcedureController();
      $procedureController->view_list();
      ?>
  </div>

  </body>
</html>
