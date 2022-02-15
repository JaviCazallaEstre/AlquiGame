<?php

namespace App\Controller\Admin;

use App\Entity\Desarrolladora;
use App\Entity\Genero;
use App\Entity\Juego;
use App\Entity\Plataforma;
use App\Entity\RangoEdad;
use App\Entity\Reservas;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('AlquiGame');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('AlquiGame', 'fa fa-home');
        yield MenuItem::linkToCrud('Plataforma', 'fas fa-list', Plataforma::class);
        yield MenuItem::linkToCrud('Usuarios', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Juegos', 'fas fa-list', Juego::class);
        yield MenuItem::linkToCrud('Generos', 'fas fa-list', Genero::class);
        yield MenuItem::linkToCrud('Rando de edad', 'fas fa-list', RangoEdad::class);
        yield MenuItem::linkToCrud('Reservas', 'fas fa-list', Reservas::class);
        yield MenuItem::linkToCrud('Desarrolladora', 'fas fa-list', Desarrolladora::class);
    }
}
