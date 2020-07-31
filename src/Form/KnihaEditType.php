<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Knihy;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KnihaEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazev', TextType::class,[
                'label' => 'Název'
            ])
            ->add('author', EntityType::class,[
                'class' => Author::class
            ])
            ->add('detail', TextareaType::class,[
                'label' => 'Detail'
            ])
            ->add('obrazek', FileType::class, [
                'label' => 'Obrázek',
                'mapped' => false,
                'required' => false
            ])
            ->add('Add', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success float-right'
                ],
                'label' => 'Upravit knihu'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Knihy::class,
        ]);
    }
}
