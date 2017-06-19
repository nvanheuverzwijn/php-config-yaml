<?php
/*
 * @license https://github.com/nvanheuverzwijn/php-config/blob/master/LICENSE
 */

namespace Zwijn\Config;

use \Zwijn\Config\Reader\ReaderInterface;

class ConfigFactory
{

    /**
     * @param array $array An array that respect the following structure.
     * [
     *     'reader' => [
     *         [
     *             'class' => 'ClassName'
     *             'config' => 'argument passed to the constructor of ClassName'
     *         ],
     *         [...]
     *     ]
     * ]
     * @throws \InvalidArgumentException
     * @return Config
     */
    public static function fromArray(array $array){

        $config = new Config([]);
        if (!isset($array['reader']) || !\is_array($array['reader'])){
            throw new \InvalidArgumentException('The given $array argument does not have a "reader" key or the "reader" key is not an array.');
        }
        $readers = $array['reader'];
        foreach($readers as $key => $reader) {
            if (!\is_array($reader)) {
                throw new \InvalidArgumentException('The given reader at position "'.$key.'" is not an array.');
            }
            if (!isset($reader['class'])){
                throw new \InvalidArgumentException('The given reader at position "'.$key.'" does not have a "class" key.');
            }
            if (!isset($reader['config'])){
                throw new \InvalidArgumentException('The given reader at position "'.$key.'" does not have a "config" key.');
            }
            /** @var ReaderInterface $readerInstance */
            $readerInstance = new $reader['class']($reader['config']);

            if (!$readerInstance instanceOf \Zwijn\Config\Reader\ReaderInterface) {
                throw new \InvalidArgumentException('The given reader "'.$reader['class'].'" at position "'.$key.'" does not implement \Zwijn\Config\Reader\ReaderInterface".');
            }
            $config->merge(new Config($readerInstance->fetchAll()));
        }

        return $config;
    }

}
