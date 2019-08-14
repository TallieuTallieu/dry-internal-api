<?php

namespace Tnt\InternalApi\Console;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;
use Tnt\InternalApi\Facade\Api;

/**
 * Class ListCmd
 * @package Tnt\InternalApi\Console
 */
class ListCmd extends Command
{
	protected function createSignature(Signature $signature): Signature
	{
		return $signature
			->setName('list')
			->setDescription('List all registered routes on the internal API')
			;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$allRoutes = Api::getRoutes();

		$output->writeLine(
			str_pad('METHOD', 20).
			str_pad('PATTERN', 60).
			'CONTROLLER', OutputInterface::TYPE_INFO);

		foreach ($allRoutes as $method => $routes) {
			foreach ($routes as $pattern => $controller) {
				$output->writeLine(
					str_pad($method, 20).
					str_pad($pattern, 60).
					$controller
				);
			}
		}
	}
}