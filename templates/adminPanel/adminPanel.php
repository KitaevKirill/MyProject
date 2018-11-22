<?php include __DIR__ . '/../header.php'; ?>

<H1>Админка</H1>
<H2> Сменить название Сайта</H2>
<form action="/adminPanel/changeTitle" method="post">
    <label for="siteTitle">Новое название сайта:</label><br>
    <textarea name="siteTitle" id="siteTitle" rows="1" cols="50"><?= $_POST['siteTitle'] ?? '' ?></textarea><br>
    <br>
    <input type="submit" value="Изменить">
</form>

<H2> Новые статьи</H2>
<?php $i = 1 ?>
<?php while (isset($article[$i])): ?>
    <p><?= $article[$i]->getAuthor()->getNickname() ?>:</p>
    <p><?= mb_substr($article[$i]->getText(), 0, 100) . '...' ?></p>
    <p><a href="http://myproject.loc/articles/<?= $article[$i]->getId() ?>/edit">Редактировать статью</a></p>
    <?php $i++ ?>
    <hr>
<?php endwhile; ?>


<H2> Новые комментарии</H2>
<?php $j = 1 ?>
<?php while (isset($comment[$j])): ?>
    <p><?= $comment[$j]->getAuthor()->getNickname() ?>:</p>
    <p><?= mb_substr($comment[$j]->getText(), 0, 100) . '...' ?></p>
    <p><a href="http://myproject.loc/comments/<?= $comment[$j]->getId() ?>/edit">Редактировать комментарий</a></p>
    <?php $j++ ?>
    <hr>
<?php endwhile; ?>



<?php include __DIR__ . '/../footer.php'; ?>
