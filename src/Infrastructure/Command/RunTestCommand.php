<?php

namespace Arch\Infrastructure\Command;

use Arch\Application\CommandBus;
use Arch\Application\MiddlewaresResolver;
use Arch\Domain\Exception\DomainEntityException;
use Arch\Domain\Exception\EntityNotFoundException;
use Arch\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RunTestCommand extends Command
{
    protected static $defaultName = 'arch:run-test';
    protected static $defaultDescription = 'Run test command';

    /**
     * RunTestCommand constructor.
     * @param string|null $name
     */
    public function __construct( string $name = null)
    {
        parent::__construct(self::$defaultName);
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
        return Command::SUCCESS;
    }
}
