<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add</title>
    <style type="text/css">
        label, textarea,input{
            margin-top: 10px;
        }
    </style>
</head>
<body>
<h2>Добавить поговорку </h2>
    <form action="?" method="post">

        <br>
        <textarea name="joketext" rows="10" cols="40">Введите текст..</textarea>
        <br>
        <label for="name">Имя автора: </label>
        <input type="text" name="name" size="26" value="1 (Мужчина) или 2 (Девушка)"/>
        <br>
        <input type="submit" value="add"/>
    </form>
</body>
</html>