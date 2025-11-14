<?php
namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();

        yield EmailField::new('email', 'Email');

        yield TextField::new('username', 'Nom d\'utilisateur');

        // Configure le champ des rôles
        yield ChoiceField::new('roles', 'Rôles')
            ->allowMultipleChoices()
            ->setChoices([
                'Abonné (User)' => 'ROLE_USER',
                'Auteur' => 'ROLE_AUTEUR',
                'Editeur' => 'ROLE_EDITEUR',
                'Designeur' => 'ROLE_DESIGNEUR',
                'Fournisseur' => 'ROLE_FOURNISSEUR',
                'Administrateur' => 'ROLE_ADMIN'
            ]);
    }

}