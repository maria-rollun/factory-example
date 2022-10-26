<?php

declare(strict_types=1);

namespace Example2\Parser;

use Example1\Parser\ParserInterface;
use Laminas\Http\Client;

abstract class AbstractParser implements ParserInterface
{
    /** @var Client */
    private $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }
}
