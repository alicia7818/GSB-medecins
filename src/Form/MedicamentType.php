<?php

namespace App\Form;

use App\Entity\Medicament;
use App\Entity\Famille;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MedicamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomcommercial')
            ->add('composition')
            ->add('effets')
            ->add('contreindications')
            ->add('idfamille', EntityType::class, [
                // looks for choices from this entity
                'class' => Famille::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'libelle',
            ])
            //->add('idrapport')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medicament::class,
        ]);
    }
}
