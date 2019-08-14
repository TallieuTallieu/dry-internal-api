<?php

namespace Tnt\InternalApi;

use dry\route\Router;
use Oak\Console\Facade\Console;
use Oak\Contracts\Container\ContainerInterface;
use Oak\ServiceProvider;
use Tnt\InternalApi\Console\InternalApi;
use Tnt\InternalApi\Router\Router as ApiRouter;

class InternalApiServiceProvider extends ServiceProvider
{
	public function boot(ContainerInterface $app)
	{
		Router::register([
			'internal-api/(?<path>.+)/' => '\\Tnt\\InternalApi\\Facade\\Api::route',
		]);

		Console::registerCommand(InternalApi::class);
	}

	public function register(ContainerInterface $app)
	{
		$app->singleton(ApiRouter::class, ApiRouter::class);

		// Console
		$app->set(InternalApi::class, InternalApi::class);
	}
}