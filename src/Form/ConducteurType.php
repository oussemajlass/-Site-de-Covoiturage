<?php

namespace App\Form;

use App\Entity\Conducteur;
use App\Entity\Notification;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConducteurType extends AbstractType
{public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('name')
        ->add('prenom')
        ->add('adresse')
        ->add('telephone')
        ->add('dateInscription', null, [
            'widget' => 'single_text',
        ])
        ->add('vehicule')
        ->add('historiqueTrajets', null, [
            'required' => false,
        ])
    ;
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conducteur::class,
        ]);
    }
}
