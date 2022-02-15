<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $roles = ['ROLE_ADMIN', 'ROLE_USER'];
        return [
            yield TextField::new('email'),
            yield TextField::new('password'),
            yield TextField::new('nombre'),
            yield TextField::new('apellidos'),
            yield DateField::new('fecha_nac'),
            yield ImageField::new('foto')
                ->setUploadDir('public/img/Perfil')
                ->setBasePath('img/Perfil'),
            yield ChoiceField::new('roles')
                ->setChoices(array_combine($roles,$roles))
                ->allowMultipleChoices()
                ->renderExpanded()
        ];
    }
}
