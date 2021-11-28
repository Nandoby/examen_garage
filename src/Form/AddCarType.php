<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Voiture;
use App\Repository\MarqueRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
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
            ->add('modele', TextType::class)
            ->add('km', IntegerType::class)
            ->add('prix', MoneyType::class)
            ->add('nombres_proprietaires', IntegerType::class)
            ->add('cylindree', TextType::class)
            ->add('puissance', TextType::class)
            ->add('mise_circulation', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('carburant', TextType::class)
            ->add('transmission', TextType::class)
            ->add('description', TextareaType::class)
            ->add('options', TextType::class)
            ->add('coverImage', UrlType::class)
            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'choice_label' => 'name'
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => ImagesType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
