<?php

namespace App\Form;

use App\Entity\Offrir;
use App\Entity\Medicament;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class OffrirType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite', TextType::class, [
                'label' => 'Quantité',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('idMedicament', EntityType::class, [
                'class' => Medicament::class,
                'choice_label' => 'nomcommercial',
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offrir::class,
        ]);
    }
}
