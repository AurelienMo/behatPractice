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

use Behat\Gherkin\Node\PyStringNode;
use Behatch\Context\RestContext;

/**
 * Class CustomRestContext
 */
class CustomRestContext extends RestContext
{
    /**
     * @When After authentication on url :arg1 with method :arg2 as user :arg3 with password :arg4, I send a :arg5 request to :arg6 with body:
     */
    public function afterAuthenticationOnUrlWithMethodAsUserWithPasswordISendARequestToWithBody(
        $arg1,
        $arg2,
        $arg3,
        $arg4,
        $arg5,
        $arg6,
        PyStringNode $string
    ) {
        $requestLogin = $this->request->send(
            $arg2,
            $this->locatePath($arg1),
            [],
            [],
            json_encode([
                'username' => $arg3,
                'password' => (string) $arg4,
            ]),
            ['CONTENT_TYPE' => 'application/json']
        );

        $datas = json_decode($requestLogin->getContent(), true);
        $response = $this->request->send(
            $arg5,
            $this->locatePath($arg6),
            [],
            [],
            $string !== null ? $string->getRaw() : null,
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_Authorization' => sprintf('Bearer %s', $datas['token'])
            ]
        );

        return $response;
    }

}
