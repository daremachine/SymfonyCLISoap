<?php
declare(strict_types=1);

namespace UkLocation\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Style\SymfonyStyle;
use UkLocation\Exceptions\IException;
use UkLocation\SoapClient;

class GetUKLocationByTownsCommand extends Command
{
    protected function configure()
    {
        $this->setName("UkLocation:GetUKLocationByTowns")
            ->setDescription("Get UK postcodes for towns.")
            ->addArgument('Towns', InputArgument::IS_ARRAY, 'Town names for search.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output = new SymfonyStyle($input, $output);

        $towns = $input->getArgument('Towns');

        try {
            $soapClient = new SoapClient();
            $data = $soapClient->GetUkLocationByTown($towns);

            // print output
            $output->success("Search complete.");

            foreach ($data as $postcode)
            {
                $output->writeln($postcode);
            }
        } catch(IException $e) {
            $output->write("<error>{$e->getMessage()}</error>");
        }        
    }
}