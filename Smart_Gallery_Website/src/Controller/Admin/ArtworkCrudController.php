<?php

namespace App\Controller\Admin;

use App\Entity\Artwork;
use DateTime;
use DateTimeZone;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController; 
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class ArtworkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Artwork::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [ 
            TextField::new('name')->setColumns(9),
            AssociationField::new('Artist')->setColumns(9),
            DateField::new('completionDate')->setEmptyData((new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh')))
                                            ->format('Y-m-d')),
            AssociationField::new('Category')->setColumns(9),
            TextEditorField::new('description')->setEmptyData("<em>The artist left nothing...</em>")
                                               ->onlyOnForms()
                                               ->setColumns(9),
            UrlField::new('artworkUrl')->setColumns(9),
            ImageField::new('artworkFile')->setBasePath('uploads/artworks')
                                          ->setUploadDir('public/uploads/artworks')
                                          ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
                                          ->setColumns(9),
            BooleanField::new('approved'),
            NumberField::new('totalViews')->setColumns(9),
        ];
    } 
}
