<?php
declare(strict_types=1);

namespace Liox\B2B\Console;

use Liox\B2B\Message\RegisterUser;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'liox:user:register')]
final class RegisterUserConsoleCommand extends Command
{
    private const ARGUMENT_USERNAME = 'username';
    private const ARGUMENT_PASSWORD = 'plainTextPassword';

    public function __construct(
        private readonly MessageBusInterface $bus,
    ) {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this->addArgument(self::ARGUMENT_USERNAME, InputArgument::REQUIRED);

        $this->addArgument(self::ARGUMENT_PASSWORD, InputArgument::REQUIRED);
    }


    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = $input->getArgument(self::ARGUMENT_USERNAME);
        assert(is_string($username));

        $plainTextPassword = $input->getArgument(self::ARGUMENT_PASSWORD);
        assert(is_string($plainTextPassword));

        $this->bus->dispatch(
            new RegisterUser($username, $plainTextPassword),
        );

        $output->writeln('<info>User created</info>');

        return self::SUCCESS;
    }
}
