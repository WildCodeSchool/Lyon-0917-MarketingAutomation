<?php


namespace Tests\AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SlugificationTest extends WebTestCase
{

    static public $container;
    static public $import;

    public function testConvertToBool(){

        $client = static::createClient();
        $slugificator = $client->getContainer()->get("AppBundle\Service\Slugification");

        $value = "Lead Marketing Logiciel";
        $result = $slugificator->slugFactory($value);
        $this->assertEquals($result, "lead-marketing-logiciel");


    }

}