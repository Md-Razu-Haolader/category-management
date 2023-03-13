<?php

declare(strict_types=1);

namespace App\Proxies;

abstract class Proxy
{
    /**
     * Handle dynamic, static calls to the object.
     *
     * @return mixed
     *
     * @throws \RuntimeException
     */
    public static function __callStatic(string $method, array $args)
    {
        $className = static::getProxyAccessor();
        if (!method_exists($className, $method)) {
            throw new \RuntimeException('Proxy instance not found');
        }

        return $className->$method(...$args);
    }
}
