<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class List2Controller extends AbstractController
{
    #[Route('/list2', name: 'app_list2')]
    public function index(): Response
    {
        return $this->render('list2/index.html.twig', [
            'controller_name' => 'List2Controller',
        ]);
    }
}
