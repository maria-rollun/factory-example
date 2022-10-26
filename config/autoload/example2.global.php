<?php

declare(strict_types=1);

use Example1\Filter\StringToLower;
use Example1\Filter\StringToUpper;
use Example2\Parser\ParserAbstractFactory;
use Example2\ParsingHandlerAbstractFactory;
use Example2\Parser\CategoryParser;
use Example2\Parser\TitleParser;
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
    ParserAbstractFactory::class => [
        TitleParser::class => [
            ParserAbstractFactory::KEY_CLASS => TitleParser::class,
        ],
        CategoryParser::class => [
            ParserAbstractFactory::KEY_CLASS => CategoryParser::class,
        ],
    ],
    ParsingHandlerAbstractFactory::class => [
        'ParsingTitleUpper' => [
            ParsingHandlerAbstractFactory::KEY_PARSER => TitleParser::class,
            ParsingHandlerAbstractFactory::KEY_FILTER => StringToUpper::class,
        ],
        'ParsingCategoryLower' => [
            ParsingHandlerAbstractFactory::KEY_PARSER => CategoryParser::class,
            ParsingHandlerAbstractFactory::KEY_FILTER => StringToLower::class,
        ],
    ],
];
