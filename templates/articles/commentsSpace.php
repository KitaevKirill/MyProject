


<?php $i = 0 ?>
<?php while (isset($comments[$i])): ?>
<?php var_dump('http://myproject.loc/Uploads/' . $comments[$i]->getUserId() . 'avatar.' . $extensionAv[$comments[$i]->getUserId()] ) ?>
    <?php if (file_exists('W:\domains\MyProject.loc\www\Uploads\\' . $comments[$i]->getUserId() . 'avatar.' . $extensionAv[$comments[$i]->getUserId()] )): ?>
    <img src="http://myproject.loc/Uploads/<?= $comments[$i]->getUserId() ?>avatar.<?= $extensionAv[$comments[$i]->getUserId()] ?>"  height="60px">
    <?php else: ?>
    <img src="http://myproject.loc/Uploads/defaultAv.jpg" height="60px">
    <?php endif;?>
    <p id='<?= comment . $comments[$i]->getId() ?>'><?= $commentsAuthor[$comments[$i]->getUserId()] ?>:
        <?= $comments[$i]->getText() ?></p>
    <?php if ($user !== null && ($user->isAdmin() || $user->getId() === $comments[$i]->getUserId())): ?>
        <a href="http://myproject.loc/comments/<?= $comments[$i]->getId() ?>/edit">редактировать</a>
    <? endif; ?>
    <hr>
    <?php $i++ ?>
<?php endwhile; ?>


