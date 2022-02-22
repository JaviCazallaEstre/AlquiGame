<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapaNavegacionController extends AbstractController
{
    #[Route('/mapaNav', name: 'mapa_navegacion')]
    public function index(): Response
    {
        return $this->render('mapa_navegacion/index.html.twig', [
            'controller_name' => 'MapaNavegacionController',
        ]);
    }
}
