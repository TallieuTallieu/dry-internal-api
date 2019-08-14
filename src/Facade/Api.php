<?php

namespace Tnt\InternalApi\Facade;

use Oak\Facade;
use Tnt\InternalApi\Router\Router;

class Api extends Facade
{
	protected static function getContract(): string
	{
		return Router::class;
	}
}