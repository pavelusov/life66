<?php
include 'connect.php';

//Добавляем поговорки
if(isset($_REQUEST['addjoke'])){
    include 'form.html.php';
    exit;
}
if( (isset($_POST['joketext']) || !empty($_POST['joketext']) )
    && (isset($_POST['name']) || !empty($_POST['name']))  ) {


    try{
        $sql = 'INSERT INTO `joke`
            SET
            joketext = :joketext,
            autorid = :jokename,
            jokedate = CURDATE()';


        $query = $pdo->prepare($sql);
        $query->bindValue(':joketext', $_POST['joketext']);
        $query->bindValue(':jokename', $_POST['name']);
        $query->execute();
    }
    catch(PDOException $e)
    {
        $output = 'Вставка не получилась' . $e->getMessage();
        include 'error.html.php';
    }
    header('Location: .');
    exit;

}


//выбираем поговорки
try{
    $sql = 'SELECT j.id, `joketext`, `name` FROM `joke` AS `j` JOIN `joke_users` AS `u` ON `autorid` = u.id';
    $result = $pdo->query($sql);


}catch(PDOException $e){
    $error = '<h2>Ошибка при выборке БД: </h2>' . $e->getMessage();
    include 'error.html.php';
}

if(isset($_GET['deletejoke'])){
    try{
        $sql = 'DELETE FROM `joke` WHERE `id`=:jokeid ';
        $s = $pdo->prepare($sql);
        $s->bindValue(':jokeid', $_POST['id']);
        $s->execute();

    }catch(PDOException $e){
        $error = '<h2>Ошибка при выборке БД: </h2>' . $e->getMessage();
        include 'error.html.php';
        exit;
        }
    header('Location: .');
    exit;
}
//Обновляем поговрки
if(isset($_REQUEST['update'])){
    try{
        $sql = 'SELECT `joketext` FROM `joke`
                WHERE `id`=:jokeid';
        $result = $pdo->prepare($sql);
        $result->bindValue(':jokeid', $_POST['id']);
        $result->execute();
        $idjoke = $_POST['id'];
    }catch(PDOException $e){
        $error = '<h2>Ошибка при выборке БД: </h2>' . $e->getMessage();
        include 'error.html.php';
    }

    include 'update.html.php';
    exit;
}

if(isset($_REQUEST['edit'])){
    try
    {
       $sql = 'UPDATE `joke`
                SET `joketext` = :joketext
                WHERE `id`= :jokeid';
        $query = $pdo->prepare($sql);
        $query->bindValue(':joketext', $_POST['joketextEdit']);
        $query->bindValue(':jokeid', $_POST['idEdit']);
        $query->execute();
    }catch(PDOException $e){
        $error = '<h2>Ошибка при редактировании: </h2>' . $e->getMessage();
        include 'error.html.php';
        exit;
    }
    header('Location: .');
    exit;
}


include 'deletejoke.html.php';

