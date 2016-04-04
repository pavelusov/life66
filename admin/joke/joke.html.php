<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Результаты поиска</title>
</head>
<body>
    <h1>Результаты поиска</h1>
    <?php if(isset($jokes)): ?>
        <table>
            <tr><th>Текст шутки</th></tr>
            <?php foreach ($jokes as $joke):?>
            <tr>
                <td><?php htmlout($joke['text']);?></td>
            </tr>
            <?php endforeach;?>
        </table>
    <?php endif;?>
</body>
</html>