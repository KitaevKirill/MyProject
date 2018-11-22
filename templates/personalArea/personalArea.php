<?php include __DIR__ . '/../header.php'; ?>

<p>Здравствуйте, <?= $user->getNickname() ?></p>
<?php if(!empty($error)): ?>
    <div style="color: red;"><?= $error ?></div>
<?php endif; ?>

<?php if(!empty($result)): ?>
    <div style="color: green;"><?= $result ?></div>
<?php endif; ?>

<form action="/uploadAvatar" method="post" enctype="multipart/form-data">
    <input type="file" name="avatar">
    <input type="submit">
</form>

<?php if(!empty($error)): ?>
    <?php include __DIR__ . '/../footerForErrors.php'; ?>
<?php else: ?>
    <?php include __DIR__ . '/../footer.php'; ?>
<?php endif; ?>
