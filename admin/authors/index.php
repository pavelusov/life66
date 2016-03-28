<?php
include_once 'connect.php';

//Запрашиваем список авторов

try{
    $query = 'SELECT * FROM `joke_users`';
    $result = $pdo->query($query);
    foreach ($result as $item) {
        $authors[] = [
            'id' => $item['id'],
            'name' => $item['name'],
            'email' => $item['email']

        ];
    }
}catch(PDOException $err){
    $error = 'Не удалось загрузить список авторов. Ошибка: ' . $err->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/error.html.php';
    exit;
}

// Погружаем файл и выводим в нем список авторов
include 'authors.html.php';

//Перехватываем запросы УДАЛИТЬ
if(isset($_POST['action']) && !empty($_POST['action']) == 'Удалить' ){

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
        foreach ($result as $item) {
            $jokeid = $result['id'];
            $s->bindValue(':id', $jokeid;
            $s->execute();
        }
    }catch(PDOException $err){
        $error = '<h2>Ошибка при удалении из категории: </h2>' . $err->getMessage();
        include 'error.html.php';
        exit;
    }

}



