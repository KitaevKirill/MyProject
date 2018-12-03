<?php
/**
 * Created by PhpStorm.
 * User: User1
 * Date: 24.11.2018
 * Time: 12:51
 */

namespace MyProject\Cli;

class Minusator extends AbstractCommand
{
    protected function checkParams()
    {
        $this->ensureParamExists('x');
        $this->ensureParamExists('y');
    }

    public function execute()
    {
        echo $this->getParam('x') - $this->getParam('y');
    }
}