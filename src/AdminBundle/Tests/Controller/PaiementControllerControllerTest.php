<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PaiementControllerControllerTest extends WebTestCase
{
    public function testAfficherpaiement()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/paiement');
    }

    public function testEditpaiement()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/edit');
    }

}
