<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Repository\IdeaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class IdeaController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/ideas', name: 'ideas')]
    public function index(IdeaRepository $ideaRepository): JsonResponse
    {
        $ideas = $ideaRepository->findAll();
        return $this->json($ideas);
    }

    #[Route('/ideas/{id}', name: 'idea')]
    public function show(Idea $idea): JsonResponse
    {
        return $this->json($idea);
    }

    #[Route('/ideas', name: 'create_idea', methods: ['POST'])]
    public function create(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $idea = new Idea();
        $data = json_decode($request->getContent(), true);

        $idea->setName($data['name'] ?? '');
        $idea->setAuthor($data['author'] ?? '');
        $idea->setShortDescription($data['shortDescription'] ?? '');
        $idea->setLongDescription($data['longDescription'] ?? null);
        $idea->setVotes($data['votes'] ?? null);

        $errors = $validator->validate($idea);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        $entityManager = $this->doctrine->getManager();
        $entityManager->persist($idea);
        $entityManager->flush();

        return $this->json($idea, Response::HTTP_CREATED);
    }

    #[Route('/ideas/{id}', name: 'update_idea', methods: ['PUT'])]
    public function update(Request $request, Idea $idea, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (isset($data['name'])) {
            $idea->setName($data['name']);
        }

        if (isset($data['author'])) {
            $idea->setAuthor($data['author']);
        }

        if (isset($data['shortDescription'])) {
            $idea->setShortDescription($data['shortDescription']);
        }

        if (isset($data['longDescription'])) {
            $idea->setLongDescription($data['longDescription']);
        }

        if (isset($data['votes'])) {
            $idea->setVotes($data['votes']);
        }

        $errors = $validator->validate($idea);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        $entityManager = $this->doctrine->getManager();
        $entityManager->persist($idea);
        $entityManager->flush();

        return $this->json($idea);
    }

    #[Route('/ideas/{id}', name: 'delete_idea', methods: ['DELETE'])]
    public function delete(Idea $idea): JsonResponse
    {
        $entityManager = $this->doctrine->getManager();
        $entityManager->remove($idea);
        $entityManager->flush();

        return $this->json('Idea deleted successfully');
    }
}
