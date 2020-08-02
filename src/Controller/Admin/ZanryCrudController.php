<?php

namespace App\Controller\Admin;

use App\Entity\Zanry;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ZanryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Zanry::class;
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
