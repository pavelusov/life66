<?php
include_once 'connect.php';

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

























































