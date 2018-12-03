<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getParsedText() ?></p>


    <p> <?= var_dump($extensionAv) ?></p>
    <p> <?= var_dump($comments) ?></p>
    <p> <?= var_dump($article) ?></p>
    <p> <?= var_dump($user) ?></p>
    <p> <?= var_dump($commentsAuthor) ?></p>
    <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
<?php if ($user !== null && $user->isAdmin()): ?>
    <p><a href="http://myproject.loc/articles/<?= $article->getId() ?>/edit">Редактировать статью</a></p>
<? endif; ?>
    <br>
<?php include __DIR__ . '/addComments.php'; ?><hr>
<?php include __DIR__ . '/commentsSpace.php'; ?>
<?php if(!empty($error)): ?>
    <?php include __DIR__ . '/../footerForErrors.php'; ?>
<?php else: ?>
    <?php include __DIR__ . '/../footer.php'; ?>
<?php endif; ?>