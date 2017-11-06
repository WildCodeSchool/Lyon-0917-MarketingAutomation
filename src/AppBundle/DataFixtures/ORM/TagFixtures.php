<?php

namespace AppBundle\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Tag;
use Faker;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create();

        for ($i = 1; $i < 6; $i++) {
            $tagTop = new Tag();
            $tagTop->setName('tag'.$i);
            $tagTop->setDescription($faker->paragraph($nbSentences = 1, $variableNbSentences = true));

            $manager->persist($tagTop);
            $this->addReference('tag'.$i, $tagTop);
        }
        $manager->flush();
    }
}