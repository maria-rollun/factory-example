<?php

declare(strict_types=1);

namespace Example1;

use Example1\Parser\Parser;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Factory\AbstractFactoryInterface;
use Psr\Container\ContainerInterface;

class ParsingHandlerAbstractFactory implements AbstractFactoryInterface
{
    public const KEY = self::class;

    public const KEY_FORMATTER = 'formatter';

    public function canCreate(ContainerInterface $container, $requestedName)
    {
        $config = $container->get('config');

        if (!isset($config[self::KEY])) {
            return false;
        }

        $servicesConfig = $config[self::KEY];

        return is_array($servicesConfig) && array_key_exists($requestedName, $servicesConfig);
    }

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $container->get('config');

        if (!isset($config[self::KEY][$requestedName])) {
            throw new ServiceNotCreatedException("Can't find config");
        }

        $serviceConfig = $config[self::KEY][$requestedName];

        if (!isset($serviceConfig[self::KEY_FORMATTER])) {
            throw new ServiceNotCreatedException("Required config key 'formatter' is missing");
        }

        $formatter = $container->get($serviceConfig[self::KEY_FORMATTER]);

        $parser = $container->get(Parser::class);

        return new ParsingHandler($parser, $formatter);
    }
}
