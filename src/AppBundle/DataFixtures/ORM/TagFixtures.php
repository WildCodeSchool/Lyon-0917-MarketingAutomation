<?php

namespace AppBundle\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Tag;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tagTop = new Tag();
        $tagTop->setName('Top5');
        $tagTop->setDescription('les meilleurs logiciels');

        $manager->persist($tagTop);

        $manager->flush();

        $this->addReference('tag1', $tagTop);
    }
}