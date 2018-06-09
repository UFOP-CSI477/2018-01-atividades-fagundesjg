<?php

namespace view;
include_once ("utils/Functions.php");
use utils\Functions;

$total = 0;
$qtd = 0;

?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>

    <div class="row">
        <div class="col-md-6" align="left">
            <h2>Lista de Testes</h2>
        </div>

        <div class="col-md-6" align="right">
            <a href="router.php?op=8" class="btn btn-success">+ Add</a>
        </div>
    </div>



<table class="table table-hover">
    <thead style="background-color: #31708f;color: #f9f9f9">
    <tr>
        <th scope="col">Procedimento</th>
<!--        <th scope="col">Paciente</th>-->
        <th scope="col">Data</th>
        <th scope="col">Valor</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php if(count($rows) > 0) foreach($rows as $row): ?>
        <tr>
            <th scope="row"><?= Functions::getProcedure($row['procedure_id'])['name']?></th>
<!--            <th scope="row">--><?//= Functions::getUser($row['user_id'])['name']?><!--</th>-->
            <th scope="row"><?= $row['date'] ?></th>
            <th scope="row"><?= Functions::getProcedure($row['procedure_id'])['price']?></th>
            <th scope="row"><a class="btn btn-danger" href="router.php?op=10&id=<?= $row['id'] ?>">Remove</a> <a class="btn btn-info" href="#">Update</a></th>
        </tr>
        <?php
            $total += Functions::getProcedure($row['procedure_id'])['price'];
            $qtd++;
        ?>
    <?php endforeach ?>
    </tbody>
    <tfoot style="background-color: #31708f;color: #f9f9f9">
        <tr align="center">
            <th scope="row"></th>
            <th scope="row">Quantidade: <?= $qtd ?></th>
            <th scope="row">Valor Total: R$ <?= $total ?></th>
            <th scope="row"></th>
            <th scope="row"></th>
        </tr>
    </tfoot>
</table>

</body>

</html>