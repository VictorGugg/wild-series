<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
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

        for ($i = 0; $i < 10; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name());
            $actorName = $actor->getName();
            // Get a random program from the const PROGRAMS
            $actor->addProgram(($this->getReference(
                'program_'
                . self::PROGRAMS[rand(0, count(self::PROGRAMS) -1)])));

            $actor->addProgram(($this->getReference(
                'program_'
                . self::PROGRAMS[rand(0, count(self::PROGRAMS) -1)])));

            $actor->addProgram(($this->getReference(
                'program_'
                . self::PROGRAMS[rand(0, count(self::PROGRAMS) -1)])));
                
            $this->addReference('actor_' . $actorName, $actor);
            $manager->persist($actor);
        }

        $manager ->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
