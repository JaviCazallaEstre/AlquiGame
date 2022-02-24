<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Reservas;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlquileresController extends AbstractController
{
    #[Route('/alquileres', name: 'alquileres')]
    public function index(): Response
    {
        return $this->render('alquileres/index.html.twig', [
            'controller_name' => 'AlquileresController',
        ]);
    }
    #[Route('/alquileres/usuario', name: 'alquileresUsuario')]
    public function cogeAlquileresDeUsuario(#[CurrentUser] ?User $user, ManagerRegistry $doctrine): Response{
        $listaAlquileres = $doctrine->getRepository(Reservas::class)->findAlquileresByUser($user->getId());
        $alquileres = [];
        foreach ($listaAlquileres as $alquiler) {
            $alquileres[] = [
                'juego'=>$alquiler["nombre"],
                'fecha_inicio' => $alquiler["fecha_inicio"],
                'fecha_fin' => $alquiler["fecha_fin"],
                'precio'=> $alquiler["precio"],
                'fecha_devolucion'=>$alquiler["fecha_devolucion"]
                
            ];
        }
        return new JsonResponse($alquileres, Response::HTTP_OK);
    }
}
