<?php

namespace Tnt\InternalApi\Facade;

use Oak\Facade;
use Tnt\InternalApi\Router\Router;

/**
 * @method static void get(string $pattern, callable $controller)
 * @method static void post(string $pattern, callable $controller)
 * @method static void put(string $pattern, callable $controller)
 * @method static void delete(string $pattern, callable $controller)
 * @method static array getRoutes()
 * @method static void route(\dry\http\Request $request)
 *
 * @see Router
 */
class Api extends Facade
{
    protected static function getContract(): string
    {
        return Router::class;
    }
}

