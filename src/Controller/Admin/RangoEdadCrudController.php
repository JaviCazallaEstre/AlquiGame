<?php

namespace App\Controller\Admin;

use App\Entity\RangoEdad;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RangoEdadCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RangoEdad::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
