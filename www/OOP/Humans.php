<?php
require __DIR__ . '/HumansLogic.php ';
?>

<html>
    <head>
        <title>Humans</title>
    </head>
    <body>
        <form action="/OOP/DBHumans.php" method="post">
            <label>
                <select name="nation" >
                    <option value="Русский">Русский</option>
                    <option value="Eng">Англичанин</option>
                </select>
            </label>
            <br>
            <label>
                Имя:<input type="text" name="name" >
            </label>
            <br>
            <label>
                Рост человека:<input type="text" name="height" value="В сантиметрах">
            </label>
            <br>
            <label>
                Вес человека:<input type="text" name="weight" value="В килограммах">
            </label>
            <br>
            <input type="submit" value="Готово">
        </form>
        <a href="/index.php">Назад</a>
    </body>
</html>
