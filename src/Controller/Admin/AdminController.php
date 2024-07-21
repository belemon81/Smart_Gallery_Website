<?php

namespace App\Controller\Admin;

use App\Entity\Artwork;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Like;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ArtworkCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<a href="gallery" style="padding-top:0;">
                            <img src="/images/favicon.png" alt="Logo" style="width:30px;height:auto;padding:0;"
                            >&nbsp;&nbsp;SMART GALLERY
                        </a>')
            ->setFaviconPath('/images/favicon.png');
        }

    public function configureMenuItems(): iterable
    { 
        //MOD + ADMIN FIELD
        yield MenuItem::linkToDashboard('Manage artworks', 'fa fa-picture-o');
              MenuItem::linkToCrud('Manage artworks', 'fa fa-picture-o', Artwork::class);
        yield MenuItem::linkToCrud('Manage categories', 'fa fa-tags', Category::class);
        yield MenuItem::linkToCrud('Manage comments', 'fa fa-comment', Comment::class);
        yield MenuItem::linkToCrud('Manage likes', 'fa fa-thumbs-up', Like::class);
        //ADMIN FIELD ONLY
        if ($this->isGranted('ROLE_ADMIN')) { 
            yield MenuItem::linkToCrud('Manage users', 'fas fa-user', User::class);
        }
    }

}
