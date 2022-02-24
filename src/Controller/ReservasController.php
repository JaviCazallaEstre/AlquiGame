<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Juego;
use App\Entity\Reservas;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservasController extends AbstractController
{
    #[Route('/reservas', name: 'reservas', methods: ["POST"])]
    public function index(Request $request, #[CurrentUser] ?User $user, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $data = $request->request;
        $arrayJuego = $doctrine->getRepository(Juego::class)->findGame($data->get('juego'));
        $juego = $doctrine->getRepository(Juego::class)->find($arrayJuego['id']);

        $fechaInicio = DateTime::createFromFormat('Y-m-d', $data->get('fecha_inicio'));
        $fechaFin = DateTime::createFromFormat('Y-m-d', $data->get('fecha_fin'));

        $reserva = new Reservas();
        $reserva->setFechaInicio($fechaInicio);
        $reserva->setFechaFin($fechaFin);
        $reserva->setPrecio($data->get('precio'));
        $reserva->setUsuario($user);
        $reserva->setJuego($juego);

        $entityManager->persist($reserva);
        $entityManager->flush();

        return $this->json([], Response::HTTP_OK);
    }

    #[Route('/reservas/currentuserid', name: 'currentuserid')]
    public function getLoggedUser(#[CurrentUser] ?User $user)
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'user'  => $user->getId()
        ], Response::HTTP_OK);
    }
}
