# php-config-yaml
A yaml configuration parser. This is part of a larger configuration library found [here](https://github.com/nvanheuverzwijn/php-config).

## Usage

This yaml reader accept a configuration array as an argument. It supports two key: `file` to specify a yml file to read and `yaml_parser` to specify a callable function that parse yaml.

Directly using this reader like this.
```
$reader = new Yaml\Reader([
    'file' => '/some/file.yml',
    'yaml_parser' => '\Symfony\Component\Yaml\Yaml::parse'
]);
$array = $reader->fetchAll();
```

Use this reader with `\Zwijn\Config`.
```
$conf = \Zwijn\Config\ConfigFactory::fromArray([
    'reader' => [
        [
            'class' => '\Zwijn\Config\Yaml\Reader'
            'config' => [
                'file' => '/some/file.yml',
                'yaml_parser' => '\Symfony\Component\Yaml\Yaml::parse'
            ]
        ]
    ]
]);
```

## Dependency
`make composer`

## Test
`make test`
