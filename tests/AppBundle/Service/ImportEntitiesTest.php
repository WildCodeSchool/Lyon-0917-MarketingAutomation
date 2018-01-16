<?php

namespace Tests\AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ImportEntitiesTest extends WebTestCase
{

    static public $container;
    static public $import;

    public function testConvertToBool(){

        $client = static::createClient();
        $import = $client->getContainer()->get("AppBundle\Service\ImportEntities");

        $value = "oui";
        $result = $import->convertToBool($value);
        $this->assertEquals(true, $result);

    }
}