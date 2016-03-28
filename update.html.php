<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.inc.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <style type="text/css">
        label, textarea,input{
            margin-top: 10px;
        }
    </style>
</head>
<body>
<h2>Редактировать поговорку </h2>
<form action="?edit" method="post">
    <input type="hidden" name="idEdit" value="<?php echo $idjoke;?>"/>
    <br>
    <textarea name="joketextEdit" rows="10" cols="40" ><?php
        foreach ($result as $value) {
                htmlout($value['joketext']);
        }
        ?></textarea>
    <input type="submit" value="Отредактировать"/>

</form>
</body>
</html>