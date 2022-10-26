<?php

declare(strict_types=1);

namespace Example1\Parser;

use Psr\Http\Message\UriInterface;

interface ParserInterface
{
    public function parse(UriInterface $url): string;
}
