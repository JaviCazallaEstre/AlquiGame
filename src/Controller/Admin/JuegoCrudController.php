<?php

namespace App\Controller\Admin;

use App\Entity\Juego;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class JuegoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Juego::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('Nombre'),
            yield TextEditorField::new('Descripcion'),
            yield MoneyField::new('Precio')
                ->setCurrency('EUR')
                ->setCustomOption('storedAsCents', false),
            yield ImageField::new('foto')
                ->setUploadDir('public/img/juego')
                ->setBasePath('img/juego'),
            yield TextField::new('Video'),
            yield AssociationField::new('desarrolladora'),
            yield AssociationField::new('RangoEdad'),
            yield AssociationField::new('plataforma'),
            yield AssociationField::new('generos')
        ];
    }
}
