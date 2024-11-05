<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Entity\IngredientList;
use App\Entity\InstructionList;
use App\Entity\MeasuringUnit;
use App\Entity\Product;
use App\Entity\Recipe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(RecipeCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToCrud('Product', 'fa fa-tags', Product::class),
            MenuItem::linkToCrud('Ingredient', 'fa fa-file-text', Ingredient::class),
            MenuItem::linkToCrud('IngredientList', 'fa fa-user', IngredientList::class),
            MenuItem::linkToCrud('InstructionList', 'fa fa-user', InstructionList::class),
            MenuItem::linkToCrud('MeasuringUnit', 'fa fa-user', MeasuringUnit::class),
            MenuItem::linkToCrud('Recipe', 'fa fa-user', Recipe::class)
        ];
    }
}
