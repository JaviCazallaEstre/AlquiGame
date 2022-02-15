<?php

namespace App\Controller\Admin;

use App\Entity\Reservas;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReservasCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservas::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield AssociationField::new('usuario'),
            yield AssociationField::new('juego'),
            yield DateField::new('FechaInicio'),
            yield DateField::new('FechaFin'),
            yield MoneyField::new('Precio')
                ->setCurrency('EUR')
                ->setCustomOption('storedAsCents', false),
            yield DateField::new('FechaDevolucion')
        ];
    }
}
