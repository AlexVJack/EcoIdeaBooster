<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    #[Route('/test', name: 'test')]
    public function index()
    {
         return new Response(
             json_encode(['name' => 'John Doe']),
             Response::HTTP_OK,
             ['content-type' => 'application/json']
         );
    }
}
