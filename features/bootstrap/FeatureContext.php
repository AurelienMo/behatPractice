<?php

use App\Domain\Model\User;
use Behat\Mink\Exception\ExpectationException;
use Behat\MinkExtension\Context\MinkContext;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
class FeatureContext extends MinkContext
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(
        KernelInterface $kernel,
        EntityManagerInterface $entityManager
    ) {
        $this->kernel = $kernel;
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $identifier
     *
     * @Then User :identifier should be exist into database
     *
     * @throws ExpectationException
     */
    public function userShouldBeExistIntoDatabase($identifier)
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => $identifier]);

        if (!$user) {
            throw new ExpectationException(
                sprintf('User with identifier %s should be exist', $identifier),
                $this->getSession()->getDriver()
            );
        }
    }
}
