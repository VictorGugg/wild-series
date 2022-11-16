<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $program = new Program();
        $program->setTitle('The Walking Dead');
        $program->setSynopsis('Zombie apocalypse');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Breaking Bad');
        $program->setSynopsis('High school teacher turns to drug manufacturing following his cancer diagnosis.');
        $program->setCategory($this->getReference('category_Drama'));
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Better Call Saul');
        $program->setSynopsis('Spin-off focusing on the lawyer character of Breaking Bad');
        $program->setCategory($this->getReference('category_Drama'));
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Love, Death and Robots');
        $program->setSynopsis('Stand-alone episodes exploring a diversity of genres (mostly comedy, horror, science fiction and fantasy).');
        $program->setCategory($this->getReference('category_Animation'));
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Sense8');
        $program->setSynopsis('Random individuals from accross the globe get suddenly mentally and emotionally connected together.');
        $program->setCategory($this->getReference('category_Sci-Fi'));
        $manager->persist($program);

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CategoryFixtures::class,
        ];
    }


}