<?php
/*
 * @license https://github.com/nvanheuverzwijn/php-config-yaml/blob/master/LICENSE
 */

namespace ZwijnTests\Config\Yaml;

use PHPUnit\Framework\TestCase;
use Zwijn\Config\Yaml;

class YamlTest extends TestCase
{

    private $yml_file = './tests/Fixture/test.yml';
    private $unreadable_file = '<=1dk';
    private $yaml_parse_function;
    private $uncallable_function = 'un-callable';

    public function setUp(){
        $this->yaml_parse_function = function($content){ return []; };
    }

    public function testNewYamlReaderWhenInvalidFileInput(){
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The file "'.$this->unreadable_file.'" is not readable.');
        new Yaml\Reader([
            'file' => $this->unreadable_file,
            'yaml_parser' => $this->yaml_parse_function
        ]);
    }

    public function testNewYamlReaderWithUncallableYamlParser(){
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The given yaml parser "'.$this->uncallable_function.'" is not callable.');
        new Yaml\Reader([
            'file' => $this->yml_file,
            'yaml_parser' => $this->uncallable_function,
        ]);
    }

    public function testNewYamlReaderWithUnspecifiedYamlParseAndYamlParseFunctionDoesNotExist(){
        if(\function_exists('yaml_parse')) {
            $this->markTestSkipped('Function "yaml_parse" is defined therefor, this test cannot work.');
        }
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('No "yaml_parser" provided.');
        new Yaml\Reader([
            'file' => $this->yml_file,
        ]);
    }

    public function testYamlReaderParseYamlWithSynfonyYaml(){
        $reader = new Yaml\Reader([
            'file' => $this->yml_file,
            'yaml_parser' => '\Symfony\Component\Yaml\Yaml::parse'
        ]);

        $array = $reader->fetchAll();

        $this->assertTrue(\is_array($array));
        $this->assertNotEmpty($array);
    }
}
