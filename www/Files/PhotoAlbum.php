<?php
require __DIR__ . '/../auth.php';
$login = getUserLogin();

$files = scandir(__DIR__ . '/uploads');
$links = [];
foreach ($files as $fileName) {
    if ($fileName === '.' || $fileName === '..') {
        continue;
    }
    $links[] = 'http://myproject.loc/Files/uploads/' . $fileName;
}
var_dump($links);
?>

<html>
    <head>
        <title>Загрузка файла</title>
    </head>
    <body>
        <?php if ($login === null): ?>
            <a href="/login.php">Авторизуйтесь</a> <br>
        <?php else: ?>
            <br>
            Вы зашли как <?= $login ?>
            <br>
            <a href="/logout.php">Выйти</a><br>
        <?php endif; ?>

        <?php foreach ($links as $link): ?>
            <a href="<?= $link ?>"><img src="<?= $link ?>" height="80px"></a>
        <?php endforeach; ?>
        <?php require __DIR__ . '/Feedback.php'; ?>

        <a href="/files/upload.php">К загрузке</a> 

    </body>
</html>