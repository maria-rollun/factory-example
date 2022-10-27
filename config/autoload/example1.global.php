<?php

declare(strict_types=1);

use Example1\Formatter\StringToLower;
use Example1\Formatter\StringToUpper;
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
    ParsingHandlerAbstractFactory::KEY => [
        'ParsingUpper' => [
            ParsingHandlerAbstractFactory::KEY_FORMATTER => StringToUpper::class,
        ],
        'ParsingLower' => [
            ParsingHandlerAbstractFactory::KEY_FORMATTER => StringToLower::class,
        ],
    ],
];
