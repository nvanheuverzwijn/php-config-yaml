<?php
/*
 * @license https://github.com/nvanheuverzwijn/php-config/blob/master/LICENSE
 */

namespace Zwijn\Config;

interface ConfigInterface extends \Countable, \Iterator, \ArrayAccess
{
    /**
     * @param  string $name
     * @param  mixed  $default
     * @return mixed
     */
    public function get($name, $default = null);

    /**
     * @return array
     */
    public function toArray();
}
