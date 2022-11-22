<?php
// src/Controller/ActorController.php
namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Program;
use App\Repository\ActorRepository;
use App\Repository\ProgramRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/actor', name: 'actor_')]
final class ActorController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ActorRepository $actorRepository): Response
    {
        $actors = $actorRepository->findAll();
        return $this->render('actor/index.html.twig', [
            'website' => 'Wild Series',
            'actors' => $actors,
        ]);
    }

    // #[Route('/new', name: 'new')]
    // public function new(Request $request, ProgramRepository $programRepository): Response
    // {
    //     $program = new Program();

    //     $form = $this->createForm(ProgramType::class, $program);

    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $programRepository->save($program, true);
    //         return $this->redirectToRoute('program_index');
    //     }

    //     return $this->renderForm('program/new.html.twig', [
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/{id}', name: 'show')]
    public function show(Actor $actor): Response
    {
        // $actor = $actorRepository->findOneBy(['id' => $id]);
        // same as $actor = $actorRepository->findOneBy($id);
        // same as $actor = $actorRepository->find($id);

        if (!$actor) {
            throw $this->createNotFoundException(
                'No actor with id : ' . $actor . ' found in actor\'s table.'
            );
            // Generate a 404
        }
        $programs = $actor->getPrograms();

        return $this->render('actor/show.html.twig', [
            'actor'=>$actor,
            'programs'=>$programs,
        ]);
    }
}
