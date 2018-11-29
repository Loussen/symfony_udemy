<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 11/28/2018
 * Time: 4:34 PM
 */

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MyCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:Hello')
            ->setDescription('Give me Hello message')
            ->setHelp('php bin/console app:Hello or a:h')
            ->addArgument('surname',InputArgument::REQUIRED)
            ->addArgument('names',InputArgument::IS_ARRAY)
            ->addOption('old','o',InputOption::VALUE_REQUIRED,'How old are you?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input,$output);

        $io->title('My name is title!');

        $io->ask('salam');

        if($io->confirm('Delete all?'))
            $output->writeln('yes');
        else
            $output->writeln('noo');
    }
}