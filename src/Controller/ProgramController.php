<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
final class ProgramController extends AbstractController
{
    // TODO factorise function
    // private function noProgramFound(): self
    // {
    //     if (!$program) {
    //         throw $this->createNotFoundException(
    //             'No program with id : {id} found in program\'s table.'
    //         );
    //         // Generate a 404
    //     }

    //     return $this;
    // }

    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
            'programs' => $programs,
        ]);
    }

    #[Route('/show/{id<^[0-9]+$>}', name: 'show')]
    // public function show(int $id, ProgramRepository $programRepository): Response
    public function show(Program $program): Response
    {
        // $program = $programRepository->findOneBy(['id' => $id]);
        // same as $program = $programRepository->findOneBy($id);
        // same as $program = $programRepository->find($id);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : {id} found in program\'s table.'
            );
            // Generate a 404
        }
        $seasons = $program->getSeasons();


        return $this->render('program/show.html.twig', [
            'program'=>$program,
            'seasons'=>$seasons,
        ]);
    }

    #[Route('/{program}/season/{season}', name: 'season_show')]
    public function showSeason(Program $program, Season $season): Response
    {
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : {program} found in program\'s table.'
            );
            // Generate a 404
        }
        if (!$season) {
            throw $this->createNotFoundException(
                'No season with id : {season} found in this program\'s table.'
            );
            // Generate a 404
        }

        $episodes = $season->getEpisodes();

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episodes,
        ]);
    }

    #[Route('/{program}/season/{season}/episode/{episode}', name: 'episode_show')]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : {program} found in programs\'s table.'
            );
            // Generate a 404
        }
        if (!$season) {
            throw $this->createNotFoundException(
                'No season with id : {season} found in this program table.'
            );
            // Generate a 404
        }
        if (!$episode) {
            throw $this->createNotFoundException(
                'No episode with id : {episode} found in this season table.'
            );
            // Generate a 404
        }
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode,
        ]);
    }
}
