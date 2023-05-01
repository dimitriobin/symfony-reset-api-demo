<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorController extends AbstractController
{
    #[Route('/api/authors', name: 'author', methods: ['GET'])]
    public function getAuthorList(AuthorRepository $authorRepository, SerializerInterface $serializerInterface): JsonResponse
    {
        $authorList = $authorRepository->findAll();
        $jsonAuthorList = $serializerInterface->serialize($authorList, 'json', ['groups' => 'getAuthors']);

        return new JsonResponse($jsonAuthorList, Response::HTTP_OK, [], true);
    }

    #[Route('/api/authors/{id}', name: 'detailAuthor', methods: ['GET'])]
    public function getDetailAuthor(int $id, SerializerInterface $serializer, AuthorRepository $authorRepository): JsonResponse
    {
        $author = $authorRepository->find($id);
        if ($author) {
            $jsonAuthor = $serializer->serialize($author, 'json', ['groups' => 'getAuthors']);
            return new JsonResponse($jsonAuthor, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}
