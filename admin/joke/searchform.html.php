<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Управление поговороками</title>
</head>
<body>
    <h1>Управление поговороками</h1>
    <p><a href="?add">Добавить новую поговорку</a></p>
    <form action="" method="get">
        <p>Критерии поговорок: </p>
        <div>
            <label for="author">По автору:</label>
            <select name="author" >
                <option value="">Любой автор</option>
                <?php foreach ($authors as $author):?>
                <option value="<?php htmlout($author['id']);?>"><?php htmlout($author['name']);?></option>
                <?php endforeach;?>
            </select>
        </div>
    </form>
</body>
</html>