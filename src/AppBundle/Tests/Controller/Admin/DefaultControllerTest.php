<?php

namespace AppBundle\Tests\Controller\Admin;

use AppBundle\Tests\Phpunit\DatabaseTestCase;
use AppBundle\Tests\Phpunit\Extension\AuthenticationExtensionTrait;
use AppBundle\Tests\Phpunit\Extension\RepositoryExtensionTrait;

class DefaultControllerTest extends DatabaseTestCase
{
    use AuthenticationExtensionTrait;
    use RepositoryExtensionTrait;

    public function testShouldLoadIndexPage()
    {
        $this->authenticateUser(
            $this->getUserRepository()->findOneBy(['email' => 'learner@example.com']),
            ['ROLE_ADMIN']
        );

        $client = static::$client;

        $crawler = $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('html:contains("Kompisbyrån")')->count() > 0);
    }
}
