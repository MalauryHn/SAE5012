<?php

namespace App\Controller\Admin;

use App\Entity\Block;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;

class BlockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Block::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('article', 'Article');

        yield ChoiceField::new('type', 'Type de bloc')
            ->setChoices([
                'Titre' => 'title',
                'Texte' => 'text',
                'Image' => 'image',
                'Visualisation (Graphique)' => 'visualization'
            ]);

        yield IntegerField::new('ordering', 'Ordre');

        yield AssociationField::new('dataSet', 'Jeu de données')
            ->setHelp('Ne remplir que pour le type "Visualisation".');

        yield CodeEditorField::new('content', 'Contenu / Paramètres')
            ->setLanguage('js')
            ->setHelp('Si type=Texte, mettez juste le texte. Si type=Visualisation, mettez les paramètres JSON.');
    }
}