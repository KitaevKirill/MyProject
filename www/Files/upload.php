<?php
require __DIR__ . '/../auth.php';
$login = getUserLogin();
if ($login !== null && !empty($_FILES['attachment'])) {
    $file = $_FILES['attachment'];
    $fileSize = getimagesize($file['tmp_name']);
    $fileHeight = $fileSize['1'];
    $fileWidth = $fileSize['0'];



    // собираем путь до нового файла - папка uploads в текущей директории
    // в качестве имени оставляем исходное файла имя во время загрузки в браузере
    $srcFileName = $file['name'];
    $newFilePath = __DIR__ . '/Uploads/' . $srcFileName;

    $allowedExtensions = ['jpg', 'png', 'gif', 'JPG'];
    $extension = pathinfo($srcFileName, PATHINFO_EXTENSION);
    if (!in_array($extension, $allowedExtensions)) {
        $error = 'Загрузка файлов с таким расширением запрещена!';
    } elseif ($file['size'] >= 8388608) {
        $error = 'Файл слишком большого размера';
    } elseif ($file['error'] !== UPLOAD_ERR_OK) {
        if ($file['error'] == UPLOAD_ERR_INI_SIZE) {
            $error = 'Размер файла больше допустимого сервером';
        } else {
            $error = 'Ошибка при загрузке файла.';
        }
    } elseif ($fileHeight > 4000 && $fileWidth > 5000) {
        $error = 'Изображение больше, чем 5000х4000';
    } elseif (file_exists($newFilePath)) {
        $error = 'Файл с таким именем уже существует';
    } elseif (!move_uploaded_file($file['tmp_name'], $newFilePath)) {
        $error = 'Ошибка при загрузке файла';
    } else {
        $result = 'http://myproject.loc/Files/uploads/' . $srcFileName;
    }
}
?>
<html>
    <head>
        <title>Загрузка файла</title>
    </head>
    <body>
        <?php if ($login === null): ?>
            <a href="/login.php">Авторизуйтесь</a> <br>
        <?php else: ?>
            Вы зашли как <?= $login ?>
            <br>
            <a href="/logout.php">Выйти</a><br>

            <?php if (!empty($error)): ?>
                <?= $error ?>
            <?php elseif (!empty($result)): ?>
                <?= $result ?>
            <?php endif; ?>
            <br>
            <form action="/Files/upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="attachment">
                <input type="submit">
            </form>
        <?php endif; ?>
        <a href="/files/PhotoAlbum.php">К фотоальбому</a> 
        <a href="/index.php">Назад</a> 
    </body>
</html>