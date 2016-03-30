<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php htmlout($pagetitle);?></title>
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
<h1><?php htmlout($pagetitle);?></h1>
<form action="?<?php htmlout($action);?>" method="post">
    <div>
        <label for="name">Имя: <input type="text" name="nameuser" value="<?php htmlout($name);?>" /></label>
    </div>
    <div>
        <label for="email">Почта: <input type="text" name="email" value="<?php htmlout($email);?>" /></label>
    </div>
    <div>
        <input type="hidden" name="id" value="<?php htmlout($id);?>" />
        <input type="submit" value="<?php htmlout($button);?>" />
    </div>
</form>
</body>
</html>