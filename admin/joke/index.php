<?php
include_once 'connect.php';
//Перехватываем кнопку "Редактировать"
if(isset($_POST['action']) && $_POST['action'] == 'Редактировать'){
    //получаем поговорку
    try{
        $sql = 'SELECT `id`, `joketext`, `autorid` FROM `joke` WHERE id = :id ';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();


    }catch(PDOException $err){
        $error = 'Ошибка при получении данных' . $err->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/error.html.php';
        exit;
    }
    $row = $s->fetch();
    $pageTitle = 'Редактировать поговорку';
    $action = 'editform';
    $text = $row['joketext'];
    $authorid = $row['autorid'];
    $id = $row['id'];
    $button = 'Обновить поговорку';

    //Формируем список авторов
    try{
        $result = $pdo->query('SELECT `id`, `name` FROM `joke_users`');


    }catch(PDOException $err){
        $error = 'Ошибка при получении данных' . $err->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/error.html.php';
        exit;
    }
    foreach ($result as $row) {
        $authors[] = [
            'id' => $row['id'],
            'name' => $row['name']
        ];
    }


    include 'form.html.php';
    exit;

}
// Добавление новой шутки

if(isset($_GET['add'])){
    $pageTitle = 'Новая поговорка!';
    $action = 'addform';
    $text = '';
    $authorid = '';
    $id = '';
    $button = 'Добавить поговорку';

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
            'name'=>$item['cat_name'],
            'selected'=>FALSE
        ];
    }



    include 'form.html.php';
    exit;
}

//запрос SELECT
if(isset($_GET['action']) && $_GET['action'] == 'search' ){
    //** ЭТАП 1 */
    //Базовое выражение SELECT
    $select = 'SELECT `id`, `joketext`';
    $from   = ' FROM `joke`';
    $where  = ' WHERE TRUE'; //если ничего не выбранно(автор, категория, поиск) то команда WHERE
    //окажется ненужной. Тогда WHERE TRUE никак не повлияет на результат
    //** ЭТАП 2 */
    // Проверяем каждый из критериев
    $placeholders = [];
    if($_GET['author'] != ''){ //автор выбран******************
        $where .= " AND `autorid` = :autorid";
        $placeholders[':autorid'] = $_GET['author'];
    }
    if($_GET['category'] != ''){ //Категория выбрана***********
        $from .= ' INNER JOIN `jokecategory` ON `id` = `idjoke` ';
        $where .= " AND `idcat` = :categotyid";
        $placeholders[':categotyid'] = $_GET['category'];
        //var_dump($placeholders);
        //print $select . $from . $where;
    }
    if($_GET['text'] != ''){ //Набран текст по которому ищем
        $where .= "AND `joketext` LIKE :joketext";
        $placeholders[':joketext'] = '%' . $_GET['text'] . '%';
    }

    //Сформировали запрос
    try{
        $query = $select . $from . $where;
        $s = $pdo->prepare($query);
        $s->execute($placeholders); //массив $placeholders хранит все значения псевдопеременных
        //поэтому bindValue можно не использовать
    }catch(PDOException $err){
        $error = 'Код ошибки: ' . $err->getMessage();
        exit;
    }
    foreach ($s as $row) {
        $jokes[] = [
            'id' => $row['id'],
            'text' => $row['joketext'],
        ] ;
    }
    include 'joke.html.php';
    exit;
}

//*************************************************************************

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

var_dump($_REQUEST);























































