<?php
/*
 * @license https://github.com/nvanheuverzwijn/php-config/blob/master/LICENSE
 */

namespace ZwijnTests\Config\Fixture;

use \Zwijn\Config\Reader\ReaderInterface;

class ReaderReturnConstructArgumentAsConfig implements ReaderInterface
{
    private $config = [];

    public function __construct($config){
        $this->config = $config;
    }

    public function fetchAll(){
        return $this->config;
    }
}
