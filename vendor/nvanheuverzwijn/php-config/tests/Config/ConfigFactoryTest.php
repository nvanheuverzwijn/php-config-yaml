<?php
/*
 * @license https://github.com/nvanheuverzwijn/php-config/blob/master/LICENSE
 */

namespace ZwijnTests\Config;

use PHPUnit\Framework\TestCase;
use Zwijn\Config\Config;
use Zwijn\Config\ConfigFactory;
use Zwijn\Config\Exception;

class ConfigFactoryTest extends TestCase
{
    public function testFromArrayThrowInvalidArgumentWhenReaderKeyIsAbsent(){
        $this->expectException(\InvalidArgumentException::class);
        ConfigFactory::fromArray([]);
    }

    public function testFromArrayThrowInvalidArgumentWhenReaderKeyIsNotAndArray(){
        $this->expectException(\InvalidArgumentException::class);
        ConfigFactory::fromArray(['reader' => '']);
    }

    public function testFromArrayThrowInvalidArgumentWhenReaderKeyElementAreNotArray(){
        $this->expectException(\InvalidArgumentException::class);
        ConfigFactory::fromArray(['reader' => ['']]);
    }

    public function testFromArrayThrowInvalidArgumentWhenReaderKeyElementIsMissingClassKey(){
        $this->expectException(\InvalidArgumentException::class);
        ConfigFactory::fromArray(['reader' => [['']]]);
    }

    public function testFromArrayThrowInvalidArgumentWhenReaderKeyElementIsMissingConfigKey(){
        $this->expectException(\InvalidArgumentException::class);
        ConfigFactory::fromArray(['reader' => [['class' => '']]]);
    }

    public function testFromArrayThrowInvalidArgumentWhenReaderClassDoesNotImplementReaderInterface(){
        $this->expectException(\InvalidArgumentException::class);
        ConfigFactory::fromArray(['reader' => [
            [
                'class' => '\ZwijnTests\Config\Fixture\ReaderDoesNotImplementReaderInterface',
                'config' => ''
            ]
        ]]);
    }

    public function testGivenReaderThatReturnEmptyArrayFromArrayReturnsEmptyConfig(){
        $config = ConfigFactory::fromArray(['reader' => [
            [
                'class' => '\ZwijnTests\Config\Fixture\ReaderReturnEmptyConfig',
                'config' => ''
            ]
        ]]);

        $this->assertEmpty($config->toArray());
    }

    public function testGivenTwoReaderThatReturnItsOwnConfigFromArrayReturnsMergedConfigInOrder(){
        $config = ConfigFactory::fromArray(['reader' => [
            [
                'class' => '\ZwijnTests\Config\Fixture\ReaderReturnConstructArgumentAsConfig',
                'config' => ['1']
            ],
            [
                'class' => '\ZwijnTests\Config\Fixture\ReaderReturnConstructArgumentAsConfig',
                'config' => ['2']
            ],
        ]]);

        $this->assertNotEmpty($config[0]);
        $this->assertNotEmpty($config[1]);
        $this->assertEquals($config[0], '1');
        $this->assertEquals($config[1], '2');
    }
}
