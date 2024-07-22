<?php

namespace App\Controller\Admin;

use App\Entity\Like;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class LikeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Like::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [ 
            AssociationField::new('User'),
            AssociationField::new('Artwork'),
        ];
    } 

    public function configureActions(Actions $actions): Actions
    {
        return $actions 
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
        ;
    }
}
