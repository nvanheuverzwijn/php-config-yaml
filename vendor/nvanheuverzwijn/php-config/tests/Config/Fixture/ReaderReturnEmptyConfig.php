<?php
/*
 * @license https://github.com/nvanheuverzwijn/php-config/blob/master/LICENSE
 */

namespace ZwijnTests\Config\Fixture;

use \Zwijn\Config\Reader\ReaderInterface;

class ReaderReturnEmptyConfig implements ReaderInterface
{
    public function fetchAll(){
        return [];
    }
}
