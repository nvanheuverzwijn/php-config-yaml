<?php
/*
 * @license https://github.com/nvanheuverzwijn/php-config/blob/master/LICENSE
 */

namespace Zwijn\Config\Reader;

interface ReaderInterface
{
    /**
     * @return array
     */
    public function fetchAll();
}
