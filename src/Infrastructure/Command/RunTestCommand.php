<?php

namespace Arch\Infrastructure\Command;

use Arch\Application\Command\HelloWorld;
use Arch\Application\Middlewares\CommandBus;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

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
        $command = new HelloWorld('Hello world');
        $response = $this->commandBus->dispatch($command);
        return Command::SUCCESS;
    }
}
