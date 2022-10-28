<?php

declare(strict_types=1);

namespace Example2\Parser;

use Example1\Parser\ParserInterface;
use Laminas\Http\Client;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Factory\AbstractFactoryInterface;
use Psr\Container\ContainerInterface;

class ParserAbstractFactory implements AbstractFactoryInterface
{
    public const KEY = self::class;

    public const KEY_CLASS = 'class';

    private const DEFAULT_INTERFACE = ParserInterface::class;

    public function canCreate(ContainerInterface $container, $requestedName)
    {
        $config = $container->get('config');

        if (!isset($config[self::KEY])) {
            return false;
        }

        $servicesConfig = $config[self::KEY];

        if (!is_array($servicesConfig) || !array_key_exists($requestedName, $servicesConfig)) {
            return false;
        }

        return isset($servicesConfig[$requestedName][self::KEY_CLASS])
            && is_a($servicesConfig[$requestedName][self::KEY_CLASS], self::DEFAULT_INTERFACE, true);
    }

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $container->get('config');

        if (!isset($config[self::KEY][$requestedName])) {
            throw new ServiceNotCreatedException("Can't find config");
        }

        $serviceConfig = $config[self::KEY][$requestedName];

        if (!isset($serviceConfig[self::KEY_CLASS])) {
            throw new ServiceNotCreatedException("Required config key 'class' is missing");
        }

        $class = $serviceConfig[self::KEY_CLASS];

        $httpClient = $container->get(Client::class);

        return new $class($httpClient);
    }
}
