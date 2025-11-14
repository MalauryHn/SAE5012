<?php
namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'Titre');

        yield TextareaField::new('summary', 'Résumé');

        yield ChoiceField::new('type')
            ->setChoices([
                'Article Classique' => 'classic',
                'Article Dashboard' => 'dashboard'
            ]);

        yield AssociationField::new('author', 'Auteur');

        yield DateTimeField::new('createdAt', 'Créé le')
            ->hideOnForm();
    }

}