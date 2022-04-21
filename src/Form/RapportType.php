<?php

namespace App\Form;

use App\Entity\Rapport;
use App\Entity\Offrir;
use App\Entity\Visiteur;
use App\Entity\Medecin;
use App\Form\MedicamentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('motif', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('bilan', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('idvisiteur', EntityType::class, [
                // looks for choices from this entity
                'class' => Visiteur::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'nom',
                'label' => "Nom du visiteur",
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('idmedecin',EntityType::class, [
                // looks for choices from this entity
                'class' => Medecin::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'nom',
                'label' => "Nom du médecin",
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('offrirs', CollectionType::class, [
                'entry_type' => OffrirType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
                'entry_options' => ['label' =>false],
                'prototype' => true,
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
        ]);
    }
}
