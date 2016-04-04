<?php
include_once 'connect.php';
//Получаем список авторов
try{
    $result = $pdo->query('SELECT `id`, `name` FROM `joke_users`');
}catch(PDOException $err){
    $error = 'Ошибка при получении списка авторов' . $err->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/error.html.php';
    exit;
}
foreach ($result as $item) {
    $authors[] = [
        'id'=>$item['id'],
        'name'=>$item['name']
    ];
}
//Получаем список категорий
try{
    $result = $pdo->query('SELECT `id`, `cat_name` FROM `category`');
}catch(PDOException $err){
    $error = 'Ошибка при получении списка категорий' . $err->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/error.html.php';
    exit;
}
foreach ($result as $item) {
    $categories[] = [
        'id'=>$item['id'],
        'name'=>$item['cat_name']
    ];
}
include 'searchform.html.php';