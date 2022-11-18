<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        'The Walking Dead',
        'Breaking Bad',
        'Better Call Saul',
        'Love, Death and Robots',
        'Sense8',
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

    foreach (self::PROGRAMS as $key => $programName) {
        for ($s = 1; $s <= 5; $s++) {
            for ($i = 1; $i <= 10; $i++) {
                $episode = new Episode();
                $episode->setTitle($faker->words(2, true));
                $episode->setNumber($i);
                $episode->setSynopsis($faker->paragraphs(3, true));
                $episode->setSeason($this->getReference($programName . 'season_' . $s));

                $manager->persist($episode);
            }
        }
    }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
