<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    private SluggerInterface $slugger;

    const PROGRAMS = [
        'The Walking Dead' => 'Action',
        'Breaking Bad' => 'Drama',
        'Better Call Saul' => 'Drama',
        'Love, Death and Robots' => 'Animation',
        'Sense8' => 'Sci-Fi',
    ];

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        foreach (self::PROGRAMS as $programName => $programCategory) {
            $program = new Program();

            $program->setTitle($programName);

            $slug = $this->slugger->slug($programName);
            $program->setSlug($slug);

            $program->setSynopsis($faker->paragraphs(1, true));

            $program->setCategory($this->getReference('category_' . $programCategory));

            $this->addReference('program_' . $programName, $program);
            
            $manager->persist($program);
        }

        $manager->flush();
        
        // $program = new Program();
        // $program->setTitle('The Walking Dead');
        // $program->setSynopsis('Zombie apocalypse, humans have to survive, together as well as against each other.');
        // $program->setCategory($this->getReference('category_Action'));
        // $this->addReference('program_0', $program);
        // $manager->persist($program);

        // $program = new Program();
        // $program->setTitle('Breaking Bad');
        // $program->setSynopsis('High school teacher turns to drug manufacturing following his cancer diagnosis.');
        // $program->setCategory($this->getReference('category_Drama'));
        // $this->addReference('program_1', $program);
        // $manager->persist($program);

        // $program = new Program();
        // $program->setTitle('Better Call Saul');
        // $program->setSynopsis('Spin-off focusing on the lawyer character of Breaking Bad.');
        // $program->setCategory($this->getReference('category_Drama'));
        // $this->addReference('program_2', $program);
        // $manager->persist($program);

        // $program = new Program();
        // $program->setTitle('Love, Death and Robots');
        // $program->setSynopsis('Stand-alone episodes exploring a diversity of genres (mostly comedy, horror, science fiction and fantasy).');
        // $program->setCategory($this->getReference('category_Animation'));
        // $this->addReference('program_3', $program);
        // $manager->persist($program);

        // $program = new Program();
        // $program->setTitle('Sense8');
        // $program->setSynopsis('Random individuals from accross the globe get suddenly mentally and emotionally connected together.');
        // $program->setCategory($this->getReference('category_Sci-Fi'));
        // $this->addReference('program_4', $program);
        // $manager->persist($program);

        // $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CategoryFixtures::class,
        ];
    }


}