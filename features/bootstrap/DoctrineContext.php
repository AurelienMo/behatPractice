<?php

declare(strict_types=1);

/*
 * This file is part of behatPractice
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use App\Domain\Model\User;
use Behat\Behat\Context\Context;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\ToolsException;
use Nelmio\Alice\Loader\NativeLoader;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * Class DoctrineContext
 */
class DoctrineContext implements Context
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    /**
     * DoctrineContext constructor.
     *
     * @param EntityManagerInterface       $entityManager
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @BeforeScenario
     *
     * @throws ToolsException
     */
    public function clearDatabase()
    {
        $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($this->entityManager);
        $schemaTool->dropSchema($this->entityManager->getMetadataFactory()->getAllMetadata());
        $schemaTool->createSchema($this->entityManager->getMetadataFactory()->getAllMetadata());
    }

    /**
     * @Given I load following fixture file :arg1
     */
    public function iLoadFollowingFixtureFile($arg1)
    {
        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(__DIR__.'/../fixtures/'.$arg1);
        foreach ($objectSet->getObjects() as $object) {
            if ($object instanceof User) {
                $user = new User(
                    $object->getUsername(),
                    $object->getEmail(),
                    $this->passwordEncoder->encodePassword($object, $object->getPassword())
                );
                $this->entityManager->persist($user);
            } {
                $this->entityManager->persist($object);
            }
        }

        $this->entityManager->flush();
    }

}
