<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.inc.php';?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Поговорки</title>
   </head>
<body>
<!--<a href="?addjoke">Добавить свою поговорку</a>-->
<form action="?addjoke" method="post">
    <input type="submit" value="Добавить свою поговорку" />
</form>
<br>
<?php foreach($result as $value):?>
    <div style="display: block;margin-top: 20px;border: 10px solid yellowgreen; width: 90%; ">
    <form action="?deletejoke" method="post" style="float: left">
        <blockquote>
            <p>
                <?php htmlout($value['joketext']);?>
                <input type="hidden" name="id" value="<?php echo $value['id'];?>" />
                <input type="submit" value="Удалить" />
                (Автор: <?=$value['name'];?>)
            </p>

        </blockquote>
    </form>
    <form action="?update" method="post" style="padding-top: 15px; ">
        <input type="hidden" name="id" value="<?php echo $value['id'];?>"/>
        <input type="submit" value="Редактировать" />
    </form>
    <p style="clear: both;"></p>
    </div>
<?php endforeach;?>
</body>
</html>