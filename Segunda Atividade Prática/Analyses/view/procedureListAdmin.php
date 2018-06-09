<?php
    session_start();
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
<div class="row">
   <div class="col-md-6" align="left">
       <h2>Lista de procedimentos</h2>
   </div>
    <div class="col-md-6" align="right">
       <?php
            session_start();
            if($_SESSION['type'] == 1) echo "<a href=\"router.php?op=15\" class=\"btn btn-success\">+ Add</a>";
       ?>
    </div>
</div>

<table class="table table-hover">
    <thead style="background-color: #31708f;color: #f9f9f9">
    <tr>
        <th scope="col">Nome</th>
        <th scope="col">Preço</th>
        <th scope="col">Usuário</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php if(count($rows) > 0) foreach($rows as $row): ?>
        <tr>
            <th scope="row"><?= $row['name']?></th>
            <th scope="row"><?= $row['price']?></th>
            <th scope="row"><?= $userController->getByID($row['user_id'])['name'] ?></th>
            <th scope="row">
                <?php if($_SESSION['type'] == 1) echo "<a href=\"router.php?op=12&id=".$row['id']."\" class=\"btn btn-danger\">Remove</a>"; ?>
                <a href="router.php?op=13&id=<?= $row['id']; ?>" class="btn btn-info">Update</a>
            </th>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
</body>

</html>