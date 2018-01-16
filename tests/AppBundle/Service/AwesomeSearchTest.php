<?php

namespace Tests\AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class AwesomeSearchTest extends WebTestCase {

    static public $container;
    static public $import;

    public function testCleanQuery(){

        $client = static::createClient();
        $search = $client->getContainer()->get("AppBundle\Service\AwesomeSearch");
        $query = "un mail";
        $result = $search->cleanQuery($query);
        $expected = array("mail");
        $this->assertEquals($expected, $result);
    }




}