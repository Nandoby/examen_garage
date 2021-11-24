<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Voiture;
use App\Repository\MarqueRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddCarType extends AbstractType
{


    public function __construct(MarqueRepository $marque)
    {
        $this->marque = $marque;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('modele', TextType::class, [
                'attr' => [
                    'class'
                ]
            ])
            ->add('km')
            ->add('prix')
            ->add('nombres_proprietaires')
            ->add('cylindree')
            ->add('puissance')
            ->add('mise_circulation')
            ->add('carburant')
            ->add('transmission')
            ->add('description')
            ->add('options')
            ->add('coverImage', )
            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
