<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GraphControllerTest extends WebTestCase
{
    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/show');
    }

}
