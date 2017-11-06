<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Software;
use Faker;



class SoftwareFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create();
        $faker->seed(12345);

        for ($i = 0; $i < 20; $i++)
        {
            $software = new Software();
            $software->setName($faker->jobTitle);
            $software->setCompany($faker->company);
            $software->setShortDescription($faker->paragraph($nbSentences = 1, $variableNbSentences = true));

            $software->setLogo($faker->imageUrl($width = 250, $height = 250));
            $software->setLongDescription($faker->paragraph($nbSentences = 3, $variableNbSentences = true));
            $software->setRate(mt_rand(0, 5));
            $software->setIsFree(mt_rand(0, 1));
            $software->setPrice(mt_rand(0, 5));
            $software->addTag($this->getReference('tag' . mt_rand(1,5)));
            $software->setLanguages('Fr');
            $software->setUrl($faker->url);

            $manager->persist($software);
        }
        $manager->flush();

    }

    public function getDependencies()
    {
        return array(
            TagFixtures::class,
        );
    }
}