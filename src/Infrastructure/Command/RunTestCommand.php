<?php

namespace Arch\Infrastructure\Command;

use Arch\Application\CommandBus;
use Arch\Application\MiddlewaresResolver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RunTestCommand extends Command
{
    protected static $defaultName = 'app:run-test';
    protected static $defaultDescription = 'Run test command';
    /**
     * The command bus to dispatch the command to
     *
     * @var CommandBus
     */
    private $commandBus;
    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;
    /**
     * @var MiddlewaresResolver
     */
    private MiddlewaresResolver $middlewaresResolver;

    /**
     * RunTestCommand constructor.
     * @param CommandBus $commandBus
     * @param string|null $name
     */
    public function __construct(CommandBus $commandBus, string $name = null)
    {
        parent::__construct(self::$defaultName);
        $this->commandBus = $commandBus;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        dump('hi there!');
        return Command::SUCCESS;
    }
}
