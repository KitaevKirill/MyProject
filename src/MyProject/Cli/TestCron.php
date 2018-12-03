<?php
/**
 * Created by PhpStorm.
 * User: User1
 * Date: 25.11.2018
 * Time: 14:54
 */

namespace MyProject\Cli;

class TestCron extends AbstractCommand
{
    protected function checkParams()
    {
        $this->ensureParamExists('x');
        $this->ensureParamExists('y');
    }

    public function execute()
    {
        // чтобы проверить работу скрипта, будем записывать в файлик 1.log текущую дату и время
        file_put_contents('w:\\1.log', date(DATE_ISO8601) . PHP_EOL, FILE_APPEND);
    }
}