<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    </head>
    <body>
    <h1>Lista de procedimentos</h1>
    <table class="table table-hover">
        <thead style="background-color: #31708f;color: #f9f9f9">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Preço</th>
            <th scope="col">Usuário</th>
        </tr>
        </thead>
        <tbody>
        <?php if(count($rows) > 0) foreach($rows as $row): ?>
            <tr>
                <th scope="row"><?= $row['name']?></th>
                <th scope="row"><?= $row['price']?></th>
                <th scope="row"><?= $userController->getByID($row['user_id'])['name'] ?></th>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    </body>

</html>