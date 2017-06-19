<?php
/*
 * @license https://github.com/nvanheuverzwijn/php-config-yaml/blob/master/LICENSE
 */

namespace Zwijn\Config\Yaml;

class Reader implements \Zwijn\Config\Reader\ReaderInterface
{
    /**
     * @var string $file
     */
    private $file = '';
    /**
     * @var callable $yaml_parser
     */
    private $yaml_parser = '';

    /**
     * @param array $config The accepted keys are:
     *   string   file: A readable yaml file.
     *   callable yaml_parser: A callable function which take the given
     *                         file content as argument and returns an array.
     * @throws \InvalidArgumentException whenever a given configuration is invalid.
     */
    public function __construct($config){
            $this->file = $config['file'];
            if (!\is_readable($this->file)){
                throw new \InvalidArgumentException('The file "'.$this->file.'" is not readable.');
            }

            if (isset($config['yaml_parser'])){
                $this->yaml_parser = $config['yaml_parser'];
            }
            elseif (\function_exists('yaml_parse')){
                $this->yaml_parser = 'yaml_parse';
            }
            else {
                throw new \InvalidArgumentException('No "yaml_parser" provided.');
            }

            if (!\is_callable($this->yaml_parser)){
                throw new \InvalidArgumentException('The given yaml parser "'.$this->yaml_parser.'" is not callable.');
            }
    }

    /**
     * @inheritDoc
     */
    public function fetchAll(){
        return call_user_func($this->yaml_parser, \file_get_contents($this->file));
    }
}
