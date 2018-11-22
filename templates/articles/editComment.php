<?php
/**
 * Created by PhpStorm.
 * User: User1
 * Date: 31.10.2018
 * Time: 21:03
 */

include __DIR__ . '/../header.php'; ?>
    <h1>Редактирование комментария</h1>
<?php if (!empty($error)): ?>
    <div style="color: red;"><?= $error ?></div><br>
<?php endif; ?>
    <form action="/comments/<?= $comment->getId() ?>/edit" method="post">
        <label for="text">Текст комментария</label><br>
        <textarea name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? $comment->getText() ?></textarea><br>
        <br>
        <input type="submit" value="Обновить">
    </form>

<?php if(!empty($error)): ?>
    <?php include __DIR__ . '/../footerForErrors.php'; ?>
<?php else: ?>
    <?php include __DIR__ . '/../footer.php'; ?>
<?php endif; ?>