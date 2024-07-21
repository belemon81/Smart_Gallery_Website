<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use Doctrine\DBAL\Types\DateType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [ 
            AssociationField::new('User')->onlyOnIndex(),
            AssociationField::new('Artwork')->onlyOnIndex(),
            TextEditorField::new('content'),
            DateTimeField::new('commentTime')
        ];
    }

    // public function configureActions(Actions $actions): Actions
    // {
    //     return $actions 
    //         //->remove(Crud::PAGE_INDEX, Action::NEW)
    //         ->remove(Crud::PAGE_DETAIL, Action::EDIT)
    //     ;
    // }
}
