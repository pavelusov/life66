<?php
include_once 'connect.php';

//Получаем запрос на добавление нового автора
if(isset($_GET['add'])){
    $pagetitle = 'Добавить нового автора';
    $action = 'addform';
    $name = '';
    $email = '';
    $id = '';
    $button = 'Добавить автора';
    include 'form.html.php';
    exit;
}
//Добавляем нового автора
if(isset($_GET['addform'])){
    try{
        $query = 'INSERT INTO `joke_users`
                  SET `name` = :nameuser,
                      `email` = :email
                  ';
        $s = $pdo->prepare($query);
        $s->bindValue(':nameuser', $_POST['nameuser']);
        $s->bindValue(':email', $_POST['email']);
        $s->execute();

    }catch(PDOException $err){
        $error = '<h2>Ошибка при добавлении автора: </h2>' . $err->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/error.html.php';
        exit;

    }

    header('Location: .');
    exit;
}
//Редактируем автора -> форма
if(isset($_POST['action']) and !empty($_POST['action'] == 'Редактировать' ) ){

    try{
        $query = 'SELECT * FROM `joke_users` WHERE `id`= :id';
        $s = $pdo->prepare($query);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();

    }catch(PDOException $err){
        $error = '<h2>Ошибка при удалении из категории: </h2>' . $err->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/error.html.php';
        exit;

    }
    $resEdit = $s->fetch();
    $pagetitle = 'Редактировать данные автора';
    $action = 'editform';
    $name = $resEdit['name'];
    $email = $resEdit['email'];
    $id = $resEdit['id'];
    $button = 'Редактировать автора';
    include 'form.html.php';
    exit;


}
//Редактируем автора -> базаданных
if(isset($_GET['editform'])){

    try{
        $query = 'UPDATE joke_users SET
                  name = :nameuser,
                  email = :email
                  WHERE id = :id';
        $s = $pdo->prepare($query);
        $s->bindValue(':id', $_POST['id']);
        $s->bindValue(':nameuser', $_POST['nameuser']);
        $s->bindValue(':email', $_POST['email']);
        $s->execute();
        //var_dump($_POST);


    }catch(PDOException $err){
        $error = '<h2>Ошибка при обновлении: </h2>' . $err->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/error.html.php';
        exit;

    }
    header('Location: .');
    //var_dump($_POST);
    exit;

}

/*
 *  try{



    }catch(PDOException $err){
        $error = '<h2>Ошибка при удалении из категории: </h2>' . $err->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/error.html.php';
        exit;

    }

 */
//Перехватываем запросы УДАЛИТЬ
if(isset($_POST['action']) and !empty($_POST['action']  == 'Удалить') ){

    //Получаем id поговорки принадлежащая автору
    try{
        $query = 'SELECT `id` FROM joke WHERE autorid = :id';
        $s = $pdo->prepare($query);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();


    }catch(PDOException $err){
        $error = '<h2>Ошибка при удалении: </h2>' . $err->getMessage();
        include 'error.html.php';
        exit;
    }
    $result = $s->fetchAll();

    // // Удаляем записи о категориях поговорки
    try{
        $query = 'DELETE FROM `jokecategory` WHERE `idjoke`= :id ';
        $s = $pdo->prepare($query);
        //Для каждой поговорки
        foreach ($result as $item) {
            $jokeid = $result['id'];
            $s->bindValue(':id', $jokeid);
            $s->execute();
        }
    }catch(PDOException $err){
        $error = '<h2>Ошибка при удалении из категории: </h2>' . $err->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/error.html.php';
        exit;
    }
    //Удаляем шутки принадлежащие автору
    try{
        $query = 'DELETE FROM `joke` WHERE autorid = :id';
        $s = $pdo->prepare($query);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }catch(PDOException $err){
        $error = '<h2>Ошибка при удалении поговорки автора: </h2>' . $err->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/error.html.php';
        exit;
    }
    //Удаляем имя автора
    try{
        $query = 'DELETE FROM `joke_users` WHERE id = :id';
        $s = $pdo->prepare($query);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }catch(PDOException $err){
        $error = '<h2>Ошибка при удалении из категории: </h2>' . $err->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/error.html.php';
        exit;
    }
    header('Location: .');
    exit;

}

//Всегда идет последним до header. Запрашиваем список авторов
try{
    $query = 'SELECT * FROM `joke_users`';
    $result = $pdo->query($query);

}
catch(PDOException $err){
    $error = 'Не удалось загрузить список авторов. Ошибка: ' . $err->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/error.html.php';
    exit;
}
foreach ($result as $item) {
    $authors[] = [
        'id' => $item['id'],
        'name' => $item['name'],
        'email' => $item['email']

    ];
}

// Погружаем файл и выводим в нем список авторов
include 'authors.html.php';



