<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/func.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php htmlout($pageTitle)?></title>
</head>
<body>

    <h1><?php htmlout($pageTitle); ?></h1>
    <form action="?<?php htmlout($action); ?>" method="post">
    <!--вводим или редактируем текст-->
    <div>
        <label for="text">Введите текст шутки:</label>
        <textarea id="text" name="text" rows="10" cols="60"><?php
            htmlout($text); ?></textarea>
    </div>
   <!--выбираем имя автора-->
    <div>
        <label for="author">Автор:</label>
        <select name="author">
            <option value="">Выбрать автора</option>
            <?php foreach($authors as $author ):?>
                <option value="<?php htmlout($author['id'])?>" <?php
                if($author['id'] == $authorid){
                    echo ' selected';
                }
                ?>><?php htmlout($author['name'])?></option>
            <?php endforeach;?>
        </select>
    </div>
    <!--выбираем категорию-->
    <fieldset>
        <legend>Категории</legend>
        <?php foreach($categories as $category):?>
            <div>
                <label for="category<?php htmlout($category['id']); ?>">
                    <input type="checkbox"
                    name="categories[]"
                    id="category<?php htmlout($category['id']); ?>"
                    value="<?php htmlout($category['id']); ?>"<?php
                    if($category['selected']){
                        echo ' checked';
                    }?>/>
                    <?php htmlout($category['name']); ?>
                </label>
            </div>

        <?php endforeach;?>
    </fieldset>
    <!--добавляем кнопки-->
        <div>
            <input type="hidden" name="id" value="<?php htmlout($id); ?>"/>
            <input type="submit" value="<?php htmlout($button)?>"/>

        </div>
    </form>

</body>
</html>