<?php

require __DIR__ . '/../vendor/autoload.php';

try {
//    spl_autoload_register(function (string $className) {
//        $classNameClear = str_replace("\\", "/", $className);
//        //var_dump($classNameClear);
//        require_once __DIR__ . '/../src/' . $classNameClear . '.php';
//    });

    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/../src/routes.php';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        throw new \MyProject\Exceptions\NotFoundException();
    }

    unset($matches[0]);

    //   var_dump($controllerAndAction);
    //var_dump($matches);


    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionName(...$matches);

} catch (\MyProject\Exceptions\DbException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
} catch (\MyProject\Exceptions\NotFoundException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
} catch (\MyProject\Exceptions\UnauthorizedException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('401.php', ['error' => $e->getMessage()], 401);
} catch (\MyProject\Exceptions\Forbidden $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('403.php', ['error' => $e->getMessage()], 403);
}


















/*
$url = '/post/892';
$pattern1 = '~/(.+)/(.+)~';
preg_match($pattern1, $url, $matches1);
var_dump($matches1);
*/

/*
Код главной страницы ссылок на первые пробы
require __DIR__ . '/auth.php';
$login = getUserLogin();
?>
<html>
    <head>
        <title>Главная страница</title>
    </head>
    <body>
        <a href="/files/upload.php">Загрузка файлов</a> <br>
        <a href="/OOP/Cats.php">Коты</a> <br>
        <a href="/OOP/CatCreation.php">Создание котов</a> <br>
        <a href="/OOP/Humans.php">Создание людей</a> <br>
        <a href="/Poligon.php">Тестилка</a> <br>
        
        <?php if ($login === null): ?>
            <a href="/login.php">Авторизуйтесь</a>
        <?php else: ?>
            Добро пожаловать, <?= $login ?>
            <br>
            <a href="/logout.php">Выйти</a>
        <?php endif; ?>
    </body>
</html>

*/