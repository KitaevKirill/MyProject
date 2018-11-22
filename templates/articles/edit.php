<?php
/**
 * Created by PhpStorm.
 * User: User1
 * Date: 16.10.2018
 * Time: 22:45
 */

include __DIR__ . '/../header.php'; ?>
    <h1>Редактирование статьи</h1>
<?php if (!empty($error)): ?>
    <div style="color: red;"><?= $error ?></div><br>
<?php endif; ?>
    <form action="/articles/<?= $article->getId() ?>/edit" method="post">
        <label for="name">Название статьи</label><br>
        <input type="text" name="name" id="name" value="<?= $_POST['name'] ?? $article->getName() ?>" size="50"><br>
        <br>
        <label for="text">Текст статьи</label><br>
        <textarea name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? $article->getText() ?></textarea><br>
        <br>
        <input type="submit" value="Обновить">
    </form>
<?php if(!empty($error)): ?>
    <?php include __DIR__ . '/../footerForErrors.php'; ?>
<?php else: ?>
    <?php include __DIR__ . '/../footer.php'; ?>
<?php endif; ?>