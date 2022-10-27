<?php

declare(strict_types=1);

namespace Example2\Parser;

use Psr\Http\Message\UriInterface;

class ProductParser extends AbstractParser
{

    public function parse(UriInterface $url): string
    {
        /**
         * todo: actually parse url, for example:
         *
         * $html = $this->httpClient->send($url);
         * $dom = phpQuery::newDocument($html);
         * return $dom->find('div.product .title');
         */

        return 'Some Product Title';
    }
}
