<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GererSessionControllerTest extends WebTestCase
{
    public function testAjoutersession()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajouterSession');
    }

    public function testAffecteruser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/affecterUser');
    }

}
