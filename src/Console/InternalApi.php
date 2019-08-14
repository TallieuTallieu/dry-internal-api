<?php

namespace Tnt\InternalApi\Console;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;

class InternalApi extends Command
{
	protected function createSignature(Signature $signature): Signature
	{
		return $signature
			->setName('internal-api')
			->addSubCommand(new ListCmd())
			;
	}
}