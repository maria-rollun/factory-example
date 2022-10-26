<?php

declare(strict_types=1);

namespace Example1;

use Example1\Filter\FilterInterface;
use Example1\Parser\ParserInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Uri;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ParsingHandler implements RequestHandlerInterface
{
    /** @var ParserInterface */
    private $parser;

    /** @var FilterInterface */
    private $filter;

    public function __construct(
        ParserInterface $parser,
        FilterInterface $filter
    ) {
        $this->parser = $parser;
        $this->filter = $filter;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $this->parser->parse(new Uri('some-url'));

        $filteredData = $this->filter->filter($data);

        return new JsonResponse($filteredData);
    }
}
