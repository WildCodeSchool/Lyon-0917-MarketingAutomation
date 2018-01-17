<?php

namespace Tests\AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class AwesomeSearchTest extends WebTestCase {

    static public $container;
    static public $import;

    public function testCleanQuery1(){

        $client = static::createClient();
        $search = $client->getContainer()->get("AppBundle\Service\AwesomeSearch");
        $query = "un megatest mail";
        $emptyWords = array("un", "megatest", "inutile", "génial");
        $result = $search->cleanQuery($query, $emptyWords);
        $expected = array("mail");
        $this->assertEquals(count($expected), count($result));
    }

    public function testCleanQuery2(){

        $client = static::createClient();
        $search = $client->getContainer()->get("AppBundle\Service\AwesomeSearch");
        $query = "un logiciel mail";
        $result = $search->cleanQuery($query);
        $expected = array("logiciel", "mail");
        $this->assertEquals(count($expected), count($result));
    }

}