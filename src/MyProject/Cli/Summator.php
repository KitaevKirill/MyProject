<?php
/**
 * Created by PhpStorm.
 * User: User1
 * Date: 23.11.2018
 * Time: 23:52
 */

namespace MyProject\Cli;

use MyProject\Exceptions\CliException;

class Summator extends AbstractCommand
{
    protected function checkParams()
    {
        $this->ensureParamExists('a');
        $this->ensureParamExists('b');
    }

    public function execute()
    {
        echo $this->getParam('a') + $this->getParam('b');
    }
}