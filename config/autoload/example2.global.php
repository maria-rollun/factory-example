<?php

declare(strict_types=1);

use Example1\Formatter\StringToLower;
use Example1\Formatter\StringToUpper;
use Example2\Parser\ParserAbstractFactory;
use Example2\ParsingHandlerAbstractFactory;
use Example2\Parser\CategoryParser;
use Example2\Parser\ProductParser;
use Laminas\Http\Client;

return [
    'dependencies' => [
        'aliases' => [
        ],
        'invokables' => [
            Client::class => Client::class,
        ],
        'factories' => [
        ],
        'abstract_factories' => [
            ParserAbstractFactory::class,
            ParsingHandlerAbstractFactory::class,
        ],
    ],
    ParserAbstractFactory::KEY => [
        ProductParser::class => [
            ParserAbstractFactory::KEY_CLASS => ProductParser::class,
        ],
        CategoryParser::class => [
            ParserAbstractFactory::KEY_CLASS => CategoryParser::class,
        ],
    ],
    ParsingHandlerAbstractFactory::KEY => [
        'ParsingProductUpper' => [
            ParsingHandlerAbstractFactory::KEY_PARSER => ProductParser::class,
            ParsingHandlerAbstractFactory::KEY_FORMATTER => StringToUpper::class,
        ],
        'ParsingCategoryLower' => [
            ParsingHandlerAbstractFactory::KEY_PARSER => CategoryParser::class,
            ParsingHandlerAbstractFactory::KEY_FORMATTER => StringToLower::class,
        ],
    ],
];
