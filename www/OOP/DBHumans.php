<?php
if (isset($_POST['name'])) {
header('Location: /OOP/Humans.php');
}
var_dump($_POST);

if (isset($_POST)) {
    $file = fopen(__DIR__ . '/list.txt', 'a');
    fputs($file, $_POST[name] . PHP_EOL);
    fputs($file, $_POST[nation] . PHP_EOL);
    fputs($file, $_POST[height] . PHP_EOL);
    fputs($file, $_POST[weight] . PHP_EOL);
    fclose($file);
    //file_put_contents(__DIR__ . '/list.txt', $_POST, FILE_APPEND);
}
?>
<html>
    <head>
        <title>Пополнение ДБ</title>
    </head>
    <body>
        <a href="/OOP/Humans.php">Создать ещё одного</a>
    </body>
</html>
