<?php

declare(strict_types=1);

namespace Example1\Parser;

use Psr\Http\Message\UriInterface;

class Parser implements ParserInterface
{
    public function parse(UriInterface $url): string
    {
        return 'Some Parsed Data'; // todo: actually parse url
    }
}
