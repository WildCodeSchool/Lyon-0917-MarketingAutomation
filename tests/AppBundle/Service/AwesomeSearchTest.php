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
        $query = "un megatest inutile sms";
        $emptyWords = array("un", "megatest", "inutile", "génial");
        $result = $search->cleanQuery($query, $emptyWords);
        $expected = array("sms");
        $this->assertEquals(count($expected), count($result));
    }

    public function testCutWords1(){
        $client = static::createClient();
        $search = $client->getContainer()->get("AppBundle\Service\AwesomeSearch");
        $query = "Ceci est une description qui fait plus de 160 caractères et l'objectif c'est de la couper proprement et d'ajouter les trois petits points à la fin. Voyons si cette méthode fonctionne comme on l'attend, quel suspens!";
        $result = $search->cutQuery($query, 160);
        $this->assertEquals("Ceci est une description qui fait plus de 160 caractères et l'objectif c'est de la couper proprement et d'ajouter les trois petits points à la fin. Voyons si cette …", $result);
    }

    public function testCutWords2(){
        $client = static::createClient();
        $search = $client->getContainer()->get("AppBundle\Service\AwesomeSearch");
        $query = "Ceci est une description de moins de 160 caractères";
        $result = $search->cutQuery($query, 160);
        $this->assertEquals($query, $result);
    }

}