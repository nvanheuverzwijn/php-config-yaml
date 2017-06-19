# Config

This library tries it's best to be lightweight and dependency free. The objective is to provide a standard configuration object, a pluggable  configuration source objects and a standard factory object to configure the configuration.

## Usage

The main way to instanciate a configuration object is via the ConfigFactory::fromArray static function. This function takes a simple array as a definition of the reader to use in order to generate a configuration object.

The array must respect the structure as shown below.
```
[
    'reader' => [
        [
            'class' => 'ClassName'
            'config' => 'argument passed to the constructor of ClassName'
        ],
        [...]
    ]
]
```

You can then pass this array to ConfigFactory::fromArray function.
```
$conf = \Zwijn\Config\ConfigFactory::fromArray($array);
```

## Build system requirements

You need [docker](https://www.docker.com/) and [GNU make](https://www.gnu.org/software/make/manual/make.html).

## Tests

Run below command

```
make test
```

## License

See the [license file](https://github.com/nvanheuverzwijn/php-config/blob/master/LICENSE).

## Acknowledgement

Inspiration for this library is taken from [Zend\Config](https://github.com/zendframework/zend-config). I encourage you to take a look at their software.
