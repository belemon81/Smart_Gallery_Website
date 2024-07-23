<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setColumns(9),
            TextField::new('username')->setColumns(9),
            TextField::new('email')->setColumns(9), 
            ChoiceField::new('roles')->setColumns(9)
                                    ->allowMultipleChoices()
                                    ->autocomplete()
                                    ->setChoices([
                                        'Admin' => 'ROLE_ADMIN', 
                                        'Moderator' => 'ROLE_MOD', 
                                        'User' => 'ROLE_USER', 
                                    ])
                                    
        ];
    } 

    public function configureActions(Actions $actions): Actions
    {
        return $actions 
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
        ;
    }
}
