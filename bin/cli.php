<?php
/**
 * Created by PhpStorm.
 * User: User1
 * Date: 23.11.2018
 * Time: 23:41
 */

require __DIR__ . '/../vendor/autoload.php';

try {
    var_dump($argv);
    unset($argv[0]);
    sleep(array_shift($argv));


    // Регистрируем функцию автозагрузки
//    spl_autoload_register(function (string $className) {
//        require_once __DIR__ . '/../src/' . $className . '.php';
//    });

    $className = '\\MyProject\\Cli\\' . array_shift($argv);
    $reflectionOfClassName = new ReflectionClass($className);

    if (!$reflectionOfClassName->isSubclassOf('MyProject\Cli\AbstractCommand')) {
        throw new \MyProject\Exceptions\CliException('Class "' . $className . '" not a subclass of AbstractCommand');
    }

    if (!class_exists($className)) {
        throw new \MyProject\Exceptions\CliException('Class "' . $className . '" not found');
    }


    // Подготавливаем список аргументов
    $params = [];
    foreach ($argv as $argument) {
        preg_match('/^-(.+)=(.+)$/', $argument, $matches);
        if (!empty($matches)) {
            $paramName = $matches[1];
            $paramValue = $matches[2];

            $params[$paramName] = $paramValue;
        }
    }

    // Создаём экземпляр класса, передав параметры и вызываем метод execute()
    $class = new $className($params);
    $class->execute();
} catch (\MyProject\Exceptions\CliException $e) {
    echo 'Error: ' . $e->getMessage();
}