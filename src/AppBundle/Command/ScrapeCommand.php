<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ScrapeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('scraper:populate')
            ->setDescription('Fetch instagram posts');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var \AppBundle\Service\InstagramService $insta */
        $insta = $this->getContainer()->get('instagram.service');

        $response = $insta->getTagMedia('bysann', 10);

        var_dump($response);

    }
}