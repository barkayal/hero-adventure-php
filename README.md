# Hero Adventure

## install instructions
```shell script
$> php composer.phar install
$> php composer.phar dump-autoload
$> chmod +x ./bin/run-adventure
```

## running the application
```shell script
$> ./bin/run-adventure
```

## running and viewing the tests
```shell script
$> ./vendor/bin/phpunit -c phpunit.xml tests --coverage-html coverage/
```
