<?php if ($user !== null): ?>
    <?php if(!empty($error)): ?>
        <div style="color: red;"><?= $error ?></div>
    <?php endif; ?>
    <form action="/articles/<?= $article->getId() ?>/addComments" method="post">
        <label for="text">Добавить комментарий:</label><br>
        <textarea name="text" id="text" rows="2" cols="80"><?= $_POST['text'] ?? '' ?></textarea><br>
        <br>
        <input type="submit" value="Создать">
    </form>
<? else: ?>
    Для добавления комментария <a href="http://myproject.loc/users/register">зарегестрируйтесь</a>
<? endif; ?>