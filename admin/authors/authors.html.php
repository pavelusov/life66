<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список авторов</title>
    <style>
        body{
            margin: 0px;
            padding: 0px;
        }
        h1{
            background-color: #3c4e82;
            color: #ffffff;
            height: 50px;
            text-align: center;
            padding-top: 10px;
        }
        li{
            background-color: gainsboro;
            padding: 2px;
            padding-left: 30px;
            padding-right: 30px;
            margin: 1px;

        }
        ul{
            list-style-type: none;
            margin-left: -30px;
        }
    </style>
</head>
<body>
<h1>Список авторов:</h1>
<a href="?add">Добавить нового автора</a>
<ul>
    <?php foreach ($authors as $author):?>
        <li>
           <form action="" method="post">
               <div>
                   <?php htmlout($author['name']) . htmlout(' - '). htmlout($author['email']); ?>
                   <input type="hidden" name="id" value="<?php echo $author['id'];?>"/>
                   <input type="submit" name="action" value="Редактировать"/>
                   <input type="submit" name="action" value="Удалить"/>

               </div>
           </form>
        </li>
    <?php endforeach;?>
</ul>
<a href="..">Вернуться в систему управления</a>
<!--<?php var_dump($result)?>-->
</body>
</html>