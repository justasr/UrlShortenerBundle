<?php

namespace UrlShortenerBundle\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class ShortenLinksCleanupCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('nfq:shorten-links-cleanup')
            ->setDescription('Shorten Links Cleanup');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Start");

        $stopwatch = new Stopwatch();
        $stopwatch->start('ShortenLinksCleanupCommand');

        /** @var EntityManager $em */
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $em->createQuery('DELETE FROM UrlShortenerBundle:ShortLink')->execute();
        $output->writeln("Done");

        $endStopWatch = $stopwatch->stop('ShortenLinksCleanupCommand');
        $output->writeln("Update took:" . $endStopWatch->getEndTime());
    }
}