<?php
declare(strict_types=1);

namespace Liox\B2B\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testPageCanBeRenderedWithoutLogin(): void
    {
        $client = self::createClient();

        $client->request('GET', '/login');

        self::assertResponseIsSuccessful();
    }

    public function testLoggedInUserWillBeRedirected(): void
    {
    }
}
