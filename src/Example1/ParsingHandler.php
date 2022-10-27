<?php

declare(strict_types=1);

namespace Example1;

use Example1\Formatter\FormatterInterface;
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

    /** @var FormatterInterface */
    private $formatter;

    public function __construct(
        ParserInterface $parser,
        FormatterInterface $formatter
    ) {
        $this->parser = $parser;
        $this->formatter = $formatter;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $this->parser->parse(new Uri('some-url'));

        $formattedData = $this->formatter->format($data);

        return new JsonResponse($formattedData);
    }
}
