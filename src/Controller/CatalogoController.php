<?php

namespace App\Controller;

use App\Entity\Juego;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CatalogoController extends AbstractController
{
    #[Route('/catalogo', name: 'catalogo')]
    public function index(): Response
    {
        return $this->render('catalogo/index.html.twig', [
            'controller_name' => 'CatalogoController',
        ]);
    }


    #[Route('/catalogo/get', name: 'getCatalogo')]
    public function getCatalogo(ManagerRegistry $doctrine): Response
    {
        $catalogo = $doctrine->getRepository(Juego::class)->findAllGames();
        $juegos = [];
        foreach ($catalogo as $juego) {
            $juegos[] = [
                'id' => $juego["id"],
                'nombre' => $juego["nombre"],
                'foto' => $juego["foto"],
                'precio' => $juego["precio"],
                'plataforma' => $juego["plataforma"],
                'idPlataforma' => $juego["plataforma_id"],
                'idRangoEdad' => $juego["rango_edad_id"],
                'idDesarrolladora' => $juego["desarrolladora_id"],
                'idsGeneros' => $juego["generos_id"]
            ];
        }
        return new JsonResponse($juegos, Response::HTTP_OK);
    }
    #[Route('/catalogo/juego/{id}', name: 'getJuego')]
    public function findGamebyId(string $id, ManagerRegistry $doctrine): Response
    {
        $juego = $doctrine->getRepository(Juego::class)->findGame($id);
        if (!$juego) {
            throw $this->createNotFoundException("El juego que has pedido no existe");
        } else {
            $response = array(
                "code" => 200,
                "response" => $this->render('detalles/index.html.twig', [
                    'juego' => $juego,
                ])->getContent()
            );
            return new Response(json_encode($response));
        }
    }
}
