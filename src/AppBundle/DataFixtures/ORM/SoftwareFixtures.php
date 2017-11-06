<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Software;



class SoftwareFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $software = new Software();
        $software->setName('MailChimp');
        $software->setCompany('Chimpito');
        $software->setLogo('http://www.webrankinfo.com/dossiers/wp-content/uploads/google-logo-carre-2015-09-400.png');
        $software->setShortDescription("C'est un logiciel qui permet d'envoyer des mails, c'est très pratique");
        $software->setLongDescription("A brain that automatically helps you find and connect with your audience so you can build your brand and sell more stuff. Activating your MailChimp brain is free and easy. Explore 10 of our most powerful automations that handle the marketing stuff so you can focus on the rest of your business.");
        $software->setRate(4);
        $software->setIsFree(0);
        $software->setPrice(10);
        $software->addTag($this->getReference('tag1'));
        $software->setLanguages('Fr');
        $software->setUrl('mailchimp.com');


        $manager->persist($software);


        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            TagFixtures::class,
        );
    }
}