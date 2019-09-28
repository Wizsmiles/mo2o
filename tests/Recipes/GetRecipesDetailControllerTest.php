<?php

namespace App\Tests\Recipes;

use App\Controller\Recipes\GetRecipesController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetRecipesDetailControllerTest extends WebTestCase
{

    public function testInvoke()
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/recipes/detail');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertNotNull($client->getResponse()->getContent());
    }
}
