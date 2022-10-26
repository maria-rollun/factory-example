<?php

declare(strict_types=1);

use Example1\Filter\StringToLower;
use Example1\Filter\StringToUpper;
use Example1\Parser\Parser;
use Example1\ParsingHandlerAbstractFactory;

return [
    'dependencies' => [
        'aliases' => [
        ],
        'invokables' => [
            StringToLower::class => StringToLower::class,
            StringToUpper::class => StringToUpper::class,
            Parser::class => Parser::class,
        ],
        'factories' => [
        ],
        'abstract_factories' => [
            ParsingHandlerAbstractFactory::class,
        ],
    ],
    ParsingHandlerAbstractFactory::class => [
        'ParsingUpper' => [
            ParsingHandlerAbstractFactory::KEY_FILTER => StringToUpper::class,
        ],
        'ParsingLower' => [
            ParsingHandlerAbstractFactory::KEY_FILTER => StringToLower::class,
        ],
    ],
];
