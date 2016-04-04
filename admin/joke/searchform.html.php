<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Управление поговороками</title>
    <style type="text/css">
        .field{
            margin: 10px 0;
            background: #6d91c4;
            padding: 15px;
            color: white;
            width: 400px;
        }
    </style>
</head>
<body>
    <h1>Управление поговороками</h1>
    <p><a href="?add">Добавить новую поговорку</a></p>
    <form action="" method="get">
        <p>Критерии поговорок: </p>
        <div class="field">
            <label for="author">По автору:</label>
            <select name="author" >
                <option value="">Любой автор</option>
                <?php foreach ($authors as $author):?>
                <option value="<?php htmlout($author['id']);?>"><?php htmlout($author['name']);?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="field">
            <label for="category">По категории: </label>
            <select name="category">
                <option value="">Любая категория</option>
                <?php foreach ($categories as $category):?>
                    <option value="<?php htmlout($category['id']);?>"><?php htmlout($category['name']);?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="field">
            <label for="text">Содержит текст: </label>
            <input type="text" name="text" />
        </div>
        <div >
            <input type="hidden" name="action" value="search" />
            <input type="submit" value="Поиск" />
        </div>
    </form>
<p><a href="..">Вернуться на главную страницу</a></p>
</body>
</html>