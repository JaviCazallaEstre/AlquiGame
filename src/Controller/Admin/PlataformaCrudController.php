<?php

namespace App\Controller\Admin;

use App\Entity\Plataforma;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PlataformaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plataforma::class;
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
