<?php
//функция экранирования символов в html
function html($text){
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

//функция для сокращения вывода содержимого, чтобы  не писать echo
function htmlout($out){
    echo html($out);
}