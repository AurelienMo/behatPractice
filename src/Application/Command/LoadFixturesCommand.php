<?php

declare(strict_types=1);

/*
 * This file is part of behat
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\Command;

use Doctrine\ORM\EntityManagerInterface;
use Nelmio\Alice\Loader\NativeLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LoadFixturesCommand
 */
class LoadFixturesCommand extends Command
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var string */
    private $rootPathFixtures;

    /**
     * LoadFixturesCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param string                 $rootPathFixtures
     * @param null                   $name
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        string $rootPathFixtures,
        $name = null
    ) {
        $this->entityManager = $entityManager;
        $this->rootPathFixtures = $rootPathFixtures;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName('app:load-fixtures');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Start generate datas');
        $this->loadFixtures();
        $output->writeln('End generate datas');
    }

    /**
     * Load fixtures to database
     */
    private function loadFixtures()
    {
        $objectSet = $this->getLoader()->loadFile($this->rootPathFixtures.'/prod/00_load.yml');

        foreach ($objectSet->getObjects() as $object) {
            $this->entityManager->persist($object);
        }

        $this->entityManager->flush();
    }

    /**
     * @return NativeLoader
     */
    private function getLoader()
    {
        return new NativeLoader();
    }
}