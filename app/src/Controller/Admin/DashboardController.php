<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Block;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->redirect($this->container->get(\EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator::class)->setController(ArticleCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SAE 5012 - Backoffice');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToRoute('Retour au site', 'fa fa-arrow-left', 'app_home'); // On créera 'app_home' plus tard
        
        yield MenuItem::section('Gestion');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Articles', 'fa fa-newspaper', Article::class);
        yield MenuItem::linkToCrud('Blocs', 'fa fa-cubes', Block::class);
    }
}