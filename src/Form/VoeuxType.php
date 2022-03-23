<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Wish;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class VoeuxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ["label" => "Titre"])
            ->add('description', TextType::class, ["label" => "Description"])
            ->add('author', TextType::class, ["label" => "Auteur"])
            ->add('dateCreated', DateType::class, ["label" => "Date de création", "widget" => "single_text"])
            ->add('category', EntityType::class, ["class" => Category::class, 'choice_label'=>'name', 'label'=>"Choisir la catégorie"])
            ->add('ajout', SubmitType::class, ["label" => "Ajout"]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}
