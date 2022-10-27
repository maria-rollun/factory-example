<?php

declare(strict_types=1);

namespace Example2;

use Example1\ParsingHandler;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Factory\AbstractFactoryInterface;
use Psr\Container\ContainerInterface;

class ParsingHandlerAbstractFactory implements AbstractFactoryInterface
{
    public const KEY_PARSER = 'parser';

    public const KEY_FORMATTER = 'formatter';

    public function canCreate(ContainerInterface $container, $requestedName)
    {
        $config = $container->get('config');

        if (!isset($config[self::class])) {
            return false;
        }

        $servicesConfig = $config[self::class];

        return is_array($servicesConfig) && array_key_exists($requestedName, $servicesConfig);
    }

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $container->get('config');

        if (!isset($config[self::class][$requestedName])) {
            throw new ServiceNotCreatedException("Can't find config");
        }

        $serviceConfig = $config[self::class][$requestedName];

        if (!isset($serviceConfig[self::KEY_PARSER], $serviceConfig[self::KEY_FORMATTER])) {
            throw new ServiceNotCreatedException("Required config key is missing");
        }

        $formatter = $container->get($serviceConfig[self::KEY_FORMATTER]);

        $parser = $container->get($serviceConfig[self::KEY_PARSER]);

        return new ParsingHandler($parser, $formatter);
    }
}
