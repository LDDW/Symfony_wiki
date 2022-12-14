<?php

namespace App\Form;

// use App\Entity\Categorie;

use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class NewArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $this->choices = $options['choices'];

        $builder
            ->add('titre', TextType::class)
            ->add('informations', TextType::class)
            ->add('image', FileType::class)
            // ->add('categorie', EntityType::class, array(
            //     'class' => Categorie::class,
            //     'choice_label' => 'nom',
            //     'placeholder' => 'Choisir une catégorie',
            // ))
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => [],
        ]);
    }
}
