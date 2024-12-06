<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageHomeController extends AbstractController
{
    #[Route('/page/home', name: 'app_page_home')]
    public function index(): Response
    {
        return $this->render('page_home/index.html.twig', [
            'controller_name' => 'PageHomeController',
        ]);
    }
}
