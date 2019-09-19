<?php

namespace Tnt\InternalApi\Console;

use Oak\Contracts\Container\ContainerInterface;
use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;
use Tnt\InternalApi\Facade\Api;
use Tnt\ConsoleTable\Table;

/**
 * Class ListCmd
 * @package Tnt\InternalApi\Console
 */
class ListCmd extends Command
{
    /**
     * @var Table $table
     */
    private $table;

    /**
     * ListCmd constructor.
     * @param ContainerInterface $app
     * @param Table $table
     */
    public function __construct(ContainerInterface $app, Table $table)
    {
        $this->table = $table;

        parent::__construct($app);
    }

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

        $this->table->setHeader(['Method', 'Pattern', 'Controller',]);

        $output->writeLine(
            str_pad('METHOD', 20).
            str_pad('PATTERN', 60).
            'CONTROLLER', OutputInterface::TYPE_INFO);

        foreach ($allRoutes as $method => $routes) {
            foreach ($routes as $pattern => $controller) {

                $this->table->addRow([$method, $pattern, $controller,]);
            }
        }

        $this->table->output();
    }
}