# Примеры абстрактных фабрик laminas

## Example 1

Фабрика создает объекты типа ParsingHandler, у которого есть 2 зависимости - parser и formatter.

Фабрика сделана так, что parser будет одинаковым для всех созданных объектов, а formatter - разным. Т.к. parser одинаковый, мы его вообще не упоминаем в конфигах, и просто достаем его из сервис-контейнера внутри фабрики:

```php
$parser = $container->get(Parser::class);
```

С форматером же другая история: т.к. он будет варьироваться, то мы должны передать его через конфиг для каждого создаваемого сервиса:

```php
    ParsingHandlerAbstractFactory::KEY => [
        'ParsingUpper' => [
            ParsingHandlerAbstractFactory::KEY_FORMATTER => StringToUpper::class,
        ],
        'ParsingLower' => [
            ParsingHandlerAbstractFactory::KEY_FORMATTER => StringToLower::class,
        ],
    ],
```

## Example 2

Отличие от первого примера в том, что тут фабрика может создавать объекты нескольких разных классов.

Мы создали ProductParser и CategoryParser, которые реализуют интерфейс ParserInterface. У них есть одна зависимость - httpClient. 

Т.к. зависимость одна и та же, просто разные классы, то можно создать фабрику вроде ParserAbstractFactory, которая

1. берет нужный класс из конфига,
2. проверяет, что он реализует допустимый интерфейс,
3. создает объект этого класса, заполняя его зависимость дефолтным значением.

Т.к. теперь у нас несколько парсеров, то в ParsingHandlerAbstractFactory можно добавить еще один ключ конфига, и сделать parser тоже настраиваемым полем.
